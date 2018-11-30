<?php

namespace App\Http\Controllers;

use DB;
use App\Vote;
use App\Story;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Session;
use Auth;
use App\Theme;

class StoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function topPage()
    {
        // get 10 top stories
        $stories = Story::all();
        $evalutedStories = [];
        foreach($stories as $story)
        {
            $votes = $story->votes();
            $up = $votes->where('vote', '=',  '1')->count();
            $dn = $votes->where('vote', '=', '-1')->count();

            $commentaries = $story->commentaries();
            $cc = $commentaries->count();

            $evalutedStories[$story->getId()] = ((2 * $up) - (3 * $dn) + (5 * $cc));
        }

        // Sort by score
        arsort($evalutedStories);

        // Get top 10 keys
        $keys = array_slice(array_keys($evalutedStories), 0, 10);

        // Get stories
        $storiesPaged = Story::whereIn('id', $keys)->paginate(3);

        return $this->paged($storiesPaged);
    }

    public function freshPage()
    {
        $storiesPaged = Story::orderBy('created_at', 'asc')->paginate(3);
        return $this->paged($storiesPaged);
    }

    public function randomPage()
    {
        $seed = Session::get("randomPageSeed"); //if unset -> null
        $storiesPaged = Story::inRandomOrder($seed)->paginate(3); //if seed == null -> like no seed
        return $this->paged($storiesPaged);
    }

    public function byUser($id)
    {
        return view("story.paged")->with("routeAJAX", route("stories.byUserPage", ['id' => $id]));
    }

    public function byUserPage($id)
    {
        $storiesPaged = Story::where('user_id', $id)->paginate(3);
        return $this->paged($storiesPaged);
    }

    private function paged($stories)
    {
        $output = "";

        if(count($stories) <= 0)
            abort(403, 'Unauthorized action.');

        foreach ($stories as $story)
        {
            $output .= view("story.show", ['story'=> $story]);
        }
        return $output;
    }

    public function random()
    {
        Session::put("randomPageSeed", rand()); //every time this route is used get a new random seed
        return view("story.paged")->with("routeAJAX", route("stories.randomPage"));
    }

    public function fresh()
    {
        return view("story.paged")->with("routeAJAX", route("stories.freshPage"));
    }

    public function top()
    {
        return view("story.paged")->with("routeAJAX", route("stories.topPage"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $themes = Theme::where('active', 1)->get();;
        $page = view('story/create', ['themes' => $themes]);
        return $page;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
          'title' => 'required',
          'text' => 'required',
        ]);

        $constraintsList = Session::get('constraints');
        $constraintsListWords = array_map(function($w){return $w['word'];}, $constraintsList);
        $themeid = Session::get('theme')->id;

        //Same verification algorithme as in the view
        $isValid = $this->verify($constraintsListWords, $request['text']);
        if($isValid)
        {
            $story = new Story([
            'title' => $request->get('title'),
            'text' => nl2br($request->get('text')),
            'user_id' => Auth::user()->getId(),
            'theme_id' => $themeid,
            'deleteVoted' => 0,
            ]);

            $story->save();

            $story->constraints()->saveMany($constraintsList);

            return redirect()->route('stories.random')->with('success', 'Story created successfully.');
        }
        else
        {
            return redirect()->route('stories.random')->with('failure', 'Story couldn\'t be added.');
        }
    }

    public function verify($constraints, $text)
    {
        $textToLower = strtolower($text);
        $textParsed = preg_replace("/[^a-zA-Z0-9 ]/i", " ", $textToLower); //replace every non letter / figure and space by a space
        $words = explode(" ", $textParsed);

        $forbidden = 0;
        $needed = length($constraints);
        foreach($constraints as $constraint)
        {
          if(in_array($constraint, $words))
          {
              if ($constraint->use)
              {
                $forbidden++;
              }
              else
              {
                $needed++;
              }
          }
        }

        /*foreach($words as $word)
        {
            if(in_array($word, $constraints))
            {
                unset($constraints[array_search($word, $constraints)]);
            }
        }*/
        return $forbidden == 0 && $needed == 0;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Story  $project
     * @return \Illuminate\Http\Response
     */
    public function access($id)
    {
        $story = Story::firstOrFail($id);
        return $this->show($story);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Story  $story
     * @return \Illuminate\Http\Response
     */
    public function show(Story $story)
    {
        return view('story.show', compact('story'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Story  $story
     * @return \Illuminate\Http\Response
     */
    public function edit(Story $story)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Story  $story
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Story $story)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Story  $story
     * @return \Illuminate\Http\Response
     */
    public function destroy(Story $story)
    {

    }

    public function like($id)
    {
      $story = Story::findOrFail($id);
      return $story->like();
    }

    public function dislike($id)
    {
      $story = Story::findOrFail($id);
      return $story->dislike();
    }
}

<?php

namespace App\Http\Controllers;

use DB;
use App\Vote;
use App\Story;
use Illuminate\Http\Request;
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
    public function index()
    {
        //old code with the view for every stories
        // $stories = Story::all();
        // return view('story.index', ['stories'=> $stories]);
        return view("story.paged");
    }

    public function page()
    {
        //it's not how we should do it be it makes the job done...
        $storiesPaged = Story::paginate(3);
        $output = "";

        if(sizeof($storiesPaged) <= 0)
            return abort(403, 'Unauthorized action.');

        foreach ($storiesPaged as $story)
        {
            $output .= view("story.show", ['story'=> $story]);
        }
        return $output;

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
            'text' => $request->get('text'),
            'user_id' => Auth::user()->getId(),
            'theme_id' => $themeid,
            'deleteVoted' => 0,
            ]);

            $story->save();

            return redirect()->route('displayStories')->with('success', 'Story created successfully.');
        }
        else
        {
            return redirect()->route('displayStories')->with('failure', 'Story couldn\'t be added.');
        }
    }

    public function verify($constraints, $text)
    {
        $textToLower = strtolower($text);
        $textParsed = preg_replace("/[^a-zA-Z0-9 ]/i", " ", $textToLower); //replace every non letter / figure and space by a space
        $words = explode(" ", $textParsed);

        foreach($words as $word)
        {
            if(in_array($word, $constraints))
            {
                unset($constraints[array_search($word, $constraints)]);
            }
        }
        return sizeof($constraints) == 0;
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

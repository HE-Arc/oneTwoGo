<?php

namespace App\Http\Controllers;

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
        $stories = Story::all();
        return view('story.index', ['stories'=>$stories]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $themes = Theme::all();
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
     * @param  \App\Story  $story
     * @return \Illuminate\Http\Response
     */
    public function preview(Story $story)
    {
        return view('story.preview', compact('story'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Story  $project
     * @return \Illuminate\Http\Response
     */
    public function access($id)
    {
        $story = Story::where('id', $id)->get()->first();
        return view('story.show')->with('story', $story);
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
        //
    }
}

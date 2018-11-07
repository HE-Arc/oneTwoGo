<?php

namespace App\Http\Controllers;

use App\Story;
use Illuminate\Http\Request;
use Session;
use Auth;


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
        $themes = [
            array('id' => '1', 'name' => 'theme name', 'description' => 'd1', 'img' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/b/b6/SIPI_Jelly_Beans_4.1.07.tiff/lossy-page1-256px-SIPI_Jelly_Beans_4.1.07.tiff.jpg'),
            array('id' => '2', 'name' => 'theme name2', 'description' => 'd2', 'img' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/6/66/SMPTE_Color_Bars.svg/672px-SMPTE_Color_Bars.svg.png')
        ];
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
          'theme_id' => 'required|integer',
          'title' => 'required',
          'text' => 'required',
        ]);

        //Same verification algorithme as in the view
        $isValid = $this->verify($request['text']);
        if($isValid)
        {
            $story = new Story([
            'title' => $request->get('title'),
            'text' => $request->get('text'),
            'user_id' => Auth::user()->getId(),
            'theme_id' => $request->get('theme_id'),
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

    public function verify($text)
    {
        $textToLower = strtolower($text);
        $textParsed = preg_replace("/[^a-zA-Z0-9 ]/i", " ", $textToLower); //replace every non letter / figure and space by a space
        $words = explode(" ", $textParsed);

        $constraints = Session::get('constraints');

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

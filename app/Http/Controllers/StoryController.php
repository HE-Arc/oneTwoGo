<?php

namespace App\Http\Controllers;

use App\story;
use Illuminate\Http\Request;

class StoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $page = view('story/create');
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\story  $story
     * @return \Illuminate\Http\Response
     */
    public function show(story $story)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\story  $story
     * @return \Illuminate\Http\Response
     */
    public function edit(story $story)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\story  $story
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, story $story)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\story  $story
     * @return \Illuminate\Http\Response
     */
    public function destroy(story $story)
    {
        //
    }
}

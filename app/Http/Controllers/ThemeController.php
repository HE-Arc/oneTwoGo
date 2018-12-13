<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Theme;
use App\Constraint;
use App\ConstraintsThemes;
//use Intervention\Image\ImageManagerStatic as Image;

class ThemeController extends Controller
{
    public function index()
    {
      $themes = Theme::all();
      return view('themes.index', ["themes"=>$themes]);
    }

    public function create()
    {
      $constraints = Constraint::where('active', 1)->get();
      return view("themes.create", ["theme" => new Theme(), "constraints" => $constraints]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'placeholder' => 'required',
            'active' => 'required'
        ]);

        $theme = Theme::create($request->all());
        $theme->constraints()->sync($request->constraints);
        return redirect()->route('themes.index')->with('success','Product created successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Theme  $Theme
     * @return \Illuminate\Http\Response
     */
    public function edit(Theme $theme)
    {
        $constraints = Constraint::where('active', 1)->get();
        return view('themes.edit', ["theme" => $theme, "constraints" => $constraints]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Theme  $Theme
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Theme $theme)
    {
        $request->validate([
            'name' => 'required',
            'placeholder' => 'required',
            'active' => 'required'
        ]);

        // Synchronize the pivot table
        $theme->constraints()->sync($request->constraints);
        $theme->update($request->all());

        return redirect()->route('themes.index')->with('success','Product updated successfully');
    }

    public function toggleActive($id)
    {
      $theme = Theme::find($id);
      $theme->update(['active' => !$theme->active]);
    }
}

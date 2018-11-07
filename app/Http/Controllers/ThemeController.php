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
      $themes =  Theme::all();
      return view('themes.index', ["themes"=>$themes]);
    }

    public function create()
    {
      return view("themes.create", ["theme" => new Theme()]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'name' => 'required'
        ]);

        Theme::create($request->all());

        return redirect()->route('themes.index')->with('success','Product created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Theme  $Theme
     * @return \Illuminate\Http\Response
     */

    public function show(Theme $theme)
    {
        return view('themes.show',compact('theme'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Theme  $Theme
     * @return \Illuminate\Http\Response
     */
    public function edit(Theme $theme)
    {
        $constraints = Constraint::all();
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
            'name' => 'required'
        ]);

        /*if($request->has('image'))
        {
          $image = $request->file('image');
          $image_resize = Image::make($image->getRealPath());
          $image_resize->resize(20, 20);
          $extension = $image->getClientOriginalExtension();
          $image_resize->storeAs('themes', $theme->id.'.'.$extension,'public');
          Storage::put('app/public/themes/'.$theme->id.'.'.$extension)
          $theme->update(['image' => 'themes\\'.$theme->id.'.'.$extension]);
          // $theme->update(['image' => $image->storeAs('themes', $theme->id.'.'.$extension,'public')]);
        }*/

        $theme->constraints()->sync($request->chkConstraints, $detaching = true);

        if($request->name != $theme->name)
        {
          //$theme->update(['name' => $request->name]);
          $theme->update($request->all());
        }

        return redirect()->route('themes.index')->with('success','Product updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Theme  $Theme
     * @return \Illuminate\Http\Response
     */
    public function destroy(Theme $theme)
    {
        $theme->delete();

        return redirect()->route('themes.index')->with('success','Product deleted successfully');
    }
}

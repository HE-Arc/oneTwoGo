<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Constraint;
use App\Theme;
use Session;

class ConstraintController extends Controller
{
  public function index()
  {
    $constraints =  Constraint::all();
    return view('constraints.index', ["constraints"=>$constraints]);
  }

  public function create()
  {
    $themes = Theme::where('active', 1)->get();
    return view("constraints.create", ["constraint" => new Constraint(), "themes" => $themes]);
  }

  public function store(Request $request)
  {
      $request->validate([
          'word' => 'required'
      ]);
      \Debugbar::info($request->themes);
      $constraint = Constraint::create($request->all());
      $constraint->themes()->sync($request->themes);
      return redirect()->route('constraints.index')->with('success','Product created successfully.');
  }

  public function random(Request $request)
  {
      $args = $request->all();
      $theme = Theme::findOrFail($args['theme_id']);
      $constraints = array_values(iterator_to_array($theme->constraints->where('active', 1)));

      $maxConstraints = 6;
      $randomconstraints = [];
      for($i = 0; $i < $maxConstraints && sizeof($constraints) > 0; $i++)
      {
          $id = random_int(0, sizeof($constraints) - 1);
          $randomconstraints[] = $constraints[$id];
          unset($constraints[$id]);
          $constraints = array_values($constraints); //reset id array
      }
      //Set in the session the constraints and the theme selected
      Session::forget('constraints');
      Session::put('constraints', $randomconstraints);
      Session::forget('theme');
      Session::put('theme', $theme);
      return array_map(function($c){return $c;},$randomconstraints); //return only words
  }

  /**
   * Display the specified resource.
   *
   * @param  \App\Constraint  $Constraint
   * @return \Illuminate\Http\Response
   */

  /**
   * Show the form for editing the specified resource.
   *
   * @param  \App\Constraint  $Constraint
   * @return \Illuminate\Http\Response
   */
  public function edit(Constraint $constraint)
  {
      $themes = Theme::where('active', 1)->get();
      return view('constraints.edit', ["constraint" => $constraint, "themes" => $themes]);
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  \App\Constraint  $Constraint
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, Constraint $constraint)
  {
      $request->validate([
          'word' => 'required'
      ]);

      $constraint->themes()->sync($request->themes);
      $constraint->update($request->all());

      return redirect()->route('constraints.index')->with('success','Product updated successfully');
  }

  public function toggleActive($id)
  {
    $constraint = Constraint::find($id);
    $constraint->update(['active' => !$constraint->active]);
  }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Constraint;
use Session;
use App\Theme;

class ConstraintController extends Controller
{
  public function index()
  {
    $constraints =  Constraint::all();
    return view('constraints.index', ["constraints"=>$constraints]);
  }

  public function create()
  {
    return view("constraints.create", ["constraint" => new Constraint()]);
  }

  public function store(Request $request)
  {
      $request->validate([
          'word' => 'required'
      ]);

      Constraint::create($request->all());

      return redirect()->route('constraints.index')->with('success','Product created successfully.');
  }

  public function random(Request $request)
  {
      $args = $request->all();
      $theme = Theme::findOrFail($args['theme_id']);
      $constraints = iterator_to_array($theme->constraints);

      $maxConstraints = 6;
      $randomconstraints = [];
      for($i = 0; $i < $maxConstraints && sizeof($constraints) > 0; $i++)
      {
          $id = rand(0, sizeof($constraints) - 1);
          $randomconstraints[] = $constraints[$id];
          unset($constraints[$id]);
          $constraints = array_values($constraints); //reset id array
      }
      //Set in the session the constraints and the theme selected
      Session::forget('constraints');
      Session::put('constraints', $randomconstraints);
      Session::forget('theme');
      Session::put('theme', $theme);
      return array_map(function($c){return $c['word'];},$randomconstraints); //return only words
  }

  /**
   * Display the specified resource.
   *
   * @param  \App\Constraint  $Constraint
   * @return \Illuminate\Http\Response
   */

  public function show(Constraint $constraint)
  {
      return view('constraints.show',compact('constraint'));
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  \App\Constraint  $Constraint
   * @return \Illuminate\Http\Response
   */
  public function edit(Constraint $constraint)
  {
      return view('constraints.edit',compact('constraint'));
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

      $constraint->update($request->all());

      return redirect()->route('constraints.index')->with('success','Product updated successfully');
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  \App\Constraint  $Constraint
   * @return \Illuminate\Http\Response
   */
  public function destroy(Constraint $constraint)
  {
      $constraint->delete();

      return redirect()->route('constraints.index')->with('success','Product deleted successfully');
  }
}

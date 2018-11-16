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

  public function random()
  {
      $nbConstraints = 6;
      $allconstraints = ["a", "b", "c", "d", "e", "f", "g", "h", "i", "j", "k"];
      $randomconstraints = [];
      for($i = 0; $i < $nbConstraints; $i++)
      {
          $id = rand(0, sizeof($allconstraints) - 1);
          $randomconstraints[] = $allconstraints[$id];
          unset($allconstraints[$id]);
          $allconstraints = array_values($allconstraints);
      }
      Session::put('constraints', $randomconstraints);
      return $randomconstraints;
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

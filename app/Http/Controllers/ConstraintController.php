<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Constraint;

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

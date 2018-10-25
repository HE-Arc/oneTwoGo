@extends('layouts.app')

@section('content')
<h2>Start writing your story !</h2>
<div>
    <i class="fas fa-arrow-left"></i>
    <img src='' width="400px" height="200px">
    <i class="fas fa-arrow-right"></i>
</div>
<div>
<h2>Constraint</h2>
    <span style='font-size:20px' class="badge badge-success">Contrainte1</span>
    <span style='font-size:20px' class="badge badge-danger">Contrainte2</span>
    <i class="navicon fas fa-random"></i>
</div>
<h2>Story</h2>
<form action='test' style='width:700px'>
    <label for='title'>Title</label>
    <div>
        <input type='text' name='title' placeholder="My awesome story" style='width:100%'>
    </div>
    <div>
        <textarea class="form-control" id="exampleTextarea" rows="15"></textarea>
    </div>
    <i class="navicon fas fa-save" onclick="this.form.submit();"></i>
</form>
@endsection

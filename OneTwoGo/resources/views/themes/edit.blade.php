@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
      @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Whoops!</strong> There were some problems with your input.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
      @endif

      <form action="{{ route('themes.update',$theme->id) }}" method="POST"  enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="row">
          <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
              <strong>Name:</strong>
              <input type="text" name="name" value="{{ $theme->name }}" class="form-control" placeholder="Name">
              <!--<img src="{{ asset('storage/'.$theme->image) }}" />
              <input type="file" accept="image/*" name="image" class="form-control" placeholder="Image">
            -->
              @foreach ($constraints->all() as $constraint)
                <input type="checkbox" name="constraints[]" value="{{ $constraint->id }}" /> {{ $constraint->word }} <br />
              @endforeach
            </div>
          </div>
          <div class="col-xs-12 col-sm-12 col-md-12 text-center">
            <button type="submit" class="btn btn-primary">Submit</button>
            <a class="btn btn-primary" href="{{ route('themes.index') }}"> Back</a>
          </div>
        </div>
    </form>

@endsection

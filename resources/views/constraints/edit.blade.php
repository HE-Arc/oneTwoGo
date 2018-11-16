@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <h1>Edition</h1>
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

      <form action="{{ route('constraints.update',$constraint->id) }}" method="POST"  enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="row">
          <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
              <label>Texte</label>
              <input type="text" name="word" value="{{ $constraint->word }}" class="form-control" placeholder="Word">
              <br />
              <!--<img src="{{ asset('storage/'.$constraint->image) }}" />
              <input type="file" accept="image/*" name="image" class="form-control" placeholder="Image">
            -->

              <div class="scrollbar scrollbar-primary form-control">
                <div class="force-overflow">
                  <div class="row">
                    @foreach ($themes->all() as $theme)
                      @if ($theme->active)
                        <div class="col-xs-12 col-sm-12 col-md-12">
                          <label class="customcheck">
                            {{ $theme->name }}
                            @php ($added = false)
                            @foreach ($constraint->themes as $themeConstraint)
                              @if($theme->id === $themeConstraint->id)
                                @php ($added = true)
                                <input type="checkbox" name="themes[]" id="checkBox-{{ $theme->id }}" value="{{ $theme->id }}" checked />
                              @endif
                            @endforeach
                            @if(!$added)
                              <input type="checkbox" name="themes[]" id="checkBox-{{ $theme->id }}" value="{{ $theme->id }}" />
                            @endif
                            <span class="checkmark"></span>
                          </label>
                        </div>
                      @endif
                    @endforeach
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-xs-12 col-sm-12 col-md-12 text-center">
            <button type="submit" class="btn btn-otg">Submit</button>
            <a class="btn btn-otg" href="{{ route('constraints.index') }}"> Back</a>
          </div>
        </div>
    </form>
@endsection

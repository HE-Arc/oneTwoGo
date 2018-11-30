@extends('layouts.app')

@section('content')
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-8">
        <h1>Ajout</h1>
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
        <div class="row">
          <div class="col-xs-12 col-sm-12 col-md-12">
            <form action="{{ route('constraints.store') }}" method="POST">
            @csrf
            <div class="row">
              <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                  <label>Texte</label>
                  <input type="text" name="word" value="" class="form-control" placeholder="Word">
                  <br />
                  <div class="scrollbar scrollbar-primary">
                    <div class="force-overflow">
                      <div class="row">
                        @foreach ($themes->all() as $theme)
                          @if ($theme->active)
                            <div class="col-xs-12 col-sm-12 col-md-12">
                              <label class="customcheck">
                                {{ $theme->name }}
                                <input type="checkbox" name="themes[]" id="checkBox-{{ $theme->id }}" value="{{ $theme->id }}" />
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
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection

@extends('layouts.app')

@section('content')
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-8">
        <h1 class="mb-5">Création de thème</h1>
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
            <form action="{{ route('themes.store') }}" method="POST">
            @csrf
            <div class="row">
              <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                  <label>Titre</label>
                  <input type="text" name="name" value="" class="form-control" placeholder="Titre">
                  <label class= "mt-4">Espace réservé</label>
                  <input type="text" name="placeholder" value="" class="form-control" placeholder="Espace réservé">
                  <!--<img src="{{ asset('storage/'.$theme->image) }}" />
                  <input type="file" accept="image/*" name="image" class="form-control" placeholder="Image">
                  -->

                  <div class="scrollbar scrollbar-primary">
                    <div class="force-overflow">
                      <div class="row">
                        @foreach ($constraints->all() as $constraint)
                          <div class="col-xs-4 col-sm-4 col-md-4">
                            <label class="customcheck">
                              {{ $constraint->word }}
                              <input type="checkbox" name="constraints[]" id="checkBox-{{ $constraint->id }}" value="{{ $constraint->id }}" />
                              <span class="checkmark"></span>
                            </label>
                          </div>
                        @endforeach
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                <button type="submit" class="btn btn-otg">Submit</button>
                <a class="btn btn-otg" href="{{ route('themes.index') }}"> Back</a>
              </div>
            </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection

@extends('layouts.app')

@section('content')
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-8">
        <div class="row">
          <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Word:</strong>
                {{ $constraint->word }}
            </div>
          </div>
          <div class="pull-right">
              <a class="btn btn-primary" href="{{ route('constraints.index') }}"> Back</a>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection

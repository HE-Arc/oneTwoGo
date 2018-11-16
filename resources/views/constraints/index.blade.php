@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <h1>Contraintes</h1>
      <div class="scrollbar scrollbar-primary form-control">
        <div class="force-overflow">
          <div class="row">
              @foreach ($constraints as $constraint)
              <div class="col-xs-3 col-sm-3 col-md-3">
                <label class="customcheck">
                  {{ $constraint->word }}
                  @if($constraint->active)
                    <input type="checkbox" class="chkConstraints" name="activation-{{ $constraint->id }}" id="activation-{{ $constraint->id }}" value="{{ $constraint->id }}" checked />
                  @else
                    <input type="checkbox" class="chkConstraints" name="activation-{{ $constraint->id }}" id="activation-{{ $constraint->id }}" value="{{ $constraint->id }}" />
                  @endif
                  <span class="checkmark"></span>
                </label>
              </div>
              @endforeach
            </div>
        </div>
      </div>
      <div class="pull-right">
        <a class="btn btn-otg" href="{{ route('constraints.create') }}">Nouveau</a>
      </div>
    </div>
  </div>
  <script>
    $(document).ready(function() {
      $('.chkConstraints').each(function() {
        $(this).click(function() {
          id = $(this).attr('value');
          $.ajax({
              type: 'POST',
              url : "/constraints/" + id + "/toggleActive",
              headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              },
              success : function () {}
          });
        });
      });
    });
  </script>
@endsection

@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <h1>Thèmes</h1>
      <div class="scrollbar scrollbar-primary form-control">
        <div class="force-overflow">
          <div class="row">
              @foreach ($themes as $theme)
              <div class="col-xs-12 col-sm-12 col-md-12">
                <label class="customcheck">
                  {{ $theme->name }}
                  @if($theme->active)
                    <input type="checkbox" class="chkThemes" name="activation-{{ $theme->id }}" id="activation-{{ $theme->id }}" value="{{ $theme->id }}" checked />
                  @else
                    <input type="checkbox" class="chkThemes" name="activation-{{ $theme->id }}" id="activation-{{ $theme->id }}" value="{{ $theme->id }}" />
                  @endif
                  <span class="checkmark"></span>
                </label>
              </div>
              @endforeach
            </div>
        </div>
      </div>
      <div class="pull-right">
        <a class="btn btn-otg" href="{{ route('themes.create') }}">Nouveau</a>
      </div>
    </div>
  </div>
  <script>
    $(document).ready(function() {
      $('.chkThemes').each(function() {
        $(this).click(function() {
          id = $(this).attr('value');
          $.ajax({
              type: 'POST',
              url : "/themes/" + id + "/toggleActive",
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

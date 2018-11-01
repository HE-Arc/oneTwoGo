@extends('layouts.app')

@section('content')
<div class="container">
  <!-- ^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^ -->
  <!-- https://getbootstrap.com/docs/4.1/components/alerts/ -->
  <!-- vvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvv -->
  @if ($message = Session::get('success'))
  <div class="alert alert-success alert-dismissible fade show" role="alert">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    <p>{{ $message }}</p>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>

  @endif

  <div class="row">
    <div class="col-xs-3">
      @foreach($stories as $story)
        @include('story.preview', ['story' => $story])
      @endforeach
    </div>
    <div class="col-xs-1">
    </div>
    <div class="col-xs-8">
      <div id="story-container">
        ijapodsjapodsjaposjdapoj
      </div>
    </div>
  </div>

@endsection

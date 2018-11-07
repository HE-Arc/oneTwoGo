@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row">
    <div class="col-md-4">
      <div class="row">
        @foreach($stories as $story)
          @include('story.preview', ['story' => $story])
        @endforeach
      </div>
    </div>
    <div class="position-fixed col-md-8 " style="max-width:60%; right:5rem;">
      <div id="story-container">
        
      </div>
    </div>
  </div>
</div>
@endsection

@extends('layouts.app')

@section('content')
<div class="container-fluid">
  <div class="row">
    <div class="col-md-2 spacer"></div>
    <!-- Story list -->
    <div class="col-md-8">
      <div class="row flex-grow">
        @foreach($stories as $story)
          @include('story.show', ['story' => $story])
        @endforeach
      </div>
    </div>
    <!-- Enf of Story list -->
    <div class="col-md-2 spacer"></div>
  </div>
</div>
@endsection

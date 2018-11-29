@if(!empty($story))

@php
$commentaries = $story->commentaries();
$commentariesCount = $commentaries->count();
@endphp

<div class="card text-center mt-2">
  <div class="card-header">
    <h5 class="card-title">
      @if(empty($story->title))
        No title found !
      @else
        {{ $story->title }}
      @endif
    </h5>
  </div>
  <div class="card-body">
    <p class="card-text text-left">
      @if(empty($story->text))
        no text found
      @else
        {{ $story->text }}
      @endif
    </p>
    <footer class="blockquote-footer text-right">
        <!-- VERY VERY UGLY way to get likes, dislikes and comments but ...
          I had no choice, impossible to call a controller function from the index view -->

        <!-- Protect like, dislike and comment if user is not logged in, with a better way rather than by the route -->
        <!-- Show the like in blue if user liked it, the dislike in red and comment in yellow -->
        <a class="btn btn-default btn-sm d-inline" onclick="Votes.likeAJAX({{ $story->getId() }})">
          <div class="d-inline" id="upVotesCount{{$story->getId()}}">
            {{ $story->getUpvotesCount() }}
          </div>
          <i class="fas fa-thumbs-up d-inline"></i>
        </a>
        <a class="btn btn-default btn-sm d-inline" onclick="Votes.dislikeAJAX({{ $story->getId() }})">
          <div class="d-inline" id="downVotesCount{{$story->getId()}}">
            {{ $story->getDownvotesCount() }}
          </div>
          <i class="fas fa-thumbs-down d-inline"></i>
        </a>
        <a class="btn btn-default btn-sm d-inline" onclick="$('#commentarySection{{ $story->getId() }}').toggle()">
          <div class="d-inline" id="commentariesCount">
            {{ $commentariesCount }}
          </div>
          <i class="fas fa-comment d-inline"></i>
        </a>
    </footer>
  </div>
  <div class="card-footer"  style="display:none" id="commentarySection{{ $story->getId() }}">
    <table class="table">
      <tr>
        <td>
          <!-- add commentary -->
          @if(Auth::check())
          @include('commentary.create', ['story_id' => $story->getId()])
          @endif
          <!-- end of add commentary -->
        </td>
      </tr>

      <!-- Foreach commentary -->
      @forelse($commentaries as $commentary)
      <tr class="border border-light rounded-circle">
        <td>
          @include('commentary.show', ['commentary' => $commentary])
        </td>
      </tr>
      @empty
        <p>No comment found :c</p>
      @endforelse
    </table>
  </div>
  <!-- end of commentary -->
</div>

<!-- SHOW COMMENTARIES CREATION HERE -->
<!-- SHOW COMMENTARIES HERE -->
@endif

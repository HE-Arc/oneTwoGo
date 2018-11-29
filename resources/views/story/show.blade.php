@if(!empty($story))

@php
// $commentariesCount = $commentaries->count();
@endphp
<div class="card text-center mt-2 w-100">
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
    @foreach ($story->constraints as $constraint)
        <span class="badge badge-pill badge-success">{{ $constraint->word }}</span>
    @endforeach
    <p class="card-text text-left">
      @if(empty($story->text))
        no text found
      @else
        {{ $story->text }}
      @endif
    </p>
    <footer class="blockquote-footer row">
        <div class="col text-left">
            <!-- VERY VERY UGLY way to get likes, dislikes and comments but ...
              I had no choice, impossible to call a controller function from the index view -->

            <!-- Protect like, dislike and comment if user is not logged in, with a better way rather than by the route -->
            <!-- Show the like in blue if user liked it, the dislike in red and comment in yellow -->
            <a type="button" class="btn btn-default btn-sm d-inline" onclick="Votes.likeAJAX({{ $story->id }})">
              <div id="upVotesCount{{$story->id}}" class="d-inline">
                {{ $story->getUpvotesCount() }}
              </div>
              <i id="upVoteThumb{{$story->id}}" class="@if($story->getDidIVote("1")) text-success @endif fas fa-thumbs-up d-inline"></i>
            </a>
            <a type="button" class="btn btn-default btn-sm d-inline" onclick="Votes.dislikeAJAX({{ $story->id }})">
              <div id="downVotesCount{{$story->id}}" class="d-inline">
                {{ $story->getDownvotesCount() }}
              </div>
              <i id="downVoteThumb{{$story->id}}" class="@if($story->getDidIVote("-1")) text-danger @endif fas fa-thumbs-down d-inline"></i>
            </a>
            <a type="button" class="btn btn-default btn-sm d-inline" onclick="$('#commentarySection{{ $story->id }}').toggle()">
              <div class="d-inline" id="commentariesCount">
                {{ $story->commentaries->count() }}
              </div>
              <i class="fas fa-comment d-inline"></i>
          </a>
        </div>
        <div class="col text-right">
            <p>Posté par : {{$story->user->name}}@if($story->created_at), {{$story->created_at}}@endif</p>
        </div>
    </footer>
  </div>
  <div class="card-footer"  style="display:none" id="commentarySection{{ $story->id }}">
    <table class="table">
      <tr>
        <td>
          <!-- add commentary -->
          @if(Auth::check())
          @include('commentary.create', ['story_id' => $story->id])
          @endif
          <!-- end of add commentary -->
        </td>
      </tr>

      <!-- Foreach commentary -->
      @forelse($story->commentaries as $commentary)
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

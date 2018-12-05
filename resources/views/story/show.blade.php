@if(!empty($story))

<div class="card story-card text-center mt-2 w-100">
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
        <span class="badge badge-pill @if($constraint->use == 1) badge-success @else badge-danger @endif">{{ $constraint->word }}</span>
    @endforeach
    <div id="storyTextLimiter{{$story->id}}" class="story-text-closed">
      <div id='storyText{{$story->id}}' class="card-text text-left">
        @if(empty($story->text))
          no text found
        @else
          @foreach($story->getParagraphs() as $paragraph)
          <p>
            {{ $paragraph }}
          </p>
          @endforeach
        @endif
      </div>
    </div>
    <i id="storyExpendIcon{{$story->id}}" onclick='Story.toggleStory(this, {{$story->id}})' class="storyExpendIconClass fas fa-angle-down" style='font-size:30px'></i>
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
              <i id="upVoteThumb{{$story->id}}" class="@if($story->getDidIVote("1")) text-primary @endif fas fa-thumbs-up d-inline"></i>
            </a>
            <a type="button" class="btn btn-default btn-sm d-inline" onclick="Votes.dislikeAJAX({{ $story->id }})">
              <div id="downVotesCount{{$story->id}}" class="d-inline">
                {{ $story->getDownvotesCount() }}
              </div>
              <i id="downVoteThumb{{$story->id}}" class="@if($story->getDidIVote("-1")) text-danger @endif fas fa-thumbs-down d-inline"></i>
            </a>
            <a type="button" class="btn btn-default btn-sm d-inline" onclick="$('#commentarySection{{ $story->id }}').toggle()">
              <div id="comments-count-{{ $story->id }}" class="d-inline">
                {{ $story->commentaries->count() }}
              </div>
              <i class="fas fa-comment d-inline"></i>
          </a>
        </div>
        <div class="col text-right">
            <p>Posté par : <a href="{{ route('stories.byUser', ['id' => $story->user->id]) }}">{{$story->user->name}}</a>@if($story->created_at), {{$story->created_at}}@endif</p>
        </div>
    </footer>
  </div>
	<div id="commentarySection{{ $story->id }}" class="card-footer" style="display:none">
		<h5>Comments</h5>
		@if(Auth::check())
			@include('commentary.create', ['story_id' => $story->id])
		@endif
		<table id='comments-story-{{ $story->id }}' class="table">
			@foreach($story->commentaries as $commentary)
				@include('commentary.show', ['commentary' => $commentary])
			@endforeach
		</table>
	</div>
</div>

<script>
// can't use a static method because it's call by eval()
function hideIcon(id) {
    // If text is smaller than his container, hide toggle button

    var height = $("#storyText"+id).css('height');
    var maxHeight = $('#storyTextLimiter'+id).css('max-height');

    height = parseInt(height.substring(0, height.length - 2));
    maxHeight = parseInt(maxHeight.substring(0, maxHeight.length - 2));

    if (height < maxHeight) {
        $('#storyExpendIcon'+id).css('display','none');
    }
}

  $(document).ready(function() {
      $(".storyExpendIconClass").each(function() {
        var id = parseInt($(this)[0].id.substring(15));
        hideIcon(id);
      });
  });
</script>
@endif

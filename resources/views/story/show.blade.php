@if(!empty($story))
<div class="card text-center">
  <div class="card-body">
    <h5 class="card-title">
      @if(empty($story->title))
        No title found !
      @else
        {{$story->title}}
      @endif
    </h5>
    <p class="card-text text-left">
      @if(empty($story->text))
        no text found
      @else
        {{ $story->text }}
      @endif
    </p>
    <footer class="blockquote-footer text-right">
      <p>
        <!-- VERY VERY UGLY way to get likes, dislikes and comments but ...
          I had no choice, impossible to call a controller function from the index view -->

        <!-- Protect like, dislike and comment if user is not logged in, with a better way rather than by the route -->

        <a type="button" class="btn btn-default btn-sm d-inline" onclick="like({{ $story->getId() }})">
          <div class="d-inline" id="upVotesCount">
            {{ $story->getUpvotesCount() }}
          </div>
          <i class="fas fa-thumbs-up d-inline"></i>
        </a>
        <a type="button" class="btn btn-default btn-sm d-inline" onclick="dislike({{ $story->getId() }})">
          <div class="d-inline" id="downVotesCount">
            {{ $story->getDownvotesCount() }}
          </div>
          <i class="fas fa-thumbs-down d-inline"></i>
        </a>
        <a type="button" class="btn btn-default btn-sm d-inline">
          <div class="d-inline" id="commentariesCount">
            {{ $story->getCommentaries()->count() }}
          </div>
          <i class="fas fa-comment d-inline"></i>
        </a>
      </p>
    </footer>
  </div>
</div>

<!-- SHOW COMMENTARIES CREATION HERE -->
<!-- SHOW COMMENTARIES HERE -->

<script>
function like(id)
{
  $.ajax({
      type: 'POST',
      url : "/story/" + id + "/like",
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
      success : function (data) {
        $('#upVotesCount').html(data[0]);
        $('#downVotesCount').html(data[1]);
      }
  });
}
function dislike(id)
{
  $.ajax({
      type: 'POST',
      url : "/story/" + id + "/dislike",
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
      success : function (data) {
        $('#upVotesCount').html(data[0]);
        $('#downVotesCount').html(data[1]);
      }
  });
}
</script>

@endif

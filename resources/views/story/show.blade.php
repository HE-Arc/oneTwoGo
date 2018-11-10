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

        <a type="button" class="btn btn-default btn-sm" onclick="like({{$story->getId()}})">
          {{ $story->getUpvotesCount() }}
          <i class="fas fa-thumbs-up"></i>
        </a>
        <a type="button" class="btn btn-default btn-sm" onclick="dislike({{$story->getId()}})">
          {{ $story->getDownvotesCount() }}
          <i class="fas fa-thumbs-down"></i>
        </a>
        <a type="button" class="btn btn-default btn-sm">
          {{ $story->getCommentaries()->count() }}
          <i class="fas fa-comment"></i>
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
      type: 'GET',
      url : "/story/" + id + "/like",
      success : function (data) {

      }
  });
}
function dislike(id)
{
  $.ajax({
      type: 'GET',
      url : "/story/" + id + "/dislike",
      success : function (data) {

      }
  });
}
</script>

@endif

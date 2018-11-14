<div class="card text-center" style="width: 18rem; height: 18rem;">
  <div class="card-body">
    <h5 class="card-title btn" onclick="showFullStory({{$story->getId()}})">{{$story->title}}</h5>
    <p class="card-text text-left block-with-text">
      {{$story->text}}
    </p>
    <footer class="blockquote-footer text-right">
      <p>
        <!-- VERY VERY UGLY way to get likes, dislikes and comments but ...
          I had no choice, impossible to call a controller function from the index view -->
          {{ $story->getUpvotesCount() }}
          <i class="fas fa-thumbs-up" style="margin-right:10px;"></i>

          {{ $story->getDownvotesCount() }}
          <i class="fas fa-thumbs-down" style="margin-right:10px;"></i>

          {{ $story->getCommentaries()->count() }}
          <i class="fas fa-comment" style="margin-right:10px;"></i>
      </p>
    </footer>
  </div>
</div>

<script>
function showFullStory(id)
{
  $.ajax({
      type: 'GET',
      url : "/story/" + id,
      success : function (data) {
          $("#story-container").html(data);
      }
  });
}
</script>

<div class="card text-center" style="width: 18rem; height: 18rem;">
  <div class="card-body">
    <h5 class="card-title btn" onclick="showFullStory({{$story->getId()}})">{{$story->title}}</h5>
    <p class="card-text text-left block-with-text">
      {{$story->text}}
    </p>
    <footer class="blockquote-footer text-right">
      <p>
        <a type="button" class="btn btn-default btn-sm">
          <i class="fas fa-thumbs-up"></i>
        </a>
        <a type="button" class="btn btn-default btn-sm">
          <i class="fas fa-thumbs-down"></i>
        </a>
        <a type="button" class="btn btn-default btn-sm">
          <i class="fas fa-comment"></i>
        </a>
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

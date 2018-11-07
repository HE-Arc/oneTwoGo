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
@endif

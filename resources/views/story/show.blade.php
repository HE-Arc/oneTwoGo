<div class="card text-center">
  <div class="card-body">
    <h5 class="card-title">{{$story->title}}</h5>
    <p class="card-text text-left">
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

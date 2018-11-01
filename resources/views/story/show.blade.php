@extends('layouts.app')

@section('content')

<style>
.block-with-text {

}
</style>

<div class="card text-center" style="width: 18rem; height: 18rem;">
  <div class="card-body">
    <h5 class="card-title">Story name</h5>
    <p class="card-text text-left block-with-text">
      Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus accumsan pretium venenatis. Donec et lorem sed eros lobortis luctus ac quis massa. Donec ut metus vel velit dignissim molestie. Phasellus ipsum leo, vulputate a dapibus vitae, fringilla at ante. Quisque id risus at lectus hendrerit interdum nec id nunc. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Praesent efficitur risus eget turpis accumsan, rhoncus varius velit malesuada. Ut sodales ipsum id dolor congue, sed consectetur nibh auctor. Integer congue mauris eu dolor tincidunt varius. Nulla egestas nisi in euismod auctor. Duis quis mi ac tellus bibendum ornare nec vitae elit. Nullam a feugiat arcu, et sollicitudin arcu. Donec cursus quis ipsum sit amet finibus.
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

@endsection

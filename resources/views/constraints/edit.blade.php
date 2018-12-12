@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <h1 class="mb-5">Edition de contrainte</h1>
      @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Whoops!</strong> Il semble qu'une erreur soit survenue.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
      @endif

      <form action="{{ route('constraints.update',$constraint->id) }}" method="POST"  enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="row">
          <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
              <input type="hidden" name="use" id="use" value="{{$constraint->use}}" />
              <div class="text-center">
                @if ($constraint->use)
                  <input type="checkbox" id="toggleUse" data-onstyle="toggle-otg" data-offstyle="danger" data-toggle="toggle" data-on="Obligatoire" data-off="Interdit" checked>
                @else
                  <input type="checkbox" id="toggleUse" data-onstyle="toggle-otg" data-offstyle="danger" data-toggle="toggle" data-on="Obligatoire" data-off="Interdit">
                @endif
              </div>
              <label class="mb-0 mt-4">Mot</label>
              <input type="text" name="word" value="{{ $constraint->word }}" class="form-control" placeholder="Mot"><span class="float-right mb-2">
              <div class="scrollbar scrollbar-primary form-control mt-4">
                <div class="force-overflow">
                  <div class="row">
                    @foreach ($themes->all() as $theme)
                      @if ($theme->active)
                        <div class="col-xs-12 col-sm-12 col-md-12">
                          <label class="customcheck">
                            <span class="a-otg">{{ $theme->name }}</span>
                            @php ($added = false)
                            @foreach ($constraint->themes as $themeConstraint)
                              @if($theme->id === $themeConstraint->id)
                                @php ($added = true)
                                <input type="checkbox" name="themes[]" id="checkBox-{{ $theme->id }}" value="{{ $theme->id }}" checked />
                              @endif
                            @endforeach
                            @if(!$added)
                              <input type="checkbox" name="themes[]" id="checkBox-{{ $theme->id }}" value="{{ $theme->id }}" />
                            @endif
                            <span class="checkmark"></span>
                          </label>
                        </div>
                      @endif
                    @endforeach
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-xs-12 col-sm-12 col-md-12 text-center">
            <button type="submit" class="btn btn-otg">Valider</button>
            <a class="btn btn-otg" href="{{ route('constraints.index') }}">Annuler</a>
          </div>
        </div>
    </form>
    <script type="text/javascript">
      $(document).ready(function() {
        $('.toggle-group').click(function() {
          var use = $('#use');
          if (use.val() == '1')
          {
            use.val('0');
          }
          else {
            use.val('1');
          }
        });
      });
    </script>
@endsection

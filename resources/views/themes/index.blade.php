@extends('layouts.app')

@section('content')
  <div class="flex-center position-ref full-height">
    <div class="col-md-8">
      <table class="table table-bordered">
        <thead class="thead-dark">
          <tr>
            <th scope="col">Name</th>
            <th scope="col">Actions</th>
          </tr>
        </thead>
        <tbody>
          @foreach($themes as $theme)
            <tr>
              <td>{{$theme->name}}</td>
              <td>
                <form action="{{ route('themes.destroy',$theme->id) }}" method="POST">
                  <a class="btn btn-primary" href="{{ route('themes.edit',$theme->id) }}">Edit</a>
                  @csrf
                  @method('DELETE')
                  <button type="submit" class="btn btn-danger">Delete</button>
                </form>
              </td>
            </tr>
          @endforeach
        </tbody>
      </table>
      <div class="pull-right">
        <a class="btn btn-primary" href="{{ route('themes.create') }}"> Add Theme</a>
      </div>
    </div>
  </div>
@endsection

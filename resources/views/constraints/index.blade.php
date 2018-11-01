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
          @foreach($constraints as $constraint)
            <tr>
              <td>{{$constraint->word}}</td>
              <td>
                <form action="{{ route('constraints.destroy',$constraint->id) }}" method="POST">
                  <a class="btn btn-info" href="{{ route('constraints.show',$constraint->id) }}">Show</a>
                  <a class="btn btn-primary" href="{{ route('constraints.edit',$constraint->id) }}">Edit</a>
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
        <a class="btn btn-primary" href="{{ route('constraints.create') }}"> Add Constraint</a>
      </div>
    </div>
  </div>
@endsection

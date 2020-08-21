@extends('layouts.app')

@section('content')
    @if (session('success'))
        <div class="alert alert-success" role="alert">
            <h4 class="alert-heading"></h4>
            <p>{{ session('success') }}</p>
            <p class="mb-0"></p>
        </div>
    @endif


    <a href="{{ route('film.create') }}" class="btn btn-primary m-3">
        <span class="m-3"> Add Film</span><i class="fa fa-plus" aria-hidden="true"></i>
    </a>

    <table class="table table-striped table-inverse table-responsive">
        <thead class="thead-inverse">
            <tr>
                <th>Title</th>
                <th>Story</th>
                <th>Edit</th>
                <th>Delete</th>
            </tr>
            </thead>
            <tbody>
                @foreach ($films as $film)
                    <tr>
                        <td><a href="{{ route('film.show',$film->id) }}">{{ $film->name }}</a></td>
                        <td>{{ $film->story }}</td>
                        <td><a href="{{ route('film.edit', $film->id) }}" class="btn btn-warning"><i class="fa fa-edit"></i></a></td>
                        <td>
                            {!! Form::open(['route'=>['film.destroy',$film->id], 'method'=>'POST']) !!}
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">
                                    <i class="fa fa-trash" aria-hidden="true"></i>
                                </button>
                            {!! Form::close() !!}
                        </td>
                    </tr>
                @endforeach
            </tbody>
    </table>
    <div class="d-flex justify-content-center">
        {{ $films->links() }}
    </div>
@endsection

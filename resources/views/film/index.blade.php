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
            </tr>
            </thead>
            <tbody>
                @foreach ($films as $film)
                    <tr>
                        @if($film->trashed())
                            <td data-toggle="tooltip" title="This film is removed.">{{ $film->name }}</td>
                            <td data-toggle="tooltip" title="This film is removed.">{{ $film->story }}</td>
                            <td>
                                {!! Form::open(['route'=>['film.restore',$film->id], 'method'=>'POST']) !!}
                                    @csrf
                                    {!! Form::button('<i class="fa fa-undo"></i>',['type'=>'submit','class'=>' btn btn-info', 'data-toggle'=>'tooltip', 'title'=>'Click to restore Film!', 'aria-hidden'=>'true']) !!}
                                {!! Form::close() !!}
                            </td>

                        @else
                            <td><a href="{{ route('film.show',$film->id) }}" data-toggle="tooltip" title="View">{{ $film->name }}</a></td>
                            <td>{{ $film->story }}</td>
                            <td><a href="{{ route('film.edit', $film->id) }}" class="btn btn-warning" data-toggle="tooltip" title="Edit film"><i class="fa fa-edit"></i></a></td>
                            <td>
                                {!! Form::open(['route'=>['film.destroy',$film->id], 'method'=>'POST']) !!}
                                    @csrf
                                    @method('DELETE')
                                    {!! Form::button('<i class="fa fa-trash"></i>',['type'=>'submit','class'=>' btn btn-danger', 'data-toggle'=>'tooltip', 'title'=>'Delete Film!', 'aria-hidden'=>'true']) !!}
                                {!! Form::close() !!}
                            </td>
                        @endif
                    </tr>
                @endforeach
            </tbody>
    </table>
    <div class="d-flex justify-content-center">
        {{ $films->links() }}
    </div>
@endsection

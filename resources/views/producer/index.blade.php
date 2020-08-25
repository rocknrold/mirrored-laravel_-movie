@extends('layouts.app')

@section('content')
    @if (Session::has('success'))
        <div class="alert alert-success" role="alert">
            <h4 class="alert-heading"></h4>
            <p>{{ Session::get('success') }}</p>
            <p class="mb-0"></p>
        </div>
    @endif


    <a href="{{ route('producer.create') }}" class="btn btn-primary m-3">
        <span class="m-3"> Add producer</span><i class="fa fa-plus" aria-hidden="true"></i>
    </a>

    <table class="table table-striped table-inverse table-responsive">
        <thead class="thead-inverse">
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Website</th>
            </tr>
            </thead>
            <tbody>
                @foreach ($producers as $producer)
                    <tr>
                        <td><a href="{{ route('producer.show',$producer->id) }}">{{ $producer->name }}</a></td>
                        <td>{{ $producer->email }}</td>
                        <td>{{ $producer->website }}</td>
                        <td><a href="{{ route('producer.edit', $producer->id) }}" class="btn btn-warning"><i class="fa fa-edit"></i></a></td>
                        <td>
                            {{-- <form action="{{ route('producer.destroy',$producer->id) }}" method="POST"> --}}
                                {!! Form::model($producer, ['route' => ['producer.destroy', $producer->id], 'method'=>'POST']) !!}
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
        {{ $producers->links() }}
    </div>
@endsection

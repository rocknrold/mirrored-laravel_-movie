@extends('layouts.app')

@section('content')
    @if (Session::has('success'))
        <div class="alert alert-success" role="alert">
            <h4 class="alert-heading"></h4>
            <p>{{ Session::get('success') }}</p>
            <p class="mb-0"></p>
        </div>
    @endif


    <a href="{{ route('actor.create') }}" class="btn btn-primary m-3">
        <span class="m-3"> Add Actor</span><i class="fa fa-plus" aria-hidden="true"></i>
    </a>

    <table class="table table-striped table-inverse table-responsive">
        <thead class="thead-inverse">
            <tr>
                <th></th>
                <th>Name</th>
                <th>Note</th>
                <th>Edit</th>
                <th>Delete</th>
            </tr>
            </thead>
            <tbody>
                @foreach ($actors as $actor)
                    <tr>
                        <td class="w-25">
                            @if (count($actor->getMedia('actors')) == 0)
                                <img src="{{asset('logo-01.jpg')}}" class="card-img-top" alt="...">
                            @else
                                <img src="{{$actor->getMedia('actors')[0]->getUrl('icon')}}" class="card-img-top" alt="...">
                            @endif
                        </td>
                        <td><a href="{{ route('actor.show',$actor->id) }}">{{ $actor->name }}</a></td>
                        <td>{{ $actor->note }}</td>
                        <td><a href="{{ route('actor.edit', $actor->id) }}" class="btn btn-warning"><i class="fa fa-edit"></i></a></td>
                        <td>
                            {{-- <form action="{{ route('actor.destroy',$actor->id) }}" method="POST"> --}}
                                {!! Form::model($actor, ['route' => ['actor.destroy', $actor->id], 'method'=>'POST']) !!}
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
        {{ $actors->links() }}
    </div>
@endsection

@extends('layouts.app')

@section('content')
@if (session('success'))
<div class="alert alert-info" role="alert">
    <h4 class="alert-heading"></h4>
    <p>{{ session('success') }}</p>
    <p class="mb-0"></p>
</div>
@endif


<a href="{{ route('role.create') }}" class="btn btn-primary m-3">
    <span class="m-3"> Add Role</span><i class="fa fa-plus" aria-hidden="true"></i>
</a>

    <table class="table table-striped table-inverse table-responsive">
        <thead class="thead-inverse">
            <tr>
                <th>ID</th>
                <th>Name</th>
            </tr>
            </thead>
            <tbody>
                @foreach ($roles as $role)
                    <tr>
                        <td>{{$role->id}}</td>
                        <td><a href="{{ route('role.show',$role->id) }}">{{ $role->name }}</a></td>
                        <td>{{ $role->note }}</td>
                        <td><a href="{{ route('role.edit', $role->id) }}" class="btn btn-warning"><i class="fa fa-edit"></i></a></td>
                        <td>
                            {!! Form::open(['route' => ['role.destroy', $role->id], 'method'=>'POST']) !!}
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
    {{ $roles->links() }}
</div>
@endsection

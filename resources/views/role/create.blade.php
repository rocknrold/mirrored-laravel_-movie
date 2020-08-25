@extends('layouts.app')

@section('content')

    <div class="container">
        <h1>Create role</h1>
        {!! Form::open(['route' => 'role.store', 'method' => 'POST' , 'files'=>true]) !!}
        @csrf

        <div class="form-group">
            {!! Form::label('name', 'Name', ['class'=>'control-label']) !!}
                {!! Form::text('name', old('name'),
                    ['class'=>'form-control '.(old('name')? ($errors->has('name')? 'is-invalid':'is-valid'):''),'id'=>'name','required'=>'true']) !!}
                @error('name')
                    <div class="invalid-feedback">
                        {{$message}}
                    </div>
                @enderror
        </div>

            {{ Form::submit('Submit',['class' => 'btn btn-success']) }}
        {!! Form::close() !!}
    </div>
@endsection

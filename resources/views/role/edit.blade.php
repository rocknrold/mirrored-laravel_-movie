@extends('layouts.app')

@section('content')

    <div class="container">
        <h1>Edit Role</h1>
        {!! Form::model($role, ['route'=>['role.update',$role->id], 'files'=>true]) !!}
        @csrf
        @method('PUT')

        <div class="form-group">
            {!! Form::label('name', 'Name', ['class'=>'control-label']) !!}
                {!! Form::text('name', null ,
                    ['class'=>'form-control '.($errors->has('name')? 'is-invalid':''),'id'=>'name','required'=>'true']) !!}
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

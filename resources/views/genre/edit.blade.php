@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Edit Genre</h1>
        {!! Form::model($genre, ['route'=>['genre.update',$genre->id]]) !!}
            @csrf
            @method('PATCH')

            <div class="form-group">
                {!! Form::label('name', 'Title', ['class'=>'control-label']) !!}
                {!! Form::text('name', null, ['class'=>'form-control '.($errors->has('name')? 'is-invalid':''),'id'=>'name']) !!}
                @error('name')
                    <div class="invalid-feedback">
                        {{$message}}
                    </div>
                @enderror
            </div>

            {!! Form::submit('Submit', ['class'=>'btn btn-success']) !!}
        {!! Form::close() !!}
    </div>
@endsection

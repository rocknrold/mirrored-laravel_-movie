@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Create Film</h1>
        {!! Form::model($film, ['route'=>['film.update',$film->id]]) !!}
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

            <div class="form-group">
                {!! Form::label('story', 'Story', ['class'=>'control-label']) !!}
                {!! Form::textarea('story', null, ['class'=>'form-control '.($errors->has('story')? 'is-invalid':''),'id'=>'story']) !!}
                @error('story')
                    <div class="invalid-feedback">
                        {{$message}}
                    </div>
                @enderror
            </div>

            <div class="form-group">
                {!! Form::label('released_at', 'Release Date', ['class'=>'control-label']) !!}
                {!! Form::datetimeLocal('released_at', null, ['class'=>'form-control '.($errors->has('released_at')? 'is-invalid':''),'id'=>'released_at']) !!}
                @error('released_at')
                    <div class="invalid-feedback">
                        {{$message}}
                    </div>
                @enderror
            </div>

            <div class="form-group">
                {!! Form::label('duration', 'Duration (minutes)', ['class'=>'control-label']) !!}
                {!! Form::number('duration', null, ['class'=>'form-control '.($errors->has('duration')? 'is-invalid':''),'id'=>'duration']) !!}
                @error('duration')
                    <div class="invalid-feedback">
                        {{$message}}
                    </div>
                @enderror
            </div>

            <div class="form-group">
                {!! Form::label('info', 'Additional Information', ['class'=>'control-label']) !!}
                {!! Form::text('info', null, ['class'=>'form-control '.($errors->has('info')? 'is-invalid':''),'id'=>'info']) !!}
                @error('info')
                    <div class="invalid-feedback">
                        {{$message}}
                    </div>
                @enderror
            </div>

            <div class="form-group">
                {!! Form::label('genre', 'Title', ['class'=>'control-label']) !!}
                {!! Form::select('genre', $genres, null, ['class'=>'form-control '.($errors->has('genre')? 'is-invalid':'')]) !!}
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

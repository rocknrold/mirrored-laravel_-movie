@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Create Film</h1>

        {!! Form::open(['route'=>'film.store', 'method'=>'POST']) !!}
            @csrf

            <div class="form-group">
                {!! Form::label('name', 'Title', ['class'=>'control-label']) !!}
                {!! Form::text('name', old('name'),
                    ['class'=>'form-control '.(old('name')? ($errors->has('name')? 'is-invalid':'is-valid'):''),'id'=>'name']) !!}
                @error('name')
                    <div class="invalid-feedback">
                        {{$message}}
                    </div>
                @enderror
            </div>

            <div class="form-group">
                {!! Form::label('story', 'Story', ['class'=>'control-label']) !!}
                {!! Form::textarea('story', old('story'),
                    ['class'=>'form-control '.(old('story')? ($errors->has('story')? 'is-invalid':'is-valid'):''),'id'=>'story']) !!}
                @error('story')
                    <div class="">
                        {{$message}}
                    </div>
                @enderror
            </div>

            <div class="form-group">
                {!! Form::label('released_at', 'Release Date', ['class'=>'control-label']) !!}
                {!! Form::datetimeLocal('released_at', old('released_at'),
                    ['class'=>'form-control '.(old('released_at')? ($errors->has('released_at')? 'is-invalid':'is-valid'):''),'id'=>'released_at']) !!}
                @error('released_at')
                    <div class="invalid-feedback">
                        {{$message}}
                    </div>
                @enderror
            </div>

            <div class="form-group">
                {!! Form::label('duration', 'Duration (minutes)', ['class'=>'control-label']) !!}
                {!! Form::number('duration', old('duration'),
                    ['class'=>'form-control '.(old('name')? ($errors->has('duration')? 'is-invalid':'is-valid'):''),'id'=>'duration']) !!}
                @error('duration')
                    <div class="invalid-feedback">
                        {{$message}}
                    </div>
                @enderror
            </div>

            <div class="form-group">
                {!! Form::label('info', 'Additional Information', ['class'=>'control-label']) !!}
                {!! Form::text('info', old('info'),
                    ['class'=>'form-control '.(old('name')? ($errors->has('info')? 'is-invalid':'is-valid'):''),'id'=>'info']) !!}
                @error('info')
                    <div class="invalid-feedback">
                        {{$message}}
                    </div>
                @enderror
            </div>

            <div class="form-group">
                {!! Form::label('genre', 'Title', ['class'=>'control-label']) !!}
                {!! Form::select('genre', $genres, null,
                    ['class'=>'form-control '.(old('name')? ($errors->has('genre')? 'is-invalid':'is-valid'):''), 'placeholder'=>'---Select Genre---']) !!}
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

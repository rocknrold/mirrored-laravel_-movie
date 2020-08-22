@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Create Film</h1>

        {!! Form::open(['route'=>'film.store', 'method'=>'POST', 'files'=>true]) !!}
            @csrf

            <div class="form-group">
                {!! Form::label('name', 'Title', ['class'=>'control-label']) !!}
                {!! Form::text('name', old('name'),
                    ['class'=>'form-control '.(old('name')? ($errors->has('name')? 'is-invalid':'is-valid'):''),'id'=>'name','required'=>'required']) !!}
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
                    <div class="invalid-feedback">
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
                    ['class'=>'form-control '.(old('duration')? ($errors->has('duration')? 'is-invalid':'is-valid'):''),'id'=>'duration']) !!}
                @error('duration')
                    <div class="invalid-feedback">
                        {{$message}}
                    </div>
                @enderror
            </div>

            <div class="form-group">
                {!! Form::label('info', 'Additional Information', ['class'=>'control-label']) !!}
                {!! Form::text('info', old('info'),
                    ['class'=>'form-control '.(old('info')? ($errors->has('info')? 'is-invalid':'is-valid'):''),'id'=>'info']) !!}
                @error('info')
                    <div class="invalid-feedback">
                        {{$message}}
                    </div>
                @enderror
            </div>

            <div class="form-group">
                {!! Form::label('genre_id', 'Genre', ['class'=>'control-label']) !!}
                {!! Form::select('genre_id', $genres, null,
                    ['class'=>'form-control '.(old('genre_id')? ($errors->has('genre_id')? 'is-invalid':'is-valid'):''), 'placeholder'=>'---Select Genre---']) !!}
                @error('genre_id')
                    <div class="invalid-feedback">
                        {{$message}}
                    </div>
                @enderror
            </div>

            <div class="form-group">
                {!! Form::label('certificate_id', 'Certificate', ['class'=>'control-label']) !!}
                {!! Form::select('certificate_id', $certificates, null,
                    ['class'=>'form-control '.(old('certificate_id')? ($errors->has('certificate_id')? 'is-invalid':'is-valid'):''), 'placeholder'=>'---Select Certificate---']) !!}
                @error('certificate_id')
                    <div class="invalid-feedback">
                        {{$message}}
                    </div>
                @enderror
            </div>

            <div class="form-group">
                <div class="custom-file">
                    {!! Form::label('media', 'Photo', ['class'=>'custom-file-label']) !!}
                    {!! Form::file('media',
                        ['class'=>'custom-file-input '.(old('media')? ($errors->has('media')? 'is-invalid':'is-valid'):''), 'placeholder'=>'Photo']) !!}

                </div>
                @error('media')
                    <div class="invalid-feedback">
                        {{$message}}
                    </div>
                @enderror
            </div>

            {!! Form::submit('Submit', ['class'=>'btn btn-success']) !!}
        {!! Form::close() !!}
    </div>
@endsection

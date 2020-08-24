@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Create Film</h1>

    {!! Form::open(['route'=>'film.store', 'method'=>'POST', 'files'=>true]) !!}
    @csrf

    <div class="form-group">
        @php
        if (old('name') || ($errors->has('name')))
        {
            $isValid = 'is-valid';
            if ($errors->has('name')){
                $isValid = 'is-invalid';
            }
        } else $isValid = '';
        @endphp

        {!! Form::label('name', 'Title', ['class'=>'control-label']) !!}
        {!! Form::text('name', old('name'),['class'=>'form-control '.$isValid,'id'=>'name']) !!}
        @error('name')
        <div class="invalid-feedback">
            {{$message}}
        </div>
        @enderror
    </div>

    <div class="form-group">
        @php
        if (old('story') || ($errors->has('story')))
        {
            $isValid = 'is-valid';
            if ($errors->has('story')){
                $isValid = 'is-invalid';
            }
        } else $isValid = '';
        @endphp
        {!! Form::label('story', 'Story', ['class'=>'control-label']) !!}
        {!! Form::textarea('story', old('story'),
        ['class'=>'form-control '.$isValid,'id'=>'story']) !!}
        @error('story')
        <div class="invalid-feedback">
            {{$message}}
        </div>
        @enderror
    </div>

    <div class="form-group">
        @php
        if (old('released_at') || ($errors->has('released_at')))
        {
            $isValid = 'is-valid';
            if ($errors->has('released_at')){
                $isValid = 'is-invalid';
            }
        } else $isValid = '';
        @endphp
        {!! Form::label('released_at', 'Release Date', ['class'=>'control-label']) !!}
        {!! Form::datetimeLocal('released_at', old('released_at'),
        ['class'=>'form-control '.$isValid,'id'=>'released_at']) !!}
        @error('released_at')
        <div class="invalid-feedback">
            {{$message}}
        </div>
        @enderror
    </div>

    <div class="form-group">
        @php
        if (old('duration') || ($errors->has('duration')))
        {
            $isValid = 'is-valid';
            if ($errors->has('duration')){
                $isValid = 'is-invalid';
            }
        } else $isValid = '';
        @endphp
        {!! Form::label('duration', 'Duration (minutes)', ['class'=>'control-label']) !!}
        {!! Form::number('duration', old('duration'),
        ['class'=>'form-control '.$isValid,'id'=>'duration']) !!}
        @error('duration')
        <div class="invalid-feedback">
            {{$message}}
        </div>
        @enderror
    </div>

    <div class="form-group">
        @php
        if (old('info') || ($errors->has('info')))
        {
            $isValid = 'is-valid';
            if ($errors->has('info')){
                $isValid = 'is-invalid';
            }
        } else $isValid = '';
        @endphp
        {!! Form::label('info', 'Additional Information', ['class'=>'control-label']) !!}
        {!! Form::text('info', old('info'),
        ['class'=>'form-control '.$isValid,'id'=>'info']) !!}
        @error('info')
        <div class="invalid-feedback">
            {{$message}}
        </div>
        @enderror
    </div>

    <div class="form-group">
        @php
        if (old('genre_id') || ($errors->has('genre_id')))
        {
            $isValid = 'is-valid';
            if ($errors->has('genre_id')){
                $isValid = 'is-invalid';
            }
        } else $isValid = '';
        @endphp
        {!! Form::label('genre_id', 'Genre', ['class'=>'control-label']) !!}
        {!! Form::select('genre_id', $genres, null,
        ['class'=>'form-control '.$isValid, 'placeholder'=>'---Select Genre---']) !!}
        @error('genre_id')
        <div class="invalid-feedback">
            {{$message}}
        </div>
        @enderror
    </div>

    <div class="form-group">
        @php
        if (old('certificate_id') || ($errors->has('certificate_id')))
        {
            $isValid = 'is-valid';
            if ($errors->has('certificate_id')){
                $isValid = 'is-invalid';
            }
        } else $isValid = '';
        @endphp
        {!! Form::select('certificate_id', $certificates, null,
        ['class'=>'custom-select '.$isValid, 'placeholder'=>'---Select Certificate---']) !!}
        @error('certificate_id')
        <div class="invalid-feedback">
            {{$message}}
        </div>
        @enderror
    </div>

    <div class="form-group">
        <div class="custom-file">
            @php
            if (old('media') || ($errors->has('media')))
            {
                $isValid = 'is-valid';
                if ($errors->has('media')){
                    $isValid = 'is-invalid';
                }
            } else $isValid = '';
            @endphp
            {!! Form::file('media',
            ['class'=>'custom-file-input '.$isValid]) !!}
            {!! Form::label('media', 'Photo', ['class'=>'custom-file-label']) !!}

            @error('media')
            <div class="invalid-feedback">
                {{$message}}
            </div>
            @enderror
        </div>
    </div>

    {!! Form::submit('Submit', ['class'=>'btn btn-success form-control']) !!}
    {!! Form::close() !!}
</div>
@endsection

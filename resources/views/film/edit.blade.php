@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row ">
            <div class="col-8">
                <h1>Edit Film</h1>
            </div>
            <div class="col-4">
                @if ($film->filmUrl == null)
                    <img src="{{asset('logo-01.jpg')}}" class="card-img-top" alt="...">
                @else
                    <img src="{{$film->filmUrl}}" class="card-img-top" alt="..." >
                @endif
            </div>

        </div>
        {!! Form::model($film, ['route'=>['film.update',$film->id], 'files'=>true]) !!}
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
                {!! Form::label('genre_id', 'Genre', ['class'=>'control-label']) !!}
                {!! Form::select('genre_id', $genres, null,
                    ['class'=>'form-control '.($errors->has('genre_id')? 'is-invalid':'')]) !!}
                @error('genre_id')
                    <div class="invalid-feedback">
                        {{$message}}
                    </div>
                @enderror
            </div>

            <div class="form-group">
                {!! Form::label('certificate_id', 'Certificate', ['class'=>'control-label']) !!}
                {!! Form::select('certificate_id', $genres, null,
                    ['class'=>'form-control '.($errors->has('certificate_id')? 'is-invalid':'')]) !!}
                @error('certificate_id')
                    <div class="invalid-feedback">
                        {{$message}}
                    </div>
                @enderror
            </div>

            <div class="form-group">
                <div class="custom-file">
                    {!! Form::file('media',
                    ['class'=>'custom-file-input '.($errors->has('media')? 'is-invalid':'')]) !!}
                    {!! Form::label('media', 'Photo', ['class'=>'custom-file-label']) !!}

                    @error('media')
                    <div class="invalid-feedback">
                        {{$message}}
                    </div>
                    @enderror
                </div>
            </div>

            {!! Form::submit('Submit', ['class'=>'btn btn-success']) !!}
        {!! Form::close() !!}
    </div>
@endsection

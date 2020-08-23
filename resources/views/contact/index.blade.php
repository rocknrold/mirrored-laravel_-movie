@extends('layouts.app')

@section('content')
    <div class="container">
        @if (session('success'))
            <div class="alert alert-success" role="alert">
                <h4 class="alert-heading"></h4>
                <p>{{ session('success') }}</p>
                <p class="mb-0"></p>
            </div>
        @endif

        {!! Form::open(['routes'=>'contact.store', 'method'=>'POST']) !!}
        @csrf
        {!! Form::hidden('email',Auth::user()->email, []) !!}
            <div class="form-group">
                {!! Form::label('to', 'To', ['class'=>'control-label']) !!}
                {!! Form::text('to', 'Admin', ['class'=>'form-control','disabled'=>'disabled']) !!}
            </div>

            <div class="form-group">
                {!! Form::label('subject', 'Subject', ['class'=>'control-label']) !!}
                {!! Form::text('subject', old('subject'),
                    ['class'=>'form-control '.(old('subject')? ($errors->has('subject')? 'is-invalid':'is-valid'):''),
                    'required'=>'required']) !!}

                @error('subject')
                <div class="invalid-feedback">
                    {{$message}}
                </div>
            @enderror
            </div>

            <div class="form-group">
                {!! Form::label('message', 'Message', ['class'=>'control-label']) !!}
                {!! Form::textarea('message', old('message'),
                    ['class'=>'form-control '.(old('message')? ($errors->has('message')? 'is-invalid':'is-valid'):''),
                    'required'=>'required']) !!}

                @error('subject')
                    <div class="invalid-feedback">
                        {{$message}}
                    </div>
                @enderror
            </div>

                {!! Form::submit('Send', ['class'=>'btn btn-success btn-lg']) !!}
        {!! Form::close() !!}
    </div>
@endsection

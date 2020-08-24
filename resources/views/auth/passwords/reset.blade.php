@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Reset Password') }}</div>

                <div class="card-body">
                    {!! Form::open(['route'=>'password.update','method'=>'POST']) !!}
                        @csrf

                        <input type="hidden" name="token" value="{{ $token }}">

                        <div class="form-group row">
                            {!! Form::label('email', 'E-mail Address', ['class' => 'col-md-4 col-form-label text-md-right']) !!}
                            <div class="col-md-6">
                                {!! Form::email('email', old('email'), ['class'=>'form-control', 'required'=>'required', 'autocomplete'=>'email', 'autofocus'=>'autofocus']) !!}

                                @error('email')
                                    <span class="alert-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            {!! Form::label('password', 'New Password', ['class'=>'col-md-4 col-form-label text-md-right']) !!}
                            <div class="col-md-6">
                                {!! Form::password('password',
                                    ['class' => 'form-control','id'=>'password', 'required'=>'required', 'autocomplete'=>'new-password']) !!}

                                @error('password')
                                    <span class="alert-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            {!! Form::label('password-confirm', 'Confirm Password', ['class'=>'col-md-4 col-form-label text-md-right']) !!}
                            <div class="col-md-6">
                                {!! Form::password('password_confirmation',
                                    ['class' => 'form-control','id'=>'password-confirm', 'required'=>'required', 'autocomplete'=>'current-password']) !!}
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                {!! Form::submit('Reset Password', ['class' => 'btn btn-primary']) !!}
                            </div>
                        </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

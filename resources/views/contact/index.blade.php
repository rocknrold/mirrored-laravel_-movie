@extends('layouts.app')

@section('content')
    <div class="container">
        @if (!isset($adminEmail))
            <div class="alert alert-danger" role="alert">
                <h4 class="alert-heading"></h4>
                <p>No registered email of Admin yet. Please stand by...</p>
                <p class="mb-0"></p>
            </div>
        @else
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
                @if (Auth::user()->is_admin)
                    {!! Form::email('to', old('to'), ['class'=>'form-control '.(old('to')? ($errors->has('to')? 'is-invalid':'is-valid'):'')]) !!}
                @else
                    {!! Form::email('to', $adminEmail, ['class'=>'form-control'.(old('to')? ($errors->has('to')? 'is-invalid':'is-valid'):'')]) !!}
                @endif

                @error('to')
                    <div class="invalid-feedback">
                        {{$message}}
                    </div>
                @enderror
            </div>

                    @error('to')
                        <div class="invalid-feedback">
                            {{$message}}
                        </div>
                    @enderror
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

        @endif
    </div>
@endsection

@extends('layouts.app')

@section('content')
    
    <div class="container">
        <h1>Create actor</h1>
        {!! Form::open(['route' => 'actor.store', 'method' => 'POST']) !!}
        @csrf

        <div class="form-group">
            {!! Form::label('name', 'Name', ['class'=>'control-label']) !!}
                {!! Form::text('name', old('name'),
                    ['class'=>'form-control '.(old('name')? ($errors->has('name')? 'is-invalid':'is-valid'):''),'id'=>'name','required'=>'true']) !!}
                @error('name')
                    <div class="invalid-feedback">
                        {{$message}}
                    </div>
                @enderror
        </div>

        <div class="form-group">
            {!! Form::label('note', 'Note', ['class'=>'control-label']) !!}
                {!! Form::textarea('note', old('note'),
                    ['class'=>'form-control '.(old('note')? ($errors->has('name')? 'is-invalid':'is-valid'):''),'id'=>'note','required'=>'true']) !!}
                @error('note')
                    <div class="invalid-feedback">
                        {{$message}}
                    </div>
                @enderror
        </div>
            
            {{ Form::submit('Submit',['class' => 'btn btn-success']) }}
        {!! Form::close() !!}
    </div>
@endsection

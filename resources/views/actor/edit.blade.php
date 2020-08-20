@extends('layouts.app')

@section('content')
    
    <div class="container">
        <h1>Edit actor</h1>
        {!! Form::model($actor, ['route'=>['actor.update',$actor->id]]) !!}
            @csrf
            @method('PUT')
            
        <div class="form-group">
            {!! Form::label('name', 'Name', ['class'=>'control-label']) !!}
                {!! Form::text('name', null ,
                    ['class'=>'form-control '.($errors->has('name')? 'is-invalid':''),'id'=>'name','required'=>'true']) !!}
                @error('name')
                    <div class="invalid-feedback">
                        {{$message}}
                    </div>
                @enderror
        </div>

        <div class="form-group">
            {!! Form::label('note', 'Note', ['class'=>'control-label']) !!}
                {!! Form::textarea('note', null ,
                    ['class'=>'form-control '.($errors->has('name')? 'is-invalid':''),'id'=>'note','required'=>'true']) !!}
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

@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row ">
            <div class="col-8">
                <h1>Edit Actor</h1>
            </div>
            <div class="col-4">
                @if ($actor->photo == null)
                    <img src="{{asset('logo-01.jpg')}}" class="card-img-top" alt="...">
                @else
                    <img src="{{$actor->actorUrlCard}}" class="card-img-top" alt="..." >
                @endif
            </div>

        </div>
        {!! Form::model($actor, ['route'=>['actor.update',$actor->id], 'files'=>true]) !!}
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

            {{ Form::submit('Submit',['class' => 'btn btn-success']) }}
        {!! Form::close() !!}
    </div>
@endsection

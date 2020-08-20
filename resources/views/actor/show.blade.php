@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>{{$actor->name}}</h1>
        <p>{{$actor->note}}</p>
    </div>
@endsection
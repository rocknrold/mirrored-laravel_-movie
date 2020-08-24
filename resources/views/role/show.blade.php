@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>{{$role->name}}</h1>
        <p>{{$role->note}}</p>
    </div>
@endsection

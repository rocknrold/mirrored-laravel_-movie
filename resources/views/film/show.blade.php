@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>{{$film->name}}</h1>
        <p>{{$film->story}}</p>
        <p>{{$film->released_at}}</p>
       @include('rating.index')
    </div>
@endsection

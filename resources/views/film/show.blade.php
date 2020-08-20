@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>{{$film->name}}</h1>
        <p>{{$film->story}}</p>
        <p>{{$film->released_at}}</p>

        <h4>Comments</h4>
        <div class="row card">
            @include('rating.index')
        </div>
    </div>
@endsection

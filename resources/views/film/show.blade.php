@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col">
                <h1>{{$film->name}}</h1>
                <p>{{$film->story}}</p>
                <p>{{$film->released_at}}</p>
            </div>
            <div class="col-sm-1-12 text-info">
                <h1><span class="display-4">{{$rating}}</span>/10</h1>
            </div>
        </div>

        <h4>Comments</h4>
        <div class="row card">
            @include('rating.index')
        </div>
    </div>
@endsection

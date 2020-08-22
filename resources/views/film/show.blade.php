@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="card mb-3 mx-auto">
            <img src="{{$media}}" class="card-img-top" alt="...">
            <div class="card-body">
                <div class="d-flex">
                    <div class="col">
                        <h1 class="card-title">{{$film->name}}</h1>
                        <p class="card-text">{{$film->story}}</p>
                        <p class="card-text"><small class="text-muted">{{$film->released_at}}</small></p>
                    </div>
                    <div class="col-sm-1-12 text-info">
                        <h1><span class="display-4">{{$rating}}</span>/10</h1>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <h4>Comments</h4>
    <div class="row card">
        @include('rating.index')
    </div>
</div>
@endsection

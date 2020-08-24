@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row row-cols-sm-1 row-cols-md-2 justify-content-center p-3">
        <div class="col-md-5 p-3  align-content-start">
            <div class="container border border-info rounded-lg p-3">
                <h1>Films</h1>
                @include('dashboard.film')
            </div>
        </div>
        <div class="col-md-1-12 p-3">
            <div class="container border border-info rounded-lg ">
                <h1>Actors</h1>
                @include('dashboard.actor')
            </div>
            <div class="row">
                <div class="col-4">
                    <h3>Producer</h3>
                    @include('dashboard.producer')
                </div>
                <div class="col-4">
                    <h3>Genre</h3>
                </div>
                <div class="col-4">
                    <h3>Roles</h3>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

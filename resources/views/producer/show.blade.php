@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>{{$producer->name}}</h1>
        <p>{{$producer->email}}</p>
    	<p>{{$producer->website}}</p>
        <table>
            <thead>
                <tr>Films</tr>
            </thead>
            <tbody>
            @foreach($producer_films as $producer_film)
                    <tr><td><i>{{ $producer_film->film->name }}</i></td></tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
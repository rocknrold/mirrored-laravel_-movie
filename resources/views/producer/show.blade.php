@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>{{$producer->name}}</h1>
        <p>{{$producer->email}}</p>
    	<p>{{$producer->website}}</p>
    	<table>
    		<thead>
    			<td>Films</td>
    		</thead>
    		<tbody>
    			@foreach($producer_films as $film)
    				<td></td>
    			@endforeach
    		</tbody>
    	</table>
    </div>
@endsection
@extends('layouts.app')

@section('content')
@if (session('success'))
<div class="alert alert-info" role="alert">
    <h4 class="alert-heading"></h4>
    <p>{{ session('success') }}</p>
    <p class="mb-0"></p>
</div>
@endif


<a href="{{ route('film.create') }}" class="btn btn-primary m-3">
    <span class="m-3"> Add Film</span><i class="fa fa-plus" aria-hidden="true"></i>
</a>

<div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 p-5">
    @foreach ($films as $film)
    <div class="col p-5 text-success">
        <div class="card h-100">
            <a href="{{ route('film.show',$film->id) }}">
                @if (count($film->getMedia('movies')) == 0)
                    <img src="{{asset('logo-01.jpg')}}" class="card-img-top" alt="...">
                @else
                    <img src="{{$film->getMedia('movies')[0]->getUrl('thumb')}}" class="card-img-top" alt="...">
                @endif
            </a>
            <div class="card-body text-info">
                <h5 class="card-title"><a href="{{ route('film.show',$film->id) }}">{{ $film->name }}</a></h5>
                <p class="card-text text-justify text-truncate">{{ $film->story }}</p>
            </div>
            <div class="card-footer d-flex">
                <div class="">
                    {{\Carbon\Carbon::createFromTimeStamp(strtotime(($film->released_at)))->diffForHumans()}}
                </div>
                <div class="ml-auto d-flex">
                    <div>
                        <a href="{{ route('film.edit', $film->id) }}" class="btn btn-outline-warning btn-sm"><i class="fa fa-edit"></i></a>
                    </div>
                    {!! Form::open(['route'=>['film.destroy',$film->id], 'method'=>'POST']) !!}
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-outline-danger btn-sm">
                        <i class="fa fa-trash" aria-hidden="true"></i>
                    </button>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
    @endforeach
</div>
<div class="d-flex justify-content-center">
    {{ $films->links() }}
</div>
@endsection

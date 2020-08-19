@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Create Film</h1>
        <form action="{{route('film.update',$film->id)}}" method="POST">
            @csrf
            @method('PUT')
              <div class="form-group">
                <label for="name">Title</label>
                <input
                type="text"
                name="name" id="name"
                class="form-control @error('title') is-invalid @enderror"
                value="{{ $film->name }}">

                @error('name')
                    <div class="invalid-feedback">
                        {{$message}}
                    </div>
                @enderror
            </div>
              <div class="form-group">
                <label for="story">Story</label>
                <textarea
                type="text"
                name="story" id="story"
                class="form-control @error('story') is-invalid @enderror"
                cols="30" rows="10">{{ $film->story }}</textarea>

                @error('story')
                    <div class="invalid-feedback">
                        {{$message}}
                    </div>
                @enderror
            </div>

              <div class="form-group">
                <label for="released_at">Release Date</label>
                <input
                type="datetime-local"
                name="released_at" id="released_at"
                class="form-control @error('released_at') is-invalid @enderror"
                value="{{ date('Y-m-d\TH:i:s',strtotime($film->released_at)) }}">

                @error('released_at')
                    <div class="invalid-feedback">
                        {{$message}}
                    </div>
                @enderror
            </div>

              <div class="form-group">
                <label for="duration">Duration</label>
                <input
                type="number"
                name="duration" id="duration"
                class="form-control @error('duration') is-invalid @enderror"
                value="{{ $film->duration }}">

                @error('duration')
                    <div class="invalid-feedback">
                        {{$message}}
                    </div>
                @enderror
            </div>

              <div class="form-group">
                <label for="info">Additional Information</label>
                <input
                type="text"
                name="info" id="info"
                class="form-control @error('info') is-invalid @enderror"
                value="{{ $film->info }}">

                @error('info')
                    <div class="invalid-feedback">
                        {{$message}}
                    </div>
                @enderror
            </div>

                <button type="submit" class="btn btn-success">Submit</button>
        </form>
    </div>
@endsection

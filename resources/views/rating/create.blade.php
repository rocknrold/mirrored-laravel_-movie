<div class="container py-3">
    {!! Form::open(['route'=>'filmUser', 'method'=>'POST']) !!}
        @csrf
        <div class="form-group">
            {!! Form::hidden('film_id', $film->id) !!}
            {!! Form::textarea('comment', old('comment'), ['class'=>'form-control']) !!}
            {!! Form::submit('Comment', ['class'=>'btn btn-success']) !!}
        </div>

    {!! Form::close() !!}
</div>

<div class="container py-3">
    {!! Form::open(['route'=>'filmUser.store', 'method'=>'POST']) !!}
        @csrf
        <div class="form-group">
            {!! Form::hidden('film_id', $film->id) !!}

            <div class="form-group row">
                {!! Form::label('rating', 'Rating (0-10)', ['class'=>'col-sm-2 col-form-label']) !!}
                <div class="col-sm-10">
                    {!! Form::number('rating', old('rating'),
                     ['step'=>0.01, 'class'=>'form-control']) !!}
                </div>
            </div>

            {!! Form::textarea('comment', old('comment'), ['class'=>'form-control']) !!}

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            {!! Form::submit('Comment', ['class'=>'mt-2 form-control btn btn-success']) !!}
        </div>

    {!! Form::close() !!}
</div>

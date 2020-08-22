<div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
            <div class="modal-header">
                    <h5 class="modal-title">Edit Comment and Rating</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                </div>
        <div class="modal-body">
            <div class="container-fluid">
                {!! Form::open(['route'=>['filmUser.update',$film->id], 'method'=>'POST']) !!}
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        {!! Form::hidden('film_id', $film->id) !!}

                        <div class="form-group row">
                            {!! Form::label('rating', 'Rating (0-10)', ['class'=>'col-sm-2 col-form-label']) !!}
                            <div class="col-sm-10">
                                {!! Form::number('rating', $comment->rating,
                                ['min'=>0,'max'=>10, 'step'=>0.01, 'class'=>'form-control','required'=>'required']) !!}
                            </div>
                        </div>
                        {!! Form::textarea('comment', $comment->comment, ['class'=>'form-control','minlength'=>3,'required'=>'required']) !!}

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
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
        </div>
    </div>
</div>

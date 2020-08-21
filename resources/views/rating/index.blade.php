@if (Session::has('success'))
    <div class="alert alert-success" role="alert">
        {{ Session::get('success') }}
    </div>
@endif
<div class="container ">

    @forelse ($comments as $comment)
        @if (Auth::user()->id == $comment->user->id)
            @php
                $hasComment = true
            @endphp
        @endif

        <div class="row border-bottom border-gray">
            <div class="col">
                <strong class="m-1 {{$hasComment ? 'text-primary':''}}">{{$comment->user->name}}</strong>
                <small>{{ (($comment->updated_at)->diff($now)->days) < 1 ? 'today':($comment->updated_at)->diffForHumans($now) }}</small>
                <p>{{$comment->comment}}</p>
            </div>

            <div class="col-sm-1-12 d-flex p-3">
                <h3 class="text-info">{{$comment->rating}}</h3>
            </div>

            @if ($hasComment)
                <div class="col-xs-1-12">
                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modelId">
                      <i class="fa fa-pencil" aria-hidden="true"></i>
                    </button>
                    {!! Form::open(['route'=>['filmUser.destroy',$film->id],'method'=>'POST']) !!}
                        @csrf
                        @method('DELETE')
                        {!! Form::button('<i class="fa fa-trash" aria-hidden="true"></i>', ['type'=>'submit','class'=>'btn btn-danger btn-sm']) !!}
                    {!! Form::close() !!}
                </div>
            @endif
        </div>

        @empty
            <p>No comments yet...</p>
    @endforelse
</div>

@if (!$hasComment)
    @include('rating.create')
@endif


<!-- Modal -->
<div class="modal fade" id="modelId" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    @if ($hasComment)
        @include('rating.edit')
    @endif
</div>

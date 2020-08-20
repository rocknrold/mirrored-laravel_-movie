<div class="container border-bottom border-info">
    @foreach ($comments as $comment)
        <div class="">
            <strong class="m-1">{{$comment->user->name}}</strong>
            <small>{{$comment->updated_at}}</small>
            <p>{{$comment->comment}}</p>
        </div>
    @endforeach
</div>

@include('rating.create')

<a href="{{ route('genre.create') }}" class="btn btn-secondary btn-sm">
    <i class="fa fa-plus" aria-hidden="true"></i>
</a>

<table class="table table-hover table-inverse table-responsive">
    <thead class="thead-inverse">
        <tr>
            <th>Title</th>
            <th>Edit</th>
            <th>Delete</th>
        </tr>
        </thead>
        <tbody>
            @foreach ($genres as $genre)
                <tr>
                    <td><a href="{{ route('genre.show',$genre->id) }}">{{ $genre->name }}</a></td>
                    <td><a href="{{ route('genre.edit', $genre->id) }}" class="btn btn-warning btn-sm"><i class="fa fa-edit"></i></a></td>
                    <td>
                        {!! Form::open(['route'=>['genre.destroy',$genre->id], 'method'=>'POST']) !!}
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">
                                <i class="fa fa-trash" aria-hidden="true"></i>
                            </button>
                        {!! Form::close() !!}
                    </td>
                </tr>
            @endforeach
        </tbody>
</table>
<div class="d-flex justify-content-center">
    {{ $genres->links() }}
</div>

<table class="table table-hover table-inverse table-responsive bg-light overflow-auto" style="max-height: 400px">
    <thead class="thead-inverse">
        <tr>
            <th></th>
            <th></th>
            <th></th>
        </tr>
        </thead>
        <tbody>
            @foreach ($actors as $actor)
                <tr>
                    <td class=" w-25">
                        @if ($actor->photo == null)
                            <img src="{{asset('logo-01.jpg')}}" class="card-img-top" alt="...">
                        @else
                            <img src="{{$actor->actorUrlIcon}}" class="card-img-top" alt="...">
                        @endif
                    </td>
                    <td>{{ $actor->name }}</td>
                    <td>{{ $actor->note }}</td>
                    <td></td>
                </tr>
            @endforeach
        </tbody>
</table>
<div class="d-flex justify-content-center">
    {{ $actors->links() }}
</div>

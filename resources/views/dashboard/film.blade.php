<table class="table table-hover table-inverse table-responsive bg-light overflow-auto" style="max-height: 1000px">
    <thead class="thead-inverse">
        <tr>
            <th></th>
            <th></th>
            <th></th>
        </tr>
        </thead>
        <tbody>
            @foreach ($films as $film)
                <tr>
                    <td>
                        @if ($film->photo == null)
                            <img src="{{asset('logo-01.jpg')}}" class="card-img-top" alt="...">
                        @else
                            <img src="{{$film->filmUrlIcon}}" class="card-img-top" alt="...">
                        @endif
                    </td>
                    <td>{{ $film->name }}</td>
                    <td>{{ $film->story }}</td>
                    <td></td>
                </tr>
            @endforeach
        </tbody>
</table>
<div class="d-flex justify-content-center">
    {{ $films->links() }}
</div>

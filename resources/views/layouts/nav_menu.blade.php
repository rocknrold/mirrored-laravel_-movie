<li class="nav-item">
    {{-- @if (Auth::user()->is_admin)
        <a class="nav-link" href="{{route('contactUser')}}">Send Email to Users</a>
    @else
    @endif --}}
    <a class="nav-link" href="{{route('contact.index')}}">Contact {{Auth::user()->is_admin ? 'User':'Admin'}}</a>
</li>

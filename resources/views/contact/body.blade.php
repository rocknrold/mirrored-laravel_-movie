@component('mail::message')
# {{$subject}}

{{$message}}

Thanks,<br>
{{ $user }}
@endcomponent

@component('mail::layout')
    {{-- Header --}}
    @slot('header')
        @component('mail::header', ['url' => config('app.url')])
            <img src="{{asset('logo-02.jpg')}}" alt="{{config('app.name')}}">
            {{ config('app.name') }}
        @endcomponent
    @endslot

    # {{$subject ?? ''}}

    {{-- Body --}}
    {{ $message ?? '' }}
    {{ $slot ?? ''}}

    {{-- Subcopy --}}
    @isset($user)
        @slot('subcopy')
            @component('mail::subcopy')
                {{ $user }}
            @endcomponent
        @endslot
    @endisset

    @isset($subcopy)
        @slot('subcopy')
            @component('mail::subcopy')
                {{ $subcopy }}
            @endcomponent
        @endslot
    @endisset

    {{-- Footer --}}
    @slot('footer')
        @component('mail::footer')
            © {{ date('Y') }} {{ config('app.name') }}. @lang('All rights reserved.')
        @endcomponent
    @endslot
@endcomponent

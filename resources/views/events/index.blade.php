@if(Auth::user()->role == 'admin' || Auth::user()->role == 'coordinator')
    @include('events.admin')
@endif


@if(Auth::user()->role == 'student')
    @include('events.student')
@endif
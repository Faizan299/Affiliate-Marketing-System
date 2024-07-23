@if(Auth::user()->role == 'admin' || Auth::user()->role == 'coordinator')
    @include('events.adminView')
@endif


@if(Auth::user()->role == 'student')
    @include('events.studentView')
@endif


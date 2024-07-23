@if(Auth::user()->role == 'admin' || Auth::user()->role == 'coordinator')
    @include('clubs.adminView')
@endif


@if(Auth::user()->role == 'student')
    @include('clubs.studentView')
@endif

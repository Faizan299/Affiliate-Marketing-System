@if(Auth::user()->role == 'admin' || Auth::user()->role == 'coordinator')
    @include('clubs.admin')
@endif



@if(Auth::user()->role == 'student')
    @include('clubs.student')
@endif
@if(Auth::user()->role == 'admin' || Auth::user()->role == 'coordinator')
    @include('calendar.admin')
@endif



@if(Auth::user()->role == 'student')
    @include('calendar.student')
@endif
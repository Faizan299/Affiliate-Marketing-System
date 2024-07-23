@if(Auth::user()->role == 'admin' || Auth::user()->role == 'coordinator')
    @include('adminDashboard')
@endif

@if(Auth::user()->role == 'student')
    @include('studentDashboard')
@endif
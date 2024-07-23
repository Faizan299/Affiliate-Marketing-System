@if(Auth::user()->role == 'admin' || Auth::user()->role == 'coordinator')
    @include('news.admin')
@endif



@if(Auth::user()->role == 'student')
    @include('news.student')
@endif
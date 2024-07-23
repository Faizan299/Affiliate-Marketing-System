@if(Auth::user()->role == 'admin' || Auth::user()->role == 'coordinator')
    @include('news.adminView')
@endif


@if(Auth::user()->role == 'student')
    @include('news.studentView')
@endif

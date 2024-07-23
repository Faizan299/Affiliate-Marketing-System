@include('includes.head')

<!-- BEGIN: Body-->

<body class="vertical-layout vertical-menu-modern 2-columns   fixed-navbar" data-open="click" data-menu="vertical-menu-modern" data-col="2-columns">
    
    @include('includes.header')
    


    @include('includes.sidemenu')
    <!-- BEGIN: Content-->
    <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="content-wrapper">
            <div class="content-header row">
            </div>
            <div class="content-body">
                <div class="row">
                    @if(Auth::user()->role == 'admin' || Auth::user()->role == 'coordinator')
                        <div class="col-xl-3 col-lg-6 col-12">
                            <div class="card pull-up">
                                    <div class="card-content">
                                        <div class="card-body">
                                            <div class="media d-flex">
                                                <div class="media-body text-left">
                                                    @if(Auth::user()->role == 'admin')
                                                        <h3 class="secondary">{{ $pendingEvents }}</h3>
                                                    @endif
                                                    @if(Auth::user()->role == 'coordinator')
                                                        <h3 class="secondary">{{ $specificPendingEvents }}</h3>
                                                    @endif
                                                    <h6>Pending Events</h6>
                                                </div>
                                                <div>
                                                    <i class="icon-notebook secondary font-large-2 float-right"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                    @endif
                    @if(Auth::user()->role == 'admin' || Auth::user()->role == 'coordinator')
                        <div class="col-xl-3 col-lg-6 col-12">
                            <div class="card pull-up">
                                <div class="card-content">
                                    <div class="card-body">
                                        <div class="media d-flex">
                                            <div class="media-body text-left">
                                                @if(Auth::user()->role == 'admin')
                                                    <h3 class="success">{{ $upcomingEvents }}</h3>
                                                @endif
                                                @if(Auth::user()->role == 'coordinator')
                                                    <h3 class="success">{{ $specificUpcomingEvents }}</h3>
                                                @endif
                                                <h6>Up Coming Events</h6>
                                            </div>
                                            <div>
                                                <i class="icon-notebook success font-large-2 float-right"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                    @if(Auth::user()->role == 'admin' || Auth::user()->role == 'coordinator')
                        <div class="col-xl-3 col-lg-6 col-12">
                            <div class="card pull-up">
                                <div class="card-content">
                                    <div class="card-body">
                                        <div class="media d-flex">
                                            <div class="media-body text-left">
                                                @if(Auth::user()->role == 'admin')
                                                    <h3 class="info">{{ $pastEvent }}</h3>
                                                @endif
                                                @if(Auth::user()->role == 'coordinator')
                                                    <h3 class="info">{{ $specificPastEvents }}</h3>
                                                @endif
                                                <h6>Past Events</h6>
                                            </div>
                                            <div>
                                                <i class="icon-notebook info font-large-2 float-right"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                    @if(Auth::user()->role == 'admin' || Auth::user()->role == 'coordinator')
                        <div class="col-xl-3 col-lg-6 col-12">
                            <div class="card pull-up">
                                <div class="card-content">
                                    <div class="card-body">
                                        <div class="media d-flex">
                                            <div class="media-body text-left">
                                                @if(Auth::user()->role == 'admin')
                                                    <h3 class="danger">{{ $rejectedEvents }}</h3>
                                                @endif
                                                @if(Auth::user()->role == 'coordinator')
                                                    <h3 class="danger">{{ $specificRejectedEvents }}</h3>
                                                @endif
                                                <h6>Rejected Events</h6>
                                            </div>
                                            <div>
                                                <i class="icon-notebook danger font-large-2 float-right"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                    @if(Auth::user()->role == 'admin' || Auth::user()->role == 'coordinator')
                        <div class="col-xl-3 col-lg-6 col-12">
                            <div class="card pull-up">
                                <div class="card-content">
                                    <div class="card-body">
                                        <div class="media d-flex">
                                            <div class="media-body text-left">
                                                @if(Auth::user()->role == 'admin')
                                                    <h3 class="primary">{{ $totalEvents }}</h3>
                                                @endif
                                                @if(Auth::user()->role == 'coordinator')
                                                    <h3 class="primary">{{ $specificTotalEvents }}</h3>
                                                @endif
                                                <h6>Total Events</h6>
                                            </div>
                                            <div>
                                                <i class="icon-notebook primary font-large-2 float-right"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                    @if(Auth::user()->role == 'admin' || Auth::user()->role == 'coordinator')
                        <div class="col-xl-3 col-lg-6 col-12">
                            <div class="card pull-up">
                                <div class="card-content">
                                    <div class="card-body">
                                        <div class="media d-flex">
                                            <div class="media-body text-left">
                                                    <h3 class="secondary">{{ $studentCount }}</h3>
                                                <h6>Total Students</h6>
                                            </div>
                                            <div>
                                                <i class="icon-users secondary font-large-2 float-right"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                    @if(Auth::user()->role == 'admin' || Auth::user()->role == 'coordinator')
                        <div class="col-xl-3 col-lg-6 col-12">
                            <div class="card pull-up">
                                <div class="card-content">
                                    <div class="card-body">
                                        <div class="media d-flex">
                                            <div class="media-body text-left">
                                                @if(Auth::user()->role == 'admin')
                                                    <h3 class="info">{{ $clubCount }}</h3>
                                                @endif
                                                @if(Auth::user()->role == 'coordinator')
                                                    <h3 class="info">{{ $specificClubs }}</h3>
                                                @endif
                                                <h6>Total Clubs</h6>
                                            </div>
                                            <div>
                                                <i class="icon-puzzle info font-large-2 float-right"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif

                    
                </div>

                    
                </div>

            


        </div>
    </div>
    <!-- END: Content-->

    @include('includes.footer')
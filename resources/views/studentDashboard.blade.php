@include('includes.sub_head')
<!-- BEGIN: Body-->

<body class="horizontal-layout horizontal-menu 2-columns  " data-open="hover" data-menu="horizontal-menu" data-col="2-columns">
    
@include('includes.sub_header')
    

    <!-- END: Main Menu-->
    <!-- BEGIN: Content-->
    <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="content-wrapper">
            <div class="content-header row">
            </div>
            <div class="content-body">
                <!-- Statistics with grouped cards -->
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-content">
                                <div class="row">
                                    <div class="col border-right-blue-grey border-right-lighten-4">
                                        <div class="card-body text-center">
                                            <h1 class="display-4">{{ $clubCount }}</h1>
                                            <span>Total Clubs</span>
                                        </div>
                                    </div>
                                    <div class="col border-right-blue-grey border-right-lighten-4">
                                        <div class="card-body text-center">
                                            <h1 class="display-4">{{ $pendingClubsCount }}</h1>
                                            <span>Requested Clubs</span>
                                        </div>
                                    </div>
                                    <div class="col border-right-blue-grey border-right-lighten-4">
                                        <div class="card-body text-center">
                                            <h1 class="display-4">{{ $rejectedClubsCount }}</h1>
                                            <span>Rejected Clubs</span>
                                        </div>
                                    </div>
                                    <div class="col border-right-blue-grey border-right-lighten-4">
                                        <div class="card-body text-center">
                                            <h1 class="display-4">{{ $approvedclubsCount }}</h1>
                                            <span>Approved Clubs</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-content">
                                <div class="row">
                                    <div class="col border-right-blue-grey border-right-lighten-4">
                                        <div class="card-body text-center">
                                            <h1 class="display-4">{{ $upcomingStudentEvents }}</h1>
                                            <span>Total Events</span>
                                        </div>
                                    </div>
                                    <div class="col border-right-blue-grey border-right-lighten-4">
                                        <div class="card-body text-center">
                                            <h1 class="display-4">{{ $studentScore }}</h1>
                                            <span>Attended Events</span>
                                        </div>
                                    </div>
                                    <div class="col border-right-blue-grey border-right-lighten-4">
                                        <div class="card-body text-center">
                                            <h1 class="display-4">{{ $eventScore }}</h1>
                                            <span>Total Score</span>
                                        </div>
                                    </div>
                                    <div class="col border-right-blue-grey border-right-lighten-4">
                                        <div class="card-body text-center">
                                            <h1 class="display-4">{{ $upcomingEvents }}</h1>
                                            <span>Upcoming Events</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    @include('includes.sub_footer')
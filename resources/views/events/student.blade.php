@include('includes.sub_head')
<!-- BEGIN: Body-->

<body class="horizontal-layout horizontal-menu 2-columns  " data-open="hover" data-menu="horizontal-menu" data-col="2-columns">
    
@include('includes.sub_header')
    
    <!-- END: Main Menu-->
    <!-- BEGIN: Content-->
    <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="content-wrapper">
            <!-- Simple User Cards with Border-->
            <h2 class="card-title">Explore all Events</h2>
            <div class="content-body">
                <section id="tickets">
                    <div class="row">
                        <div class="col-lg-12 col-md-12">
                            <div class="card">
                                <div class="card-body">
                                    <div class="media-list media-bordered">
                                        <div class="time">
                                            <h5>Up Coming Events</h5>   
                                        </div>
                                        @foreach($studentEvents as $event)
                                            @if(!$studentEvents->isEmpty())
                                                <div class="media">
                                                    <div class="media-left">
                                                        <img src="images/event_images/{{ $event->image }}" height="100" width="100" alt="" class="mr-3 profile-img rounded-circle">
                                                    </div>
                                                    <div class="media-body">
                                                        

                                                        <h5><a href="events/view/{{ $event->id }}" class="text-info ticket-heading">
                                                                {{ $event->name }}
                                                            </a></h5>
                                                        <p class="text-muted">
                                                            {{ $event->description }}
                                                        </p>
                                                        <ul class="list-unstyled list-inline">
                                                            <li class="support-ticket-item  text-light">
                                                                <i class="font-small-3 la la-club"></i>
                                                                
                                                            </li>
                                                            <li class="support-ticket-item  text-light">
                                                                <i class="font-small-3 la la-calendar"></i>
                                                                {{ \Carbon\Carbon::parse($event->start_date)->format('F d, Y') }}
                                                            </li>
                                                            <li class="support-ticket-item  text-light">
                                                                <i class="font-small-3 ft-user"></i>
                                                                13
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            @endif
                                        @endforeach
                                        @if($studentEvents->isEmpty())
                                            <div class="text-center" style="color:#C0C0C0">
                                                <h2 style="color:#C0C0C0;font-size:20px">No upcoming events available at a moment</h2>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12 col-md-12">
                            <div class="card">
                                <div class="card-body">
                                    <div class="media-list media-bordered ">
                                        <div class="time">
                                            <h5>Live Events</h5>
                                        </div>
                                        @foreach($live_events as $event)
                                            @if(!$live_events->isEmpty())
                                                <div class="media">
                                                    <div class="media-left">
                                                        <img src="images/event_images/{{ $event->image }}" height="100" width="100" alt="" class="mr-3 profile-img rounded-circle">
                                                    </div>
                                                    <div class="media-body">
                                                        <h5><a href="events/view/{{ $event->id }}" class="text-info ticket-heading">
                                                                {{ $event->name }}
                                                            </a></h5>
                                                        <p class="text-muted">
                                                            {{ $event->description }}
                                                        </p>
                                                        <ul class="list-unstyled list-inline">
                                                            <li class="support-ticket-item  text-light">
                                                                <i class="font-small-3 la la-club"></i>
                                                                
                                                            </li>
                                                            <li class="support-ticket-item  text-light">
                                                                <i class="font-small-3 la la-calendar"></i>
                                                                {{ \Carbon\Carbon::parse($event->start_date)->format('F d, Y') }}
                                                            </li>
                                                            <li class="support-ticket-item  text-light">
                                                                <i class="font-small-3 ft-user"></i>
                                                                13
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            @endif
                                        @endforeach
                                        @if($live_events->isEmpty())
                                            <div class="text-center" style="color:#C0C0C0">
                                                <h2 style="color:#C0C0C0;font-size:20px">No live events available at a moment</h2>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>
    
    @include('includes.sub_footer')
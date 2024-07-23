@include('includes.sub_head')
<!-- BEGIN: Body-->

<body class="horizontal-layout horizontal-menu 2-columns  " data-open="hover" data-menu="horizontal-menu" data-col="2-columns">
    
@include('includes.sub_header')
    
<div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
    <ol class="carousel-indicators">
        <li data-target="#carousel-example-generic" data-slide-to="0" class=""></li>
        <li data-target="#carousel-example-generic" data-slide-to="1" class="active"></li>
        <li data-target="#carousel-example-generic" data-slide-to="2" class=""></li>
    </ol>
    <div class="carousel-inner" role="listbox">
        @foreach($carousel as $key => $slider)
        <div class="carousel-item {{ $key == 0 ? 'active' : '' }} carousel-item-left">
            <img src="{{ asset('images/carousel_images/' . $slider->image) }}" width="100%" class="img-fluid" alt="First slide">
        </div>
        @endforeach
    </div>
    <a class="carousel-control-prev" href="#carousel-example-generic" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#carousel-example-generic" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
    </a>
</div>
    <!-- END: Main Menu-->
    <!-- BEGIN: Content-->
    <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="content-wrapper">
            
            <div class="content-header row">
            </div>
            <div class="content-body">
                <!-- Statistics with grouped cards -->
                <h1 class="text-center" style="font-size:50px">Events</h1>
                <div class="row">
                    <div class="col-md-12">
                        <div class="card" >
                            <div class="card-content">
                                <div class="card-body">
                                    <section id="events">
                                        <h3>Upcoming Events</h3> 
                                            <div class="row">
                                                <div class="col-lg-12 col-md-12">
                                                    <div class="card">
                                                        <div class="card-body">
                                                            <div class="media-list media-bordered">
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
                                            
                                    </section>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="card" >
                            <div class="card-content">
                                <div class="card-body">
                                    <section id="events">
                                        <h3>Live Events</h3> 
                                        <div class="row">
                                                <div class="col-lg-12 col-md-12">
                                                    <div class="card">
                                                        
                                                        <div class="card-body">
                                                            <div class="media-list media-bordered">
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
                                    </section>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <h1 class="text-center" style="font-size:50px">Latest News</h1>
            <div class="content-body">
                <!-- Statistics with grouped cards -->
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-content">
                                <div class="card-body">
                                        <section id="tickets">
                                            <div class="row">
                                                <div class="col-lg-12 col-md-12">
                                                    <div class="card">
                                                        <div class="card-body">
                                                            <div class="media-list media-bordered">
                                                                @foreach($latestNews as $news)
                                                                        <div class="media">
                                                                            <div class="media-left">
                                                                                
                                                                            </div>
                                                                            <div class="media-body">
                                                                                

                                                                                <h5><a href="news/view/{{ $news->id }}" class="text-info ticket-heading">
                                                                                        {{ $news->title }}
                                                                                    </a></h5>
                                                                                <p class="text-muted">
                                                                                        {{ str_word_count($news->description) > 150 ? '....' : $news->description }}

                                                                                </p>
                                                                                <ul class="list-unstyled list-inline">
                                                                                    <li class="support-ticket-item  text-light">
                                                                                        <i class="font-small-3 la la-club"></i>
                                                                                        
                                                                                    </li>
                                                                                    <li class="support-ticket-item  text-light">
                                                                                        <i class="font-small-3 la la-calendar"></i>
                                                                                        {{ \Carbon\Carbon::parse($news->date)->format('F d, Y') }}
                                                                                    </li>
                                                                                </ul>
                                                                            </div>
                                                                        </div>
                                                                @endforeach
                                                            </div>
                                                            @if($latestNews->isEmpty())
                                                            <div class="text-center" style="color:#C0C0C0">
                                                                <h2 style="color:#C0C0C0;font-size:20px">No News available at a moment</h2>
                                                            </div>
                                                            @endif
                                                        </div>
                                                    </div>  
                                                </div>
                                            </div>
                                        </section>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    @include('includes.sub_footer')
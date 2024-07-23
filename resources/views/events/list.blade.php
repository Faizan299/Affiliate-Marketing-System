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
                <div class="content-header-left col-md-6 col-12 mb-2 breadcrumb-new">
                    <h3 class="content-header-title mb-0 d-inline-block">Events</h3>
                    <div class="row breadcrumbs-top d-inline-block">
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="index.html">EventifyU</a>
                                </li>
                                <li class="breadcrumb-item active">Events
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <section id="basic-examples">
                <div class="row match-height">
                @foreach($events as $event)
                    <div class="col-xl-3 col-md-6 col-sm-12">
                        <div class="card" style="height: 397.109px;">
                            <div class="card-content">
                                <div class="card-body">
                                    <h4 class="card-title">{{ $event->name }}</h4>
                                    <div style="display: flex; align-items: center;">
                                        <a href="#" type="button" data-toggle="modal" data-target="#iconModal" onclick="setModalImage('{{ asset('images/event_images/' . $event->image) }}', '{{ $event->name }}')" style="margin-right: 10px;">
                                            <img src="{{ asset('images/event_images/' . $event->image) }}" class="rounded-circle img-thumbnail" style="width: 30px; height: 30px;">
                                        </a>
                                        <h6 class="card-subtitle text-muted" style="margin: 0;">{{ $event->club->name }}</h6>
                                    </div>
                                </div>
                                <img class="img-fluid" src="{{ asset('images/event_images/' . $event->image) }}" style="width: 100%; height: 200px; object-fit: cover;" alt="Card image cap">
                                <div class="card-body">
                                    <p class="card-text">{{ strlen($event->description) > 40 ? substr($event->description, 0, 40) . '...' : $event->description }}</p>
                                    <a href="view/{{ $event->id }}" class="btn btn-outline-success ">Learn More</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </section>
        </div>
    </div>
    <!-- END: Content-->
    @include('includes.footer') 
 

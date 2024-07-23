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
            <div class="content-body">
                <section id="tickets">
                    <div class="row">
                        <div class="col-lg-12 col-md-12">
                            <div class="card">
                                <div class="card-content collapse show">
                                    <div class="card-body card-dashboard dataTables_wrapper dt-bootstrap">
                                        <div class="container">
                                            <div class="tab-content">
                                                <div>
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <h3>{{ $news->title }}</h3>
                                                            <p style="color:#ccc">{{ $news->category }}</p>
                                                            <p>
                                                                {{ $news->description }} 
                                                            </p>
                                                        </div>
                                                        <div class="col-md-6 col-sm-12">
                                                            <div class="card">
                                                                <div class="card-header">
                                                                    <h4 class="card-title">Basic Example</h4>
                                                                </div>
                                                                <div class="card-content">
                                                                    <div class="card-body">
                                                                        <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
                                                                            <ol class="carousel-indicators">
                                                                                <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
                                                                                <li data-target="#carousel-example-generic" data-slide-to="1"></li>
                                                                                <li data-target="#carousel-example-generic" data-slide-to="2"></li>
                                                                            </ol>
                                                                            <div class="carousel-inner" role="listbox">
                                                                            @if(is_array($news->image) && count($news->image) > 0)
                                                                                @foreach ($news->image as $index => $image)
                                                                                    <div class="carousel-item {{ $index == 0 ? 'active' : '' }}">
                                                                                        <img src="{{ asset('images/news_images/' . $image) }}" class="img-fluid" alt="Slide {{ $index + 1 }}">
                                                                                    </div>
                                                                                @endforeach
                                                                            @else
                                                                                <div class="carousel-item active">
                                                                                    <img src="{{ asset('path_to_default_image/default.jpg') }}" class="img-fluid" alt="Default Slide">
                                                                                </div>
                                                                            @endif
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
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>
    
    @include('includes.sub_footer')

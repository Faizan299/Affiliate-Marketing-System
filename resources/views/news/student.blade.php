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
                                <div class="card-content">
                                    <div class="card-body">
                                        <!-- Task List table -->
                                        <div class="table-responsive">
                                            <table id="project-task-list" class="table table-white-space table-bordered row-grouping display no-wrap icheck table-middle">
                                                <thead>
                                                    
                                                </thead>
                                                <tbody>
                                                    @foreach($news as $update)
                                                    <tr>
                                                        <td>
                                                            <a href="news/view/{{ $update->id }}" class="text-bold-600">{{ $update->title }}</a>
                                                            <p class="text-muted">{{ Illuminate\Support\Str::limit($update->description, 20, '...') }}</p>
                                                        </td>
                                                        <td>
                                                            <h6>{{ \Carbon\Carbon::parse($update->date)->format('F d, Y') }}</h6>
                                                        </td>
                                                    </tr>
                                                    @endforeach
                                                    
                                                </tbody>
                                                <tfoot>
                                                    
                                                </tfoot>
                                            </table>
                                        </div>
                                        <!--/ Task List table -->
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
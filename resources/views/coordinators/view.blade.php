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
                    <h3 class="content-header-title mb-0 d-inline-block">Club Coordinator</h3>
                    <div class="row breadcrumbs-top d-inline-block">
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="index.html">EventifyU</a>
                                </li>
                                <li class="breadcrumb-item active">Club Coordinator 
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>

                <div class="content-header-right col-md-6 col-12">
                    <div class="btn-group float-md-right">
                            <a href="{{ route('events.add') }}">
                            <button class="btn btn-info mb-1" type="button">Manage Events</button>
                            </a>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12 col-md-12">

                    <!-- Road Trip Card -->

                    <div class="card">
                        <div class="card-body">
                            <div class="row bg-primary bg-lighten-5 rounded mb-2 mx-25 text-center text-lg-left">
                                <div class="col-12 col-sm-4 p-2">
                                    <h6 class="text-primary mb-0">Total Events: <span class="font-large-1 align-middle">{{ $events }}</span></h6>
                                </div>
                                <div class="col-12 col-sm-4 p-2">
                                    <h6 class="text-primary mb-0">Approved Events: <span class="font-large-1 align-middle">{{ $approvedEvents }}</span></h6>
                                </div>
                                <div class="col-12 col-sm-4 p-2">
                                    <h6 class="text-primary mb-0">Rejected Events: <span class="font-large-1 align-middle">{{ $pendingEvents }}</span></h6>
                                </div>
                            </div>
                            <div class="col-12">
                                <h5 class="mb-1"><i class="ft-info"></i> Personal Info</h5>
                                <table class="table table-borderless">
                                    <tbody>
                                        <tr>
                                            <td>Name:</td>
                                            <td class="users-view-username">{{ $coordinator->name }}</td>
                                        </tr>
                                        <tr>
                                            <td>Login Id:</td>
                                            <td class="users-view-name">{{ $coordinator->student_id }}</td>
                                        </tr>
                                        <tr>
                                            <td>E-mail:</td>
                                            <td class="users-view-email">{{ $coordinator->email }}</td>
                                        </tr>
                                        <tr>
                                            <td>Phone:</td>
                                            <td>{{ $coordinator->phone }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                                <h5 class="mb-1"><i class="ft-link"></i>Membership Clubs</h5>
                                <table class="table table-borderless">
                                    <tbody>
                                        @foreach($clubs as $club)
                                        <tr>
                                            <td><li>{{ $club }}</li></td>
                                        </tr>
                                        @endforeach
                                        
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END: Content-->
    @include('includes.footer') 

    
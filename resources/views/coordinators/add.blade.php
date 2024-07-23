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
                    <h3 class="content-header-title mb-0 d-inline-block">Add Coordinators</h3>
                    <div class="row breadcrumbs-top d-inline-block">
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="index.html">EventifyU</a>
                                </li>
                                <li class="breadcrumb-item active"><a href="">Coordinators</a>
                                </li>
                                <li class="breadcrumb-item active">Add
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>
                <div class="content-header-right col-md-6 col-12">
                    <div class="btn-group float-md-right">
                        <a href="{{ route('coordinators.index') }}">
                        <button class="btn btn-info mb-1" type="button">Manage Coordinators</button>
                        </a>
                    </div>
                </div>
            </div>
            <div class="content-body">
                <!-- File export table -->
                <section id="file-export">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">Add a New Coordinator</h4>
                                    <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                                </div>
                                <div class="card-content collapse show">
                                    <div class="card-body card-dashboard dataTables_wrapper dt-bootstrap">
                                    <form class="form" action="{{ route('coordinators.add') }}" method="post">
                                            @csrf

                                            @if ($errors->any())
                                            <div class="alert alert-danger">
                                                <ul>
                                                    @foreach ($errors->all() as $error)
                                                        <li>{{ $error }}</li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        @endif
                                        @if (session()->has('success'))
                                            <div class="alert alert-success">
                                                {{ session()->get('success') }}
                                            </div>
                                        @endif
                                            <div class="form-body">
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="projectinput1">Full Name <span class="text-danger">*</span></label>
                                                            <input type="text" name="name" value="{{ old('name') }}" id="projectinput1" class="form-control" placeholder="Full Name" required  >
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="projectinput2">Coordinator Id <span class="text-danger">*</span></label>
                                                            <input type="text" id="projectinput2" value="{{ old('coordinator_id') }}" name="coordinator_id" required class="form-control" placeholder="Coordinator Id" >
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="projectinput3">Email<span class="text-danger"> *</span></label>
                                                            <input type="email" id="projectinput3" value="{{ old('email') }}" name="email" required class="form-control" placeholder="Email Address">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label>Assign Clubs<span class="text-danger"> *</span></label>
                                                            <select class="selectize-multiple" name="clubs[]" multiple>
                                                                <option value="">No club selected</option>
                                                                @foreach($clubs as $club)
                                                                    <option value="{{ $club->id }}">{{ $club->name }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="projectinput4">Phone <span class="text-danger"> *</span></label>
                                                            <input type="tel" id="projectinput4" value="{{ old('phone') }}" name="phone" class="form-control" placeholder="Phone" >
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="projectinput4">Password <span class="text-danger"> *</span></label>
                                                            <input type="text" id="projectinput5" value="{{ old('password') }}" placeholder="*******"  name="password" class="form-control" >
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-actions">
                                                    <a href="index.php">
                                                        <button type="button" class="btn btn-warning mr-1">
                                                            <i class="ft-x"></i> Cancel
                                                        </button>
                                                    </a>
                                                    <button type="submit" class="btn btn-primary">
                                                        <i class="la la-check-square-o"></i> Save
                                                    </button>
                                                </div>
                                            </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <!-- File export table -->
            </div>
        </div>
    </div>
    <!-- END: Content-->

    @include('includes.footer')
@include('includes.head')
<link rel="stylesheet" type="text/css" href="../../../app-assets/vendors/css/forms/selects/select2.min.css">
<!-- BEGIN: Body-->

<body class="vertical-layout vertical-menu-modern 2-columns   fixed-navbar" data-open="click" dat   a-menu="vertical-menu-modern" data-col="2-columns">
    
    @include('includes.header')
    


    @include('includes.sidemenu')
    <!-- BEGIN: Content-->
    <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="content-wrapper">
        <div class="content-header row">
                <div class="content-header-left col-md-6 col-12 mb-2 breadcrumb-new">
                    <h3 class="content-header-title mb-0 d-inline-block">Edit Student</h3>
                    <div class="row breadcrumbs-top d-inline-block">
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="index.html">EventifyU</a>
                                </li>
                                <li class="breadcrumb-item active"><a href="">Students</a>
                                </li>
                                <li class="breadcrumb-item active">Edit
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>
                <div class="content-header-right col-md-6 col-12">
                    <div class="btn-group float-md-right">
                        <a href="{{ route('students.index') }}">
                        <button class="btn btn-info mb-1" type="button">Manage Students</button>
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
                                    <h4 class="card-title">Edit a Student</h4>
                                    <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                                </div>
                                <div class="card-content collapse show">
                                    <div class="card-body card-dashboard dataTables_wrapper dt-bootstrap">
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
                                                <form action="{{ route('student.update' , ['id' => $student->id]) }}" method="post">
                                                @csrf
                                                    <div class="row mb-2">
                                                        <div class="col-md-4">
                                                            <label for="">Name <span class="text-danger">*</span></label>
                                                            <input type="text" name="name" class="form-control" value="{{ $student->name }}">
                                                        </div>
                                                        <div class="col-md-4">
                                                            <label for="">Student Id <span class="text-danger">*</span></label>
                                                            <input type="text" name="student_id" class="form-control" value="{{ $student->student_id }}" readonly>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <label for="">Email <span class="text-danger">*</span></label>
                                                            <input type="text" name="email" class="form-control" value="{{ $student->email }}">
                                                        </div>
                                                        <div class="col-md-4 mt-2">
                                                            <label for="">Phone <span class="text-danger">*</span></label>
                                                            <input type="text" name="phone" class="form-control" value="{{ $student->phone }}">
                                                        </div>
                                                        <div class="col-md-4 mt-2">
                                                            <label for="">Member Role <span class="text-danger">*</span></label>
                                                            <input type="text" name="member_role" class="form-control" value="{{ $student->member_role }}">
                                                        </div>
                                                        <div class="col-md-4 mt-2">
                                                            <label for="">Course <span class="text-danger">*</span></label>
                                                            <input type="text" name="course" class="form-control" value="{{ $student->course }}">
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
    <!-- BEGIN: Page Vendor JS-->
    <script src="../../../app-assets/vendors/js/forms/select/select2.full.min.js"></script>
    <!-- END: Page Vendor JS-->

    <!-- BEGIN: Page JS-->
    <script src="../../../app-assets/js/scripts/forms/select/form-select2.js"></script>
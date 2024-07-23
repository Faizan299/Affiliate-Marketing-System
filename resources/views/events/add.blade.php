@include('includes.head')
<link rel="stylesheet" type="text/css" href="../../../app-assets/vendors/css/forms/selects/select2.min.css">
<link rel="stylesheet" type="text/css" href="../../../app-assets/css/plugins/forms/wizard.css">
<!-- BEGIN: Body-->

    <link rel="stylesheet" type="text/css" href="../../../app-assets/vendors/css/vendors.min.css">
    <link rel="stylesheet" type="text/css" href="../../../app-assets/vendors/css/tables/datatable/datatables.min.css">
    <link rel="stylesheet" type="text/css" href="../../../app-assets/vendors/css/tables/datatable/select.dataTables.min.css">
    <link rel="stylesheet" type="text/css" href="../../../app-assets/vendors/css/tables/extensions/buttons.dataTables.min.css">
    <link rel="stylesheet" type="text/css" href="../../../app-assets/vendors/css/tables/datatable/buttons.bootstrap4.min.css">

<body class="vertical-layout vertical-menu-modern 2-columns   fixed-navbar" data-open="click" dat   a-menu="vertical-menu-modern" data-col="2-columns">
    
    @include('includes.header')
    


    @include('includes.sidemenu')
    <!-- BEGIN: Content-->
    <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-md-6 col-12 mb-2 breadcrumb-new">
                    <h3 class="content-header-title mb-0 d-inline-block">Add Events</h3>
                    <div class="row breadcrumbs-top d-inline-block">
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="index.html">EventifyU</a>
                                </li>
                                <li class="breadcrumb-item active"><a href="">Events</a>
                                </li>
                                <li class="breadcrumb-item active">Add
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>
                <div class="content-header-right col-md-6 col-12">
                    <div class="btn-group float-md-right">
                        <a href="{{ route('events.index') }}">
                        <button class="btn btn-info mb-1" type="button">Manage Events</button>
                        </a>
                    </div>
                </div>
            </div>
            <div class="content-body">
                <section id="number-tabs">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-content collapse show">
                                    <div class="card-body">
                                        <form action="{{ route('events.add') }}" id="stepForm" method="post" enctype="multipart/form-data" class="number-tab-steps wizard-circle">
                                            <!-- Step 1 -->
                                            <h6>Event Info</h6>
                                            <fieldset>
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="projectinput1">Name <span class="text-danger">*</span></label>
                                                            <input type="text" name="name" value="{{ old('name') }}" id="projectinput1" class="form-control" placeholder="Full Name" required  >
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="projectinput2">Associated Club<span class="text-danger">*</span></label>
                                                            <div class="form-group">
                                                                @if(Auth::user()->role == 'coordinator')
                                                                <select class="select2 form-control" id="select2" name="club_id">    
                                                                    @foreach($specificClubs as $club)
                                                                        <option value="{{ $club->id }}">{{ $club->name }}</option>
                                                                    @endforeach
                                                                </select>
                                                                @endif
                                                                @if(Auth::user()->role == 'admin')
                                                                    <select class="select2 form-control" id="select2" name="club_id">    
                                                                        @foreach($clubs as $club)
                                                                            <option value="{{ $club->id }}">{{ $club->name }}</option>
                                                                        @endforeach
                                                                    </select>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <input type="text" value="{{ Auth::user()->id }}" hidden name="coordinator_id">
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="projectinput3">Venue<span class="text-danger"> *</span></label>
                                                            <input type="text" id="projectinput3" value="{{ old('venue') }}" name="venue" required class="form-control" placeholder="Event Venue" required>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="projectinput4">Starting Date <span class="text-danger"> *</span></label>
                                                            <input type="date" id="projectinput4" value="{{ old('start_date') }}" name="start_date" class="form-control" placeholder="Phone" required>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="projectinput4">End Date <span class="text-danger"> *</span></label>
                                                            <input type="date" id="projectinput4" value="{{ old('end_date') }}" name="end_date" class="form-control" placeholder="Phone" required>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="projectinput4">Start Time <span class="text-danger"> *</span></label>
                                                            <input type="time" id="projectinput4" value="{{ old('start_time') }}"  name="start_time" class="form-control" required>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="projectinput4">End Time <span class="text-danger"> *</span></label>
                                                            <input type="time" id="projectinput4" value="{{ old('end_time') }}"  name="end_time" class="form-control" required>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="projectinput4">Image <span class="text-danger"> *</span></label>
                                                            <input type="file" id="projectinput4" value=""  name="image" class="form-control" required>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="projectinput4">Color <span class="text-danger"> *</span></label>
                                                            <input type="color" id="projectinput4" value="#5059e5"  name="color" class="form-control" required>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label for="projectinput4">Description</label>
                                                            <textarea name="description" class="form-control" id="" cols="30" rows="10">{{ old('description') }}</textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                            </fieldset>

                                            <h6>Visibility</h6>
                                            <fieldset>
                                                <table class="table table-striped table-bordered file-export">
                                                    <thead>
                                                        <tr>
                                                            <th><input type="checkbox" id="selectAllCheckbox"></th>
                                                            <th>S.No</th>
                                                            <th>Name</th>
                                                            <th>Email</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach($students as $student)
                                                        <tr>
                                                            <td>
                                                                <input type="checkbox" class="student-checkbox" value="{{ $student->id }}" {{ in_array($student->id, old('selected_students', [])) ? 'checked' : '' }}>
                                                            </td>
                                                            <td>{{ $loop->iteration }}</td>
                                                            <td>{{ $student->name }}</td>
                                                            <td>{{ $student->email }}</td>
                                                        </tr>
                                                        @endforeach
                                                    </tbody>
                                                    <tfoot>
                                                        <tr>
                                                            <th></th>
                                                            <th>S.No</th>
                                                            <th>Name</th>
                                                            <th>Email</th>
                                                        </tr>
                                                    </tfoot>
                                                </table>
                                                <input type="hidden" id="allSelectedStudents" name="selected_students_1" value="{{ old('selected_students_1') }}">
                                            </fieldset>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <!-- Form wizard with number tabs section end -->
            </div>
        </div>
    </div>
    <!-- END: Content-->

    @include('includes.footer')
    <!-- BEGIN: Page Vendor JS-->
    <script src="../../../app-assets/vendors/js/forms/select/select2.full.min.js"></script>
    <!-- END: Page Vendor JS-->

    <!-- BEGIN: Page JS-->
    <script src="../../../app-assets/vendors/js/extensions/jquery.steps.min.js"></script>
    <script src="../../../app-assets/vendors/js/pickers/dateTime/moment-with-locales.min.js"></script>
    <script src="../../../app-assets/vendors/js/pickers/daterange/daterangepicker.js"></script>
    <script src="../../../app-assets/vendors/js/forms/validation/jquery.validate.min.js"></script>
    <script src="../../../app-assets/js/scripts/forms/wizard-steps.js"></script>


    <script src="../../../app-assets/vendors/js/tables/datatable/datatables.min.js"></script>
    <script src="../../../app-assets/vendors/js/tables/datatable/dataTables.responsive.min.js"></script>
    <script src="../../../app-assets/vendors/js/tables/datatable/dataTables.select.min.js"></script>
    <script src="../../../app-assets/vendors/js/tables/datatable/dataTables.buttons.min.js"></script>
    <script src="../../../app-assets/vendors/js/tables/datatable/buttons.bootstrap4.min.js"></script>

    <script src="../../../app-assets/js/scripts/tables/datatables-extensions/datatable-select.js"></script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
        var selectAllCheckbox = document.getElementById("selectAllCheckbox");
        var checkboxes = document.querySelectorAll(".student-checkbox");
        var selectedStudentsInput = document.getElementById("allSelectedStudents");

        function updateSelectedStudentsInput() {
            var selectedStudents = Array.from(checkboxes)
                .filter(checkbox => checkbox.checked)
                .map(checkbox => checkbox.value);
            selectedStudentsInput.value = selectedStudents.join(',');
        }

        // Attach the update function to the select all checkbox
        selectAllCheckbox.addEventListener("change", function() {
            checkboxes.forEach(function(checkbox) {
                checkbox.checked = selectAllCheckbox.checked;
            });
            updateSelectedStudentsInput();
        });

        // Attach the update function to each student checkbox
        checkboxes.forEach(function(checkbox) {
            checkbox.addEventListener("change", updateSelectedStudentsInput);
        });

        // Initial call to update the hidden input field on page load
        updateSelectedStudentsInput();
        });


    </script>

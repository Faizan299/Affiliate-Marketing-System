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
                    <h3 class="content-header-title mb-0 d-inline-block">Students</h3>
                    <div class="row breadcrumbs-top d-inline-block">
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="index.html">EventifyU</a>
                                </li>
                                <li class="breadcrumb-item active">Students
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>
                <div class="content-header-right col-md-6 col-12">
                    <div class="btn-group float-md-right">
                        <a href="{{ route('students.add') }}">
                        <button class="btn btn-info mb-1" type="button">Create a New Student</button>
                        </a>
                    </div>
                </div>
            </div>
            <div class="content-body">
                <!-- File export table -->
                <section id="file-export">
                    <div class="row">
                        <div class="col-12">
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
                            <div class="card">
                                <div class="card-header d-flex justify-content-between align-items-center">
                                    <h4 class="card-title mb-0">Manage Students</h4>
                                    <button class="btn btn-outline-success" id="mark_attendance" data-toggle="modal" data-target="#notificationModal">Send Notification</button>
                                </div>
                                <div class="card-content collapse show">
                                    <div class="card-body card-dashboard dataTables_wrapper dt-bootstrap">
                                        <table class="table table-striped table-bordered file-export">
                                            <thead>
                                                <tr>
                                                    <th><input type="checkbox" id="selectAllCheckbox"></th>
                                                    <th>S.No</th>
                                                    <th>Name</th>
                                                    <th>Email</th>
                                                    <th>Score</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($students as $student)
                                                <tr>
                                                    <td><input type="checkbox" class="student-checkbox" value="{{ $student->id }}"></td>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ $student->name }}</td>
                                                    <td>{{ $student->email }}</td>
                                                    <td>{{ $eventAttendeesCount[$student->id] }}</td>
                                                    <td><a href="student/delete/{{ $student->id }}" class="delete-student" data-id="{{ $student->id }}"
                                                        onclick="confirmDelete({{ $student->id }})">
                                                        <a href="student/view/{{ $student->id }}" type="button" class="btn btn-primary btn-sm">View</a>
                                                        <a href="student/edit/{{ $student->id }}" type="button" class="btn btn-warning btn-sm">Edit</a>
                                                        <a href="students/delete/{{ $student->id }}" type="button" class="btn btn-danger btn-sm">Delete</a>
                                                    </a>
                                                </td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <th>S.No</th>
                                                    <th>Name</th>
                                                    <th>Email</th>
                                                    <th>Score</th>
                                                    <th>Action</th>
                                                </tr>
                                            </tfoot>
                                        </table>
                                        
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

    <!-- Notification Modal -->
    <div class="modal fade" id="notificationModal" tabindex="-1" role="dialog" aria-labelledby="notificationModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form id="sendNotificationForm" method="POST" action="{{ route('send.custom.notification') }}">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="notificationModalLabel">Send Notification</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="notificationTitle">Title</label>
                            <input type="text" class="form-control" id="notificationTitle" name="message" required>
                        </div>
                        <div class="form-group">
                            <label for="notificationDescription">Description</label>
                            <textarea class="form-control" id="notificationDescription" name="description" rows="3" required></textarea>
                        </div>
                        <input type="hidden" id="allSelectedStudents" name="selected_students_1" value="{{ old('selected_students_1') }}">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Send Notification</button>
                    </div>
                </div>
            </form>
        </div>
    </div>


    <!-- Modal -->
    
    @include('includes.footer') 
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
        
        $(document).ready(function(){
            $('.delete-student').click(function(event) {
                event.preventDefault(); // Prevent the default action (i.e., following the link)

                var coordinatorId = $(this).data('id'); // Get the coordinator ID from the data attribute

                // Show SweetAlert confirmation dialog
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        // If confirmed, redirect to the delete route
                        window.location.href = '/students/delete/' + coordinatorId;
                    }
                });
            });
        });
        

        $(document).ready(function() {
            $('.approve-btn').click(function() {
                setApprovalStatus(this, 1);
            });

            $('.reject-btn').click(function() {
                setApprovalStatus(this, 2);
            });
        });


        function setApprovalStatus(button, status) {
            var dataId = $(button).data('id');
            $('#approvalStatus').val(status);
            $('#dataId').val(dataId);
            $('#approveRejectForm').submit();
        }

    </script>

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
                    <h3 class="content-header-title mb-0 d-inline-block">Coordinators</h3>
                    <div class="row breadcrumbs-top d-inline-block">
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="index.html">EventifyU</a>
                                </li>
                                <li class="breadcrumb-item active">Coordinators
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>
                <div class="content-header-right col-md-6 col-12">
                    <div class="btn-group float-md-right">
                        <a href="{{ route('coordinators.add') }}">
                        <button class="btn btn-info mb-1" type="button">Create a New Coordinator</button>
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
                                    <h4 class="card-title">Manage Coordinators</h4>
                                    <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                                </div>
                                <div class="card-content collapse show">
                                    <div class="card-body card-dashboard dataTables_wrapper dt-bootstrap">
                                        <table class="table table-striped table-bordered file-export">
                                            <thead>
                                                <tr>
                                                    <th>S.No</th>
                                                    <th>Full Name</th>
                                                    <th>Login Id</th>
                                                    <th>Email</th>
                                                    <th>Phone</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($coordinators as $coordinator)
                                                    <tr>
                                                        <td>{{ $loop->iteration }}</td>
                                                        <td>{{ $coordinator->name }}</td>
                                                        <td>{{ $coordinator->student_id }}</td>
                                                        <td>{{ $coordinator->email }}</td>
                                                        <td>{{ $coordinator->phone }}</td>
                                                        <td>
                                                            <a href="coordinators/view/{{ $coordinator->id }}">
                                                                <button type="button" class="btn btn-primary btn-sm">View</button>
                                                            </a>
                                                            <a href="coordinators/edit/{{ $coordinator->id }}">
                                                                <button type="button" class="btn btn-warning btn-sm">Edit</button>
                                                            </a>
                                                            <a href="coordinators/delete/{{ $coordinator->id }}" class="delete-coordinator" data-id="{{ $coordinator->id }}"
                                                                onclick="confirmDelete({{ $coordinator->id }})">
                                                                <button type="button" class="btn btn-danger btn-sm">Delete</button>
                                                            </a>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>

                                            <tfoot>
                                                <tr>
                                                    <th>S.No</th>
                                                    <th>Full Name</th>
                                                    <th>Login Id</th>
                                                    <th>Email</th>
                                                    <th>Phone</th>
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

    @include('includes.footer') 
    <script>
        // When the delete link is clicked
        $('.delete-coordinator').click(function(event) {
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
                    window.location.href = '/coordinators/delete/' + coordinatorId;
                }
            });
        });

    </script>

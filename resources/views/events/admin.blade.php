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
                <div class="content-header-right col-md-6 col-12">
                    <div class="btn-group float-md-right">
                        <a href="{{ route('events.add') }}">
                        <button class="btn btn-info mb-1" type="button">Create a New Event</button>
                        </a>
                    </div>
                </div>
            </div>
            <div class="content-body">
                <!-- File export table -->
                <section id="file-export">
                    <div class="row">
                        <div class="col-12">
                            @if (session()->has('success'))
                                <div class="alert alert-success">
                                    {{ session()->get('success') }}
                                </div>
                            @endif
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">Manage Events</h4>
                                    <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                                </div>
                                <div class="card-content collapse show">
                                    <div class="card-body card-dashboard dataTables_wrapper dt-bootstrap">
                                        <table class="table table-striped table-bordered file-export">
                                            <thead>
                                                <tr>
                                                    <th>S.No</th>
                                                    <th>Title</th>
                                                    @if(Auth::user()->role == 'admin') 
                                                        <th>Coordinator</th>
                                                    @endif
                                                    <th>Start Date & Time</th>
                                                    <th>Venue</th>
                                                    <th>Club</th>
                                                    <th>Image</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @if(Auth::user()->role == 'admin')
                                                    @foreach($events as $event)
                                                    <tr>
                                                        <td>{{ $loop->iteration }}</td>
                                                        <td>{{ $event->name }} 
                                                            @if($event->status == 1)
                                                            <span class="badge badge-success">Approved</span>
                                                            @elseif($event->status == 2)
                                                            <span class="badge badge-danger">Rejected</span>
                                                            @else
                                                            <span class="badge badge-secondary">Pending</span>
                                                            @endif
                                                        </td>
                                                        @if(Auth::user()->role == 'admin') 
                                                            <td>{{ $event->coordinator ? $event->coordinator->name : 'N/A' }}</td>
                                                        @endif
                                                        <td>{{ \Carbon\Carbon::parse($event->start_date)->format('F d, Y') }} | {{ \Carbon\Carbon::parse($event->start_time)->format('h:i A') }}</td>
                                                        <td>{{ $event->venue }}</td>
                                                        <td>{{ $event->club->name }}</td>
                                                        <td>
                                                        <a href="#" type="button" data-toggle="modal" data-target="#iconModal" onclick="setModalImage('{{ asset('images/event_images/' . $event->image) }}', '{{ $event->name }}')">
                                                            <img src="{{ asset('images/event_images/' . $event->image) }}" class="rounded-circle img-thumbnail" style="width: 50px; height: 50px;">
                                                        </a>
                                                        </td>
                                                        <td>
                                                            <a href="events/view/{{ $event->id }}" style="margin:1px">
                                                                <button type="button" class="btn btn-primary btn-sm">View</button>
                                                            </a>
                                                            <a href="events/edit/{{ $event->id }}" style="margin:1px">
                                                                <button type="button" class="btn btn-warning btn-sm">Edit</button>
                                                            </a>
                                                            <a href="events/delete/{{ $event->id }}" class="delete-events" data-id="{{ $event->id }}"
                                                                onclick="confirmDelete({{ $event->id }})">
                                                                <button type="button" class="btn btn-danger btn-sm">Delete</button>
                                                            </a>
                                                            @if($event->status == 0)
                                                            <form id="approveRejectForm" action="{{ route('events.approveReject') }}" method="POST" style="margin:2px">
                                                                @csrf
                                                                <button type="button" class="btn btn-success btn-sm approve-btn" data-id="{{ $event->id }}">Approve</button>
                                                                <button type="button" class="btn btn-secondary btn-sm reject-btn" data-id="{{ $event->id }}">Reject</button>
                                                                <input type="hidden" id="approvalStatus" name="approval_status">
                                                                <input type="hidden" id="dataId" name="data_id">
                                                            </form>
                                                            @endif

    
                                                        </td>
                                                    </tr>
                                                    @endforeach
                                                @else
                                                @foreach($specific_events as $specific_event)
                                                    <tr>
                                                        <td>{{ $loop->iteration }}</td>
                                                        <td>{{ $specific_event->name }} 
                                                            @if($specific_event->status == 1)
                                                                <span class="badge badge-success">Approved</span>
                                                            @elseif($specific_event->status == 2)
                                                                <span class="badge badge-danger">Rejected</span>
                                                            @else
                                                                <span class="badge badge-secondary">Pending</span>
                                                            @endif
                                                        </td>
                                                        <td>{{ \Carbon\Carbon::parse($specific_event->start_date)->format('F d, Y') }} | {{ \Carbon\Carbon::parse($specific_event->start_time)->format('h:i A') }}</td>
                                                        <td>{{ $specific_event->venue }}</td>
                                                        <td>{{ $specific_event->club->name }}</td>
                                                        <td>
                                                        <a href="#" type="button" data-toggle="modal" data-target="#iconModal" onclick="setModalImage('{{ asset('images/event_images/' . $specific_event->image) }}', '{{ $specific_event->name }}')">
                                                            <img src="{{ asset('images/event_images/' . $specific_event->image) }}" class="rounded-circle img-thumbnail" style="width: 50px; height: 50px;">
                                                        </a>
                                                        </td>
                                                        <td>
                                                            <a href="events/view/{{ $specific_event->id }}" style="margin:1px">
                                                                <button type="button" class="btn btn-primary btn-sm">View</button>
                                                            </a>
                                                            <a href="events/edit/{{ $specific_event->id }}" style="margin:1px">
                                                                <button type="button" class="btn btn-warning btn-sm">Edit</button>
                                                            </a>
                                                            <a href="events/delete/{{ $specific_event->id }}" class="delete-events" data-id="{{ $specific_event->id }}"
                                                                onclick="confirmDelete({{ $specific_event->id }})">
                                                                <button type="button" class="btn btn-danger btn-sm">Delete</button>
                                                            </a>
                                                        </td>
                                                    </tr>
                                                    @endforeach
                                                @endif
                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                <th>S.No</th>
                                                    <th>Title</th>
                                                    @if(Auth::user()->role == 'admin') 
                                                        <th>Coordinator</th>
                                                    @endif
                                                    <th>Start Date & Time</th>
                                                    <th>Venue</th>
                                                    <th>Club</th>
                                                    <th>Image</th>
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

    <!-- Modal -->
    <div class="modal fade text-left" id="iconModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel2" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <!-- Dynamic modal title -->
                    <h4 class="modal-title text-center" id="modalTitle"><i class="la la-road2"></i></h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- Image displayed here -->
                    <img id="modalImage" src="" class="img-fluid">
                </div>
            </div>
        </div>
    </div>
    @include('includes.footer') 
    <script>
        $('.delete-events').click(function(event) {
            event.preventDefault(); // Prevent the default action (i.e., following the link)

            var event = $(this).data('id'); // Get the coordinator ID from the data attribute

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
                    window.location.href = '/events/delete/' + event;
                }
            });
        });

        function setModalImage(imageUrl, title) {
            document.getElementById('modalImage').src = imageUrl;
            document.getElementById('modalTitle').innerHTML = title;
        }
        
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

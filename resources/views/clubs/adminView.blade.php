@include('includes.head')

<!-- BEGIN: Body-->
<style>
.tabs {
    margin-top: 20px;
}

.tab-buttons {
    display: flex;
}

.tab-btn {
    padding: 10px 20px;
    border: none;
    background-color: #f0f0f0;
    cursor: pointer;
    transition: background-color 0.3s;
}

.tab-btn.active {
    background-color: #ccc;
}

.tab-content .tab {
    display: none;
    padding: 10px;
}

.tab-content .tab.active {
    display: block;
}

.tab-buttons .col-md-3 {
    margin-right: 0; /* Remove right margin for the first button */
}

.tab-buttons .col-md-2 {
    margin-left: -15px; /* Adjust left margin for the second button to compensate */
}

.custom-gap {
    margin-left: 10px; /* Adjust the value as needed */
}



</style>
<body class="vertical-layout vertical-menu-modern 2-columns   fixed-navbar" data-open="click" data-menu="vertical-menu-modern" data-col="2-columns">
    
    @include('includes.header')
    


    @include('includes.sidemenu')
    <!-- BEGIN: Content-->
    <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="content-wrapper">
        <div class="content-header row">
                <div class="content-header-left col-md-6 col-12 mb-2 breadcrumb-new">
                    <h3 class="content-header-title mb-0 d-inline-block">Club</h3>
                    <div class="row breadcrumbs-top d-inline-block">
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="index.html">EventifyU</a>
                                </li>
                                <li class="breadcrumb-item active">Club
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>
                <div class="content-header-right col-md-6 col-12">
                    <div class="btn-group float-md-right">
                        <a href="{{ route('clubs.add') }}">
                        <button class="btn btn-info mb-1" type="button">Create New Club</button>
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
                                <div class="card-content collapse show">
                                    <div class="card-body card-dashboard dataTables_wrapper dt-bootstrap">
                                        <div class="container">
                                            <div class="row mb-1 tabs">
                                                <div class="col-md-8 mb-2 tab-buttons">
                                                    <button class="btn tab-btn btn-secondary active" width="500px" data-tab="#club_info">Club Info </button>
                                                    <button class="btn tab-btn btn-outline-secondary custom-gap" width="500px" data-tab="#associated_members">Associated Members</button>
                                                    <button class="btn tab-btn btn-outline-secondary custom-gap" width="500px" data-tab="#associated_coordinators">Associated Coordinators</button>
                                                    <button class="btn tab-btn btn-outline-secondary custom-gap" width="500px" data-tab="#associated_events">Associated Events</button>
                                                    <button class="btn tab-btn btn-outline-secondary custom-gap" width="500px" data-tab="#members_requests">Members Request</button>
                                                </div>
                                            </div>
                                            <div class="tab-content">
                                                <div class="tab active" id="club_info">
                                                    <h1 class="text-center" style="font-size:50px">{{ $club->name }}</h1>
                                                    <hr>
                                                    <div class="row">
                                                        <div class="col-md-6 text-center">    
                                                            <img src="{{ asset('images/club_logos/' . $club->logo) }}"  class="img-fluid img-responsive" style="height:300px">
                                                        </div>
                                                        
                                                        <div class="col-md-6 mt-1 text-center">
                                                        {{ $club->description }}
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                                <div class="tab" id="associated_coordinators">
                                                    <h3>Associated Coordinators</h3>
                                                    <hr>
                                                    <table class="table table-striped table-bordered file-export" id="attendeeTable">
                                                        <thead>
                                                            <tr>
                                                                <th>S.No</th>
                                                                <th>Name</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @foreach($coordinators as $coordinator)
                                                            <tr>
                                                                <td>{{ $loop->iteration }}</td>
                                                                <td><a href="../../coordinators/view/{{ $coordinator->id }}">{{ $coordinator->name }}</td>
                                                            </tr>
                                                            @endforeach
                                                        </tbody>
                                                        <tfoot>
                                                            <tr>
                                                                <th>S.No</th>
                                                                <th>Name</th>
                                                            </tr>
                                                        </tfoot>
                                                    </table>
                                                </div>

                                                <div class="tab" id="associated_members">
                                                    <h3>Associated Members</h3>
                                                    <hr>
                                                    <table class="table table-striped table-bordered file-export" id="attendeeTable">
                                                        <thead>
                                                            <tr>
                                                                <th>S.No</th>
                                                                <th>Name</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @foreach($members as $user)
                                                            <tr>
                                                                <td>{{ $loop->iteration }}</td>
                                                                <td><a href="../../students/view/{{ $user->id }}">{{ $user->name }}</td>
                                                            </tr>
                                                            @endforeach
                                                        </tbody>
                                                        <tfoot>
                                                            <tr>
                                                                <th>S.No</th>
                                                                <th>Name</th>
                                                            </tr>
                                                        </tfoot>
                                                    </table>
                                                </div>

                                                <div class="tab" id="associated_events">
                                                    <h3>Associated Events</h3>
                                                    <hr>
                                                    <table class="table table-striped table-bordered file-export" id="attendeeTable">
                                                        <thead>
                                                            <tr>
                                                                <th>S.No</th>
                                                                <th>Name</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @foreach($events as $event)
                                                            <tr>
                                                                <td>{{ $loop->iteration }}</td>
                                                                <td><a href="../../event/view/{{ $event->id }}">{{ $event->name }}</a></td>
                                                            </tr>
                                                            @endforeach
                                                        </tbody>
                                                        <tfoot>
                                                            <tr>
                                                                <th>S.No</th>
                                                                <th>Name</th>
                                                            </tr>
                                                        </tfoot>
                                                    </table>
                                                </div>
                                                <div class="tab" id="members_requests">
                                                    <h3>Members Request</h3>
                                                    <hr>
                                                    <table class="table table-striped table-bordered file-export" id="attendeeTable">
                                                        <thead>
                                                            <tr>
                                                                <th>S.No</th>
                                                                <th>Name</th>
                                                                <th>Action</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                                @foreach($membersRequests as $membersRequest)
                                                                <tr>
                                                                    <td>{{ $loop->iteration }}</td>
                                                                    <td>{{ $membersRequest->name }}</td>
                                                                    <td>
                                                                        <form id="approveRejectForm" action="{{ route('clubs.approveReject') }}" method="POST" style="margin:2px;">
                                                                            @csrf
                                                                            <button type="button" class="btn btn-success btn-sm approve-btn" data-id="{{ $membersRequest->id }}">Approve</button>
                                                                            <button type="button" class="btn btn-danger btn-sm reject-btn" data-id="{{ $membersRequest->id }}">Reject</button>
                                                                            <input type="hidden" id="approvalStatus" name="approval_status">
                                                                            <input type="hidden" id="dataId" name="data_id">
                                                                            <input type="hidden" id="clubId" name="clubId" value="{{ $club->id }}">
                                                                        </form>
                                                                    </td>
                                                                </tr>
                                                                @endforeach
                                                        </tbody>
                                                        <tfoot>
                                                            <tr>
                                                                <th>S.No</th>
                                                                <th>Name</th>
                                                                <th>Action</th>
                                                            </tr>
                                                        </tfoot>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
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
        $('.tab-btn').on('click', function() {
            var tabId = $(this).data('tab');

            // Remove 'active' class from all buttons and add 'btn-outline-secondary' class
            $('.tab-btn').removeClass('active btn-secondary').addClass('btn-outline-secondary');

            // Add 'active' class to the clicked button and change its style
            $(this).addClass('active btn-secondary').removeClass('btn-outline-secondary');

            // Show/Hide Tabs
            $('.tab-content ' + tabId).show().siblings().hide();
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
            $('#clubId').val();
            $('#approveRejectForm').submit();
        }
    </script>


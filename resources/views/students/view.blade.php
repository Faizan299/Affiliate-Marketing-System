@include('includes.head')
<link rel="stylesheet" type="text/css" href="../../../app-assets/vendors/css/forms/selects/select2.min.css">

<!-- BEGIN: Body-->
<body class="vertical-layout vertical-menu-modern 2-columns   fixed-navbar" data-open="click" data-menu="vertical-menu-modern" data-col="2-columns">
    
@include('includes.header')
    
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

    @include('includes.sidemenu')
    <!-- BEGIN: Content-->
    <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-md-6 col-12 mb-2 breadcrumb-new">
                    <h3 class="content-header-title mb-0 d-inline-block">Event</h3>
                    <div class="row breadcrumbs-top d-inline-block">
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="index.html">EventifyU</a>
                                </li>
                                <li class="breadcrumb-item active">Event 
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>

                <div class="content-header-right col-md-6 col-12">
                    <div class="btn-group float-md-right">
                        @if(Auth::user()->role == 'admin')
                            <a href="{{ route('events.add') }}">
                            <button class="btn btn-info mb-1" type="button">Manage Events</button>
                            </a>
                        @endif
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12 col-md-12">

                    <!-- Road Trip Card -->

                    <div class="card">
                        <div class="card-body">
                            <div class="row mb-1 tabs">
                                <div class="col-md-8 mb-2 tab-buttons">
                                    <button class="btn tab-btn btn-secondary active" width="200px" data-tab="#student_info">Student Info </button>
                                    <button class="btn tab-btn btn-outline-secondary custom-gap" width="200px" data-tab="#associated_clubs">Associated Clubs</button>
                                    <button class="btn tab-btn btn-outline-secondary custom-gap" width="200px" data-tab="#attended_ecents">Attended Events</button>
                                </div>
                            </div>
                            <div class="tab-content">
                                <div class="tab active" id="student_info">
                                    <div class="row">
                                        <div class="col-12">
                                            <h5 class="mb-1"><i class="ft-info"></i> Personal Info</h5>
                                            <table class="table table-borderless">
                                                <tbody>
                                                    <tr>
                                                        <td>Name:</td>
                                                        <td class="users-view-username">{{ $student->name }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Student Id:</td>
                                                        <td class="users-view-name">{{ $student->student_id }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td>E-mail:</td>
                                                        <td class="users-view-email">{{ $student->email }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Phone:</td>
                                                        <td>{{ $student->phone }}</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab" id="associated_clubs">
                                    <div class="row">
                                        <div class="col-12">
                                            <h5 class="mb-1"><i class="ft-info"></i> Associated Clubs</h5>
                                            <table class="table table-striped table-bordered file-export">
                                            <thead>
                                                <tr>
                                                    <th>S.No</th>
                                                    <th>Club</th>
                                                    <th>Image</th>
                                                </tr>
                                            </thead>
                                                <tbody>
                                                    @foreach($clubs as $club)
                                                        <tr>
                                                            <td>{{ $loop->iteration }}</td>
                                                            <td>{{ $club->name }}</td>
                                                            <td>
                                                                <a href="#" type="button" data-toggle="modal" data-target="#iconModal" onclick="setModalImage('{{ asset('images/club_logos/' . $club->logo) }}', '{{ $club->name }}')">
                                                                    <img src="{{ asset('images/club_logos/' . $club->logo) }}" class="rounded-circle img-thumbnail" style="width: 50px; height: 50px;">
                                                                </a>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            <tfoot>
                                                <tr>
                                                    <th>S.No</th>
                                                    <th>Club</th>
                                                    <th>Image</th>
                                                </tr>
                                            </tfoot>
                                        </table>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab" id="attended_ecents">
                                    <div class="row">
                                        <div class="col-12">
                                            <h5 class="mb-1"><i class="ft-info"></i> Attended Events</h5>
                                            <table class="table table-striped table-bordered file-export">
                                            <thead>
                                                <tr>
                                                    <th>S.No</th>
                                                    <th>Club</th>
                                                    <th>Image</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                    
                                            <tfoot>
                                                <tr>
                                                    <th>S.No</th>
                                                    <th>Club</th>
                                                    <th>Image</th>
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
        </div>
    </div>
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
    <!-- END: Content-->
    @include('includes.footer') 
    <script src="../../../app-assets/vendors/js/forms/select/select2.full.min.js"></script>
    <!-- END: Page Vendor JS-->

    <!-- BEGIN: Page JS-->
    <script src="../../../app-assets/js/scripts/forms/select/form-select2.js"></script>

    <script>
        function setModalImage(imageUrl, title) {
            document.getElementById('modalImage').src = imageUrl;
            document.getElementById('modalTitle').innerHTML = title;
        }
        $(document).ready(function() {
            $('#registerButton').click(function() {
                const eventId = $(this).data('id');
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, Register Me'
                }).then((result) => {
                if (result.value) {
                        $.ajax({
                            url: '/event/register/',
                            method: 'POST',
                            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                            data: {
                                "eventId" : eventId,
                            },
                            success: function(response) {
                                    Swal.fire(
                                        'Registered',
                                        'Registered Successfully',
                                        'success'
                                    ).then(function () {
                                        location.reload();
                                    })
                            },
                        });
                    }
                })
            });
            $('.tab-btn').on('click', function() {
                var tabId = $(this).data('tab');

                // Remove 'active' class from all buttons and add 'btn-outline-secondary' class
                $('.tab-btn').removeClass('active btn-secondary').addClass('btn-outline-secondary');

                // Add 'active' class to the clicked button and change its style
                $(this).addClass('active btn-secondary').removeClass('btn-outline-secondary');

                // Show/Hide Tabs
                $('.tab-content ' + tabId).show().siblings().hide();
            });
        });
        
    </script>
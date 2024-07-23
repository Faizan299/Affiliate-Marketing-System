@include('includes.sub_head')
<!-- BEGIN: Body-->

<body class="horizontal-layout horizontal-menu 2-columns  " data-open="hover" data-menu="horizontal-menu" data-col="2-columns">
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

</style>
@include('includes.sub_header')
    

    <!-- END: Main Menu-->
    <!-- BEGIN: Content-->
    <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="content-wrapper">
            <!-- Simple User Cards with Border-->
            <div class="content-header row">
                <div class="content-header-left col-md-6 col-12 mb-2 breadcrumb-new">
                    <h3 class="content-header-title mb-0 d-inline-block"></h3>
                </div>
                <div class="content-header-right col-md-6 col-12">
                    <div class="btn-group float-md-right">
                        <a href="{{ route('clubs.index') }}">
                        <button class="btn btn-info mb-1" type="button">Go Back</button>
                        </a>
                    </div>
                </div>
            </div>  
            <div class="content-body">
                <div class="row">
                    <div class="col-md-12 col-sm-12">
                        <div class="card mt-2">
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <h4 class="card-title mb-0" style="font-size: 30px;">{{ $club->name }}</h4>
                                <div class="d-flex">
                                    <div class="tabs d-flex">
                                        <!-- Place your buttons here -->
                                        <div class="tab-buttons">
                                            <button type="button" class="btn btn-outline-secondary mx-1 tab-btn" data-tab="#club_info">Club Info</button>
                                        </div>
                                        <div class="">
                                            <button type="button" class="btn btn-outline-secondary mx-1 tab-btn" data-tab="#members_list">Members list</button>
                                        </div>
                                        <!-- Add more buttons as needed -->
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div class="card-body">
                                <div class="tab-content">
                                    <div class="tab active" id="club_info">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <img class=" img-fluid" src="{{ asset('images/club_logos/' . $club->logo) }}" alt="Card image cap">
                                                Since {{ $club->created_at->format('M j, Y') }}
                                            </div>
                                            <div class="col-md-6 col-sm-12 mt-2">
                                                <h2>Description</h2>
                                                <p style="font-size:15px">{!! nl2br(e($club->description)) !!}</p>
                                                
                                                @if($pendingClubs != '' && in_array($club->id, $pendingClubs))
                                                    <p class="bg-secondary text-center p-1" style="color:#fff">Your request to join the club is pending approval from the admin</p>
                                        
                                                @elseif($rejectedClubs != '' && in_array($club->id, $rejectedClubs))
                                                <p class="bg-danger text-center p-1" style="color:#fff">Your request to join the club has been rejected</p>
                                                
                                                @elseif($clubs != '' && in_array($club->id, $clubs))
                                                <p class="bg-success text-center p-1" style="color:#fff">You are Already a Member</p>
                                                
                                                @else
                                                <button class="btn btn-success btn-block" data-id="{{ $club->id }}" id="registerButton">Request For Join {{ $club->name }}</button>
                                                
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab" id="members_list">
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
                                                    <td>{{ $user->name }}</td>
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
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    @include('includes.sub_footer')

    <script>
        $('.tab-btn').on('click', function() {
                var tabId = $(this).data('tab');
                console.log(tabId)
                // Remove 'active' class from all buttons and add 'btn-outline-secondary' class
                $('.tab-btn').removeClass('active btn-secondary').addClass('btn-outline-secondary');

                // Add 'active' class to the clicked button and change its style
                $(this).addClass('active btn-secondary').removeClass('btn-outline-secondary');

                // Show/Hide Tabs
                $('.tab-content ' + tabId).show().siblings().hide();
            });
        $(document).ready(function() {
            

            $('#registerButton').click(function() {
                const clubId = $(this).data('id');
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
                            url: '/club/register/',
                            method: 'POST',
                            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                            data: {
                                "clubId" : clubId,
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
        });
    </script>
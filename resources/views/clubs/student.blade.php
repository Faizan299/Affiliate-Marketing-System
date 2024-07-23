@include('includes.sub_head')
<!-- BEGIN: Body-->

<body class="horizontal-layout horizontal-menu 2-columns  " data-open="hover" data-menu="horizontal-menu" data-col="2-columns">
    
@include('includes.sub_header')
    

    <!-- END: Main Menu-->
    <!-- BEGIN: Content-->
    <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="content-wrapper">
            <!-- Simple User Cards with Border-->
            <div class="content-body">
            <section id="simple-user-cards-with-border" class="row mt-2">
    <div class="col-12">
        <h3 class="text-uppercase">My Clubs</h3>
    </div>

    <!-- Clubs You Haven't Requested to Join Yet -->
    <div class="col-12 mt-3">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Clubs You Have Joined</h4>
            </div>
            <div class="card-body">
                <div class="row">
                    @php
                        $joinedClubs = $clubs->filter(function($club) use ($approvedClubs) {
                            return in_array($club->id, $approvedClubs);
                        });
                    @endphp

                    @if($joinedClubs->isEmpty())
                        <div class="col-12">
                            <div class="alert alert-info text-center">
                                <p class="mt-1" style="font-size:25px">No clubs joined yet</p>
                            </div>
                        </div>
                    @else
                        @foreach($joinedClubs as $myClub)
                            <div class="col-xl-3 col-md-6 col-12">
                                <div class="card border-teal border-lighten-2">
                                    <div class="text-center">
                                        <div class="card-body">
                                            <img src="{{ asset('images/club_logos/' . $myClub->logo) }}" class="rounded-circle height-150 img-responsive" alt="Card image">
                                        </div>
                                        <div class="card-body">
                                            <h4 class="card-title">{{ $myClub->name }}</h4>
                                            <h6 class="card-subtitle text-muted">{{ $myClub->created_at->format('M j, Y') }}</h6>
                                            <h5 class="card-subtitle mt-1 text-success"><span class="badge badge-success">Joined</span></h5>
                                        </div>
                                        <div class="text-center">
                                            <a href="clubs/view/{{ $myClub->id }}" class="btn mb-1 btn-outline-facebook">View Details</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Clubs You Have Joined -->
    <div class="col-12 mt-3">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Clubs You Haven't Requested to Join Yet</h4>
            </div>
            <div class="card-body">
                <div class="row">
                    @php
                        $notRequestedClubs = $clubs->filter(function($club) use ($pendingClubs, $rejectedClubs, $approvedClubs) {
                            return !in_array($club->id, $pendingClubs) && !in_array($club->id, $rejectedClubs) && !in_array($club->id, $approvedClubs);
                        });
                    @endphp

                    @if($notRequestedClubs->isEmpty())
                        <div class="col-12">
                            <div class="alert alert-info text-center">
                                <p class="mt-1" style="font-size:25px">No clubs available to request.</p>
                            </div>
                        </div>
                    @else
                        @foreach($notRequestedClubs as $myClub)
                            <div class="col-xl-3 col-md-6 col-12">
                                <div class="card border-teal border-lighten-2">
                                    <div class="text-center">
                                        <div class="card-body">
                                            <img src="{{ asset('images/club_logos/' . $myClub->logo) }}" class="rounded-circle height-150 img-responsive" alt="Card image">
                                        </div>
                                        <div class="card-body">
                                            <h4 class="card-title">{{ $myClub->name }}</h4>
                                            <h6 class="card-subtitle text-muted">{{ $myClub->created_at->format('M j, Y') }}</h6>
                                        </div>
                                        <div class="text-center">
                                            <a href="clubs/view/{{ $myClub->id }}" class="btn mb-1 btn-outline-facebook">View Details</a>
                                            <button data-id="{{ $myClub->id }}" class="btn mb-1 btn-info registerButton">Request Join</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Clubs You've Requested to Join -->
    <div class="col-12 mt-3">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Clubs You've Requested to Join</h4>
            </div>
            <div class="card-body">
                <div class="row">
                    @php
                        $requestedClubs = $clubs->filter(function($club) use ($pendingClubs) {
                            return in_array($club->id, $pendingClubs);
                        });
                    @endphp

                    @if($requestedClubs->isEmpty())
                        <div class="col-12">
                            <div class="alert alert-info text-center">
                                <p class="mt-1" style="font-size:25px">No join requests pending.</p>
                            </div>
                        </div>
                    @else
                        @foreach($requestedClubs as $myClub)
                            <div class="col-xl-3 col-md-6 col-12">
                                <div class="card border-teal border-lighten-2">
                                    <div class="text-center">
                                        <div class="card-body">
                                            <img src="{{ asset('images/club_logos/' . $myClub->logo) }}" class="rounded-circle height-150 img-responsive" alt="Card image">
                                        </div>
                                        <div class="card-body">
                                            <h4 class="card-title">{{ $myClub->name }}</h4>
                                            <h6 class="card-subtitle text-muted">{{ $myClub->created_at->format('M j, Y') }}</h6>
                                            <h5 class="card-subtitle mt-1 text-success"><span class="badge badge-secondary">Pending</span></h5>
                                        </div>
                                        <div class="text-center">
                                            <a href="clubs/view/{{ $myClub->id }}" class="btn mb-1 btn-outline-facebook">View Details</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Clubs You've Been Rejected From -->
    <div class="col-12 mt-3">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Clubs You've Been Rejected From</h4>
            </div>
            <div class="card-body">
                <div class="row">
                    @php
                        $rejectedClubsList = $clubs->filter(function($club) use ($rejectedClubs) {
                            return in_array($club->id, $rejectedClubs);
                        });
                    @endphp

                    @if($rejectedClubsList->isEmpty())
                        <div class="col-12">
                            <div class="alert alert-info text-center">
                                <p class="mt-1" style="font-size:25px">No rejections.</p>
                            </div>
                        </div>
                    @else
                        @foreach($rejectedClubsList as $myClub)
                            <div class="col-xl-3 col-md-6 col-12">
                                <div class="card border-teal border-lighten-2">
                                    <div class="text-center">
                                        <div class="card-body">
                                            <img src="{{ asset('images/club_logos/' . $myClub->logo) }}" class="rounded-circle height-150 img-responsive" alt="Card image">
                                        </div>
                                        <div class="card-body">
                                            <h4 class="card-title">{{ $myClub->name }}</h4>
                                            <h6 class="card-subtitle text-muted">{{ $myClub->created_at->format('M j, Y') }}</h6>
                                            <h5 class="card-subtitle mt-1 text-danger"><span class="badge badge-danger">Rejected</span></h5>
                                        </div>
                                        <div class="text-center">
                                            <a href="clubs/view/{{ $myClub->id }}" class="btn mb-1 btn-outline-facebook">View Details</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
    </div>
</section>
            </div>
        </div>
    </div>
    
@include('includes.sub_footer')

<script>
    $(document).ready(function(){
        $('.registerButton').click(function() {
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
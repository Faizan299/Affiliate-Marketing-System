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
                <section id="tickets">
                    <div class="row">
                        <div class="col-lg-12 col-md-12">
                            <div class="card">
                                <!-- <div class="card-header"> -->
                                    <!-- <h2 class="card-title">Explore the Event</h2> -->
                                <!-- </div> -->
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="media-list media-bordered">
                                                <div class="time mb-3">
                                                    <h1>{{ $event->name }}</h1>
                                                </div>
                                                <table class="table table">
                                                    <tbody>
                                                        <tr>
                                                            <th scope="row"><h4>Associated Club</h4></th>
                                                            <td><h4>{{ $event->club->name }}</h4></td>
                                                        </tr>
                                                        <tr>
                                                            <th scope="row"><h4>Start Date</h4></th>
                                                            <td><h4>{{ \Carbon\Carbon::parse($event->start_date)->format('F d, Y') }}
                                                    | {{ \Carbon\Carbon::parse($event->start_time)->format('h:i A') }}</h4></td>
                                                        </tr>
                                                        <tr>
                                                            <th scope="row"><h4>End Date</h4></th>
                                                            <td><h4>{{ \Carbon\Carbon::parse($event->end_date)->format('F d, Y') }}
                                                    | {{ \Carbon\Carbon::parse($event->end_time)->format('h:i A') }}</h4></td>
                                                        </tr>
                                                        <tr>
                                                            <th scope="row"><h4>Venue</h4></th>
                                                            <td><h4>{{ $event->venue }}</h4></td>
                                                        </tr>
                                                        <tr>
                                                            <th scope="row"><h4>No. of Attendees</h4></th>
                                                            <td><h4>{{ $attendeeCount }}</h4></td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                                @if($isAttendee)
                                                <p class="badge badge-success" style="font-size:15px">Attended Successfully!</p>
                                                @endif

                                                @if($isLiveEvent && $isUserAttendee && !$isAttendee)
                                                    <p class="badge badge-success" style="font-size:15px">Event is Live Now!</p>
                                                @endif

                                                @if($eventAttendees && !$isLiveEvent)
                                                    <span class="text-success text-dark badge badge-success" style="font-size: 15px">You have Registered for this Event 
                                                    <i class="la la-check"></i> </span>
                                                @endif

                                                @if(!$isLiveEvent && !$isUserAttendee)
                                                    <button class="btn btn-info" data-id="{{ $event->id }}" id="registerButton">Register Me</button>
                                                @endif

                                                @if($isLiveEvent && !$isUserAttendee)
                                                    <p class="badge badge-secondary" style="font-size:15px">You were not registserd for this event</p><br>
                                                    <p class="badge badge-success" style="font-size:15px">Event is Live Now!</p>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <img src="{{ asset('images/event_images/' . $event->image) }}" class="img-responsive img-fluid rounded" alt="sd">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
            <div class="content-body">
                <section id="tickets">
                    <div class="row">
                        <div class="col-lg-12 col-md-12">
                            <div class="card">
                                <!-- <div class="card-header"> -->
                                    <!-- <h2 class="card-title">Explore the Event</h2> -->
                                <!-- </div> -->
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="media-list media-bordered">
                                                <div class="time mb-3">
                                                    <h1>Description</h1>
                                                </div>
                                        </div>
                                        <div class="col-md-6">
                                            {{ $event->description }}
                                        </div>
                                    </div>
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
        
        $('#mark_attendance').click(function() {
            const eventId = $(this).data('id');
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, Mark My Attendance'
            }).then((result) => {
            if (result.value) {
                    $.ajax({
                        url: '/event/attendance/',
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
    </script>
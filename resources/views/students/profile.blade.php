@include('includes.sub_head')

    @include('includes.sub_header')
    


    <!-- BEGIN: Content-->
    <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="content-wrapper">
        <div class="content-header row">
               
                
            </div>
            <div class="content-body">
                <!-- users edit start -->
                @if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

@if (session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif
                <section class="users-edit">
                    <div class="card">
                        <div class="card-content">
                            <div class="card-body">
                                <ul class="nav nav-tabs mb-2" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link d-flex align-items-center active" id="dashbaord-tab" data-toggle="tab" href="#dashboard" aria-controls="dashboard" role="tab" aria-selected="false">
                                            <i class="ft-info mr-25"></i><span class="d-none d-sm-block">Dashboard</span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link d-flex align-items-center" id="account-tab" data-toggle="tab" href="#account" aria-controls="account" role="tab" aria-selected="true">
                                            <i class="ft-user mr-25"></i><span class="d-none d-sm-block">Account</span>
                                        </a>
                                    </li>
                                </ul>
                                <div class="tab-content">
                                    <div class="tab-pane active" id="dashboard" aria-labelledby="dashboard-tab" role="tabpanel">
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="card">
                                                    <div class="card-content">
                                                        <div class="row">
                                                            <div class="col border-right-blue-grey border-right-lighten-4">
                                                                <div class="card-body text-center">
                                                                    <h1 class="display-4">{{ $clubCount }}</h1>
                                                                    <span>Total Clubs</span>
                                                                </div>
                                                            </div>
                                                            <div class="col border-right-blue-grey border-right-lighten-4">
                                                                <div class="card-body text-center">
                                                                    <h1 class="display-4">{{ $pendingClubsCount }}</h1>
                                                                    <span>Requested Clubs</span>
                                                                </div>
                                                            </div>
                                                            <div class="col border-right-blue-grey border-right-lighten-4">
                                                                <div class="card-body text-center">
                                                                    <h1 class="display-4">{{ $rejectedClubsCount }}</h1>
                                                                    <span>Rejected Clubs</span>
                                                                </div>
                                                            </div>
                                                            <div class="col border-right-blue-grey border-right-lighten-4">
                                                                <div class="card-body text-center">
                                                                    <h1 class="display-4">{{ $approvedclubsCount }}</h1>
                                                                    <span>Approved Clubs</span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="card">
                                                    <div class="card-content">
                                                        <div class="row">
                                                            <div class="col border-right-blue-grey border-right-lighten-4">
                                                                <div class="card-body text-center">
                                                                    <h1 class="display-4">{{ $upcomingStudentEvents }}</h1>
                                                                    <span>Total Events</span>
                                                                </div>
                                                            </div>
                                                            <div class="col border-right-blue-grey border-right-lighten-4">
                                                                <div class="card-body text-center">
                                                                    <h1 class="display-4">{{ $studentScore }}</h1>
                                                                    <span>Attended Events</span>
                                                                </div>
                                                            </div>
                                                            <div class="col border-right-blue-grey border-right-lighten-4">
                                                                <div class="card-body text-center">
                                                                    <h1 class="display-4">{{ $eventScore }}</h1>
                                                                    <span>Total Score</span>
                                                                </div>
                                                            </div>
                                                            <div class="col border-right-blue-grey border-right-lighten-4">
                                                                <div class="card-body text-center">
                                                                    <h1 class="display-4">{{ $upcomingEvents }}</h1>
                                                                    <span>Upcoming Events</span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane" id="account" aria-labelledby="account-tab" role="tabpanel">
                                    <form action="{{ route('profile.update', ['id' => Auth::user()->id]) }}" method="POST">
                                         
                                            @csrf
                                            <div class="row">
                                                <div class="col-12 col-sm-6">
                                                    <div class="form-group">
                                                        <div class="controls">
                                                            <label>Name</label>
                                                            <input type="text" name="name" class="form-control" placeholder="Username" value="{{ $student->name }}" required data-validation-required-message="This username field is required">
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <div class="controls">
                                                            <label>Email</label>
                                                            <input type="text" class="form-control" placeholder="Name" value="{{ $student->email }}" readonly required data-validation-required-message="This name field is required">
                                                        </div>
                                                    </div>
                                                    <div class="controls">
                                                        <label>Phone</label>
                                                        <input type="text" name="phone" class="form-control" placeholder="Name" value="{{ $student->phone }}" required data-validation-required-message="This name field is required">
                                                    </div>
                                                </div>
                                                <div class="col-12 col-sm-6">
                                                    <div class="controls mb-2">
                                                        <label>Student Id</label>
                                                        <input type="text" class="form-control" readonly placeholder="Name" value="{{ $student->student_id }}" required data-validation-required-message="This name field is required">
                                                    </div>
                                                    <div class="controls mb-2">
                                                        <label>Course</label>
                                                        <input type="text" name="course" class="form-control" placeholder="Name" value="{{ $student->course }}"  required data-validation-required-message="This name field is required">
                                                    </div>
                                                    <div class="controls">
                                                        <label>Role</label>
                                                        <input type="text" readonly class="form-control" placeholder="Name" value="{{ ucfirst($student->role) }}" required data-validation-required-message="This name field is required">
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                </div>
                                                <div class="col-12 d-flex flex-sm-row flex-column justify-content-end mt-1">
                                                    <button type="submit" class="btn btn-primary glow mb-1 mb-sm-0 mr-0 mr-sm-1">Save
                                                        changes</button>
                                                </div>
                                            </div>
                                        </form>
                                        <!-- users edit account form ends -->
                                    </div>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <!-- users edit ends -->
            </div>
        </div>
    </div>
    <!-- END: Content-->

    @include('includes.sub_footer')
<!-- BEGIN: Header-->
<nav class="header-navbar navbar-expand-md navbar navbar-with-menu navbar-without-dd-arrow navbar-static-top navbar-light navbar-brand-center">
        <div class="navbar-wrapper">
            <div class="navbar-header">
                <ul class="nav navbar-nav flex-row">
                    <li class="nav-item mobile-menu d-md-none mr-auto"><a class="nav-link nav-menu-main menu-toggle hidden-xs" href="#"><i class="ft-menu font-large-1"></i></a></li>
                    <li class="nav-item"><a class="navbar-brand" href="index.html"><img class="brand-logo" alt="modern admin logo" src="../../../app-assets/images/logo/logo.png">
                            <h3 class="brand-text">EventifyU</h3>
                        </a></li>
                    <li class="nav-item d-md-none"><a class="nav-link open-navbar-container" data-toggle="collapse" data-target="#navbar-mobile"><i class="la la-ellipsis-v"></i></a></li>
                </ul>
            </div>
            <div class="navbar-container content">
                <div class="collapse navbar-collapse" id="navbar-mobile">
                    <ul class="nav navbar-nav mr-auto float-left">
                        <li class="nav-item d-none d-md-block"><a class="nav-link nav-menu-main menu-toggle hidden-xs" href="#"><i class="ft-menu"></i></a></li>
                        <li class="nav-item d-none d-lg-block"><a class="nav-link nav-link-expand" href="#"><i class="ficon ft-maximize"></i></a></li>
                    </ul>
                    <ul class="nav navbar-nav float-right">
                        @include('notifications.component')
                        
                        <li class="dropdown dropdown-notification nav-item">
                            <!-- <a class="nav-link nav-link-label" href="#" data-toggle="dropdown">Score<span class="badge badge-pill badge-danger badge-up badge-glow">5</span></a> -->
                            <a class="nav-link nav-link-label" href="#" data-toggle="dropdown">Event Score: {{ $eventScore }}</a>

                        
                        </li>
                        <li class="dropdown dropdown-user nav-item"><a class="dropdown-toggle nav-link dropdown-user-link" href="#" data-toggle="dropdown"><span class="mr-1 user-name text-bold-700">{{ Auth::user()->name }}</span><span class="avatar avatar-online"><img src="../../../app-assets/images/portrait/small/avatar-s-19.png" alt="avatar"><i></i></span></a>
                            <div class="dropdown-menu dropdown-menu-right"><a class="dropdown-item" href="{{ route('student.profile', ['id' => Auth::user()->id]) }}"><i class="ft-user"></i> Edit Profile</a>
                                <!-- <div class="dropdown-divider"></div><a class="dropdown-item" href="login-with-bg-image.html"><i class="ft-power"></i> Logout</a> -->
                                <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <a class="dropdown-item" href="route('logout')" onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                    <i class="ft-power"></i> Logout
                                </a>
                                </form>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>
    <!-- END: Header-->


    <!-- BEGIN: Main Menu-->

    <div class="header-navbar navbar-expand-sm navbar navbar-horizontal navbar-fixed navbar-dark navbar-without-dd-arrow navbar-shadow" role="navigation" data-menu="menu-wrapper">
        <div class="navbar-container main-menu-content" data-menu="menu-container">
            <ul class="nav navbar-nav" id="main-menu-navigation" data-menu="menu-navigation">
                <li class="nav-item "><a class="nav-link" href="{{ route('students.home') }}"> <i class="la la-bank"></i><span> Home</span></a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('clubs.index') }}"> <i class="la la-credit-card"></i><span> Clubs</span></a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('events.index') }}"> <i class="la la-credit-card"></i><span> Events</span></a></li>      
                <li class="nav-item"><a class="nav-link" href="{{ route('calendar.index') }}"><i class="la la-calendar"></i><span> Events Calendar</span></a></li>      
                <li class="nav-item"><a class="nav-link" href="{{ route('news.index') }}"><i class="la la-newspaper-o"></i><span> News</span></a></li>      
            </ul>
        </div>
    </div>
<!-- BEGIN: Main Menu-->

<div class="main-menu menu-fixed menu-dark menu-accordion menu-shadow" data-scroll-to-active="true">
        <div class="main-menu-content">
            <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
                
                    <li class="nav-item">
                        <a href="{{ route('dashboard.index') }}">
                            <i class="la la-home"></i>
                            <span class="menu-title" data-i18n="eCommerce">Dashboard</span>
                        </a>
                    </li>
                
                @if(Auth::user()->role == 'admin' || Auth::user()->role == 'coordinator')
                    <li class="nav-item">
                        <a href="{{ route('clubs.index') }}">
                            <i class="la la-connectdevelop"></i>
                            <span class="menu-title" data-i18n="eCommerce">Clubs</span>
                        </a>
                    </li>
                @endif

                @if(Auth::user()->role == 'admin' || Auth::user()->role == 'coordinator')
                    <li class="nav-item">
                        <a href="{{ route('events.index') }}">
                            <i class="la la-connectdevelop"></i>
                            <span class="menu-title" data-i18n="eCommerce">Events</span>
                        </a>
                    </li>
                @endif

                @if(Auth::user()->role == 'admin')
                    <li class="nav-item">
                        <a href="{{ route('coordinators.index') }}">
                            <i class="la la-users"></i>
                            <span class="menu-title" data-i18n="eCommerce">Club Coordinators</span>
                        </a>
                    </li>
                @endif

                @if(Auth::user()->role == 'admin' || Auth::user()->role == 'coordinator')
                    <li class="nav-item">
                        <a href="{{ route('students.index') }}">
                            <i class="la la-users"></i>
                            <span class="menu-title" data-i18n="eCommerce">Students</span>
                        </a>
                    </li>
                @endif

                    <li class="nav-item">
                        <a href="{{ route('calendar.index') }}">
                            <i class="la la-calendar"></i>
                            <span class="menu-title" data-i18n="eCommerce">Calender</span>
                        </a>
                    </li>
                
                

                @if(Auth::user()->role == 'student')
                    <li class="nav-item">
                        <a href="{{ route('events.list') }}">
                            <i class="la la-connectdevelop"></i>
                            <span class="menu-title" data-i18n="eCommerce">Events</span>
                        </a>
                    </li>
                @endif

                @if(Auth::user()->role == 'admin' || Auth::user()->role == 'coordinator')
                    <li class="nav-item">
                        <a href="{{ route('news.index') }}">
                            <i class="la la-newspaper-o"></i>
                            <span class="menu-title" data-i18n="eCommerce">News and Updates</span>
                        </a>
                    </li>
                @endif
                
                @if(Auth::user()->role == 'admin' || Auth::user()->role == 'coordinator')
                    <li class="nav-item">
                        <a href="{{ route('carousel.index') }}">
                            <i class="la la-image"></i>
                            <span class="menu-title" data-i18n="eCommerce">Carousel Images</span>
                        </a>
                    </li>
                @endif

            </ul>
        </div>
    </div>

    <!-- END: Main Menu-->
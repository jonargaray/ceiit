<style type="text/css">
    .slimScrollBar{
        background-color: rgb(255 255 255) !important;
        width: 14px !important;
    }
</style>

<nav class="navbar-default navbar-static-side" role="navigation">
    <div class="sidebar-collapse">
        <ul class="nav metismenu" id="side-menu">
            <li class="nav-header">
                <div class="dropdown profile-element">
                    <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                        <span class="block m-t-xs font-bold">{{ Auth::user()->first_name }} {{ Auth::user()->last_name }} </span>
                        <span class="text-muted text-xs block">{{ Auth::user()->user_type }} <b class="caret"></b></span>

                    </a>
                    <ul class="dropdown-menu animated fadeInRight m-t-xs">
                     
                        <li>
                            <a class="dropdown-item" href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                                             document.getElementById('logout-form').submit();">
                             {{ __('Logout') }}
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </li>
                    </ul>
                </div>
                <div class="logo-element">
                   CEIIT
                </div>
            </li>
            
            @if (Auth::user()->status == 'Active')
                <li class="@yield('dashboard')">
                    <a href="{{ route('officer.dashboards.index') }}"><i class="fa fa-th-large text-success"></i> <span class="nav-label">Dashboard</span></a>
                </li>

                <li class="@yield('student')">
                    <a href="{{ route('officer.users.students') }}"><i class="fa fa-users"></i> <span class="nav-label">Students</span></a>
                </li>
                
                <li class="@yield('language')">
                    <a href="{{ route('officer.languages.index') }}"><i class="fa fa-code"></i> <span class="nav-label">Languages</span></a>
                </li>

                <li class="@yield('grading-system')">
                    <a href="{{ route('officer.grading-systems.index') }}"><i class="fa fa-list"></i> <span class="nav-label">Grading System</span></a>
                </li>

                <li class="@yield('reports')">
                    <a href="#"><i class="fa fa-file"></i> <span class="nav-label">Reports</span><span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level collapse">
                        <li class="@yield('passed-failed')"><a href="{{ route('officer.reports.passed.failed', 'Passed') }}"><i class="fa fa-chevron-right"></i>Passed & Failed</a></li>
                        <li class="@yield('per-question')"><a href="{{ route('officer.reports.per-question', 'Passed') }}"><i class="fa fa-chevron-right"></i>Exam Result per question</a></li>
                    </ul>
                </li>

            @endif

        </ul>

    </div>
</nav>

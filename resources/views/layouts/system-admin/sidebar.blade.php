<style type="text/css">
    .slimScrollBar{
        background-color: rgb(255 255 255) !important;
        width: 14px !important;
    }
</style>

<nav class="navbar-default navbar-static-side" role="navigation">
    <div class="sidebar-collapse">
        <ul class="nav metismenu" id="side-menu" >
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
            
            <li class="@yield('dashboard')">
                <a href="{{ route('system-admin.dashboards.index') }}"><i class="fa fa-th-large text-success"></i> <span class="nav-label">Dashboard</span></a>
            </li>

            <li class="@yield('student')">
                <a href="{{ route('system-admin.users.students') }}"><i class="fa fa-users"></i> <span class="nav-label">Students</span></a>
            </li>
            
            <li class="@yield('officer')">
                <a href="{{ route('system-admin.users.index') }}"><i class="fa fa-user"></i> <span class="nav-label">Officers</span></a>
            </li>

        </ul>

    </div>
</nav>

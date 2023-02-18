<div class="row border-bottom white-bg">
    <nav class="navbar navbar-expand-lg navbar-static-top" role="navigation" style="padding: 20px 50px; background-color:#bdf6aa; " >
            <a href="{{route('student.dashboards.index')}}" class="navbar-brand" style="background-color: #303030"><b>CEIIT</b> Track Assessment</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-label="Toggle navigation">
                <i class="fa fa-reorder"></i>
            </button>
            <div class="navbar-collapse collapse" id="navbar">
                <ul class="nav navbar-nav mr-auto">
                    <!-- <li class="active">
                        <a aria-expanded="false" role="button" href="{{ route('student.dashboards.index') }}"> Back to home page</a>
                    </li>
                    <li class="">
                        <a aria-expanded="false" role="button" href="{{ route('student.dashboards.index') }}"> Assessment</a>
                    </li> -->

                </ul>
                <ul class="nav navbar-top-links navbar-right">
                    <li class="dropdown">
                            <a aria-expanded="false" role="button" href="#" class="dropdown-toggle" data-toggle="dropdown"> 
                                {{ Auth::user()->first_name }} {{ Auth::user()->last_name }}
                            </a>
                            <ul role="menu" class="dropdown-menu">
                                @if (Auth::user()->user_type == 'Active')
                                    <li><a href="{{ route('student.users.profile') }}"><i class="fa fa-fw fa-user"></i> Profile</a></li>
                                <li class="divider"></li>
                                @endif
                                <li>
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                    onclick="event.preventDefault();
                                                    document.getElementById('logout-form').submit();">
                                                    <i class="fa fa-fw fa-power-off"></i>
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </li>
                            </ul>
                        </li>
                </ul>
            </div>
    </nav>
</div>
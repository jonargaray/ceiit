<div id="page-wrapper" class="gray-bg">
    <div class="row border-bottom">
    <nav  class="navbar navbar-static-top white-bg" role="navigation" style="margin-bottom: 0; background-color: #bdf6aa">
    <div class="navbar-header">
        <button class="navbar-minimalize minimalize-styl-2 btn btn-default " id="btn-toggle-sidebar" href="#"><i class="fa fa-bars"></i> </button> 

    </div>
        <ul class="nav navbar-top-links navbar-right">
           <!--  <li class="dropdown">
                <a class="dropdown-toggle count-info" data-toggle="dropdown" href="#">
                    <i class="fa fa-bell"></i>  <span class="label label-primary">8</span>
                </a>
                <ul class="dropdown-menu dropdown-alerts">
                    <li>
                        <a href="mailbox.html" class="dropdown-item">
                            <div>
                                <i class="fa fa-envelope fa-fw"></i> You have 16 messages
                                <span class="float-right text-muted small">4 minutes ago</span>
                            </div>
                        </a>
                    </li>
                    <li class="dropdown-divider"></li>
                    <li>
                        <a href="profile.html" class="dropdown-item">
                            <div>
                                <i class="fa fa-twitter fa-fw"></i> 3 New Followers
                                <span class="float-right text-muted small">12 minutes ago</span>
                            </div>
                        </a>
                    </li>
                    <li class="dropdown-divider"></li>
                    <li>
                        <a href="grid_options.html" class="dropdown-item">
                            <div>
                                <i class="fa fa-upload fa-fw"></i> Server Rebooted
                                <span class="float-right text-muted small">4 minutes ago</span>
                            </div>
                        </a>
                    </li>
                    <li class="dropdown-divider"></li>
                    <li>
                        <div class="text-center link-block">
                            <a href="notifications.html" class="dropdown-item">
                                <strong>See All Alerts</strong>
                                <i class="fa fa-angle-right"></i>
                            </a>
                        </div>
                    </li>
                </ul>
            </li>
 --><!-- 
            <li>
                @if (\DB::connection()->getDatabaseName() == 'bakery')
                    <a href="#" class="dropdown-item"><label class="badge badge-danger">OFFLINE MODE</label></a> 
                @else
                    <a href="#" class="dropdown-item"><label class="badge badge-success">ONLINE MODE</label></a> 
                @endif
            </li> -->
            <li>
                 <a href="{{ route('logout') }}"
                   onclick="event.preventDefault();
                                 document.getElementById('logout-form').submit();">
                 {{ __('Sign out') }}
                </a>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            </li>
        </ul>

    </nav>
</div>

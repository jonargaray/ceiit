@extends ('layouts.system-admin.master')
@section ('title')
  Dashboard
@endsection
@section ('user')
  active
@endsection 

@section ('body')
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-12">
            <h1>Officers</h1>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    Dashboard
                </li>
                <li class="breadcrumb-item active">
                    <strong>Officers</strong>
                </li>
            </ol>
        </div>
    </div>
    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox ">

                    @include('layouts.widgets.alert')

                    <div class="ibox-content">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Status</th>
                                    <th><i class="fa fa-fw fa-gear"></i> </th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($users as $user)
                                    <tr>
                                    <th>
                                           <h2 class="font-bold"> <i class="fa fa-fw fa-user-circle"></i>
                                            <span style="font-size: 14px">{{ $user->first_name }} {{ $user->last_name }}</span>
                                        </h2>
                                        </th>
                                        <th>
                                            <br>
                                            @if ($user->status == 'Active')
                                                <span class="label bg-primary">Active</span>
                                            @else  
                                                <span class="label bg-danger">Deactivated</span>
                                            @endif
                                        </th>
                                        <td>
                                            <br>
                                            <a href="{{ route('system-admin.users.profile', $user->id) }}" class=""> Profile</a>
                                        </td>
                                    </tr>
                                @empty
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                     
                </div>
            </div>
        </div>
        
    </div>
@endsection
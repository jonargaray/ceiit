@extends ('layouts.system-admin.master')
@section ('title')
  Dashboard
@endsection
@section ('student')
  active
@endsection

@section ('body')
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-12">
            <h1>Students
            </h1>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    Dashboard
                </li>
                <li class="breadcrumb-item">
                    Students
                </li>
            </ol>
        </div>
    </div>
    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox ">
                @include('layouts.widgets.alert')
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Status</th>
                                <th>
                                    <i class="fa fa-fw fa-gear"></i>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                                @forelse ($students as $student)
                                    <tr>
                                        <th>
                                           <h2 class="font-bold"> <i class="fa fa-fw fa-user-circle"></i>
                                            <span style="font-size: 14px">{{ $student->first_name }} {{ $student->last_name }}</span>
                                        </h2>
                                        </th>
                                        <td><br> {{ $student->student_num }}</td>
                                    <th>
                                        <br>
                                        @if ($student->status == 'Active')
                                            <span class="label bg-primary">Active</span>
                                        @else  
                                            <span class="label bg-danger">Deactivated</span>
                                        @endif
                                    </th>
                                    <td>
                                        <br>
                                        <a href="{{ route('system-admin.users.profile', $student->id) }}" class=""> Profile</a>
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
@endsection
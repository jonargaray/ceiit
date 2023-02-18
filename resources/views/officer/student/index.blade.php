@extends ('layouts.officer.master')
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
                    <div class="ibox-header">
                        <form method="get" action="index.html" class="float-right mail-search">
                            <div class="input-group">
                                <input type="text" class="form-control form-control-sm" name="search" placeholder="Search..">
                                <div class="input-group-btn">
                                    <button type="submit" class="btn btn-sm btn-success">
                                        Search
                                    </button>
                                </div>
                            </div>
                        </form>
                        <br>
                        <br>
                    </div>
                    <div class="ibox-content">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Student Number</th>
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
                                        <td>{{ $student->student_num }}</td>
                                        <td>
                                            <a href="{{ route('officer.users.profile', $student->id) }}" class=""> Profile</a> &nbsp | &nbsp;
                                            <a href="{{ route('officer.users.assessments', $student->id) }}" class="">Assessment</a>
                                        </td>
                                    </tr>
                                @empty
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    <div class="ibox-footer">
                        <div class="mail-tools tooltip-demo m-t-md">
                            <medium class="font-normal">Showing {{$students->firstItem()}} to {{$students->lastItem()}} of {{$students->total()}} entries </medium>
                            <div class="btn-group float-right">
                                {{ $students->links('pagination') }}
                            </div>
                        <br>
                        <br>
                        </div>
                    </div>
                </div>
                </div>
            </div>
        </div>
        
    </div>
@endsection
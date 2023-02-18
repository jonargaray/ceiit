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
            <h1>
                <a href="{{ route('officer.users.students') }}"><i class="fa fa-fw fa-arrow-left text-black"></i></a>
                Assessments
            </h1>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    Dashboard
                </li>
                <li class="breadcrumb-item">
                    Students
                </li>
                <li class="breadcrumb-item active">
                    Assessments
                </li>
            </ol>
        </div>
    </div>
    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-lg-12">
                <h2>Student Details</h2>
            <table class="table">
                <tr>
                    <th width="150px">Student Name</th>
                    <td>{{ $user->first_name }} {{ $user->last_name }}</td>
                </tr>
                <tr>
                    <th>Student Number</th>
                    <td>{{ $user->student_num }}</td>
                </tr>
            </table>
                <div class="ibox ">
                    <h2>Assessments</h2>
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Date</th>
                                <th>
                                    <i class="fa fa-fw fa-gear"></i>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                          @forelse ($assessments as $assessment)
                            <tr>
                                <td>{{ $assessment->created_at }}</td>
                                <td>
                                <a href="{{ route('officer.users.assessment-details', $assessment->id) }}" class="btn btn-sm btn-default">Vew Result</a>
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
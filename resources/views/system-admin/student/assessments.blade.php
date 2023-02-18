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
            <h1>Assessments
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
                <div class="ibox ">
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
                                <a href="{{ route('system-admin.users.assessment-details', $assessment->id) }}" class="btn btn-sm btn-default"><i class="fa fa-fw fa-bar-chart"></i> Result</a>
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
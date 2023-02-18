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
            <h1>Assessment
            </h1>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    Dashboard
                </li>
                <li class="breadcrumb-item">
                    Students
                </li>
                <li class="breadcrumb-item active">
                    Assessment
                </li>
            </ol>
        </div>
    </div>
    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox ">
                    <div class="ibox-content">
                        <table class="table">
                            <tr>
                            <th width="150px">Student Name</th>
                            <td>{{ $assessment->first_name }} {{ $assessment->last_name }}</td>
                            </tr>
                            <tr>
                            <th>Assessment Date</th>
                            <td>{{ $assessment->created_at }}</td>
                            </tr>
                        </table>
                        <br>
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th>Indicators</th>
                                @forelse ($languages as $language)
                                <th width="100px" class="text-center">{{ $language->language }}</th>
                                @empty
                                @endforelse
                                <th class="text-center">Remarks</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>Skil Assessment Result</td>
                                @forelse ($languages as $language)
                                <th>
                                    {{ $quizClass->percentage($request->assessment_id, $language->id) }}%
                                </th>
                                @empty
                                @endforelse
                                <th></th>
                            </tr>
                            <tr>
                                <td>Efficiency Assessment Result</td>
                                <th>{{ $assessment->c_e }}%</th>
                                <th>{{ $assessment->p_e }}%</th>
                                <th></th>
                            </tr>
                            <tr>
                                <td>Combined Result</td>
                                <th>{{ $assessment->c_c }}%</th>
                                <th>{{ $assessment->p_c }}%</th>
                                <th>{{ $assessment->remarks }}%</th>
                            </tr>
                            </tbody>
                        </table>
                        <br>
                        0% - 50% = FAILED <br>
                        51% - 100% = PASSED <br>

                        </div>
                </div>
            </div>
        </div>
        
    </div>
@endsection
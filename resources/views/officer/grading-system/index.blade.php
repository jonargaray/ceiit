@extends ('layouts.officer.master')
@section ('title')
  Dashboard
@endsection
@section ('grading-system')
  active
@endsection

@section ('body')
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-12">
            <h1>
            
                Grading Sytem
                <a href="{{route('officer.grading-systems.create')}}" class="btn btn-xs btn-success dim" type="button"><i class="fa fa-fw fa-plus"></i> Create new grading system</a>
            </h1>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    Dashboard
                </li>
                <li class="breadcrumb-item active">
                    Grading Sytem
                </li>
            </ol>
        </div>
    </div>
    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-lg-12">
            @include('layouts.widgets.alert')
                <div class="ibox ">
                    <div class="ibox-content">
                        <table class="table table-hover table-bordered">
                            <thead>
                                <tr>
                                    <th>SET</th>
                                    <th>Skill Assessment Result (%)</th>
                                    <th>Efficiency Assessment Result (%)</th>
                                    <th>Status</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($gradings as $grading)
                                    <tr>
                                        <th>{{ $grading->set }}</th>
                                        <td>{{ $grading->quiz }}%</td>
                                        <td>{{ $grading->exercise }}%</td>
                                        <td>
                                            @if( $grading->status == 1) 
                                                <span class="label bg-primary">Active</span>
                                            @else
                                                --
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{route('officer.grading-systems.edit', $grading->id)}}">Edit </a>
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
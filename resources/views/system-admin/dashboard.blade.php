@extends ('layouts.system-admin.master')
@section ('title')
Dashboard
@endsection
@section ('dashboard')
active
@endsection

@section ('body')

<div class="wrapper wrapper-content">
    <div class="row">
        <div class="col-lg-6">
            <div class="ibox ">
                <div class="ibox-title">
                    <h5>Students</h5>
                </div>
                <div class="ibox-content">
                    <h1 class="no-margins">{{ count($students) }}</h1>
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="ibox ">
                <div class="ibox-title">
                    <h5>Officers</h5>
                </div>
                <div class="ibox-content">
                    <h1 class="no-margins">{{ count($officers) }}</h1>
                </div>
            </div>
        </div>
    </div>
</div>



@endsection

@section('script')

@endsection
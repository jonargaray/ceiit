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
            <a href="{{ route('officer.grading-systems.index') }}"><i class="fa fa-fw fa-arrow-left text-black"></i></a>
                New Grading Sytem
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
                <div class="ibox ">
                    <form method="post" action="{{ route('officer.grading-systems.store') }}" onsubmit="btnSubmit.disabled = true">
                        @csrf
                        @method('POST')

                        <div class="ibox-content">
                            <div class="form-group  row"><label class="col-sm-3 col-form-label">Skill Assessment Result (%) <span class="text-danger">*</span></label>
                                <div class="col-sm-4"> 
                                    <input type="text" name="quiz" autofocus class="form-control" required />
                                </div>
                            </div>
                            <div class="form-group  row"><label class="col-sm-3 col-form-label">Efficiency Assessment Result (%) <span class="text-danger">*</span></label>
                                <div class="col-sm-4"> 
                                    <input type="text" name="exercise" autofocus class="form-control" required />
                                </div>
                            </div>
                        </div>
                        <div class="ibox-footer">
                            <button class="btn btn-success btn-sm" id="btnSubmit" type="submit"><i class="fa fa-fw fa-save"></i> Save</button>
                        </div>
                       
                    </form>
                </div>
            </div>
        </div>
        
    </div>
@endsection
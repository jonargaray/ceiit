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
            <a href="{{route('officer.users.students')}}" ><i class="fa fa-fw fa-arrow-left"></i></a>
                Profile
            </h1>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    Dashboard
                </li>
                <li class="breadcrumb-item">
                    Profile
                </li>
            </ol>
            
        </div>
    </div>
    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-lg-12">
                <form method="post" action="" onsubmit="btnSubmit.disabled = true">
                        @csrf
                        @method('POST')

                        <div class="form-group  row"><label class="col-sm-2 col-form-label">Student Number </label>
                            <div class="col-sm-5"> 
                                <input type="text" name="" readonly value="{{$user->student_num}}" autofocus class="form-control" required />
                            </div>
                        </div>

                        <div class="form-group  row"><label class="col-sm-2 col-form-label">First Name </label>
                            <div class="col-sm-5"> 
                                <input type="text" name="" readonly value="{{$user->first_name}}" autofocus class="form-control" required />
                            </div>
                        </div>
                        <div class="form-group  row"><label class="col-sm-2 col-form-label">Last Name </label>
                            <div class="col-sm-5"> 
                                <input type="text" name="" readonly value="{{$user->last_name}}" autofocus class="form-control" required />
                            </div>
                        </div>

                        <div class="form-group  row"><label class="col-sm-2 col-form-label">Email </label>
                            <div class="col-sm-5"> 
                                <input type="text" name="" readonly value="{{$user->email}}" autofocus class="form-control" required />
                            </div>
                        </div>

                    
                    </form>
            </div>
        </div>
        
    </div>
@endsection
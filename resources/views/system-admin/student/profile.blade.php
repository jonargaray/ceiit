@extends ('layouts.system-admin.master')
@section ('title')
  Dashboard
@endsection

@if ($user->user_type == 'STUDENT')
@section ('student')
  active
@endsection
@endif

@if ($user->user_type == 'OFFICER')
@section ('officer')
  active
@endsection
@endif


@section ('body')
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-12">
            <h1>Profile
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
                <form method="post" action="{{ route('system-admin.users.update', $user->id) }}" onsubmit="btnSubmit.disabled = true">
                        @csrf
                        @method('POST')
                        @include('layouts.widgets.alert')
                        <div class="ibox">
                            <div class="ibox-content">
                                <div class="form-group  row"><label class="col-sm-2 col-form-label">User Type </label>
                                    <div class="col-sm-5"> 
                                        <input type="text" name="user_type" readonly value="{{$user->user_type}}" autofocus class="form-control" required />
                                    </div>
                                </div>
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
        
                                <div class="form-group  row"><label class="col-sm-2 col-form-label">Status </label>
                                    <div class="col-sm-5"> 
                                        <select name="status" class="form-control">
                                            <option value="Active" {{$user->status == 'Active' ? 'selected' : ''}}>Active</option>
                                            <option value="Deactivate" {{$user->status == 'Deactivate' ? 'selected' : ''}}>Deactivate</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="ibox-footer">
                                <button class="btn btn-success btn-sm" id="btnSubmit" type="submit"><i class="fa fa-fw fa-save"></i> Update</button>
                            </div>
                        </div>
                    </form>
            </div>
        </div>
        
    </div>
@endsection
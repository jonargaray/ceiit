@extends ('layouts.business-owner.master')
@section ('title')
  Dashboard
@endsection

@section ('user')
  active
@endsection

@section ('body')
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h1>
                <a href="{{ route('business-owner.users.index') }}"><i class="fa fa-fw fa-chevron-left"></i></a>
                New User</h1>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    Dashboard
                </li>
                <li class="breadcrumb-item">
                    Users
                </li>
                <li class="breadcrumb-item active">
                    <strong>Add New</strong>
                </li>
            </ol>
        </div>
    </div>
    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
                <div class="col-lg-12">
                    <div class="ibox ">

                        @include('layouts.widgets.alert')

                        <div class="ibox-title">
                            <h5>User  <small>Fill the required fields <span class="text-danger">* </span>.</small></h5>
                            <div class="ibox-tools">
                                <a class="collapse-link">
                                    <i class="fa fa-chevron-up"></i>
                                </a> 
                            </div>
                        </div>
                        <div class="ibox-content">
                            <form method="post" action="{{ route('business-owner.users.store') }}" onsubmit="btnCreateUser.disabled = true" enctype="multipart/form-data">
                                @csrf
                                @method('POST')
                                <div class="form-group  row"><label class="col-sm-2 col-form-label">First Name  <span class="text-danger pull-right">* </span></label>
                                    <div class="col-sm-4"> 
                                        <input name="first_name" type="text" autofocus="" class="form-control @error('first_name') error @enderror" value="{{ old('first_name')  }}" required="">
                                        @error('first_name')
                                            <small class="text-danger">
                                                <strong>{{ $message }}</strong>
                                            </small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="hr-line-dashed"></div>

                                <div class="form-group  row"><label class="col-sm-2 col-form-label">Last Name  <span class="text-danger pull-right">* </span></label>
                                    <div class="col-sm-4">
                                        <input name="last_name" type="text" class="form-control @error('last_name') error @enderror" value="{{ old('last_name')  }}" required="">
                                        @error('last_name')
                                            <small class="text-danger">
                                                <strong>{{ $message }}</strong>
                                            </small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="hr-line-dashed"></div>

                                 <div class="form-group  row"><label class="col-sm-2 col-form-label">Contact No.  <span class="text-danger pull-right">* </span></label>
                                    <div class="col-sm-4">
                                        <input name="contact_num" type="text" class="form-control @error('contact_num') error @enderror" value="{{ old('contact_num')  }}" required="" data-mask="+63 9999999999" placeholder="">
                                        @error('contact_num')
                                            <small class="text-danger">
                                                <strong>{{ $message }}</strong>
                                            </small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="hr-line-dashed"></div>

                                <div class="form-group  row"><label class="col-sm-2 col-form-label">Email  <span class="text-danger pull-right">* </span></label>
                                    <div class="col-sm-4">
                                        <input name="email" type="email" class="form-control @error('email') error @enderror" value="{{ old('email')  }}" required="">
                                        @error('email')
                                            <small class="text-danger">
                                                <strong>{{ $message }}</strong>
                                            </small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="hr-line-dashed"></div>

                                <div class="form-group  row"><label class="col-sm-2 col-form-label">Branch  <span class="text-danger pull-right">* </span></label>
                                    <div class="col-sm-4">
                                        <select name="branch_id" class="form-control @error('branch_id') error @enderror">
                                            <option value="">--</option>
                                            @forelse($branches as $branch)
                                                 @if(Auth::user()->user_type == 'Business Owner')
                                                    <option value="{{$branch->branch_id}}" {{$branch->branch_id==old('branch_id') ? 'selected' : ''}}>{{$branch->barangay}} {{$branch->main == 1 ? '(MAIN)' : ''}}</option>
                                                @else
                                                    @if (Auth::user()->branch_id == $branch->branch_id)
                                                        <option value="{{$branch->branch_id}}" {{$branch->branch_id==old('branch_id') ? 'selected' : ''}}>{{$branch->barangay}}</option>
                                                    @endif
                                                @endif
                                            @empty
                                            @endforelse
                                        </select>
                                        @error('branch_id')
                                            <small class="text-danger">
                                                <strong>{{ $message }}</strong>
                                            </small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="hr-line-dashed"></div>


                                <div class="form-group  row"><label class="col-sm-2 col-form-label">User Type  <span class="text-danger pull-right">* </span></label>
                                    <div class="col-sm-4">
                                        <select name="user_type" class="form-control @error('user_type') error @enderror">
                                            <option value="">--</option>
                                            @if(Auth::user()->user_type == 'Business Owner')
                                                <option value="Branch Manager" {{ old("user_type") == 'Branch Manager' ? 'selected' : '' }}>Branch Manager</option>
                                            @endif
                                            <option value="Branch Staff" {{ old("user_type") == 'Branch Staff' ? 'selected' : '' }}>Branch Staff</option>
                                        </select>
                                        @error('user_type')
                                            <small class="text-danger"> 
                                                <strong>{{ $message }}</strong>
                                            </small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="hr-line-dashed"></div>

                                 <div class="form-group  row"><label class="col-sm-2 col-form-label">Profile Picture</label>
                                        <div class="col-sm-4">
                                            <input name="image" id="image" type="file" class="form-control"> 
                                            @error('image')
                                                <small class="text-danger"><strong>{{ $message }}</strong></small>
                                            @enderror
                                        </div>
                                    </div>

                                <div class="form-group row">
                                    <div class="col-sm-4 col-sm-offset-2">
                                        <a href="{{ route('business-owner.users.index') }}" class="btn btn-white btn-sm">Cancel</a>
                                        <button class="btn btn-primary btn-sm" id="btnCreateUser" type="submit"><i class="fa fa-fw fa-save"></i> Save</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        
    </div>
@endsection
@extends ('layouts.student.master')
@section ('title')
  Dashboard
@endsection

@section ('body')

<div class="wrapper wrapper-content">
  <h1>Profile</h1>

    <div class="row">
        <div class="col-md-12">
        @include('layouts.widgets.alert')
          <div class="ibox">
              <form method="post" action="{{route('student.users.update.profile')}}" onsubmit="btnSubmit.disabled = true">
                 <div class="ibox-content">
                    @csrf
                    @method('POST')

                    <div class="form-group  row"><label class="col-sm-2 col-form-label">Student Number </label>
                        <div class="col-sm-5"> 
                            <input type="text" name="student_num" value="{{Auth::user()->student_num}}" autofocus class="form-control" required />
                        </div>
                    </div>
                    <div class="form-group  row"><label class="col-sm-2 col-form-label">First Name </label>
                        <div class="col-sm-5"> 
                            <input type="text" name="" readonly value="{{Auth::user()->first_name}}" autofocus class="form-control" required />
                        </div>
                    </div>
                    <div class="form-group  row"><label class="col-sm-2 col-form-label">Last Name </label>
                        <div class="col-sm-5"> 
                            <input type="text" name="" readonly value="{{Auth::user()->last_name}}" autofocus class="form-control" required />
                        </div>
                    </div>

                    <div class="form-group  row"><label class="col-sm-2 col-form-label">Email </label>
                        <div class="col-sm-5"> 
                            <input type="text" name="" readonly value="{{Auth::user()->email}}" autofocus class="form-control" required />
                        </div>
                    </div>    
                </div>
                <div class="ibox-footer">
                    <button class="btn btn-sm btn-success">Update</button>
                </div>
            </form>
          </div>
        </div>
    </div>

</div>
@endsection


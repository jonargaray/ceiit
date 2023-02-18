@extends('layouts.app')

@section('content')

    <div class="loginColumns animated fadeInDown">
        <h1 class="text-center"><i class="fa fa-fw fa-user-plus"></i> Account Registration</h1> 
        <div class="row">
            <div class="col-md-12">
                <div class="">

                     <form method="POST" action="{{ route('register') }}" onsubmit="btnSubmit.disabled = true">
                        @csrf
                        <hr>
                        <div class="row">
                            <div class="col-md-12">
                                <h2>Details</h2>
                                <div class="form-group row"><label class="col-sm-3 col-form-label">User Type <span class="text-danger pull-right">*</span></label>
                                    <div class="col-sm-9">
                                        <select class="form-control" name="user_type" required>
                                            <option value="">--</option>
                                            <option value="STUDENT">Student</option>
                                            <option value="OFFICER">Faculty/Program Head</option>
                                        </select>
                                    </div>
                                </div>    
                                <div class="form-group row"><label class="col-sm-3 col-form-label">First Name <span class="text-danger pull-right">*</span></label>
                                    <div class="col-sm-9">
                                        <input id="email" type="text" autocomplete="off" class="form-control  @error('first_name') is-invalid @enderror" name="first_name" required="" placeholder="Ex. Juan" value="{{ old('first_name') }}"  autofocus>
                                        @error('first_name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row"><label class="col-sm-3 col-form-label">Last Name <span class="text-danger pull-right">*</span></label>
                                    <div class="col-sm-9">
                                        <input id="email" type="text" class="form-control  @error('last_name') is-invalid @enderror" name="last_name" autocomplete="off" required="" placeholder="Ex. Dela Cruz" value="{{ old('last_name') }}" >
                                        @error('last_name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row"><label class="col-sm-3 col-form-label">Student Number</label>
                                    <div class="col-sm-9">
                                        <input id="student_num" type="text" class="form-control @error('student_num') is-invalid @enderror" name="student_num" autocomplete="off" value="{{ old('student_num') }}" placeholder="Ex. 22B0000" >
                                        @error('student_num')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <hr>
                                <h2>Email & Password</h2>
                                <div class="form-group row"><label class="col-sm-3 col-form-label">Email <span class="text-danger pull-right">*</span></label>
                                    <div class="col-sm-9">
                                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" placeholder="Ex. juan@gmail.com" autocomplete="off" required=""  autocomplete="email">
                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row"><label class="col-sm-3 col-form-label">Password <span class="text-danger pull-right">*</span></label>
                                    <div class="col-sm-9">
                                        <input id="password" type="password" required="" class="form-control @error('password') is-invalid @enderror" name="password" placeholder="********"  autocomplete="new-password">
                                        @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row"><label class="col-sm-3 col-form-label">Confirm Password <span class="text-danger pull-right">*</span></label>
                                    <div class="col-sm-9">
                                        <input id="password-confirm" type="password" required="" class="form-control @error('password') is-invalid @enderror" placeholder="********" name="password_confirmation"  autocomplete="new-password">
                                        @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <br>
                                <div class="form-group row"><label class="col-sm-3 col-form-label"></label>
                                    <div class="col-sm-9">
                                    <button type="submit" class="btn btn-success btn-sm font-bold m-b" id="btnSubmit">{{ __('Register') }}</button>
                                    &nbsp; <a class="" href="{{ route('login') }}">{{ __('Go to login') }}</a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        

                    </form>
                    
                </div>
            </div>
        </div>
        
    </div>

    
@endsection
    
<script type="text/javascript" src="{{ url('js/jquery-3.1.1.min.js') }}"></script>
<script type="text/javascript" src="{{ url('js/ajax-script.js') }}"></script>

 <script> 

    function myFunction() {
      var checkBox = document.getElementById("myCheck");
      var text = document.getElementById("text");
      if (checkBox.checked == true){
        text.style.display = "block";
      } else {
         text.style.display = "none";
      }
    }

</script>
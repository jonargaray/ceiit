@extends('layouts.app')

@section('content')

    <div class="loginColumns animated fadeInDown">
        <div class="row">
            <div class="col-md-1">
               
            </div>
            <div class="col-md-10">
                <div class="ibox-content">
                <div class="row">
                    <div class="col-md-4">
                        <h1>CEIIT</h1>
                        <h2>Track Assessment</h2>
                    </div>
                    <div class="col-md-8">
                        
                            <h2 class="text-center">Login</h2>
                            <form class="m-t" role="form" method="POST" action="{{ route('login') }}">
                                @csrf

                                <div class="form-group">
                                    <input id="email" autocomplete="nope" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                    
                                <button type="submit" class="btn text-white black-bg block full-width m-b">{{ __('Login') }}</button>

                                <!-- @if (Route::has('password.request'))
                                    <a href="{{ route('password.request') }}"><small>{{ __('Forgot Your Password?') }}</small></a>
                                @endif -->

                                <p class="text-muted text-center"><small>Do not have an account?</small></p>
                            
                                @guest
                                    @if (Route::has('register'))
                                        <a class="btn btn-sm btn-block" href="{{ route('register') }}">{{ __('Create an account') }}</a>
                                    @endif
                                @endguest
                            
                            </form>
                            <!-- <p class="m-t">
                                <small>Laravel framework base on Bootstrap 3 &copy; 2014</small>
                            </p> -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
    </div>
@endsection

@extends('layouts.app')

@section('content')

    <div class="middle-box text-center animated fadeInDown">

        @if (session('resent'))
            <div class="alert alert-success" role="alert">
                {{ __('A fresh verification link has been sent to your email address.') }}
            </div>
        @endif

        <h1 class="text-center" style="margin-left: -100px;">SIMS</h1>
        <h2 class="text-center">Email verification</h2>
        <!-- <h3 class="font-bold">Verify your email</h3> -->

        <div>
            We sent a verification email to  <span class="font-bold">{{ Auth::user()->email  }} </span>
            Click link inside to get started: <br/> <br/>

            If you did not receive the email <br/>
            <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                @csrf
                <button type="submit" class="btn btn-primary m-t">{{ __('click here') }}</button>.
            </form>
        </div>
            to request another
    </div>

@endsection

@extends('layouts.app')

@section('content')

    <div class="middle-box text-center animated fadeInDown">

        <h1 class="text-center">SIMS</h1>
        <br>
        <br>
        <br>
        <p>Syncing data...</p>
        <div class="progress">
            <div class="progress-bar progress-bar-striped progress-bar-animated progress-bar-primary" style="width: 100%;" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
        </div>
    </div>

    <script type="text/javascript">
        setTimeout(function(){
            window.location.href = '/login';
         }, 3000);
    </script>

@endsection


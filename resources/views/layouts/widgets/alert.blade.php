@if(Session::get('error'))
    <div class="alert alert-danger alert-dismissable">
        <i class="fa fa-fw fa-warning"></i>
         {{Session::get('error')}}
    </div>
@endif

@if(Session::get('warning'))
    <div class="alert alert-warning alert-dismissable">
        <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
        <i class="fa fa-fw fa-warning"></i>
         {{Session::get('warning')}}
    </div>
@endif

@if(Session::get('success'))
    <div class="alert alert-success alert-dismissable">
        <p>{{Session::get('success')}}</p>
    </div>
@endif




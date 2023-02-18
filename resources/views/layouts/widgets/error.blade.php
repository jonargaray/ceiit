@if(Session::get('error'))
    <div class="alert alert-danger alert-dismissable">
        <i class="fa fa-fw fa-danger"></i>
         {{Session::get('error')}}
    </div>
@endif


@if ($errors->any())
    <div class="alert alert-danger">
        <h2>
            <i class="fa fa-fw fa-danger"></i>
            Validation Errors
        </h2>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

@if(Session::get('warning'))
    <div class="alert alert-danger alert-dismissable">
        <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
        <i class="fa fa-fw fa-danger"></i>
         {{Session::get('warning')}}
    </div>
@endif

@if(Session::get('success'))
    <div class="alert alert-success alert-dismissable">
        <b>
            <i class="fa fa-fw fa-check"></i>
            Success
        </b>
        <p>{{Session::get('success')}}</p>
    </div>
@endif



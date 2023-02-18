@extends ('layouts.officer.master')
@section ('title')
  Dashboard
@endsection
@section ('language')
  active
@endsection

@section ('body')
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h1>
                <a href="{{ route('officer.question-sets.index', $request->prog_language_id) }}"><i class="fa fa-fw fa-arrow-left text-black"></i></a>
                New Set</h1>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    Dashboard
                </li>
                <li class="breadcrumb-item">
                    Question set
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

                        <form method="post" action="{{ route('officer.question-sets.store') }}" onsubmit="btnSubmit.disabled = true">
                            <div class="ibox-content">
                                @csrf
                                @method('POST')
                                <input type="hidden" name="prog_language_id" value="{{$request->prog_language_id}}">
                                <div class="form-group  row"><label class="col-sm-2 col-form-label">Language <span class="text-danger">*</span></label>
                                    <div class="col-sm-4"> 
                                        <select name="prog_language_id" class="form-control" disabled>
                                            @forelse ($languages as $language)
                                                <option value="{{ $language->id }}" {{ $language->id == $request->prog_language_id ? 'selected' : '' }}>{{ $language->language }}</option>
                                            @empty
                                            @endforelse
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group  row"><label class="col-sm-2 col-form-label">Set <span class="text-danger">*</span></label>
                                    <div class="col-sm-4"> 
                                        <input type="text" readOnly value="{{ $newSet }}" name="question_set" autofocus class="form-control" required />
                                    </div>
                                </div>
                            </div>
                            <div class="ibox-footer">
                                <button class="btn btn-success btn-sm" id="btnSubmit" type="submit"><i class="fa fa-fw fa-save"></i> Save</button>
                                <br>
                                <br>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        
    </div>
@endsection
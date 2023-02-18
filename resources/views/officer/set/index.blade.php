@extends ('layouts.officer.master')
@section ('title')
  Dashboard
@endsection
@section ('language')
  active
@endsection

@section ('body')
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-12">
            <h1>
                <a href="{{route('officer.languages.index')}}"><i class="fa fa-fw fa-arrow-left  text-black"></i></a>
                Quiz
                <a href="{{ route('officer.question-sets.create', $request->prog_language_id) }}" class="btn btn-xs btn-success dim" type="button"><i class="fa fa-fw fa-plus"></i> Create new set</a>
            </h1>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    Dashboard
                </li>
                <li class="breadcrumb-item">
                    Language
                </li>
                <li class="breadcrumb-item active">
                    <strong>Quiz</strong>
                </li>
            </ol>
        </div>
    </div>
    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-lg-12">
                <form id="frm" method="GET">
                    <div class="form-group  row"><label class="col-sm-1 col-form-label">Language </span></label>
                        <div class="col-sm-3">
                            <select name="prog_language_id" class="form-control" select onchange="clearPage('frm', 'container')">
                                @forelse ($languages as $language)
                                    <option value="{{ $language->id }}" {{ $language->id == $request->prog_language_id ? 'selected' : '' }}>{{ $language->language }}</option>
                                @empty
                                @endforelse
                            </select>
                        </div>
                    </div>
                </form>
                <div class="ibox ">

                    @include('layouts.widgets.alert')
                    
                    <div class="ibox-content" id="user_container"> 
                        <div class="">
                            <div class="row">
                                @forelse ($sets as $set)
                                    <div class="col-lg-3">
                                        <div class="panel panel-default">
                                            <div class="panel-heading">
                                                Set @if($set->status == 1) <i class="fa fa-check pull-right text-primary"></i> @endif
                                            </div>
                                            <div class="panel-body">
                                                <h2><a href="{{ route('officer.questions.index', [$request->prog_language_id, $set->id]) }}">{{ $set->question_set }}</a></h2>
                                            </div>
                                        </div>
                                    </div>
                                @empty
                                @endforelse
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
    </div>
@endsection
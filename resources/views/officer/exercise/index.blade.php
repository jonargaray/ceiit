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
            <a href="{{ route('officer.questions.exercise', $request->prog_language_id) }}"><i class="fa fa-fw fa-arrow-left text-black"></i></a>
                Excercises
                <a href="{{ route('officer.exercises.create', [$request->prog_language_id, $request->topic_id]) }}" class="btn btn-xs btn-success dim" type="button"><i class="fa fa-fw fa-plus"></i> Add New Exercise</a>
            </h1>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    Dashboard
                </li>
                <li class="breadcrumb-item active">
                    <strong>Language</strong>
                </li>
            </ol>
        </div>
    </div>
    <div class="wrapper wrapper-content animated fadeInRight">
    @include('layouts.widgets.alert')
        <div class="row">
            <div class="col-lg-12">

                <form id="frm" method="GET">
                    <div class="form-group row">
                        <label class="col-sm-1 col-form-label">Language </span></label>
                        <div class="col-sm-3">
                            <select name="prog_language_id" class="form-control" select onchange="clearPage('frm', 'container')">
                                @forelse ($languages as $language)
                                    <option value="{{ $language->id }}" {{ $language->id == $request->prog_language_id ? 'selected' : '' }}>{{ $language->language }}</option>
                                @empty
                                @endforelse
                            </select>
                        </div>
                    </div>
                    <div class="form-group  row"><label class="col-sm-1 col-form-label">Topic </span></label>
                        <div class="col-sm-3">
                            <select name="topic_id" class="form-control" select onchange="clearPage('frm', 'container')">
                                <option value="" selected disabled>--</option>
                                @forelse ($topics as $topic)
                                    <option value="{{ $topic->id }}" {{ $topic->id == $request->topic_id ? 'selected' : '' }}>{{ $topic->topic }}</option>
                                @empty
                                @endforelse
                            </select>
                        </div>
                    </div>
                </form>

                <hr>
                <br>
                @php $numbering = 1 @endphp
                @forelse ($exercises as $exercise)
                    <div class="ibox">
                        <div class="ibox-content"> 
                            <table class="table table-no-border">
                                <tr>
                                    <th width="40px"><span class="label bg-primary font-bold" style="font-size: 14px">{{ $numbering }}</span>  </th>
                                    <th>{!! $exercise->instruction !!} </th>
                                    <th width="80px"><i class="fa fa-fw fa-clock-o"></i> {{ $exercise->seconds }} sec.  </th>
                                    <td width="100px">
                                        <span class="pull-right">
                                            <a href="{{ route('officer.exercises.edit', $exercise->id) }}" class="btn btn-xs btn-default"><i class="fa fa-pencil"></i></a>
                                            <button class="btn btn-xs btn-danger"><i class="fa fa-trash"></i></button>
                                        </span>
                                    </td>
                                </tr>
                            </table>
                            <hr>
                            <div class="table-responsive" style="background-color: #1e1e1e; color: #f0f0f0; padding: 20px">
                                {!! $exercise->program !!}
                            </div>
                        </div>
                    </div>
                    @php $numbering++ @endphp
                @empty
                    <div class="ibox">
                        <div class="ibox-content"> 
                            <span class="text-muted"> No exercise available </span>
                        </div>
                    </div>
                @endforelse
            </div>
        </div>
        
    </div>
@endsection
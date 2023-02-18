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
                <a href="{{ route('officer.question-sets.index', $request->prog_language_id) }}"><i class="fa fa-fw fa-arrow-left text-black"></i></a>
                Quiz
                <a href="{{ route('officer.questions.create', [$request->prog_language_id, $request->question_set_id]) }}" class="btn btn-xs btn-success dim" type="button"><i class="fa fa-fw fa-plus"></i> Add New Question</a>
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
                    <div class="form-group  row"><label class="col-sm-1 col-form-label">Set </span></label>
                        <div class="col-sm-3">
                            <select name="question_set_id" class="form-control" select onchange="clearPage('frm', 'container')">
                                <option value="" selected disabled>--</option>
                                @forelse ($sets as $set)
                                    <option value="{{ $set->id }}" {{ $set->id == $request->question_set_id ? 'selected' : '' }}>{{ $set->question_set }}</option>
                                @empty
                                @endforelse
                            </select>
                        </div>
                    </div>
                </form>
                <form method="post" action="{{ route('officer.question-sets.update', $request->question_set_id) }}">
                    @csrf
                    @method('POST')

                    <input type="hidden" name="prog_language_id" value="{{$request->prog_language_id}}">

                    <div class="form-group  row"><label class="col-sm-1 col-form-label">Status </span></label>
                        <div class="col-sm-3">
                            <select name="status" disabled class="form-control" select onchange="clearPage('frm', 'container')">
                                <option value="1" {{ $selectedSet->status == 1 ? 'selected' : '' }}>Active</option>
                                <option value="0" {{ $selectedSet->status == 0 ? 'selected' : '' }}>Inacitve</option>
                            </select>
                        </div>
                        @if ($selectedSet->status == 0)
                            <button class="btn btn-primary">ACTIVATE</button>
                        @endif
                    </div>
                </form>

                @php $ctr = 1 @endphp
                @forelse ($questions as $question)
                    <div class="ibox">
                        <div class="ibox-content"> 
                            <table class="table table-no-border">
                                <tr>
                                    <th width="40px"><span class="label bg-primary font-bold" style="font-size: 14px">{{ $ctr++ }}</span></th>
                                    <th>{!! $question->question !!}</th>
                                    <td width="100px">
                                        <span class="pull-right">
                                            <a href="{{ route('officer.questions.edit', $question->id) }}" class="btn btn-xs btn-default"><i class="fa fa-pencil"></i></a>
                                            <a class="btn btn-xs btn-danger"><i class="fa fa-trash"></i></a>
                                        </span>
                                    </td>
                                </tr>
                            </table>
                            
                            <div class="table-responsive">
                                <table class="table">
                                    @forelse ($question->choices as $choice)
                                    <tr>
                                        <td width="40px">
                                            <input type="radio" {{ $question->correct_answer_id !== $choice->id ? 'disabled' : 'checked' }} class="mt-1">
                                        </td>
                                        <td colspan="2">{{ $choice->choice }}</td>
                                    </tr>
                                    @empty
                                    @endforelse
                                </table>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="ibox">
                        <div class="ibox-content"> 
                            <span class="text-muted"> No question available </span>
                        </div>
                    </div>
                @endforelse
            </div>
        </div>
        
    </div>
@endsection
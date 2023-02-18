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
                <a href="{{ route('officer.exercises.index', [$exercise->prog_language_id, $exercise->topic_id]) }}"><i class="fa fa-fw fa-arrow-left text-black"></i></a>
                Edit Excercise</h1>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    Dashboard
                </li>
                <li class="breadcrumb-item">
                    Question
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

                    <form action="">
                        <div class="form-group  row"><label class="col-sm-1 col-form-label">Language </span></label>
                            <div class="col-sm-3">
                                <select name="prog_language_id" class="form-control" disabled>
                                    @forelse ($languages as $language)
                                        <option value="{{ $language->id }}" {{ $language->id == $request->prog_language_id ? 'selected' : '' }}>{{ $language->language }}</option>
                                    @empty
                                    @endforelse
                                </select>
                            </div>
                        </div>
                        <div class="form-group  row"><label class="col-sm-1 col-form-label">Topic </span></label>
                            <div class="col-sm-3">
                                <select name="topic_id" class="form-control" disabled>
                                    @forelse ($topics as $topic)
                                        <option value="{{ $topic->id }}" {{ $topic->id == $request->topic_id ? 'selected' : '' }}>{{ $topic->topic }}</option>
                                    @empty
                                    @endforelse
                                </select>
                            </div>
                        </div>
                    </form>
                    
                    <div class="ibox ">
                        <form method="post" action="{{ route('officer.exercises.generate') }}" onsubmit="btnSubmit.disabled = true">
                            @csrf
                            @method('POST')

                            <input type="hidden" name="topic_id" value="{{$exercise->topic_id}}">
                            <input type="hidden" name="prog_language_id" value="{{$exercise->prog_language_id}}">
                            <input type="hidden" name="redirect" value="edit">
                            <input type="hidden" name="exercise_id" value="{{ $exercise->exercise_id }}">

                            <div class="ibox-title">
                                <h5>New Exercise</h5>
                            </div>
                            <div class="ibox-content">
                                <div class="form-group">
                                    <label class="form-label">Instruction <span class="text-danger">*</span></label> <button class="btn btn-warning btn-sm text-black" id="btnSubmit" type="submit"><i class="fa fa-fw fa-refresh"></i> Generate</button>
                                    <textarea name="instruction" autofocus rows=2 block class="summernote form-control w-100" required>{{ $exercise->instruction }}</textarea>
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Code <span class="text-danger">*</span></label>
                                    <textarea  class="summernote" name="program" required id="program">{{ $exercise->codes }}</textarea >
                                </div>
                            </div>
                        </form>

                        @if ($generated !== '')
                            <form method="post" action="{{ route('officer.exercises.update', $exercise->exercise_id) }}" onsubmit="btnSubmit.disabled = true">
                                @csrf
                                @method('POST')

                                <input type="hidden" name="topic_id" value="{{$request->topic_id}}">
                                <input type="hidden" name="prog_language_id" value="{{$request->prog_language_id}}">
                                <input type="hidden" name="instruction" value="{{$request->instruction}}">
                                <input type="hidden" name="program" value="{{$request->program}}">

                                
                                <div class="ibox-content">
                                    <div class="form-group">
                                        <label class="form-label">Timer (No. of seconds) 
                                        <input type="number" class="form-control" name="seconds" min="1" value="60" />
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">Generate Program <span class="font-normal"> (Please fill out the blank) </span><span class="text-danger">*</span></label>
                                        <div class="table-responsive" style="background-color: #1e1e1e; color: #f0f0f0; padding: 20px">
                                            {!! $generated !!}
                                        </div>
                                    </div>
                                
                                </div>
                                <div class="ibox-footer">
                                    <div class="">
                                        <button class="btn btn-success btn-sm" id="btnSubmit" type="submit"><i class="fa fa-fw fa-save"></i> Update</button>
                                    </div>
                                </div>
                            </form>
                        @endif

                    </div>
                </div>
            </div>
    </div>
@endsection

@section('script')
 
@endsection
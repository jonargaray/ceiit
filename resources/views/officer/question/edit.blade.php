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
                <a href="{{ route('officer.questions.index', [$question->prog_language_id, $question->question_set_id]) }}"><i class="fa fa-fw fa-chevron-left text-black"></i></a>
                Edit Question</h1>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    Dashboard
                </li>
                <li class="breadcrumb-item">
                    Question
                </li>
                <li class="breadcrumb-item active">
                    <strong>Edit</strong>
                </li>
            </ol>
        </div>
    </div>
    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
                <div class="col-lg-12">
                    
                    <div class="ibox ">

                        @include('layouts.widgets.alert')

                        <div class="ibox-content">
                            <form method="post" action="{{ route('officer.questions.update', $question->id) }}" onsubmit="btnSubmit.disabled = true">
                                @csrf
                                @method('POST')

                                <div class="form-group  row"><label class="col-sm-2 col-form-label">Language </label>
                                    <div class="col-sm-4"> 
                                        <select name="prog_language_id" class="form-control" disabled>
                                            @forelse ($languages as $language)
                                                <option value="{{ $language->id }}" {{ $language->id == $question->prog_language_id ? 'selected' : '' }}>{{ $language->language }}</option>
                                            @empty
                                            @endforelse
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group  row"><label class="col-sm-2 col-form-label">Set</label>
                                    <div class="col-sm-4"> 
                                        <select name="question_set_id" class="form-control" disabled>
                                            @forelse ($sets as $set)
                                                <option value="{{ $set->id }}" {{ $set->id == $question->question_set_id ? 'selected' : '' }}>{{ $set->question_set }}</option>
                                            @empty
                                            @endforelse
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group  row"><label class="col-sm-2 col-form-label">Question   <span class="text-danger">*</span></label>
                                    <div class="col-sm-10"> 
                                        <textarea name="question" autofocus rows=5 block class="summernote form-control w-100" required>{{ $question->question }}</textarea>
                                    </div>
                                </div>

                                <span class="font-bold">Choices <span class="font-normal"> (Please set the correct answer)</span></span>
                                <hr>
                                @for($i=0; $i<=4; $i++)
                                <div class="form-group  row">
                                    <label class="col-sm-2 col-form-label">
                                        <input type="radio" required name="correct_answer" class="mx-2 pull-right" 
                                            @if (isset($choices[$i]))
                                                value="{{$choices[$i]->id}}"
                                            @endif 
                                            
                                            
                                            @if (isset($choices[$i]))
                                                {{$question->correct_answer_id == $choices[$i]->id ? 'checked' : ''}}
                                            @endif
                                        >
                                    </label>
                                    <div class="col-sm-10">
                                        <textarea name="choices[]" rows=2 block class="form-control w-100">{{ isset($choices[$i]) ? $choices[$i]->choice : '' }}</textarea>
                                    </div>
                                </div>
                                @endfor

                                <div class="form-group row">
                                    <div class="col-sm-12 col-sm-offset-2">
                                        <button class="btn btn-success btn-sm pull-right" id="btnSubmit" type="submit"><i class="fa fa-fw fa-save"></i> Update</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        
    </div>
@endsection
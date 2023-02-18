@extends ('layouts.student.master')
@section ('title')
  Dashboard
@endsection

@section ('body')

<div class="wrapper wrapper-content">
    

     <div class="ibox-content m-b-sm border-bottom">
        <div class="">
             <h1>Assessment</h1>
            <span>You can test your Programming skills with CTA.</span>
        </div>
    </div>
    
    <div class="row">
        <div class="col-lg-3">
            @forelse($languages as $language)
                <h2 class="text-success"> &nbsp; {{ $language->language }}
                    @if ($currentLanguage->prog_language_id == $language->id)
                        <span class="label badge-warning pull-right">... </span>
                    @endif
                    @if ($currentLanguage->prog_language_id == 2 && $language->id == 1)
                        <i class="fa fa-check text-primary pull-right"></i>
                    @endif
                </h2>
                <hr>
                <h3><i class="fa fa-fw"></i> Quiz ({{ count($language->questions) }})</h3>
                <h3><i class="fa fa-fw"></i> Exercices </h3>
                <ul class="nav nav-tabs">
                    @forelse($language->topics as $topic)
                        @if (count($topic->exercises) > 0)
                            <li style="width: 100%"><a class="nav-link" href="#"><i class="fa fa-fw fa-chevron-right"></i> {{ $topic->topic }} ({{ count($topic->exercises) }})</a></li>
                        @endif        
                    @empty
                    @endforelse
                </ul>
                @empty
            @endforelse
        </div>
        <div class="col-lg-9">
            <form method="post" action="{{ route('student.quizzes.store') }}" onsubmit="btnSubmit.disabled = true">
                @csrf
                @method('POST')
                
                <input type="hidden" name="assessment_id" value="{{ $assessment->id }}">
                <input type="hidden" name="prog_language_id" value="{{ $currentLanguage->prog_language_id }}">
                <input type="hidden" name="question_set_id" value="{{ $questionSet->id }}">

                @php $ctr = 1 @endphp
                @forelse ($questions as $question)
                    <div class="ibox">
                        <div class="ibox-content"> 
                            <table class="table table-no-border">
                                <tr>
                                    <th width="40px"><span class="label badge-info font-bold" style="font-size: 14px"> {{ $ctr++ }} </span></th>
                                    <th>{!! $question->question !!}</th>
                                </tr>
                            </table>
                            
                            <div class="table-responsive">
                                <table class="table">
                                    @forelse ($question->choices as $choice)
                                    <tr>
                                        <td width="40px">
                                            <input type="radio" required value="{{ $choice->id }}" name="answer{{$question->id}}" class="mt-1">
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
                <div class="ibox">
                    <div class="ibox-footer">
                        <div class="form-group row">
                            <div class="col-sm-12 col-sm-offset-2">
                                <button class="btn btn-success btn-lg" id="btnSubmit" type="submit"> Submit answer</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>


</div>
@endsection
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
                <h3><i class="fa fa-fw"></i> Quiz ({{ count($language->questions) }}) 
                    @if ($currentLanguage->prog_language_id == $language->id && in_array(0, $completeArray))
                        <i class="fa fa-check text-primary pull-right"></i>
                    @endif
                </h3>
                <h3><i class="fa fa-fw"></i> Exercices </h3>
                <ul class="nav nav-tabs">
                    @forelse($language->topics as $topic)
                        @if (count($topic->exercises) > 0)
                            <li style="width: 100%"><a class="nav-link" href="#"><i class="fa fa-fw fa-chevron-right"></i> {{ $topic->topic }} ({{ count($topic->exercises) }})
                                @if ($currentLanguage->topic_id == $topic->id)
                                    <span class="label badge-warning pull-right">... </span>
                                @endif
                                @if ($currentLanguage->prog_language_id == $language->id && in_array($topic->id, $completeArray))
                                    <i class="fa fa-check text-primary pull-right"></i>
                                @endif
                                </a>
                            </li>
                        @endif
                    @empty
                    @endforelse
                </ul>
                @empty
            @endforelse
        </div>
        <div class="col-lg-9">
            <div class="ibox">
                <form id="frm_exercise" method="post" action="{{ route('student.ass-exercises.store') }}" onsubmit="btnSubmit.disabled = true">
                    @csrf
                    @method('POST')
                    <input type="hidden" name="assessment_id" value="{{$assessment->id}}">
                    <input type="hidden" name="exercise_id" value="{{$exercise->id}}">
                    <input type="hidden" name="time" value="">

                    <div class="ibox-content"> 
                        <h1 class="text-center"><i class="fa fa-fw fa-clock-o"></i><span id="timer">{{$exercise->seconds}}</span> </h1>
                        <table class="table table-no-border">
                            <tr>
                                <th>{!! $exercise->instruction !!}</th>
                            </tr>
                        </table>
                        <hr>
                        <div class="table-responsive" style="background-color: #1e1e1e; color: #f0f0f0; padding: 20px">
                            {!! $exercise->program !!}
                        </div>
                    </div>
                    <div class="ibox-footer">
                        <div class="">
                            <button class="btn btn-success btn-sm" id="btnSubmit" type="submit">Submit answer</button>
                        </div>
                    </div>
                </form>

                <form id="frm_next" hidden="hidden" method="post" action="{{ route('student.ass-exercises.store') }}" onsubmit="btnSubmit.disabled = true">
                    @csrf
                    @method('POST')
                    <input type="hidden" name="assessment_id" value="{{$assessment->id}}">
                    <input type="hidden" name="exercise_id" value="{{$exercise->id}}">
                    <input type="hidden" name="time" value="-1">

                    <div class="ibox-content text-center"> <br><br><br><br><br><br>
                        <h1 class="text-center text-danger"><i class="fa fa-fw fa-clock-o"></i><span>0s</span> </h1>
                        <h1>Time is up</h1>
                    </div>
                    <div class="ibox-footer text-center">
                        <div class="">
                            <button class="btn btn-default btn-lg" id="btnSubmit" type="submit">Next <i class="fa fa-fw fa-arrow-right"></i></button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

</div>
@endsection

@section('script')
<script>
    // $("#frm_next").hide();
    var timer = $('#timer').html();
    setInterval(function() {
        $("#timer").html(timer--);
        
        if (timer <= 10) {
            $("#timer").addClass('text-danger');
        }

        if (timer <= 0) {
            $("#timer").html('TIME IS UP');
            $("#frm_exercise").hide();
            $("#frm_next").removeAttr('hidden');
        }

    }, 1000);
</script>
@endsection
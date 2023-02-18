@extends ('layouts.officer.master')
@section ('title')
  Dashboard
@endsection
@section ('reports')
  active
@endsection

@section ('per-question')
  active
@endsection

<style>
    @media print {
        #panel {
            visibility: hidden;
        }
    }
</style>


@section ('body')
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-12">
            <center>
                <br>
                <h4>Marinduque State College</h4>
                <h2>CEIIT Software Development Track Assessment Reports</h2>
                <h3>Exam results per question</h3>
            </center>
        </div>
    </div>
    <div class="wrapper wrapper-content">
        
        <form method="get" id="panel" onsubmit="btnSubmit.disabled = true">
            <div class="ibox-content">
                <label class="">Languages</label>
                <select onchange="loadElement('/officer/AJAX/set/'+this.value, 'set')" name="prog_language_id" class="">
                    <option value="">--</option>
                    @forelse ($languages as $language)
                        <option value="{{ $language->id }}" {{$request->prog_language_id == $language->id ? 'selected' : ''}}>{{ $language->language }}</option>
                    @empty
                    @endforelse
                </select>

                &nbsp; &nbsp;

                <label class="">Set</label>
                <select name="set" id="set">
                    @forelse ($sets as $set)
                        <option value="{{ $set->id }}" {{$request->set == $set->id ? 'selected' : ''}}>{{ $set->question_set }}</option>
                    @empty
                    @endforelse
                </select>
               
                <a onclick="print()" class="btn btn-success pull-right btn-sm text-white"><i class="fa fa-fw fa-print"></i>  Print</a>
                <button class="btn btn-default pull-right btn-sm" id="btnSubmit" type="submit"> Go<i class="fa fa-fw fa-chevron-right"></i></button>
            </div>
        </form>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th style="width: 10px">#</th>
                    <th>Questions</th>
                    <th>Passed</th>
                    <th>Failed</th>
                </tr>
            </thead>
            <tbody>
                @php $ctr = 1; @endphp
                @forelse ($questions as $question)
                    <tr>
                        <th>{{$ctr++}}.</th>
                        <td>{!! $question->question !!}</td>
                        <td>{{ $quizClass->resultPerQuestion($question->id, 1) }}</td>
                        <td>{{ $quizClass->resultPerQuestion($question->id, 0) }}</td>
                    </tr>
               @empty
               @endforelse
            </tbody>
        </table>
    </div>
@endsection
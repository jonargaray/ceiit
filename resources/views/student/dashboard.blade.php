@extends ('layouts.student.master')
@section ('title')
  Dashboard
@endsection

@section ('body')
  
<!-- <div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-12">
        <h2>Subscibe</h2>
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                Step 1
            </li>
            <li class="breadcrumb-item active font-bold">
                Choose the plan that’s right for you
            </li>
        </ol>
    </div>
</div>  -->
<div class="wrapper wrapper-content">
    

     <div class="ibox-content m-b-sm border-bottom">
        <div class="">
            <h1>Welcome to CEIIT Track Assessment</h1>
            <span>You can test your Programming skills with CTA.</span>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-4">
            @forelse($languages as $language)
            <h2 class="text-success"> &nbsp; {{ $language->language }}</h2>
                <hr>
                <h3><i class="fa fa-fw"></i> Quiz ({{ count($language->questions) }})</h3>
                <h3><i class="fa fa-fw"></i> Exercices </h3>
                <ul class="nav nav-tabs">
                    @forelse($language->topics as $topic)
                        <li style="width: 100%"><a class="nav-link" href=""><i class="fa fa-fw fa-chevron-right"></i> {{ $topic->topic }} ({{ count($topic->exercises) }})</a></li>
                    @empty
                    @endforelse
                </ul>
                @empty
            @endforelse
        </div>
        <div class="col-md-6">
            @if (count($assessments) == 0)
                <br>
                <br>
                <img alt="image" class=""  src="{{url('/images/code.jpg')}}" width="100%" />
                <br>
                <br>
                <a href="{{ route('student.assessments.quiz') }}" style="width: 100%; font-size: 20px; padding: 15px" class="btn btn-lg btn-success">Start Assessment <i class="fa fa-fw fa-arrow-right"></i> </a>
            @else
                <h2>Assessments</h2>
                <table class="table">
                    @forelse ($assessments as $assessment)
                        <tr>
                            <td>{{ $assessment->created_at }}</td>
                            <td>
                                <a href="{{route('student.assessments.result', $assessment->id)}}" class="btn btn-default btn-sm">View Result</a>
                            </td>
                        </tr>
                    @empty
                    @endforelse
                </table>
            @endif
        </div>
    </div>
</div>
@endsection
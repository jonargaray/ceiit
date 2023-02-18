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
            <h1>Programming Langauge
                <!-- <a href="{{ route('officer.languages.create') }}" class="btn btn-xs btn-success dim" type="button"><i class="fa fa-fw fa-plus"></i> Add New</a> -->
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
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox ">

                    @include('layouts.widgets.alert')
                    
                    <div class="ibox-content" id="user_container"> 
                     <div class="table-responsive">
                        <table class="table table-hover">
                            <tbody>
                                @forelse($languages as $language)
                                <tr>
                                   <td>
                                        <h2>
                                            <i class="fa fa-fw fa-arrow-right"></i>
                                            {{ $language->language }}</td> 
                                        </h2> 
                                   <td>
                                        <a href="{{ route('officer.question-sets.index', $language->id) }}" class="btn btn-sm btn-default"> <i class="fa fa-fw fa-question"></i> Quiz</a>
                                        <a href="{{ route('officer.questions.exercise', $language->id) }}" class="btn btn-sm btn-default"><i class="fa fa-fw fa-code"></i> Exercise</a>
                                   </td> 
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="7" class="text-center text-danger">Empty</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                     </div>
                    </div>
                </div>
            </div>
        </div>
        
    </div>
@endsection
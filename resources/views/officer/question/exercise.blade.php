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
                <a href="{{ route('officer.languages.index' ) }}"><i class="fa fa-fw fa-arrow-left text-black"></i></a>
                Excercises
                <a href="{{ route('officer.topics.create', $request->prog_language_id) }}" class="btn btn-xs btn-success dim" type="button"><i class="fa fa-fw fa-plus"></i> Add New Topic</a>
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
                </form>
                <div class="ibox">
                    <div class="ibox-content"> 
                        <h2>Topics</h2>
                        <div class="table-responsive">
                            <table class="table">
                                @forelse ($topics as $topic)
                                <tr>
                                   <th>
                                        <a href="{{ route('officer.exercises.index', [$request->prog_language_id, $topic->id]) }}"><i class="fa fa-chevron-right"></i> {{ $topic->topic }}</a>
                                    </th>
                                    <th>
                                        <a href="{{ route('officer.topics.edit', $topic->id) }}">Edit</a>
                                    </th>
                                </tr>
                                @empty
                                <tr>
                                    <td class="text-muted">No topic available</td>
                                </tr>
                                @endforelse
                            </table>
                        </div>
                    </div>
                </div>
                
            </div>
        </div>
        
    </div>
@endsection
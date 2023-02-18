@extends ('layouts.officer.master')
@section ('title')
  Dashboard
@endsection
@section ('reports')
  active
@endsection

@section ('passed-failed')
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
                <h3>List of {{ $request->remarks == 1 ? 'Passers' : 'Failures'}} {{ $request->year }} </h3>
            </center>
        </div>
    </div>
    <div class="wrapper wrapper-content">
        
        <form method="get" id="panel" onsubmit="btnSubmit.disabled = true">
            <div class="ibox-content">
                <label class="">Remarks</label>
                <select name="remarks" class="">
                    <option value="1" {{$request->remarks == '1' ? 'selected' : '' }}>Passed</option>
                    <option value="0" {{$request->remarks == '0' ? 'selected' : '' }}>Failed</option>
                </select>
                &nbsp;&nbsp;&nbsp;
                <label class="">Year </label>
                <select name="year" class="">
                    @for ($i=date('Y'); $i>=2020; $i--)
                        <option value="{{$i}}" {{$i == $request->year ? 'selected' : '' }}>{{$i}}</option>
                    @endfor
                </select>
                <a onclick="print()" class="btn btn-success pull-right btn-sm text-white"><i class="fa fa-fw fa-print"></i>  Print</a>
                <button class="btn btn-default pull-right btn-sm" id="btnSubmit" type="submit"> Go<i class="fa fa-fw fa-chevron-right"></i></button>
            </div>
        </form>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th style="width: 10px">#</th>
                    <th>Name</th>
                    <th>Remarks</th>
                </tr>
            </thead>
            <tbody>
                @php $ctr = 0; @endphp
                @forelse($assessments as $assessment)
                    @php $ctr++ @endphp
                    <tr>
                        <th>{{$ctr}}.</th>
                        <td>{{ $assessment->first_name }} {{ $assessment->last_name }}</td>
                        <td>{{ $assessment->remarks}}%</td>
                    </tr>
                @empty
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
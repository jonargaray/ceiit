@extends ('layouts.officer.master')
@section ('title')
  Dashboard
@endsection
@section ('student')
  active
@endsection

@section ('body')
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-12">
            <h1>
            <a href="{{ route('officer.users.assessments', $assessment->user_id) }}"><i class="fa fa-fw fa-arrow-left text-black"></i></a>    
                Assessment
            </h1>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    Dashboard
                </li>
                <li class="breadcrumb-item">
                    Students
                </li>
                <li class="breadcrumb-item active">
                    Assessment
                </li>
            </ol>
        </div>
    </div>
    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox ">
                    <div class="ibox-content">
                        <table class="table">
                            <tr>
                                <th width="150px">Student Name</th>
                                <td>{{ $assessment->first_name }} {{ $assessment->last_name }}</td>
                            </tr>
                            <tr>
                                <th>Student Number</th>
                                <td>{{ $assessment->student_num }}</td>
                            </tr>
                            <tr>
                                <th>Assessment Date</th>
                                <td>{{ $assessment->created_at }}</td>
                            </tr>
                            <tr>
                                <th>Final Remarks</th>
                                <td>{{ $assessment->remarks >= 50 ? 'Compatible to take Software Development Track' : 'Failed to take Software Development Track' }}</td>
                            </tr>
                        </table>
                        <br>
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th>Indicators</th>
                                @forelse ($languages as $language)
                                <th width="100px" class="text-center">{{ $language->language }}</th>
                                @empty
                                @endforelse
                                <th class="text-center">Remarks</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>Skil Assessment Result</td>
                                @forelse ($languages as $language)
                                <th>
                                    {{ round($quizClass->percentage($request->assessment_id, $language->id), 1) }}%
                                </th>
                                @empty
                                @endforelse
                                <th></th>
                            </tr>
                            <tr>
                                <td>Efficiency Assessment Result</td>
                                <th>{{ round($assessment->c_e, 1) }}%</th>
                                <th>{{ round($assessment->p_e, 1) }}%</th>
                                <th></th>
                            </tr>
                            <tr>
                                <td>Combined Result</td>
                                <th>{{ $assessment->c_c }}%</th>
                                <th>{{ $assessment->p_c }}%</th>
                                <th>{{ $assessment->remarks }}% ({{ $assessment->remarks > 50 ? 'Passed' : 'Failed' }})</th>
                            </tr>
                            </tbody>
                        </table>
                        <br>
                        0% - 49% = FAILED <br>
                        50% - 100% = PASSED <br>

                        <br>
                        <div class="row">
                <div class="col-md-6">
                  <div class="ibox ">
                      <div class="ibox-title">
                          <h5>C# Skil Assessment Result</h5>
                      </div>
                      <div class="ibox-content">
                          <div>
                              <div id="c_q_pie"></div>
                          </div>
                      </div>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="ibox ">
                      <div class="ibox-title">
                          <h5>PYTHON Skil Assessment Result</h5>
                      </div>
                      <div class="ibox-content">
                          <div>
                              <div id="p_q_pie"></div>
                          </div>
                      </div>
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col-md-6">
                  <div class="ibox ">
                      <div class="ibox-title">
                          <h5>C# Efficiency Assessment Result </h5>
                      </div>
                      <div class="ibox-content">
                          <div>
                              <div id="c_e_pie"></div>
                          </div>
                      </div>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="ibox ">
                      <div class="ibox-title">
                          <h5>PYTHON Efficiency Assessment Result </h5>
                      </div>
                      <div class="ibox-content">
                          <div>
                              <div id="p_e_pie"></div>
                          </div>
                      </div>
                  </div>
                </div>
              </div>

                        </div>
                </div>
            </div>
        </div>
        
    </div>
@endsection

@section('script')
<script>

    c_q = '{{$assessment->c_q}}';
    p_q = '{{$assessment->p_q}}';
    c_e = '{{$assessment->c_e}}';
    p_e = '{{$assessment->p_e}}';

    $(document).ready(function () {
      c3.generate({
          bindto: '#c_q_pie',
          data:{
              columns: [
                  ['Correct', c_q],
                  ['Wrong', 100 - c_q]
              ],
              colors:{
                  data1: '#1ab394',
                  data2: '#BABABA'
              },
              type : 'pie'
          }
      });

      c3.generate({
          bindto: '#p_q_pie',
          data:{
              columns: [
                  ['Correct', p_q],
                  ['Wrong', 100 - p_q]
              ],
              colors:{
                  data1: '#1ab394',
                  data2: '#BABABA'
              },
              type : 'pie'
          }
      });

      c3.generate({
          bindto: '#c_e_pie',
          data:{
              columns: [
                  ['Correct', c_e],
                  ['Wrong', 100 - c_e]
              ],
              colors:{
                  data1: '#1ab394',
                  data2: '#BABABA'
              },
              type : 'pie'
          }
      });

      c3.generate({
          bindto: '#p_e_pie',
          data:{
              columns: [
                  ['Correct', p_e],
                  ['Wrong', 100 - p_e]
              ],
              colors:{
                  data1: '#1ab394',
                  data2: '#BABABA'
              },
              type : 'pie'
          }
      });

    });
  </script>
@endsection
@extends ('layouts.officer.master')
@section ('title')
Dashboard
@endsection
@section ('dashboard')
active
@endsection

@section ('body')

<div class="wrapper wrapper-content">
    <div class="row">
        <div class="col-lg-3">
            <div class="ibox ">
                <div class="ibox-title">
                    <h5>Students</h5>
                </div>
                <div class="ibox-content">
                    <h1 class="no-margins">{{ count($students) }}</h1>
                    
                </div>
            </div>
        </div>
        <div class="col-lg-3">
            <div class="ibox ">
                <div class="ibox-title">
                    <h5>With Assesments</h5>
                </div>
                <div class="ibox-content">
                    <h1 class="no-margins">{{ count($withAssessments) }}</h1>
                    
                </div>
            </div>
        </div>
        <div class="col-lg-3">
            <div class="ibox ">
                <div class="ibox-title">
                    <h5>Passed</h5>
                </div>
                <div class="ibox-content">
                    <h1 class="no-margins">{{ count($passers) }}</h1>
                    <div class="stat-percent font-bold text-info">
                        @if (count($passers) > 0)
                            {{ round(count($passers)/count($students) * 100, 0)}} %
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3">
            <div class="ibox ">
                <div class="ibox-title">
                    <h5>Failed</h5>
                </div>
                <div class="ibox-content">
                    <h1 class="no-margins">
                            {{ count($failures) }}</h1>
                    <div class="stat-percent font-bold text-navy">
                        @if (count($failures) > 0)
                            {{ round(count($failures)/count($students) * 100, 0)}} % 
                        @endif    
                        </div>

                </div>
            </div>
        </div>
    </div>

    <!-- <div class="row">
        <div class="col-lg-12">
            <div class="ibox ">
                <div class="ibox-title">
                    <h5>Orders</h5>
                </div>
                <div class="ibox-content">
                    <div class="row">
                    <div class="col-lg-9">
                        <div class="flot-chart">
                            <div class="flot-chart-content" id="flot-dashboard-chart"></div>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <ul class="stat-list">
                            <li>
                                <h2 class="no-margins">2,346</h2>
                                <small>Total orders in period</small>
                                <div class="stat-percent">48% <i class="fa fa-level-up text-navy"></i></div>
                                <div class="progress progress-mini">
                                    <div style="width: 48%;" class="progress-bar"></div>
                                </div>
                            </li>
                            <li>
                                <h2 class="no-margins ">4,422</h2>
                                <small>Orders in last month</small>
                                <div class="stat-percent">60% <i class="fa fa-level-down text-navy"></i></div>
                                <div class="progress progress-mini">
                                    <div style="width: 60%;" class="progress-bar"></div>
                                </div>
                            </li>
                            <li>
                                <h2 class="no-margins ">9,180</h2>
                                <small>Monthly income from orders</small>
                                <div class="stat-percent">22% <i class="fa fa-bolt text-navy"></i></div>
                                <div class="progress progress-mini">
                                    <div style="width: 22%;" class="progress-bar"></div>
                                </div>
                            </li>
                            </ul>
                        </div>
                    </div>
                    </div>

                </div>
            </div>
        </div>
    </div> -->

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


@endsection

@section('script')

  <script>

    withAssessments = '{{ count($withAssessments) }}';
    c_q = '{{ $c_q }}';
    p_q = '{{ $p_q }}';
    c_e = '{{ $c_e }}';
    p_e = '{{ $p_e }}';

    $(document).ready(function () {
      c3.generate({
          bindto: '#c_q_pie',
          data:{
              columns: [
                  ['Passed', c_q],
                  ['Failed', withAssessments - c_q]
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
                  ['Passed', p_q],
                  ['Failed', withAssessments - p_q]
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
                  ['Passed', c_e],
                  ['Failed', withAssessments - c_e]
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
                    ['Passed', p_e],
                    ['Failed', withAssessments - p_e]
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
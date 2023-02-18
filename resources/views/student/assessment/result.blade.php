@extends ('layouts.student.master')
@section ('title')
  Dashboard
@endsection

@section ('body')

<div class="wrapper wrapper-content">
  <h1>Assessment Result</h1>

    <div class="row">
        <div class="col-md-12">
          <div class="ibox">
            <div class="ibox-content">
              <table class="table table-bordered">
                <tr>
                  <th width="150px">Student Name</th>
                  <td>{{ Auth::user()->first_name }} {{ Auth::user()->last_name }}</td>
                </tr>
                <tr>
                  <th>Student Number</th>
                  <td>{{ Auth::user()->student_num }}</td>
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
                    <th>Skil Assessment Result ({{ $gradingSystem->quiz }})%</th>
                    @forelse ($languages as $language)
                      <th>
                        <input type="text" hidden id="QUIZ_{{$language->id}}" value="{{ $quizClass->percentage($request->assessment_id, $language->id) }}">
                         {{ round($quizClass->percentage($request->assessment_id, $language->id), 1) }}%
                      </th>
                    @empty
                    @endforelse
                  </tr>
                  <tr>  
                    <th>Efficiency Assessment Result ({{ $gradingSystem->exercise }})%</th>
                    @forelse ($languages as $language)
                      <th>
                        @php 
                          $exercises = $exerciseClass->activeByLanguage($language->id);
                          $totalPercentage = 0;
                        @endphp

                        @forelse ($exercises  as $exercise)
                          @php 
                            $pecentage = 0;
                            if ($assExerciseClass->findByExercise($request->assessment_id, $exercise->exercise_id)->score > 0) {
                              $pecentage = ($assExerciseClass->findByExercise($request->assessment_id, $exercise->exercise_id)->score / $exercise->answer_count) * (100 / $exercises->count());
                            }
                           
                              $totalPercentage =  round($totalPercentage + $pecentage, 1);
                              if ($totalPercentage >= 99.9) {
                                $totalPercentage =  100;
                              }

                          @endphp
                        @empty
                        @endforelse
                        <input type="text" hidden id="EXERCISE_{{$language->id}}" value="{{ $totalPercentage }}">
                        {{ round($totalPercentage, 1) }}%
                      </th>
                    @empty
                    @endforelse
                  </tr>
                  <tr>
                    <th>Combined Result</th>
                    <th id="RESULT_C"></th>
                    <th id="RESULT_P"></th>
                    <th id="REMARKS"></th>
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

    <div id="result"></div>

</div>
@endsection

@section('script')
  <script>
      var assessmentId = '{{ $request->assessment_id }}';
      var quiz = '{{ $gradingSystem->quiz }}';
      var exercise = '{{ $gradingSystem->exercise }}';
      var cQuiz = $('#QUIZ_1').val();
      var pQuiz = $('#QUIZ_2').val();
      var cExercise = $('#EXERCISE_1').val();
      var pExercise = $('#EXERCISE_2').val();
      
      cQuizPercentage = (quiz/100 * cQuiz/100);
      pQuizPercentage = (quiz/100 * pQuiz/100);

      cExercisePercentage = (exercise/100 * cExercise/100);
      pExercisePercentage = (exercise/100 * pExercise/100);

      cPercentage =  Math.round(parseFloat((cQuizPercentage + cExercisePercentage) * 100))
      pPercentage =  Math.round(parseFloat((pQuizPercentage + pExercisePercentage) * 100))
      remarks =  Math.round(parseFloat(((cPercentage * .5) + (pPercentage * .5))))

      result = 'Failed';

      if (remarks >= 50) {
        result = 'Passed';
      }
      
      $('#RESULT_C').html(cPercentage+'%');
      $('#RESULT_P').html(pPercentage+'%');
      $('#REMARKS').html(Math.round(remarks) +'% ' + '('+result+')');

  </script>

  <script>
    loadPage('/student/assessments/store-result/'+assessmentId+'/'+cQuiz+'/'+pQuiz+'/'+cExercise+'/'+pExercise+'/'+cPercentage+'/'+pPercentage+'/'+remarks, 'result');
  </script>

  <script>
    $(document).ready(function () {
      c3.generate({
          bindto: '#c_q_pie',
          data:{
              columns: [
                  ['Correct', cQuiz],
                  ['Wrong', 100 - cQuiz]
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
                  ['Correct', pQuiz],
                  ['Wrong', 100 - pQuiz]
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
                  ['Correct', cExercise],
                  ['Wrong', 100 - cExercise]
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
                  ['Correct', pExercise],
                  ['Wrong', 100 - pExercise]
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
<?php

namespace App\Http\Controllers;

use DB;
use Auth;
use Cache;
use Illuminate\Http\Request;
use App\Models\Choice;
use App\Models\Topic;
use App\Models\Question;
use App\Models\Checklist;
use App\Models\Exercise;
use App\Models\QuestionSet;
use App\Models\ProgLanguage;
use App\Models\ExerciseChecklist;
use App\Models\Assessment;
use App\Models\AssExercise;
use App\Models\Quiz;
use Illuminate\Support\Str;
use App\Http\Services\CustomFunction;

class AssExerciseController extends Controller
{
    public function store(Request $request)
    {  

        $current = (new Checklist)->current($request->assessment_id);
        $exercises = Exercise::select('id')->where('topic_id', $current->topic_id)->get();
        $topicExerciseArray = [];

        foreach ($exercises as $topicExercise) {
            $topicExerciseArray[] = $topicExercise->id;
        }

        $score = 0;
        $answers = '';
        $ctr = 1;

        if ($request->time != -1) {
            foreach ($request->answers as $answer)
            {
                $ctr != count($request->answers) ? $answers .= $answer.'SEPERATOR' : $answers .= $answer;
                $ctr++;
            }

            $exercise = Exercise::find($request->exercise_id);
            $exerAnswers = (new CustomFunction)->stringToArray('SEPERATOR', $exercise->answers);
            

            for ($i=0; $i< count($exerAnswers); $i++) {
                $exerAnswers[$i] == $request->answers[$i] ? $score++ : 0;
            }
        }
        
        AssExercise::create([
            'assessment_id' => $request->assessment_id,
            'exercise_id' => $request->exercise_id,
            'answers' => $answers,
            'score' => $score,
        ]);

        ExerciseChecklist::where('exercise_id', $request->exercise_id)->update(['status' => 1]);

        $incompletedExercises = ExerciseChecklist::whereIn('exercise_id', $topicExerciseArray)->where('status', 0)->get();
        
        if (count($incompletedExercises) == 0) {
            Checklist::where('id', $current->id)->update(['status' => 1]);
        }
        
        return redirect()
            ->route('student.assessments.quiz')
            ->with(['success' => 'Successfully Added.']);
    }

}

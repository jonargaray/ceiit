<?php

namespace App\Http\Controllers;

use DB;
use Auth;
use Cache;
use Illuminate\Http\Request;
use App\Models\Choice;
use App\Models\Exercise;
use App\Models\Topic;
use App\Models\Question;
use App\Models\ExerciseChecklist;
use App\Models\GradingSystem;
use App\Models\AssExercise;
use App\Models\Checklist;
use App\Models\QuestionSet;
use App\Models\ProgLanguage;
use App\Models\Assessment;
use App\Models\Quiz;
use Illuminate\Support\Str;
use App\Http\Services\CustomFunction;

class AssessmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function quiz(Request $request)
    {  
        $languages = (new ProgLanguage)->getAll();

        $assessment = Assessment::firstOrCreate([
            'user_id' => Auth::user()->id,
        ]);
        
        foreach ($languages as $language) {
            $checklist = Checklist::firstOrCreate([
                'assessment_id' => $assessment->id,
                'prog_language_id' => $language->id
            ]);

            foreach ($language->topics as $topic) {
                if (count($topic->exercises) > 0) {
                    $checklist = Checklist::firstOrCreate([
                        'assessment_id' => $assessment->id,
                        'prog_language_id' => $language->id,
                        'topic_id' => $topic->id
                    ]);
    
                    $exercises = Exercise::select('id')->where('topic_id', $topic->id)->get();
    
                    foreach ($exercises as $exercise) {
                        ExerciseChecklist::firstOrCreate([
                            'assessment_id' => $assessment->id,
                            'exercise_id' => $exercise->id,
                        ]);
                    }
                }
            }
        }

        $current = (new Checklist)->current($assessment->id);
        $completes = (new Checklist)->completes($assessment->id);
        $completeArray = [];

        foreach ($completes as $complete) {
            $completeArray[] = $complete->topic_id;
        }

        if (!$current) {
            return redirect()->route('student.assessments.result', $assessment->id);
        }

        if ($current->topic_id == 0) {

            $questionSet = (new QuestionSet)->findActivated($current->prog_language_id);
            
            $questions = (new Question)->getAll((object) [
                'prog_language_id' => $current->prog_language_id,
                'question_type_id' => $request->question_type_id,
                'question_set_id' => $questionSet->id,
            ]);
            
            return view('student.assessment.quiz', [
                'languages' => $languages,
                'questions' => $questions,
                'questionSet' => $questionSet,
                'assessment' => $assessment,
                'currentLanguage' => $current,
                'completeArray' => $completeArray,
            ]);
        }

        // Exercise
        $currentExercise = (new ExerciseChecklist)->current($assessment->id);
        $completeExercises = (new ExerciseChecklist)->completes($assessment->id);
        $completeExerciseArray = [];

        foreach ($completeExercises as $completeExercise) {
            $completeExerciseArray[] = $completeExercise->exercise_id;
        }

        $exercise = Exercise::find($currentExercise->exercise_id);
        
        return view('student.assessment.exercise', [
            'languages' => $languages,
            'exercise' => $exercise,
            'assessment' => $assessment,
            'currentLanguage' => $current,
            'completeArray' => $completeArray,
            'completeExerciseArray' => $completeExerciseArray,
        ]);
    }

    public function storeQuiz(Request $request)
    {
        $quizzes = [];

        $questions = (new Question)->getAll((object) [
            'prog_language_id' => $request->prog_language_id,
            'question_type_id' => $request->question_type_id,
        ]);

        foreach ($questions as $question) {
            $quizzes[] = [
                'assessment_id' => $request->assessment_id,
                'question_id' => $question->id,
                'choice_id' => $request->input('answer'.$question->id),
                'correct' => $request->input('answer'.$question->id) == $question->correct_answer_id ? true : false
            ];
        }

        DB::table('quizzes')->insert($quizzes);
    }

    public function result (Request $request)
    {
        $assessment = Assessment::find($request->assessment_id);

        if (empty($assessment)) {
            return redirect()->route('student.dashboards.index');
        }else {
            Assessment::find($request->assessment_id)
            ->update([
                'status' => 1,
            ]);

        }
        
        return view('student.assessment.result', [
            'languages' => $languages = (new ProgLanguage)->getAll(),
            'quizClass' => new Quiz,
            'request' => $request,
            'gradingSystem' => (new GradingSystem)->activeSet(),
            'exerciseClass' => new Exercise,
            'assExerciseClass' => new AssExercise,
            'assessment' => $assessment,
        ]);
    }

    public function storeResult(Request $request)
    {
        Assessment::find($request->assessment_id)
            ->update([
                'status' => 1,
                'c_q' => $request->c_q,
                'p_q' => $request->p_q,
                'c_e' => $request->c_e,
                'p_e' => $request->p_e,
                'c_c' => $request->c_c,
                'p_c' => $request->p_c,
                'remarks' => $request->remarks,
                'passed' => $request->remarks >= 50 ? 1 : 0,
            ]);

    }
}

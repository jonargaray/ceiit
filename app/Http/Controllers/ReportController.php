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

class ReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function passedFailed(Request $request)
    {  
        return view('officer.reports.passed-failed', [
            'request' => $request,
            'assessments' => $request->year ? (new Assessment)->filterByRemarks($request->remarks, $request->year) : [],
       ]);
    }

    public function perQuestion(Request $request)
    {
        $questions = [];
        $sets = [];

        if ($request->set) {
            $questions = Question::where('question_type_id', $request->set)
                ->select('question', 'id')
                ->get();
        }

        if ($request->prog_language_id) {
            $sets = QuestionSet::where('prog_language_id', $request->prog_language_id)->get();
        }

        return view('officer.reports.per-question', [
            'languages' => (new ProgLanguage)->getAll(),
            'questions' => $questions,
            'request' => $request,
            'sets' => $sets,
            'quizClass' => (new Quiz)
        ]);
    }
}

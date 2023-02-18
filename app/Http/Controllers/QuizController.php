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
use App\Models\QuestionSet;
use App\Models\ProgLanguage;
use App\Models\Assessment;
use App\Models\Quiz;
use Illuminate\Support\Str;
use App\Http\Services\CustomFunction;

class QuizController extends Controller
{
    public function store(Request $request)
    {  

        $questions = (new Question)->getAll((object) [
            'prog_language_id' => $request->prog_language_id,
            'question_type_id' => 1,
            'question_set_id' => $request->question_set_id,
        ]);

        foreach ($questions as $question)
        {   
            $correctAnswerId = Question::where('id', $question->id)->select('correct_answer_id')->first()->correct_answer_id; 

            $quiz = Quiz::create([
                'assessment_id' => $request->assessment_id,
                'question_id' => $question->id,
                'choice_id' => $request->input('answer'.$question->id),
                'status' => $request->input('answer'.$question->id) == $correctAnswerId ? true : false,
            ]);
        }

        Checklist::where('assessment_id', $request->assessment_id)->where('status', 0)->first()->update(['status' => 1]);

        return redirect()
            ->route('student.assessments.quiz')
            ->with(['success' => 'Successfully Added.']);
    }


}

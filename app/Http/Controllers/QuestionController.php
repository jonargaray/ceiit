<?php

namespace App\Http\Controllers;

use DB;
use Auth;
use Cache;
use Illuminate\Http\Request;
use App\Models\Choice;
use App\Models\Topic;
use App\Models\Question;
use App\Models\QuestionSet;
use App\Models\ProgLanguage;
use App\Models\QuestionType;
use Illuminate\Support\Str;
use App\Http\Services\CustomFunction;

class QuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $sets = (new QuestionSet)->getByLanguage((object) ['prog_language_id' => $request->prog_language_id]);

        return view('officer.question.index', [
            'request' => $request,
            'sets' => $sets,
            'selectedSet' => (new QuestionSet)->findById($request->question_set_id),
            'languages' => (new ProgLanguage)->getAll(),
            'types' => (new QuestionType)->getAll(),
            'questions' => (new Question)->getAll((object) [
                'prog_language_id' => $request->prog_language_id,
                'question_type_id' => $request->question_type_id,
                'question_set_id' => $request->question_set_id,
            ]),
        ]);
    }

    public function exercise(Request $request)
    {
        return view('officer.question.exercise', [
            'request' => $request,
            'languages' => (new ProgLanguage)->getAll(),
            'types' => (new QuestionType)->getAll(),
            'topics' => (new Topic)->getByLanguage((object) [
                'prog_language_id' => $request->prog_language_id,
                'question_type_id' => $request->question_type_id,
            ]),
        ]);
    }

    public function create(Request $request)
    {
        $sets = (new QuestionSet)->getByLanguage((object) ['prog_language_id' => $request->prog_language_id]);

        return view('officer.question.create', [
            'request' => $request,
            'numbering' => (new Question)->nextNumbering($request->prog_language_id, $request->question_set_id),
            'languages' => (new ProgLanguage)->getAll(),
            'sets' => $sets,
            'types' => (new QuestionType)->getAll(),
        ]);
    }

    public function store(Request $request) 
    {
        
        $ctr = 0;

        $question = Question::firstOrCreate([
            'question_set_id' => $request->question_set_id,
            'question' => $request->question,
            'prog_language_id' => $request->prog_language_id,
        ], [
            'question_type_id' => 1,
            'numbering' => (new Question)->nextNumbering($request->prog_language_id, $request->question_set_id),
            'correct_answer_id' => $request->correct_answer,
        ]);

        foreach ($request->choices as $choice) {

            if ($choice !== null) {
                $choice = Choice::create([
                    'question_id' => $question->id,
                    'choice' => $choice,
                ]);

                if ($ctr == $request->correct_answer) {
                    $question->update([
                        'correct_answer_id' => $choice->id
                    ]);
                }
            }

            $ctr++;
        }

        return redirect()
            ->route('officer.questions.index', [$request->prog_language_id, $request->question_set_id])
            ->with(['success' => 'Successfully Added.']);
    }


    public function edit(Question $question) 
    {
        $sets = (new QuestionSet)->getByLanguage((object) ['prog_language_id' => $question->prog_language_id]);

        return view('officer.question.edit', [
            'question' => $question,
            'languages' => (new ProgLanguage)->getAll(),
            'sets' => $sets,
            'choices' => (new Choice)->filterByQuestion($question->id)
        ]);
    }

    public function update(Question $question, Request $request) 
    {
    
        $question->update([
            'question' => $request->question,
            'correct_answer_id' => $request->correct_answer,
        ]);

        return redirect()
            ->route('officer.questions.index', [$question->prog_language_id, $question->question_set_id])
            ->with(['success' => 'Successfully Updated.']);
    }
}

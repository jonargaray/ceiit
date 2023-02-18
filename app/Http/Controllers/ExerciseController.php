<?php

namespace App\Http\Controllers;

use DB;
use Auth;
use Cache;
use Illuminate\Http\Request;
use App\Models\Topic;
use App\Models\Exercise;
use App\Models\ProgLanguage;
use App\Models\QuestionType;
use Illuminate\Support\Str;
use App\Http\Services\CustomFunction;

class ExerciseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return view('officer.exercise.index', [
            'request' => $request,
            'languages' => (new ProgLanguage)->getAll(),
            'topics' => (new Topic)->getByLanguage((object) [
                'prog_language_id' => $request->prog_language_id,
            ]),
            'exercises' => (new Exercise)->getByTopic((object) [
                'prog_language_id' => $request->prog_language_id,
                'topic_id' => $request->topic_id,
            ]),
        ]);
    }

    public function create(Request $request)
    {
        return view('officer.exercise.create', [
            'request' => $request,
            'languages' => (new ProgLanguage)->getAll(),
            'types' => (new QuestionType)->getAll(),
            'topics' => (new Topic)->getByLanguage((object) [
                'prog_language_id' => $request->prog_language_id,
                'question_type_id' => $request->question_type_id,
            ]),
            'generated' => ''
        ]);
    }

    public function generate(Request $request)
    {
        if ($request->redirect == 'edit') {
            $exercise = (new Exercise)->findById($request->exercise_id);
            return view('officer.exercise.edit', [
                'request' => $request,
                'exercise' => $exercise,
                'languages' => (new ProgLanguage)->getAll(),
                'types' => (new QuestionType)->getAll(),
                'topics' => (new Topic)->getByLanguage((object) [
                    'prog_language_id' => $request->prog_language_id,
                    'question_type_id' => $request->question_type_id,
                ]),
                'generated' => str_replace('BLANK', '<input type="text" class="blank" style="width:100px" name="answers[]" id="answers[]" required />', $request->program),
            ]);
        }

        return view('officer.exercise.create', [
            'request' => $request,
            'languages' => (new ProgLanguage)->getAll(),
            'types' => (new QuestionType)->getAll(),
            'topics' => (new Topic)->getByLanguage((object) [
                'prog_language_id' => $request->prog_language_id,
                'question_type_id' => $request->question_type_id,
            ]),
            'generated' => str_replace('BLANK', '<input type="text" class="blank" style="width:100px" name="answers[]" id="answers[]" required />', $request->program),
        ]);
    }

    public function store(Request $request)
    {
        $answers = '';
        $ctr = 1;
        foreach ($request->answers as $answer)
        {
            $ctr != count($request->answers) ? $answers .= $answer.'SEPERATOR' : $answers .= $answer;
            $ctr++;
        }

        Topic::find($request->topic_id)->increment('exer_count');

        Exercise::create([
            'topic_id' => $request->topic_id,
            'program' => str_replace('BLANK', '<input type="text" class="answers" required style="width:100px" name="answers[]" id="answers[]" />', $request->program),
            'codes' => $request->program,
            'instruction' => $request->instruction,
            'answers' => $answers,
            'seconds' => $request->seconds,
            'answer_count' => $ctr - 1,
        ]);

        return redirect()
            ->route('officer.exercises.index', [$request->prog_language_id, $request->topic_id])
            ->with(['success' => 'Successfully Added.']);
    }

    public function edit(Exercise $exercise, Request $request)
    {
        
        $exercise = $exercise->findById($exercise->id);
        return view('officer.exercise.edit', [
            'request' => $request,
            'exercise' => $exercise,
            'languages' => (new ProgLanguage)->getAll(),
            'types' => (new QuestionType)->getAll(),
            'topics' => (new Topic)->getByLanguage((object) [
                'prog_language_id' => $exercise->prog_language_id,
                'question_type_id' => $exercise->question_type_id,
            ]),
            'generated' => ''
        ]);
    }

    public function update($id, Request $request)
    {
        $answers = '';
        // $ctr = 1;
        // foreach ($request->answers as $answer)
        // {
        //     $ctr != count($request->answers) ? $answers .= $answer.'SEPERATOR' : $answers .= $answer;
        //     $ctr++;
        // }
        
        Exercise::find($id)->update([
            'program' => str_replace('BLANK', '<input type="text" class="answers" required style="width:100px" name="answers[]" id="answers[]" />', $request->program),
            'codes' => $request->program,
            'instruction' => $request->instruction,
            // 'answers' => $answers,
            'seconds' => $request->seconds,
        ]);

        return redirect()
            ->route('officer.exercises.index', [$request->prog_language_id, $request->topic_id])
            ->with(['success' => 'Successfully Updated.']);
    }
        
}

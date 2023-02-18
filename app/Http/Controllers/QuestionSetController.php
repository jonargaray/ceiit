<?php

namespace App\Http\Controllers;

use DB;
use Auth;
use Cache;
use Illuminate\Http\Request;
use App\Models\Choice;
use App\Models\Topic;
use App\Models\Question;
use App\Models\ProgLanguage;
use App\Models\QuestionSet;
use App\Models\Quiz;
use Illuminate\Support\Str;
use App\Http\Services\CustomFunction;

class QuestionSetController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $sets = (new QuestionSet)->getByLanguage((object) ['prog_language_id' => $request->prog_language_id]);

        return view('officer.set.index', [
            'request' => $request,
            'languages' => (new ProgLanguage)->getAll(),
            'sets' => $sets,
        ]);
    }

    public function create(Request $request)
    {

        $alphabet = range('A', 'Z');
        $sets = (new QuestionSet)->getByLanguage((object) ['prog_language_id' => $request->prog_language_id]);

        return view('officer.set.create', [
            'request' => $request,
            'languages' => (new ProgLanguage)->getAll(),
            'sets' => $sets,
            'newSet' => $alphabet[count($sets)]
        ]);
    }

    public function store(Request $request) 
    {
        QuestionSet::firstOrCreate([
            'question_set' => $request->question_set,
            'prog_language_id' => $request->prog_language_id,
            ]);

        return redirect()
            ->route('officer.question-sets.index', $request->prog_language_id)
            ->with(['success' => 'Successfully Added.']);
    }

    public function update($id, Request $request) 
    {
        QuestionSet::where('prog_language_id', $request->prog_language_id)
            ->update([
                'status' => 0,
            ]);

        QuestionSet::find($id)
            ->update([
                'status' => 1,
            ]);

        return redirect()
            ->route('officer.questions.index', [$request->prog_language_id, $id])
            ->with(['success' => 'Successfully activated.']);
    }

    public function AJAX_select(Request $request)
    {
        return view('officer.ajax.set.select', [
            'sets' => QuestionSet::where('prog_language_id', $request->proglang_id)->get()
        ]);
    }
    
}

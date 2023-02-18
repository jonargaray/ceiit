<?php

namespace App\Http\Controllers;

use DB;
use Auth;
use Cache;
use Illuminate\Http\Request;
use App\Models\Topic;
use App\Models\Question;
use App\Models\ProgLanguage;
use App\Models\QuestionType;
use Illuminate\Support\Str;
use App\Http\Services\CustomFunction;

class TopicController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return view('officer.topic.index', [
            'request' => $request,
            'languages' => (new ProgLanguage)->getAll(),
            'types' => (new QuestionType)->getAll(),
        ]);
    }

    public function create(Request $request)
    {
        return view('officer.topic.create', [
            'request' => $request,
            'languages' => (new ProgLanguage)->getAll(),
            'types' => (new QuestionType)->getAll(),
        ]);
    }

    public function edit(Topic $topic, Request $request)
    {
        return view('officer.topic.edit', [
            'request' => $request,
            'topic' => $topic,
            'languages' => (new ProgLanguage)->getAll(),
            'types' => (new QuestionType)->getAll(),
        ]);
    }

    public function store(Request $request)
    {
        Topic::firstOrCreate([
            'topic' => $request->topic,
            'prog_language_id' => $request->prog_language_id,
            ]);

        return redirect()
            ->route('officer.questions.exercise', $request->prog_language_id)
            ->with(['success' => 'Successfully Added.']);
    }

    public function update(Topic $topic, Request $request)
    {
        Topic::find($topic->id)->update([
            'topic' => $request->topic,
            ]);

        return redirect()
            ->route('officer.questions.exercise', $topic->prog_language_id)
            ->with(['success' => 'Successfully Added.']);
    }
}

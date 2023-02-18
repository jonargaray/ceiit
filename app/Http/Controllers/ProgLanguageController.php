<?php

namespace App\Http\Controllers;

use DB;
use Auth;
use Cache;
use App\Models\ProgLanguage;
use App\Models\QuestionType;
use Illuminate\Support\Str;

class ProgLanguageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('officer.language.index', [
            'languages' => (new ProgLanguage)->getAll(),
            'types' => (new QuestionType)->getAll(),
        ]);
    }
}

<?php

namespace App\Http\Controllers;

use DB;
use Auth;
use Cache;
use App\Models\ProgLanguage;
use App\Models\Assessment;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class StudentDashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if (Auth::user()->status != 'Active') {
            return view('student.inactive');
        }
        
        return view('student.dashboard', [
            'languages' => (new ProgLanguage)->getAll(),
            'assessments' => (new Assessment)->filterByUser(Auth::user()->id),
        ]);
    }
}

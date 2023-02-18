<?php

namespace App\Http\Controllers;

use DB;
use Auth;
use Cache;
use App\Models\Assessment;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class OfficerDashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return view('officer.dashboard', [
            'students' => (new User)->filterByUserType('STUDENT'),
            'withAssessments' => (new User)->withAssessment('STUDENT'),
            'passers' => (new Assessment)->filterByRemarks(1),
            'failures' => (new Assessment)->filterByRemarks(0),
            'c_q' => (new Assessment)->passingCount('c_q'),
            'p_q' => (new Assessment)->passingCount('p_q'),
            'c_e' => (new Assessment)->passingCount('c_e'),
            'p_e' => (new Assessment)->passingCount('p_e'),
        ]);
    }
}

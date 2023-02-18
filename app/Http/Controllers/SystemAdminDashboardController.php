<?php

namespace App\Http\Controllers;

use DB;
use Auth;
use Cache;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class SystemAdminDashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return view('system-admin.dashboard', [
            'students' => (new User)->filterByUserType('STUDENT'),
            'officers' => (new User)->filterByUserType('OFFICER')
        ]);
    }
}

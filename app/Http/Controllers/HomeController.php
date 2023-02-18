<?php

namespace App\Http\Controllers;

use DB;
use Auth;
use Session;
use Carbon\Carbon;
use App\Http\Services\CustomFunction;
use Illuminate\Http\Request;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth', 'verified']);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if (Auth::user()->status != 'Active' && Auth::user()->user_type == 'STUDENT') {
            return view('student.inactive');
        }

        if (Auth::user()->status != 'Active' && Auth::user()->user_type == 'OFFICER') {
            return view('officer.inactive');
        }

        switch (Auth::user()->user_type) {

            case 'SYSTEM ADMINISTRATOR':
                return redirect()->route('system-admin.dashboards.index');
                break;

            case 'OFFICER':  
                return redirect()->route('officer.dashboards.index');
                break;

            case 'STUDENT':
                return redirect()->route('student.dashboards.index');
                break;
            
            default:
                return view('auth.login');
                break;
        }

    }

}

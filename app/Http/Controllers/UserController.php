<?php

namespace App\Http\Controllers;

use DB;
use Auth;
use Hash;
use Mail;
use Session;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Assessment;
use App\Models\BranchTable;
use App\Models\ProgLanguage;
use App\Models\Quiz;
use App\Models\Profile;
use App\Http\Services\CustomFunction;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index ()
    {
        return view('system-admin.user.index', [
            'users' => (new User)->filterByUserType('OFFICER')
        ]);
    }
    
    public function students (Request $request)
    {
        
        return Auth::user()->user_type == 'SYSTEM ADMINISTRATOR' ?
            view('system-admin.user.students', [
                'students' => (new User)->students()
            ]) :

            view('officer.student.index', [
                'students' => (new User)->PAGINATE_students($request)
            ]);
    }

    public function assessments (Request $request)
    {
        return Auth::user()->user_type == 'SYSTEM ADMINISTRATOR' ?
            view('system-admin.student.assessments', [
                'assessments' => (new User)->assessments($request->user_id)
            ]) :

            view('officer.student.assessments', [
                'user' => (new User)->findById($request->user_id),
                'assessments' => (new User)->assessments($request->user_id)
            ]);
    }

    public function assessmentDetails (Request $request)
    {
        return Auth::user()->user_type == 'SYSTEM ADMINISTRATOR' ?
            view('system-admin.student.assessment-details', [
                'languages' => $languages = (new ProgLanguage)->getAll(),
                'quizClass' => new Quiz,
                'request' => $request,
                'assessment' => (new Assessment)->findById($request->assessment_id),
            ]) :

            view('officer.student.assessment-details', [
                'languages' => $languages = (new ProgLanguage)->getAll(),
                'quizClass' => new Quiz,
                'request' => $request,
                'assessment' => (new Assessment)->findById($request->assessment_id),
            ]);

    }

    public function profile(Request $request)
    {
        if (Auth::user()->user_type == 'STUDENT') {
            return view('student.profile');
        }

        if (Auth::user()->user_type == 'OFFICER') {
            return view('officer.student.profile', [
                'user' => User::find($request->id)
            ]);
        }

        if (Auth::user()->user_type == 'SYSTEM ADMINISTRATOR') {
            return view('system-admin.student.profile', [
                'user' => User::find($request->id)
            ]);
        }
    }


    public function update($id, Request $request)
    {
        User::find($id)->update([
            'status' => $request->status,
        ]);

        if ($request->user_type == 'STUDENT') {
            return redirect()
                ->route('system-admin.users.students')
                ->with(['success' => 'Successfully updated.']);
        }

        if ($request->user_type == 'OFFICER') {
            return redirect()
                ->route('system-admin.users.index')
                ->with(['success' => 'Successfully updated.']);
        }
    }

    public function updateProfile(Request $request)
    {
        Auth::user()->update([
            'student_num' => $request->student_num
        ]);

        return redirect()
                ->route('student.users.profile')
                ->with(['success' => 'Successfully updated.']);
    }
   
}

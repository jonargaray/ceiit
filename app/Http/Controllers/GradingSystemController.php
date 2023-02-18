<?php

namespace App\Http\Controllers;

use DB;
use Auth;
use Cache;
use Illuminate\Http\Request;
use App\Models\Choice;
use App\Models\Exercise;
use App\Models\Topic;
use App\Models\ExerciseChecklist;
use App\Models\Question;
use App\Models\Checklist;
use App\Models\GradingSystem;
use App\Models\QuestionSet;
use App\Models\ProgLanguage;
use App\Models\Assessment;
use App\Models\Quiz;
use Illuminate\Support\Str;
use App\Http\Services\CustomFunction;

class GradingSystemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    
     public function index ()
     {
        return view('officer.grading-system.index', [
            'gradings' => GradingSystem::all()
        ]);
     }

     public function create()
     {
         return view('officer.grading-system.create');
     }

     public function store(Request $request)
     {
         $alphabet = range('A', 'Z');
         $sets = GradingSystem::all();
         
         GradingSystem::create([
            'set' => $alphabet[count($sets)],
            'quiz' => $request->quiz,
            'exercise' => $request->exercise,
         ]);

         return redirect()
            ->route('officer.grading-systems.index')
            ->with(['success' => 'Successfully Added.']);
     }

     public function edit($id)
     {
         return view('officer.grading-system.edit', [
            'grading' => GradingSystem::find($id)
         ]);
     }

     public function update($id, Request $request)
     {
 
         $status = 1;
         
         if ($request->status) {
            GradingSystem::where('status', 1)->update([
               'status' => 0
            ]);
         }
         
         $active = GradingSystem::where('status', 1)->get();

         if (count($active) == 0) {
            $status = 1;
         }

         GradingSystem::find($id)->update([
            'quiz' => $request->quiz,
            'exercise' => $request->exercise,
            'status' => $status,
         ]);

         return redirect()
            ->route('officer.grading-systems.index')
            ->with(['success' => 'Successfully Added.']);
     }
}

<?php

namespace App\Models;

use DB;
use Auth;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use Illuminate\Database\Eloquent\SoftDeletes;

class Quiz extends Model implements Auditable
{

    use \OwenIt\Auditing\Auditable, HasFactory;

    protected $fillable = ['assessment_id', 'question_id', 'choice_id', 'status'];
 
    public function assessment()
    {
        return $this->belongsTo(Assessment::class);
    }

    public function scores ($assessmentId, $progLanguageId)
    {
        return Quiz::join('questions', 'questions.id', 'quizzes.question_id')
            ->select('status')
            ->where('assessment_id', $assessmentId)
            ->where('prog_language_id', $progLanguageId)
            ->where('status', 1)
            ->get();
    }

    public function percentage ($assessmentId, $progLanguageId)
    {
        return $this->scores($assessmentId, $progLanguageId)->count() / (new Question)->activeSet($progLanguageId)->count() * 100;
    }


    public function resultPerQuestion($questionId, $status)
    {
        return Quiz::where('question_id', $questionId)
            ->where('status', $status)
            ->count();
    }

}

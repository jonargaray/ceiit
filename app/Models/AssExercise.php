<?php

namespace App\Models;

use DB;
use Auth;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use Illuminate\Database\Eloquent\SoftDeletes;

class AssExercise extends Model implements Auditable
{

    use \OwenIt\Auditing\Auditable, HasFactory;

    protected $fillable = ['assessment_id', 'exercise_id', 'answers', 'score'];

    public function findByExercise($assessmentId, $exerciseId)
    {
        return $this->where('assessment_id', $assessmentId)
            ->where('exercise_id', $exerciseId)
            ->select('score')
            ->first();

    }
}

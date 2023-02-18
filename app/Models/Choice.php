<?php

namespace App\Models;

use DB;
use Auth;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use Illuminate\Database\Eloquent\SoftDeletes;

class Choice extends Model implements Auditable
{

    use \OwenIt\Auditing\Auditable, HasFactory;

    protected $fillable = ['question_id', 'choice'];

    public function question()
    {
        return $this->belongsTo(Question::class);
    }

    public function filterByQuestion($questionId)
    {
        return $this->where('question_id', $questionId)
            ->get();
    }
}

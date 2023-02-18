<?php

namespace App\Models;

use DB;
use Auth;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use Illuminate\Database\Eloquent\SoftDeletes;

class Question extends Model implements Auditable
{

    use \OwenIt\Auditing\Auditable, HasFactory;

    protected $fillable = ['prog_language_id', 'question_set_id', 'question_type_id', 'question', 'correct_answer_id', 'numbering'];

    public function choices()
    {
        return $this->hasMany(Choice::class, 'question_id');
    }

    public function quizes()
    {
        return $this->hasMany(Quiz::class, 'question_id');
    }

    public function getAll($params = [])
    {
        $query = $this->select('questions.*');

        $params->prog_language_id ? $query->where('questions.prog_language_id', $params->prog_language_id) : '';
        $params->question_type_id ? $query->where('questions.question_type_id', $params->question_type_id) : '';
        $params->question_set_id ? $query->where('questions.question_set_id', $params->question_set_id) : '';

        return $query->with('choices')
            ->get();
    }

    public function nextNumbering($progLanguageId, $questionSetId)
    {
        $count = $this->select('id')
            ->where('prog_language_id', $progLanguageId) 
            ->where('question_set_id', $questionSetId) 
            ->count();

        return $count = $count + 1;
    }

    public function activeSet($progLanguageId) 
    {
        return Question::join('question_sets', 'question_sets.id', 'questions.question_set_id')
            ->where('questions.prog_language_id', $progLanguageId)
            ->where('question_sets.status', 1)
            ->get();
    }
}

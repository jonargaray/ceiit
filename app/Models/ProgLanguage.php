<?php

namespace App\Models;

use DB;
use Auth;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProgLanguage extends Model implements Auditable
{

    use \OwenIt\Auditing\Auditable, HasFactory;

    protected $fillable = ['id', 'language', 'details'];

    public function topics()
    {
        return $this->hasMany(Topic::class, 'prog_language_id');
    }

    public function questions()
    {
        return $this->hasMany(Question::class, 'prog_language_id');
    }

    public function getAll()
    {
        return $this->select('prog_languages.*')
            ->with('questions', function($query){
                $query->join('question_sets', 'question_sets.id', 'questions.question_set_id')
                    ->where('question_sets.status', 1)
                    ->get();
            })
            ->with('topics', function($query){
                $query->with('exercises');
            })
            ->get();
    }

    public function findById($id)
    {
        return $this->find($id);
    }

}

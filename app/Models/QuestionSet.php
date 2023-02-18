<?php

namespace App\Models;

use DB;
use Auth;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use Illuminate\Database\Eloquent\SoftDeletes;

class QuestionSet extends Model implements Auditable
{

    use \OwenIt\Auditing\Auditable, HasFactory;

    protected $fillable = ['question_set', 'status', 'prog_language_id'];

    public function progLanguage()
    {
        return $this->belongsTo(ProgLanguage::class);
    }

    public function getByLanguage($params = [])
    {
        $query = $this->select('question_sets.*')
            ->where('prog_language_id', $params->prog_language_id);

        return $query->get();
    }

    public function findById($id)
    {
        return $this->where('id', $id)
            ->first();
    }

    public function findActivated($progLanguageId)
    {
        return $this->where('prog_language_id', $progLanguageId)
            ->where('status', 1)
            ->first();
    }
}

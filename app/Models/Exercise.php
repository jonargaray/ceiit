<?php

namespace App\Models;

use DB;
use Auth;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use Illuminate\Database\Eloquent\SoftDeletes;

class Exercise extends Model implements Auditable
{

    use \OwenIt\Auditing\Auditable, HasFactory;

    protected $fillable = ['topic_id', 'program', 'codes', 'instruction', 'answers', 'seconds', 'answer_count'];

    public function topic()
    {
        return $this->belongsTo(Topic::class);
    }

    public function getByTopic($params = [])
    {
        $query = $this->select('exercises.*');

        $params->topic_id ? $query->where('exercises.topic_id', $params->topic_id) : '';
        $params->prog_language_id ? 
            $query->join('topics', 'topics.id', 'exercises.topic_id')
                ->where('topics.prog_language_id', $params->prog_language_id) : '';

        return $query->get();
    }

    public function findById($id) 
    {
        return $this->join('topics', 'topics.id', 'exercises.topic_id')
            ->select('exercises.*', 'topics.*', 'exercises.id as exercise_id')
            ->where('exercises.id', $id)
            ->first();
    }
    
    public function activeByLanguage($progLanguageId)
    {
        return $this->join('topics', 'topics.id', 'exercises.topic_id')
            ->where('prog_language_id', $progLanguageId)
            ->select('topics.*', 'exercises.*', 'exercises.id as exercise_id')
            ->get();
    }

}

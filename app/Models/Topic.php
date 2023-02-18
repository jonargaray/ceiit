<?php

namespace App\Models;

use DB;
use Auth;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use Illuminate\Database\Eloquent\SoftDeletes;

class Topic extends Model implements Auditable
{

    use \OwenIt\Auditing\Auditable, HasFactory;

    protected $fillable = ['prog_language_id', 'topic', 'exer_count'];

    public function question()
    {
        return $this->belongsTo(ProgLanguage::class);
    }

    public function exercises()
    {
        return $this->hasMany(Exercise::class);
    }

    public function getByLanguage($params = [])
    {
        $query = $this->select('topics.*');

        $params->prog_language_id ? $query->where('topics.prog_language_id', $params->prog_language_id) : '';

        return $query->get();
    }
}

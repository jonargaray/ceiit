<?php

namespace App\Models;

use DB;
use Auth;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use Illuminate\Database\Eloquent\SoftDeletes;

class Checklist extends Model implements Auditable
{

    use \OwenIt\Auditing\Auditable, HasFactory;

    protected $fillable = ['assessment_id', 'status', 'prog_language_id', 'topic_id'];

    public function assessment()
    {
        return $this->belongsTo(Assessment::class);
    }

    public function current($assessmentId)
    {
        return $this->where('assessment_id', $assessmentId)
            ->where('status', 0)
            ->first();
    }

    public function completes($assessmentId)
    {
        return $this->where('assessment_id', $assessmentId)
            ->where('status', 1)
            ->get();
    }
}

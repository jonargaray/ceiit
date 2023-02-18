<?php

namespace App\Models;

use DB;
use Auth;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use Illuminate\Database\Eloquent\SoftDeletes;

class GradingSystem extends Model implements Auditable
{

    use \OwenIt\Auditing\Auditable, HasFactory;

    protected $fillable = ['set', 'quiz', 'exercise', 'status'];

    public function activeSet()
    {
        return $this->where('status', 1)->first();
    }

}

<?php

namespace App\Models;

use DB;
use Auth;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use Illuminate\Database\Eloquent\SoftDeletes;

class Assessment extends Model implements Auditable
{

    use \OwenIt\Auditing\Auditable, HasFactory;

    protected $fillable = ['user_id', 'status', 'c_q', 'p_q', 'c_e', 'p_e', 'c_c', 'p_c', 'remarks', 'passed'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function findByUser($params = [])
    {
        $query = $this->select('assessments.*');

        $params->user_id ? $query->where('assessments.user_id', $params->user_id) : '';

        return $query->first();
    }

    public function filterByUser($userId)
    {
        return $this->where('assessments.user_id', $userId)
            ->get();
    }

    public function findById($id)
    {
        return $this->join('users', 'users.id', 'assessments.user_id')
            ->where('assessments.id', $id)
            ->first();
    }

    public function filterByRemarks($passed, $year=null)
    {
        $query = $this->join('users', 'users.id', 'assessments.user_id')
            ->where('passed', $passed);

        $year != null ? $query->where('assessments.created_at', 'LIKE', "%{$year}%") : '';
        
        return $query->orderBy('remarks', 'desc')
            ->get();
    }

    public function passingCount($field)
    {
        return Assessment::where($field, '>=', 50)->count();
    }
}

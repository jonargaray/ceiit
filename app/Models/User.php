<?php

namespace App\Models;

use Auth;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use OwenIt\Auditing\Contracts\Auditable;

class User extends Authenticatable implements Auditable, MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable;
    use \OwenIt\Auditing\Auditable;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = ['last_name', 'first_name', 'email', 'password', 'user_type', 'status', 'student_num'];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function findById($id)
    {
        return $this->find($id);
    }

    public function students()
    {
        return $this->where('user_type', 'STUDENT')
            ->orderBy('first_name')
            ->orderBy('last_name')
            ->get();
    }

    public function PAGINATE_students($request)
    {
        $query = $this->where('user_type', 'STUDENT')
                ->where(function ($query) use($request) {
                    $query->orWhere('first_name', 'LIKE', "%{$request->keyword}%")
                        ->orWhere('first_name', 'LIKE', "%{$request->keyword}%")
                        ->orWhere('student_num', 'LIKE', "%{$request->keyword}%")
                        ->orWhere('email', 'LIKE', "%{$request->keyword}%");
                });

        return $query->orderBy('first_name')
            ->orderBy('last_name')
            ->paginate(9)
            ->withPath('?keyword='.$request->keyword);
    }


    public function assessments($id)
    {
        return Assessment::where('user_id', $id)->get();
    }

    public function filterByUserType($userType)
    {
        return $this->where('user_type', $userType)->get();
    }

    public function withAssessment($userType)
    {
        return $this->join('assessments', 'assessments.user_id', 'users.id')
            ->where('user_type', $userType)
            ->groupBy('users.id')
            ->get();
    }

}

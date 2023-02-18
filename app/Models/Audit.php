<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Model\UserAccess;


class Audit extends Model
{   
    
    protected $table = 'audits';


    public function PAGINATE_filterByBranch($branchId, $request)
    {
        $query = $this->join('users', 'users.id', 'audits.user_id')
            ->join('profiles', 'profiles.id', 'users.profile_id')
            ->where('users.branch_id', $branchId)
            ->select('audits.*', 'audits.id as audit_id', 'users.*', 'profiles.*')
            ->where(function ($query) use($request){
                $query->orWhere('first_name', 'LIKE', "%{$request->keyword}%")
                      ->orWhere('audits.created_at', 'LIKE', "%{$request->keyword}%");

            });

        return $query->orderBy('audits.created_at', 'desc')
            ->paginate(15)
            ->withPath('?keyword='.$request->keyword);
    }

    public function PAGINATE_filterBySubscriber($subscriberId, $request)
    {
        $query = $this->join('users', 'users.id', 'audits.user_id')
            ->join('profiles', 'profiles.id', 'users.profile_id')
            ->select('audits.*', 'audits.id as audit_id', 'users.*', 'profiles.*')
            ->where(function ($query) use($request){
                $query->orWhere('first_name', 'LIKE', "%{$request->keyword}%")
                      ->orWhere('audits.created_at', 'LIKE', "%{$request->keyword}%");

            });

        return $query->orderBy('audits.created_at', 'desc')
            ->paginate(15)
            ->withPath('?keyword='.$request->keyword);
    }


    public function PAGINATE_getAll($request)
    {
        $query = $this->leftJoin('users', 'users.id', 'audits.user_id')
            ->leftJoin('profiles', 'profiles.id', 'users.profile_id')
            ->select('audits.*', 'audits.id as audit_id', 'users.*', 'profiles.*', 'audits.created_at as created_at')
            ->where(function ($query) use($request){
                $query->orWhere('first_name', 'LIKE', "%{$request->keyword}%")
                      ->orWhere('audits.created_at', 'LIKE', "%{$request->keyword}%");

            });

        return $query->orderBy('audits.created_at', 'desc')
            ->paginate(15)
            ->withPath('?keyword='.$request->keyword);
    }

    public function findById($id)
    {
        return $this->leftJoin('users', 'users.id', 'audits.user_id')
            ->leftJoin('profiles', 'profiles.id', 'users.profile_id')
            ->select('audits.*', 'audits.id as audit_id', 'users.*', 'profiles.*', 'audits.created_at as created_at')
            ->where('audits.id', $id)
            ->first();
    }

}

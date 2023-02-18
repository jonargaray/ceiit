<?php

namespace App\Models;

use Auth;
use App\Models\Branch;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Unit extends Model
{
    use HasFactory, SoftDeletes;

    protected $connection;
    protected $fillable = ['id', 'unit', 'description', 'symbol', 'subscriber_id', 'created_by', 'updated_by', 'exported', 'branch_code', 'subscriber_code'];
    protected $dates = ['deleted_at'];
    protected $softDelete = true;

    public function getAll()
    {
        return $this->select('id as unit_id', 'unit', 'description')
    		->orderBy('unit', 'asc')
            ->where('units.branch_code', Auth::user()->branch_code)
            ->where('units.subscriber_code', Auth::user()->subscriber_code)
    		->get();
    }

    public function filterBySubscriber($subscriberId, $branchCode)
    {

        return $this->select('id as unit_id', 'unit', 'description')
            ->where('subscriber_id', $subscriberId)
            ->where('units.branch_code', $branchCode)
            ->where('units.subscriber_code', Auth::user()->subscriber_code)
            ->orderBy('unit', 'asc')
            ->get();
    }

    public function findById($id)
    {
        return $this->select('units.id as unit_id', 'unit', 'description')
            ->where('id', $id)
            ->where('units.branch_code', Auth::user()->branch_code)
            ->where('units.subscriber_code', Auth::user()->subscriber_code)
            ->first();
    }

    public function PAGINATE_filterByBranch($branchCode, $request)
    {
        $query = $this->select('units.id as unit_id', 'unit', 'subscriber_id', 'description', 'symbol', 'common')
            ->where('units.branch_code', $branchCode)
            ->where('units.subscriber_code', Auth::user()->subscriber_code)
            ->where(function ($query) use($request){
                $query->orWhere('unit', 'LIKE', "%{$request->keyword}%");
            });

        $request->data_status == 'trash' ? $query->onlyTrashed() : '';

        return $query->orderBy('unit', 'asc')
            ->paginate(15)
            ->withPath('?keyword='.$request->keyword);
    }


 // check if it is exist
    // for updating
    // return result count
    public function isExistOnUpdate($request, $id, $subscriberId)
    {
        $unitCount = $this::where('unit', $request->unit)
            ->where('subscriber_id', $subscriberId)
            ->where('id', '<>', $id)
            ->where('units.branch_code', Auth::user()->branch_code)
            ->where('units.subscriber_code', Auth::user()->subscriber_code)
            ->count();

        if ($unitCount >= 1) {
            return true;
        }

        return false;
    }

    public function EXPORT_filterBySubscriber($subscriberId)
    {
    return $this->select('units.id', 'unit', 'description','subscriber_id','created_by','updated_by', 'created_at', 'updated_at', 'subscriber_code', 'branch_code', 'deleted_at')
            ->where('subscriber_id', $subscriberId)
            ->where('units.exported', 0)
            ->where('units.branch_code', Auth::user()->branch_code)
            ->where('units.subscriber_code', Auth::user()->subscriber_code)
            ->get();
    }
    
}

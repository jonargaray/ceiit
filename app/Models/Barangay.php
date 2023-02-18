<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class Barangay extends Model implements Auditable
{
    use HasFactory;
    use \OwenIt\Auditing\Auditable;

    public function filterByCity($city_id)
    {
    	return $this->select('id as barangay_id', 'barangay')
    		->where('city_id', $city_id)
    		->orderBy('barangay', 'asc')
    		->get();
    }
}

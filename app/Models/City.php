<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
class City extends Model implements Auditable
{
    use HasFactory;
    use \OwenIt\Auditing\Auditable;

    public function filterByProvince($province_id)
    {
    	return $this->select('id as city_id', 'city')
    		->where('province_id', $province_id)
    		->orderBy('city', 'asc')
    		->get();
    }
}

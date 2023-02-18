<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreSupplierRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'supplier' => 'required|max:50',
            // 'street' => 'required',
            'province_id' => 'required',
            'city_id' => 'required',
            'barangay_id' => 'required',
            'contact_num'  => 'required',
            'contact_person' => 'required|max:50',
        ];
    }

      public function messages()
    {
        return [
            'supplier.required' => 'Required',
            // 'street' => 'required',
            'province_id.required' => 'Required',
            'city_id.required' => 'Required',
            'barangay_id.required' => 'Required',
            'contact_num.required'  => 'Required',
            'contact_person.required' => 'Required',
        ];
    }
}

<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreMaterialSupplierRequest extends FormRequest
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
            'material_id' => 'required|numeric',
            'unit_id' => 'required|numeric',
            'current_unit_price' => 'required|numeric|min:0|not_in:0',
        ];
    }


    public function messages()
    {
        return [
            'material_id.required' => 'Required',
            'unit_id.required' => 'Required',
            'current_unit_price.required' => 'Required',
        ];
    }
}

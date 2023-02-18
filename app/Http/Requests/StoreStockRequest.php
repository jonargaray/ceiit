<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreStockRequest extends FormRequest
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
            'supplier_id' => 'required|numeric|min:0',
            'material_supplier_id' => 'required|numeric|min:0',
            'qty' => 'required|integer|min:0|not_in:0',
            'unit_id' => 'required|numeric|min:0',
            'delivery_date' => 'required|date',
        ];
    }
}

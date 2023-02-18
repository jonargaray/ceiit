<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUnitConversionRequest extends FormRequest
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
            'quantity' => 'required|numeric|min:0|not_in:0',
            'base_id' => 'required|numeric',
            'equivalent_id' => 'required|numeric',
            'unit_price' => $this->request->get('unit_price') ? 'numeric|min:0' : '',
            'srp' => $this->request->get('mark_up') ? 'required|numeric|min:'.$this->get('unit_price') + 0.1 : '',
            'mark_up' => $this->request->get('srp') ? 'required|numeric|min:0.1' : '',
        ];
    }


     public function messages()
    {
        return [
            'quantity.required' => 'Required',
            'base_id.required' => 'Required',
            'equivalent_id.required' => 'Required',
            'unit_price.required' => 'Required',
            // 'srp.required' => 'Required',
            
        ];
    }
}

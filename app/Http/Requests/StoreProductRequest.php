<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductRequest extends FormRequest
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
            'current_unit_price' =>  $this->request->get('product_type') == 'Retail' ? 'required|numeric|min:1' : '',
            'category_id' => 'required',
            'mark_up' =>  $this->request->get('product_type') == 'Retail' ? 'required|numeric|min:0.1' : '',
            'supplier_id' =>  $this->request->get('product_type') == 'Retail' ? 'required' : '',
            'unit_id' =>  $this->request->get('product_type') == 'Retail' ? 'required' : '',
            'current_srp' =>  $this->request->get('product_type') == 'Retail' ? 'required|numeric|min:'. $this->request->get('current_unit_price') : '',
            'new_product' =>  $this->request->get('product_id') == '0' ? 'required|max:50' : '',
            //'product_id' => $this->request->get('product_id') != '0' ? 'required|numeric': '',
            'critical' => 'required|min:0|not_in:0',
            'code' => $this->request->get('product_id') == '0' ? 'required|max:50' : '',
            'shelf_life' =>  $this->request->get('product_type') == 'In-house production' ? 'required|integer|min:0|not_in:0' : '',
            'product_type' => 'required',
            'description' => $this->request->get('product_id') == '0' ? 'max:100' : '',
            'image'=>  $this->request->get('image') ? 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048' : '',
            'new_product' => 'required',
            
        ];
    }

      public function messages()
    {
        return [
            'current_unit_price.required' => 'Required',
            'category_id.required' => 'Required',
            'mark_up.required' => 'Required',
            'supplier_id.required' => 'Required',
            'unit_id.required' => 'Required',
            'critical.required' => 'Required',
            'code.required' => 'Required',
            'shelf_life.required' => 'Required',
            'product_type.required' => 'Required',
            'new_product.required' => 'Required',
            'current_srp.required' => 'Required',
        ];
    }
}

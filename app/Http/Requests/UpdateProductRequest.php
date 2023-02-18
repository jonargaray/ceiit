<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProductRequest extends FormRequest
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
            'product' => 'required|max:50',
            'category_id' => 'required',
            'critical' => 'required|min:0|not_in:0',
            'code' => 'required:max:50',
            'shelf_life' => $this->request->get('product_type') == 'In-house production' ? 'required|integer|min:0|not_in:0' : '',
            'image'=>  $this->request->get('image') ? 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048' : '',
            'current_unit_price' =>$this->request->get('product_type') == 'Retail' ? 'required|numeric|min:1' : '',
            'current_srp' =>$this->request->get('product_type') == 'Retail' ? 'required|numeric|min:1' : '',
        ];
    }
}

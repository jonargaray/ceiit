<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateMaterialRequest extends FormRequest
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
            'material' => 'required|max:50',
            'description' => 'max:100',
            'critical' => 'required|numeric|min:0|not_in:0',
            //'life_shelf' => 'required|numeric|min:0|not_in:0',
            //'duration' => 'required',
            'unit_id' => 'required',
            'category' => 'required',
            'unit_price'=>'required',
            'image'=>  $this->request->get('image') ? 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048' : '',
        ];
    }
}

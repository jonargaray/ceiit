<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreMaterialRequest extends FormRequest
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
            'new_material' => 'required',
           // 'material_id' => $this->request->get('material_id') != '0' ? 'required|numeric': '',
            'critical' => 'required|numeric|min:0|not_in:0',
            'category' => 'required',
            'description' => $this->request->get('material_id') == '0' ? 'max:100' : '',
            'unit_id' => 'required',
            // 'mark_up' => 'required|numeric',
            // 'current_srp' => 'required|numeric|min:0|not_in:0',
            'image'=>  $this->request->get('image') ? 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048' : '',
        ];
    }


    public function messages()
    {
        return [
            'new_material.required' => 'Required',
            'critical.required' => 'Required',
            'category.required' => 'Required',
            'unit_id.required' => 'Required',
            // 'mark_up.required' => 'Required',
            // 'current_srp.required' => 'Required',
        ];
    }
}

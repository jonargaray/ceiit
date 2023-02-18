<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreAddOnRequest extends FormRequest
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
            'qty' =>   'required|min:1',
            //'category_id' => $this->request->get('category_id') != '0' ? 'required|numeric': '',
            
        ];
    }

    public function messages()
    {

        return [
            'qty.required' => 'Required',
            //'category_id' => $this->request->get('category_id') != '0' ? 'required|numeric': '',
            
        ];
    }
}

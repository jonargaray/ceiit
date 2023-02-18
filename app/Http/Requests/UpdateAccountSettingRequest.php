<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateAccountSettingRequest extends FormRequest
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
          'first_name' => 'required|max:50',
            'last_name' => 'required|max:50',
            'contact_num' => 'required|numeric',
            //'password' => 'required',
            'email' => 'required|email',
            // 'business_name'=>'required',
            // 'city_id' => 'required',
            // 'barangay_id' => 'required',
            // 'province_id' => 'required',
            // 'street' => 'required',
            // 'image'=>  $this->request->get('image') ? 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048' : '',
        ];

    }


    public function messages()
    {
        return [
          'first_name.required' => 'Required',
            'last_name.required' => 'Required',
            'contact_num.required' => 'Required',
            //'password' => 'required',
            'email.required' => 'Required',
            // 'business_name'=>'required',
            // 'city_id' => 'required',
            // 'barangay_id' => 'required',
            // 'province_id' => 'required',
            // 'street' => 'required',
            // 'image'=>  $this->request->get('image') ? 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048' : '',
        ];

    }
}

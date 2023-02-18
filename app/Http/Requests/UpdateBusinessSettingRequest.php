<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateBusinessSettingRequest extends FormRequest
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
            'first_name' => 'required',
            'mid_name' => 'required',
            'last_name' => 'required',
            'business_name'=>'required',
            'city_id' => 'required',
            'barangay_id' => 'required',
            'province_id' => 'required',
            'street' => 'required',
            'image'=>  $this->request->get('image') ? 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048' : '',
        ];

    }
}

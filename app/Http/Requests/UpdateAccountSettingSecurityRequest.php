<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateAccountSettingSecurityRequest extends FormRequest
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
          
            'password' => 'required',
            'current_password' => 'required',
            'confirm_password'=>'required',
           
        ];

    }

     public function messages()
    {
        return [
          
            'password.required' => 'required',
            'current_password.required' => 'required',
            'confirm_password.required'=>'required',
           
        ];

    }
}

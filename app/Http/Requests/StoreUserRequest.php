<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
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
            'contact_num' => 'required',
            'email' => 'required|email',
            'branch_id' => 'required',
            'user_type' => 'required',
           
        ];
    }


     public function messages()
    {
        return [
            'first_name.required' => 'Required',
            'last_name.required' => 'Required',
            'contact_num.required' => 'Required',
            'email.required' => 'Required',
            'branch_id.required' => 'Required',
            'user_type.required' => 'Required',
           
        ];
    }
}

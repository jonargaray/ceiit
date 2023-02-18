<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePlanRequest extends FormRequest
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
            'plan' => 'required',
            'duration' => 'required|numeric|min:0|not_in:0',
            'amount' => 'required|numeric|min:0|not_in:0',
            'description' => 'required',
            'discount' => 'required|numeric|min:0',
        ];
    }
}

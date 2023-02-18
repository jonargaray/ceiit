<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreRecipeExpenseRequest extends FormRequest
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
            'expense_id' =>   'required|max:50',
            'amount' =>   'required|numeric|min:0',
            
        ];
    }


    public function messages()
    {
        return [
            'expense_id.required' => 'Required',
            'amount.required' => 'Required',
           
        ];
    }
}

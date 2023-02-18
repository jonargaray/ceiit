<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreExpenseRequest extends FormRequest
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
            'expense' =>   'required|max:50',
            //'category_id' => $this->request->get('category_id') != '0' ? 'required|numeric': '',
            'description' => $this->request->get('expense_id') == '0' ? 'max:100' : '',
           // 'color' => $this->request->get('category_id') == '0' ? 'max:100' : '',
        ];
    }
}
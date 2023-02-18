<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductionRequest extends FormRequest
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
            'batch' => 'required',
            'product_id' => 'required|numeric',
            'production_date' => 'required',
            'srp' => 'required',
            // 'qty' => 'required|numeric|min:1',
            // // 'packaging' => 'required',
            // 'qty_per_package' => $this->request->get('packaging') == 'True' ? 'required|integer|min:1' : '',
            // 'package_srp' => $this->request->get('packaging') == 'True' ? 'required|numeric|min:1' : '',
        ];
    }

    public function messages()
    {
        return [
            'srp.required' => 'Product SRP is required.',
            'srp.min' => 'Product SRP is must be at least ₱1.00.',
            'qty_per_package.required' => 'Quantity per package is required.',
            'package_srp.required' => 'Package SRP is required.',
        ];
    }
}

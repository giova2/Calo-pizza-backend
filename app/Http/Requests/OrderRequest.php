<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OrderRequest extends FormRequest
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
            'name' => 'required',
            'contact' => 'required|numeric',
            'address' => 'required|max:254',
            'currency' => 'required',
            'fee' => 'required|numeric',
            'item_id' => 'required|array',
            'price' => 'required|array',
            'quantity' => 'required|array',
            'quantity.*' => 'nullable|integer|gt:0',
        ];
    }
}

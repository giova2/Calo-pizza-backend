<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Order;

class OrderRequestApi extends FormRequest
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
            'name' => 'required|max:254',
            'email' => 'required|email:rfc',
            'contact' => 'required|numeric',
            'address' => 'required|max:254',
            'currency' => 'required|in:'.implode(',', Order::currencies()),
            'total' => 'required|numeric',
            'items' => 'required|array',
            'items.*.id' => 'required|numeric|gt:0',
            'items.*.quantity' => 'required|numeric|integer|gt:0',
        ];
    }
}

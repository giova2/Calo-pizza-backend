<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Model\Order;

class OrderRequestUpdate extends FormRequest
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
            'contact' => 'required|numeric',
            'address' => 'required|max:254',
            'status' => 'required|in:'.Order::approbed().','.Order::pending().','.Order::rejected(),
        ];
    }
}

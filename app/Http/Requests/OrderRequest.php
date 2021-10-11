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
            'product_id' => 'required|numeric|exists:products,id',
            'color_id' => 'required|numeric|exists:colors,id',
            'amount' => 'required|numeric|max:10',
            'custom_print_photo' => 'image|max:2048',
            'email' => 'nullable|required_without:phone|email|max:100',
            'phone' => 'nullable|required_without:email|string|max:20',
            'address' => 'required|string|max:400',
        ];
    }
}

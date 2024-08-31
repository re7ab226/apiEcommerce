<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProductRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'category_id' => 'required|exists:categories,id',
            'brand_id' => 'required|exists:brands,id',
            'image' => 'nullable|image',
            'discount' => 'nullable|numeric',
            'amount' => 'required|integer',
            'price' => '|numeric',
            'is_available' => 'required|boolean',
            'is_trendy' => 'required|boolean',
            'name' => 'required|string',
        ];
    }
}

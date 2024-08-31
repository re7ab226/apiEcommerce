<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'category_id' => 'required|exists:categories,id', 
            'brand_id' => 'required|exists:brands,id', 
            'image' => 'required|image',
            'discount'=>'required',
            'amount'=>'required',
            'price' => 'required|numeric',
            'is_avalible'=>'required',
            'is_trendy'=>'required',
            'name'=>'required',
            
        ];
    }
}

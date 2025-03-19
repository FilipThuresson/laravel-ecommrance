<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductsRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return auth()->user()->can('manage products');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'article_no' => 'nullable|string|unique:products,article_no|max:255',
            'price' => 'required|min:0',
            'active' => 'boolean',
            'description' => 'nullable|string',
            'short_description' => 'nullable|string|max:500',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'The product name is required.',
            'article_no.unique' => 'The article number must be unique.',
            'price_in_cents.required' => 'The price is required.',
        ];
    }
}

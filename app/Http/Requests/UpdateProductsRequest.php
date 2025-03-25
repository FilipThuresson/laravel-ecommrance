<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProductsRequest extends FormRequest
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
            'article_no' => 'nullable',
            'price' => 'required|min:0',
            'description' => 'nullable|string',
            'short_description' => 'nullable|string|max:500',
            'files' => 'nullable|array',
            'files.*' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
            'removed_images' => 'nullable|array',
        ];
    }
}

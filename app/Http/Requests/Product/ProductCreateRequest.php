<?php

namespace App\Http\Requests\Product;

use Illuminate\Foundation\Http\FormRequest;

class ProductCreateRequest extends FormRequest
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
            "category_id" => "required|exists:categories,id",
            "name" => "required|string|max:255",
            "slug" => "required|string|max:255|unique:products,slug",
            "description" => "required|string|max:2000",
            "price_per_kg" => "required|numeric|min:0",
            "available_weight" => "required|numeric|min:0",
            "image" => "required|image|mimes:jpeg,png,jpg|max:2048",

        ];
    }


//     public function messages():array{
//         return [
//             'name.required' => 'Product name is required.',
//             'name.min' => 'Product name must be at least :min characters.',
//             'price.required' => 'Please enter a price.',
//             'price.numeric' => 'Price must be a valid number.',
//         ];
// }

    public function attributes(): array
    {
        return [
            'category_id' => 'Category',
            'name' => 'Product Name',
            'slug' => 'Slug',
            'description' => 'Description',
            'price_per_kg' => 'Price per kg',
            'available_weight' => 'Available Weight',
            'image' => 'Product Image',
        ];
    }

}

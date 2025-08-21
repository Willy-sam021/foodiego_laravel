<?php

namespace App\Http\Requests\Seller;

use Illuminate\Foundation\Http\FormRequest;

class SellerRegisterRequest extends FormRequest
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
            "vendor_name"=> "required|string|max:255",
            "government_nin"=>"required|mimes:pdf,jpg,jpeg,png|max:5120",
            "business_address"=>"required|string|max:255",
            "business_type"=>"required|in:individual,company",
            "bank_account_name"=>"required|string",
            "bank_account_number"=>"required|string|max:10",
        ];
    }
}

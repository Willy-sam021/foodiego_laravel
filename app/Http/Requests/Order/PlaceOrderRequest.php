<?php

namespace App\Http\Requests\Order;

use Illuminate\Foundation\Http\FormRequest;

class PlaceOrderRequest extends FormRequest
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
            "shipping_address" => 'required|string|max:255',
            "phone" => 'required|string|max:20',
            "notes" => 'nullable|string|max:1000',
            "payment_method"=> 'required|in:cash,transfer,paystack',

        ];
    }
}

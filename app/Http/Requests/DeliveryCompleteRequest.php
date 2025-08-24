<?php

namespace App\Http\Requests;
use App\Enums\DeliveryEnums;
use Illuminate\Foundation\Http\FormRequest;

class DeliveryCompleteRequest extends FormRequest
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
            "delivery_status" => ['required','in:'. implode(',', DeliveryEnums::getCasesArray()),],
        ];
    }
    public function attributes()
    {
        return [
            'delivery_status' => 'delivery status ',
        ];
    }

     public function messages()
    {
        //the :attribute place holder will make use of the attribute name
        return [
            'delivery_status.required' => 'The :attribute is required.',

        ];
    }
}

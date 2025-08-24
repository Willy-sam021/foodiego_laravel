<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DeliveryDateRequest extends FormRequest
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
            'delivery_date' => ['required','date','after_or_equal:today','before_or_equal:' . now()->addDays(7)->toDateString(),],
        ];
    }
    public function attributes()
    {
        return [
            'delivery_date' => 'delivery date',
        ];
    }

     public function messages()
    {
        //the :attribute place holder will make use of the attribute name
        return [
            'delivery_date.required' => 'The :attribute is required.',
            'delivery_date.after_or_equal' => 'The :attribute must be today or a future date.',
            'delivery_date.before_or_equal' => 'The :attribute cannot be more than 7 days from now.',
        ];
    }
}

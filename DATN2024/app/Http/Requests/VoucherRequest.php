<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class VoucherRequest extends FormRequest
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
            'name' => 'required|string|max:255',
            'code' => [
                'required',
                'string',
                Rule::unique('vouchers', 'code')->ignore($this->route('voucher')),
                'max:10'
            ],
            'description' => 'nullable|string|max:1000',
            'quantity' => 'required|integer|min:1',
            'discount' => 'required|numeric|min:0|' . ($this->discount_type == 'percent' ? 'max:100' : ''),
            'discount_type' => 'required|in:percent,amount',
            'start_date' => 'required|date|before_or_equal:expiration_date',
            'expiration_date' => 'required|date|after:start_date',
            'is_active' => 'required|boolean',

        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'The name field is required.',
            'name.string' => 'The name must be a valid string.',
            'name.max' => 'The name may not be greater than 255 characters.',

            'code.required' => 'The code field is required.',
            'code.string' => 'The code must be a valid string.',
            'code.unique' => 'The code has already been taken.',
            'code.max' => 'The code may not be greater than 10 characters.',

            'description.string' => 'The description must be a valid string.',
            'description.max' => 'The description may not be greater than 1000 characters.',

            'quantity.required' => 'The quantity field is required.',
            'quantity.integer' => 'The quantity must be an integer.',
            'quantity.min' => 'The quantity must be at least 1.',

            'discount.required' => 'The discount is required.',
            'discount.numeric' => 'The discount must be a valid number.',
            'discount.min' => 'The discount must be at least 0.',
            'discount.max' => 'The discount may not be greater than 100 when using percent.',

            'discount_type.required' => 'The discount type is required.',
            'discount_type.in' => 'The discount type must be either percent or amount.',
            
            'start_date.required' => 'The start date is required.',
            'start_date.date' => 'The start date must be a valid date.',
            'start_date.before_or_equal' => 'The start date must be before or equal to the expiration date.',
            
            'expiration_date.required' => 'The expiration date is required.',
            'expiration_date.date' => 'The expiration date must be a valid date.',
            'expiration_date.after' => 'The expiration date must be after the start date.',

            'is_active.required' => 'The is active field is required.',
            'is_active.boolean' => 'The is active field must be true or false.',
        ];
    }

}

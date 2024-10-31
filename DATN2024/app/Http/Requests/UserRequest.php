<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
            "name" => "required|string|max:255",
            "email" => "required|email|max:255",
            "password" => "required|string|min:8|max:20", 
            "phone" => "required|string|max:255",
            "address" => "required|string|max:255",
        ];
    }

    public function messages(): array
    {
        return [
            "name.required" => "Name is required.",
            "name.max" => "Name must not exceed 255 characters.",
            "email.required" => "Email is required.",
            "email.max" => "Email must not exceed 255 characters.",
            "password.required" => "Password is required.",
            "password.max" => "Password must not exceed 20 characters.",
            "phone.required" => "Phone number is required.",
            "phone.max" => "Phone number must not exceed 255 characters.",
            "address.required" => "Address is required.",
            "address.max" => "Address must not exceed 255 characters.",
        ];
        
    }
}

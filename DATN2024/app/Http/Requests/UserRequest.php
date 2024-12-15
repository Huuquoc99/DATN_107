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
            // "email" => "required|email|max:255|unique:users,email",
            "email" => "required|email|max:255",
            "password" => "required|string|min:8|max:20", 
            "phone" => "required|numeric|max:255",
            "address" => "required|string|max:255",
        ];
    }

    public function messages(): array
    {
        return [
            "name.required" => "Tên là bắt buộc.",
            "name.max" => "Tên không được vượt quá 255 ký tự.",
            "email.required" => "Email là bắt buộc.",
            "email.max" => "Email không được vượt quá 255 ký tự.",
            // "email.unique" => "Email này đã được sử dụng.",
            "password.required" => "Mật khẩu là bắt buộc.",
            "password.max" => "Mật khẩu không được vượt quá 20 ký tự.",
            "password.min" => "Mật khẩu phải có ít nhất 8 ký tự.",
            "phone.required" => "Số điện thoại là bắt buộc.",
            "phone.max" => "Số điện thoại không được vượt quá 255 ký tự.",
            "phone.numeric" => "Số điện thoại phải là số hợp lệ.",
            "address.required" => "Địa chỉ là bắt buộc.",
            "address.max" => "Địa chỉ không được vượt quá 255 ký tự.",
        ];
        
    }
}

<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductColorRequest extends FormRequest
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
            "name" => "required|max:255",
            "color_code" => "required",
        ];
    }

    public function messages(): array
    {
        return [
            "name.required" => "Tên màu sản phẩm không được để trống",
            "name.max" => "Tên màu sản phẩm không được vượt quá 255 ký tự",
            "color_code.required" => "Mã màu sản phẩm không được để trống",
            // "color_code.max" => "Tên mã màu sản phẩm không được vượt quá 7 ký tự",
        ];
    }
}

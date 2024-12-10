<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CatalogueRequest extends FormRequest
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
        ];
    }

     /**
     * Get the error message for the defined validation rules. 
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            "name.required" => "Tên danh mục không được để trống",
            "name.max" => "Tên danh mục không được vượt quá 255 ký tự",
        ];
    }
}

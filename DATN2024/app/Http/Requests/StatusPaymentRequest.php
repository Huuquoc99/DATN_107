<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StatusPaymentRequest extends FormRequest
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
            'code' => 'required|string|max:50',
            'name' => 'required|string|max:100',
            'description' => 'nullable|string|max:255',
            'display_order' => 'required|integer|min:1',
        ];
    }

    public function messages()
    {
        return [
            'code.required' => 'Trường mã là bắt buộc.',
            // 'code.unique' => 'Mã phải là duy nhất.',
            'code.max' => 'Mã không được vượt quá 50 ký tự.',
            'name.required' => 'Trường tên là bắt buộc.',
            'name.string' => 'Tên phải là một chuỗi',
            'name.max' => 'Tên không được vượt quá 100 ký tự.',
            'display_order.required' => 'Thứ tự hiển thị không được vượt quá 100 ký tự.',
        ];
    }
}

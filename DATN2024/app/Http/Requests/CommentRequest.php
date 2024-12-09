<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CommentRequest extends FormRequest
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
            'user_id' => 'required|exists:users,id',
            'product_id' => 'required|exists:products,id',
            'content' => 'required|string',
        ];
    }

    public function messages()
    {
        return [
            'user_id.required' => 'Yêu cầu nhập ID người dùng.',
            'user_id.exists' => 'Không có ID người dùng.',
            'product_id.required' => 'Yêu cầu nhập ID sản phẩm.',
            'product_id.exists' => 'Không có ID sản phẩm.',
            'content.required' => 'Yêu cầu nhập nội dung bình luận.',
            'content.string' => 'Nội dung bình luận phải là chuỗi.',
        ];
    }
}

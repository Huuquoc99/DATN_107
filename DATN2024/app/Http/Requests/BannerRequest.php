<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BannerRequest extends FormRequest
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
            'title'       => 'required|string|max:255',
            'description' => 'nullable|string|max:500',
            'link'        => 'required|url',
            'image'       => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ];
    }

    public function messages(): array
    {
        return [
            'title.required' => 'Trường tiêu đề là bắt buộc.',
            'title.string' => 'Tiêu đề phải là một chuỗi.',
            'title.max' => 'Tiêu đề không được dài hơn 255 ký tự.',
            'description.string' => 'Mô tả phải là một chuỗi.',
            'description.max' => 'Mô tả không được dài hơn 500 ký tự.',
            'link.url' => 'Liên kết phải là một URL hợp lệ.',
            'link.required' => 'Trường liên kết là bắt buộc.',
            'image.image' => 'Tệp phải là hình ảnh.',
            'image.mimes' => 'Hình ảnh phải là tệp có loại: jpeg, png, jpg, gif, svg.',
            'image.max' => 'Kích thước hình ảnh không được lớn hơn 2MB.',
            'image.required' => 'Trường hình ảnh là bắt buộc.',
        ];
    }
}

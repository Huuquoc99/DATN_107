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
            'min_order_value' => 'required|numeric|min:0',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Trường tên là bắt buộc.',
            'name.string' => 'Tên phải là một chuỗi hợp lệ.',
            'name.max' => 'Tên không được dài quá 255 ký tự.',
            
            'code.required' => 'Trường mã là bắt buộc.',
            'code.string' => 'Mã phải là một chuỗi hợp lệ.',
            'code.unique' => 'Mã đã được sử dụng.',
            'code.max' => 'Mã không được dài quá 10 ký tự.',
            
            'description.string' => 'Mô tả phải là một chuỗi hợp lệ.',
            'description.max' => 'Mô tả không được dài quá 1000 ký tự.',
            
            'quantity.required' => 'Trường số lượng là bắt buộc.',
            'quantity.integer' => 'Số lượng phải là một số nguyên.',
            'quantity.min' => 'Số lượng phải ít nhất là 1.',
            
            'discount.required' => 'Yêu cầu giảm giá.',
            'discount.numeric' => 'Giảm giá phải là một số hợp lệ.',
            'discount.min' => 'Giảm giá phải ít nhất là 0.',
            'discount.max' => 'Giảm giá không được lớn hơn 100 khi sử dụng phần trăm.',
            
            'discount_type.required' => 'Yêu cầu loại giảm giá.',
            'discount_type.in' => 'Loại giảm giá phải là phần trăm hoặc số tiền.',
            
            'start_date.required' => 'Yêu cầu ngày bắt đầu.',
            'start_date.date' => 'Ngày bắt đầu phải là ngày hợp lệ.',
            'start_date.before_or_equal' => 'Ngày bắt đầu phải trước hoặc bằng ngày hết hạn.',
            
            'expiration_date.required' => 'Yêu cầu ngày hết hạn.',
            
            'expiration_date.date' => 'Ngày hết hạn phải là ngày hợp lệ.',
            'expiration_date.after' => 'Ngày hết hạn phải sau ngày bắt đầu.',
            
            'is_active.required' => 'Trường đang hoạt động là bắt buộc.',
            'is_active.boolean' => 'Trường đang hoạt động phải là đúng hoặc sai.',

            'min_order_value.required' => 'Giá trị đơn hàng tối thiểu là bắt buộc.',
            'min_order_value.numeric' => 'Giá trị đơn hàng tối thiểu phải là một số.',
            'min_order_value.min' => 'Giá trị đơn hàng tối thiểu phải lớn hơn hoặc bằng 0.',
        ];
    }

}

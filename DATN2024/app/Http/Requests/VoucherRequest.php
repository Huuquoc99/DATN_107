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
                'max:10',
                Rule::unique('vouchers', 'code')->ignore($this->route('voucher')),
            ],
            'description' => 'nullable|string|max:1000',
            'quantity' => 'required|integer|min:1',
            'discount_type' => 'required|in:percent,amount',
            'start_date' => 'required|date|before_or_equal:expiration_date',
            'expiration_date' => 'required|date|after:start_date',
            'is_active' => 'required|boolean',
            'min_order_value' => 'required|numeric|min:0', 
            'max_discount' => 'nullable|numeric|min:0|required_if:discount_type,percent_max',
            'discount' => [
                'required',
                'numeric',
                'min:0',
                ($this->discount_type == 'percent' || $this->discount_type == 'percent_max' ? 'max:100' : ''),
            ],

            'product_ids' => 'required|array', 
            'product_ids.*' => 'exists:products,id', 

        ];
    }


    public function messages()
    {
        return [
            'name.required' => 'Tên voucher là bắt buộc.',
            'name.string' => 'Tên voucher phải là chuỗi ký tự.',
            'name.max' => 'Tên voucher không được vượt quá 255 ký tự.',
            
            'code.required' => 'Mã voucher là bắt buộc.',
            'code.string' => 'Mã voucher phải là chuỗi ký tự.',
            'code.max' => 'Mã voucher không được vượt quá 10 ký tự.',
            'code.unique' => 'Mã voucher này đã tồn tại.',
            
            'description.nullable' => 'Mô tả là tùy chọn.',
            'description.string' => 'Mô tả phải là chuỗi ký tự.',
            'description.max' => 'Mô tả không được vượt quá 1000 ký tự.',
            
            'quantity.required' => 'Số lượng là bắt buộc.',
            'quantity.integer' => 'Số lượng phải là số nguyên.',
            'quantity.min' => 'Số lượng phải lớn hơn hoặc bằng 1.',
            
            'discount_type.required' => 'Loại giảm giá là bắt buộc.',
            'discount_type.in' => 'Loại giảm giá phải là "percent" hoặc "amount".',
            
            'start_date.required' => 'Ngày bắt đầu là bắt buộc.',
            'start_date.date' => 'Ngày bắt đầu phải là một ngày hợp lệ.',
            'start_date.before_or_equal' => 'Ngày bắt đầu phải trước hoặc bằng ngày hết hạn.',
            
            'expiration_date.required' => 'Ngày hết hạn là bắt buộc.',
            'expiration_date.date' => 'Ngày hết hạn phải là một ngày hợp lệ.',
            'expiration_date.after' => 'Ngày hết hạn phải sau ngày bắt đầu.',
            
            'is_active.required' => 'Trạng thái kích hoạt là bắt buộc.',
            'is_active.boolean' => 'Trạng thái kích hoạt phải là đúng hoặc sai.',
            
            'min_order_value.required' => 'Giá trị đơn hàng tối thiểu là bắt buộc.',
            'min_order_value.numeric' => 'Giá trị đơn hàng tối thiểu phải là số.',
            'min_order_value.min' => 'Giá trị đơn hàng tối thiểu phải lớn hơn hoặc bằng 0.',
            
            'max_discount.nullable' => 'Giảm giá tối đa là tùy chọn.',
            'max_discount.numeric' => 'Giảm giá tối đa phải là số.',
            'max_discount.min' => 'Giảm giá tối đa phải lớn hơn hoặc bằng 0.',
            'max_discount.required_if' => 'Giảm giá tối đa là bắt buộc nếu loại giảm giá là "percent_max".',
            
            'discount.required' => 'Giảm giá là bắt buộc.',
            'discount.numeric' => 'Giảm giá phải là số.',
            'discount.min' => 'Giảm giá phải lớn hơn hoặc bằng 0.',
            'discount.max' => 'Giảm giá không được vượt quá 100 nếu loại giảm giá là "percent" hoặc "percent_max".',
            
            'product_ids.required' => 'Danh sách sản phẩm là bắt buộc.',
            'product_ids.array' => 'Danh sách sản phẩm phải là mảng.',
            'product_ids.*.exists' => 'Mỗi sản phẩm phải có ID hợp lệ từ bảng sản phẩm.',
        ];
        
    }

}

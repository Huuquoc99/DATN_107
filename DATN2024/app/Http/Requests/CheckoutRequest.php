<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CheckoutRequest extends FormRequest
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
            'user_name' => 'required|string|max:255',
            'user_email' => 'required|email|max:255',
            'user_phone' => 'required|string|max:255',
            'user_address' => 'required|string|max:255',
            'user_note' => 'nullable|string|max:255',
            'is_ship_user_same_user' => 'required|boolean',
            'ship_user_name' => 'nullable|string|max:255',
            'ship_user_email' => 'nullable|email|max:255',
            'ship_user_phone' => 'nullable|string|max:255',
            'ship_user_address' => 'nullable|string|max:255',
            'ship_user_note' => 'nullable|string|max:255',
            'status_order_id' => 'required|exists:status_orders,id',
            'status_payment_id' => 'required|exists:status_payments,id',
        ];
    }


    public function messages()
    {
        return [
            'user_name.required' => 'Tên người dùng là bắt buộc.',
            'user_email.required' => 'Email là bắt buộc.',
            'user_email.email' => 'Email phải là địa chỉ email hợp lệ.',
            'user_phone.required' => 'Số điện thoại là bắt buộc.',
            'user_address.required' => 'Địa chỉ là bắt buộc.',
            'is_ship_user_same_user.required' => 'Vui lòng chỉ định thông tin giao hàng.',
            'status_order_id.required' => 'Tình trạng đơn hàng là bắt buộc.',
            'status_payment_id.required' => 'Tình trạng thanh toán là bắt buộc.',
            'status_order_id.exists' => 'Tình trạng đơn hàng đã chọn không tồn tại.',
            'status_payment_id.exists' => 'Tình trạng thanh toán đã chọn không tồn tại.',
        ];
    }
}

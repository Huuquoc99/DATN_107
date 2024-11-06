<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductStoreRequest extends FormRequest
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
            'price_regular' => 'required|numeric',
            'price_sale' => 'required|numeric',
            'catalogue_id' => 'required|exists:catalogues,id',
            'img_thumbnail' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'processor' => 'nullable|string|max:255',
            'ram' => 'nullable|string|max:255',
            'short_description' => 'nullable|string',
            'sku' => 'required|string|max:20',
            'screen_size' => 'nullable|string|max:255',
            'operating_system' => 'nullable|string|max:255',
            'battery_capacity' => 'nullable|string|max:255',
            'camera_resolution' => 'nullable|string|max:255',
            'network_connectivity' => 'nullable|string|max:255',
            'storage' => 'nullable|string|max:255',
            // Validate các biến thể
//            'product_variants.*.quantity' => 'nullable|integer|min:0',
//            'product_variants.*.price' => 'nullable|numeric|min:0',
//            'product_variants.*.sku' => 'nullable|string|max:20',
//            'product_variants.*.image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
//            'tags' => 'nullable|array',
//            'tags.*' => 'exists:tags,id',
        ];
    }

    public function messages()
    {
        return [
            // 'name.required' => 'Tên sản phẩm là bắt buộc.',
            // 'name.string' => 'Tên sản phẩm phải là chuỗi ký tự.',
            // 'name.max' => 'Tên sản phẩm không được vượt quá 255 ký tự.',

            // 'price_regular.required' => 'Giá thường là bắt buộc.',
            // 'price_regular.numeric' => 'Giá thường phải là số.',

            // 'price_sale.required' => 'Giá giảm giá là bắt buộc.',
            // 'price_sale.numeric' => 'Giá giảm giá phải là số.',

            // 'catalogue_id.required' => 'Hãng điện thoại là bắt buộc.',
            // 'catalogue_id.exists' => 'Hãng điện thoại không hợp lệ.',

            // 'img_thumbnail.required' => 'Ảnh đại diện là bắt buộc.',
            // 'img_thumbnail.image' => 'Ảnh đại diện phải là file ảnh.',
            // 'img_thumbnail.mimes' => 'Ảnh đại diện phải có định dạng: jpeg, png, jpg, gif, svg.',
            // 'img_thumbnail.max' => 'Ảnh đại diện không được vượt quá 2MB.',

            // 'sku.required' => 'Mã sản phẩm là bắt buộc.',
            // 'sku.string' => 'Mã sản phẩm phải là chuỗi ký tự.',
            // 'sku.max' => 'Mã sản phẩm không được vượt quá 20 ký tự.',

            // // Các thông báo cho các trường không bắt buộc nếu muốn kiểm tra thêm
            // 'processor.max' => 'CPU không được vượt quá 255 ký tự.',
            // 'ram.max' => 'Ram không được vượt quá 255 ký tự.',
            // 'screen_size.max' => 'Kích thước màn hình không được vượt quá 255 ký tự.',
            // 'operating_system.max' => 'Hệ điều hành không được vượt quá 255 ký tự.',
            // 'battery_capacity.max' => 'Dung lượng pin không được vượt quá 255 ký tự.',
            // 'camera_resolution.max' => 'Độ phân giải camera không được vượt quá 255 ký tự.',
            // 'network_connectivity.max' => 'Kết nối mạng không được vượt quá 255 ký tự.',
            // 'storage.max' => 'Dung lượng lưu trữ không được vượt quá 255 ký tự.',


            'name.required' => 'Product name is required.',
            'name.string' => 'Product name must be a string.',
            'name.max' => 'Product name may not exceed 255 characters.',

            'price_regular.required' => 'Regular price is required.',
            'price_regular.numeric' => 'Regular price must be a number.',

            'price_sale.required' => 'Sale price is required.',
            'price_sale.numeric' => 'Sale price must be a number.',

            'catalogue_id.required' => 'Phone brand is required.',
            'catalogue_id.exists' => 'Invalid phone brand.',

            'img_thumbnail.required' => 'Thumbnail image is required.',
            'img_thumbnail.image' => 'Thumbnail image must be an image file.',
            'img_thumbnail.mimes' => 'Thumbnail image must be in one of the following formats: jpeg, png, jpg, gif, svg.',
            'img_thumbnail.max' => 'Thumbnail image may not exceed 2MB.',

            'sku.required' => 'SKU is required.',
            'sku.string' => 'SKU must be a string.',
            'sku.max' => 'SKU may not exceed 20 characters.',

            // Optional fields validation messages if needed
            'processor.max' => 'Processor may not exceed 255 characters.',
            'ram.max' => 'RAM may not exceed 255 characters.',
            'screen_size.max' => 'Screen size may not exceed 255 characters.',
            'operating_system.max' => 'Operating system may not exceed 255 characters.',
            'battery_capacity.max' => 'Battery capacity may not exceed 255 characters.',
            'camera_resolution.max' => 'Camera resolution may not exceed 255 characters.',
            'network_connectivity.max' => 'Network connectivity may not exceed 255 characters.',
            'storage.max' => 'Storage may not exceed 255 characters.',
        ];
    }
}

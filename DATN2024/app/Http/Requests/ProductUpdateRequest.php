<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Traits\ValidateProductTrait;

class ProductUpdateRequest extends FormRequest
{
    use ValidateProductTrait;
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        $this->saveSessionUI();
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
            'price_regular' => 'required|numeric|min:0',
            'price_sale' => 'nullable|numeric|min:0|lt:price_regular',
            'catalogue_id' => 'required|exists:catalogues,id',
            'img_thumbnail' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'processor' => 'nullable|string|max:255',
            'ram' => 'nullable|string|max:255',
            'short_description' => 'nullable|string|max:500',
            'screen_size' => 'nullable|string|max:255',
            'operating_system' => 'nullable|string|max:255',
            'battery_capacity' => 'nullable|string|max:255',
            'camera_resolution' => 'nullable|string|max:255',
            'network_connectivity' => 'nullable|string|max:255',
            // 'storage' => 'nullable|string|max:255',
            'sim_type' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'is_active' => 'nullable|boolean',
            'is_hot_deal' => 'nullable|boolean',
            'is_good_deal' => 'nullable|boolean',
            'is_new' => 'nullable|boolean',
            'is_show_home' => 'nullable|boolean',

            // validate product_variants
            'product_variants' => 'nullable|array',
            'product_variants.*' => 'required_with:product_variants|array',
            'product_variants.*.quantity' => 'required_with:product_variants.*|numeric|min:0',
            'product_variants.*.price' => 'required_with:product_variants.*|numeric|min:0',

            'new_product_variants' => 'nullable|array',
            'new_product_variants.*' => 'required_with:new_product_variants|array',
            'new_product_variants.*.size' => 'required_with:new_product_variants.*|string|max:255',
            'new_product_variants.*.color' => 'required_with:new_product_variants.*|string|max:255',
            'new_product_variants.*.quantity' => 'required_with:new_product_variants.*|numeric|min:0',
            'new_product_variants.*.price' => 'required_with:new_product_variants.*|numeric|min:0',
            'new_product_variants.*.image' => 'required_with:new_product_variants.*|image|mimes:jpeg,png,jpg,gif|max:2048',

            // validate product_galleries
            'product_galleries' => 'nullable|array',
            'product_galleries.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048'
        ];

    }

    public function messages()
    {
        return [
            'name.required' => 'Tên sản phẩm là bắt buộc.',
            'name.string' => 'Tên sản phẩm phải là một chuỗi.',
            'name.max' => 'Tên sản phẩm không được vượt quá 255 ký tự.',
            
            'price_regular.required' => 'Giá thông thường là bắt buộc.',
            'price_regular.numeric' => 'Giá thông thường phải là một số.',
            
            'price_sale.required' => 'Giá bán là bắt buộc.',
            'price_sale.numeric' => 'Giá bán phải là một số.',
            
            'catalogue_id.required' => 'Nhãn hiệu điện thoại là bắt buộc.',
            'catalogue_id.exists' => 'Nhãn hiệu điện thoại không hợp lệ.',
            
            'img_thumbnail.required' => 'Hình ảnh thu nhỏ là bắt buộc.',
            'img_thumbnail.image' => 'Hình ảnh thu nhỏ phải là một tệp hình ảnh.',
            'img_thumbnail.mimes' => 'Hình thu nhỏ phải có một trong các định dạng sau: jpeg, png, jpg, gif, svg.',
            'img_thumbnail.max' => 'Hình thu nhỏ không được vượt quá 2MB.',
            
            'sku.required' => 'SKU là bắt buộc.',
            'sku.string' => 'SKU phải là một chuỗi.',
            'sku.max' => 'SKU không được vượt quá 20 ký tự.',
            
            'processor.max' => 'Bộ xử lý không được vượt quá 255 ký tự.',
            'ram.max' => 'RAM không được vượt quá 255 ký tự.',
            'screen_size.max' => 'Kích thước màn hình không được vượt quá 255 ký tự.',
            'operating_system.max' => 'Hệ điều hành không được vượt quá 255 ký tự.',
            'battery_capacity.max' => 'Dung lượng pin không được vượt quá 255 ký tự.',
            'camera_resolution.max' => 'Độ phân giải camera không được vượt quá 255 ký tự.',
            'network_connectivity.max' => 'Kết nối mạng không được vượt quá 255 ký tự.',
            'storage.max' => 'Lưu trữ không được vượt quá 255 ký tự.',
            
            'product_variants.array' => 'Các biến thể sản phẩm phải là một mảng hợp lệ.',
            'product_variants.*.quantity.required_with' => 'Số lượng là bắt buộc đối với biến thể sản phẩm.',
            'product_variants.*.quantity.numeric' => 'Số lượng phải là một số.',
            'product_variants.*.quantity.min' => 'Số lượng không được là số âm.',
            
            'product_variants.*.price.required_with' => 'Giá là bắt buộc đối với biến thể sản phẩm.',
            'product_variants.*.price.numeric' => 'Giá phải là một số.',
            'product_variants.*.price.min' => 'Giá không được là negative.',
            
            'product_variants.*.image.required_with' => 'Bắt ​​buộc phải có hình ảnh cho biến thể sản phẩm.',
            'product_variants.*.image.image' => 'Tệp đã tải lên phải là hình ảnh.',
            'product_variants.*.image.mimes' => 'Hình ảnh phải là JPEG, PNG, JPG hoặc GIF.',
            'product_variants.*.image.max' => 'Hình ảnh không được vượt quá 2MB.',
            
            'new_product_variants.array' => 'Biến thể sản phẩm mới phải là một mảng hợp lệ.',
            'new_product_variants.*.size.required_with' => 'Bắt ​​buộc phải có kích thước cho biến thể sản phẩm mới.',
            'new_product_variants.*.size.string' => 'Kích thước phải là chuỗi.',
            'new_product_variants.*.size.max' => 'Kích thước không được vượt quá 255 ký tự.',
            
            'new_product_variants.*.color.required_with' => 'Màu sắc là bắt buộc đối với biến thể sản phẩm mới.',
            'new_product_variants.*.color.string' => 'Màu sắc phải là một chuỗi.',
            'new_product_variants.*.color.max' => 'Màu sắc không được vượt quá 255 ký tự.',
            
            'new_product_variants.*.quantity.required_with' => 'Số lượng là bắt buộc đối với biến thể sản phẩm mới.',
            'new_product_variants.*.quantity.numeric' => 'Số lượng phải là một số.',
            'new_product_variants.*.quantity.min' => 'Số lượng không được là số âm.',
            
            'new_product_variants.*.price.required_with' => 'Giá là bắt buộc đối với biến thể sản phẩm mới.',
            'new_product_variants.*.price.numeric' => 'Giá phải là một số.',
            'new_product_variants.*.price.min' => 'Giá không được là số âm.',
            
            'new_product_variants.*.image.required_with' => 'Bắt ​​buộc phải có hình ảnh cho biến thể sản phẩm mới.',
            'new_product_variants.*.image.image' => 'Tệp đã tải lên phải là hình ảnh.',
            'new_product_variants.*.image.mimes' => 'Hình ảnh phải là JPEG, PNG, JPG hoặc GIF.',
            'new_product_variants.*.image.max' => 'Hình ảnh không được vượt quá 2MB.',
            
            'product_galleries.array' => 'Thư viện sản phẩm phải là một mảng hợp lệ.',
            'product_galleries.*.required_with' => 'Bắt ​​buộc phải có hình ảnh cho thư viện sản phẩm.',
            'product_galleries.*.image' => 'Tệp đã tải lên phải là hình ảnh.',
            'product_galleries.*.mimes' => 'Hình ảnh phải là JPEG, PNG, JPG hoặc GIF.',
            'product_galleries.*.max' => 'Hình ảnh không được vượt quá 2MB.',
            
            ];
    }
}

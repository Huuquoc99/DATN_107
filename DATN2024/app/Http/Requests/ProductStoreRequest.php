<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Traits\ValidateProductTrait;

class ProductStoreRequest extends FormRequest
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
            'price_regular' => 'required|numeric',
            'price_sale' => 'required|numeric|lte:price_regular',
            'catalogue_id' => 'required|exists:catalogues,id',
            'img_thumbnail' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'processor' => 'required|string|max:255',
            'ram' => 'required|string|max:255',
            'sku' => 'required|string|max:20',
            'screen_size' => 'required|string|max:255',
            'operating_system' => 'required|string|max:255',
            'battery_capacity' => 'required|string|max:255',
            'camera_resolution' => 'required|string|max:255',
            'network_connectivity' => 'required|string|max:255',
            'storage' => 'required|string|max:255',
            'sim_type' => 'required|string|max:255',
            'short_description' => 'required|string|max:255',

            // validate product_variants
            'product_variants' => 'nullable|array',
            'product_variants.*' => 'required_with:product_variants|array',
            'product_variants.*.quantity' => 'required_with:product_variants.*|numeric|min:0',
            'product_variants.*.price' => 'required_with:product_variants.*|numeric|min:0',
            'product_variants.*.image' => 'required_with:product_variants.*|image|mimes:jpeg,png,jpg,gif|max:2048',

            // validate new_product_variants
            'new_product_variants' => 'nullable|array',
            'new_product_variants.*' => 'required_with:new_product_variants|array',
            'new_product_variants.*.size' => 'required_with:new_product_variants.*|string|max:255',
            'new_product_variants.*.color' => 'required_with:new_product_variants.*|string|max:255',
            'new_product_variants.*.quantity' => 'required_with:new_product_variants.*|numeric|min:0',
            'new_product_variants.*.price' => 'required_with:new_product_variants.*|numeric|min:0',
            'new_product_variants.*.image' => 'required_with:new_product_variants.*|image|mimes:jpeg,png,jpg,gif|max:2048',

            // validate product_galleries
            'product_galleries' => 'required|array',
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
            'price_regular.min' => 'Giá thông thường phải ít nhất là 0.',
            
            'price_sale.numeric' => 'Giá bán phải là một số.',
            'price_sale.min' => 'Giá bán phải ít nhất là 0.',
            'price_sale.lt' => 'Giá bán phải thấp hơn giá thông thường.',
            
            'catalogue_id.required' => 'Nhãn hiệu điện thoại là bắt buộc.',
            'catalogue_id.exists' => 'Nhãn hiệu điện thoại không hợp lệ.',
            
            'img_thumbnail.image' => 'Hình thu nhỏ phải là tệp hình ảnh.',
            'img_thumbnail.mimes' => 'Hình thu nhỏ phải ở một trong các định dạng sau: jpeg, png, jpg, gif, svg.',
            'img_thumbnail.max' => 'Hình thu nhỏ không được vượt quá 2MB.',
            
            'sku.required' => 'Bắt ​​buộc phải có SKU.',
            'sku.string' => 'SKU phải là chuỗi.',
            'sku.max' => 'SKU không được vượt quá 255 ký tự.',
            
            'processor.max' => 'Bộ xử lý không được vượt quá 255 ký tự.',
            'ram.max' => 'RAM không được vượt quá 255 ký tự.',
            'screen_size.max' => 'Kích thước màn hình không được vượt quá 255 ký tự.',
            'operating_system.max' => 'Hệ điều hành không được vượt quá 255 ký tự.',
            'battery_capacity.max' => 'Dung lượng pin không được vượt quá 255 ký tự.',
            'camera_resolution.max' => 'Độ phân giải camera không được vượt quá 255 ký tự.',
            'network_connectivity.max' => 'Kết nối mạng không được vượt quá 255 ký tự.',
            'storage.max' => 'Lưu trữ không được vượt quá 255 ký tự.',
            
            'product_variants.array' => 'Biến thể sản phẩm phải là một mảng hợp lệ.',
            'product_variants.*.quantity.required_with' => 'Số lượng là bắt buộc đối với biến thể sản phẩm.',
            'product_variants.*.quantity.numeric' => 'Số lượng phải là một số.',
            'product_variants.*.quantity.min' => 'Số lượng không được âm.',
            
            'product_variants.*.price.required_with' => 'Giá là bắt buộc đối với biến thể sản phẩm.',
            'product_variants.*.price.numeric' => 'Giá phải là number.',
            'product_variants.*.price.min' => 'Giá không được âm.',
            
            'product_variants.*.image.required_with' => 'Cần có hình ảnh cho biến thể sản phẩm.',
            'product_variants.*.image.image' => 'Tệp đã tải lên phải là hình ảnh.',
            'product_variants.*.image.mimes' => 'Hình ảnh phải là JPEG, PNG, JPG hoặc GIF.',
            'product_variants.*.image.max' => 'Hình ảnh không được vượt quá 2MB.',
            
            'new_product_variants.array' => 'Biến thể sản phẩm mới phải là một mảng hợp lệ.',
            'new_product_variants.*.size.required_with' => 'Cần có kích thước cho biến thể sản phẩm mới.',
            'new_product_variants.*.size.string' => 'Kích thước phải là chuỗi.',
            'new_product_variants.*.size.max' => 'Kích thước không được vượt quá 255 ký tự.',
            
            'new_product_variants.*.color.required_with' => 'Màu là bắt buộc đối với biến thể sản phẩm mới.',
            'new_product_variants.*.color.string' => 'Màu phải là chuỗi.',
            'new_product_variants.*.color.max' => 'Màu không được vượt quá 255 ký tự.',
            
            'new_product_variants.*.quantity.required_with' => 'Số lượng là bắt buộc đối với biến thể sản phẩm mới.',
            'new_product_variants.*.quantity.numeric' => 'Số lượng phải là số.',
            'new_product_variants.*.quantity.min' => 'Số lượng không được âm.',
            
            'new_product_variants.*.price.required_with' => 'Giá là bắt buộc đối với biến thể sản phẩm mới.',
            'new_product_variants.*.price.numeric' => 'Giá phải là số.',
            
            'new_product_variants.*.price.min' => 'Giá không được âm.',
            
            'new_product_variants.*.image.required_with' => 'Cần có hình ảnh cho biến thể sản phẩm mới.',
            'new_product_variants.*.image.image' => 'Tệp đã tải lên phải là hình ảnh.',
            'new_product_variants.*.image.mimes' => 'Hình ảnh phải là JPEG, PNG, JPG hoặc GIF.',
            'new_product_variants.*.image.max' => 'Hình ảnh không được vượt quá 2MB.',
            
            'product_galleries.array' => 'Thư viện sản phẩm phải là một mảng hợp lệ.',
            'product_galleries.*.required_with' => 'Cần có hình ảnh cho thư viện sản phẩm.',
            'product_galleries.*.image' => 'Tệp đã tải lên phải là hình ảnh.',
            'product_galleries.*.mimes' => 'Hình ảnh phải là JPEG, PNG, JPG hoặc GIF.',
            'product_galleries.*.max' => 'Hình ảnh không được vượt quá 2MB.',
            
        ];
    }
}

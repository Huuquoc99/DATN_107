<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductUpdateRequest extends FormRequest
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
            'storage' => 'nullable|string|max:255',
            'sim_type' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'is_active' => 'nullable|boolean',
            'is_hot_deal' => 'nullable|boolean',
            'is_good_deal' => 'nullable|boolean',
            'is_new' => 'nullable|boolean',
            'is_show_home' => 'nullable|boolean',

            'product_galleries' => 'nullable|array|min:1',
            'product_galleries.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ];

    }

    public function messages()
    {
        return [
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

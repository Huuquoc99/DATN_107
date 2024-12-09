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
            'name.required' => 'Product name is required.',
            'name.string' => 'Product name must be a string.',
            'name.max' => 'Product name may not exceed 255 characters.',

            'price_regular.required' => 'Regular price is required.',
            'price_regular.numeric' => 'Regular price must be a number.',
            'price_regular.min' => 'Regular price must be at least 0.',
            'price_sale.lte' => 'The sale price must be less than or equal to the regular price.',

            'price_sale.numeric' => 'Sale price must be a number.',
            'price_sale.min' => 'Sale price must be at least 0.',
            'price_sale.lt' => 'Sale price must be less than regular price.',

            'catalogue_id.required' => 'Phone brand is required.',
            'catalogue_id.exists' => 'Invalid phone brand.',

            'img_thumbnail.image' => 'Thumbnail image must be an image file.',
            'img_thumbnail.mimes' => 'Thumbnail image must be in one of the following formats: jpeg, png, jpg, gif, svg.',
            'img_thumbnail.max' => 'Thumbnail image may not exceed 2MB.',

            'sku.required' => 'SKU is required.',
            'sku.string' => 'SKU must be a string.',
            'sku.max' => 'SKU may not exceed 255 characters.',

            'processor.max' => 'Processor may not exceed 255 characters.',
            'ram.max' => 'RAM may not exceed 255 characters.',
            'screen_size.max' => 'Screen size may not exceed 255 characters.',
            'operating_system.max' => 'Operating system may not exceed 255 characters.',
            'battery_capacity.max' => 'Battery capacity may not exceed 255 characters.',
            'camera_resolution.max' => 'Camera resolution may not exceed 255 characters.',
            'network_connectivity.max' => 'Network connectivity may not exceed 255 characters.',
            'storage.max' => 'Storage may not exceed 255 characters.',

            'product_variants.array' => 'Product variants must be a valid array.',
            'product_variants.*.quantity.required_with' => 'Quantity is required for product variant.',
            'product_variants.*.quantity.numeric' => 'Quantity must be a number.',
            'product_variants.*.quantity.min' => 'Quantity cannot be negative.',

            'product_variants.*.price.required_with' => 'Price is required for product variant.',
            'product_variants.*.price.numeric' => 'Price must be a number.',
            'product_variants.*.price.min' => 'Price cannot be negative.',

            'product_variants.*.image.required_with' => 'Image is required for product variant.',
            'product_variants.*.image.image' => 'Uploaded file must be an image.',
            'product_variants.*.image.mimes' => 'Image must be a JPEG, PNG, JPG, or GIF.',
            'product_variants.*.image.max' => 'Image cannot exceed 2MB.',

            'new_product_variants.array' => 'New product variants must be a valid array.',
            'new_product_variants.*.size.required_with' => 'Size is required for new product variant.',
            'new_product_variants.*.size.string' => 'Size must be a string.',
            'new_product_variants.*.size.max' => 'Size cannot exceed 255 characters.',

            'new_product_variants.*.color.required_with' => 'Color is required for new product variant.',
            'new_product_variants.*.color.string' => 'Color must be a string.',
            'new_product_variants.*.color.max' => 'Color cannot exceed 255 characters.',

            'new_product_variants.*.quantity.required_with' => 'Quantity is required for new product variant.',
            'new_product_variants.*.quantity.numeric' => 'Quantity must be a number.',
            'new_product_variants.*.quantity.min' => 'Quantity cannot be negative.',

            'new_product_variants.*.price.required_with' => 'Price is required for new product variant.',
            'new_product_variants.*.price.numeric' => 'Price must be a number.',
            'new_product_variants.*.price.min' => 'Price cannot be negative.',

            'new_product_variants.*.image.required_with' => 'Image is required for new product variant.',
            'new_product_variants.*.image.image' => 'Uploaded file must be an image.',
            'new_product_variants.*.image.mimes' => 'Image must be a JPEG, PNG, JPG, or GIF.',
            'new_product_variants.*.image.max' => 'Image cannot exceed 2MB.',

            'product_galleries.array' => 'Product galleries must be a valid array.',
            'product_galleries.*.required_with' => 'Image is required for product gallery.',
            'product_galleries.*.image' => 'Uploaded file must be an image.',
            'product_galleries.*.mimes' => 'Image must be a JPEG, PNG, JPG, or GIF.',
            'product_galleries.*.max' => 'Image cannot exceed 2MB.',

        ];
    }
}

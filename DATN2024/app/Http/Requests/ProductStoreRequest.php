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
//             Validate các biến thể

            'product_variants.*.quantity' => 'nullable|integer|min:0',
            'product_variants.*.price' => 'nullable|numeric|min:0',
            'product_variants.*.sku' => 'nullable|string|max:20',
            'product_variants.*.image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'tags' => 'nullable|array',
            'tags.*' => 'exists:tags,id',
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
        ];
    }
}

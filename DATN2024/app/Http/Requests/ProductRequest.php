<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
            'slug' => 'required|string|unique:products,slug|max:255',
            'sku' => 'required|string',
            'img_thumbnail' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'price_regular' => 'required|numeric',
            'price_sale' => 'required|numeric',
            'short_description' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'screen_size' => 'required|string|max:50',
            'battery_capacity' => 'required|string|max:50',
            'camera_resolution' => 'required|string|max:100',
            'operating_system' => 'required|string|max:50',
            'processor' => 'required|string|max:100',
            'ram' => 'required|string|max:50',
            'storage' => 'required|string|max:50',
            'sim_type' => 'required|string|max:50',
            'network_connectivity' => 'required|string|max:100',
            'is_active' => 'nullable|boolean',
            'is_hot_deal' => 'nullable|boolean',
            'is_good_deal' => 'nullable|boolean',
            'is_new' => 'nullable|boolean',
            'is_show_home' => 'nullable|boolean',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'The product name is required.',
            'slug.required' => 'The slug is required.',
            'slug.unique' => 'The slug has already been taken.',
            'sku.required' => 'The SKU is required.',
            // 'sku.unique' => 'The SKU has already been taken.',
            'img_thumbnail.image' => 'The thumbnail must be an image.',
            'img_thumbnail.mimes' => 'The thumbnail must be a file of type: jpeg, png, jpg.',
            'img_thumbnail.max' => 'The thumbnail may not be greater than 2048 kilobytes.',
            'price_regular.required' => 'The regular price is required.',
            'price_regular.numeric' => 'The regular price must be a number.',
            'price_sale.numeric' => 'The sale price must be a number.',
            'short_description.max' => 'The short description may not be greater than 255 characters.',
            'screen_size.required' => 'The screen size is required.',
            'battery_capacity.required' => 'The battery capacity is required.',
            'camera_resolution.required' => 'The camera resolution is required.',
            'operating_system.required' => 'The operating system is required.',
            'processor.required' => 'The processor is required.',
            'ram.required' => 'The RAM is required.',
            'storage.required' => 'The storage is required.',
            'sim_type.required' => 'The SIM type is required.',
            'network_connectivity.required' => 'The network connectivity is required.',
        ];
    }
}

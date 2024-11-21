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
            'processor' => 'required|string|max:255',
            'ram' => 'required|string|max:255',
            'short_description' => 'required|string|max:500',
            'screen_size' => 'required|string|max:255',
            'operating_system' => 'required|string|max:255',
            'battery_capacity' => 'required|string|max:255',
            'camera_resolution' => 'required|string|max:255',
            'network_connectivity' => 'required|string|max:255',
            'storage' => 'required|string|max:255',
            'sim_type' => 'required|string|max:255',
            'description' => 'nullable|string',
            'is_active' => 'nullable|boolean',
            'is_hot_deal' => 'nullable|boolean',
            'is_good_deal' => 'nullable|boolean',
            'is_new' => 'nullable|boolean',
            'is_show_home' => 'nullable|boolean',

            'product_galleries' => 'nullable|array|min:1',
            'product_galleries.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',

        ];

    }

    public function messages()
    {
        return [
            'name.required' => 'The product name is required.',
            'name.string' => 'The product name must be a string.',
            'name.max' => 'The product name must not exceed 255 characters.',
            
            'price_regular.required' => 'The regular price is required.',
            'price_regular.numeric' => 'The regular price must be a numeric value.',
            'price_regular.min' => 'The regular price must be at least 0.',

            'price_sale.numeric' => 'The sale price must be a numeric value.',
            'price_sale.min' => 'The sale price must be at least 0.',
            'price_sale.lt' => 'The sale price must be less than the regular price.',

            'catalogue_id.required' => 'The catalogue is required.',
            'catalogue_id.exists' => 'The selected catalogue is invalid.',

            'img_thumbnail.image' => 'The thumbnail must be an image.',
            'img_thumbnail.mimes' => 'The thumbnail must be a file of type: jpeg, png, jpg, gif, svg.',
            'img_thumbnail.max' => 'The thumbnail size must not exceed 2MB.',

            'processor.required' => 'The processor is required.',
            'processor.string' => 'The processor must be a string.',
            'processor.max' => 'The processor must not exceed 255 characters.',

            'ram.required' => 'The RAM is required.',
            'ram.string' => 'The RAM must be a string.',
            'ram.max' => 'The RAM must not exceed 255 characters.',

            'short_description.required' => 'A short description is required.',
            'short_description.string' => 'The short description must be a string.',
            'short_description.max' => 'The short description must not exceed 500 characters.',

            'screen_size.required' => 'The screen size is required.',
            'screen_size.string' => 'The screen size must be a string.',
            'screen_size.max' => 'The screen size must not exceed 255 characters.',

            'operating_system.required' => 'The operating system is required.',
            'operating_system.string' => 'The operating system must be a string.',
            'operating_system.max' => 'The operating system must not exceed 255 characters.',

            'battery_capacity.required' => 'The battery capacity is required.',
            'battery_capacity.string' => 'The battery capacity must be a string.',
            'battery_capacity.max' => 'The battery capacity must not exceed 255 characters.',

            'camera_resolution.required' => 'The camera resolution is required.',
            'camera_resolution.string' => 'The camera resolution must be a string.',
            'camera_resolution.max' => 'The camera resolution must not exceed 255 characters.',

            'network_connectivity.required' => 'The network connectivity is required.',
            'network_connectivity.string' => 'The network connectivity must be a string.',
            'network_connectivity.max' => 'The network connectivity must not exceed 255 characters.',

            'storage.required' => 'The storage capacity is required.',
            'storage.string' => 'The storage capacity must be a string.',
            'storage.max' => 'The storage capacity must not exceed 255 characters.',

            'sim_type.required' => 'The SIM type is required.',
            'sim_type.string' => 'The SIM type must be a string.',
            'sim_type.max' => 'The SIM type must not exceed 255 characters.',

            'description.string' => 'The description must be a string.',

            'is_active.boolean' => 'The active status must be true or false.',
            'is_hot_deal.boolean' => 'The hot deal status must be true or false.',
            'is_good_deal.boolean' => 'The good deal status must be true or false.',
            'is_new.boolean' => 'The new product status must be true or false.',
            'is_show_home.boolean' => 'The show on home status must be true or false.',

            'product_galleries.array' => 'The product galleries must be an array.',
            'product_galleries.min' => 'At least one product gallery image is required.',
            'product_galleries.*.image' => 'Each product gallery image must be an image.',
            'product_galleries.*.mimes' => 'Each product gallery image must be a file of type: jpeg, png, jpg, gif.',
            'product_galleries.*.max' => 'Each product gallery image size must not exceed 2MB.',
        ];
    }
}

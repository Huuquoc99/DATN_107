<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BannerRequest extends FormRequest
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
            'title'       => 'required|string|max:255',
            'description' => 'nullable|string|max:500',
            'link'        => 'required|url',
            'image'       => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ];
    }

    public function messages(): array
    {
        return [
            'title.required'       => 'The title field is required.',
            'title.string'         => 'The title must be a string.',
            'title.max'            => 'The title may not be greater than 255 characters.',
            'description.string'   => 'The description must be a string.',
            'description.max'      => 'The description may not be greater than 500 characters.',
            'link.url'             => 'The link must be a valid URL.',
            'link.required'        => 'The link field is required.',
            'image.image'          => 'The file must be an image.',
            'image.mimes'          => 'The image must be a file of type: jpeg, png, jpg, gif, svg.',
            'image.max'            => 'The image size may not be greater than 2MB.',
            'image.required'       => 'The image field is required.',
            
        ];
    }
}

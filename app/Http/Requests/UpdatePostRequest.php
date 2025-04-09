<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePostRequest extends FormRequest
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
            'title' => 'required|max:255',
            'description' => 'required|max:65535',
            'price' => 'required|numeric|min:0',
            'category_id' => 'required|exists:categories,id',
            'city_id' => 'required|exists:cities,id',
            'photos' => 'nullable',
            'photos.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ];
    }

    public function messages(): array
    {
        return [
            'title.required' => __(key: 'post.'.'The title is required.'),
            'title.max' => __('post.'.'The title cannot be longer than 255 characters.'),

            'description.required' => __('post.'.'The description is required.'),
            'description.max' => __('post.'.'The description cannot be longer than 65,535 characters.'),

            'price.required' => __('post.'.'The price is required.'),
            'price.numeric' => __('post.'.'The price must be a number.'),
            'price.min' => __('post.'.'The price cannot be negative.'),

            'category_id.required' => __('post.'.'Please select a category.'),
            'category_id.exists' => __('post.'.'The selected category is invalid.'),

            'city_id.required' => __('post.'.'Please select a city.'),
            'city_id.exists' => __('post.'.'The selected city is invalid.'),

            'photos.array' => __('post.'.'The images must be in an array format.'),
            'photos.max' => __('post.'.'You can upload up to'.env('MAX_UPLOAD_NUMNER', 5).'images only.'),

            'photos.*.image' => __('post.'.'The uploaded file must be an image.'),
            'photos.*.mimes' => __('post.'.'Images must be of type: jpeg, png, jpg, gif, or svg.'),
            'photos.*.max' => __('post.'.'Each image must not be larger than '.env('MAX_UPLOAD_SIZE', 2048) / 1024 .' MB.'),
        ];
    }
}

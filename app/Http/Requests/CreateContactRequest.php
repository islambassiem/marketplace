<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class CreateContactRequest extends FormRequest
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
        $types = implode(',', array_keys(\App\Models\Contact::TYPES));
        $rules = [
            'type' => 'required|in:'.$types,
            'subject' => 'required|string|max:255',
            'body' => 'required|string|max:1000',
        ];
        if (! Auth::check()) {
            $rules['name'] = 'required|string|max:255';
            $rules['email'] = 'required|email|max:255';
        }

        return $rules;
    }

    public function messages(): array
    {
        return [
            'type.required' => __('contact.'.'Please select a contact type'),
            'type.in' => __('contact.'.'The selected contact type is invalid.'),
            'subject.required' => __('contact.'.'The subject is required.'),
            'subject.max' => __('contact.'.'The subject cannot be longer than 255 characters.'),
            'body.required' => __('contact.'.'The body is required.'),
            'body.max' => __('contact.'.'The body cannot be longer than 1000 characters.'),
            'name.required' => __('contact.'.'The name is required.'),
            'name.max' => __('contact.'.'The name cannot be longer than 255 characters.'),
            'email.required' => __('contact.'.'The email is required.'),
            'email.email' => __('contact.'.'The email is not valid.'),
            'email.max' => __('contact.'.'The email cannot be longer than 255 characters.'),
        ];
    }
}

<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ShortUrlCreationRequest extends FormRequest
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
            'original_url' => 'required|string|url',
            'is_private' => 'nullable|boolean',
            'expiration' => 'nullable|integer|min:1|max:90',
            'shortened_url' => 'nullable|string|unique:short_urls,shortened_url',
        ];
    }
}

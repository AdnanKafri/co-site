<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class UpdateGeneralSettingsRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'company_name' => ['required', 'string', 'max:255'],
            'email' => ['nullable', 'email', 'max:255'],
            'phone' => ['nullable', 'string', 'max:255'],
            'address' => ['nullable', 'string', 'max:500'],
            'brand_primary' => ['nullable', 'string', 'max:20'],
            'brand_secondary' => ['nullable', 'string', 'max:20'],
            'maps_embed' => ['nullable', 'string'],
            'logo_media_id' => ['nullable', 'integer', 'exists:media,id'],
            'favicon_media_id' => ['nullable', 'integer', 'exists:media,id'],
            'default_title' => ['nullable', 'string', 'max:255'],
            'default_description' => ['nullable', 'string', 'max:320'],
            'default_og_image_media_id' => ['nullable', 'integer', 'exists:media,id'],
            'linkedin' => ['nullable', 'url', 'max:255'],
            'instagram' => ['nullable', 'url', 'max:255'],
            'x' => ['nullable', 'url', 'max:255'],
        ];
    }
}

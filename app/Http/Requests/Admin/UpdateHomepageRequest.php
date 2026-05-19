<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class UpdateHomepageRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'hero.badge' => ['nullable', 'string', 'max:120'],
            'hero.title' => ['nullable', 'string', 'max:255'],
            'hero.body' => ['nullable', 'string'],
            'hero.primary_label' => ['nullable', 'string', 'max:120'],
            'hero.primary_url' => ['nullable', 'string', 'max:255'],
            'hero.secondary_label' => ['nullable', 'string', 'max:120'],
            'hero.secondary_url' => ['nullable', 'string', 'max:255'],
            'hero.media_id' => ['nullable', 'integer', 'exists:media,id'],
            'features.eyebrow' => ['nullable', 'string', 'max:120'],
            'features.title' => ['nullable', 'string', 'max:255'],
            'features.items' => ['nullable', 'array'],
            'features.items.*.title' => ['nullable', 'string', 'max:255'],
            'features.items.*.body' => ['nullable', 'string', 'max:500'],
            'cta.title' => ['nullable', 'string', 'max:255'],
            'cta.body' => ['nullable', 'string'],
            'cta.button_label' => ['nullable', 'string', 'max:120'],
            'cta.button_url' => ['nullable', 'string', 'max:255'],
            'cta.media_id' => ['nullable', 'integer', 'exists:media,id'],
            'partners_rail.title' => ['nullable', 'string', 'max:255'],
            'partners_rail.body' => ['nullable', 'string', 'max:500'],
        ];
    }
}

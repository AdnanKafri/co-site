<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\UpdateGeneralSettingsRequest;
use App\Services\Settings\SettingsManager;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class SettingsController extends Controller
{
    public function __construct(protected SettingsManager $settings)
    {
    }

    public function edit(): View
    {
        return view('admin.settings.edit', [
            'general' => $this->settings->group('general'),
            'seo' => $this->settings->group('seo'),
            'social' => $this->settings->group('social'),
        ]);
    }

    public function update(UpdateGeneralSettingsRequest $request): RedirectResponse
    {
        foreach ([
            'company_name',
            'email',
            'phone',
            'address',
            'brand_primary',
            'brand_secondary',
            'maps_embed',
            'logo_media_id',
            'favicon_media_id',
        ] as $key) {
            $this->settings->set('general.'.$key, $request->validated($key));
        }

        foreach ([
            'default_title',
            'default_description',
            'default_og_image_media_id',
        ] as $key) {
            $this->settings->set('seo.'.$key, $request->validated($key));
        }

        foreach ([
            'linkedin',
            'instagram',
            'x',
        ] as $key) {
            $this->settings->set('social.'.$key, $request->validated($key));
        }

        return back()->with('status', 'Settings updated successfully.');
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\UpdateHomepageRequest;
use App\Models\PageSection;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class HomepageController extends Controller
{
    public function edit(): View
    {
        $sections = PageSection::query()
            ->where('page', 'home')
            ->get()
            ->keyBy('section');

        return view('admin.homepage.edit', [
            'hero' => $sections->get('hero')?->data ?? [],
            'features' => $sections->get('features')?->data ?? [],
            'cta' => $sections->get('cta')?->data ?? [],
            'partnersRail' => $sections->get('partners_rail')?->data ?? [],
        ]);
    }

    public function update(UpdateHomepageRequest $request): RedirectResponse
    {
        foreach ([
            'hero' => 10,
            'features' => 20,
            'cta' => 30,
            'partners_rail' => 40,
        ] as $section => $sortOrder) {
            PageSection::query()->updateOrCreate(
                ['page' => 'home', 'section' => $section],
                [
                    'data' => $request->validated($section, []),
                    'is_active' => true,
                    'sort_order' => $sortOrder,
                ]
            );
        }

        return back()->with('status', 'Homepage content updated successfully.');
    }
}

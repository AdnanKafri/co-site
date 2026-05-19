<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\PageSection;
use App\Models\TeamMember;
use App\Support\Seo\SeoData;
use Illuminate\View\View;

class AboutController extends Controller
{
    public function __invoke(): View
    {
        return view('pages.about', [
            'seo' => new SeoData('About'),
            'sections' => PageSection::query()
                ->where('page', 'about')
                ->where('is_active', true)
                ->orderBy('sort_order')
                ->get()
                ->keyBy('section'),
            'teamMembers' => TeamMember::query()->where('is_active', true)->orderBy('sort_order')->get(),
        ]);
    }
}

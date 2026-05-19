<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\PageSection;
use App\Models\Partner;
use App\Models\Project;
use App\Models\Service;
use App\Support\Seo\SeoData;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function __invoke(): View
    {
        $sections = PageSection::query()
            ->where('page', 'home')
            ->where('is_active', true)
            ->orderBy('sort_order')
            ->get()
            ->keyBy('section');

        return view('pages.home', [
            'seo' => new SeoData('PressnGo'),
            'sections' => $sections,
            'featuredServices' => Service::query()->where('featured', true)->orderBy('sort_order')->take(3)->get(),
            'featuredProjects' => Project::query()->where('featured', true)->latest()->take(3)->get(),
            'partners' => Partner::query()->where('is_active', true)->orderBy('sort_order')->take(8)->get(),
        ]);
    }
}

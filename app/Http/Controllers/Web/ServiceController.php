<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Service;
use App\Support\Seo\SeoData;
use Illuminate\View\View;

class ServiceController extends Controller
{
    public function index(): View
    {
        $services = Service::query()->with('image')->orderBy('sort_order')->get();

        return view('pages.services.index', [
            'seo' => new SeoData('Services'),
            'services' => $services,
            'featuredServices' => $services->where('featured', true)->take(2)->values(),
        ]);
    }

    public function show(Service $service): View
    {
        return view('pages.services.show', [
            'seo' => new SeoData($service->title),
            'service' => $service->load('image'),
            'relatedServices' => Service::query()
                ->with('image')
                ->whereKeyNot($service->id)
                ->orderBy('sort_order')
                ->take(3)
                ->get(),
        ]);
    }
}

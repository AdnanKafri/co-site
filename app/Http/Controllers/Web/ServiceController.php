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
        return view('pages.services.index', [
            'seo' => new SeoData('Services'),
            'services' => Service::query()->with('image')->orderBy('sort_order')->get(),
        ]);
    }

    public function show(Service $service): View
    {
        return view('pages.services.show', [
            'seo' => new SeoData($service->title),
            'service' => $service->load('image'),
        ]);
    }
}

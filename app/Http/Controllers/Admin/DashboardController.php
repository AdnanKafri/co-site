<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Inquiry;
use App\Models\Media;
use App\Models\Project;
use App\Models\Service;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function __invoke(): View
    {
        return view('admin.dashboard.index', [
            'stats' => [
                'services' => Service::query()->count(),
                'projects' => Project::query()->count(),
                'media' => Media::query()->count(),
                'newInquiries' => Inquiry::query()->where('status', 'new')->count(),
            ],
        ]);
    }
}

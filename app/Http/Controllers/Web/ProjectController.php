<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Support\Seo\SeoData;
use Illuminate\View\View;

class ProjectController extends Controller
{
    public function index(): View
    {
        return view('pages.projects.index', [
            'seo' => new SeoData('Projects'),
            'projects' => Project::query()->latest()->get(),
        ]);
    }

    public function show(Project $project): View
    {
        return view('pages.projects.show', [
            'seo' => new SeoData($project->title),
            'project' => $project->load('gallery'),
        ]);
    }
}

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
        $projects = Project::query()->with('cover')->latest()->get();

        return view('pages.projects.index', [
            'seo' => new SeoData('Projects'),
            'projects' => $projects,
            'featuredProjects' => $projects->where('featured', true)->take(2)->values(),
        ]);
    }

    public function show(Project $project): View
    {
        return view('pages.projects.show', [
            'seo' => new SeoData($project->title),
            'project' => $project->load('gallery'),
            'relatedProjects' => Project::query()
                ->with('cover')
                ->whereKeyNot($project->id)
                ->latest()
                ->take(2)
                ->get(),
        ]);
    }
}

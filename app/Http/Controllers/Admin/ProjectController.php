<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ProjectRequest;
use App\Models\Project;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Str;
use Illuminate\View\View;

class ProjectController extends Controller
{
    public function index(): View
    {
        return view('admin.projects.index', [
            'projects' => Project::query()->with(['cover', 'gallery'])->latest()->paginate(20),
        ]);
    }

    public function create(): View
    {
        return view('admin.projects.create', [
            'project' => new Project([
                'featured' => false,
            ]),
        ]);
    }

    public function store(ProjectRequest $request): RedirectResponse
    {
        $project = Project::query()->create($this->payload($request));
        $this->syncGallery($project, $request->validated('gallery_media_ids', []));

        return redirect()->route('admin.projects.edit', $project)->with('status', 'Project created successfully.');
    }

    public function edit(Project $project): View
    {
        return view('admin.projects.edit', [
            'project' => $project->load('gallery'),
        ]);
    }

    public function update(ProjectRequest $request, Project $project): RedirectResponse
    {
        $project->update($this->payload($request));
        $this->syncGallery($project, $request->validated('gallery_media_ids', []));

        return back()->with('status', 'Project updated successfully.');
    }

    public function destroy(Project $project): RedirectResponse
    {
        $project->delete();

        return redirect()->route('admin.projects.index')->with('status', 'Project deleted successfully.');
    }

    protected function payload(ProjectRequest $request): array
    {
        $data = $request->validated();
        $data['featured'] = $request->boolean('featured');
        $data['slug'] = Str::slug($data['slug']);
        $data['technologies'] = collect(explode(',', (string) ($data['technologies'] ?? '')))
            ->map(fn (string $item) => trim($item))
            ->filter()
            ->values()
            ->all();

        unset($data['gallery_media_ids']);

        return $data;
    }

    protected function syncGallery(Project $project, array $ids): void
    {
        $syncData = collect($ids)
            ->values()
            ->mapWithKeys(fn ($id, $index) => [$id => ['sort_order' => $index]])
            ->all();

        $project->gallery()->sync($syncData);
    }
}

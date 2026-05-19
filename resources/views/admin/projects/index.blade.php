<x-layouts.admin title="Projects">
    <div class="mb-6 flex items-center justify-between gap-4">
        <div>
            <h2 class="text-lg font-semibold text-slate-950">Projects / Portfolio</h2>
            <p class="mt-1 text-sm text-slate-500">Curated case studies with cover media, gallery assets, and technology tags.</p>
        </div>
        <a href="{{ route('admin.projects.create') }}" class="rounded-full bg-slate-950 px-5 py-3 text-sm font-semibold text-white transition hover:bg-slate-800">
            Add Project
        </a>
    </div>

    <div class="overflow-hidden rounded-[2rem] bg-white shadow-sm ring-1 ring-slate-200">
        <table class="min-w-full divide-y divide-slate-200 text-sm">
            <thead class="bg-slate-50 text-left text-slate-500">
                <tr>
                    <th class="px-6 py-4">Project</th>
                    <th class="px-6 py-4">Category</th>
                    <th class="px-6 py-4">Featured</th>
                    <th class="px-6 py-4">Gallery</th>
                    <th class="px-6 py-4"></th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100">
                @forelse ($projects as $project)
                    <tr>
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-4">
                                @if ($project->cover)
                                    <img src="{{ $project->cover->url }}" alt="{{ $project->title }}" class="h-16 w-16 rounded-2xl object-cover">
                                @else
                                    <div class="flex h-16 w-16 items-center justify-center rounded-2xl bg-slate-100 text-xs text-slate-500">No cover</div>
                                @endif
                                <div>
                                    <p class="font-medium text-slate-900">{{ $project->title }}</p>
                                    <p class="text-slate-500">{{ $project->client }}</p>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4 text-slate-600">{{ $project->category }}</td>
                        <td class="px-6 py-4 text-slate-600">{{ $project->featured ? 'Yes' : 'No' }}</td>
                        <td class="px-6 py-4 text-slate-600">{{ $project->gallery->count() }}</td>
                        <td class="px-6 py-4 text-right">
                            <a href="{{ route('admin.projects.edit', $project) }}" class="font-medium text-slate-900">Edit</a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-6 py-10 text-center text-slate-500">No projects created yet.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-6">{{ $projects->links() }}</div>
</x-layouts.admin>

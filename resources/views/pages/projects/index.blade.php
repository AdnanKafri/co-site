<x-layouts.app>
    <section class="mx-auto max-w-7xl px-6 py-24">
        <div class="max-w-3xl">
            <p class="text-sm uppercase tracking-[0.3em] text-sky-200">Projects</p>
            <h1 class="mt-6 font-[family-name:var(--font-display)] text-5xl font-semibold text-white">A curated portfolio layer for case studies, proof, and capability.</h1>
        </div>

        <div class="mt-16 grid gap-6 md:grid-cols-2">
            @forelse ($projects as $project)
                <a href="{{ route('projects.show', $project) }}" class="rounded-[2rem] border border-white/10 bg-white/5 p-6 transition hover:-translate-y-1 hover:border-white/20">
                    <p class="text-sm text-sky-200">{{ $project->category ?: 'Project' }}</p>
                    <h2 class="mt-3 text-2xl font-semibold text-white">{{ $project->title }}</h2>
                    <p class="mt-3 text-sm text-slate-400">{{ $project->client }}</p>
                    <p class="mt-4 text-sm leading-7 text-slate-300">{{ \Illuminate\Support\Str::limit(strip_tags($project->description), 180) }}</p>
                </a>
            @empty
                <div class="rounded-[2rem] border border-dashed border-white/15 bg-white/5 p-6 text-slate-300 md:col-span-2">
                    No projects published yet.
                </div>
            @endforelse
        </div>
    </section>
</x-layouts.app>

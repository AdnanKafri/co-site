<x-layouts.app>
    <section class="mx-auto max-w-5xl px-6 py-24">
        <p class="text-sm uppercase tracking-[0.3em] text-sky-200">{{ $project->category ?: 'Project' }}</p>
        <h1 class="mt-6 font-[family-name:var(--font-display)] text-5xl font-semibold text-white">{{ $project->title }}</h1>
        <p class="mt-4 text-sm text-slate-400">{{ $project->client }}</p>
        <div class="prose prose-invert mt-10 max-w-none prose-p:text-slate-300">
            {!! nl2br(e($project->description)) !!}
        </div>
    </section>
</x-layouts.app>

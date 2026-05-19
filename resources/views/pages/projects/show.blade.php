<x-layouts.app>
    <section class="mx-auto max-w-5xl px-6 py-24">
        @if ($project->cover)
            <img src="{{ $project->cover->url }}" alt="{{ $project->title }}" class="mb-10 h-[28rem] w-full rounded-[2rem] object-cover">
        @endif
        <p class="text-sm uppercase tracking-[0.3em] text-sky-200">{{ $project->category ?: 'Project' }}</p>
        <h1 class="mt-6 font-[family-name:var(--font-display)] text-5xl font-semibold text-white">{{ $project->title }}</h1>
        <p class="mt-4 text-sm text-slate-400">{{ $project->client }}</p>
        @if (! empty($project->technologies))
            <div class="mt-6 flex flex-wrap gap-3">
                @foreach ($project->technologies as $technology)
                    <span class="rounded-full border border-white/10 bg-white/5 px-4 py-2 text-sm text-slate-200">{{ $technology }}</span>
                @endforeach
            </div>
        @endif
        <div class="prose prose-invert mt-10 max-w-none prose-p:text-slate-300">
            {!! nl2br(e($project->description)) !!}
        </div>
        @if ($project->gallery->isNotEmpty())
            <div class="mt-12 grid gap-4 sm:grid-cols-2 lg:grid-cols-3">
                @foreach ($project->gallery as $image)
                    <img src="{{ $image->url }}" alt="{{ $image->alt_text ?: $project->title }}" class="h-56 w-full rounded-[1.75rem] object-cover">
                @endforeach
            </div>
        @endif
    </section>
</x-layouts.app>

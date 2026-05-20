<x-layouts.app>
    <section class="site-container section-space">
        <div class="grid gap-8 xl:grid-cols-[0.95fr_1.05fr] xl:items-end">
            <div class="max-w-3xl">
                <p class="eyebrow">{{ $project->category ?: 'Project' }}</p>
                <h1 class="hero-display mt-8">{{ $project->title }}</h1>
                <p class="mt-5 text-sm uppercase tracking-[0.24em] text-slate-400">{{ $project->client }}</p>
            </div>
            <div class="glass-panel p-6 sm:p-8">
                @if (! empty($project->technologies))
                    <p class="text-[11px] uppercase tracking-[0.22em] text-slate-400">Technologies</p>
                    <div class="mt-5 flex flex-wrap gap-3">
                @foreach ($project->technologies as $technology)
                            <span class="rounded-full border border-white/10 bg-white/[0.04] px-4 py-2 text-sm text-slate-200">{{ $technology }}</span>
                @endforeach
                    </div>
                @endif
                <div class="soft-divider my-8"></div>
                <p class="body-md">
                    The project page is intentionally composed as a case-study experience, allowing the content to remain dynamic while the visual hierarchy stays directed and branded.
                </p>
            </div>
        </div>
    </section>

    <section class="site-container section-space">
        <div class="grid gap-8 xl:grid-cols-[1.05fr_0.95fr] xl:items-start">
            <div class="glass-panel-strong overflow-hidden p-3">
                <div class="relative aspect-[5/4] overflow-hidden rounded-[1.8rem] bg-slate-900">
                    @if ($project->cover)
                        <img src="{{ $project->cover->url }}" alt="{{ $project->title }}" class="absolute inset-0 h-full w-full object-cover">
                    @endif
                    <div class="absolute inset-0 bg-[linear-gradient(180deg,rgba(9,16,30,0.08),rgba(9,16,30,0.72))]"></div>
                </div>
            </div>
            <div class="glass-panel p-7">
                <p class="text-[11px] uppercase tracking-[0.22em] text-slate-400">Case study narrative</p>
                <div class="prose prose-invert mt-5 max-w-none prose-p:text-slate-300 prose-p:leading-8">
                    {!! nl2br(e($project->description)) !!}
                </div>
            </div>
        </div>
    </section>

    @if ($project->gallery->isNotEmpty())
        <section class="site-container section-space">
            <div class="mb-8 max-w-3xl">
                <p class="eyebrow">Gallery</p>
                <h2 class="section-title mt-6">Supporting visuals inside the same story arc.</h2>
            </div>
            <div class="grid gap-4 sm:grid-cols-2 lg:grid-cols-3">
                @foreach ($project->gallery as $image)
                    <div class="site-card">
                        <div class="relative aspect-[4/3] overflow-hidden">
                            <img src="{{ $image->url }}" alt="{{ $image->alt_text ?: $project->title }}" class="absolute inset-0 h-full w-full object-cover">
                        </div>
                    </div>
                @endforeach
            </div>
        </section>
    @endif

    @if ($relatedProjects->isNotEmpty())
        <section class="site-container section-space">
            <div class="mb-8 max-w-3xl">
                <p class="eyebrow">More Work</p>
                <h2 class="section-title mt-6">Related projects in the same visual ecosystem.</h2>
            </div>
            <div class="grid gap-6 md:grid-cols-2">
                @foreach ($relatedProjects as $related)
                    <a href="{{ route('projects.show', $related) }}" class="site-card">
                        @if ($related->cover)
                            <div class="relative aspect-[5/4] overflow-hidden">
                                <img src="{{ $related->cover->url }}" alt="{{ $related->title }}" class="absolute inset-0 h-full w-full object-cover">
                            </div>
                        @endif
                        <div class="p-6">
                            <p class="text-sm uppercase tracking-[0.22em] text-sky-100">{{ $related->category ?: 'Project' }}</p>
                            <h2 class="mt-3 text-2xl font-semibold text-white">{{ $related->title }}</h2>
                            <p class="mt-3 text-sm text-slate-400">{{ $related->client }}</p>
                        </div>
                    </a>
                @endforeach
            </div>
        </section>
    @endif
</x-layouts.app>

<x-layouts.app>
    <x-site.breadcrumbs :items="[
        ['label' => 'Home', 'url' => route('home')],
        ['label' => 'Projects', 'url' => route('projects.index')],
        ['label' => $project->title],
    ]" />

    <section class="site-container section-space" data-reveal>
        <div class="grid gap-8 xl:grid-cols-[0.95fr_1.05fr] xl:items-end">
            <div class="max-w-3xl">
                <p class="eyebrow">{{ $project->category ?: 'Project' }}</p>
                <h1 class="hero-display mt-8">{{ $project->title }}</h1>
                <p class="mt-5 text-sm uppercase tracking-[0.24em] text-slate-400">{{ $project->client }}</p>
            </div>
            <div class="glass-panel p-6 sm:p-8">
                @if (! empty($project->technologies))
                    <p class="text-[11px] uppercase tracking-[0.22em] text-slate-400">Technologies</p>
                    <div class="mt-5 flex flex-wrap gap-3" data-reveal data-reveal-stagger="true">
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

    <section class="site-container section-space" data-reveal>
        <div class="grid gap-8 xl:grid-cols-[1.05fr_0.95fr] xl:items-start">
            <div class="glass-panel-strong overflow-hidden p-3">
                <x-site.media-frame
                    :src="$project->cover?->url"
                    :alt="$project->title"
                    ratio="aspect-[5/4]"
                    rounded="rounded-[1.8rem]"
                    overlayClass="bg-[linear-gradient(180deg,rgba(9,16,30,0.08),rgba(9,16,30,0.72))]"
                    imageClass="image-zoom"
                />
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
                    <div class="site-card hover-glow">
                        <x-site.media-frame
                            :src="$image->url"
                            :alt="$image->alt_text ?: $project->title"
                            ratio="aspect-[4/3]"
                            rounded="rounded-none"
                            overlayClass="bg-[linear-gradient(180deg,rgba(9,16,30,0.06),rgba(9,16,30,0.45))]"
                            imageClass="image-zoom"
                        />
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
                    <a href="{{ route('projects.show', $related) }}" class="site-card group">
                        <x-site.media-frame
                            :src="$related->cover?->url"
                            :alt="$related->title"
                            ratio="aspect-[5/4]"
                            rounded="rounded-none"
                            overlayClass="bg-[linear-gradient(180deg,rgba(10,18,34,0.08),rgba(10,18,34,0.78))]"
                            imageClass="image-zoom"
                        />
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

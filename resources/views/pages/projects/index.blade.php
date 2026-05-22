<x-layouts.app>
    <x-site.breadcrumbs :items="[
        ['label' => 'Home', 'url' => route('home')],
        ['label' => 'Projects'],
    ]" />

    <section class="site-container section-space" data-reveal>
        <div class="grid gap-8 xl:grid-cols-[1.05fr_0.95fr] xl:items-end">
            <div class="max-w-4xl">
                <p class="eyebrow">Projects</p>
                <h1 class="hero-display mt-8">Case studies composed like a portfolio narrative, not a content shelf.</h1>
                <p class="body-lg mt-8 max-w-3xl">
                    Featured work should feel like proof with atmosphere. The layout stays structured, but the visual sequencing is designed to carry weight and momentum.
                </p>
            </div>
            <div class="grid gap-4 sm:grid-cols-2" data-reveal data-reveal-stagger="true">
                @foreach ($featuredProjects as $featured)
                    <a href="{{ route('projects.show', $featured) }}" class="glass-panel hover-glow p-5 transition duration-500 hover:-translate-y-1 hover:border-white/20">
                        <p class="text-[11px] uppercase tracking-[0.22em] text-sky-100">{{ $featured->category ?: 'Featured' }}</p>
                        <h2 class="mt-4 text-2xl font-semibold text-white">{{ $featured->title }}</h2>
                        <p class="mt-3 text-sm text-slate-400">{{ $featured->client }}</p>
                    </a>
                @endforeach
            </div>
        </div>
    </section>

    <section class="site-container section-space" data-reveal>
        <div class="space-y-6">
                @forelse ($projects as $project)
                    <a href="{{ route('projects.show', $project) }}" class="site-card group grid gap-0 lg:grid-cols-[1fr_1fr]">
                        <div class="relative min-h-[20rem] overflow-hidden bg-slate-900 {{ $loop->even ? 'lg:order-2' : '' }}">
                            <x-site.media-frame
                                :src="$project->cover?->url"
                                :alt="$project->title"
                                ratio="aspect-[4/3] lg:aspect-auto lg:absolute lg:inset-0 lg:h-full"
                                rounded="rounded-none"
                                wrapperClass="h-full"
                                overlayClass="bg-[linear-gradient(180deg,rgba(10,18,34,0.08),rgba(10,18,34,0.78))]"
                                imageClass="image-zoom"
                            />
                        </div>
                    <div class="flex flex-col justify-between p-7 sm:p-8">
                        <div>
                            <p class="text-sm uppercase tracking-[0.24em] text-sky-100">{{ $project->category ?: 'Project' }}</p>
                            <h2 class="mt-4 text-3xl font-semibold text-white">{{ $project->title }}</h2>
                            <p class="mt-4 text-sm text-slate-400">{{ $project->client }}</p>
                            <p class="body-md mt-6 max-w-xl">{{ \Illuminate\Support\Str::limit(strip_tags($project->description), 180) }}</p>
                        </div>
                        <div class="mt-8 flex items-center justify-between gap-4">
                            <span class="text-sm text-slate-400">Case study framing</span>
                            <span class="text-sm font-semibold text-white transition duration-500 group-hover:translate-x-1">Explore</span>
                        </div>
                    </div>
                </a>
            @empty
                <div class="glass-panel border-dashed p-6 text-slate-300">
                    No projects published yet.
                </div>
            @endforelse
        </div>
    </section>
</x-layouts.app>

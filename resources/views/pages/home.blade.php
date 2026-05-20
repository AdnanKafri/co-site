<x-layouts.app>
    @php($heroImageId = $sections->get('hero')?->data['media_id'] ?? null)
    @php($heroImage = $heroImageId ? \App\Models\Media::query()->find($heroImageId) : null)
    @php($processSteps = ['Signal', 'Structure', 'Momentum'])

    <section class="site-container relative section-space min-h-[calc(100vh-5rem)]">
        <div class="grid gap-12 lg:grid-cols-[1.05fr_0.95fr] lg:items-center">
            <div class="relative z-10">
                <p class="eyebrow">
                    {{ $sections->get('hero')?->data['badge'] ?? 'Curated Digital Presence' }}
                </p>
                <h1 class="hero-display mt-8 max-w-5xl">
                    {{ $sections->get('hero')?->data['title'] ?? 'A premium company platform built for credibility, speed, and clear storytelling.' }}
                </h1>
                <p class="body-lg mt-8 max-w-2xl">
                    {{ $sections->get('hero')?->data['body'] ?? 'This foundation keeps the site developer-curated while making the real business content easy to manage through a lightweight custom dashboard.' }}
                </p>
                <div class="mt-10 flex flex-wrap gap-4">
                    <a href="{{ $sections->get('hero')?->data['primary_url'] ?? route('services.index') }}" class="rounded-full bg-white px-6 py-3 text-sm font-semibold text-slate-950 transition hover:bg-slate-200">
                        {{ $sections->get('hero')?->data['primary_label'] ?? 'Explore Services' }}
                    </a>
                    <a href="{{ $sections->get('hero')?->data['secondary_url'] ?? route('contact') }}" class="rounded-full border border-white/20 px-6 py-3 text-sm font-semibold text-white transition hover:border-white/40 hover:bg-white/5">
                        {{ $sections->get('hero')?->data['secondary_label'] ?? 'Contact Us' }}
                    </a>
                </div>

                <div class="mt-14 grid gap-4 sm:grid-cols-3">
                    <div class="glass-panel p-5">
                        <p class="text-[11px] uppercase tracking-[0.24em] text-slate-400">Services</p>
                        <p class="mt-3 text-3xl font-semibold text-white">{{ $serviceCount }}</p>
                    </div>
                    <div class="glass-panel p-5">
                        <p class="text-[11px] uppercase tracking-[0.24em] text-slate-400">Projects</p>
                        <p class="mt-3 text-3xl font-semibold text-white">{{ $projectCount }}</p>
                    </div>
                    <div class="glass-panel p-5">
                        <p class="text-[11px] uppercase tracking-[0.24em] text-slate-400">Approach</p>
                        <p class="mt-3 text-lg font-semibold text-white">Curated by design</p>
                    </div>
                </div>
            </div>

            <div class="relative z-10">
                <div class="glass-panel-strong relative overflow-hidden p-3">
                    <div class="relative aspect-[4/5] overflow-hidden rounded-[1.8rem] border border-white/10 bg-slate-950/60">
                        @if ($heroImage)
                            <img src="{{ $heroImage->url }}" alt="{{ $heroImage->alt_text ?: 'Hero media' }}" class="absolute inset-0 h-full w-full object-cover">
                            <div class="absolute inset-0 bg-[linear-gradient(180deg,rgba(6,12,22,0.08),rgba(6,12,22,0.55)_70%,rgba(6,12,22,0.82))]"></div>
                        @else
                            <div class="absolute inset-0 bg-[radial-gradient(circle_at_top,rgba(121,196,255,0.24),transparent_40%),linear-gradient(180deg,rgba(10,18,34,0.95),rgba(5,9,19,1))]"></div>
                        @endif

                        <div class="absolute inset-x-0 bottom-0 p-6 sm:p-8">
                            <div class="grid gap-4 sm:grid-cols-3">
                                @foreach ($processSteps as $step)
                                    <div class="rounded-[1.4rem] border border-white/10 bg-white/8 p-4 backdrop-blur-md">
                                        <p class="text-[11px] uppercase tracking-[0.24em] text-sky-100">0{{ $loop->iteration }}</p>
                                        <p class="mt-2 text-lg font-semibold text-white">{{ $step }}</p>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="site-container section-space">
        <div class="glass-panel-strong overflow-hidden px-6 py-8 sm:px-8 sm:py-10">
            <div class="grid gap-8 lg:grid-cols-[0.7fr_1.3fr] lg:items-start">
                <div>
                    <p class="eyebrow">{{ $sections->get('features')?->data['eyebrow'] ?? 'Why PressnGo' }}</p>
                    <h2 class="section-title mt-6">{{ $sections->get('features')?->data['title'] ?? 'A business-ready platform that stays clean under real-world use.' }}</h2>
                </div>
                <div class="grid gap-5 lg:grid-cols-3">
            @foreach (($sections->get('features')?->data['items'] ?? []) as $feature)
                        <article class="rounded-[1.8rem] border border-white/10 bg-white/[0.035] p-6">
                            <p class="text-[11px] uppercase tracking-[0.24em] text-sky-100">0{{ $loop->iteration }}</p>
                            <h3 class="mt-5 text-2xl font-semibold text-white">{{ $feature['title'] ?? '' }}</h3>
                            <p class="body-md mt-4">{{ $feature['body'] ?? '' }}</p>
                </article>
            @endforeach
                </div>
            </div>
        </div>
    </section>

    <section class="site-container section-space">
        <div class="grid gap-10 xl:grid-cols-[0.8fr_1.2fr]">
            <div class="xl:sticky xl:top-28 xl:self-start">
                <p class="eyebrow">Service Spectrum</p>
                <h2 class="section-display mt-6">Strategy, execution, and presentation woven into one flow.</h2>
                <p class="body-lg mt-6 max-w-xl">
                    The structure stays disciplined, but the experience feels directed. Each service lands inside the same visual ecosystem rather than breaking the narrative into disconnected cards.
                </p>
                <a href="{{ route('services.index') }}" class="mt-8 inline-flex rounded-full border border-white/14 px-6 py-3 text-sm font-semibold text-white transition hover:border-white/24 hover:bg-white/6">
                    View all services
                </a>
            </div>

            <div class="space-y-6">
            @forelse ($featuredServices as $service)
                    <a href="{{ route('services.show', $service) }}" class="site-card grid gap-0 lg:grid-cols-[0.82fr_1.18fr]">
                        <div class="relative min-h-[18rem] overflow-hidden bg-slate-900">
                            @if ($service->image)
                                <img src="{{ $service->image->url }}" alt="{{ $service->title }}" class="absolute inset-0 h-full w-full object-cover">
                            @endif
                            <div class="absolute inset-0 bg-[linear-gradient(180deg,rgba(7,13,24,0.1),rgba(7,13,24,0.7))]"></div>
                        </div>
                        <div class="flex flex-col justify-between p-7 sm:p-8">
                            <div>
                                <p class="text-sm uppercase tracking-[0.26em] text-sky-100">{{ $service->icon ?: 'Service' }}</p>
                                <h3 class="mt-4 text-3xl font-semibold text-white">{{ $service->title }}</h3>
                                <p class="body-md mt-5 max-w-xl">{{ $service->excerpt }}</p>
                            </div>
                            <div class="mt-8 flex items-center justify-between gap-4">
                                <span class="text-sm font-medium text-slate-200">Curated service page</span>
                                <span class="text-sm font-semibold text-white">Discover</span>
                            </div>
                        </div>
                    </a>
            @empty
                    <article class="glass-panel border-dashed p-6 text-slate-300">
                    Featured services will appear here once they are created in the admin dashboard.
                </article>
            @endforelse
            </div>
        </div>
    </section>

    <section class="site-container section-space">
        <div class="grid gap-6 lg:grid-cols-[1.2fr_0.8fr]">
            @forelse ($featuredProjects as $project)
                @if ($loop->first)
                    <a href="{{ route('projects.show', $project) }}" class="site-card lg:row-span-2">
                    @if ($project->cover)
                            <div class="relative aspect-[5/4] overflow-hidden">
                                <img src="{{ $project->cover->url }}" alt="{{ $project->title }}" class="absolute inset-0 h-full w-full object-cover">
                                <div class="absolute inset-0 bg-[linear-gradient(180deg,rgba(10,18,34,0.05),rgba(10,18,34,0.82))]"></div>
                            </div>
                    @endif
                        <div class="p-7 sm:p-8">
                            <p class="text-sm uppercase tracking-[0.26em] text-sky-100">{{ $project->category ?: 'Project' }}</p>
                            <h3 class="mt-4 text-3xl font-semibold text-white sm:text-4xl">{{ $project->title }}</h3>
                            <p class="mt-4 text-sm text-slate-400">{{ $project->client }}</p>
                            <p class="body-md mt-6 max-w-2xl">{{ \Illuminate\Support\Str::limit(strip_tags($project->description), 200) }}</p>
                        </div>
                    </a>
                @else
                    <a href="{{ route('projects.show', $project) }}" class="site-card">
                        @if ($project->cover)
                            <div class="relative aspect-[4/3] overflow-hidden">
                                <img src="{{ $project->cover->url }}" alt="{{ $project->title }}" class="absolute inset-0 h-full w-full object-cover">
                            </div>
                        @endif
                        <div class="p-6">
                            <p class="text-sm uppercase tracking-[0.24em] text-sky-100">{{ $project->category ?: 'Project' }}</p>
                            <h3 class="mt-3 text-2xl font-semibold text-white">{{ $project->title }}</h3>
                            <p class="mt-3 text-sm text-slate-400">{{ $project->client }}</p>
                        </div>
                    </a>
                @endif
            @empty
                <article class="glass-panel border-dashed p-6 text-slate-300 lg:col-span-2">
                    Featured projects will appear here once they are created in the admin dashboard.
                </article>
            @endforelse
        </div>
        <div class="mt-8 flex justify-end">
            <a href="{{ route('projects.index') }}" class="rounded-full border border-white/14 px-6 py-3 text-sm font-semibold text-white transition hover:border-white/24 hover:bg-white/6">
                View all projects
            </a>
        </div>
    </section>

    <section class="site-container section-space">
        <div class="grid gap-8 lg:grid-cols-[1fr_0.95fr]">
            <div class="glass-panel-strong p-8 sm:p-12">
                <div>
                        <p class="eyebrow">Call To Action</p>
                        <h2 class="section-display mt-6">{{ $sections->get('cta')?->data['title'] ?? 'Ready to shape a stronger digital presence?' }}</h2>
                        <p class="body-lg mt-6 max-w-3xl">{{ $sections->get('cta')?->data['body'] ?? 'Use the admin workflow to manage content confidently while the frontend stays cohesive and premium.' }}</p>
                    <div class="soft-divider my-10"></div>
                    <div class="grid gap-4 sm:grid-cols-3">
                        <div class="rounded-[1.5rem] border border-white/10 bg-white/[0.04] p-5">
                            <p class="text-[11px] uppercase tracking-[0.2em] text-slate-400">01</p>
                            <p class="mt-3 text-xl font-semibold text-white">Clarity</p>
                        </div>
                        <div class="rounded-[1.5rem] border border-white/10 bg-white/[0.04] p-5">
                            <p class="text-[11px] uppercase tracking-[0.2em] text-slate-400">02</p>
                            <p class="mt-3 text-xl font-semibold text-white">Structure</p>
                        </div>
                        <div class="rounded-[1.5rem] border border-white/10 bg-white/[0.04] p-5">
                            <p class="text-[11px] uppercase tracking-[0.2em] text-slate-400">03</p>
                            <p class="mt-3 text-xl font-semibold text-white">Momentum</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="glass-panel p-8 sm:p-10">
                <p class="text-sm uppercase tracking-[0.3em] text-sky-200">Studio Flow</p>
                <div class="mt-8 space-y-6">
                    <div class="rounded-[1.7rem] border border-white/10 bg-white/[0.04] p-6">
                        <p class="text-[11px] uppercase tracking-[0.2em] text-slate-400">Narrative</p>
                        <p class="body-md mt-3">Story and structure are designed first so every dynamic field fits an authored visual rhythm.</p>
                    </div>
                    <div class="rounded-[1.7rem] border border-white/10 bg-white/[0.04] p-6">
                        <p class="text-[11px] uppercase tracking-[0.2em] text-slate-400">Execution</p>
                        <p class="body-md mt-3">Laravel, Blade, Tailwind, and lightweight Alpine keep the experience polished without drifting into product complexity.</p>
                    </div>
                    <a href="{{ $sections->get('cta')?->data['button_url'] ?? route('contact') }}" class="inline-flex rounded-full bg-white px-6 py-3 text-sm font-semibold text-slate-950 transition hover:bg-slate-200">
                        {{ $sections->get('cta')?->data['button_label'] ?? 'Contact Us' }}
                    </a>
                </div>
            </div>
        </div>
    </section>

    <section class="site-container section-space">
        <div class="grid gap-10 lg:grid-cols-[0.9fr_1.1fr] lg:items-start">
            <div class="max-w-2xl">
                <p class="eyebrow">Partners</p>
                <h2 class="section-title mt-6">{{ $sections->get('partners_rail')?->data['title'] ?? 'Trusted by growing brands and ambitious teams.' }}</h2>
                <p class="body-lg mt-6">{{ $sections->get('partners_rail')?->data['body'] ?? 'Partner logos are managed from one central library and rendered in a curated homepage rail.' }}</p>
                @if ($teamMembers->isNotEmpty())
                    <div class="mt-10 flex items-center gap-4">
                        @foreach ($teamMembers as $member)
                            <div class="flex items-center gap-3 rounded-full border border-white/10 bg-white/[0.04] px-4 py-3">
                                @if ($member->image)
                                    <img src="{{ $member->image->url }}" alt="{{ $member->name }}" class="h-10 w-10 rounded-full object-cover">
                                @endif
                                <div>
                                    <p class="text-sm font-semibold text-white">{{ $member->name }}</p>
                                    <p class="text-xs uppercase tracking-[0.16em] text-slate-400">{{ $member->role }}</p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
            <div class="glass-panel-strong p-6">
                <div class="grid gap-4 sm:grid-cols-2 xl:grid-cols-3">
                    @forelse ($partners as $partner)
                        <a href="{{ $partner->website ?: '#' }}" class="flex min-h-28 items-center justify-center rounded-[1.75rem] border border-white/10 bg-white/[0.04] p-6 transition hover:border-white/20 hover:bg-white/[0.07]">
                            @if ($partner->logo)
                                <img src="{{ $partner->logo->url }}" alt="{{ $partner->name }}" class="max-h-12 w-auto object-contain opacity-90">
                            @else
                                <span class="text-sm text-slate-300">{{ $partner->name }}</span>
                            @endif
                        </a>
                    @empty
                        <div class="rounded-[1.75rem] border border-dashed border-white/15 bg-white/5 p-6 text-slate-300 sm:col-span-2 xl:col-span-3">
                            Partner logos will appear here once they are added in the admin dashboard.
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </section>
</x-layouts.app>

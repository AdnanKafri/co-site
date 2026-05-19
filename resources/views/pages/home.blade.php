<x-layouts.app>
    <section class="mx-auto max-w-7xl px-6 py-24 sm:py-32">
        <div class="grid gap-16 lg:grid-cols-[1.2fr_0.8fr] lg:items-end">
            <div>
                <p class="mb-6 inline-flex rounded-full border border-white/15 bg-white/5 px-4 py-2 text-xs uppercase tracking-[0.3em] text-sky-100">
                    {{ $sections->get('hero')?->data['badge'] ?? 'Curated Digital Presence' }}
                </p>
                <h1 class="max-w-4xl font-[family-name:var(--font-display)] text-5xl font-semibold tracking-tight text-white sm:text-6xl">
                    {{ $sections->get('hero')?->data['title'] ?? 'A premium company platform built for credibility, speed, and clear storytelling.' }}
                </h1>
                <p class="mt-6 max-w-2xl text-lg leading-8 text-slate-300">
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
            </div>

            <div class="overflow-hidden rounded-[2.25rem] border border-white/10 bg-white/5 backdrop-blur">
                @php($heroImageId = $sections->get('hero')?->data['media_id'] ?? null)
                @php($heroImage = $heroImageId ? \App\Models\Media::query()->find($heroImageId) : null)
                @if ($heroImage)
                    <img src="{{ $heroImage->url }}" alt="{{ $heroImage->alt_text ?: 'Hero media' }}" class="h-full min-h-[24rem] w-full object-cover">
                @else
                    <div class="grid min-h-[24rem] gap-4 p-6 sm:grid-cols-2">
                        <div class="rounded-[2rem] border border-white/10 bg-white/5 p-6">
                            <p class="text-sm text-slate-400">Featured Services</p>
                            <p class="mt-3 text-4xl font-semibold text-white">{{ $featuredServices->count() }}</p>
                        </div>
                        <div class="rounded-[2rem] border border-white/10 bg-white/5 p-6">
                            <p class="text-sm text-slate-400">Featured Projects</p>
                            <p class="mt-3 text-4xl font-semibold text-white">{{ $featuredProjects->count() }}</p>
                        </div>
                        <div class="rounded-[2rem] border border-white/10 bg-white/5 p-6 sm:col-span-2">
                            <p class="text-sm text-slate-400">Admin-Ready Structure</p>
                            <p class="mt-3 text-lg leading-8 text-slate-200">
                                The frontend is curated. The content is editable. The media is centralized and reusable.
                            </p>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </section>

    <section class="mx-auto max-w-7xl px-6 py-16">
        <div class="max-w-3xl">
            <p class="text-sm uppercase tracking-[0.3em] text-sky-200">{{ $sections->get('features')?->data['eyebrow'] ?? 'Why PressnGo' }}</p>
            <h2 class="mt-6 font-[family-name:var(--font-display)] text-4xl font-semibold text-white">{{ $sections->get('features')?->data['title'] ?? 'A business-ready platform that stays clean under real-world use.' }}</h2>
        </div>
        <div class="mt-10 grid gap-6 md:grid-cols-3">
            @foreach (($sections->get('features')?->data['items'] ?? []) as $feature)
                <article class="rounded-[2rem] border border-white/10 bg-white/5 p-6">
                    <h3 class="text-2xl font-semibold text-white">{{ $feature['title'] ?? '' }}</h3>
                    <p class="mt-3 text-sm leading-7 text-slate-300">{{ $feature['body'] ?? '' }}</p>
                </article>
            @endforeach
        </div>
    </section>

    <section class="mx-auto max-w-7xl px-6 py-16">
        <div class="mb-8 flex items-end justify-between gap-4">
            <div>
                <p class="text-sm uppercase tracking-[0.3em] text-sky-200">Featured Services</p>
                <h2 class="mt-4 font-[family-name:var(--font-display)] text-4xl font-semibold text-white">Clear offerings with editorial control and strong presentation.</h2>
            </div>
            <a href="{{ route('services.index') }}" class="text-sm font-medium text-white">View all services</a>
        </div>

        <div class="grid gap-6 md:grid-cols-3">
            @forelse ($featuredServices as $service)
                <a href="{{ route('services.show', $service) }}" class="overflow-hidden rounded-[2rem] border border-white/10 bg-white/5 transition hover:-translate-y-1 hover:border-white/20">
                    @if ($service->image)
                        <img src="{{ $service->image->url }}" alt="{{ $service->title }}" class="h-56 w-full object-cover">
                    @endif
                    <div class="p-6">
                        <p class="text-sm text-sky-200">{{ $service->icon ?: 'Service' }}</p>
                        <h3 class="mt-4 text-2xl font-semibold text-white">{{ $service->title }}</h3>
                        <p class="mt-3 text-sm leading-7 text-slate-300">{{ $service->excerpt }}</p>
                    </div>
                </a>
            @empty
                <article class="rounded-[2rem] border border-dashed border-white/15 bg-white/5 p-6 text-slate-300 md:col-span-3">
                    Featured services will appear here once they are created in the admin dashboard.
                </article>
            @endforelse
        </div>
    </section>

    <section class="mx-auto max-w-7xl px-6 py-16">
        <div class="mb-8 flex items-end justify-between gap-4">
            <div>
                <p class="text-sm uppercase tracking-[0.3em] text-sky-200">Featured Projects</p>
                <h2 class="mt-4 font-[family-name:var(--font-display)] text-4xl font-semibold text-white">Selected work presented as proof, not clutter.</h2>
            </div>
            <a href="{{ route('projects.index') }}" class="text-sm font-medium text-white">View all projects</a>
        </div>

        <div class="grid gap-6 md:grid-cols-3">
            @forelse ($featuredProjects as $project)
                <a href="{{ route('projects.show', $project) }}" class="overflow-hidden rounded-[2rem] border border-white/10 bg-white/5 transition hover:-translate-y-1 hover:border-white/20">
                    @if ($project->cover)
                        <img src="{{ $project->cover->url }}" alt="{{ $project->title }}" class="h-56 w-full object-cover">
                    @endif
                    <div class="p-6">
                        <p class="text-sm text-sky-200">{{ $project->category ?: 'Project' }}</p>
                        <h3 class="mt-4 text-2xl font-semibold text-white">{{ $project->title }}</h3>
                        <p class="mt-3 text-sm text-slate-400">{{ $project->client }}</p>
                    </div>
                </a>
            @empty
                <article class="rounded-[2rem] border border-dashed border-white/15 bg-white/5 p-6 text-slate-300 md:col-span-3">
                    Featured projects will appear here once they are created in the admin dashboard.
                </article>
            @endforelse
        </div>
    </section>

    <section class="mx-auto max-w-7xl px-6 py-16">
        <div class="rounded-[2.5rem] border border-white/10 bg-white/5 p-8 sm:p-12">
            <div class="grid gap-10 lg:grid-cols-[1fr_auto] lg:items-center">
                <div>
                    <p class="text-sm uppercase tracking-[0.3em] text-sky-200">Call To Action</p>
                    <h2 class="mt-4 font-[family-name:var(--font-display)] text-4xl font-semibold text-white">{{ $sections->get('cta')?->data['title'] ?? 'Ready to shape a stronger digital presence?' }}</h2>
                    <p class="mt-4 max-w-3xl text-lg leading-8 text-slate-300">{{ $sections->get('cta')?->data['body'] ?? 'Use the admin workflow to manage content confidently while the frontend stays cohesive and premium.' }}</p>
                </div>
                <a href="{{ $sections->get('cta')?->data['button_url'] ?? route('contact') }}" class="rounded-full bg-white px-6 py-3 text-sm font-semibold text-slate-950 transition hover:bg-slate-200">
                    {{ $sections->get('cta')?->data['button_label'] ?? 'Contact Us' }}
                </a>
            </div>
        </div>
    </section>

    <section class="mx-auto max-w-7xl px-6 py-16">
        <div class="mb-10 max-w-3xl">
            <p class="text-sm uppercase tracking-[0.3em] text-sky-200">Partners</p>
            <h2 class="mt-4 font-[family-name:var(--font-display)] text-4xl font-semibold text-white">{{ $sections->get('partners_rail')?->data['title'] ?? 'Trusted by growing brands and ambitious teams.' }}</h2>
            <p class="mt-4 text-lg leading-8 text-slate-300">{{ $sections->get('partners_rail')?->data['body'] ?? 'Partner logos are managed from one central library and rendered in a curated homepage rail.' }}</p>
        </div>
        <div class="grid gap-4 sm:grid-cols-2 lg:grid-cols-4 xl:grid-cols-6">
            @forelse ($partners as $partner)
                <a href="{{ $partner->website ?: '#' }}" class="flex min-h-28 items-center justify-center rounded-[1.75rem] border border-white/10 bg-white/5 p-6 transition hover:border-white/20">
                    @if ($partner->logo)
                        <img src="{{ $partner->logo->url }}" alt="{{ $partner->name }}" class="max-h-12 w-auto object-contain opacity-90">
                    @else
                        <span class="text-sm text-slate-300">{{ $partner->name }}</span>
                    @endif
                </a>
            @empty
                <div class="rounded-[1.75rem] border border-dashed border-white/15 bg-white/5 p-6 text-slate-300 sm:col-span-2 lg:col-span-4 xl:col-span-6">
                    Partner logos will appear here once they are added in the admin dashboard.
                </div>
            @endforelse
        </div>
    </section>
</x-layouts.app>

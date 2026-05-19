<x-layouts.app>
    <section class="mx-auto max-w-7xl px-6 py-24 sm:py-32">
        <div class="grid gap-16 lg:grid-cols-[1.2fr_0.8fr] lg:items-end">
            <div>
                <p class="mb-6 inline-flex rounded-full border border-white/15 bg-white/5 px-4 py-2 text-xs uppercase tracking-[0.3em] text-sky-100">
                    Curated Digital Presence
                </p>
                <h1 class="max-w-4xl font-[family-name:var(--font-display)] text-5xl font-semibold tracking-tight text-white sm:text-6xl">
                    A premium company platform built for credibility, speed, and clear storytelling.
                </h1>
                <p class="mt-6 max-w-2xl text-lg leading-8 text-slate-300">
                    This foundation keeps the site developer-curated while making the real business content easy to manage through a lightweight custom dashboard.
                </p>
                <div class="mt-10 flex flex-wrap gap-4">
                    <a href="{{ route('services.index') }}" class="rounded-full bg-white px-6 py-3 text-sm font-semibold text-slate-950 transition hover:bg-slate-200">
                        Explore Services
                    </a>
                    <a href="{{ route('contact') }}" class="rounded-full border border-white/20 px-6 py-3 text-sm font-semibold text-white transition hover:border-white/40 hover:bg-white/5">
                        Contact Us
                    </a>
                </div>
            </div>

            <div class="grid gap-4 sm:grid-cols-2">
                <div class="rounded-[2rem] border border-white/10 bg-white/5 p-6 backdrop-blur">
                    <p class="text-sm text-slate-400">Featured Services</p>
                    <p class="mt-3 text-4xl font-semibold text-white">{{ $featuredServices->count() }}</p>
                </div>
                <div class="rounded-[2rem] border border-white/10 bg-white/5 p-6 backdrop-blur">
                    <p class="text-sm text-slate-400">Featured Projects</p>
                    <p class="mt-3 text-4xl font-semibold text-white">{{ $featuredProjects->count() }}</p>
                </div>
                <div class="rounded-[2rem] border border-white/10 bg-white/5 p-6 backdrop-blur sm:col-span-2">
                    <p class="text-sm text-slate-400">Admin-Ready Structure</p>
                    <p class="mt-3 text-lg leading-8 text-slate-200">
                        The frontend is curated. The content is editable. The media is centralized and reusable.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <section class="mx-auto max-w-7xl px-6 py-16">
        <div class="grid gap-6 md:grid-cols-3">
            @forelse ($featuredServices as $service)
                <article class="rounded-[2rem] border border-white/10 bg-white/5 p-6">
                    <p class="text-sm text-sky-200">{{ $service->icon ?: 'Service' }}</p>
                    <h2 class="mt-4 text-2xl font-semibold text-white">{{ $service->title }}</h2>
                    <p class="mt-3 text-sm leading-7 text-slate-300">{{ $service->excerpt }}</p>
                </article>
            @empty
                <article class="rounded-[2rem] border border-dashed border-white/15 bg-white/5 p-6 text-slate-300 md:col-span-3">
                    Featured services will appear here once they are created in the admin dashboard.
                </article>
            @endforelse
        </div>
    </section>
</x-layouts.app>

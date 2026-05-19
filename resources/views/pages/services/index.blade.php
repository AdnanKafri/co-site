<x-layouts.app>
    <section class="mx-auto max-w-7xl px-6 py-24">
        <div class="max-w-3xl">
            <p class="text-sm uppercase tracking-[0.3em] text-sky-200">Services</p>
            <h1 class="mt-6 font-[family-name:var(--font-display)] text-5xl font-semibold text-white">Purposeful service pages with clear structure and reusable content.</h1>
        </div>

        <div class="mt-16 grid gap-6 md:grid-cols-2 xl:grid-cols-3">
            @forelse ($services as $service)
                <a href="{{ route('services.show', $service) }}" class="overflow-hidden rounded-[2rem] border border-white/10 bg-white/5 transition hover:-translate-y-1 hover:border-white/20">
                    @if ($service->image)
                        <img src="{{ $service->image->url }}" alt="{{ $service->title }}" class="h-60 w-full object-cover">
                    @endif
                    <div class="p-6">
                        <p class="text-sm text-sky-200">{{ $service->icon ?: 'Service' }}</p>
                        <h2 class="mt-3 text-2xl font-semibold text-white">{{ $service->title }}</h2>
                        <p class="mt-3 text-sm leading-7 text-slate-300">{{ $service->excerpt }}</p>
                    </div>
                </a>
            @empty
                <div class="rounded-[2rem] border border-dashed border-white/15 bg-white/5 p-6 text-slate-300 md:col-span-2 xl:col-span-3">
                    No services published yet.
                </div>
            @endforelse
        </div>
    </section>
</x-layouts.app>

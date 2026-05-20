<x-layouts.app>
    <section class="site-container section-space">
        <div class="grid gap-8 xl:grid-cols-[1.05fr_0.95fr] xl:items-end">
            <div class="max-w-4xl">
                <p class="eyebrow">Services</p>
                <h1 class="hero-display mt-8">Services presented as an editorial system, not a product shelf.</h1>
                <p class="body-lg mt-8 max-w-3xl">
                    The structure stays scalable, but the presentation is still intentional. Every offering belongs to the same visual story and uses the same atmospheric language.
                </p>
            </div>
            <div class="grid gap-4 sm:grid-cols-2">
                @foreach ($featuredServices as $featured)
                    <a href="{{ route('services.show', $featured) }}" class="glass-panel p-5 transition hover:-translate-y-1 hover:border-white/20">
                        <p class="text-[11px] uppercase tracking-[0.22em] text-sky-100">{{ $featured->icon ?: 'Featured' }}</p>
                        <h2 class="mt-4 text-2xl font-semibold text-white">{{ $featured->title }}</h2>
                        <p class="body-md mt-3">{{ \Illuminate\Support\Str::limit($featured->excerpt, 110) }}</p>
                    </a>
                @endforeach
            </div>
        </div>
    </section>

    <section class="site-container section-space">
        <div class="space-y-6">
            @forelse ($services as $service)
                <a href="{{ route('services.show', $service) }}" class="site-card grid gap-0 lg:grid-cols-[0.92fr_1.08fr]">
                    <div class="relative min-h-[18rem] overflow-hidden bg-slate-900 {{ $loop->even ? 'lg:order-2' : '' }}">
                        @if ($service->image)
                            <img src="{{ $service->image->url }}" alt="{{ $service->title }}" class="absolute inset-0 h-full w-full object-cover">
                        @endif
                        <div class="absolute inset-0 bg-[linear-gradient(180deg,rgba(9,16,30,0.06),rgba(9,16,30,0.76))]"></div>
                    </div>
                    <div class="flex flex-col justify-between p-7 sm:p-8">
                        <div>
                            <p class="text-sm uppercase tracking-[0.24em] text-sky-100">{{ $service->icon ?: 'Service' }}</p>
                            <h2 class="mt-4 text-3xl font-semibold text-white">{{ $service->title }}</h2>
                            <p class="body-md mt-5 max-w-2xl">{{ $service->excerpt }}</p>
                        </div>
                        <div class="mt-8 flex items-center justify-between gap-4">
                            <span class="text-sm text-slate-400">Structured service page</span>
                            <span class="text-sm font-semibold text-white">Open</span>
                        </div>
                    </div>
                </a>
            @empty
                <div class="glass-panel border-dashed p-6 text-slate-300">
                    No services published yet.
                </div>
            @endforelse
        </div>
    </section>
</x-layouts.app>

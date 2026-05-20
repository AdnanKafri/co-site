<x-layouts.app>
    <section class="site-container section-space">
        <div class="grid gap-8 xl:grid-cols-[0.9fr_1.1fr] xl:items-end">
            <div class="max-w-3xl">
                <p class="eyebrow">{{ $service->icon ?: 'Service' }}</p>
                <h1 class="hero-display mt-8">{{ $service->title }}</h1>
                <p class="body-lg mt-8">{{ $service->excerpt }}</p>
            </div>
            <div class="glass-panel p-6 sm:p-8">
                <div class="grid gap-4 sm:grid-cols-3">
                    <div class="rounded-[1.5rem] border border-white/10 bg-white/[0.04] p-4">
                        <p class="text-[11px] uppercase tracking-[0.2em] text-slate-400">01</p>
                        <p class="mt-2 text-lg font-semibold text-white">Diagnose</p>
                    </div>
                    <div class="rounded-[1.5rem] border border-white/10 bg-white/[0.04] p-4">
                        <p class="text-[11px] uppercase tracking-[0.2em] text-slate-400">02</p>
                        <p class="mt-2 text-lg font-semibold text-white">Design</p>
                    </div>
                    <div class="rounded-[1.5rem] border border-white/10 bg-white/[0.04] p-4">
                        <p class="text-[11px] uppercase tracking-[0.2em] text-slate-400">03</p>
                        <p class="mt-2 text-lg font-semibold text-white">Deliver</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="site-container section-space">
        <div class="grid gap-8 xl:grid-cols-[1.05fr_0.95fr] xl:items-start">
            <div>
                <div class="glass-panel-strong overflow-hidden p-3">
                    <div class="relative aspect-[4/3] overflow-hidden rounded-[1.7rem] bg-slate-900">
                        @if ($service->image)
                            <img src="{{ $service->image->url }}" alt="{{ $service->title }}" class="absolute inset-0 h-full w-full object-cover">
                        @endif
                        <div class="absolute inset-0 bg-[linear-gradient(180deg,rgba(8,14,24,0.08),rgba(8,14,24,0.74))]"></div>
                    </div>
                </div>
            </div>
            <div class="grid gap-6">
                <div class="glass-panel p-7">
                    <p class="text-[11px] uppercase tracking-[0.22em] text-slate-400">Service narrative</p>
                    <div class="prose prose-invert mt-5 max-w-none prose-p:text-slate-300 prose-p:leading-8">
                        {!! nl2br(e($service->description)) !!}
                    </div>
                </div>
                <div class="glass-panel p-7">
                    <p class="text-[11px] uppercase tracking-[0.22em] text-slate-400">Why it matters</p>
                    <p class="body-md mt-4">
                        This service is framed inside a curated presentation system so the content stays flexible, but the experience remains deliberate and premium.
                    </p>
                </div>
            </div>
        </div>
    </section>

    @if ($relatedServices->isNotEmpty())
        <section class="site-container section-space">
            <div class="mb-8 max-w-3xl">
                <p class="eyebrow">Related Services</p>
                <h2 class="section-title mt-6">Other capabilities in the same ecosystem.</h2>
            </div>
            <div class="grid gap-6 md:grid-cols-3">
                @foreach ($relatedServices as $related)
                    <a href="{{ route('services.show', $related) }}" class="site-card">
                        @if ($related->image)
                            <div class="relative aspect-[4/3] overflow-hidden">
                                <img src="{{ $related->image->url }}" alt="{{ $related->title }}" class="absolute inset-0 h-full w-full object-cover">
                            </div>
                        @endif
                        <div class="p-6">
                            <p class="text-sm uppercase tracking-[0.22em] text-sky-100">{{ $related->icon ?: 'Service' }}</p>
                            <h2 class="mt-3 text-2xl font-semibold text-white">{{ $related->title }}</h2>
                            <p class="body-md mt-4">{{ \Illuminate\Support\Str::limit($related->excerpt, 110) }}</p>
                        </div>
                    </a>
                @endforeach
            </div>
        </section>
    @endif
</x-layouts.app>

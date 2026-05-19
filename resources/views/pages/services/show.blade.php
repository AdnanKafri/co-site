<x-layouts.app>
    <section class="mx-auto max-w-5xl px-6 py-24">
        @if ($service->image)
            <img src="{{ $service->image->url }}" alt="{{ $service->title }}" class="mb-10 h-[26rem] w-full rounded-[2rem] object-cover">
        @endif
        <p class="text-sm uppercase tracking-[0.3em] text-sky-200">Service</p>
        <h1 class="mt-6 font-[family-name:var(--font-display)] text-5xl font-semibold text-white">{{ $service->title }}</h1>
        <p class="mt-6 text-lg leading-8 text-slate-300">{{ $service->excerpt }}</p>
        <div class="prose prose-invert mt-10 max-w-none prose-p:text-slate-300">
            {!! nl2br(e($service->description)) !!}
        </div>
    </section>
</x-layouts.app>

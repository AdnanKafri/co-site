<x-layouts.app>
    @php($story = $sections->get('story')?->data['body'] ?? 'We build company platforms that feel directed, premium, and cohesive rather than assembled from interchangeable content blocks.')
    @php($mission = $sections->get('mission')?->data['body'] ?? 'Translate business clarity into a stronger digital presence with structure that stays maintainable under real-world use.')
    @php($vision = $sections->get('vision')?->data['body'] ?? 'Create modern company websites that feel authored like a brand experience while remaining easy to manage operationally.')
    @php($values = $sections->get('values')?->data['items'] ?? [
        ['title' => 'Intentionality', 'body' => 'Every section earns its place and supports the overall rhythm.'],
        ['title' => 'Clarity', 'body' => 'The message, the layout, and the interaction language all point in the same direction.'],
        ['title' => 'Momentum', 'body' => 'The system should help teams move quickly without collapsing into chaos.'],
    ])

    <section class="site-container section-space">
        <div class="grid gap-8 xl:grid-cols-[1.1fr_0.9fr] xl:items-end">
            <div class="max-w-4xl">
                <p class="eyebrow">About</p>
                <h1 class="hero-display mt-8">A company story told with structure, atmosphere, and restraint.</h1>
                <p class="body-lg mt-8 max-w-3xl">{{ $story }}</p>
            </div>
            <div class="glass-panel p-6 sm:p-8">
                <div class="grid gap-6 sm:grid-cols-2">
                    <div>
                        <p class="text-[11px] uppercase tracking-[0.2em] text-slate-400">Mission</p>
                        <p class="body-md mt-3">{{ $mission }}</p>
                    </div>
                    <div>
                        <p class="text-[11px] uppercase tracking-[0.2em] text-slate-400">Vision</p>
                        <p class="body-md mt-3">{{ $vision }}</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="site-container section-space">
        <div class="grid gap-8 lg:grid-cols-[0.75fr_1.25fr]">
            <div class="xl:sticky xl:top-28 xl:self-start">
                <p class="eyebrow">Values</p>
                <h2 class="section-title mt-6">Creative direction stays curated even when content stays dynamic.</h2>
            </div>
            <div class="grid gap-5 lg:grid-cols-3">
                @foreach ($values as $value)
                    <article class="glass-panel p-6">
                        <p class="text-[11px] uppercase tracking-[0.22em] text-sky-100">0{{ $loop->iteration }}</p>
                        <h3 class="mt-4 text-2xl font-semibold text-white">{{ $value['title'] ?? '' }}</h3>
                        <p class="body-md mt-4">{{ $value['body'] ?? '' }}</p>
                    </article>
                @endforeach
            </div>
        </div>
    </section>

    <section class="site-container section-space">
        <div class="mb-10 max-w-3xl">
            <p class="eyebrow">People</p>
            <h2 class="section-display mt-6">The team behind the pace, precision, and presentation.</h2>
        </div>
        <div class="grid gap-6 md:grid-cols-2 xl:grid-cols-3">
            @forelse ($teamMembers as $member)
                <article class="site-card">
                    @if ($member->image)
                        <div class="relative aspect-[4/5] overflow-hidden">
                            <img src="{{ $member->image->url }}" alt="{{ $member->name }}" class="absolute inset-0 h-full w-full object-cover">
                            <div class="absolute inset-0 bg-[linear-gradient(180deg,rgba(8,14,24,0.06),rgba(8,14,24,0.72))]"></div>
                        </div>
                    @endif
                    <div class="p-7">
                        <p class="text-sm uppercase tracking-[0.22em] text-sky-100">{{ $member->role }}</p>
                        <h2 class="mt-3 text-2xl font-semibold text-white">{{ $member->name }}</h2>
                        <p class="body-md mt-4">{{ $member->bio }}</p>
                    </div>
                </article>
            @empty
                <article class="glass-panel border-dashed p-6 text-slate-300 md:col-span-3">
                    Team content will appear here once team members are added.
                </article>
            @endforelse
        </div>
    </section>
</x-layouts.app>

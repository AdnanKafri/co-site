<x-layouts.app>
    <section class="mx-auto max-w-7xl px-6 py-24">
        <div class="max-w-3xl">
            <p class="text-sm uppercase tracking-[0.3em] text-sky-200">About</p>
            <h1 class="mt-6 font-[family-name:var(--font-display)] text-5xl font-semibold text-white">A company story with a structured editorial system behind it.</h1>
            <p class="mt-6 text-lg leading-8 text-slate-300">
                The About page is designed to stay polished while letting the team manage story, values, mission, vision, stats, and supporting visuals from the admin side.
            </p>
        </div>

        <div class="mt-16 grid gap-6 md:grid-cols-3">
            @forelse ($teamMembers as $member)
                <article class="rounded-[2rem] border border-white/10 bg-white/5 p-6">
                    <p class="text-sm text-sky-200">{{ $member->role }}</p>
                    <h2 class="mt-3 text-2xl font-semibold text-white">{{ $member->name }}</h2>
                    <p class="mt-3 text-sm leading-7 text-slate-300">{{ $member->bio }}</p>
                </article>
            @empty
                <article class="rounded-[2rem] border border-dashed border-white/15 bg-white/5 p-6 text-slate-300 md:col-span-3">
                    Team content will appear here once team members are added.
                </article>
            @endforelse
        </div>
    </section>
</x-layouts.app>

<x-layouts.app>
    @php($intro = $sections->get('intro')?->data ?? [])
    @php($details = $sections->get('details')?->data ?? [])
    @php($cta = $sections->get('cta')?->data ?? [])

    <section class="site-container section-space">
        <div class="grid gap-10 xl:grid-cols-[0.92fr_1.08fr] xl:items-start">
            <div>
                <p class="eyebrow">Contact</p>
                <h1 class="hero-display mt-8">{{ $intro['title'] ?? 'Let\'s talk about the next project.' }}</h1>
                <p class="body-lg mt-8 max-w-2xl">
                    {{ $intro['body'] ?? 'The contact workflow is server-rendered, SEO-friendly, and connected to an admin-managed inquiries system.' }}
                </p>

                <div class="mt-10 grid gap-4">
                    <div class="glass-panel p-6">
                        <p class="text-[11px] uppercase tracking-[0.22em] text-slate-400">Email</p>
                        <p class="mt-3 text-lg font-semibold text-white">{{ $brandSettings['email'] ?? 'hello@pressngo.studio' }}</p>
                    </div>
                    <div class="glass-panel p-6">
                        <p class="text-[11px] uppercase tracking-[0.22em] text-slate-400">Phone</p>
                        <p class="mt-3 text-lg font-semibold text-white">{{ $brandSettings['phone'] ?? '+966 11 560 3024' }}</p>
                    </div>
                    <div class="glass-panel p-6">
                        <p class="text-[11px] uppercase tracking-[0.22em] text-slate-400">{{ $details['headline'] ?? 'Location' }}</p>
                        <p class="body-md mt-3">{{ $brandSettings['address'] ?? 'Riyadh Front, Business District, Riyadh' }}</p>
                        <p class="body-md mt-4 text-slate-400">{{ $details['body'] ?? 'Share the context, the current friction, and where the site needs to go next.' }}</p>
                    </div>
                </div>
            </div>

            <form action="{{ route('contact.store') }}" method="POST" class="glass-panel-strong space-y-5 p-8 sm:p-10">
                @csrf
                <div class="grid gap-5 sm:grid-cols-2">
                    <label class="text-sm text-slate-300">
                        Name
                        <input type="text" name="name" value="{{ old('name') }}" class="mt-2 w-full rounded-2xl border border-white/10 bg-slate-950/60 px-4 py-3 text-white outline-none">
                    </label>
                    <label class="text-sm text-slate-300">
                        Email
                        <input type="email" name="email" value="{{ old('email') }}" class="mt-2 w-full rounded-2xl border border-white/10 bg-slate-950/60 px-4 py-3 text-white outline-none">
                    </label>
                </div>
                <div class="grid gap-5 sm:grid-cols-2">
                    <label class="text-sm text-slate-300">
                        Phone
                        <input type="text" name="phone" value="{{ old('phone') }}" class="mt-2 w-full rounded-2xl border border-white/10 bg-slate-950/60 px-4 py-3 text-white outline-none">
                    </label>
                    <label class="text-sm text-slate-300">
                        Company
                        <input type="text" name="company" value="{{ old('company') }}" class="mt-2 w-full rounded-2xl border border-white/10 bg-slate-950/60 px-4 py-3 text-white outline-none">
                    </label>
                </div>
                <label class="block text-sm text-slate-300">
                    Subject
                    <input type="text" name="subject" value="{{ old('subject') }}" class="mt-2 w-full rounded-2xl border border-white/10 bg-slate-950/60 px-4 py-3 text-white outline-none">
                </label>
                <label class="block text-sm text-slate-300">
                    Message
                    <textarea name="message" rows="6" class="mt-2 w-full rounded-2xl border border-white/10 bg-slate-950/60 px-4 py-3 text-white outline-none">{{ old('message') }}</textarea>
                </label>
                <button type="submit" class="rounded-full bg-white px-6 py-3 text-sm font-semibold text-slate-950 transition hover:bg-slate-200">
                    Send Inquiry
                </button>
            </form>
        </div>

        @if (! empty($cta))
            <div class="mt-14 glass-panel p-8 sm:p-10">
                <p class="eyebrow">Before the build</p>
                <h2 class="section-title mt-6">{{ $cta['title'] ?? 'Prefer a workshop before a build?' }}</h2>
                <p class="body-lg mt-5">{{ $cta['body'] ?? 'We also run architecture, positioning, and narrative sessions for teams that need clarity before implementation.' }}</p>
            </div>
        @endif

        @if ($teamMembers->isNotEmpty())
            <div class="mt-16">
                <p class="eyebrow">Team</p>
                <h2 class="section-display mt-6">Talk to the people behind the work.</h2>
                <div class="mt-10 grid gap-6 md:grid-cols-3">
                    @foreach ($teamMembers as $member)
                        <article class="site-card">
                            @if ($member->image)
                                <div class="relative aspect-[4/5] overflow-hidden">
                                    <img src="{{ $member->image->url }}" alt="{{ $member->name }}" class="absolute inset-0 h-full w-full object-cover">
                                </div>
                            @endif
                            <div class="p-6">
                                <p class="text-sm uppercase tracking-[0.22em] text-sky-100">{{ $member->role }}</p>
                                <h3 class="mt-3 text-2xl font-semibold text-white">{{ $member->name }}</h3>
                                <p class="body-md mt-4">{{ $member->bio }}</p>
                            </div>
                        </article>
                    @endforeach
                </div>
            </div>
        @endif
    </section>
</x-layouts.app>

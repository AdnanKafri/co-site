<footer class="relative mt-20 border-t border-white/10">
    <div class="site-container py-10 text-sm text-slate-400">
        <div class="glass-panel-strong px-6 py-8 sm:px-8">
            <div class="flex flex-col gap-8 lg:flex-row lg:items-end lg:justify-between">
                <div class="max-w-xl">
                    <div class="flex items-center gap-3">
            @if ($siteLogo)
                            <img src="{{ $siteLogo->url }}" alt="{{ $brandSettings['company_name'] ?? 'PressnGo' }}" class="h-9 w-auto opacity-95">
            @endif
                        <p class="font-[family-name:var(--font-display)] text-lg font-semibold text-white">{{ $brandSettings['company_name'] ?? 'PressnGo' }}</p>
                    </div>
                    <p class="mt-4 body-md max-w-lg">
                        A curated company platform with intentional structure, premium presentation, and content management that stays light enough to actually use.
                    </p>
                </div>
                <div class="flex flex-col gap-4 sm:flex-row sm:items-center">
                    <a href="{{ route('about') }}" class="action-pill justify-center">About</a>
                    <a href="{{ route('services.index') }}" class="action-pill justify-center">Services</a>
                    <a href="{{ route('projects.index') }}" class="action-pill justify-center">Projects</a>
                    <a href="{{ route('contact') }}" class="action-pill justify-center">Contact</a>
                </div>
            </div>
            <div class="soft-divider my-8"></div>
            <div class="flex flex-col gap-3 text-xs uppercase tracking-[0.18em] text-slate-500 sm:flex-row sm:items-center sm:justify-between">
                <p>{{ $brandSettings['company_name'] ?? 'PressnGo' }}. Crafted for a modern company presence.</p>
                <p>Server-rendered. Curated. Built for clarity.</p>
            </div>
        </div>
    </div>
</footer>

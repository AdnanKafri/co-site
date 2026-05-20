<header x-data="{ open: false }" class="sticky top-0 z-40 border-b border-white/10 bg-slate-950/35 backdrop-blur-2xl">
    <div class="site-container flex items-center justify-between py-5">
        <a href="{{ route('home') }}" class="flex items-center gap-3">
            @if ($siteLogo)
                <img src="{{ $siteLogo->url }}" alt="{{ $brandSettings['company_name'] ?? 'PressnGo' }}" class="h-10 w-auto drop-shadow-[0_10px_30px_rgba(76,193,255,0.18)]">
            @endif
            <span class="font-[family-name:var(--font-display)] text-xl font-semibold tracking-[0.2em] text-white uppercase">
                {{ $brandSettings['company_name'] ?? 'PressnGo' }}
            </span>
        </a>

        <nav class="hidden items-center gap-2 md:flex">
            <a href="{{ route('about') }}" class="action-pill">About</a>
            <a href="{{ route('services.index') }}" class="action-pill">Services</a>
            <a href="{{ route('projects.index') }}" class="action-pill">Projects</a>
            <a href="{{ route('contact') }}" class="action-pill">Contact</a>
        </nav>

        <div class="hidden md:block">
            <a href="{{ route('contact') }}" class="rounded-full bg-white px-5 py-2.5 text-sm font-semibold text-slate-950 transition hover:bg-slate-200">
                Start a Project
            </a>
        </div>

        <button type="button" @click="open = ! open" class="inline-flex h-11 w-11 items-center justify-center rounded-full border border-white/12 bg-white/6 text-white md:hidden">
            <span class="sr-only">Toggle menu</span>
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.6" d="M4 7h16M4 12h16M4 17h16" />
            </svg>
        </button>
    </div>

    <div x-show="open" x-cloak class="border-t border-white/10 bg-slate-950/85 md:hidden">
        <div class="site-container flex flex-col gap-3 py-4">
            <a href="{{ route('about') }}" class="action-pill justify-center">About</a>
            <a href="{{ route('services.index') }}" class="action-pill justify-center">Services</a>
            <a href="{{ route('projects.index') }}" class="action-pill justify-center">Projects</a>
            <a href="{{ route('contact') }}" class="action-pill justify-center">Contact</a>
            <a href="{{ route('contact') }}" class="rounded-full bg-white px-5 py-3 text-center text-sm font-semibold text-slate-950 transition hover:bg-slate-200">
                Start a Project
            </a>
        </div>
    </div>
</header>

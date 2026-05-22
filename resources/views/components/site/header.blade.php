@php
    $isHome = request()->routeIs('home');
    $isAbout = request()->routeIs('about');
    $isServices = request()->routeIs('services.*');
    $isProjects = request()->routeIs('projects.*');
    $isContact = request()->routeIs('contact');
@endphp

<header
    x-data="{
        open: false,
        scrolled: false,
        hidden: false,
        lastScroll: window.scrollY,
        init() {
            const update = () => {
                const current = window.scrollY;
                const delta = current - this.lastScroll;

                this.scrolled = current > 24;

                if (current < 24 || this.open) {
                    this.hidden = false;
                } else if (Math.abs(delta) > 4) {
                    this.hidden = delta > 0 && current > 120;
                }

                this.lastScroll = current;
            };

            update();
            window.addEventListener('scroll', () => requestAnimationFrame(update), { passive: true });
        }
    }"
    x-init="init()"
    x-on:keydown.escape.window="open = false"
    class="sticky top-3 z-40 transition-all duration-500 sm:top-4"
>
    <div class="site-container">
        <div
            :class="[
                hidden ? '-translate-y-6 opacity-0 pointer-events-none' : 'translate-y-0 opacity-100',
                scrolled
                    ? 'border-white/12 bg-slate-950/78 shadow-[0_18px_60px_rgba(0,0,0,0.24)]'
                    : 'border-white/10 bg-slate-950/40 shadow-[0_14px_50px_rgba(0,0,0,0.18)]'
            ]"
            class="rounded-[1.5rem] px-4 py-4 backdrop-blur-2xl transition duration-500 sm:px-5 sm:py-4 lg:px-6"
        >
            <div class="flex items-center justify-between gap-4">
                <a href="{{ route('home') }}" class="group flex items-center gap-3 transition duration-500 hover:opacity-95">
                    @if ($siteLogo)
                        <img src="{{ $siteLogo->url }}" alt="{{ $brandSettings['company_name'] ?? 'PressnGo' }}" class="h-10 w-auto drop-shadow-[0_10px_30px_rgba(76,193,255,0.18)] transition duration-500 group-hover:scale-105">
                    @endif
                    <span class="font-[family-name:var(--font-display)] text-xl font-semibold tracking-[0.2em] text-white uppercase">
                        {{ $brandSettings['company_name'] ?? 'PressnGo' }}
                    </span>
                </a>

            <nav class="hidden items-center gap-2 md:flex">
                <a href="{{ route('home') }}" @class(['nav-premium', 'border-white/24 bg-white/10 text-white shadow-[0_12px_30px_rgba(0,0,0,0.16)]' => $isHome])>Home</a>
                <a href="{{ route('about') }}" @class(['nav-premium', 'border-white/24 bg-white/10 text-white shadow-[0_12px_30px_rgba(0,0,0,0.16)]' => $isAbout])>About</a>
                <a href="{{ route('services.index') }}" @class(['nav-premium', 'border-white/24 bg-white/10 text-white shadow-[0_12px_30px_rgba(0,0,0,0.16)]' => $isServices])>Services</a>
                <a href="{{ route('projects.index') }}" @class(['nav-premium', 'border-white/24 bg-white/10 text-white shadow-[0_12px_30px_rgba(0,0,0,0.16)]' => $isProjects])>Projects</a>
                <a href="{{ route('contact') }}" @class(['nav-premium', 'border-white/24 bg-white/10 text-white shadow-[0_12px_30px_rgba(0,0,0,0.16)]' => $isContact])>Contact</a>
            </nav>

            <div class="hidden md:block">
                <a href="{{ route('contact') }}" class="button-premium bg-white text-slate-950 hover:bg-slate-200">
                    Start a Project
                </a>
            </div>

            <button type="button" @click="open = ! open; hidden = false" class="inline-flex h-11 w-11 items-center justify-center rounded-full border border-white/12 bg-white/6 text-white transition duration-500 hover:-translate-y-0.5 hover:border-white/24 hover:bg-white/10 md:hidden">
                <span class="sr-only">Toggle menu</span>
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.6" d="M4 7h16M4 12h16M4 17h16" />
                </svg>
            </button>
        </div>

        <div
            x-show="open"
            x-transition.opacity.duration.180ms
            x-transition.scale.origin.top.duration.220ms
            x-cloak
            class="mt-3 rounded-[1.35rem] border border-white/10 bg-slate-950/90 p-4 shadow-[0_18px_60px_rgba(0,0,0,0.24)] backdrop-blur-2xl md:hidden"
        >
            <div class="flex flex-col gap-3">
                <a href="{{ route('home') }}" @click="open = false" @class(['nav-premium justify-center', 'border-white/24 bg-white/10 text-white' => $isHome])>Home</a>
                <a href="{{ route('about') }}" @click="open = false" @class(['nav-premium justify-center', 'border-white/24 bg-white/10 text-white' => $isAbout])>About</a>
                <a href="{{ route('services.index') }}" @click="open = false" @class(['nav-premium justify-center', 'border-white/24 bg-white/10 text-white' => $isServices])>Services</a>
                <a href="{{ route('projects.index') }}" @click="open = false" @class(['nav-premium justify-center', 'border-white/24 bg-white/10 text-white' => $isProjects])>Projects</a>
                <a href="{{ route('contact') }}" @click="open = false" @class(['nav-premium justify-center', 'border-white/24 bg-white/10 text-white' => $isContact])>Contact</a>
                <a href="{{ route('contact') }}" class="button-premium bg-white text-center text-slate-950 hover:bg-slate-200">
                    Start a Project
                </a>
            </div>
        </div>
    </div>
</header>

<header class="border-b border-white/10">
    <div class="mx-auto flex max-w-7xl items-center justify-between px-6 py-5">
        <a href="{{ route('home') }}" class="font-[family-name:var(--font-display)] text-xl font-semibold tracking-[0.2em] text-white uppercase">
            {{ $brandSettings['company_name'] ?? 'PressnGo' }}
        </a>

        <nav class="hidden items-center gap-8 text-sm text-slate-300 md:flex">
            <a href="{{ route('about') }}" class="transition hover:text-white">About</a>
            <a href="{{ route('services.index') }}" class="transition hover:text-white">Services</a>
            <a href="{{ route('projects.index') }}" class="transition hover:text-white">Projects</a>
            <a href="{{ route('contact') }}" class="transition hover:text-white">Contact</a>
        </nav>

        <a href="{{ route('contact') }}" class="rounded-full bg-white px-4 py-2 text-sm font-medium text-slate-950 transition hover:bg-slate-200">
            Start a Project
        </a>
    </div>
</header>

<footer class="border-t border-white/10">
    <div class="mx-auto flex max-w-7xl flex-col gap-4 px-6 py-8 text-sm text-slate-400 md:flex-row md:items-center md:justify-between">
        <div class="flex items-center gap-3">
            @if ($siteLogo)
                <img src="{{ $siteLogo->url }}" alt="{{ $brandSettings['company_name'] ?? 'PressnGo' }}" class="h-8 w-auto opacity-90">
            @endif
            <p>{{ $brandSettings['company_name'] ?? 'PressnGo' }}. Crafted for a modern company presence.</p>
        </div>
        <div class="flex gap-4">
            <a href="{{ route('about') }}" class="hover:text-white">About</a>
            <a href="{{ route('services.index') }}" class="hover:text-white">Services</a>
            <a href="{{ route('projects.index') }}" class="hover:text-white">Projects</a>
            <a href="{{ route('contact') }}" class="hover:text-white">Contact</a>
        </div>
    </div>
</footer>

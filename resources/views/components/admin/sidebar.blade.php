<aside class="hidden w-72 shrink-0 border-r border-slate-200 bg-white lg:block">
    <div class="border-b border-slate-200 px-6 py-5">
        <p class="font-[family-name:var(--font-display)] text-lg font-semibold text-slate-950">
            {{ $brandSettings['company_name'] ?? 'PressnGo' }}
        </p>
        <p class="mt-1 text-sm text-slate-500">Custom content dashboard</p>
    </div>

    <nav class="space-y-1 p-4 text-sm text-slate-600">
        <a href="{{ route('admin.dashboard') }}" class="block rounded-2xl px-4 py-3 hover:bg-slate-100 hover:text-slate-950">Overview</a>
        <a href="{{ route('admin.settings.edit') }}" class="block rounded-2xl px-4 py-3 hover:bg-slate-100 hover:text-slate-950">General Settings</a>
        <a href="{{ route('admin.media.index') }}" class="block rounded-2xl px-4 py-3 hover:bg-slate-100 hover:text-slate-950">Media Library</a>
    </nav>
</aside>

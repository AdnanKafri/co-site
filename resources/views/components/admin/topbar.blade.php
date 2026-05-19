@props(['title'])

<header class="border-b border-slate-200 bg-white">
    <div class="flex items-center justify-between px-6 py-5">
        <div>
            <h1 class="font-[family-name:var(--font-display)] text-2xl font-semibold text-slate-950">{{ $title }}</h1>
            <p class="mt-1 text-sm text-slate-500">Purpose-built for this business workflow.</p>
        </div>

        <form action="{{ route('admin.logout') }}" method="POST">
            @csrf
            <button type="submit" class="rounded-full border border-slate-300 px-4 py-2 text-sm font-medium text-slate-700 transition hover:border-slate-400 hover:text-slate-950">
                Sign out
            </button>
        </form>
    </div>
</header>

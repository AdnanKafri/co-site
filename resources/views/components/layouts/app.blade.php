<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ trim(($seo->title ?? ($seoDefaults['default_title'] ?? ($brandSettings['company_name'] ?? config('app.name')))).' | '.($brandSettings['company_name'] ?? config('app.name')), ' |') }}</title>
    <meta name="description" content="{{ $seo->description ?? ($seoDefaults['default_description'] ?? 'A premium company platform built for clarity, speed, and strong presentation.') }}">
    @if ($siteFavicon)
        <link rel="icon" href="{{ $siteFavicon->url }}">
    @endif
    @if (($seo->image ?? null) || $defaultOgImage)
        <meta property="og:image" content="{{ $seo->image ?? $defaultOgImage?->url }}">
    @endif
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=plus-jakarta-sans:400,500,600,700|sora:500,600,700" rel="stylesheet" />
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen bg-slate-950 text-white">
    <div class="relative isolate overflow-hidden">
        <div class="absolute inset-0 -z-10 bg-[radial-gradient(circle_at_top,rgba(47,102,208,0.35),transparent_40%),linear-gradient(180deg,#0b1020_0%,#0f172a_60%,#020617_100%)]"></div>
        <x-site.header />

        @if (session('status'))
            <div class="mx-auto max-w-7xl px-6 pt-4">
                <div class="rounded-2xl border border-emerald-400/30 bg-emerald-400/10 px-4 py-3 text-sm text-emerald-100">
                    {{ session('status') }}
                </div>
            </div>
        @endif

        @if ($errors->any())
            <div class="mx-auto max-w-7xl px-6 pt-4">
                <div class="rounded-2xl border border-rose-400/30 bg-rose-400/10 px-4 py-3 text-sm text-rose-100">
                    {{ $errors->first() }}
                </div>
            </div>
        @endif

        <main>
            {{ $slot }}
        </main>

        <x-site.footer />
    </div>
</body>
</html>

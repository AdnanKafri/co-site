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
    <div class="relative isolate overflow-hidden bg-[linear-gradient(180deg,#040816_0%,#091125_22%,#0c1730_54%,#040816_100%)]">
        <div class="pointer-events-none absolute inset-0 -z-20">
            <div class="halo-orb left-[-10rem] top-[-8rem] h-[26rem] w-[26rem] bg-cyan-400/18"></div>
            <div class="halo-orb right-[-8rem] top-[10rem] h-[22rem] w-[22rem] bg-blue-500/20"></div>
            <div class="halo-orb bottom-[12rem] left-[8%] h-[18rem] w-[18rem] bg-fuchsia-500/12"></div>
            <div class="halo-orb bottom-[-8rem] right-[10%] h-[22rem] w-[22rem] bg-sky-300/10"></div>
            <div class="ambient-grid absolute inset-0 opacity-35"></div>
            <div class="absolute inset-0 bg-[radial-gradient(circle_at_top,rgba(121,196,255,0.18),transparent_28%),radial-gradient(circle_at_80%_20%,rgba(47,102,208,0.2),transparent_32%),linear-gradient(180deg,rgba(4,8,22,0.2),rgba(4,8,22,0.92))]"></div>
        </div>
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

        <main class="relative">
            {{ $slot }}
        </main>

        <x-site.footer />
    </div>
</body>
</html>

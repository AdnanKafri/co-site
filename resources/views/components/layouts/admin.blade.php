@props(['title' => 'Admin'])

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title.' | '.($brandSettings['company_name'] ?? config('app.name')) }}</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=plus-jakarta-sans:400,500,600,700|sora:500,600,700" rel="stylesheet" />
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen bg-slate-100 text-slate-900">
    <div class="flex min-h-screen">
        <x-admin.sidebar />

        <div class="flex min-h-screen flex-1 flex-col">
            <x-admin.topbar :title="$title" />

            @if (session('status'))
                <div class="px-6 pt-6">
                    <div class="rounded-2xl border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm text-emerald-700">
                        {{ session('status') }}
                    </div>
                </div>
            @endif

            @if ($errors->any())
                <div class="px-6 pt-6">
                    <div class="rounded-2xl border border-rose-200 bg-rose-50 px-4 py-3 text-sm text-rose-700">
                        {{ $errors->first() }}
                    </div>
                </div>
            @endif

            <main class="flex-1 px-6 py-6">
                {{ $slot }}
            </main>
        </div>
    </div>
</body>
</html>

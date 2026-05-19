<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Login | {{ config('app.name') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen bg-slate-950 text-white">
    <div class="flex min-h-screen items-center justify-center px-6">
        <form action="{{ route('admin.login.store') }}" method="POST" class="w-full max-w-md rounded-[2rem] border border-white/10 bg-white/5 p-8 backdrop-blur">
            @csrf
            <p class="text-sm uppercase tracking-[0.3em] text-sky-200">Admin</p>
            <h1 class="mt-4 font-[family-name:var(--font-display)] text-3xl font-semibold">Sign in to manage the site</h1>

            <div class="mt-8 space-y-5">
                <label class="block text-sm text-slate-300">
                    Email
                    <input type="email" name="email" value="{{ old('email') }}" class="mt-2 w-full rounded-2xl border border-white/10 bg-slate-950/70 px-4 py-3 text-white outline-none">
                </label>

                <label class="block text-sm text-slate-300">
                    Password
                    <input type="password" name="password" class="mt-2 w-full rounded-2xl border border-white/10 bg-slate-950/70 px-4 py-3 text-white outline-none">
                </label>
            </div>

            @if ($errors->any())
                <div class="mt-5 rounded-2xl border border-rose-400/30 bg-rose-400/10 px-4 py-3 text-sm text-rose-100">
                    {{ $errors->first() }}
                </div>
            @endif

            <button type="submit" class="mt-8 w-full rounded-full bg-white px-6 py-3 text-sm font-semibold text-slate-950 transition hover:bg-slate-200">
                Sign In
            </button>
        </form>
    </div>
</body>
</html>

<x-layouts.app>
    <section class="mx-auto max-w-7xl px-6 py-24">
        <div class="grid gap-12 lg:grid-cols-[0.9fr_1.1fr]">
            <div>
                <p class="text-sm uppercase tracking-[0.3em] text-sky-200">Contact</p>
                <h1 class="mt-6 font-[family-name:var(--font-display)] text-5xl font-semibold text-white">Let’s talk about the next project.</h1>
                <p class="mt-6 text-lg leading-8 text-slate-300">
                    The contact workflow is server-rendered, SEO-friendly, and connected to an admin-managed inquiries system.
                </p>
            </div>

            <form action="{{ route('contact.store') }}" method="POST" class="space-y-5 rounded-[2rem] border border-white/10 bg-white/5 p-8">
                @csrf
                <div class="grid gap-5 sm:grid-cols-2">
                    <label class="text-sm text-slate-300">
                        Name
                        <input type="text" name="name" value="{{ old('name') }}" class="mt-2 w-full rounded-2xl border border-white/10 bg-slate-950/60 px-4 py-3 text-white outline-none">
                    </label>
                    <label class="text-sm text-slate-300">
                        Email
                        <input type="email" name="email" value="{{ old('email') }}" class="mt-2 w-full rounded-2xl border border-white/10 bg-slate-950/60 px-4 py-3 text-white outline-none">
                    </label>
                </div>
                <div class="grid gap-5 sm:grid-cols-2">
                    <label class="text-sm text-slate-300">
                        Phone
                        <input type="text" name="phone" value="{{ old('phone') }}" class="mt-2 w-full rounded-2xl border border-white/10 bg-slate-950/60 px-4 py-3 text-white outline-none">
                    </label>
                    <label class="text-sm text-slate-300">
                        Company
                        <input type="text" name="company" value="{{ old('company') }}" class="mt-2 w-full rounded-2xl border border-white/10 bg-slate-950/60 px-4 py-3 text-white outline-none">
                    </label>
                </div>
                <label class="block text-sm text-slate-300">
                    Subject
                    <input type="text" name="subject" value="{{ old('subject') }}" class="mt-2 w-full rounded-2xl border border-white/10 bg-slate-950/60 px-4 py-3 text-white outline-none">
                </label>
                <label class="block text-sm text-slate-300">
                    Message
                    <textarea name="message" rows="6" class="mt-2 w-full rounded-2xl border border-white/10 bg-slate-950/60 px-4 py-3 text-white outline-none">{{ old('message') }}</textarea>
                </label>
                <button type="submit" class="rounded-full bg-white px-6 py-3 text-sm font-semibold text-slate-950 transition hover:bg-slate-200">
                    Send Inquiry
                </button>
            </form>
        </div>
    </section>
</x-layouts.app>

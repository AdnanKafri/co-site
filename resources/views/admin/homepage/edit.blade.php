<x-layouts.admin title="Homepage">
    <form action="{{ route('admin.homepage.update') }}" method="POST" class="space-y-8">
        @csrf
        @method('PUT')

        <section class="rounded-[2rem] bg-white p-6 shadow-sm ring-1 ring-slate-200">
            <h2 class="text-lg font-semibold text-slate-950">Hero</h2>
            <div class="mt-6 grid gap-5 md:grid-cols-2">
                <label class="text-sm text-slate-600">
                    Badge
                    <input type="text" name="hero[badge]" value="{{ old('hero.badge', $hero['badge'] ?? '') }}" class="mt-2 w-full rounded-2xl border border-slate-200 px-4 py-3 outline-none">
                </label>
                <label class="text-sm text-slate-600 md:col-span-2">
                    Title
                    <input type="text" name="hero[title]" value="{{ old('hero.title', $hero['title'] ?? '') }}" class="mt-2 w-full rounded-2xl border border-slate-200 px-4 py-3 outline-none">
                </label>
                <label class="text-sm text-slate-600 md:col-span-2">
                    Body
                    <textarea name="hero[body]" rows="5" class="mt-2 w-full rounded-2xl border border-slate-200 px-4 py-3 outline-none">{{ old('hero.body', $hero['body'] ?? '') }}</textarea>
                </label>
                <label class="text-sm text-slate-600">
                    Primary button label
                    <input type="text" name="hero[primary_label]" value="{{ old('hero.primary_label', $hero['primary_label'] ?? '') }}" class="mt-2 w-full rounded-2xl border border-slate-200 px-4 py-3 outline-none">
                </label>
                <label class="text-sm text-slate-600">
                    Primary button URL
                    <input type="text" name="hero[primary_url]" value="{{ old('hero.primary_url', $hero['primary_url'] ?? '') }}" class="mt-2 w-full rounded-2xl border border-slate-200 px-4 py-3 outline-none">
                </label>
                <label class="text-sm text-slate-600">
                    Secondary button label
                    <input type="text" name="hero[secondary_label]" value="{{ old('hero.secondary_label', $hero['secondary_label'] ?? '') }}" class="mt-2 w-full rounded-2xl border border-slate-200 px-4 py-3 outline-none">
                </label>
                <label class="text-sm text-slate-600">
                    Secondary button URL
                    <input type="text" name="hero[secondary_url]" value="{{ old('hero.secondary_url', $hero['secondary_url'] ?? '') }}" class="mt-2 w-full rounded-2xl border border-slate-200 px-4 py-3 outline-none">
                </label>
            </div>
            <div class="mt-6">
                <x-admin.media-picker name="hero[media_id]" label="Hero media" :value="old('hero.media_id', $hero['media_id'] ?? null)" />
            </div>
        </section>

        <section class="rounded-[2rem] bg-white p-6 shadow-sm ring-1 ring-slate-200">
            <h2 class="text-lg font-semibold text-slate-950">Features</h2>
            <div class="mt-6 grid gap-5">
                <label class="text-sm text-slate-600">
                    Eyebrow
                    <input type="text" name="features[eyebrow]" value="{{ old('features.eyebrow', $features['eyebrow'] ?? '') }}" class="mt-2 w-full rounded-2xl border border-slate-200 px-4 py-3 outline-none">
                </label>
                <label class="text-sm text-slate-600">
                    Title
                    <input type="text" name="features[title]" value="{{ old('features.title', $features['title'] ?? '') }}" class="mt-2 w-full rounded-2xl border border-slate-200 px-4 py-3 outline-none">
                </label>
            </div>
            <div class="mt-6 grid gap-6 lg:grid-cols-3">
                @foreach (range(0, 2) as $index)
                    <div class="rounded-[1.5rem] border border-slate-200 p-4">
                        <label class="text-sm text-slate-600">
                            Feature {{ $index + 1 }} title
                            <input type="text" name="features[items][{{ $index }}][title]" value="{{ old("features.items.$index.title", $features['items'][$index]['title'] ?? '') }}" class="mt-2 w-full rounded-2xl border border-slate-200 px-4 py-3 outline-none">
                        </label>
                        <label class="mt-4 block text-sm text-slate-600">
                            Feature {{ $index + 1 }} body
                            <textarea name="features[items][{{ $index }}][body]" rows="5" class="mt-2 w-full rounded-2xl border border-slate-200 px-4 py-3 outline-none">{{ old("features.items.$index.body", $features['items'][$index]['body'] ?? '') }}</textarea>
                        </label>
                    </div>
                @endforeach
            </div>
        </section>

        <section class="rounded-[2rem] bg-white p-6 shadow-sm ring-1 ring-slate-200">
            <h2 class="text-lg font-semibold text-slate-950">CTA</h2>
            <div class="mt-6 grid gap-5 md:grid-cols-2">
                <label class="text-sm text-slate-600 md:col-span-2">
                    Title
                    <input type="text" name="cta[title]" value="{{ old('cta.title', $cta['title'] ?? '') }}" class="mt-2 w-full rounded-2xl border border-slate-200 px-4 py-3 outline-none">
                </label>
                <label class="text-sm text-slate-600 md:col-span-2">
                    Body
                    <textarea name="cta[body]" rows="4" class="mt-2 w-full rounded-2xl border border-slate-200 px-4 py-3 outline-none">{{ old('cta.body', $cta['body'] ?? '') }}</textarea>
                </label>
                <label class="text-sm text-slate-600">
                    Button label
                    <input type="text" name="cta[button_label]" value="{{ old('cta.button_label', $cta['button_label'] ?? '') }}" class="mt-2 w-full rounded-2xl border border-slate-200 px-4 py-3 outline-none">
                </label>
                <label class="text-sm text-slate-600">
                    Button URL
                    <input type="text" name="cta[button_url]" value="{{ old('cta.button_url', $cta['button_url'] ?? '') }}" class="mt-2 w-full rounded-2xl border border-slate-200 px-4 py-3 outline-none">
                </label>
            </div>
            <div class="mt-6">
                <x-admin.media-picker name="cta[media_id]" label="CTA media" :value="old('cta.media_id', $cta['media_id'] ?? null)" />
            </div>
        </section>

        <section class="rounded-[2rem] bg-white p-6 shadow-sm ring-1 ring-slate-200">
            <h2 class="text-lg font-semibold text-slate-950">Partner / Client Rail</h2>
            <div class="mt-6 grid gap-5">
                <label class="text-sm text-slate-600">
                    Title
                    <input type="text" name="partners_rail[title]" value="{{ old('partners_rail.title', $partnersRail['title'] ?? '') }}" class="mt-2 w-full rounded-2xl border border-slate-200 px-4 py-3 outline-none">
                </label>
                <label class="text-sm text-slate-600">
                    Body
                    <textarea name="partners_rail[body]" rows="4" class="mt-2 w-full rounded-2xl border border-slate-200 px-4 py-3 outline-none">{{ old('partners_rail.body', $partnersRail['body'] ?? '') }}</textarea>
                </label>
            </div>
        </section>

        <button type="submit" class="rounded-full bg-slate-950 px-6 py-3 text-sm font-semibold text-white transition hover:bg-slate-800">
            Save Homepage
        </button>
    </form>
</x-layouts.admin>

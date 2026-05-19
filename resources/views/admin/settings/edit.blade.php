<x-layouts.admin title="General Settings">
    <form action="{{ route('admin.settings.update') }}" method="POST" class="space-y-8">
        @csrf
        @method('PUT')

        <section class="rounded-[2rem] bg-white p-6 shadow-sm ring-1 ring-slate-200">
            <h2 class="text-lg font-semibold text-slate-950">Company</h2>
            <div class="mt-6 grid gap-5 md:grid-cols-2">
                <label class="text-sm text-slate-600">
                    Company name
                    <input type="text" name="company_name" value="{{ old('company_name', $general['company_name'] ?? '') }}" class="mt-2 w-full rounded-2xl border border-slate-200 px-4 py-3 outline-none">
                </label>
                <label class="text-sm text-slate-600">
                    Email
                    <input type="email" name="email" value="{{ old('email', $general['email'] ?? '') }}" class="mt-2 w-full rounded-2xl border border-slate-200 px-4 py-3 outline-none">
                </label>
                <label class="text-sm text-slate-600">
                    Phone
                    <input type="text" name="phone" value="{{ old('phone', $general['phone'] ?? '') }}" class="mt-2 w-full rounded-2xl border border-slate-200 px-4 py-3 outline-none">
                </label>
                <label class="text-sm text-slate-600">
                    Address
                    <input type="text" name="address" value="{{ old('address', $general['address'] ?? '') }}" class="mt-2 w-full rounded-2xl border border-slate-200 px-4 py-3 outline-none">
                </label>
            </div>
        </section>

        <section class="rounded-[2rem] bg-white p-6 shadow-sm ring-1 ring-slate-200">
            <h2 class="text-lg font-semibold text-slate-950">Brand and SEO</h2>
            <div class="mt-6 grid gap-5 md:grid-cols-2">
                <label class="text-sm text-slate-600">
                    Primary brand color
                    <input type="text" name="brand_primary" value="{{ old('brand_primary', $general['brand_primary'] ?? '') }}" placeholder="#2f66d0" class="mt-2 w-full rounded-2xl border border-slate-200 px-4 py-3 outline-none">
                </label>
                <label class="text-sm text-slate-600">
                    Secondary brand color
                    <input type="text" name="brand_secondary" value="{{ old('brand_secondary', $general['brand_secondary'] ?? '') }}" placeholder="#19b7a7" class="mt-2 w-full rounded-2xl border border-slate-200 px-4 py-3 outline-none">
                </label>
                <label class="text-sm text-slate-600 md:col-span-2">
                    Default SEO title
                    <input type="text" name="default_title" value="{{ old('default_title', $seo['default_title'] ?? '') }}" class="mt-2 w-full rounded-2xl border border-slate-200 px-4 py-3 outline-none">
                </label>
                <label class="text-sm text-slate-600 md:col-span-2">
                    Default SEO description
                    <textarea name="default_description" rows="4" class="mt-2 w-full rounded-2xl border border-slate-200 px-4 py-3 outline-none">{{ old('default_description', $seo['default_description'] ?? '') }}</textarea>
                </label>
                <label class="text-sm text-slate-600 md:col-span-2">
                    Maps embed / link
                    <textarea name="maps_embed" rows="4" class="mt-2 w-full rounded-2xl border border-slate-200 px-4 py-3 outline-none">{{ old('maps_embed', $general['maps_embed'] ?? '') }}</textarea>
                </label>
            </div>
        </section>

        <section class="rounded-[2rem] bg-white p-6 shadow-sm ring-1 ring-slate-200">
            <h2 class="text-lg font-semibold text-slate-950">Social Links</h2>
            <div class="mt-6 grid gap-5 md:grid-cols-3">
                <label class="text-sm text-slate-600">
                    LinkedIn
                    <input type="url" name="linkedin" value="{{ old('linkedin', $social['linkedin'] ?? '') }}" class="mt-2 w-full rounded-2xl border border-slate-200 px-4 py-3 outline-none">
                </label>
                <label class="text-sm text-slate-600">
                    Instagram
                    <input type="url" name="instagram" value="{{ old('instagram', $social['instagram'] ?? '') }}" class="mt-2 w-full rounded-2xl border border-slate-200 px-4 py-3 outline-none">
                </label>
                <label class="text-sm text-slate-600">
                    X
                    <input type="url" name="x" value="{{ old('x', $social['x'] ?? '') }}" class="mt-2 w-full rounded-2xl border border-slate-200 px-4 py-3 outline-none">
                </label>
            </div>
        </section>

        <button type="submit" class="rounded-full bg-slate-950 px-6 py-3 text-sm font-semibold text-white transition hover:bg-slate-800">
            Save Settings
        </button>
    </form>
</x-layouts.admin>

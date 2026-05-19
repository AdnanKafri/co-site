@php($isEdit = $partner->exists)

<form action="{{ $isEdit ? route('admin.partners.update', $partner) : route('admin.partners.store') }}" method="POST" class="space-y-8">
    @csrf
    @if ($isEdit)
        @method('PUT')
    @endif

    <section class="rounded-[2rem] bg-white p-6 shadow-sm ring-1 ring-slate-200">
        <div class="grid gap-5 md:grid-cols-2">
            <label class="text-sm text-slate-600">
                Name
                <input type="text" name="name" value="{{ old('name', $partner->name) }}" class="mt-2 w-full rounded-2xl border border-slate-200 px-4 py-3 outline-none">
            </label>
            <label class="text-sm text-slate-600">
                Website
                <input type="url" name="website" value="{{ old('website', $partner->website) }}" class="mt-2 w-full rounded-2xl border border-slate-200 px-4 py-3 outline-none">
            </label>
            <label class="text-sm text-slate-600">
                Sort order
                <input type="number" name="sort_order" value="{{ old('sort_order', $partner->sort_order) }}" class="mt-2 w-full rounded-2xl border border-slate-200 px-4 py-3 outline-none">
            </label>
            <label class="flex items-center gap-3 text-sm text-slate-600">
                <input type="hidden" name="is_active" value="0">
                <input type="checkbox" name="is_active" value="1" @checked(old('is_active', $partner->is_active)) class="h-4 w-4 rounded border-slate-300">
                Active on site
            </label>
        </div>
    </section>

    <section class="rounded-[2rem] bg-white p-6 shadow-sm ring-1 ring-slate-200">
        <x-admin.media-picker name="logo_media_id" label="Partner logo" :value="old('logo_media_id', $partner->logo_media_id)" />
    </section>

    <div class="flex items-center gap-4">
        <button type="submit" class="rounded-full bg-slate-950 px-6 py-3 text-sm font-semibold text-white transition hover:bg-slate-800">
            {{ $isEdit ? 'Save Changes' : 'Create Partner' }}
        </button>
    </div>
</form>

@if ($isEdit)
    <form action="{{ route('admin.partners.destroy', $partner) }}" method="POST" class="mt-4">
        @csrf
        @method('DELETE')
        <button type="submit" class="rounded-full border border-rose-200 px-6 py-3 text-sm font-semibold text-rose-700 transition hover:bg-rose-50">
            Delete
        </button>
    </form>
@endif

@php($isEdit = $service->exists)

<form action="{{ $isEdit ? route('admin.services.update', $service) : route('admin.services.store') }}" method="POST" class="space-y-8">
    @csrf
    @if ($isEdit)
        @method('PUT')
    @endif

    <section class="rounded-[2rem] bg-white p-6 shadow-sm ring-1 ring-slate-200">
        <div class="grid gap-5 md:grid-cols-2">
            <label class="text-sm text-slate-600">
                Title
                <input type="text" name="title" value="{{ old('title', $service->title) }}" class="mt-2 w-full rounded-2xl border border-slate-200 px-4 py-3 outline-none">
            </label>
            <label class="text-sm text-slate-600">
                Slug
                <input type="text" name="slug" value="{{ old('slug', $service->slug) }}" class="mt-2 w-full rounded-2xl border border-slate-200 px-4 py-3 outline-none">
            </label>
            <label class="text-sm text-slate-600">
                Icon / short label
                <input type="text" name="icon" value="{{ old('icon', $service->icon) }}" placeholder="Strategy" class="mt-2 w-full rounded-2xl border border-slate-200 px-4 py-3 outline-none">
            </label>
            <label class="text-sm text-slate-600">
                Sort order
                <input type="number" name="sort_order" value="{{ old('sort_order', $service->sort_order) }}" class="mt-2 w-full rounded-2xl border border-slate-200 px-4 py-3 outline-none">
            </label>
            <label class="flex items-center gap-3 text-sm text-slate-600">
                <input type="hidden" name="featured" value="0">
                <input type="checkbox" name="featured" value="1" @checked(old('featured', $service->featured)) class="h-4 w-4 rounded border-slate-300">
                Featured service
            </label>
        </div>
    </section>

    <section class="rounded-[2rem] bg-white p-6 shadow-sm ring-1 ring-slate-200">
        <div class="grid gap-5">
            <label class="text-sm text-slate-600">
                Excerpt
                <textarea name="excerpt" rows="4" class="mt-2 w-full rounded-2xl border border-slate-200 px-4 py-3 outline-none">{{ old('excerpt', $service->excerpt) }}</textarea>
            </label>
            <label class="text-sm text-slate-600">
                Full description
                <textarea name="description" rows="10" class="mt-2 w-full rounded-2xl border border-slate-200 px-4 py-3 outline-none">{{ old('description', $service->description) }}</textarea>
            </label>
        </div>
    </section>

    <section class="rounded-[2rem] bg-white p-6 shadow-sm ring-1 ring-slate-200">
        <x-admin.media-picker
            name="image_media_id"
            label="Service image"
            :value="old('image_media_id', $service->image_media_id)"
        />
    </section>

    <div class="flex items-center gap-4">
        <button type="submit" class="rounded-full bg-slate-950 px-6 py-3 text-sm font-semibold text-white transition hover:bg-slate-800">
            {{ $isEdit ? 'Save Changes' : 'Create Service' }}
        </button>
    </div>
</form>

@if ($isEdit)
    <form action="{{ route('admin.services.destroy', $service) }}" method="POST" class="mt-4">
        @csrf
        @method('DELETE')
        <button type="submit" class="rounded-full border border-rose-200 px-6 py-3 text-sm font-semibold text-rose-700 transition hover:bg-rose-50">
            Delete
        </button>
    </form>
@endif

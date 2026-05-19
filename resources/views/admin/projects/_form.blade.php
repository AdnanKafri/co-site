@php($isEdit = $project->exists)

<form action="{{ $isEdit ? route('admin.projects.update', $project) : route('admin.projects.store') }}" method="POST" class="space-y-8">
    @csrf
    @if ($isEdit)
        @method('PUT')
    @endif

    <section class="rounded-[2rem] bg-white p-6 shadow-sm ring-1 ring-slate-200">
        <div class="grid gap-5 md:grid-cols-2">
            <label class="text-sm text-slate-600">
                Title
                <input type="text" name="title" value="{{ old('title', $project->title) }}" class="mt-2 w-full rounded-2xl border border-slate-200 px-4 py-3 outline-none">
            </label>
            <label class="text-sm text-slate-600">
                Slug
                <input type="text" name="slug" value="{{ old('slug', $project->slug) }}" class="mt-2 w-full rounded-2xl border border-slate-200 px-4 py-3 outline-none">
            </label>
            <label class="text-sm text-slate-600">
                Client
                <input type="text" name="client" value="{{ old('client', $project->client) }}" class="mt-2 w-full rounded-2xl border border-slate-200 px-4 py-3 outline-none">
            </label>
            <label class="text-sm text-slate-600">
                Category
                <input type="text" name="category" value="{{ old('category', $project->category) }}" class="mt-2 w-full rounded-2xl border border-slate-200 px-4 py-3 outline-none">
            </label>
            <label class="text-sm text-slate-600">
                Technologies
                <input type="text" name="technologies" value="{{ old('technologies', collect($project->technologies ?? [])->implode(', ')) }}" placeholder="Laravel, Tailwind, Alpine.js" class="mt-2 w-full rounded-2xl border border-slate-200 px-4 py-3 outline-none">
            </label>
            <label class="text-sm text-slate-600">
                Completed at
                <input type="date" name="completed_at" value="{{ old('completed_at', optional($project->completed_at)->format('Y-m-d')) }}" class="mt-2 w-full rounded-2xl border border-slate-200 px-4 py-3 outline-none">
            </label>
            <label class="text-sm text-slate-600 md:col-span-2">
                External link
                <input type="url" name="external_link" value="{{ old('external_link', $project->external_link) }}" class="mt-2 w-full rounded-2xl border border-slate-200 px-4 py-3 outline-none">
            </label>
            <label class="flex items-center gap-3 text-sm text-slate-600">
                <input type="hidden" name="featured" value="0">
                <input type="checkbox" name="featured" value="1" @checked(old('featured', $project->featured)) class="h-4 w-4 rounded border-slate-300">
                Featured project
            </label>
        </div>
    </section>

    <section class="rounded-[2rem] bg-white p-6 shadow-sm ring-1 ring-slate-200">
        <label class="block text-sm text-slate-600">
            Project description
            <textarea name="description" rows="10" class="mt-2 w-full rounded-2xl border border-slate-200 px-4 py-3 outline-none">{{ old('description', $project->description) }}</textarea>
        </label>
    </section>

    <section class="grid gap-8 xl:grid-cols-2">
        <div class="rounded-[2rem] bg-white p-6 shadow-sm ring-1 ring-slate-200">
            <x-admin.media-picker
                name="cover_media_id"
                label="Cover image"
                :value="old('cover_media_id', $project->cover_media_id)"
            />
        </div>

        <div class="rounded-[2rem] bg-white p-6 shadow-sm ring-1 ring-slate-200">
            <x-admin.media-picker
                name="gallery_media_ids"
                label="Project gallery"
                :value="old('gallery_media_ids', $project->gallery->all() ?? [])"
                :multiple="true"
            />
        </div>
    </section>

    <div class="flex items-center gap-4">
        <button type="submit" class="rounded-full bg-slate-950 px-6 py-3 text-sm font-semibold text-white transition hover:bg-slate-800">
            {{ $isEdit ? 'Save Changes' : 'Create Project' }}
        </button>
    </div>
</form>

@if ($isEdit)
    <form action="{{ route('admin.projects.destroy', $project) }}" method="POST" class="mt-4">
        @csrf
        @method('DELETE')
        <button type="submit" class="rounded-full border border-rose-200 px-6 py-3 text-sm font-semibold text-rose-700 transition hover:bg-rose-50">
            Delete
        </button>
    </form>
@endif

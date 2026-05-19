@php($isEdit = $teamMember->exists)

<form action="{{ $isEdit ? route('admin.team.update', $teamMember) : route('admin.team.store') }}" method="POST" class="space-y-8">
    @csrf
    @if ($isEdit)
        @method('PUT')
    @endif

    <section class="rounded-[2rem] bg-white p-6 shadow-sm ring-1 ring-slate-200">
        <div class="grid gap-5 md:grid-cols-2">
            <label class="text-sm text-slate-600">
                Name
                <input type="text" name="name" value="{{ old('name', $teamMember->name) }}" class="mt-2 w-full rounded-2xl border border-slate-200 px-4 py-3 outline-none">
            </label>
            <label class="text-sm text-slate-600">
                Role
                <input type="text" name="role" value="{{ old('role', $teamMember->role) }}" class="mt-2 w-full rounded-2xl border border-slate-200 px-4 py-3 outline-none">
            </label>
            <label class="text-sm text-slate-600">
                Sort order
                <input type="number" name="sort_order" value="{{ old('sort_order', $teamMember->sort_order) }}" class="mt-2 w-full rounded-2xl border border-slate-200 px-4 py-3 outline-none">
            </label>
            <label class="flex items-center gap-3 text-sm text-slate-600">
                <input type="hidden" name="is_active" value="0">
                <input type="checkbox" name="is_active" value="1" @checked(old('is_active', $teamMember->is_active)) class="h-4 w-4 rounded border-slate-300">
                Active on site
            </label>
            <label class="text-sm text-slate-600 md:col-span-2">
                Bio
                <textarea name="bio" rows="6" class="mt-2 w-full rounded-2xl border border-slate-200 px-4 py-3 outline-none">{{ old('bio', $teamMember->bio) }}</textarea>
            </label>
        </div>
    </section>

    <section class="grid gap-8 xl:grid-cols-[0.9fr_1.1fr]">
        <div class="rounded-[2rem] bg-white p-6 shadow-sm ring-1 ring-slate-200">
            <x-admin.media-picker name="image_media_id" label="Profile image" :value="old('image_media_id', $teamMember->image_media_id)" />
        </div>
        <div class="rounded-[2rem] bg-white p-6 shadow-sm ring-1 ring-slate-200">
            <h2 class="text-lg font-semibold text-slate-950">Socials</h2>
            <div class="mt-6 grid gap-5">
                <label class="text-sm text-slate-600">
                    LinkedIn
                    <input type="url" name="linkedin" value="{{ old('linkedin', $teamMember->social_links['linkedin'] ?? '') }}" class="mt-2 w-full rounded-2xl border border-slate-200 px-4 py-3 outline-none">
                </label>
                <label class="text-sm text-slate-600">
                    X
                    <input type="url" name="x" value="{{ old('x', $teamMember->social_links['x'] ?? '') }}" class="mt-2 w-full rounded-2xl border border-slate-200 px-4 py-3 outline-none">
                </label>
                <label class="text-sm text-slate-600">
                    Website
                    <input type="url" name="website" value="{{ old('website', $teamMember->social_links['website'] ?? '') }}" class="mt-2 w-full rounded-2xl border border-slate-200 px-4 py-3 outline-none">
                </label>
            </div>
        </div>
    </section>

    <div class="flex items-center gap-4">
        <button type="submit" class="rounded-full bg-slate-950 px-6 py-3 text-sm font-semibold text-white transition hover:bg-slate-800">
            {{ $isEdit ? 'Save Changes' : 'Create Team Member' }}
        </button>
    </div>
</form>

@if ($isEdit)
    <form action="{{ route('admin.team.destroy', $teamMember) }}" method="POST" class="mt-4">
        @csrf
        @method('DELETE')
        <button type="submit" class="rounded-full border border-rose-200 px-6 py-3 text-sm font-semibold text-rose-700 transition hover:bg-rose-50">
            Delete
        </button>
    </form>
@endif

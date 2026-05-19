<x-layouts.admin title="Media Library">
    <div class="grid gap-6 lg:grid-cols-[0.95fr_1.05fr]">
        <section class="rounded-[2rem] bg-white p-6 shadow-sm ring-1 ring-slate-200">
            <h2 class="text-lg font-semibold text-slate-950">Upload Media</h2>
            <form action="{{ route('admin.media.store') }}" method="POST" enctype="multipart/form-data" class="mt-6 space-y-5">
                @csrf
                <label class="block text-sm text-slate-600">
                    Directory
                    <select name="directory" class="mt-2 w-full rounded-2xl border border-slate-200 px-4 py-3 outline-none">
                        @foreach (['general', 'settings', 'services', 'projects', 'team', 'partners', 'seo'] as $directory)
                            <option value="{{ $directory }}">{{ ucfirst($directory) }}</option>
                        @endforeach
                    </select>
                </label>
                <label class="block text-sm text-slate-600">
                    File
                    <input type="file" name="file" class="mt-2 w-full rounded-2xl border border-slate-200 px-4 py-3 outline-none">
                </label>
                <button type="submit" class="rounded-full bg-slate-950 px-6 py-3 text-sm font-semibold text-white transition hover:bg-slate-800">
                    Upload
                </button>
            </form>
        </section>

        <section class="rounded-[2rem] bg-white p-6 shadow-sm ring-1 ring-slate-200">
            <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
                <h2 class="text-lg font-semibold text-slate-950">Library</h2>
                <form action="{{ route('admin.media.index') }}" method="GET">
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Search media" class="w-full rounded-full border border-slate-200 px-4 py-2 text-sm outline-none sm:w-64">
                </form>
            </div>

            <div class="mt-6 grid gap-4 sm:grid-cols-2 xl:grid-cols-3">
                @forelse ($media as $item)
                    <article class="overflow-hidden rounded-[1.5rem] border border-slate-200">
                        @if (str_starts_with($item->mime_type, 'image/'))
                            <img src="{{ $item->url }}" alt="{{ $item->alt_text ?: $item->original_name }}" class="h-40 w-full bg-slate-100 object-cover">
                        @else
                            <div class="flex h-40 items-center justify-center bg-slate-100 text-sm text-slate-500">
                                {{ strtoupper($item->extension ?: 'FILE') }}
                            </div>
                        @endif

                        <div class="space-y-1 p-4">
                            <p class="truncate text-sm font-medium text-slate-900">{{ $item->original_name }}</p>
                            <p class="text-xs text-slate-500">{{ number_format($item->size / 1024, 1) }} KB</p>
                        </div>
                    </article>
                @empty
                    <div class="rounded-[1.5rem] border border-dashed border-slate-300 p-6 text-sm text-slate-500 sm:col-span-2 xl:col-span-3">
                        No media uploaded yet.
                    </div>
                @endforelse
            </div>

            <div class="mt-6">
                {{ $media->links() }}
            </div>
        </section>
    </div>
</x-layouts.admin>

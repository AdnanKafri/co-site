<x-layouts.admin title="Media Library">
    <div class="grid gap-6 xl:grid-cols-[0.85fr_1.15fr]">
        <section
            x-data="{
                previewUrl: null,
                fileName: '',
                fileType: '',
                fileSize: '',
                hasImagePreview: false,
                updatePreview(event) {
                    const file = event.target.files?.[0];
                    if (!file) {
                        this.previewUrl = null;
                        this.fileName = '';
                        this.fileType = '';
                        this.fileSize = '';
                        this.hasImagePreview = false;
                        return;
                    }

                    this.fileName = file.name;
                    this.fileType = file.type || 'file';
                    this.fileSize = `${(file.size / 1024 / 1024).toFixed(2)} MB`;
                    this.hasImagePreview = file.type.startsWith('image/');

                    if (this.previewUrl) {
                        URL.revokeObjectURL(this.previewUrl);
                    }

                    this.previewUrl = this.hasImagePreview ? URL.createObjectURL(file) : null;
                }
            }"
            class="rounded-[2rem] bg-white p-6 shadow-sm ring-1 ring-slate-200"
        >
            <h2 class="text-lg font-semibold text-slate-950">Upload Media</h2>
            <p class="mt-1 text-sm text-slate-500">Upload once, then reuse the same asset everywhere in the site and admin.</p>

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
                    <input type="file" name="file" @change="updatePreview($event)" class="mt-2 w-full rounded-2xl border border-slate-200 px-4 py-3 outline-none">
                </label>

                <div class="overflow-hidden rounded-[1.75rem] border border-slate-200 bg-slate-50">
                    <div class="relative aspect-[16/10] bg-[linear-gradient(180deg,#f8fafc_0%,#eef2f7_100%)]">
                        <template x-if="previewUrl && hasImagePreview">
                            <img :src="previewUrl" alt="Upload preview" class="absolute inset-0 h-full w-full object-cover">
                        </template>
                        <template x-if="!previewUrl || !hasImagePreview">
                            <div class="absolute inset-0 flex flex-col items-center justify-center gap-3 px-6 text-center">
                                <div class="rounded-full bg-white px-3 py-1 text-[11px] font-semibold uppercase tracking-[0.22em] text-slate-500 shadow-sm">
                                    Preview area
                                </div>
                                <p class="max-w-xs text-sm leading-6 text-slate-500">
                                    Image uploads render here before submission. Non-image files stay neatly represented as reusable assets.
                                </p>
                            </div>
                        </template>
                    </div>
                    <div class="grid gap-3 border-t border-slate-200 p-4 sm:grid-cols-3">
                        <div>
                            <p class="text-[11px] font-semibold uppercase tracking-[0.18em] text-slate-400">Name</p>
                            <p class="mt-1 truncate text-sm text-slate-700" x-text="fileName || 'No file selected'"></p>
                        </div>
                        <div>
                            <p class="text-[11px] font-semibold uppercase tracking-[0.18em] text-slate-400">Type</p>
                            <p class="mt-1 text-sm text-slate-700" x-text="fileType || 'Awaiting upload'"></p>
                        </div>
                        <div>
                            <p class="text-[11px] font-semibold uppercase tracking-[0.18em] text-slate-400">Size</p>
                            <p class="mt-1 text-sm text-slate-700" x-text="fileSize || 'Awaiting upload'"></p>
                        </div>
                    </div>
                </div>

                <button type="submit" class="rounded-full bg-slate-950 px-6 py-3 text-sm font-semibold text-white transition hover:bg-slate-800">
                    Upload
                </button>
            </form>
        </section>

        <section class="rounded-[2rem] bg-white p-6 shadow-sm ring-1 ring-slate-200">
            <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
                <div>
                    <h2 class="text-lg font-semibold text-slate-950">Library</h2>
                    <p class="mt-1 text-sm text-slate-500">Consistent cards, stable previews, and reusable assets.</p>
                </div>
                <form action="{{ route('admin.media.index') }}" method="GET">
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Search media" class="w-full rounded-full border border-slate-200 px-4 py-2 text-sm outline-none sm:w-64">
                </form>
            </div>

            <div class="mt-6 grid gap-4 sm:grid-cols-2 xl:grid-cols-3">
                @forelse ($media as $item)
                    <article class="overflow-hidden rounded-[1.5rem] border border-slate-200 bg-white shadow-sm">
                        @if (str_starts_with($item->mime_type, 'image/'))
                            <div class="relative aspect-[4/3] bg-slate-100">
                                <img
                                    src="{{ $item->url }}"
                                    alt="{{ $item->alt_text ?: $item->original_name }}"
                                    class="absolute inset-0 h-full w-full object-cover"
                                    onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';"
                                >
                                <div class="absolute inset-0 hidden items-center justify-center bg-slate-100 px-4 text-center text-sm text-slate-500">
                                    Preview unavailable
                                </div>
                            </div>
                        @else
                            <div class="flex aspect-[4/3] items-center justify-center bg-slate-100 px-4 text-center text-sm text-slate-500">
                                {{ strtoupper($item->extension ?: 'FILE') }}
                            </div>
                        @endif

                        <div class="space-y-2 p-4">
                            <p class="truncate text-sm font-medium text-slate-900">{{ $item->original_name }}</p>
                            <div class="flex flex-wrap items-center gap-2 text-xs text-slate-500">
                                <span>{{ number_format($item->size / 1024, 1) }} KB</span>
                                @if ($item->width && $item->height)
                                    <span class="rounded-full bg-slate-100 px-2.5 py-1">{{ $item->width }} x {{ $item->height }}</span>
                                @endif
                            </div>
                        </div>
                    </article>
                @empty
                    <div class="rounded-[1.5rem] border border-dashed border-slate-300 bg-slate-50 p-6 text-sm text-slate-500 sm:col-span-2 xl:col-span-3">
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

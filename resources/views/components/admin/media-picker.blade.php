@props([
    'name',
    'label' => 'Media',
    'value' => null,
    'multiple' => false,
    'singleAspect' => 'aspect-[16/10]',
    'multipleAspect' => 'aspect-square',
])

@php
    $isMultiple = filter_var($multiple, FILTER_VALIDATE_BOOLEAN);

    $selectedItems = collect($isMultiple ? ($value ?? []) : array_filter([$value]))
        ->map(function ($item) {
            if ($item instanceof \App\Models\Media) {
                return [
                    'id' => $item->id,
                    'url' => $item->url,
                    'name' => $item->original_name,
                    'mime_type' => $item->mime_type,
                    'width' => $item->width,
                    'height' => $item->height,
                ];
            }

            if (is_array($item)) {
                return $item;
            }

            $media = \App\Models\Media::query()->find($item);

            return $media ? [
                'id' => $media->id,
                'url' => $media->url,
                'name' => $media->original_name,
                'mime_type' => $media->mime_type,
                'width' => $media->width,
                'height' => $media->height,
            ] : null;
        })
        ->filter()
        ->values()
        ->all();
@endphp

<div
    x-data="{
        open: false,
        search: '',
        loading: false,
        library: [],
        selected: @js($selectedItems),
        multiple: @js($isMultiple),
        async load() {
            this.loading = true;
            const url = new URL(@js(route('admin.media.browser')), window.location.origin);
            if (this.search) url.searchParams.set('search', this.search);
            const response = await fetch(url, { headers: { 'Accept': 'application/json' } });
            const payload = await response.json();
            this.library = (payload.data ?? []).map(item => ({ ...item, broken: false }));
            this.loading = false;
        },
        isSelected(id) {
            return this.selected.some(item => item.id === id);
        },
        toggle(item) {
            const normalized = { ...item, broken: item.broken ?? false };

            if (this.multiple) {
                if (this.isSelected(normalized.id)) {
                    this.selected = this.selected.filter(selected => selected.id !== normalized.id);
                } else {
                    this.selected = [...this.selected, normalized];
                }
                return;
            }

            this.selected = [normalized];
            this.open = false;
        },
        remove(id) {
            this.selected = this.selected.filter(item => item.id !== id);
        },
        markBroken(item) {
            item.broken = true;
        }
    }"
    x-init="load()"
    class="space-y-3"
>
    <div class="flex items-center justify-between gap-4">
        <label class="text-sm font-medium text-slate-700">{{ $label }}</label>
        <button
            type="button"
            @click="open = true; load()"
            class="rounded-full border border-slate-300 px-4 py-2 text-sm font-medium text-slate-700 transition hover:border-slate-400 hover:text-slate-950"
        >
            Choose Media
        </button>
    </div>

    <div class="grid gap-4" :class="multiple ? 'sm:grid-cols-2 xl:grid-cols-3' : 'max-w-2xl'">
        <template x-for="item in selected" :key="item.id">
            <article class="overflow-hidden rounded-[1.5rem] border border-slate-200 bg-white shadow-sm">
                <div class="relative bg-slate-100" :class="multiple ? '{{ $multipleAspect }}' : '{{ $singleAspect }}'">
                    <template x-if="item.mime_type.startsWith('image/') && ! item.broken">
                            <img
                                :src="item.url"
                                :alt="item.name"
                                x-on:error="markBroken(item)"
                                class="absolute inset-0 h-full w-full object-cover"
                            >
                    </template>
                    <template x-if="! item.mime_type.startsWith('image/') || item.broken">
                        <div class="absolute inset-0 flex flex-col items-center justify-center gap-2 bg-slate-100 px-4 text-center">
                            <div class="rounded-full bg-white px-3 py-1 text-[11px] font-semibold uppercase tracking-[0.22em] text-slate-500 shadow-sm">
                                <span x-text="item.broken ? 'Preview unavailable' : 'File asset'"></span>
                            </div>
                            <p class="max-w-[16rem] text-sm text-slate-500" x-text="item.broken ? 'The image could not be rendered, but the media record is still selected.' : 'Non-image files remain reusable assets in the centralized library.'"></p>
                        </div>
                    </template>
                </div>

                <div class="space-y-3 p-4">
                    <div class="space-y-1">
                        <p class="truncate text-sm font-medium text-slate-900" x-text="item.name"></p>
                        <p class="text-xs text-slate-500" x-text="item.width && item.height ? `${item.width} x ${item.height}` : (item.mime_type.startsWith('image/') ? 'Image asset' : 'Reusable media asset')"></p>
                    </div>
                    <div class="flex items-center justify-between gap-3">
                        <div class="rounded-full bg-slate-100 px-3 py-1 text-[11px] font-medium uppercase tracking-[0.18em] text-slate-500" x-text="item.mime_type.startsWith('image/') ? 'Image' : 'File'"></div>
                        <button type="button" @click="remove(item.id)" class="rounded-full px-3 py-1 text-xs font-semibold text-rose-600 transition hover:bg-rose-50">Remove</button>
                    </div>
                </div>
            </article>
        </template>

        <div
            x-show="selected.length === 0"
            class="rounded-[1.5rem] border border-dashed border-slate-300 bg-slate-50/70 p-5 text-sm text-slate-500"
            :class="multiple ? '' : 'min-h-52'"
        >
            <div class="flex h-full flex-col justify-center gap-2">
                <p class="font-medium text-slate-700">No media selected yet.</p>
                <p>Choose from the library to keep images reusable and visually consistent across the site.</p>
            </div>
        </div>
    </div>

    <template x-for="item in selected" :key="`input-${item.id}`">
        <input
            type="hidden"
            :name="multiple ? '{{ $name }}[]' : '{{ $name }}'"
            :value="item.id"
        >
    </template>

    <div
        x-show="open"
        x-cloak
        class="fixed inset-0 z-50 overflow-y-auto bg-slate-950/60 px-4 py-6 sm:px-6 sm:py-8"
    >
        <div class="flex min-h-full items-start justify-center sm:items-center">
            <div @click.outside="open = false" class="flex max-h-[88vh] w-full max-w-6xl flex-col overflow-hidden rounded-[2rem] bg-white shadow-2xl">
                <div class="flex flex-col gap-4 border-b border-slate-200 px-5 py-5 sm:flex-row sm:items-center sm:justify-between sm:px-6">
                    <div>
                        <h3 class="text-lg font-semibold text-slate-950">Media Library</h3>
                        <p class="text-sm text-slate-500">Reuse existing assets from the centralized library.</p>
                    </div>
                    <div class="flex items-center gap-3">
                        <div class="rounded-full bg-slate-100 px-3 py-1 text-[11px] font-semibold uppercase tracking-[0.2em] text-slate-500" x-text="multiple ? `${selected.length} selected` : (selected.length ? '1 selected' : 'Nothing selected')"></div>
                        <button type="button" @click="open = false" class="rounded-full border border-slate-300 px-4 py-2 text-sm">Close</button>
                    </div>
                </div>

                <div class="border-b border-slate-200 px-5 py-4 sm:px-6">
                    <input
                        type="text"
                        x-model.debounce.300ms="search"
                        @input="load()"
                        placeholder="Search media"
                        class="w-full rounded-full border border-slate-200 px-4 py-3 text-sm outline-none"
                    >
                </div>

                <div class="flex-1 overflow-y-auto p-5 sm:p-6">
                    <div x-show="loading" class="rounded-[1.5rem] border border-dashed border-slate-300 bg-slate-50 p-6 text-sm text-slate-500">
                        Loading media...
                    </div>

                    <div class="grid gap-4 sm:grid-cols-2 xl:grid-cols-3" x-show="! loading && library.length > 0">
                        <template x-for="item in library" :key="item.id">
                            <button
                                type="button"
                                @click="toggle(item)"
                                class="group overflow-hidden rounded-[1.5rem] border bg-white text-left shadow-sm transition"
                                :class="isSelected(item.id) ? 'border-slate-950 ring-2 ring-slate-950/10' : 'border-slate-200 hover:border-slate-300 hover:shadow-md'"
                            >
                                <div class="relative aspect-[4/3] bg-slate-100">
                                    <template x-if="item.mime_type.startsWith('image/') && ! item.broken">
                                        <img
                                            :src="item.url"
                                            :alt="item.name"
                                            x-on:error="markBroken(item)"
                                            class="absolute inset-0 h-full w-full object-cover"
                                        >
                                    </template>
                                    <template x-if="! item.mime_type.startsWith('image/') || item.broken">
                                        <div class="absolute inset-0 flex flex-col items-center justify-center gap-2 bg-slate-100 px-4 text-center">
                                            <div class="rounded-full bg-white px-3 py-1 text-[11px] font-semibold uppercase tracking-[0.22em] text-slate-500 shadow-sm">
                                                <span x-text="item.broken ? 'Preview unavailable' : 'File asset'"></span>
                                            </div>
                                            <p class="text-sm text-slate-500">Reusable media record</p>
                                        </div>
                                    </template>
                                </div>

                                <div class="space-y-2 p-4">
                                    <div class="flex items-start justify-between gap-3">
                                        <p class="min-w-0 truncate text-sm font-medium text-slate-900" x-text="item.name"></p>
                                        <span
                                            class="shrink-0 rounded-full px-2.5 py-1 text-[11px] font-semibold uppercase tracking-[0.18em]"
                                            :class="isSelected(item.id) ? 'bg-slate-950 text-white' : 'bg-slate-100 text-slate-500'"
                                        >
                                            <span x-text="isSelected(item.id) ? 'Selected' : 'Select'"></span>
                                        </span>
                                    </div>
                                    <p class="text-xs text-slate-500" x-text="item.width && item.height ? `${item.width} x ${item.height}` : 'Reusable media asset'"></p>
                                </div>
                            </button>
                        </template>
                    </div>

                    <div x-show="! loading && library.length === 0" class="rounded-[1.5rem] border border-dashed border-slate-300 bg-slate-50 p-6 text-sm text-slate-500">
                        No media matched this search yet.
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

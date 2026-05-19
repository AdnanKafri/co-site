<x-layouts.admin title="Services">
    <div class="mb-6 flex items-center justify-between gap-4">
        <div>
            <h2 class="text-lg font-semibold text-slate-950">Services</h2>
            <p class="mt-1 text-sm text-slate-500">Manage curated service pages with reusable media and featured ordering.</p>
        </div>
        <a href="{{ route('admin.services.create') }}" class="rounded-full bg-slate-950 px-5 py-3 text-sm font-semibold text-white transition hover:bg-slate-800">
            Add Service
        </a>
    </div>

    <div class="overflow-hidden rounded-[2rem] bg-white shadow-sm ring-1 ring-slate-200">
        <table class="min-w-full divide-y divide-slate-200 text-sm">
            <thead class="bg-slate-50 text-left text-slate-500">
                <tr>
                    <th class="px-6 py-4">Service</th>
                    <th class="px-6 py-4">Slug</th>
                    <th class="px-6 py-4">Featured</th>
                    <th class="px-6 py-4">Order</th>
                    <th class="px-6 py-4"></th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100">
                @forelse ($services as $service)
                    <tr>
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-4">
                                @if ($service->image)
                                    <img src="{{ $service->image->url }}" alt="{{ $service->title }}" class="h-14 w-14 rounded-2xl object-cover">
                                @else
                                    <div class="flex h-14 w-14 items-center justify-center rounded-2xl bg-slate-100 text-xs text-slate-500">No image</div>
                                @endif
                                <div>
                                    <p class="font-medium text-slate-900">{{ $service->title }}</p>
                                    <p class="text-slate-500">{{ $service->icon }}</p>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4 text-slate-600">{{ $service->slug }}</td>
                        <td class="px-6 py-4 text-slate-600">{{ $service->featured ? 'Yes' : 'No' }}</td>
                        <td class="px-6 py-4 text-slate-600">{{ $service->sort_order }}</td>
                        <td class="px-6 py-4 text-right">
                            <a href="{{ route('admin.services.edit', $service) }}" class="font-medium text-slate-900">Edit</a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-6 py-10 text-center text-slate-500">No services created yet.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-6">{{ $services->links() }}</div>
</x-layouts.admin>

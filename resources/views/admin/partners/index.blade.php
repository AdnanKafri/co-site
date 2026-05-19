<x-layouts.admin title="Partners">
    <div class="mb-6 flex items-center justify-between gap-4">
        <div>
            <h2 class="text-lg font-semibold text-slate-950">Partners / Clients</h2>
            <p class="mt-1 text-sm text-slate-500">Manage logos and ordering for the homepage rail and future proof points.</p>
        </div>
        <a href="{{ route('admin.partners.create') }}" class="rounded-full bg-slate-950 px-5 py-3 text-sm font-semibold text-white transition hover:bg-slate-800">
            Add Partner
        </a>
    </div>

    <div class="overflow-hidden rounded-[2rem] bg-white shadow-sm ring-1 ring-slate-200">
        <table class="min-w-full divide-y divide-slate-200 text-sm">
            <thead class="bg-slate-50 text-left text-slate-500">
                <tr>
                    <th class="px-6 py-4">Partner</th>
                    <th class="px-6 py-4">Website</th>
                    <th class="px-6 py-4">Active</th>
                    <th class="px-6 py-4"></th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100">
                @forelse ($partners as $partner)
                    <tr>
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-4">
                                @if ($partner->logo)
                                    <img src="{{ $partner->logo->url }}" alt="{{ $partner->name }}" class="h-14 w-14 rounded-2xl object-cover">
                                @else
                                    <div class="flex h-14 w-14 items-center justify-center rounded-2xl bg-slate-100 text-xs text-slate-500">No logo</div>
                                @endif
                                <div>
                                    <p class="font-medium text-slate-900">{{ $partner->name }}</p>
                                    <p class="text-slate-500">Order {{ $partner->sort_order }}</p>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4 text-slate-600">{{ $partner->website }}</td>
                        <td class="px-6 py-4 text-slate-600">{{ $partner->is_active ? 'Yes' : 'No' }}</td>
                        <td class="px-6 py-4 text-right">
                            <a href="{{ route('admin.partners.edit', $partner) }}" class="font-medium text-slate-900">Edit</a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="px-6 py-10 text-center text-slate-500">No partners created yet.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-6">{{ $partners->links() }}</div>
</x-layouts.admin>

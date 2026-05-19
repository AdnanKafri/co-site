<x-layouts.admin title="Inquiries">
    <div class="mb-6 flex items-end justify-between gap-4">
        <div>
            <h2 class="text-lg font-semibold text-slate-950">Inquiries</h2>
            <p class="mt-1 text-sm text-slate-500">Track contact submissions and move them through a lightweight status workflow.</p>
        </div>
        <form action="{{ route('admin.inquiries.index') }}" method="GET">
            <select name="status" onchange="this.form.submit()" class="rounded-full border border-slate-200 px-4 py-3 text-sm outline-none">
                <option value="">All statuses</option>
                @foreach ($statuses as $status)
                    <option value="{{ $status }}" @selected(request('status') === $status)>{{ str($status)->headline() }}</option>
                @endforeach
            </select>
        </form>
    </div>

    <div class="overflow-hidden rounded-[2rem] bg-white shadow-sm ring-1 ring-slate-200">
        <table class="min-w-full divide-y divide-slate-200 text-sm">
            <thead class="bg-slate-50 text-left text-slate-500">
                <tr>
                    <th class="px-6 py-4">Sender</th>
                    <th class="px-6 py-4">Subject</th>
                    <th class="px-6 py-4">Status</th>
                    <th class="px-6 py-4">Received</th>
                    <th class="px-6 py-4"></th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100">
                @forelse ($inquiries as $inquiry)
                    <tr>
                        <td class="px-6 py-4">
                            <p class="font-medium text-slate-900">{{ $inquiry->name }}</p>
                            <p class="text-slate-500">{{ $inquiry->email }}</p>
                        </td>
                        <td class="px-6 py-4 text-slate-600">{{ $inquiry->subject ?: 'General inquiry' }}</td>
                        <td class="px-6 py-4 text-slate-600">{{ str($inquiry->status)->headline() }}</td>
                        <td class="px-6 py-4 text-slate-600">{{ $inquiry->created_at->format('M d, Y') }}</td>
                        <td class="px-6 py-4 text-right">
                            <a href="{{ route('admin.inquiries.show', $inquiry) }}" class="font-medium text-slate-900">View</a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-6 py-10 text-center text-slate-500">No inquiries yet.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-6">{{ $inquiries->links() }}</div>
</x-layouts.admin>

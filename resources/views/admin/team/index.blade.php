<x-layouts.admin title="Team">
    <div class="mb-6 flex items-center justify-between gap-4">
        <div>
            <h2 class="text-lg font-semibold text-slate-950">Team Members</h2>
            <p class="mt-1 text-sm text-slate-500">Manage the people shown on the About and Contact experiences.</p>
        </div>
        <a href="{{ route('admin.team.create') }}" class="rounded-full bg-slate-950 px-5 py-3 text-sm font-semibold text-white transition hover:bg-slate-800">
            Add Team Member
        </a>
    </div>

    <div class="overflow-hidden rounded-[2rem] bg-white shadow-sm ring-1 ring-slate-200">
        <table class="min-w-full divide-y divide-slate-200 text-sm">
            <thead class="bg-slate-50 text-left text-slate-500">
                <tr>
                    <th class="px-6 py-4">Member</th>
                    <th class="px-6 py-4">Role</th>
                    <th class="px-6 py-4">Active</th>
                    <th class="px-6 py-4"></th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100">
                @forelse ($teamMembers as $member)
                    <tr>
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-4">
                                @if ($member->image)
                                    <img src="{{ $member->image->url }}" alt="{{ $member->name }}" class="h-14 w-14 rounded-2xl object-cover">
                                @else
                                    <div class="flex h-14 w-14 items-center justify-center rounded-2xl bg-slate-100 text-xs text-slate-500">No image</div>
                                @endif
                                <div>
                                    <p class="font-medium text-slate-900">{{ $member->name }}</p>
                                    <p class="text-slate-500">Order {{ $member->sort_order }}</p>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4 text-slate-600">{{ $member->role }}</td>
                        <td class="px-6 py-4 text-slate-600">{{ $member->is_active ? 'Yes' : 'No' }}</td>
                        <td class="px-6 py-4 text-right">
                            <a href="{{ route('admin.team.edit', $member) }}" class="font-medium text-slate-900">Edit</a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="px-6 py-10 text-center text-slate-500">No team members created yet.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-6">{{ $teamMembers->links() }}</div>
</x-layouts.admin>

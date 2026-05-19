<x-layouts.admin title="Inquiry Details">
    <div class="grid gap-8 lg:grid-cols-[1.1fr_0.9fr]">
        <section class="rounded-[2rem] bg-white p-6 shadow-sm ring-1 ring-slate-200">
            <div class="flex flex-wrap items-center justify-between gap-4">
                <div>
                    <h2 class="text-lg font-semibold text-slate-950">{{ $inquiry->name }}</h2>
                    <p class="text-sm text-slate-500">{{ $inquiry->email }}{{ $inquiry->phone ? ' • '.$inquiry->phone : '' }}</p>
                </div>
                <p class="text-sm text-slate-500">{{ $inquiry->created_at->format('M d, Y H:i') }}</p>
            </div>

            <div class="mt-6 grid gap-4 text-sm text-slate-600 sm:grid-cols-2">
                <div>
                    <p class="font-medium text-slate-900">Company</p>
                    <p>{{ $inquiry->company ?: 'Not provided' }}</p>
                </div>
                <div>
                    <p class="font-medium text-slate-900">Subject</p>
                    <p>{{ $inquiry->subject ?: 'General inquiry' }}</p>
                </div>
            </div>

            <div class="mt-8">
                <p class="font-medium text-slate-900">Message</p>
                <div class="mt-3 rounded-[1.5rem] bg-slate-50 p-5 text-sm leading-7 text-slate-700">
                    {!! nl2br(e($inquiry->message)) !!}
                </div>
            </div>
        </section>

        <section class="rounded-[2rem] bg-white p-6 shadow-sm ring-1 ring-slate-200">
            <form action="{{ route('admin.inquiries.update', $inquiry) }}" method="POST" class="space-y-5">
                @csrf
                @method('PUT')
                <label class="block text-sm text-slate-600">
                    Status
                    <select name="status" class="mt-2 w-full rounded-2xl border border-slate-200 px-4 py-3 outline-none">
                        @foreach ($statuses as $status)
                            <option value="{{ $status }}" @selected($inquiry->status === $status)>{{ str($status)->headline() }}</option>
                        @endforeach
                    </select>
                </label>
                <label class="block text-sm text-slate-600">
                    Internal notes
                    <textarea name="notes" rows="8" class="mt-2 w-full rounded-2xl border border-slate-200 px-4 py-3 outline-none">{{ old('notes', $inquiry->notes) }}</textarea>
                </label>
                <button type="submit" class="rounded-full bg-slate-950 px-6 py-3 text-sm font-semibold text-white transition hover:bg-slate-800">
                    Save Inquiry
                </button>
            </form>
        </section>
    </div>
</x-layouts.admin>

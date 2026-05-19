<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\UpdateInquiryStatusRequest;
use App\Models\Inquiry;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class InquiryController extends Controller
{
    public function index(Request $request): View
    {
        return view('admin.inquiries.index', [
            'inquiries' => Inquiry::query()
                ->when($request->filled('status'), fn ($query) => $query->where('status', $request->string('status')))
                ->latest()
                ->paginate(20)
                ->withQueryString(),
            'statuses' => ['new', 'in_progress', 'resolved', 'archived'],
        ]);
    }

    public function show(Inquiry $inquiry): View
    {
        return view('admin.inquiries.show', [
            'inquiry' => $inquiry,
            'statuses' => ['new', 'in_progress', 'resolved', 'archived'],
        ]);
    }

    public function update(UpdateInquiryStatusRequest $request, Inquiry $inquiry): RedirectResponse
    {
        $inquiry->update($request->validated());

        return back()->with('status', 'Inquiry updated successfully.');
    }
}

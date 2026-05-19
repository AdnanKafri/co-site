<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Inquiry;
use App\Models\PageSection;
use App\Support\Seo\SeoData;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ContactController extends Controller
{
    public function show(): View
    {
        return view('pages.contact', [
            'seo' => new SeoData('Contact'),
            'sections' => PageSection::query()
                ->where('page', 'contact')
                ->where('is_active', true)
                ->orderBy('sort_order')
                ->get()
                ->keyBy('section'),
            'teamMembers' => \App\Models\TeamMember::query()->with('image')->where('is_active', true)->orderBy('sort_order')->take(3)->get(),
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
            'phone' => ['nullable', 'string', 'max:255'],
            'company' => ['nullable', 'string', 'max:255'],
            'subject' => ['nullable', 'string', 'max:255'],
            'message' => ['required', 'string'],
        ]);

        Inquiry::query()->create($data);

        return back()->with('status', 'Your message has been sent.');
    }
}

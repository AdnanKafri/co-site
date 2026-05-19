<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\PartnerRequest;
use App\Models\Partner;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class PartnerController extends Controller
{
    public function index(): View
    {
        return view('admin.partners.index', [
            'partners' => Partner::query()->with('logo')->orderBy('sort_order')->paginate(20),
        ]);
    }

    public function create(): View
    {
        return view('admin.partners.create', [
            'partner' => new Partner([
                'is_active' => true,
                'sort_order' => Partner::query()->max('sort_order') + 1,
            ]),
        ]);
    }

    public function store(PartnerRequest $request): RedirectResponse
    {
        $partner = Partner::query()->create($this->payload($request));

        return redirect()->route('admin.partners.edit', $partner)->with('status', 'Partner created successfully.');
    }

    public function edit(Partner $partner): View
    {
        return view('admin.partners.edit', compact('partner'));
    }

    public function update(PartnerRequest $request, Partner $partner): RedirectResponse
    {
        $partner->update($this->payload($request));

        return back()->with('status', 'Partner updated successfully.');
    }

    public function destroy(Partner $partner): RedirectResponse
    {
        $partner->delete();

        return redirect()->route('admin.partners.index')->with('status', 'Partner deleted successfully.');
    }

    protected function payload(PartnerRequest $request): array
    {
        $data = $request->validated();
        $data['is_active'] = $request->boolean('is_active');

        return $data;
    }
}

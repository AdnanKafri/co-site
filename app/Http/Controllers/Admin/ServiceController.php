<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ServiceRequest;
use App\Models\Service;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Str;
use Illuminate\View\View;

class ServiceController extends Controller
{
    public function index(): View
    {
        return view('admin.services.index', [
            'services' => Service::query()->with('image')->orderBy('sort_order')->paginate(20),
        ]);
    }

    public function create(): View
    {
        return view('admin.services.create', [
            'service' => new Service([
                'featured' => false,
                'sort_order' => Service::query()->max('sort_order') + 1,
            ]),
        ]);
    }

    public function store(ServiceRequest $request): RedirectResponse
    {
        $service = Service::query()->create($this->payload($request));

        return redirect()->route('admin.services.edit', $service)->with('status', 'Service created successfully.');
    }

    public function edit(Service $service): View
    {
        return view('admin.services.edit', compact('service'));
    }

    public function update(ServiceRequest $request, Service $service): RedirectResponse
    {
        $service->update($this->payload($request));

        return back()->with('status', 'Service updated successfully.');
    }

    public function destroy(Service $service): RedirectResponse
    {
        $service->delete();

        return redirect()->route('admin.services.index')->with('status', 'Service deleted successfully.');
    }

    protected function payload(ServiceRequest $request): array
    {
        $data = $request->validated();
        $data['featured'] = $request->boolean('featured');
        $data['sort_order'] = $data['sort_order'] ?? 0;
        $data['slug'] = Str::slug($data['slug']);

        return $data;
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreMediaRequest;
use App\Models\Media;
use App\Services\Media\MediaUploader;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class MediaController extends Controller
{
    public function __construct(protected MediaUploader $uploader)
    {
    }

    public function index(Request $request): View
    {
        $media = Media::query()
            ->when($request->string('search')->isNotEmpty(), function ($query) use ($request) {
                $query->where(function ($subquery) use ($request): void {
                    $term = '%'.$request->string('search')->value().'%';

                    $subquery
                        ->where('original_name', 'like', $term)
                        ->orWhere('title', 'like', $term)
                        ->orWhere('alt_text', 'like', $term);
                });
            })
            ->latest()
            ->paginate(24)
            ->withQueryString();

        return view('admin.media.index', compact('media'));
    }

    public function store(StoreMediaRequest $request): RedirectResponse
    {
        $this->uploader->upload(
            $request->file('file'),
            $request->validated('directory') ?: 'general',
            $request->user()?->id
        );

        return back()->with('status', 'Media uploaded successfully.');
    }

    public function browser(Request $request): JsonResponse
    {
        $media = Media::query()
            ->when($request->string('search')->isNotEmpty(), function ($query) use ($request) {
                $term = '%'.$request->string('search')->value().'%';

                $query->where(function ($subquery) use ($term): void {
                    $subquery
                        ->where('original_name', 'like', $term)
                        ->orWhere('title', 'like', $term)
                        ->orWhere('alt_text', 'like', $term);
                });
            })
            ->latest()
            ->limit(36)
            ->get()
            ->map(fn (Media $item) => [
                'id' => $item->id,
                'url' => $item->url,
                'name' => $item->original_name,
                'mime_type' => $item->mime_type,
                'size' => $item->size,
                'width' => $item->width,
                'height' => $item->height,
            ]);

        return response()->json([
            'data' => $media,
        ]);
    }
}

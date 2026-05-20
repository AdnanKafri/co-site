<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Media;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\StreamedResponse;

class MediaController extends Controller
{
    public function show(Media $media): StreamedResponse|Response
    {
        if ($media->exists()) {
            return Storage::disk($media->disk)->response(
                $media->path,
                $media->original_name,
                [
                    'Cache-Control' => 'public, max-age=86400',
                ]
            );
        }

        if ($media->is_image) {
            return response($this->placeholderSvg($media), 200, [
                'Content-Type' => 'image/svg+xml',
                'Cache-Control' => 'public, max-age=3600',
            ]);
        }

        abort(404);
    }

    protected function placeholderSvg(Media $media): string
    {
        $label = e($media->title ?: $media->original_name ?: 'Media');
        $subtitle = e($media->mime_type ?: 'image asset');

        return <<<SVG
<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1600 1000" role="img" aria-label="Missing media placeholder">
  <defs>
    <linearGradient id="bg" x1="0%" y1="0%" x2="100%" y2="100%">
      <stop offset="0%" stop-color="#0b1020"/>
      <stop offset="55%" stop-color="#16294f"/>
      <stop offset="100%" stop-color="#08213b"/>
    </linearGradient>
  </defs>
  <rect width="1600" height="1000" fill="url(#bg)"/>
  <circle cx="1220" cy="180" r="180" fill="#2f66d0" opacity="0.22"/>
  <circle cx="260" cy="820" r="220" fill="#19b7a7" opacity="0.14"/>
  <rect x="250" y="220" width="1100" height="560" rx="42" fill="rgba(255,255,255,0.06)" stroke="rgba(255,255,255,0.12)"/>
  <text x="800" y="430" fill="#f8fafc" text-anchor="middle" font-family="Arial, sans-serif" font-size="68" font-weight="700">Preview unavailable</text>
  <text x="800" y="520" fill="#cbd5e1" text-anchor="middle" font-family="Arial, sans-serif" font-size="34">{$label}</text>
  <text x="800" y="585" fill="#94a3b8" text-anchor="middle" font-family="Arial, sans-serif" font-size="24">{$subtitle}</text>
</svg>
SVG;
    }
}

<?php

namespace App\Services\Media;

use App\Models\Media;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class MediaUploader
{
    public function upload(UploadedFile $file, string $directory = 'general', ?int $uploadedBy = null): Media
    {
        $filename = Str::uuid()->toString().'.'.$file->getClientOriginalExtension();
        $path = $file->storeAs($directory, $filename, 'public');
        $metadata = @getimagesize(Storage::disk('public')->path($path)) ?: null;

        return Media::query()->create([
            'disk' => 'public',
            'directory' => trim($directory, '/'),
            'filename' => basename($path),
            'original_name' => $file->getClientOriginalName(),
            'mime_type' => $file->getMimeType() ?? $file->getClientMimeType(),
            'extension' => $file->getClientOriginalExtension(),
            'size' => $file->getSize(),
            'width' => Arr::get($metadata, 0),
            'height' => Arr::get($metadata, 1),
            'uploaded_by' => $uploadedBy,
        ]);
    }
}

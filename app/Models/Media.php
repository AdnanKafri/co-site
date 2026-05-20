<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class Media extends Model
{
    protected $table = 'media';

    protected $fillable = [
        'disk',
        'directory',
        'filename',
        'original_name',
        'mime_type',
        'extension',
        'size',
        'title',
        'alt_text',
        'width',
        'height',
        'uploaded_by',
    ];

    protected $appends = [
        'url',
        'path',
        'is_image',
    ];

    public function uploader(): BelongsTo
    {
        return $this->belongsTo(User::class, 'uploaded_by');
    }

    public function getPathAttribute(): string
    {
        return trim(implode('/', array_filter([$this->directory, $this->filename])), '/');
    }

    public function getUrlAttribute(): string
    {
        return route('media.show', [
            'media' => $this->getKey(),
            'filename' => $this->presentableFilename(),
        ], false);
    }

    public function getIsImageAttribute(): bool
    {
        return str_starts_with((string) $this->mime_type, 'image/');
    }

    public function exists(): bool
    {
        return $this->path !== '' && Storage::disk($this->disk)->exists($this->path);
    }

    public function presentableFilename(): string
    {
        $name = pathinfo($this->original_name ?: $this->filename, PATHINFO_FILENAME);
        $extension = $this->extension ?: pathinfo($this->filename, PATHINFO_EXTENSION);

        return trim(Str::slug($name).($extension ? '.'.$extension : ''), '.');
    }
}

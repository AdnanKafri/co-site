<?php

namespace App\Support\Seo;

class SeoData
{
    public function __construct(
        public readonly string $title,
        public readonly ?string $description = null,
        public readonly ?string $image = null,
    ) {
    }
}

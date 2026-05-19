<?php

namespace Database\Seeders;

use App\Models\Media;
use App\Models\PageSection;
use App\Models\Setting;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

class SiteSettingsSeeder extends Seeder
{
    public function run(): void
    {
        $logoMediaId = $this->importLogo();

        foreach ([
            'general.company_name' => 'PressnGo',
            'general.email' => 'hello@pressngo.test',
            'general.phone' => '+966 000 000 000',
            'general.address' => 'Riyadh, Saudi Arabia',
            'general.brand_primary' => '#2f66d0',
            'general.brand_secondary' => '#19b7a7',
            'general.logo_media_id' => $logoMediaId,
            'seo.default_title' => 'PressnGo',
            'seo.default_description' => 'A modern company platform with a premium frontend and lightweight content management workflow.',
            'seo.default_og_image_media_id' => $logoMediaId,
        ] as $key => $value) {
            Setting::query()->updateOrCreate(
                ['key' => $key],
                ['group' => str($key)->before('.')->value(), 'value' => ['value' => $value]]
            );
        }

        $this->seedHomepageSections();
    }

    protected function importLogo(): ?int
    {
        $source = public_path('logoV1.png');
        $destination = storage_path('app/public/settings/logo-v1.png');

        if (! File::exists($source)) {
            return null;
        }

        if (! File::exists($destination)) {
            File::ensureDirectoryExists(dirname($destination));
            File::copy($source, $destination);
        }

        $size = File::size($destination);
        $dimensions = @getimagesize($destination) ?: null;

        $media = Media::query()->updateOrCreate(
            [
                'directory' => 'settings',
                'filename' => 'logo-v1.png',
            ],
            [
                'disk' => 'public',
                'original_name' => 'logoV1.png',
                'mime_type' => 'image/png',
                'extension' => 'png',
                'size' => $size,
                'title' => 'PressnGo Logo',
                'alt_text' => 'PressnGo logo',
                'width' => $dimensions[0] ?? null,
                'height' => $dimensions[1] ?? null,
            ]
        );

        return $media->id;
    }

    protected function seedHomepageSections(): void
    {
        $defaults = [
            'hero' => [
                'badge' => 'Curated Digital Presence',
                'title' => 'A premium company platform built for credibility, speed, and clear storytelling.',
                'body' => 'PressnGo combines intentional design with a lightweight admin workflow, giving the business a polished site without generic CMS sprawl.',
                'primary_label' => 'Explore Services',
                'primary_url' => '/services',
                'secondary_label' => 'Start a Project',
                'secondary_url' => '/contact',
            ],
            'features' => [
                'eyebrow' => 'Why PressnGo',
                'title' => 'A business-ready platform that stays clean under real-world use.',
                'items' => [
                    ['title' => 'Curated structure', 'body' => 'Developers keep the layout intentional while the business updates meaningful content.'],
                    ['title' => 'Centralized media', 'body' => 'Assets are uploaded once and reused across services, projects, team, and settings.'],
                    ['title' => 'Production simplicity', 'body' => 'Laravel, Blade, Tailwind, and Alpine keep the stack fast, stable, and maintainable.'],
                ],
            ],
            'cta' => [
                'title' => 'Ready to shape a stronger digital presence?',
                'body' => 'Use the admin workflow to manage content confidently while the frontend stays cohesive and premium.',
                'button_label' => 'Contact Us',
                'button_url' => '/contact',
            ],
            'partners_rail' => [
                'title' => 'Trusted by growing brands and ambitious teams.',
                'body' => 'Partner logos are managed from one central library and rendered in a curated homepage rail.',
            ],
        ];

        foreach ($defaults as $section => $data) {
            PageSection::query()->updateOrCreate(
                ['page' => 'home', 'section' => $section],
                ['data' => $data, 'is_active' => true, 'sort_order' => match ($section) {
                    'hero' => 10,
                    'features' => 20,
                    'cta' => 30,
                    'partners_rail' => 40,
                }]
            );
        }
    }
}

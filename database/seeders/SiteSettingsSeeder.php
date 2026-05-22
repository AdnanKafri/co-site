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
                'badge' => 'Software & Digital Transformation',
                'title' => 'We build premium digital platforms that help modern companies communicate, operate, and grow with clarity.',
                'body' => 'PressnGo designs Laravel-powered web platforms, internal systems, and brand-aware digital experiences for teams that need more than a brochure site.',
                'primary_label' => 'Explore Capabilities',
                'primary_url' => '/services',
                'secondary_label' => 'Talk to Us',
                'secondary_url' => '/contact',
            ],
            'features' => [
                'eyebrow' => 'What makes it work',
                'title' => 'A company site should feel like a strategic product, not an assembled template.',
                'items' => [
                    ['title' => 'Software-minded architecture', 'body' => 'We structure the site around real business workflows, not a generic CMS surface.'],
                    ['title' => 'Brand-aware presentation', 'body' => 'Every page balances clear information, premium composition, and a strong visual identity.'],
                    ['title' => 'Reusable content operations', 'body' => 'Media, sections, and content stay centralized so the team can move quickly without compromising quality.'],
                ],
            ],
            'cta' => [
                'title' => 'If the business is evolving, the platform should keep up.',
                'body' => 'We help companies translate strategy into a polished digital experience that supports sales, operations, and long-term growth.',
                'button_label' => 'Book a Discovery Call',
                'button_url' => '/contact',
            ],
            'partners_rail' => [
                'title' => 'Trusted by teams modernizing how they present, operate, and scale.',
                'body' => 'Client and partner marks are managed through the same centralized media workflow as the rest of the platform.',
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

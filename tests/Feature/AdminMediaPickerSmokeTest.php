<?php

namespace Tests\Feature;

use App\Models\Media;
use App\Models\PageSection;
use App\Models\Partner;
use App\Models\Project;
use App\Models\Service;
use App\Models\Setting;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class AdminMediaPickerSmokeTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_pages_render_with_media_picker(): void
    {
        Storage::disk('public')->put('tests/admin-media.png', base64_decode(
            'iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAQAAAC1HAwCAAAAC0lEQVR42mP8/x8AAwMCAO+/2WkAAAAASUVORK5CYII='
        ));

        $admin = User::factory()->create([
            'is_admin' => true,
        ]);

        $singleImage = Media::query()->create([
            'disk' => 'public',
            'directory' => 'tests',
            'filename' => 'admin-media.png',
            'original_name' => 'admin-media.png',
            'mime_type' => 'image/png',
            'extension' => 'png',
            'size' => 68,
            'title' => 'Admin media',
            'alt_text' => 'Admin media preview',
            'uploaded_by' => $admin->id,
        ]);

        $galleryImage = Media::query()->create([
            'disk' => 'public',
            'directory' => 'tests',
            'filename' => 'admin-media-gallery.png',
            'original_name' => 'admin-media-gallery.png',
            'mime_type' => 'image/png',
            'extension' => 'png',
            'size' => 68,
            'title' => 'Gallery media',
            'alt_text' => 'Gallery media preview',
            'uploaded_by' => $admin->id,
        ]);

        Setting::query()->create([
            'group' => 'general',
            'key' => 'general.logo_media_id',
            'value' => ['value' => $singleImage->id],
        ]);

        Setting::query()->create([
            'group' => 'seo',
            'key' => 'seo.default_og_image_media_id',
            'value' => ['value' => $singleImage->id],
        ]);

        PageSection::query()->create([
            'page' => 'home',
            'section' => 'hero',
            'data' => [
                'badge' => 'Curated Digital Presence',
                'title' => 'A premium platform',
                'body' => 'A structured homepage with a selected hero image.',
                'media_id' => $singleImage->id,
            ],
            'is_active' => true,
            'sort_order' => 10,
        ]);

        $service = Service::query()->create([
            'title' => 'Brand Strategy',
            'slug' => 'brand-strategy',
            'excerpt' => 'A concise service excerpt.',
            'description' => 'A longer service description.',
            'image_media_id' => $singleImage->id,
            'icon' => 'Strategy',
            'featured' => true,
            'sort_order' => 1,
        ]);

        $project = Project::query()->create([
            'title' => 'Portfolio Launch',
            'slug' => 'portfolio-launch',
            'client' => 'Acme Co.',
            'category' => 'Launch',
            'description' => 'Case study body.',
            'technologies' => ['Laravel', 'Blade'],
            'cover_media_id' => $singleImage->id,
            'featured' => true,
            'external_link' => null,
            'completed_at' => now()->toDateString(),
        ]);

        $project->gallery()->attach($galleryImage->id, ['sort_order' => 1]);

        $partner = Partner::query()->create([
            'name' => 'Northstar',
            'website' => 'https://example.com',
            'logo_media_id' => $singleImage->id,
            'sort_order' => 1,
        ]);

        $this->actingAs($admin);

        $this->get(route('admin.settings.edit'))
            ->assertOk()
            ->assertSee('Website logo')
            ->assertSee('Choose Media')
            ->assertSee('admin-media.png');

        $this->get(route('admin.homepage.edit'))
            ->assertOk()
            ->assertSee('Hero')
            ->assertSee('Choose Media')
            ->assertSee('admin-media.png');

        $this->get(route('admin.services.create'))
            ->assertOk()
            ->assertSee('Service image')
            ->assertSee('No media selected yet.');

        $this->get(route('admin.services.edit', $service))
            ->assertOk()
            ->assertSee('Service image')
            ->assertSee('admin-media.png')
            ->assertSee('Media Library');

        $this->get(route('admin.projects.create'))
            ->assertOk()
            ->assertSee('Cover image')
            ->assertSee('Project gallery');

        $this->get(route('admin.projects.edit', $project))
            ->assertOk()
            ->assertSee('Project gallery')
            ->assertSee('admin-media-gallery.png');

        $this->get(route('admin.partners.edit', $partner))
            ->assertOk()
            ->assertSee('Partner logo')
            ->assertSee('admin-media.png');

        $this->get(route('admin.team.create'))
            ->assertOk()
            ->assertSee('Profile image');
    }
}

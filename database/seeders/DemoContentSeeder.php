<?php

namespace Database\Seeders;

use App\Models\Inquiry;
use App\Models\Media;
use App\Models\PageSection;
use App\Models\Partner;
use App\Models\Project;
use App\Models\Service;
use App\Models\Setting;
use App\Models\TeamMember;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class DemoContentSeeder extends Seeder
{
    protected array $media = [];

    public function run(): void
    {
        $this->seedMediaAssets();
        $this->seedSettings();
        $this->seedPageSections();
        $this->seedServices();
        $this->seedProjects();
        $this->seedTeam();
        $this->seedPartners();
        $this->seedInquiries();
    }

    protected function seedMediaAssets(): void
    {
        $this->media['hero'] = $this->storeSvg('demo', 'hero-signal-ecosystem.svg', 'Hero Signal Ecosystem', 'Hero artwork for the company platform', $this->artworkSvg('Digital Transformation Platform', 'Premium software, internal systems, and branded digital experiences.', '#071221', '#2454cb', '#39c9ff'));
        $this->media['cta'] = $this->storeSvg('demo', 'cta-system-rhythm.svg', 'CTA System Rhythm', 'Atmospheric abstract CTA artwork', $this->artworkSvg('Operational Momentum', 'Designed code, editorial pacing, and premium structure aligned into one experience.', '#0a1326', '#183f82', '#13b9a9'));
        $this->media['favicon'] = $this->storeSvg('settings', 'pressngo-favicon.svg', 'PressnGo Favicon', 'PressnGo favicon mark', $this->faviconSvg());

        foreach ([
            ['slug' => 'digital-transformation', 'title' => 'Digital Transformation', 'base' => '#0b1222', 'accent' => '#2b66db', 'highlight' => '#85e3ff'],
            ['slug' => 'custom-web-platforms', 'title' => 'Custom Web Platforms', 'base' => '#0f2749', 'accent' => '#21a0d8', 'highlight' => '#51d3ff'],
            ['slug' => 'automation-systems', 'title' => 'Automation Systems', 'base' => '#112b52', 'accent' => '#166ac3', 'highlight' => '#7de8f3'],
            ['slug' => 'ux-engineering', 'title' => 'UX Engineering', 'base' => '#173664', 'accent' => '#1c3f9f', 'highlight' => '#d07eff'],
        ] as $item) {
            $this->media['service_'.$item['slug']] = $this->storeSvg('services', $item['slug'].'.svg', $item['title'], $item['title'].' artwork', $this->artworkSvg($item['title'], 'A premium service visual for '.$item['title'].'.', $item['base'], $item['accent'], $item['highlight']));
        }

        foreach ([
            ['slug' => 'northstar-mobility', 'title' => 'Northstar Mobility', 'base' => '#071421', 'accent' => '#31a3ff', 'highlight' => '#19c5af'],
            ['slug' => 'aureline-cloud', 'title' => 'Aureline Cloud', 'base' => '#0d1328', 'accent' => '#675dff', 'highlight' => '#7fd7ff'],
            ['slug' => 'fathom-health', 'title' => 'Fathom Health Systems', 'base' => '#081423', 'accent' => '#2e6eff', 'highlight' => '#ff6ea8'],
        ] as $item) {
            $this->media['project_'.$item['slug']] = $this->storeSvg('projects', $item['slug'].'-cover.svg', $item['title'].' Cover', $item['title'].' project cover', $this->artworkSvg($item['title'], 'Case study visual crafted for '.$item['title'].'.', $item['base'], $item['accent'], $item['highlight']));

            foreach (range(1, 3) as $galleryIndex) {
                $this->media['project_'.$item['slug'].'_gallery_'.$galleryIndex] = $this->storeSvg('projects', $item['slug'].'-gallery-'.$galleryIndex.'.svg', $item['title'].' Gallery '.$galleryIndex, $item['title'].' gallery image '.$galleryIndex, $this->detailArtworkSvg($item['title'], $galleryIndex));
            }
        }

        foreach ([
            ['slug' => 'layla-haddad', 'name' => 'Layla Haddad', 'role' => 'Design Director', 'base' => '#0d1833', 'accent' => '#2f66d0', 'highlight' => '#8de9ff'],
            ['slug' => 'omar-khaled', 'name' => 'Omar Khaled', 'role' => 'Engineering Lead', 'base' => '#10182d', 'accent' => '#197dbf', 'highlight' => '#5bd7c7'],
            ['slug' => 'nora-farouk', 'name' => 'Nora Farouk', 'role' => 'Product Strategy Lead', 'base' => '#111b30', 'accent' => '#6e5fe9', 'highlight' => '#f58cff'],
        ] as $item) {
            $this->media['team_'.$item['slug']] = $this->storeSvg('team', $item['slug'].'.svg', $item['name'], $item['name'].' portrait', $this->portraitSvg($item['name'], $item['role'], $item['base'], $item['accent'], $item['highlight']));
        }

        foreach (['Northstar Mobility', 'Aureline Cloud', 'Fathom Health Systems', 'Sable Energy Group', 'Meridian Labs', 'Vector Systems'] as $index => $partner) {
            $slug = Str::slug($partner);
            $colors = ['#b6f5ff', '#f7f9ff', '#9be7ff', '#f0ebff', '#dcfdff', '#c9e8ff'];
            $this->media['partner_'.$slug] = $this->storeSvg('partners', $slug.'.svg', $partner, $partner.' logo', $this->wordmarkSvg($partner, $colors[$index % count($colors)]));
        }
    }

    protected function seedSettings(): void
    {
        foreach ([
            'general.company_name' => 'PressnGo',
            'general.email' => 'hello@pressngo.studio',
            'general.phone' => '+966 11 560 3024',
            'general.address' => 'Riyadh Front, Business District, Riyadh',
            'general.brand_primary' => '#2f66d0',
            'general.brand_secondary' => '#19b7a7',
            'general.maps_embed' => 'Riyadh Front Business District, Riyadh, Saudi Arabia',
            'general.favicon_media_id' => $this->media['favicon']->id,
            'seo.default_title' => 'PressnGo | Premium Software & Digital Platforms',
            'seo.default_description' => 'PressnGo designs premium software platforms, digital transformation websites, and UX-focused systems for modern companies.',
            'seo.default_og_image_media_id' => $this->media['hero']->id,
            'social.linkedin' => 'https://www.linkedin.com/company/pressngo-studio',
            'social.instagram' => 'https://www.instagram.com/pressngo.studio',
            'social.x' => 'https://x.com/pressngostudio',
        ] as $key => $value) {
            Setting::query()->updateOrCreate(
                ['key' => $key],
                ['group' => str($key)->before('.')->value(), 'value' => ['value' => $value]]
            );
        }
    }

    protected function seedPageSections(): void
    {
        foreach ([
            'hero' => [
                'badge' => 'Software & Digital Transformation',
                'title' => 'We build premium digital platforms that help modern companies communicate, operate, and grow with clarity.',
                'body' => 'PressnGo designs Laravel-powered web platforms, internal systems, and brand-aware digital experiences for teams that need more than a brochure site. The result is a cohesive company presence with stronger storytelling, cleaner operations, and a premium visual language.',
                'primary_label' => 'Explore Capabilities',
                'primary_url' => '/services',
                'secondary_label' => 'Talk to Us',
                'secondary_url' => '/contact',
                'media_id' => $this->media['hero']->id,
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
                'media_id' => $this->media['cta']->id,
            ],
            'partners_rail' => [
                'title' => 'Trusted by teams modernizing how they present, operate, and scale.',
                'body' => 'Client and partner marks are managed through the same centralized media workflow as the rest of the platform, keeping the presentation cohesive and reusable.',
            ],
        ] as $section => $data) {
            PageSection::query()->updateOrCreate(
                ['page' => 'home', 'section' => $section],
                ['data' => $data, 'is_active' => true, 'sort_order' => match ($section) {
                    'hero' => 10, 'features' => 20, 'cta' => 30, 'partners_rail' => 40,
                }]
            );
        }

        foreach ([
            'story' => ['body' => 'PressnGo was shaped around a simple observation: many company websites are either visually polished but operationally rigid, or flexible enough to edit but too generic to feel like a real brand. We built the middle path. A curated digital platform with premium presentation, stronger storytelling, and a lightweight operating model the team can maintain with confidence.'],
            'mission' => ['body' => 'Give modern companies a premium digital foundation that improves trust, communicates capability clearly, and supports the work happening inside the business.'],
            'vision' => ['body' => 'Set a higher standard for company websites by treating them as long-term software and brand systems rather than disposable launch assets.'],
            'values' => ['items' => [
                ['title' => 'Intentionality', 'body' => 'Every section, transition, and visual motif should support the company story.'],
                ['title' => 'Clarity', 'body' => 'The message, hierarchy, and interface design should reinforce one another.'],
                ['title' => 'Maintainability', 'body' => 'A premium frontend should stay lightweight enough for real internal teams to use confidently.'],
            ]],
            'stats' => ['items' => [
                ['label' => 'Digital platforms launched', 'value' => '28+'],
                ['label' => 'Internal systems simplified', 'value' => '14'],
                ['label' => 'Average launch cycle', 'value' => '6 weeks'],
            ]],
        ] as $section => $data) {
            PageSection::query()->updateOrCreate(
                ['page' => 'about', 'section' => $section],
                ['data' => $data, 'is_active' => true, 'sort_order' => match ($section) {
                    'story' => 10, 'mission' => 20, 'vision' => 30, 'values' => 40, 'stats' => 50, default => 60,
                }]
            );
        }

        foreach ([
            'intro' => ['title' => 'Bring the next version of your digital presence into focus.', 'body' => 'Whether you need a full rebuild, a custom platform, or a cleaner content system, we can shape the right next move together.'],
            'details' => ['headline' => 'Direct contact', 'body' => 'Share the context, the current friction, and where the platform needs to go next. We respond with practical direction and a realistic path forward.'],
            'cta' => ['title' => 'Prefer a strategy session before a build?', 'body' => 'We also run architecture, positioning, and narrative sessions for teams that need clarity before implementation.'],
        ] as $section => $data) {
            PageSection::query()->updateOrCreate(
                ['page' => 'contact', 'section' => $section],
                ['data' => $data, 'is_active' => true, 'sort_order' => match ($section) {
                    'intro' => 10, 'details' => 20, 'cta' => 30,
                }]
            );
        }
    }

    protected function seedServices(): void
    {
        Service::query()->delete();

        foreach ([
            [
                'title' => 'Digital Product Strategy',
                'slug' => 'digital-product-strategy',
                'excerpt' => 'Align positioning, scope, and content structure before design or development begins.',
                'description' => "We define the product and platform direction before the interface takes shape.\n\nThis service is focused on discovery, audience clarity, information structure, and the practical decisions that make a launch feel coherent. It is ideal for teams that need more than design polish and want the website to support real business goals.",
                'image_media_id' => $this->media['service_digital-transformation']->id,
                'icon' => 'Strategy',
                'featured' => true,
                'sort_order' => 10,
            ],
            [
                'title' => 'Custom Web Applications',
                'slug' => 'custom-web-applications',
                'excerpt' => 'Build branded web applications, portals, and business tools tailored to the way your team actually works.',
                'description' => "This service covers custom Laravel application design for teams that need more than a marketing website.\n\nWe create dashboards, portals, client-facing experiences, and internal tools with clean architecture, smooth interactions, and a premium UI that still feels practical under daily use.",
                'image_media_id' => $this->media['service_custom-web-platforms']->id,
                'icon' => 'Apps',
                'featured' => true,
                'sort_order' => 20,
            ],
            [
                'title' => 'Website & Digital Experience Design',
                'slug' => 'website-digital-experience-design',
                'excerpt' => 'Create cinematic company websites that feel modern, premium, and clearly tied to the brand.',
                'description' => "We design public-facing websites that feel intentional from the first scroll.\n\nThe work balances typography, rhythm, section composition, and responsive behavior so the platform becomes a trustworthy brand surface rather than a generic layout with content plugged into it.",
                'image_media_id' => $this->media['service_ux-engineering']->id,
                'icon' => 'Web',
                'featured' => true,
                'sort_order' => 30,
            ],
            [
                'title' => 'Automation & Internal Systems',
                'slug' => 'automation-internal-systems',
                'excerpt' => 'Streamline repetitive operations with lightweight systems that reduce manual work and improve clarity.',
                'description' => "Many teams grow faster than their workflows.\n\nWe design practical automation and internal tools that reduce repetitive tasks, improve handoff clarity, and support the business behind the scenes without turning the stack into a bloated product suite.",
                'image_media_id' => $this->media['service_automation-systems']->id,
                'icon' => 'Ops',
                'featured' => false,
                'sort_order' => 40,
            ],
        ] as $service) {
            Service::query()->create($service);
        }
    }

    protected function seedProjects(): void
    {
        DB::table('project_media')->truncate();
        Project::query()->delete();

        foreach ([
            [
                'title' => 'Northstar Mobility Platform',
                'slug' => 'northstar-mobility',
                'client' => 'Northstar Mobility',
                'category' => 'Mobility Platform',
                'description' => "Northstar needed a platform that could support partnerships, hiring, and product storytelling in one cohesive surface.\n\nWe rebuilt the site around a stronger brand narrative, a cleaner information architecture, and a more premium editorial rhythm that matched the maturity of the product direction.",
                'technologies' => ['Laravel', 'Blade', 'Tailwind CSS', 'Alpine.js', 'MySQL'],
                'cover_media_id' => $this->media['project_northstar-mobility']->id,
                'featured' => true,
                'external_link' => 'https://northstar.example',
                'completed_at' => now()->subMonths(5)->toDateString(),
                'gallery_keys' => ['project_northstar-mobility_gallery_1', 'project_northstar-mobility_gallery_2', 'project_northstar-mobility_gallery_3'],
            ],
            [
                'title' => 'Aureline Cloud Experience',
                'slug' => 'aureline-cloud',
                'client' => 'Aureline Cloud',
                'category' => 'Infrastructure Brand',
                'description' => "Aureline needed a more credible presence for enterprise conversations.\n\nThe solution combined a refined visual language, stronger proof points, and a clean editorial structure that made the technical offering easier to understand without reducing its sophistication.",
                'technologies' => ['Laravel', 'MySQL', 'Tailwind CSS', 'Blade'],
                'cover_media_id' => $this->media['project_aureline-cloud']->id,
                'featured' => true,
                'external_link' => 'https://aureline.example',
                'completed_at' => now()->subMonths(3)->toDateString(),
                'gallery_keys' => ['project_aureline-cloud_gallery_1', 'project_aureline-cloud_gallery_2', 'project_aureline-cloud_gallery_3'],
            ],
            [
                'title' => 'Fathom Health Systems Portal',
                'slug' => 'fathom-health-systems',
                'client' => 'Fathom Health Systems',
                'category' => 'Healthcare Systems',
                'description' => "Fathom needed a digital presence that could speak to operational teams, clinical stakeholders, and partners without feeling fragmented.\n\nWe structured the site around clarity, trust, and a clean systems narrative so the platform could support both external communication and internal coordination.",
                'technologies' => ['Laravel', 'Blade', 'Tailwind CSS', 'Content Strategy'],
                'cover_media_id' => $this->media['project_fathom-health']->id,
                'featured' => false,
                'external_link' => 'https://fathom.example',
                'completed_at' => now()->subMonths(2)->toDateString(),
                'gallery_keys' => ['project_fathom-health_gallery_1', 'project_fathom-health_gallery_2', 'project_fathom-health_gallery_3'],
            ],
        ] as $payload) {
            $galleryKeys = $payload['gallery_keys'];
            unset($payload['gallery_keys']);

            $project = Project::query()->create($payload);

            $project->gallery()->sync(
                collect($galleryKeys)->values()->mapWithKeys(fn ($key, $index) => [$this->media[$key]->id => ['sort_order' => $index]])->all()
            );
        }
    }

    protected function seedTeam(): void
    {
        TeamMember::query()->delete();

        foreach ([
            [
                'name' => 'Layla Haddad',
                'role' => 'Design Director',
                'image_media_id' => $this->media['team_layla-haddad']->id,
                'bio' => 'Leads visual systems, editorial composition, and brand atmosphere so each launch feels directed, premium, and easy to trust.',
                'social_links' => ['linkedin' => 'https://linkedin.com/in/laylahaddad'],
                'sort_order' => 10,
                'is_active' => true,
            ],
            [
                'name' => 'Omar Khaled',
                'role' => 'Engineering Lead',
                'image_media_id' => $this->media['team_omar-khaled']->id,
                'bio' => 'Shapes Laravel architecture, content model discipline, and implementation patterns that keep the platform fast, stable, and maintainable.',
                'social_links' => ['linkedin' => 'https://linkedin.com/in/omarkhaled'],
                'sort_order' => 20,
                'is_active' => true,
            ],
            [
                'name' => 'Nora Farouk',
                'role' => 'Product Strategy Lead',
                'image_media_id' => $this->media['team_nora-farouk']->id,
                'bio' => 'Translates company narrative into maintainable section logic, content governance, and workflows teams can sustain long after launch.',
                'social_links' => ['linkedin' => 'https://linkedin.com/in/norafarouk'],
                'sort_order' => 30,
                'is_active' => true,
            ],
        ] as $member) {
            TeamMember::query()->create($member);
        }
    }

    protected function seedPartners(): void
    {
        Partner::query()->delete();

        foreach ([
            ['name' => 'Northstar Mobility', 'website' => 'https://northstar.example'],
            ['name' => 'Aureline Cloud', 'website' => 'https://aureline.example'],
            ['name' => 'Fathom Health Systems', 'website' => 'https://fathom.example'],
            ['name' => 'Sable Energy Group', 'website' => 'https://sable.example'],
            ['name' => 'Meridian Labs', 'website' => 'https://meridian.example'],
            ['name' => 'Vector Systems', 'website' => 'https://vector.example'],
        ] as $index => $partner) {
            $slug = Str::slug($partner['name']);

            Partner::query()->create([
                'name' => $partner['name'],
                'logo_media_id' => $this->media['partner_'.$slug]->id,
                'website' => $partner['website'],
                'sort_order' => ($index + 1) * 10,
                'is_active' => true,
            ]);
        }
    }

    protected function seedInquiries(): void
    {
        Inquiry::query()->delete();

        foreach ([
            [
                'name' => 'Amal Rahman',
                'email' => 'amal@northstar.example',
                'phone' => '+966 50 221 9087',
                'company' => 'Northstar Mobility',
                'subject' => 'Digital platform rebuild for launch phase',
                'message' => 'We are preparing for a regional rollout and need the website to reflect product maturity, partner trust, and a stronger brand system before the next quarter.',
                'status' => 'new',
            ],
            [
                'name' => 'Daniel Ross',
                'email' => 'daniel@meridian.example',
                'phone' => '+971 55 101 2288',
                'company' => 'Meridian Labs',
                'subject' => 'Discovery workshop for internal systems',
                'message' => 'We need help clarifying our website narrative and simplifying a content setup that has become too complicated for the team to manage.',
                'status' => 'in_progress',
                'notes' => 'Follow-up workshop proposal shared on Tuesday.',
            ],
            [
                'name' => 'Sara Al-Qahtani',
                'email' => 'sara@aureline.example',
                'phone' => '+966 54 889 1440',
                'company' => 'Aureline Cloud',
                'subject' => 'Brand-led redesign with a lighter CMS workflow',
                'message' => 'Our current site feels too generic for the kind of enterprise conversations we are having now. We want a stronger flagship presence without adding an overly complex admin system.',
                'status' => 'resolved',
                'notes' => 'Project converted into active proposal.',
            ],
        ] as $entry) {
            Inquiry::query()->create($entry);
        }
    }

    protected function storeSvg(string $directory, string $filename, string $title, string $alt, string $svg): Media
    {
        $path = storage_path('app/public/'.$directory.'/'.$filename);
        File::ensureDirectoryExists(dirname($path));
        File::put($path, $svg);

        return Media::query()->updateOrCreate(
            ['directory' => $directory, 'filename' => $filename],
            [
                'disk' => 'public',
                'original_name' => $filename,
                'mime_type' => 'image/svg+xml',
                'extension' => 'svg',
                'size' => File::size($path),
                'title' => $title,
                'alt_text' => $alt,
                'width' => $this->extractSvgDimension($svg, 'width') ?? 1600,
                'height' => $this->extractSvgDimension($svg, 'height') ?? 1000,
            ]
        );
    }

    protected function extractSvgDimension(string $svg, string $dimension): ?int
    {
        preg_match('/'.$dimension.'="(\d+)"/', $svg, $matches);

        return isset($matches[1]) ? (int) $matches[1] : null;
    }

    protected function artworkSvg(string $title, string $subtitle, string $base, string $accent, string $highlight): string
    {
        $title = e($title);
        $subtitle = e($subtitle);

        return <<<SVG
<svg xmlns="http://www.w3.org/2000/svg" width="1600" height="1100" viewBox="0 0 1600 1100" role="img" aria-label="{$title}">
  <defs>
    <linearGradient id="bg" x1="0%" y1="0%" x2="100%" y2="100%">
      <stop offset="0%" stop-color="{$base}"/>
      <stop offset="60%" stop-color="{$accent}"/>
      <stop offset="100%" stop-color="#061322"/>
    </linearGradient>
    <linearGradient id="line" x1="0%" y1="0%" x2="100%" y2="0%">
      <stop offset="0%" stop-color="{$highlight}" stop-opacity="0.1"/>
      <stop offset="50%" stop-color="{$highlight}" stop-opacity="0.85"/>
      <stop offset="100%" stop-color="#ffffff" stop-opacity="0.08"/>
    </linearGradient>
  </defs>
  <rect width="1600" height="1100" fill="url(#bg)"/>
  <circle cx="1310" cy="180" r="200" fill="{$highlight}" opacity="0.16"/>
  <circle cx="260" cy="860" r="260" fill="#ffffff" opacity="0.05"/>
  <path d="M150 850C350 660 640 560 960 600C1190 628 1340 560 1490 420" stroke="url(#line)" stroke-width="20" fill="none" stroke-linecap="round"/>
  <path d="M160 930C420 760 740 700 1030 740C1220 766 1360 710 1460 620" stroke="url(#line)" stroke-width="10" fill="none" stroke-linecap="round" opacity="0.6"/>
  <rect x="160" y="190" width="1280" height="720" rx="46" fill="rgba(255,255,255,0.05)" stroke="rgba(255,255,255,0.12)"/>
  <rect x="250" y="285" width="350" height="360" rx="28" fill="rgba(255,255,255,0.07)"/>
  <rect x="655" y="285" width="530" height="150" rx="28" fill="rgba(255,255,255,0.08)"/>
  <rect x="655" y="470" width="530" height="260" rx="28" fill="rgba(255,255,255,0.05)"/>
  <rect x="1215" y="285" width="135" height="445" rx="24" fill="rgba(255,255,255,0.08)"/>
  <text x="250" y="805" fill="#ffffff" font-family="Arial, sans-serif" font-size="68" font-weight="700">{$title}</text>
  <text x="250" y="870" fill="#dbeafe" font-family="Arial, sans-serif" font-size="26">{$subtitle}</text>
</svg>
SVG;
    }

    protected function detailArtworkSvg(string $title, int $variant): string
    {
        $title = e($title.' / Detail '.$variant);
        $pairs = [['#20b8ff', '#0f6bd1'], ['#7a60ff', '#1e93ff'], ['#16c4a6', '#1b59d9']];
        $accent = $pairs[$variant - 1];

        return <<<SVG
<svg xmlns="http://www.w3.org/2000/svg" width="1400" height="1000" viewBox="0 0 1400 1000" role="img" aria-label="{$title}">
  <defs><linearGradient id="bg" x1="0%" y1="0%" x2="100%" y2="100%"><stop offset="0%" stop-color="#081321"/><stop offset="55%" stop-color="{$accent[1]}"/><stop offset="100%" stop-color="#04111c"/></linearGradient></defs>
  <rect width="1400" height="1000" fill="url(#bg)"/>
  <circle cx="260" cy="220" r="170" fill="{$accent[0]}" opacity="0.22"/>
  <circle cx="1120" cy="790" r="220" fill="#ffffff" opacity="0.05"/>
  <rect x="150" y="170" width="1100" height="660" rx="40" fill="rgba(255,255,255,0.05)" stroke="rgba(255,255,255,0.12)"/>
  <rect x="240" y="260" width="920" height="90" rx="24" fill="rgba(255,255,255,0.08)"/>
  <rect x="240" y="400" width="420" height="300" rx="28" fill="rgba(255,255,255,0.07)"/>
  <rect x="710" y="400" width="450" height="140" rx="28" fill="rgba(255,255,255,0.08)"/>
  <rect x="710" y="580" width="450" height="120" rx="28" fill="rgba(255,255,255,0.05)"/>
  <text x="240" y="785" fill="#ffffff" font-family="Arial, sans-serif" font-size="48" font-weight="700">{$title}</text>
</svg>
SVG;
    }

    protected function portraitSvg(string $name, string $role, string $base, string $accent, string $highlight): string
    {
        $name = e($name);
        $role = e($role);

        return <<<SVG
<svg xmlns="http://www.w3.org/2000/svg" width="1000" height="1260" viewBox="0 0 1000 1260" role="img" aria-label="{$name}">
  <defs><linearGradient id="bg" x1="0%" y1="0%" x2="100%" y2="100%"><stop offset="0%" stop-color="{$base}"/><stop offset="58%" stop-color="{$accent}"/><stop offset="100%" stop-color="#08111e"/></linearGradient></defs>
  <rect width="1000" height="1260" fill="url(#bg)"/>
  <circle cx="500" cy="420" r="210" fill="#f8fafc" opacity="0.12"/>
  <path d="M330 860C365 715 435 600 500 600C565 600 635 715 670 860V1040H330V860Z" fill="#f8fafc" opacity="0.17"/>
  <circle cx="500" cy="455" r="132" fill="#f8fafc" opacity="0.92"/>
  <path d="M390 382C412 315 472 282 500 282C528 282 589 315 611 382C585 364 548 353 500 353C452 353 415 364 390 382Z" fill="{$highlight}" opacity="0.9"/>
  <rect x="112" y="110" width="776" height="1040" rx="42" fill="rgba(255,255,255,0.04)" stroke="rgba(255,255,255,0.12)"/>
  <text x="170" y="1070" fill="#ffffff" font-family="Arial, sans-serif" font-size="56" font-weight="700">{$name}</text>
  <text x="170" y="1128" fill="#dbeafe" font-family="Arial, sans-serif" font-size="24">{$role}</text>
</svg>
SVG;
    }

    protected function wordmarkSvg(string $name, string $color): string
    {
        $name = e($name);

        return <<<SVG
<svg xmlns="http://www.w3.org/2000/svg" width="1000" height="360" viewBox="0 0 1000 360" role="img" aria-label="{$name}">
  <rect width="1000" height="360" rx="44" fill="#091321"/>
  <circle cx="160" cy="180" r="62" fill="{$color}" opacity="0.92"/>
  <path d="M138 180h44" stroke="#091321" stroke-width="18" stroke-linecap="round"/>
  <text x="270" y="205" fill="#f8fafc" font-family="Arial, sans-serif" font-size="72" font-weight="700">{$name}</text>
</svg>
SVG;
    }

    protected function faviconSvg(): string
    {
        return <<<SVG
<svg xmlns="http://www.w3.org/2000/svg" width="256" height="256" viewBox="0 0 256 256" role="img" aria-label="PressnGo icon">
  <defs><linearGradient id="g" x1="0%" y1="0%" x2="100%" y2="100%"><stop offset="0%" stop-color="#37c7ff"/><stop offset="100%" stop-color="#2f66d0"/></linearGradient></defs>
  <rect width="256" height="256" rx="64" fill="#071221"/>
  <path d="M62 76h78c42 0 66 20 66 56c0 34-24 56-66 56h-28v34H62V76Zm50 38v36h25c12 0 19-6 19-18s-7-18-19-18h-25Z" fill="url(#g)"/>
  <path d="M144 184c12 0 22-10 22-22s-10-22-22-22h-8v-32h10c30 0 54 24 54 54s-24 54-54 54h-24v-32h22Z" fill="#b56dff"/>
</svg>
SVG;
    }
}

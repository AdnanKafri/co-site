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
        $this->media['hero'] = $this->storeSvg('demo', 'hero-signal-ecosystem.svg', 'Hero Signal Ecosystem', 'Layered interface inspired hero artwork', $this->artworkSvg('Signal Ecosystem', 'Architected visibility for companies that need presence, clarity, and momentum.', '#071221', '#2454cb', '#39c9ff'));
        $this->media['cta'] = $this->storeSvg('demo', 'cta-system-rhythm.svg', 'CTA System Rhythm', 'Atmospheric abstract CTA artwork', $this->artworkSvg('System Rhythm', 'Designed code, editorial pacing, and premium structure aligned into one experience.', '#0a1326', '#183f82', '#13b9a9'));
        $this->media['favicon'] = $this->storeSvg('settings', 'pressngo-favicon.svg', 'PressnGo Favicon', 'PressnGo favicon mark', $this->faviconSvg());

        foreach ([
            ['slug' => 'brand-architecture', 'title' => 'Brand Architecture', 'base' => '#0b1222', 'accent' => '#2b66db', 'highlight' => '#85e3ff'],
            ['slug' => 'platform-design', 'title' => 'Platform Design', 'base' => '#0f2749', 'accent' => '#21a0d8', 'highlight' => '#51d3ff'],
            ['slug' => 'growth-sites', 'title' => 'Growth Sites', 'base' => '#112b52', 'accent' => '#166ac3', 'highlight' => '#7de8f3'],
            ['slug' => 'content-operations', 'title' => 'Content Operations', 'base' => '#173664', 'accent' => '#1c3f9f', 'highlight' => '#d07eff'],
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
            ['slug' => 'layla-haddad', 'name' => 'Layla Haddad', 'role' => 'Creative Director', 'base' => '#0d1833', 'accent' => '#2f66d0', 'highlight' => '#8de9ff'],
            ['slug' => 'omar-khaled', 'name' => 'Omar Khaled', 'role' => 'Technical Lead', 'base' => '#10182d', 'accent' => '#197dbf', 'highlight' => '#5bd7c7'],
            ['slug' => 'nora-farouk', 'name' => 'Nora Farouk', 'role' => 'Content Systems Strategist', 'base' => '#111b30', 'accent' => '#6e5fe9', 'highlight' => '#f58cff'],
        ] as $item) {
            $this->media['team_'.$item['slug']] = $this->storeSvg('team', $item['slug'].'.svg', $item['name'], $item['name'].' portrait', $this->portraitSvg($item['name'], $item['role'], $item['base'], $item['accent'], $item['highlight']));
        }

        foreach (['Northstar Mobility', 'Aureline Cloud', 'Fathom Health', 'Sable Energy', 'Meridian Labs', 'Vector Systems'] as $index => $partner) {
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
            'seo.default_title' => 'PressnGo | Premium Company Platforms',
            'seo.default_description' => 'PressnGo designs cinematic company platforms with strong brand structure, premium composition, and maintainable content systems.',
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
                'badge' => 'Brand-Led Digital Presence',
                'title' => 'We design premium company platforms that feel directed, immersive, and unmistakably intentional.',
                'body' => 'PressnGo helps ambitious companies move beyond flat brochure websites with Laravel-powered brand platforms shaped by visual rhythm, strong narrative structure, and content systems teams can actually manage.',
                'primary_label' => 'See Our Services',
                'primary_url' => '/services',
                'secondary_label' => 'Start a Conversation',
                'secondary_url' => '/contact',
                'media_id' => $this->media['hero']->id,
            ],
            'features' => [
                'eyebrow' => 'What makes it stronger',
                'title' => 'A company site should feel like an authored experience, not an assembled template.',
                'items' => [
                    ['title' => 'Narrative structure', 'body' => 'Layouts are curated in code so the story unfolds with intention rather than drifting into page-builder chaos.'],
                    ['title' => 'Centralized media', 'body' => 'Images, brand assets, and supporting visuals are uploaded once and reused across the whole platform cleanly.'],
                    ['title' => 'Operational clarity', 'body' => 'Business teams edit content through a focused dashboard without touching the visual composition layer.'],
                ],
            ],
            'cta' => [
                'title' => 'If the business has momentum, the website should carry it.',
                'body' => 'We create premium digital company presences that sharpen trust, present capability clearly, and give internal teams a system they can maintain confidently.',
                'button_label' => 'Book a Discovery Call',
                'button_url' => '/contact',
                'media_id' => $this->media['cta']->id,
            ],
            'partners_rail' => [
                'title' => 'Trusted by operators, builders, and teams scaling with intent.',
                'body' => 'Every partner mark is managed through the same centralized media system used by the site, keeping the whole presentation cohesive and reusable.',
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
            'story' => ['body' => 'PressnGo was shaped around a simple frustration: too many company websites either look polished but are impossible to maintain, or they become dynamic content systems that lose all authorship. We wanted the middle path. Curated composition. Lightweight operations. Stronger presence.'],
            'mission' => ['body' => 'Give modern companies a premium digital presence that communicates confidence and stays manageable long after launch.'],
            'vision' => ['body' => 'Raise the standard for company websites by treating them as long-term brand systems instead of disposable launch artifacts.'],
            'values' => ['items' => [
                ['title' => 'Intentionality', 'body' => 'Every section, transition, and visual motif should earn its place.'],
                ['title' => 'Clarity', 'body' => 'Narrative, hierarchy, and interface design should reinforce the same message.'],
                ['title' => 'Maintainability', 'body' => 'A premium frontend should not require a bloated admin or fragile stack to sustain it.'],
            ]],
            'stats' => ['items' => [
                ['label' => 'Platform launches', 'value' => '28+'],
                ['label' => 'Editorial systems simplified', 'value' => '14'],
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
            'intro' => ['title' => 'Bring the next version of the company presence into focus.', 'body' => 'Whether the need is a full repositioning, a premium rebuild, or a cleaner content system, we can shape the right next move together.'],
            'details' => ['headline' => 'Direct contact', 'body' => 'Share the context, the current friction, and where the site needs to go next. We respond with practical direction and a realistic path forward.'],
            'cta' => ['title' => 'Prefer a workshop before a build?', 'body' => 'We also run architecture, positioning, and narrative sessions for teams that need clarity before implementation.'],
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
                'title' => 'Brand Systems & Narrative Architecture',
                'slug' => 'brand-systems-narrative-architecture',
                'excerpt' => 'Define the message, hierarchy, and strategic framing that shape how the company should be experienced online.',
                'description' => "We map the business story before pixels start moving.\n\nThis service is focused on structuring the brand narrative, message hierarchy, and content logic so the website feels decisive instead of improvised. We clarify what the audience needs to understand first, where trust should be built, and how the platform should carry momentum from section to section.",
                'image_media_id' => $this->media['service_brand-architecture']->id,
                'icon' => 'Narrative',
                'featured' => true,
                'sort_order' => 10,
            ],
            [
                'title' => 'Platform Experience Design',
                'slug' => 'platform-experience-design',
                'excerpt' => 'Create a more cinematic, premium company experience with stronger composition, motion rhythm, and visual cohesion.',
                'description' => "This is where visual direction becomes productively concrete.\n\nWe design the flagship experience, the supporting editorial layouts, and the coded composition system that gives the site atmosphere without turning it into a fragile frontend experiment. The result is a platform that feels elevated while staying easy to evolve.",
                'image_media_id' => $this->media['service_platform-design']->id,
                'icon' => 'Experience',
                'featured' => true,
                'sort_order' => 20,
            ],
            [
                'title' => 'Growth-Focused Marketing Sites',
                'slug' => 'growth-focused-marketing-sites',
                'excerpt' => 'Launch high-trust company websites that support sales, positioning, and expansion without SaaS-level complexity.',
                'description' => "We build marketing sites that are credible enough for enterprise conversations and simple enough for internal teams to keep alive.\n\nThis service balances premium presentation, clean architecture, and launch readiness so the platform performs as both a brand surface and a business tool.",
                'image_media_id' => $this->media['service_growth-sites']->id,
                'icon' => 'Launch',
                'featured' => true,
                'sort_order' => 30,
            ],
            [
                'title' => 'Content Operations & CMS Simplification',
                'slug' => 'content-operations-cms-simplification',
                'excerpt' => 'Replace bloated editing workflows with focused content systems that match how the business actually works.',
                'description' => "Teams often need better operations more than more flexibility.\n\nWe design lightweight admin experiences, structured editing models, and sustainable content workflows that reduce friction without exposing the visual system to accidental fragmentation.",
                'image_media_id' => $this->media['service_content-operations']->id,
                'icon' => 'Operations',
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
                'title' => 'Northstar Mobility',
                'slug' => 'northstar-mobility',
                'client' => 'Northstar Mobility',
                'category' => 'Mobility Platform',
                'description' => "Northstar needed a company presence that felt as advanced as the product roadmap.\n\nWe reshaped the site around stronger hierarchy, a more cinematic flagship page, and a supporting structure that could handle investor visibility, partnership trust, and product storytelling without becoming a generic SaaS template.",
                'technologies' => ['Laravel', 'Blade', 'Tailwind CSS', 'Alpine.js'],
                'cover_media_id' => $this->media['project_northstar-mobility']->id,
                'featured' => true,
                'external_link' => 'https://northstar.example',
                'completed_at' => now()->subMonths(5)->toDateString(),
                'gallery_keys' => ['project_northstar-mobility_gallery_1', 'project_northstar-mobility_gallery_2', 'project_northstar-mobility_gallery_3'],
            ],
            [
                'title' => 'Aureline Cloud',
                'slug' => 'aureline-cloud',
                'client' => 'Aureline Cloud',
                'category' => 'Infrastructure Brand',
                'description' => "Aureline was growing quickly, but the website still looked like a placeholder between fundraising rounds.\n\nWe introduced a premium visual system, clarified the service architecture, and rebuilt the content workflow so the internal team could manage updates without flattening the design language.",
                'technologies' => ['Laravel', 'MySQL', 'Tailwind CSS'],
                'cover_media_id' => $this->media['project_aureline-cloud']->id,
                'featured' => true,
                'external_link' => 'https://aureline.example',
                'completed_at' => now()->subMonths(3)->toDateString(),
                'gallery_keys' => ['project_aureline-cloud_gallery_1', 'project_aureline-cloud_gallery_2', 'project_aureline-cloud_gallery_3'],
            ],
            [
                'title' => 'Fathom Health Systems',
                'slug' => 'fathom-health-systems',
                'client' => 'Fathom Health Systems',
                'category' => 'Healthcare Systems',
                'description' => "Fathom needed to present technical capability, operational reliability, and human clarity within one cohesive digital experience.\n\nThe final platform uses editorial composition, trust-focused information layering, and a lighter admin architecture that keeps critical content organized across the company team.",
                'technologies' => ['Laravel', 'Blade', 'Content Strategy'],
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
                'role' => 'Creative Director',
                'image_media_id' => $this->media['team_layla-haddad']->id,
                'bio' => 'Leads visual systems, editorial composition, and the overall brand atmosphere so every page feels authored instead of assembled.',
                'social_links' => ['linkedin' => 'https://linkedin.com/in/laylahaddad'],
                'sort_order' => 10,
                'is_active' => true,
            ],
            [
                'name' => 'Omar Khaled',
                'role' => 'Technical Lead',
                'image_media_id' => $this->media['team_omar-khaled']->id,
                'bio' => 'Shapes the Laravel architecture, content model discipline, and implementation patterns that keep the platform powerful without turning it heavy.',
                'social_links' => ['linkedin' => 'https://linkedin.com/in/omarkhaled'],
                'sort_order' => 20,
                'is_active' => true,
            ],
            [
                'name' => 'Nora Farouk',
                'role' => 'Content Systems Strategist',
                'image_media_id' => $this->media['team_nora-farouk']->id,
                'bio' => 'Translates brand narrative into maintainable section logic, content governance, and internal workflows that teams can sustain after launch.',
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
            ['name' => 'Fathom Health', 'website' => 'https://fathom.example'],
            ['name' => 'Sable Energy', 'website' => 'https://sable.example'],
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
                'subject' => 'Platform rebuild for launch phase',
                'message' => 'We are preparing for a regional rollout and need the website to reflect product maturity, partner trust, and a stronger visual system before the next quarter.',
                'status' => 'new',
            ],
            [
                'name' => 'Daniel Ross',
                'email' => 'daniel@meridian.example',
                'phone' => '+971 55 101 2288',
                'company' => 'Meridian Labs',
                'subject' => 'Discovery workshop',
                'message' => 'We need help clarifying our website narrative and simplifying a content setup that has become too complicated for the team to manage.',
                'status' => 'in_progress',
                'notes' => 'Follow-up workshop proposal shared on Tuesday.',
            ],
            [
                'name' => 'Sara Al-Qahtani',
                'email' => 'sara@aureline.example',
                'phone' => '+966 54 889 1440',
                'company' => 'Aureline Cloud',
                'subject' => 'Brand-led redesign',
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
        preg_match('/'.$dimension.'=\"(\d+)\"/', $svg, $matches);

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

# PressnGo Product Architecture

## Product Positioning

PressnGo is a curated company website with a custom admin dashboard.

It is not:
- a SaaS product
- a generic CMS
- a page builder
- a multi-tenant system
- a low-code content engine

It is:
- a premium marketing site
- a business content management workflow
- a developer-controlled frontend with editable business data
- a lightweight admin experience for a single company

## Core Principles

- Curated structure: developers control page composition and section order.
- Editable content: business users manage approved content fields only.
- Single-company scope: one installation, one business, one admin area.
- Server-rendered first: Laravel + Blade drive SEO, performance, and simplicity.
- Lightweight interactivity: Alpine.js only where it adds clear value.
- Centralized media: assets are uploaded once and reused everywhere.
- Production realism: avoid abstractions that do not create immediate value.

## High-Level Architecture

### Application Layers

- Public site
  - Server-rendered marketing pages.
  - Uses Blade layouts, page views, and reusable section components.
- Admin dashboard
  - Custom-built internal CRUD and settings UI.
  - Uses the same Laravel app, separate route group, layouts, and components.
- Domain layer
  - Eloquent models for content entities.
  - Focused action/service classes only where reuse or orchestration matters.
- Infrastructure layer
  - Media storage, SEO helpers, settings repository, and shared view data.

### Routing Strategy

- `routes/web.php`
  - Public routes only.
- `routes/admin.php`
  - Admin auth, dashboard, content management, and media library routes.

Route naming convention:
- Public: `home`, `about`, `services.index`, `services.show`, `projects.index`
- Admin: `admin.dashboard`, `admin.services.index`, `admin.media.index`

### Namespace Strategy

- `App\Http\Controllers\Web`
- `App\Http\Controllers\Admin`
- `App\Http\Requests\Admin`
- `App\Models`
- `App\Services`
- `App\Support`
- `App\View\Composers`

This keeps separation clear without introducing a module system too early.

## Data and Content Model

### 1. Global Settings

Use one `settings` table with grouped key-value records instead of many one-off tables.

Why:
- flexible enough for controlled settings
- simple to query and cache
- easy to extend without schema churn for every minor field

Suggested keys:
- `general.company_name`
- `general.email`
- `general.phone`
- `general.address`
- `general.logo_media_id`
- `general.favicon_media_id`
- `general.brand_primary`
- `general.brand_secondary`
- `general.maps_embed`
- `seo.default_title`
- `seo.default_description`
- `seo.default_og_image_media_id`
- `social.linkedin`
- `social.instagram`

### 2. Homepage Content

Use one `page_sections` table for tightly controlled structured sections.

Important:
- This is not a page builder.
- Each row represents a known section type for a known page.
- Rendering is hardcoded by developers.

Suggested columns:
- `page`
- `section`
- `data` JSON
- `is_active`
- `sort_order`

Homepage sections:
- `hero`
- `features`
- `services_preview`
- `cta`
- `partners_rail`

### 3. About Page

Use `page_sections` for most structured about content as well:
- `story`
- `mission`
- `vision`
- `values`
- `stats`
- `gallery`

This avoids a separate table for every editorial block while preserving control.

### 4. Services

Use a dedicated `services` table because this is repeatable business data.

Columns:
- `title`
- `slug`
- `excerpt`
- `description`
- `image_media_id`
- `icon`
- `featured`
- `sort_order`
- timestamps

### 5. Projects / Portfolio

Use a dedicated `projects` table.

Columns:
- `title`
- `slug`
- `client`
- `category`
- `description`
- `technologies` JSON
- `cover_media_id`
- `featured`
- `external_link`
- `completed_at` nullable
- timestamps

Project gallery:
- `project_media` pivot table
  - `project_id`
  - `media_id`
  - `sort_order`

### 6. Team Members

Use `team_members`:
- `name`
- `role`
- `image_media_id`
- `bio`
- `social_links` JSON
- `sort_order`
- `is_active`

### 7. Partners / Clients

Use `partners`:
- `name`
- `logo_media_id`
- `website`
- `sort_order`
- `is_active`

### 8. Contact / Inquiries

Use:
- `page_sections` entries for contact page editorial content
- `inquiries` table for submissions

`inquiries` columns:
- `name`
- `email`
- `phone`
- `company`
- `subject`
- `message`
- `status`
- `notes` nullable
- timestamps

Status values:
- `new`
- `in_progress`
- `resolved`
- `archived`

### 9. Media Library

Use a first-class `media` table rather than attaching uploads directly to content tables.

Suggested columns:
- `id`
- `disk`
- `directory`
- `filename`
- `original_name`
- `mime_type`
- `extension`
- `size`
- `alt_text` nullable
- `title` nullable
- `width` nullable
- `height` nullable
- `uploaded_by` nullable
- timestamps

Each content table references media by FK where a single asset is selected.

For galleries or many-to-many usage:
- dedicated pivot tables such as `project_media`

## Admin Dashboard Structure

### Dashboard Areas

- Overview
  - lightweight stats and shortcuts
- Site Settings
  - general settings
  - SEO defaults
  - social links
- Content
  - homepage
  - about
  - services
  - projects
  - team
  - partners
  - contact page
- Inquiries
  - list, view, status updates
- Media Library
  - upload
  - browse grid
  - search/filter
  - select from modal

### Admin UX Principles

- One clear workflow per screen.
- Avoid nested builders and dynamic schema editors.
- Prefer split forms by business meaning, not technical storage.
- Use consistent form partials and reusable admin UI components.
- Keep listing screens fast and readable with search + filters only where needed.

### Admin Authentication

Use simple Laravel auth for internal users only.

Recommendation:
- `users` table with admin users
- email/password login
- password reset later if needed
- no roles/permissions package initially

For now:
- treat all authenticated users as admins
- add lightweight policy structure so roles can evolve later

## Frontend Structure

### Layouts

- `resources/views/layouts/app.blade.php`
- `resources/views/layouts/admin.blade.php`

### Public Pages

- `resources/views/pages/home.blade.php`
- `resources/views/pages/about.blade.php`
- `resources/views/pages/services/index.blade.php`
- `resources/views/pages/services/show.blade.php`
- `resources/views/pages/projects/index.blade.php`
- `resources/views/pages/projects/show.blade.php`
- `resources/views/pages/contact.blade.php`

### Blade Components

Public:
- `components/site/header`
- `components/site/footer`
- `components/site/section-heading`
- `components/site/hero`
- `components/site/service-card`
- `components/site/project-card`
- `components/site/stat-card`
- `components/site/cta-band`

Admin:
- `components/admin/sidebar`
- `components/admin/topbar`
- `components/admin/page-header`
- `components/admin/card`
- `components/admin/input`
- `components/admin/textarea`
- `components/admin/select`
- `components/admin/toggle`
- `components/admin/media-picker`
- `components/admin/data-table`

### Frontend Design Direction

- Strong typographic hierarchy
- Clean spacing system
- Intentional color palette from settings
- Soft motion using CSS + Alpine only
- Image-led sections where helpful
- Minimal but polished hover and reveal states

Avoid:
- generic startup template styling
- flashy but heavy animation libraries
- inconsistent section patterns

## Media Library Approach

### Core Rules

- Media is uploaded once and stored centrally.
- Content records reference media IDs.
- Admin forms use a reusable media picker modal.
- The same media item can be reused across hero, services, projects, partners, and SEO.

### Storage Strategy

- Use Laravel public disk initially.
- Store files in organized directories:
  - `settings`
  - `services`
  - `projects`
  - `team`
  - `partners`
  - `seo`
  - `general`

### Admin Media Picker

Reusable workflow:
- open modal
- browse existing media grid
- search/filter
- select media
- optionally upload new media from the modal
- return chosen media ID to the form

### Image Handling

Initial scope:
- validate file types and size
- capture dimensions
- allow optional alt text and title

Later enhancements:
- responsive derivatives
- focal points
- WebP conversions

These should not block launch.

## SEO Strategy

- Server-rendered meta tags per page
- global defaults from settings
- page-specific overrides where needed
- Open Graph image support through media selection
- clean slugs for services and projects
- sitemap and robots later in implementation

## Future Readiness Without Premature Complexity

Prepare for future multilingual support by:
- avoiding hardcoded content in controllers
- centralizing editable content
- using stable section keys

Do not implement now:
- translation tables
- locale routing
- multi-tenant assumptions

## Suggested Folder Structure

```text
app/
  Http/
    Controllers/
      Admin/
      Web/
    Requests/
      Admin/
  Models/
  Services/
    Media/
    Settings/
  Support/
    Seo/
    Navigation/
resources/
  views/
    components/
      admin/
      site/
    layouts/
    pages/
      services/
      projects/
    admin/
      auth/
      dashboard/
      settings/
      homepage/
      about/
      services/
      projects/
      team/
      partners/
      inquiries/
      media/
routes/
  web.php
  admin.php
```

## Implementation Phases

### Phase 1: Foundation

- establish route split
- create base layouts
- create admin auth
- add settings infrastructure
- add shared SEO/site helpers
- build media table and upload service

### Phase 2: Admin Shell

- admin dashboard layout
- navigation
- reusable form components
- reusable media picker component
- flash messages and validation UX

### Phase 3: Core Content Modules

- general settings
- homepage structured editor
- about structured editor
- services CRUD
- projects CRUD
- team CRUD
- partners CRUD
- contact page editor
- inquiries management

### Phase 4: Public Frontend

- premium marketing layout
- home page
- about page
- services pages
- projects pages
- contact page
- inquiry form

### Phase 5: Hardening

- seeders for baseline content
- policy coverage
- caching selected shared data
- basic feature tests
- deployment notes

## Recommended First Build Order

1. route/layout/foundation scaffold
2. admin auth
3. settings repository
4. media library core
5. settings UI
6. services + projects modules
7. homepage/about structured content
8. team/partners/contact/inquiries
9. premium frontend build
10. test and deployment cleanup

## Deliberate Non-Goals

Do not build:
- block/page builder systems
- arbitrary dynamic page creation
- role matrix UI
- plugin architecture
- GraphQL/API-first architecture
- SPA frontend
- generic reusable CMS abstractions that hide business intent

The system should stay understandable to a Laravel developer opening it for the first time.

# Comprehensive Project Overview
---
## 1. Repository Layout (top-level)

| Path | Purpose |
|------|---------|
| `app/` | All runtime assets that power the site (WordPress core + SQL dump). |
| `app/public/` | The **document-root** served by the web server – Composer controlled for easy CLI usage. |
| `app/sql/local.sql` | Database. |
| `vendor/` | PHP dependencies installed by Composer at the repository root (tools / CI helpers). |
| `composer.json` | Root composer file – currently pulls in the WP-CLI *widget-command* package. |

> **Pro-tip:** Run `composer install` at the repo root to install CLI tooling and `composer install` again inside **`app/public`** to install any WordPress-specific dependencies.

---
## 2. WordPress Installation – `app/public/`

Inside `app/public` you will find the usual WordPress core directories (`wp-admin`, `wp-content`, `wp-includes`, etc.) plus a few project-specific items:

| Path | Notes |
|------|-------|
| `composer.json` + `composer.lock` | Defines the site as a Composer project (`type: project`). Autoloads namespace **`Smoothmigrant\WpSmoothDemo\`** from a custom plugin (`wp-content/plugins/system-tools`). |
| `wp-config.php` | Standard configuration file – DB credentials, salts, etc. |
| `create-all-services.php` | A CLI helper that bulk-creates Service posts. Was Placeholder 
| `vendor/` | Dependencies specific to the runtime WP site (installed via the *public* composer.json). |

---
## 3. Active Theme – `wp-content/themes/smoothmigration`

`smoothmigration` is the **only** theme in the project and therefore always active.  Its anatomy:

### 3.1 Root template files

| File | Role |
|------|------|
| `front-page.php` | Template for the *Home* page (automatically used when WordPress is configured to display a static front page). |
| `page-*.php` | One template per high-value marketing page.  Examples include: `page-about.php`, `page-services.php`, `page-faq.php`, `page-become-a-partner.php`, etc.  Open the file whose slug matches the page you need to edit. |
| `taxonomy-service_type.php` | Renders archive pages for the custom *Service Type* taxonomy. |
| `index.php`, `page.php` | Generic fall-backs that WordPress uses when no more specific template applies. |
| `header.php`, `footer.php` | Site-wide header & footer markup. |
| `style.css` | Required WordPress stylesheet header + global CSS.  (Use the existing color palette for visual consistency.) |
| `functions.php` | **Bootstrap file** that loads everything under `/inc`; keeps itself intentionally short (≈ 27 lines). |

### 3.2 `/inc` – Keep PHP logic organised

| File | Key responsibilities |
|------|----------------------|
| `theme-setup.php` | Registers menus (`primary`, `footer`), theme supports (custom-logo, post-thumbnails, HTML5), and loads text-domain. |
| `enqueue.php` | Enqueues CSS & JS from `/assets` (handles cache-busting with the constant `SMOOTHMIGRATION_VERSION`). |
| `class-wp-bootstrap-navwalker.php` | Third-party helper that converts WP menus into Twitter-Bootstrap 5-compatible markup. |
| `ajax.php` | Defines **AJAX endpoints** (both front-end and admin) – check here if you need custom dynamic behaviour. |
| `seo-meta.php` | Inserts `<meta>` tags (OpenGraph, Twitter cards) based on post/page context for better SEO. |
| `cpt-service.php` | *Registers* the custom post type **Service** and its taxonomy **Service Type**, adds Gutenberg-compatible meta boxes, custom columns, and REST exposure. |
| `elementor.php` | Leftover from previous tries. Will delete soon |
| `demo-content.php` | Programmatic content import for demos / previews.

### 3.3 `/assets`

```
assets/
├─ css/
│  ├─ landing-page.css     (styles unique to the front page)
│  ├─ buttons.css          (utility classes for CTA buttons)
│  ├─ cards.css            (card components)
│  ├─ hero.css             (full-bleed hero sections)
│  ├─ header.css / footer.css
│  ├─ responsive.css       (mobile break-points)
│  └─ quick-view.css       (modal/quick-view component)
├─ js/
│  ├─ theme.js             (global interactions – nav, accordions, etc.)
│  ├─ landing-page.js      (animations, counters, sliders just for home)
│  └─ quick-view.js        (scripts for quick-view modals)
├─ images/                 (raw design assets)
└─ img/                    (optimised, ready-to-serve images)
```

> **Editing styles**: create a new `.css` (or `.scss`) file inside `assets/css` and enqueue it from `inc/enqueue.php`.  JavaScript follows the same pattern.

### 3.4 `/template-parts`
Currently only `content-none.php` (fallback message *“Nothing found”*). Might be good to add reusable chunks here (hero, testimonial, etc.) and include them from templates via `get_template_part()`.

---
## 4. Custom Functionality at a Glance

1. **Service** Custom Post Type  
   • URL: `/service/{slug}`  
   • Supports: title, editor, excerpt, thumbnail, comments  
   • REST: enabled (can be queried from JS)  
   • Admin columns: *Service Type*, *Branding*, etc.

2. **Service Type** Taxonomy  
   Hierarchical; used to group Service posts.

3. **AJAX Endpoints**  
   Registered in `inc/ajax.php` – both unauthenticated (`wp_ajax_nopriv_*`) and admin (`wp_ajax_*`).  Useful for dynamic forms, quick-view, etc.

4. **Elementor Integration**  
   Needs to be removed

---
## 5. Working Locally / Deployment (IF NOT USING SOMETHING LIKE LOCAL BY FLYWHEEL)

1. **Clone the repo** and run `composer install` at *both* the repo root **and** `app/public`.
2. Import `app/sql/local.sql` into your local MySQL instance (`wp-smooth-demo` recommended DB name).
3. Update `wp-config.php` (DB creds + `WP_HOME`, `WP_SITEURL`).
4. Access the site at `http://{your-local-domain}`.
5. When pushing to staging/production, deploy everything *except* `app/sql` – DB migration handled separately.

---
## 6. How to Edit a Page (Step-by-Step)

1. **Locate the template**  
   • Front page → `front-page.php`  
   • Marketing pages → look for a matching `page-{slug}.php`  
   • CPT single → `single-{post-type}.php` (not present yet, falls back to `single.php`/`index.php`).
2. **Open the template** under `wp-content/themes/smoothmigration/`.
3. **Adjust markup / PHP** as needed.  *Keep business logic out of templates – move to `/inc` when possible.*
4. **Style it** by editing/adding a file in `assets/css` and enqueueing it.
5. **Respect the colour palette** defined in `style.css` to maintain brand cohesion.
6. **Save & refresh** – in dev the site auto-reloads; in production remember to purge caches.

---
## 7. Quick Reference

| Task | Where to look |
|------|---------------|
| Change global navigation items | `Appearance → Menus` in WP admin or edit `header.php` for markup tweaks |
| Add a new page with unique layout | Duplicate an existing `page-*.php` or create one from scratch, then assign it in the WP admin *Page Attributes* panel |
| Add new Service type | `inc/cpt-service.php` (code) or WP admin under *Service Types* |
| Override button styles site-wide | `assets/css/buttons.css` |
| Register a new JS file | Add file to `assets/js` **and** enqueue via `inc/enqueue.php` |
| Update footer credits | `footer.php` |
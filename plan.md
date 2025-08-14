Smooth Migration Website Upgrade Plan

### Architecture and Codebase Inventory
- **CMS**: WordPress (custom theme `smoothmigration`, Bootstrap 5 via CDN)
- **Design tokens**: `wp-content/themes/smoothmigration/style.css` (CSS vars)
- **Core templates**
  - **Layout**: `header.php`, `footer.php`
  - **Homepage**: `front-page.php`
  - **Services**: `page-services.php`, `page-services-enhanced.php`, `taxonomy-service_type.php`
  - **FAQ**: `page-faq.php` · **About**: `page-about-us.php` · **Partner**: `page-become-a-partner.php` · **Legal**: `page-legal-disclaimer.php`
- **Theme glue**: `functions.php`, `inc/theme-setup.php`, `inc/enqueue.php`, `inc/ajax.php`, `inc/cpt-service.php`
- **Assets**
  - CSS: `assets/css/{header,hero,landing-page,buttons,footer,responsive}.css`
  - JS: `assets/js/{theme,landing-page,quick-view}.js`
- **Principle**: keep to the existing palette and tokens in `style.css` for brand cohesion

### Design Priorities
- **Legibility/consistency**: hero overlays, typography, unified buttons
- **Segmentation/shortcuts**: clickable flags, category chips, dropdown soft boxes
- **Dynamic facts**: admin-editable stats and timelines
- **Social proof**: curated partners/testimonials with a11y
- **Accessibility**: WCAG AA contrast; respect reduced motion

### Workstreams and Tasks

- **1) Admin-editable KPIs and Timelines**
  - Add Options page for: moves, avg days, countries, community size
  - Add `service_type` term meta: Typical timeline
  - Replace hard-coded values in `front-page.php` and services pages

- **2) Homepage Hero and Top Segmentation**
  - Flag chips (Canada first) → country hubs
  - Horizontal secondary CTAs: About/Services/Contact/Partner/Relocation Plan
  - Increase hero overlay contrast; validate WCAG
  - Finalize headline/subheadline copy
  - Standardize hero button colors (primary + outline secondary)
  - Persistent “Consult available” sticky pill → Contact

- **3) Navigation and Soft-Box Dropdowns**
  - Populate Primary menu with dropdowns
  - Soft-box dropdown UI for Services in `header.php`/`header.css`

- **4) How It Works + Category Shortcuts**
  - Category chips under subtitle; a11y focus and contrast

- **5) Services Cards and Pages Consistency**
  - Unify card visuals across homepage and `page-services*.php`
  - Read timelines from term meta
  - Reorder homepage “Core Services” (top three)

- **6) Partners Carousel and Testimonials**
  - Curate logos (≤12), constrain size, lazy-load
  - Source from featured Services or list; retina crispness
  - Testimonials formatted “From: X → To: Y”

- **7) FAQ Interaction and Contrast**
  - Category filters and accordion contrast; `prefers-reduced-motion`
  - Content verification pass

- **8) Footer and Social**
  - Increase font size/spacing
  - Add Instagram; replace Twitter with X; `aria-label`s
  - Verify legal links

- **9) Logo Handling**
  - Use `the_custom_logo()`; support transparent vs scrolled state

- **10) Accessibility and Performance QA**
  - Contrast, keyboard focus, mobile breakpoints, Lighthouse

### File Change Map
- Dynamic data/setup: `inc/theme-setup.php`, `functions.php` (+ new `inc/options.php`)
- Homepage: `front-page.php`, `assets/css/landing-page.css`, `assets/css/hero.css`, minor `assets/js/landing-page.js`
- Navigation: `header.php`, `assets/css/header.css`
- Services: `page-services.php`, `page-services-enhanced.php`, `taxonomy-service_type.php`, `inc/cpt-service.php` (term meta helper)
- Partners/testimonials: `front-page.php`, `assets/css/landing-page.css`
- FAQ: `page-faq.php`, relevant CSS
- Footer/social: `footer.php`, `assets/css/footer.css`
- Logo variants: assets + `header.css`

### Slide Feedback Mapping → Tasks
- S1-B1: Flag chips + secondary CTAs + logo visibility → `front-page.php`, `header.php`, CSS
- S1-B2: Admin-editable stats (set moves=2500) → Options + `front-page.php`
- S1-B3: Increase hero overlay contrast → `landing-page.css`/`hero.css`
- S1-B4: Refine headline/subheadline → `front-page.php`
- S1-B5: Unify button colors → `buttons.css` usage
- S1-B6: Font consistency in buttons → `buttons.css`, `style.css`
- S1-B7: Persistent consult pill → `front-page.php` + CSS + minor JS
- S1-B8: Populate dropdowns + soft boxes → menu + `header.php`/`header.css`
- S2-B1/B2: Improve steps + add category chips → `landing-page.css`, `front-page.php`
- S3-B1/B2/B3: Services readability/order/timelines via term meta → PHP + CSS
- S4-B1: Mirror services styles across pages → `page-services*.php`
- S5-B1..B5: Icon color consistency; defensible claims; auto-update stats; mention no hidden costs → options + views
- S6-B1..B4: Curate partners; logo sizing; testimonial format; per-site partner differences (main vs country) → homepage CSS/PHP
- S7-B1: Community size stat → Options + placement
- S8-B1..B5: FAQ contrast/click colors; categories; content current; audit button/icon colors against tokens → `page-faq.php` + CSS
- S9-B1..B5: Footer legibility; add Instagram; replace X; ensure background tones match palette; legal links current → `footer.php`/`footer.css` + legal

### Additional Mapping (from Missing_Feedback_Mapping.csv)
- **S3-B3**: Auto-update typical timelines → add `service_type` term meta; read in cards and services pages (`inc/cpt-service.php`, `front-page.php`, services pages)
- **S5-B2**: Icon buttons reflect SM colors → enforce token-driven color classes; audit components using `buttons.css`/tokens
- **S5-B3**: Substantiate claims → add data source fields and “as of” date in Options; show small-print note near stats; remove/adjust if unverified
- **S5-B4**: Auto-updating stats; set moves=2500; satisfaction unchanged; countries=5 (confirm) → implement Options; render on homepage; counters read from Options
- **S5-B5**: Mention “free/no hidden costs” → add to hero or “Why us” with concise language and link to disclaimer
- **S6-B2**: Which partners and differences main vs country sites → add mechanism (taxonomy or per-page config) to vary displayed partners by country/context
- **S6-B3**: Partner logos current and sized → define max dimensions and accepted formats; constrain via CSS; retina-friendly; add upload guidance
- **S6-B4**: Update reviews; switch “profession” to “From → To” → update testimonial copy format; curate real excerpts
- **S8-B2**: Categories mention → add category chips/links in relevant sections (How it Works, FAQ intro)
- **S8-B3**: “Are these up to date” → content sweep for FAQ entries; mark last reviewed date if useful
- **S8-B4**: Clicked colors readable in FAQ → check active/hover/pressed states; adjust tokens for contrast
- **S8-B5**: Button colors/pics/graphics in FAQ → align with core button/icon styles; ensure token adherence
- **S9-B2**: Categories in footer/elsewhere for direction → add quick category links in footer “Resources” or a small chips row
- **S9-B3**: Add Instagram; ensure proper X logo usage → update social in `footer.php` with correct icons and labels
- **S9-B4**: Darker color matching rest of background → verify footer background uses tokenized color; harmonize with site palette
- **S9-B5**: Legal content currency → verify Privacy/Terms/Cookies/Disclaimer content and update dates

### Milestones and Order of Work
1. Options/term meta plumbing
2. Homepage hero segmentation, overlay, copy, CTAs, consult pill
3. Navigation dropdown soft boxes and category chips
4. Services card system + timelines
5. Partners/testimonials curation
6. FAQ contrast & motion prefs
7. Footer/social updates
8. Logo handling
9. A11y/perf QA

### Risks & Dependencies
- Confirm accurate KPIs and country count
- Decide country hub URLs/taxonomy
- Partner logo usage rights
- Keep within existing color tokens

---

### TODO
- [ ] Approve KPIs (moves=2500, avg days, countries, community size) and copy changes
- [ ] Implement Theme Options page (`inc/options.php`) and wire to `functions.php`
- [ ] Add data source and “as of date” fields for KPIs; render small-print near stats
- [ ] Replace hard-coded stats in `front-page.php` (trust metrics, social proof)
- [ ] Add `service_type` term meta “Typical timeline” and render on cards/pages
- [ ] Build hero flag chips (Canada first) with accessible links
- [ ] Add secondary CTA row (About/Services/Contact/Partner/Relocation Plan)
- [ ] Increase hero overlay/contrast; validate WCAG AA
- [ ] Standardize hero buttons (primary + outline); enforce typography consistency
- [ ] Add sticky “Consult available” pill linking to Contact
- [ ] Populate Primary menu dropdowns in WP and implement soft-box dropdown UI
- [ ] Add category chips under “How it Works” and in FAQ intro section
- [ ] Unify service card system across homepage and services pages
- [ ] Curate partner logos (12 max), define size/format guidelines, constrain size, lazy-load
- [ ] Enable per-country partner variation (taxonomy or per-page config)
- [ ] Update testimonials to “From: X → To: Y” format with real excerpts
- [ ] Improve FAQ contrast/active states; respect reduced motion; verify content is current
- [ ] Increase footer font size/spacing; add Instagram; replace Twitter with X; verify legal links
- [ ] Add footer quick links for key categories
- [ ] Ensure footer background tones match palette tokens
- [ ] Switch header logo to `the_custom_logo()` and support transparent vs scrolled states
- [ ] Run a11y/perf QA (contrast checks, keyboard nav, mobile layouts, Lighthouse)

---

Smooth Migration Website Upgrade — Implementation Strategy

### Overview

- Platform: WordPress custom theme at `app/public/wp-content/themes/smoothmigration` using Bootstrap 5.3 (see `inc/enqueue.php`).
- Structure
  - Layout: `header.php`, `footer.php`, `index.php`, `page.php`
  - Homepage: `front-page.php`
  - Services: `page-services.php`, `page-services-enhanced.php`, `taxonomy-service_type.php`
  - Content pages: `page-faq.php`, `page-about-us.php`, `page-become-a-partner.php`, `page-legal-disclaimer.php`
  - Glue: `functions.php`, `inc/theme-setup.php`, `inc/enqueue.php`, `inc/ajax.php`, `inc/cpt-service.php`
  - Assets: CSS `assets/css/{header.css,hero.css,landing-page.css,buttons.css,cards.css,sections.css,footer.css,responsive.css}`; JS `assets/js/{theme.js,landing-page.js,quick-view.js}`
- Styling system: design tokens and typography in `style.css`. All additions should use these tokens to maintain brand cohesion.
- Improvement themes: legibility/contrast, segmentation (flags/CTAs), dynamic KPIs/timelines, curated partners/testimonials, WCAG 2.1 AA, responsive polish, maintainable logo handling.

### Detailed Improvement Plan (by slide & bullet)

- S1-B1 (flags/CTAs/logo)
  - Change: Clickable flag chips (Canada first) linking to country hubs; horizontal secondary CTAs (About/Services/Contact/Partner/Relocation Plan). Ensure header logo legibility on hero.
  - Files: `front-page.php`, `header.php`, `assets/css/{hero.css,landing-page.css,header.css}`
  - Why: Faster routing, brand clarity, a11y.

- S1-B2 (stats update; 2500+)
  - Change: Add Theme Options to store KPIs (moves, avg days, countries, community size, as-of, data source). Render in hero/trust metrics.
  - Files: new `inc/options.php` + hook in `functions.php`; render in `front-page.php`.
  - Why: Accuracy and maintainability.

- S1-B3 (hero contrast)
  - Change: Strengthen overlay/gradient tokens; validate heading/subheading contrast.
  - Files: `assets/css/hero.css`, `style.css`.
  - Why: WCAG AA.

- S1-B4 (headline/subheadline)
  - Change: Refine copy and typographic scale/measure.
  - Files: `front-page.php`, `assets/css/hero.css`.
  - Why: Clarity and conversion.

- S1-B5 (button colors unification)
  - Change: Standardize variants: primary, outline-primary, limited accent. Enforce globally.
  - Files: `assets/css/buttons.css` (+ audit usage).
  - Why: Consistency and contrast.

- S1-B6 (font consistency)
  - Change: Normalize font families/weights for buttons and UI text via tokens.
  - Files: `style.css`, `assets/css/buttons.css`.
  - Why: Readability and cohesion.

- S1-B7 (persistent consult pill)
  - Change: Add sticky pill linking to Contact; respect `prefers-reduced-motion`.
  - Files: `front-page.php`, `assets/css/landing-page.css`, minor `assets/js/landing-page.js`.
  - Why: Conversion, a11y.

- S1-B8 (nav dropdowns soft-box)
  - Change: Populate Primary menu; implement soft-box dropdown with focus/keyboard support.
  - Files: `header.php`, `assets/css/header.css`.
  - Why: IA clarity.

- S2-B1 (How it Works legibility)
  - Change: Ensure AA contrast and readable sizes on step cards.
  - Files: `assets/css/{sections.css,landing-page.css}`.
  - Why: WCAG.

- S2-B2 (category shortcuts)
  - Change: Add category chips/links under subtitle with visible focus.
  - Files: `front-page.php`, `assets/css/sections.css`.
  - Why: Faster discovery.

- S3-B1 (services legibility)
  - Change: Improve card contrast/typography and overlays.
  - Files: `assets/css/{cards.css,sections.css}`.
  - Why: WCAG.

- S3-B2 (top three services order)
  - Change: Reorder to Housing/Banking/Visas (configurable later).
  - Files: `front-page.php`.
  - Why: Business priority.

- S3-B3 (auto timelines)
  - Change: Add `service_type` term meta “Typical timeline”; render on cards and taxonomy pages; admin UI.
  - Files: `inc/cpt-service.php`, `front-page.php`, `taxonomy-service_type.php`.
  - Why: Accuracy/maintainability.

- S4-B1 (apply services improvements sitewide)
  - Change: Mirror S3 improvements on `page-services*.php`.
  - Files: `page-services.php`, `page-services-enhanced.php`, `assets/css/cards.css`.
  - Why: Consistency.

- S5-B1 (icon buttons graphics)
  - Change: Use consistent iconography with token backgrounds and a11y labels.
  - Files: `assets/css/buttons.css`, templates using icon buttons.
  - Why: Brand consistency, a11y.

- S5-B2 (SM colours for icons)
  - Change: Map variants to tokens; remove ad-hoc colors.
  - Files: `style.css`, `assets/css/buttons.css`.
  - Why: Branding.

- S5-B3 (substantiated claims)
  - Change: Add Options for data source and as-of; render small-print near stats.
  - Files: `inc/options.php`, `front-page.php`.
  - Why: Trust/compliance.

- S5-B4 (auto-updating stats)
  - Change: Replace hard-coded stats with Options-driven values (moves=2500+ default; countries editable).
  - Files: `inc/options.php`, `front-page.php`.
  - Why: Accuracy.

- S5-B5 (free/no hidden costs)
  - Change: Add concise note in hero or Why Us with link to disclaimer.
  - Files: `front-page.php`, `page-legal-disclaimer.php`.
  - Why: Transparency.

- S6-B1 (brand consistency)
  - Change: Audit token usage; remove inline overrides.
  - Files: `style.css`, section CSS.
  - Why: Cohesion.

- S6-B2 (partners by site/country)
  - Change: Context-based partner selection (taxonomy or options mapping); limit ≤12.
  - Files: `front-page.php`, optional `inc/options.php`.
  - Why: Relevance/perf.

- S6-B3 (logo sizing/formats)
  - Change: Constrain CSS sizes; lazy-load; document accepted formats/retina guidance.
  - Files: `assets/css/landing-page.css`.
  - Why: Perf and crispness.

- S6-B4 (testimonials format)
  - Change: “From: X → To: Y” author format; curate excerpts.
  - Files: `front-page.php`, `assets/css/sections.css`.
  - Why: Clarity.

- S7-B1 (community size stat)
  - Change: Add KPI in Options; render in hero/resources.
  - Files: `inc/options.php`, `front-page.php`.
  - Why: Social proof.

- S8-B1 (FAQ legibility)
  - Change: Ensure AA contrast and sizes per tokens.
  - Files: `page-faq.php`, `assets/css/sections.css`.
  - Why: WCAG.

- S8-B2 (FAQ categories)
  - Change: Add category chips/links at top; keyboard/focus handling.
  - Files: `page-faq.php`, `assets/css/sections.css`.
  - Why: IA clarity.

- S8-B3 (FAQ currency)
  - Change: Content verification; optional “Last reviewed” date from Options.
  - Files: `page-faq.php`, `inc/options.php` (optional field).
  - Why: Trust.

- S8-B4 (clicked colors in FAQ)
  - Change: Audit active/hover/pressed states; adjust tokens to ensure AA.
  - Files: `style.css`, `assets/css/sections.css`.
  - Why: WCAG interactive states.

- S8-B5 (FAQ button styles)
  - Change: Align FAQ CTAs with global button system.
  - Files: `assets/css/buttons.css`, `page-faq.php`.
  - Why: Consistency.

- S9-B1 (footer text size)
  - Change: Increase font size/line-height/spacing.
  - Files: `assets/css/footer.css`.
  - Why: Legibility.

- S9-B2 (footer category links)
  - Change: Add quick category chips/links in footer.
  - Files: `footer.php`, `assets/css/footer.css`.
  - Why: Navigation.

- S9-B3 (Instagram and X)
  - Change: Add Instagram; replace Twitter with X; ensure `aria-label`s.
  - Files: `footer.php`, `assets/css/footer.css`.
  - Why: Accuracy and a11y.

- S9-B4 (footer background tone)
  - Change: Use tokenized background; harmonize with site palette.
  - Files: `style.css`, `assets/css/footer.css`.
  - Why: Cohesion.

- S9-B5 (legal currency)
  - Change: Verify Privacy/Terms/Cookies/Disclaimer; show “Last updated”.
  - Files: `page-legal-disclaimer.php` (+ others if added).
  - Why: Compliance.

### Cross-Cutting Enhancements

- Theme Options & Data
  - Implement `inc/options.php` (“Site Settings”) for KPIs, data source/as-of, optional partner mapping, optional global “last reviewed”.
  - Extend `inc/cpt-service.php` to register `service_type` term meta “Typical timeline”.

- Design System
  - Enforce variants in `assets/css/buttons.css`; keep colors/typography from `style.css` tokens only; audit templates.

- Accessibility
  - WCAG 2.1 AA contrast; visible focus states; keep homepage skip-link; respect `prefers-reduced-motion`.
  - Add `aria-label`s for social links and flag chips; keyboard-accessible dropdowns/chips.

- Performance
  - Lazy-load non-critical images; set explicit dimensions; limit partner logos to ≤12; ensure scripts are page-scoped.

- Branding & Logo
  - Switch to `the_custom_logo()` in `header.php` with fallback; add transparent vs scrolled variants via `scrolled` class handling in CSS; ensure retina dimensions.

### Task List (prioritized)

- Data/Admin
  - [ ] S1-B2,S5-B3,S5-B4,S7-B1: Create `inc/options.php`, wire in `functions.php`, render KPIs on `front-page.php`.
  - [ ] S3-B3: Add term meta in `inc/cpt-service.php`; render timelines in `front-page.php` and `taxonomy-service_type.php`.

- Homepage & Nav
  - [ ] S1-B1: Add flag chips + secondary CTAs in `front-page.php`.
  - [ ] S1-B3/S1-B4: Improve hero overlay/copy.
  - [ ] S1-B5/S1-B6: Standardize buttons/fonts.
  - [ ] S1-B7: Add sticky consult pill.
  - [ ] S1-B8: Soft-box dropdown UI in `header.php` + CSS.

- Services & FAQ
  - [ ] S2-B1/S3-B1/S4-B1: Improve legibility across cards/sections.
  - [ ] S2-B2: Add category chips under How it Works.
  - [ ] S3-B2: Reorder top three services.
  - [ ] S8-B1..B5: FAQ contrast/categories/states/buttons; optional “Last reviewed”.

- Social Proof & Footer
  - [ ] S6-B2..B4: Partner logo curation, sizing, lazy-load; testimonials “From → To”.
  - [ ] S5-B5: Add free/no hidden costs note with disclaimer link.
  - [ ] S9-B1..B4: Footer legibility, category links, Instagram/X, palette harmony.
  - [ ] S9-B5: Legal pages currency + “Last updated”.

- Branding & QA
  - [ ] Logo: switch to `the_custom_logo()` with scrolled variant support.
  - [ ] A11y/perf pass (contrast, keyboard nav, mobile, Lighthouse).

### File Reference Index

- Theme root: `app/public/wp-content/themes/smoothmigration/`
- Core: `header.php`, `footer.php`, `front-page.php`, `functions.php`, `style.css`
- Inc: `inc/{theme-setup.php, enqueue.php, ajax.php, cpt-service.php}` (+ new `inc/options.php`)
- Pages: `page-services.php`, `page-services-enhanced.php`, `taxonomy-service_type.php`, `page-faq.php`, `page-about-us.php`, `page-become-a-partner.php`, `page-legal-disclaimer.php`
- Assets: `assets/css/{header.css,hero.css,landing-page.css,buttons.css,cards.css,sections.css,footer.css,responsive.css}`, `assets/js/{theme.js,landing-page.js,quick-view.js}`

### Risks & Dependencies

- Confirm KPI values/country count; decide URL/taxonomy for country hubs.
- Partner logo rights and accepted formats; procure updated assets.
- Keep to brand tokens in `style.css` to preserve visual identity.
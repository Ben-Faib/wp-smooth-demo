## Locale Switcher — TODO to make all regions and languages work end‑to‑end

Goal: Simple, standard, and robust multi‑region + multi‑language experience using minimal custom code. Prioritize proven WP patterns and plugin capabilities over bespoke logic.

### 1) Recommended architecture (standard, low‑risk)
- [ ] Prefer WordPress Multisite: one site per region domain (`.net`, `.ca`, `.co.uk`, `.com.au`, `.co.za`).
  - [ ] Enable Multisite (Network) and map each domain to its site.
  - [ ] Configure HTTPS + valid certs on all domains.
  - [ ] Set each site’s default language (usually English variant per region).
- [ ] Install Polylang (free) on each site to add languages: English, Français, Español, Deutsch.
  - [ ] Language URL format: use “The language is set from the directory name in URLs” (e.g., `/fr/`, `/es/`, `/de/`).
  - [ ] Enable media, menus, widgets, and string translations in Polylang.
- Why this path: Standard plugin behavior handles routing, canonical/hreflang, sitemaps, and menus per site, minimizing custom complexity.

Alternative (single site): Not recommended at scale. If used, still install Polylang and use directory‑based languages; region by domain will require domain mapping and extra care for hreflang and sitemaps.

### 2) Domain & network setup
- [ ] DNS records for all TLDs → the same hosting.
- [ ] Issue/renew SSL certificates per domain.
- [ ] WordPress Multisite created, each region domain mapped to correct site.
- [ ] Verify `home` and `siteurl` per site use the correct domain.

### 3) Language configuration per site (Polylang)
- [ ] Add languages: English (regional variant where applicable), Français, Español, Deutsch.
- [ ] Choose directory slug scheme (e.g., `en`, `fr`, `es`, `de`).
- [ ] Set default language per site (match region norm: `en-CA`, `en-GB`, etc.).
- [ ] Translate navigation menus, widgets, and site strings.
- [ ] Ensure translators have access/workflow.

### 4) Content and taxonomy
- [ ] Translate all key pages (About, Services, Contact, Legal pages) into FR/ES/DE.
- [ ] Translate service CPT content and taxonomies (names, slugs if needed). Avoid SEO‑breaking slug changes unless required.
- [ ] Translate reusable blocks/templates and any theme strings (generate `.pot`, add `.po`/`.mo`).
- [ ] Translate media alt text and captions where relevant.

### 5) Theme integration tasks (current custom selector)
- [ ] In `assets/js/locale.js` update navigation for non‑CA languages:
  - [ ] If Polylang is active with directory mode, prepend `/<lang>/` to the path before switching host.
  - [ ] If parameter mode is used anywhere, standardize on one approach across all sites (prefer directories).
  - [ ] Expand `inferRegionFromAcceptLanguage` to detect Spanish (es-*, es-MX, es-ES) and German (de-*).
- [ ] In `inc/locale-switcher.php` hreflang output:
  - [ ] When Polylang/SEO plugin is active, keep our hreflang off (default behavior already guards this).
  - [ ] If no plugin, extend to emit hreflang for FR/ES/DE only when distinct URLs exist (directory or param). Avoid advertising hreflang you can’t serve.
- [ ] Keep x‑domain allowlist strict to prevent open redirects.
- [ ] Keep no‑JS fallback list updated with correct language directories.

### 6) SEO & discovery
- [ ] Choose one hreflang authority: SEO plugin (Yoast/Rank Math) or Polylang’s integration. Keep theme hreflang disabled in that case.
- [ ] Ensure per‑site sitemaps include language alternates and are discoverable.
- [ ] Verify canonical URLs per language.
- [ ] OG/Twitter meta: output locale and translated titles/descriptions per language.
- [ ] Robots.txt per site: allow sitemaps and block staging paths if any.

### 7) Analytics and attribution
- [ ] Configure GA4 cross‑domain measurement across all TLDs (link domains, preserve client ID).
- [ ] Preserve UTM parameters during region/language navigation.
- [ ] Validate events and conversions per language and site.

### 8) Caching/CDN
- [ ] Ensure caches vary by host and by language directory.
- [ ] Purge rules per site and language.
- [ ] Edge redirects (if any) must not override plugin routing.

### 9) Forms, emails, and system messages
- [ ] Localize contact forms (labels, errors, success messages) per language.
- [ ] Localize transactional emails and admin notifications.
- [ ] Localize date/number formats and currency displays where shown.

### 10) Legal/compliance
- [ ] Translate Privacy Policy, Terms, and Cookies pages per language.
- [ ] Cookie banners and consent strings localized; respect language selection.

### 11) Edge cases & fallbacks
- [ ] Region guess: don’t auto‑redirect; show chip and respect user choice.
- [ ] If a translation is missing, link to default language URL for that site.
- [ ] Preserve path, query (including UTM), and hash across region/language switches.
- [ ] 404s: provide regionalized and localized 404 pages.

### 12) QA checklist
- [ ] Switch region: same path opens on new domain; UTMs preserved; SSL valid.
- [ ] Switch language: path gains correct `/<lang>/` directory on the same domain.
- [ ] Return to previous page state when closing dialog; focus restored (keyboard users).
- [ ] No duplicate hreflang when SEO plugin active; correct alternates visible otherwise.
- [ ] Sitemaps list language versions; Search Console submits per property.
- [ ] Chip appears only when Accept‑Language differs and only every 30 days if dismissed.
- [ ] No CLS from pill/chip/sheet on mobile and desktop.

### 13) Launch checklist
- [ ] Content complete for FR/ES/DE across all critical pages.
- [ ] Domains verified in Search Console (one per region domain).
- [ ] Analytics cross‑domain linking validated.
- [ ] Uptime/monitoring per domain.
- [ ] Rollback plan: feature flag `sm_locale_emit_hreflang`, `sm_locale_emit_og_locale`, and disable locale UI if needed.

### Implementation notes
- Keep to plugin‑standard routing (Polylang) and let SEO plugin own hreflang/canonicals where present.
- Our selector should: change domain for region, then apply language directory per site. Avoid custom rewrites.
- Debug/QA toggles remain available: `localePrompt=1`, `localeDebug=1`, `resetLocale=1`, `region`, `lang`.



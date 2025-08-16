Smooth Migration — Audit-Driven Improvement Plan (Living Document)

### How to use this document
- Treat each checkbox as a trackable task. Keep this file updated in PRs.
- Priorities: High = blockers/credibility/compliance; Medium = usability/conversion; Low = nice-to-have.
- Add links to commits/PRs beside tasks as you complete them.

### Phase 0 — Compliance & Critical Fixes (do first)
- [ ] **Missing legal pages (Privacy, Terms, Cookies)** — Links return 404 from footer and forms.
  - Action: Create WordPress pages for Privacy Policy, Terms of Service, Cookie Policy. Publish and link in `footer.php`, any form templates, and consent UIs.
  - Priority: High
- [ ] **Forms require acceptance of non-existent policies** — Partner and Realtor forms reference missing docs.
  - Action: After legal pages exist, update form links and validation messages to point to the correct URLs. Do not require acceptance until pages are live.
  - Priority: High
- [ ] **Cookie consent validity depends on published policies** — Current consent is non-compliant without policy pages.
  - Action: Pause showing/strictly limit cookie gating until legal pages are live; then wire banner “Learn more” links to Cookie Policy.
  - Priority: High
- [ ] **Location/Language pop-up persists on every page** — Does not remember choice; blocks interaction.
  - Action: Persist selection in cookie/localStorage with expiry; only re-prompt when missing/expired or user changes region. Ensure dismissal does not reappear during session.
  - Priority: High
- [ ] **Broken/placeholder links** — AI Checklist, Moving Guides, Cookies pages and disabled Terms button on Legal Disclaimer.
  - Action: Create pages or remove links until ready; enable Terms button once Terms page exists.
  - Priority: High

Dependencies
- Legal pages must be published before: cookie banner is valid, forms require acceptance, and footer links are final.
- Copy approvals for policies must precede “Last updated” dates and jurisdiction statements.

### Phase 1 — Credibility & Content Integrity
- [ ] **Provider names spelling** — “Remitely” → “Remitly”; “Vistor Insurance” → “Visitor Insurance”.
  - Action: Correct titles, slugs, and on-page references; add 301 redirects from old slugs.
  - Priority: High
- [ ] **Logo mismatch** — Rentcars page shows Discover Cars logo.
  - Action: Replace with correct brand asset; verify logo alt text matches provider.
  - Priority: Medium
- [ ] **Generic provider copy** — Identical descriptions, bullets, and fee tables across providers.
  - Action: Write unique “About”, “How it helps relocators”, “Why we recommend”, and “Fees & timeline” per provider with sources.
  - Priority: High
- [ ] **Fee/timeline accuracy** — One-size fee labels and 1–2 day timelines shown everywhere.
  - Action: Add provider-specific fee ranges and typical timeframes; include “indicative” note and source link per provider.
  - Priority: High
- [ ] **Statistics misformatted** — “3200,200+ successful referrals.”
  - Action: Correct to intended value (e.g., “3,200+”); store in theme options for future edits; display “as of” date.
  - Priority: High
- [ ] **Tagline grammar** — “Up to 30% cheaper than going direct”.
  - Action: Change to “going directly”.
  - Priority: Medium
- [ ] **Contact intro grammar** — “Let's Talk Whether you have questions”.
  - Action: Revise to: “Let's Talk — whether you have questions about our services, need guidance, or want to partner with us, we're here to help.”
  - Priority: Medium
- [ ] **Placeholder ‘Featured New’ prices** — Appear random/unlinked to listings.
  - Action: Either connect to real listings with source labels or remove/clearly label as examples.
  - Priority: Medium

Dependencies
- Provider copy and fee tables depend on research/partner data. Define minimum information per provider before editing at scale.

### Phase 2 — UI/UX & Accessibility Polishing
- [ ] **Service card truncation** — Text cut off due to fixed heights.
  - Action: Remove fixed heights; allow wrapping or add “Expand” pattern with a11y support.
  - Priority: High
- [ ] **Floating chat/consultation widget overlap** — Covers CTAs on small screens.
  - Action: Adjust z-index and safe area margins; avoid covering buttons; hide/simplify at narrow breakpoints.
  - Priority: High
- [ ] **Greyed icons/cards until scroll** — Content appears disabled.
  - Action: Make visible by default; only animate in-view subtly; respect `prefers-reduced-motion`.
  - Priority: Medium
- [ ] **Colour contrast and interactive states** — Light grey text on white; unclear hover/active states.
  - Action: Audit against WCAG AA; adjust tokens and states; ensure visible focus.
  - Priority: High
- [ ] **Alt text coverage** — Many images lack descriptive `alt` attributes.
  - Action: Write descriptive alt text for partner logos, hero backgrounds (decorative = empty alt).
  - Priority: Medium
- [ ] **Responsive overlaps** — Popup and chat sometimes overlap content.
  - Action: Test across devices; adjust breakpoints, spacing, and z-index layering.
  - Priority: High

Dependencies
- Contrast and motion updates should align with existing design tokens to avoid regressions.

### Phase 3 — Navigation & Information Architecture
- [ ] **Header menu is limited** — “Get in Touch” hamburger lacks full site navigation.
  - Action: Populate full primary navigation with Services mega/soft dropdown; ensure keyboard/focus support.
  - Priority: Medium
- [ ] **Footer resources/quick links** — Ensure categories and legal links aid discovery.
  - Action: Add quick links for key categories/resources; verify all URLs.
  - Priority: Medium
- [ ] **Missing pages (Guides, AI Checklist)** — Links currently 404.
  - Action: Create pages and content or remove links until ready.
  - Priority: High

Dependencies
- Final IA requires decisions on page scope for Guides/Checklist.

### Phase 4 — Forms UX & Validation
- [ ] **Realtor Locator complexity** — Many fields presented at once.
  - Action: Group into clear steps (property, timing/budget, contact, review); show progress; optional tooltips.
  - Priority: Medium
- [ ] **hCaptcha feedback** — No user-friendly errors.
  - Action: Add inline error messaging and summary; prevent silent failures.
  - Priority: Medium
- [ ] **Autofilled names (“John”, “Doe”)** — Misleads users.
  - Action: Replace with placeholders (“First name”, “Last name”); ensure no prefill values.
  - Priority: Medium

Dependencies
- Legal pages must be live before forms enforce policy acceptance.

### Phase 5 — Performance & QA
- [ ] **Image handling** — Ensure explicit sizes and lazy-loading for non-critical images and partner logos (≤12 logos).
  - Action: Constrain sizes, set width/height, lazy-load; provide retina assets.
  - Priority: Medium
- [ ] **Accessibility & Lighthouse** — Systematic QA after changes.
  - Action: Run Lighthouse (mobile/desktop), keyboard navigation checks, colour contrast audits; fix regressions.
  - Priority: Medium

### Cross-Category Index (by Category → Problem → Action → Priority)
- **UI/UX**
  - Truncated cards → Remove fixed heights/allow expand → High
  - Popup persists/overlaps → Persist choice; adjust z-index/breakpoints → High
  - Chat overlaps → Safe-area margins, responsive behavior → High
  - Greyed content on scroll → Visible by default; subtle/in-view animations → Medium
  - Contrast and states → WCAG AA audit and token adjustments → High
  - Alt text → Add descriptive alts → Medium
- **Content/Grammar**
  - Spelling (“Remitly”, “Visitor Insurance”) → Correct titles/slugs + 301 → High
  - Generic provider copy → Unique descriptions/bullets/fees → High
  - Fee/timeline accuracy → Provider-specific ranges with sources → High
  - Tagline/contact grammar → Fix copy → Medium
  - Placeholder prices → Remove or label clearly → Medium
  - Logo mismatch → Replace asset → Medium
- **Technical**
  - Broken links (Guides/AI Checklist/Cookies) → Create or remove until ready → High
  - Consent validity → Defer or fix post-legal pages → High
  - hCaptcha errors → Inline messages and handling → Medium
- **Legal/Compliance**
  - Privacy/Terms/Cookies missing → Create/publish/link → High
  - Legal Disclaimer date/jurisdiction → Verify and correct; align with operating region → Medium
  - Disabled Terms button → Enable once Terms exists → High
- **Navigation/Structure**
  - Limited header menu → Build full nav + services dropdown → Medium
  - Footer quick links → Add/tidy resources and legal links → Medium
  - Missing pages (Guides/Checklist) → Create or remove links → High

### Dependencies & Sequencing Summary
- Legal pages → enable cookie banner, footer/form links, and acceptance checkboxes.
- Provider data research → enables accurate copy/fees timelines.
- Design token updates → inform contrast/state fixes before broad CSS refactors.
- Slug corrections → require 301 redirects to preserve SEO.

### Success Metrics (define baselines now; measure 2 and 6 weeks post-release)
- **No broken links**: 0 4xx from scheduled crawler; GA “Outbound/404” events reduced by >90%.
- **Compliance**: Cookie banner links to live policies; consent log rate >95% with valid links.
- **Bounce rate (home/services)**: Decrease by 10–20% after UI/UX fixes.
- **Form conversion**: Realtor Locator and Partner forms completion rate +20%; hCaptcha error rate <2%.
- **Content engagement**: Service provider pages average time on page +25%; scroll depth to fee table >60%.
- **Accessibility**: Lighthouse Accessibility ≥ 90; 0 contrast violations in axe scans; keyboard nav passes.
- **Performance**: LCP < 2.5s on 75th percentile mobile; CLS < 0.1; Total size reduced (optimize logos/images).

### Implementation Notes (for engineers)
- Update links in `footer.php`, form templates, and any consent components when legal pages go live.
- For pop-up persistence, store choice in cookie/localStorage with a reasonable expiry (e.g., 30–90 days) and gate display accordingly.
- For slug changes (e.g., `remitely` → `remitly`, `vistor-insurance` → `visitor-insurance`), add 301 redirects in WordPress to avoid SEO loss.
- Keep animations subtle, trigger on hover/in-view only, and respect reduced-motion.

### Review & Governance
- Assign owners for each phase; add due dates.
- Add checkmarks and PR links as tasks are completed.
- Re-run audits (links, Lighthouse, axe) after each phase before moving to the next.



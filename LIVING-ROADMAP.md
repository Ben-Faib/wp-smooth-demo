## Smooth Migration — Living Roadmap & Checkpoints

Last updated: <fill on edit>

### How to use this document
- Update after every completed task: check the box, add a brief note under the current Phase’s Checkpoint Summary.
- Keep entries short, objective, and linked to commits/PRs (WP Pusher deployments acceptable).
- Use the provided checkpoint templates. At the end of each Phase, fill in the Phase Summary (Completed, Pending, Blockers).

### Links and References
- Detailed plan and rationale: `plan.md`
- Theme path: `app/public/wp-content/themes/smoothmigration/`
- Key files: `front-page.php`, `header.php`, `footer.php`, `functions.php`, `inc/{options.php,cpt-service.php,enqueue.php}`, `style.css`, `assets/css/{hero.css,header.css,buttons.css,landing-page.css,sections.css,footer.css}`

### Global Dependencies
- Legal pages must be current before cookie consent is considered valid.
- Options and term meta must exist before replacing hard-coded stats/timelines.
- Enforce design tokens and button variants before broad UI refactors to reduce rework.

### Success Metrics to Track (set baselines before Phase 2)
- Engagement: hero CTA CTR, flag chips CTR, footer resource clicks
- Conversion: contact form starts/completions
- A11y: AA contrast pass rate, keyboard navigation success
- Performance: LCP < 2.5s, CLS < 0.1, Lighthouse ≥ 90
- Quality: 0 broken links, valid cookie consent flows

---

## Phase 1 — Data/Admin Foundations (Options + Term Meta)

### Scope
- Create `inc/options.php` (Site Settings) for KPIs: moves (default 2500+), avg days, countries, community size, data source, as-of date, optional global “Last reviewed”
- Wire into `functions.php`; render Options on `front-page.php`
- Add `service_type` term meta “Typical timeline”; render on homepage cards and `taxonomy-service_type.php`

### Tasks
- [ ] Create `inc/options.php` with fields (KPI + source/as-of + optional global “Last reviewed”)
- [ ] Register settings, sanitize callbacks, and capabilities
- [ ] Wire options load in `functions.php`
- [ ] Replace hard-coded stats on `front-page.php` (trust metrics, hero, social proof)
- [ ] Add `service_type` term meta registration in `inc/cpt-service.php`
- [ ] Admin UI for term meta; render timelines on cards and taxonomy pages
- [ ] Unit smoke test: missing values fall back safely; no PHP notices

### Planned Checkpoints
- P1-C1: Options page scaffolding merged; fields render and persist
- P1-C2: Homepage stats sourced from Options; correct formatting and fallbacks
- P1-C3: Term meta registered and visible in admin; timelines render in cards/pages

### Checkpoint Summaries (fill as you go)
#### P1-C1 Summary
- Completed: <add>
- Pending: <add>
- Blockers: <add>

#### P1-C2 Summary
- Completed: <add>
- Pending: <add>
- Blockers: <add>

#### P1-C3 Summary
- Completed: <add>
- Pending: <add>
- Blockers: <add>

### Phase 1 Summary
- Completed tasks: <bullet list>
- Pending items: <bullet list>
- Blockers: <bullet list>

---

## Phase 2 — Homepage Hero and Primary IA (Flags, CTAs, Dropdowns)

### Scope
- Improve hero overlay/contrast; refine headline/subheadline
- Add flag chips (Canada first) and secondary CTA row
- Implement soft-box dropdowns with keyboard/focus/escape handling

### Tasks
- [ ] Strengthen hero overlay/gradient tokens for AA contrast (`assets/css/hero.css`)
- [ ] Refine copy + typographic scale for hero text (`front-page.php`)
- [ ] Add flag chips linking to hubs; add `aria-label`s (`front-page.php`, `landing-page.css`)
- [ ] Add secondary CTA row (About/Services/Contact/Partner/Relocation Plan)
- [ ] Populate Primary menu in WP; implement soft-box dropdown UI (`header.php`, `header.css`)
- [ ] Add sticky “Consult available” pill; respect `prefers-reduced-motion` (`front-page.php`, `landing-page.css`, `landing-page.js`)

### Planned Checkpoints
- P2-C1: Hero overlay + copy updated; AA contrast passes
- P2-C2: Flag chips and CTA row live and accessible
- P2-C3: Soft-box dropdowns keyboard-accessible; focus/escape verified

### Checkpoint Summaries (fill as you go)
#### P2-C1 Summary
- Completed: <add>
- Pending: <add>
- Blockers: <add>

#### P2-C2 Summary
- Completed: <add>
- Pending: <add>
- Blockers: <add>

#### P2-C3 Summary
- Completed: <add>
- Pending: <add>
- Blockers: <add>

### Phase 2 Summary
- Completed tasks: <bullet list>
- Pending items: <bullet list>
- Blockers: <bullet list>

---

## Phase 3 — Services System and Social Proof

### Scope
- Unify services card visuals; timelines from term meta; reorder top three
- Curate partner logos (≤12), constrain sizes, lazy-load; testimonials format “From → To”

### Tasks
- [ ] Mirror card system across homepage/services pages (`cards.css`, sections)
- [ ] Read timelines from term meta everywhere (`front-page.php`, `taxonomy-service_type.php`)
- [ ] Reorder homepage top services to Housing/Banking/Visas
- [ ] Curate partner logos; constrain dimensions; set explicit sizes; lazy-load (`landing-page.css`)
- [ ] Update testimonials to “From: X → To: Y”; curate excerpts

### Planned Checkpoints
- P3-C1: Services cards unified; timelines rendering; order updated
- P3-C2: Partners curated/sized/lazy-loaded; testimonials format updated

### Checkpoint Summaries (fill as you go)
#### P3-C1 Summary
- Completed: <add>
- Pending: <add>
- Blockers: <add>

#### P3-C2 Summary
- Completed: <add>
- Pending: <add>
- Blockers: <add>

### Phase 3 Summary
- Completed tasks: <bullet list>
- Pending items: <bullet list>
- Blockers: <bullet list>

---

## Phase 4 — FAQ, Footer, Legal/Compliance

### Scope
- FAQ category chips, contrast, motion prefs; optional “Last reviewed”
- Footer legibility, resources links, add Instagram; replace Twitter with X; verify legal links
- Legal pages: update content and “Last updated”; validate cookie consent

### Tasks
- [ ] Add FAQ chips; ensure visible focus and AA states (`page-faq.php`, `sections.css`)
- [ ] Improve FAQ contrast/active/hover; respect reduced motion
- [ ] Footer: increase font size/spacing; add quick category links; add Instagram; replace X branding; verify links (`footer.php`, `footer.css`)
- [ ] Update Privacy/Terms/Cookies/Disclaimer; add dates; verify content currency (`page-legal-disclaimer.php` + others if present)
- [ ] Validate cookie consent flows after legal pages updated

### Planned Checkpoints
- P4-C1: FAQ chips/contrast/motion complete; optional “Last reviewed” in place
- P4-C2: Footer updates live; social links accurate; legal links verified
- P4-C3: Legal content current; cookie consent validated

### Checkpoint Summaries (fill as you go)
#### P4-C1 Summary
- Completed: <add>
- Pending: <add>
- Blockers: <add>

#### P4-C2 Summary
- Completed: <add>
- Pending: <add>
- Blockers: <add>

#### P4-C3 Summary
- Completed: <add>
- Pending: <add>
- Blockers: <add>

### Phase 4 Summary
- Completed tasks: <bullet list>
- Pending items: <bullet list>
- Blockers: <bullet list>

---

## Phase 5 — A11y/Performance QA and Logo Handling

### Scope
- Enforce token-driven styles; visible focus states; scope scripts to pages
- Switch to `the_custom_logo()` with transparent vs scrolled variants; ensure retina sizing and no distortion
- Lighthouse/perf and a11y passes

### Tasks
- [ ] Audit and remove inline/override styles; enforce tokens (`style.css`, section CSS)
- [ ] Ensure visible focus states across components
- [ ] Scope scripts to relevant pages only (`inc/enqueue.php`)
- [ ] Implement `the_custom_logo()` in header; support scrolled state; keep footer logo consistent (`header.php`, `header.css`, `footer.php`)
- [ ] Performance QA: LCP, CLS, image dimensions, lazy-load non-critical images
- [ ] Lighthouse/a11y run; address regressions

### Planned Checkpoints
- P5-C1: Token audit complete; scripts scoped; focus states verified
- P5-C2: Logo handling implemented; Lighthouse/a11y targets met

### Checkpoint Summaries (fill as you go)
#### P5-C1 Summary
- Completed: <add>
- Pending: <add>
- Blockers: <add>

#### P5-C2 Summary
- Completed: <add>
- Pending: <add>
- Blockers: <add>

### Phase 5 Summary
- Completed tasks: <bullet list>
- Pending items: <bullet list>
- Blockers: <bullet list>

---

## Checkpoint Entry Template (copy/paste)
```
Checkpoint: P<phase>-C<index>
Date: YYYY-MM-DD
Owner: <name>
Related PR/Deploy: <link or ref>

Completed:
- <concise bullets>

Pending:
- <concise bullets>

Blockers:
- <concise bullets>
```

## Task Entry Template (for each checkbox)
```
- [ ] <task title>
  - Owner: <name> | Due: <date> | Status: Not started / In progress / In review / Done
  - Notes: <short implementation note>
  - Links: <PR/commit/issue>
```

## Changelog (append entries as tasks complete)
- YYYY-MM-DD: <short note of what shipped + link>



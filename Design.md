Developer: # Site-Wide Design Implementation Document: Scandinavian Hygge Aesthetic

## Introduction
This document outlines a comprehensive, senior-level design system for the relocation company website, reflecting Scandinavian hygge principles. Implementation is tokenized and maintainable for clean, air-tight results without custom complexity or external dependencies. The essence: soft neutral palettes, airy white space, warm textures, natural-light imagery, and a modern, professional, yet welcoming atmosphere.

## 1. Color Palette (Soft Neutrals & Warm Accents)
- Apply calming neutral tones throughout, avoiding saturated blues/teals and strong gradients.
- Integrate a single warm accent to unify CTAs and highlights.
- Add palette as `.hygge` CSS class for easy opt-in and A/B testing. Insert these CSS variable overrides near end of `style.css`:

```css
.hygge {
  --primary-color: #2F3E46;
  --primary-dark: #2A3439;
  --primary-light: #607D8B;

  --secondary-color: #8F9A88;
  --secondary-dark: #6F7A73;
  --secondary-light: #B7C2B5;

  --accent-color: #D8A27D;
  --accent-dark: #C08864;
  --accent-light: #E8BFA0;

  --text-dark: #2E2E2E;
  --text-medium: #4A4A4A;
  --text-light: #737373;

  --bg-white: #FFFFFF;
  --bg-light: #FAFAF7;
  --bg-lighter: #F4F1EC;
  --bg-section: #FBFBF8;

  --border-light: #E7E2DA;
  --border-medium: #DCD6CE;

  --shadow-xs: 0 1px 2px rgba(0,0,0,.03);
  --shadow-sm: 0 2px 8px rgba(0,0,0,.06);
  --shadow-md: 0 6px 16px rgba(0,0,0,.08);
  --shadow-lg: 0 12px 24px rgba(0,0,0,.1);

  --border-radius: 8px;
  --border-radius-sm: 6px;
  --border-radius-lg: 12px;
  --border-radius-xl: 16px;
}
```

## 2. Typography (Calm, Modern, Human)
- Use system sans-serif for best performance and consistent aesthetics site-wide.
- Reserve serif for select, warmth-adding headlines (hero, testimonials).
- Remove text shadow for a clean, breathable feel.
```css
body { font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial; font-size: 17px; line-height: 1.6; }
h1, h2, h3, h4, h5, h6 { font-family: inherit; font-weight: 700; letter-spacing: 0; }
.hero h1, .hero-landing h1 { font-weight: 800; text-shadow: none; }
```

## 3. Layout & White Space (Airy & Reassuring)
- Reduce container width to 1100px for an airy layout.
- Increase section padding (4.5rem vertical) to maximize whitespace.
```css
.container { max-width: 1100px; }
section { padding: 4.5rem 0; }
```

## 4. Header & Navigation (Simple & Intuitive)
- Header remains static white with minimalist divider.
- Remove background blur and animated underlines for clarity.
- CTA appears as subtle outline button, strengthening navigation clarity.
```css
.site-header { background:#fff; backdrop-filter:none; -webkit-backdrop-filter:none; box-shadow:0 1px 0 var(--border-light); }
.navbar-nav .nav-link::before { display:none; }
.nav-cta-btn { background:transparent !important; border:1px solid var(--border-medium) !important; color:var(--text-dark) !important; box-shadow:none; }
.nav-cta-btn:hover { background:var(--bg-light) !important; transform:none; box-shadow:none; }
```

## 5. Hero Area (Natural Light & Human Moments)
- Feature one strong, natural-light photo capturing human moments — moving, candid warmth, daylight.
- No busy patterns, gradients, or overlays; clean and approachable.
- Readability overlay is gentle; hero height reduced.
```css
.hero-landing { background:url('../images/hero-human-moment.jpg') center/cover no-repeat; background-blend-mode:normal; min-height:75vh; }
.hero-landing::before, .hero::before { display:none; }
.hero-landing .hero-overlay-dark { background:linear-gradient(180deg, rgba(0,0,0,.25), rgba(0,0,0,.45)); }
.hero::after { opacity:.04; }
```

## 6. Buttons (Soft, Tactile, No Gimmicks)
- Gentle box shadows, subtle transitions — no shine, ripples, or harsh elevation.
- Sneakers hover/focus effects.
```css
.btn { box-shadow:var(--shadow-xs); transition: background-color .2s ease, color .2s ease, box-shadow .2s ease, transform .15s ease; }
.btn::before, .btn .ripple { display:none !important; }
.btn-primary { background:var(--primary-color); border:1px solid transparent; color:#fff; }
.btn-primary:hover { background:var(--primary-dark); transform:translateY(-1px); box-shadow:var(--shadow-sm); }
.btn-outline-primary { border:1px solid var(--primary-color); }
.btn-outline-primary:hover { background:var(--primary-color); color:#fff; box-shadow:var(--shadow-sm); transform:none; }
```

## 7. Cards & Features (Quiet, Breathable)
- Minimize visual noise, remove glassmorphism and heavy shadow.
- Gentle elevation on hover; focus on content.
```css
.service-card, .step-card, .feature-item { backdrop-filter:none; -webkit-backdrop-filter:none; box-shadow:var(--shadow-xs); }
.service-card:hover, .step-card:hover, .feature-item:hover { transform:translateY(-2px); box-shadow:var(--shadow-sm); }
.service-overlay { background:linear-gradient(180deg, transparent 0%, rgba(0,0,0,.25) 100%); opacity:.85; }
```

## 8. Imagery Principles (Content Guidance)
- Use daylit scenes, warm woods/linens, human touch — hands, movement, smiles, coffee. Candid, not staged.
- Backgrounds uncluttered, cropped to 3:2 or 16:9. Monochrome logos, gentle brightness. No heavy post-processing.

## 9. Motion & Accessibility
- All motion is subtle, short, and optional (`prefers-reduced-motion` support is active).
- Ensure visible focus outlines on interactive elements.
- No shimmer/ripple effects for utmost clarity.

## 10. Content Hierarchy
- **Hero:** One-line value proposition, strong primary CTA, and secondary “How it works” link below.
- Use reassuring micro-copy: “Flexible scheduling, trusted movers, fair pricing.”
- Below hero: Show concise 3-step process and a testimonial with a human photo.

## 11. Zero-Risk Implementation Toggle
- Integrate `.hygge` preview with query param for safe, non-disruptive deployment.
```javascript
(function(){try{var p=new URLSearchParams(location.search);if(p.get('style')==='hygge')document.documentElement.classList.add('hygge');}catch(e){}})();
```
- Add to `assets/js/theme.js`. Preview at `?style=hygge`. Remove param to return to current styling.

## 12. Remove/Phase Out in Current CSS
- Gradients and overlays in hero.
- Button shine/ripple.
- Glass/blur on cards and header; strong elevation/shadows.
- Animated nav underlines.

## 13. Implementation & QA
- No new dependencies; all changes override with CSS variables.
- No template changes — update imagery and copy only.
- JS only extended for optional preview toggle.
- Accessibility: contrast, tap targets, header readability, lazy-loaded images, and CLS mitigation.

---

## Summary
- **Color/Palette:** Hygge-optimized variables, previewable via query param.
- **Atmosphere:** Calm, modern, friendly, reassuring, and professional.
- **Implementation:** Standards-based, low-complexity CSS overrides, no custom code.
- **Imagery:** Natural, candid, warm, and simple — reflecting real human moments in Scandinavian style.
- **QA:** All site-wide changes are tokenized, easily testable, and reversible.

---

*This document serves as both a technical and creative guide to transform the relocation company website according to Scandinavian digital design leadership and hygge-inspired best practices. All recommendations are implementation-ready and built for quality assurance and maintainability.*
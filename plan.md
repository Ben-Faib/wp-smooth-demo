# World Map SVG — Implementation Plan and QA Guide

File: `app/public/wp-content/themes/smoothmigration/assets/svg/world-map.svg`  
Scope: hub placement, origin placement, routes, country outlines, accessibility, debug, and QA.

## Goals
- Place blue hub dots accurately on: New York City (US), Vancouver (CA), London (UK), Cape Town (SA), Melbourne (AU).
- Place yellow origin dots on visible land across many unique countries and connect them to one or more hubs.
- Add distinct colored outline halos around Canada, United States, United Kingdom, South Africa, and Australia.
- Keep subtle animation; fully respect `prefers-reduced-motion`.
- Provide a zero-JS debug toggle for verification.

## Projection model and conventions (corrected)
- Coordinate space: 800×400 SVG viewBox.
- Base map: Natural Earth 110m land pre‑projected to Winkel Tripel (WinTri). Therefore, use WinTri forward projection for all coordinates (NOT equirectangular).
- Central meridian: `λ₀ = 0°`. Standard parallel: `φ₁ = arccos(2/π) ≈ 50.467°`.
- Animations must not run when `prefers-reduced-motion: reduce`.
- No external paid assets; keep to SVG/CSS only.

WinTri forward projection used here (pseudo‑code / JS):

```js
// inputs in degrees, output in SVG pixels for an 800×400 canvas
function lonLatToPixel(lonDeg, latDeg, bbox = computedWintriBBox) {
  const W = 800, H = 400; // viewBox
  const toRad = d => (Math.PI / 180) * d;
  const lon = toRad(lonDeg);
  const lat = toRad(latDeg);
  const λ0 = 0; // central meridian
  const φ1 = Math.acos(2 / Math.PI); // ≈ 0.880 rad (50.467°)
  // Aitoff helper
  const λ = lon - λ0;
  const α = Math.acos(Math.cos(lat) * Math.cos(λ / 2));
  const sinc = α === 0 ? 1 : Math.sin(α) / α;
  const xA = 2 * Math.cos(lat) * Math.sin(λ / 2) / sinc;
  const yA = Math.sin(lat) / sinc;
  // Winkel Tripel: average of Aitoff and equirectangular at φ1
  const xW = (xA + λ * Math.cos(φ1)) / 2;
  const yW = (yA + lat) / 2;
  // Normalize to pixels using a bbox precomputed by gridding lon/lat
  // bbox = { xmin, xmax, ymin, ymax } in WinTri coords
  const x = (xW - bbox.xmin) / (bbox.xmax - bbox.xmin) * W;
  const y = (1 - (yW - bbox.ymin) / (bbox.ymax - bbox.ymin)) * H;
  return { x, y };
}
```

How to get `computedWintriBBox`:
- Grid lon `[-180,180]` and lat `[-90,90]` every 1–2 degrees, project with the function above, take min/max of `xW`, `yW` to form `{xmin,xmax,ymin,ymax}`.
- Use the same bbox for all points to match the land layer’s extents. Optionally shrink by ~1% to add a small breathing margin.

---

## Stage 1 — Baseline, projection, and helpers
- Confirm map renders at 800×400.
- Embed the WinTri conversion snippet (above) as a comment in the plan and keep a local script to recompute pixel coordinates on demand.
- Compute the WinTri bbox by gridding and lock it in the repo (JSON in `assets/svg/wintri-bbox.json`).
- Add a hidden debug grid and labels, revealed by:
  - Setting `data-debug="1"` on the root `<svg>`, or
  - Loading with `#debug` fragment.

Deliverables
- Inline `<style>` with `.debug` rules.
- `<g id="debug" class="debug">` grid at 80px intervals.

Acceptance criteria
- Toggling `data-debug="1"` shows the grid and labels without JS.

---

## Stage 2 — Hubs (blue)
- Place the five blue hubs using WinTri‑derived pixels (rounded) and allow ±4px visual nudge per region to sit cleanly on land.
- Keep soft glow + pulse animation; hide via reduced-motion media query.

| Hub        | Lat, Lon            | Pixel (x,y) | Notes |
|------------|----------------------|-------------|-------|
| Vancouver  | 49.2827, −123.1207  | (~126, ~90) | Canada west coast |
| New York   | 40.7128, −74.0060   | (~236, ~112)| US east coast |
| London     | 51.5074, −0.1278    | (~400, ~86) | UK |
| Cape Town  | −33.9249, 18.4241   | (~441, ~285)| South Africa |
| Melbourne  | −37.8136, 144.9631  | (~722, ~288)| Australia |

Deliverables
- Updated `<g class="hubs">` with the coordinates above and existing animations.

Acceptance criteria
- Each hub sits clearly on the intended land mass; no overlap with oceans at 1× and 2× DPR.

---

## Stage 3 — Origins (yellow)
- Curate origin dots across unique countries on continent land masses only (no islands or micro‑states that are absent at 110m resolution).
- Keep comments per city for maintainability.
- Ensure geographic spread across Americas, Europe/MENA, Africa, and Asia (mainland) + Australia (as the only Oceania continent).

Deliverables
- Updated `<g class="origins">` with a diverse mainland set (examples; all WinTri‑projected):
  - Americas: Mexico City (MX), Bogotá (CO), Lima (PE), São Paulo (BR), Buenos Aires (AR)
  - Europe/MENA (mainland): Madrid (ES), Berlin (DE), Paris (FR), Rome (IT), Istanbul (TR), Casablanca (MA)
  - Africa (mainland): Lagos (NG), Luanda (AO), Nairobi (KE), Addis Ababa (ET)
  - Asia (mainland): Mumbai (IN), Delhi (IN), Dubai (AE), Riyadh (SA), Tehran (IR), Bangkok (TH), Ho Chi Minh City (VN), Kuala Lumpur (MY), Guangzhou (CN), Seoul (KR)
- Keep `filter="url(#glow)"` for visual consistency.

Acceptance criteria
- All yellow dots are over continent land (no islands); 15–20 unique countries minimum; no cluster overlaps hubs.

---

## Stage 4 — Routes
- Use quadratic curves (`Q`) from each origin to one or more hubs to indicate migration.
- Style: `stroke="#fbbf24"`, `stroke-width="1.2"`, `stroke-dasharray="4,4"`, `fill="none"`.
- Create several multi-hub links to show diversity (e.g., Tokyo → Vancouver and → Melbourne; Cairo → London and → Cape Town).

Deliverables
- `<g class="routes">` organized in blocks by destination hub with clear comments.

Acceptance criteria
- Routes terminate on hubs; avoid lines that end in ocean; density balanced so the map remains readable.

---

## Stage 5 — Country border outlines (distinct colors) — corrected
- Replace ellipses with actual country border paths (stroke only) for:
  - Canada: `#06b6d4`
  - United States: `#ef4444`
  - United Kingdom: `#a78bfa`
  - South Africa: `#10b981`
  - Australia: `#f59e0b`
- Source: Natural Earth Admin‑0 (110m) for each country; project to WinTri with the same parameters and scale used for the land layer.
- Simplify to ~1–2px fidelity at 800×400 to keep file size reasonable.
- Style: `fill="none"`, `stroke` per color, `stroke-width="1.2"`, `stroke-dasharray="6,6"`, `filter="url(#glow)"`.

Deliverables
- `<g class="country-borders">` containing five `<path>` elements that follow the real borders.

Acceptance criteria
- Strokes follow visible coastlines/borders at 110m resolution; colors are distinct and readable; no ellipses remain.

---

## Stage 6 — Accessibility, motion, and performance
- Keep pulse animations wrapped with `[data-anim]` and disabled via:
  ```css
  @media (prefers-reduced-motion: reduce) {
    [data-anim] { display: none; }
  }
  ```
- Ensure adequate contrast for hubs and origins on the gradient.
- SVG remains <100KB uncompressed where practical.

Deliverables
- Verified reduced-motion behavior.
- Final size check.

Acceptance criteria
- No animation when reduced-motion is on.
- Visuals remain legible on standard laptop and mobile widths.

---

## Stage 7 — QA and sign‑off
- Cross-check hub locations against a reference map using the debug grid.
- Verify every origin dot is on land at 110m granularity.
- Scan routes for kinks/overlaps; adjust control points as needed.
- Validate halo colors and positions.
- Smoke test in Safari, Chrome, Firefox on macOS; Chrome/Edge on Windows.
- Run through responsive containers (CSS scaling) to ensure no clipping.

Definition of Done
- All acceptance criteria above pass.
- No yellow dot in ocean; no route endpoints off the hub coordinates.
- Distinct colored halos present for CA, US, UK, SA, AU.
- Reduced-motion respected; debug toggle works.

---

## Maintenance guide

Add a new origin
1. Convert city lat/lon to pixel:
   ```
   x = (lon + 180) * 800 / 360
   y = (90 - lat) * 400 / 180
   ```
2. Place a `<circle>` with `r="3"` and `filter="url(#glow)"`.
3. Add one or more routes to the nearest hub(s) using `Q` curves.
4. Verify on land with the debug grid.

Adjusting hubs or halos
- Update coordinates in the hubs table and move related route endpoints.
- Recenter/re‑size the corresponding halo ellipse; keep stroke width and dash pattern consistent.

Debug usage (no JS)
- Temporarily set `data-debug="1"` on the root `<svg>` or load with `#debug` to reveal the grid and labels.

Appendix — Projection references
- Winkel Tripel forward formula as implemented above (WinTri = mean of Aitoff and equirectangular at `φ₁ = arccos(2/π)`).
- Bbox must be computed once for the repo and reused; do not mix formulas (no equirectangular short‑cuts).
- Example (sanity check, approximate pixels for this repo’s bbox):
  - NYC (40.7128, −74.0060) → ≈ (236, 112)
  - London (51.5074, −0.1278) → ≈ (400, 86)
  - Vancouver (49.2827, −123.1207) → ≈ (126, 90)
  - Cape Town (−33.9249, 18.4241) → ≈ (441, 285)
  - Melbourne (−37.8136, 144.9631) → ≈ (722, 288)
<!-- a20ccd68-49ec-49ce-b2ea-aeace815bd5e 479fd19d-8760-4167-b3ad-51c629288a0f -->
# NBC Page Updates & Multi-Domain Service Management

## Overview

Update the National Bank of Canada service page to mirror the official NBC newcomers page (https://www.nbc.ca/personal/accounts/newcomers.html), implement a flexible awards/badges system for all services, and create deployment infrastructure for managing 5 domains (.net, .ca, .uk, .com.au, .co.za) using GitHub + WP Pusher.

## 1. Flexible Awards System

### 1.1 Custom Fields for Service Awards

Update `inc/cpt-service.php` to add awards repeater fields:

- Award title (e.g., "Best Bank for Newcomers to Canada")
- Award organization (e.g., "MoneySense") 
- Award year (e.g., "2024")
- Award badge image (media library ID)
- Award description (optional text)
- Award link (optional URL)

Add meta box to service edit screen with repeater UI for managing multiple awards.

### 1.2 Award Display Functions

Create helper functions in `inc/service-helpers.php`:

- `smoothmigration_get_service_awards()` - Retrieve all awards for a service
- `smoothmigration_display_award_badge()` - Render single award badge
- `smoothmigration_display_awards_section()` - Render full awards section

## 2. NBC Service Page Content Updates

### 2.1 Hero Section Enhancement

Update `single-service.php` hero to include award badges display alongside logo using new helper functions. Display up to 3 award badges horizontally below the main CTA buttons.

### 2.2 Sidebar Awards Display

Update sidebar in `single-service.php` to add "Awards & Recognition" card after "Why We Recommend" section. Show award badges vertically with organization, year, and title.

### 2.3 Dedicated Awards Section

Add new tabbed section "Awards" to service navigation after FAQs. Create expandable accordion for each award showing:

- Badge image
- Full award title and description
- Organization and year
- Link to award announcement (if available)

### 2.4 NBC Specific Content

Update NBC service post content to include:

**Promotion Details:**

- Up to $550 cashback promotion
- $300 for opening chequing account + direct deposit
- $100 for eligible credit card
- $50 for systematic savings
- $100 for pre-authorized mortgage payments
- No fixed monthly fees for up to 3 years
- 12 months free legal support

**Key Features:**

- One of Canada's 6 major banks (established 1859)
- 361+ branches across Canada
- 2,071 ABMs nationwide
- Services in 6 languages
- International ABM network access
- CDIC deposit protection
- Full newcomer eligibility criteria (90 days before to 5 years after arrival)

**Benefits Breakdown:**
Create custom shortcode `[nbc_promotion_table]` to display the cashback breakdown table dynamically.

### 2.5 Enhanced "How It Helps" Section

Expand with NBC-specific benefits:

- Step-by-step account opening process
- Credit building with secured cards
- International money transfers from $5.95
- Legal assistance service details
- Banking advisor support

### 2.6 Fees & Timeline Section

Update with NBC-specific pricing:

- Monthly fee structure (Year 1: $0, Year 2: $7.98, Year 3: $11.96)
- Account opening timeline
- Credit card approval process
- Total savings calculator ($334.92 baseline to $671.30 maximum)

## 3. Award Badge Image Upload

### 3.1 Upload NBC Award Images

Upload the 3 award badge images to WordPress Media Library:

- `2025_Milesopedia-Awards_Best-Bank_Newcomers-QUEBEC_Comptes.png`
- `image.png` (2024 MoneySense)
- `img-milesopedia-2023-newcomers-en.png`

Add appropriate alt text and titles for accessibility.

### 3.2 Assign to NBC Service

Use the new awards repeater to add all 3 awards to National Bank of Canada service post:

1. **2025 Milesopedia** - Best Bank Account, Newcomers to Quebec
2. **2024 MoneySense** - Best Bank for Newcomers to Canada
3. **2023 Milesopedia** - Best Credit Card, Newcomers

## 4. Custom Single-Service Import Tool

### 4.1 Create Admin Import Page

Create `inc/service-single-import.php` with admin page under Tools > Import Single Service.

Features:

- Country/domain selector dropdown
- Service search/select (autocomplete by partner name)
- JSONL file upload or paste raw JSON
- Preview changes before import
- Individual field override checkboxes
- Import log with success/error messages

### 4.2 Import Logic

Parse JSONL structure matching `canada_context.jsonl` format:

- Partner name → post title
- Category → service_type taxonomy
- Overview → post content (first paragraph)
- "Why we recommend" → custom meta field
- "How it helps" → custom meta field  
- Link → affiliate URL meta
- quick_view → post excerpt

Support partial updates (only update selected fields, leave others unchanged).

### 4.3 Bulk Processing Option

Add "Import Multiple Services" tab for processing entire JSONL files for a country at once, with individual service review/approval.

### 4.4 Domain-Specific Handling

Add domain/country mapping in tool:

- `.ca` → Canada
- `.com` / `.net` → United States
- `.co.uk` → United Kingdom
- `.com.au` → Australia
- `.co.za` → South Africa

Store domain affiliation as service meta to enable multi-domain filtering.

## 5. WP Pusher Deployment Strategy

### 5.1 GitHub Repository Setup

Current structure: Theme files at `app/public/wp-content/themes/smoothmigration/`

Recommendations:

- Keep existing GitHub repo for version control
- Use branches for domain-specific customizations if needed
- Tag releases for production deployment (v1.0.0, v1.1.0, etc.)

### 5.2 WP Pusher Configuration

Install WP Pusher on all 5 domains:

- Connect to GitHub repository
- Set branch: `main` (or `production`)
- Enable automatic deployment on push (or manual deploy)
- Set theme subdirectory path: `smoothmigration`

### 5.3 Deployment Workflow

1. **Local Development:** Make changes in local environment
2. **Testing:** Test on local site (wp-smooth-demo)
3. **Commit & Push:** Push to GitHub repository
4. **Deploy:** Use WP Pusher dashboard to deploy to production domains
5. **Verify:** Check each domain for successful deployment

### 5.4 Service Content Deployment

For service-specific content updates:

1. **Export from local:** Use new Single Service Import tool to export service data as JSON
2. **Upload to production:** Use the same tool on production domains to import
3. **Media sync:** Upload award badges and logos manually to each domain's Media Library (or use WP All Import for automation)

### 5.5 Domain-Specific Variations

If domains need different theme features:

- Option A: Use conditional logic in theme based on `get_bloginfo('url')`
- Option B: Create custom branches per domain in GitHub
- Recommendation: Start with Option A (single branch with conditionals) for easier maintenance

## 6. Testing & Quality Assurance

### 6.1 Local Testing Checklist

- [ ] Awards display correctly in all 3 locations (hero, sidebar, dedicated section)
- [ ] NBC promotion details render properly
- [ ] Responsive design on mobile/tablet
- [ ] Accessibility (screen readers, keyboard navigation)
- [ ] Awards system works for other services

### 6.2 Production Deployment Checklist

- [ ] Backup production databases before deployment
- [ ] Test WP Pusher deployment on staging/test domain first
- [ ] Verify award badge images upload correctly
- [ ] Import NBC service data using Single Service Import tool
- [ ] Test affiliate link tracking
- [ ] Cross-browser testing (Chrome, Safari, Firefox, Edge)

### 6.3 Multi-Domain Verification

After deploying to all 5 domains:

- [ ] Verify theme deploys successfully via WP Pusher
- [ ] Check that NBC service only appears on `.ca` (Canada) domain
- [ ] Test Single Service Import tool on each domain
- [ ] Verify domain-specific service filtering

## 7. Documentation

### 7.1 Awards System Usage Guide

Create documentation in theme README:

- How to add awards to any service
- Award badge image specifications (recommended size, format)
- Display customization options

### 7.2 Import Tool Documentation

Document the Single Service Import workflow:

- JSONL format requirements
- Field mapping reference
- Troubleshooting common import errors
- Domain/country assignment guide

### 7.3 Deployment Guide

Document the WP Pusher workflow:

- How to deploy theme updates
- How to rollback if needed
- Service content update process
- Media library sync strategy

## Key Files to Modify

**Theme Files:**

- `inc/cpt-service.php` - Add awards custom fields
- `inc/service-helpers.php` - Add award display functions
- `single-service.php` - Update hero, sidebar, add awards section
- `inc/service-single-import.php` - NEW: Single service import tool
- `functions.php` - Register new import tool menu

**Service Content:**

- Update National Bank of Canada service post via WordPress admin
- Upload 3 award badge images to Media Library
- Add awards using new repeater fields

**Deployment:**

- GitHub repository (existing)
- WP Pusher installation on all 5 production domains

### To-dos

- [ ] Implement flexible awards/badges custom field system in cpt-service.php with repeater UI
- [ ] Create award display helper functions in service-helpers.php
- [ ] Update single-service.php to display awards in hero, sidebar, and dedicated section
- [ ] Create NBC-specific content sections with promotion details and benefits
- [ ] Upload 3 NBC award badge images to Media Library with proper alt text
- [ ] Build custom Single Service Import admin tool in inc/service-single-import.php
- [ ] Create import tool UI with service selector, JSONL parser, and preview functionality
- [ ] Add domain/country mapping and filtering to import tool
- [ ] Document WP Pusher deployment workflow for 5 domains
- [ ] Test awards system, NBC page updates, and import tool locally before deployment
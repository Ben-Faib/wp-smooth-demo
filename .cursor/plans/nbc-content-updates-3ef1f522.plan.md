<!-- 3ef1f522-6952-474b-81c7-eebae12d6e98 ff092d60-8221-49eb-9f07-a9d028aa9c49 -->
# NBC Service Page Content Updates

## Overview

Update the National Bank of Canada service page to display custom section headings and content. The solution uses custom meta fields for content storage with NBC-specific conditional display logic in the template, allowing for future expansion to other services.

## Implementation Approach

**Storage Strategy:** Create custom meta fields for each section (why_choose, how_helps_newcomers, offer_details, contact_info, timeline_details) that store the custom content.

**Display Logic:** Update `single-service.php` to detect if the current service is "National Bank of Canada" and conditionally render the custom sections when those meta fields exist.

**Future-Proof:** This approach allows any service to use custom sections by simply populating the meta fields, making it easy to expand beyond NBC later.

## 1. Add Custom Meta Fields

**File:** `app/public/wp-content/themes/smoothmigration/inc/cpt-service.php`

Add new meta box "Custom Sections" with fields:

- `_service_section_why_choose` (textarea) - "Why Choose [Service]" content
- `_service_section_how_helps_newcomers` (textarea) - "How they help newcomers" content  
- `_service_section_offer` (textarea) - "Offer for Newcomers" content
- `_service_section_contact` (textarea) - "Contact" section content
- `_service_section_timeline_details` (textarea) - "Typical Timeline" details
- `_service_section_little_details` (textarea) - "Little details that matter" (FAQ) content
- `_service_cta_primary_text` (text) - Primary CTA button text
- `_service_cta_primary_url` (url) - Primary CTA button URL
- `_service_cta_secondary_text` (text) - Secondary CTA button text
- `_service_cta_secondary_url` (url) - Secondary CTA button URL

Add save logic to persist these fields when editing a service.

## 2. Update Single Service Template

**File:** `app/public/wp-content/themes/smoothmigration/single-service.php`

### 2.1 Detect Custom Sections

At the top of the template, check if custom section meta fields exist:

```php
$has_custom_sections = get_post_meta( get_the_ID(), '_service_section_why_choose', true );
```

### 2.2 Update Hero Section CTAs

Replace hardcoded button text/URLs with custom CTA fields when they exist:

```60:40:single-service.php
// Current: "Visit Partner" and "Talk to Our Team"
// Update to use custom CTAs if available
```

### 2.3 Update Tab Navigation

Conditionally display tab labels based on whether custom sections exist:

- "Overview" → "Why choose [Service]" (if custom field exists)
- "How It Helps Relocators" → "How they help newcomers" (if custom field exists)
- "Fees & Speed" → "Offer for Newcomers" (if custom field exists)
- "Countries" → "Contact" (if custom field exists)
- "FAQs" → "Little details that matter" (if custom field exists)

### 2.4 Update Section Content

Replace generic section content with custom field content when available:

```100:119:single-service.php
// Current sections use hardcoded content
// Update to pull from custom meta fields when they exist
```

### 2.5 Update Sidebar CTAs

Update sidebar button text to use custom CTA fields.

### 2.6 Update Sticky CTA Bar

Update bottom sticky CTA buttons to use custom CTA fields.

## 3. Populate NBC Service Content

Using WordPress admin, populate the National Bank of Canada service with the provided content:

**Why choose National Bank:**

```
National Bank of Canada is one of Canada's six largest banks, with a dynamic presence across key financial segments such as personal, business, and international banking. Offering a wide range of products and services, National Bank is committed to providing high-quality service. Discover why National Bank was named the top bank for newcomers by MoneySense in 2024 and how they're helping their clients build their future in Canada.
```

**How they help newcomers:**

```
National Bank makes handling your everyday transactions simple. From getting the credit card that best fits your needs, to creating a long-term financial strategy, National Bank's services for newcomers are designed to give you the tools and support you need to build your future in Canada.

Take advantage of a wide range of banking products and services to manage your finances more confidently and build your projects in Canada.
• Unlimited electronic transactions and Interac e-transfers®; plus access to mortgages, auto loans, business accounts, investment solutions and more.
• Come visit us at one of our over 360 branches, or access one of our 2,000 automated banking machines across Canada.
• Access your funds abroad by making withdrawals at an ABM using our network partners around the world.
• Your deposits with National Bank of Canada are protected by the Canada Deposit Insurance Corporation (CDIC).
• Save on your first order of 100 cheques (not including tax and shipping).
```

**Offer for Newcomers:**

```
Get up to $550 cashback to help give your Canadian projects a boost 

Your success in Canada starts here, with our special promotion for newcomers. All you need to do is open a chequing account, then add other eligible banking products to the offer by completing the necessary transactions.* Take advantage of this offer from 90 days before your arrival and up to 5 years afterward.
```

**Typical Timeline:**

```
Take advantage of this offer from 90 days before your arrival and up to 5 years afterward.
```

**CTAs:**

- Primary: "Advice on getting settled" → https://www.nbc.ca/personal/switch-national-bank/newcomers/guide.html
- Secondary: "Open an account online" → TBD

## 4. Testing

- Verify custom sections display correctly on NBC service page
- Verify other services still display default sections
- Test responsive design on mobile/tablet
- Verify CTAs link to correct URLs
- Test that sections can be edited via WordPress admin

## Key Files Modified

- `inc/cpt-service.php` - Add custom section meta fields
- `single-service.php` - Conditional display logic for custom sections

### To-dos

- [ ] Add custom meta box and fields to cpt-service.php for NBC-specific sections
- [ ] Update single-service.php with conditional logic to display custom sections
- [ ] Populate NBC service with provided content via WordPress admin
- [ ] Test NBC page displays custom sections correctly and other services use defaults
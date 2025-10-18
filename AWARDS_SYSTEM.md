# Awards & Recognition System

Flexible system for displaying awards, badges, and recognition for service partners across the Smooth Migration platform.

## Overview

The awards system allows you to add multiple awards to any service post, with automatic display in three key locations:
1. **Hero Section** - Compact badges below CTA buttons
2. **Sidebar** - Detailed cards with organization and year
3. **Dedicated Section** - Full accordion with descriptions and links

## Adding Awards to a Service

### Step 1: Upload Award Badge Image

1. Go to **Media > Add New**
2. Upload the award badge image (PNG, JPG, or SVG)
3. Recommended specifications:
   - **Format**: PNG with transparent background
   - **Size**: 500x500px minimum (square ratio)
   - **File size**: Under 200KB for optimal performance
4. Set descriptive **Alt Text** for accessibility
5. Note the **Media Library ID** (visible in URL when editing)

### Step 2: Add Award to Service

1. Go to **Services > All Services**
2. Edit the service that won the award
3. Scroll to **Awards & Recognition** meta box
4. Click **+ Add Another Award** (if adding more than one)

### Step 3: Fill Award Details

**Required Fields:**
- **Award Title**: Full award name  
  Example: `Best Bank for Newcomers to Canada`

- **Organization**: Awarding organization  
  Example: `MoneySense`

- **Year**: Award year  
  Example: `2024`

- **Award Badge Image**: Click "Select Badge Image" and choose from Media Library

**Optional Fields:**
- **Description**: Additional details about the award  
  Example: `National Bank of Canada has been named the Best Bank for Newcomers to Canada for 2024 by MoneySense, recognizing their comprehensive newcomer programs.`

- **Award Link**: URL to award announcement or details  
  Example: `https://www.moneysense.ca/best-banks/`

### Step 4: Save

Click **Update** to save the service with awards.

## Display Locations

### Hero Section
- **Location**: Below CTA buttons in service hero
- **Display**: Up to 3 award badges horizontally
- **Style**: Circular badges with white background
- **Size**: 80px × 80px (60px on mobile)
- **Behavior**: Clickable if award link provided

### Sidebar
- **Location**: "Awards & Recognition" card in sidebar
- **Display**: All awards stacked vertically
- **Style**: Badge + organization + year + title
- **Size**: 60px × 60px badge thumbnails
- **Behavior**: Static display for quick reference

### Dedicated Section
- **Location**: Below FAQs in main content
- **Display**: Expandable accordion for each award
- **Style**: Full details with large badge, description, and link
- **Size**: 120px × 120px badge
- **Behavior**: First award expanded by default, click to toggle

### Navigation Tab
- **Display**: "Awards" tab automatically appears in service navigation when awards exist
- **Behavior**: Smooth scroll to awards section

## Award Badge Image Guidelines

### Recommended Formats

1. **PNG with Transparency** (Best)
   - Clear background
   - High contrast
   - Works on any background color

2. **SVG** (Ideal for logos)
   - Scalable to any size
   - Small file size
   - Perfect quality

3. **JPG** (Acceptable)
   - Use white background
   - High resolution
   - Optimize for web

### Design Tips

- **Keep it simple**: Award badges should be recognizable at small sizes
- **High contrast**: Ensure text is readable when scaled down
- **Professional look**: Use official award graphics when available
- **Consistent style**: Try to maintain visual consistency across awards

### Size Reference

| Location | Display Size | Recommended Upload Size |
|----------|-------------|-------------------------|
| Hero | 80px × 80px | 500px × 500px |
| Sidebar | 60px × 60px | 500px × 500px |
| Section | 120px × 120px | 600px × 600px |
| Mobile | 60px × 60px | 500px × 500px |

## Managing Multiple Awards

### Adding Awards

1. Start with one award field visible
2. Click **+ Add Another Award** for each additional award
3. No limit to number of awards
4. Awards display in the order added

### Editing Awards

1. Edit the service post
2. Scroll to Awards & Recognition
3. Modify any field
4. Click Update to save

### Removing Awards

1. Click **Remove** button on the award item
2. Confirm deletion
3. Award data is permanently removed

### Reordering Awards

Awards display in the order they appear in the meta box. To reorder:
1. Remove all awards
2. Re-add them in the desired order

## Styling & Customization

### CSS Classes

Awards use these classes for custom styling:

```css
/* Container */
.service-awards { }
.service-awards-hero { }
.service-awards-sidebar { }
.service-awards-section { }

/* Individual badges */
.award-badge { }
.award-badge-hero { }
.award-badge-sidebar { }
.award-badge-section { }

/* Badge components */
.award-badge-img { }
.award-badge-image { }
.award-badge-org { }
.award-badge-year { }
.award-badge-title { }
.award-badge-desc { }
.award-badge-link { }
```

### Custom Styling Example

```css
/* Make hero badges larger on desktop */
@media (min-width: 992px) {
  .award-badge-hero img {
    width: 100px;
    height: 100px;
  }
}

/* Custom award badge border */
.award-badge-hero img {
  border: 3px solid gold;
}

/* Hover effect on hero badges */
.award-badge-hero img:hover {
  transform: scale(1.1);
  transition: transform 0.3s ease;
}
```

## Accessibility Features

The awards system is built with accessibility in mind:

- **Alt Text**: All badge images include descriptive alt text
- **Keyboard Navigation**: Awards accordion is keyboard accessible
- **Screen Readers**: Proper ARIA labels and semantic HTML
- **Focus Indicators**: Clear focus states for interactive elements

## Example: National Bank of Canada Awards

Here's how the NBC awards are configured:

### Award #1: 2025 Milesopedia
```
Title: Best Bank Account for Newcomers to Quebec
Organization: Milesopedia
Year: 2025
Badge: 2025_Milesopedia-Awards_Best-Bank_Newcomers-QUEBEC_Comptes.png
Description: National Bank of Canada received the award for "Best Bank Account" for newcomers to Quebec by Milesopedia in 2025.
Link: https://www.milesopedia.com/...
```

### Award #2: 2024 MoneySense
```
Title: Best Bank for Newcomers to Canada
Organization: MoneySense
Year: 2024
Badge: 2024-MoneySense-Best-Bank-Newcomers.png
Description: National Bank of Canada has been named the Best Bank for Newcomers to Canada for 2024 by MoneySense.
Link: https://www.moneysense.ca/best-banks/
```

### Award #3: 2023 Milesopedia
```
Title: Best Credit Card for Newcomers
Organization: Milesopedia
Year: 2023
Badge: 2023-Milesopedia-Best-Credit-Card-Newcomers.png
Description: The National Bank® mycreditTM Mastercard® credit card was named the best credit card for newcomers by Milesopedia in 2023.
Link: https://www.milesopedia.com/...
```

## Technical Details

### Database Storage

Awards are stored as serialized array in post meta:
- **Meta Key**: `_service_awards`
- **Meta Value**: Array of award objects

Each award object contains:
```php
array(
    'title' => 'Award Title',
    'organization' => 'Organization Name',
    'year' => '2024',
    'badge_id' => 123, // Media Library ID
    'description' => 'Optional description',
    'link' => 'https://...'
)
```

### Helper Functions

```php
// Get all awards for a service
$awards = smoothmigration_get_service_awards( $post_id );

// Display awards in specific context
smoothmigration_display_awards_section( $post_id, 'hero' );
smoothmigration_display_awards_section( $post_id, 'sidebar' );
smoothmigration_display_awards_section( $post_id, 'section' );

// Display single award badge
$badge_html = smoothmigration_display_award_badge( $award, 'hero' );
```

### Template Integration

Awards automatically display when they exist. To manually control display:

```php
<?php if ( function_exists( 'smoothmigration_get_service_awards' ) ) : ?>
    <?php $awards = smoothmigration_get_service_awards( get_the_ID() ); ?>
    <?php if ( ! empty( $awards ) ) : ?>
        <?php smoothmigration_display_awards_section( get_the_ID(), 'section' ); ?>
    <?php endif; ?>
<?php endif; ?>
```

## Troubleshooting

### Awards Not Displaying

1. **Check if awards exist**: Edit service, scroll to Awards meta box
2. **Verify badge images**: Ensure badge images are uploaded and selected
3. **Check theme version**: Awards system requires theme v1.1.0+
4. **Clear cache**: Clear site cache and browser cache

### Badge Images Not Showing

1. **Verify Media Library ID**: Check that badge_id is valid
2. **Check file permissions**: Ensure uploads folder is readable
3. **Test image URL**: Try accessing image URL directly
4. **Re-upload image**: Upload image again if corrupted

### Styling Issues

1. **Check CSS loaded**: View page source, verify styles are present
2. **Browser compatibility**: Test in multiple browsers
3. **Responsive design**: Check mobile breakpoints
4. **Custom CSS conflicts**: Check for conflicting styles

## Future Enhancements

Potential features for future releases:

- [ ] Award badge animations on scroll
- [ ] Award filtering/sorting
- [ ] Award badge presets/templates
- [ ] Automatic award expiry dates
- [ ] Award statistics dashboard
- [ ] CSV import for bulk award assignment

---

**Version**: 1.0.0  
**Last Updated**: October 2025  
**Developer**: Smooth Migration Team


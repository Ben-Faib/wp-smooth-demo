# Quick Start Guide - Get NBC Page Live in 10 Minutes

This is the fastest way to get the National Bank of Canada page up and running with all features.

## Prerequisites

✅ WordPress running locally  
✅ Smooth Migration theme active  
✅ Admin access

## Step 1: Test Shortcodes (2 minutes)

Let's verify everything works:

1. Go to **Services > Add New**
2. Title: `Test NBC Sections`
3. Switch to **Code Editor** (top right)
4. Paste this:
   ```html
   [nbc_promotion_box]
   [nbc_benefits]
   [nbc_how_it_works]
   [nbc_fee_structure]
   [nbc_countries]
   [nbc_faq]
   ```
5. Click **Publish**
6. Click **View Post**

✅ **You should see**: All NBC sections with proper navigation links working

If it works, **delete this test post** and continue.

## Step 2: Upload Award Badges (3 minutes)

1. Go to **Media > Add New**
2. Upload these 3 files from `/NBC Updates/`:
   - `2025_Milesopedia-Awards_Best-Bank_Newcomers-QUEBEC_Comptes.png`
   - `image.png`
   - `img-milesopedia-2023-newcomers-en.png`
3. For each image, set **Alt Text**:
   - "2025 Milesopedia Award - Best Bank Account for Newcomers to Quebec"
   - "2024 MoneySense Award - Best Bank for Newcomers to Canada"
   - "2023 Milesopedia Award - Best Credit Card for Newcomers"
4. **Note the image IDs** (visible in URL when editing each image)

## Step 3: Create/Edit NBC Service (5 minutes)

### Find or Create NBC Service

**Option A**: Edit existing
1. **Services > All Services**
2. Find "National Bank of Canada"
3. Click **Edit**

**Option B**: Create new
1. **Services > Add New**
2. Title: `National Bank of Canada`

### Add Content

1. **Switch to Code Editor** (top right)
2. **Open**: `/NBC_PAGE_CONTENT.md` in your editor
3. **Copy** the HTML from "Step 3: Main Content"
4. **Paste** into WordPress editor
5. **Switch back to Visual Editor** to verify it looks good

### Set Category

- Under **Service Type**: Check **Banking Services**

### Add Awards

Scroll to **Awards & Recognition** meta box:

1. Click **+ Add Another Award** twice (to have 3 total)

2. **Award #1**:
   - Title: `Best Bank Account for Newcomers to Quebec`
   - Organization: `Milesopedia`
   - Year: `2025`
   - Badge: Select 2025 Milesopedia image
   - Description: `National Bank of Canada received the award for "Best Bank Account" for newcomers to Quebec by Milesopedia in 2025.`

3. **Award #2**:
   - Title: `Best Bank for Newcomers to Canada`
   - Organization: `MoneySense`
   - Year: `2024`
   - Badge: Select MoneySense image
   - Description: `National Bank of Canada has been named the Best Bank for Newcomers to Canada for 2024 by MoneySense.`

4. **Award #3**:
   - Title: `Best Credit Card for Newcomers`
   - Organization: `Milesopedia`
   - Year: `2023`
   - Badge: Select 2023 Milesopedia image
   - Description: `The National Bank® mycreditTM Mastercard® credit card was named the best credit card for newcomers by Milesopedia in 2023.`

### Set Affiliate Link

Scroll to **Affiliate Link** meta box:
- **URL**: `https://www.nbc.ca/personal/accounts/newcomers.html`

### Set Brand Color

Scroll to **Service Branding** meta box:
- **Brand Color**: `#d4002a`

### Quick Excerpt (Optional)

In the **Excerpt** box at top:
```
One of Canada's 6 major banks, established in 1859. Newcomer-focused account packages with up to $550 cashback. No fixed monthly fees for 3 years. CDIC protected.
```

### Publish

Click **Publish** or **Update**

## Step 4: View & Verify (2 minutes)

1. Click **View Service** link
2. Check that you see:
   - ✅ NBC branding in hero
   - ✅ 3 award badges in hero (below buttons)
   - ✅ Promotion box (up to $550)
   - ✅ Benefits grid (6 cards)
   - ✅ Eligibility section
   - ✅ How It Works (4 steps)
   - ✅ Fee structure table
   - ✅ FAQ accordion (7 questions)
   - ✅ CTA section at bottom (red gradient)
   - ✅ Awards in sidebar
   - ✅ "Awards" tab in navigation
   - ✅ Awards section after FAQs

3. **Test Mobile**:
   - Resize browser window
   - Everything should stack nicely

4. **Test Links**:
   - Click "Open Your Account" button
   - Should go to NBC website

## That's It! 🎉

Your NBC page is now live with:
- ✅ Complete content from official NBC page
- ✅ All 7 shortcode sections
- ✅ 3 awards displayed in 3 locations
- ✅ Professional styling with NBC brand colors
- ✅ Fully responsive design
- ✅ Accessibility features

## Optional Enhancements

### Add to Banking Services Hub

1. Go to **Service Type > Banking Services** in WordPress
2. NBC should automatically appear there
3. Verify it shows up with logo and excerpt

### Update SEO

If you have Yoast SEO:
1. Scroll to Yoast SEO box
2. **Focus Keyword**: `national bank of canada newcomers`
3. **SEO Title**: `National Bank of Canada for Newcomers | Smooth Migration`
4. **Meta Description**: `Open a Canadian bank account with National Bank - award-winning banking for newcomers. Up to $550 cashback, no fixed fees for 3 years, CDIC protected.`

### Add NBC Logo

1. Upload NBC official logo to Media Library
2. In **Service Branding** meta box:
   - **Company Logo**: Select NBC logo
3. Update service

### Test Import Tool

1. Go to **Tools > Import Single Service**
2. Try importing NBC data from JSONL
3. Verify it updates correctly

## Troubleshooting

### Shortcodes Show as Text

**Problem**: `[nbc_promotion_box]` shows as plain text  
**Solution**: Make sure you're in Visual Editor, not Code Editor

### Sections Not Styling

**Problem**: Sections appear but look plain  
**Solution**: Clear browser cache, hard refresh (Ctrl+Shift+R)

### Awards Not Showing

**Problem**: No awards in hero/sidebar  
**Solution**: Make sure you saved the service after adding awards

### Images Not Loading

**Problem**: Award badges don't display  
**Solution**: Check image IDs are correct, re-upload if needed

## Next Steps

### Ready for Production?

Follow these guides:
1. **TESTING_GUIDE.md** - Complete testing checklist
2. **DEPLOYMENT.md** - Deploy to production with WP Pusher
3. **AWARDS_SYSTEM.md** - Full awards system documentation

### Want to Customize?

Edit these files:
- **Content sections**: `inc/nbc-sections.php`
- **Template**: `single-service.php`
- **Styling**: Add custom CSS in theme or customizer

## Support Resources

- `NBC_PAGE_CONTENT.md` - Complete setup guide
- `NBC_IMPLEMENTATION_COMPLETE.md` - Feature overview
- `AWARDS_SYSTEM.md` - Awards documentation
- `DEPLOYMENT.md` - Production deployment
- `TESTING_GUIDE.md` - Testing procedures

## Quick Commands

### Clear WordPress Cache
```bash
# If using WP-CLI locally
wp cache flush
```

### Check for PHP Errors
Look in: `/logs/php/error.log`

### Verify Theme Active
```bash
wp theme list
```

---

**Time to Complete**: 10 minutes  
**Difficulty**: Easy  
**Status**: Ready to Go! 🚀


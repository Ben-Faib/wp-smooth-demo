# Quick Testing Guide - Awards System & Import Tool

Follow these steps to test the newly implemented features on your local environment.

## Prerequisites

✅ Local WordPress site running at `http://wp-smooth-demo.local`  
✅ Theme active: Smooth Migration  
✅ Admin access available

## Test 1: Awards Meta Box

**Time**: 2 minutes

1. **Navigate to Services**
   - Go to WordPress Admin
   - Click **Services > All Services**
   - Click any service to edit (or create a new test service)

2. **Locate Awards Meta Box**
   - Scroll down to find **"Awards & Recognition"** meta box
   - Should see one empty award form by default

3. **Test Add Award**
   - Click **"+ Add Another Award"** button
   - Should add a new award form
   - Try adding 3-4 awards

4. **Test Remove Award**
   - Click **"Remove"** button on any award
   - Confirm deletion
   - Award form should disappear

5. **Test Media Picker**
   - Click **"Select Badge Image"** button
   - WordPress Media Library should open
   - Select any image
   - Image preview should appear below

✅ **Expected**: Awards meta box works smoothly with add/remove/media picker

## Test 2: Save Award Data

**Time**: 3 minutes

1. **Fill in Award Details**
   ```
   Title: Test Award 2024
   Organization: Test Organization
   Year: 2024
   Badge Image: [Select any image]
   Description: This is a test award
   Link: https://example.com
   ```

2. **Save Service**
   - Click **"Update"** button
   - Wait for page reload

3. **Verify Data Persisted**
   - Refresh the page
   - Award data should still be there
   - Badge image preview should display

4. **Add Multiple Awards**
   - Add 2-3 more awards with different data
   - Save again
   - All awards should persist

✅ **Expected**: Award data saves and loads correctly

## Test 3: Awards Display on Frontend

**Time**: 3 minutes

1. **View Service Page**
   - Click **"View Service"** link (or visit service URL)
   - Service page should load

2. **Check Hero Section**
   - Look below the CTA buttons in hero
   - Should see award badges (circular, 80px)
   - Max 3 badges displayed
   - Badges should have white background and shadow

3. **Check Sidebar**
   - Look in the right sidebar
   - Should see **"Awards & Recognition"** card
   - Vertical list of all awards
   - Each with badge (60px), organization, year, title

4. **Check Navigation Tabs**
   - Look at the sticky navigation bar
   - Should see **"Awards"** tab (new)
   - Click it - should smooth scroll to awards section

5. **Check Awards Section**
   - Scroll to bottom of page (or click Awards tab)
   - Should see **"Awards & Recognition"** section
   - Accordion with one item per award
   - First award expanded by default
   - Click to expand/collapse other awards
   - Each shows large badge (120px), full details

6. **Test Responsive**
   - Resize browser to mobile width (< 768px)
   - Hero badges should be 60px
   - Section should stack vertically
   - Everything should be readable

✅ **Expected**: Awards display in all three locations with correct styling

## Test 4: Awards with No Data

**Time**: 1 minute

1. **Create New Service**
   - Services > Add New
   - Title: "Test Service No Awards"
   - Leave awards empty
   - Publish

2. **View Service Page**
   - No awards should display
   - No Awards tab in navigation
   - No empty sections

✅ **Expected**: Services without awards display normally (no empty sections)

## Test 5: Import Tool Access

**Time**: 1 minute

1. **Navigate to Import Tool**
   - Go to **Tools > Import Single Service**
   - Page should load without errors

2. **Check UI Elements**
   - Country dropdown with 5 options
   - Import method radio buttons
   - JSONL textarea
   - Field checkboxes
   - Import options checkboxes
   - "Import Service" button

✅ **Expected**: Import tool page loads and displays correctly

## Test 6: Import Tool - Preview Mode

**Time**: 3 minutes

1. **Prepare Test Data**
   Copy this JSONL:
   ```json
   {"country": "Canada", "partner": "Test Partner Import", "category": "Banking Services", "text": "Country: Canada\nPartner: Test Partner Import\nCategory: Banking Services\nOverview: This is a test overview for import.\nWhy we recommend: Test recommendation.\nHow it helps: Test help text.", "metadata": {"link": "https://example.com", "quick_view": "Test quick view"}}
   ```

2. **Configure Import**
   - Select Country: **Canada**
   - Paste JSONL data
   - Check all field checkboxes
   - Check **"Create service if it doesn't exist"**
   - Check **"Preview only"**

3. **Run Preview**
   - Click **"Import Service"**
   - Wait for page reload

4. **Check Results**
   - Should see success message
   - "Preview complete: 1 service(s) would be processed"
   - Details: "Preview: Would create Test Partner Import"

5. **Verify No Database Changes**
   - Go to Services > All Services
   - "Test Partner Import" should NOT exist

✅ **Expected**: Preview mode shows what would happen without saving

## Test 7: Import Tool - Actual Import

**Time**: 3 minutes

1. **Run Same Import Without Preview**
   - Go back to Tools > Import Single Service
   - Use same JSONL data
   - Same configuration
   - **Uncheck** "Preview only"

2. **Import**
   - Click **"Import Service"**
   - Should see success message
   - "Import complete: 1 created"
   - Details show service ID

3. **Verify Service Created**
   - Go to Services > All Services
   - "Test Partner Import" should exist
   - Status: Draft (for review)

4. **Check Import Data**
   - Edit the service
   - Title should be "Test Partner Import"
   - Content should have overview
   - Custom fields should be populated
   - Category should be "Banking Services"

✅ **Expected**: Service created with correct data

## Test 8: Import Tool - Update Existing

**Time**: 2 minutes

1. **Modify JSONL Data**
   ```json
   {"country": "Canada", "partner": "Test Partner Import", "category": "Banking Services", "text": "Country: Canada\nPartner: Test Partner Import\nCategory: Banking Services\nOverview: UPDATED overview text.\nWhy we recommend: UPDATED recommendation.", "metadata": {"link": "https://example-updated.com", "quick_view": "UPDATED quick view"}}
   ```

2. **Import Again**
   - Same configuration
   - Uncheck "Preview only"
   - Import

3. **Check Results**
   - Should say "1 updated"
   - Not "1 created"

4. **Verify Updates**
   - Edit the service
   - Content should say "UPDATED overview text"
   - Affiliate link should be "https://example-updated.com"

✅ **Expected**: Existing service updated with new data

## Test 9: Import Tool - Selective Fields

**Time**: 2 minutes

1. **Import with Limited Fields**
   - Same service
   - **Uncheck** "Overview" and "Link"
   - Check only "Why We Recommend"
   - Import

2. **Verify Selective Update**
   - Edit service
   - Overview should still be "UPDATED overview text" (unchanged)
   - Link should still be old value (unchanged)
   - "Why We Recommend" custom field should be updated

✅ **Expected**: Only selected fields update

## Test 10: Import Tool - Error Handling

**Time**: 2 minutes

1. **Test Invalid JSON**
   - Paste: `{invalid json`
   - Try to import
   - Should show error: "Invalid JSON"

2. **Test Missing Country**
   - Valid JSON
   - Don't select country
   - Try to import
   - Should show error: "Please select a country/domain"

3. **Test Empty Data**
   - Select country
   - Clear JSONL textarea
   - Try to import
   - Should show error: "Please provide JSONL data"

✅ **Expected**: Validation errors display correctly

## Test 11: CSS & Styling

**Time**: 2 minutes

1. **Check Award Styles**
   - View service page with awards
   - Open browser DevTools (F12)
   - Inspect award badges
   - Classes should be applied:
     - `.award-badge-hero`
     - `.award-badge-sidebar`
     - `.award-badge-section`

2. **Check Responsive Styles**
   - Use DevTools to toggle device toolbar
   - Test mobile (375px width)
   - Test tablet (768px width)
   - Test desktop (1200px width)
   - Styles should adapt appropriately

3. **Check Hover Effects**
   - Hover over hero badges
   - Should see visual feedback (if linked)

✅ **Expected**: CSS loads and styles correctly

## Test 12: Cleanup Test Data

**Time**: 1 minute

1. **Delete Test Service**
   - Services > All Services
   - Find "Test Partner Import"
   - Move to Trash
   - Empty Trash

2. **Remove Test Awards**
   - Edit any service you added test awards to
   - Remove all test awards
   - Update service

✅ **Expected**: Test data cleaned up

## Common Issues & Solutions

### Awards Meta Box Not Showing
- **Check**: Is service post type?
- **Fix**: Make sure editing a "Service" not a "Post"

### Award Images Not Displaying
- **Check**: Is badge_id valid?
- **Fix**: Re-select image from Media Library

### Import Tool Not Found
- **Check**: Is theme active?
- **Fix**: Ensure theme is activated, not just uploaded

### Styles Not Loading
- **Check**: Browser cache
- **Fix**: Hard refresh (Ctrl+Shift+R or Cmd+Shift+R)

### JSONL Parse Error
- **Check**: Valid JSON format
- **Fix**: Use https://jsonlint.com to validate

## Final Checklist

Before considering testing complete, verify:

- [x] Awards meta box functional
- [x] Awards save and load correctly
- [x] Awards display in hero
- [x] Awards display in sidebar
- [x] Awards display in dedicated section
- [x] Awards tab appears when appropriate
- [x] Responsive design works
- [x] Import tool accessible
- [x] Preview mode works
- [x] Actual import creates services
- [x] Update existing services works
- [x] Selective field updates work
- [x] Error handling displays correctly
- [x] CSS styles load properly

## Next Steps After Testing

Once all tests pass:

1. ✅ **Commit Changes**
   ```bash
   cd "/Users/benfaib/Local Sites/wp-smooth-demo"
   git add .
   git commit -m "feat: Add awards system and single service import tool"
   git push origin main
   ```

2. ✅ **Prepare Production**
   - Upload NBC award badge images to `/NBC Updates/`
   - Prepare NBC service content
   - Document any custom configurations

3. ✅ **Setup WP Pusher**
   - Install on all 5 domains
   - Configure GitHub connection
   - Test deployment on one domain first

4. ✅ **Deploy to Production**
   - Follow DEPLOYMENT.md guide
   - Deploy theme via WP Pusher
   - Upload award badges
   - Add awards to NBC service
   - Test on each domain

---

**Testing Duration**: ~25 minutes total  
**Status**: Ready for Testing  
**Date**: October 17, 2025


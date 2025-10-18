# Deployment Guide - WP Pusher & Multi-Domain Management

This guide explains how to deploy theme updates and service content across all 5 Smooth Migration domains using WP Pusher and the custom import tools.

## Domain Overview

| Domain | Country | URL | Purpose |
|--------|---------|-----|---------|
| .ca | Canada | smoothmigration.ca | Canadian services |
| .com/.net | United States | smoothmigration.com / smoothmigration.net | US services |
| .co.uk | United Kingdom | smoothmigration.co.uk | UK services |
| .com.au | Australia | smoothmigration.com.au | Australian services |
| .co.za | South Africa | smoothmigration.co.za | South African services |

## Part 1: Theme Deployment with WP Pusher

### Initial Setup (One-Time)

1. **Install WP Pusher on Each Domain**
   - Log in to WordPress admin on each domain
   - Navigate to Plugins > Add New
   - Search for "WP Pusher"
   - Install and activate

2. **Connect to GitHub**
   - Go to WP Pusher > GitHub
   - Click "Obtain GitHub Token"
   - Follow prompts to authorize WP Pusher with your GitHub account
   - Copy the generated token and paste it

3. **Install Theme from GitHub**
   - Go to WP Pusher > Install Theme
   - Repository: `yourusername/wp-smooth-demo` (or your repo name)
   - Branch: `main` (or `production`)
   - Subdirectory: `app/public/wp-content/themes/smoothmigration`
   - Check "Push-to-Deploy" if you want automatic deployments
   - Click "Install Theme"

### Deployment Workflow

#### Step 1: Local Development
```bash
# Make changes in your local environment
cd "/Users/benfaib/Local Sites/wp-smooth-demo"

# Test changes locally
# Visit http://wp-smooth-demo.local in browser
```

#### Step 2: Commit & Push
```bash
# Stage changes
git add .

# Commit with descriptive message
git commit -m "feat: Add awards system for services"

# Push to GitHub
git push origin main
```

#### Step 3: Deploy to Production

**Option A: Automatic Deployment (if Push-to-Deploy is enabled)**
- Theme updates automatically within 5 minutes

**Option B: Manual Deployment**
1. Log in to WordPress admin on each domain
2. Go to WP Pusher > Themes
3. Find "smoothmigration" theme
4. Click "Update Theme"
5. Wait for deployment to complete
6. Verify theme is active

#### Step 4: Verify Deployment
- Check each domain to ensure theme updated successfully
- Test awards system on a service page
- Check for any PHP errors in WordPress debug log
- Test responsive design on mobile

### Best Practices

1. **Use Release Tags**
   ```bash
   # Tag releases for production
   git tag -a v1.1.0 -m "Add awards system"
   git push origin v1.1.0
   ```

2. **Test Before Deploying**
   - Always test changes thoroughly on local environment
   - Consider using a staging domain for testing

3. **Backup Before Major Updates**
   - Backup WordPress database before major theme updates
   - Keep a backup of the previous theme version

4. **Monitor Deployments**
   - Check WP Pusher logs for deployment status
   - Review WordPress debug logs after deployment

## Part 2: Service Content Deployment

### NBC Awards Example

#### Step 1: Upload Award Badge Images

For **each domain** where NBC appears (Canada .ca):

1. Log in to WordPress admin
2. Go to Media > Add New
3. Upload the 3 NBC award badge images:
   - `2025_Milesopedia-Awards_Best-Bank_Newcomers-QUEBEC_Comptes.png`
   - `image.png` (2024 MoneySense)
   - `img-milesopedia-2023-newcomers-en.png`
4. Set alt text for each:
   - "2025 Milesopedia Award - Best Bank Account for Newcomers to Quebec"
   - "2024 MoneySense Award - Best Bank for Newcomers to Canada"
   - "2023 Milesopedia Award - Best Credit Card for Newcomers"
5. Note the Media Library ID numbers for each image

#### Step 2: Add Awards to NBC Service

1. Go to Services > All Services
2. Find "National Bank of Canada"
3. Scroll to "Awards & Recognition" meta box
4. Add each award:

**Award #1:**
- Title: `Best Bank Account for Newcomers to Quebec`
- Organization: `Milesopedia`
- Year: `2025`
- Badge Image: (select 2025 Milesopedia image)
- Description: `National Bank of Canada received the award for "Best Bank Account" for newcomers to Quebec by Milesopedia in 2025.`
- Link: (if available)

**Award #2:**
- Title: `Best Bank for Newcomers to Canada`
- Organization: `MoneySense`
- Year: `2024`
- Badge Image: (select 2024 MoneySense image)
- Description: `National Bank of Canada has been named the Best Bank for Newcomers to Canada for 2024 by MoneySense.`

**Award #3:**
- Title: `Best Credit Card for Newcomers`
- Organization: `Milesopedia`
- Year: `2023`
- Badge Image: (select 2023 Milesopedia image)
- Description: `The National Bank® of Canada mycreditTM Mastercard® credit card was named the best credit card for newcomers by Milesopedia in 2023.`

3. Click "Update" to save

### Using the Single Service Import Tool

#### Step 1: Prepare JSONL Data

Example for NBC:
```json
{"country": "Canada", "partner": "National Bank of Canada", "category": "Banking Services", "text": "Country: Canada\nPartner: National Bank of Canada\nCategory: Banking Services\nOverview: National Bank of Canada is a large, integrated financial group and one of Canada's six systemically important banks, founded in 1859...\nWhy we recommend: National Bank of Canada is one of the country's leading financial institutions...\nHow it helps: From opening your first Canadian bank account to setting up credit...\nLink: https://www.nbc.ca/personal/accounts/newcomers.html", "metadata": {"link": "https://www.nbc.ca/personal/accounts/newcomers.html", "quick_view": "One of Canada's 6 major banks, established in 1859. • Newcomer-focused account packages..."}}
```

#### Step 2: Import Service

1. Go to Tools > Import Single Service
2. Select Country: **Canada**
3. Paste JSONL data
4. Select fields to update:
   - ☑ Partner Name (Title)
   - ☑ Overview (Content)
   - ☑ Why We Recommend
   - ☑ How It Helps
   - ☑ Affiliate Link
   - ☑ Quick View (Excerpt)
5. Options:
   - ☑ Create service if it doesn't exist
   - ☐ Preview only (uncheck to save)
6. Click "Import Service"

#### Step 3: Bulk Import Multiple Services

For importing many services at once:

1. Prepare a complete JSONL file with one service per line
2. Go to Tools > Import Single Service
3. Select Country
4. Paste entire JSONL content (multiple lines)
5. The tool will process each line separately
6. Review the import log

## Part 3: Domain-Specific Considerations

### Service Filtering by Domain

Services are tagged with country metadata (`_service_country`). To display only relevant services:

```php
// Example: Show only Canada services
$args = array(
    'post_type' => 'service',
    'meta_key' => '_service_country',
    'meta_value' => 'canada',
);
$services = get_posts( $args );
```

### Conditional Theme Features

If domains need different features:

```php
// In theme files
$current_domain = $_SERVER['HTTP_HOST'];

if ( strpos( $current_domain, '.ca' ) !== false ) {
    // Canada-specific code
} elseif ( strpos( $current_domain, '.com' ) !== false ) {
    // US-specific code
}
```

## Part 4: Rollback Procedures

### If Theme Update Breaks Site

**Option 1: Rollback via WP Pusher**
1. Go to WP Pusher > Themes
2. Click theme settings
3. Change Branch to previous release tag (e.g., `v1.0.0`)
4. Update theme

**Option 2: Manual Rollback via FTP/File Manager**
1. Connect to server via FTP or File Manager
2. Navigate to `/wp-content/themes/`
3. Delete `smoothmigration` folder
4. Upload previous version from backup

**Option 3: Git Revert**
```bash
# Revert to previous commit
git revert HEAD
git push origin main
# WP Pusher will auto-deploy the revert
```

### If Service Import Goes Wrong

1. Services are created as "Draft" by default
2. Review in WordPress admin before publishing
3. Use "Preview only" mode first to test imports
4. Delete incorrect services from Services > All Services

## Part 5: Troubleshooting

### WP Pusher Issues

**"Repository not found"**
- Check GitHub token has correct permissions
- Verify repository name is correct
- Ensure repository is accessible (not private without token)

**"Theme not updating"**
- Check WP Pusher logs for errors
- Verify Branch name is correct
- Try manual update from WP Pusher dashboard
- Check file permissions on server

### Import Tool Issues

**"Service not found"**
- Partner name must match exactly (case-insensitive)
- Try enabling "Create if not exists"
- Check spelling in JSONL data

**"Invalid JSON"**
- Validate JSON at jsonlint.com
- Ensure proper escaping of quotes in text
- Each service should be on a single line (no line breaks within JSON)

**"No fields updated"**
- Ensure at least one field checkbox is checked
- Check that JSONL data contains the expected fields
- Verify country selection matches data

## Part 6: Maintenance Schedule

### Weekly
- Review service updates from partners
- Check for broken affiliate links
- Update service descriptions as needed

### Monthly
- Review analytics for each domain
- Update service rankings/order
- Add new services as needed

### Quarterly
- Audit all services across all domains
- Update screenshots/logos as needed
- Review and update SEO meta descriptions

### Before Major Updates
- Backup all databases
- Test in staging environment
- Document all changes
- Schedule deployment during low-traffic hours

## Support & Resources

- **WP Pusher Documentation**: https://wppusher.com/documentation
- **GitHub Documentation**: https://docs.github.com
- **Theme Files**: `/wp-content/themes/smoothmigration/`
- **Debug Log**: `/wp-content/debug.log` (enable WP_DEBUG in wp-config.php)

---

**Last Updated**: October 2025  
**Version**: 1.0.0


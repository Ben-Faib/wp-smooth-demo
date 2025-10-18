# National Bank of Canada - Complete Page Content

This guide provides the complete content structure for the NBC service page, including what to paste into the WordPress editor and how to configure all settings.

## Step 1: Edit NBC Service Post

1. Go to **Services > All Services**
2. Find "National Bank of Canada" (or create if doesn't exist)
3. Click **Edit**

## Step 2: Basic Settings

### Post Title
```
National Bank of Canada
```

### Post Excerpt (Quick View)
```
One of Canada's 6 major banks, established in 1859. • Newcomer-focused account packages • Full banking, credit, and investment services • Branch network across Canada. 165+ years of financial stability. Start your Canadian financial journey securely.
```

### Service Type (Category)
- Select: **Banking Services**

## Step 3: Main Content (WordPress Editor)

Paste this into the WordPress editor (switch to "Code Editor" view if needed):

```html
<h2>Open a Bank Account in Canada</h2>

<p class="lead">National Bank of Canada is one of Canada's six major banks and a trusted financial institution serving newcomers since 1859. With over 361 branches nationwide and services in 6 languages, we make it easy for you to start your Canadian banking journey with confidence.</p>

[nbc_promotion_box]

<h2>Why National Bank of Canada?</h2>

<p>As an award-winning bank for newcomers, National Bank offers comprehensive banking solutions specifically designed for your transition to Canada. Whether you're arriving soon or have been here for up to 5 years, our specialized newcomer program provides the support and services you need.</p>

<div class="row g-4 my-4">
  <div class="col-md-4 text-center">
    <div class="feature-icon mb-3">
      <i class="fa-solid fa-building-columns fa-3x" style="color: #d4002a;"></i>
    </div>
    <h3 class="h5">Established Trust</h3>
    <p>One of Canada's 6 systemically important banks with 165+ years of stability and security.</p>
  </div>
  <div class="col-md-4 text-center">
    <div class="feature-icon mb-3">
      <i class="fa-solid fa-award fa-3x" style="color: #d4002a;"></i>
    </div>
    <h3 class="h5">Award-Winning</h3>
    <p>Recognized by MoneySense and Milesopedia for best newcomer banking services and credit cards.</p>
  </div>
  <div class="col-md-4 text-center">
    <div class="feature-icon mb-3">
      <i class="fa-solid fa-users fa-3x" style="color: #d4002a;"></i>
    </div>
    <h3 class="h5">Newcomer Focused</h3>
    <p>Dedicated programs, multilingual support, and no Canadian credit history required.</p>
  </div>
</div>

[nbc_benefits]

[nbc_eligibility]

[nbc_how_it_works]

<h2>What Makes NBC Different for Newcomers?</h2>

<div class="row g-4 my-4">
  <div class="col-md-6">
    <h3 class="h5"><i class="fa-solid fa-laptop me-2" style="color: #d4002a;"></i>Remote Account Opening</h3>
    <p>Start your application online from anywhere in the world, up to 90 days before your arrival. Complete the process remotely or at a branch when you arrive.</p>
  </div>
  <div class="col-md-6">
    <h3 class="h5"><i class="fa-solid fa-money-bill-transfer me-2" style="color: #d4002a;"></i>Pre-Arrival Money Transfers</h3>
    <p>Transfer money to your new Canadian account before you even land, so funds are waiting for you when you arrive.</p>
  </div>
  <div class="col-md-6">
    <h3 class="h5"><i class="fa-solid fa-language me-2" style="color: #d4002a;"></i>Multilingual Support</h3>
    <p>Banking services and ABMs available in French, English, Spanish, Traditional Chinese, Punjabi, and Arabic.</p>
  </div>
  <div class="col-md-6">
    <h3 class="h5"><i class="fa-solid fa-handshake me-2" style="color: #d4002a;"></i>Personal Banking Advisor</h3>
    <p>Get dedicated support from a banking advisor who understands the unique needs of newcomers to Canada.</p>
  </div>
</div>

[nbc_fee_structure]

[nbc_countries]

<h2>Additional Services for Newcomers</h2>

<ul>
  <li><strong>Credit Cards:</strong> Build your Canadian credit with cards designed for newcomers with no local credit history</li>
  <li><strong>Mortgages:</strong> Access mortgage pre-approval and home buying support tailored for newcomers</li>
  <li><strong>Investment Services:</strong> Open TFSAs, RRSPs, and other investment accounts to secure your financial future</li>
  <li><strong>Business Banking:</strong> Entrepreneur programs for newcomers starting businesses in Canada</li>
  <li><strong>Insurance:</strong> Life, home, and auto insurance products through National Bank Financial partners</li>
</ul>

[nbc_faq]

[nbc_cta]

<div class="disclaimer mt-5 p-4 bg-light rounded">
  <h3 class="h6">Important Information</h3>
  <p class="small mb-2"><strong>Promotion Period:</strong> April 1 to October 25, 2025. Conditions and eligibility criteria apply.</p>
  <p class="small mb-2"><strong>Eligibility:</strong> Available to newcomers from 90 days before arrival up to 5 years after arriving in Canada. Must be permanent residents, temporary workers, or international students.</p>
  <p class="small mb-2"><strong>Account Requirements:</strong> To maintain promotional pricing and cashback eligibility, you must keep your account and required services active for specified periods. See National Bank's terms and conditions for complete details.</p>
  <p class="small mb-2"><strong>Fees:</strong> While monthly account fees are waived or reduced for the first 3 years, transaction fees may apply for services not included in your package. Review the Guide to Personal Banking Solutions for complete fee schedule.</p>
  <p class="small mb-0"><strong>Deposits Protected:</strong> Eligible deposits with National Bank of Canada are protected by the Canada Deposit Insurance Corporation (CDIC) up to applicable limits.</p>
  <p class="small mt-3 mb-0"><em>Information current as of October 2025. Offers, rates, and terms subject to change. Visit <a href="https://www.nbc.ca" target="_blank">nbc.ca</a> for the most current information.</em></p>
</div>
```

## Step 4: Custom Fields

Scroll down to the meta boxes and fill in:

### Service Details
- **Price**: `Free for Year 1 ($15.95/month from Year 4)`
- **Duration**: `Account active within 1-2 business days`

### Service Branding
- **Company Name**: `National Bank of Canada`
- **Company URL**: `https://www.nbc.ca`
- **Brand Color**: `#d4002a` (NBC red)
- **Company Logo**: Upload NBC logo from Media Library

### Affiliate Link
- **Affiliate URL**: `https://www.nbc.ca/personal/accounts/newcomers.html`

### Regions/Countries
- **Regions**: `Canada`

### Service Country (Custom Meta)
- Add via import tool or manually: `canada`

## Step 5: Awards & Recognition

Add the 3 awards (see AWARDS_SYSTEM.md for detailed steps):

### Award #1
- **Title**: `Best Bank Account for Newcomers to Quebec`
- **Organization**: `Milesopedia`
- **Year**: `2025`
- **Badge Image**: Upload `2025_Milesopedia-Awards_Best-Bank_Newcomers-QUEBEC_Comptes.png`
- **Description**: `National Bank of Canada received the award for "Best Bank Account" for newcomers to Quebec by Milesopedia in 2025.`
- **Link**: `` (leave empty unless you have the announcement URL)

### Award #2
- **Title**: `Best Bank for Newcomers to Canada`
- **Organization**: `MoneySense`
- **Year**: `2024`
- **Badge Image**: Upload `image.png` (MoneySense badge)
- **Description**: `National Bank of Canada has been named the Best Bank for Newcomers to Canada for 2024 by MoneySense, recognizing their comprehensive newcomer programs and services.`
- **Link**: `https://www.moneysense.ca/spend/banking/best-banks-in-canada/`

### Award #3
- **Title**: `Best Credit Card for Newcomers`
- **Organization**: `Milesopedia`
- **Year**: `2023`
- **Badge Image**: Upload `img-milesopedia-2023-newcomers-en.png`
- **Description**: `The National Bank® of Canada mycreditTM Mastercard® credit card was named the best credit card for newcomers by Milesopedia in 2023.`
- **Link**: `` (leave empty unless you have the announcement URL)

## Step 6: SEO Settings (if Yoast SEO installed)

### Focus Keyword
```
national bank of canada newcomers
```

### SEO Title
```
National Bank of Canada for Newcomers | Smooth Migration
```

### Meta Description
```
Open a Canadian bank account with National Bank - award-winning banking for newcomers. Up to $550 cashback, no fixed fees for 3 years, CDIC protected. Apply online today.
```

## Step 7: Publish

1. Set **Status** to **Published** (or keep as Draft for review)
2. Set **Visibility** to **Public**
3. Click **Publish** or **Update**

## Step 8: Verify Frontend Display

Visit the service page and verify:
- [ ] Hero section displays properly with NBC branding
- [ ] Award badges appear in hero (up to 3)
- [ ] All shortcode sections render correctly
- [ ] Promotion box displays with correct amounts
- [ ] Benefits section shows all 6 benefits
- [ ] Eligibility section with documents checklist
- [ ] How It Works 4-step process
- [ ] Fee structure table
- [ ] FAQ accordion (7 questions)
- [ ] CTA section at bottom
- [ ] Awards display in sidebar
- [ ] Awards tab appears in navigation
- [ ] Dedicated awards section after FAQs
- [ ] Mobile responsive design
- [ ] All links work correctly

## Available Shortcodes

Use these shortcodes anywhere in your content:

- `[nbc_promotion_box]` - Cashback promotion summary
- `[nbc_benefits]` - 6 key benefits grid
- `[nbc_eligibility]` - Who's eligible + required documents
- `[nbc_how_it_works]` - 4-step process (links to #how)
- `[nbc_fee_structure]` - Fee table for 3 years (links to #fees)
- `[nbc_countries]` - Where NBC operates (links to #countries)
- `[nbc_faq]` - 7 frequently asked questions (links to #faq)
- `[nbc_cta]` - Final call-to-action section

**Note**: The shortcodes with IDs automatically create anchor links that work with the navigation tabs!

## Customization

### Changing NBC Brand Color

If you need to adjust the brand color, update in:
1. Meta box: **Service Branding > Brand Color**
2. Shortcode sections: Edit `inc/nbc-sections.php` and replace `#d4002a` with new color

### Adding More FAQs

Edit `inc/nbc-sections.php` and add more accordion items to the `smoothmigration_nbc_faq_section()` function.

### Custom CTA Text

The CTA section automatically pulls the affiliate URL from the service meta. To customize text, edit the `smoothmigration_nbc_cta_section()` function.

## Next Steps

After setting up the NBC page:

1. **Test All Links**: Verify affiliate URL and internal links work
2. **Check Analytics**: Ensure tracking is configured for CTA clicks
3. **Mobile Test**: View on mobile devices to verify responsive design
4. **Accessibility**: Run through with keyboard navigation and screen reader
5. **Cross-Link**: Add links to NBC from Banking Services hub page
6. **Update Hub**: Ensure NBC appears prominently on `/service-type/banking-services/` page

---

**Content Version**: 1.0.0  
**Last Updated**: October 2025  
**Based On**: Official NBC newcomers page (https://www.nbc.ca/personal/accounts/newcomers.html)


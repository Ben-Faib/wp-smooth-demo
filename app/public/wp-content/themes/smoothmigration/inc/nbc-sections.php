<?php
/**
 * NBC-Specific Content Sections
 * 
 * Reusable sections for National Bank of Canada service page
 * Based on official NBC newcomers page content
 * 
 * @package smoothmigration
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * NBC Promotion Summary Box
 */
function smoothmigration_nbc_promotion_box() {
    ob_start();
    ?>
    <div class="nbc-promotion-box card shadow-sm mb-4" style="border-left: 4px solid #d4002a;">
        <div class="card-body">
            <h3 class="h5 mb-3" style="color: #d4002a;">
                <i class="fa-solid fa-gift me-2"></i>Special Offer for Newcomers
            </h3>
            <div class="promotion-highlight mb-3 p-3 bg-light rounded">
                <h4 class="h3 mb-2" style="color: #d4002a;">Up to $550 Cashback</h4>
                <p class="mb-0">Available from 90 days before your arrival and up to 5 years afterward</p>
            </div>
            <ul class="list-unstyled mb-0">
                <li class="mb-2"><i class="fa-solid fa-check-circle text-success me-2"></i><strong>$300</strong> - Opening a chequing account with direct deposit</li>
                <li class="mb-2"><i class="fa-solid fa-check-circle text-success me-2"></i><strong>$100</strong> - Signing up for an eligible credit card</li>
                <li class="mb-2"><i class="fa-solid fa-check-circle text-success me-2"></i><strong>$50</strong> - Activating systematic savings</li>
                <li class="mb-2"><i class="fa-solid fa-check-circle text-success me-2"></i><strong>$100</strong> - Setting up pre-authorized mortgage payments</li>
            </ul>
            <p class="text-muted small mt-3 mb-0">
                <i class="fa-solid fa-info-circle me-1"></i>Promotion valid from April 1 to October 25, 2025. Conditions apply.
            </p>
        </div>
    </div>
    <?php
    return ob_get_clean();
}

/**
 * NBC Key Benefits Section
 */
function smoothmigration_nbc_benefits_section() {
    ob_start();
    ?>
    <div class="nbc-benefits-section mb-5">
        <h2 class="h3 mb-4">Banking Benefits for Newcomers</h2>
        <div class="row g-4">
            <div class="col-md-6">
                <div class="benefit-card h-100 p-4 border rounded">
                    <div class="benefit-icon mb-3">
                        <i class="fa-solid fa-coins fa-2x" style="color: #d4002a;"></i>
                    </div>
                    <h3 class="h5">No Fixed Monthly Fees</h3>
                    <p>Save up to $574.20 over 3 years with no monthly account fees for the first year, reduced fees in year 2 and 3.</p>
                </div>
            </div>
            <div class="col-md-6">
                <div class="benefit-card h-100 p-4 border rounded">
                    <div class="benefit-icon mb-3">
                        <i class="fa-solid fa-scale-balanced fa-2x" style="color: #d4002a;"></i>
                    </div>
                    <h3 class="h5">Legal Support</h3>
                    <p>Get 12 months of free legal assistance for everyday concerns through our Assistance Network, available 7 days a week.</p>
                </div>
            </div>
            <div class="col-md-6">
                <div class="benefit-card h-100 p-4 border rounded">
                    <div class="benefit-icon mb-3">
                        <i class="fa-solid fa-credit-card fa-2x" style="color: #d4002a;"></i>
                    </div>
                    <h3 class="h5">Build Credit History</h3>
                    <p>Access credit cards designed for newcomers to help you build your Canadian credit history from day one.</p>
                </div>
            </div>
            <div class="col-md-6">
                <div class="benefit-card h-100 p-4 border rounded">
                    <div class="benefit-icon mb-3">
                        <i class="fa-solid fa-building-columns fa-2x" style="color: #d4002a;"></i>
                    </div>
                    <h3 class="h5">Nationwide Access</h3>
                    <p>361+ branches across Canada and 2,071 ABMs, plus services available in 6 languages including French and English.</p>
                </div>
            </div>
            <div class="col-md-6">
                <div class="benefit-card h-100 p-4 border rounded">
                    <div class="benefit-icon mb-3">
                        <i class="fa-solid fa-globe fa-2x" style="color: #d4002a;"></i>
                    </div>
                    <h3 class="h5">International Banking</h3>
                    <p>Transfer money internationally starting at $5.95, plus access funds abroad through partner ABM networks worldwide.</p>
                </div>
            </div>
            <div class="col-md-6">
                <div class="benefit-card h-100 p-4 border rounded">
                    <div class="benefit-icon mb-3">
                        <i class="fa-solid fa-shield-halved fa-2x" style="color: #d4002a;"></i>
                    </div>
                    <h3 class="h5">CDIC Protected</h3>
                    <p>Your deposits are protected by the Canada Deposit Insurance Corporation (CDIC), giving you peace of mind.</p>
                </div>
            </div>
        </div>
    </div>
    <?php
    return ob_get_clean();
}

/**
 * NBC Eligibility Section
 */
function smoothmigration_nbc_eligibility_section() {
    ob_start();
    ?>
    <div class="nbc-eligibility-section mb-5">
        <h2 class="h3 mb-4">Who's Eligible?</h2>
        <div class="eligibility-content p-4 bg-light rounded">
            <h3 class="h5 mb-3">You qualify for the newcomer offer if you are:</h3>
            <ul class="list-unstyled mb-4">
                <li class="mb-2"><i class="fa-solid fa-check text-success me-2"></i>At least 18 years of age</li>
                <li class="mb-2"><i class="fa-solid fa-check text-success me-2"></i>A permanent resident, temporary worker, or international student</li>
                <li class="mb-2"><i class="fa-solid fa-check text-success me-2"></i>Applying from 90 days before arrival up to 5 years after arriving in Canada</li>
                <li class="mb-2"><i class="fa-solid fa-check text-success me-2"></i>The sole user of the account (individual account only)</li>
            </ul>
            
            <h3 class="h5 mb-3 mt-4">What You'll Need:</h3>
            <div class="row g-3">
                <div class="col-md-6">
                    <div class="document-card p-3 bg-white rounded border">
                        <h4 class="h6 mb-2"><i class="fa-solid fa-passport me-2" style="color: #d4002a;"></i>Identification</h4>
                        <p class="small mb-0">Valid passport or government-issued ID from your home country</p>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="document-card p-3 bg-white rounded border">
                        <h4 class="h6 mb-2"><i class="fa-solid fa-file-certificate me-2" style="color: #d4002a;"></i>Immigration Documents</h4>
                        <p class="small mb-0">Work permit, study permit, or permanent resident card</p>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="document-card p-3 bg-white rounded border">
                        <h4 class="h6 mb-2"><i class="fa-solid fa-location-dot me-2" style="color: #d4002a;"></i>Proof of Address</h4>
                        <p class="small mb-0">Lease agreement, utility bill, or letter from landlord (if already in Canada)</p>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="document-card p-3 bg-white rounded border">
                        <h4 class="h6 mb-2"><i class="fa-solid fa-briefcase me-2" style="color: #d4002a;"></i>Employment Info</h4>
                        <p class="small mb-0">Job offer letter or employment contract (for direct deposit setup)</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php
    return ob_get_clean();
}

/**
 * NBC How It Works Section
 */
function smoothmigration_nbc_how_it_works_section() {
    ob_start();
    ?>
    <div class="nbc-how-it-works-section mb-5" id="how">
        <h2 class="h3 mb-4 text-center">How It Helps Relocators</h2>
        <div class="steps-container">
            <div class="row g-4">
                <div class="col-md-3">
                    <div class="step-card text-center h-100 p-4">
                        <div class="step-number mb-3 mx-auto" style="width: 60px; height: 60px; background: #d4002a; color: white; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 24px; font-weight: bold;">1</div>
                        <h3 class="h5 mb-3">Apply Online</h3>
                        <p class="small">Open your account online from anywhere in the world, even before you arrive in Canada.</p>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="step-card text-center h-100 p-4">
                        <div class="step-number mb-3 mx-auto" style="width: 60px; height: 60px; background: #d4002a; color: white; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 24px; font-weight: bold;">2</div>
                        <h3 class="h5 mb-3">Get Matched</h3>
                        <p class="small">We'll schedule an appointment to complete the process together when you arrive, or remotely if eligible.</p>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="step-card text-center h-100 p-4">
                        <div class="step-number mb-3 mx-auto" style="width: 60px; height: 60px; background: #d4002a; color: white; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 24px; font-weight: bold;">3</div>
                        <h3 class="h5 mb-3">Set Up Services</h3>
                        <p class="small">Activate your account, set up direct deposit, sign up for online banking, and add optional services.</p>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="step-card text-center h-100 p-4">
                        <div class="step-number mb-3 mx-auto" style="width: 60px; height: 60px; background: #d4002a; color: white; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 24px; font-weight: bold;">4</div>
                        <h3 class="h5 mb-3">Start Banking</h3>
                        <p class="small">Begin using your account with no fixed fees for the first year, plus claim your cashback rewards.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php
    return ob_get_clean();
}

/**
 * NBC Fee Structure Section
 */
function smoothmigration_nbc_fee_structure_section() {
    ob_start();
    ?>
    <div class="nbc-fee-structure-section mb-5">
        <h2 class="h3 mb-4">Fee Structure & Savings</h2>
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead class="table-light">
                    <tr>
                        <th>Year</th>
                        <th>Monthly Fee</th>
                        <th>Annual Savings</th>
                        <th>Conditions</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><strong>Year 1</strong></td>
                        <td><span class="text-success fw-bold">$0.00</span></td>
                        <td>$191.40</td>
                        <td>Sign up for eStatements and online banking</td>
                    </tr>
                    <tr>
                        <td><strong>Year 2</strong></td>
                        <td>$7.98</td>
                        <td>$95.64</td>
                        <td>Maintain direct deposit OR 2+ bill payments monthly</td>
                    </tr>
                    <tr>
                        <td><strong>Year 3</strong></td>
                        <td>$11.96</td>
                        <td>$47.88</td>
                        <td>Continue meeting Year 2 conditions</td>
                    </tr>
                    <tr class="table-light">
                        <td colspan="2"><strong>Total 3-Year Savings</strong></td>
                        <td colspan="2"><strong>Up to $574.20</strong></td>
                    </tr>
                </tbody>
            </table>
        </div>
        <p class="text-muted small">
            <i class="fa-solid fa-info-circle me-1"></i>Regular monthly fee of $15.95 applies from Year 4 onwards. Additional savings available with the first cheque order and paper statement waiver.
        </p>
    </div>
    <?php
    return ob_get_clean();
}

/**
 * NBC FAQ Section
 */
function smoothmigration_nbc_faq_section() {
    ob_start();
    ?>
    <div class="nbc-faq-section mb-5">
        <h2 class="h3 mb-4">Frequently Asked Questions</h2>
        <div class="accordion" id="nbcFaqAccordion">
            <div class="accordion-item">
                <h3 class="accordion-header">
                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#faq1">
                        Can I open an account before arriving in Canada?
                    </button>
                </h3>
                <div id="faq1" class="accordion-collapse collapse show" data-bs-parent="#nbcFaqAccordion">
                    <div class="accordion-body">
                        Yes! You can begin the application process online from your home country up to 90 days before your arrival. We'll complete the final verification when you arrive or through a virtual appointment if eligible.
                    </div>
                </div>
            </div>
            
            <div class="accordion-item">
                <h3 class="accordion-header">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq2">
                        Do I need Canadian credit history?
                    </button>
                </h3>
                <div id="faq2" class="accordion-collapse collapse" data-bs-parent="#nbcFaqAccordion">
                    <div class="accordion-body">
                        No! Our newcomer accounts and credit cards are specifically designed for people without Canadian credit history. We'll help you build your credit profile from scratch.
                    </div>
                </div>
            </div>
            
            <div class="accordion-item">
                <h3 class="accordion-header">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq3">
                        How do I claim the $550 cashback?
                    </button>
                </h3>
                <div id="faq3" class="accordion-collapse collapse" data-bs-parent="#nbcFaqAccordion">
                    <div class="accordion-body">
                        The cashback is paid automatically to your chequing account within 180 days of account opening, once you've met all the conditions (account opening, direct deposit, optional credit card, savings, and mortgage setup).
                    </div>
                </div>
            </div>
            
            <div class="accordion-item">
                <h3 class="accordion-header">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq4">
                        What if I'm still in my home country?
                    </button>
                </h3>
                <div id="faq4" class="accordion-collapse collapse" data-bs-parent="#nbcFaqAccordion">
                    <div class="accordion-body">
                        You can start the application online and even transfer money to your new account before you leave. Final account activation typically requires you to visit a branch or complete a virtual verification after arrival.
                    </div>
                </div>
            </div>
            
            <div class="accordion-item">
                <h3 class="accordion-header">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq5">
                        Are there any hidden fees?
                    </button>
                </h3>
                <div id="faq5" class="accordion-collapse collapse" data-bs-parent="#nbcFaqAccordion">
                    <div class="accordion-body">
                        No hidden fees. The monthly account fee is waived for Year 1, reduced in Years 2-3, and clearly disclosed. Transaction fees may apply for services not included in your package. All fees are transparently listed in our Guide to Personal Banking Solutions.
                    </div>
                </div>
            </div>
            
            <div class="accordion-item">
                <h3 class="accordion-header">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq6">
                        How long does account opening take?
                    </button>
                </h3>
                <div id="faq6" class="accordion-collapse collapse" data-bs-parent="#nbcFaqAccordion">
                    <div class="accordion-body">
                        The online application takes about 10-15 minutes. Once you complete verification (in-person or virtual), your account is typically active within 1-2 business days. Your debit card and checks will arrive by mail within 7-10 days.
                    </div>
                </div>
            </div>
            
            <div class="accordion-item">
                <h3 class="accordion-header">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq7">
                        What languages are supported?
                    </button>
                </h3>
                <div id="faq7" class="accordion-collapse collapse" data-bs-parent="#nbcFaqAccordion">
                    <div class="accordion-body">
                        National Bank offers services in 6 languages: French, English, Spanish, Traditional Chinese, Punjabi, and Arabic. ABMs support all 6 languages, and staff assistance is available in multiple languages at most branches.
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php
    return ob_get_clean();
}

/**
 * NBC CTA Section
 */
function smoothmigration_nbc_cta_section( $affiliate_url = '' ) {
    if ( empty( $affiliate_url ) ) {
        $affiliate_url = 'https://www.nbc.ca/personal/accounts/newcomers.html';
    }
    
    ob_start();
    ?>
    <div class="nbc-cta-section text-center py-5 mb-5" style="background: linear-gradient(135deg, #d4002a, #8b0015); color: white; border-radius: 10px;">
        <div class="container">
            <h2 class="h2 mb-3">Ready to Start Your Canadian Banking Journey?</h2>
            <p class="lead mb-4">Join thousands of newcomers who've chosen National Bank of Canada as their trusted banking partner.</p>
            <div class="d-flex flex-wrap gap-3 justify-content-center">
                <a href="<?php echo esc_url( $affiliate_url ); ?>" target="_blank" rel="nofollow noopener" class="btn btn-light btn-lg px-5" onclick="if(window.gtag){gtag('event','cta_click',{brand:'National Bank of Canada',location:'bottom_cta'})}">
                    <i class="fa-solid fa-arrow-right me-2"></i>Open Your Account
                </a>
                <a href="/contact" class="btn btn-outline-light btn-lg px-5">
                    <i class="fa-solid fa-comments me-2"></i>Talk to Our Team
                </a>
            </div>
            <p class="small mt-4 mb-0 opacity-75">
                <i class="fa-solid fa-shield-halved me-1"></i>Secure application • CDIC Protected • Award-winning service
            </p>
        </div>
    </div>
    <?php
    return ob_get_clean();
}

/**
 * Register shortcodes for easy content insertion
 */
add_shortcode( 'nbc_promotion_box', 'smoothmigration_nbc_promotion_box' );
add_shortcode( 'nbc_benefits', 'smoothmigration_nbc_benefits_section' );
add_shortcode( 'nbc_eligibility', 'smoothmigration_nbc_eligibility_section' );
add_shortcode( 'nbc_how_it_works', 'smoothmigration_nbc_how_it_works_section' );
add_shortcode( 'nbc_fee_structure', 'smoothmigration_nbc_fee_structure_section' );
add_shortcode( 'nbc_faq', 'smoothmigration_nbc_faq_section' );
add_shortcode( 'nbc_cta', function() {
    $affiliate_url = get_post_meta( get_the_ID(), '_service_affiliate_url', true );
    return smoothmigration_nbc_cta_section( $affiliate_url );
} );


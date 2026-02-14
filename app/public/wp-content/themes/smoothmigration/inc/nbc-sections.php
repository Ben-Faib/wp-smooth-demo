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
                <i class="fa-solid fa-gift me-2"></i>Special offer for newcomers
            </h3>
            <div class="promotion-highlight mb-3 p-3 bg-light rounded">
                <h4 class="h3 mb-2" style="color: #d4002a;">Up to $600 Cashback*</h4>
                <p class="mb-0">Available from 90 days before your arrival and up to 5 years afterward</p>
            </div>
            <ul class="list-unstyled mb-0">
                <li class="mb-2"><i class="fa-solid fa-check-circle text-success me-2"></i><strong>$300</strong> - Open a chequing account with direct deposit</li>
                <li class="mb-2"><i class="fa-solid fa-check-circle text-success me-2"></i><strong>$100</strong> - Sign up for an eligible credit card</li>
                <li class="mb-2"><i class="fa-solid fa-check-circle text-success me-2"></i><strong>$100</strong> - Activate systematic savings</li>
                <li class="mb-2"><i class="fa-solid fa-check-circle text-success me-2"></i><strong>$100</strong> - Set up pre-authorized mortgage payments</li>
            </ul>
            <p class="text-muted small mt-3 mb-0">
                <i class="fa-solid fa-info-circle me-1"></i>Promotion valid from November 5, 2025, to May 5, 2026. <a href="#nbc-terms-and-conditions-title">Terms and Conditions apply.</a>
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
        <h2 class="h3 mb-4">Banking benefits for newcomers</h2>
        <div class="row g-4">
            <div class="col-md-6">
                <div class="benefit-card h-100 p-4 border rounded">
                    <div class="benefit-icon mb-3">
                        <i class="fa-solid fa-coins fa-2x" style="color: #d4002a;"></i>
                    </div>
                    <h3 class="h5">No fixed monthly fees</h3>
                    <p>Save up to $574.20 over 3 years with no monthly account fees for the first year, reduced fees in year 2 and 3.</p>
                </div>
            </div>
            <div class="col-md-6">
                <div class="benefit-card h-100 p-4 border rounded">
                    <div class="benefit-icon mb-3">
                        <i class="fa-solid fa-scale-balanced fa-2x" style="color: #d4002a;"></i>
                    </div>
                    <h3 class="h5">Legal support</h3>
                    <p>Get 12 months of free legal assistance for everyday concerns. Get 12 months of free legal assistance for everyday concerns through
the available Assistance Network, available 7 days a week</p>
                </div>
            </div>
            <div class="col-md-6">
                <div class="benefit-card h-100 p-4 border rounded">
                    <div class="benefit-icon mb-3">
                        <i class="fa-solid fa-credit-card fa-2x" style="color: #d4002a;"></i>
                    </div>
                    <h3 class="h5">Build credit history</h3>
                    <p>Access credit cards designed for newcomers to help you build your Canadian credit history from day one.</p>
                </div>
            </div>
            <div class="col-md-6">
                <div class="benefit-card h-100 p-4 border rounded">
                    <div class="benefit-icon mb-3">
                        <i class="fa-solid fa-building-columns fa-2x" style="color: #d4002a;"></i>
                    </div>
                    <h3 class="h5">Nationwide access</h3>
                    <p>361+ branches across Canada and 2,071 ABMs, plus services available in 6 languages including French and English.</p>
                </div>
            </div>
            <div class="col-md-6">
                <div class="benefit-card h-100 p-4 border rounded">
                    <div class="benefit-icon mb-3">
                        <i class="fa-solid fa-globe fa-2x" style="color: #d4002a;"></i>
                    </div>
                    <h3 class="h5">International banking</h3>
                    <p>Transfer money internationally starting at $5.95, plus access funds abroad through partner ABM networks worldwide.</p>
                </div>
            </div>
            <div class="col-md-6">
                <div class="benefit-card h-100 p-4 border rounded">
                    <div class="benefit-icon mb-3">
                        <i class="fa-solid fa-shield-halved fa-2x" style="color: #d4002a;"></i>
                    </div>
                    <h3 class="h5">CDIC protected</h3>
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
        <h2 class="h3 mb-4">Who's eligible?</h2>
        <div class="eligibility-content p-4 bg-light rounded">
            <h3 class="h5 mb-3">You qualify for the newcomer offer if you are:</h3>
            <ul class="list-unstyled mb-4">
                <li class="mb-2"><i class="fa-solid fa-check text-success me-2"></i>At least 18 years of age</li>
                <li class="mb-2"><i class="fa-solid fa-check text-success me-2"></i>A permanent resident, temporary worker, or international student</li>
                <li class="mb-2"><i class="fa-solid fa-check text-success me-2"></i>Applying from 90 days before arrival up to 5 years after arriving in Canada</li>
                <li class="mb-2"><i class="fa-solid fa-check text-success me-2"></i>The sole user of the account (individual account only)</li>
            </ul>

            <div class="container">
                <header>
                    <h3 class="h5 mb-3">Just 2 simple steps to open your bank account</h3>
                    <p class="subtitle">Make the most of our offer and get a bank account with no fixed monthly fee for 3 years as well as other benefits.</p>
                </header>
                
                <div class="intro">
                    <p>Find out if you're eligible by checking the criteria and following the steps below.</p>
                </div>
                
                <div class="steps-container">
                    <div class="step">
                        <div class="step-number">1</div>
                        <div class="step-content">
                            <h2 class="step-title">Open an account online</h2>
                            <p class="step-description">Fill out an online application form. You'll need the following:</p>
                            <div class="requirements">
                                <ul>
                                    <li>A Canadian phone number</li>
                                    <li>One of the following documents:
                                        <ul class="nested-list">
                                            <li>A valid and eligible foreign passport</li>
                                            <li>A Canadian permanent resident card</li>
                                            <li>A Canadian driver's license</li>
                                            <li>A provincial or federal ID (except Quebec)</li>
                                            <li>A valid Quebec Health Insurance Card</li>
                                        </ul>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    
                    <div class="step">
                        <div class="step-number">2</div>
                        <div class="step-content">
                            <h2 class="step-title">Receive a confirmation email</h2>
                            <p class="step-description">Within a couple of days of your request, you'll receive a confirmation email with your account information. Your debit card will then be mailed to you.</p>
                        </div>
                    </div>
                </div>

                <div class="container">
                    <h3 class="h5 mb-3">If you are already in Canada</h3>
                    <p>To complete the online application form, you will need:</p>
                    <ul>
                        <li>A Canadian phone number</li>
                        <li>One of the following documents:
                            <ul class="nested-list">
                                <li>A valid and eligible passport from a country other than Canada</li>
                                <li>A Canadian permanent resident card</li>
                                <li>A Canadian driver's licence</li>
                                <li>A Canadian identity card (except in Quebec)</li>
                                <li>A Quebec health insurance card (new model)</li>
                            </ul>
                        </li>
                    </ul>
                </div>

                <div class="section">
                    <h3 class="h5 mb-3">If you are still in your home country and will be arriving in Canada in less than 90 days</h3>
                    <div class="no-documents">
                        No documents are required to complete your online form.
                    </div>
                </div>
            </div> <!-- /.container -->
        </div> <!-- /.eligibility-content -->

        <!--
        <h3 class="h5 mb-3 mt-4">What you'll need:</h3>
        <div class="row g-3">
            <div class="col-md-6">
                <div class="document-card p-3 bg-white rounded border">
                    <h4 class="h6 mb-2"><i class="fa-solid fa-passport me-2" style="color: #d4002a;"></i>Identification</h4>
                    <p class="small mb-0">Valid passport or government-issued ID from your home country</p>
                </div>
            </div>
            <div class="col-md-6">
                <div class="document-card p-3 bg-white rounded border">
                    <h4 class="h6 mb-2"><i class="fa-solid fa-file-certificate me-2" style="color: #d4002a;"></i>Immigration documents</h4>
                    <p class="small mb-0">Work permit, study permit, or permanent resident card</p>
                </div>
            </div>
            <div class="col-md-6">
                <div class="document-card p-3 bg-white rounded border">
                    <h4 class="h6 mb-2"><i class="fa-solid fa-location-dot me-2" style="color: #d4002a;"></i>Proof of address</h4>
                    <p class="small mb-0">Lease agreement, utility bill, or letter from landlord (if already in Canada)</p>
                </div>
            </div>
            <div class="col-md-6">
                <div class="document-card p-3 bg-white rounded border">
                    <h4 class="h6 mb-2"><i class="fa-solid fa-briefcase me-2" style="color: #d4002a;"></i>Employment info</h4>
                    <p class="small mb-0">Job offer letter or employment contract (for direct deposit setup)</p>
                </div>
            </div>
        </div>
        -->
    </div> <!-- /.nbc-eligibility-section -->
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
                        <h3 class="h5 mb-3">Apply online</h3>
                        <p class="small">Open your account online from anywhere in the world, even before you arrive in Canada.</p>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="step-card text-center h-100 p-4">
                        <div class="step-number mb-3 mx-auto" style="width: 60px; height: 60px; background: #d4002a; color: white; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 24px; font-weight: bold;">2</div>
                        <h3 class="h5 mb-3">Get matched</h3>
                        <p class="small">We'll schedule an appointment to complete the process together when you arrive, or remotely if eligible.</p>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="step-card text-center h-100 p-4">
                        <div class="step-number mb-3 mx-auto" style="width: 60px; height: 60px; background: #d4002a; color: white; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 24px; font-weight: bold;">3</div>
                        <h3 class="h5 mb-3">Set-up services</h3>
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
    <div class="nbc-fee-structure-section mb-5" id="fees">
        <h2 class="h3 mb-4">Fees</h2>
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
    <div class="nbc-faq-section mb-5" id="faq">
        <h2 class="h3 mb-4">FAQs</h2>
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
                        How do I claim the $600 cashback*?
                    </button>
                </h3>
                <div id="faq3" class="accordion-collapse collapse" data-bs-parent="#nbcFaqAccordion">
                    <div class="accordion-body">
                        The cashback is paid automatically to your chequing account within 180 days of <u>account opening</u>, once you've met all the <strong><i><a href="##nbc-terms-and-conditions-title">conditions</a></i></strong> (account opening, direct deposit, optional credit card, savings, and mortgage setup).
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
 * NBC Supported Countries/Regions Section
 */
function smoothmigration_nbc_countries_section() {
    ob_start();
    ?>
    <div class="nbc-countries-section mb-5" id="countries">
        <h2 class="h3 mb-4">National Bank locations</h2>
        <p class="lead">National Bank serves clients across the country.</p>
        
        <div class="row g-4 mt-3">
            <div class="col-md-6">
                <div class="p-4 border rounded h-100">
                    <h3 class="h5 mb-3">
                    <img src="https://smoothmigration.ca/wp-content/uploads/2026/01/icon-twotones-social.svg" class="me-2" style="vertical-align:-0.125em;">
                    <br>
                    Branches</h3>
                    <ul class="mb-0">
                        <li><strong>361+ branches</strong> across Canada</li>
                        <li><strong>2,071 ABMs</strong> nationwide</li>
                        <li>Extensive coverage in Quebec and Ontario</li>
                        <li>Growing presence in Western Canada</li>
                        <li>Services available in <strong>6 languages</strong></li>
                    </ul>
                </div>
            </div>
            <div class="col-md-6">
                <div class="p-4 border rounded h-100">
                    <h3 class="h5 mb-3">
                    <img src="https://smoothmigration.ca/wp-content/uploads/2026/01/picto-transfer-simple-international-color.svg" class="me-2" style="vertical-align:-0.125em;">
                    <br>International access</h3>
                    <ul class="mb-0">
                        <li>Access funds abroad via <strong>Cirrus®, Maestro®, and NYCE®</strong> networks</li>
                        <li>Partner ABMs worldwide (Accel®, Cirrus®, Allpoint®)</li>
                        <li>International money transfers to 170+ countries</li>
                        <li>Newcomer support from your home country</li>
                    </ul>
                </div>
            </div>
        </div>
        
        <div class="alert alert-info mt-4">
            <i class="fa-solid fa-info-circle me-2"></i>
            <strong>New to Canada?</strong> You can start your application from your home country up to 90 days before arrival. Visit a branch upon arrival or complete verification remotely.
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
        $affiliate_url = 'https://locator.nbc.ca/index.html';
    }
    
    ob_start();
    ?>
    <div class="nbc-cta-section text-center py-5 mb-5" style="background: linear-gradient(135deg, #d4002a, #8b0015); color: white; border-radius: 10px;">
        <div class="container">
            <h2 class="h2 mb-3">Ready to start your Canadian banking journey?</h2>
            <p class="lead mb-4">Join thousands of newcomers who've chosen National Bank of Canada as their trusted banking partner.</p>
            <div class="d-flex flex-wrap gap-3 justify-content-center">
                <a href="<?php echo esc_url( $affiliate_url ); ?>" target="_blank" rel="nofollow noopener" class="btn btn-light btn-lg px-5" onclick="if(window.gtag){gtag('event','cta_click',{brand:'National Bank of Canada',location:'bottom_cta'})}">
                    <i class="fa-solid fa-arrow-right me-2"></i>Open an account online
                </a>
                <a href="https://www.nbc.ca/personal/accounts.html" class="btn btn-outline-light btn-lg px-5">
                    <i class="fa-solid fa-comments me-2"></i>Speak with an expert
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

function smoothmigration_nbc_terms_and_conditions_section() {
    ob_start();
    ?>
    <div class="nbc-tac-section mb-5" id="terms-and-conditions">

        <h2 class="h3 mb-4" id="nbc-terms-and-conditions-title">Legal disclaimers</h2>
        <div class="accordion" id="nbcTacAccordion">
            <div class="accordion-item">
                <h3 class="accordion-header">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#tac1">
                        Terms and conditions of the promotion
                    </button>
                </h3>
            <div id="tac1" class="accordion-collapse collapse" data-bs-parent="#nbcTacAccordion">
                    <div class="accordion-body">
                        <section class="terms-conditions">

                            <h2>Cashback Promotion – Chequing Account and Additional Cashback</h2>


                            <h3>Description of the Promotion</h3>
                            <p>Up to <strong>$600 cashback</strong> after opening a chequing account and adding certain products or services, or carrying out certain transactions in the new account.</p>

                            <h3>Eligibility Conditions</h3>

                            <table border="1" cellspacing="0" cellpadding="8" class="table-responsive">
                                <tr>
                                    <th>Products, Services or Transactions</th>
                                    <th>Conditions</th>
                                    <th>Cashback</th>
                                </tr>
                                <tr>
                                    <td>New National Bank chequing account with an eligible package/offer, online services and activation of an automatic deposit</td>
                                    <td>
                                        <ul>
                                            <li>During the promotion period, open a first chequing account as the main account holder using the redirection link on one of our partners' sites (finder.com, Borrowell, or MoneySense) and sign up for The Connected® package.</li>
                                            <li>Within 120 days of opening the chequing account and signing up for the eligible package/offer, complete the following steps:
                                                <ul>
                                                    <li>Sign up for online banking</li>
                                                    <li>Carry out 20 eligible transactions, including debit card purchases and bill payments using your online banking or the National Bank mobile app.</li>
                                                </ul>
                                            </li>
                                            <li>The following transactions are excluded:
                                                <ul>
                                                    <li>Refund of purchases (Interac®)</li>
                                                    <li>Reimbursement of fees</li>
                                                    <li>Flat monthly fee</li>
                                                    <li>Account handling charges</li>
                                                </ul>
                                            </li>
                                            <li>Receive 3 eligible automatic deposits of at least $100 each within the first 120 days according to the following schedule:
                                                <ul>
                                                    <li>1st deposit: within 60 days</li>
                                                    <li>2nd deposit: between 60–89 days</li>
                                                    <li>3rd deposit: between 90–120 days</li>
                                                </ul>
                                            </li>
                                            <li>Maintain this package or offer for at least 120 days after opening the chequing account.</li>
                                            <li>Must not have had a National Bank chequing or savings account, or specified lines of credit, in the past 36 months.</li>
                                        </ul>
                                    </td>
                                    <td>$300 (Basic cashback)</td>
                                </tr>
                                <tr>
                                    <td>Apply for a new eligible credit card</td>
                                    <td>
                                        <ul>
                                            <li>Within 120 days, apply for and be approved as the primary cardholder for one of the following cards:
                                                <ul>
                                                    <li>Platinum Mastercard®</li>
                                                    <li>World Mastercard®</li>
                                                    <li>World Elite Mastercard®</li>
                                                    <li>Mycredit Mastercard®</li>
                                                    <li>Allure Mastercard®</li>
                                                    <li>MC1 Mastercard®</li>
                                                    <li>Mastercard Echo® Cashback</li>
                                                    <li>Syncro Mastercard®</li>
                                                </ul>
                                            </li>
                                            <li>Carry out at least 20 purchases or cash advances with the new credit card.</li>
                                            <li>Excluded transactions: Mastercard cheques, interest, fees, returns, or redemptions.</li>
                                            <li>Must not have been a National Bank personal credit cardholder in the past 36 months.</li>
                                        </ul>
                                    </td>
                                    <td>+ $100</td>
                                </tr>
                                <tr>
                                    <td>Automatic mortgage loan payment</td>
                                    <td>Within 120 days, set up pre-authorized recurring payments from the new chequing account for a National Bank mortgage.</td>
                                    <td>+ $100</td>
                                </tr>
                                <tr>
                                    <td>High Interest Savings Account</td>
                                    <td>
                                        <ul>
                                            <li>Within 15 days of opening the chequing account, open a High Interest Savings Account and deposit at least $5,000.</li>
                                            <li>Maintain a minimum balance of $5,000 for 120 days.</li>
                                            <li>Must not have held a National Bank High Interest Savings Account in the past 36 months.</li>
                                        </ul>
                                    </td>
                                    <td>+ $100</td>
                                </tr>
                                <tr>
                                    <th colspan="2">Total cashback if all conditions are met</th>
                                    <th>Up to $600</th>
                                </tr>
                            </table>

                            <h3>Eligible Automated Direct Deposits</h3>
                            <table border="1" cellspacing="0" cellpadding="8">
                                <tr><th>Type</th><th>Payments Canada Transaction Code</th></tr>
                                <tr><td>Payroll Deposit</td><td>200</td></tr>
                                <tr><td>Private Pension</td><td>233</td></tr>
                                <tr><td>Family Support Plan</td><td>601</td></tr>
                                <tr><td>Special Payroll</td><td>201</td></tr>
                                <tr><td>Retirement Income Fund</td><td>272</td></tr>
                                <tr><td>Income Security Benefits</td><td>603</td></tr>
                                <tr><td>Vacation Payroll</td><td>202</td></tr>
                                <tr><td>Canada Child Benefit</td><td>308</td></tr>
                                <tr><td>CNESST</td><td>605</td></tr>
                                <tr><td>Overtime Payroll</td><td>203</td></tr>
                                <tr><td>CPP (Canada Pension Plan)</td><td>310</td></tr>
                                <tr><td>Employment Assistance Allowance</td><td>607</td></tr>
                                <tr><td>Advance Pay</td><td>204</td></tr>
                                <tr><td>Old Age Security</td><td>311</td></tr>
                                <tr><td>Disability Payment</td><td>611</td></tr>
                                <tr><td>Commission Payroll</td><td>205</td></tr>
                                <tr><td>War Veterans' Allowance</td><td>312</td></tr>
                                <tr><td>Parental Insurance</td><td>612</td></tr>
                                <tr><td>Bonus Payroll</td><td>206</td></tr>
                                <tr><td>VAC (Veterans Affairs Canada)</td><td>313</td></tr>
                                <tr><td>Children Assistance</td><td>616</td></tr>
                                <tr><td>Adjustment Payroll</td><td>207</td></tr>
                                <tr><td>Public Service Superannuation</td><td>315</td></tr>
                                <tr><td>Miscellaneous Payments</td><td>450</td></tr>
                                <tr><td>Pension</td><td>230</td></tr>
                                <tr><td>Canadian Forces Superannuation</td><td>316</td></tr>
                                <tr><td>Accounts Payable</td><td>460</td></tr>
                                <tr><td>Federal Pension</td><td>231</td></tr>
                                <tr><td>Employment Insurance</td><td>318</td></tr>
                                <tr><td>Provincial Pension</td><td>232</td></tr>
                                <tr><td>Canada Disability Benefit</td><td>328</td></tr>
                            </table>

                            <h3>Cashback Payment Schedule</h3>
                            <table border="1" cellspacing="0" cellpadding="8">
                                <tr>
                                    <th>Opening Date of New Chequing Account</th>
                                    <th>Date of Cashback Deposit</th>
                                </tr>
                                <tr><td>Nov 5 – Nov 30, 2025</td><td>By May 15, 2026</td></tr>
                                <tr><td>Dec 1 – Dec 31, 2025</td><td>By June 15, 2026</td></tr>
                                <tr><td>Jan 1 – Jan 31, 2026</td><td>By July 15, 2026</td></tr>
                                <tr><td>Feb 1 – Feb 28, 2026</td><td>By August 15, 2026</td></tr>
                                <tr><td>Mar 1 – Mar 31, 2026</td><td>By September 15, 2026</td></tr>
                                <tr><td>Apr 1 – Apr 30, 2026</td><td>By October 15, 2026</td></tr>
                                <tr><td>May 1 – May 5, 2026</td><td>By November 15, 2026</td></tr>
                            </table>

                            <h3>Other Conditions</h3>
                            <ul>
                                <li>Only one cashback per chequing account.</li>
                                <li>Must be at least 14 years old to open the account.</li>
                                <li>Must keep both the chequing account and any eligible credit card for at least 12 months.</li>
                                <li>Chequing account must remain in good standing for at least 180 days (no unauthorized overdrafts or misuse).</li>
                                <li>Credit card must remain in good standing (minimum payments made on time).</li>
                                <li>Credit card approval subject to National Bank credit approval; must be 18 years or older.</li>
                                <li>Employees of National Bank, CWB®, or subsidiaries and their spouses are not eligible.</li>
                                <li>Promotion may be modified or withdrawn without notice.</li>
                                <li>Cannot be combined with other National Bank chequing cashback promotions, but may be combined with eligible credit card, mortgage, insurance, or investment promotions.</li>
                            </ul>

                            <p><strong>Trademarks:</strong><br>
                            ® NATIONAL BANK, CWB, CRESCENDO, THE STRATEGIST, THE CONNECTED, THE TOTAL, SUPERIOR FLEX LINE, ALL-IN-ONE, MY CREDIT, ALLURE, and ECHO are registered trademarks of National Bank of Canada.<br>
                            ® Interac is a registered trademark of Interac Corp. Used under licence.<br>
                            ® Mastercard, World Mastercard, MC1, Platinum, and World Elite are registered trademarks, and the circles design is a trademark of Mastercard International Incorporated. National Bank is an authorized user.
                            </p>

                        </section>
                    </div> <!-- /.accordion-body -->
                </div> <!-- /.accordion-collapse -->
        </div> <!-- /.accordion-item -->


        <div class="accordion" id="nbcTacLdAccordion">
            <div class="accordion-item">
                <h3 class="accordion-header">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#tac2">
                        Legal disclaimers
                    </button>
                </h3>
                <div id="tac2" class="accordion-collapse collapse" data-bs-parent="#nbcTacLdAccordion">
                    <div class="accordion-body">
                        <section class="terms-conditions">
                            <h3>Legal disclaimers</h3>
                            <ul>
                                <li>TM National Bank Assistance Network is a trademark of National Bank of Canada, used under licence by authorized third parties.</li>
                                <li>® Mastercard is a registered trademark, and the circles design is a trademark of Mastercard International Incorporated. Authorized user: National Bank.</li>
                                <li>®THE EXCHANGE and Accel are registered trademarks of Fiserv Inc.</li>
                                <li>®CIRRUS is a registered trademark of Mastercard International Incorporated. Authorized user: National Bank.</li>
                                <li>®Allpoint is a registered trademark of ATM National LLC.</li>
                                <li>PARAGON, CELPIP, CELPIT, CELTOP, CELL, LPI, CANADIAN ENGLISH LANGUAGE PROFICIENCY INDEX TEST, LANGUAGE PROFICIENCY INDEX, CANADIAN ENGLISH LANGUAGE PROFICIENCY INDEX PROGRAM, CAEL, CANADIAN ACADEMIC ENGLISH LANGUAGE ASSESSMENT and related logos are registered or unregistered trademarks and service marks owned or licensed by Paragon. Any unauthorized use of those trademarks is strictly prohibited, and nothing on a Website or in these General Terms of Services or any Service Terms will be construed as granting, by implication, estoppel, or otherwise, any licence or right to use any of those trademarks and service marks.</li>
                                <li>National Bank of Canada is not a licensed bank in France or other countries outside of Canada.</li>
                                <li>National Bank of Canada was named the best bank for newcomers to Canada by MoneySense in 2024. MoneySense establishes its annual rankings by selecting some of the largest financial institutions and comparing them for fees, access to credit and services offered to newcomers.</li>
                                <li>National Bank's mycredit® Mastercard® credit card has won the Milesopedia best credit card for newcomers in 2023. Each year, Milesopedia examines the credit card offers of the largest financial institutions and establishes its ranking according to more than 150 criteria such as fees, welcome offers, minimum income required, number of points per category, account credits, insurance, airport lounge access, etc.
                                    <ul>
                                        <li>Our banking offer is available to newcomers from their home countries up to 90 days before arriving in Canada or at any point during your first 5 years in Canada. <a href="https://www.nbc.ca/personal/switch-national-bank/newcomers/celpip-cael-offer.html#notes-item-d5892ec38c">See the above terms and conditions of the offer for no fixed monthly fee for 3 years</a>. The offer may be modified, extended or withdrawn, without prior notice, at any time. The offer may not be combined or used with any other National Bank offer, promotion or benefit. Fees may apply for transactions not included in the banking offer for newcomers. For more information on transaction fees, see our <a href="https://www.nbc.ca/content/dam/bnc/particuliers/pdf/tarification-compte/brochure-fees-banking.pdf">Guide to Personal Banking Solutions</a> [PDF].</li>
                                        <li>Financing is subject to credit approval by National Bank. Certain conditions apply. Eligible credit cards: mycredit, MC1, Allure, Syncro, Platinum, ECHO Cashback, World and World Elite.</li>
                                        <li>Guarantee may be required under certain circumstances. Financing is subject to credit approval by National Bank. Certain conditions apply.</li>
                                        <li>International Transfer by Mastercard® and Interac® are available at a cost of $5.95 per transaction, no matter which account you hold. The amount received by the beneficiary may differ from the amount sent considering that the intermediary bank or the beneficiary's bank will apply their fees to the original transfer's amount. This service allows you to transfer funds to the United States, India, Philippines, United Kingdom and the following 19 European countries: Austria, Belgium, Cyprus, Estonia, Finland, France, Germany, Greece, Ireland, Italy, Latvia, Lithuania, Luxembourg, Malta, the Netherlands, Portugal, Slovakia, Slovenia and Spain.</li>
                                        <li>Telephone assistance service offered by FBA Solutions, valid for 12 months from your account opening date. The content of the packages and terms described are subject to change.</li>
                                        <li>National Bank ABMs or ABMs in THE EXCHANGEᴹᴰ network. Use all our ABM features in six languages (French, English, Spanish, Traditional Chinese, Punjabi, and Arabic).</li>
                                    </ul>
                                </li>
                                <li>Locate CIRRUS, Maestro® and NYCE® ABMs and payment terminals with the logos on the back of your card. You can then use your debit card at these ABMs in the United States and around the world, including our network of partners Accel®, Cirrus® and Allpoint®. Administrative or exchange rate fees may apply.</li>
                            </ul>
                        </section>
                    </div> <!-- /.accordion-body -->
                </div> <!-- /.accordion-collapse -->
            </div> <!-- /.accordion-item -->
        </div>

        <div class="accordion" id="nbcTacEcAccordion">
            <div class="accordion-item">
                <h3 class="accordion-header">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#tac3">
                        Eligibility criteria
                    </button>
                </h3>
                <div id="tac3" class="accordion-collapse collapse" data-bs-parent="#nbcTacEcAccordion">
                    <div class="accordion-body">
                        <section class="terms-conditions">
                            <h3>Eligibility criteria</h3>
                            <ul>
                                <li>Be a newcomer and at least 18 years of age or older</li>
                                <li>Apply to open an account from your home country up to 90 days before you arrive in Canada, or within 5 years of your arrival</li>
                                <li>Be the only account user</li>
                                <li>The offer for newcomers is open to permanent residents, temporary workers and international students</li>
                            </ul>

                                                        
                    
                        </section>
                    </div> <!-- /.accordion-body -->
                </div> <!-- /.accordion-collapse -->
            </div> <!-- /.accordion-item -->
        </div>

        <div class="accordion" id="nbcTacDacAccordion">
            <div class="accordion-item">
                <h3 class="accordion-header">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#tac4">
                        Bank account for Newcomers details and conditions
                    </button>
                </h3>
                <div id="tac4" class="accordion-collapse collapse" data-bs-parent="#nbcTacDacAccordion">
                    <div class="accordion-body">
                        <section class="terms-conditions">
                            <h3>Bank account for Newcomers details and conditions</h3>
                            <ul>
                                <li><strong>Three levels of savings possible on your newcomer bank account</strong></li>
                                <li><strong>1. Baseline savings of $334.92 over three years for the account</strong>
                                    <ul>
                                        <li>You'll save if you meet the following conditions:</li>
                                        <li>Open a bank account online before arriving with our secure form or visit a branch upon arrival.</li>
                                        <li>Sign up for our offer for newcomers.</li>
                                        <li>Savings are based on:
                                            <ul>
                                                <li><strong>First year</strong>: no flat monthly fee (savings of $15.95/month for 12 months)</li>
                                                <li><strong>Second year</strong>: flat monthly fee of $7.98 instead of $15.95 (savings of $7.97/month for 12 months)</li>
                                                <li><strong>Third year</strong>: flat monthly fee of $11.96 instead of $15.95 (savings of $3.99/month for 12 months)</li>
                                            </ul>
                                        </li>
                                    </ul>
                                </li>
                                <li><strong>2. Maximum savings on the account: $574.20 over 3 years</strong>
                                    <ul>
                                        <li>In addition to the basic savings conditions, you must:</li>
                                        <li>Maintain a minimum daily balance of <strong>$4,500</strong></li>
                                        <li><strong>OR</strong></li>
                                        <li>Sign up for the following three products and services before the end of the first year and maintain them until the end of the special offer:
                                            <ul>
                                                <li>A <strong>Mastercard</strong>® personal credit card</li>
                                                <li><strong>Electronic bank statements</strong></li>
                                                <li><strong>Payroll deposit</strong> to your bank account at one of our branches at least once a month <strong>or</strong> payment of at least two bills per month electronically from this bank account</li>
                                            </ul>
                                        </li>
                                    </ul>
                                </li>
                                <li><strong>3. Maximum total savings of the offer: $683.30 over 3 years</strong>
                                    <ul>
                                        <li>To reach these savings, you must meet all the conditions for maximum savings on the account (above) and take advantage of the following services:
                                            <ul>
                                                <li>First check order free ($67.10/order)</li>
                                                <li>Free paper bank statements for the first year ($42)</li>
                                            </ul>
                                        </li>
                                    </ul>
                                </li>
                                <li><strong>Please note</strong>:
                                    <ul>
                                        <li>The savings depend on meeting all the requirements for the entire duration of the offer (3 years).</li>
                                        <li>If you do not meet all the conditions in a given month, your savings will be reduced.</li>
                                        <li>If you no longer have the bank account or the Newcomer Package, the savings will no longer apply.</li>
                                    </ul>
                                </li>
                                <li>At the end of the third year, the Newcomer Package will automatically be migrated to <a href="https://www.nbc.ca/personal/accounts/chequing/connected.html">The Connected® package</a>, along with any applicable benefits. No action is required on your part. You can also <a href="https://www.nbc.ca/personal/accounts/chequing.html">browse all our packages</a> to find the one that best suits your needs.</li>
                            </ul> 
                        </section>
                    </div> <!-- /.accordion-body -->
                </div> <!-- /.accordion-collapse -->
            </div> <!-- /.accordion-item -->
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
add_shortcode( 'nbc_countries', 'smoothmigration_nbc_countries_section' );
add_shortcode( 'nbc_faq', 'smoothmigration_nbc_faq_section' );
add_shortcode( 'nbc_tac', 'smoothmigration_nbc_terms_and_conditions_section' );




add_shortcode( 'nbc_cta', function() {
    $affiliate_url = get_post_meta( get_the_ID(), '_service_affiliate_url', true );
    return smoothmigration_nbc_cta_section( $affiliate_url );
} );


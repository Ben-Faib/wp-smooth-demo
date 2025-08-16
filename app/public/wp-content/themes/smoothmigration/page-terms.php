<?php
/**
 * Terms of Service Page Template
 * Professional terms page with clear typography and modern design
 * 
 * @package smoothmigration
 */

get_header();
?>

<main id="main" class="site-main legal-page" role="main">

    <!-- Hero Section -->
    <section class="legal-hero py-6 bg-gradient-primary text-white position-relative overflow-hidden">
        <div class="container position-relative z-2">
            <div class="row justify-content-center text-center">
                <div class="col-lg-8">
                    <div class="hero-content animate-on-scroll">
                        <div class="hero-badge mb-4">
                            <span class="badge-legal">📄 Terms & Conditions</span>
                        </div>
                        <h1 class="display-2 fw-bold mb-4">Terms of Service</h1>
                        <p class="lead fs-4 mb-4 opacity-90">Please read these terms carefully before using our services.</p>
                        <div class="legal-update-notice">
                            <i class="fas fa-clock me-2"></i>
                            <span>Last Updated: <?php echo date('F d, Y'); ?></span>
                        </div>
                    </div>
                </div>
    </div>
</div>

        <!-- Background Pattern -->
        <div class="hero-pattern position-absolute top-0 start-0 w-100 h-100 opacity-10"></div>
    </section>

    <!-- Quick Navigation -->
    <section class="legal-nav py-4 bg-light border-bottom">
    <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-10">
                    <nav class="legal-navigation">
                        <h4 class="nav-title">Quick Navigation</h4>
                        <div class="nav-links">
                            <a href="#acceptance" class="nav-link">Acceptance</a>
                            <a href="#services" class="nav-link">Services</a>
                            <a href="#use-of-services" class="nav-link">Use of Services</a>
                            <a href="#third-party" class="nav-link">Third-Party Services</a>
                            <a href="#limitation" class="nav-link">Liability</a>
                            <a href="#contact" class="nav-link">Contact</a>
                        </div>
                    </nav>
                </div>
            </div>
        </div>
    </section>

    <!-- Legal Content -->
    <section class="legal-content py-6">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-10">
                    <div class="legal-document">
                        
                        <!-- Introduction -->
                        <div class="legal-section intro-section">
                            <div class="section-header">
                                <i class="fas fa-file-contract"></i>
                                <h2>Introduction</h2>
                            </div>
                            <div class="section-content">
                                <p class="lead">These Terms of Service ("Terms") constitute a legally binding agreement between you and Smooth Migration Global ("Company," "we," "our," or "us") regarding your use of our website and services.</p>

                <div class="important-notice">
                                    <div class="notice-header">
                                        <i class="fas fa-exclamation-triangle"></i>
                                        <strong>Important Notice</strong>
                                    </div>
                                    <p>By accessing our website, using our services, or clicking "I agree" where applicable, you acknowledge that you have read, understood, and agree to be bound by these Terms, as well as our Privacy Policy and Cookie Policy.</p>
                                </div>
                            </div>
                </div>

                        <!-- Acceptance of Terms -->
                        <div id="acceptance" class="legal-section">
                            <div class="section-header">
                                <i class="fas fa-handshake"></i>
                                <h2>Acceptance of Terms</h2>
                            </div>
                            <div class="section-content">
                                <p>These Terms of Service ("Terms") constitute a legally binding agreement between you and Smooth Migration Global ("Company," "we," "our," or "us") regarding your use of our website and services.</p>
                                <p>By accessing our website, using our services, or clicking "I agree" where applicable, you acknowledge that you have read, understood, and agree to be bound by these Terms, as well as our Privacy Policy and Cookie Policy.</p>
                            </div>
                        </div>

                        <!-- Description of Services -->
                        <div id="services" class="legal-section">
                            <div class="section-header">
                                <i class="fas fa-concierge-bell"></i>
                                <h2>Description of Services</h2>
                            </div>
                            <div class="section-content">
                                <p>Smooth Migration Global provides an online platform that connects individuals and families planning international relocations with vetted service providers. Our services include:</p>
                                <ul>
                                    <li>Matching users with real estate professionals, moving companies, and other relocation service providers</li>
                                    <li>Providing information and resources about international relocation</li>
                                    <li>Offering planning tools and checklists</li>
                                    <li>Facilitating communication between users and service providers</li>
                                </ul>
                                
                                <h3>Service Limitations</h3>
                                <p>We act as an intermediary platform and do not directly provide real estate, moving, legal, financial, or other professional services. The actual services are provided by independent third-party providers.</p>
                            </div>
                        </div>

                        <!-- Eligibility and Account -->
                        <div id="eligibility" class="legal-section">
                            <div class="section-header">
                                <i class="fas fa-user-check"></i>
                                <h2>Eligibility and Account</h2>
                            </div>
                            <div class="section-content">
                                <h3>Age Requirement</h3>
                                <p>You must be at least 18 years old to use our services. By using our services, you represent and warrant that you meet this age requirement.</p>
                                
                                <h3>Account Registration</h3>
                                <p>Some features may require you to create an account. When creating an account, you agree to:</p>
                                <ul>
                                    <li>Provide accurate, current, and complete information</li>
                                    <li>Maintain and update your information to keep it accurate</li>
                                    <li>Keep your login credentials secure and confidential</li>
                                    <li>Accept responsibility for all activities under your account</li>
                                    <li>Notify us immediately of any unauthorized use</li>
                                </ul>
                            </div>
                        </div>

                        <!-- Use of Services -->
                        <div id="use-of-services" class="legal-section">
                            <div class="section-header">
                                <i class="fas fa-user-cog"></i>
                                <h2>Use of Services</h2>
                            </div>
                            <div class="section-content">
                                <h3>Permitted Use</h3>
                                <p>You may use our services only for lawful purposes and in accordance with these Terms. You agree to:</p>
                                <ul>
                                    <li>Use our services for legitimate relocation planning purposes</li>
                                    <li>Provide truthful information in all interactions</li>
                                    <li>Respect the rights and privacy of others</li>
                                    <li>Comply with all applicable laws and regulations</li>
                                </ul>
                                
                                <h3>Prohibited Use</h3>
                                <p>You agree NOT to:</p>
                                <ul>
                                    <li>Use our services for any illegal or unauthorized purpose</li>
                                    <li>Violate any laws in your jurisdiction</li>
                                    <li>Transmit any malicious code, viruses, or harmful content</li>
                                    <li>Attempt to gain unauthorized access to our systems</li>
                                    <li>Interfere with or disrupt our services or servers</li>
                                    <li>Collect or harvest user data without permission</li>
                                    <li>Impersonate another person or entity</li>
                                    <li>Use automated systems or bots without our permission</li>
                                    <li>Engage in any activity that could damage our reputation</li>
                                </ul>
                            </div>
                        </div>

                        <!-- User Content and Conduct -->
                        <div id="user-content" class="legal-section">
                            <div class="section-header">
                                <i class="fas fa-file-alt"></i>
                                <h2>User Content and Conduct</h2>
                            </div>
                            <div class="section-content">
                                <h3>Content Ownership</h3>
                                <p>You retain ownership of any content you submit through our services. However, by submitting content, you grant us a worldwide, non-exclusive, royalty-free license to use, reproduce, modify, and display your content as necessary to provide our services.</p>
                                
                                <h3>Content Standards</h3>
                                <p>You are responsible for all content you submit and agree that it will not:</p>
                                <ul>
                                    <li>Contain false, misleading, or deceptive information</li>
                                    <li>Infringe on any third-party intellectual property rights</li>
                                    <li>Contain offensive, abusive, or discriminatory material</li>
                                    <li>Violate any person's privacy or publicity rights</li>
                                    <li>Contain spam or commercial solicitations</li>
                                </ul>
                                
                                <h3>Content Removal</h3>
                                <p>We reserve the right to remove any content that violates these Terms or that we deem inappropriate, without prior notice.</p>
                            </div>
                        </div>

                        <!-- Third-Party Services -->
                        <div id="third-party" class="legal-section">
                            <div class="section-header">
                                <i class="fas fa-handshake"></i>
                                <h2>Third-Party Services</h2>
                            </div>
                            <div class="section-content">
                                <h3>Independent Providers</h3>
                                <p>Service providers accessible through our platform are independent third parties. We do not employ, control, or direct these providers. Any agreement you enter with a service provider is solely between you and that provider.</p>
                                
                                <h3>No Endorsement</h3>
                                <p>While we vet our partner providers, their inclusion on our platform does not constitute an endorsement, guarantee, or warranty of their services. We encourage you to conduct your own due diligence.</p>
                                
                                <h3>Third-Party Terms</h3>
                                <p>When using third-party services, you may be subject to their separate terms and conditions and privacy policies. We are not responsible for the practices of third-party providers.</p>
                            </div>
                        </div>

                        <!-- Fees and Payment -->
                        <div id="fees" class="legal-section">
                            <div class="section-header">
                                <i class="fas fa-credit-card"></i>
                                <h2>Fees and Payment</h2>
                            </div>
                            <div class="section-content">
                                <h3>Platform Fees</h3>
                                <p>Access to our basic platform and matching services is currently free for users. We are compensated by our partner service providers.</p>
                                
                                <h3>Third-Party Fees</h3>
                                <p>Service providers may charge fees for their services. These fees are determined by and paid directly to the service providers. We are not involved in these transactions unless explicitly stated.</p>
                                
                                <h3>Future Changes</h3>
                                <p>We reserve the right to introduce fees for certain premium features or services in the future. Any such changes will be communicated in advance.</p>
                            </div>
                        </div>

                        <!-- Intellectual Property -->
                        <div id="intellectual-property" class="legal-section">
                            <div class="section-header">
                                <i class="fas fa-copyright"></i>
                                <h2>Intellectual Property</h2>
                            </div>
                            <div class="section-content">
                                <h3>Our Property</h3>
                                <p>All content on our website, including text, graphics, logos, images, software, and the compilation thereof, is the property of Smooth Migration Global or its licensors and is protected by intellectual property laws.</p>
                                
                                <h3>Limited License</h3>
                                <p>We grant you a limited, non-exclusive, non-transferable license to access and use our website and services for personal, non-commercial purposes in accordance with these Terms.</p>
                                
                                <h3>Restrictions</h3>
                                <p>You may not:</p>
                                <ul>
                                    <li>Copy, modify, or distribute our content without permission</li>
                                    <li>Use our trademarks or logos without authorization</li>
                                    <li>Reverse engineer or attempt to extract source code</li>
                                    <li>Create derivative works based on our services</li>
                                    <li>Use our content for commercial purposes</li>
                                </ul>
                            </div>
                        </div>

                        <!-- Privacy -->
                        <div id="privacy" class="legal-section">
                            <div class="section-header">
                                <i class="fas fa-user-shield"></i>
                                <h2>Privacy</h2>
                            </div>
                            <div class="section-content">
                                <p>Your use of our services is also governed by our <a href="/privacy">Privacy Policy</a>, which explains how we collect, use, and protect your personal information. By using our services, you consent to our data practices as described in the Privacy Policy.</p>
                            </div>
                        </div>

                        <!-- Disclaimers -->
                        <div id="disclaimers" class="legal-section">
                            <div class="section-header">
                                <i class="fas fa-exclamation-triangle"></i>
                                <h2>Disclaimers</h2>
                            </div>
                            <div class="section-content">
                                <h3>Service Availability</h3>
                                <p>Our services are provided "as is" and "as available" without warranties of any kind, either express or implied. We do not guarantee that our services will be uninterrupted, error-free, or secure.</p>
                                
                                <h3>Information Accuracy</h3>
                                <p>While we strive to provide accurate information, we make no warranties about the completeness, reliability, or accuracy of information on our platform.</p>
                                
                                <h3>Professional Advice</h3>
                                <p>Content on our platform is for informational purposes only and should not be considered professional advice. Always consult qualified professionals for legal, financial, tax, or other professional guidance.</p>
                            </div>
                        </div>

                        <!-- Limitation of Liability -->
                        <div id="limitation" class="legal-section">
                            <div class="section-header">
                                <i class="fas fa-shield-alt"></i>
                                <h2>Limitation of Liability</h2>
                            </div>
                            <div class="section-content">
                                <p>To the maximum extent permitted by law:</p>
                                <ul>
                                    <li>We shall not be liable for any indirect, incidental, special, consequential, or punitive damages</li>
                                    <li>Our total liability shall not exceed the amount you paid us in the twelve months preceding the claim</li>
                                    <li>We are not liable for the acts or omissions of third-party service providers</li>
                                    <li>We are not responsible for any losses resulting from your reliance on information provided through our services</li>
                                </ul>
                                
                                <p>Some jurisdictions do not allow the exclusion of certain warranties or limitations of liability, so some of the above may not apply to you.</p>
                            </div>
                        </div>

                        <!-- Indemnification -->
                        <div id="indemnification" class="legal-section">
                            <div class="section-header">
                                <i class="fas fa-user-shield"></i>
                                <h2>Indemnification</h2>
                            </div>
                            <div class="section-content">
                                <p>You agree to indemnify, defend, and hold harmless Smooth Migration Global, its officers, directors, employees, agents, and affiliates from any claims, damages, losses, liabilities, costs, and expenses (including reasonable attorneys' fees) arising from:</p>
                                <ul>
                                    <li>Your use or misuse of our services</li>
                                    <li>Your violation of these Terms</li>
                                    <li>Your violation of any third-party rights</li>
                                    <li>Your content or information you provide</li>
                                    <li>Your interactions with service providers</li>
                                </ul>
                            </div>
                        </div>

                        <!-- Termination -->
                        <div id="termination" class="legal-section">
                            <div class="section-header">
                                <i class="fas fa-times-circle"></i>
                                <h2>Termination</h2>
                            </div>
                            <div class="section-content">
                                <h3>By You</h3>
                                <p>You may stop using our services at any time. If you have an account, you may request its deletion by contacting us.</p>
                                
                                <h3>By Us</h3>
                                <p>We reserve the right to suspend or terminate your access to our services at any time, with or without notice, for any reason, including violation of these Terms.</p>
                                
                                <h3>Effect of Termination</h3>
                                <p>Upon termination:</p>
                                <ul>
                                    <li>Your right to use our services will immediately cease</li>
                                    <li>We may delete your account and associated data</li>
                                    <li>Provisions that by their nature should survive will remain in effect</li>
                                </ul>
                            </div>
                        </div>

                        <!-- Governing Law -->
                        <div id="governing-law" class="legal-section">
                            <div class="section-header">
                                <i class="fas fa-gavel"></i>
                                <h2>Governing Law</h2>
                            </div>
                            <div class="section-content">
                                <p>These Terms shall be governed by and construed in accordance with the laws of Canada and the Province of British Columbia, without regard to conflict of law principles.</p>
                                
                                <h3>Dispute Resolution</h3>
                                <p>Any disputes arising from these Terms or your use of our services shall be resolved through binding arbitration in accordance with the rules of the British Columbia International Commercial Arbitration Centre, except where prohibited by law.</p>
                                
                                <h3>Class Action Waiver</h3>
                                <p>You agree that any disputes will be resolved individually and you waive your right to participate in a class action lawsuit or class-wide arbitration.</p>
                            </div>
                        </div>

                        <!-- Changes to Terms -->
                        <div id="changes" class="legal-section">
                            <div class="section-header">
                                <i class="fas fa-sync-alt"></i>
                                <h2>Changes to Terms</h2>
                            </div>
                            <div class="section-content">
                                <p>We reserve the right to modify these Terms at any time. When we make changes:</p>
                                <ul>
                                    <li>We will update the "Last Updated" date at the top of this page</li>
                                    <li>For material changes, we will provide notice through our website or via email</li>
                                    <li>Your continued use after changes constitutes acceptance of the modified Terms</li>
                                </ul>
                                <p>We encourage you to review these Terms periodically to stay informed of any updates.</p>
                            </div>
                        </div>

                        <!-- Contact Information -->
                        <div id="contact" class="legal-section contact-section">
                            <div class="section-header">
                                <i class="fas fa-envelope"></i>
                                <h2>Contact Information</h2>
                            </div>
                            <div class="section-content">
                                <p>If you have any questions or concerns about these Terms of Service, please contact us:</p>
                                
                                <div class="contact-info">
                                    <div class="contact-method">
                                        <i class="fas fa-envelope"></i>
                                        <div>
                                            <strong>Legal Team</strong>
                                            <p><a href="mailto:contact@smoothmigration.net">contact@smoothmigration.net</a></p>
                                        </div>
                                    </div>
                                    <div class="contact-method">
                                        <i class="fas fa-map-marker-alt"></i>
                                        <div>
                                            <strong>Head Office</strong>
                                            <p>1011-5307 Victoria Drive<br>Vancouver, BC V5P 3V6<br>Canada</p>
                                        </div>
                                    </div>
                                    <div class="contact-method">
                                        <i class="fas fa-phone"></i>
                                        <div>
                                            <strong>Phone</strong>
                                            <p>+1 604 283 7626</p>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="legal-footer">
                                    <p><strong>Governing Law:</strong> These Terms are governed by the laws of Canada and the Province of British Columbia.</p>
                                    <p><strong>Dispute Resolution:</strong> Any disputes will be resolved through arbitration in British Columbia, Canada.</p>
                                </div>
                            </div>
                        </div>

                        <!-- Additional Provisions -->
                        <div class="legal-section">
                            <div class="section-header">
                                <i class="fas fa-plus-circle"></i>
                    <h2>Additional Provisions</h2>
                            </div>
                            <div class="section-content">
                    <h3>Severability</h3>
                    <p>If any provision of these Terms is found to be unenforceable or invalid, that provision will be limited or eliminated to the minimum extent necessary, and the remaining provisions will remain in full effect.</p>
                    
                    <h3>Entire Agreement</h3>
                    <p>These Terms, together with our Privacy Policy and Cookie Policy, constitute the entire agreement between you and Smooth Migration Global regarding the use of our services.</p>
                    
                    <h3>No Waiver</h3>
                    <p>Our failure to enforce any right or provision of these Terms will not be considered a waiver of those rights.</p>
                    
                    <h3>Assignment</h3>
                    <p>You may not assign or transfer these Terms or your rights under them without our prior written consent. We may assign our rights and obligations without restriction.</p>
                            </div>
                </div>

            </div>
        </div>
    </div>
</div>
    </section>

    <!-- Need Help CTA -->
    <section class="legal-cta py-6 bg-light">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-8">
                    <div class="cta-content">
                        <h2 class="display-5 fw-bold mb-3">Questions About Our Terms?</h2>
                        <p class="lead mb-4">Our team is here to provide clarification and address any concerns you may have about our terms of service.</p>
                        <div class="cta-features d-flex flex-wrap gap-4">
                            <div class="feature-item d-flex align-items-center">
                                <i class="fas fa-file-contract text-primary me-2"></i>
                                <span>Clear Terms</span>
                            </div>
                            <div class="feature-item d-flex align-items-center">
                                <i class="fas fa-shield-alt text-primary me-2"></i>
                                <span>Fair Practices</span>
                            </div>
                            <div class="feature-item d-flex align-items-center">
                                <i class="fas fa-handshake text-primary me-2"></i>
                                <span>Transparent Service</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 text-center">
                    <div class="cta-actions">
                        <a href="/contact" class="btn btn-primary btn-lg mb-3 w-100">
                            <i class="fas fa-comments me-2"></i>
                            Contact Legal Team
                        </a>
                        <a href="/privacy" class="btn btn-outline-primary w-100">
                            <i class="fas fa-shield-alt me-2"></i>
                            Privacy Policy
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

</main><!-- .site-main -->

<style>
/* Legal Page Specific Styles */
.legal-hero {
    min-height: 70vh;
}

.hero-pattern {
    background: 
        radial-gradient(circle at 25% 25%, rgba(255, 255, 255, 0.1) 0%, transparent 50%),
        radial-gradient(circle at 75% 75%, rgba(255, 255, 255, 0.05) 0%, transparent 50%),
        url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23ffffff' fill-opacity='0.1'%3E%3Ccircle cx='30' cy='30' r='2'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
    animation: float 20s ease-in-out infinite;
}

.badge-legal {
    background: rgba(255, 255, 255, 0.15);
    color: white;
    padding: 0.5rem 1rem;
    border-radius: var(--border-radius-2xl);
    font-size: 0.9rem;
    font-weight: 600;
    backdrop-filter: blur(10px);
    -webkit-backdrop-filter: blur(10px);
    border: 1px solid rgba(255, 255, 255, 0.2);
}

.legal-update-notice {
    background: rgba(255, 255, 255, 0.1);
    padding: 0.75rem 1.5rem;
    border-radius: var(--border-radius-lg);
    font-size: 0.9rem;
    font-weight: 500;
    display: inline-flex;
    align-items: center;
    backdrop-filter: blur(10px);
    -webkit-backdrop-filter: blur(10px);
    border: 1px solid rgba(255, 255, 255, 0.2);
}

.legal-navigation {
    background: var(--bg-white);
    padding: 2rem;
    border-radius: var(--border-radius-2xl);
    box-shadow: var(--shadow-sm);
    border: 1px solid var(--border-light);
}

.nav-title {
    color: var(--text-dark);
    font-weight: 700;
    margin-bottom: 1rem;
    font-size: 1.2rem;
}

.nav-links {
    display: flex;
    flex-wrap: wrap;
    gap: 1rem;
}

.nav-links .nav-link {
    background: var(--bg-section);
    color: var(--text-medium);
    padding: 0.5rem 1rem;
    border-radius: var(--border-radius-lg);
    text-decoration: none;
    font-weight: 600;
    font-size: 0.9rem;
    transition: all 0.3s ease;
    border: 1px solid var(--border-light);
}

.nav-links .nav-link:hover {
    background: var(--primary-color);
    color: white;
    transform: translateY(-2px);
    box-shadow: var(--shadow-md);
    text-decoration: none;
}

.legal-document {
    background: var(--bg-white);
    border-radius: var(--border-radius-2xl);
    box-shadow: var(--shadow-lg);
    overflow: hidden;
    border: 1px solid var(--border-light);
}

.legal-section {
    padding: 3rem;
    border-bottom: 1px solid var(--border-light);
}

.legal-section:last-child {
    border-bottom: none;
}

.legal-section.intro-section {
    background: var(--bg-section);
}

.legal-section.contact-section {
    background: var(--bg-light);
}

.section-header {
    display: flex;
    align-items: center;
    gap: 1rem;
    margin-bottom: 2rem;
    padding-bottom: 1rem;
    border-bottom: 2px solid var(--border-light);
}

.section-header i {
    color: var(--primary-color);
    font-size: 2rem;
}

.section-header h2 {
    color: var(--text-dark);
    font-weight: 800;
    margin: 0;
    font-size: 2rem;
}

.section-content {
    color: var(--text-medium);
    line-height: 1.8;
    font-size: 1.05rem;
}

.section-content h3 {
    color: var(--text-dark);
    font-weight: 700;
    margin: 2rem 0 1rem;
    font-size: 1.4rem;
    position: relative;
    padding-left: 1rem;
}

.section-content h3::before {
    content: '';
    position: absolute;
    left: 0;
    top: 0.3rem;
    width: 4px;
    height: 1.2rem;
    background: var(--gradient-accent);
    border-radius: 2px;
}

.section-content h4 {
    color: var(--primary-color);
    font-weight: 700;
    margin: 1.5rem 0 0.75rem;
    font-size: 1.2rem;
}

.section-content p {
    margin-bottom: 1rem;
}

.section-content ul {
    margin: 1rem 0;
    padding-left: 2rem;
}

.section-content li {
    margin-bottom: 0.5rem;
    position: relative;
}

.section-content li::before {
    content: '•';
    color: var(--primary-color);
    font-weight: bold;
    position: absolute;
    left: -1rem;
}

.important-notice {
    background: var(--accent-lighter);
    border: 2px solid var(--accent-color);
    border-radius: var(--border-radius-xl);
    padding: 2rem;
    margin: 2rem 0;
}

.notice-header {
    display: flex;
    align-items: center;
    gap: 0.75rem;
    margin-bottom: 1rem;
}

.notice-header i {
    color: var(--accent-color);
    font-size: 1.5rem;
}

.notice-header strong {
    color: var(--text-dark);
    font-size: 1.2rem;
}

.contact-info {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
    gap: 1.5rem;
    margin: 2rem 0;
}

.contact-method {
    display: flex;
    align-items: flex-start;
    gap: 1rem;
    background: var(--bg-white);
    padding: 2rem;
    border-radius: var(--border-radius-xl);
    border: 1px solid var(--border-light);
    box-shadow: var(--shadow-sm);
}

.contact-method i {
    color: var(--primary-color);
    font-size: 1.5rem;
    margin-top: 0.25rem;
}

.contact-method strong {
    color: var(--text-dark);
    display: block;
    margin-bottom: 0.5rem;
    font-size: 1.1rem;
}

.contact-method p {
    color: var(--text-light);
    margin: 0;
    line-height: 1.6;
}

.legal-cta {
    background: var(--bg-light);
}

.cta-features .feature-item {
    color: var(--text-medium);
    font-weight: 500;
}

.cta-features i {
    font-size: 1.2rem;
}

/* Responsive Design */
@media (max-width: 768px) {
    .legal-hero {
        min-height: 60vh;
    }
    
    .legal-navigation {
        padding: 1.5rem;
    }
    
    .nav-links {
        justify-content: center;
    }
    
    .nav-links .nav-link {
        font-size: 0.8rem;
        padding: 0.4rem 0.8rem;
    }
    
    .legal-section {
        padding: 2rem 1.5rem;
    }
    
    .section-header {
        flex-direction: column;
        text-align: center;
        gap: 0.5rem;
    }
    
    .section-header h2 {
        font-size: 1.5rem;
    }
    
    .contact-info {
        grid-template-columns: 1fr;
    }
    
    .important-notice {
        padding: 1.5rem;
    }
    
    .cta-features {
        justify-content: center;
        gap: 1rem !important;
    }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Smooth scrolling for navigation links
    const navLinks = document.querySelectorAll('.nav-links .nav-link');
    
    navLinks.forEach(link => {
        link.addEventListener('click', function(e) {
            e.preventDefault();
            const targetId = this.getAttribute('href');
            const targetElement = document.querySelector(targetId);
            
            if (targetElement) {
                targetElement.scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });
                
                // Add active state
                navLinks.forEach(l => l.classList.remove('active'));
                this.classList.add('active');
            }
        });
    });
    
    // Highlight active section on scroll
    const sections = document.querySelectorAll('.legal-section[id]');
    const navLinksArray = Array.from(navLinks);
    
    const observerOptions = {
        threshold: 0.3,
        rootMargin: '-100px 0px -50% 0px'
    };
    
    const sectionObserver = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                const targetId = entry.target.id;
                const correspondingLink = navLinksArray.find(link => 
                    link.getAttribute('href') === `#${targetId}`
                );
                
                if (correspondingLink) {
                    navLinksArray.forEach(link => link.classList.remove('active'));
                    correspondingLink.classList.add('active');
                }
            }
        });
    }, observerOptions);
    
    sections.forEach(section => {
        sectionObserver.observe(section);
    });
    
    // Add scroll animations
    const scrollObserver = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('animate-in');
            }
        });
    }, {
        threshold: 0.1,
        rootMargin: '0px 0px -50px 0px'
    });
    
    // Observe elements for scroll animation
    const elementsToAnimate = document.querySelectorAll('.hero-content, .legal-navigation, .legal-section, .legal-cta');
    elementsToAnimate.forEach(element => {
        element.classList.add('animate-on-scroll');
        scrollObserver.observe(element);
    });
});
</script>

<?php
get_footer(); ?>

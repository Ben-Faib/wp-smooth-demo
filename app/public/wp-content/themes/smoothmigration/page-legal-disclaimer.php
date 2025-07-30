<?php
/**
 * Legal Disclaimer Page Template
 * Professional legal page with clear typography and modern design
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
                            <span class="badge-legal">⚖️ Legal Information</span>
                        </div>
                        <h1 class="display-2 fw-bold mb-4">Legal Disclaimer</h1>
                        <p class="lead fs-4 mb-4 opacity-90">Important legal information and disclaimers regarding our services and platform.</p>
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
                            <a href="#general-disclaimer" class="nav-link">General Disclaimer</a>
                            <a href="#service-limitations" class="nav-link">Service Limitations</a>
                            <a href="#third-party" class="nav-link">Third-Party Services</a>
                            <a href="#liability" class="nav-link">Liability Limitations</a>
                            <a href="#professional-advice" class="nav-link">Professional Advice</a>
                            <a href="#contact-legal" class="nav-link">Legal Contact</a>
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
                                <i class="fas fa-info-circle"></i>
                                <h2>Introduction</h2>
                            </div>
                            <div class="section-content">
                                <p class="lead">This legal disclaimer governs your use of Smooth Migration Global's website and services. By accessing our platform or using our services, you acknowledge that you have read, understood, and agree to be bound by these terms.</p>
                                
                                <div class="important-notice">
                                    <div class="notice-header">
                                        <i class="fas fa-exclamation-triangle"></i>
                                        <strong>Important Notice</strong>
                                    </div>
                                    <p>The information and services provided by Smooth Migration Global are intended to assist with international relocation planning. This disclaimer outlines the scope and limitations of our services to ensure transparency and protect all parties involved.</p>
                                </div>
                            </div>
                        </div>

                        <!-- General Disclaimer -->
                        <div id="general-disclaimer" class="legal-section">
                            <div class="section-header">
                                <i class="fas fa-gavel"></i>
                                <h2>General Disclaimer</h2>
                            </div>
                            <div class="section-content">
                                <h3>Service Nature</h3>
                                <p>Smooth Migration Global operates as a platform that connects clients with vetted service providers for international relocation services. We are <strong>not</strong> direct providers of most services but rather facilitators and coordinators.</p>
                                
                                <h3>Information Accuracy</h3>
                                <p>While we strive to provide accurate and up-to-date information:</p>
                                <ul>
                                    <li>Immigration laws, visa requirements, and regulations change frequently</li>
                                    <li>Country-specific requirements may vary by individual circumstances</li>
                                    <li>We recommend verifying all information with official government sources</li>
                                    <li>Our content is for informational purposes and not legal advice</li>
                                </ul>
                                
                                <h3>No Guarantees</h3>
                                <p>We cannot guarantee:</p>
                                <ul>
                                    <li>Visa approval or immigration success</li>
                                    <li>Specific timelines for service completion</li>
                                    <li>Availability of housing, jobs, or other opportunities</li>
                                    <li>Specific outcomes from any relocation service</li>
                                </ul>
                            </div>
                        </div>

                        <!-- Service Limitations -->
                        <div id="service-limitations" class="legal-section">
                            <div class="section-header">
                                <i class="fas fa-exclamation-circle"></i>
                                <h2>Service Limitations</h2>
                            </div>
                            <div class="section-content">
                                <h3>Scope of Services</h3>
                                <p>Our services are limited to:</p>
                                <ul>
                                    <li>Coordination and facilitation of relocation services</li>
                                    <li>Connection with vetted service providers</li>
                                    <li>General guidance and support throughout the process</li>
                                    <li>Information sharing and resource provision</li>
                                </ul>
                                
                                <h3>What We Do Not Provide</h3>
                                <div class="limitation-grid">
                                    <div class="limitation-item">
                                        <h4>Legal Services</h4>
                                        <p>We do not provide legal advice, representation, or immigration law services. We connect you with qualified professionals.</p>
                                    </div>
                                    <div class="limitation-item">
                                        <h4>Financial Advice</h4>
                                        <p>We do not provide investment, tax, or financial planning advice. Our partners offer these specialized services.</p>
                                    </div>
                                    <div class="limitation-item">
                                        <h4>Medical Services</h4>
                                        <p>We do not provide medical advice or healthcare services. We can connect you with healthcare providers.</p>
                                    </div>
                                    <div class="limitation-item">
                                        <h4>Employment Services</h4>
                                        <p>We do not guarantee job placement or employment opportunities. We may connect you with recruitment services.</p>
                                    </div>
                                </div>
                                
                                <h3>Service Availability</h3>
                                <p>Service availability may be limited by:</p>
                                <ul>
                                    <li>Geographic location and destination country</li>
                                    <li>Local regulations and restrictions</li>
                                    <li>Partner availability and capacity</li>
                                    <li>Seasonal or temporary limitations</li>
                                </ul>
                            </div>
                        </div>

                        <!-- Third-Party Services -->
                        <div id="third-party" class="legal-section">
                            <div class="section-header">
                                <i class="fas fa-handshake"></i>
                                <h2>Third-Party Service Providers</h2>
                            </div>
                            <div class="section-content">
                                <h3>Partner Network</h3>
                                <p>We work with a network of independent service providers who are:</p>
                                <ul>
                                    <li>Vetted through our quality assurance process</li>
                                    <li>Licensed and qualified in their respective fields</li>
                                    <li>Independent contractors, not employees of Smooth Migration Global</li>
                                    <li>Responsible for their own service delivery and quality</li>
                                </ul>
                                
                                <div class="partner-disclaimer">
                                    <h4>Partner Responsibility</h4>
                                    <p>Each service provider is responsible for:</p>
                                    <ul>
                                        <li>Quality and accuracy of their services</li>
                                        <li>Professional licensing and compliance</li>
                                        <li>Direct communication with clients</li>
                                        <li>Meeting agreed-upon timelines and deliverables</li>
                                        <li>Resolving service-related issues</li>
                                    </ul>
                                </div>
                                
                                <h3>Quality Assurance</h3>
                                <p>While we vet our partners, we cannot be held responsible for:</p>
                                <ul>
                                    <li>Individual service provider performance issues</li>
                                    <li>Disputes between clients and service providers</li>
                                    <li>Changes in partner licensing or qualifications</li>
                                    <li>Service provider availability or capacity changes</li>
                                </ul>
                            </div>
                        </div>

                        <!-- Liability Limitations -->
                        <div id="liability" class="legal-section">
                            <div class="section-header">
                                <i class="fas fa-shield-alt"></i>
                                <h2>Limitation of Liability</h2>
                            </div>
                            <div class="section-content">
                                <div class="liability-notice">
                                    <h3>Maximum Liability</h3>
                                    <p><strong>In no event shall Smooth Migration Global's total liability exceed the amount paid by the client for our coordination services.</strong></p>
                                </div>
                                
                                <h3>Excluded Damages</h3>
                                <p>We shall not be liable for:</p>
                                <ul>
                                    <li>Indirect, incidental, or consequential damages</li>
                                    <li>Lost profits, opportunities, or business</li>
                                    <li>Emotional distress or mental anguish</li>
                                    <li>Delays caused by third parties or government agencies</li>
                                    <li>Changes in immigration laws or policies</li>
                                    <li>Force majeure events (natural disasters, pandemics, etc.)</li>
                                </ul>
                                
                                <h3>Client Responsibilities</h3>
                                <p>Clients are responsible for:</p>
                                <ul>
                                    <li>Providing accurate and complete information</li>
                                    <li>Verifying all information and advice received</li>
                                    <li>Making final decisions about their relocation</li>
                                    <li>Complying with all applicable laws and regulations</li>
                                    <li>Maintaining appropriate insurance coverage</li>
                                </ul>
                            </div>
                        </div>

                        <!-- Professional Advice -->
                        <div id="professional-advice" class="legal-section">
                            <div class="section-header">
                                <i class="fas fa-user-tie"></i>
                                <h2>Professional Advice Disclaimer</h2>
                            </div>
                            <div class="section-content">
                                <div class="advice-warning">
                                    <h3>Not Professional Advice</h3>
                                    <p>Unless specifically stated otherwise, information provided by Smooth Migration Global is <strong>not</strong> professional advice and should not be relied upon as such.</p>
                                </div>
                                
                                <h3>Seek Qualified Professionals</h3>
                                <p>We strongly recommend consulting with qualified professionals for:</p>
                                
                                <div class="advice-categories">
                                    <div class="advice-category">
                                        <i class="fas fa-balance-scale"></i>
                                        <h4>Legal Matters</h4>
                                        <p>Immigration lawyers, legal counsel, contract attorneys</p>
                                    </div>
                                    <div class="advice-category">
                                        <i class="fas fa-calculator"></i>
                                        <h4>Financial Planning</h4>
                                        <p>Tax advisors, financial planners, accountants</p>
                                    </div>
                                    <div class="advice-category">
                                        <i class="fas fa-heartbeat"></i>
                                        <h4>Medical Concerns</h4>
                                        <p>Healthcare providers, medical professionals</p>
                                    </div>
                                    <div class="advice-category">
                                        <i class="fas fa-graduation-cap"></i>
                                        <h4>Education</h4>
                                        <p>Educational consultants, school administrators</p>
                                    </div>
                                </div>
                                
                                <h3>Information Sources</h3>
                                <p>Always verify information with official sources:</p>
                                <ul>
                                    <li>Government immigration websites</li>
                                    <li>Embassy and consulate resources</li>
                                    <li>Professional licensing boards</li>
                                    <li>Official regulatory agencies</li>
                                </ul>
                            </div>
                        </div>

                        <!-- Updates and Changes -->
                        <div class="legal-section">
                            <div class="section-header">
                                <i class="fas fa-sync-alt"></i>
                                <h2>Updates and Changes</h2>
                            </div>
                            <div class="section-content">
                                <h3>Disclaimer Updates</h3>
                                <p>This disclaimer may be updated periodically to reflect:</p>
                                <ul>
                                    <li>Changes in our services or business model</li>
                                    <li>Legal or regulatory requirements</li>
                                    <li>Industry best practices</li>
                                    <li>Customer feedback and clarifications</li>
                                </ul>
                                
                                <h3>Notification Process</h3>
                                <p>When material changes are made:</p>
                                <ul>
                                    <li>Updated disclaimer will be posted on our website</li>
                                    <li>Registered users will be notified via email</li>
                                    <li>Changes become effective 30 days after posting</li>
                                    <li>Continued use constitutes acceptance of changes</li>
                                </ul>
                            </div>
                        </div>

                        <!-- Contact Information -->
                        <div id="contact-legal" class="legal-section contact-section">
                            <div class="section-header">
                                <i class="fas fa-envelope"></i>
                                <h2>Legal Contact Information</h2>
                            </div>
                            <div class="section-content">
                                <p>For legal inquiries, questions about this disclaimer, or to report concerns:</p>
                                
                                <div class="contact-info">
                                    <div class="contact-method">
                                        <i class="fas fa-envelope"></i>
                                        <div>
                                            <strong>Legal Department</strong>
                                            <p>legal@smoothmigration.global</p>
                                        </div>
                                    </div>
                                    <div class="contact-method">
                                        <i class="fas fa-map-marker-alt"></i>
                                        <div>
                                            <strong>Mailing Address</strong>
                                            <p>Smooth Migration Global<br>Legal Department<br>123 Business District<br>Singapore 018956</p>
                                        </div>
                                    </div>
                                    <div class="contact-method">
                                        <i class="fas fa-clock"></i>
                                        <div>
                                            <strong>Response Time</strong>
                                            <p>We aim to respond to legal inquiries within 5-7 business days</p>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="legal-footer">
                                    <p><strong>Governing Law:</strong> This disclaimer is governed by the laws of Singapore.</p>
                                    <p><strong>Dispute Resolution:</strong> Any disputes will be resolved through arbitration in Singapore.</p>
                                </div>
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
                        <h2 class="display-5 fw-bold mb-3">Questions About Our Legal Terms?</h2>
                        <p class="lead mb-4">Our team is here to provide clarification and address any concerns you may have about our services or legal policies.</p>
                        <div class="cta-features d-flex flex-wrap gap-4">
                            <div class="feature-item d-flex align-items-center">
                                <i class="fas fa-user-tie text-primary me-2"></i>
                                <span>Legal Clarity</span>
                            </div>
                            <div class="feature-item d-flex align-items-center">
                                <i class="fas fa-shield-alt text-primary me-2"></i>
                                <span>Transparent Terms</span>
                            </div>
                            <div class="feature-item d-flex align-items-center">
                                <i class="fas fa-handshake text-primary me-2"></i>
                                <span>Fair Practices</span>
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
                        <a href="/terms" class="btn btn-outline-primary w-100">
                            <i class="fas fa-file-contract me-2"></i>
                            Terms of Service
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

.limitation-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
    gap: 1.5rem;
    margin: 2rem 0;
}

.limitation-item {
    background: var(--bg-section);
    padding: 2rem;
    border-radius: var(--border-radius-xl);
    border: 1px solid var(--border-light);
    box-shadow: var(--shadow-sm);
}

.limitation-item h4 {
    color: var(--text-dark);
    font-weight: 700;
    margin-bottom: 1rem;
    font-size: 1.1rem;
}

.limitation-item p {
    color: var(--text-light);
    margin: 0;
    line-height: 1.6;
}

.partner-disclaimer {
    background: var(--secondary-lighter);
    border: 2px solid var(--secondary-color);
    border-radius: var(--border-radius-xl);
    padding: 2rem;
    margin: 2rem 0;
}

.partner-disclaimer h4 {
    color: var(--secondary-color);
    font-weight: 700;
    margin-bottom: 1rem;
}

.liability-notice {
    background: var(--primary-lighter);
    border: 3px solid var(--primary-color);
    border-radius: var(--border-radius-xl);
    padding: 2rem;
    margin: 2rem 0;
    text-align: center;
}

.liability-notice h3 {
    color: var(--primary-color);
    font-weight: 800;
    margin-bottom: 1rem;
    font-size: 1.3rem;
}

.liability-notice h3::before {
    display: none;
}

.liability-notice p {
    color: var(--text-dark);
    font-size: 1.1rem;
    font-weight: 600;
    margin: 0;
}

.advice-warning {
    background: var(--bg-light);
    border: 2px solid var(--border-medium);
    border-radius: var(--border-radius-xl);
    padding: 2rem;
    margin: 2rem 0;
    text-align: center;
}

.advice-warning h3 {
    color: var(--text-dark);
    font-weight: 800;
    margin-bottom: 1rem;
}

.advice-warning h3::before {
    display: none;
}

.advice-categories {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 1.5rem;
    margin: 2rem 0;
}

.advice-category {
    background: var(--bg-white);
    padding: 2rem;
    border-radius: var(--border-radius-xl);
    border: 1px solid var(--border-light);
    box-shadow: var(--shadow-sm);
    text-align: center;
}

.advice-category i {
    color: var(--primary-color);
    font-size: 2.5rem;
    margin-bottom: 1rem;
}

.advice-category h4 {
    color: var(--text-dark);
    font-weight: 700;
    margin-bottom: 0.75rem;
    font-size: 1.1rem;
}

.advice-category p {
    color: var(--text-light);
    margin: 0;
    font-size: 0.95rem;
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

.legal-footer {
    background: var(--bg-section);
    padding: 2rem;
    border-radius: var(--border-radius-xl);
    margin-top: 2rem;
    border: 1px solid var(--border-light);
}

.legal-footer p {
    margin-bottom: 0.5rem;
    font-weight: 600;
    color: var(--text-dark);
}

.legal-footer p:last-child {
    margin-bottom: 0;
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
    
    .limitation-grid,
    .advice-categories {
        grid-template-columns: 1fr;
    }
    
    .contact-info {
        grid-template-columns: 1fr;
    }
    
    .important-notice,
    .partner-disclaimer,
    .liability-notice,
    .advice-warning,
    .legal-footer {
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
get_footer(); 
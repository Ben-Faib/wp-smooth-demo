<?php
/**
 * Privacy Policy Page Template
 * Professional privacy page with clear typography and modern design
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
                            <span class="badge-legal">🔒 Privacy Information</span>
                        </div>
                        <h1 class="display-2 fw-bold mb-4">Privacy Policy</h1>
                        <p class="lead fs-4 mb-4 opacity-90">Your privacy is important to us. This policy explains how we collect, use, and protect your information.</p>
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
                            <a href="#introduction" class="nav-link">Introduction</a>
                            <a href="#information-collection" class="nav-link">Information Collection</a>
                            <a href="#information-use" class="nav-link">How We Use Information</a>
                            <a href="#information-sharing" class="nav-link">Information Sharing</a>
                            <a href="#data-security" class="nav-link">Data Security</a>
                            <a href="#user-rights" class="nav-link">Your Rights</a>
                            <a href="#contact" class="nav-link">Contact Us</a>
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
                                <i class="fas fa-shield-alt"></i>
                                <h2>Introduction</h2>
                            </div>
                            <div class="section-content">
                                <p class="lead">Welcome to Smooth Migration Global ("we," "our," or "us"). We are committed to protecting your personal information and your right to privacy. This Privacy Policy explains how we collect, use, disclose, and safeguard your information when you visit our website or use our services.</p>
                                
                                <div class="important-notice">
                                    <div class="notice-header">
                                        <i class="fas fa-info-circle"></i>
                                        <strong>Your Privacy Matters</strong>
                                    </div>
                                    <p>By using our website and services, you agree to the collection and use of information in accordance with this policy. If you do not agree with the terms of this privacy policy, please do not access the site or use our services.</p>
                                </div>
                            </div>
                        </div>

                        <!-- Information Collection -->
                        <div id="information-collection" class="legal-section">
                            <div class="section-header">
                                <i class="fas fa-database"></i>
                                <h2>Information We Collect</h2>
                            </div>
                            <div class="section-content">
                                <h3>Personal Information You Provide</h3>
                                <p>We collect personal information that you voluntarily provide when you:</p>
                                <ul>
                                    <li>Fill out forms on our website (contact forms, partner applications, service requests)</li>
                                    <li>Create an account or profile</li>
                                    <li>Subscribe to our newsletter or communications</li>
                                    <li>Contact us via email, phone, or chat</li>
                                    <li>Use our relocation planning tools</li>
                                </ul>
                                
                                <p>This information may include:</p>
                                <ul>
                                    <li>Name and contact information (email, phone number, address)</li>
                                    <li>Demographic information (nationality, language preferences)</li>
                                    <li>Relocation details (origin/destination countries, timeline, budget)</li>
                                    <li>Property preferences and requirements</li>
                                    <li>Professional information (occupation, employer)</li>
                                    <li>Payment and billing information (when applicable)</li>
                                </ul>

                                <h3>Information Automatically Collected</h3>
                                <p>When you visit our website, we automatically collect certain information about your device and usage, including:</p>
                                <ul>
                                    <li>IP address and geolocation data</li>
                                    <li>Browser type and version</li>
                                    <li>Operating system</li>
                                    <li>Pages visited and time spent on pages</li>
                                    <li>Referring website addresses</li>
                                    <li>Device identifiers</li>
                                </ul>
                            </div>
                        </div>

                        <!-- Information Use -->
                        <div id="information-use" class="legal-section">
                            <div class="section-header">
                                <i class="fas fa-cogs"></i>
                                <h2>How We Use Your Information</h2>
                            </div>
                            <div class="section-content">
                                <p>We use the information we collect for various purposes, including:</p>
                                <ul>
                                    <li><strong>Service Delivery:</strong> To provide, operate, and maintain our relocation services</li>
                                    <li><strong>Personalization:</strong> To personalize your experience and deliver tailored content and recommendations</li>
                                    <li><strong>Communication:</strong> To respond to your inquiries and send service-related updates</li>
                                    <li><strong>Marketing:</strong> To send promotional communications (with your consent)</li>
                                    <li><strong>Partner Matching:</strong> To connect you with appropriate service providers</li>
                                    <li><strong>Improvement:</strong> To understand how our services are used and make improvements</li>
                                    <li><strong>Legal Compliance:</strong> To comply with legal obligations and protect our rights</li>
                                    <li><strong>Security:</strong> To detect, prevent, and address technical issues and fraud</li>
                                </ul>
                            </div>
                        </div>

                        <!-- Information Sharing -->
                        <div id="information-sharing" class="legal-section">
                            <div class="section-header">
                                <i class="fas fa-share-alt"></i>
                                <h2>Information Sharing and Disclosure</h2>
                            </div>
                            <div class="section-content">
                                <p>We may share your information in the following situations:</p>
                                
                                <h3>With Service Providers</h3>
                                <p>We share your information with vetted third-party service providers who assist us in providing relocation services, including:</p>
                                <ul>
                                    <li>Real estate agencies and realtors</li>
                                    <li>Moving and storage companies</li>
                                    <li>Financial service providers</li>
                                    <li>Immigration and legal service providers</li>
                                    <li>Insurance companies</li>
                                    <li>Travel and accommodation providers</li>
                                </ul>

                                <h3>With Your Consent</h3>
                                <p>We will share your personal information with third parties when we have your explicit consent to do so.</p>

                                <h3>For Legal Reasons</h3>
                                <p>We may disclose your information if required by law or in response to valid legal requests by public authorities.</p>

                                <h3>Business Transfers</h3>
                                <p>In the event of a merger, acquisition, or sale of assets, your information may be transferred to the acquiring entity.</p>
                            </div>
                        </div>

                        <!-- Data Security -->
                        <div id="data-security" class="legal-section">
                            <div class="section-header">
                                <i class="fas fa-shield-alt"></i>
                                <h2>Data Security</h2>
                            </div>
                            <div class="section-content">
                                <p>We implement appropriate technical and organizational security measures to protect your personal information against unauthorized access, alteration, disclosure, or destruction. These measures include:</p>
                                <ul>
                                    <li>Encryption of data in transit and at rest</li>
                                    <li>Regular security assessments and audits</li>
                                    <li>Access controls and authentication procedures</li>
                                    <li>Employee training on data protection</li>
                                    <li>Secure data centers and infrastructure</li>
                                </ul>
                                <p>However, no method of transmission over the Internet or electronic storage is 100% secure, and we cannot guarantee absolute security.</p>
                            </div>
                        </div>

                        <!-- Cookies and Tracking -->
                        <div id="cookies" class="legal-section">
                            <div class="section-header">
                                <i class="fas fa-cookie-bite"></i>
                                <h2>Cookies and Tracking Technologies</h2>
                            </div>
                            <div class="section-content">
                                <p>We use cookies and similar tracking technologies to collect and store information about your interactions with our website. For detailed information about our use of cookies, please refer to our <a href="/cookies">Cookie Policy</a>.</p>
                                
                                <p>You can control cookie preferences through your browser settings and our cookie consent tool. Note that disabling certain cookies may limit your ability to use some features of our website.</p>
                            </div>
                        </div>

                        <!-- User Rights -->
                        <div id="user-rights" class="legal-section">
                            <div class="section-header">
                                <i class="fas fa-user-shield"></i>
                                <h2>Your Rights and Choices</h2>
                            </div>
                            <div class="section-content">
                                <p>Depending on your location, you may have certain rights regarding your personal information:</p>
                                
                                <h3>Access and Portability</h3>
                                <p>You have the right to request access to the personal information we hold about you and receive it in a portable format.</p>
                                
                                <h3>Correction and Update</h3>
                                <p>You can request that we correct or update inaccurate or incomplete personal information.</p>
                                
                                <h3>Deletion</h3>
                                <p>You may request the deletion of your personal information, subject to certain legal exceptions.</p>
                                
                                <h3>Opt-Out</h3>
                                <p>You can opt-out of marketing communications at any time by clicking the unsubscribe link in our emails or contacting us directly.</p>
                                
                                <h3>Do Not Track</h3>
                                <p>We do not currently respond to Do Not Track browser signals.</p>
                                
                                <p>To exercise any of these rights, please contact us using the information provided below.</p>
                            </div>
                        </div>

                        <!-- International Transfers -->
                        <div id="international" class="legal-section">
                            <div class="section-header">
                                <i class="fas fa-globe"></i>
                                <h2>International Data Transfers</h2>
                            </div>
                            <div class="section-content">
                                <p>As a global relocation service, we may transfer your information to countries other than the one in which you reside. These countries may have different data protection laws than your country.</p>
                                <p>When we transfer personal information internationally, we implement appropriate safeguards to protect your information, including:</p>
                                <ul>
                                    <li>Standard contractual clauses approved by relevant authorities</li>
                                    <li>Ensuring recipients are in countries with adequate data protection laws</li>
                                    <li>Obtaining your explicit consent when required</li>
                                </ul>
                            </div>
                        </div>

                        <!-- Children's Privacy -->
                        <div id="children" class="legal-section">
                            <div class="section-header">
                                <i class="fas fa-child"></i>
                                <h2>Children's Privacy</h2>
                            </div>
                            <div class="section-content">
                                <p>Our services are not directed to individuals under the age of 18. We do not knowingly collect personal information from children under 18. If you become aware that a child has provided us with personal information, please contact us, and we will take steps to delete such information.</p>
                            </div>
                        </div>

                        <!-- Changes -->
                        <div id="changes" class="legal-section">
                            <div class="section-header">
                                <i class="fas fa-sync-alt"></i>
                                <h2>Changes to This Policy</h2>
                            </div>
                            <div class="section-content">
                                <p>We may update this Privacy Policy from time to time to reflect changes in our practices or for legal, operational, or regulatory reasons. We will notify you of any material changes by posting the new Privacy Policy on this page and updating the "Last Updated" date.</p>
                                <p>We encourage you to review this Privacy Policy periodically to stay informed about how we protect your information.</p>
                            </div>
                        </div>

                        <!-- Contact Information -->
                        <div id="contact" class="legal-section contact-section">
                            <div class="section-header">
                                <i class="fas fa-envelope"></i>
                                <h2>Contact Information</h2>
                            </div>
                            <div class="section-content">
                                <p>If you have questions, concerns, or requests regarding this Privacy Policy or our data practices, please contact us:</p>
                                
                                <div class="contact-info">
                                    <div class="contact-method">
                                        <i class="fas fa-envelope"></i>
                                        <div>
                                            <strong>Privacy Team</strong>
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
                        <h2 class="display-5 fw-bold mb-3">Questions About Our Privacy Policy?</h2>
                        <p class="lead mb-4">Our team is here to help you understand how we protect your personal information and answer any privacy-related questions.</p>
                        <div class="cta-features d-flex flex-wrap gap-4">
                            <div class="feature-item d-flex align-items-center">
                                <i class="fas fa-shield-alt text-primary me-2"></i>
                                <span>Data Protection</span>
                            </div>
                            <div class="feature-item d-flex align-items-center">
                                <i class="fas fa-lock text-primary me-2"></i>
                                <span>Secure Processing</span>
                            </div>
                            <div class="feature-item d-flex align-items-center">
                                <i class="fas fa-user-shield text-primary me-2"></i>
                                <span>Your Rights</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 text-center">
                    <div class="cta-actions">
                        <a href="/contact" class="btn btn-primary btn-lg mb-3 w-100">
                            <i class="fas fa-comments me-2"></i>
                            Contact Privacy Team
                        </a>
                        <a href="/cookies" class="btn btn-outline-primary w-100">
                            <i class="fas fa-cookie-bite me-2"></i>
                            Cookie Policy
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

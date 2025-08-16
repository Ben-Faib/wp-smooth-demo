<?php
/**
 * Cookie Policy Page Template
 * Professional cookie policy with clear typography and modern design
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
                            <span class="badge-legal">🍪 Cookie Information</span>
                        </div>
                        <h1 class="display-2 fw-bold mb-4">Cookie Policy</h1>
                        <p class="lead fs-4 mb-4 opacity-90">Understanding how we use cookies to improve your experience.</p>
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
                            <a href="#what-are-cookies" class="nav-link">What Are Cookies</a>
                            <a href="#how-we-use" class="nav-link">How We Use Cookies</a>
                            <a href="#types-of-cookies" class="nav-link">Types of Cookies</a>
                            <a href="#manage-cookies" class="nav-link">Manage Cookies</a>
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
                                <i class="fas fa-info-circle"></i>
                                <h2>Introduction</h2>
                            </div>
                            <div class="section-content">
                                <p class="lead">This Cookie Policy explains how Smooth Migration Global ("we," "us," or "our") uses cookies and similar tracking technologies when you visit our website at smoothmigration.com. This policy provides detailed information about why we use cookies, how they help us improve your experience, and how you can manage your cookie preferences.</p>
                                
                                <div class="important-notice">
                                    <div class="notice-header">
                                        <i class="fas fa-cookie-bite"></i>
                                        <strong>Cookie Consent</strong>
                                    </div>
                                    <p>By continuing to use our website, you consent to our use of cookies as described in this policy. This Cookie Policy should be read in conjunction with our <a href="/privacy">Privacy Policy</a> and <a href="/terms">Terms of Service</a>.</p>
                                </div>
                            </div>
                        </div>

                        <!-- What Are Cookies -->
                        <div id="what-are-cookies" class="legal-section">

                            <div class="section-header">
                                <i class="fas fa-cookie-bite"></i>
                                <h2>What Are Cookies?</h2>
                            </div>
                            <div class="section-content">
                                <p>Cookies are small text files that are stored on your device (computer, tablet, or mobile phone) when you visit a website. They help websites recognize your device and remember information about your visit, such as your preferences and settings.</p>
                                
                                <h3>Key Points About Cookies:</h3>
                                <ul>
                                    <li>Cookies cannot harm your device or access your personal files</li>
                                    <li>They help make websites work more efficiently</li>
                                    <li>They provide information that helps us improve our services</li>
                                    <li>Most cookies expire after a certain period</li>
                                    <li>You can control and delete cookies through your browser settings</li>
                                </ul>

                                <h3>Similar Technologies</h3>
                                <p>In addition to cookies, we may use other similar technologies such as:</p>
                                <ul>
                                    <li><strong>Web Beacons:</strong> Small graphics with unique identifiers that help us track user behavior</li>
                                    <li><strong>Local Storage:</strong> Technology that stores information locally on your device</li>
                                    <li><strong>Session Storage:</strong> Temporary storage that is deleted when you close your browser</li>
                                </ul>
                            </div>
                        </div>

                        <!-- How We Use Cookies -->
                        <div id="how-we-use" class="legal-section">
                            <div class="section-header">
                                <i class="fas fa-cogs"></i>
                                <h2>How We Use Cookies</h2>
                            </div>
                            <div class="section-content">
                                <p>We use cookies for various purposes to enhance your experience on our website:</p>
                                
                                <div class="cookie-category">
                                    <h4>🔐 Authentication & Security</h4>
                                    <p>To keep your account secure and verify your identity when you log in.</p>
                                </div>

                                <div class="cookie-category">
                                    <h4>⚙️ Functionality</h4>
                                    <p>To remember your preferences, language settings, and location choices.</p>
                                </div>

                                <div class="cookie-category">
                                    <h4>📊 Analytics & Performance</h4>
                                    <p>To understand how visitors use our website and identify areas for improvement.</p>
                                </div>

                                <div class="cookie-category">
                                    <h4>🎯 Marketing & Advertising</h4>
                                    <p>To deliver relevant advertisements and measure their effectiveness.</p>
                                </div>

                                <div class="cookie-category">
                                    <h4>💬 Customer Support</h4>
                                    <p>To provide better customer service through chat and support features.</p>
                                </div>
                            </div>
                        </div>

                        <!-- Types of Cookies We Use -->
                        <div id="types-of-cookies" class="legal-section">
                            <div class="section-header">
                                <i class="fas fa-list-alt"></i>
                                <h2>Types of Cookies We Use</h2>
                            </div>
                            <div class="section-content">
                                <h3>Essential Cookies</h3>
                                <p>These cookies are necessary for the website to function properly. They cannot be disabled.</p>
                    
                    <div class="cookie-table">
                        <table>
                            <thead>
                                <tr>
                                    <th>Cookie Name</th>
                                    <th>Purpose</th>
                                    <th>Duration</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>session_id</td>
                                    <td>Maintains user session</td>
                                    <td>Session</td>
                                </tr>
                                <tr>
                                    <td>csrf_token</td>
                                    <td>Security - prevents cross-site attacks</td>
                                    <td>Session</td>
                                </tr>
                                <tr>
                                    <td>cookie_consent</td>
                                    <td>Stores cookie consent preferences</td>
                                    <td>1 year</td>
                                </tr>
                                <tr>
                                    <td>location_preference</td>
                                    <td>Remembers selected country/region</td>
                                    <td>30 days</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <h3>Performance Cookies</h3>
                    <p>These cookies help us understand how visitors interact with our website.</p>
                    
                    <div class="cookie-table">
                        <table>
                            <thead>
                                <tr>
                                    <th>Cookie Name</th>
                                    <th>Purpose</th>
                                    <th>Duration</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>_ga</td>
                                    <td>Google Analytics - tracks unique visitors</td>
                                    <td>2 years</td>
                                </tr>
                                <tr>
                                    <td>_gid</td>
                                    <td>Google Analytics - distinguishes users</td>
                                    <td>24 hours</td>
                                </tr>
                                <tr>
                                    <td>_gat</td>
                                    <td>Google Analytics - throttles request rate</td>
                                    <td>1 minute</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <h3>Functional Cookies</h3>
                    <p>These cookies enable enhanced functionality and personalization.</p>
                    
                    <div class="cookie-table">
                        <table>
                            <thead>
                                <tr>
                                    <th>Cookie Name</th>
                                    <th>Purpose</th>
                                    <th>Duration</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>language</td>
                                    <td>Stores language preference</td>
                                    <td>1 year</td>
                                </tr>
                                <tr>
                                    <td>timezone</td>
                                    <td>Stores timezone for accurate times</td>
                                    <td>1 year</td>
                                </tr>
                                <tr>
                                    <td>recently_viewed</td>
                                    <td>Tracks recently viewed services</td>
                                    <td>30 days</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <h3>Marketing Cookies</h3>
                    <p>These cookies track your browsing habits to deliver relevant advertisements.</p>
                    
                    <div class="cookie-table">
                        <table>
                            <thead>
                                <tr>
                                    <th>Cookie Name</th>
                                    <th>Purpose</th>
                                    <th>Duration</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>fbp</td>
                                    <td>Facebook Pixel - tracks conversions</td>
                                    <td>3 months</td>
                                </tr>
                                <tr>
                                    <td>_gcl_au</td>
                                    <td>Google Ads - conversion tracking</td>
                                    <td>3 months</td>
                                </tr>
                                <tr>
                                    <td>IDE</td>
                                    <td>Google DoubleClick - targeted advertising</td>
                                    <td>1 year</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                            </div>
                        </div>

                        <!-- Third-Party Cookies -->
                        <div id="third-party" class="legal-section">
                            <div class="section-header">
                                <i class="fas fa-share-alt"></i>
                                <h2>Third-Party Cookies</h2>
                            </div>
                            <div class="section-content">
                                <p>We work with third-party services that may set cookies on your device. These include:</p>
                                
                                <h3>Analytics Providers</h3>
                                <ul>
                                    <li><strong>Google Analytics:</strong> Helps us understand website usage patterns</li>
                                    <li><strong>Hotjar:</strong> Provides heatmaps and user session recordings</li>
                                </ul>
                                
                                <h3>Advertising Partners</h3>
                                <ul>
                                    <li><strong>Google Ads:</strong> Delivers targeted advertisements</li>
                                    <li><strong>Facebook Pixel:</strong> Measures advertising effectiveness</li>
                                    <li><strong>LinkedIn Insight Tag:</strong> Tracks conversions from LinkedIn ads</li>
                                </ul>
                                
                                <h3>Customer Support Tools</h3>
                                <ul>
                                    <li><strong>Intercom:</strong> Provides chat support functionality</li>
                                    <li><strong>Zendesk:</strong> Manages customer support tickets</li>
                                </ul>
                                
                                <p>These third parties have their own privacy policies and cookie practices. We recommend reviewing their policies to understand how they use your information.</p>
                            </div>
                        </div>

                        <!-- How to Manage Cookies -->
                        <div id="manage-cookies" class="legal-section">
                            <div class="section-header">
                                <i class="fas fa-cog"></i>
                                <h2>How to Manage Cookies</h2>
                            </div>
                            <div class="section-content">
                                <p>You have several options for managing cookies:</p>
                                
                                <h3>Cookie Consent Tool</h3>
                                <p>When you first visit our website, you'll see a cookie consent banner that allows you to:</p>
                                <ul>
                                    <li>Accept all cookies</li>
                                    <li>Reject non-essential cookies</li>
                                    <li>Customize your cookie preferences</li>
                                </ul>
                                
                                <button class="manage-cookies-btn" onclick="openCookieSettings()">Manage Cookie Settings</button>
                                
                                <h3>Impact of Disabling Cookies</h3>
                                <p>Please note that if you disable certain cookies:</p>
                                <ul>
                                    <li>Some features of our website may not function properly</li>
                                    <li>You may need to re-enter information each visit</li>
                                    <li>Your preferences may not be saved</li>
                                    <li>You may see less relevant content and advertisements</li>
                                </ul>
                            </div>
                        </div>

                        <!-- Browser Cookie Settings -->
                        <div id="browser-settings" class="legal-section">
                            <div class="section-header">
                                <i class="fas fa-globe"></i>
                                <h2>Browser Cookie Settings</h2>
                            </div>
                            <div class="section-content">
                                <p>You can also control cookies through your browser settings. Here's how to manage cookies in popular browsers:</p>
                                
                                <h3>Chrome</h3>
                                <p>Settings → Privacy and security → Cookies and other site data</p>
                                <p><a href="https://support.google.com/chrome/answer/95647" target="_blank" rel="noopener">Chrome Cookie Settings Guide</a></p>
                                
                                <h3>Firefox</h3>
                                <p>Settings → Privacy & Security → Cookies and Site Data</p>
                                <p><a href="https://support.mozilla.org/en-US/kb/cookies-information-websites-store-on-your-computer" target="_blank" rel="noopener">Firefox Cookie Settings Guide</a></p>
                                
                                <h3>Safari</h3>
                                <p>Preferences → Privacy → Manage Website Data</p>
                                <p><a href="https://support.apple.com/guide/safari/manage-cookies-and-website-data-sfri11471/mac" target="_blank" rel="noopener">Safari Cookie Settings Guide</a></p>
                                
                                <h3>Microsoft Edge</h3>
                                <p>Settings → Privacy, search, and services → Cookies and site permissions</p>
                                <p><a href="https://support.microsoft.com/en-us/microsoft-edge/delete-cookies-in-microsoft-edge-63947406-40ac-c3b8-57b9-2a946a29ae09" target="_blank" rel="noopener">Edge Cookie Settings Guide</a></p>
                                
                                <h3>Opt-Out Tools</h3>
                                <p>You can also use these tools to opt out of certain tracking:</p>
                                <ul>
                                    <li><a href="https://tools.google.com/dlpage/gaoptout" target="_blank" rel="noopener">Google Analytics Opt-Out</a></li>
                                    <li><a href="http://www.aboutads.info/choices/" target="_blank" rel="noopener">Digital Advertising Alliance Opt-Out</a></li>
                                    <li><a href="http://www.youronlinechoices.eu/" target="_blank" rel="noopener">European Interactive Digital Advertising Alliance</a></li>
                                </ul>
                            </div>
                        </div>

                        <!-- Cookies on Mobile Devices -->
                        <div id="mobile-devices" class="legal-section">
                            <div class="section-header">
                                <i class="fas fa-mobile-alt"></i>
                                <h2>Cookies on Mobile Devices</h2>
                            </div>
                            <div class="section-content">
                                <p>Mobile devices offer additional privacy settings:</p>
                                
                                <h3>iOS Devices</h3>
                                <ul>
                                    <li>Go to Settings → Safari → Privacy & Security</li>
                                    <li>Toggle "Prevent Cross-Site Tracking"</li>
                                    <li>Manage "Block All Cookies" settings</li>
                                </ul>
                                
                                <h3>Android Devices</h3>
                                <ul>
                                    <li>Open Chrome → Settings → Site settings → Cookies</li>
                                    <li>Choose your preferred cookie settings</li>
                                    <li>Manage site-specific permissions</li>
                                </ul>
                                
                                <h3>Mobile App Tracking</h3>
                                <p>For mobile apps, you can usually opt out of tracking through:</p>
                                <ul>
                                    <li><strong>iOS:</strong> Settings → Privacy & Security → Tracking</li>
                                    <li><strong>Android:</strong> Settings → Google → Ads → Opt out of Ads Personalization</li>
                                </ul>
                            </div>
                        </div>

                        <!-- Changes to This Policy -->
                        <div id="changes" class="legal-section">
                            <div class="section-header">
                                <i class="fas fa-sync-alt"></i>
                                <h2>Changes to This Policy</h2>
                            </div>
                            <div class="section-content">
                                <p>We may update this Cookie Policy from time to time to reflect changes in our practices or for legal, operational, or regulatory reasons. When we make changes:</p>
                                <ul>
                                    <li>We will update the "Last Updated" date at the top of this policy</li>
                                    <li>For significant changes, we may display a notice on our website</li>
                                    <li>We may request renewed consent for certain cookie uses</li>
                                </ul>
                                <p>We encourage you to review this policy periodically to stay informed about our use of cookies.</p>
                            </div>
                        </div>

                        <!-- Contact Information -->
                        <div id="contact" class="legal-section contact-section">
                            <div class="section-header">
                                <i class="fas fa-envelope"></i>
                                <h2>Contact Us</h2>
                            </div>
                            <div class="section-content">
                                <p>If you have questions about this Cookie Policy or our use of cookies, please contact us:</p>
                                
                                <div class="contact-info">
                                    <div class="contact-method">
                                        <i class="fas fa-envelope"></i>
                                        <div>
                                            <strong>Cookie Team</strong>
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
                                
                                <p class="mt-4">For more information about how we handle your personal data, please see our <a href="/privacy">Privacy Policy</a>.</p>
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
                        <h2 class="display-5 fw-bold mb-3">Questions About Our Cookie Policy?</h2>
                        <p class="lead mb-4">Our team is here to help you understand how we use cookies and manage your preferences.</p>
                        <div class="cta-features d-flex flex-wrap gap-4">
                            <div class="feature-item d-flex align-items-center">
                                <i class="fas fa-cookie-bite text-primary me-2"></i>
                                <span>Cookie Management</span>
                            </div>
                            <div class="feature-item d-flex align-items-center">
                                <i class="fas fa-shield-alt text-primary me-2"></i>
                                <span>Privacy Protection</span>
                            </div>
                            <div class="feature-item d-flex align-items-center">
                                <i class="fas fa-cogs text-primary me-2"></i>
                                <span>Preference Control</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 text-center">
                    <div class="cta-actions">
                        <a href="/contact" class="btn btn-primary btn-lg mb-3 w-100">
                            <i class="fas fa-comments me-2"></i>
                            Contact Cookie Team
                        </a>
                        <button class="btn btn-outline-primary w-100" onclick="openCookieSettings()">
                            <i class="fas fa-cogs me-2"></i>
                            Manage Cookie Settings
                        </button>
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

/* Cookie-specific styles */
.cookie-table {
    width: 100%;
    margin: 2rem 0;
    border-collapse: collapse;
    border-radius: var(--border-radius-lg);
    overflow: hidden;
    box-shadow: var(--shadow-sm);
}

.cookie-table th {
    background: var(--primary-color);
    color: white;
    font-weight: 600;
    padding: 1rem;
    text-align: left;
}

.cookie-table td {
    padding: 0.8rem 1rem;
    border-bottom: 1px solid var(--border-light);
    color: var(--text-medium);
}

.cookie-table tr:hover {
    background: var(--bg-section);
}

.cookie-category {
    background: var(--bg-section);
    border-radius: var(--border-radius-lg);
    padding: 1.5rem;
    margin-bottom: 1.5rem;
    border: 1px solid var(--border-light);
}

.cookie-category h4 {
    color: var(--text-dark);
    margin-bottom: 0.75rem;
    font-size: 1.1rem;
    font-weight: 600;
}

.cookie-category p {
    color: var(--text-light);
    margin: 0;
}

.manage-cookies-btn {
    background: var(--primary-color);
    color: white;
    padding: 0.8rem 2rem;
    border: none;
    border-radius: var(--border-radius-lg);
    font-size: 1rem;
    cursor: pointer;
    transition: all 0.3s ease;
    display: inline-block;
    text-decoration: none;
    margin: 1rem 0;
    font-weight: 600;
}

.manage-cookies-btn:hover {
    background: var(--primary-hover);
    transform: translateY(-2px);
    box-shadow: var(--shadow-md);
    text-decoration: none;
    color: white;
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
    
    .cookie-table {
        font-size: 0.9rem;
    }
    
    .cookie-table th,
    .cookie-table td {
        padding: 0.6rem 0.8rem;
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

function openCookieSettings() {
    // This function will be implemented to open cookie consent settings
    // For now, show an alert
    alert('Cookie settings panel will be available soon. You can manage cookies through your browser settings in the meantime.');
}
</script>

<?php
get_footer(); ?>

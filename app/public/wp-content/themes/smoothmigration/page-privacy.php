<?php
/**
 * Template Name: Privacy Policy
 * 
 * @package smoothmigration
 */

get_header();
?>

<style>
.privacy-hero {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    padding: 100px 0 60px;
    color: white;
    position: relative;
    overflow: hidden;
}

.privacy-hero::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='100' height='100' viewBox='0 0 100 100'%3E%3Cg fill-opacity='0.1'%3E%3Cpolygon fill='white' points='50 0 60 40 100 50 60 60 50 100 40 60 0 50 40 40'/%3E%3C/g%3E%3C/svg%3E");
    background-size: 100px 100px;
}

.privacy-content {
    background: #f8f9fa;
    padding: 60px 0;
}

.privacy-section {
    background: white;
    border-radius: 12px;
    padding: 40px;
    margin-bottom: 30px;
    box-shadow: 0 2px 15px rgba(0,0,0,0.08);
}

.privacy-section h2 {
    color: #2c3e50;
    margin-bottom: 25px;
    padding-bottom: 15px;
    border-bottom: 2px solid #e9ecef;
    font-size: 1.8rem;
}

.privacy-section h3 {
    color: #495057;
    margin-top: 25px;
    margin-bottom: 15px;
    font-size: 1.3rem;
}

.privacy-section p {
    line-height: 1.8;
    color: #6c757d;
    margin-bottom: 15px;
}

.privacy-section ul {
    margin: 20px 0;
    padding-left: 25px;
}

.privacy-section li {
    margin-bottom: 10px;
    line-height: 1.8;
    color: #6c757d;
}

.table-of-contents {
    background: #f8f9fa;
    border-radius: 8px;
    padding: 25px;
    margin-bottom: 30px;
}

.table-of-contents h3 {
    color: #2c3e50;
    margin-bottom: 20px;
    font-size: 1.2rem;
}

.table-of-contents ul {
    list-style: none;
    padding: 0;
    margin: 0;
}

.table-of-contents li {
    margin-bottom: 12px;
}

.table-of-contents a {
    color: #667eea;
    text-decoration: none;
    transition: all 0.3s ease;
    display: inline-block;
}

.table-of-contents a:hover {
    color: #764ba2;
    transform: translateX(5px);
}

.last-updated {
    background: #e7f3ff;
    border-left: 4px solid #0066cc;
    padding: 15px;
    margin-bottom: 30px;
    border-radius: 4px;
}

.contact-info {
    background: #f8f9fa;
    border-radius: 8px;
    padding: 25px;
    margin-top: 30px;
}

.contact-info h3 {
    color: #2c3e50;
    margin-bottom: 15px;
}

.contact-info p {
    margin-bottom: 10px;
    color: #6c757d;
}

.contact-info a {
    color: #667eea;
    text-decoration: none;
}

.contact-info a:hover {
    text-decoration: underline;
}
</style>

<div class="privacy-hero">
    <div class="container position-relative">
        <h1 class="display-4 fw-bold mb-3">Privacy Policy</h1>
        <p class="lead">Your privacy is important to us. This policy explains how we collect, use, and protect your information.</p>
    </div>
</div>

<div class="privacy-content">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 mx-auto">
                
                <div class="last-updated">
                    <strong>Last Updated:</strong> <?php echo date('F j, Y'); ?> | <strong>Effective Date:</strong> <?php echo date('F j, Y'); ?>
                </div>

                <div class="table-of-contents">
                    <h3>Table of Contents</h3>
                    <ul>
                        <li><a href="#introduction">1. Introduction</a></li>
                        <li><a href="#information-collection">2. Information We Collect</a></li>
                        <li><a href="#information-use">3. How We Use Your Information</a></li>
                        <li><a href="#information-sharing">4. Information Sharing and Disclosure</a></li>
                        <li><a href="#data-security">5. Data Security</a></li>
                        <li><a href="#cookies">6. Cookies and Tracking Technologies</a></li>
                        <li><a href="#user-rights">7. Your Rights and Choices</a></li>
                        <li><a href="#international">8. International Data Transfers</a></li>
                        <li><a href="#children">9. Children's Privacy</a></li>
                        <li><a href="#changes">10. Changes to This Policy</a></li>
                        <li><a href="#contact">11. Contact Information</a></li>
                    </ul>
                </div>

                <div class="privacy-section" id="introduction">
                    <h2>1. Introduction</h2>
                    <p>Welcome to Smooth Migration Global ("we," "our," or "us"). We are committed to protecting your personal information and your right to privacy. This Privacy Policy explains how we collect, use, disclose, and safeguard your information when you visit our website or use our services.</p>
                    <p>By using our website and services, you agree to the collection and use of information in accordance with this policy. If you do not agree with the terms of this privacy policy, please do not access the site or use our services.</p>
                </div>

                <div class="privacy-section" id="information-collection">
                    <h2>2. Information We Collect</h2>
                    
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

                <div class="privacy-section" id="information-use">
                    <h2>3. How We Use Your Information</h2>
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

                <div class="privacy-section" id="information-sharing">
                    <h2>4. Information Sharing and Disclosure</h2>
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

                <div class="privacy-section" id="data-security">
                    <h2>5. Data Security</h2>
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

                <div class="privacy-section" id="cookies">
                    <h2>6. Cookies and Tracking Technologies</h2>
                    <p>We use cookies and similar tracking technologies to collect and store information about your interactions with our website. For detailed information about our use of cookies, please refer to our <a href="/cookies">Cookie Policy</a>.</p>
                    
                    <p>You can control cookie preferences through your browser settings and our cookie consent tool. Note that disabling certain cookies may limit your ability to use some features of our website.</p>
                </div>

                <div class="privacy-section" id="user-rights">
                    <h2>7. Your Rights and Choices</h2>
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

                <div class="privacy-section" id="international">
                    <h2>8. International Data Transfers</h2>
                    <p>As a global relocation service, we may transfer your information to countries other than the one in which you reside. These countries may have different data protection laws than your country.</p>
                    <p>When we transfer personal information internationally, we implement appropriate safeguards to protect your information, including:</p>
                    <ul>
                        <li>Standard contractual clauses approved by relevant authorities</li>
                        <li>Ensuring recipients are in countries with adequate data protection laws</li>
                        <li>Obtaining your explicit consent when required</li>
                    </ul>
                </div>

                <div class="privacy-section" id="children">
                    <h2>9. Children's Privacy</h2>
                    <p>Our services are not directed to individuals under the age of 18. We do not knowingly collect personal information from children under 18. If you become aware that a child has provided us with personal information, please contact us, and we will take steps to delete such information.</p>
                </div>

                <div class="privacy-section" id="changes">
                    <h2>10. Changes to This Policy</h2>
                    <p>We may update this Privacy Policy from time to time to reflect changes in our practices or for legal, operational, or regulatory reasons. We will notify you of any material changes by posting the new Privacy Policy on this page and updating the "Last Updated" date.</p>
                    <p>We encourage you to review this Privacy Policy periodically to stay informed about how we protect your information.</p>
                </div>

                <div class="privacy-section" id="contact">
                    <h2>11. Contact Information</h2>
                    <p>If you have questions, concerns, or requests regarding this Privacy Policy or our data practices, please contact us:</p>
                    
                    <div class="contact-info">
                        <h3>Smooth Migration Global</h3>
                        <p><strong>Email:</strong> <a href="mailto:privacy@smoothmigration.com">privacy@smoothmigration.com</a></p>
                        <p><strong>Phone:</strong> +1 (555) 123-4567</p>
                        <p><strong>Address:</strong> 123 Migration Plaza, Suite 100<br>
                        New York, NY 10001<br>
                        United States</p>
                        <p><strong>Data Protection Officer:</strong> <a href="mailto:dpo@smoothmigration.com">dpo@smoothmigration.com</a></p>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

<?php get_footer(); ?>

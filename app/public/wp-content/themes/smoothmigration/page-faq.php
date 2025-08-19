<?php
/**
 * FAQ Page Template
 * Modern FAQ page with interactive accordion and search functionality
 *
 * @package smoothmigration
 */

get_header();
?>

<main id="main" class="site-main faq-page" role="main">

    <!-- Hero Section -->
    <section class="faq-hero py-6 bg-gradient-primary text-white position-relative overflow-hidden">
        <div class="container position-relative z-2">
            <div class="row justify-content-center text-center">
                <div class="col-lg-8">
                    <div class="hero-content animate-on-scroll">
                        <div class="hero-badge mb-4">
                            <span class="badge-faq">❓ Frequently Asked Questions</span>
                        </div>
                        <h1 class="display-2 fw-bold mb-4">FAQ</h1>
                        <p class="lead fs-4 mb-4 opacity-90">Find answers to common questions about international relocation and our services.</p>
                        
                        <!-- Search Box -->
                        <div class="faq-search mb-4">
                            <div class="search-wrapper">
                                <input type="text" id="faqSearch" class="form-control" placeholder="Search frequently asked questions...">
                                <i class="fas fa-search search-icon"></i>
                            </div>
                        </div>
                        
                        <div class="hero-stats d-flex flex-wrap justify-content-center gap-4">
                            <div class="stat-item">
                                <div class="stat-number">16</div>
                                <div class="stat-label">Key Questions Answered</div>
                            </div>
                            <div class="stat-item">
                                <div class="stat-number">365</div>
                                <div class="stat-label">Days of Support</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Background Pattern -->
        <div class="hero-pattern position-absolute top-0 start-0 w-100 h-100 opacity-10"></div>
    </section>

    <!-- FAQ Categories -->
    <section class="faq-categories py-4 bg-light border-bottom">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-10">
                    <div class="category-filters d-flex flex-wrap justify-content-center gap-2">
                        <button class="category-btn active" data-category="all">All Questions</button>
                        <button class="category-btn" data-category="general">General</button>
                        <button class="category-btn" data-category="services">Services</button>
                        <button class="category-btn" data-category="pricing">Pricing</button>
                        <button class="category-btn" data-category="process">Process</button>
                        <button class="category-btn" data-category="support">Support</button>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- FAQ Content -->
    <section class="faq-content py-6">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-10">
                    <div class="faq-accordion" id="faqAccordion">
                        
                        <!-- General Questions -->
                        <div class="faq-section" data-category="general">
                            <h3 class="section-title">General Questions</h3>
                            
                            <div class="faq-item" data-faq-id="1">
                                <div class="faq-header" data-target="#faq1">
                                    <h4 class="faq-question">What is international relocation to Smooth Migration Global?</h4>
                                    <i class="fas fa-plus faq-icon"></i>
                                </div>
                                <div class="collapse" id="faq1">
                                    <div class="faq-answer">
                                        <p>At Smooth Migration Global, we deliver expert-driven, customized solutions that support seamless transitions and long-term success for individuals and businesses alike.</p>
                                        <p>International relocation and cross-border business expansion involve complex processes as well as successfully adapting to new cultures, work environments, and lifestyles. We understand these challenges because we've lived them ourselves.</p>
                                        <div class="services-grid">
                                            <div class="service-item"><?php echo sm_icon('earth-americas', 'solid', 'text-primary icon'); ?> Cultural Adaptation</div>
                                            <div class="service-item"><?php echo sm_icon('briefcase', 'solid', 'text-primary icon'); ?> Work Environment Integration</div>
                                            <div class="service-item"><?php echo sm_icon('house', 'solid', 'text-primary icon'); ?> Lifestyle Transition</div>
                                            <div class="service-item"><?php echo sm_icon('clipboard-list', 'solid', 'text-primary icon'); ?> Complex Process Management</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="faq-item" data-faq-id="2">
                                <div class="faq-header" data-target="#faq2">
                                    <h4 class="faq-question">What services do you provide? Are you an immigration agency?</h4>
                                    <i class="fas fa-plus faq-icon"></i>
                                </div>
                                <div class="collapse" id="faq2">
                                    <div class="faq-answer">
                                        <p><strong>We are not an immigration agency.</strong> Immigration agencies offer legal services for visas, while shipping companies only manage moving goods.</p>
                                        <p>We work with immigration agencies and shipping companies to provide a comprehensive range of relocation services necessary for moving countries successfully.</p>
                                        <div class="country-list">
                                            <div class="country-group">
                                                <strong>Our Role:</strong> Comprehensive relocation coordination and support services
                                            </div>
                                            <div class="country-group">
                                                <strong>Immigration Agencies:</strong> Legal visa and documentation services
                                            </div>
                                            <div class="country-group">
                                                <strong>Shipping Companies:</strong> Moving goods and belongings internationally
                                            </div>
                                        </div>
                                        <p>Think of us as your relocation concierge - we coordinate with all the specialists you need for a smooth transition.</p>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="faq-item" data-faq-id="3">
                                <div class="faq-header" data-target="#faq3">
                                    <h4 class="faq-question">Can anyone contact Smooth Migration or only referred clients?</h4>
                                    <i class="fas fa-plus faq-icon"></i>
                                </div>
                                <div class="collapse" id="faq3">
                                    <div class="faq-answer">
                                        <p><strong>Anyone can contact us!</strong> You don't need a referral or special invitation.</p>
                                        <p>Whether you're moving from any country to one of our service countries, we're here to provide free assistance and guidance. Our doors are open to everyone who needs support with international relocation.</p>
                                        <div class="pricing-options">
                                            <div class="pricing-item">
                                                <strong>Free Initial Consultation:</strong> No cost to explore how we can help
                                            </div>
                                            <div class="pricing-item">
                                                <strong>No Referral Required:</strong> Direct access to our services
                                            </div>
                                            <div class="pricing-item">
                                                <strong>Global Accessibility:</strong> Support for moves from any country to our service locations
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Services Questions -->
                        <div class="faq-section" data-category="services">
                            <h3 class="section-title">Services</h3>
                            
                            <div class="faq-item" data-faq-id="4">
                                <div class="faq-header" data-target="#faq4">
                                    <h4 class="faq-question">How does your insurance work?</h4>
                                    <i class="fas fa-plus faq-icon"></i>
                                </div>
                                <div class="collapse" id="faq4">
                                    <div class="faq-answer">
                                        <p>We partner with some of the best international insurance providers to offer a comprehensive variety of insurance types, with their extensive support teams working alongside us.</p>
                                        <div class="services-grid">
                                            <div class="service-item"><?php echo sm_icon('shield-halved', 'solid', 'text-primary icon'); ?> Travel Insurance</div>
                                            <div class="service-item"><?php echo sm_icon('hospital', 'solid', 'text-primary icon'); ?> Health Insurance</div>
                                            <div class="service-item"><?php echo sm_icon('house', 'solid', 'text-primary icon'); ?> Property Insurance</div>
                                            <div class="service-item"><?php echo sm_icon('car', 'solid', 'text-primary icon'); ?> Vehicle Insurance</div>
                                            <div class="service-item"><?php echo sm_icon('briefcase', 'solid', 'text-primary icon'); ?> Business Insurance</div>
                                            <div class="service-item"><?php echo sm_icon('lock', 'solid', 'text-primary icon'); ?> Personal Liability</div>
                                        </div>
                                        <p>Generally, everyone should consider one of our travel insurance options, but there are additional coverage types depending on your individual needs. Our immigration agency partners often recommend starting with our insurance consultation.</p>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="faq-item" data-faq-id="5">
                                <div class="faq-header" data-target="#faq5">
                                    <h4 class="faq-question">How do you help teachers relocate?</h4>
                                    <i class="fas fa-plus faq-icon"></i>
                                </div>
                                <div class="collapse" id="faq5">
                                    <div class="faq-answer">
                                        <p><strong>We provide comprehensive support for educators - completely free!</strong></p>
                                        <p>We work closely with schools, colleges, and immigration agencies to assist new teachers in getting settled in their destination country.</p>
                                        <div class="services-grid">
                                            <div class="service-item"><?php echo sm_icon('house', 'solid', 'text-primary icon'); ?> Rental Assistance</div>
                                            <div class="service-item"><?php echo sm_icon('car', 'solid', 'text-primary icon'); ?> Vehicle Purchase Support</div>
                                            <div class="service-item"><?php echo sm_icon('shield-halved', 'solid', 'text-primary icon'); ?> Travel Insurance</div>
                                            <div class="service-item"><?php echo sm_icon('landmark', 'solid', 'text-primary icon'); ?> Banking Setup</div>
                                            <div class="service-item"><?php echo sm_icon('mobile-screen', 'solid', 'text-primary icon'); ?> Phone & Internet</div>
                                            <div class="service-item"><?php echo sm_icon('graduation-cap', 'solid', 'text-primary icon'); ?> School Integration</div>
                                        </div>
                                        <p>Our teacher relocation program recognizes the vital role educators play in our communities, which is why we provide these essential services at no cost.</p>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="faq-item" data-faq-id="6">
                                <div class="faq-header" data-target="#faq6">
                                    <h4 class="faq-question">Do you offer business services?</h4>
                                    <i class="fas fa-plus faq-icon"></i>
                                </div>
                                <div class="collapse" id="faq6">
                                    <div class="faq-answer">
                                        <p><strong>Yes, we do!</strong> Our business services are managed on a case-by-case basis to ensure personalized solutions.</p>
                                        <p>We have a comprehensive range of business-specific services available in all of our locations. Whether you're expanding internationally or setting up a new venture, we can help.</p>
                                        <div class="country-list">
                                            <div class="country-group">
                                                <strong>Company Registration:</strong> Legal entity setup and compliance
                                            </div>
                                            <div class="country-group">
                                                <strong>Tax Requirements:</strong> Inter-country tax planning and setup
                                            </div>
                                            <div class="country-group">
                                                <strong>Banking Solutions:</strong> Business account setup and financial services
                                            </div>
                                            <div class="country-group">
                                                <strong>Compliance Support:</strong> Regulatory requirements and ongoing compliance
                                            </div>
                                        </div>
                                        <p>Ready to expand your business internationally? <a href="/contact">Reach out via our contact form</a> to discuss your specific requirements.</p>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="faq-item" data-faq-id="7">
                                <div class="faq-header" data-target="#faq7">
                                    <h4 class="faq-question">Can you assist in setting up our company when we arrive?</h4>
                                    <i class="fas fa-plus faq-icon"></i>
                                </div>
                                <div class="collapse" id="faq7">
                                    <div class="faq-answer">
                                        <p><strong>Absolutely!</strong> We have some of the most innovative partners in our service countries who can assist with various aspects of company setup and business establishment.</p>
                                        <div class="process-steps">
                                            <div class="process-step">
                                                <div class="step-number">1</div>
                                                <div class="step-content">
                                                    <h5>Company Registration</h5>
                                                    <p>Complete legal entity setup with all required documentation and registrations.</p>
                                                </div>
                                            </div>
                                            <div class="process-step">
                                                <div class="step-number">2</div>
                                                <div class="step-content">
                                                    <h5>Tax Setup</h5>
                                                    <p>Inter-country tax requirements, structures, and ongoing compliance planning.</p>
                                                </div>
                                            </div>
                                            <div class="process-step">
                                                <div class="step-number">3</div>
                                                <div class="step-content">
                                                    <h5>Banking & Finance</h5>
                                                    <p>Business banking setup, merchant services, and financial infrastructure.</p>
                                                </div>
                                            </div>
                                            <div class="process-step">
                                                <div class="step-number">4</div>
                                                <div class="step-content">
                                                    <h5>Ongoing Support</h5>
                                                    <p>Continued guidance for regulatory compliance and business operations.</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="faq-item" data-faq-id="8">
                                <div class="faq-header" data-target="#faq8">
                                    <h4 class="faq-question">Our immigration agency recommended that we ask Smooth Migration which insurance options we need - where do we start?</h4>
                                    <i class="fas fa-plus faq-icon"></i>
                                </div>
                                <div class="collapse" id="faq8">
                                    <div class="faq-answer">
                                        <p><strong>Great question!</strong> Immigration agencies often recommend us because we specialize in helping new residents understand their insurance needs in their destination country.</p>
                                        <p>Generally, everyone should look at one of our travel insurance options as a starting point, but there are a number of other coverage types depending on your individual needs and circumstances.</p>
                                        <div class="services-grid">
                                            <div class="service-item"><?php echo sm_icon('shield-halved', 'solid', 'text-primary icon'); ?> Travel Insurance (Essential)</div>
                                            <div class="service-item"><?php echo sm_icon('hospital', 'solid', 'text-primary icon'); ?> Health Insurance</div>
                                            <div class="service-item"><?php echo sm_icon('house', 'solid', 'text-primary icon'); ?> Property Insurance</div>
                                            <div class="service-item"><?php echo sm_icon('car', 'solid', 'text-primary icon'); ?> Vehicle Insurance</div>
                                            <div class="service-item"><?php echo sm_icon('briefcase', 'solid', 'text-primary icon'); ?> Business Insurance</div>
                                            <div class="service-item"><?php echo sm_icon('people-group', 'solid', 'text-primary icon'); ?> Family Coverage Plans</div>
                                        </div>
                                        <p><strong>Recommended Starting Process:</strong></p>
                                        <div class="process-steps">
                                            <div class="process-step">
                                                <div class="step-number">1</div>
                                                <div class="step-content">
                                                    <h5>Travel Insurance First</h5>
                                                    <p>Secure travel insurance for your journey and initial period in the new country.</p>
                                                </div>
                                            </div>
                                            <div class="process-step">
                                                <div class="step-number">2</div>
                                                <div class="step-content">
                                                    <h5>Personal Consultation</h5>
                                                    <p>Discuss your specific situation, family needs, and destination requirements.</p>
                                                </div>
                                            </div>
                                            <div class="process-step">
                                                <div class="step-number">3</div>
                                                <div class="step-content">
                                                    <h5>Customized Recommendations</h5>
                                                    <p>Receive tailored insurance options that match your individual circumstances.</p>
                                                </div>
                                            </div>
                                        </div>
                                        <p><a href="/contact">Contact us today</a> for a personalized insurance consultation - we'll work with your immigration agency to ensure you have the right coverage from day one.</p>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="faq-item" data-faq-id="9">
                                <div class="faq-header" data-target="#faq9">
                                    <h4 class="faq-question">How do I get a shipping quote if it's not on your website?</h4>
                                    <i class="fas fa-plus faq-icon"></i>
                                </div>
                                <div class="collapse" id="faq9">
                                    <div class="faq-answer">
                                        <p>We have recently changed web providers and our new website is currently under development with enhanced features and functionality.</p>
                                        <p><strong>For all service queries, including shipping quotes, please complete our contact form on any of our websites.</strong></p>
                                        <div class="pricing-options">
                                            <div class="pricing-item">
                                                <strong>Quick Response:</strong> We'll get back to you within 24 hours with a detailed quote
                                            </div>
                                            <div class="pricing-item">
                                                <strong>Comprehensive Assessment:</strong> We'll review your specific shipping needs and provide options
                                            </div>
                                            <div class="pricing-item">
                                                <strong>Competitive Pricing:</strong> Benefit from our negotiated rates with trusted shipping partners
                                            </div>
                                        </div>
                                        <p>Thank you for your patience as we improve our digital experience!</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Pricing Questions -->
                        <div class="faq-section" data-category="pricing">
                            <h3 class="section-title">Pricing</h3>
                            
                            <div class="faq-item" data-faq-id="10">
                                <div class="faq-header" data-target="#faq10">
                                    <h4 class="faq-question">How does Smooth Migration negotiate better pricing?</h4>
                                    <i class="fas fa-plus faq-icon"></i>
                                </div>
                                <div class="collapse" id="faq10">
                                    <div class="faq-answer">
                                        <p><strong>Volume and strategic partnerships are key to our cost savings.</strong></p>
                                        <p>We operate across numerous locations and work with high volumes of people, which allows us to negotiate significantly better rates that we then pass directly onto our clients.</p>
                                        <div class="pricing-options">
                                            <div class="pricing-item">
                                                <strong>Volume Discounts:</strong> Our scale allows us to secure wholesale pricing across services
                                            </div>
                                            <div class="pricing-item">
                                                <strong>Strategic Partnerships:</strong> Long-term relationships with trusted providers mean better rates
                                            </div>
                                            <div class="pricing-item">
                                                <strong>Direct Savings:</strong> We pass these negotiated savings directly to you - no markup
                                            </div>
                                            <div class="pricing-item">
                                                <strong>Package Benefits:</strong> Bundling services often provides additional cost efficiencies
                                            </div>
                                        </div>
                                        <p>In many cases, you'll find our package pricing is more competitive than sourcing services individually, while providing the added benefit of coordinated, seamless service delivery.</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Process Questions -->
                        <div class="faq-section" data-category="process">
                            <h3 class="section-title">Process</h3>
                            
                            <div class="faq-item" data-faq-id="11">
                                <div class="faq-header" data-target="#faq11">
                                    <h4 class="faq-question">How does Smooth Migration work?</h4>
                                    <i class="fas fa-plus faq-icon"></i>
                                </div>
                                <div class="collapse" id="faq11">
                                    <div class="faq-answer">
                                        <p><strong>Over the last four years, we have been researching, negotiating, and building something special.</strong></p>
                                        <p>We think outside the box to provide the best solutions, specifically tailored for the millions of people that relocate internationally every year.</p>
                                        <div class="process-steps">
                                            <div class="process-step">
                                                <div class="step-number">1</div>
                                                <div class="step-content">
                                                    <h5>Research-Driven Approach</h5>
                                                    <p>Four years of research into what international relocators actually need and want.</p>
                                                </div>
                                            </div>
                                            <div class="process-step">
                                                <div class="step-number">2</div>
                                                <div class="step-content">
                                                    <h5>Strategic Partnerships</h5>
                                                    <p>Carefully negotiated relationships with the best service providers worldwide.</p>
                                                </div>
                                            </div>
                                            <div class="process-step">
                                                <div class="step-number">3</div>
                                                <div class="step-content">
                                                    <h5>Innovative Solutions</h5>
                                                    <p>Creative, outside-the-box thinking applied to complex relocation challenges.</p>
                                                </div>
                                            </div>
                                            <div class="process-step">
                                                <div class="step-number">4</div>
                                                <div class="step-content">
                                                    <h5>Tailored Experience</h5>
                                                    <p>Every solution is customized for your specific situation and destination.</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="faq-item" data-faq-id="12">
                                <div class="faq-header" data-target="#faq12">
                                    <h4 class="faq-question">How long do I have to be in my new country before I can apply for a mortgage?</h4>
                                    <i class="fas fa-plus faq-icon"></i>
                                </div>
                                <div class="collapse" id="faq12">
                                    <div class="faq-answer">
                                        <p><strong>Great news!</strong> While there are exceptions to standard timelines, some of our partners offer competitive mortgage financing from as soon as 90 days of residency.</p>
                                        <div class="timeline-examples">
                                            <div class="timeline-item">
                                                <strong>90 Days:</strong> Some lenders offer financing to qualified new residents
                                            </div>
                                            <div class="timeline-item">
                                                <strong>6 Months:</strong> More lenders become available with established credit history
                                            </div>
                                            <div class="timeline-item">
                                                <strong>12+ Months:</strong> Full range of mortgage products and best rates typically available
                                            </div>
                                        </div>
                                        <p>Each country and lender has different requirements, but we work with partners who specialize in new resident financing. <a href="/contact">Contact us</a> to explore your specific options.</p>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="faq-item" data-faq-id="13">
                                <div class="faq-header" data-target="#faq13">
                                    <h4 class="faq-question">What are the best ways to build a credit record in my new country?</h4>
                                    <i class="fas fa-plus faq-icon"></i>
                                </div>
                                <div class="collapse" id="faq13">
                                    <div class="faq-answer">
                                        <p><strong>Building credit is essential for your financial future.</strong> There are several easy ways to get started, and we can help you arrange these options at no charge!</p>
                                        <div class="services-grid">
                                            <div class="service-item"><?php echo sm_icon('credit-card', 'solid', 'text-primary icon'); ?> Secured Credit Cards</div>
                                            <div class="service-item"><?php echo sm_icon('landmark', 'solid', 'text-primary icon'); ?> Bank Account History</div>
                                            <div class="service-item"><?php echo sm_icon('file-invoice', 'solid', 'text-primary icon'); ?> Utility Account Setup</div>
                                            <div class="service-item"><?php echo sm_icon('mobile-screen', 'solid', 'text-primary icon'); ?> Mobile Phone Contracts</div>
                                            <div class="service-item"><?php echo sm_icon('house', 'solid', 'text-primary icon'); ?> Rental Payment History</div>
                                            <div class="service-item"><?php echo sm_icon('briefcase', 'solid', 'text-primary icon'); ?> Credit Builder Loans</div>
                                        </div>
                                        <p>Each country has slightly different credit systems, but the fundamentals are similar. We'll guide you through the most effective strategies for your destination.</p>
                                        <p><strong><a href="/contact">Contact us today</a> to discuss easy-to-arrange credit building options that won't cost you anything!</strong></p>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="faq-item" data-faq-id="14">
                                <div class="faq-header" data-target="#faq14">
                                    <h4 class="faq-question">Could I get financing for used vehicles as a new resident?</h4>
                                    <i class="fas fa-plus faq-icon"></i>
                                </div>
                                <div class="collapse" id="faq14">
                                    <div class="faq-answer">
                                        <p><strong>Yes, absolutely!</strong> Vehicle financing for new residents is available in all of our service locations.</p>
                                        <div class="country-list">
                                            <div class="country-group">
                                                <strong>New Resident Programs:</strong> Special financing options designed for people without local credit history
                                            </div>
                                            <div class="country-group">
                                                <strong>Competitive Rates:</strong> Our partners offer fair rates even for new residents
                                            </div>
                                            <div class="country-group">
                                                <strong>Used Vehicle Focus:</strong> Financing available for quality used vehicles, not just new cars
                                            </div>
                                            <div class="country-group">
                                                <strong>Quick Approval:</strong> Streamlined process for faster vehicle access
                                            </div>
                                        </div>
                                        <p>Getting reliable transportation is often one of the first priorities when relocating, and we've made sure financing options are available regardless of your credit history in the new country.</p>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="faq-item" data-faq-id="15">
                                <div class="faq-header" data-target="#faq15">
                                    <h4 class="faq-question">Does mortgage financing work the same in every country that you cover?</h4>
                                    <i class="fas fa-plus faq-icon"></i>
                                </div>
                                <div class="collapse" id="faq15">
                                    <div class="faq-answer">
                                        <p><strong>The basic principles of mortgages are similar in many countries, with some important exceptions.</strong></p>
                                        <p>The most notable difference is in Canada, where there is a key distinction between the term and amortization period that doesn't exist in most other countries.</p>
                                        <div class="country-list">
                                            <div class="country-group">
                                                <strong>Most Countries:</strong> Mortgage term equals the amortization period (e.g., 30-year mortgage)
                                            </div>
                                            <div class="country-group">
                                                <strong>Canada:</strong> Term (1-5 years) is separate from amortization (25-30 years)
                                            </div>
                                            <div class="country-group">
                                                <strong>Down Payments:</strong> Vary significantly by country (5% to 20%+ required)
                                            </div>
                                            <div class="country-group">
                                                <strong>Interest Rates:</strong> Fixed vs. variable options differ by market
                                            </div>
                                        </div>
                                        <p>Our mortgage specialists understand these country-specific differences and will guide you through the process that applies to your destination.</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Support Questions -->
                        <div class="faq-section" data-category="support">
                            <h3 class="section-title">Support</h3>
                            
                            <div class="faq-item" data-faq-id="16">
                                <div class="faq-header" data-target="#faq16">
                                    <h4 class="faq-question">Does Smooth Migration have support if there is a problem?</h4>
                                    <i class="fas fa-plus faq-icon"></i>
                                </div>
                                <div class="collapse" id="faq16">
                                    <div class="faq-answer">
                                        <p><strong>Absolutely!</strong> We have dedicated support staff available 365 days a year by email who will work to resolve all queries with support from our trusted partners.</p>
                                        <div class="contact-methods">
                                            <div class="contact-method">
                                                <i class="fas fa-calendar"></i>
                                                <div>
                                                    <strong>365-Day Availability</strong>
                                                    <p>Support every single day of the year - no exceptions</p>
                                                </div>
                                            </div>
                                            <div class="contact-method">
                                                <i class="fas fa-envelope"></i>
                                                <div>
                                                    <strong>Email Support</strong>
                                                    <p>Direct access to our support team who know your case</p>
                                                </div>
                                            </div>
                                            <div class="contact-method">
                                                <i class="fas fa-users"></i>
                                                <div>
                                                    <strong>Partner Network</strong>
                                                    <p>Our support team coordinates with our global partner network</p>
                                                </div>
                                            </div>
                                            <div class="contact-method">
                                                <i class="fas fa-clock"></i>
                                                <div>
                                                    <strong>Quick Resolution</strong>
                                                    <p>We work diligently to resolve issues as quickly as possible</p>
                                                </div>
                                            </div>
                                        </div>
                                        <p>Whether it's a service issue, documentation problem, or any challenge that arises during your relocation, our support team is here to help you navigate through it successfully.</p>
                                        <p><strong>Remember:</strong> You're never alone in your relocation journey - we're here to support you every step of the way.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                    </div>
                    
                    <!-- No Results Message -->
                    <div id="noResults" class="no-results text-center py-5" style="display: none;">
                        <div class="no-results-icon">
                            <i class="fas fa-search display-1 text-muted"></i>
                        </div>
                        <h3>No Results Found</h3>
                        <p class="text-muted mb-4">We couldn't find any questions matching your search. Try different keywords or browse all categories.</p>
                        <button class="btn btn-outline-primary" onclick="clearSearch()">Clear Search</button>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Still Have Questions CTA -->
    <section class="questions-cta py-6 bg-light">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-8">
                    <div class="cta-content">
                        <h2 class="display-5 fw-bold mb-3">Still Have Questions?</h2>
                        <p class="lead mb-4">Can't find what you're looking for? Our expert team is here to help with personalized answers and guidance.</p>
                        <div class="cta-features d-flex flex-wrap gap-4">
                            <div class="feature-item d-flex align-items-center">
                                <i class="fas fa-phone-alt text-primary me-2"></i>
                                <span>Free Consultation</span>
                            </div>
                            <div class="feature-item d-flex align-items-center">
                                <i class="fas fa-clock text-primary me-2"></i>
                                <span>24/7 Support</span>
                            </div>
                            <div class="feature-item d-flex align-items-center">
                                <i class="fas fa-users text-primary me-2"></i>
                                <span>Expert Team</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 text-center">
                    <div class="cta-actions">
                        <a href="/contact" class="btn btn-primary btn-lg mb-3 w-100">
                            <i class="fas fa-comments me-2"></i>
                            Ask a Question
                        </a>
                        <a href="/services" class="btn btn-outline-primary w-100">
                            <i class="fas fa-list me-2"></i>
                            View Services
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

 </main><!-- .site-main -->

<style>
/* FAQ Page Specific Styles */
.faq-hero {
    min-height: 80vh;
}

.hero-pattern {
    background: 
        radial-gradient(circle at 25% 25%, rgba(255, 255, 255, 0.1) 0%, transparent 50%),
        radial-gradient(circle at 75% 75%, rgba(255, 255, 255, 0.05) 0%, transparent 50%),
        url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23ffffff' fill-opacity='0.1'%3E%3Ccircle cx='30' cy='30' r='2'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
    animation: float 20s ease-in-out infinite;
}

.badge-faq {
    background: rgba(255, 255, 255, 0.15);
    color: white;
    padding: 0.5rem 1rem;
    border-radius: var(--border-radius-2xl);
    font-size: 0.9rem;
    font-weight: 600;
    /* blur removed for clarity */
    border: 1px solid rgba(255, 255, 255, 0.2);
}

.faq-search {
    max-width: 600px;
    margin: 0 auto;
}

.search-wrapper {
    position: relative;
}

.search-wrapper .form-control {
    background: rgba(255, 255, 255, 0.95);
    border: 2px solid rgba(255, 255, 255, 0.3);
    border-radius: var(--border-radius-2xl);
    padding: 1rem 3rem 1rem 1.5rem;
    font-size: 1.1rem;
    /* blur removed for clarity */
    color: var(--text-dark);
}

.search-wrapper .form-control:focus {
    border-color: var(--accent-color);
    box-shadow: 0 0 0 3px rgba(245, 158, 11, 0.2);
    outline: none;
}

.search-icon {
    position: absolute;
    right: 1.5rem;
    top: 50%;
    transform: translateY(-50%);
    color: var(--text-light);
    font-size: 1.2rem;
}

.hero-stats {
    display: flex;
    gap: 2rem;
    margin-top: 2rem;
}

.hero-stats .stat-item {
    text-align: center;
}

.hero-stats .stat-number {
    font-size: 2rem;
    font-weight: 900;
    color: var(--accent-color);
    line-height: 1;
    text-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
}

.hero-stats .stat-label {
    font-size: 0.9rem;
    opacity: 0.9;
    font-weight: 500;
}

.category-filters {
    background: var(--bg-white);
    padding: 1rem;
    border-radius: var(--border-radius-2xl);
    box-shadow: var(--shadow-sm);
    border: 1px solid var(--border-light);
}

.category-btn {
    background: transparent;
    border: 2px solid var(--border-light);
    color: var(--text-medium);
    padding: 0.5rem 1rem;
    border-radius: var(--border-radius-lg);
    font-weight: 600;
    font-size: 0.9rem;
    transition: all 0.3s ease;
    cursor: pointer;
}

.category-btn:hover,
.category-btn.active {
    background: var(--primary-color);
    border-color: var(--primary-color);
    color: white;
    transform: translateY(-2px);
    box-shadow: var(--shadow-md);
}

.faq-section {
    margin-bottom: 3rem;
}

.faq-section .section-title {
    color: var(--primary-color);
    font-weight: 800;
    margin-bottom: 2rem;
    padding-bottom: 0.5rem;
    border-bottom: 3px solid var(--primary-lighter);
    position: relative;
}

.faq-section .section-title::after {
    content: '';
    position: absolute;
    bottom: -3px;
    left: 0;
    width: 60px;
    height: 3px;
    background: var(--gradient-accent);
    border-radius: 2px;
}

.faq-item {
    background: var(--bg-white);
    border: 1px solid var(--border-light);
    border-radius: var(--border-radius-xl);
    margin-bottom: 1rem;
    overflow: hidden;
    transition: all 0.3s ease;
    box-shadow: var(--shadow-sm);
}

.faq-item:hover {
    box-shadow: var(--shadow-md);
    border-color: var(--primary-light);
}

.faq-header {
    padding: 1.5rem 2rem;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: space-between;
    transition: all 0.3s ease;
    user-select: none;
}

.faq-header:hover {
    background: var(--bg-section);
}

.faq-question {
    color: var(--text-dark);
    font-weight: 700;
    margin: 0;
    font-size: 1.1rem;
    flex: 1;
    padding-right: 1rem;
}

.faq-icon {
    color: var(--primary-color);
    font-size: 1.2rem;
    transition: all 0.3s ease;
    cursor: pointer;
    padding: 0.25rem;
    border-radius: 50%;
    user-select: none;
}

.faq-icon:hover {
    background: rgba(59, 78, 162, 0.1);
    transform: scale(1.1);
}

.faq-header[aria-expanded="true"] .faq-icon {
    transform: rotate(45deg);
}

.faq-header[aria-expanded="true"] .faq-icon:hover {
    transform: rotate(45deg) scale(1.1);
}

/* Professional Fade + Slide Animation */
.collapse {
    max-height: 0;
    overflow: hidden;
    opacity: 0;
    transform: translateY(-10px);
    transition: max-height 0.4s cubic-bezier(0.4, 0, 0.2, 1),
                opacity 0.3s ease 0.1s,
                transform 0.3s ease 0.1s;
}

.collapse.show {
    max-height: 1000px; /* Generous height for content */
    opacity: 1;
    transform: translateY(0);
    transition: max-height 0.5s cubic-bezier(0.4, 0, 0.2, 1),
                opacity 0.4s ease 0.05s,
                transform 0.4s ease 0.05s;
}

.faq-answer {
    padding: 0 2rem 2rem;
    color: var(--text-medium);
    line-height: 1.7;
}

/* Subtle content staggering for premium feel */
.collapse.show .faq-answer > *:nth-child(1) {
    animation: fadeInUp 0.4s ease 0.1s both;
}

.collapse.show .faq-answer > *:nth-child(2) {
    animation: fadeInUp 0.4s ease 0.15s both;
}

.collapse.show .faq-answer > *:nth-child(3) {
    animation: fadeInUp 0.4s ease 0.2s both;
}

@keyframes fadeInUp {
    from {
        opacity: 0;
        transform: translateY(8px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

/* Respect user motion preferences */
@media (prefers-reduced-motion: reduce) {
    .collapse,
    .collapse.show,
    .faq-answer,
    .collapse.show .faq-answer > * {
        transition: none !important;
        animation: none !important;
        transform: none !important;
    }
}

.faq-answer p {
    margin-bottom: 1rem;
}

.faq-answer ul {
    margin: 1rem 0;
    padding-left: 1.5rem;
}

.faq-answer li {
    margin-bottom: 0.5rem;
}

.faq-answer a {
    color: var(--primary-color);
    text-decoration: none;
    font-weight: 600;
}

.faq-answer a:hover {
    color: var(--primary-dark);
    text-decoration: underline;
}

.country-list {
    display: flex;
    flex-direction: column;
    gap: 0.75rem;
    margin: 1rem 0;
}

.country-group {
    padding: 0.75rem;
    background: var(--bg-section);
    border-radius: var(--border-radius);
    border-left: 4px solid var(--primary-color);
}

.services-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: 0.75rem;
    margin: 1rem 0;
}

.service-item {
    background: var(--bg-section);
    padding: 0.75rem;
    border-radius: var(--border-radius);
    text-align: center;
    font-weight: 600;
    border: 1px solid var(--border-light);
}

.pricing-options {
    display: flex;
    flex-direction: column;
    gap: 1rem;
    margin: 1rem 0;
}

.pricing-item {
    background: var(--bg-section);
    padding: 1rem;
    border-radius: var(--border-radius);
    border-left: 4px solid var(--success-color);
}

.process-steps {
    display: flex;
    flex-direction: column;
    gap: 1.5rem;
    margin: 1rem 0;
}

.process-step {
    display: flex;
    align-items: flex-start;
    gap: 1rem;
    background: var(--bg-section);
    padding: 1.5rem;
    border-radius: var(--border-radius-lg);
    border: 1px solid var(--border-light);
}

.step-number {
    width: 40px;
    height: 40px;
    background: var(--gradient-primary);
    color: white;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: 700;
    font-size: 1.1rem;
    flex-shrink: 0;
}

.step-content h5 {
    color: var(--text-dark);
    font-weight: 700;
    margin-bottom: 0.5rem;
}

.step-content p {
    color: var(--text-light);
    margin: 0;
    font-size: 0.95rem;
}

.timeline-examples {
    display: flex;
    flex-direction: column;
    gap: 0.75rem;
    margin: 1rem 0;
}

.timeline-item {
    background: var(--bg-section);
    padding: 1rem;
    border-radius: var(--border-radius);
    border-left: 4px solid var(--secondary-color);
}

.contact-methods {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 1rem;
    margin: 1rem 0;
}

.contact-method {
    display: flex;
    align-items: flex-start;
    gap: 1rem;
    background: var(--bg-section);
    padding: 1.5rem;
    border-radius: var(--border-radius-lg);
    border: 1px solid var(--border-light);
}

.contact-method i {
    color: var(--primary-color);
    font-size: 1.5rem;
    margin-top: 0.25rem;
}

.contact-method strong {
    color: var(--text-dark);
    display: block;
    margin-bottom: 0.25rem;
}

.contact-method p {
    color: var(--text-light);
    margin: 0;
    font-size: 0.9rem;
}

.no-results {
    background: var(--bg-white);
    border-radius: var(--border-radius-2xl);
    padding: 3rem;
    border: 1px solid var(--border-light);
    box-shadow: var(--shadow-sm);
}

.no-results-icon {
    margin-bottom: 1.5rem;
}

.questions-cta {
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
    .faq-hero {
        min-height: 70vh;
    }
    
    .hero-stats {
        justify-content: center;
        gap: 1rem;
    }
    
    .category-filters {
        padding: 0.5rem;
    }
    
    .category-btn {
        padding: 0.4rem 0.8rem;
        font-size: 0.8rem;
    }
    
    .faq-header {
        padding: 1rem 1.5rem;
    }
    
    .faq-answer {
        padding: 0 1.5rem 1.5rem;
    }
    
    .faq-question {
        font-size: 1rem;
    }
    
    .services-grid {
        grid-template-columns: 1fr;
    }
    
    .process-step {
        flex-direction: column;
        text-align: center;
        gap: 1rem;
    }
    
    .contact-methods {
        grid-template-columns: 1fr;
    }
    
    .cta-features {
        justify-content: center;
        gap: 1rem !important;
    }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Search functionality
    const searchInput = document.getElementById('faqSearch');
    const faqItems = document.querySelectorAll('.faq-item');
    const faqSections = document.querySelectorAll('.faq-section');
    const noResults = document.getElementById('noResults');
    
    searchInput.addEventListener('input', function(e) {
        const searchTerm = e.target.value.toLowerCase();
        let hasResults = false;
        
        faqItems.forEach(item => {
            const question = item.querySelector('.faq-question').textContent.toLowerCase();
            const answer = item.querySelector('.faq-answer').textContent.toLowerCase();
            
            if (question.includes(searchTerm) || answer.includes(searchTerm)) {
                item.style.display = 'block';
                hasResults = true;
            } else {
                item.style.display = 'none';
            }
        });
        
        // Show/hide sections based on results
        faqSections.forEach(section => {
            const visibleItems = section.querySelectorAll('.faq-item[style="display: block"], .faq-item:not([style*="display: none"])');
            section.style.display = visibleItems.length > 0 ? 'block' : 'none';
        });
        
        // Show/hide no results message
        noResults.style.display = hasResults ? 'none' : 'block';
    });
    
    // Category filtering
    const categoryButtons = document.querySelectorAll('.category-btn');
    
    categoryButtons.forEach(button => {
        button.addEventListener('click', function() {
            // Update active button
            categoryButtons.forEach(btn => btn.classList.remove('active'));
            this.classList.add('active');
            
            const category = this.dataset.category;
            
            // Show/hide sections based on category
            faqSections.forEach(section => {
                if (category === 'all' || section.dataset.category === category) {
                    section.style.display = 'block';
                } else {
                    section.style.display = 'none';
                }
            });
            
            // Reset search
            searchInput.value = '';
            faqItems.forEach(item => item.style.display = 'block');
            noResults.style.display = 'none';
        });
    });
    
    // Accordion functionality
    const faqHeaders = document.querySelectorAll('.faq-header');
    const faqIcons = document.querySelectorAll('.faq-icon');
    
    // Initialize all FAQ headers with proper aria-expanded state
    faqHeaders.forEach(header => {
        if (!header.hasAttribute('aria-expanded')) {
            header.setAttribute('aria-expanded', 'false');
        }
    });
    
    // Function to toggle FAQ item
    function toggleFaqItem(header) {
        const targetId = header.dataset.target;
        const targetElement = document.querySelector(targetId);
        const icon = header.querySelector('.faq-icon');
        
        // Check current state
        const isCurrentlyExpanded = targetElement.classList.contains('show');
        
        if (isCurrentlyExpanded) {
            // Close this item
            targetElement.classList.remove('show');
            header.setAttribute('aria-expanded', 'false');
            icon.style.transform = 'rotate(0deg)';
        } else {
            // Close all other open items first
            document.querySelectorAll('.collapse.show').forEach(openItem => {
                openItem.classList.remove('show');
                const openHeader = document.querySelector(`[data-target="#${openItem.id}"]`);
                if (openHeader) {
                    openHeader.setAttribute('aria-expanded', 'false');
                    openHeader.querySelector('.faq-icon').style.transform = 'rotate(0deg)';
                }
            });
            
            // Open this item
            targetElement.classList.add('show');
            header.setAttribute('aria-expanded', 'true');
            icon.style.transform = 'rotate(45deg)';
        }
    }
    
    // Add event listeners to headers
    faqHeaders.forEach(header => {
        header.addEventListener('click', function(e) {
            e.preventDefault();
            e.stopPropagation();
            toggleFaqItem(this);
        });
    });
    
    // Add specific event listeners to icons to ensure they work
    faqIcons.forEach(icon => {
        icon.addEventListener('click', function(e) {
            e.preventDefault();
            e.stopPropagation();
            const header = this.closest('.faq-header');
            if (header) {
                toggleFaqItem(header);
            }
        });
    });
    
    // Scroll animations
    const observerOptions = {
        threshold: 0.1,
        rootMargin: '0px 0px -50px 0px'
    };
    
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('animate-in');
            }
        });
    }, observerOptions);
    
    // Observe elements
    const elementsToAnimate = document.querySelectorAll('.hero-content, .faq-section, .questions-cta');
    elementsToAnimate.forEach(element => {
        element.classList.add('animate-on-scroll');
        observer.observe(element);
    });
});

// Clear search function
function clearSearch() {
    const searchInput = document.getElementById('faqSearch');
    const faqItems = document.querySelectorAll('.faq-item');
    const faqSections = document.querySelectorAll('.faq-section');
    const noResults = document.getElementById('noResults');
    
    searchInput.value = '';
    faqItems.forEach(item => item.style.display = 'block');
    faqSections.forEach(section => section.style.display = 'block');
    noResults.style.display = 'none';
    
    // Reset to "All Questions" category
    document.querySelectorAll('.category-btn').forEach(btn => btn.classList.remove('active'));
    document.querySelector('.category-btn[data-category="all"]').classList.add('active');
}
</script>

<?php
get_footer(); 
get_footer(); 
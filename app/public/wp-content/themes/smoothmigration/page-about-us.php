<?php
/**
 * About Us Page Template
 * Modern about us page with team showcase and company story
 * Template Name: About Us
 *
 * @package smoothmigration
 */

/**
 * Get team member image by searching Media Library for filename/title.
 * - Accepts a string or an array of preferred search terms (first match wins)
 * - Prefers newest uploads by ordering by date DESC
 * - Debug: add ?sm_debug_team=1 to the URL to output HTML comments with match info
 */
function get_team_member_image($search_terms, $alt_text = '', $class = 'team-image') {
    $debug = isset($_GET['sm_debug_team']);
    if (!is_array($search_terms)) {
        $search_terms = array($search_terms);
    }

    foreach ($search_terms as $term) {
        // Primary: search by file path (filename in _wp_attached_file)
        $attachments = get_posts(array(
            'post_type' => 'attachment',
            'post_mime_type' => 'image',
            'post_status' => 'inherit',
            'posts_per_page' => 1,
            'orderby' => 'date',
            'order' => 'DESC',
            'meta_query' => array(
                array(
                    'key' => '_wp_attached_file',
                    'value' => $term,
                    'compare' => 'LIKE',
                ),
            ),
            'suppress_filters' => false,
        ));

        // Secondary: search by attachment title if not found by file path
        if (empty($attachments)) {
            $attachments = get_posts(array(
                'post_type' => 'attachment',
                'post_mime_type' => 'image',
                'post_status' => 'inherit',
                'posts_per_page' => 1,
                'orderby' => 'date',
                'order' => 'DESC',
                's' => $term,
                'suppress_filters' => false,
            ));
        }

        if (!empty($attachments)) {
            $attachment = $attachments[0];
            $image_url = wp_get_attachment_image_url($attachment->ID, 'full');
            if ($debug) {
                echo "\n<!-- sm_debug_team: term='" . esc_html($term) . "' matched attachment ID " . intval($attachment->ID) . " url=" . esc_url($image_url) . " -->\n";
            }
            if ($image_url) {
                return '<img src="' . esc_url($image_url) . '" alt="' . esc_attr($alt_text) . '" class="' . esc_attr($class) . '" />';
            }
        } else {
            if ($debug) {
                echo "\n<!-- sm_debug_team: term='" . esc_html($term) . "' not found -->\n";
            }
        }
    }

    // Fallback: return placeholder if image not found
    return '<div class="photo-placeholder"><i class="fas fa-user"></i></div>';
}

get_header();
?>

<main id="main" class="site-main about-page" role="main" tabindex="-1">

    <!-- Hero Section -->
    <section class="about-hero py-6 bg-gradient-primary text-white position-relative overflow-hidden">
        <div class="container position-relative z-2">
            <div class="row align-items-center min-vh-75">
                <div class="col-lg-7">
                    <div class="hero-content animate-on-scroll">
                        <div class="hero-badge mb-4">
                            <span class="badge-about"><?php echo sm_icon('earth-americas', 'solid', 'me-2 icon'); ?> Our Story</span>
                        </div>
                        <h1 class="display-2 fw-bold mb-4">About Smooth Migration</h1>
                        <p class="lead fs-4 mb-4 opacity-90">Founded by global professionals who have navigated international relocations across multiple continents.<br />We bring decades of real-world experience to make your move seamless.</p>
                        
                        <div class="hero-stats d-flex flex-wrap gap-4 mb-4">
                            <div class="stat-item">
                                <div class="stat-number">2021</div>
                                <div class="stat-label">Founded in</div>
                            </div>
                            <div class="stat-item">
                                <div class="stat-number">15+</div>
                                <div class="stat-label">Countries Lived</div>
                            </div>
                            <div class="stat-item">
                                <div class="stat-number">35+</div>
                                <div class="stat-label">Years Experience</div>
                            </div>
                        </div>
                        
                        <div class="hero-cta">
                            <a href="#team" class="btn btn-outline-light btn-lg">
                                <i class="fas fa-users me-2" aria-hidden="true"></i>
                                Meet the Team
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-5">
                    <div class="hero-visual animate-on-scroll" style="animation-delay: 0.3s;">
                        <div class="about-graphic">
                            <div class="world-connections">
                                <div class="central-hub">
                                    <i class="fas fa-home display-3 text-accent"></i>
                                </div>
                                <div class="connection-lines"></div>
                                <div class="location-dots" aria-hidden="true">
                                    <div class="dot dot-1" data-location="Checklist"><i class="fas fa-clipboard-check" aria-hidden="true"></i></div>
                                    <div class="dot dot-2" data-location="Keys"><i class="fas fa-key" aria-hidden="true"></i></div>
                                    <div class="dot dot-3" data-location="Moving Boxes"><i class="fas fa-box" aria-hidden="true"></i></div>
                                    <div class="dot dot-4" data-location="Visa"><i class="fas fa-passport" aria-hidden="true"></i></div>
                                    <div class="dot dot-5" data-location="SIM"><i class="fas fa-sim-card" aria-hidden="true"></i></div>
                                    <div class="dot dot-6" data-location="Banking"><i class="fas fa-landmark" aria-hidden="true"></i></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Background Pattern -->
        <div class="hero-pattern position-absolute top-0 start-0 w-100 h-100 opacity-10"></div>
        <!-- Scroll cue -->
        <div class="scroll-cue" aria-hidden="true">
            <span class="scroll-text">Scroll</span>
            <div class="scroll-arrow">
                <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                    <path d="M12 4v14m0 0l-5-5m5 5l5-5" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            </div>
        </div>
    </section>

    <!-- Our Story Section -->
    <section id="our-story" class="our-story py-6">
        <div class="container">
            <div class="row justify-content-center mb-5">
                <div class="col-lg-8 text-center">
                    <h2 class="section-title">Our Story</h2>
                    <p class="section-subtitle">Born from personal experience across four continents, Smooth Migration was founded to solve the challenges we faced ourselves.</p>
                </div>
            </div>
            
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <div class="story-content animate-on-scroll">
                        <div class="story-timeline">
                            <div class="timeline-item">
                                <div class="timeline-marker">
                                    <i class="fas fa-lightbulb"></i>
                                </div>
                                <div class="timeline-content">
                                    <h4>The Experience</h4>
                                    <p>Our founder's journey spans four countries - from South Africa to England at 17, becoming one of the youngest foreigners licensed before the Supreme Court in London, then to the USA in 2019 where Smooth Migration was born.</p>
                                </div>
                            </div>
                            
                            <div class="timeline-item">
                                <div class="timeline-marker">
                                    <i class="fas fa-rocket"></i>
                                </div>
                                <div class="timeline-content">
                                    <h4>The Vision</h4>
                                    <p>Drawing from 35+ years of work experience across multiple countries and industries, we realized the need for a comprehensive relocation service that truly understands the newcomer experience.</p>
                                </div>
                            </div>
                            
                            <div class="timeline-item">
                                <div class="timeline-marker">
                                    <i class="fas fa-globe"></i>
                                </div>
                                <div class="timeline-content">
                                    <h4>The Team</h4>
                                    <p>Today, our team of international professionals across North America, Southern Africa, and the UK brings collective experience from over 15 countries to help families navigate their relocation journey with confidence.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="story-visual animate-on-scroll" style="animation-delay: 0.3s;">
                        <div class="story-stats-grid">
                            <div class="story-stat">
                                <div class="stat-icon">
                                    <i class="fas fa-globe"></i>
                                </div>
                                <div class="stat-details">
                                    <h3>15+</h3>
                                    <p>Countries Lived In</p>
                                </div>
                            </div>
                            <div class="story-stat">
                                <div class="stat-icon">
                                    <i class="fas fa-briefcase"></i>
                                </div>
                                <div class="stat-details">
                                    <h3>60+</h3>
                                    <p>Years Combined Experience</p>
                                </div>
                            </div>
                            <div class="story-stat">
                                <div class="stat-icon">
                                    <i class="fas fa-language"></i>
                                </div>
                                <div class="stat-details">
                                    <h3>5+</h3>
                                    <p>Languages Spoken</p>
                                </div>
                            </div>
                            <div class="story-stat">
                                <div class="stat-icon">
                                    <i class="fas fa-award"></i>
                                </div>
                                <div class="stat-details">
                                    <h3>4</h3>
                                    <p>Regional Experts</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Our Values Section -->
    <section class="our-values py-6 bg-light">
        <div class="container">
            <div class="row justify-content-center mb-5">
                <div class="col-lg-8 text-center">
                    <h2 class="section-title">Our Values</h2>
                    <p class="section-subtitle">The principles that guide everything we do.</p>
                </div>
            </div>
            
            <div class="row g-4">
                <div class="col-lg-4 col-md-6">
                    <div class="value-card animate-on-scroll">
                        <div class="value-icon">
                            <i class="fas fa-heart"></i>
                        </div>
                        <h3 class="value-title">Empathy First</h3>
                        <p class="value-description">We understand the emotional and practical challenges of international relocation because we've been there ourselves.</p>
                    </div>
                </div>
                
                <div class="col-lg-4 col-md-6">
                    <div class="value-card animate-on-scroll" style="animation-delay: 0.2s;">
                        <div class="value-icon bg-secondary">
                            <i class="fas fa-shield-alt"></i>
                        </div>
                        <h3 class="value-title">Trust & Transparency</h3>
                        <p class="value-description">We maintain complete transparency in our processes and only work with thoroughly vetted, trusted partners.</p>
                    </div>
                </div>
                
                <div class="col-lg-4 col-md-6">
                    <div class="value-card animate-on-scroll" style="animation-delay: 0.4s;">
                        <div class="value-icon bg-success">
                            <i class="fas fa-lightbulb"></i>
                        </div>
                        <h3 class="value-title">Innovation</h3>
                        <p class="value-description">We continuously improve our platform and services using data insights and customer feedback.</p>
                    </div>
                </div>
                
                <div class="col-lg-4 col-md-6">
                    <div class="value-card animate-on-scroll" style="animation-delay: 0.1s;">
                        <div class="value-icon bg-warning">
                            <i class="fas fa-hands-helping"></i>
                        </div>
                        <h3 class="value-title">Support</h3>
                        <p class="value-description">Our commitment doesn't end when you arrive. We provide ongoing support throughout your relocation journey.</p>
                    </div>
                </div>
                
                <div class="col-lg-4 col-md-6">
                    <div class="value-card animate-on-scroll" style="animation-delay: 0.3s;">
                        <div class="value-icon bg-info">
                            <i class="fas fa-globe"></i>
                        </div>
                        <h3 class="value-title">Global Perspective</h3>
                        <p class="value-description">Our international team brings diverse cultural perspectives and local expertise to every relocation.</p>
                    </div>
                </div>
                
                <div class="col-lg-4 col-md-6">
                    <div class="value-card animate-on-scroll" style="animation-delay: 0.5s;">
                        <div class="value-icon bg-danger">
                            <i class="fas fa-medal"></i>
                        </div>
                        <h3 class="value-title">Excellence</h3>
                        <p class="value-description">We strive for excellence in every interaction, service delivery, and customer experience.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Team Section -->
    <section id="team" class="our-team py-6">
        <div class="container">
            <div class="row justify-content-center mb-5">
                <div class="col-lg-8 text-center">
                    <h2 class="section-title">Meet Our Team</h2>
                    <p class="section-subtitle">Experienced international professionals who have lived and worked across the globe.</p>
                </div>
            </div>
            
            <div class="row g-4">
                <div class="col-lg-4 col-md-6">
                    <div class="team-card animate-on-scroll">
                        <div class="team-photo">
                            <?php echo get_team_member_image('Grant', 'Grant Sakinofsky'); ?>
                            <div class="team-social">
                                <a href="#" class="social-link" aria-label="Grant Sakinofsky on LinkedIn"><i class="fab fa-linkedin" aria-hidden="true"></i></a>
                                <a href="#" class="social-link" aria-label="Email Grant Sakinofsky"><i class="fas fa-envelope" aria-hidden="true"></i></a>
                            </div>
                        </div>
                        <div class="team-info">
                            <h4 class="team-name">Grant Sakinofsky</h4>
                            <p class="team-role">Founder & Director</p>
                            <p class="team-description">Grant's journey began early — working since age 8, he graduated at 17 and used his savings to move to England, where he became one of the youngest foreigners in recent British history to be licensed before the Supreme Court in London.</p>
                            <p class="team-description">A former national age group champion in springboard diving, provincial gymnast, and rock climber, Grant brings both athletic discipline and legal precision to international relocation.</p>
                            <p class="team-description">After excelling across South Africa and England, Grant moved to the USA in 2019 where he got licensed in real estate and founded Smooth Migration. In 2022, he relocated to Canada, earning additional qualifications from UBC and becoming one of the only non-US, non-Canadian citizens to hold real estate licenses in both countries.</p>
                            <p class="team-description">Currently serving on a Canadian non-profit board, Grant's 35+ years span four countries and multiple industries.</p>
                            <div class="team-expertise">
                                <span class="expertise-tag">Internationally Qualified Across Multiple Industries</span>
                                <span class="expertise-tag">Dual Real Estate Licenses</span>
                                <span class="expertise-tag">Former National Athlete</span>
                                <span class="expertise-tag">Non-Profit Director</span>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="col-lg-4 col-md-6">
                    <div class="team-card animate-on-scroll" style="animation-delay: 0.2s;">
                        <div class="team-photo">
                            <?php echo get_team_member_image(array('Erin-about', 'Erin Copeland', 'Erin'), 'Erin Copeland'); ?>
                            <div class="team-social">
                                <a href="#" class="social-link" aria-label="Connect on LinkedIn"><i class="fab fa-linkedin" aria-hidden="true"></i></a>
                                <a href="#" class="social-link" aria-label="Send email"><i class="fas fa-envelope" aria-hidden="true"></i></a>
                            </div>
                        </div>
                        <div class="team-info">
                            <h4 class="team-name">Erin Copeland</h4>
                            <p class="team-role">Operations Manager - North America</p>
                            <p class="team-description">Erin is a true veteran of international living, having navigated relocations across seven different countries.</p>
                            <p class="team-description">Her unique background as a former Science and Biology teacher gives her exceptional organizational skills and attention to detail that prove invaluable in managing complex relocations.</p>
                            <p class="team-description">With teaching qualifications from the University of Waterloo in Canada and a Master’s in Education from Griffith University in Australia, Erin combines academic rigor with practical experience.</p>
                            <p class="team-description">She ran an established online tutoring company serving clients across multiple countries, demonstrating her ability to manage international operations and cross-cultural communication.</p>
                            <p class="team-description">Her strong background in logistics, organization, and communication makes her the perfect bridge between our clients and their new destinations.</p>
                            <div class="team-expertise">
                                <span class="expertise-tag">7 Countries Experience</span>
                                <span class="expertise-tag">Master’s in Education</span>
                                <span class="expertise-tag">International Tutoring</span>
                                <span class="expertise-tag">Logistics Expert</span>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="col-lg-4 col-md-6">
                    <div class="team-card animate-on-scroll" style="animation-delay: 0.4s;">
                        <div class="team-photo">
                            <?php echo get_team_member_image('Christian', 'Christian Harmbeck'); ?>
                            <div class="team-social">
                                <a href="#" class="social-link" aria-label="Connect on LinkedIn"><i class="fab fa-linkedin" aria-hidden="true"></i></a>
                                <a href="#" class="social-link" aria-label="Send email"><i class="fas fa-envelope" aria-hidden="true"></i></a>
                            </div>
                        </div>
                        <div class="team-info">
                            <h4 class="team-name">Christian Harmbeck</h4>
                            <p class="team-role">Operations Manager - Southern Africa</p>
                            <p class="team-description">Christian brings a wealth of international business expertise, having lived and worked across several countries while mastering three languages.</p>
                            <p class="team-description">As a driven business leader with a remarkable 25+ year track record, he has successfully scaled profitable companies and achieved successful exits across hospitality, retail and other sectors.</p>
                            <p class="team-description">As a globally certified business and executive coach, Christian excels at empowering teams and business owners to reach their full potential.</p>
                            <p class="team-description">He's a versatile business generalist who specializes in systemizing workflows and creating independent, self-sustaining operations.</p>
                            <p class="team-description">His passion lies in driving organizational success through empowered teams, streamlined processes, and deep industry-specific knowledge.</p>
                            <p class="team-description">Christian's strength in building robust customer relations and fostering positive company cultures makes him invaluable for clients navigating new business environments.</p>
                            <div class="team-expertise">
                                <span class="expertise-tag">Trilingual</span>
                                <span class="expertise-tag">Certified Executive Coach</span>
                                <span class="expertise-tag">Successful Exits</span>
                                <span class="expertise-tag">Workflow Systems</span>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="col-lg-4 col-md-6">
                    <div class="team-card animate-on-scroll" style="animation-delay: 0.1s;">
                        <div class="team-photo">
                            <?php echo get_team_member_image(array('Rob-about', 'Robert Wood', 'Rob'), 'Robert Wood'); ?>
                            <div class="team-social">
                                <a href="#" class="social-link" aria-label="Connect on LinkedIn"><i class="fab fa-linkedin" aria-hidden="true"></i></a>
                                <a href="#" class="social-link" aria-label="Send email"><i class="fas fa-envelope" aria-hidden="true"></i></a>
                            </div>
                        </div>
                        <div class="team-info">
                            <h4 class="team-name">Robert Wood</h4>
                            <p class="team-role">Operations Manager - United Kingdom</p>
                            <p class="team-description">Originally from Australia, Robert has made the United Kingdom his home for over 20 years, working extensively across both England and Scotland with a focus on customer-facing roles.</p>
                            <p class="team-description">His international perspective expanded further during his time in Italy, where he provided ongoing business support to locally based companies, gaining invaluable insight into European business culture.</p>
                            <p class="team-description">With over two decades of experience spanning Hospitality, New Business Development, and Customer Relations, Robert has developed an exceptional ability to connect with people from all backgrounds.</p>
                            <p class="team-description">As a highly skilled customer relations expert and experienced marketing professional, he brings his own unique flair to everything he does.</p>
                            <p class="team-description">His deep understanding of what it means to build a life in a new country, combined with his natural talent for making people feel at ease, makes him the perfect advocate for our UK-bound clients.</p>
                            <div class="team-expertise">
                                <span class="expertise-tag">20+ Years of UK Experience</span>
                                <span class="expertise-tag">Cross-European Business</span>
                                <span class="expertise-tag">Customer Relations Expert</span>
                                <span class="expertise-tag">Marketing Professional</span>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- Mission & Vision -->
    <section class="mission-vision py-6 bg-gradient-secondary text-white">
        <div class="container">
            <div class="row g-5">
                <div class="col-lg-6">
                    <div class="mission-content animate-on-scroll">
                        <div class="content-icon">
                            <i class="fas fa-bullseye display-3 text-accent"></i>
                        </div>
                        <h3 class="content-title">Our Mission</h3>
                        <p class="content-description">To leverage our team's collective 60+ years of international living and working experience to eliminate the stress and complexity of relocation for professionals and families worldwide.</p>
                        <div class="mission-points">
                            <div class="point-item">
                                <i class="fas fa-check-circle text-accent"></i>
                                <span>Draw from real expat experience</span>
                            </div>
                            <div class="point-item">
                                <i class="fas fa-check-circle text-accent"></i>
                                <span>Provide expert regional knowledge</span>
                            </div>
                            <div class="point-item">
                                <i class="fas fa-check-circle text-accent"></i>
                                <span>Deliver comprehensive relocation solutions</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="vision-content animate-on-scroll" style="animation-delay: 0.3s;">
                        <div class="content-icon">
                            <i class="fas fa-eye display-3 text-accent"></i>
                        </div>
                        <h3 class="content-title">Our Vision</h3>
                        <p class="content-description">To be the leading relocation service powered by professionals who have lived the expat experience, providing unmatched expertise and genuine understanding of international moves.</p>
                        <div class="vision-goals">
                            <div class="goal-item">
                                <div class="goal-number">4</div>
                                <div class="goal-label">Key Regions</div>
                            </div>
                            <div class="goal-item">
                                <div class="goal-number">15+</div>
                                <div class="goal-label">Countries Experienced</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Contact CTA -->
    <section class="contact-cta py-6">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-8">
                    <div class="cta-content">
                        <h2 class="display-5 fw-bold mb-3">Ready to Start Your Journey?</h2>
                        <p class="lead mb-4">Work with professionals who have lived the expat experience across four continents. Let our personal knowledge guide your successful relocation.</p>
                        <div class="cta-features d-flex flex-wrap gap-4">
                            <div class="feature-item d-flex align-items-center">
                                <i class="fas fa-star text-primary me-2"></i>
                                <span>Superior Service</span>
                            </div>
                            <div class="feature-item d-flex align-items-center">
                                <i class="fas fa-tags text-primary me-2"></i>
                                <span>Superior Pricing</span>
                            </div>
                            <div class="feature-item d-flex align-items-center">
                                <i class="fas fa-microchip text-primary me-2"></i>
                                <span>Superior Technology</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 text-center">
                    <div class="cta-actions">
                        <a href="/contact" class="btn btn-primary btn-lg mb-3 w-100">
                            <i class="fas fa-comments me-2"></i>
                            Get in Touch
                        </a>
                        <a href="/services" class="btn btn-outline-primary w-100">
                            <i class="fas fa-list me-2"></i>
                            View Our Services
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

</main><!-- .site-main -->

<style>
/* About Page Specific Styles */
.about-hero {
    min-height: 100vh;
}

/* Prevent hero H1 clipping at some viewports */
.about-hero h1.display-2 {
    line-height: 1.15;
}

.hero-pattern {
    background: 
        radial-gradient(circle at 25% 25%, rgba(255, 255, 255, 0.1) 0%, transparent 50%),
        radial-gradient(circle at 75% 75%, rgba(255, 255, 255, 0.05) 0%, transparent 50%),
        url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23ffffff' fill-opacity='0.1'%3E%3Ccircle cx='30' cy='30' r='2'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
    animation: float 20s ease-in-out infinite;
}

.badge-about {
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

.hero-stats {
    display: flex;
    gap: 2rem;
    margin: 2rem 0;
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

.about-graphic {
    display: flex;
    justify-content: center;
    align-items: center;
    height: 400px;
    position: relative;
}

.world-connections {
    position: relative;
    width: 300px;
    height: 300px;
}

.central-hub {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    width: 80px;
    height: 80px;
    background: var(--bg-white);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    box-shadow: var(--shadow-2xl);
    z-index: 2;
}

.location-dots {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
}

.dot {
    position: absolute;
    width: 50px;
    height: 50px;
    background: var(--bg-white);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.5rem;
    box-shadow: var(--shadow-lg);
    animation: float-dot 4s ease-in-out infinite;
    cursor: pointer;
    transition: transform 0.3s ease;
}

.dot:hover {
    transform: scale(1.2);
}

.dot-1 { top: 10px; left: 50%; transform: translateX(-50%); animation-delay: 0s; }
.dot-2 { top: 50%; right: 10px; transform: translateY(-50%); animation-delay: 0.8s; }
.dot-3 { bottom: 10px; right: 30%; animation-delay: 1.6s; }
.dot-4 { bottom: 10px; left: 30%; animation-delay: 2.4s; }
.dot-5 { top: 50%; left: 10px; transform: translateY(-50%); animation-delay: 3.2s; }

/* Additional relocation icon */
.dot-6 { top: 20%; left: 20%; animation-delay: 1.2s; }

@keyframes float-dot {
    0%, 100% { transform: translateY(0); }
    50% { transform: translateY(-10px); }
}

.story-timeline {
    position: relative;
    padding-left: 2rem;
}

.story-timeline::before {
    content: '';
    position: absolute;
    left: 20px;
    top: 0;
    bottom: 0;
    width: 3px;
    background: var(--gradient-primary);
    border-radius: 2px;
}

.timeline-item {
    display: flex;
    align-items: flex-start;
    margin-bottom: 3rem;
    position: relative;
}

.timeline-marker {
    width: 60px;
    height: 60px;
    background: var(--gradient-primary);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 1.5rem;
    box-shadow: var(--shadow-lg);
    margin-right: 2rem;
    flex-shrink: 0;
    position: relative;
    z-index: 2;
}

.timeline-content h4 {
    color: var(--text-dark);
    font-weight: 700;
    margin-bottom: 1rem;
    font-size: 1.3rem;
}

.timeline-content p {
    color: var(--text-light);
    line-height: 1.7;
    margin: 0;
}

.story-stats-grid {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 2rem;
}

.story-stat {
    background: var(--bg-white);
    padding: 2rem;
    border-radius: var(--border-radius-xl);
    box-shadow: var(--shadow-md);
    text-align: center;
    border: 1px solid var(--border-light);
    transition: all 0.3s ease;
}

.story-stat:hover {
    transform: translateY(-5px);
    box-shadow: var(--shadow-xl);
}

.stat-icon {
    width: 60px;
    height: 60px;
    background: var(--gradient-primary);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 1rem;
    color: white;
    font-size: 1.5rem;
}

.stat-details h3 {
    color: var(--primary-color);
    font-weight: 900;
    font-size: 2rem;
    margin-bottom: 0.5rem;
}

.stat-details p {
    color: var(--text-light);
    margin: 0;
    font-size: 0.9rem;
}

.value-card {
    background: var(--bg-white);
    padding: 3rem 2rem;
    border-radius: var(--border-radius-2xl);
    box-shadow: var(--shadow-sm);
    border: 1px solid var(--border-light);
    transition: all 0.4s ease;
    height: 100%;
    text-align: center;
}

.value-card:hover {
    transform: translateY(-8px);
    box-shadow: var(--shadow-2xl);
    background: var(--bg-section);
}

.value-icon {
    width: 80px;
    height: 80px;
    background: var(--gradient-primary);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 1.5rem;
    font-size: 2rem;
    color: white;
    box-shadow: var(--shadow-md);
}

.value-title {
    color: var(--text-dark);
    font-weight: 700;
    margin-bottom: 1rem;
    font-size: 1.3rem;
}

.value-description {
    color: var(--text-light);
    line-height: 1.6;
    margin: 0;
}

.team-card {
    background: var(--bg-white);
    border-radius: var(--border-radius-2xl);
    overflow: hidden;
    box-shadow: var(--shadow-sm);
    border: 1px solid var(--border-light);
    transition: all 0.4s ease;
    height: auto;
    min-height: 700px;
    display: flex;
    flex-direction: column;
}

.team-card:hover {
    transform: translateY(-8px);
    box-shadow: var(--shadow-2xl);
}

.team-photo {
    position: relative;
    /* Use portrait aspect ratio to reduce unwanted cropping on headshots */
    aspect-ratio: 4 / 5;
    height: auto;
    min-height: 280px;
    background: var(--bg-light);
    display: flex;
    align-items: center;
    justify-content: center;
    overflow: hidden;
    flex-shrink: 0;
}

.photo-placeholder {
    width: 120px;
    height: 120px;
    background: var(--gradient-primary);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 3rem;
    box-shadow: var(--shadow-lg);
}

.team-image {
    width: 100%;
    height: 100%;
    object-fit: cover;
    /* Bias framing slightly toward the top to keep faces visible */
    object-position: center 20%;
    border-radius: 0;
    transition: transform 0.3s ease;
}

.team-card:hover .team-image {
    transform: scale(1.02);
}

.team-social {
    position: absolute;
    bottom: 1rem;
    right: 1rem;
    display: flex;
    gap: 0.5rem;
    opacity: 0;
    transition: opacity 0.3s ease;
}

.team-card:hover .team-social {
    opacity: 1;
}

.social-link {
    width: 40px;
    height: 40px;
    background: var(--bg-white);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: var(--primary-color);
    text-decoration: none;
    box-shadow: var(--shadow-md);
    transition: all 0.3s ease;
}

.social-link:hover {
    background: var(--primary-color);
    color: white;
    transform: scale(1.1);
}

.team-info {
    padding: 2.5rem 2rem 2rem;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    flex-grow: 1;
}

.team-name {
    color: var(--text-dark);
    font-weight: 700;
    margin-bottom: 0.5rem;
    font-size: 1.3rem;
}

.team-role {
    color: var(--primary-color);
    font-weight: 600;
    margin-bottom: 1.5rem;
    font-size: 1rem;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.team-description {
    color: var(--text-light);
    line-height: 1.65;
    margin-bottom: 1rem;
    font-size: 0.92rem;
    flex-grow: 1;
}

.team-description:last-of-type {
    margin-bottom: 2rem;
}

.team-expertise {
    display: flex;
    flex-wrap: wrap;
    gap: 0.5rem;
    margin-top: auto;
    padding-top: 1rem;
}

.expertise-tag {
    background: var(--primary-lighter);
    color: var(--primary-color);
    padding: 0.4rem 1rem;
    border-radius: var(--border-radius-2xl);
    font-size: 0.75rem;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.3px;
    transition: all 0.3s ease;
}

.expertise-tag:hover {
    background: var(--primary-color);
    color: white;
    transform: translateY(-2px);
}

/* Enhanced paragraph spacing for team descriptions */
.team-description + .team-description {
    margin-top: 1.2rem;
}

/* Add subtle divider between multiple paragraphs */
.team-description:not(:last-of-type)::after {
    content: '';
    display: block;
    width: 30px;
    height: 2px;
    background: var(--primary-lighter);
    margin: 1rem 0 0.5rem 0;
    border-radius: 2px;
}

.mission-vision {
    background: var(--gradient-secondary) !important;
}

.content-icon {
    margin-bottom: 2rem;
}

.content-title {
    font-size: 2.5rem;
    font-weight: 800;
    margin-bottom: 1.5rem;
    color: white;
}

.content-description {
    font-size: 1.1rem;
    line-height: 1.7;
    opacity: 0.95;
    margin-bottom: 2rem;
}

.mission-points {
    display: flex;
    flex-direction: column;
    gap: 1rem;
}

.point-item {
    display: flex;
    align-items: center;
    gap: 1rem;
    font-size: 1.05rem;
    font-weight: 500;
}

.vision-goals {
    display: flex;
    gap: 3rem;
    margin-top: 2rem;
}

.goal-item {
    text-align: center;
}

.goal-number {
    font-size: 3rem;
    font-weight: 900;
    color: var(--accent-color);
    line-height: 1;
    text-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
}

.goal-label {
    font-size: 1rem;
    opacity: 0.9;
    font-weight: 600;
}

.contact-cta {
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
    .about-hero {
        min-height: 80vh;
        text-align: center;
    }
    
    .hero-stats {
        justify-content: center;
        gap: 1rem;
    }
    
    .about-graphic {
        height: 250px;
        margin-top: 2rem;
    }
    
    .world-connections {
        width: 200px;
        height: 200px;
    }
    
    .central-hub {
        width: 60px;
        height: 60px;
        font-size: 1.5rem;
    }
    
    .dot {
        width: 35px;
        height: 35px;
        font-size: 1rem;
    }
    
    .story-timeline {
        padding-left: 0;
    }
    
    .story-timeline::before {
        display: none;
    }
    
    .timeline-item {
        flex-direction: column;
        text-align: center;
        margin-bottom: 2rem;
    }
    
    .timeline-marker {
        margin-right: 0;
        margin-bottom: 1rem;
    }
    
    .story-stats-grid {
        grid-template-columns: 1fr;
        gap: 1rem;
    }
    
    .vision-goals {
        gap: 2rem;
        justify-content: center;
    }
    
    .cta-features {
        justify-content: center;
        gap: 1rem !important;
    }
    
    .team-card {
        min-height: auto;
    }
    
    .team-info {
        padding: 2rem 1.5rem 1.5rem;
        min-height: auto;
    }
    
    .team-photo {
        aspect-ratio: 4 / 5;
        height: auto;
        min-height: 220px;
    }
    
    .team-image {
        object-position: center 28%;
    }
    
    .team-name {
        font-size: 1.2rem;
    }
    
    .team-description {
        font-size: 0.9rem;
        line-height: 1.6;
    }
    
    .team-description:not(:last-of-type)::after {
        width: 20px;
        margin: 0.8rem 0 0.3rem 0;
    }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
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
    const elementsToAnimate = document.querySelectorAll('.hero-content, .hero-visual, .story-content, .story-visual, .value-card, .team-card, .mission-content, .vision-content');
    elementsToAnimate.forEach(element => {
        element.classList.add('animate-on-scroll');
        observer.observe(element);
    });
    
    // Location dot tooltips
    const dots = document.querySelectorAll('.dot');
    dots.forEach(dot => {
        dot.addEventListener('mouseenter', function() {
            const location = this.dataset.location;
            if (location) {
                // Create a simple tooltip effect
                this.setAttribute('title', location);
            }
        });
    });
    
    // Smooth scrolling for anchor links
    const anchorLinks = document.querySelectorAll('a[href^="#"]');
    anchorLinks.forEach(link => {
        link.addEventListener('click', function(e) {
            e.preventDefault();
            const targetId = this.getAttribute('href');
            const targetElement = document.querySelector(targetId);
            if (targetElement) {
                targetElement.scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });
            }
        });
    });
});
</script>

<?php
get_footer(); 
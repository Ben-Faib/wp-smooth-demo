<?php
/**
 * AI Relocator Page Template
 * Modern AI-powered relocation assistance page with futuristic design
 *
 * @package smoothmigration
 */

get_header();
?>

<main id="main" class="site-main ai-relocator-page" role="main">

    <!-- Coming Soon Banner -->
    <section class="coming-soon-banner">
        <div class="container">
            <div class="banner-content">
                <i class="fas fa-rocket me-2"></i>
                <span>COMING SOON</span>
                <i class="fas fa-rocket ms-2"></i>
            </div>
        </div>
    </section>

    <!-- Hero Section -->
    <section class="ai-hero py-6 bg-gradient-primary text-white position-relative overflow-hidden">
        <div class="container position-relative z-2">
            <div class="row align-items-center min-vh-100">
                <div class="col-lg-7">
                    <div class="hero-content animate-on-scroll">
                        <div class="hero-badge mb-4">
                            <span class="badge-ai"><?php echo sm_icon('robot', 'solid', 'me-2 icon'); ?> AI-Powered</span>
                        </div>
                        <h1 class="display-1 fw-bold mb-4">AI Relocator</h1>
                        <p class="lead fs-3 mb-4 opacity-90">Experience the future of international relocation with our intelligent AI assistant that personalizes your entire moving journey.</p>
                        
                        <div class="ai-features mb-4">
                            <div class="feature-highlight">
                                <i class="fas fa-brain me-2"></i>
                                <span>Smart Planning</span>
                            </div>
                            <div class="feature-highlight">
                                <i class="fas fa-robot me-2"></i>
                                <span>24/7 AI Assistant</span>
                            </div>
                            <div class="feature-highlight">
                                <i class="fas fa-chart-line me-2"></i>
                                <span>Predictive Analytics</span>
                            </div>
                        </div>
                        
                        <div class="hero-cta">
                            <div class="locked-button-container">
                                <button class="btn btn-locked btn-xl" disabled>
                                    <i class="fas fa-user-plus me-2"></i>
                                    Sign Up
                                </button>
                                <div class="lock-overlay">
                                    <i class="fas fa-lock"></i>
                                </div>
                            </div>
                        </div>
                        
                        <div class="launch-info mt-4">
                            <div class="coming-soon-badge">
                                <i class="fas fa-calendar-alt me-2"></i>
                                <span>Coming Soon - Q4 2025</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-5">
                    <div class="ai-visual animate-on-scroll" style="animation-delay: 0.3s;">
                        <div class="ai-interface-preview">
                            <div class="interface-screen">
                                <div class="screen-header">
                                    <div class="screen-dots">
                                        <span></span>
                                        <span></span>
                                        <span></span>
                                    </div>
                                    <div class="screen-title">AI Relocator Assistant</div>
                                </div>
                                <div class="screen-content">
                                    <div class="chat-message ai-message">
                                        <div class="avatar ai-avatar">
                                            <i class="fas fa-robot"></i>
                                        </div>
                                        <div class="message-content">
                                            <p>Hi! I'm your AI relocation assistant. I've analyzed your preferences and found the perfect services for your move to Singapore.</p>
                                        </div>
                                    </div>
                                    <div class="chat-message user-message">
                                        <div class="message-content">
                                            <p>Show me housing options in the CBD area</p>
                                        </div>
                                        <div class="avatar user-avatar">
                                            <i class="fas fa-user"></i>
                                        </div>
                                    </div>
                                    <div class="typing-indicator">
                                        <span></span>
                                        <span></span>
                                        <span></span>
                                    </div>
                                </div>
                            </div>
                            <div class="floating-elements">
                                <div class="floating-icon icon-1"><?php echo sm_icon('house', 'solid', 'icon'); ?></div>
                                <div class="floating-icon icon-2"><?php echo sm_icon('landmark', 'solid', 'icon'); ?></div>
                                <div class="floating-icon icon-3"><?php echo sm_icon('plane', 'solid', 'icon'); ?></div>
                                <div class="floating-icon icon-4"><?php echo sm_icon('clipboard-list', 'solid', 'icon'); ?></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Animated Background -->
        <div class="ai-background position-absolute top-0 start-0 w-100 h-100">
            <div class="neural-network">
                <div class="node node-1"></div>
                <div class="node node-2"></div>
                <div class="node node-3"></div>
                <div class="node node-4"></div>
                <div class="node node-5"></div>
                <div class="connection conn-1"></div>
                <div class="connection conn-2"></div>
                <div class="connection conn-3"></div>
                <div class="connection conn-4"></div>
            </div>
        </div>
    </section>

    <!-- AI Features -->
    <section id="features" class="ai-features-section py-6">
        <div class="container">
            <div class="row justify-content-center mb-5">
                <div class="col-lg-8 text-center">
                    <h2 class="section-title">Intelligent Relocation Features</h2>
                    <p class="section-subtitle">Our AI understands your unique needs and creates a personalized relocation experience unlike anything before.</p>
                </div>
            </div>
            
            <div class="row g-4">
                <div class="col-lg-4">
                    <div class="ai-feature-card animate-on-scroll">
                        <div class="feature-icon-ai">
                            <i class="fas fa-brain"></i>
                            <div class="icon-pulse"></div>
                        </div>
                        <h3 class="feature-title">Smart Analysis</h3>
                        <p class="feature-description">AI analyzes your profile, preferences, and destination to create a personalized relocation strategy in seconds.</p>
                        <div class="feature-capabilities">
                            <span class="capability">Preference Learning</span>
                            <span class="capability">Risk Assessment</span>
                            <span class="capability">Timeline Optimization</span>
                        </div>
                    </div>
                </div>
                
                <div class="col-lg-4">
                    <div class="ai-feature-card animate-on-scroll" style="animation-delay: 0.2s;">
                        <div class="feature-icon-ai bg-secondary">
                            <i class="fas fa-comments"></i>
                            <div class="icon-pulse"></div>
                        </div>
                        <h3 class="feature-title">Conversational Interface</h3>
                        <p class="feature-description">Chat naturally with our AI assistant to get instant answers, recommendations, and updates on your relocation progress.</p>
                        <div class="feature-capabilities">
                            <span class="capability">Natural Language</span>
                            <span class="capability">Instant Responses</span>
                            <span class="capability">Multi-language</span>
                        </div>
                    </div>
                </div>
                
                <div class="col-lg-4">
                    <div class="ai-feature-card animate-on-scroll" style="animation-delay: 0.4s;">
                        <div class="feature-icon-ai bg-success">
                            <i class="fas fa-chart-network"></i>
                            <div class="icon-pulse"></div>
                        </div>
                        <h3 class="feature-title">Predictive Planning</h3>
                        <p class="feature-description">Advanced algorithms predict potential challenges and proactively suggest solutions before issues arise.</p>
                        <div class="feature-capabilities">
                            <span class="capability">Risk Prediction</span>
                            <span class="capability">Timeline Forecasting</span>
                            <span class="capability">Cost Optimization</span>
                        </div>
                    </div>
                </div>
                
                <div class="col-lg-4">
                    <div class="ai-feature-card animate-on-scroll" style="animation-delay: 0.1s;">
                        <div class="feature-icon-ai bg-warning">
                            <i class="fas fa-sync-alt"></i>
                            <div class="icon-pulse"></div>
                        </div>
                        <h3 class="feature-title">Real-time Adaptation</h3>
                        <p class="feature-description">AI continuously learns from your feedback and adjusts recommendations to better match your evolving needs.</p>
                        <div class="feature-capabilities">
                            <span class="capability">Continuous Learning</span>
                            <span class="capability">Dynamic Updates</span>
                            <span class="capability">Personalization</span>
                        </div>
                    </div>
                </div>
                
                <div class="col-lg-4">
                    <div class="ai-feature-card animate-on-scroll" style="animation-delay: 0.3s;">
                        <div class="feature-icon-ai bg-info">
                            <i class="fas fa-network-wired"></i>
                            <div class="icon-pulse"></div>
                        </div>
                        <h3 class="feature-title">Smart Connections</h3>
                        <p class="feature-description">AI matches you with the most suitable service providers based on your specific requirements and past performance data.</p>
                        <div class="feature-capabilities">
                            <span class="capability">Smart Matching</span>
                            <span class="capability">Performance Analytics</span>
                            <span class="capability">Quality Assurance</span>
                        </div>
                    </div>
                </div>
                
                <div class="col-lg-4">
                    <div class="ai-feature-card animate-on-scroll" style="animation-delay: 0.5s;">
                        <div class="feature-icon-ai bg-danger">
                            <i class="fas fa-shield-alt"></i>
                            <div class="icon-pulse"></div>
                        </div>
                        <h3 class="feature-title">Privacy-First AI</h3>
                        <p class="feature-description">Advanced encryption and privacy controls ensure your personal data is protected while delivering personalized experiences.</p>
                        <div class="feature-capabilities">
                            <span class="capability">Data Encryption</span>
                            <span class="capability">Privacy Controls</span>
                            <span class="capability">Secure Processing</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- How AI Works -->
    <section class="ai-process py-6 bg-light">
        <div class="container">
            <div class="row justify-content-center mb-5">
                <div class="col-lg-8 text-center">
                    <h2 class="section-title">How AI Relocator Works</h2>
                    <p class="section-subtitle">Experience a seamless, intelligent approach to international relocation.</p>
                </div>
            </div>
            
            <div class="ai-process-flow">
                <div class="process-step-ai" data-step="1">
                    <div class="step-visual">
                        <div class="step-icon">
                            <i class="fas fa-user-plus"></i>
                        </div>
                        <div class="step-animation">
                            <div class="pulse-ring"></div>
                        </div>
                    </div>
                    <div class="step-content">
                        <h3>Profile Creation</h3>
                        <p>Tell our AI about your relocation goals, preferences, timeline, and any specific requirements. The more details you share, the more personalized your experience becomes.</p>
                    </div>
                </div>
                
                <div class="process-arrow">
                    <i class="fas fa-arrow-right"></i>
                </div>
                
                <div class="process-step-ai" data-step="2">
                    <div class="step-visual">
                        <div class="step-icon">
                            <i class="fas fa-cogs"></i>
                        </div>
                        <div class="step-animation">
                            <div class="pulse-ring"></div>
                        </div>
                    </div>
                    <div class="step-content">
                        <h3>AI Analysis</h3>
                        <p>Our AI processes your information, analyzes destination requirements, and creates a comprehensive relocation strategy tailored specifically to your needs.</p>
                    </div>
                </div>
                
                <div class="process-arrow">
                    <i class="fas fa-arrow-right"></i>
                </div>
                
                <div class="process-step-ai" data-step="3">
                    <div class="step-visual">
                        <div class="step-icon">
                            <i class="fas fa-comments"></i>
                        </div>
                        <div class="step-animation">
                            <div class="pulse-ring"></div>
                        </div>
                    </div>
                    <div class="step-content">
                        <h3>Interactive Planning</h3>
                        <p>Chat with your AI assistant to refine your plan, ask questions, and get instant recommendations. The AI learns from each interaction to better serve you.</p>
                    </div>
                </div>
                
                <div class="process-arrow">
                    <i class="fas fa-arrow-right"></i>
                </div>
                
                <div class="process-step-ai" data-step="4">
                    <div class="step-visual">
                        <div class="step-icon">
                            <i class="fas fa-rocket"></i>
                        </div>
                        <div class="step-animation">
                            <div class="pulse-ring"></div>
                        </div>
                    </div>
                    <div class="step-content">
                        <h3>Smart Execution</h3>
                        <p>AI coordinates with service providers, monitors progress, and provides real-time updates while continuously optimizing your relocation timeline.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- AI Benefits -->
    <section class="ai-benefits py-6">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <div class="benefits-content animate-on-scroll">
                        <h2 class="section-title text-start">Why Choose AI-Powered Relocation?</h2>
                        <p class="lead mb-4">Traditional relocation services are reactive. Our AI is proactive, intelligent, and available 24/7.</p>
                        
                        <div class="comparison-table">
                            <div class="comparison-row">
                                <div class="comparison-feature">Response Time</div>
                                <div class="traditional">Hours to Days</div>
                                <div class="ai-powered">Instant</div>
                            </div>
                            <div class="comparison-row">
                                <div class="comparison-feature">Personalization</div>
                                <div class="traditional">Generic Plans</div>
                                <div class="ai-powered">Fully Customized</div>
                            </div>
                            <div class="comparison-row">
                                <div class="comparison-feature">Availability</div>
                                <div class="traditional">Business Hours</div>
                                <div class="ai-powered">24/7/365</div>
                            </div>
                            <div class="comparison-row">
                                <div class="comparison-feature">Adaptation</div>
                                <div class="traditional">Manual Updates</div>
                                <div class="ai-powered">Auto-Learning</div>
                            </div>
                            <div class="comparison-row">
                                <div class="comparison-feature">Predictions</div>
                                <div class="traditional">Reactive</div>
                                <div class="ai-powered">Predictive</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="benefits-visual animate-on-scroll" style="animation-delay: 0.3s;">
                        <div class="ai-stats-dashboard">
                            <div class="dashboard-header">
                                <h4>AI Performance Metrics</h4>
                            </div>
                            <div class="stats-grid">
                                <div class="stat-card">
                                    <div class="stat-value">99.9%</div>
                                    <div class="stat-label">Uptime</div>
                                    <div class="stat-bar">
                                        <div class="stat-fill" style="width: 99.9%"></div>
                                    </div>
                                </div>
                                <div class="stat-card">
                                    <div class="stat-value">0.2s</div>
                                    <div class="stat-label">Response Time</div>
                                    <div class="stat-bar">
                                        <div class="stat-fill" style="width: 95%"></div>
                                    </div>
                                </div>
                                <div class="stat-card">
                                    <div class="stat-value">97%</div>
                                    <div class="stat-label">Accuracy</div>
                                    <div class="stat-bar">
                                        <div class="stat-fill" style="width: 97%"></div>
                                    </div>
                                </div>
                                <div class="stat-card">
                                    <div class="stat-value">4.9/5</div>
                                    <div class="stat-label">User Rating</div>
                                    <div class="stat-bar">
                                        <div class="stat-fill" style="width: 98%"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Sign Up Preview -->
    <section id="signup-preview" class="signup-preview py-6 bg-gradient-secondary text-white">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="signup-content text-center">
                        <h2 class="display-4 fw-bold mb-4">Be the First to Experience AI Relocator</h2>
                        <p class="lead fs-4 mb-5">Revolutionary AI-powered relocation assistance is almost here. Join thousands who are waiting for the future of international moving.</p>
                        
                        <div class="locked-signup-area">
                            <div class="signup-preview-form">
                                <div class="form-row">
                                    <div class="input-group locked-input">
                                        <input type="email" class="form-control" placeholder="Enter your email address" disabled>
                                        <div class="locked-button-container-large">
                                            <button type="button" class="btn btn-locked-large" disabled>
                                                <i class="fas fa-user-plus me-2"></i>
                                                Sign Up
                                            </button>
                                            <div class="lock-overlay-large">
                                                <i class="fas fa-lock"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="locked-message mt-3">
                                    <i class="fas fa-info-circle me-2"></i>
                                    <span>Sign-up will be available when AI Relocator launches</span>
                                </div>
                            </div>
                        </div>
                        
                        <div class="beta-stats mt-5">
                            <div class="row g-4">
                                <div class="col-md-4">
                                    <div class="beta-stat">
                                        <div class="stat-number" id="interestedUsers">2,847</div>
                                        <div class="stat-label">Interested Users</div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="beta-stat">
                                        <div class="stat-number">Q4 2025</div>
                                        <div class="stat-label">Expected Launch</div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="beta-stat">
                                        <div class="stat-number"><?php echo esc_html( get_option( 'sm_countries_served', '5+' ) ); ?></div>
                                        <div class="stat-label">Countries Ready</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- FAQ -->
    <section class="ai-faq py-6 bg-light">
        <div class="container">
            <div class="row justify-content-center mb-5">
                <div class="col-lg-8 text-center">
                    <h2 class="section-title">Frequently Asked Questions</h2>
                    <p class="section-subtitle">Learn more about our AI-powered relocation platform.</p>
                </div>
            </div>
            
            <div class="row justify-content-center">
                <div class="col-lg-10">
                    <div class="ai-faq-accordion">
                        <div class="faq-item">
                            <div class="faq-header" data-target="#aiFaq1">
                                <h4>How does the AI understand my specific needs?</h4>
                                <i class="fas fa-plus"></i>
                            </div>
                            <div class="collapse" id="aiFaq1">
                                <div class="faq-answer">
                                    <p>Our AI uses advanced natural language processing and machine learning algorithms to analyze your input, preferences, and behavior patterns. It considers factors like your family size, budget, timeline, cultural preferences, and specific requirements to create a highly personalized relocation strategy.</p>
                                </div>
                            </div>
                        </div>
                        
                        <div class="faq-item">
                            <div class="faq-header" data-target="#aiFaq2">
                                <h4>Is my personal data safe with AI processing?</h4>
                                <i class="fas fa-plus"></i>
                            </div>
                            <div class="collapse" id="aiFaq2">
                                <div class="faq-answer">
                                    <p>Absolutely. We use enterprise-grade encryption and privacy-first AI architecture. Your data is processed securely, never shared with third parties without consent, and you maintain full control over your information. Our AI is designed to be smart while keeping your privacy intact.</p>
                                </div>
                            </div>
                        </div>
                        
                        <div class="faq-item">
                            <div class="faq-header" data-target="#aiFaq3">
                                <h4>Will AI replace human support entirely?</h4>
                                <i class="fas fa-plus"></i>
                            </div>
                            <div class="collapse" id="aiFaq3">
                                <div class="faq-answer">
                                    <p>No, our AI enhances human support rather than replacing it. While AI handles routine tasks, complex decisions, and provides 24/7 assistance, our human experts remain available for nuanced situations, emotional support, and specialized guidance that requires human empathy and expertise.</p>
                                </div>
                            </div>
                        </div>
                        
                        <div class="faq-item">
                            <div class="faq-header" data-target="#aiFaq4">
                                <h4>What makes this different from chatbots?</h4>
                                <i class="fas fa-plus"></i>
                            </div>
                            <div class="collapse" id="aiFaq4">
                                <div class="faq-answer">
                                    <p>Unlike simple chatbots, our AI Relocator is powered by advanced machine learning models trained specifically on relocation data. It can analyze complex scenarios, make predictions, coordinate multiple services, and learn from each interaction to provide increasingly personalized assistance.</p>
                                </div>
                            </div>
                        </div>
                        
                        <div class="faq-item">
                            <div class="faq-header" data-target="#aiFaq5">
                                <h4>When will the AI Relocator be available?</h4>
                                <i class="fas fa-plus"></i>
                            </div>
                            <div class="collapse" id="aiFaq5">
                                <div class="faq-answer">
                                    <p>We're planning to launch the AI Relocator in Q4 2025. The platform is currently in final development and testing phases. Once launched, users will be able to sign up and begin using our revolutionary AI-powered relocation services.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

</main><!-- .site-main -->

<style>
/* AI Relocator Page Specific Styles */

/* Coming Soon Banner */
.coming-soon-banner {
    background: var(--gradient-accent);
    padding: 1rem 0;
    text-align: center;
    position: relative;
    overflow: hidden;
    box-shadow: var(--shadow-lg);
}

.banner-content {
    font-weight: 800;
    font-size: 1.1rem;
    color: var(--text-dark);
    text-shadow: 0 1px 2px rgba(0, 0, 0, 0.1);
    animation: banner-pulse 2s ease-in-out infinite;
}

@keyframes banner-pulse {
    0%, 100% { transform: scale(1); }
    50% { transform: scale(1.02); }
}

/* Locked Button Styles */
.locked-button-container {
    position: relative;
    display: inline-block;
}

.locked-button-container-large {
    position: relative;
    display: inline-block;
}

.btn-locked {
    background: #e5e7eb !important;
    border: 2px solid #d1d5db !important;
    color: #6b7280 !important;
    cursor: not-allowed !important;
    position: relative;
    font-weight: 700;
    transition: all 0.3s ease;
}

.btn-locked:hover, .btn-locked:focus, .btn-locked:active {
    background: #e5e7eb !important;
    border-color: #d1d5db !important;
    color: #6b7280 !important;
    transform: none !important;
}

.btn-locked-large {
    background: #e5e7eb !important;
    border: 2px solid #d1d5db !important;
    color: #6b7280 !important;
    cursor: not-allowed !important;
    position: relative;
    padding: 1rem 2rem;
    font-size: 1.1rem;
    font-weight: 700;
    transition: all 0.3s ease;
}

.lock-overlay {
    position: absolute;
    top: -8px;
    right: -8px;
    width: 24px;
    height: 24px;
    background: #ef4444;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 0.75rem;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
    animation: lock-pulse 2s ease-in-out infinite;
}

.lock-overlay-large {
    position: absolute;
    top: -8px;
    right: -8px;
    width: 28px;
    height: 28px;
    background: #ef4444;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 0.8rem;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
    animation: lock-pulse 2s ease-in-out infinite;
}

@keyframes lock-pulse {
    0%, 100% { 
        transform: scale(1);
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
    }
    50% { 
        transform: scale(1.1);
        box-shadow: 0 4px 8px rgba(239, 68, 68, 0.4);
    }
}

@keyframes shake {
    0%, 100% { transform: translateX(0); }
    10%, 30%, 50%, 70%, 90% { transform: translateX(-3px); }
    20%, 40%, 60%, 80% { transform: translateX(3px); }
}

/* Locked Input Styles */
.locked-input .form-control {
    background: rgba(255, 255, 255, 0.1) !important;
    border-color: #6b7280 !important;
    color: #9ca3af !important;
    cursor: not-allowed !important;
}

.locked-input .form-control::placeholder {
    color: rgba(156, 163, 175, 0.7) !important;
}

.locked-message {
    color: rgba(255, 255, 255, 0.8);
    font-size: 0.9rem;
    font-style: italic;
}

.signup-preview {
    background: var(--gradient-secondary) !important;
}

.ai-hero {
    min-height: 100vh;
    position: relative;
    overflow-x: hidden;
}

.badge-ai {
    background: rgba(245, 158, 11, 0.2);
    color: var(--accent-color);
    padding: 0.5rem 1rem;
    border-radius: var(--border-radius-2xl);
    font-size: 0.9rem;
    font-weight: 700;
    backdrop-filter: blur(10px);
    -webkit-backdrop-filter: blur(10px);
    border: 2px solid var(--accent-color);
    text-shadow: 0 1px 2px rgba(0, 0, 0, 0.2);
}

.ai-features {
    display: flex;
    flex-wrap: wrap;
    gap: 2rem;
    margin: 2rem 0;
}

.feature-highlight {
    background: rgba(255, 255, 255, 0.1);
    padding: 0.75rem 1.5rem;
    border-radius: var(--border-radius-2xl);
    font-weight: 600;
    font-size: 1rem;
    backdrop-filter: blur(10px);
    -webkit-backdrop-filter: blur(10px);
    border: 1px solid rgba(255, 255, 255, 0.2);
    display: flex;
    align-items: center;
    transition: all 0.3s ease;
}

.feature-highlight:hover {
    background: rgba(255, 255, 255, 0.2);
    transform: translateY(-2px);
}

.coming-soon-badge {
    background: var(--gradient-accent);
    color: var(--text-dark);
    padding: 0.75rem 1.5rem;
    border-radius: var(--border-radius-2xl);
    font-weight: 700;
    display: inline-flex;
    align-items: center;
    box-shadow: var(--shadow-lg);
    animation: pulse-glow 2s ease-in-out infinite;
}

@keyframes pulse-glow {
    0%, 100% { box-shadow: var(--shadow-lg); }
    50% { box-shadow: 0 0 30px rgba(245, 158, 11, 0.5); }
}

.ai-interface-preview {
    position: relative;
    max-width: 400px;
    margin: 0 auto;
}

.interface-screen {
    background: var(--bg-white);
    border-radius: var(--border-radius-2xl);
    box-shadow: var(--shadow-2xl);
    overflow: hidden;
    border: 1px solid var(--border-light);
}

.screen-header {
    background: var(--bg-light);
    padding: 1rem 1.5rem;
    display: flex;
    align-items: center;
    justify-content: space-between;
    border-bottom: 1px solid var(--border-light);
}

.screen-dots {
    display: flex;
    gap: 0.5rem;
}

.screen-dots span {
    width: 12px;
    height: 12px;
    border-radius: 50%;
    background: var(--border-medium);
}

.screen-dots span:nth-child(1) { background: #ff5f56; }
.screen-dots span:nth-child(2) { background: #ffbd2e; }
.screen-dots span:nth-child(3) { background: #27ca3f; }

.screen-title {
    font-weight: 700;
    color: var(--text-dark);
}

.screen-content {
    padding: 1.5rem;
    height: 250px;
    overflow-y: auto;
}

.chat-message {
    display: flex;
    gap: 1rem;
    margin-bottom: 1rem;
    animation: fadeInMessage 0.5s ease-in;
}

.chat-message.user-message {
    flex-direction: row-reverse;
}

@keyframes fadeInMessage {
    from { opacity: 0; transform: translateY(10px); }
    to { opacity: 1; transform: translateY(0); }
}

.avatar {
    width: 35px;
    height: 35px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 0.9rem;
    flex-shrink: 0;
}

.ai-avatar {
    background: var(--gradient-primary);
    color: white;
}

.user-avatar {
    background: var(--gradient-secondary);
    color: white;
}

.message-content {
    background: var(--bg-section);
    padding: 0.75rem 1rem;
    border-radius: var(--border-radius-lg);
    max-width: 70%;
    border: 1px solid var(--border-light);
}

.user-message .message-content {
    background: var(--primary-lighter);
    border-color: var(--primary-color);
}

.message-content p {
    margin: 0;
    color: var(--text-dark);
    font-size: 0.9rem;
    line-height: 1.4;
}

.typing-indicator {
    display: flex;
    gap: 0.3rem;
    padding: 0.75rem 1rem;
    background: var(--bg-section);
    border-radius: var(--border-radius-lg);
    width: fit-content;
    margin-left: 46px;
    border: 1px solid var(--border-light);
}

.typing-indicator span {
    width: 8px;
    height: 8px;
    border-radius: 50%;
    background: var(--text-light);
    animation: typing 1.4s ease-in-out infinite;
}

.typing-indicator span:nth-child(2) { animation-delay: 0.2s; }
.typing-indicator span:nth-child(3) { animation-delay: 0.4s; }

@keyframes typing {
    0%, 60%, 100% { transform: translateY(0); }
    30% { transform: translateY(-10px); }
}

.floating-elements {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    pointer-events: none;
}

.floating-icon {
    position: absolute;
    font-size: 2rem;
    animation: float 3s ease-in-out infinite;
    opacity: 0.3;
}

.icon-1 { top: 20%; left: -20%; animation-delay: 0s; }
.icon-2 { top: 60%; right: -20%; animation-delay: 0.7s; }
.icon-3 { bottom: 30%; left: -15%; animation-delay: 1.4s; }
.icon-4 { top: 10%; right: -15%; animation-delay: 2.1s; }

.ai-background {
    pointer-events: none;
    z-index: 0;
}

.neural-network {
    position: relative;
    width: 100%;
    height: 100%;
    opacity: 0.1;
}

.node {
    position: absolute;
    width: 20px;
    height: 20px;
    background: var(--accent-color);
    border-radius: 50%;
    animation: pulse-node 3s ease-in-out infinite;
}

.node-1 { top: 20%; left: 10%; animation-delay: 0s; }
.node-2 { top: 40%; right: 15%; animation-delay: 0.6s; }
.node-3 { bottom: 30%; left: 20%; animation-delay: 1.2s; }
.node-4 { top: 60%; right: 30%; animation-delay: 1.8s; }
.node-5 { bottom: 20%; right: 10%; animation-delay: 2.4s; }

@keyframes pulse-node {
    0%, 100% { transform: scale(1); opacity: 0.5; }
    50% { transform: scale(1.5); opacity: 1; }
}

.connection {
    position: absolute;
    height: 2px;
    background: linear-gradient(90deg, transparent, var(--accent-color), transparent);
    animation: flow 4s ease-in-out infinite;
}

.conn-1 { top: 25%; left: 12%; width: 15%; transform: rotate(30deg); animation-delay: 0s; }
.conn-2 { top: 45%; right: 20%; width: 20%; transform: rotate(-45deg); animation-delay: 1s; }
.conn-3 { bottom: 35%; left: 25%; width: 18%; transform: rotate(60deg); animation-delay: 2s; }
.conn-4 { top: 65%; right: 35%; width: 12%; transform: rotate(-30deg); animation-delay: 3s; }

@keyframes flow {
    0%, 100% { opacity: 0.3; }
    50% { opacity: 1; }
}

.ai-feature-card {
    background: var(--bg-white);
    padding: 3rem 2rem;
    border-radius: var(--border-radius-2xl);
    box-shadow: var(--shadow-sm);
    border: 1px solid var(--border-light);
    transition: all 0.4s ease;
    height: 100%;
    text-align: center;
    position: relative;
    overflow: hidden;
}

.ai-feature-card::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 4px;
    background: var(--gradient-primary);
    opacity: 0;
    transition: opacity 0.3s ease;
}

.ai-feature-card:hover::before {
    opacity: 1;
}

.ai-feature-card:hover {
    transform: translateY(-10px);
    box-shadow: var(--shadow-2xl);
    background: var(--bg-section);
}

.feature-icon-ai {
    width: 100px;
    height: 100px;
    background: var(--gradient-primary);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 2rem;
    font-size: 2.5rem;
    color: white;
    position: relative;
    box-shadow: var(--shadow-lg);
}

.icon-pulse {
    position: absolute;
    top: -5px;
    left: -5px;
    right: -5px;
    bottom: -5px;
    border-radius: 50%;
    border: 3px solid var(--primary-color);
    opacity: 0;
    animation: pulse-ring 2s ease-out infinite;
}

@keyframes pulse-ring {
    0% { transform: scale(1); opacity: 0.8; }
    100% { transform: scale(1.2); opacity: 0; }
}

.feature-title {
    color: var(--text-dark);
    font-weight: 800;
    margin-bottom: 1rem;
    font-size: 1.4rem;
}

.feature-description {
    color: var(--text-light);
    line-height: 1.7;
    margin-bottom: 2rem;
}

.feature-capabilities {
    display: flex;
    flex-wrap: wrap;
    gap: 0.5rem;
    justify-content: center;
}

.capability {
    background: var(--primary-lighter);
    color: var(--primary-color);
    padding: 0.3rem 0.8rem;
    border-radius: var(--border-radius-2xl);
    font-size: 0.8rem;
    font-weight: 600;
}

.ai-process-flow {
    display: flex;
    align-items: center;
    justify-content: center;
    flex-wrap: wrap;
    gap: 2rem;
    margin: 3rem 0;
}

.process-step-ai {
    display: flex;
    flex-direction: column;
    align-items: center;
    text-align: center;
    max-width: 250px;
    position: relative;
}

.step-visual {
    position: relative;
    margin-bottom: 2rem;
}

.step-icon {
    width: 80px;
    height: 80px;
    background: var(--gradient-secondary);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 2rem;
    color: white;
    box-shadow: var(--shadow-lg);
    position: relative;
    z-index: 2;
}

.pulse-ring {
    position: absolute;
    top: -10px;
    left: -10px;
    right: -10px;
    bottom: -10px;
    border-radius: 50%;
    border: 4px solid var(--secondary-color);
    opacity: 0;
    animation: pulse-ring 3s ease-out infinite;
}

.step-content h3 {
    color: var(--text-dark);
    font-weight: 700;
    margin-bottom: 1rem;
    font-size: 1.3rem;
}

.step-content p {
    color: var(--text-light);
    line-height: 1.6;
    margin: 0;
}

.process-arrow {
    color: var(--primary-color);
    font-size: 2rem;
    margin: 0 1rem;
}

.comparison-table {
    background: var(--bg-white);
    border-radius: var(--border-radius-xl);
    overflow: hidden;
    box-shadow: var(--shadow-md);
    border: 1px solid var(--border-light);
}

.comparison-row {
    display: grid;
    grid-template-columns: 1fr 1fr 1fr;
    align-items: center;
    min-height: 60px;
}

.comparison-row:nth-child(odd) {
    background: var(--bg-section);
}

.comparison-row:first-child {
    background: var(--primary-color);
    color: white;
    font-weight: 700;
}

.comparison-feature {
    padding: 1rem 1.5rem;
    font-weight: 600;
    color: var(--text-dark);
}

.comparison-row:first-child .comparison-feature {
    color: white;
}

.traditional {
    padding: 1rem 1.5rem;
    color: var(--text-light);
    text-align: center;
    border-right: 1px solid var(--border-light);
}

.ai-powered {
    padding: 1rem 1.5rem;
    color: var(--success-color);
    font-weight: 700;
    text-align: center;
    position: relative;
}

.ai-powered::before {
    content: '✓';
    margin-right: 0.5rem;
    color: var(--success-color);
}

.ai-stats-dashboard {
    background: var(--bg-white);
    border-radius: var(--border-radius-2xl);
    padding: 2rem;
    box-shadow: var(--shadow-lg);
    border: 1px solid var(--border-light);
}

.dashboard-header h4 {
    color: var(--text-dark);
    font-weight: 700;
    margin-bottom: 2rem;
    text-align: center;
}

.stats-grid {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 1.5rem;
}

.stat-card {
    text-align: center;
    padding: 1.5rem;
    background: var(--bg-section);
    border-radius: var(--border-radius-lg);
}

.stat-value {
    font-size: 2rem;
    font-weight: 900;
    color: var(--primary-color);
    margin-bottom: 0.5rem;
}

.stat-label {
    color: var(--text-light);
    font-size: 0.9rem;
    font-weight: 600;
    margin-bottom: 1rem;
}

.stat-bar {
    height: 4px;
    background: var(--bg-light);
    border-radius: 2px;
    overflow: hidden;
}

.stat-fill {
    height: 100%;
    background: var(--gradient-primary);
    transition: width 2s ease-in-out;
}

.early-access {
    background: var(--gradient-secondary) !important;
}

.early-access-form .input-group {
    max-width: 500px;
    margin: 0 auto;
    background: rgba(255, 255, 255, 0.1);
    border-radius: var(--border-radius-2xl);
    padding: 0.5rem;
    backdrop-filter: blur(10px);
    -webkit-backdrop-filter: blur(10px);
}

.early-access-form .form-control {
    background: transparent;
    border: none;
    color: white;
    font-size: 1.1rem;
    padding: 1rem 1.5rem;
}

.early-access-form .form-control::placeholder {
    color: rgba(255, 255, 255, 0.7);
}

.early-access-form .form-control:focus {
    box-shadow: none;
    outline: none;
}

.form-benefits {
    display: flex;
    justify-content: center;
    gap: 2rem;
    flex-wrap: wrap;
}

.benefit-item {
    display: flex;
    align-items: center;
    color: rgba(255, 255, 255, 0.9);
    font-weight: 500;
}

.beta-stats .row {
    justify-content: center;
}

.beta-stat {
    text-align: center;
}

.beta-stat .stat-number {
    font-size: 2.5rem;
    font-weight: 900;
    color: var(--accent-color);
    margin-bottom: 0.5rem;
    text-shadow: 0 2px 4px rgba(0, 0, 0, 0.3);
}

.beta-stat .stat-label {
    color: rgba(255, 255, 255, 0.9);
    font-weight: 600;
}

.ai-faq-accordion .faq-item {
    background: var(--bg-white);
    border: 1px solid var(--border-light);
    border-radius: var(--border-radius-xl);
    margin-bottom: 1rem;
    overflow: hidden;
    transition: all 0.3s ease;
    box-shadow: var(--shadow-sm);
}

.ai-faq-accordion .faq-item:hover {
    box-shadow: var(--shadow-md);
    border-color: var(--primary-light);
}

.ai-faq-accordion .faq-header {
    padding: 1.5rem 2rem;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: space-between;
    transition: all 0.3s ease;
}

.ai-faq-accordion .faq-header:hover {
    background: var(--bg-section);
}

.ai-faq-accordion .faq-header h4 {
    color: var(--text-dark);
    font-weight: 700;
    margin: 0;
    font-size: 1.1rem;
}

.ai-faq-accordion .faq-header i {
    color: var(--primary-color);
    transition: transform 0.3s ease;
}

/* Professional Fade + Slide Animation for AI FAQ */
.ai-faq-accordion .collapse {
    max-height: 0;
    overflow: hidden;
    opacity: 0;
    transform: translateY(-10px);
    transition: max-height 0.4s cubic-bezier(0.4, 0, 0.2, 1),
                opacity 0.3s ease 0.1s,
                transform 0.3s ease 0.1s;
}

.ai-faq-accordion .collapse.show {
    max-height: 1000px; /* Generous height for content */
    opacity: 1;
    transform: translateY(0);
    transition: max-height 0.5s cubic-bezier(0.4, 0, 0.2, 1),
                opacity 0.4s ease 0.05s,
                transform 0.4s ease 0.05s;
}

.ai-faq-accordion .faq-answer {
    padding: 0 2rem 2rem;
    color: var(--text-medium);
    line-height: 1.7;
}

/* Subtle content staggering for premium feel */
.ai-faq-accordion .collapse.show .faq-answer > *:nth-child(1) {
    animation: fadeInUp 0.4s ease 0.1s both;
}

.ai-faq-accordion .collapse.show .faq-answer > *:nth-child(2) {
    animation: fadeInUp 0.4s ease 0.15s both;
}

.ai-faq-accordion .collapse.show .faq-answer > *:nth-child(3) {
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
    .ai-faq-accordion .collapse,
    .ai-faq-accordion .collapse.show,
    .ai-faq-accordion .faq-answer,
    .ai-faq-accordion .collapse.show .faq-answer > * {
        transition: none !important;
        animation: none !important;
        transform: none !important;
    }
}

/* Responsive Design */
@media (max-width: 768px) {
    .ai-hero {
        min-height: 90vh;
        text-align: center;
    }
    
    .ai-features {
        justify-content: center;
        gap: 1rem;
    }
    
    .feature-highlight {
        font-size: 0.9rem;
        padding: 0.5rem 1rem;
    }
    
    .ai-interface-preview {
        margin-top: 3rem;
        max-width: 350px;
    }
    
    .screen-content {
        height: 200px;
    }
    
    .ai-process-flow {
        flex-direction: column;
        gap: 3rem;
    }
    
    .process-arrow {
        transform: rotate(90deg);
        margin: 0;
    }
    
    .comparison-table {
        font-size: 0.9rem;
    }
    
    .comparison-row {
        min-height: 50px;
    }
    
    .stats-grid {
        grid-template-columns: 1fr;
    }
    
    .form-benefits {
        gap: 1rem;
        justify-content: center;
    }
    
    .beta-stats .row {
        text-align: center;
    }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Animated counter for interested users
    const interestedUsersElement = document.getElementById('interestedUsers');
    if (interestedUsersElement) {
        animateCounter(interestedUsersElement, 2847, 2000);
    }
    
    function animateCounter(element, target, duration) {
        let start = 0;
        const increment = target / (duration / 16);
        
        const timer = setInterval(() => {
            start += increment;
            element.textContent = Math.floor(start).toLocaleString();
            
            if (start >= target) {
                element.textContent = target.toLocaleString();
                clearInterval(timer);
            }
        }, 16);
    }
    
    // Locked button interactions (visual feedback only)
    const lockedButtons = document.querySelectorAll('.btn-locked, .btn-locked-large');
    lockedButtons.forEach(button => {
        button.addEventListener('click', function(e) {
            e.preventDefault();
            
            // Add shake animation to the container
            const container = this.closest('.locked-button-container, .locked-button-container-large');
            if (container) {
                container.style.animation = 'shake 0.5s ease-in-out';
                setTimeout(() => {
                    container.style.animation = '';
                }, 500);
            }
        });
    });
    
    // FAQ accordion
    const faqHeaders = document.querySelectorAll('.ai-faq-accordion .faq-header');
    
    faqHeaders.forEach(header => {
        header.addEventListener('click', function() {
            const target = this.getAttribute('data-target');
            const targetElement = document.querySelector(target);
            const icon = this.querySelector('i');
            
            // Close other open items
            faqHeaders.forEach(otherHeader => {
                if (otherHeader !== this) {
                    const otherTarget = otherHeader.getAttribute('data-target');
                    const otherElement = document.querySelector(otherTarget);
                    const otherIcon = otherHeader.querySelector('i');
                    
                    if (otherElement && otherElement.classList.contains('show')) {
                        otherElement.classList.remove('show');
                        otherIcon.style.transform = 'rotate(0deg)';
                    }
                }
            });
            
            // Toggle current item
            if (targetElement.classList.contains('show')) {
                targetElement.classList.remove('show');
                icon.style.transform = 'rotate(0deg)';
            } else {
                targetElement.classList.add('show');
                icon.style.transform = 'rotate(45deg)';
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
                
                // Animate stat bars
                if (entry.target.classList.contains('ai-stats-dashboard')) {
                    const statFills = entry.target.querySelectorAll('.stat-fill');
                    statFills.forEach(fill => {
                        const width = fill.style.width;
                        fill.style.width = '0%';
                        setTimeout(() => {
                            fill.style.width = width;
                        }, 500);
                    });
                }
            }
        });
    }, observerOptions);
    
    // Observe elements
    const elementsToAnimate = document.querySelectorAll('.hero-content, .ai-visual, .ai-feature-card, .benefits-content, .benefits-visual, .process-step-ai, .early-access-content, .ai-faq-accordion');
    elementsToAnimate.forEach(element => {
        element.classList.add('animate-on-scroll');
        observer.observe(element);
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
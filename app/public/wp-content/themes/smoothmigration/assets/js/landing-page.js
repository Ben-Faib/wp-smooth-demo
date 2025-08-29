/**
 * Landing Page Specific JavaScript - Smooth Migration Global
 */

document.addEventListener('DOMContentLoaded', function() {
    
    // Track "Talk to a human" CTA clicks
    document.querySelectorAll('a[href="/contact"]').forEach(btn => {
        btn.addEventListener('click', function(e) {
            // Track the contact CTA clicks
            if (typeof gtag !== 'undefined') {
                gtag('event', 'cta_click', {
                    'event_category': 'engagement',
                    'event_label': 'talk_to_human_cta',
                    'value': 1
                });
            }
        });
    });
    
    // Enhanced CTA Button Tracking
    document.querySelectorAll('a[href*="relocation-builder"]').forEach(btn => {
        btn.addEventListener('click', function(e) {
            // Track the primary CTA clicks
            if (typeof gtag !== 'undefined') {
                gtag('event', 'cta_click', {
                    'event_category': 'conversion',
                    'event_label': 'build_plan_cta',
                    'value': 1
                });
            }
            
            // Add loading state
            this.classList.add('loading');
            const originalText = this.textContent;
            this.innerHTML = '<span class="spinner-border spinner-border-sm me-2" role="status" aria-hidden="true"></span>Loading...';
            
            // Note: Remove this timeout in production - this is just for demo
            setTimeout(() => {
                this.classList.remove('loading');
                this.textContent = originalText;
            }, 1500);
        });
    });
    
    // Service Card Link Interactions
    document.querySelectorAll('.service-card-link').forEach(link => {
        link.addEventListener('click', function(e) {
            const serviceName = this.querySelector('.service-title').textContent;
            const serviceUrl = this.getAttribute('href');
            
            // Track service interest
            if (typeof gtag !== 'undefined') {
                gtag('event', 'service_click', {
                    'event_category': 'engagement',
                    'event_label': serviceName.toLowerCase().replace(/\s+/g, '_'),
                    'destination_url': serviceUrl
                });
            }
            
            // Add visual feedback
            const card = this.querySelector('.service-card');
            card.style.transform = 'scale(0.98)';
            setTimeout(() => {
                card.style.transform = '';
            }, 150);
        });
    });
    
    // Stats Counter Animation (enhanced, requestAnimationFrame-based)
    function animateCounters() {
        const counters = document.querySelectorAll('.stat-number');
        
        counters.forEach(counter => {
            const target = parseInt(counter.textContent.replace(/\D/g, ''));
            const suffix = counter.textContent.replace(/\d/g, '');
            let startTime = null;
            const duration = 1200;

            function step(ts) {
                if (startTime === null) startTime = ts;
                const progress = Math.min(1, (ts - startTime) / duration);
                const value = Math.floor(progress * target);
                counter.textContent = value + suffix;
                if (progress < 1) requestAnimationFrame(step);
            }
            requestAnimationFrame(step);
        });
    }
    
    // Trigger counter animation when stats section is visible
    const statsObserver = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting && !entry.target.classList.contains('animated')) {
                entry.target.classList.add('animated');
                animateCounters();
                statsObserver.unobserve(entry.target);
            }
        });
    }, { threshold: 0.5 });
    
    const statsSection = document.querySelector('.stats-row');
    if (statsSection) {
        statsObserver.observe(statsSection);
    }
    
    // Note: Removed smooth scroll for internal links since we're linking to contact page instead
    
    // Progressive disclosure for "Why Us" features
    document.querySelectorAll('.feature-item').forEach((item, index) => {
        item.style.opacity = '0';
        item.style.transform = 'translateY(30px)';
        
        setTimeout(() => {
            item.style.transition = 'all 0.6s ease';
            item.style.opacity = '1';
            item.style.transform = 'translateY(0)';
        }, index * 200);
    });
    
    // Testimonials are static by default; rotation removed per design decision
    
    // Hero section parallax effect
    const heroSection = document.querySelector('.hero-landing');
    if (heroSection) {
        try { if (window.matchMedia && window.matchMedia('(prefers-reduced-motion: reduce)').matches) { return; } } catch (e) {}
        let ticking = false;
        function onScroll() {
            if (!ticking) {
                window.requestAnimationFrame(() => {
                    const scrolled = window.pageYOffset;
                    const rate = scrolled * -0.2;
                    heroSection.style.backgroundPosition = `center ${rate}px`;
                    ticking = false;
                });
                ticking = true;
            }
        }
        window.addEventListener('scroll', onScroll, { passive: true });
    }
    
    // Note: Removed form validation since contact form is now on dedicated contact page
    
    // Utility function for notifications
    function showNotification(message, type = 'info') {
        const notification = document.createElement('div');
        notification.className = `alert alert-${type} alert-dismissible fade show position-fixed`;
        notification.style.cssText = 'top: 20px; right: 20px; z-index: 9999; min-width: 300px;';
        
        notification.innerHTML = `
            ${message}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        `;
        
        document.body.appendChild(notification);
        
        // Auto-remove after 5 seconds
        setTimeout(() => {
            if (notification.parentNode) {
                notification.remove();
            }
        }, 5000);
    }
    
    // Add loading states to all CTA buttons
    document.querySelectorAll('.btn[href]').forEach(btn => {
        if (!btn.getAttribute('href').startsWith('#') && !btn.getAttribute('href').startsWith('mailto:')) {
            btn.addEventListener('click', function(e) {
                if (!this.classList.contains('btn-outline-light')) {
                    this.style.opacity = '0.7';
                    this.style.pointerEvents = 'none';
                    
                    setTimeout(() => {
                        this.style.opacity = '';
                        this.style.pointerEvents = '';
                    }, 2000);
                }
            });
        }
    });
    
    // Initialize tooltips for service icons (if Bootstrap tooltips are available)
    if (typeof bootstrap !== 'undefined' && bootstrap.Tooltip) {
        const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
        tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl);
        });
    }

    // Sheen animation removed
});

// Global functions for landing page
window.landingPage = {
    goToContact: function() {
        window.location.href = '/contact';
    },
    
    trackServiceInterest: function(serviceName) {
        if (typeof gtag !== 'undefined') {
            gtag('event', 'service_interest', {
                'event_category': 'engagement',
                'event_label': serviceName,
                'value': 1
            });
        }
        console.log('Service interest tracked:', serviceName);
    }
}; 
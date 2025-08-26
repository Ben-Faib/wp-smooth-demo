/**
 * Intersection Observer for Scroll-Triggered Animations
 * Smooth Migration Theme - Accessible & Performance-Optimized
 */

document.addEventListener('DOMContentLoaded', function() {
    // Respect user's motion preferences
    const prefersReducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)');
    
    if (prefersReducedMotion.matches) {
        // If reduced motion is preferred, just add visible classes immediately
        const elementsToAnimate = document.querySelectorAll('.animate-on-scroll');
        elementsToAnimate.forEach(element => {
            element.classList.add('animate-in');
        });
        return;
    }
    
    // Intersection Observer options
    const observerOptions = {
        threshold: [0.1, 0.5],
        rootMargin: '0px 0px -50px 0px'
    };
    
    // Create observer
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            const element = entry.target;
            
            if (entry.isIntersecting) {
                // Add animation class when element enters viewport
                element.classList.add('animate-in');
                
                // Stop observing once animated (performance optimization)
                observer.unobserve(element);
            }
        });
    }, observerOptions);
    
    // Function to observe elements
    function observeElements() {
        // Service cards animation
        const serviceCards = document.querySelectorAll('.service-card');
        serviceCards.forEach((card, index) => {
            card.classList.add('animate-on-scroll');
            card.style.animationDelay = `${index * 0.1}s`;
            observer.observe(card);
        });
        
        // Step cards animation
        const stepCards = document.querySelectorAll('.step-card');
        stepCards.forEach((card, index) => {
            card.classList.add('animate-on-scroll');
            card.style.animationDelay = `${index * 0.15}s`;
            observer.observe(card);
        });
        
        // Feature items animation
        const featureItems = document.querySelectorAll('.feature-item');
        featureItems.forEach((item, index) => {
            item.classList.add('animate-on-scroll');
            item.style.animationDelay = `${index * 0.12}s`;
            observer.observe(item);
        });
        
        // Testimonial cards animation
        const testimonialCards = document.querySelectorAll('.testimonial-card');
        testimonialCards.forEach((card, index) => {
            card.classList.add('animate-on-scroll');
            card.style.animationDelay = `${index * 0.1}s`;
            observer.observe(card);
        });
        
        // Section animations with staggered timing
        const sectionsToAnimate = document.querySelectorAll('.how-it-works, .services-snapshot, .why-us, .social-proof, .about-snippet, .resources-section');
        sectionsToAnimate.forEach((section, index) => {
            section.classList.add('animate-on-scroll', 'animate-section');
            section.style.animationDelay = `${index * 0.2}s`;
            observer.observe(section);
        });
        
        // Hero floating elements (if they exist)
        const heroFloatingElements = document.querySelectorAll('.floating-cube, .world-map-overlay');
        heroFloatingElements.forEach((element, index) => {
            element.classList.add('animate-on-scroll', 'animate-float');
            element.style.animationDelay = `${index * 0.3}s`;
            observer.observe(element);
        });
    }
    
    // Initialize observer
    observeElements();
    
    // Listen for reduced motion preference changes
    prefersReducedMotion.addEventListener('change', function() {
        if (this.matches) {
            // If user enables reduced motion, immediately show all elements
            const elementsToAnimate = document.querySelectorAll('.animate-on-scroll');
            elementsToAnimate.forEach(element => {
                element.classList.add('animate-in');
                element.style.animation = 'none';
                element.style.transform = 'none';
                element.style.opacity = '1';
            });
        }
    });
});

// Performance optimization: Cleanup observer on page unload
window.addEventListener('beforeunload', function() {
    if (typeof observer !== 'undefined') {
        observer.disconnect();
    }
});

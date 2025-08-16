/**
 * Smooth Migration Theme JavaScript
 */

document.addEventListener('DOMContentLoaded', function() {
    // Smooth scrolling for anchor links
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            e.preventDefault();
            const target = document.querySelector(this.getAttribute('href'));
            if (target) {
                target.scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });
            }
        });
    });

    // Intersection Observer for fade-in animations
    const observerOptions = {
        threshold: 0.1,
        rootMargin: '0px 0px -50px 0px'
    };

    const observer = new IntersectionObserver(function(entries) {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('fade-in-up');
                observer.unobserve(entry.target);
            }
        });
    }, observerOptions);

    // Observe elements for animation
    document.querySelectorAll('.service-card, .stat-item, .testimonial-card').forEach(el => {
        observer.observe(el);
    });

    // Counter animation for stats
    function animateCounter(element) {
        const target = parseInt(element.textContent.replace(/\D/g, ''));
        const duration = 2000;
        const step = target / (duration / 16);
        let current = 0;
        
        const timer = setInterval(() => {
            current += step;
            if (current >= target) {
                element.textContent = element.textContent.replace(/\d+/, target);
                clearInterval(timer);
            } else {
                element.textContent = element.textContent.replace(/\d+/, Math.floor(current));
            }
        }, 16);
    }

    // Animate counters when they come into view
    const statObserver = new IntersectionObserver(function(entries) {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                const counter = entry.target.querySelector('.stat-number');
                if (counter && !counter.classList.contains('animated')) {
                    counter.classList.add('animated');
                    animateCounter(counter);
                }
                statObserver.unobserve(entry.target);
            }
        });
    }, { threshold: 0.5 });

    document.querySelectorAll('.stat-item').forEach(item => {
        statObserver.observe(item);
    });

    // Header scroll effect
    let lastScrollY = window.scrollY;
    const header = document.querySelector('.site-header');
    
    window.addEventListener('scroll', () => {
        if (window.scrollY > 100) {
            header.classList.add('scrolled');
        } else {
            header.classList.remove('scrolled');
        }
        
        // Hide/show header on scroll
        if (window.scrollY > lastScrollY && window.scrollY > 200) {
            header.style.transform = 'translateY(-100%)';
        } else {
            header.style.transform = 'translateY(0)';
        }
        lastScrollY = window.scrollY;
    });

    // Simplified button loading states - Fixed version
    document.querySelectorAll('.btn').forEach(btn => {
        btn.addEventListener('click', function(e) {
            // Skip for anchor links, disabled buttons, and already loading buttons
            if (this.href && this.href.includes('#') && !this.href.endsWith('#')) {
                return;
            }
            if (this.disabled || this.classList.contains('loading') || this.classList.contains('btn-locked')) {
                return;
            }
            
            // Store original content and dimensions
            const originalHTML = this.innerHTML;
            const rect = this.getBoundingClientRect();
            
            // Apply fixed dimensions to prevent layout shift
            this.style.width = rect.width + 'px';
            this.style.height = rect.height + 'px';
            
            // Add loading class and spinner
            this.classList.add('loading');
            this.innerHTML = originalHTML + '<span class="btn-loading-spinner"></span>';
            
            // Reset after timeout
            setTimeout(() => {
                if (this.classList.contains('loading')) {
                    this.classList.remove('loading');
                    this.innerHTML = originalHTML;
                    this.style.removeProperty('width');
                    this.style.removeProperty('height');
                }
            }, 2000);
        });
    });

    // Mobile menu enhancements
    const mobileToggle = document.querySelector('[data-bs-toggle="offcanvas"]');
    const offcanvas = document.querySelector('#mobileNav');
    
    if (mobileToggle && offcanvas) {
        // Close mobile menu when clicking on links
        offcanvas.querySelectorAll('a').forEach(link => {
            link.addEventListener('click', () => {
                const bsOffcanvas = bootstrap.Offcanvas.getInstance(offcanvas);
                if (bsOffcanvas) {
                    bsOffcanvas.hide();
                }
            });
        });
    }

    // Form enhancements
    document.querySelectorAll('form').forEach(form => {
        form.addEventListener('submit', function(e) {
            const submitBtn = this.querySelector('button[type="submit"], input[type="submit"]');
            if (submitBtn) {
                submitBtn.classList.add('loading');
                submitBtn.disabled = true;
            }
        });
    });

    // Service card hover effects
    document.querySelectorAll('.service-card').forEach(card => {
        card.addEventListener('mouseenter', function() {
            this.style.transform = 'translateY(-10px)';
            this.style.boxShadow = '0 25px 50px rgba(0, 0, 0, 0.15)';
        });
        
        card.addEventListener('mouseleave', function() {
            this.style.transform = 'translateY(0)';
            this.style.boxShadow = '0 4px 20px rgba(0, 0, 0, 0.08)';
        });
    });

    // Modal enhancements
    document.querySelectorAll('.modal').forEach(modal => {
        modal.addEventListener('show.bs.modal', function() {
            this.style.display = 'block';
            this.style.opacity = '0';
            this.style.transform = 'scale(0.9)';
            
            requestAnimationFrame(() => {
                this.style.transition = 'all 0.3s ease';
                this.style.opacity = '1';
                this.style.transform = 'scale(1)';
            });
        });
        
        modal.addEventListener('hide.bs.modal', function() {
            this.style.transition = 'all 0.2s ease';
            this.style.opacity = '0';
            this.style.transform = 'scale(0.9)';
        });
    });

    // Button ripple effect - Fixed to avoid conflicts
    document.querySelectorAll('.btn').forEach(btn => {
        btn.addEventListener('click', function(e) {
            // Skip ripple effect for loading or disabled buttons
            if (this.classList.contains('loading') || this.disabled || this.classList.contains('btn-locked')) {
                return;
            }
            
            const ripple = document.createElement('span');
            const rect = this.getBoundingClientRect();
            const size = Math.max(rect.width, rect.height);
            const x = e.clientX - rect.left - size / 2;
            const y = e.clientY - rect.top - size / 2;
            
            ripple.style.width = ripple.style.height = size + 'px';
            ripple.style.left = x + 'px';
            ripple.style.top = y + 'px';
            ripple.classList.add('ripple');
            
            this.appendChild(ripple);
            
            setTimeout(() => {
                if (ripple.parentNode) {
                    ripple.remove();
                }
            }, 600);
        });
    });

    // Enhanced scroll animations
    const scrollElements = document.querySelectorAll('.animate-on-scroll');
    const elementInView = (el, dividend = 1) => {
        const elementTop = el.getBoundingClientRect().top;
        return (
            elementTop <= (window.innerHeight || document.documentElement.clientHeight) / dividend
        );
    };

    const displayScrollElement = (element) => {
        element.classList.add('scrolled');
    };

    const hideScrollElement = (element) => {
        element.classList.remove('scrolled');
    };

    const handleScrollAnimation = () => {
        scrollElements.forEach((el) => {
            if (elementInView(el, 1.25)) {
                displayScrollElement(el);
            } else {
                hideScrollElement(el);
            }
        });
    };

    window.addEventListener('scroll', handleScrollAnimation);

    // Parallax effect for hero section
    const parallaxElements = document.querySelectorAll('.parallax');
    window.addEventListener('scroll', () => {
        const scrolled = window.pageYOffset;
        parallaxElements.forEach(el => {
            const rate = scrolled * -0.5;
            el.style.transform = `translateY(${rate}px)`;
        });
    });

    // Service option tracking
    document.querySelectorAll('[data-bs-toggle="modal"]').forEach(btn => {
        btn.addEventListener('click', function() {
            const serviceTitle = this.closest('.service-card').querySelector('h3').textContent;
            console.log('Service options viewed:', serviceTitle);
            
            // You can add analytics tracking here
            if (typeof gtag !== 'undefined') {
                gtag('event', 'service_options_viewed', {
                    'service_name': serviceTitle
                });
            }
        });
    });

    // Enhanced typing effect for hero text
    function typeWriter(element, text, speed = 50) {
        let i = 0;
        element.innerHTML = '';
        
        function type() {
            if (i < text.length) {
                element.innerHTML += text.charAt(i);
                i++;
                setTimeout(type, speed);
            }
        }
        
        type();
    }

    // Apply typing effect to hero subtitle if present
    const heroSubtitle = document.querySelector('.hero .lead');
    if (heroSubtitle) {
        const originalText = heroSubtitle.textContent;
        heroSubtitle.style.opacity = '0';
        
        setTimeout(() => {
            heroSubtitle.style.opacity = '1';
            typeWriter(heroSubtitle, originalText, 30);
        }, 1000);
    }

    // Progressive loading for images
    const imageObserver = new IntersectionObserver((entries, observer) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                const img = entry.target;
                img.src = img.dataset.src;
                img.classList.add('loaded');
                observer.unobserve(img);
            }
        });
    });

    document.querySelectorAll('img[data-src]').forEach(img => {
        imageObserver.observe(img);
    });

    // Dark mode toggle (if implemented)
    const darkModeToggle = document.querySelector('.dark-mode-toggle');
    if (darkModeToggle) {
        darkModeToggle.addEventListener('click', function() {
            document.body.classList.toggle('dark-mode');
            localStorage.setItem('darkMode', document.body.classList.contains('dark-mode'));
        });

        // Check for saved dark mode preference
        if (localStorage.getItem('darkMode') === 'true') {
            document.body.classList.add('dark-mode');
        }
    }

    // Inject "Meet Our Team" CTA button into the hero section (if present)
    const heroCtaGroup = document.querySelector('.hero .d-flex');
    if (heroCtaGroup && !document.querySelector('.hero a[href*="team"]')) {
        const teamBtn = document.createElement('a');
        teamBtn.href = '/about/#team';
        teamBtn.className = 'btn btn-outline-light';
        teamBtn.textContent = 'Meet Our Team';
        heroCtaGroup.appendChild(teamBtn);
    }

    // Lordicon / Lottie controls: hover + in-view, respecting reduced motion
    const prefersReduced = window.matchMedia && window.matchMedia('(prefers-reduced-motion: reduce)').matches;

    // Respect reduced motion for lottie-player elements
    if (prefersReduced) {
        document.querySelectorAll('lottie-player[autoplay]').forEach(player => {
            try { if (player.pause) player.pause(); } catch(e) {}
            player.removeAttribute('autoplay');
        });
    }

    // CTA hover → control lord-icon inside the button
    ['.cta-relocating', '.cta-employer', '.cta-partner'].forEach(selector => {
        document.querySelectorAll(selector).forEach(button => {
            const icon = button.querySelector('lord-icon');
            if (!icon) return;
            button.addEventListener('mouseenter', () => {
                if (!prefersReduced && icon.play) icon.play();
            });
            button.addEventListener('mouseleave', () => {
                if (icon.stop) icon.stop();
            });
        });
    });

    // In-view → play once for section icons
    const iconObserver = new IntersectionObserver((entries, obs) => {
        entries.forEach(entry => {
            if (!entry.isIntersecting) return;
            const el = entry.target;
            const playOnce = () => {
                if (!prefersReduced && el.play) {
                    try { el.play(); } catch (e) {}
                }
                obs.unobserve(el);
            };
            if (el.play) {
                playOnce();
            } else {
                const onReady = () => { playOnce(); };
                el.addEventListener('ready', onReady, { once: true });
                el.addEventListener('load', onReady, { once: true });
            }
        });
    }, { threshold: 0.25 });

    document.querySelectorAll('.why-us lord-icon, .resource-link lord-icon, .resource-icon lord-icon').forEach(el => iconObserver.observe(el));
});

// Utility functions
window.smoothMigration = {
    // Show notification
    showNotification: function(message, type = 'info') {
        const notification = document.createElement('div');
        notification.className = `alert alert-${type} position-fixed top-0 end-0 m-3`;
        notification.style.zIndex = '9999';
        notification.textContent = message;
        
        document.body.appendChild(notification);
        
        setTimeout(() => {
            notification.remove();
        }, 5000);
    },
    
    // Smooth scroll to element
    scrollTo: function(selector) {
        const element = document.querySelector(selector);
        if (element) {
            element.scrollIntoView({ behavior: 'smooth' });
        }
    }
}; 
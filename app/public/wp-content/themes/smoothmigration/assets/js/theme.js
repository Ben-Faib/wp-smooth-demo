/**
 * Smooth Migration Theme JavaScript
 */

document.addEventListener('DOMContentLoaded', function() {
    // Check for reduced motion preference
    const prefersReducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
    
    // Hero World Map Parallax Effect
    if (!prefersReducedMotion) {
        const heroSection = document.querySelector('.hero-landing');
        if (heroSection) {
            let ticking = false;
            
            function updateParallax() {
                const scrolled = window.pageYOffset;
                const heroHeight = heroSection.offsetHeight;
                const scrollRatio = Math.min(scrolled / heroHeight, 1);
                
                // Subtle parallax effect for world map background
                heroSection.style.setProperty(
                    '--parallax-y', 
                    `${scrollRatio * 30}px`
                );
                
                ticking = false;
            }
            
            function requestParallaxTick() {
                if (!ticking) {
                    requestAnimationFrame(updateParallax);
                    ticking = true;
                }
            }
            
            // Throttled scroll listener for performance
            window.addEventListener('scroll', requestParallaxTick, { passive: true });
            
            // Apply parallax CSS custom property
            const style = document.createElement('style');
            style.textContent = `
                .hero-landing::before {
                    transform: translateY(var(--parallax-y, 0px)) translateZ(0);
                }
            `;
            document.head.appendChild(style);
        }
    }
    
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

    // UX debug outline toggle via ?ux=1
    try {
        const params = new URLSearchParams(location.search);
        if (params.get('ux') === '1') {
            document.documentElement.classList.add('ux-debug');
            const style = document.createElement('style');
            style.textContent = `
                .ux-debug * { outline: 1px dashed rgba(0,0,0,.12); }
            `;
            document.head.appendChild(style);
        }
    } catch(e) {}

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

    // Enhanced Counter Animation System for Sprint 2.1
    class EnhancedCounterAnimator {
        constructor() {
            this.prefersReducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
            this.observedElements = new Set();
            this.initializeObserver();
        }

        initializeObserver() {
            this.observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting && !this.observedElements.has(entry.target)) {
                        this.observedElements.add(entry.target);
                        this.animateCounter(entry.target);
                        this.observer.unobserve(entry.target);
                    }
                });
            }, { 
                threshold: 0.3, 
                rootMargin: '0px 0px -100px 0px' 
            });
        }

        parseCounterData(element) {
            const fullText = element.textContent.trim();
            const numberMatch = fullText.match(/^(\d+(?:\.\d+)?)/);
            const suffixMatch = fullText.match(/([+%KMB]*)$/);
            
            return {
                targetValue: numberMatch ? parseFloat(numberMatch[1]) : 0,
                prefix: fullText.substring(0, fullText.indexOf(numberMatch ? numberMatch[1] : '')),
                suffix: suffixMatch ? suffixMatch[1] : '',
                originalText: fullText,
                isPercentage: fullText.includes('%'),
                isLargeNumber: /[KMB]/.test(fullText)
            };
        }

        easeOutCubic(t) {
            return 1 - Math.pow(1 - t, 3);
        }

        formatNumber(value, isLargeNumber, isPercentage) {
            if (isLargeNumber) {
                return Math.round(value).toString();
            } else if (isPercentage && value < 10) {
                return value.toFixed(1);
            } else {
                return Math.round(value).toString();
            }
        }

        animateCounter(element) {
            // Skip animation if reduced motion is preferred
            if (this.prefersReducedMotion) {
                element.classList.add('counter-animated');
                return;
            }

            const counterData = this.parseCounterData(element);
            if (counterData.targetValue === 0) return;

            // Add animation class for CSS effects
            element.classList.add('counter-animating');
            
            const duration = 2500; // Slightly longer for smoother feel
            const startTime = performance.now();
            let currentValue = 0;

            const animate = (currentTime) => {
                const elapsed = currentTime - startTime;
                const progress = Math.min(elapsed / duration, 1);
                const easedProgress = this.easeOutCubic(progress);
                
                currentValue = easedProgress * counterData.targetValue;
                const displayValue = this.formatNumber(
                    currentValue, 
                    counterData.isLargeNumber, 
                    counterData.isPercentage
                );
                
                element.textContent = `${counterData.prefix}${displayValue}${counterData.suffix}`;
                
                if (progress < 1) {
                    requestAnimationFrame(animate);
                } else {
                    // Ensure final value is exact
                    element.textContent = counterData.originalText;
                    element.classList.remove('counter-animating');
                    element.classList.add('counter-animated');
                    
                    // Add completion effect
                    this.addCompletionEffect(element);
                }
            };

            requestAnimationFrame(animate);
        }

        addCompletionEffect(element) {
            // Add a subtle scale pulse on completion
            element.style.transform = 'scale(1.05)';
            element.style.transition = 'transform 0.3s ease-out';
            
            setTimeout(() => {
                element.style.transform = 'scale(1)';
                setTimeout(() => {
                    element.style.transition = '';
                    element.style.transform = '';
                }, 300);
            }, 150);
        }

        observeElement(element) {
            if (element && !this.observedElements.has(element)) {
                this.observer.observe(element);
            }
        }

        observeElements(selector) {
            const elements = document.querySelectorAll(selector);
            elements.forEach(element => this.observeElement(element));
        }
    }

    // Initialize Enhanced Counter System
    const counterAnimator = new EnhancedCounterAnimator();
    
    // Observe various counter elements throughout the site
    counterAnimator.observeElements('.stat-number');
    counterAnimator.observeElements('[data-counter]');
    counterAnimator.observeElements('.counter-value');
    counterAnimator.observeElements('.metric-number');
    
    // Legacy support - observe stat items and look for counters inside
    document.querySelectorAll('.stat-item').forEach(item => {
        const counter = item.querySelector('.stat-number, [data-counter], .counter-value');
        if (counter) {
            counterAnimator.observeElement(counter);
        }
    });

    // Header scroll effect (integrated into combined scroll handler)
    let lastScrollY = window.scrollY;
    const header = document.querySelector('.site-header');

    // Add header handling to the combined scroll function
    const originalHandleCombinedScroll = handleCombinedScroll;
    handleCombinedScroll = function() {
        clearTimeout(scrollTimeout);
        scrollTimeout = setTimeout(() => {
            const scrolled = window.pageYOffset;

            // Handle scroll animations
            handleScrollAnimation();

            // Handle parallax elements
            const parallaxElements = document.querySelectorAll('.parallax');
            parallaxElements.forEach(el => {
                const rate = scrolled * -0.5;
                el.style.transform = `translateY(${rate}px)`;
            });

            // Handle header scroll effect
            if (header) {
                if (scrolled > 100) {
                    header.classList.add('scrolled');
                } else {
                    header.classList.remove('scrolled');
                }

                // Hide/show header on scroll
                if (scrolled > lastScrollY && scrolled > 200) {
                    header.style.transform = 'translateY(-100%)';
                } else {
                    header.style.transform = 'translateY(0)';
                }
                lastScrollY = scrolled;
            }
        }, 16); // ~60fps
    };

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

    // Sprint 3.1 - Enhanced Mobile Menu System
    class EnhancedMobileMenu {
        constructor() {
            this.menuTrigger = document.querySelector('.mobile-menu-trigger');
            this.mobileMenu = document.querySelector('.mobile-menu');
            this.menuBackdrop = document.querySelector('.mobile-menu-backdrop');
            this.menuClose = document.querySelector('.mobile-menu-close');

            this.isOpen = false;
            
            this.init();
        }

        init() {
            if (!this.menuTrigger || !this.mobileMenu || !this.menuBackdrop) return;

            // Event listeners
            this.menuTrigger.addEventListener('click', () => this.toggleMenu());
            this.menuClose.addEventListener('click', () => this.closeMenu());
            this.menuBackdrop.addEventListener('click', () => this.closeMenu());
            
            // Handle submenu toggles
            this.setupSubmenuToggles();
            
            // Handle link clicks
            this.setupLinkHandlers();
            
            // Handle mobile theme toggle
            this.setupMobileThemeToggle();
            
            // Keyboard navigation
            this.setupKeyboardNavigation();
            
            // Touch gesture support
            this.setupTouchGestures();
        }

        toggleMenu() {
            if (this.isOpen) {
                this.closeMenu();
            } else {
                this.openMenu();
            }
        }

        openMenu() {
            this.isOpen = true;
            this.mobileMenu.classList.add('active');
            this.menuBackdrop.classList.add('active');
            this.menuTrigger.classList.add('active');
            this.menuTrigger.setAttribute('aria-expanded', 'true');
            
            // Prevent body scroll
            document.body.style.overflow = 'hidden';
            
            // Focus management
            setTimeout(() => {
                const firstLink = this.mobileMenu.querySelector('.mobile-menu-link, .mobile-menu-toggle');
                if (firstLink) firstLink.focus();
            }, 300);
            
            // Analytics
            this.trackEvent('mobile_menu_opened');
        }

        closeMenu() {
            this.isOpen = false;
            this.mobileMenu.classList.remove('active');
            this.menuBackdrop.classList.remove('active');
            this.menuTrigger.classList.remove('active');
            this.menuTrigger.setAttribute('aria-expanded', 'false');
            
            // Restore body scroll
            document.body.style.overflow = '';
            
            // Return focus to trigger
            this.menuTrigger.focus();
            
            // Close all submenus
            this.closeAllSubmenus();
            
            // Analytics
            this.trackEvent('mobile_menu_closed');
        }

        setupSubmenuToggles() {
            const submenuToggles = this.mobileMenu.querySelectorAll('.mobile-menu-toggle');
            
            submenuToggles.forEach(toggle => {
                toggle.addEventListener('click', (e) => {
                    e.preventDefault();
                    this.toggleSubmenu(toggle);
                });
            });
        }

        toggleSubmenu(toggle) {
            const isExpanded = toggle.getAttribute('aria-expanded') === 'true';
            const submenu = toggle.nextElementSibling;
            
            if (isExpanded) {
                toggle.setAttribute('aria-expanded', 'false');
                submenu.style.maxHeight = '0';
            } else {
                // Close other submenus first
                this.closeOtherSubmenus(toggle);
                
                toggle.setAttribute('aria-expanded', 'true');
                submenu.style.maxHeight = submenu.scrollHeight + 'px';
            }
        }

        closeOtherSubmenus(currentToggle) {
            const allToggles = this.mobileMenu.querySelectorAll('.mobile-menu-toggle');
            
            allToggles.forEach(toggle => {
                if (toggle !== currentToggle) {
                    toggle.setAttribute('aria-expanded', 'false');
                    const submenu = toggle.nextElementSibling;
                    if (submenu) submenu.style.maxHeight = '0';
                }
            });
        }

        closeAllSubmenus() {
            const allToggles = this.mobileMenu.querySelectorAll('.mobile-menu-toggle');
            
            allToggles.forEach(toggle => {
                toggle.setAttribute('aria-expanded', 'false');
                const submenu = toggle.nextElementSibling;
                if (submenu) submenu.style.maxHeight = '0';
            });
        }

        setupLinkHandlers() {
            const menuLinks = this.mobileMenu.querySelectorAll('.mobile-menu-link');
            
            menuLinks.forEach(link => {
                link.addEventListener('click', () => {
                    // Close menu after navigation
                    setTimeout(() => this.closeMenu(), 150);
                    
                    // Analytics
                    this.trackEvent('mobile_menu_link_clicked', {
                        href: link.href,
                        text: link.textContent.trim()
                    });
                });
            });
        }


        // Graceful mobile theme toggle (no-op if toggle not present)
        setupMobileThemeToggle() {
            const toggles = this.mobileMenu.querySelectorAll('.mobile-theme-toggle, .theme-toggle, [data-action="toggle-theme"]');
            if (!toggles.length) {
                // Initialize from saved preference even if no toggle exists
                try {
                    const saved = localStorage.getItem('sm-theme');
                    if (saved) document.documentElement.setAttribute('data-theme', saved);
                } catch(e) {}
                return;
            }

            // Apply saved preference on load
            try {
                const saved = localStorage.getItem('sm-theme');
                if (saved) document.documentElement.setAttribute('data-theme', saved);
            } catch(e) {}

            toggles.forEach(toggle => {
                toggle.addEventListener('click', (e) => {
                    e.preventDefault();
                    const root = document.documentElement;
                    const current = root.getAttribute('data-theme');
                    const next = current === 'dark' ? 'light' : 'dark';
                    root.setAttribute('data-theme', next);
                    try { localStorage.setItem('sm-theme', next); } catch(e) {}
                });
            });
        }



        setupKeyboardNavigation() {
            this.mobileMenu.addEventListener('keydown', (e) => {
                if (e.key === 'Escape') {
                    this.closeMenu();
                }
                
                if (e.key === 'Tab') {
                    this.handleTabNavigation(e);
                }
            });
        }

        handleTabNavigation(e) {
            const focusableElements = this.mobileMenu.querySelectorAll(
                'a[href], button, [tabindex]:not([tabindex="-1"])'
            );
            
            const firstElement = focusableElements[0];
            const lastElement = focusableElements[focusableElements.length - 1];
            
            if (e.shiftKey) {
                if (document.activeElement === firstElement) {
                    e.preventDefault();
                    lastElement.focus();
                }
            } else {
                if (document.activeElement === lastElement) {
                    e.preventDefault();
                    firstElement.focus();
                }
            }
        }

        setupTouchGestures() {
            let startX = 0;
            let startY = 0;
            
            this.mobileMenu.addEventListener('touchstart', (e) => {
                startX = e.touches[0].clientX;
                startY = e.touches[0].clientY;
            }, { passive: true });
            
            this.mobileMenu.addEventListener('touchend', (e) => {
                const endX = e.changedTouches[0].clientX;
                const endY = e.changedTouches[0].clientY;
                
                const deltaX = endX - startX;
                const deltaY = Math.abs(endY - startY);
                
                // Swipe right to close (only if horizontal swipe is significant)
                if (deltaX > 100 && deltaY < 50) {
                    this.closeMenu();
                }
            }, { passive: true });
        }

        trackEvent(eventName, data = {}) {
            // Analytics integration
            if (typeof gtag !== 'undefined') {
                gtag('event', eventName, {
                    event_category: 'mobile_menu',
                    ...data
                });
            }
            
            console.log(`Mobile Menu Event: ${eventName}`, data);
        }

        // Public methods for external control
        open() { this.openMenu(); }
        close() { this.closeMenu(); }
        toggle() { this.toggleMenu(); }
        isMenuOpen() { return this.isOpen; }
    }

    // Initialize Enhanced Mobile Menu
    const mobileMenuSystem = new EnhancedMobileMenu();
    
    // Expose to global scope for external access
    window.smoothMigration = window.smoothMigration || {};
    window.smoothMigration.mobileMenu = mobileMenuSystem;

    // Sprint 3.2 - Touch-Optimized Interactions System
    class TouchOptimizedInteractions {
        constructor() {
            this.init();
        }

        init() {
            this.setupTouchRipples();
            this.setupCarouselSwipeGestures();
            this.setupTouchFeedback();
            this.optimizeScrolling();
        }

        setupTouchRipples() {
            // Enhanced touch ripple for buttons
            const buttons = document.querySelectorAll('.btn');
            buttons.forEach(button => {
                button.addEventListener('touchstart', (e) => {
                    if (button.classList.contains('loading') || button.disabled) return;
                    this.createTouchRipple(e, button, 'touch-ripple');
                }, { passive: true });
            });

            // Enhanced touch ripple for cards
            const cards = document.querySelectorAll('.service-card, .step-card, .feature-item, .testimonial-card, .stat-item');
            cards.forEach(card => {
                card.addEventListener('touchstart', (e) => {
                    this.createTouchRipple(e, card, 'card-ripple');
                }, { passive: true });
            });
        }

        createTouchRipple(event, element, className) {
            // Remove existing ripples
            const existingRipples = element.querySelectorAll('.' + className);
            existingRipples.forEach(ripple => ripple.remove());

            const ripple = document.createElement('span');
            const rect = element.getBoundingClientRect();
            
            // Get touch position
            const touch = event.touches[0] || event.changedTouches[0];
            const x = touch.clientX - rect.left;
            const y = touch.clientY - rect.top;
            
            // Calculate ripple size to cover the entire element
            const size = Math.max(
                Math.sqrt(Math.pow(x, 2) + Math.pow(y, 2)),
                Math.sqrt(Math.pow(rect.width - x, 2) + Math.pow(y, 2)),
                Math.sqrt(Math.pow(x, 2) + Math.pow(rect.height - y, 2)),
                Math.sqrt(Math.pow(rect.width - x, 2) + Math.pow(rect.height - y, 2))
            ) * 2.5;

            ripple.classList.add(className);
            ripple.style.width = ripple.style.height = `${size}px`;
            ripple.style.left = `${x - size / 2}px`;
            ripple.style.top = `${y - size / 2}px`;

            element.appendChild(ripple);

            // Remove ripple after animation
            setTimeout(() => {
                if (ripple.parentNode) {
                    ripple.remove();
                }
            }, 800);
        }

        setupCarouselSwipeGestures() {
            const carousels = document.querySelectorAll('.carousel, .partner-carousel, .testimonial-slider');
            
            carousels.forEach(carousel => {
                let startX = 0;
                let startY = 0;
                let isDragging = false;

                carousel.addEventListener('touchstart', (e) => {
                    startX = e.touches[0].clientX;
                    startY = e.touches[0].clientY;
                    isDragging = true;
                }, { passive: true });

                carousel.addEventListener('touchmove', (e) => {
                    if (!isDragging) return;

                    const currentX = e.touches[0].clientX;
                    const currentY = e.touches[0].clientY;
                    
                    const deltaX = Math.abs(currentX - startX);
                    const deltaY = Math.abs(currentY - startY);

                    // If horizontal swipe is more significant than vertical
                    if (deltaX > deltaY && deltaX > 10) {
                        e.preventDefault(); // Prevent scrolling
                    }
                }, { passive: false });

                carousel.addEventListener('touchend', (e) => {
                    if (!isDragging) return;
                    
                    const endX = e.changedTouches[0].clientX;
                    const endY = e.changedTouches[0].clientY;
                    
                    const deltaX = endX - startX;
                    const deltaY = Math.abs(endY - startY);
                    
                    // Only handle horizontal swipes
                    if (Math.abs(deltaX) > 50 && deltaY < 100) {
                        if (deltaX > 0) {
                            this.triggerCarouselAction(carousel, 'prev');
                        } else {
                            this.triggerCarouselAction(carousel, 'next');
                        }
                    }
                    
                    isDragging = false;
                }, { passive: true });
            });
        }

        triggerCarouselAction(carousel, direction) {
            // Bootstrap carousel integration
            if (carousel.classList.contains('carousel')) {
                const bsCarousel = bootstrap.Carousel.getInstance(carousel);
                if (bsCarousel) {
                    if (direction === 'next') {
                        bsCarousel.next();
                    } else {
                        bsCarousel.prev();
                    }
                }
                return;
            }

            // Custom carousel integration
            const nextBtn = carousel.querySelector('.carousel-control-next, .next-btn, [data-action="next"]');
            const prevBtn = carousel.querySelector('.carousel-control-prev, .prev-btn, [data-action="prev"]');

            if (direction === 'next' && nextBtn) {
                nextBtn.click();
            } else if (direction === 'prev' && prevBtn) {
                prevBtn.click();
            }

            // Add visual feedback
            this.addSwipeFeedback(carousel, direction);
        }

        addSwipeFeedback(element, direction) {
            const feedback = document.createElement('div');
            feedback.className = 'swipe-feedback';
            feedback.innerHTML = direction === 'next' ? '→' : '←';
            feedback.style.cssText = `
                position: absolute;
                top: 50%;
                ${direction === 'next' ? 'right' : 'left'}: 20px;
                transform: translateY(-50%);
                font-size: 2rem;
                color: var(--primary-color);
                background: rgba(255, 255, 255, 0.9);
                border-radius: 50%;
                width: 50px;
                height: 50px;
                display: flex;
                align-items: center;
                justify-content: center;
                animation: swipeFeedback 0.6s ease-out forwards;
                pointer-events: none;
                z-index: 10;
            `;

            element.style.position = 'relative';
            element.appendChild(feedback);

            setTimeout(() => {
                if (feedback.parentNode) {
                    feedback.remove();
                }
            }, 600);
        }

        setupTouchFeedback() {
            // Add haptic feedback for supported devices
            if ('vibrate' in navigator) {
                const interactiveElements = document.querySelectorAll('.btn, .service-card, .step-card, .mobile-menu-link');
                
                interactiveElements.forEach(element => {
                    element.addEventListener('touchstart', () => {
                        // Subtle haptic feedback (10ms)
                        navigator.vibrate(10);
                    }, { passive: true });
                });
            }

            // Enhanced visual feedback for all touch interactions
            document.addEventListener('touchstart', (e) => {
                const target = e.target.closest('.btn, .service-card, .step-card, .feature-item, .testimonial-card, .stat-item');
                if (target && !target.classList.contains('loading')) {
                    target.style.transition = 'transform 0.1s ease-out';
                    target.style.transform = 'scale(0.98)';
                }
            }, { passive: true });

            document.addEventListener('touchend', (e) => {
                const target = e.target.closest('.btn, .service-card, .step-card, .feature-item, .testimonial-card, .stat-item');
                if (target) {
                    setTimeout(() => {
                        target.style.transform = '';
                    }, 100);
                }
            }, { passive: true });
        }

        optimizeScrolling() {
            // Optimize scroll performance on touch devices
            if ('ontouchstart' in window) {
                // Enable momentum scrolling on iOS
                document.body.style.webkitOverflowScrolling = 'touch';
                
                // Optimize scroll containers
                const scrollContainers = document.querySelectorAll('.mobile-menu-content, .modal-body, .carousel-inner');
                scrollContainers.forEach(container => {
                    container.style.webkitOverflowScrolling = 'touch';
                    container.style.overscrollBehavior = 'contain';
                });
            }
        }

        // Public methods for external control
        enableTouchOptimizations() {
            document.body.classList.add('touch-optimized');
        }

        disableTouchOptimizations() {
            document.body.classList.remove('touch-optimized');
        }
    }

    // Initialize Touch-Optimized Interactions
    const touchInteractions = new TouchOptimizedInteractions();
    window.smoothMigration.touchInteractions = touchInteractions;

    // Add swipe feedback animation to CSS
    if (!document.querySelector('#swipe-feedback-styles')) {
        const swipeStyles = document.createElement('style');
        swipeStyles.id = 'swipe-feedback-styles';
        swipeStyles.textContent = `
            @keyframes swipeFeedback {
                0% {
                    opacity: 0;
                    transform: translateY(-50%) scale(0.5);
                }
                50% {
                    opacity: 1;
                    transform: translateY(-50%) scale(1.1);
                }
                100% {
                    opacity: 0;
                    transform: translateY(-50%) scale(1);
                }
            }
        `;
        document.head.appendChild(swipeStyles);
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

    // Modal enhancements (skip Quick View to avoid double animations)
    document.querySelectorAll('.modal').forEach(modal => {
        modal.addEventListener('show.bs.modal', function() {
            if (this.id === 'quickViewModal' || this.classList.contains('quickview-modal')) return;
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
            if (this.id === 'quickViewModal' || this.classList.contains('quickview-modal')) return;
            this.style.transition = 'all 0.2s ease';
            this.style.opacity = '0';
            this.style.transform = 'scale(0.9)';
        });
    });

    // Sprint 2.2 - Enhanced Button Micro-interactions System
    class AdvancedButtonInteractions {
        constructor() {
            this.magneticButtons = document.querySelectorAll('.btn[data-magnetic="true"]');
            this.allButtons = document.querySelectorAll('.btn');
            this.setupMagneticEffect();
            this.setupEnhancedRipples();
            this.setupButtonStates();
        }

        setupMagneticEffect() {
            // Only enable magnetic effect on devices with fine pointers (mouse)
            if (!window.matchMedia('(hover: hover) and (pointer: fine)').matches) {
                return;
            }

            this.magneticButtons.forEach(btn => {
                btn.addEventListener('mouseenter', (e) => this.enableMagnetic(e.target));
                btn.addEventListener('mousemove', (e) => this.handleMagneticMove(e));
                btn.addEventListener('mouseleave', (e) => this.disableMagnetic(e.target));
            });
        }

        enableMagnetic(button) {
            if (button.classList.contains('loading')) return;
            button.style.transition = 'transform 0.1s ease-out';
        }

        handleMagneticMove(e) {
            if (e.target.classList.contains('loading')) return;

            const button = e.target;
            const rect = button.getBoundingClientRect();
            const centerX = rect.left + rect.width / 2;
            const centerY = rect.top + rect.height / 2;
            const mouseX = e.clientX;
            const mouseY = e.clientY;

            // Calculate distance from center
            const distanceX = (mouseX - centerX) * 0.3;
            const distanceY = (mouseY - centerY) * 0.3;

            // Apply magnetic transform
            button.style.transform = `translate(${distanceX}px, ${distanceY}px) scale(1.02)`;
        }

        disableMagnetic(button) {
            button.style.transition = 'transform 0.4s cubic-bezier(0.4, 0, 0.2, 1)';
            button.style.transform = '';
            
            setTimeout(() => {
                button.style.transition = '';
            }, 400);
        }

        setupEnhancedRipples() {
            this.allButtons.forEach(btn => {
                btn.addEventListener('click', (e) => this.createEnhancedRipple(e));
            });
        }

        createEnhancedRipple(e) {
            const button = e.currentTarget;
            
            // Skip ripple for disabled/loading buttons
            if (button.classList.contains('loading') || 
                button.disabled || 
                button.classList.contains('btn-locked')) {
                return;
            }

            // Remove existing ripples
            const existingRipples = button.querySelectorAll('.ripple');
            existingRipples.forEach(ripple => ripple.remove());

            const ripple = document.createElement('span');
            const rect = button.getBoundingClientRect();
            
            // Get exact click position
            const x = e.clientX - rect.left;
            const y = e.clientY - rect.top;
            
            // Calculate ripple size to ensure it covers the entire button
            const size = Math.max(
                Math.sqrt(Math.pow(x, 2) + Math.pow(y, 2)),
                Math.sqrt(Math.pow(rect.width - x, 2) + Math.pow(y, 2)),
                Math.sqrt(Math.pow(x, 2) + Math.pow(rect.height - y, 2)),
                Math.sqrt(Math.pow(rect.width - x, 2) + Math.pow(rect.height - y, 2))
            ) * 2;

            ripple.classList.add('ripple');
            ripple.style.width = ripple.style.height = `${size}px`;
            ripple.style.left = `${x - size / 2}px`;
            ripple.style.top = `${y - size / 2}px`;

            button.appendChild(ripple);

            // Remove ripple after animation
            setTimeout(() => {
                if (ripple.parentNode) {
                    ripple.remove();
                }
            }, 800);
        }

        setupButtonStates() {
            // Enhanced focus handling
            this.allButtons.forEach(btn => {
                btn.addEventListener('focus', function() {
                    if (!this.classList.contains('loading')) {
                        this.style.transform = 'scale(1.02)';
                    }
                });

                btn.addEventListener('blur', function() {
                    if (!this.classList.contains('loading')) {
                        this.style.transform = '';
                    }
                });
            });
        }

        // Public methods for state management
        setButtonLoading(button, progress = null) {
            if (typeof button === 'string') {
                button = document.querySelector(button);
            }
            if (!button) return;

            button.classList.add('loading');
            button.disabled = true;
            
            // Store original content
            if (!button.dataset.originalContent) {
                button.dataset.originalContent = button.innerHTML;
            }

            // Apply fixed dimensions to prevent layout shift
            const rect = button.getBoundingClientRect();
            button.style.width = rect.width + 'px';
            button.style.height = rect.height + 'px';

            // Add loading spinner
            button.innerHTML = button.dataset.originalContent + '<span class="btn-loading-spinner"></span>';

            // Set progress if provided
            if (progress !== null) {
                button.style.setProperty('--progress', `${Math.min(100, Math.max(0, progress))}%`);
            }
        }

        setButtonSuccess(button, message = null) {
            if (typeof button === 'string') {
                button = document.querySelector(button);
            }
            if (!button) return;

            button.classList.remove('loading');
            button.classList.add('success');
            
            if (message) {
                const originalContent = button.dataset.originalContent || button.innerHTML;
                button.innerHTML = message;
                
                setTimeout(() => {
                    button.innerHTML = originalContent;
                    this.resetButton(button);
                }, 2000);
            } else {
                setTimeout(() => {
                    this.resetButton(button);
                }, 1500);
            }
        }

        setButtonError(button, message = null) {
            if (typeof button === 'string') {
                button = document.querySelector(button);
            }
            if (!button) return;

            button.classList.remove('loading');
            button.classList.add('error');
            
            if (message) {
                const originalContent = button.dataset.originalContent || button.innerHTML;
                button.innerHTML = message;
                
                setTimeout(() => {
                    button.innerHTML = originalContent;
                    this.resetButton(button);
                }, 2500);
            } else {
                setTimeout(() => {
                    this.resetButton(button);
                }, 1500);
            }
        }

        resetButton(button) {
            if (typeof button === 'string') {
                button = document.querySelector(button);
            }
            if (!button) return;

            button.classList.remove('loading', 'success', 'error');
            button.disabled = false;
            button.style.removeProperty('width');
            button.style.removeProperty('height');
            button.style.removeProperty('--progress');
            
            if (button.dataset.originalContent) {
                button.innerHTML = button.dataset.originalContent;
                delete button.dataset.originalContent;
            }
        }

        updateProgress(button, progress) {
            if (typeof button === 'string') {
                button = document.querySelector(button);
            }
            if (!button) return;

            button.style.setProperty('--progress', `${Math.min(100, Math.max(0, progress))}%`);
        }
    }

    // Initialize Advanced Button Interactions
    const buttonInteractions = new AdvancedButtonInteractions();

    // Expose to global scope for external usage
    window.smoothMigration = window.smoothMigration || {};
    window.smoothMigration.buttonInteractions = buttonInteractions;

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

    // Combined scroll handler for better performance
    let scrollTimeout;
    function handleCombinedScroll() {
        clearTimeout(scrollTimeout);
        scrollTimeout = setTimeout(() => {
            const scrolled = window.pageYOffset;

            // Handle scroll animations
            handleScrollAnimation();

            // Handle parallax elements
            const parallaxElements = document.querySelectorAll('.parallax');
            parallaxElements.forEach(el => {
                const rate = scrolled * -0.5;
                el.style.transform = `translateY(${rate}px)`;
            });
        }, 16); // ~60fps
    }

    window.addEventListener('scroll', handleCombinedScroll, { passive: true });

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

    // CTA hover → animate icon (FA or Lordicon) inside the button
    ['.cta-relocating', '.cta-employer', '.cta-partner'].forEach(selector => {
        document.querySelectorAll(selector).forEach(button => {
            const lord = button.querySelector('lord-icon');
            const fa = button.querySelector('.icon-glow i');
            button.addEventListener('mouseenter', () => {
                if (!prefersReduced && lord && lord.play) lord.play();
                if (fa) fa.style.transform = 'translateY(-2px) scale(1.08)';
            });
            button.addEventListener('mouseleave', () => {
                if (lord && lord.stop) lord.stop();
                if (fa) fa.style.transform = '';
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

    // Observe both Lordicon and FA wrappers for in-view animation
    document.querySelectorAll('.why-us lord-icon, .resource-link lord-icon, .resource-icon lord-icon').forEach(el => iconObserver.observe(el));
    const faIconObserver = new IntersectionObserver((entries, obs) => {
        entries.forEach(entry => {
            if (!entry.isIntersecting) return;
            const wrap = entry.target;
            wrap.classList.add('in-view');
            obs.unobserve(wrap);
        });
    }, { threshold: 0.25 });
    document.querySelectorAll('.why-us .icon-glow, .resource-link .icon-glow, .resource-icon .icon-glow').forEach(el => faIconObserver.observe(el));
});

// Performance monitoring utility
window.smoothMigration = window.smoothMigration || {};
window.smoothMigration.performance = {
    // Track script execution time
    scriptStartTime: performance.now(),

    // Monitor globe instances
    globeInstances: 0,

    // Track event listeners
    eventListeners: {
        scroll: 0,
        resize: 0
    },

    // Log performance metrics
    logMetrics: function() {
        const loadTime = performance.now() - this.scriptStartTime;
        console.log('[Performance] Page load time:', loadTime + 'ms');
        console.log('[Performance] Globe instances:', this.globeInstances);

        // Check for multiple globes (performance issue indicator)
        if (this.globeInstances > 1) {
            console.warn('[Performance] Multiple globe instances detected! This may cause performance issues.');
        }
    },

    // Track globe creation
    trackGlobe: function() {
        this.globeInstances++;
    }
};

// Utility functions
window.smoothMigration = window.smoothMigration || {};
window.smoothMigration.utils = {
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

// Log performance metrics on page load
document.addEventListener('DOMContentLoaded', function() {
    setTimeout(() => {
        window.smoothMigration.performance.logMetrics();
    }, 100);
}); 
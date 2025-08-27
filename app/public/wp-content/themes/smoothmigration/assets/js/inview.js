/**
 * Sprint 3.3 - Enhanced Intersection Observer with Performance Scaling
 * Smooth Migration Theme - Accessible & Performance-Optimized
 */

document.addEventListener('DOMContentLoaded', function() {
    // Performance and capability detection
    const performanceMonitor = new PerformanceMonitor();
    
    // Respect user's motion preferences
    const prefersReducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)');
    
    if (prefersReducedMotion.matches || performanceMonitor.isLowPerformance()) {
        // If reduced motion is preferred or low performance, just add visible classes immediately
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
        const heroFloatingElements = document.querySelectorAll('.floating-cube');
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

// Sprint 3.3 - Performance Monitor Class
class PerformanceMonitor {
    constructor() {
        this.performanceScore = 0;
        this.capabilities = {
            hasGoodCPU: true,
            hasGoodGPU: true,
            hasGoodNetwork: true,
            hasGoodBattery: true,
            hasReducedData: false
        };
        
        this.detectCapabilities();
        this.applyOptimizations();
    }

    detectCapabilities() {
        // CPU Detection
        this.detectCPUPerformance();
        
        // GPU Detection  
        this.detectGPUPerformance();
        
        // Network Detection
        this.detectNetworkCapabilities();
        
        // Battery Detection
        this.detectBatteryLevel();
        
        // Data Saver Detection
        this.detectDataSaver();
        
        // Screen size considerations
        this.detectScreenCapabilities();
        
        // Memory considerations
        this.detectMemoryCapabilities();
    }

    detectCPUPerformance() {
        // Hardware concurrency (CPU cores)
        const cores = navigator.hardwareConcurrency || 1;
        
        // Simple performance test
        const start = performance.now();
        let iterations = 0;
        while (performance.now() - start < 10) {
            iterations++;
        }
        
        // Score based on iterations and cores
        this.performanceScore += (iterations / 1000) * cores;
        
        // Consider low performance if score is below threshold
        if (this.performanceScore < 50 || cores < 4) {
            this.capabilities.hasGoodCPU = false;
        }
    }

    detectGPUPerformance() {
        try {
            const canvas = document.createElement('canvas');
            const gl = canvas.getContext('webgl') || canvas.getContext('experimental-webgl');
            
            if (!gl) {
                this.capabilities.hasGoodGPU = false;
                return;
            }
            
            // Check for GPU info
            const debugInfo = gl.getExtension('WEBGL_debug_renderer_info');
            if (debugInfo) {
                const renderer = gl.getParameter(debugInfo.UNMASKED_RENDERER_WEBGL);
                
                // Check for integrated/low-end GPUs
                if (renderer.includes('Intel') && 
                    (renderer.includes('HD') || renderer.includes('UHD') || 
                     renderer.includes('Iris') && !renderer.includes('Pro'))) {
                    this.capabilities.hasGoodGPU = false;
                }
            }
        } catch (e) {
            this.capabilities.hasGoodGPU = false;
        }
    }

    detectNetworkCapabilities() {
        if ('connection' in navigator) {
            const connection = navigator.connection;
            
            // Check effective connection type
            const slowConnections = ['slow-2g', '2g', '3g'];
            if (slowConnections.includes(connection.effectiveType)) {
                this.capabilities.hasGoodNetwork = false;
            }
            
            // Check data saver
            if (connection.saveData) {
                this.capabilities.hasReducedData = true;
            }
        }
    }

    detectBatteryLevel() {
        if ('getBattery' in navigator) {
            navigator.getBattery().then(battery => {
                // Low battery optimization
                if (battery.level < 0.2 && !battery.charging) {
                    this.capabilities.hasGoodBattery = false;
                    this.applyBatteryOptimizations();
                }
                
                // Listen for battery changes
                battery.addEventListener('levelchange', () => {
                    if (battery.level < 0.2 && !battery.charging) {
                        this.capabilities.hasGoodBattery = false;
                        this.applyBatteryOptimizations();
                    }
                });
            }).catch(() => {
                // Battery API not supported, assume good battery
                this.capabilities.hasGoodBattery = true;
            });
        }
    }

    detectDataSaver() {
        // Check for data saver preference
        if ('connection' in navigator && navigator.connection.saveData) {
            this.capabilities.hasReducedData = true;
        }
        
        // Check for prefers-reduced-data (future spec)
        if (window.matchMedia && window.matchMedia('(prefers-reduced-data: reduce)').matches) {
            this.capabilities.hasReducedData = true;
        }
    }

    detectScreenCapabilities() {
        const screenWidth = window.screen.width;
        const screenHeight = window.screen.height;
        const pixelRatio = window.devicePixelRatio || 1;
        
        // Lower performance expectations for small/low-DPI screens
        if (screenWidth < 768 && pixelRatio < 2) {
            this.performanceScore -= 20;
        }
        
        // Very small screens get reduced animations
        if (screenWidth < 480) {
            this.capabilities.hasGoodGPU = false;
        }
    }

    detectMemoryCapabilities() {
        if ('memory' in performance) {
            const memInfo = performance.memory;
            const memoryRatio = memInfo.usedJSHeapSize / memInfo.jsHeapSizeLimit;
            
            // High memory usage indicates potential performance issues
            if (memoryRatio > 0.8) {
                this.performanceScore -= 30;
            }
        }
        
        // Check available system memory (Chrome-specific)
        if ('deviceMemory' in navigator) {
            const deviceMemory = navigator.deviceMemory; // GB
            
            if (deviceMemory < 4) {
                this.capabilities.hasGoodCPU = false;
            }
        }
    }

    applyOptimizations() {
        const body = document.body;
        
        // Apply performance classes
        if (this.isLowPerformance()) {
            body.classList.add('low-performance');
        }
        
        if (!this.capabilities.hasGoodBattery) {
            body.classList.add('low-battery');
        }
        
        if (this.capabilities.hasReducedData) {
            body.classList.add('reduced-data');
        }
        
        if (!this.capabilities.hasGoodNetwork) {
            body.classList.add('slow-connection');
        }
        
        if (!this.capabilities.hasGoodCPU && !this.capabilities.hasGoodGPU) {
            body.classList.add('reduced-performance');
        }
    }

    applyBatteryOptimizations() {
        document.body.classList.add('low-battery');
        
        // Disable intensive animations
        const animatedElements = document.querySelectorAll('.hero-landing::before, .floating-cube');
        animatedElements.forEach(element => {
            element.style.animationPlayState = 'paused';
        });
    }

    isLowPerformance() {
        return this.performanceScore < 30 || 
               (!this.capabilities.hasGoodCPU && !this.capabilities.hasGoodGPU) ||
               !this.capabilities.hasGoodBattery;
    }

    // Public methods for external access
    getPerformanceScore() {
        return this.performanceScore;
    }

    getCapabilities() {
        return { ...this.capabilities };
    }

    // Method to re-evaluate performance (e.g., after page changes)
    reevaluatePerformance() {
        this.detectCapabilities();
    }
}

// Expose PerformanceMonitor globally
window.PerformanceMonitor = PerformanceMonitor;

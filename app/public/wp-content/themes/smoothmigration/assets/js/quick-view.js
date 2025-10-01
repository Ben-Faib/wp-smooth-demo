/**
 * Sprint 2.3 - Advanced Service Card Interactions
 * Enhanced Quick View Modal with Card Flip Animations
 */

document.addEventListener('DOMContentLoaded', function() {
    // Sprint 2.3 - Service Card Advanced Interactions System
    class ServiceCardInteractions {
        constructor() {
            this.prefersReducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
            this.activeModal = null;
            this.modalListenersAttached = false;
            this.lastOpeningCard = null;
            this.initializeFlipCards();
            this.initializeQuickViewModal();
            this.initializeAccessibilityFeatures();
        }

        initializeFlipCards() {
            // Add flip functionality to service cards
            const serviceCards = document.querySelectorAll('.service-card');
            
            serviceCards.forEach((card, index) => {
                // Wrap existing card content for flip functionality
                this.prepareCardForFlip(card, index);
            });
        }

        prepareCardForFlip(card, index) {
            // Skip if already prepared or if reduced motion is preferred
            if (card.querySelector('.service-card-flip') || this.prefersReducedMotion) {
                return;
            }

            // Store original content
            const originalContent = card.innerHTML;
            
            // Create flip structure
            const flipContainer = document.createElement('div');
            flipContainer.className = 'service-card-flip';
            
            const innerContainer = document.createElement('div');
            innerContainer.className = 'service-card-inner';
            
            const frontSide = document.createElement('div');
            frontSide.className = 'service-card-front';
            frontSide.innerHTML = originalContent;
            
            const backSide = document.createElement('div');
            backSide.className = 'service-card-back';
            backSide.innerHTML = this.generateBackContent(card, index);
            
            // Add flip button to front
            const flipButton = document.createElement('button');
            flipButton.className = 'service-flip-button';
            flipButton.setAttribute('aria-label', 'Show service details');
            flipButton.innerHTML = '<i class="fas fa-info-circle"></i>';
            
            // Add event listener for flip
            flipButton.addEventListener('click', (e) => {
                e.preventDefault();
                e.stopPropagation();
                this.toggleCardFlip(flipContainer, flipButton);
            });
            
            frontSide.appendChild(flipButton);
            
            // Assemble structure
            innerContainer.appendChild(frontSide);
            innerContainer.appendChild(backSide);
            flipContainer.appendChild(innerContainer);
            
            // Replace original content
            card.innerHTML = '';
            card.appendChild(flipContainer);
            
            // Add reveal animation
            setTimeout(() => {
                card.setAttribute('data-reveal', 'true');
            }, index * 100);
        }

        generateBackContent(card, index) {
            // Generate sample service details (in real implementation, this would come from data attributes or API)
            const serviceTitle = card.querySelector('.service-title, h3, h4, h5')?.textContent || 'Service Details';
            
            const sampleDetails = [
                'Professional consultation',
                'Documentation assistance', 
                'Expert guidance',
                'Ongoing support',
                '24/7 availability',
                'Multi-language support'
            ];

            return `
                <div class="service-back-content">
                    <h4 class="service-back-title">${serviceTitle}</h4>
                    <ul class="service-details-list">
                        ${sampleDetails.slice(0, 4).map(detail => `<li>${detail}</li>`).join('')}
                    </ul>
                    <div class="service-back-actions">
                        <button class="btn btn-primary btn-sm btn-quick-view" 
                                data-service-type="sample-${index}" 
                                data-service-type-name="${serviceTitle}">
                            <i class="fas fa-eye me-1"></i> Quick View
                        </button>
                    </div>
                </div>
            `;
        }

        toggleCardFlip(flipContainer, flipButton) {
            const isFlipped = flipContainer.classList.contains('flipped');
            
            if (isFlipped) {
                flipContainer.classList.remove('flipped');
                flipButton.setAttribute('aria-label', 'Show service details');
                flipButton.setAttribute('aria-expanded', 'false');
            } else {
                flipContainer.classList.add('flipped');
                flipButton.setAttribute('aria-label', 'Show service summary');
                flipButton.setAttribute('aria-expanded', 'true');
            }
        }

        initializeQuickViewModal() {
            // Prevent duplicate bindings if script was enqueued twice
            window.smoothMigration = window.smoothMigration || {};
            if (window.smoothMigration.__qvHandlerBound) return;
            window.smoothMigration.__qvHandlerBound = true;

            // Single delegated handler to prevent duplicate bindings
            document.addEventListener('click', (e) => {
                const trigger = e.target.classList.contains('btn-quick-view')
                    ? e.target
                    : e.target.closest('.btn-quick-view');
                if (!trigger) return;
                e.preventDefault();
                e.stopPropagation();
                this.openQuickViewModal(trigger);
            });
        }

        attachModalListeners(modal) {
            if (this.modalListenersAttached) return;
            this.modalListenersAttached = true;
            modal.addEventListener('shown.bs.modal', () => {
                if (this.lastOpeningCard) {
                    this.lastOpeningCard.classList.remove('modal-opening');
                }
                this.focusModalContent(modal);
            });
            modal.addEventListener('hidden.bs.modal', () => {
                if (this.lastOpeningCard) {
                    this.lastOpeningCard.classList.remove('modal-opening');
                    this.lastOpeningCard = null;
                }
            });
        }

        openQuickViewModal(button) {
            const card = button.closest('.service-list-card, .service-card');
            const serviceType = button.dataset.serviceType || card?.dataset.serviceType || 'general';
            const serviceTypeName = button.dataset.serviceTypeName || card?.dataset.title || 'Service';

            if (card && !this.prefersReducedMotion) {
                card.classList.add('modal-opening');
                this.lastOpeningCard = card;
            }

            let modal = document.getElementById('quickViewModal');
            if (!modal) {
                modal = this.createQuickViewModal();
            } else {
                // Ensure Quick View modal has a distinct class for scoped behavior
                modal.classList.add('quickview-modal');
            }
            this.attachModalListeners(modal);

            if (card && (card.dataset.title || card.dataset.link || card.dataset.excerpt)) {
                this.updateModalContentFromCard(modal, card);
            } else {
                this.updateModalContent(modal, serviceType, serviceTypeName);
            }

            const bsModal = bootstrap.Modal.getOrCreateInstance(modal, {
                backdrop: true,
                keyboard: true,
                focus: true
            });
            bsModal.show();
            this.activeModal = bsModal;
        }

        createQuickViewModal() {
            const modal = document.createElement('div');
            modal.className = 'modal fade quickview-modal';
            modal.id = 'quickViewModal';
            modal.setAttribute('tabindex', '-1');
            modal.setAttribute('aria-labelledby', 'quickViewModalLabel');
            modal.setAttribute('aria-hidden', 'true');
            
            modal.innerHTML = `
                <div class="modal-dialog modal-dialog-centered modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="quickViewModalLabel">Quick View</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body"></div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            `;
            
            document.body.appendChild(modal);
            return modal;
        }

        updateModalContentFromCard(modal, card) {
            const title = card.dataset.title || 'Service';
            const excerpt = card.dataset.excerpt || '';
            const logo = card.dataset.logo || '';
            const link = card.dataset.link || '#';
            const affiliate = card.dataset.affiliate || link;
            const serviceType = (card.dataset.serviceType || '').toLowerCase();
            const hasWidget = (card.dataset.hasWidget || '0') === '1';

            let affiliateText = 'Explore Partner Services';
            if (serviceType.includes('insurance')) {
                affiliateText = 'Get a Quote';
            }

            // If this service has an on-site widget, route to service page with a widget intent param
            let ctaHref = affiliate;
            let ctaTarget = ' target="_blank"';
            let ctaRel = ' rel="nofollow noopener"';
            if (hasWidget) {
                const base = link.replace(/#.*$/, '');
                const sep = base.includes('?') ? '&' : '?';
                ctaHref = `${base}${sep}toWidget=1`;
                ctaTarget = '';
                ctaRel = '';
            }

            const titleEl = modal.querySelector('.modal-title');
            if (titleEl) titleEl.textContent = title;

            const bodyEl = modal.querySelector('.modal-body');
            if (bodyEl) {
                // Parse the blurb intelligently
                const parsedContent = this.parseBlurb(excerpt, title, serviceType);
                
                bodyEl.innerHTML = `
                    <div class="qv-enhanced-content">
                        <!-- Logo and Value Prop Section -->
                        <div class="qv-header-section">
                            ${logo ? `
                                <div class="qv-logo-container">
                                    <img src="${logo}" alt="${title}" class="qv-logo" />
                                </div>
                            ` : ''}
                            ${parsedContent.valueProp ? `
                                <div class="qv-value-prop">
                                    <i class="fas fa-quote-left qv-quote-icon"></i>
                                    <p class="qv-value-text">${parsedContent.valueProp}</p>
                                </div>
                            ` : ''}
                        </div>

                        <!-- Key Benefits Section -->
                        ${parsedContent.benefits.length > 0 ? `
                            <div class="qv-benefits-section">
                                <h6 class="qv-section-title">
                                    <i class="fas fa-check-circle"></i> Key Benefits
                                </h6>
                                <ul class="qv-benefits-list">
                                    ${parsedContent.benefits.map(benefit => `
                                        <li class="qv-benefit-item">
                                            <i class="fas fa-check"></i>
                                            <span>${benefit}</span>
                                        </li>
                                    `).join('')}
                                </ul>
                            </div>
                        ` : ''}

                        <!-- Full Description (if no parsing available) -->
                        ${!parsedContent.valueProp && parsedContent.benefits.length === 0 ? `
                            <div class="qv-description">
                                <p class="qv-description-text">${excerpt}</p>
                            </div>
                        ` : ''}

                        <!-- Trust Signals & Badges -->
                        <div class="qv-trust-section">
                            ${parsedContent.trustSignals.map(signal => `
                                <span class="qv-trust-badge">
                                    <i class="${signal.icon}"></i> ${signal.text}
                                </span>
                            `).join('')}
                            ${parsedContent.trustSignals.length === 0 ? `
                                <span class="qv-trust-badge">
                                    <i class="fas fa-shield-alt"></i> Verified Partner
                                </span>
                            ` : ''}
                        </div>

                        <!-- Call to Action Section -->
                        <div class="qv-cta-section">
                            <a id="qvAffiliate" href="${ctaHref}"${ctaTarget}${ctaRel} class="btn btn-primary qv-btn-primary">
                                <i class="fas fa-external-link-alt"></i>
                                <span>${affiliateText}</span>
                            </a>
                            <a id="qvLearn" href="${link}" class="btn btn-outline-primary qv-btn-secondary">
                                <i class="fas fa-info-circle"></i>
                                <span>Learn More</span>
                            </a>
                        </div>
                    </div>
                `;
            }
        }

        /**
         * Intelligently parse blurb content to extract structure
         * @param {string} blurb - The full blurb text
         * @param {string} title - Service title
         * @param {string} serviceType - Service category
         * @returns {Object} Parsed content with valueProp, benefits, and trustSignals
         */
        parseBlurb(blurb, title, serviceType) {
            const parsed = {
                valueProp: '',
                benefits: [],
                trustSignals: []
            };

            if (!blurb) return parsed;

            // Remove the "ServiceName — Category:" prefix if present
            let cleanedBlurb = blurb.replace(/^[^—]+—\s*[^:]+:\s*/i, '');
            
            // Split into sentences
            const sentences = cleanedBlurb.split(/\.\s+/).filter(s => s.trim().length > 0);
            
            if (sentences.length === 0) {
                return parsed;
            }

            // First sentence is usually the value prop
            parsed.valueProp = sentences[0] + (sentences[0].endsWith('.') ? '' : '.');

            // Look for bullet-separated benefits (• symbol)
            if (cleanedBlurb.includes('•')) {
                const bulletSection = cleanedBlurb.split('•').slice(1);
                parsed.benefits = bulletSection
                    .map(b => b.replace(/\.$/, '').trim())
                    .filter(b => b.length > 0 && b.length < 150);
            }
            // Look for benefits in sentences containing keywords
            else if (sentences.length > 1) {
                for (let i = 1; i < Math.min(sentences.length, 4); i++) {
                    const sentence = sentences[i].trim();
                    // Check if sentence describes a feature/benefit
                    if (sentence.length > 15 && sentence.length < 120) {
                        // Look for benefit indicators
                        const benefitKeywords = /\b(offers?|provides?|includes?|features?|helps?|allows?|enables?|supports?|delivers?|ensures?|gives?)\b/i;
                        if (benefitKeywords.test(sentence) || i <= 3) {
                            parsed.benefits.push(sentence + (sentence.endsWith('.') ? '' : '.'));
                        }
                    }
                }
                // Limit to 4 benefits max
                parsed.benefits = parsed.benefits.slice(0, 4);
            }

            // Extract trust signals from text - only use specific, high-value patterns
            const trustPatterns = [
                // Numbers with units (most valuable)
                { 
                    pattern: /(\d+(?:[\+M]|million)?)\s*(?:\+)?\s*(customers?|users?|members?|clients?|reviews?|countries|locations|cities|years?)/gi, 
                    icon: 'fas fa-users',
                    extract: (match) => {
                        // Clean up the match to create a natural phrase
                        const text = match[0].replace(/\s+/g, ' ').trim();
                        if (text.match(/\d/)) return this.capitalizeFirst(text);
                        return null;
                    }
                },
                // Ratings
                { 
                    pattern: /rated\s+(\d+(?:\.\d+)?)\s*(?:\/\s*\d+)?\s*stars?/gi,
                    icon: 'fas fa-star',
                    extract: (match) => this.capitalizeFirst(match[0])
                },
                { 
                    pattern: /(\d+(?:\.\d+)?)\s*(?:\/\s*\d+)?\s*star[s]?\s+rated/gi,
                    icon: 'fas fa-star',
                    extract: (match) => this.capitalizeFirst(match[0])
                },
                // Credentials (only if part of meaningful phrase)
                { 
                    pattern: /(?:licensed|verified|certified|accredited|approved|backed)\s+(?:by|and|in)\s+[\w\s]{2,20}(?:\.|,|$)/gi,
                    icon: 'fas fa-shield-alt',
                    extract: (match) => {
                        const text = match[0].replace(/[.,]$/, '').trim();
                        if (text.length > 10 && text.length < 50) return this.capitalizeFirst(text);
                        return null;
                    }
                },
                // 24/7 support (specific)
                { 
                    pattern: /24\/7\s+(?:support|assistance|customer\s+support|help)/gi,
                    icon: 'fas fa-headset',
                    extract: (match) => this.capitalizeFirst(match[0])
                }
            ];

            // Process each pattern
            trustPatterns.forEach(({ pattern, icon, extract }) => {
                if (parsed.trustSignals.length >= 3) return; // Max 3 badges
                
                const matches = cleanedBlurb.matchAll(pattern);
                for (const match of matches) {
                    if (parsed.trustSignals.length >= 3) break;
                    
                    const extractedText = extract(match);
                    if (extractedText && extractedText.length > 5 && extractedText.length < 60) {
                        // Avoid duplicates
                        const isDuplicate = parsed.trustSignals.some(
                            signal => signal.text.toLowerCase() === extractedText.toLowerCase()
                        );
                        
                        if (!isDuplicate) {
                            parsed.trustSignals.push({
                                text: extractedText,
                                icon: icon
                            });
                        }
                    }
                }
            });

            return parsed;
        }

        /**
         * Capitalize first letter of a string
         */
        capitalizeFirst(str) {
            if (!str) return '';
            return str.charAt(0).toUpperCase() + str.slice(1);
        }

        updateModalContent(modal, serviceType, serviceTypeName) {
            const titleElement = modal.querySelector('.modal-title');
            const bodyElement = modal.querySelector('.modal-body');
            
            titleElement.textContent = `Quick View: ${serviceTypeName}`;
            
            // Show loading state
            bodyElement.innerHTML = `
                <div class="text-center">
                    <div class="spinner-border text-primary" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                    <p class="mt-2 text-muted">Loading service details...</p>
                </div>
            `;

            // Simulate content loading (replace with actual AJAX call)
            setTimeout(() => {
                this.loadServiceDetails(bodyElement, serviceType, serviceTypeName);
            }, 800);
        }

        loadServiceDetails(bodyElement, serviceType, serviceTypeName) {
            // Enhanced service details with glassmorphism styling
            const mockServices = [
                { title: 'Premium Consultation', description: 'One-on-one expert guidance tailored to your needs' },
                { title: 'Document Processing', description: 'Complete assistance with all required paperwork' },
                { title: 'Status Tracking', description: 'Real-time updates on your application progress' },
                { title: 'Support Network', description: 'Access to our community and support resources' }
            ];

            const content = `
                <div class="service-details-content">
                    <div class="mb-4">
                        <h6 class="text-primary fw-bold mb-3">Available Services</h6>
                        <div class="row g-3">
                            ${mockServices.map(service => `
                                <div class="col-md-6">
                                    <div class="service-detail-item p-3 rounded" style="
                                        background: color-mix(in srgb, var(--primary-light), transparent 90%);
                                        border: 1px solid color-mix(in srgb, var(--primary-light), transparent 70%);
                                    ">
                                        <h6 class="fw-bold mb-2">${service.title}</h6>
                                        <p class="mb-0 small text-muted">${service.description}</p>
                                    </div>
                                </div>
                            `).join('')}
                        </div>
                    </div>
                    
                    <div class="text-center">
                        <p class="text-muted mb-3">Ready to get started with ${serviceTypeName}?</p>
                        <div class="d-flex gap-2 justify-content-center">
                            <a href="/contact" class="btn btn-primary">
                                <i class="fas fa-comments me-1"></i> Get In Touch
                            </a>
                            <a href="/services" class="btn btn-outline-primary">
                                <i class="fas fa-list me-1"></i> View All Services
                            </a>
                        </div>
                    </div>
                </div>
            `;

            bodyElement.innerHTML = content;
        }

        focusModalContent(modal) {
            // Enhanced focus management for accessibility
            const firstButton = modal.querySelector('.btn:not([data-bs-dismiss])');
            if (firstButton) {
                firstButton.focus();
            } else {
                const closeButton = modal.querySelector('.btn-close');
                if (closeButton) closeButton.focus();
            }
        }

        initializeAccessibilityFeatures() {
            // Enhanced keyboard navigation
            document.addEventListener('keydown', (e) => {
                // ESC key to close modal
                if (e.key === 'Escape' && this.activeModal) {
                    this.activeModal.hide();
                }
                
                // Enter/Space to activate flip buttons
                if ((e.key === 'Enter' || e.key === ' ') && 
                    e.target.classList.contains('service-flip-button')) {
                    e.preventDefault();
                    e.target.click();
                }
            });

            // Manage focus trapping in flipped cards
            document.addEventListener('focusin', (e) => {
                const flipButton = e.target.closest('.service-flip-button');
                if (flipButton) {
                    const card = flipButton.closest('.service-card-flip');
                    if (card && !card.classList.contains('flipped')) {
                        // Ensure flip button is visible when focused
                        flipButton.style.zIndex = '11';
                    }
                }
            });
        }

        // Public methods for external usage
        flipCard(cardElement, forceState = null) {
            const flipContainer = cardElement.querySelector('.service-card-flip');
            const flipButton = cardElement.querySelector('.service-flip-button');
            
            if (!flipContainer || !flipButton) return;
            
            if (forceState === 'flip') {
                flipContainer.classList.add('flipped');
            } else if (forceState === 'unflip') {
                flipContainer.classList.remove('flipped');
            } else {
                this.toggleCardFlip(flipContainer, flipButton);
            }
        }

        openQuickView(serviceType, serviceName) {
            const mockButton = document.createElement('button');
            mockButton.dataset.serviceType = serviceType;
            mockButton.dataset.serviceTypeName = serviceName;
            this.openQuickViewModal(mockButton);
        }
    }

    // Initialize Enhanced Service Card Interactions
    const serviceCardInteractions = new ServiceCardInteractions();

    // Expose to global scope
    window.smoothMigration = window.smoothMigration || {};
    window.smoothMigration.serviceCardInteractions = serviceCardInteractions;

    // Debug: auto-open first Quick View for verification (?qvDebug=1)
    try {
        const qs = new URLSearchParams(window.location.search);
        if (qs.get('qvDebug') === '1') {
            const btn = document.querySelector('.btn-quick-view') || document.querySelector('.js-quick-view');
            if (btn) serviceCardInteractions.openQuickViewModal(btn);
        }
    } catch(e) {}
});
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

            let affiliateText = 'Explore Partner Services';
            if (serviceType.includes('insurance')) {
                affiliateText = 'Get a Quote';
            }

            const titleEl = modal.querySelector('.modal-title');
            if (titleEl) titleEl.textContent = title;

            const bodyEl = modal.querySelector('.modal-body');
            if (bodyEl) {
                bodyEl.innerHTML = `
                    <div class="d-flex gap-3 align-items-start flex-wrap">
                        ${logo ? `<img src="${logo}" alt="" style="height:56px;width:auto" />` : ''}
                        <p class="mb-0 text-muted">${excerpt}</p>
                    </div>
                    <div class="d-flex gap-2 mt-3">
                        <a id="qvAffiliate" href="${affiliate}" target="_blank" rel="nofollow noopener" class="btn btn-primary">${affiliateText}</a>
                        <a id="qvLearn" href="${link}" class="btn btn-outline-primary">Learn More</a>
                    </div>
                `;
            }
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
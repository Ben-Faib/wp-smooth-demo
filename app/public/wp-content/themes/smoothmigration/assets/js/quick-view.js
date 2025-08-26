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
            // Enhanced Quick View functionality with card-to-modal transition
            document.addEventListener('click', (e) => {
                if (e.target.classList.contains('btn-quick-view') || 
                    e.target.closest('.btn-quick-view')) {
                    
                    e.preventDefault();
                    
                    const button = e.target.classList.contains('btn-quick-view') 
                        ? e.target 
                        : e.target.closest('.btn-quick-view');
                    
                    this.openQuickViewModal(button);
                }
            });
        }

        openQuickViewModal(button) {
            const serviceType = button.dataset.serviceType || 'general';
            const serviceTypeName = button.dataset.serviceTypeName || 'Service';
            const card = button.closest('.service-card');

            // Add card opening animation
            if (card && !this.prefersReducedMotion) {
                card.classList.add('modal-opening');
            }

            // Create or get existing modal
            let modal = document.getElementById('quickViewModal');
            if (!modal) {
                modal = this.createQuickViewModal();
            }

            // Update modal content
            this.updateModalContent(modal, serviceType, serviceTypeName);

            // Show modal with enhanced animation
            const bsModal = new bootstrap.Modal(modal, {
                backdrop: true,
                keyboard: true,
                focus: true
            });

            // Enhanced modal events
            modal.addEventListener('shown.bs.modal', () => {
                if (card) {
                    card.classList.remove('modal-opening');
                }
                this.focusModalContent(modal);
            });

            modal.addEventListener('hidden.bs.modal', () => {
                if (card) {
                    card.classList.remove('modal-opening');
                }
            });

            bsModal.show();
            this.activeModal = bsModal;
        }

        createQuickViewModal() {
            const modal = document.createElement('div');
            modal.className = 'modal fade';
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
                        <div class="modal-body">
                            <div class="text-center">
                                <div class="spinner-border text-primary" role="status">
                                    <span class="visually-hidden">Loading...</span>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            `;
            
            document.body.appendChild(modal);
            return modal;
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

    // Legacy jQuery support for existing implementations
    if (typeof jQuery !== 'undefined') {
        jQuery(document).ready(function($) {
            // Maintain backward compatibility with existing Quick View buttons
            $(document).on('click', '.btn-quick-view', function(e) {
                if (!$(this).closest('.service-card-back').length) {
                    // This is an original quick view button, not from our flip cards
                    e.preventDefault();
                    
                    const serviceType = $(this).data('service-type') || 'general';
                    const serviceTypeName = $(this).data('service-type-name') || 'Service';
                    
                    serviceCardInteractions.openQuickView(serviceType, serviceTypeName);
                }
            });
        });
    }
}); 
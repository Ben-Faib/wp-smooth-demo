/**
 * Enhanced Guides System JavaScript
 * Handles search, filtering, bookmarking, and interactive features
 */

document.addEventListener('DOMContentLoaded', function() {
    const guidesContainer = document.getElementById('guidesContainer');
    const loadingState = document.getElementById('loadingState');
    const noResultsState = document.getElementById('noResultsState');
    const resultsCount = document.getElementById('resultsCount');
    const loadMoreContainer = document.getElementById('loadMoreContainer');
    const loadMoreBtn = document.getElementById('loadMoreGuides');
    
    // Search and filter elements
    const heroSearch = document.getElementById('heroGuideSearch');
    const categoryFilter = document.getElementById('categoryFilter');
    const difficultyFilter = document.getElementById('difficultyFilter');
    const timelineFilter = document.getElementById('timelineFilter');
    const countryFilter = document.getElementById('countryFilter');
    const sortGuides = document.getElementById('sortGuides');
    const clearFiltersBtn = document.getElementById('clearFilters');
    const resetFiltersBtn = document.getElementById('resetFilters');
    
    // Search suggestions
    const searchSuggestions = document.querySelectorAll('.search-suggestion-tag');
    
    // State management
    let currentPage = 1;
    let totalGuides = 0;
    let isLoading = false;
    let currentFilters = {};
    
    // Initialize
    init();
    
    function init() {
        setupEventListeners();
        loadGuides();
        setupIntersectionObserver();
        setupBookmarkSystem();
    }
    
    function setupEventListeners() {
        // Search suggestions
        searchSuggestions.forEach(tag => {
            tag.addEventListener('click', function() {
                heroSearch.value = this.dataset.search;
                performSearch();
                // Scroll to results
                document.getElementById('guidesGrid').scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });
            });
        });
        
        // Search and filters
        heroSearch?.addEventListener('input', debounce(performSearch, 300));
        categoryFilter?.addEventListener('change', performSearch);
        difficultyFilter?.addEventListener('change', performSearch);
        timelineFilter?.addEventListener('change', performSearch);
        countryFilter?.addEventListener('change', performSearch);
        sortGuides?.addEventListener('change', performSearch);
        
        // Clear filters
        clearFiltersBtn?.addEventListener('click', clearAllFilters);
        resetFiltersBtn?.addEventListener('click', clearAllFilters);
        
        // Load more
        loadMoreBtn?.addEventListener('click', loadMoreGuides);
        
        // Keyboard shortcuts
        document.addEventListener('keydown', handleKeyboardShortcuts);
    }
    
    function setupIntersectionObserver() {
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
        
        // Initial observation
        observeElements(observer);
    }
    
    function observeElements(observer) {
        const elementsToObserve = document.querySelectorAll('.animate-on-scroll:not(.animate-in)');
        elementsToObserve.forEach(el => observer.observe(el));
    }
    
    function loadGuides() {
        if (isLoading) return;
        
        isLoading = true;
        showLoading();
        
        currentFilters = {
            page: currentPage,
            search: heroSearch?.value || '',
            category: categoryFilter?.value || '',
            difficulty: difficultyFilter?.value || '',
            timeline: timelineFilter?.value || '',
            country: countryFilter?.value || '',
            sort: sortGuides?.value || 'date'
        };
        
        const formData = new FormData();
        formData.append('action', 'load_guides');
        formData.append('nonce', guideAjax.nonce);
        
        Object.keys(currentFilters).forEach(key => {
            formData.append(key, currentFilters[key]);
        });
        
        fetch(guideAjax.ajaxUrl, {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            isLoading = false;
            hideLoading();
            
            if (data.success) {
                handleSuccessResponse(data.data);
            } else {
                handleErrorResponse(data.data?.message);
            }
        })
        .catch(error => {
            isLoading = false;
            hideLoading();
            console.error('Error loading guides:', error);
            showNoResults('An error occurred while loading guides. Please try again.');
        });
    }
    
    function handleSuccessResponse(data) {
        if (currentPage === 1) {
            guidesContainer.innerHTML = data.html;
        } else {
            guidesContainer.innerHTML += data.html;
        }
        
        totalGuides = data.total;
        updateResultsCount();
        updateLoadMoreButton();
        
        // Setup animations for new elements
        const newElements = guidesContainer.querySelectorAll('.animate-on-scroll:not(.animate-in)');
        newElements.forEach((el, index) => {
            el.style.animationDelay = `${index * 0.1}s`;
            setTimeout(() => el.classList.add('animate-in'), 100 + (index * 50));
        });
        
        // Setup bookmark buttons
        setupBookmarkButtons();
    }
    
    function handleErrorResponse(message) {
        showNoResults(message || 'No guides found matching your criteria.');
    }
    
    function performSearch() {
        currentPage = 1;
        loadGuides();
    }
    
    function loadMoreGuides() {
        if (isLoading) return;
        currentPage++;
        loadGuides();
    }
    
    function clearAllFilters() {
        if (heroSearch) heroSearch.value = '';
        if (categoryFilter) categoryFilter.value = '';
        if (difficultyFilter) difficultyFilter.value = '';
        if (timelineFilter) timelineFilter.value = '';
        if (countryFilter) countryFilter.value = '';
        if (sortGuides) sortGuides.value = 'date';
        
        performSearch();
        
        // Smooth scroll to top of results
        document.getElementById('guidesGrid')?.scrollIntoView({
            behavior: 'smooth',
            block: 'start'
        });
    }
    
    function showLoading() {
        if (loadingState) loadingState.style.display = 'block';
        if (noResultsState) noResultsState.style.display = 'none';
        if (currentPage === 1 && guidesContainer) {
            guidesContainer.innerHTML = '';
        }
    }
    
    function hideLoading() {
        if (loadingState) loadingState.style.display = 'none';
    }
    
    function showNoResults(message = 'No guides found matching your criteria.') {
        if (noResultsState) {
            noResultsState.style.display = 'block';
            const messageEl = noResultsState.querySelector('p');
            if (messageEl) messageEl.textContent = message;
        }
        if (guidesContainer) guidesContainer.innerHTML = '';
        if (loadMoreContainer) loadMoreContainer.style.display = 'none';
        updateResultsCount();
    }
    
    function updateResultsCount() {
        if (!resultsCount) return;
        
        const currentShowing = guidesContainer?.querySelectorAll('.guide-card').length || 0;
        
        if (totalGuides === 0) {
            resultsCount.textContent = 'No guides found';
        } else if (currentShowing < totalGuides) {
            resultsCount.textContent = `Showing ${currentShowing} of ${totalGuides} guides`;
        } else {
            resultsCount.textContent = `${totalGuides} guide${totalGuides !== 1 ? 's' : ''}`;
        }
    }
    
    function updateLoadMoreButton() {
        if (!loadMoreContainer) return;
        
        const currentShowing = guidesContainer?.querySelectorAll('.guide-card').length || 0;
        
        if (currentShowing < totalGuides) {
            loadMoreContainer.style.display = 'block';
            if (loadMoreBtn) {
                loadMoreBtn.textContent = `Load More Guides (${totalGuides - currentShowing} remaining)`;
            }
        } else {
            loadMoreContainer.style.display = 'none';
        }
    }
    
    // Bookmark System
    function setupBookmarkSystem() {
        const bookmarkedGuides = getBookmarkedGuides();
        updateBookmarkButtons(bookmarkedGuides);
    }
    
    function setupBookmarkButtons() {
        const bookmarkBtns = document.querySelectorAll('[onclick*="bookmarkGuide"]');
        bookmarkBtns.forEach(btn => {
            const onclick = btn.getAttribute('onclick');
            const guideId = onclick.match(/bookmarkGuide\((\d+)\)/)?.[1];
            if (guideId) {
                btn.removeAttribute('onclick');
                btn.addEventListener('click', (e) => {
                    e.preventDefault();
                    bookmarkGuide(parseInt(guideId));
                });
            }
        });
        
        // Setup notify buttons
        const notifyBtns = document.querySelectorAll('[onclick*="notifyWhenReady"]');
        notifyBtns.forEach(btn => {
            const onclick = btn.getAttribute('onclick');
            const guideId = onclick.match(/notifyWhenReady\((\d+)\)/)?.[1];
            if (guideId) {
                btn.removeAttribute('onclick');
                btn.addEventListener('click', (e) => {
                    e.preventDefault();
                    notifyWhenReady(parseInt(guideId));
                });
            }
        });
        
        updateBookmarkButtons(getBookmarkedGuides());
    }
    
    function bookmarkGuide(guideId) {
        let bookmarked = getBookmarkedGuides();
        const button = document.querySelector(`[onclick*="bookmarkGuide(${guideId})"]`) || 
                      document.querySelector(`button[data-guide-id="${guideId}"]`);
        
        if (bookmarked.includes(guideId)) {
            // Remove bookmark
            bookmarked = bookmarked.filter(id => id !== guideId);
            if (button) {
                button.innerHTML = '<i class="fas fa-bookmark"></i> Save';
                button.classList.remove('btn-success');
                button.classList.add('btn-primary');
            }
            showToast('Guide removed from saved list', 'info');
        } else {
            // Add bookmark
            bookmarked.push(guideId);
            if (button) {
                button.innerHTML = '<i class="fas fa-check"></i> Saved';
                button.classList.remove('btn-primary');
                button.classList.add('btn-success');
            }
            showToast('Guide saved to your list', 'success');
        }
        
        localStorage.setItem('smoothmigration_bookmarked_guides', JSON.stringify(bookmarked));
    }
    
    function getBookmarkedGuides() {
        try {
            return JSON.parse(localStorage.getItem('smoothmigration_bookmarked_guides') || '[]');
        } catch {
            return [];
        }
    }
    
    function updateBookmarkButtons(bookmarkedGuides) {
        bookmarkedGuides.forEach(guideId => {
            const button = document.querySelector(`button[onclick*="bookmarkGuide(${guideId})"]`);
            if (button) {
                button.innerHTML = '<i class="fas fa-check"></i> Saved';
                button.classList.remove('btn-primary');
                button.classList.add('btn-success');
            }
        });
    }
    
    function notifyWhenReady(guideId) {
        // Get guide title
        const guideCard = document.querySelector(`[data-guide-id="${guideId}"]`);
        const guideTitle = guideCard?.querySelector('.guide-title')?.textContent || 'Guide';
        
        showToast(`You'll be notified when "${guideTitle}" is ready!`, 'success');
        
        // Store notification request
        let notifications = JSON.parse(localStorage.getItem('smoothmigration_guide_notifications') || '[]');
        if (!notifications.includes(guideId)) {
            notifications.push(guideId);
            localStorage.setItem('smoothmigration_guide_notifications', JSON.stringify(notifications));
        }
        
        // Update button
        const button = document.querySelector(`[onclick*="notifyWhenReady(${guideId})"]`);
        if (button) {
            button.innerHTML = '<i class="fas fa-check"></i> Notify Set';
            button.disabled = true;
            button.classList.add('btn-success');
        }
    }
    
    // Toast notification system
    function showToast(message, type = 'info') {
        const toast = document.createElement('div');
        toast.className = `alert alert-${type} toast-notification`;
        toast.innerHTML = `
            <div class="d-flex align-items-center">
                <i class="fas fa-${type === 'success' ? 'check-circle' : 'info-circle'} me-2"></i>
                <span>${message}</span>
                <button type="button" class="btn-close ms-auto" onclick="this.parentElement.parentElement.remove()"></button>
            </div>
        `;
        
        // Add styles
        toast.style.cssText = `
            position: fixed;
            top: 20px;
            right: 20px;
            z-index: 1060;
            min-width: 300px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.15);
            border-radius: 8px;
            transform: translateX(100%);
            transition: transform 0.3s ease;
        `;
        
        document.body.appendChild(toast);
        
        // Animate in
        setTimeout(() => {
            toast.style.transform = 'translateX(0)';
        }, 100);
        
        // Auto remove
        setTimeout(() => {
            toast.style.transform = 'translateX(100%)';
            setTimeout(() => toast.remove(), 300);
        }, 4000);
    }
    
    // Keyboard shortcuts
    function handleKeyboardShortcuts(e) {
        // Ctrl/Cmd + K to focus search
        if ((e.ctrlKey || e.metaKey) && e.key === 'k') {
            e.preventDefault();
            heroSearch?.focus();
        }
        
        // Escape to clear search
        if (e.key === 'Escape' && heroSearch === document.activeElement) {
            heroSearch.value = '';
            performSearch();
        }
    }
    
    // Utility function for debouncing
    function debounce(func, wait) {
        let timeout;
        return function executedFunction(...args) {
            const later = () => {
                clearTimeout(timeout);
                func(...args);
            };
            clearTimeout(timeout);
            timeout = setTimeout(later, wait);
        };
    }
    
    // Export functions for global access
    window.bookmarkGuide = bookmarkGuide;
    window.notifyWhenReady = notifyWhenReady;
});

// Additional styles for toast notifications
const toastStyles = document.createElement('style');
toastStyles.textContent = `
.toast-notification {
    animation: slideInRight 0.3s ease;
}

@keyframes slideInRight {
    from {
        transform: translateX(100%);
        opacity: 0;
    }
    to {
        transform: translateX(0);
        opacity: 1;
    }
}
`;
document.head.appendChild(toastStyles);

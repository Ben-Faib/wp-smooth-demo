(function () {
  if (typeof Globe !== 'function') return;

  var targets = document.querySelectorAll('.smooth-globe');
  if (!targets.length) return;

  var d = window.SmoothGlobeData || { arcs: [], points: [], reduced: false };
  var url = new URL(window.location.href);
  var debug = url.searchParams.get('globe_debug') === '1';
  var perfMode = url.searchParams.get('globe_perf'); // 'low' | 'off'
  if (url.searchParams.get('noglobe') === '1' || perfMode === 'off') return;

  // Honor prefers-reduced-motion
  var prefersReduced = false;
  try {
    prefersReduced = window.matchMedia && window.matchMedia('(prefers-reduced-motion: reduce)').matches;
  } catch (e) {}

  var disableMotion = d.reduced || prefersReduced;

  // Debounced resize handler to prevent excessive calls
  var resizeTimeout;
  function debounceResize(func, wait) {
    return function() {
      clearTimeout(resizeTimeout);
      resizeTimeout = setTimeout(func, wait);
    };
  }

  targets.forEach(function (el, idx) {
    if (el.__smoothGlobeMounted) return; // prevent double init

    if (debug) {
      try { console.log('[SmoothGlobe] init target #' + idx, {width: el.clientWidth, height: el.clientHeight}); } catch(e) {}
    }

    // Track globe instance for performance monitoring
    if (window.smoothMigration && window.smoothMigration.performance) {
      window.smoothMigration.performance.trackGlobe();
    }

    var globe = Globe()
      .globeImageUrl('https://unpkg.com/three-globe/example/img/earth-dark.jpg')
      .bumpImageUrl('https://unpkg.com/three-globe/example/img/earth-topology.png')
      .backgroundColor('rgba(0,0,0,0)')
      .arcsData(d.arcs)
      .arcColor(function (e) { return [e.colorStart || '#60a5fa', e.colorEnd || '#a78bfa']; })
      .arcAltitude(0.18)
      .arcStroke(0.7)
      .arcDashLength(0.6)
      .arcDashGap(0.2)
      .arcDashAnimateTime((disableMotion || perfMode === 'low') ? 0 : 3000)
      .pointsData(d.points)
      .pointAltitude(0.01)
      .pointRadius(0.15)
      .pointColor(function () { return 'rgba(99,102,241,0.9)'; })
      (el);

    // Make globe focusable for keyboard navigation
    el.tabIndex = 0;
    el.setAttribute('role', 'img');
    el.setAttribute('aria-label', 'Interactive world map showing migration routes');

    // Store globe instance for parallax effects
    el.__globeInstance = globe;

    var controls = globe.controls();
    controls.enableZoom = true;
    controls.autoRotate = !disableMotion;
    controls.autoRotateSpeed = 0.35;

    // Reduce GPU load on low mode or high-DPI screens
    try {
      var pxRatio = (perfMode === 'low') ? 1 : Math.min(1.5, window.devicePixelRatio || 1);
      if (globe.renderer && typeof globe.renderer === 'function') {
        var r = globe.renderer();
        if (r && typeof r.setPixelRatio === 'function') r.setPixelRatio(pxRatio);
      }
    } catch (e) {}

    // Enhanced scroll conflict prevention
    var scrollTimeout;
    var isScrolling = false;
    var lastScrollTime = 0;
    var scrollVelocity = 0;
    var lastScrollY = window.scrollY;


    // Function to temporarily disable globe interactions during scroll
    function disableGlobeInteractions() {
      if (controls) {
        controls.enableRotate = false;
        controls.enableZoom = false;
        controls.enablePan = false;
        controls.autoRotate = false; // Disable auto-rotation during scroll
      }
      isScrolling = true;

      // Add visual feedback
      globeContainer.classList.add('scroll-disabled');

      clearTimeout(scrollTimeout);
      scrollTimeout = setTimeout(function() {
        if (controls) {
          controls.enableRotate = true;
          controls.enableZoom = true;
          controls.enablePan = true;
          // Re-enable auto-rotation only if not disabled by reduced motion preferences
          if (!disableMotion && perfMode !== 'low') {
            controls.autoRotate = true;
          }
        }
        isScrolling = false;
        globeContainer.classList.remove('scroll-disabled');
      }, 500); // Re-enable after 500ms of no scroll activity
    }

    // Function to detect scroll intent
    function handleScrollIntent() {
      var currentTime = Date.now();
      var currentScrollY = window.scrollY;
      scrollVelocity = Math.abs(currentScrollY - lastScrollY);

      // If scrolling velocity is high, user is likely trying to scroll the page
      if (scrollVelocity > 5 || (currentTime - lastScrollTime) < 100) {
        disableGlobeInteractions();
      }

      lastScrollTime = currentTime;
      lastScrollY = currentScrollY;
    }



    // Enhanced touch event handling
    var touchStartY = 0;
    var touchStartX = 0;
    var isDraggingGlobe = false;
    var touchStartTime = 0;

    function handleTouchStart(e) {
      touchStartY = e.touches[0].clientY;
      touchStartX = e.touches[0].clientX;
      touchStartTime = Date.now();
      isDraggingGlobe = false;
    }

    function handleTouchMove(e) {
      if (isScrolling) return;

      var touchCurrentY = e.touches[0].clientY;
      var touchCurrentX = e.touches[0].clientX;
      var deltaY = Math.abs(touchCurrentY - touchStartY);
      var deltaX = Math.abs(touchCurrentX - touchStartX);
      var timeDiff = Date.now() - touchStartTime;

      // If vertical movement is greater than horizontal and fast enough,
      // it's likely a scroll attempt
      if (deltaY > deltaX && deltaY > 10 && timeDiff < 300) {
        disableGlobeInteractions();
        return;
      }

      // If user is clearly dragging the globe, allow it
      if (deltaX > 20 || deltaY > 20) {
        isDraggingGlobe = true;
      }
    }

    function handleTouchEnd(e) {
      // Reset drag state
      setTimeout(function() {
        isDraggingGlobe = false;
      }, 100);
    }

    // Wheel event handling to prevent zoom conflicts
    function handleWheel(e) {
      // If user is scrolling with momentum, disable globe zoom temporarily
      if (Math.abs(e.deltaY) > 50) {
        disableGlobeInteractions();
      }
    }

    // Keyboard shortcut to manually disable globe interactions (Escape key)
    function handleKeyDown(e) {
      if (e.key === 'Escape' && globeContainer.contains(document.activeElement)) {
        disableGlobeInteractions();
      }
    }

    // Add zoom limits to prevent excessive zooming that might interfere with scrolling
    if (controls) {
      // Set reasonable zoom limits
      controls.minDistance = 100;
      controls.maxDistance = 1000;
      controls.zoomSpeed = 0.6; // Reduce zoom sensitivity
    }

    // Add event listeners with proper event capturing
    var globeContainer = el.parentElement;

    // Use passive listeners where possible for better performance
    window.addEventListener('scroll', handleScrollIntent, { passive: true });
    globeContainer.addEventListener('touchstart', handleTouchStart, { passive: true });
    globeContainer.addEventListener('touchmove', handleTouchMove, { passive: false });
    globeContainer.addEventListener('touchend', handleTouchEnd, { passive: true });
    globeContainer.addEventListener('wheel', handleWheel, { passive: false });

    // Add buffer zone touch detection
    function handleBufferZoneTouch(e) {
      // If user touches buffer zones, prepare for scroll
      if (e.target === globeContainer || globeContainer.contains(e.target)) {
        var rect = globeContainer.getBoundingClientRect();
        var touchY = e.touches[0].clientY;

        // Check if touch is in buffer zones
        if (touchY < rect.top + 30 || touchY > rect.bottom - 30) {
          disableGlobeInteractions();
        }
      }
    }

    // Prevent default touch behaviors that might interfere
    globeContainer.addEventListener('touchmove', function(e) {
      if (isScrolling) {
        e.preventDefault();
      }
    }, { passive: false });

    // Add buffer zone event listeners
    globeContainer.addEventListener('touchstart', handleBufferZoneTouch, { passive: true });

    // Add keyboard event listener for manual control
    globeContainer.addEventListener('keydown', handleKeyDown, { passive: true });

    function resize() {
      globe.width(el.clientWidth);
      globe.height(el.clientHeight);
    }

    // Use debounced resize handler and store reference for cleanup
    var debouncedResize = debounceResize(resize, 150);
    window.addEventListener('resize', debouncedResize, { passive: true });
    resize();

    // Ensure non-zero size if layout not settled yet (optimized)
    (function ensureSize(attempt) {
      attempt = attempt || 1;
      var w = el.clientWidth || 0;
      var h = el.clientHeight || 0;
      if (debug) { try { console.log('[SmoothGlobe] size check', {attempt: attempt, w: w, h: h}); } catch(e) {} }
      if (w > 0 && h > 0) return;
      if (attempt > 5) return; // Reduced from 8 to 5 attempts
      setTimeout(function(){ resize(); ensureSize(attempt + 1); }, 300); // Increased from 250ms to 300ms
    })(1);

    globe.onPointClick(function (p) {
      if (debug) { alert('Clicked: ' + (p.name || (p.lat + ',' + p.lng))); }
    });

    // Pause/Resume animations when offscreen (hero & any globe)
    try {
      var visObserver = new IntersectionObserver(function(entries){
        entries.forEach(function(entry){
          if (!entry.isIntersecting) {
            if (controls) controls.autoRotate = false;
            globe.arcDashAnimateTime(0);
          } else {
            if (!disableMotion && perfMode !== 'low') {
              if (controls) controls.autoRotate = true;
              globe.arcDashAnimateTime(3000);
            }
          }
        });
      }, { threshold: 0.1 });
      visObserver.observe(globeContainer);
    } catch (e) {}

    // Store cleanup function for potential future use
    el.__smoothGlobeCleanup = function() {
      window.removeEventListener('resize', debouncedResize);
      window.removeEventListener('scroll', handleScrollIntent);
      globeContainer.removeEventListener('touchstart', handleTouchStart);
      globeContainer.removeEventListener('touchmove', handleTouchMove);
      globeContainer.removeEventListener('touchend', handleTouchEnd);
      globeContainer.removeEventListener('wheel', handleWheel);
      globeContainer.removeEventListener('touchstart', handleBufferZoneTouch);
      globeContainer.removeEventListener('keydown', handleKeyDown);
      clearTimeout(scrollTimeout);
      if (globe && typeof globe.destroy === 'function') {
        globe.destroy();
      }
    };

    el.__smoothGlobeMounted = true;
  });

  // Services Page Parallax and Zoom Effects
  function initServicesGlobeEffects() {
    const globeContainer = document.getElementById('services-globe-container');
    if (!globeContainer) return;

    const globeElement = globeContainer.querySelector('.smooth-globe');
    if (!globeElement) return;

    // Respect reduced motion preferences
    if (prefersReduced) {
      globeContainer.style.transform = 'none';
      return;
    }

    let currentScale = 1;
    let currentRotation = 0;
    let targetRotation = 0;
    let isAnimating = false;
    const baseScale = 1;
    const maxScale = 1.4; // Increased for more dynamic zoom
    const minScale = 0.8; // Decreased for more range

    // Throttled scroll handler for better performance
    let scrollVelocity = 0;
    const dampening = 0.95;

    // Get all service cards for scroll-based interactions
    const serviceCards = document.querySelectorAll('.enhanced-service-card');
    let currentActiveService = 0;

    // Calculate the maximum position for the globe within the services grid
    function getMaxGlobePosition() {
      const servicesGrid = document.querySelector('.services-grid');
      if (!servicesGrid) return window.innerHeight;

      const gridHeight = servicesGrid.getBoundingClientRect().height;
      const globeWrapper = document.getElementById('services-globe-wrapper');
      const wrapperHeight = globeWrapper ? globeWrapper.offsetHeight : globeContainer.offsetHeight;

      // Return the maximum top position (grid height minus globe height)
      return Math.max(0, gridHeight - wrapperHeight);
    }

    // Variables for floating behavior
    let currentGlobeTop = 0; // Start at top of wrapper
    let targetGlobeTop = currentGlobeTop;
    let lastScrollY = window.scrollY;
    let isFloating = false;

    // Mouse interaction variables
    let mouseHoverBoost = 0;
    let isHoverAnimating = false;
    let leaveTimeout;
    let isVisible = true; // Track visibility for mouse interactions
    const mouseHoverMaxBoost = 0.15;
    const mouseHoverSpeed = 0.02;

    // Function to determine which service card is currently most visible
    function getActiveServiceIndex() {
      const windowHeight = window.innerHeight;
      const scrollY = window.scrollY;
      let maxVisibility = 0;
      let activeIndex = 0;

      serviceCards.forEach((card, index) => {
        const rect = card.getBoundingClientRect();
        const cardTop = rect.top + scrollY;
        const cardBottom = rect.bottom + scrollY;
        const viewportTop = scrollY;
        const viewportBottom = scrollY + windowHeight;

        // Calculate how much of the card is visible
        const visibleTop = Math.max(cardTop, viewportTop);
        const visibleBottom = Math.min(cardBottom, viewportBottom);
        const visibleHeight = Math.max(0, visibleBottom - visibleTop);
        const cardHeight = cardBottom - cardTop;
        const visibility = cardHeight > 0 ? visibleHeight / cardHeight : 0;

        if (visibility > maxVisibility) {
          maxVisibility = visibility;
          activeIndex = index;
        }
      });

      return activeIndex;
    }

    // Function to handle globe floating behavior
    function updateGlobePosition() {
      const currentScrollY = window.scrollY;

      // Get the services grid boundaries
      const servicesGrid = document.querySelector('.services-grid');
      if (!servicesGrid) return;

      const gridRect = servicesGrid.getBoundingClientRect();
      const gridTop = gridRect.top + window.scrollY;
      const gridBottom = gridRect.bottom + window.scrollY;
      const gridHeight = gridRect.height;

      // Globe dimensions
      const globeWrapper = document.getElementById('services-globe-wrapper');
      const wrapperHeight = globeWrapper ? globeWrapper.offsetHeight : globeContainer.offsetHeight;

      // Enhanced scroll-based positioning: move globe with increased speed and range
      // Calculate extended scroll range to allow globe to keep up with fast scrolling
      const scrollStart = gridTop - window.innerHeight * 0.5; // Start when grid is 50% into view
      const scrollEnd = gridBottom + window.innerHeight * 0.8; // End much later to allow extended movement

      const scrollProgress = Math.max(0, Math.min(1,
        (currentScrollY - scrollStart) / (scrollEnd - scrollStart)
      ));

      // Calculate target position with increased movement multiplier
      // Globe moves 1.5x the available space for better tracking
      const availableSpace = Math.max(0, gridHeight - wrapperHeight);
      const movementMultiplier = 1.5; // Globe moves 1.5x faster than proportional
      let targetPosition = scrollProgress * (availableSpace * movementMultiplier + window.innerHeight * 0.6);

      // Allow globe to move much lower and higher
      const minPosition = -window.innerHeight * 0.3; // Allow moving above the wrapper
      const maxPosition = availableSpace * movementMultiplier + window.innerHeight * 0.8; // Allow moving well below
      targetPosition = Math.max(minPosition, Math.min(maxPosition, targetPosition));

      // Much more aggressive easing to keep up with fast scrolling
      const positionDiff = targetPosition - currentGlobeTop;
      const easingFactor = Math.abs(positionDiff) > 100 ? 0.25 : 0.18; // Faster easing for large movements
      currentGlobeTop += positionDiff * easingFactor;

      // Apply the position
      globeContainer.style.top = currentGlobeTop + 'px';

      lastScrollY = currentScrollY;
    }

    // Parallax and zoom effect on scroll
    function updateGlobeTransform() {
      if (isAnimating) {
        requestAnimationFrame(updateGlobeTransform);
        return;
      }

      isAnimating = true;

      // Update globe position first
      updateGlobePosition();

      const containerRect = globeContainer.getBoundingClientRect();
      const windowHeight = window.innerHeight;
      const containerCenter = containerRect.top + containerRect.height / 2;
      const windowCenter = windowHeight / 2;

      // Only update if globe is visible
      if (containerRect.bottom < 0 || containerRect.top > windowHeight) {
        isAnimating = false;
        requestAnimationFrame(updateGlobeTransform);
        return;
      }

      // Calculate scroll progress within the globe's visible area
      const scrollProgress = Math.max(0, Math.min(1,
        (windowCenter - containerRect.top) / (containerRect.height + windowHeight)
      ));

      // Calculate scroll velocity for smoother effects
      const currentScrollY = window.scrollY;
      scrollVelocity = (scrollVelocity * dampening) + ((currentScrollY - lastScrollY) * 0.05);

      // Get the currently active service (for scaling effects only)
      const activeServiceIndex = getActiveServiceIndex();
      if (activeServiceIndex !== currentActiveService) {
        currentActiveService = activeServiceIndex;
        // Rotation disabled during scrolling - globe stays static
        // targetRotation = (activeServiceIndex * 60) - 180; // Disabled for static globe
      }

      // Rotation disabled - globe stays static
      // const rotationDiff = targetRotation - currentRotation;
      // currentRotation += rotationDiff * 0.02; // Disabled for static globe

      // Enhanced scale based on scroll progress and active service
      const velocityInfluence = Math.abs(scrollVelocity) * 0.001;
      const serviceInfluence = (activeServiceIndex / serviceCards.length) * 0.2; // Scale based on service position
      const scrollBasedScale = baseScale + (scrollProgress - 0.5) * 0.4 + velocityInfluence + serviceInfluence;

      // Combine scroll-based scale with mouse hover boost smoothly
      const targetScale = scrollBasedScale + mouseHoverBoost;
      currentScale += (targetScale - currentScale) * 0.06; // Adjusted smoothing

      // Clamp scale between min and max, accounting for hover boost
      const effectiveMaxScale = maxScale + mouseHoverMaxBoost;
      currentScale = Math.max(minScale, Math.min(effectiveMaxScale, currentScale));

      // Add subtle floating motion
      const time = Date.now() * 0.001;
      const floatOffset = Math.sin(time * 0.5) * 2; // Gentle floating effect

      // Apply transform with hardware acceleration (rotation disabled)
      globeElement.style.transform = `scale(${currentScale}) translateY(${floatOffset}px) translateZ(0)`;

      // Update debug data attributes
      if (globeDebug) {
        globeContainer.setAttribute('data-scale', currentScale.toFixed(2));
        globeContainer.setAttribute('data-service', currentActiveService);
        globeContainer.setAttribute('data-position', currentGlobeTop.toFixed(1));
        globeContainer.setAttribute('data-max-pos', getMaxGlobePosition().toFixed(1));
      }

      // Update globe controls if available (more responsive updates)
      const globeInstance = globeElement.__globeInstance;
      if (globeInstance && globeInstance.controls && Math.random() < 0.15) { // Increased update frequency
        const zoomLevel = 1 + (scrollProgress - 0.5) * 0.4 + serviceInfluence;
        globeInstance.controls.zoom = Math.max(0.6, Math.min(1.6, zoomLevel));

        // Also update rotation in the globe itself for more dynamic effect
        if (globeInstance.controls.rotateSpeed !== undefined) {
          globeInstance.controls.rotateSpeed = 0.3 + (Math.abs(scrollVelocity) * 0.001);
        }
      }

      isAnimating = false;
      requestAnimationFrame(updateGlobeTransform);
    }

    // Start the animation loop
    updateGlobeTransform();

    // Function to highlight active service card
    function highlightActiveService(activeIndex) {
      // Remove active class from all service cards
      serviceCards.forEach(card => card.classList.remove('active-service'));

      // Add active class to current service card
      if (serviceCards[activeIndex]) {
        serviceCards[activeIndex].classList.add('active-service');
      }
    }

    // Update active service highlighting
    function updateActiveService() {
      const activeIndex = getActiveServiceIndex();
      if (activeIndex !== currentActiveService) {
        highlightActiveService(activeIndex);
      }
    }

    // Add scroll-based zoom zones
    const zoomZone = document.createElement('div');
    zoomZone.className = 'globe-zoom-zone';
    globeContainer.appendChild(zoomZone);

    function updateZoomZone() {
      const containerRect = globeContainer.getBoundingClientRect();
      const scrollY = window.scrollY;
      const windowHeight = window.innerHeight;

      // Activate zoom zone when globe is in viewport
      if (containerRect.top < windowHeight && containerRect.bottom > 0) {
        zoomZone.classList.add('active');
      } else {
        zoomZone.classList.remove('active');
      }

      // Update active service highlighting
      updateActiveService();
    }

    window.addEventListener('scroll', updateZoomZone, { passive: true });
    updateZoomZone();

    // Initial highlight
    highlightActiveService(0);

    // Add mouse interaction for enhanced zoom

    globeContainer.addEventListener('mouseenter', () => {
      // Clear any pending leave animation
      if (leaveTimeout) {
        clearTimeout(leaveTimeout);
        leaveTimeout = null;
      }

      if (isHoverAnimating || !isVisible) return; // Prevent multiple animations or interactions when not visible

      isHoverAnimating = true;

      // Smooth transition instead of instant jump
      const animateHoverIn = () => {
        mouseHoverBoost += mouseHoverSpeed;
        if (mouseHoverBoost < mouseHoverMaxBoost) {
          requestAnimationFrame(animateHoverIn);
        } else {
          mouseHoverBoost = mouseHoverMaxBoost;
          isHoverAnimating = false;
        }
      };
      animateHoverIn();
    });

    globeContainer.addEventListener('mouseleave', () => {
      // Add a small delay to prevent flickering when mouse moves quickly over edges
      leaveTimeout = setTimeout(() => {
        if (isHoverAnimating || !isVisible) return; // Prevent multiple animations or interactions when not visible

        isHoverAnimating = true;

        // Smooth transition back instead of instant jump
        const animateHoverOut = () => {
          mouseHoverBoost -= mouseHoverSpeed;
          if (mouseHoverBoost > 0) {
            requestAnimationFrame(animateHoverOut);
          } else {
            mouseHoverBoost = 0;
            isHoverAnimating = false;
          }
        };
        animateHoverOut();
      }, 50); // 50ms delay
    });

    // Performance optimization: pause when not visible
    const observer = new IntersectionObserver((entries) => {
      entries.forEach(entry => {
        isVisible = entry.isIntersecting;
        if (!isVisible) {
          // Pause expensive operations when not visible
          currentScale = baseScale;
          currentRotation = 0;
        }
      });
    }, { threshold: 0.1 });

    observer.observe(globeContainer);

    // Add scroll performance monitoring
    let frameCount = 0;
    let lastTime = performance.now();

    function monitorPerformance() {
      frameCount++;
      const currentTime = performance.now();

      if (currentTime - lastTime >= 1000) { // Log every second
        const fps = (frameCount * 1000) / (currentTime - lastTime);
        if (window.smoothMigration && window.smoothMigration.performance) {
          window.smoothMigration.performance.globeFPS = fps;
        }
        frameCount = 0;
        lastTime = currentTime;
      }

      if (isVisible) {
        requestAnimationFrame(monitorPerformance);
      }
    }

    monitorPerformance();

    // Performance monitoring
    if (window.smoothMigration && window.smoothMigration.performance) {
      window.smoothMigration.performance.servicesGlobeActive = true;
    }
  }

  // Debug mode for services globe effects
  const globeDebug = new URLSearchParams(window.location.search).get('globe_debug') === '1';

  if (globeDebug) {
    console.log('[SmoothGlobe] Debug mode enabled');
    // Add debug styles
    const debugStyles = document.createElement('style');
    debugStyles.textContent = `
      .globe-zoom-zone { background: rgba(255, 0, 0, 0.2) !important; border: 2px dashed red; }
      .globe-zoom-zone.active { background: rgba(0, 255, 0, 0.3) !important; border: 2px solid green; }
      .services-parallax-globe::before {
        content: 'DEBUG: ' attr(data-scale) 'x Pos: ' attr(data-position) 'px Max: ' attr(data-max-pos) 'px Service: ' attr(data-service);
        position: absolute;
        top: 10px;
        left: 10px;
        background: rgba(0, 0, 0, 0.8);
        color: white;
        padding: 5px 10px;
        border-radius: 4px;
        font-size: 12px;
        z-index: 1000;
        pointer-events: none;
        max-width: 400px;
        word-wrap: break-word;
      }
      .enhanced-service-card.active-service {
        outline: 3px solid #ff6b6b !important;
        outline-offset: 2px;
      }
    `;
    document.head.appendChild(debugStyles);
  }

  // Initialize services globe effects if on services page
  if (document.body.classList.contains('page-template-page-services') ||
      document.querySelector('.services-parallax-globe')) {
    initServicesGlobeEffects();
  }

})();



(function () {
  if (typeof Globe !== 'function') {
    console.warn('[SmoothGlobe] Globe.gl library not loaded');
    return;
  }

  var targets = document.querySelectorAll('.smooth-globe');
  if (!targets.length) {
    console.warn('[SmoothGlobe] No .smooth-globe elements found');
    return;
  }

  console.log('[SmoothGlobe] Found', targets.length, 'globe target(s)');

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

  // Helper function to get country-specific CSS classes
  function getCountryClass(countryCode) {
    switch(countryCode) {
      case 'AU': return 'australia-node';
      case 'GB': return 'uk-node';
      case 'US': return 'usa-node';
      case 'CA': return 'canada-node';
      case 'ZA': return 'south-africa-node';
      default: return 'supported-country-node';
    }
  }

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

    try {
      var globe = Globe()
        .globeImageUrl('https://unpkg.com/three-globe/example/img/earth-dark.jpg')
        .bumpImageUrl('https://unpkg.com/three-globe/example/img/earth-topology.png')
        .backgroundColor('rgba(0,0,0,0)')
        .arcsData(d.arcs)
        .arcColor(function (e) {
          // Make Australia paths more visible and prominent
          if (e.endLat === -33.8688 && e.endLng === 151.2093) { // Sydney AU
            return [e.colorStart || '#60a5fa', '#ffffff']; // Bright white end for AU
          } else if (e.endLat === -37.8136 && e.endLng === 144.9631) { // Melbourne AU
            return [e.colorStart || '#60a5fa', '#ffffff']; // Bright white end for AU
          }
          return [e.colorStart || '#60a5fa', e.colorEnd || '#a78bfa'];
        })
        .arcAltitude(function(e) {
          // Higher altitude for Australia paths to make them more visible
          if (e.endLat === -33.8688 && e.endLng === 151.2093) return 0.25; // Sydney AU
          if (e.endLat === -37.8136 && e.endLng === 144.9631) return 0.25; // Melbourne AU
          return 0.18; // Standard altitude for other paths
        })
        .arcStroke(function(e) {
          // Thicker stroke for Australia paths
          if (e.endLat === -33.8688 && e.endLng === 151.2093) return 1.2; // Sydney AU
          if (e.endLat === -37.8136 && e.endLng === 144.9631) return 1.2; // Melbourne AU
          return 0.7; // Standard stroke for other paths
        })
        .arcDashLength(0.6)
        .arcDashGap(0.2)
        .arcDashAnimateTime((disableMotion || perfMode === 'low') ? 0 : 8000)
        .pointsData(d.points)
        .pointAltitude(function(d) {
          if (d.size && d.size >= 0.20) return 0.05; // Our supported countries - higher
          if (d.size && d.size < 0.20) return 0.02; // Source countries - medium
          return 0.08; // Animated dots - highest
        })
        .pointRadius(function(d) {
          if (d.size && d.size >= 0.20) return d.size * 2; // Our countries - very prominent
          if (d.size && d.size < 0.20) return d.size * 1.5; // Source countries - smaller but visible
          return 0.15; // Animated dots - standard
        })
        .pointColor(function (d) {
          if (d.size && d.size >= 0.20) {
            // Our supported countries - bright and prominent with distinct colors
            var countryClass = getCountryClass(d.code);
            // Add CSS class to the globe canvas for country-specific glow effects
            if (countryClass) {
              el.classList.add(countryClass);
            }
            return d.color || 'rgba(99,102,241,0.9)';
          } else if (d.size && d.size < 0.20) {
            // Source countries - subdued
            return 'rgba(120,120,120,0.7)';
          }
          return d.color || 'rgba(99,102,241,0.9)'; // Animated dots
        })
        .pointLabel(function (d) {
          if (d.name && d.flag && d.services && d.size >= 0.20) {
            // Our supported countries - show full info
            return d.flag + ' ' + d.name + '\n' + d.services;
          } else if (d.name && d.size >= 0.20) {
            // Our countries without full info
            return d.name + ' (' + d.code + ')';
          } else if (d.name && d.flag && d.size < 0.20) {
            // Source countries - just flag and name
            return d.flag + ' ' + d.name;
          } else if (d.name) {
            return d.name + ' (' + d.code + ')';
          }
          return '';
        })
        (el);

      console.log('[SmoothGlobe] Globe initialized successfully');
    } catch (error) {
      console.error('[SmoothGlobe] Error initializing globe:', error);

      // Add fallback content
      el.innerHTML = `
        <div style="display:flex;flex-direction:column;align-items:center;justify-content:center;height:100%;text-align:center;padding:20px;background:linear-gradient(135deg, #667eea 0%, #764ba2 100%);border-radius:8px;color:white;">
          <div style="font-size:4rem;margin-bottom:20px;">🌍</div>
          <h3 style="margin-bottom:15px;font-size:1.5rem;">Interactive World Map</h3>
          <p style="margin-bottom:20px;opacity:0.9;max-width:300px;">Experience our global relocation network with animated migration routes and country-specific services.</p>
          <div style="display:flex;gap:10px;flex-wrap:wrap;justify-content:center;">
            <span style="background:rgba(255,255,255,0.2);padding:5px 10px;border-radius:15px;font-size:0.9rem;">🇬🇧 UK</span>
            <span style="background:rgba(255,255,255,0.2);padding:5px 10px;border-radius:15px;font-size:0.9rem;">🇦🇺 Australia</span>
            <span style="background:rgba(255,255,255,0.2);padding:5px 10px;border-radius:15px;font-size:0.9rem;">🇺🇸 USA</span>
            <span style="background:rgba(255,255,255,0.2);padding:5px 10px;border-radius:15px;font-size:0.9rem;">🇨🇦 Canada</span>
            <span style="background:rgba(255,255,255,0.2);padding:5px 10px;border-radius:15px;font-size:0.9rem;">🇿🇦 South Africa</span>
          </div>
        </div>
      `;

      return;
    }

    // Make globe focusable for keyboard navigation
    el.tabIndex = 0;
    el.setAttribute('role', 'img');
    el.setAttribute('aria-label', 'Interactive world map showing migration routes');

    // Add drag interaction handling to hide container
    var controls = globe.controls();
    var isDragging = false;

    function startDrag() {
      isDragging = true;
      globeContainer.classList.add('globe-dragging');
    }

    function endDrag() {
      isDragging = false;
      globeContainer.classList.remove('globe-dragging');
    }

    // Listen for mouse/touch events on the globe
    el.addEventListener('mousedown', startDrag);
    el.addEventListener('touchstart', startDrag, { passive: true });

    // Use capture to ensure we catch the events before other handlers
    window.addEventListener('mouseup', endDrag, true);
    window.addEventListener('touchend', endDrag, { passive: true, capture: true });

    // Safety cleanup - remove dragging class if window loses focus
    window.addEventListener('blur', endDrag);
    window.addEventListener('visibilitychange', function() {
      if (document.hidden) {
        endDrag();
      }
    });

    // Also listen for controls events if available
    if (controls && typeof controls.addEventListener === 'function') {
      controls.addEventListener('start', startDrag);
      controls.addEventListener('end', endDrag);
    }

    // Store globe instance for parallax effects
    el.__globeInstance = globe;
    controls.enableZoom = true;
    controls.autoRotate = !disableMotion;
    controls.autoRotateSpeed = 0.15; // Slowed down from 0.35 for more relaxed experience

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
      // Only handle clicks on country nodes (not animated dots)
      if (p.name && p.code) {
        handleCountryClick(p);
      }
      if (debug) { alert('Clicked: ' + (p.name || (p.lat + ',' + p.lng))); }
    });

    // Add hover functionality for country information
    globe.onPointHover(function (p) {
      if (p && p.name && p.code) {
        showCountryInfo(p);
      } else {
        hideCountryInfo();
      }
    });

    function showCountryInfo(country) {
      // Remove existing info panel
      var existingPanel = document.getElementById('country-info-panel');
      if (existingPanel) {
        existingPanel.remove();
      }

      // Get immigration flow information
      var incomingArcs = d.arcs.filter(function(arc) {
        return arc.endLat === country.lat && arc.endLng === country.lng;
      });

      var outgoingArcs = d.arcs.filter(function(arc) {
        return arc.startLat === country.lat && arc.startLng === country.lng;
      });

      // Create info panel
      var infoPanel = document.createElement('div');
      infoPanel.id = 'country-info-panel';

      var panelContent = `
        <div style="background: rgba(0,0,0,0.9); color: white; padding: 12px; border-radius: 8px; font-size: 14px; max-width: 220px;">
          <div style="font-weight: bold; margin-bottom: 8px;">${country.flag} ${country.name}</div>
      `;

      if (country.services) {
        panelContent += `
          <div style="font-size: 12px; opacity: 0.8; margin-bottom: 6px;">Services Available:</div>
          <div style="font-size: 12px; margin-bottom: 8px; line-height: 1.3;">${country.services}</div>
        `;
      }

      if (country.size >= 0.20) {
        // Our supported countries
        panelContent += `<div style="font-size: 12px; color: #4ade80; margin-bottom: 4px;">✓ Our Supported Destination</div>`;
        if (incomingArcs.length > 0) {
          panelContent += `<div style="font-size: 11px; opacity: 0.9;">${incomingArcs.length} immigration routes from ${getUniqueSourceCountries(incomingArcs).length} countries</div>`;
        }
      } else {
        // Source countries
        panelContent += `<div style="font-size: 12px; color: #fbbf24;">📍 Source Country</div>`;
        if (outgoingArcs.length > 0) {
          var destinations = getUniqueDestinationCountries(outgoingArcs);
          panelContent += `<div style="font-size: 11px; opacity: 0.9; margin-top: 4px;">Routes to: ${destinations.join(', ')}</div>`;
        }
      }

      panelContent += `</div>`;

      infoPanel.innerHTML = panelContent;

      infoPanel.style.position = 'absolute';
      infoPanel.style.top = '20px';
      infoPanel.style.right = '20px';
      infoPanel.style.zIndex = '1000';
      infoPanel.style.pointerEvents = 'none';

      globeContainer.appendChild(infoPanel);
    }

    function getUniqueSourceCountries(arcs) {
      var countries = [];
      arcs.forEach(function(arc) {
        var sourcePoint = d.points.find(function(p) {
          return p.lat === arc.startLat && p.lng === arc.startLng;
        });
        if (sourcePoint && !countries.includes(sourcePoint.name)) {
          countries.push(sourcePoint.name);
        }
      });
      return countries;
    }

    function getUniqueDestinationCountries(arcs) {
      var countries = [];
      arcs.forEach(function(arc) {
        var destPoint = d.points.find(function(p) {
          return p.lat === arc.endLat && p.lng === arc.endLng;
        });
        if (destPoint && destPoint.size >= 0.20) { // Only our supported countries
          countries.push(destPoint.name.split(',')[1] || destPoint.name); // Get country name
        }
      });
      return countries;
    }

    function hideCountryInfo() {
      var panel = document.getElementById('country-info-panel');
      if (panel) {
        panel.remove();
      }
    }

    function handleCountryClick(country) {
      // Add visual feedback class
      globeContainer.classList.add('interactive-active', 'route-highlight');

      // Get the country code to find all cities/nodes for this country
      var countryCode = country.code;

      // Find all nodes for this country (our supported countries have multiple nodes)
      var countryNodes = d.points.filter(function(point) {
        return point.code === countryCode && point.size >= 0.20; // Only our supported countries
      });

      // Highlight related arcs - arcs that end in any of our country nodes
      var relatedArcs = d.arcs.filter(function(arc) {
        // Check if arc ends in any of our country nodes
        return countryNodes.some(function(node) {
          return arc.endLat === node.lat && arc.endLng === node.lng;
        });
      });

      // Temporarily highlight the clicked country's nodes and their connections
      if (relatedArcs.length > 0) {
        // Create a temporary visual effect
        var originalPointColor = globe.pointColor();
        var originalArcColor = globe.arcColor();

        globe.pointColor(function(d) {
          // Highlight all nodes of the clicked country
          if (d.code === countryCode && d.size >= 0.20) {
            return '#ffffff'; // Highlight all country nodes in white
          }
          return d.color || 'rgba(99,102,241,0.3)'; // Dim other countries
        });

        globe.arcColor(function(e) {
          var isRelated = relatedArcs.some(function(arc) {
            return arc.startLat === e.startLat && arc.startLng === e.startLng &&
                   arc.endLat === e.endLat && arc.endLng === e.endLng;
          });
          if (isRelated) {
            // Make arcs to our countries very bright
            return ['#ffffff', '#ffffff'];
          }
          return ['rgba(96,165,250,0.2)', 'rgba(167,139,250,0.2)'];
        });

        // Reset after 4 seconds
        setTimeout(function() {
          globe.pointColor(originalPointColor);
          globe.arcColor(originalArcColor);
          globeContainer.classList.remove('interactive-active', 'route-highlight');
        }, 4000);
      } else {
        // Remove classes if no related arcs
        setTimeout(function() {
          globeContainer.classList.remove('interactive-active', 'route-highlight');
        }, 1000);
      }
    }

    // Add animated relocation dots
    if (!disableMotion && perfMode !== 'low' && d.show_dots) {
      addRelocationAnimations(globe, d.arcs);
    }

    function addRelocationAnimations(globe, arcs) {
      if (!arcs || arcs.length === 0) return;

      var animatedDots = [];
      var animationSpeed = 0.002; // Speed of dot movement along arcs (slowed down)

      // Create animated dots for each arc
      arcs.forEach(function(arc, index) {
        var dot = {
          arcIndex: index,
          progress: Math.random(), // Random starting position
          speed: animationSpeed + (Math.random() * 0.003), // Slight variation in speed
          arc: arc
        };
        animatedDots.push(dot);
      });

      // Animation loop for moving dots
      function animateDots() {
        if (disableMotion || perfMode === 'low') return;

        animatedDots.forEach(function(dot) {
          dot.progress += dot.speed;
          if (dot.progress >= 1) {
            dot.progress = 0; // Loop back to start
          }
        });

        // Update globe with new dot positions
        updateDotsOnGlobe();

        requestAnimationFrame(animateDots);
      }

      function updateDotsOnGlobe() {
        // Convert animated dots to globe-compatible format
        var dotsData = animatedDots.map(function(dot) {
          var arc = dot.arc;

          // Interpolate position along the arc
          var lat = arc.startLat + (arc.endLat - arc.startLat) * dot.progress;
          var lng = arc.startLng + (arc.endLng - arc.startLng) * dot.progress;

          return {
            lat: lat,
            lng: lng,
            size: 0.8 + Math.sin(dot.progress * Math.PI) * 0.4, // Pulsing effect
            color: arc.colorEnd || '#60a5fa'
          };
        });

        // Add dots as additional points data
        var allPoints = d.points.concat(dotsData);
        globe.pointsData(allPoints);
      }

      // Store initial points for reference
      var initialPoints = d.points.slice();

      // Start animation
      animateDots();
    }

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
    const mouseHoverMaxBoost = 0.12; // Reduced from 0.15
    const mouseHoverSpeed = 0.008; // Slowed down from 0.02

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

              // Smooth transition instead of instant jump (slowed down)
        const animateHoverIn = () => {
          mouseHoverBoost += mouseHoverSpeed * 0.5; // Slowed down by half
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

        // Smooth transition back instead of instant jump (slowed down)
        const animateHoverOut = () => {
          mouseHoverBoost -= mouseHoverSpeed * 0.3; // Slowed down significantly
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



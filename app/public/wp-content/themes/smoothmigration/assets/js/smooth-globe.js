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

    // Ultra-optimized scroll handling - minimal work during scroll
    var isScrolling = false;
    var scrollTimeout;
    var ticking = false;

    // Ultra-light scroll handler - just queue updates
    function handleScrollPassive() {
      if (!ticking) {
        requestAnimationFrame(function() {
          processScrollQueue();
          ticking = false;
        });
        ticking = true;
      }
    }

    // Process all queued scroll updates in one go
    function processScrollQueue() {
      const currentScrollY = window.scrollY;
      const velocity = Math.abs(currentScrollY - lastScrollY);

      // Only disable interactions during fast scrolling
      if (velocity > 10 && !isScrolling) {
        disableGlobeInteractions();
      }

      lastScrollY = currentScrollY;
    }

    // Simplified globe interaction disable
    function disableGlobeInteractions() {
      if (controls && !isScrolling) {
        controls.enableRotate = false;
        controls.enableZoom = false;
        controls.enablePan = false;
        controls.autoRotate = false;
        isScrolling = true;

        globeContainer.classList.add('scroll-disabled');

        clearTimeout(scrollTimeout);
        scrollTimeout = setTimeout(function() {
          if (controls) {
            controls.enableRotate = true;
            controls.enableZoom = true;
            controls.enablePan = true;
            if (!disableMotion && perfMode !== 'low') {
              controls.autoRotate = true;
            }
          }
          isScrolling = false;
          globeContainer.classList.remove('scroll-disabled');
        }, 250);
      }
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

    // Use ultra-light passive scroll listener
    window.addEventListener('scroll', handleScrollPassive, { passive: true });
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
      window.removeEventListener('scroll', handleScrollPassive);
      globeContainer.removeEventListener('touchstart', handleTouchStart);
      globeContainer.removeEventListener('touchmove', handleTouchMove);
      globeContainer.removeEventListener('touchend', handleTouchEnd);
      globeContainer.removeEventListener('wheel', handleWheel);
      globeContainer.removeEventListener('touchstart', handleBufferZoneTouch);
      globeContainer.removeEventListener('keydown', handleKeyDown);
      clearTimeout(scrollTimeout);
      if (rafId) {
        cancelAnimationFrame(rafId);
      }
      if (hoverAnimationId) {
        cancelAnimationFrame(hoverAnimationId);
      }
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



    // Variables for simplified floating behavior
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

    // Fixed start position globe positioning with fade-out
    let currentTranslateY = 0;
    let targetTranslateY = 0;
    let lastScrollPosition = window.scrollY;
    let servicesGridRect = null;
    let globeStartPosition = 0; // The maximum height/start position
    // CTA section intersection will be calculated dynamically
    let currentOpacity = 1; // Globe opacity for fade-out effect

    // Cache the grid position and set start position
    function cacheGridPosition() {
      const servicesGrid = document.querySelector('.services-grid');
      const ctaSection = document.querySelector('.services-cta');

      if (servicesGrid) {
        servicesGridRect = servicesGrid.getBoundingClientRect();
        // Set the start position to the top of the services grid (maximum height)
        globeStartPosition = servicesGridRect.top + window.scrollY;
        // Initialize globe at start position
        currentTranslateY = 0;
        targetTranslateY = 0;
      }

      // CTA section position will be calculated dynamically in updateGlobePosition
      // No need to cache it statically since intersection changes with scroll
    }

    // Smooth easing function for transitions
    function easeInOutQuad(t) {
      return t < 0.5 ? 2 * t * t : 1 - Math.pow(-2 * t + 2, 2) / 2;
    }

    // Globe positioning with proper intersection-based fade behavior
    function updateGlobePosition() {
      if (!servicesGridRect) return;

      // Get globe container element
      const globeContainer = globeElement.closest('.services-parallax-globe');
      if (!globeContainer) return;

      const currentScrollY = window.scrollY;

      // Get current positions of both elements
      const globeRect = globeContainer.getBoundingClientRect();
      const ctaSection = document.querySelector('.services-cta');

      if (!ctaSection) return;

      const ctaRect = ctaSection.getBoundingClientRect();

      // Calculate intersection between globe container and CTA section
      const globeBottom = globeRect.bottom;
      const globeTop = globeRect.top;
      const globeHeight = globeRect.height;

      const ctaTop = ctaRect.top;
      const ctaBottom = ctaRect.bottom;
      const ctaHeight = ctaRect.height;

      // Calculate how much the globe overlaps with the CTA section
      const overlapStart = Math.max(globeTop, ctaTop);
      const overlapEnd = Math.min(globeBottom, ctaBottom);
      const overlapHeight = Math.max(0, overlapEnd - overlapStart);

      // Calculate intersection percentage (0 to 1)
      const intersectionPercentage = overlapHeight / globeHeight;

      // Globe scrolls naturally with the page until it starts intersecting with CTA
      let naturalScrollY = Math.max(0, currentScrollY - globeStartPosition);

      // If globe hasn't reached CTA yet, move naturally
      if (intersectionPercentage === 0 && globeBottom < ctaTop) {
        targetTranslateY = naturalScrollY;
        currentOpacity = 1;
      }
      // If globe is intersecting with CTA, apply smooth fade and movement
      else if (intersectionPercentage > 0) {
        // Fade based on intersection percentage (start at 5%, complete at 95%)
        const fadeStartThreshold = 0.05; // 5% intersection - fade begins
        const fadeEndThreshold = 0.95;   // 95% intersection - fade completes

        // Movement transition zone (start earlier than fade for smoother effect)
        const movementStartThreshold = 0.02; // 2% intersection - start slowing movement
        const movementEndThreshold = 0.98;   // 98% intersection - fully slowed (30% speed)

        // Calculate fade progress with smooth easing
        let fadeProgress = 0;
        if (intersectionPercentage >= fadeStartThreshold) {
          const fadeRange = fadeEndThreshold - fadeStartThreshold;
          const fadePosition = intersectionPercentage - fadeStartThreshold;
          // Use smooth easing function for fade
          fadeProgress = Math.min(1, easeInOutQuad(fadePosition / fadeRange));
          currentOpacity = 1 - fadeProgress;
        } else {
          currentOpacity = 1;
        }

        // Calculate movement damping with smooth transition
        let movementDamping = 1.0; // Start with normal speed
        if (intersectionPercentage >= movementStartThreshold) {
          const movementRange = movementEndThreshold - movementStartThreshold;
          const movementPosition = intersectionPercentage - movementStartThreshold;
          // Smooth easing for movement damping
          const dampingProgress = Math.min(1, easeInOutQuad(movementPosition / movementRange));
          movementDamping = 1.0 - (dampingProgress * 0.7); // Gradually reduce to 30% speed
        }

        // Apply smoothed movement
        targetTranslateY = naturalScrollY * movementDamping;
      }
      // If globe has completely passed CTA section, keep it faded and still
      else if (globeTop >= ctaBottom) {
        currentOpacity = 0;
        // Keep the final position when it was 95% covered
        targetTranslateY = targetTranslateY; // Don't change position
      }

      // Handle pointer events based on visibility
      globeElement.style.pointerEvents = currentOpacity > 0.1 ? 'auto' : 'none';

      const visualContainer = globeElement.closest('.services-parallax-globe');
      if (visualContainer) {
        visualContainer.style.pointerEvents = currentOpacity > 0.1 ? 'auto' : 'none';
      }

      lastScrollPosition = currentScrollY;
    }

    // Ultra-simple animation loop - minimal work per frame
    let rafId = null;
    let lastFrameTime = 0;

    function updateGlobeSmooth(currentTime = 0) {
      // Limit to 60fps for smooth performance
      if (currentTime - lastFrameTime < 16.67) {
        rafId = requestAnimationFrame(updateGlobeSmooth);
        return;
      }
      lastFrameTime = currentTime;

      // Update position on each frame
      updateGlobePosition();

      // Smooth interpolation for position
      const positionDiff = targetTranslateY - currentTranslateY;
      currentTranslateY += positionDiff * 0.1; // Smooth easing

      // Simple scale based on mouse hover only
      const targetScale = baseScale + mouseHoverBoost;
      currentScale += (targetScale - currentScale) * 0.15;

      // Clamp scale
      currentScale = Math.max(minScale, Math.min(maxScale + mouseHoverMaxBoost, currentScale));

      // Subtle floating motion
      const time = currentTime * 0.001;
      const floatOffset = Math.sin(time * 0.5) * 0.5;

      // Apply transforms to both globe and visual container so they move together
      const globeTransform = `scale(${currentScale.toFixed(3)}) translateY(${floatOffset.toFixed(1)}px) translateZ(0)`;
      const containerTransform = `translateY(${currentTranslateY.toFixed(1)}px)`;

      // Only apply styles if globe is visible (opacity > 0)
      if (currentOpacity > 0.01) {
        globeElement.style.transform = globeTransform;
        globeElement.style.opacity = currentOpacity.toFixed(3);

        // Move the visual container (.services-parallax-globe) alongside the globe
        const visualContainer = globeElement.closest('.services-parallax-globe');
        if (visualContainer) {
          visualContainer.style.transform = containerTransform;
          visualContainer.style.opacity = currentOpacity.toFixed(3);
        }
      } else {
        // Globe is completely faded out, hide it entirely
        globeElement.style.opacity = '0';
        globeElement.style.pointerEvents = 'none';

        const visualContainer = globeElement.closest('.services-parallax-globe');
        if (visualContainer) {
          visualContainer.style.opacity = '0';
          visualContainer.style.pointerEvents = 'none';
        }
      }

      // Debug information (only in debug mode)
      if (globeDebug && Math.random() < 0.02) { // Show debug info occasionally
        const ctaSection = document.querySelector('.services-cta');
        const globeRect = globeContainer.getBoundingClientRect();
        const ctaRect = ctaSection ? ctaSection.getBoundingClientRect() : null;

        // Calculate intersection for debug
        let intersectionPercentage = 0;
        if (ctaRect) {
          const globeBottom = globeRect.bottom;
          const globeTop = globeRect.top;
          const globeHeight = globeRect.height;
          const ctaTop = ctaRect.top;
          const ctaBottom = ctaRect.bottom;

          const overlapStart = Math.max(globeTop, ctaTop);
          const overlapEnd = Math.min(globeBottom, ctaBottom);
          const overlapHeight = Math.max(0, overlapEnd - overlapStart);
          intersectionPercentage = overlapHeight / globeHeight;
        }

        const debugInfo = {
          scrollY: window.scrollY.toFixed(0),
          globeTop: globeRect.top.toFixed(0),
          globeBottom: globeRect.bottom.toFixed(0),
          ctaTop: ctaRect ? ctaRect.top.toFixed(0) : 'N/A',
          ctaBottom: ctaRect ? ctaRect.bottom.toFixed(0) : 'N/A',
          intersectionPercent: (intersectionPercentage * 100).toFixed(1) + '%',
          scrollDirection: 'intersection-based',
          currentY: currentTranslateY.toFixed(1),
          targetY: targetTranslateY.toFixed(1),
          scale: currentScale.toFixed(3),
          opacity: currentOpacity.toFixed(3),
          fadeState: intersectionPercentage > 0.95 ? 'COMPLETE' : intersectionPercentage > 0.05 ? 'FADING' : 'VISIBLE'
        };
        console.log('[GlobePosition]', debugInfo);

        // Update debug attributes on container
        if (globeContainer) {
          globeContainer.setAttribute('data-globe-top', globeRect.top.toFixed(0));
          globeContainer.setAttribute('data-globe-bottom', globeRect.bottom.toFixed(0));
          globeContainer.setAttribute('data-cta-top', ctaRect ? ctaRect.top.toFixed(0) : '0');
          globeContainer.setAttribute('data-intersection', (intersectionPercentage * 100).toFixed(1) + '%');
          globeContainer.setAttribute('data-opacity', currentOpacity.toFixed(3));
          globeContainer.setAttribute('data-scroll-behavior', 'intersection-based');
          globeContainer.setAttribute('data-fade-state', intersectionPercentage > 0.95 ? 'complete' : intersectionPercentage > 0.05 ? 'fading' : 'visible');
        }
      }

      rafId = requestAnimationFrame(updateGlobeSmooth);
    }

    // Cache initial position and start animation
    cacheGridPosition();

    // Set initial transforms - globe and container both start at the maximum height
    globeElement.style.transform = `scale(${baseScale}) translateY(0px) translateZ(0)`;

    // Also set the visual container initial transform
    const initialVisualContainer = globeElement.closest('.services-parallax-globe');
    if (initialVisualContainer) {
      initialVisualContainer.style.transform = `translateY(0px)`;
    }

    updateGlobeSmooth();

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

    // Optimized mouse interaction for enhanced zoom
    let hoverAnimationId = null;

    globeContainer.addEventListener('mouseenter', () => {
      // Clear any pending leave animation
      if (leaveTimeout) {
        clearTimeout(leaveTimeout);
        leaveTimeout = null;
      }

      if (isHoverAnimating || !isVisible) return;

      isHoverAnimating = true;

      // Cancel any existing animation
      if (hoverAnimationId) {
        cancelAnimationFrame(hoverAnimationId);
      }

      // Smooth transition with optimized easing
      const animateHoverIn = () => {
        const prevBoost = mouseHoverBoost;
        mouseHoverBoost += (mouseHoverMaxBoost - mouseHoverBoost) * 0.15; // Faster easing

        if (Math.abs(mouseHoverBoost - prevBoost) > 0.001) {
          hoverAnimationId = requestAnimationFrame(animateHoverIn);
        } else {
          mouseHoverBoost = mouseHoverMaxBoost;
          isHoverAnimating = false;
          hoverAnimationId = null;
        }
      };
      animateHoverIn();
    });

    globeContainer.addEventListener('mouseleave', () => {
      // Add a small delay to prevent flickering
      leaveTimeout = setTimeout(() => {
        if (isHoverAnimating || !isVisible) return;

        isHoverAnimating = true;

        // Cancel any existing animation
        if (hoverAnimationId) {
          cancelAnimationFrame(hoverAnimationId);
        }

        // Smooth transition back with optimized easing
        const animateHoverOut = () => {
          const prevBoost = mouseHoverBoost;
          mouseHoverBoost += (0 - mouseHoverBoost) * 0.12; // Faster easing

          if (Math.abs(mouseHoverBoost - prevBoost) > 0.001) {
            hoverAnimationId = requestAnimationFrame(animateHoverOut);
          } else {
            mouseHoverBoost = 0;
            isHoverAnimating = false;
            hoverAnimationId = null;
          }
        };
        animateHoverOut();
      }, 30); // Reduced delay for better responsiveness
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
      .services-parallax-globe::before {
        content: 'DEBUG: ' attr(data-scale) 'x Pos: ' attr(data-position) 'px Service: ' attr(data-service) ' | Start: ' attr(data-start-pos) 'px | Effective: ' attr(data-effective-start) 'px | CTA: ' attr(data-cta-fade-start) 'px | Opacity: ' attr(data-opacity);
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
        max-width: 600px;
        word-wrap: break-word;
      }
      .enhanced-service-card.active-service {
        outline: 3px solid #ff6b6b !important;
        outline-offset: 2px;
      }
      /* Debug indicator for start position */
      .globe-start-indicator {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 2px;
        background: red;
        z-index: 9999;
        pointer-events: none;
      }
      .globe-start-indicator::before {
        content: 'GLOBE START POSITION';
        position: absolute;
        top: -20px;
        left: 10px;
        background: red;
        color: white;
        padding: 2px 5px;
        font-size: 10px;
        border-radius: 3px;
      }
      /* Debug indicator for effective start position (where globe actually begins moving) */
      .globe-effective-start-indicator {
        position: absolute;
        top: 200px; /* 200px above start position */
        left: 0;
        width: 100%;
        height: 2px;
        background: orange;
        z-index: 9998;
        pointer-events: none;
      }
      .globe-effective-start-indicator::before {
        content: 'GLOBE EFFECTIVE START (MOVEMENT BEGINS HERE)';
        position: absolute;
        top: -20px;
        left: 10px;
        background: orange;
        color: white;
        padding: 2px 5px;
        font-size: 10px;
        border-radius: 3px;
      }
      /* Debug indicator for CTA fade-out start position */
      .globe-cta-fade-indicator {
        position: absolute;
        top: 0; /* Will be positioned dynamically */
        left: 0;
        width: 100%;
        height: 2px;
        background: purple;
        z-index: 9997;
        pointer-events: none;
      }
      .globe-cta-fade-indicator::before {
        content: 'GLOBE FADE-OUT STARTS HERE (CTA SECTION)';
        position: absolute;
        top: -20px;
        left: 10px;
        background: purple;
        color: white;
        padding: 2px 5px;
        font-size: 10px;
        border-radius: 3px;
      }
    `;
    document.head.appendChild(debugStyles);

    // Add visual indicators for start, effective start, and CTA fade positions
    const servicesGrid = document.querySelector('.services-grid');
    let ctaFadeIndicator = null;

    if (servicesGrid) {
      // Start position indicator (red line)
      const startIndicator = document.createElement('div');
      startIndicator.className = 'globe-start-indicator';
      servicesGrid.appendChild(startIndicator);

      // Effective start position indicator (orange line, 200px above start)
      const effectiveStartIndicator = document.createElement('div');
      effectiveStartIndicator.className = 'globe-effective-start-indicator';
      servicesGrid.appendChild(effectiveStartIndicator);

      // CTA fade start indicator (purple line, positioned dynamically)
      ctaFadeIndicator = document.createElement('div');
      ctaFadeIndicator.className = 'globe-cta-fade-indicator';
      servicesGrid.appendChild(ctaFadeIndicator);
    }
  }

  // Initialize services globe effects if on services page
  if (document.body.classList.contains('page-template-page-services') ||
      document.querySelector('.services-parallax-globe')) {
    initServicesGlobeEffects();
  }

})();



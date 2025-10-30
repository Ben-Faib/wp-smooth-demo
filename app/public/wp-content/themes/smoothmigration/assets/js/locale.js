(function(){
	if (!window.SM_LOCALE_DATA) return;
	const DATA = window.SM_LOCALE_DATA;
	const REGIONS = DATA.regions;
	const CURRENT_REGION = DATA.currentRegion;
	const DEBUG = !!DATA.debugEnabled;

	const qs = new URLSearchParams(location.search);
	if (qs.has('resetLocale')) {
		try {
			// Clear cookies
			document.cookie = 'smLocalePref=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;';
			document.cookie = 'smLocaleDismiss=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;';
			// Clear localStorage as backup
			localStorage.removeItem('smLocalePref');
			localStorage.removeItem('smLocaleDismiss');
		} catch(e){}
	}

	// Safe-area computation for fixed UI touching the top edge
	function computeSafeTop() {
		const adminBar = document.getElementById('wpadminbar');
		const topBar = document.querySelector('.top-bar');
		const adminBarH = adminBar ? adminBar.offsetHeight : 0;
		// Consider top bar only when not translated offscreen
		let topBarH = 0;
		if (topBar) {
			const cs = getComputedStyle(topBar);
			const isHidden = cs.transform && cs.transform !== 'none';
			topBarH = isHidden ? 0 : topBar.offsetHeight;
		}
		const total = adminBarH + topBarH;
		document.documentElement.style.setProperty('--sm-safe-top', total + 'px');
		document.documentElement.style.setProperty('--sm-topbar-height', (topBarH) + 'px');
	}
	computeSafeTop();
	window.addEventListener('resize', computeSafeTop, { passive: true });
	window.addEventListener('scroll', () => { window.requestAnimationFrame(computeSafeTop); }, { passive: true });

	// Build UI
	const $pill = document.getElementById('sm-locale-pill');
	const $pillText = document.getElementById('sm-pill-text');
	const $pillIco = document.querySelector('#sm-locale-pill .sm-pill-ico');
	const $chip = document.getElementById('sm-locale-chip');
	const $chipText = document.getElementById('sm-chip-text');
	const $chipSwitch = document.getElementById('sm-chip-switch');
	const $chipStay = document.getElementById('sm-chip-stay');
	const $sheet = document.getElementById('sm-locale-sheet');
	const $panel = $sheet && $sheet.querySelector('.sm-sheet-panel');
	const $grid = document.getElementById('sm-region-grid');
	const $langs = document.getElementById('sm-lang-list');
	const $done = document.getElementById('sm-done');
	let lastFocused = null;

	let state = restorePref() || { region: CURRENT_REGION, lang: defaultLangFor(CURRENT_REGION) };
	refreshPill();

	// Populate Regions as segmented chips (compact)
	const orderedKeys = ['us','ca','uk','au','za'].filter(k => REGIONS[k]);
	const inferredRegion = inferRegionFromAcceptLanguage()?.region;

	orderedKeys.forEach(k => {
		const b = document.createElement('button');
		b.type = 'button';
		b.className = 'sm-region';
		b.setAttribute('data-region', k);
		b.setAttribute('aria-pressed', k === state.region ? 'true' : 'false');
		const regionCfg = REGIONS[k] || {};
		b.setAttribute('aria-label', `${regionCfg.label || getCountryCode(k)} region ${regionCfg.domain ? `(${regionCfg.domain})` : ''}`.trim());
		b.setAttribute('role', 'radio');


		b.innerHTML = `
			<span class="sm-region-flag" aria-hidden="true">${flagEmojiFor(k)}</span>
			<span class="sm-region-info">
				<span class="sm-region-label">${regionCfg.label || getCountryCode(k)}</span>
				<span class="sm-region-domain">${regionCfg.domain || ''}</span>
			</span>
		`;

		b.addEventListener('click', () => {
			state.region = k;
			state.lang = defaultLangFor(k);
			refreshRegions();
			refreshLangs();
			refreshPill();
			validateAndUpdateDoneButton();
		});
		b.addEventListener('keydown', (e) => {
			if (e.key === 'Enter' || e.key === ' ') {
				e.preventDefault();
				state.region = k;
				state.lang = defaultLangFor(k);
				refreshRegions();
				refreshLangs();
				refreshPill();
				validateAndUpdateDoneButton();
			}
		});
		$grid.appendChild(b);
	});
	refreshRegions();
	refreshLangs();
	validateAndUpdateDoneButton();

	// Suggestion chip
	const forcePrompt = qs.get('localePrompt') === '1' || qs.get('feature.locale') === 'on';
	if (shouldSuggest() || forcePrompt) showChip();

	// Auto-open modal via debug param (?localeOpen=1)
	if (qs.get('localeOpen') === '1') {
		setTimeout(() => { openSheet(); }, 50);
	}



	// Events
	$pill && $pill.addEventListener('click', openSheet);
	$sheet && $sheet.addEventListener('click', (e) => { if (e.target.dataset.close) closeSheet(); });
	document.addEventListener('keydown', (e) => {
		if ($sheet && $sheet.getAttribute('aria-hidden') === 'false' && e.key === 'Escape') closeSheet();
		// focus trap
		if ($sheet && $sheet.getAttribute('aria-hidden') === 'false' && e.key === 'Tab') trapFocus(e);
		// Region grid keyboard navigation
		if ($sheet && $sheet.getAttribute('aria-hidden') === 'false' && e.target.closest('.sm-region')) {
			handleRegionKeydown(e);
		}
		// Language list keyboard navigation
		if ($sheet && $sheet.getAttribute('aria-hidden') === 'false' && e.target.closest('.sm-lang')) {
			handleLangKeydown(e);
		}
	});
	$done && $done.addEventListener('click', () => {
		savePref();
		navigateTo(state.region, normalizedLang(state.region, state.lang));
	});

	$chipSwitch && $chipSwitch.addEventListener('click', () => {
		savePref();
		navigateTo(state.region, normalizedLang(state.region, state.lang));
	});
	$chipStay && $chipStay.addEventListener('click', () => {
		dismissChip();
	});

	// Preselect via query (?region=ca&lang=fr) for QA
	if (qs.get('region') && REGIONS[qs.get('region')]) {
		state.region = qs.get('region');
		const l = qs.get('lang');
		if (l) state.lang = normalizedLang(state.region, l);
		refreshRegions(); refreshLangs(); refreshPill();
	}

	// Helpers
	function defaultLangFor(region) {
		const langs = Object.keys(REGIONS[region].languages || {});
		return langs[0] || 'en';
	}
	function normalizedLang(region, lang) {
		const keys = Object.keys(REGIONS[region].languages || {});
		return keys.includes(lang) ? lang : keys[0] || lang;
	}
	function refreshRegions() {
		Array.from($grid.children).forEach(el => {
			el.setAttribute('aria-pressed', el.dataset.region === state.region ? 'true' : 'false');
		});
	}
	function refreshLangs() {
		$langs.innerHTML = '';
		const entries = Object.entries(REGIONS[state.region].languages || {});
		const previousLang = state.lang;
		let langChanged = false;

		entries.forEach(([key, label]) => {
			const b = document.createElement('button');
			b.type = 'button';
			b.className = 'sm-lang';
			b.setAttribute('data-lang', key);
			b.setAttribute('aria-pressed', key === state.lang ? 'true' : 'false');
			b.setAttribute('aria-label', `${label} language`);
			b.setAttribute('role', 'radio');

			// Get autonym and locale code
			const autonym = getAutonym(key);
			const localeCode = getLocaleCode(key);

			const english = getEnglishName(key);
			b.innerHTML = `
				<span class="sm-lang-radio" aria-hidden="true"></span>
				<span class="sm-lang-info">
					<span class="sm-lang-autonym">${autonym}</span>
					<span class="sm-lang-meta">${english} · ${localeCode}</span>
				</span>
			`;

			b.addEventListener('click', () => {
				state.lang = key;
				refreshLangs();
				refreshPill();
				validateAndUpdateDoneButton();
			});
			b.addEventListener('keydown', (e) => {
				if (e.key === 'Enter' || e.key === ' ') {
					e.preventDefault();
					state.lang = key;
					refreshLangs();
					refreshPill();
					validateAndUpdateDoneButton();
				}
			});
			$langs.appendChild(b);
		});

		// Add notice if language was auto-changed
		if (!entries.find(([key]) => key === previousLang) && previousLang !== state.lang) {
			langChanged = true;
			const notice = document.createElement('div');
			notice.className = 'sm-lang-notice';
			notice.textContent = `Language changed to ${getAutonym(state.lang)} (${getLocaleCode(state.lang)}) for ${REGIONS[state.region].label}.`;
			$langs.appendChild(notice);

			// Auto-remove notice after 3 seconds
			setTimeout(() => {
				if (notice.parentNode) {
					notice.remove();
				}
			}, 3000);
		}
	}
	function refreshPill() {
		const r = REGIONS[state.region];
		const langLabel = (r.languages && r.languages[state.lang]) || 'English';
		const regionLabel = r.label || getCountryCode(state.region);
		$pillText.textContent = `${regionLabel} · ${langLabel}`;
		if ($pill) {
			$pill.setAttribute('title', `${regionLabel} – ${langLabel}`);
		}
		if ($pillIco) { $pillIco.textContent = flagEmojiFor(state.region); }
	}



	function validateAndUpdateDoneButton() {
		const doneButton = document.getElementById('sm-done');
		if (doneButton) {
			const hasValidSelection = state.region && state.lang &&
				REGIONS[state.region] &&
				REGIONS[state.region].languages &&
				REGIONS[state.region].languages[state.lang];

			doneButton.disabled = !hasValidSelection;
		}
	}

	function getCurrencyForRegion(region) {
		const currencyMap = {
			'us': 'USD',
			'ca': 'CAD',
			'uk': 'GBP',
			'au': 'AUD',
			'za': 'ZAR'
		};
		return currencyMap[region] || 'USD';
	}

	function getAutonym(lang) {
		const autonymMap = {
			'en': 'English',
			'fr': 'Français',
			'es': 'Español',
			'de': 'Deutsch',
			'en-GB': 'English',
			'en-AU': 'English',
			'en-ZA': 'English',
			'fr-CA': 'Français'
		};
		return autonymMap[lang] || lang;
	}

	function getEnglishName(lang) {
		const englishMap = {
			'en': 'English',
			'fr': 'French',
			'es': 'Spanish',
			'de': 'German',
			'en-GB': 'English (UK)',
			'en-AU': 'English (Australia)',
			'en-ZA': 'English (South Africa)',
			'fr-CA': 'French (Canada)'
		};
		return englishMap[lang] || lang;
	}
	function openSheet() {
		refreshPill();
		$sheet.setAttribute('aria-hidden', 'false');
		$pill && $pill.setAttribute('aria-expanded', 'true');
		lastFocused = document.activeElement;

		// Focus the close button first
		setTimeout(() => {
			const $closeButton = $sheet.querySelector('.sm-close');
			try { $closeButton && $closeButton.focus(); } catch(e){};
		}, 100);
	}
	function closeSheet() {
		$sheet.setAttribute('aria-hidden', 'true');
		$pill && $pill.setAttribute('aria-expanded', 'false');
		try { lastFocused && lastFocused.focus(); } catch(e){}
	}

	function trapFocus(e) {
		const focusable = $sheet.querySelectorAll('button:not([disabled]), [href], input, select, textarea, [tabindex]:not([tabindex="-1"])');
		const nodes = Array.from(focusable).filter(el => el.offsetParent !== null);
		if (!nodes.length) return;
		const first = nodes[0];
		const last = nodes[nodes.length - 1];
		if (e.shiftKey && document.activeElement === first) { last.focus(); e.preventDefault(); }
		else if (!e.shiftKey && document.activeElement === last) { first.focus(); e.preventDefault(); }
	}

	function restorePref() {
		try {
			const cookies = document.cookie.split(';');
			const localeCookie = cookies.find(cookie => cookie.trim().startsWith('smLocalePref='));

			if (!localeCookie) return null;

			const raw = decodeURIComponent(localeCookie.split('=')[1]);
			const val = JSON.parse(raw);

			if (val && REGIONS[val.region]) return val;
		} catch(e){}
		return null;
	}

	function savePref() {
		try {
			const expiryDate = new Date();
			expiryDate.setFullYear(expiryDate.getFullYear() + 1); // 1 year expiry

			const cookieValue = encodeURIComponent(JSON.stringify(state));
			document.cookie = `smLocalePref=${cookieValue}; expires=${expiryDate.toUTCString()}; path=/; SameSite=Lax`;

			// Also save to localStorage as backup (for cross-domain scenarios)
			localStorage.setItem('smLocalePref', JSON.stringify(state));
		} catch(e){}
	}

	function navigateTo(region, lang) {
		const cfg = REGIONS[region]; if (!cfg) return;
		const url = new URL(window.location.href);
		if (!DATA.allowedDomains.includes(cfg.domain)) return;

		url.hostname = cfg.domain;
		if (region === 'ca' && /^fr/i.test(lang)) {
			url.searchParams.set('lang', 'fr');
		} else {
			url.searchParams.delete('lang');
		}
		['localePrompt','resetLocale','feature.locale','region','localeDebug'].forEach(k => url.searchParams.delete(k));

		// Announce navigation for screen readers
		const announcement = `Navigating to ${cfg.label} website at ${cfg.domain}`;
		const ariaLive = document.createElement('div');
		ariaLive.setAttribute('aria-live', 'assertive');
		ariaLive.setAttribute('aria-atomic', 'true');
		ariaLive.className = 'sr-only';
		ariaLive.textContent = announcement;
		document.body.appendChild(ariaLive);

		// Navigate after a brief delay to allow announcement
		setTimeout(() => {
			window.location.assign(url.toString());
		}, 100);
	}

	function shouldSuggest() {
		const hint = inferRegionFromAcceptLanguage();
		if (!hint) return false;
		const different = hint.region && hint.region !== CURRENT_REGION;
		if (!different) return false;
		state.region = hint.region; state.lang = hint.lang; refreshPill();

		try {
			// Check cookies first, then localStorage
			const cookies = document.cookie.split(';');
			const dismissCookie = cookies.find(cookie => cookie.trim().startsWith('smLocaleDismiss='));

			let lastDismissed = 0;
			if (dismissCookie) {
				lastDismissed = parseInt(decodeURIComponent(dismissCookie.split('=')[1]), 10);
			} else {
				lastDismissed = parseInt(localStorage.getItem('smLocaleDismiss') || '0', 10);
			}

			const THIRTY_DAYS = 30*24*60*60*1000;
			return Date.now() - lastDismissed > THIRTY_DAYS;
		} catch(e) { return true; }
	}

	function showChip() {
		const r = REGIONS[state.region];
		$chipText.textContent = `Looks like ${r.label}. Switch?`;
		$chip.hidden = false;
	}
	function dismissChip() {
		$chip.hidden = true;
		try {
			const expiryDate = new Date();
			expiryDate.setMonth(expiryDate.getMonth() + 1); // 30 days expiry for dismissal

			document.cookie = `smLocaleDismiss=${Date.now()}; expires=${expiryDate.toUTCString()}; path=/; SameSite=Lax`;
			localStorage.setItem('smLocaleDismiss', String(Date.now())); // Backup
		} catch(e){}
	}

	function inferRegionFromAcceptLanguage() {
		const langs = navigator.languages || [navigator.language || 'en-US'];
		for (const raw of langs) {
			const l = String(raw || '').toLowerCase();
			if (l.includes('fr-ca')) return { region: 'ca', lang: 'fr' };
			if (l.includes('en-ca')) return { region: 'ca', lang: 'en' };
			if (l.includes('en-gb')) return { region: 'uk', lang: 'en-GB' };
			if (l.includes('en-au')) return { region: 'au', lang: 'en-AU' };
			if (l.includes('en-za')) return { region: 'za', lang: 'en-ZA' };
		}
		return null;
	}

	function flagEmojiFor(region) {
		switch (region) {
			case 'us': return '🇺🇸';
			case 'ca': return '🇨🇦';
			case 'uk': return '🇬🇧';
			case 'au': return '🇦🇺';
			case 'za': return '🇿🇦';
			default: return '🌐';
		}
	}

	function getCountryCode(region) {
		switch (region) {
			case 'us': return 'US';
			case 'ca': return 'CA';
			case 'uk': return 'UK';
			case 'au': return 'AU';
			case 'za': return 'ZA';
			default: return region.toUpperCase();
		}
	}

	function getLocaleCode(lang) {
		// Extract locale code (e.g., 'en-GB' -> 'GB', 'fr' -> 'FR')
		if (lang.includes('-')) {
			return lang.split('-')[1];
		}
		switch (lang) {
			case 'en': return 'EN';
			case 'fr': return 'FR';
			case 'es': return 'ES';
			case 'de': return 'DE';
			default: return lang.toUpperCase();
		}
	}

	function getCountryCode(region) {
		switch (region) {
			case 'us': return 'US';
			case 'ca': return 'CA';
			case 'uk': return 'UK';
			case 'au': return 'AU';
			case 'za': return 'ZA';
			default: return region.toUpperCase();
		}
	}

	function handleRegionKeydown(e) {
		const regions = Array.from($grid.children).filter(el => el.classList.contains('sm-region'));
		const currentIndex = regions.indexOf(e.target);

		switch (e.key) {
			case 'ArrowUp':
			case 'ArrowLeft':
				e.preventDefault();
				const prevIndex = currentIndex > 0 ? currentIndex - 1 : regions.length - 1;
				regions[prevIndex].focus();
				break;
			case 'ArrowDown':
			case 'ArrowRight':
				e.preventDefault();
				const nextIndex = currentIndex < regions.length - 1 ? currentIndex + 1 : 0;
				regions[nextIndex].focus();
				break;
			case 'Home':
				e.preventDefault();
				regions[0].focus();
				break;
			case 'End':
				e.preventDefault();
				regions[regions.length - 1].focus();
				break;
		}
	}

	function handleLangKeydown(e) {
		const languages = Array.from($langs.children).filter(el => el.classList.contains('sm-lang'));
		const currentIndex = languages.indexOf(e.target);

		switch (e.key) {
			case 'ArrowUp':
				e.preventDefault();
				const prevIndex = currentIndex > 0 ? currentIndex - 1 : languages.length - 1;
				languages[prevIndex].focus();
				break;
			case 'ArrowDown':
				e.preventDefault();
				const nextIndex = currentIndex < languages.length - 1 ? currentIndex + 1 : 0;
				languages[nextIndex].focus();
				break;
			case 'Home':
				e.preventDefault();
				languages[0].focus();
				break;
			case 'End':
				e.preventDefault();
				languages[languages.length - 1].focus();
				break;
		}
	}

	// Debug overlay (optional)
	if (DEBUG) {
		const box = document.createElement('div');
		box.style.position = 'fixed';
		box.style.left = '14px';
		box.style.bottom = '14px';
		box.style.zIndex = '2147483001';
		box.style.padding = '8px 10px';
		box.style.font = '12px/1.25 system-ui, -apple-system, Segoe UI, Roboto, sans-serif';
		box.style.background = 'rgba(0,0,0,.6)';
		box.style.color = '#fff';
		box.style.borderRadius = '10px';
		const info = {
			currentRegion: CURRENT_REGION,
			inferred: inferRegionFromAcceptLanguage(),
			state,
			allowed: DATA.allowedDomains
		};
		box.textContent = 'Locale Debug: ' + JSON.stringify(info);
		document.body.appendChild(box);
	}
})();



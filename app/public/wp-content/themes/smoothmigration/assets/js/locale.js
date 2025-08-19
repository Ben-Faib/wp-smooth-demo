(function(){
	if (!window.SM_LOCALE_DATA) return;
	const DATA = window.SM_LOCALE_DATA;
	const REGIONS = DATA.regions;
	const CURRENT_REGION = DATA.currentRegion;

	const qs = new URLSearchParams(location.search);
	if (qs.has('resetLocale')) {
		try { localStorage.removeItem('smLocalePref'); localStorage.removeItem('smLocaleDismiss'); } catch(e){}
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
	const $chip = document.getElementById('sm-locale-chip');
	const $chipText = document.getElementById('sm-chip-text');
	const $chipSwitch = document.getElementById('sm-chip-switch');
	const $chipStay = document.getElementById('sm-chip-stay');
	const $sheet = document.getElementById('sm-locale-sheet');
	const $panel = $sheet && $sheet.querySelector('.sm-sheet-panel');
	const $grid = document.getElementById('sm-region-grid');
	const $langs = document.getElementById('sm-lang-list');
	const $go = document.getElementById('sm-go');

	let state = restorePref() || { region: CURRENT_REGION, lang: defaultLangFor(CURRENT_REGION) };
	refreshPill();

	// Populate Regions
	const orderedKeys = ['us','ca','uk','au','za'].filter(k => REGIONS[k]);
	orderedKeys.forEach(k => {
		const b = document.createElement('button');
		b.type = 'button';
		b.className = 'sm-region';
		b.textContent = REGIONS[k].label;
		b.setAttribute('data-region', k);
		b.setAttribute('aria-pressed', k === state.region ? 'true' : 'false');
		b.addEventListener('click', () => { state.region = k; state.lang = defaultLangFor(k); refreshRegions(); refreshLangs(); refreshPill(); });
		$grid.appendChild(b);
	});
	refreshRegions();
	refreshLangs();

	// Suggestion chip
	const forcePrompt = qs.get('localePrompt') === '1' || qs.get('feature.locale') === 'on';
	if (shouldSuggest() || forcePrompt) showChip();

	// Events
	$pill && $pill.addEventListener('click', openSheet);
	$sheet && $sheet.addEventListener('click', (e) => { if (e.target.dataset.close) closeSheet(); });
	document.addEventListener('keydown', (e) => { if ($sheet && $sheet.getAttribute('aria-hidden') === 'false' && e.key === 'Escape') closeSheet(); });
	$go && $go.addEventListener('click', () => {
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
		entries.forEach(([key, label]) => {
			const b = document.createElement('button');
			b.type = 'button';
			b.className = 'sm-lang';
			b.textContent = label;
			b.setAttribute('data-lang', key);
			b.setAttribute('aria-pressed', key === state.lang ? 'true' : 'false');
			b.addEventListener('click', () => { state.lang = key; refreshLangs(); refreshPill(); });
			$langs.appendChild(b);
		});
	}
	function refreshPill() {
		const r = REGIONS[state.region];
		const langLabel = (r.languages && r.languages[state.lang]) || 'English';
		$pillText.textContent = `${r.label} · ${langLabel}`;
	}
	function openSheet() {
		refreshPill();
		$sheet.setAttribute('aria-hidden', 'false');
		setTimeout(() => { try { $panel && $panel.focus(); } catch(e){} }, 0);
	}
	function closeSheet() { $sheet.setAttribute('aria-hidden', 'true'); }

	function restorePref() {
		try {
			const raw = localStorage.getItem('smLocalePref');
			if (!raw) return null;
			const val = JSON.parse(raw);
			if (val && REGIONS[val.region]) return val;
		} catch(e){}
		return null;
	}
	function savePref() {
		try { localStorage.setItem('smLocalePref', JSON.stringify(state)); } catch(e){}
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
		['localePrompt','resetLocale','feature.locale','region'].forEach(k => url.searchParams.delete(k));

		window.location.assign(url.toString());
	}

	function shouldSuggest() {
		const hint = inferRegionFromAcceptLanguage();
		if (!hint) return false;
		const different = hint.region && hint.region !== CURRENT_REGION;
		if (!different) return false;
		state.region = hint.region; state.lang = hint.lang; refreshPill();

		try {
			const last = parseInt(localStorage.getItem('smLocaleDismiss') || '0', 10);
			const THIRTY_DAYS = 30*24*60*60*1000;
			return Date.now() - last > THIRTY_DAYS;
		} catch(e) { return true; }
	}

	function showChip() {
		const r = REGIONS[state.region];
		$chipText.textContent = `Looks like ${r.label}. Switch?`;
		$chip.hidden = false;
	}
	function dismissChip() {
		$chip.hidden = true;
		try { localStorage.setItem('smLocaleDismiss', String(Date.now())); } catch(e){}
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
})();



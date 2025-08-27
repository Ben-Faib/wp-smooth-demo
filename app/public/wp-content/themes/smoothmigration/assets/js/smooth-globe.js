(function () {
	if (typeof Globe !== 'function') return;

	var container = document.getElementById('smooth-globe') || document.querySelector('.smooth-globe');
	if (!container) return;

	var d = window.SmoothGlobeData || { arcs: [], points: [], reduced: false };

	var globe = Globe()
		.globeImageUrl('https://unpkg.com/three-globe/example/img/earth-dark.jpg')
		.bumpImageUrl('https://unpkg.com/three-globe/example/img/earth-topology.png')
		.backgroundColor('rgba(0,0,0,0)')
		.arcsData(d.arcs)
		.arcColor(function (e) { return [e.colorStart || '#60a5fa', e.colorEnd || '#a78bfa']; })
		.arcAltitude(0.2)
		.arcStroke(0.7)
		.arcDashLength(0.6)
		.arcDashGap(0.2)
		.arcDashAnimateTime(d.reduced ? 0 : 4000)
		.pointsData(d.points)
		.pointAltitude(0.01)
		.pointRadius(0.15)
		.pointColor(function () { return 'rgba(99,102,241,0.9)'; })
		(container);

	var controls = globe.controls();
	controls.enableZoom = true;
	controls.autoRotate = !d.reduced;
	controls.autoRotateSpeed = 0.35;

	function resize() {
		globe.width(container.clientWidth);
		globe.height(container.clientHeight);
	}
	window.addEventListener('resize', resize);
	resize();

	// Optional: click handler for points
	globe.onPointClick(function (p) {
		// Example: navigate by country
		// window.location.href = '/services?country=' + encodeURIComponent(p.name);
	});
})();



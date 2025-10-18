<?php
/**
 * Single Service Template
 * Rich, modern layout highlighting brand, why we recommend, and how it helps relocations
 * @package smoothmigration
 */

get_header();
the_post();

$affiliate_url = get_post_meta( get_the_ID(), '_service_affiliate_url', true );
$brand_color = get_post_meta( get_the_ID(), '_service_brand_color', true ) ?: '#175873';
$company_url = get_post_meta( get_the_ID(), '_service_company_url', true );
$service_terms = get_the_terms( get_the_ID(), 'service_type' );
$term_name = $service_terms && ! is_wp_error( $service_terms ) ? $service_terms[0]->name : '';
$term_slug = $service_terms && ! is_wp_error( $service_terms ) ? $service_terms[0]->slug : '';

// Determine appropriate button text based on service type
$button_text = 'Continue to Partner';
if (strpos($term_slug, 'insurance') !== false) {
    $button_text = 'Get a Quote';
}
?>

<main id="main" class="site-main service-single" role="main">
    <section class="service-hero py-6 text-white" style="background: linear-gradient(135deg, <?php echo esc_attr($brand_color); ?>, #0a2a36); position:relative;">
		<div class="container">
			<div class="row align-items-center g-4">
				<div class="col-lg-8">
					<div class="hero-content">
						<div class="breadcrumb small opacity-75 mb-2">Service / <?php echo esc_html( $term_name ); ?></div>
						<h1 class="display-4 fw-bold mb-3"><?php the_title(); ?></h1>
						<p class="lead mb-4">Trusted partner for international relocations. Learn why we recommend this provider.</p>
						<div class="d-flex flex-wrap gap-3">
							<?php if ( $affiliate_url ) : ?>
								<a href="<?php echo esc_url( $affiliate_url ); ?>" target="_blank" rel="nofollow noopener" class="btn btn-light btn-lg">Visit Partner</a>
							<?php endif; ?>
							<a href="/contact" class="btn btn-outline-light btn-lg">Talk to Our Team</a>
						</div>
						<?php 
						// Display awards in hero if they exist
						if ( function_exists( 'smoothmigration_display_awards_section' ) ) {
							smoothmigration_display_awards_section( get_the_ID(), 'hero' );
						}
						?>
					</div>
				</div>
                <div class="col-lg-4 text-center">
                    <div class="hero-logo bg-white rounded-3 p-4 shadow-sm">
                        <?php echo function_exists('smoothmigration_get_service_logo') ? smoothmigration_get_service_logo( get_the_ID(), 'dark', 'medium', array('class'=>'img-fluid') ) : ( has_post_thumbnail() ? get_the_post_thumbnail( get_the_ID(), 'medium', array('class'=>'img-fluid') ) : '' ); ?>
                    </div>
                </div>
			</div>
		</div>
	</section>

    <nav class="service-tabs bg-light border-bottom sticky-top" style="top:60px; z-index: 1000;">
        <div class="container">
            <ul class="nav nav-pills gap-2 py-2" id="svcTabs">
                <li class="nav-item"><a class="nav-link active" href="#overview">Overview</a></li>
                <li class="nav-item"><a class="nav-link" href="#how">How It Helps Relocators</a></li>
                <li class="nav-item"><a class="nav-link" href="#fees">Fees & Speed</a></li>
                <li class="nav-item"><a class="nav-link" href="#countries">Countries</a></li>
                <?php if ( function_exists( 'smoothmigration_get_service_awards' ) && ! empty( smoothmigration_get_service_awards( get_the_ID() ) ) ) : ?>
                <li class="nav-item"><a class="nav-link" href="#awards">Awards</a></li>
                <?php endif; ?>
                <li class="nav-item"><a class="nav-link" href="#faq">FAQs</a></li>
            </ul>
        </div>
    </nav>

    <section class="py-5" id="overview">
		<div class="container">
			<div class="row g-5">
				<div class="col-lg-8">
                    <article class="service-article">
                        <?php the_content(); ?>
                        <?php $svc_widget = get_post_meta( get_the_ID(), '_service_widget_html', true ); if ( $svc_widget ) : ?>
                        <hr class="my-5" />
                        <div class="card shadow-sm mb-4" id="svcWidget">
                            <div class="card-body">
                                <h2 class="h5 mb-3">Get a quote!</h2>
                                <div class="service-embed" data-widget-ready="0" aria-busy="true">
                                    <div class="svc-loading-overlay" role="status" aria-live="polite">
                                        <div class="text-center w-100">
                                            <div class="spinner-border text-primary" aria-hidden="true"></div>
                                            <p class="small text-muted mt-2 mb-0">Hold on tight — loading options…</p>
                                        </div>
                                    </div>
                                    <div class="svc-widget-target"></div>
                                    <noscript>
                                        <?php echo do_shortcode( $svc_widget ); ?>
                                    </noscript>
                                </div>
                                <template id="svcWidgetTpl"><?php echo do_shortcode( $svc_widget ); ?></template>
                            </div>
                        </div>
                        <?php endif; ?>
                        <hr class="my-5" />
                        <h2 id="how" class="h4">How It Helps Relocators</h2>
                        <ul>
                            <li>Step-by-step onboarding suited to cross-border moves</li>
                            <li>Clear timelines and document requirements</li>
                            <li>Works well alongside our other services</li>
                        </ul>
                        <h2 id="fees" class="h4 mt-4">Fees & Speed</h2>
                        <p class="text-muted">Indicative. See partner site for latest pricing.</p>
                        <div class="table-responsive">
                            <table class="table table-sm">
                                <thead><tr><th>Scenario</th><th>Typical Fee</th><th>Typical Speed</th></tr></thead>
                                <tbody>
                                    <tr><td>Standard</td><td>Low</td><td>1–2 days</td></tr>
                                    <tr><td>Express</td><td>Medium</td><td>Same day</td></tr>
                                </tbody>
                            </table>
                        </div>
                        <h2 id="countries" class="h4 mt-4">Supported Countries</h2>
                        <p>Broad global coverage. Use the partner site to confirm your corridor.</p>
                        <h2 id="faq" class="h4 mt-4">FAQs</h2>
                        <div class="accordion" id="svcFaq">
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="q1"><button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#a1">Do I need local ID?</button></h2>
                                <div id="a1" class="accordion-collapse collapse show" data-bs-parent="#svcFaq"><div class="accordion-body">Most services accept passport; some require local proof of address.</div></div>
                            </div>
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="q2"><button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#a2">Can I start before I land?</button></h2>
                                <div id="a2" class="accordion-collapse collapse" data-bs-parent="#svcFaq"><div class="accordion-body">Often yes. Some verifications can be done remotely.</div></div>
                            </div>
                        </div>
                        
                        <?php
                        // Display full awards section if they exist
                        if ( function_exists( 'smoothmigration_display_awards_section' ) && ! empty( smoothmigration_get_service_awards( get_the_ID() ) ) ) {
                            smoothmigration_display_awards_section( get_the_ID(), 'section' );
                        }
                        ?>
                    </article>
				</div>
				<div class="col-lg-4">
					<div class="card shadow-sm mb-4">
						<div class="card-body">
							<h3 class="h5">Why We Recommend</h3>
							<ul class="list-unstyled small mt-3">
								<li>Vetted partner with proven track record</li>
								<li>Trusted by expats for transparent pricing</li>
								<li>Seamless fit in our relocation workflow</li>
							</ul>
							<?php if ( $affiliate_url ) : ?>
								<a href="<?php echo esc_url( $affiliate_url ); ?>" target="_blank" rel="nofollow noopener" class="btn btn-primary w-100 mt-3"><?php echo esc_html( $button_text ); ?></a>
							<?php endif; ?>
						</div>
					</div>

					<?php
					// Display awards in sidebar if they exist
					if ( function_exists( 'smoothmigration_get_service_awards' ) && ! empty( smoothmigration_get_service_awards( get_the_ID() ) ) ) : ?>
						<div class="card shadow-sm mb-4">
							<div class="card-body">
								<?php smoothmigration_display_awards_section( get_the_ID(), 'sidebar' ); ?>
							</div>
						</div>
					<?php endif; ?>

					<div class="card shadow-sm">
						<div class="card-body">
							<h3 class="h5">Typical Timeline</h3>
							<p class="small text-muted mb-2">Based on recent expat projects</p>
							<div class="progress" style="height:10px;">
								<div class="progress-bar" role="progressbar" style="width: 70%; background-color: <?php echo esc_attr($brand_color); ?>"></div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>

    <!-- Sticky CTA bar -->
    <div class="sticky-cta shadow-lg">
        <div class="container d-flex justify-content-between align-items-center py-2">
            <strong><?php the_title(); ?></strong>
            <div class="d-flex gap-2">
                <?php if ( $affiliate_url ) : ?>
                <a href="<?php echo esc_url( $affiliate_url ); ?>" target="_blank" rel="nofollow noopener" class="btn btn-primary"><?php echo esc_html( $button_text ); ?></a>
                <?php endif; ?>
                <a href="/contact" class="btn btn-outline-primary">Talk to Our Team</a>
            </div>
        </div>
    </div>
</main>

<style>
.sticky-cta{position:sticky;bottom:0;background:#fff}
.service-tabs .nav-link{border-radius:999px}
#svcWidget{scroll-margin-top:100px}
#svcWidget .service-embed{position:relative;min-height:220px}
#svcWidget .svc-loading-overlay{position:absolute;inset:0;display:flex;align-items:center;justify-content:center;background:rgba(255,255,255,.85)}
#svcWidget:not(.svc-widget-loading) .svc-loading-overlay{display:none}
@media (prefers-reduced-motion: reduce){#svcWidget .spinner-border{animation:none!important}}

/* Awards Styling */
.service-awards{margin-top:1.5rem}
.award-badges-hero{display:flex;gap:1rem;margin-top:1.5rem;flex-wrap:wrap}
.award-badge-hero{flex:0 0 auto}
.award-badge-hero img{width:80px;height:80px;object-fit:contain;border-radius:50%;background:#fff;padding:5px;box-shadow:0 2px 8px rgba(0,0,0,0.1)}
.award-badge-sidebar{display:flex;gap:0.75rem;align-items:center;padding:0.75rem 0;border-bottom:1px solid #eee}
.award-badge-sidebar:last-child{border-bottom:none;padding-bottom:0}
.award-badge-sidebar .award-badge-image{flex-shrink:0}
.award-badge-sidebar .award-badge-img{width:60px;height:60px;object-fit:contain}
.award-badge-sidebar .award-badge-org{font-size:0.75rem;color:#6c757d;font-weight:600;text-transform:uppercase}
.award-badge-sidebar .award-badge-title{font-size:0.875rem;line-height:1.3;margin-top:0.25rem}
.award-badge-section{display:flex;gap:1.5rem;align-items:flex-start}
.award-badge-section .award-badge-image{flex-shrink:0}
.award-badge-section .award-badge-img{width:120px;height:120px;object-fit:contain}
.award-badge-section .award-badge-meta{display:flex;gap:1rem;margin-bottom:0.5rem;font-size:0.875rem}
.award-badge-section .award-badge-org{color:#6c757d;font-weight:600}
.award-badge-section .award-badge-year{color:#6c757d}
.award-badge-section .award-badge-title{font-size:1.25rem;margin-bottom:0.5rem}
.award-badge-section .award-badge-desc{color:#6c757d;margin-bottom:1rem}
.award-badge-section .award-badge-link{display:inline-flex;align-items:center;gap:0.5rem;text-decoration:none}
.award-badge-section .award-badge-link i{font-size:0.875rem}
@media (max-width: 768px){
  .award-badges-hero{justify-content:center}
  .award-badge-hero img{width:60px;height:60px}
  .award-badge-section{flex-direction:column;text-align:center}
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function(){
  // Smooth scroll for tabs
  document.querySelectorAll('#svcTabs a').forEach(a=>{
    a.addEventListener('click', function(e){
      if(this.hash){ e.preventDefault(); document.querySelector(this.hash).scrollIntoView({behavior:'smooth', block:'start'}); }
    });
  });
  // Track affiliate clicks
  document.querySelectorAll('a[rel~="nofollow"]').forEach(a=>{
    a.addEventListener('click', function(){
      if (window.gtag) { gtag('event','affiliate_click',{brand: '<?php echo esc_js( get_the_title() ); ?>', url: this.href}); }
    });
  });
});
</script>

<script>
document.addEventListener('DOMContentLoaded', function(){
	(function(){
		var card = document.getElementById('svcWidget');
		if(!card) return;
		var embed = card.querySelector('.service-embed');
		var target = embed.querySelector('.svc-widget-target');
		var tpl = document.getElementById('svcWidgetTpl');
		var qs = new URLSearchParams(window.location.search);
		var prefersReduced = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
		var debug = qs.get('widgetDebug') === '1';
		var loaded = false;

		function log(){ if(debug && window.console) console.log.apply(console, arguments); }

		function execScripts(scope){
			scope.querySelectorAll('script').forEach(function(old){
				var s = document.createElement('script');
				for (var i=0;i<old.attributes.length;i++){ var a=old.attributes[i]; s.setAttribute(a.name,a.value); }
				s.text = old.text || old.textContent;
				old.parentNode.replaceChild(s, old);
			});
		}

		function show(){ card.classList.add('svc-widget-loading'); embed.setAttribute('aria-busy','true'); }
		function hide(){ card.classList.remove('svc-widget-loading'); embed.removeAttribute('aria-busy'); }

		function load(){
			if(loaded) return;
			loaded = true;
			log('Widget: start lazy load');
			show();
			if(tpl){ target.innerHTML = tpl.innerHTML; execScripts(target); }
			var iframes = target.querySelectorAll('iframe');
			var done = false, count = 0;
			function finish(){
				if(done) return; done = true;
				hide();
				log('Widget: loaded');
				if (qs.get('toWidget') === '1' || window.location.hash === '#svcWidget') {
					card.scrollIntoView({ behavior: prefersReduced ? 'auto' : 'smooth', block: 'start' });
				}
			}
			if(iframes.length){
				iframes.forEach(function(f){
					f.addEventListener('load', function(){ count++; if(count===iframes.length) finish(); });
				});
				setTimeout(finish, 2000);
			}else{
				setTimeout(finish, 900);
			}
		}

		var observer = new IntersectionObserver(function(entries){
			entries.forEach(function(entry){ if(entry.isIntersecting){ load(); observer.disconnect(); } });
		}, { rootMargin: '300px 0px', threshold: 0.01 });
		observer.observe(card);

		if(qs.get('toWidget') === '1'){
			setTimeout(function(){
				card.scrollIntoView({ behavior: prefersReduced ? 'auto' : 'smooth', block: 'start' });
			}, 100);
			load();
			try{
				var url = new URL(window.location.href);
				url.searchParams.delete('toWidget');
				window.history.replaceState({}, '', url.pathname + url.hash);
			}catch(e){}
		}

		if(window.location.hash === '#svcWidget'){
			load();
			if(!prefersReduced){
				setTimeout(function(){
					card.scrollIntoView({ behavior: 'smooth', block: 'start' });
				}, 300);
			}
		}
	})();
});
</script>
<?php get_footer();



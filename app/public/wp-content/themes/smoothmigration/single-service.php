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
                        <div class="card shadow-sm mb-4">
                            <div class="card-body">
                                <h2 class="h5 mb-3">Booking / Price Widget</h2>
                                <div class="service-embed"><?php echo $svc_widget; ?></div>
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
								<a href="<?php echo esc_url( $affiliate_url ); ?>" target="_blank" rel="nofollow noopener" class="btn btn-primary w-100 mt-3">Use Partner Link</a>
							<?php endif; ?>
						</div>
					</div>

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
                <a href="<?php echo esc_url( $affiliate_url ); ?>" target="_blank" rel="nofollow noopener" class="btn btn-primary">Use Partner Link</a>
                <?php endif; ?>
                <a href="/contact" class="btn btn-outline-primary">Talk to Our Team</a>
            </div>
        </div>
    </div>
</main>

<style>
.sticky-cta{position:sticky;bottom:0;background:#fff}
.service-tabs .nav-link{border-radius:999px}
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
<?php get_footer();



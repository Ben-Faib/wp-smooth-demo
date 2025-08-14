<?php
/**
 * Realtor Form Page Template (replaces locator)
 * @package smoothmigration
 */

get_header(); ?>

<main id="main" class="site-main" role="main">
	<section class="py-6 bg-gradient-primary text-white text-center">
		<div class="container">
			<h1 class="display-4 fw-bold">Tell Us What You Need</h1>
			<p class="lead opacity-90">Share your preferences and we’ll match you with a vetted realtor</p>
		</div>
	</section>

	<section class="py-5 bg-light">
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-lg-10">
					<?php /* Simple embed to reuse the existing form block from locator page */ ?>
					<div class="card shadow-sm">
						<div class="card-body">
							<?php
								// If the old locator template exists, reuse its form markup for consistency (IDs/classes preserved)
								$locator = locate_template( 'page-realtor-locator.php' );
								if ( $locator ) {
									require $locator;
								} else {
									echo '<p>Please contact us for realtor assistance.</p>';
								}
							?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
</main>

<?php get_footer();



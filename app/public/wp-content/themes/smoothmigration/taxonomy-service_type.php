<?php
/**
 * The template for displaying archive pages for the "service_type" taxonomy.
 *
 * @package smoothmigration
 */

get_header();

$term = get_queried_object();
?>

        <header class="page-header bg-light py-5">
    <div class="container text-center">
        <h1 class="page-title display-5 fw-bold">
            <?php echo esc_html( $term->name ); ?>
        </h1>
        <?php if ( ! empty( $term->description ) ) : ?>
            <p class="lead text-muted"><?php echo esc_html( $term->description ); ?></p>
        <?php endif; ?>

        <!-- Request Help CTA -->
        <div class="mt-4">
            <a href="/contact" class="btn btn-primary btn-lg me-3" id="headerRequestHelp">
                <i class="fas fa-question-circle me-2"></i>Request Help
            </a>
            <a href="/services" class="btn btn-outline-primary btn-lg">
                <i class="fas fa-arrow-left me-2"></i>Back to All Services
            </a>
        </div>

        <?php if ( has_nav_menu( 'section_category_links' ) ) : ?>
            <nav aria-label="Category quick links" class="mt-4">
                <?php wp_nav_menu( array(
                    'theme_location' => 'section_category_links',
                    'container'      => false,
                    'menu_class'     => 'nav justify-content-center gap-2 flex-wrap',
                    'depth'          => 1,
                    'fallback_cb'    => false,
                ) ); ?>
            </nav>
        <?php endif; ?>
    </div>
</header>

<main id="main" class="site-main py-5" role="main">
    <div class="container">
        <?php
        // Add quick comparison for all service types except banking-services and realtor
        $excluded_slugs = array('banking-services', 'realtor');
        if ( isset($term) && isset($term->slug) && !in_array($term->slug, $excluded_slugs) ) :
        ?>
        <div class="card shadow-sm mb-4">
            <div class="card-body">
                <h2 class="h5 mb-3">Quick Comparison</h2>
                <div class="table-responsive">
                    <table class="table table-sm align-middle">
                        <?php
                        // Define comparison data for each service type
                        $service_comparisons = array(
                            'data-and-phone-plans' => array(
                                'headers' => array('Brand', 'Best For', 'Data Plans', 'Details'),
                                'data' => array(
                                    'airalo' => array('Best For' => 'Global eSIM coverage', 'Data Plans' => 'From $5/day'),
                                    'visible' => array('Best For' => 'US coverage', 'Data Plans' => 'Unlimited plans available'),
                                    'tesco' => array('Best For' => 'UK coverage', 'Data Plans' => 'Flexible monthly plans'),
                                    'canadiansim' => array('Best For' => 'Canadian coverage', 'Data Plans' => 'From $1/day'),
                                )
                            ),
                            'vehicles' => array(
                                'headers' => array('Brand', 'Best For', 'Vehicle Types', 'Details'),
                                'data' => array(
                                    'expat' => array('Best For' => 'International car leasing', 'Vehicle Types' => 'Cars, SUVs, vans'),
                                    'itlauto' => array('Best For' => 'US vehicle imports', 'Vehicle Types' => 'Various makes/models'),
                                    'bond' => array('Best For' => 'UK vehicle leasing', 'Vehicle Types' => 'Business & personal'),
                                )
                            ),
                            'international-moving' => array(
                                'headers' => array('Brand', 'Best For', 'Service Type', 'Details'),
                                'data' => array(
                                    'sirelo' => array('Best For' => 'Full-service moving', 'Service Type' => 'Door-to-door'),
                                    'experts' => array('Best For' => 'Specialized moving', 'Service Type' => 'Custom solutions'),
                                )
                            ),
                            'insurance' => array(
                                'headers' => array('Brand', 'Best For', 'Coverage Type', 'Details'),
                                'data' => array(
                                    'visitors-coverage' => array('Best For' => 'Travel medical insurance & visitors to US', 'Coverage Type' => 'Comparison marketplace'),
                                    'covermore' => array('Best For' => 'Travel & health insurance', 'Coverage Type' => 'Comprehensive'),
                                    'figo' => array('Best For' => 'Pet insurance', 'Coverage Type' => 'Pet-specific'),
                                    'lemonade' => array('Best For' => 'Tenant insurance', 'Coverage Type' => 'Rental protection'),
                                    'square' => array('Best For' => 'Canadian tenant insurance', 'Coverage Type' => 'Rental protection'),
                                    'pets' => array('Best For' => 'Canadian pet insurance', 'Coverage Type' => 'Pet health'),
                                )
                            ),
                            'visas-immigration' => array(
                                'headers' => array('Brand', 'Best For', 'Processing Time', 'Details'),
                                'data' => array(
                                    '1st' => array('Best For' => 'UK company setup', 'Processing Time' => '5-10 days'),
                                    'ownr' => array('Best For' => 'Canadian company setup', 'Processing Time' => '3-7 days'),
                                )
                            ),
                            'pet-relocation' => array(
                                'headers' => array('Brand', 'Best For', 'Service Type', 'Details'),
                                'data' => array(
                                    'pets' => array('Best For' => 'Canadian pet relocation', 'Service Type' => 'Health certificates & transport'),
                                    'figo' => array('Best For' => 'Pet health insurance', 'Service Type' => 'Insurance coverage'),
                                )
                            ),
                            'school-search' => array(
                                'headers' => array('Brand', 'Best For', 'Service Type', 'Details'),
                                'data' => array(
                                    'school' => array('Best For' => 'International school search', 'Service Type' => 'Research & enrollment'),
                                )
                            ),
                            'tax-legal' => array(
                                'headers' => array('Brand', 'Best For', 'Service Type', 'Details'),
                                'data' => array(
                                    'tax' => array('Best For' => 'International tax advice', 'Service Type' => 'Compliance & planning'),
                                    'legal' => array('Best For' => 'Legal services for expats', 'Service Type' => 'Documentation & advice'),
                                )
                            ),
                            'business-setup' => array(
                                'headers' => array('Brand', 'Best For', 'Processing Time', 'Details'),
                                'data' => array(
                                    '1st' => array('Best For' => 'UK company formation', 'Processing Time' => '5-10 working days'),
                                    'ownr' => array('Best For' => 'Canadian company setup', 'Processing Time' => '3-7 business days'),
                                )
                            ),
                            'utilities-services' => array(
                                'headers' => array('Brand', 'Best For', 'Service Type', 'Details'),
                                'data' => array(
                                    'utility' => array('Best For' => 'Internet & phone setup', 'Service Type' => 'Connection services'),
                                    'energy' => array('Best For' => 'Electricity & gas', 'Service Type' => 'Utility connections'),
                                )
                            )
                        );

                        $current_comparison = $service_comparisons[$term->slug] ?? null;

                        if ($current_comparison) :
                            // Output table headers
                            echo '<thead><tr>';
                            foreach ($current_comparison['headers'] as $header) {
                                echo '<th>' . esc_html($header) . '</th>';
                            }
                            echo '<th></th></tr></thead>';

                            // Output table body
                            echo '<tbody>';
                            $posts = get_posts(array(
                                'post_type'=>'service',
                                'numberposts'=>-1,
                                'tax_query'=>array(array(
                                    'taxonomy'=>'service_type',
                                    'field'=>'slug',
                                    'terms'=>array($term->slug)
                                ))
                            ));

                            foreach($posts as $p){
                                $slug = sanitize_title($p->post_title);
                                $row = null;
                                foreach($current_comparison['data'] as $key=>$val){
                                    if (strpos($slug,$key)!==false){
                                        $row=$val; break;
                                    }
                                }

                                if ($row) {
                                    echo '<tr>';
                                    echo '<td>'.esc_html($p->post_title).'</td>';
                                    foreach ($row as $value) {
                                        echo '<td>'.esc_html($value).'</td>';
                                    }
                                    echo '<td><a class="btn btn-outline-primary btn-sm" href="'.get_permalink($p->ID).'">Details</a></td>';
                                    echo '</tr>';
                                }
                            }
                            echo '</tbody>';
                        endif;
                        ?>
                    </table>
                </div>
            </div>
        </div>
        <?php endif; ?>

        <?php if ( isset($term) && isset($term->slug) && $term->slug === 'banking-services' ) : ?>
        <div class="card shadow-sm mb-4">
            <div class="card-body">
                <h2 class="h5 mb-3">Quick Comparison</h2>
                <div class="table-responsive">
                    <table class="table table-sm align-middle">
                        <thead><tr><th>Brand</th><th>Best For</th><th>Typical Speed</th><th></th></tr></thead>
                        <tbody>
                            <?php
                            $compare = array(
                                'wise' => array('Best For' => 'Low fees, multi-currency accounts', 'Speed' => 'Hours–2 days'),
                                'remitly' => array('Best For' => 'Cash pickup and remittances', 'Speed' => 'Minutes–1 day'),
                                'xe' => array('Best For' => 'Larger transfers & FX tools', 'Speed' => '1–3 days'),
                                'chime' => array('Best For' => 'US banking setup', 'Speed' => 'Same day'),
                            );
                            $posts = get_posts(array('post_type'=>'service','numberposts'=>-1,'tax_query'=>array(array('taxonomy'=>'service_type','field'=>'slug','terms'=>array('banking-services')))));
                            foreach($posts as $p){
                                $slug = sanitize_title($p->post_title);
                                $row = null;
                                foreach($compare as $key=>$val){ if (strpos($slug,$key)!==false){ $row=$val; break; } }
                                $best = $row['Best For'] ?? 'Great for expats';
                                $speed = $row['Speed'] ?? 'Varies';
                                echo '<tr><td>'.esc_html($p->post_title).'</td><td>'.esc_html($best).'</td><td>'.esc_html($speed).'</td><td><a class="btn btn-outline-primary btn-sm" href="'.get_permalink($p->ID).'">Details</a></td></tr>';
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <?php endif; ?>
        <?php if ( have_posts() ) : ?>
            <div class="row g-4">
                <?php while ( have_posts() ) : the_post(); ?>
                    <?php
                        $affiliate = get_post_meta( get_the_ID(), '_service_affiliate_url', true );
                        $logo_html = function_exists('smoothmigration_get_service_logo') ? smoothmigration_get_service_logo( get_the_ID(), 'list', 'medium', array('style'=>'height:36px;width:auto') ) : '';
                        if ( empty( $logo_html ) && has_post_thumbnail() ) {
                            $logo_html = get_the_post_thumbnail( get_the_ID(), 'medium', array( 'style' => 'height:36px;width:auto' ) );
                        }
                        $logo_src = '';
                        if ( $logo_html && preg_match('/src=\"([^\"]+)\"/i', $logo_html, $m) ) { $logo_src = $m[1]; }
                        
                        // Prioritize curated quick view from Service_Blurbs.xlsx
                        $quick_view_meta = get_post_meta( get_the_ID(), '_service_quick_view', true );
                        if ( ! empty( $quick_view_meta ) ) {
                            $excerpt = $quick_view_meta;
                        } else {
                            // Fallback: generate excerpt from post content
                            $raw_excerpt = has_excerpt() ? get_the_excerpt() : strip_tags( get_the_content() );
                            $raw_excerpt = preg_replace( '/^\s*(Overview|Summary)[:\s]+/i', '', (string) $raw_excerpt );
                            $excerpt = wp_trim_words( trim( preg_replace( '/\s+/', ' ', (string) $raw_excerpt ) ), 18, '…' );
                        }
                        
                        $service_terms = get_the_terms( get_the_ID(), 'service_type' );
                        $service_type_slug = $service_terms && ! is_wp_error( $service_terms ) ? $service_terms[0]->slug : '';
                    ?>
                    <div class="col-lg-12">
                        <?php $has_widget = get_post_meta( get_the_ID(), '_service_widget_html', true ) ? '1' : '0'; ?>
                        <div class="card h-100 shadow-sm service-list-card" data-title="<?php echo esc_attr( get_the_title() ); ?>" data-excerpt="<?php echo esc_attr( $excerpt ); ?>" data-logo="<?php echo esc_url( $logo_src ); ?>" data-link="<?php echo esc_url( get_permalink() ); ?>" data-affiliate="<?php echo esc_url( $affiliate ?: '' ); ?>" data-service-type="<?php echo esc_attr( $service_type_slug ); ?>" data-has-widget="<?php echo esc_attr( $has_widget ); ?>">
                            <div class="card-body d-flex align-items-center justify-content-between flex-wrap gap-3">
                                <div class="d-flex align-items-center gap-3">
                                    <?php echo $logo_html ?: ''; ?>
                                    <h3 class="card-title h5 mb-0"><?php the_title(); ?></h3>
                                </div>
                                <div class="d-flex gap-2">
                                    <button class="btn btn-outline-primary btn-sm btn-quick-view"
                                        data-service-type="<?php echo esc_attr( $service_type_slug ); ?>"
                                        data-service-type-name="<?php echo esc_attr( get_the_title() ); ?>">Quick View</button>
                                    <button class="btn btn-outline-secondary btn-sm js-add-plan" data-id="<?php the_ID(); ?>">Add to My Plan</button>
                                    <a href="<?php the_permalink(); ?>" class="btn btn-primary btn-sm">Learn More</a>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endwhile; ?>
            </div>
            
            <?php
            // Pagination
            the_posts_pagination( array(
                'prev_text' => '&laquo; Previous',
                'next_text' => 'Next &raquo;',
                'screen_reader_text' => 'Services navigation'
            ) );
            ?>

        <?php else : ?>
            <div class="text-center">
                <p>No services have been added to this category yet.</p>
                <a href="/services" class="btn btn-primary">Return to All Services</a>
            </div>
        <?php endif; ?>

        <div class="support-banner text-center bg-light p-4 p-md-5 rounded-4 shadow-sm mt-5">
            <h2 class="h4 fw-bold mb-3">Need a specialized service?</h2>
            <p class="mb-0">Looking for specialized services like international tax advice, business setup, or other services not listed? Our expert team is here to help with personalized solutions within our preferred network providers.</p>
            <a href="/contact" class="btn btn-primary mt-3">Talk to our team</a>
        </div>
    </div>
</main>

<!-- Removed per unified global Quick View modal (in footer via inc/ajax.php) -->
<!-- My Plan Tray -->
<div id="planTray" class="plan-tray shadow">
    <div class="plan-header">My Plan <span class="badge bg-primary" id="planCount">0</span></div>
    <div class="plan-items" id="planItems"></div>
    <div class="plan-actions">
        <a id="planSubmit" href="/contact" class="btn btn-primary w-100">Request Help</a>
    </div>
</div>

<style>
.service-list-card{border:1px solid var(--border-light,#e6e8eb)}
.support-banner{max-width:760px;margin:3rem auto 0;}
.support-banner p{font-size:1.05rem;line-height:1.6;}
.plan-tray{position:fixed;right:16px;bottom:16px;background:#fff;border-radius:12px;padding:12px;z-index:1050;width:320px;max-height:60vh;display:flex;flex-direction:column}
.plan-header{font-weight:700;margin-bottom:8px}
.plan-items{overflow:auto;flex:1;border:1px solid #eee;border-radius:8px;padding:8px;margin-bottom:8px}
.plan-item{display:flex;justify-content:space-between;align-items:center;padding:6px 4px;border-bottom:1px dashed #eee}
.plan-item:last-child{border-bottom:none}


</style>

<script>
document.addEventListener('DOMContentLoaded', function(){
    // My Plan tray
    const key='smPlan';
    const tray = document.getElementById('planTray');
    const itemsEl = document.getElementById('planItems');
    const countEl = document.getElementById('planCount');
    const submitEl = document.getElementById('planSubmit');
    function read(){ try { return JSON.parse(localStorage.getItem(key)||'[]'); } catch(e){ return []; } }
    function write(data){ localStorage.setItem(key, JSON.stringify(data)); update(); }
    function update(){
        const list = read();
        countEl.textContent = list.length;
        itemsEl.innerHTML='';
        list.forEach((it,idx)=>{
            const row=document.createElement('div'); row.className='plan-item';
            row.innerHTML='<span>'+it.title+'</span><button class="btn btn-sm btn-link text-danger">Remove</button>';
            row.querySelector('button').addEventListener('click',()=>{ list.splice(idx,1); write(list); updateRequestHelpLinks(); });
            itemsEl.appendChild(row);
        });

        // Update request help links whenever plan changes
        updateRequestHelpLinks();
    }
    document.querySelectorAll('.js-add-plan').forEach(btn=>{
        btn.addEventListener('click', function(){
            const card = this.closest('.service-list-card');
            const list = read();
            const title = card.dataset.title;
            if (!list.find(i=>i.title===title)) list.push({title});
            write(list);
        });
    });
    update();

    // Request Help functionality - Direct link to contact page
    function updateRequestHelpLinks() {
        const selectedServices = read();
        const serviceType = '<?php echo esc_js($term->slug); ?>';
        const serviceName = '<?php echo esc_js($term->name); ?>';

        // Build URL parameters
        const qp = new URLSearchParams();
        qp.set('interest', serviceType);
        qp.set('source', 'service_type_direct');

        // Build a human-readable message with clear formatting
        let message = `Service Type: ${serviceName}`;

        // Include selected services from plan tray
        if (selectedServices.length > 0) {
            const titles = selectedServices.map(i => i.title).join(', ');
            message += `\n\nSelected Services:\n${selectedServices.map(s => `• ${s.title}`).join('\n')}`;
            qp.set('services', titles);
        }

        // Properly encode the message to preserve line breaks
        qp.set('message', encodeURIComponent(message));

        // Update both request help links
        const headerLink = document.getElementById('headerRequestHelp');
        const planLink = document.getElementById('planSubmit');

        if (headerLink) {
            headerLink.href = '/contact?' + qp.toString();
        }

        if (planLink) {
            planLink.href = '/contact?' + qp.toString();
        }
    }

    // Update links when plan changes
    updateRequestHelpLinks();
});
</script>

<?php
get_footer(); 
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
    </div>
</header>

<main id="main" class="site-main py-5" role="main">
    <div class="container">
        <?php if ( isset($term) && isset($term->slug) && $term->slug === 'money-services' ) : ?>
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
                            $posts = get_posts(array('post_type'=>'service','numberposts'=>-1,'tax_query'=>array(array('taxonomy'=>'service_type','field'=>'slug','terms'=>array('money-services')))));
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
                        $logo_src = '';
                        if ( $logo_html && preg_match('/src=\"([^\"]+)\"/i', $logo_html, $m) ) { $logo_src = $m[1]; }
                        $excerpt = has_excerpt() ? get_the_excerpt() : wp_trim_words( strip_tags( get_the_content() ), 24 );
                    ?>
                    <div class="col-lg-12">
                        <div class="card h-100 shadow-sm service-list-card" data-title="<?php echo esc_attr( get_the_title() ); ?>" data-excerpt="<?php echo esc_attr( $excerpt ); ?>" data-logo="<?php echo esc_url( $logo_src ); ?>" data-link="<?php echo esc_url( get_permalink() ); ?>" data-affiliate="<?php echo esc_url( $affiliate ?: '' ); ?>">
                            <div class="card-body d-flex align-items-center justify-content-between flex-wrap gap-3">
                                <div class="d-flex align-items-center gap-3">
                                    <?php echo $logo_html ?: ''; ?>
                                    <h3 class="card-title h5 mb-0"><?php the_title(); ?></h3>
                                </div>
                                <div class="d-flex gap-2">
                                    <button class="btn btn-outline-primary btn-sm js-quick-view">Quick View</button>
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
    </div>
</main>

<!-- Quick View Modal -->
<div class="modal fade" id="serviceQuickView" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="qvTitle">Service</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="d-flex gap-3 align-items-start flex-wrap">
                    <img id="qvLogo" src="" alt="" style="height:56px;width:auto;display:none" />
                    <p id="qvExcerpt" class="mb-0 text-muted"></p>
                </div>
            </div>
            <div class="modal-footer d-flex justify-content-between">
                <small class="text-muted">We may earn a referral fee at no cost to you.</small>
                <div class="d-flex gap-2">
                    <a id="qvAffiliate" href="#" target="_blank" rel="nofollow noopener" class="btn btn-primary">Use Partner Link</a>
                    <a id="qvLearn" href="#" class="btn btn-outline-primary">Learn More</a>
                </div>
            </div>
        </div>
    </div>
    </div>

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
.plan-tray{position:fixed;right:16px;bottom:16px;background:#fff;border-radius:12px;padding:12px;z-index:1050;width:320px;max-height:60vh;display:flex;flex-direction:column}
.plan-header{font-weight:700;margin-bottom:8px}
.plan-items{overflow:auto;flex:1;border:1px solid #eee;border-radius:8px;padding:8px;margin-bottom:8px}
.plan-item{display:flex;justify-content:space-between;align-items:center;padding:6px 4px;border-bottom:1px dashed #eee}
.plan-item:last-child{border-bottom:none}
</style>

<script>
document.addEventListener('DOMContentLoaded', function(){
    // Quick View modal
    const modalEl = document.getElementById('serviceQuickView');
    let bsModal;
    if (window.bootstrap && modalEl){ bsModal = new bootstrap.Modal(modalEl); }
    document.querySelectorAll('.js-quick-view').forEach(btn => {
        btn.addEventListener('click', function(){
            const card = this.closest('.service-list-card');
            const title = card.dataset.title;
            const excerpt = card.dataset.excerpt;
            const logo = card.dataset.logo;
            const link = card.dataset.link;
            const affiliate = card.dataset.affiliate || link;
            document.getElementById('qvTitle').textContent = title;
            const logoEl = document.getElementById('qvLogo');
            if (logo){ logoEl.src = logo; logoEl.style.display='block'; } else { logoEl.style.display='none'; }
            document.getElementById('qvExcerpt').textContent = excerpt || '';
            document.getElementById('qvAffiliate').href = affiliate;
            document.getElementById('qvLearn').href = link;
            if (bsModal) { bsModal.show(); }
        });
    });

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
            row.querySelector('button').addEventListener('click',()=>{ list.splice(idx,1); write(list); });
            itemsEl.appendChild(row);
        });
        const titles = list.map(i=>i.title).join(', ');
        const url = new URL(submitEl.getAttribute('href'), window.location.origin);
        if (titles) { url.searchParams.set('services', titles); } else { url.searchParams.delete('services'); }
        submitEl.setAttribute('href', url.pathname + url.search);
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
});
</script>

<?php
get_footer(); 
<?php
/**
 * Template Name: Metaxchron Blog Landing
 */
get_header(); ?>

<!-- Hero Section -->
<section class="mxc-hero">
    <div class="container position-relative">
        <div class="row align-items-center g-5">
            <div class="col-lg-6 mxc-hero-content reveal">
                <span class="mxc-hero-kicker">Premium Futurism</span>
                <h1 class="display-4 fw-bold text-gradient mb-3"><?php echo esc_html( get_bloginfo( 'name' ) ); ?></h1>
                <p class="lead text-white-50 mb-4"><?php echo esc_html( get_bloginfo( 'description' ) ); ?></p>
                <div class="d-flex flex-wrap gap-3">
                    <a class="btn btn-primary btn-lg px-4" href="#features">Explore Features</a>
                    <a class="mxc-hero-cta" href="#latest">See Latest <i class="fas fa-arrow-right"></i></a>
                </div>
                <div class="d-flex flex-wrap gap-2 mt-4">
                    <span class="mxc-chip"><i class="fas fa-bolt"></i> Fast setup</span>
                    <span class="mxc-chip"><i class="fas fa-shield-alt"></i> WC-ready</span>
                    <span class="mxc-chip"><i class="fas fa-sliders-h"></i> Customizer driven</span>
                </div>
                <div class="d-flex gap-3 flex-wrap mt-4">
                    <div class="mxc-stat">
                        <div class="mxc-stat-number"><?php echo esc_html( wp_count_posts()->publish ); ?>+</div>
                        <div class="small text-muted">Articles styled<br>out-of-box</div>
                    </div>
                    <div class="mxc-stat">
                        <div class="mxc-stat-number">5</div>
                        <div class="small text-muted">Distinct single<br>layouts</div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 mxc-hero-visual position-relative reveal">
                <div class="floating-card glass-panel">
                    <p class="small text-muted mb-2">Latest drop</p>
                    <?php
                    $hero_post = get_posts( array( 'numberposts' => 1 ) );
                    if ( $hero_post ) :
                        $post = $hero_post[0];
                        setup_postdata( $post );
                    ?>
                        <?php if ( has_post_thumbnail( $post->ID ) ) : ?>
                            <a href="<?php echo get_permalink( $post->ID ); ?>" class="d-block mb-3">
                                <?php echo get_the_post_thumbnail( $post->ID, 'medium_large', array( 'class' => 'img-fluid rounded' ) ); ?>
                            </a>
                        <?php endif; ?>
                        <h3 class="h4 mb-2"><a class="text-white text-decoration-none" href="<?php echo get_permalink( $post->ID ); ?>"><?php echo esc_html( get_the_title( $post->ID ) ); ?></a></h3>
                        <p class="text-white-50 mb-3"><?php echo esc_html( wp_trim_words( get_the_excerpt( $post->ID ), 18 ) ); ?></p>
                        <div class="d-flex align-items-center gap-3">
                            <span class="mxc-chip"><i class="far fa-calendar-alt"></i> <?php echo esc_html( get_the_date( '', $post->ID ) ); ?></span>
                            <a class="btn btn-outline-primary btn-sm px-3" href="<?php echo get_permalink( $post->ID ); ?>">Read</a>
                        </div>
                    <?php
                        wp_reset_postdata();
                    else :
                    ?>
                        <h3 class="h4 mb-2 text-white">Launch your next story</h3>
                        <p class="text-white-50 mb-3">Import the demo content or start crafting your first article to see the premium hero come alive.</p>
                        <a class="btn btn-outline-primary btn-sm px-3" href="<?php echo admin_url( 'post-new.php' ); ?>">Create Post</a>
                    <?php endif; ?>
                </div>
                <span class="mxc-orb one"></span>
                <span class="mxc-orb two"></span>
            </div>
        </div>
    </div>
    <span class="position-absolute top-0 start-0 w-100 h-100" style="pointer-events:none;"></span>
</section>

<!-- Features Section -->
<section class="py-5" id="features">
    <div class="container">
        <div class="text-center mb-5 reveal">
            <span class="mxc-chip"><i class="fas fa-swatchbook"></i> Design system</span>
            <h2 class="mxc-section-title mt-3">Built for bold content, refined for conversions</h2>
            <p class="text-muted mb-0">Opinionated layouts, neon-accented surfaces, and effortless customizer controls bundled into one premium theme.</p>
        </div>
        <div class="row g-4 row-cols-1 row-cols-md-3">
            <div class="col">
                <div class="card h-100 border-0 mxc-feature-card p-4 reveal">
                    <div class="mb-3 display-6 text-primary-custom"><i class="fas fa-layer-group"></i></div>
                    <h5 class="fw-bold mb-2">Curated layouts</h5>
                    <p class="text-muted mb-0">Switch between grid, list, masonry, dual, minimal, or cover posts without touching code.</p>
                </div>
            </div>
            <div class="col">
                <div class="card h-100 border-0 mxc-feature-card p-4 reveal">
                    <div class="mb-3 display-6 text-primary-custom"><i class="fas fa-magic"></i></div>
                    <h5 class="fw-bold mb-2">Glassmorphic cards</h5>
                    <p class="text-muted mb-0">Layered glass surfaces, neon gradients, and animated chips create a premium storefront vibe.</p>
                </div>
            </div>
            <div class="col">
                <div class="card h-100 border-0 mxc-feature-card p-4 reveal">
                    <div class="mb-3 display-6 text-primary-custom"><i class="fas fa-rocket"></i></div>
                    <h5 class="fw-bold mb-2">Performance-first</h5>
                    <p class="text-muted mb-0">Bootstrap 5, async fonts, and lightweight effects keep the experience fast and smooth.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Latest Posts Preview -->
<section class="py-5 bg-light" id="latest">
    <div class="container">
        <?php
        $blog_page = get_option( 'page_for_posts' );
        $blog_url  = $blog_page ? get_permalink( $blog_page ) : home_url( '/' );
        ?>
        <div class="d-flex align-items-center justify-content-between flex-wrap mb-4 reveal">
            <div>
                <span class="mxc-chip mb-2"><i class="far fa-newspaper"></i> Fresh stories</span>
                <h2 class="mxc-section-title mb-0">From the blog</h2>
            </div>
            <a class="btn btn-outline-primary" href="<?php echo esc_url( $blog_url ); ?>">View all</a>
        </div>
        <div class="row g-4">
            <?php
            $landing_posts = new WP_Query( array( 'posts_per_page' => 3 ) );
            if ( $landing_posts->have_posts() ) :
                while ( $landing_posts->have_posts() ) : $landing_posts->the_post();
            ?>
                <div class="col-md-4">
                    <div class="card h-100 border-0 shadow-sm glass-panel reveal">
                        <?php if ( has_post_thumbnail() ) : ?>
                            <?php the_post_thumbnail( 'medium', array( 'class' => 'card-img-top', 'style' => 'height: 200px; object-fit: cover; border-top-left-radius: 12px; border-top-right-radius: 12px;' ) ); ?>
                        <?php endif; ?>
                        <div class="card-body">
                            <div class="d-flex align-items-center justify-content-between mb-2">
                                <span class="mxc-chip"><i class="far fa-calendar-alt"></i> <?php echo get_the_date(); ?></span>
                                <span class="text-muted small"><?php echo esc_html( mxc_get_reading_time() ); ?></span>
                            </div>
                            <h5 class="card-title"><?php the_title(); ?></h5>
                            <p class="card-text small text-muted"><?php echo wp_trim_words( get_the_excerpt(), 14 ); ?></p>
                        </div>
                        <div class="card-footer border-0 bg-transparent">
                            <a href="<?php the_permalink(); ?>" class="btn btn-primary w-100">Read More</a>
                        </div>
                    </div>
                </div>
            <?php
                endwhile;
                wp_reset_postdata();
            else :
                echo '<p class="text-muted">Add your first posts to showcase them here.</p>';
            endif;
            ?>
        </div>
    </div>
</section>

<!-- Call to Action -->
<section class="py-5">
    <div class="container">
        <div class="glass-panel p-5 text-center reveal">
            <h2 class="display-6 mb-3 text-gradient">Ready to launch your site?</h2>
            <p class="text-muted mb-4">Use the landing template, tweak colors and fonts in the Customizer, and publish with confidence.</p>
            <div class="d-flex justify-content-center gap-3 flex-wrap">
                <a href="<?php echo admin_url( 'customize.php' ); ?>" class="btn btn-primary btn-lg px-4">Open Customizer</a>
                <a href="<?php echo admin_url( 'edit.php' ); ?>" class="btn btn-outline-primary btn-lg px-4">Curate Posts</a>
            </div>
        </div>
    </div>
</section>

<?php get_footer(); ?>

<?php
/**
 * Single Post Logic Router
 */
$layout = get_post_meta( get_the_ID(), '_mxc_post_layout', true );

if ( $layout === 'cover' ) {
    include( locate_template( 'templates/single-cover.php' ) );
    return;
} elseif ( $layout === 'video' ) {
    include( locate_template( 'templates/single-video.php' ) );
    return;
} elseif ( $layout === 'sidebar-left' ) {
    include( locate_template( 'templates/single-sidebar-left.php' ) );
    return;
} elseif ( $layout === 'minimal' ) {
    include( locate_template( 'templates/single-minimal.php' ) );
    return;
} elseif ( $layout === 'dual' ) {
    include( locate_template( 'templates/single-dual.php' ) );
    return;
}

// Default Sidebar Right Layout
get_header(); ?>

<div class="container py-5">
    <div class="row">
        <div class="col-lg-8">
            <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
                <article <?php post_class(); ?>>
                    <?php if ( has_post_thumbnail() ) : ?>
                        <div class="mb-4">
                            <?php the_post_thumbnail( 'full', array( 'class' => 'img-fluid rounded shadow' ) ); ?>
                        </div>
                    <?php endif; ?>

                    <header class="mb-4">
                        <h1 class="fw-bolder mb-1"><?php the_title(); ?></h1>
                        <div class="text-muted fst-italic mb-2">
                            Posted on <?php echo get_the_date(); ?> by <?php the_author(); ?> &bull; <?php echo mxc_get_reading_time(); ?> read
                        </div>
                        <div class="badge bg-secondary text-decoration-none link-light">
                            <?php the_category( ' ' ); ?>
                        </div>
                    </header>

                    <section class="mb-5 content-body">
                        <?php if ( get_theme_mod( 'mxc_ad_before_content' ) ) : ?>
                            <div class="mxc-ad-before-content mb-4 text-center">
                                <?php echo get_theme_mod( 'mxc_ad_before_content' ); ?>
                            </div>
                        <?php endif; ?>

                        <?php the_content(); ?>

                        <!-- Review Box -->
                        <?php get_template_part( 'template-parts/review-box' ); ?>

                        <?php if ( get_theme_mod( 'mxc_ad_after_content' ) ) : ?>
                            <div class="mxc-ad-after-content mt-4 text-center">
                                <?php echo get_theme_mod( 'mxc_ad_after_content' ); ?>
                            </div>
                        <?php endif; ?>
                    </section>

                    <!-- Social Sharing -->
                    <div class="card bg-light mb-4">
                        <div class="card-body">
                            <h5 class="card-title h6">Share this post:</h5>
                            <a href="<?php echo esc_url( 'https://www.facebook.com/sharer/sharer.php?u=' . urlencode( get_permalink() ) ); ?>" target="_blank" class="btn btn-sm btn-primary me-2"><i class="fab fa-facebook-f"></i> Facebook</a>
                            <a href="<?php echo esc_url( 'https://x.com/intent/tweet?text=' . urlencode( get_the_title() ) . '&url=' . urlencode( get_permalink() ) ); ?>" target="_blank" class="btn btn-sm btn-dark text-white me-2"><i class="fab fa-x-twitter"></i> X</a>
                            <a href="<?php echo esc_url( 'https://www.linkedin.com/shareArticle?mini=true&url=' . urlencode( get_permalink() ) . '&title=' . urlencode( get_the_title() ) ); ?>" target="_blank" class="btn btn-sm btn-primary" style="background-color: #0077b5; border-color: #0077b5;"><i class="fab fa-linkedin-in"></i> LinkedIn</a>
                        </div>
                    </div>

                    <!-- Author Bio -->
                    <?php get_template_part( 'template-parts/author-bio' ); ?>

                    <!-- Related Posts -->
                    <?php get_template_part( 'template-parts/related-posts' ); ?>

                    <?php if ( comments_open() || get_comments_number() ) : ?>
                        <div class="mt-5">
                            <?php comments_template(); ?>
                        </div>
                    <?php endif; ?>

                </article>
            <?php endwhile; endif; ?>
        </div>

        <?php get_sidebar(); ?>
    </div>
</div>

<?php get_footer(); ?>

<?php
/**
 * Template Part: Featured Slider
 */
if ( ! get_theme_mod( 'mxc_show_slider', true ) ) {
    return;
}

$container_class = ( get_theme_mod( 'mxc_slider_width', 'container' ) === 'container' ) ? 'container' : 'container-fluid px-0';

$args = array(
    'posts_per_page' => 3,
    'ignore_sticky_posts' => 1,
);

if ( get_theme_mod( 'mxc_featured_source', 'sticky' ) === 'category' ) {
    $args['cat'] = get_theme_mod( 'mxc_featured_category', 0 );
} else {
    $args['post__in'] = get_option( 'sticky_posts' );
    // Fallback if no sticky posts: just get latest 3
    if ( empty( $args['post__in'] ) ) {
        $args = array( 'posts_per_page' => 3 );
    }
}

$slider_query = new WP_Query( $args );

if ( $slider_query->have_posts() ) : ?>
    <div class="<?php echo esc_attr( $container_class ); ?>">
    <div id="mxcCarousel" class="carousel slide mb-5" data-bs-ride="carousel">
        <div class="carousel-indicators">
            <?php $i = 0; while ( $slider_query->have_posts() ) : $slider_query->the_post(); ?>
                <button type="button" data-bs-target="#mxcCarousel" data-bs-slide-to="<?php echo $i; ?>" class="<?php echo $i === 0 ? 'active' : ''; ?>" aria-current="<?php echo $i === 0 ? 'true' : 'false'; ?>" aria-label="Slide <?php echo $i + 1; ?>"></button>
            <?php $i++; endwhile; ?>
        </div>
        <?php $slider_query->rewind_posts(); ?>
        <div class="carousel-inner rounded shadow">
            <?php $i = 0; while ( $slider_query->have_posts() ) : $slider_query->the_post(); ?>
                <div class="carousel-item <?php echo $i === 0 ? 'active' : ''; ?>">
                    <?php if ( has_post_thumbnail() ) : ?>
                        <?php the_post_thumbnail( 'full', array( 'class' => 'd-block w-100 mxc-slider-img', 'loading' => 'lazy' ) ); ?>
                    <?php else : ?>
                        <div class="d-block w-100 bg-secondary" style="height: clamp(260px, 45vw, 420px);"></div>
                    <?php endif; ?>
                    <div class="carousel-caption d-none d-md-block bg-dark bg-opacity-50 p-3 rounded">
                        <h5><a href="<?php the_permalink(); ?>" class="text-white text-decoration-none"><?php the_title(); ?></a></h5>
                        <p><?php echo get_the_excerpt(); ?></p>
                    </div>
                </div>
            <?php $i++; endwhile; ?>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#mxcCarousel" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#mxcCarousel" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
    </div>
    <?php wp_reset_postdata(); ?>
<?php endif; ?>

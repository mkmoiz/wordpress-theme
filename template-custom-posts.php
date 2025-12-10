<?php
/**
 * Template Name: Custom Posts Showcase
 */
get_header();

$ids_raw = get_post_meta( get_the_ID(), '_mxc_custom_posts_ids', true );
$ids     = array_filter( array_map( 'absint', explode( ',', $ids_raw ) ) );
$cat     = absint( get_post_meta( get_the_ID(), '_mxc_custom_posts_cat', true ) );
$count   = absint( get_post_meta( get_the_ID(), '_mxc_custom_posts_count', true ) );
$count   = $count ? $count : 6;

$args = array(
    'post_type'      => 'post',
    'posts_per_page' => $count,
    'post_status'    => 'publish',
);

if ( ! empty( $ids ) ) {
    $args['post__in'] = $ids;
    $args['orderby']  = 'post__in';
} elseif ( $cat ) {
    $args['cat'] = $cat;
}

$query = new WP_Query( $args );
$read_more_style = get_theme_mod( 'mxc_read_more_style', 'outline' ) === 'solid' ? 'btn-primary' : 'btn-outline-primary';
$container_style = get_theme_mod( 'mxc_container_style', 'boxed' );
?>

<div class="<?php echo esc_attr( mxc_container_class( 'content' ) ); ?> mxc-section">
    <header class="text-center mb-5">
        <h1 class="display-4 fw-bold"><?php the_title(); ?></h1>
        <?php if ( has_excerpt() ) : ?>
            <p class="lead text-muted"><?php echo get_the_excerpt(); ?></p>
        <?php endif; ?>
    </header>

    <?php if ( $query->have_posts() ) : ?>
        <div class="row g-4 row-cols-1 row-cols-md-2 row-cols-lg-3">
            <?php while ( $query->have_posts() ) : $query->the_post(); ?>
                <?php
                $card_class = ( $container_style === 'boxed' ) ? 'card h-100 shadow-sm border-0' : 'h-100 border-0 mb-4';
                ?>
                <div class="col">
                    <article <?php post_class( $card_class ); ?>>
                        <?php if ( get_theme_mod( 'mxc_show_feat_img', true ) && has_post_thumbnail() ) : ?>
                            <a href="<?php the_permalink(); ?>">
                                <?php the_post_thumbnail( 'medium_large', array( 'class' => 'card-img-top', 'style' => 'height: 200px; object-fit: cover;' ) ); ?>
                            </a>
                        <?php endif; ?>
                        <div class="card-body <?php echo ( $container_style === 'unboxed' ) ? 'px-0' : ''; ?>">
                            <?php if ( get_theme_mod( 'mxc_show_meta', true ) ) : ?>
                                <div class="mb-2 text-muted small">
                                    <?php if ( get_theme_mod( 'mxc_meta_date', true ) ) : ?>
                                        <span class="me-2"><i class="far fa-calendar-alt"></i> <?php echo get_the_date(); ?></span>
                                    <?php endif; ?>
                                    <?php if ( get_theme_mod( 'mxc_meta_category', true ) ) : ?>
                                        <span><i class="far fa-folder"></i> <?php the_category( ', ' ); ?></span>
                                    <?php endif; ?>
                                </div>
                            <?php endif; ?>
                            <h2 class="card-title h5"><a href="<?php the_permalink(); ?>" class="text-decoration-none"><?php the_title(); ?></a></h2>
                            <?php if ( get_theme_mod( 'mxc_show_excerpt', true ) ) : ?>
                                <p class="card-text text-muted"><?php echo wp_trim_words( get_the_excerpt(), get_theme_mod( 'mxc_excerpt_length', 18 ) ); ?></p>
                            <?php endif; ?>
                        </div>
                        <?php if ( get_theme_mod( 'mxc_show_readmore', true ) ) : ?>
                            <div class="card-footer border-0 bg-transparent <?php echo ( $container_style === 'unboxed' ) ? 'px-0' : ''; ?>">
                                <a href="<?php the_permalink(); ?>" class="btn btn-sm <?php echo esc_attr( $read_more_style ); ?> rounded-pill"><?php echo esc_html( get_theme_mod( 'mxc_read_more_text', __( 'Read More', 'metaxchron' ) ) ); ?></a>
                            </div>
                        <?php endif; ?>
                    </article>
                </div>
            <?php endwhile; ?>
        </div>
        <?php wp_reset_postdata(); ?>
    <?php else : ?>
        <div class="alert alert-info" role="alert"><?php esc_html_e( 'No posts found for this selection.', 'metaxchron' ); ?></div>
    <?php endif; ?>
</div>

<?php get_footer(); ?>

<?php get_header(); ?>

<?php
if ( get_theme_mod( 'mxc_featured_style', 'slider' ) === 'magazine' ) {
    get_template_part( 'template-parts/featured-magazine' );
} else {
    get_template_part( 'template-parts/slider' );
}
?>

<div class="container py-5">

    <div class="row">
        <div class="col-lg-8">
            <?php if ( is_home() && ! is_front_page() ) : ?>
                <h1 class="mb-4 border-bottom pb-2"><?php single_post_title(); ?></h1>
            <?php else : ?>
                <h2 class="mb-4 border-bottom pb-2"><?php echo esc_html( get_theme_mod( 'mxc_home_title', 'Latest Posts' ) ); ?></h2>
            <?php endif; ?>

            <?php
            $layout = get_theme_mod( 'mxc_home_layout', 'grid' );
            $grid_class = ( $layout === 'grid' ) ? 'row row-cols-1 row-cols-md-2 g-4' : 'row row-cols-1 g-4';
            ?>

            <div id="mxc-posts-container" class="<?php echo esc_attr( $grid_class ); ?>">
                <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
                    <?php
                    // Astra-like Blog Pro Settings
                    $container_style = get_theme_mod( 'mxc_container_style', 'boxed' );
                    $card_class = ( $container_style === 'boxed' ) ? 'card h-100 shadow-sm border-0' : 'h-100 border-0 mb-4';
                    $layout = get_theme_mod( 'mxc_home_layout', 'grid' );
                    if ( $layout === 'list' ) { $card_class .= ' flex-row'; }
                    ?>
                    <div class="col">
                        <article <?php post_class( $card_class ); ?>>
                            <?php if ( get_theme_mod( 'mxc_show_feat_img', true ) && has_post_thumbnail() ) : ?>
                                <a href="<?php the_permalink(); ?>" class="<?php echo ( $layout === 'list' ) ? 'w-25' : ''; ?>">
                                    <?php
                                    $img_style = ( $layout === 'list' ) ? 'height: 100%; object-fit: cover;' : 'object-fit: cover;';
                                    if ( $container_style === 'unboxed' ) { $img_style .= 'border-radius: 0.5rem;'; }
                                    the_post_thumbnail( 'medium_large', array( 'class' => 'card-img-top ' . ( $layout === 'list' ? 'h-100' : '' ), 'style' => $img_style, 'loading' => 'lazy' ) );
                                    ?>
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

                                <?php if ( get_theme_mod( 'mxc_show_title', true ) ) : ?>
                                    <h3 class="card-title h5"><a href="<?php the_permalink(); ?>" class="text-decoration-none"><?php the_title(); ?></a></h3>
                                <?php endif; ?>

                                <?php if ( get_theme_mod( 'mxc_show_excerpt', true ) ) : ?>
                                    <p class="card-text"><?php echo wp_trim_words( get_the_excerpt(), get_theme_mod( 'mxc_excerpt_length', 18 ) ); ?></p>
                                <?php endif; ?>
                            </div>
                            <?php if ( get_theme_mod( 'mxc_show_readmore', true ) ) :
                                $btn_style = get_theme_mod( 'mxc_read_more_style', 'outline' ) === 'solid' ? 'btn-primary' : 'btn-outline-primary';
                            ?>
                                <div class="card-footer border-0 bg-transparent <?php echo ( $container_style === 'unboxed' ) ? 'px-0' : ''; ?>">
                                    <a href="<?php the_permalink(); ?>" class="btn <?php echo esc_attr( $btn_style ); ?> btn-sm rounded-pill"><?php echo esc_html( get_theme_mod( 'mxc_read_more_text', __( 'Read More', 'metaxchron' ) ) ); ?></a>
                                </div>
                            <?php endif; ?>
                        </article>
                    </div>
                <?php endwhile; else : ?>
                    <p><?php esc_html_e( 'No posts found.', 'metaxchron' ); ?></p>
                <?php endif; ?>
            </div>

            <div class="mt-5 text-center">
                <?php
                // AJAX Load More Button
                if (  $wp_query->max_num_pages > 1 ) {
                    echo '<button id="mxc-load-more" class="btn btn-primary rounded-pill px-5">Load More</button>';

                    // Pass query data to JS securely
                    $ajax_params = array(
                        'posts'        => json_encode( $wp_query->query_vars ),
                        'current_page' => ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1,
                        'max_page'     => $wp_query->max_num_pages,
                        'layout'       => $layout
                    );

                    wp_add_inline_script( 'mxc-main-js', 'var mxc_ajax_params = ' . wp_json_encode( $ajax_params ) . ';', 'before' );
                } else {
                     // Fallback standard pagination
                    the_posts_pagination( array(
                        'mid_size'  => 2,
                        'prev_text' => __( '&laquo; Previous', 'metaxchron' ),
                        'next_text' => __( 'Next &raquo;', 'metaxchron' ),
                        'class'     => 'pagination justify-content-center'
                    ) );
                }
                ?>
            </div>
        </div>

        <?php get_sidebar(); ?>
    </div>
</div>

<?php get_footer(); ?>

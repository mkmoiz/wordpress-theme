<?php
/**
 * AJAX Load More Handler
 */
function mxc_ajax_load_more() {
    check_ajax_referer( 'mxc_load_more_nonce', 'nonce' );

    $raw_args = isset( $_POST['query'] ) ? json_decode( stripslashes( $_POST['query'] ), true ) : array();

    // Whitelist allowed parameters for security
    $allowed_keys = array( 'category_name', 'cat', 'tag', 'tag_id', 'author', 'author_name', 's', 'year', 'monthnum', 'day', 'post_type' );
    $args = array();

    foreach ( $allowed_keys as $key ) {
        if ( isset( $raw_args[$key] ) ) {
            $args[$key] = $raw_args[$key];
        }
    }

    $args['paged'] = absint( $_POST['page'] ) + 1;
    $args['post_status'] = 'publish';

    $query = new WP_Query( $args );

    $layout = isset( $_POST['layout'] ) ? sanitize_text_field( $_POST['layout'] ) : 'grid';

    if ( $query->have_posts() ) {
        while ( $query->have_posts() ) {
            $query->the_post();
            ?>
            <div class="col">
                <article <?php post_class( 'card h-100 shadow-sm border-0 ' . ( $layout === 'list' ? 'flex-row' : '' ) ); ?>>
                    <?php if ( has_post_thumbnail() ) : ?>
                        <a href="<?php the_permalink(); ?>" class="<?php echo ( $layout === 'list' ) ? 'w-25' : ''; ?>">
                            <?php
                            $img_style = ( $layout === 'list' ) ? 'height: 100%; object-fit: cover;' : 'object-fit: cover;';
                            the_post_thumbnail( 'medium_large', array( 'class' => 'card-img-top ' . ( $layout === 'list' ? 'h-100' : '' ), 'style' => $img_style, 'loading' => 'lazy' ) );
                            ?>
                        </a>
                    <?php endif; ?>
                    <div class="card-body">
                        <div class="mb-2 text-muted small">
                            <span class="me-2"><i class="far fa-calendar-alt"></i> <?php echo get_the_date(); ?></span>
                            <span><i class="far fa-folder"></i> <?php the_category( ', ' ); ?></span>
                        </div>
                        <h3 class="card-title h5"><a href="<?php the_permalink(); ?>" class="text-decoration-none"><?php the_title(); ?></a></h3>
                        <p class="card-text"><?php echo wp_trim_words( get_the_excerpt(), 15 ); ?></p>
                    </div>
                    <div class="card-footer border-0 bg-transparent">
                        <a href="<?php the_permalink(); ?>" class="btn btn-outline-primary btn-sm rounded-pill">Read More</a>
                    </div>
                </article>
            </div>
            <?php
        }
    }
    wp_die();
}
add_action( 'wp_ajax_mxc_load_more', 'mxc_ajax_load_more' );
add_action( 'wp_ajax_nopriv_mxc_load_more', 'mxc_ajax_load_more' );

<?php
/**
 * Template Part: Featured Magazine Grid
 */
$args = array(
    'posts_per_page'      => 3,
    'ignore_sticky_posts' => 1,
);

if ( get_theme_mod( 'mxc_featured_source', 'sticky' ) === 'category' ) {
    $args['cat'] = get_theme_mod( 'mxc_featured_category', 0 );
} else {
    $args['post__in'] = get_option( 'sticky_posts' );
    // Fallback if no sticky posts
    if ( empty( $args['post__in'] ) ) {
        $args = array( 'posts_per_page' => 3 );
    }
}

$featured_query = new WP_Query( $args );

// Check visibility setting
if ( ! get_theme_mod( 'mxc_show_slider', true ) ) {
    return;
}

if ( $featured_query->have_posts() ) : ?>
    <div class="container mb-5">
        <div class="row g-3">
            <?php
            $i = 0;
            while ( $featured_query->have_posts() ) : $featured_query->the_post();
                // First Post (Big, Left)
                if ( $i === 0 ) : ?>
                    <div class="col-lg-8">
                        <div class="card bg-dark text-white border-0 h-100 position-relative overflow-hidden shadow-lg">
                            <?php if ( has_post_thumbnail() ) : ?>
                                <div class="position-absolute w-100 h-100" style="background: url('<?php echo get_the_post_thumbnail_url( null, 'large' ); ?>') center/cover;"></div>
                                <div class="position-absolute w-100 h-100 bg-dark opacity-50"></div>
                            <?php endif; ?>
                            <div class="card-img-overlay d-flex flex-column justify-content-end p-4 p-md-5">
                                <div class="badge bg-primary mb-2 align-self-start"><?php echo get_the_category_list( ', ' ); ?></div>
                                <h2 class="card-title display-5 fw-bold"><a href="<?php the_permalink(); ?>" class="text-white text-decoration-none"><?php the_title(); ?></a></h2>
                                <p class="card-text d-none d-md-block lead"><?php echo wp_trim_words( get_the_excerpt(), 20 ); ?></p>
                                <div class="small text-white-50 mt-2">
                                    <span><?php echo get_the_date(); ?></span> &bull; <span><?php the_author(); ?></span>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php
                // Second and Third Posts (Small, Right Stack)
                else :
                    // Open Right Column Container on first "small" post (index 1)
                    if ( $i === 1 ) : ?>
                    <div class="col-lg-4">
                        <div class="d-flex flex-column h-100 gap-3">
                    <?php endif; ?>
                            <div class="card bg-dark text-white border-0 flex-fill position-relative overflow-hidden shadow-sm">
                                <?php if ( has_post_thumbnail() ) : ?>
                                    <div class="position-absolute w-100 h-100" style="background: url('<?php echo get_the_post_thumbnail_url( null, 'medium' ); ?>') center/cover;"></div>
                                    <div class="position-absolute w-100 h-100 bg-dark opacity-50"></div>
                                <?php endif; ?>
                                <div class="card-img-overlay d-flex flex-column justify-content-end p-3">
                                    <h5 class="card-title fw-bold"><a href="<?php the_permalink(); ?>" class="text-white text-decoration-none"><?php the_title(); ?></a></h5>
                                    <div class="small text-white-50">
                                        <span><?php echo get_the_date(); ?></span>
                                    </div>
                                </div>
                            </div>
                <?php endif;
                $i++;
            endwhile;

            // Close the Right Column div if we had more than 1 post
            if ( $featured_query->post_count > 1 ) {
                echo '</div></div>'; // Close flex-column and col-lg-4
            } else {
                // If only 1 post, we still need to close the loop logic correctly or handle layout
                // But the loop handles 1 post gracefully by skipping the else block
            }
            ?>
        </div>
    </div>
    <?php wp_reset_postdata(); ?>
<?php endif; ?>

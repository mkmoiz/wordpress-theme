<?php
$orig_post = $post;
$tags = wp_get_post_tags( $post->ID );

if ( $tags ) :
    $tag_ids = array();
    foreach ( $tags as $individual_tag ) {
        $tag_ids[] = $individual_tag->term_id;
    }
    $args = array(
        'tag__in' => $tag_ids,
        'post__not_in' => array( $post->ID ),
        'posts_per_page' => 3, // Number of related posts to display.
        'ignore_sticky_posts' => 1
    );

    $related_query = new WP_Query( $args );

    if ( $related_query->have_posts() ) : ?>
        <div class="related-posts mb-5">
            <h3 class="h4 mb-4 border-bottom pb-2"><?php _e( 'You Might Also Like', 'metaxchron' ); ?></h3>
            <div class="row row-cols-1 row-cols-md-3 g-4">
                <?php while ( $related_query->have_posts() ) : $related_query->the_post(); ?>
                    <div class="col">
                        <div class="card h-100 border-0 shadow-sm">
                            <?php if ( has_post_thumbnail() ) : ?>
                                <a href="<?php the_permalink(); ?>">
                                    <?php the_post_thumbnail( 'medium', array( 'class' => 'card-img-top', 'style' => 'height: 150px; object-fit: cover;' ) ); ?>
                                </a>
                            <?php endif; ?>
                            <div class="card-body p-3">
                                <h4 class="card-title h6 mb-2"><a href="<?php the_permalink(); ?>" class="text-decoration-none"><?php the_title(); ?></a></h4>
                                <div class="text-muted small"><?php echo get_the_date(); ?></div>
                            </div>
                        </div>
                    </div>
                <?php endwhile; ?>
            </div>
        </div>
    <?php endif;
    wp_reset_postdata();
endif;
$post = $orig_post;
?>

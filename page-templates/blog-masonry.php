<?php
/**
 * Template Name: Blog - Masonry Grid
 */
get_header(); ?>

<div class="container py-5">
    <header class="text-center mb-5">
        <h1 class="display-4 fw-bold"><?php the_title(); ?></h1>
        <?php if ( has_excerpt() ) : ?>
            <div class="lead text-muted mt-2"><?php echo get_the_excerpt(); ?></div>
        <?php endif; ?>
    </header>

    <div id="mxc-masonry-grid" class="row g-4" data-masonry='{"percentPosition": true }'>
        <?php
        $paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
        $args = array(
            'post_type' => 'post',
            'posts_per_page' => 9,
            'paged' => $paged
        );
        $masonry_query = new WP_Query( $args );

        if ( $masonry_query->have_posts() ) : while ( $masonry_query->have_posts() ) : $masonry_query->the_post(); ?>
            <div class="col-sm-6 col-lg-4 mb-4">
                <article <?php post_class( 'card shadow-sm border-0 h-100' ); ?>>
                    <?php if ( has_post_thumbnail() ) : ?>
                        <a href="<?php the_permalink(); ?>">
                            <?php the_post_thumbnail( 'medium_large', array( 'class' => 'card-img-top' ) ); ?>
                        </a>
                    <?php endif; ?>
                    <div class="card-body">
                        <div class="mb-2 text-muted small">
                            <?php echo get_the_date(); ?>
                        </div>
                        <h3 class="card-title h5"><a href="<?php the_permalink(); ?>" class="text-decoration-none"><?php the_title(); ?></a></h3>
                        <p class="card-text"><?php echo wp_trim_words( get_the_excerpt(), 20 ); ?></p>
                    </div>
                    <div class="card-footer bg-transparent border-0">
                        <a href="<?php the_permalink(); ?>" class="btn btn-sm btn-outline-primary rounded-pill">Read More</a>
                    </div>
                </article>
            </div>
        <?php endwhile; endif; wp_reset_postdata(); ?>
    </div>

    <div class="mt-5 text-center">
        <?php
        // Simple Pagination for custom query
        $big = 999999999;
        echo paginate_links( array(
            'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
            'format' => '?paged=%#%',
            'current' => max( 1, get_query_var('paged') ),
            'total' => $masonry_query->max_num_pages,
            'type' => 'list',
            'prev_text' => '&laquo;',
            'next_text' => '&raquo;'
        ) );
        ?>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/masonry-layout@4.2.2/dist/masonry.pkgd.min.js" integrity="sha384-GNFwBvfVxBkLMJpYMOABq3c+d3KnQxudP/mGPkzpZSTYykLBNsZEnG2D9G/X/+7D" crossorigin="anonymous" async></script>

<?php get_footer(); ?>

<?php get_header(); ?>

<div class="container py-5">
    <header class="mb-5 border-bottom pb-3">
        <h1 class="page-title">
            <?php
            /* translators: %s: search query. */
            printf( esc_html__( 'Search Results for: %s', 'metaxchron' ), '<span>' . get_search_query() . '</span>' );
            ?>
        </h1>
    </header>

    <div class="row">
        <div class="col-lg-8">
            <div class="row row-cols-1 row-cols-md-2 g-4">
                <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
                    <div class="col">
                <article <?php post_class( 'card h-100 shadow-sm' ); ?>>
                    <?php if ( has_post_thumbnail() ) : ?>
                        <a href="<?php the_permalink(); ?>">
                            <?php the_post_thumbnail( 'medium_large', array( 'class' => 'card-img-top', 'style' => 'height: 200px; object-fit: cover;' ) ); ?>
                        </a>
                    <?php endif; ?>
                    <div class="card-body">
                        <div class="mb-2 text-muted small">
                            <span class="me-2"><i class="far fa-calendar-alt"></i> <?php echo get_the_date(); ?></span>
                            <span><i class="far fa-folder"></i> <?php the_category( ', ' ); ?></span>
                        </div>
                        <h3 class="card-title h5"><a href="<?php the_permalink(); ?>" class="text-decoration-none"><?php the_title(); ?></a></h3>
                        <p class="card-text text-muted"><?php echo wp_trim_words( get_the_excerpt(), 15 ); ?></p>
                    </div>
                    <div class="card-footer border-0 bg-transparent">
                        <a href="<?php the_permalink(); ?>" class="btn btn-outline-primary btn-sm rounded-pill">Read More</a>
                    </div>
                </article>
            </div>
                <?php endwhile; else : ?>
                    <div class="col-12">
                        <div class="alert alert-info" role="alert">
                            <?php esc_html_e( 'Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'metaxchron' ); ?>
                        </div>
                        <?php get_search_form(); ?>
                    </div>
                <?php endif; ?>
            </div>

            <div class="mt-5">
                <?php
                the_posts_pagination( array(
                    'mid_size'  => 2,
                    'prev_text' => __( '&laquo; Previous', 'metaxchron' ),
                    'next_text' => __( 'Next &raquo;', 'metaxchron' ),
                    'class'     => 'pagination justify-content-center'
                ) );
                ?>
            </div>
        </div>

        <?php get_sidebar(); ?>
    </div>
</div>

<?php get_footer(); ?>

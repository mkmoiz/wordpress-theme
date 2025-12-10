<?php
/**
 * Template Name: Sidebar Left
 * Template Post Type: post, page
 */
get_header(); ?>

<div class="container py-5">
    <div class="row">
        <!-- Content First (DOM Order) - Pushed to Right (Visual) on Desktop -->
        <div class="col-lg-8 order-lg-2">
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
                    </header>

                    <section class="mb-5 content-body">
                        <?php the_content(); ?>
                    </section>

                    <?php get_template_part( 'template-parts/author-bio' ); ?>
                    <?php get_template_part( 'template-parts/related-posts' ); ?>

                    <?php if ( comments_open() || get_comments_number() ) : ?>
                        <div class="mt-5">
                            <?php comments_template(); ?>
                        </div>
                    <?php endif; ?>

                </article>
            <?php endwhile; endif; ?>
        </div>

        <!-- Sidebar Second (DOM Order) - Pulled to Left (Visual) on Desktop -->
        <div class="col-lg-4 order-lg-1 mt-5 mt-lg-0">
             <?php get_sidebar(); ?>
        </div>
    </div>
</div>

<?php get_footer(); ?>

<?php
/**
 * Template Name: Minimalist Text
 * Template Post Type: post
 */
get_header(); ?>

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-8 col-xl-7">
            <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
                <article <?php post_class(); ?>>

                    <header class="mb-5 text-center">
                        <div class="mb-3 text-muted text-uppercase small tracking-wide">
                            <?php the_category( ', ' ); ?>
                        </div>
                        <h1 class="display-4 fw-bold mb-4"><?php the_title(); ?></h1>
                        <div class="d-flex align-items-center justify-content-center">
                            <?php echo get_avatar( get_the_author_meta( 'ID' ), 40, '', '', array( 'class' => 'rounded-circle me-2' ) ); ?>
                            <div class="text-start">
                                <div class="fw-bold small"><?php the_author(); ?></div>
                                <div class="text-muted small"><?php echo get_the_date(); ?> &bull; <?php echo mxc_get_reading_time(); ?></div>
                            </div>
                        </div>
                    </header>

                    <div class="mb-5">
                        <hr class="w-25 mx-auto text-primary" style="height: 3px; opacity: 1;">
                    </div>

                    <section class="content-body lead" style="font-size: 1.25rem; line-height: 1.8;">
                        <?php the_content(); ?>
                    </section>

                    <div class="mt-5 pt-5 border-top">
                        <?php get_template_part( 'template-parts/author-bio' ); ?>
                    </div>

                    <?php if ( comments_open() || get_comments_number() ) : ?>
                        <div class="mt-5">
                            <?php comments_template(); ?>
                        </div>
                    <?php endif; ?>

                </article>
            <?php endwhile; endif; ?>
        </div>
    </div>
</div>

<?php get_footer(); ?>

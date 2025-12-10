<?php
/**
 * Template Name: Dual Column (Sticky)
 * Template Post Type: post
 */
get_header(); ?>

<div class="container py-5">
    <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
        <div class="row g-5">
            <!-- Left Column: Sticky Title & Meta -->
            <div class="col-lg-5">
                <div class="sticky-top" style="top: 100px; z-index: 1;">
                    <div class="mb-3 text-primary fw-bold text-uppercase small">
                        <?php the_category( ', ' ); ?>
                    </div>
                    <h1 class="display-4 fw-bold mb-4"><?php the_title(); ?></h1>

                    <div class="d-flex align-items-center mb-4">
                        <?php echo get_avatar( get_the_author_meta( 'ID' ), 50, '', '', array( 'class' => 'rounded-circle me-3' ) ); ?>
                        <div>
                            <div class="fw-bold"><?php the_author(); ?></div>
                            <div class="text-muted small">
                                <?php echo get_the_date(); ?> <br>
                                <?php echo mxc_get_reading_time(); ?> read
                            </div>
                        </div>
                    </div>

                    <?php if ( has_post_thumbnail() ) : ?>
                        <div class="mb-4 rounded overflow-hidden shadow-sm d-none d-lg-block">
                            <?php the_post_thumbnail( 'large', array( 'class' => 'img-fluid' ) ); ?>
                        </div>
                    <?php endif; ?>

                    <!-- Share Buttons -->
                    <div class="d-flex gap-2">
                        <a href="#" class="btn btn-outline-secondary btn-sm rounded-circle"><i class="fab fa-facebook-f"></i></a>
                        <a href="#" class="btn btn-outline-secondary btn-sm rounded-circle"><i class="fab fa-twitter"></i></a>
                        <a href="#" class="btn btn-outline-secondary btn-sm rounded-circle"><i class="fab fa-linkedin-in"></i></a>
                    </div>
                </div>
            </div>

            <!-- Right Column: Content -->
            <div class="col-lg-7">
                <!-- Mobile Image -->
                <?php if ( has_post_thumbnail() ) : ?>
                    <div class="mb-4 rounded overflow-hidden shadow-sm d-lg-none">
                        <?php the_post_thumbnail( 'large', array( 'class' => 'img-fluid' ) ); ?>
                    </div>
                <?php endif; ?>

                <div class="content-body">
                    <p class="lead fw-bold mb-4"><?php echo get_the_excerpt(); ?></p>
                    <?php the_content(); ?>
                </div>

                <div class="mt-5 pt-4 border-top">
                    <?php get_template_part( 'template-parts/related-posts' ); ?>
                    <?php if ( comments_open() || get_comments_number() ) : ?>
                        <div class="mt-4">
                            <?php comments_template(); ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    <?php endwhile; endif; ?>
</div>

<?php get_footer(); ?>

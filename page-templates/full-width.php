<?php
/**
 * Template Name: Full Width
 */

get_header(); ?>

<div class="container-fluid py-5 px-0">
    <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

        <?php if ( has_post_thumbnail() ) : ?>
            <div class="position-relative mb-5" style="height: 50vh; overflow: hidden;">
                <?php the_post_thumbnail( 'full', array( 'class' => 'w-100 h-100', 'style' => 'object-fit: cover;' ) ); ?>
                <div class="position-absolute top-50 start-50 translate-middle text-center text-white bg-dark bg-opacity-50 p-4 rounded">
                    <h1 class="display-3 fw-bold"><?php the_title(); ?></h1>
                </div>
            </div>
        <?php else: ?>
            <div class="container text-center mb-5">
                <h1 class="display-4 fw-bold"><?php the_title(); ?></h1>
            </div>
        <?php endif; ?>

        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="content-body">
                        <?php the_content(); ?>
                    </div>
                </div>
            </div>
        </div>

    <?php endwhile; endif; ?>
</div>

<?php get_footer(); ?>

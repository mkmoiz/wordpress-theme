<?php
/**
 * Template Name: Split Screen
 */
get_header();

// We need to override the header styles locally or ensure structure allows full width
// Assuming the header is normally static at top.
?>

<div class="container-fluid p-0">
    <div class="row g-0" style="min-height: calc(100vh - 70px);">
        <!-- Left Side: Image -->
        <div class="col-lg-6 d-none d-lg-block position-relative">
            <?php if ( has_post_thumbnail() ) : ?>
                <div class="position-absolute w-100 h-100" style="background: url('<?php echo get_the_post_thumbnail_url( null, 'full' ); ?>') center/cover no-repeat;"></div>
            <?php else : ?>
                <div class="position-absolute w-100 h-100 bg-secondary d-flex align-items-center justify-content-center">
                    <span class="text-white h3">No Image Set</span>
                </div>
            <?php endif; ?>
        </div>

        <!-- Right Side: Content -->
        <div class="col-lg-6">
            <div class="d-flex align-items-center min-vh-100 py-5">
                <div class="px-4 px-xl-5">
                    <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
                        <h1 class="display-4 fw-bold mb-4"><?php the_title(); ?></h1>
                        <div class="content-body lead">
                            <?php the_content(); ?>
                        </div>
                    <?php endwhile; endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>

<?php get_footer(); ?>

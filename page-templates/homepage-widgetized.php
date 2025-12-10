<?php
/**
 * Template Name: Widgetized Homepage
 * Template Post Type: page
 */
get_header(); ?>

<div id="homepage-builder" class="site-content">
    <?php if ( is_active_sidebar( 'homepage-widgets' ) ) : ?>
        <?php dynamic_sidebar( 'homepage-widgets' ); ?>
    <?php else : ?>
        <div class="container py-5 text-center">
            <h2><?php _e( 'Homepage Builder', 'metaxchron' ); ?></h2>
            <p class="lead"><?php _e( 'Please add widgets to the "Homepage Widgets" area in Appearance > Widgets.', 'metaxchron' ); ?></p>
        </div>
    <?php endif; ?>
</div>

<?php get_footer(); ?>

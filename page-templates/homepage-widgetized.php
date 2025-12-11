<?php
/**
 * Template Name: Homepage - Widgetized
 * Description: A flexible homepage layout that automatically displays block patterns if no content is provided.
 */
get_header(); ?>

<main id="primary" class="site-main">

    <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

        <?php if ( get_the_content() ) : ?>
            <div class="entry-content">
                <?php the_content(); ?>
            </div>
        <?php else : ?>
            <!-- Default Landing Layout if Content is Empty -->
            <div class="mxc-default-landing">

                <!-- Hero Section -->
                <?php
                $hero_pattern = get_user_option( 'mxc_hero_pattern' ) ?: '<!-- wp:pattern {"slug":"mxc/hero-futurism"} /-->';
                echo do_blocks( $hero_pattern );
                ?>

                <!-- Magazine Grid -->
                <div class="container py-5">
                    <?php echo do_blocks( '<!-- wp:pattern {"slug":"mxc/magazine-grid"} /-->' ); ?>
                </div>

                <!-- CTA Section -->
                <?php echo do_blocks( '<!-- wp:pattern {"slug":"mxc/cta-neon"} /-->' ); ?>

            </div>
        <?php endif; ?>

    <?php endwhile; endif; ?>

    <!-- Widget Area as Backup/Addon -->
    <?php if ( is_active_sidebar( 'homepage-widgets' ) ) : ?>
        <div class="container py-5">
            <?php dynamic_sidebar( 'homepage-widgets' ); ?>
        </div>
    <?php endif; ?>

</main>

<?php get_footer(); ?>

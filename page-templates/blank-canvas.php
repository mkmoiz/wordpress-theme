<?php
/**
 * Template Name: Blank Canvas
 */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php wp_head(); ?>
    <style>
        /* Minimal reset for blank canvas */
        body { background-color: #fff; color: #333; }
        body[data-theme="dark"] { background-color: #121212; color: #e0e0e0; }
    </style>
</head>
<body <?php body_class(); ?>>

<main id="blank-canvas-content">
    <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
        <?php the_content(); ?>
    <?php endwhile; endif; ?>
</main>

<?php wp_footer(); ?>
</body>
</html>

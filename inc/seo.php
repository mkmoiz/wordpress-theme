<?php
/**
 * SEO Enhancements
 *
 * Handles Open Graph, Twitter Cards, and other SEO meta tags.
 */

function mxc_seo_meta_tags() {
    // Basic setup
    global $post;

    // Default image
    $default_image = get_theme_mod( 'mxc_logo' );

    // Title
    if ( is_front_page() && is_home() ) {
        $title = get_bloginfo( 'name' ) . ' - ' . get_bloginfo( 'description' );
    } elseif ( is_singular() ) {
        $title = get_the_title() . ' - ' . get_bloginfo( 'name' );
    } else {
        $title = wp_get_document_title();
    }

    // URL
    $url = esc_url( home_url( add_query_arg( array(), $wp->request ) ) );
    if ( is_singular() ) {
        $url = get_permalink();
    }

    // Description
    $description = get_bloginfo( 'description' );
    if ( is_singular() ) {
        if ( has_excerpt() ) {
            $description = strip_tags( get_the_excerpt() );
        } else {
            // Get first 160 chars of content
            $content_text = wp_strip_all_tags( $post->post_content );
            $description = mb_substr( $content_text, 0, 160 ) . '...';
        }
    }

    // Image
    $image = $default_image;
    if ( is_singular() && has_post_thumbnail() ) {
        $image = get_the_post_thumbnail_url( null, 'large' );
    }

    // Output Meta Tags
    ?>
    <!-- SEO & Social Meta Tags -->
    <meta name="description" content="<?php echo esc_attr( $description ); ?>">

    <!-- Open Graph -->
    <meta property="og:type" content="<?php echo is_single() ? 'article' : 'website'; ?>">
    <meta property="og:title" content="<?php echo esc_attr( $title ); ?>">
    <meta property="og:description" content="<?php echo esc_attr( $description ); ?>">
    <meta property="og:url" content="<?php echo esc_attr( $url ); ?>">
    <meta property="og:site_name" content="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>">
    <?php if ( $image ) : ?>
    <meta property="og:image" content="<?php echo esc_url( $image ); ?>">
    <?php endif; ?>

    <!-- Twitter Card -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="<?php echo esc_attr( $title ); ?>">
    <meta name="twitter:description" content="<?php echo esc_attr( $description ); ?>">
    <?php if ( $image ) : ?>
    <meta name="twitter:image" content="<?php echo esc_url( $image ); ?>">
    <?php endif; ?>
    <?php
}
add_action( 'wp_head', 'mxc_seo_meta_tags', 1 );

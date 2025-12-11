<?php
/**
 * Gutenberg Editor Support
 */

function mxc_gutenberg_support() {
    // Add default block styles
    add_theme_support( 'wp-block-styles' );

    // Add support for editor styles
    add_theme_support( 'editor-styles' );

    // Enqueue editor styles
    add_editor_style( 'assets/css/editor-style.css' );

    // Add support for wide and full alignment
    add_theme_support( 'align-wide' );

    // Add support for responsive embeds
    add_theme_support( 'responsive-embeds' );

    // Add support for custom line height
    add_theme_support( 'custom-line-height' );

    // Add support for custom units
    add_theme_support( 'custom-spacing' );

    // Define custom color palette based on theme defaults
    // Note: Ideally, these should match Customizer settings dynamically if possible,
    // but PHP-in-CSS for editor styles is complex. Hardcoded defaults for now.
    add_theme_support( 'editor-color-palette', array(
        array(
            'name'  => __( 'Primary', 'metaxchron' ),
            'slug'  => 'primary',
            'color' => '#0d6efd',
        ),
        array(
            'name'  => __( 'Dark Background', 'metaxchron' ),
            'slug'  => 'dark',
            'color' => '#121212',
        ),
        array(
            'name'  => __( 'Light Background', 'metaxchron' ),
            'slug'  => 'light',
            'color' => '#f8f9fa',
        ),
        array(
            'name'  => __( 'White', 'metaxchron' ),
            'slug'  => 'white',
            'color' => '#ffffff',
        ),
    ) );
}
add_action( 'after_setup_theme', 'mxc_gutenberg_support' );

/**
 * Enqueue Block Editor Assets
 */
function mxc_block_editor_assets() {
    // Enqueue Google Fonts for the editor
    if ( function_exists( 'mxc_get_google_fonts_url' ) ) {
        $fonts_url = mxc_get_google_fonts_url();
        if ( $fonts_url ) {
            wp_enqueue_style( 'mxc-editor-fonts', $fonts_url, array(), null );
        }
    }
}
add_action( 'enqueue_block_editor_assets', 'mxc_block_editor_assets' );

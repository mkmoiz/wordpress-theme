<?php
/**
 * Typography Handling
 *
 * Enqueues Google Fonts based on Customizer settings.
 */

function mxc_enqueue_fonts() {
    $heading_font = get_theme_mod( 'mxc_font_heading_choice', 'inter' );
    $body_font    = get_theme_mod( 'mxc_font_body_choice', 'inter' );

    $fonts = array();

    // Map choices to Google Font names
    $font_map = array(
        'inter'         => 'Inter:wght@400;700',
        'poppins'       => 'Poppins:wght@400;700',
        'space_grotesk' => 'Space Grotesk:wght@400;700',
        'orbitron'      => 'Orbitron:wght@400;700', // Example if added later
    );

    if ( isset( $font_map[ $heading_font ] ) ) {
        $fonts[] = $font_map[ $heading_font ];
    }

    if ( isset( $font_map[ $body_font ] ) ) {
        $fonts[] = $font_map[ $body_font ];
    }

    // Remove duplicates
    $fonts = array_unique( $fonts );

    if ( ! empty( $fonts ) ) {
        $font_args = implode( '&family=', $fonts );
        $fonts_url = "https://fonts.googleapis.com/css2?family={$font_args}&display=swap";

        // Enqueue the font
        wp_enqueue_style( 'mxc-google-fonts', $fonts_url, array(), null );
    }
}
add_action( 'wp_enqueue_scripts', 'mxc_enqueue_fonts' );

/**
 * Add preconnect for Google Fonts.
 */
function mxc_preconnect_fonts() {
    echo '<link rel="preconnect" href="https://fonts.googleapis.com">' . "\n";
    echo '<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>' . "\n";
}
add_action( 'wp_head', 'mxc_preconnect_fonts', 5 );

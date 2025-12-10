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
        'orbitron'      => 'Orbitron:wght@400;700',
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

/**
 * Output Dynamic CSS for Fonts and Colors.
 * Hooked to wp_head to ensure it runs on all templates (even blank ones).
 */
function mxc_output_typography_css() {
    $heading_choice = get_theme_mod( 'mxc_font_heading_choice', 'inter' );
    $heading_custom = get_theme_mod( 'mxc_font_heading_custom', 'Inter' );
    $body_choice    = get_theme_mod( 'mxc_font_body_choice', 'inter' );
    $body_custom    = get_theme_mod( 'mxc_font_body_custom', 'Inter' );

    // Check if functions exist (in case this file is loaded differently, though unlikely)
    if ( function_exists( 'mxc_get_font_stack_from_choice' ) ) {
        $heading_stack  = mxc_get_font_stack_from_choice( $heading_choice, $heading_custom );
        $body_stack     = mxc_get_font_stack_from_choice( $body_choice, $body_custom );
    } else {
        $heading_stack = 'sans-serif';
        $body_stack = 'sans-serif';
    }

    ?>
    <style>
        :root {
            --mxc-primary-color: <?php echo get_theme_mod( 'mxc_primary_color', '#0d6efd' ); ?>;
            --mxc-bg-dark: <?php echo get_theme_mod( 'mxc_bg_color', '#121212' ); ?>;
            --mxc-bg-card: <?php echo get_theme_mod( 'mxc_card_bg_color', '#1e1e1e' ); ?>;
            --mxc-headings-color: <?php echo get_theme_mod( 'mxc_headings_color', '#ffffff' ); ?>;
            --mxc-body-color: <?php echo get_theme_mod( 'mxc_body_color', '#e0e0e0' ); ?>;
            --mxc-link-color: <?php echo get_theme_mod( 'mxc_link_color', '#0d6efd' ); ?>;
            --mxc-h1-size: <?php echo get_theme_mod( 'mxc_h1_size', '2.5' ); ?>rem;
            --mxc-font-heading: <?php echo esc_html( $heading_stack ); ?>;
            --mxc-font-body: <?php echo esc_html( $body_stack ); ?>;
            --mxc-container-width: <?php echo get_theme_mod( 'mxc_container_width', '1320' ); ?>px;
            --mxc-sidebar-width: <?php echo get_theme_mod( 'mxc_sidebar_width', '33' ); ?>%;
        }
        body {
            font-size: <?php echo get_theme_mod( 'mxc_body_font_size', '16' ); ?>px;
        }
        .bg-primary-custom {
            background-color: var(--mxc-primary-color) !important;
        }
        .text-primary-custom {
            color: var(--mxc-primary-color) !important;
        }
        .btn-primary-custom {
            background-color: var(--mxc-primary-color);
            border-color: var(--mxc-primary-color);
            color: #fff;
        }
        .btn-primary-custom:hover {
            background-color: #0b5ed7; /* Darker shade approximation */
            border-color: #0a58ca;
            color: #fff;
        }
    </style>
    <?php
}
add_action( 'wp_head', 'mxc_output_typography_css', 10 );

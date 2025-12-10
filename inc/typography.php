<?php
/**
 * Typography Handling
 *
 * Enqueues Google Fonts and generates dynamic CSS.
 */

/**
 * Get the Google Fonts URL based on theme mods.
 */
function mxc_get_google_fonts_url() {
    $heading_font = get_theme_mod( 'mxc_font_heading_choice', 'inter' );
    $body_font    = get_theme_mod( 'mxc_font_body_choice', 'inter' );

    $fonts = array();
    $display = 'swap';

    // Map internal IDs to Google Font Family names
    $font_library = array(
        'inter'         => 'Inter',
        'roboto'        => 'Roboto',
        'opensans'      => 'Open Sans',
        'montserrat'    => 'Montserrat',
        'poppins'       => 'Poppins',
        'lato'          => 'Lato',
        'oswald'        => 'Oswald',
        'raleway'       => 'Raleway',
        'playfair'      => 'Playfair Display',
        'merriweather'  => 'Merriweather',
        'lora'          => 'Lora',
        'ptserif'       => 'PT Serif',
        'orbitron'      => 'Orbitron',
        'spacegrotesk'  => 'Space Grotesk',
        'rajdhani'      => 'Rajdhani',
        'syne'          => 'Syne',
        'robotomono'    => 'Roboto Mono',
    );

    // Standard weights we want to load: 400 (Regular), 500 (Medium), 600 (SemiBold), 700 (Bold)
    // We can adjust this if specific fonts don't support all weights, but most premium ones do.
    $weights = ':wght@400;500;600;700';

    if ( isset( $font_library[ $heading_font ] ) ) {
        $fonts[] = urlencode( $font_library[ $heading_font ] ) . $weights;
    }

    if ( isset( $font_library[ $body_font ] ) ) {
        $fonts[] = urlencode( $font_library[ $body_font ] ) . $weights;
    }

    // Remove duplicates
    $fonts = array_unique( $fonts );

    if ( ! empty( $fonts ) ) {
        // Construct URL: family=FontA:wght@...&family=FontB:wght@...
        $font_args = implode( '&family=', $fonts );
        return "https://fonts.googleapis.com/css2?family={$font_args}&display={$display}";
    }

    return '';
}

/**
 * Enqueue the fonts.
 */
function mxc_enqueue_fonts() {
    $fonts_url = mxc_get_google_fonts_url();
    if ( $fonts_url ) {
        wp_enqueue_style( 'mxc-google-fonts', $fonts_url, array(), null );
    }
}
add_action( 'wp_enqueue_scripts', 'mxc_enqueue_fonts' );

/**
 * Add preconnect hints.
 */
function mxc_preconnect_fonts() {
    echo '<link rel="preconnect" href="https://fonts.googleapis.com">' . "\n";
    echo '<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>' . "\n";
}
add_action( 'wp_head', 'mxc_preconnect_fonts', 5 );

/**
 * Helper to get font stack string.
 */
function mxc_get_font_stack( $font_id ) {
    $stacks = array(
        'inter'         => "'Inter', sans-serif",
        'roboto'        => "'Roboto', sans-serif",
        'opensans'      => "'Open Sans', sans-serif",
        'montserrat'    => "'Montserrat', sans-serif",
        'poppins'       => "'Poppins', sans-serif",
        'lato'          => "'Lato', sans-serif",
        'oswald'        => "'Oswald', sans-serif",
        'raleway'       => "'Raleway', sans-serif",
        'playfair'      => "'Playfair Display', serif",
        'merriweather'  => "'Merriweather', serif",
        'lora'          => "'Lora', serif",
        'ptserif'       => "'PT Serif', serif",
        'orbitron'      => "'Orbitron', sans-serif",
        'spacegrotesk'  => "'Space Grotesk', sans-serif",
        'rajdhani'      => "'Rajdhani', sans-serif",
        'syne'          => "'Syne', sans-serif",
        'robotomono'    => "'Roboto Mono', monospace",
        'system'        => "system-ui, -apple-system, 'Segoe UI', sans-serif",
    );

    return isset( $stacks[ $font_id ] ) ? $stacks[ $font_id ] : $stacks['system'];
}

/**
 * Output Dynamic CSS.
 */
function mxc_output_typography_css() {
    $heading_choice = get_theme_mod( 'mxc_font_heading_choice', 'inter' );
    $heading_custom = get_theme_mod( 'mxc_font_heading_custom', 'Inter' );
    $body_choice    = get_theme_mod( 'mxc_font_body_choice', 'inter' );
    $body_custom    = get_theme_mod( 'mxc_font_body_custom', 'Inter' );

    // Resolve stacks
    $heading_stack = ( $heading_choice === 'custom' ) ? $heading_custom : mxc_get_font_stack( $heading_choice );
    $body_stack    = ( $body_choice === 'custom' )    ? $body_custom    : mxc_get_font_stack( $body_choice );

    // Line Heights & Spacing
    $lh_body    = get_theme_mod( 'mxc_line_height_body', '1.6' );
    $lh_heading = get_theme_mod( 'mxc_line_height_heading', '1.2' );
    $ls_heading = get_theme_mod( 'mxc_letter_spacing_heading', '0' );

    // Colors
    $primary    = get_theme_mod( 'mxc_primary_color', '#0d6efd' );
    $bg_dark    = get_theme_mod( 'mxc_bg_color', '#121212' );
    $bg_card    = get_theme_mod( 'mxc_card_bg_color', '#1e1e1e' );
    $color_head = get_theme_mod( 'mxc_headings_color', '#ffffff' );
    $color_body = get_theme_mod( 'mxc_body_color', '#e0e0e0' );
    $color_link = get_theme_mod( 'mxc_link_color', '#0d6efd' );

    // Dimensions
    $h1_size    = get_theme_mod( 'mxc_h1_size', '2.5' );
    $font_size  = get_theme_mod( 'mxc_body_font_size', '16' );
    $container  = get_theme_mod( 'mxc_container_width', '1320' );
    $sidebar    = get_theme_mod( 'mxc_sidebar_width', '33' );

    ?>
    <style id="mxc-typography-css">
        :root {
            /* Colors */
            --mxc-primary-color: <?php echo esc_attr( $primary ); ?>;
            --mxc-bg-dark: <?php echo esc_attr( $bg_dark ); ?>;
            --mxc-bg-card: <?php echo esc_attr( $bg_card ); ?>;
            --mxc-headings-color: <?php echo esc_attr( $color_head ); ?>;
            --mxc-body-color: <?php echo esc_attr( $color_body ); ?>;
            --mxc-link-color: <?php echo esc_attr( $color_link ); ?>;

            /* Typography Family */
            --mxc-font-heading: <?php echo $heading_stack; ?>; /* Safe CSS string */
            --mxc-font-body: <?php echo $body_stack; ?>;

            /* Typography Settings */
            --mxc-h1-size: <?php echo esc_attr( $h1_size ); ?>rem;
            --mxc-body-size: <?php echo esc_attr( $font_size ); ?>px;
            --mxc-lh-body: <?php echo esc_attr( $lh_body ); ?>;
            --mxc-lh-heading: <?php echo esc_attr( $lh_heading ); ?>;
            --mxc-ls-heading: <?php echo esc_attr( $ls_heading ); ?>em;

            /* Layout */
            --mxc-container-width: <?php echo esc_attr( $container ); ?>px;
            --mxc-sidebar-width: <?php echo esc_attr( $sidebar ); ?>%;
        }

        body {
            font-family: var(--mxc-font-body);
            font-size: var(--mxc-body-size);
            line-height: var(--mxc-lh-body);
            color: var(--mxc-body-color);
        }

        h1, h2, h3, h4, h5, h6, .navbar-brand, .display-1, .display-2, .display-3, .display-4, .widget-title {
            font-family: var(--mxc-font-heading);
            color: var(--mxc-headings-color);
            line-height: var(--mxc-lh-heading);
            letter-spacing: var(--mxc-ls-heading);
        }

        .bg-primary-custom { background-color: var(--mxc-primary-color) !important; }
        .text-primary-custom { color: var(--mxc-primary-color) !important; }
        .btn-primary-custom { background-color: var(--mxc-primary-color); border-color: var(--mxc-primary-color); color: #fff; }
    </style>
    <?php
}
add_action( 'wp_head', 'mxc_output_typography_css', 10 );

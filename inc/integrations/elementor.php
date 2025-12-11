<?php
/**
 * Elementor Integration
 */

function mxc_elementor_support() {
    // Add theme colors to Elementor global colors (if API allows, otherwise just CSS override)
    // This is a basic integration to ensure Elementor uses theme variables where possible.
    ?>
    <style>
        :root {
            --e-global-color-primary: var(--mxc-primary-color);
            --e-global-color-secondary: var(--mxc-headings-color);
            --e-global-color-text: var(--mxc-text-main);
            --e-global-color-accent: var(--mxc-primary-color);
        }
    </style>
    <?php
}
add_action( 'wp_head', 'mxc_elementor_support' );

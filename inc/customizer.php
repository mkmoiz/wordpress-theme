<?php
/**
 * Theme Customizer
 */

function mxc_customize_register( $wp_customize ) {
    // 1. Logo Upload
    $wp_customize->add_section( 'mxc_logo_section' , array(
        'title'      => __( 'Logo', 'metaxchron' ),
        'priority'   => 30,
    ) );

    $wp_customize->add_setting( 'mxc_logo' );

    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'mxc_logo', array(
        'label'    => __( 'Upload Logo', 'metaxchron' ),
        'section'  => 'mxc_logo_section',
        'settings' => 'mxc_logo',
    ) ) );

    // 2. Primary Theme Color
    $wp_customize->add_section( 'mxc_colors_section' , array(
        'title'      => __( 'Theme Colors', 'metaxchron' ),
        'priority'   => 30,
    ) );

    $wp_customize->add_setting( 'mxc_primary_color' , array(
        'default'           => '#0d6efd',
        'transport'         => 'refresh',
        'sanitize_callback' => 'sanitize_hex_color',
    ) );

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'mxc_primary_color', array(
        'label'      => __( 'Primary Color', 'metaxchron' ),
        'section'    => 'mxc_colors_section',
        'settings'   => 'mxc_primary_color',
    ) ) );

    // 3. Footer Copyright Text
    $wp_customize->add_section( 'mxc_footer_section' , array(
        'title'      => __( 'Footer Settings', 'metaxchron' ),
        'priority'   => 120,
    ) );

    $wp_customize->add_setting( 'mxc_footer_text', array(
        'default'           => '© 2023 MetaXChron. All rights reserved.',
        'sanitize_callback' => 'sanitize_text_field',
    ) );

    $wp_customize->add_control( 'mxc_footer_text', array(
        'label'    => __( 'Copyright Text', 'metaxchron' ),
        'section'  => 'mxc_footer_section',
        'type'     => 'text',
    ) );

    // Footer Background Color
    $wp_customize->add_setting( 'mxc_footer_bg_color', array(
        'default'           => '#000000',
        'sanitize_callback' => 'sanitize_hex_color',
        'transport'         => 'refresh',
    ) );
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'mxc_footer_bg_color', array(
        'label'      => __( 'Footer Background', 'metaxchron' ),
        'section'    => 'mxc_footer_section',
    ) ) );

    // Footer Columns Layout
    $wp_customize->add_setting( 'mxc_footer_columns', array(
        'default'           => 2,
        'sanitize_callback' => 'absint',
    ) );
    $wp_customize->add_control( 'mxc_footer_columns', array(
        'label'    => __( 'Footer Columns', 'metaxchron' ),
        'section'  => 'mxc_footer_section',
        'type'     => 'select',
        'choices'  => array(
            1 => __( '1 Column', 'metaxchron' ),
            2 => __( '2 Columns', 'metaxchron' ),
            3 => __( '3 Columns', 'metaxchron' ),
            4 => __( '4 Columns', 'metaxchron' ),
        ),
    ) );

    // Show Footer Social Icons
    $wp_customize->add_setting( 'mxc_show_footer_social', array(
        'default'           => true,
        'sanitize_callback' => 'mxc_sanitize_checkbox',
    ) );
    $wp_customize->add_control( 'mxc_show_footer_social', array(
        'label'    => __( 'Show Social Icons', 'metaxchron' ),
        'section'  => 'mxc_footer_section',
        'type'     => 'checkbox',
    ) );

    // Social URLs
    $wp_customize->add_setting( 'mxc_social_facebook', array( 'default' => '', 'sanitize_callback' => 'esc_url_raw' ) );
    $wp_customize->add_control( 'mxc_social_facebook', array( 'label' => 'Facebook URL', 'section' => 'mxc_footer_section', 'type' => 'url' ) );

    $wp_customize->add_setting( 'mxc_social_twitter', array( 'default' => '', 'sanitize_callback' => 'esc_url_raw' ) );
    $wp_customize->add_control( 'mxc_social_twitter', array( 'label' => 'Twitter/X URL', 'section' => 'mxc_footer_section', 'type' => 'url' ) );

    $wp_customize->add_setting( 'mxc_social_instagram', array( 'default' => '', 'sanitize_callback' => 'esc_url_raw' ) );
    $wp_customize->add_control( 'mxc_social_instagram', array( 'label' => 'Instagram URL', 'section' => 'mxc_footer_section', 'type' => 'url' ) );


    // 4. Extended Appearance Controls
    // 4. Global Design (Unified Appearance)
    $wp_customize->add_panel( 'mxc_global_design_panel', array(
        'title'      => __( 'Global Colors & Typography', 'metaxchron' ),
        'priority'   => 40,
    ) );

    // SECTION: Typography
    $wp_customize->add_section( 'mxc_typography_section', array(
        'title'      => __( 'Typography', 'metaxchron' ),
        'panel'      => 'mxc_global_design_panel',
    ) );

    // Heading Font Choice
    $wp_customize->add_setting( 'mxc_font_heading_choice', array(
        'default'           => 'inter',
        'sanitize_callback' => 'mxc_sanitize_select',
    ) );
    $wp_customize->add_control( 'mxc_font_heading_choice', array(
        'label'    => __( 'Heading Font Family', 'metaxchron' ),
        'section'  => 'mxc_typography_section',
        'type'     => 'select',
        'choices'  => array(
            'inter'         => __( 'Inter (modern)', 'metaxchron' ),
            'poppins'       => __( 'Poppins (rounded)', 'metaxchron' ),
            'space_grotesk' => __( 'Space Grotesk (tech)', 'metaxchron' ),
            'orbitron'      => __( 'Orbitron (futuristic)', 'metaxchron' ),
            'serif'         => __( 'Classic Serif', 'metaxchron' ),
            'mono'          => __( 'Monospace', 'metaxchron' ),
            'system'        => __( 'System Default', 'metaxchron' ),
            'custom'        => __( 'Custom (enter below)', 'metaxchron' ),
        ),
    ) );

    // Body Font Choice
    $wp_customize->add_setting( 'mxc_font_body_choice', array(
        'default'           => 'inter',
        'sanitize_callback' => 'mxc_sanitize_select',
    ) );
    $wp_customize->add_control( 'mxc_font_body_choice', array(
        'label'    => __( 'Body Font Family', 'metaxchron' ),
        'section'  => 'mxc_typography_section',
        'type'     => 'select',
        'choices'  => array(
            'inter'         => __( 'Inter (modern)', 'metaxchron' ),
            'poppins'       => __( 'Poppins (rounded)', 'metaxchron' ),
            'space_grotesk' => __( 'Space Grotesk (tech)', 'metaxchron' ),
            'serif'         => __( 'Classic Serif', 'metaxchron' ),
            'mono'          => __( 'Monospace', 'metaxchron' ),
            'system'        => __( 'System Default', 'metaxchron' ),
            'custom'        => __( 'Custom (enter below)', 'metaxchron' ),
        ),
    ) );

    // Custom Heading Font
    $wp_customize->add_setting( 'mxc_font_heading_custom', array(
        'default'           => 'Orbitron',
        'sanitize_callback' => 'sanitize_text_field',
    ) );
    $wp_customize->add_control( 'mxc_font_heading_custom', array(
        'label'       => __( 'Custom Heading Font Stack', 'metaxchron' ),
        'section'     => 'mxc_typography_section',
        'type'        => 'text',
        'description' => __( 'Used only when Heading Font Family is set to Custom. Provide a CSS font stack.', 'metaxchron' ),
    ) );

    // Custom Body Font
    $wp_customize->add_setting( 'mxc_font_body_custom', array(
        'default'           => 'Poppins',
        'sanitize_callback' => 'sanitize_text_field',
    ) );
    $wp_customize->add_control( 'mxc_font_body_custom', array(
        'label'       => __( 'Custom Body Font Stack', 'metaxchron' ),
        'section'     => 'mxc_typography_section',
        'type'        => 'text',
        'description' => __( 'Used only when Body Font Family is set to Custom. Provide a CSS font stack.', 'metaxchron' ),
    ) );

    // Body Font Size
    $wp_customize->add_setting( 'mxc_body_font_size', array(
        'default'           => '16',
        'sanitize_callback' => 'absint',
        'transport'         => 'refresh',
    ) );
    $wp_customize->add_control( 'mxc_body_font_size', array(
        'label'       => __( 'Body Font Size (px)', 'metaxchron' ),
        'section'     => 'mxc_typography_section',
        'type'        => 'number',
        'input_attrs' => array( 'min' => 12, 'max' => 24, 'step' => 1 ),
    ) );

    // Headings Size Scale (Simulated)
    $wp_customize->add_setting( 'mxc_h1_size', array( 'default' => '2.5', 'sanitize_callback' => 'sanitize_text_field' ) );
    $wp_customize->add_control( 'mxc_h1_size', array(
        'label' => __( 'H1 Size (rem)', 'metaxchron' ),
        'section' => 'mxc_typography_section',
        'type' => 'number', 'input_attrs' => array( 'step' => 0.1 )
    ));

    // SECTION: Colors
    $wp_customize->add_section( 'mxc_colors_global_section', array(
        'title'      => __( 'Global Colors', 'metaxchron' ),
        'panel'      => 'mxc_global_design_panel',
    ) );

    // Headings Color
    $wp_customize->add_setting( 'mxc_headings_color', array( 'default' => '#ffffff', 'sanitize_callback' => 'sanitize_hex_color' ) );
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'mxc_headings_color', array(
        'label'      => __( 'Headings Color', 'metaxchron' ),
        'section'    => 'mxc_colors_global_section',
    ) ) );

    // Body Text Color
    $wp_customize->add_setting( 'mxc_body_color', array( 'default' => '#e0e0e0', 'sanitize_callback' => 'sanitize_hex_color' ) );
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'mxc_body_color', array(
        'label'      => __( 'Body Text Color', 'metaxchron' ),
        'section'    => 'mxc_colors_global_section',
    ) ) );

    // Link Color
    $wp_customize->add_setting( 'mxc_link_color', array( 'default' => '#0d6efd', 'sanitize_callback' => 'sanitize_hex_color' ) );
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'mxc_link_color', array(
        'label'      => __( 'Link Color', 'metaxchron' ),
        'section'    => 'mxc_colors_global_section',
    ) ) );

    // Background Color (Light Mode / Override)
    $wp_customize->add_setting( 'mxc_bg_color', array(
        'default'           => '#121212',
        'sanitize_callback' => 'sanitize_hex_color',
        'transport'         => 'refresh',
    ) );
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'mxc_bg_color', array(
        'label'      => __( 'Background Color (Dark Mode Base)', 'metaxchron' ),
        'section'    => 'mxc_appearance_section',
    ) ) );

    // Card Background Color
    $wp_customize->add_setting( 'mxc_card_bg_color', array(
        'default'           => '#1e1e1e',
        'sanitize_callback' => 'sanitize_hex_color',
        'transport'         => 'refresh',
    ) );
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'mxc_card_bg_color', array(
        'label'      => __( 'Card Background Color', 'metaxchron' ),
        'section'    => 'mxc_appearance_section',
    ) ) );

    // 5. Homepage Settings
    $wp_customize->add_section( 'mxc_homepage_section', array(
        'title'      => __( 'Homepage Settings', 'metaxchron' ),
        'priority'   => 50,
    ) );

    // Show Slider
    $wp_customize->add_setting( 'mxc_show_slider', array(
        'default'           => true,
        'sanitize_callback' => 'mxc_sanitize_checkbox',
    ) );
    $wp_customize->add_control( 'mxc_show_slider', array(
        'label'    => __( 'Show Featured Section', 'metaxchron' ),
        'section'  => 'mxc_homepage_section',
        'type'     => 'checkbox',
    ) );

    // Featured Layout Style (Slider vs Magazine)
    $wp_customize->add_setting( 'mxc_featured_style', array(
        'default'           => 'slider',
        'sanitize_callback' => 'mxc_sanitize_select',
    ) );
    $wp_customize->add_control( 'mxc_featured_style', array(
        'label'    => __( 'Featured Section Style', 'metaxchron' ),
        'section'  => 'mxc_homepage_section',
        'type'     => 'select',
        'choices'  => array(
            'slider'   => __( 'Carousel Slider', 'metaxchron' ),
            'magazine' => __( 'Magazine Grid', 'metaxchron' ),
        ),
    ) );

    // Slider Width
    $wp_customize->add_setting( 'mxc_slider_width', array(
        'default'           => 'container',
        'sanitize_callback' => 'mxc_sanitize_select',
    ) );
    $wp_customize->add_control( 'mxc_slider_width', array(
        'label'    => __( 'Slider Width', 'metaxchron' ),
        'section'  => 'mxc_homepage_section',
        'type'     => 'select',
        'choices'  => array(
            'container'       => __( 'Contained', 'metaxchron' ),
            'container-fluid' => __( 'Full Width', 'metaxchron' ),
        ),
    ) );

    // Home Layout (Grid vs List)
    $wp_customize->add_setting( 'mxc_home_layout', array(
        'default'           => 'grid',
        'sanitize_callback' => 'mxc_sanitize_select',
    ) );
    $wp_customize->add_control( 'mxc_home_layout', array(
        'label'    => __( 'Post Layout', 'metaxchron' ),
        'section'  => 'mxc_homepage_section',
        'type'     => 'select',
        'choices'  => array(
            'grid' => __( 'Grid (2 Columns)', 'metaxchron' ),
            'list' => __( 'List (1 Column)', 'metaxchron' ),
        ),
    ) );

    // Home Title
    $wp_customize->add_setting( 'mxc_home_title', array(
        'default'           => __( 'Latest Posts', 'metaxchron' ),
        'sanitize_callback' => 'sanitize_text_field',
    ) );
    $wp_customize->add_control( 'mxc_home_title', array(
        'label'    => __( 'Homepage Heading', 'metaxchron' ),
        'section'  => 'mxc_homepage_section',
        'type'     => 'text',
    ) );

    // 6. Blog Pro (Astra-like Structure)
    $wp_customize->add_section( 'mxc_blog_pro_section', array(
        'title'      => __( 'Blog / Archive Layout', 'metaxchron' ),
        'priority'   => 55,
    ) );

    // Container Style
    $wp_customize->add_setting( 'mxc_container_style', array(
        'default'           => 'boxed',
        'sanitize_callback' => 'mxc_sanitize_select',
    ) );
    $wp_customize->add_control( 'mxc_container_style', array(
        'label'    => __( 'Container Style', 'metaxchron' ),
        'section'  => 'mxc_blog_pro_section',
        'type'     => 'select',
        'choices'  => array(
            'boxed'   => __( 'Boxed (Card & Shadow)', 'metaxchron' ),
            'unboxed' => __( 'Unboxed (Flat & Clean)', 'metaxchron' ),
        ),
    ) );

    // Toggle Elements
    $elements = array(
        'mxc_show_feat_img' => __( 'Featured Image', 'metaxchron' ),
        'mxc_show_title'    => __( 'Post Title', 'metaxchron' ),
        'mxc_show_meta'     => __( 'Meta Info', 'metaxchron' ),
        'mxc_show_excerpt'  => __( 'Excerpt', 'metaxchron' ),
        'mxc_show_readmore' => __( 'Read More Button', 'metaxchron' ),
    );

    foreach ( $elements as $id => $label ) {
        $wp_customize->add_setting( $id, array(
            'default'           => true,
            'sanitize_callback' => 'mxc_sanitize_checkbox',
        ) );
        $wp_customize->add_control( $id, array(
            'label'    => $label,
            'section'  => 'mxc_blog_pro_section',
            'type'     => 'checkbox',
        ) );
    }

    // Toggle Meta Elements
    $wp_customize->add_setting( 'mxc_meta_header', array( 'sanitize_callback' => 'sanitize_text_field' ) ); // Dummy setting for label
    $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'mxc_meta_header', array(
        'label'    => __( 'Meta Data to Display:', 'metaxchron' ),
        'section'  => 'mxc_blog_pro_section',
        'type'     => 'hidden', // Just using description via next controls
        'settings' => 'mxc_meta_header',
    ) ) );

    $meta_elements = array(
        'mxc_meta_date'     => __( 'Publish Date', 'metaxchron' ),
        'mxc_meta_author'   => __( 'Author Name', 'metaxchron' ),
        'mxc_meta_category' => __( 'Category', 'metaxchron' ),
        'mxc_meta_readtime' => __( 'Reading Time', 'metaxchron' ),
    );

    foreach ( $meta_elements as $id => $label ) {
        $wp_customize->add_setting( $id, array(
            'default'           => true,
            'sanitize_callback' => 'mxc_sanitize_checkbox',
        ) );
        $wp_customize->add_control( $id, array(
            'label'    => $label,
            'section'  => 'mxc_blog_pro_section',
            'type'     => 'checkbox',
        ) );
    }

    // 7. Ad Management
    $wp_customize->add_section( 'mxc_ads_section', array(
        'title'      => __( 'Ad Management', 'metaxchron' ),
        'priority'   => 60,
    ) );

    // Container Max Width
    $wp_customize->add_setting( 'mxc_container_width', array(
        'default'           => '1320',
        'sanitize_callback' => 'absint',
    ) );
    $wp_customize->add_control( 'mxc_container_width', array(
        'label'       => __( 'Container Max Width (px)', 'metaxchron' ),
        'section'     => 'mxc_appearance_section',
        'type'        => 'number',
        'input_attrs' => array( 'min' => 800, 'max' => 1920, 'step' => 10 ),
    ) );

    // Sidebar Width
    $wp_customize->add_setting( 'mxc_sidebar_width', array(
        'default'           => '33',
        'sanitize_callback' => 'absint',
    ) );
    $wp_customize->add_control( 'mxc_sidebar_width', array(
        'label'       => __( 'Sidebar Width (%)', 'metaxchron' ),
        'section'     => 'mxc_appearance_section',
        'type'        => 'range',
        'input_attrs' => array( 'min' => 20, 'max' => 50, 'step' => 1 ),
    ) );

    // Header Ad
    $wp_customize->add_setting( 'mxc_ad_header', array( 'default' => '', 'sanitize_callback' => 'mxc_sanitize_ad_code' ) );
    $wp_customize->add_control( 'mxc_ad_header', array(
        'label'    => __( 'Header Ad Code', 'metaxchron' ),
        'section'  => 'mxc_ads_section',
        'type'     => 'textarea',
        'description' => __( 'Display at the very top of the site.', 'metaxchron' ),
    ) );

    // Before Content Ad
    $wp_customize->add_setting( 'mxc_ad_before_content', array( 'default' => '', 'sanitize_callback' => 'mxc_sanitize_ad_code' ) );
    $wp_customize->add_control( 'mxc_ad_before_content', array(
        'label'    => __( 'Before Post Content Ad', 'metaxchron' ),
        'section'  => 'mxc_ads_section',
        'type'     => 'textarea',
    ) );

    // After Content Ad
    $wp_customize->add_setting( 'mxc_ad_after_content', array( 'default' => '', 'sanitize_callback' => 'mxc_sanitize_ad_code' ) );
    $wp_customize->add_control( 'mxc_ad_after_content', array(
        'label'    => __( 'After Post Content Ad', 'metaxchron' ),
        'section'  => 'mxc_ads_section',
        'type'     => 'textarea',
    ) );
}
add_action( 'customize_register', 'mxc_customize_register' );

/**
 * Sanitization Callbacks
 */
function mxc_sanitize_checkbox( $checked ) {
    return ( ( isset( $checked ) && true == $checked ) ? true : false );
}

function mxc_sanitize_select( $input, $setting ) {
    $input = sanitize_key( $input );
    $choices = $setting->manager->get_control( $setting->id )->choices;
    return ( array_key_exists( $input, $choices ) ? $input : $setting->default );
}

function mxc_sanitize_ad_code( $input ) {
    // Only allow users with unfiltered_html cap (Admins) to save raw HTML/JS
    if ( current_user_can( 'unfiltered_html' ) ) {
        return $input;
    }
    return wp_kses_post( $input );
}

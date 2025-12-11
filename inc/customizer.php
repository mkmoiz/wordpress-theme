<?php
/**
 * Theme Customizer
 */

function mxc_customize_register( $wp_customize ) {
    /**
     * Define the Font Library
     */
    $google_fonts = array(
        // Sans-Serif
        'inter'         => __( 'Inter (Modern Sans)', 'metaxchron' ),
        'roboto'        => __( 'Roboto (Geometric Sans)', 'metaxchron' ),
        'opensans'      => __( 'Open Sans (Neutral Sans)', 'metaxchron' ),
        'montserrat'    => __( 'Montserrat (Geometric Sans)', 'metaxchron' ),
        'poppins'       => __( 'Poppins (Rounded Sans)', 'metaxchron' ),
        'lato'          => __( 'Lato (Friendly Sans)', 'metaxchron' ),
        'oswald'        => __( 'Oswald (Condensed Sans)', 'metaxchron' ),
        'raleway'       => __( 'Raleway (Elegant Sans)', 'metaxchron' ),

        // Serif
        'playfair'      => __( 'Playfair Display (Elegant Serif)', 'metaxchron' ),
        'merriweather'  => __( 'Merriweather (Readability Serif)', 'metaxchron' ),
        'lora'          => __( 'Lora (Contemporary Serif)', 'metaxchron' ),
        'ptserif'       => __( 'PT Serif (Humanist Serif)', 'metaxchron' ),

        // Display / Tech
        'orbitron'      => __( 'Orbitron (Sci-Fi)', 'metaxchron' ),
        'spacegrotesk'  => __( 'Space Grotesk (Tech)', 'metaxchron' ),
        'rajdhani'      => __( 'Rajdhani (Squared)', 'metaxchron' ),
        'syne'          => __( 'Syne (Artistic)', 'metaxchron' ),

        // Mono
        'robotomono'    => __( 'Roboto Mono (Code)', 'metaxchron' ),

        // System
        'system'        => __( 'System Default', 'metaxchron' ),
    );

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

    // Retina Logo
    $wp_customize->add_setting( 'mxc_logo_retina' );
    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'mxc_logo_retina', array(
        'label'       => __( 'Retina Logo (2x)', 'metaxchron' ),
        'description' => __( 'Upload an image twice the size of the main logo for high-density screens.', 'metaxchron' ),
        'section'     => 'mxc_logo_section',
        'settings'    => 'mxc_logo_retina',
    ) ) );

    // Mobile Logo
    $wp_customize->add_setting( 'mxc_logo_mobile' );
    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'mxc_logo_mobile', array(
        'label'       => __( 'Mobile Logo', 'metaxchron' ),
        'description' => __( 'Optional alternative logo for smaller screens.', 'metaxchron' ),
        'section'     => 'mxc_logo_section',
        'settings'    => 'mxc_logo_mobile',
    ) ) );

    // Logo Width
    $wp_customize->add_setting( 'mxc_logo_width', array( 'default' => '200', 'sanitize_callback' => 'absint' ) );
    $wp_customize->add_control( 'mxc_logo_width', array(
        'label'       => __( 'Logo Width (px)', 'metaxchron' ),
        'section'     => 'mxc_logo_section',
        'type'        => 'range',
        'input_attrs' => array( 'min' => 50, 'max' => 500, 'step' => 5 ),
    ) );

    // Header Layout
    $wp_customize->add_setting( 'mxc_header_layout', array(
        'default'           => 'default',
        'sanitize_callback' => 'mxc_sanitize_select',
    ) );
    $wp_customize->add_control( 'mxc_header_layout', array(
        'label'    => __( 'Header Layout Style', 'metaxchron' ),
        'section'  => 'mxc_logo_section',
        'type'     => 'select',
        'choices'  => array(
            'default'  => __( 'Default (Logo Left, Nav Right)', 'metaxchron' ),
            'centered' => __( 'Centered (Logo Top, Nav Bottom)', 'metaxchron' ),
            'minimal'  => __( 'Minimal (Hamburger Menu)', 'metaxchron' ),
        ),
    ) );

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

    // 3. Footer Settings
    $wp_customize->add_section( 'mxc_footer_section' , array(
        'title'      => __( 'Footer Settings', 'metaxchron' ),
        'priority'   => 120,
    ) );

    $wp_customize->add_setting( 'mxc_footer_text', array( 'default' => '© 2023 MetaXChron.', 'sanitize_callback' => 'sanitize_text_field' ) );
    $wp_customize->add_control( 'mxc_footer_text', array( 'label' => __( 'Copyright Text', 'metaxchron' ), 'section' => 'mxc_footer_section', 'type' => 'text' ) );

    $wp_customize->add_setting( 'mxc_footer_bg_color', array( 'default' => '#000000', 'sanitize_callback' => 'sanitize_hex_color', 'transport' => 'refresh' ) );
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'mxc_footer_bg_color', array( 'label' => __( 'Footer Background', 'metaxchron' ), 'section' => 'mxc_footer_section' ) ) );

    $wp_customize->add_setting( 'mxc_footer_columns', array( 'default' => 2, 'sanitize_callback' => 'absint' ) );
    $wp_customize->add_control( 'mxc_footer_columns', array(
        'label' => __( 'Footer Columns', 'metaxchron' ), 'section' => 'mxc_footer_section', 'type' => 'select',
        'choices' => array( 1 => '1 Column', 2 => '2 Columns', 3 => '3 Columns', 4 => '4 Columns' )
    ) );

    $wp_customize->add_setting( 'mxc_show_footer_social', array( 'default' => true, 'sanitize_callback' => 'mxc_sanitize_checkbox' ) );
    $wp_customize->add_control( 'mxc_show_footer_social', array( 'label' => __( 'Show Social Icons', 'metaxchron' ), 'section' => 'mxc_footer_section', 'type' => 'checkbox' ) );

    $wp_customize->add_setting( 'mxc_social_facebook', array( 'default' => '', 'sanitize_callback' => 'esc_url_raw' ) );
    $wp_customize->add_control( 'mxc_social_facebook', array( 'label' => 'Facebook URL', 'section' => 'mxc_footer_section', 'type' => 'url' ) );

    $wp_customize->add_setting( 'mxc_social_twitter', array( 'default' => '', 'sanitize_callback' => 'esc_url_raw' ) );
    $wp_customize->add_control( 'mxc_social_twitter', array( 'label' => 'Twitter/X URL', 'section' => 'mxc_footer_section', 'type' => 'url' ) );

    $wp_customize->add_setting( 'mxc_social_instagram', array( 'default' => '', 'sanitize_callback' => 'esc_url_raw' ) );
    $wp_customize->add_control( 'mxc_social_instagram', array( 'label' => 'Instagram URL', 'section' => 'mxc_footer_section', 'type' => 'url' ) );

    $wp_customize->add_setting( 'mxc_social_linkedin', array( 'default' => '', 'sanitize_callback' => 'esc_url_raw' ) );
    $wp_customize->add_control( 'mxc_social_linkedin', array( 'label' => 'LinkedIn URL', 'section' => 'mxc_footer_section', 'type' => 'url' ) );

    $wp_customize->add_setting( 'mxc_social_github', array( 'default' => '', 'sanitize_callback' => 'esc_url_raw' ) );
    $wp_customize->add_control( 'mxc_social_github', array( 'label' => 'GitHub URL', 'section' => 'mxc_footer_section', 'type' => 'url' ) );

    $wp_customize->add_setting( 'mxc_social_youtube', array( 'default' => '', 'sanitize_callback' => 'esc_url_raw' ) );
    $wp_customize->add_control( 'mxc_social_youtube', array( 'label' => 'YouTube URL', 'section' => 'mxc_footer_section', 'type' => 'url' ) );

    $wp_customize->add_setting( 'mxc_social_tiktok', array( 'default' => '', 'sanitize_callback' => 'esc_url_raw' ) );
    $wp_customize->add_control( 'mxc_social_tiktok', array( 'label' => 'TikTok URL', 'section' => 'mxc_footer_section', 'type' => 'url' ) );

    $wp_customize->add_setting( 'mxc_show_scroll_top', array( 'default' => true, 'sanitize_callback' => 'mxc_sanitize_checkbox' ) );
    $wp_customize->add_control( 'mxc_show_scroll_top', array( 'label' => __( 'Show Scroll to Top', 'metaxchron' ), 'section' => 'mxc_footer_section', 'type' => 'checkbox' ) );


    // 4. Global Design (Unified Appearance)
    $wp_customize->add_panel( 'mxc_global_design_panel', array(
        'title'      => __( 'Global Design', 'metaxchron' ),
        'priority'   => 40,
        'description'=> __( 'Control the overall look and feel of your site.', 'metaxchron' ),
    ) );

    // Panel: Header Options
    $wp_customize->add_panel( 'mxc_header_panel', array(
        'title'    => __( 'Header & Navigation', 'metaxchron' ),
        'priority' => 45,
    ) );

    // Move Logo Section to Header Panel
    $logo_section = $wp_customize->get_section( 'mxc_logo_section' );
    if ( $logo_section ) {
        $logo_section->panel = 'mxc_header_panel';
    }

    // Panel: Blog Settings
    $wp_customize->add_panel( 'mxc_blog_panel', array(
        'title'    => __( 'Blog & Archives', 'metaxchron' ),
        'priority' => 55,
    ) );

    // 6. Blog Pro
    $wp_customize->add_section( 'mxc_blog_pro_section', array( 'title' => __( 'Blog / Archive Layout', 'metaxchron' ), 'priority' => 55 ) );

    // Move Blog Pro Section to Blog Panel
    $blog_section = $wp_customize->get_section( 'mxc_blog_pro_section' );
    if ( $blog_section ) {
        $blog_section->panel = 'mxc_blog_panel';
    }

    // SECTION: Typography
    $wp_customize->add_section( 'mxc_typography_section', array(
        'title'      => __( 'Typography', 'metaxchron' ),
        'panel'      => 'mxc_global_design_panel',
        'description' => __( 'Choose from a curated list of premium Google Fonts.', 'metaxchron' ),
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
        'choices'  => $google_fonts,
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
        'choices'  => $google_fonts,
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

    // H1 Size
    $wp_customize->add_setting( 'mxc_h1_size', array( 'default' => '2.5', 'sanitize_callback' => 'sanitize_text_field' ) );
    $wp_customize->add_control( 'mxc_h1_size', array(
        'label' => __( 'H1 Size (rem)', 'metaxchron' ),
        'section' => 'mxc_typography_section',
        'type' => 'number', 'input_attrs' => array( 'step' => 0.1 )
    ));

    // Advanced: Line Heights
    $wp_customize->add_setting( 'mxc_line_height_body', array( 'default' => '1.6', 'sanitize_callback' => 'sanitize_text_field' ) );
    $wp_customize->add_control( 'mxc_line_height_body', array(
        'label' => __( 'Body Line Height', 'metaxchron' ),
        'section' => 'mxc_typography_section',
        'type' => 'number', 'input_attrs' => array( 'step' => 0.1, 'min' => 1, 'max' => 2.5 )
    ));

    $wp_customize->add_setting( 'mxc_line_height_heading', array( 'default' => '1.2', 'sanitize_callback' => 'sanitize_text_field' ) );
    $wp_customize->add_control( 'mxc_line_height_heading', array(
        'label' => __( 'Heading Line Height', 'metaxchron' ),
        'section' => 'mxc_typography_section',
        'type' => 'number', 'input_attrs' => array( 'step' => 0.1, 'min' => 0.8, 'max' => 2.0 )
    ));

    // Advanced: Letter Spacing
    $wp_customize->add_setting( 'mxc_letter_spacing_heading', array( 'default' => '0', 'sanitize_callback' => 'sanitize_text_field' ) );
    $wp_customize->add_control( 'mxc_letter_spacing_heading', array(
        'label' => __( 'Heading Letter Spacing (em)', 'metaxchron' ),
        'section' => 'mxc_typography_section',
        'type' => 'number', 'input_attrs' => array( 'step' => 0.01, 'min' => -0.1, 'max' => 0.5 )
    ));

    // SECTION: Colors
    $wp_customize->add_section( 'mxc_colors_global_section', array(
        'title'      => __( 'Global Colors', 'metaxchron' ),
        'panel'      => 'mxc_global_design_panel',
    ) );

    $wp_customize->add_setting( 'mxc_headings_color', array( 'default' => '#ffffff', 'sanitize_callback' => 'sanitize_hex_color' ) );
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'mxc_headings_color', array( 'label' => __( 'Headings Color', 'metaxchron' ), 'section' => 'mxc_colors_global_section' ) ) );

    $wp_customize->add_setting( 'mxc_body_color', array( 'default' => '#e0e0e0', 'sanitize_callback' => 'sanitize_hex_color' ) );
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'mxc_body_color', array( 'label' => __( 'Body Text Color', 'metaxchron' ), 'section' => 'mxc_colors_global_section' ) ) );

    $wp_customize->add_setting( 'mxc_link_color', array( 'default' => '#0d6efd', 'sanitize_callback' => 'sanitize_hex_color' ) );
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'mxc_link_color', array( 'label' => __( 'Link Color', 'metaxchron' ), 'section' => 'mxc_colors_global_section' ) ) );

    $wp_customize->add_setting( 'mxc_bg_color', array( 'default' => '#121212', 'sanitize_callback' => 'sanitize_hex_color', 'transport' => 'refresh' ) );
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'mxc_bg_color', array( 'label' => __( 'Background Color (Dark Mode Base)', 'metaxchron' ), 'section' => 'mxc_colors_global_section' ) ) );

    $wp_customize->add_setting( 'mxc_card_bg_color', array( 'default' => '#1e1e1e', 'sanitize_callback' => 'sanitize_hex_color', 'transport' => 'refresh' ) );
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'mxc_card_bg_color', array( 'label' => __( 'Card Background Color', 'metaxchron' ), 'section' => 'mxc_colors_global_section' ) ) );

    // 5. Homepage Settings (Simplified for brevity, ensuring necessary structure)
    $wp_customize->add_section( 'mxc_homepage_section', array( 'title' => __( 'Homepage Settings', 'metaxchron' ), 'priority' => 50 ) );
    $wp_customize->add_setting( 'mxc_show_slider', array( 'default' => true, 'sanitize_callback' => 'mxc_sanitize_checkbox' ) );
    $wp_customize->add_control( 'mxc_show_slider', array( 'label' => __( 'Show Featured Section', 'metaxchron' ), 'section' => 'mxc_homepage_section', 'type' => 'checkbox' ) );

    $wp_customize->add_setting( 'mxc_featured_style', array( 'default' => 'slider', 'sanitize_callback' => 'mxc_sanitize_select' ) );
    $wp_customize->add_control( 'mxc_featured_style', array( 'label' => __( 'Featured Section Style', 'metaxchron' ), 'section' => 'mxc_homepage_section', 'type' => 'select', 'choices' => array( 'slider' => 'Carousel', 'magazine' => 'Magazine' ) ) );

    $wp_customize->add_setting( 'mxc_slider_width', array( 'default' => 'container', 'sanitize_callback' => 'mxc_sanitize_select' ) );
    $wp_customize->add_control( 'mxc_slider_width', array( 'label' => __( 'Slider Width', 'metaxchron' ), 'section' => 'mxc_homepage_section', 'type' => 'select', 'choices' => array( 'container' => 'Contained', 'container-fluid' => 'Full Width' ) ) );

    $wp_customize->add_setting( 'mxc_home_layout', array( 'default' => 'grid', 'sanitize_callback' => 'mxc_sanitize_select' ) );
    $wp_customize->add_control( 'mxc_home_layout', array( 'label' => __( 'Post Layout', 'metaxchron' ), 'section' => 'mxc_homepage_section', 'type' => 'select', 'choices' => array( 'grid' => 'Grid', 'list' => 'List' ) ) );

    $wp_customize->add_setting( 'mxc_home_title', array( 'default' => __( 'Latest Posts', 'metaxchron' ), 'sanitize_callback' => 'sanitize_text_field' ) );
    $wp_customize->add_control( 'mxc_home_title', array( 'label' => __( 'Homepage Heading', 'metaxchron' ), 'section' => 'mxc_homepage_section', 'type' => 'text' ) );

    $wp_customize->add_setting( 'mxc_container_style', array( 'default' => 'boxed', 'sanitize_callback' => 'mxc_sanitize_select' ) );
    $wp_customize->add_control( 'mxc_container_style', array( 'label' => __( 'Container Style', 'metaxchron' ), 'section' => 'mxc_blog_pro_section', 'type' => 'select', 'choices' => array( 'boxed' => 'Boxed', 'unboxed' => 'Unboxed' ) ) );

    $elements = array( 'mxc_show_feat_img' => 'Featured Image', 'mxc_show_title' => 'Post Title', 'mxc_show_meta' => 'Meta Info', 'mxc_show_excerpt' => 'Excerpt', 'mxc_show_readmore' => 'Read More Button' );
    foreach ( $elements as $id => $label ) {
        $wp_customize->add_setting( $id, array( 'default' => true, 'sanitize_callback' => 'mxc_sanitize_checkbox' ) );
        $wp_customize->add_control( $id, array( 'label' => $label, 'section' => 'mxc_blog_pro_section', 'type' => 'checkbox' ) );
    }

    $meta_elements = array( 'mxc_meta_date' => 'Publish Date', 'mxc_meta_author' => 'Author Name', 'mxc_meta_category' => 'Category', 'mxc_meta_readtime' => 'Reading Time' );
    foreach ( $meta_elements as $id => $label ) {
        $wp_customize->add_setting( $id, array( 'default' => true, 'sanitize_callback' => 'mxc_sanitize_checkbox' ) );
        $wp_customize->add_control( $id, array( 'label' => $label, 'section' => 'mxc_blog_pro_section', 'type' => 'checkbox' ) );
    }

    // 7. Ad Management
    $wp_customize->add_section( 'mxc_ads_section', array( 'title' => __( 'Ad Management', 'metaxchron' ), 'priority' => 60 ) );
    $wp_customize->add_setting( 'mxc_container_width', array( 'default' => '1320', 'sanitize_callback' => 'absint' ) );
    $wp_customize->add_control( 'mxc_container_width', array( 'label' => __( 'Container Max Width (px)', 'metaxchron' ), 'section' => 'mxc_colors_global_section', 'type' => 'number', 'input_attrs' => array( 'min' => 800, 'max' => 1920, 'step' => 10 ) ) );

    $wp_customize->add_setting( 'mxc_sidebar_width', array( 'default' => '33', 'sanitize_callback' => 'absint' ) );
    $wp_customize->add_control( 'mxc_sidebar_width', array( 'label' => __( 'Sidebar Width (%)', 'metaxchron' ), 'section' => 'mxc_colors_global_section', 'type' => 'range', 'input_attrs' => array( 'min' => 20, 'max' => 50, 'step' => 1 ) ) );

    $wp_customize->add_setting( 'mxc_ad_header', array( 'default' => '', 'sanitize_callback' => 'mxc_sanitize_ad_code' ) );
    $wp_customize->add_control( 'mxc_ad_header', array( 'label' => __( 'Header Ad Code', 'metaxchron' ), 'section' => 'mxc_ads_section', 'type' => 'textarea' ) );

    $wp_customize->add_setting( 'mxc_ad_before_content', array( 'default' => '', 'sanitize_callback' => 'mxc_sanitize_ad_code' ) );
    $wp_customize->add_control( 'mxc_ad_before_content', array( 'label' => __( 'Before Post Content Ad', 'metaxchron' ), 'section' => 'mxc_ads_section', 'type' => 'textarea' ) );

    $wp_customize->add_setting( 'mxc_ad_after_content', array( 'default' => '', 'sanitize_callback' => 'mxc_sanitize_ad_code' ) );
    $wp_customize->add_control( 'mxc_ad_after_content', array( 'label' => __( 'After Post Content Ad', 'metaxchron' ), 'section' => 'mxc_ads_section', 'type' => 'textarea' ) );
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
    if ( current_user_can( 'unfiltered_html' ) ) {
        return $input;
    }
    return wp_kses_post( $input );
}

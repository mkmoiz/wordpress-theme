<?php
// Helper for font stacks is now in inc/typography.php

function mxc_enqueue_scripts() {
    // Bootstrap 5 CSS
    wp_enqueue_style( 'bootstrap-css', 'https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css', array(), '5.3.0', 'all' );

    // Theme Main CSS
    wp_enqueue_style( 'mxc-style', get_stylesheet_uri() );
    wp_enqueue_style( 'mxc-main-css', get_template_directory_uri() . '/assets/css/main.css', array('bootstrap-css'), '1.0', 'all' );

    // WooCommerce CSS
    if ( class_exists( 'WooCommerce' ) ) {
        wp_enqueue_style( 'mxc-woocommerce', get_template_directory_uri() . '/assets/css/woocommerce.css', array('mxc-main-css'), '1.0', 'all' );
    }

    // Prism.js for Syntax Highlighting (Only on single posts)
    if ( is_single() ) {
        wp_enqueue_style( 'prism-css', 'https://cdnjs.cloudflare.com/ajax/libs/prism/1.29.0/themes/prism-okaidia.min.css', array(), '1.29.0' );
        wp_enqueue_script( 'prism-js', 'https://cdnjs.cloudflare.com/ajax/libs/prism/1.29.0/prism.min.js', array(), '1.29.0', true );
        // Add autoloader or languages if needed, usually core is fine for basic usage
    }

    // Masonry for Masonry Page Template
    if ( is_page_template( 'page-templates/blog-masonry.php' ) ) {
        wp_enqueue_script( 'masonry' );
    }

    // Bootstrap 5 JS Bundle (No jQuery dependency needed for BS5)
    wp_enqueue_script( 'bootstrap-js', 'https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js', array(), '5.3.0', true );

    // Theme Main JS
    wp_enqueue_script( 'mxc-main-js', get_template_directory_uri() . '/assets/js/main.js', array('jquery', 'bootstrap-js'), '1.0', true );

    // Pass variables to JS
    wp_localize_script( 'mxc-main-js', 'mxc_ajax', array(
        'ajax_url' => admin_url( 'admin-ajax.php' ),
        'nonce'    => wp_create_nonce( 'mxc_load_more_nonce' )
    ));

    // FontAwesome
    wp_enqueue_style( 'fontawesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css', array(), '6.4.0' );

    // Threaded comments
    if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
        wp_enqueue_script( 'comment-reply' );
    }
}
add_action( 'wp_enqueue_scripts', 'mxc_enqueue_scripts' );

/**
 * Custom Comment Callback for Bootstrap styling
 */
function mxc_comment_callback($comment, $args, $depth) {
    ?>
    <li <?php comment_class('media mb-4 card bg-light border-0 shadow-sm p-3'); ?> id="comment-<?php comment_ID(); ?>">
        <div class="d-flex">
            <div class="flex-shrink-0 me-3">
                <?php if ( $args['avatar_size'] != 0 ) echo get_avatar( $comment, $args['avatar_size'], '', '', array('class' => 'rounded-circle') ); ?>
            </div>
            <div class="flex-grow-1">
                <h5 class="mt-0 fw-bold"><?php comment_author_link(); ?> <span class="text-muted small fw-normal ms-2"><?php comment_date(); ?> at <?php comment_time(); ?></span></h5>
                <?php if ($comment->comment_approved == '0') : ?>
                    <em class="text-warning d-block mb-2"><?php _e('Your comment is awaiting moderation.', 'metaxchron') ?></em>
                <?php endif; ?>

                <div class="comment-content mb-2">
                    <?php comment_text(); ?>
                </div>

                <div class="reply">
                    <?php comment_reply_link(array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth'], 'class' => 'btn btn-sm btn-outline-primary rounded-pill') )); ?>
                </div>
            </div>
        </div>
    <!-- </li> is closed by WordPress -->
    <?php
}

function mxc_setup() {
    // Load theme textdomain
    load_theme_textdomain( 'metaxchron', get_template_directory() . '/languages' );

    // Add default posts and comments RSS feed links to head.
    add_theme_support( 'automatic-feed-links' );

    // Let WordPress manage the document title.
    add_theme_support( 'title-tag' );

    // Enable support for Post Thumbnails on posts and pages.
    add_theme_support( 'post-thumbnails' );

    // This theme uses wp_nav_menu() in one location.
    register_nav_menus( array(
        'primary' => esc_html__( 'Primary Menu', 'metaxchron' ),
    ) );

    // HTML5 support
    add_theme_support( 'html5', array(
        'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption',
    ) );

    // WooCommerce Support
    add_theme_support( 'woocommerce' );
    add_theme_support( 'wc-product-gallery-zoom' );
    add_theme_support( 'wc-product-gallery-lightbox' );
    add_theme_support( 'wc-product-gallery-slider' );
}
add_action( 'after_setup_theme', 'mxc_setup' );

/**
 * Add lazy loading to custom logo.
 */
function mxc_custom_logo_attributes( $attr ) {
    $attr['loading'] = 'eager'; // Logo is above fold, so eager is better than lazy, but explicit is good.
    // Actually, WP lazy loads by default, so we might want to ensure it's NOT lazy for the logo.
    return $attr;
}
add_filter( 'get_custom_logo_image_attributes', 'mxc_custom_logo_attributes' );

/**
 * Register widget area.
 */
function mxc_widgets_init() {
    register_sidebar( array(
        'name'          => esc_html__( 'Sidebar', 'metaxchron' ),
        'id'            => 'sidebar-1',
        'description'   => esc_html__( 'Add widgets here.', 'metaxchron' ),
        'before_widget' => '<section id="%1$s" class="widget %2$s mb-4 card border-0 shadow-sm"><div class="card-body">',
        'after_widget'  => '</div></section>',
        'before_title'  => '<h2 class="widget-title h5 mb-3 border-bottom pb-2">',
        'after_title'   => '</h2>',
    ) );

    if ( class_exists( 'WooCommerce' ) ) {
        register_sidebar( array(
            'name'          => esc_html__( 'Shop Sidebar', 'metaxchron' ),
            'id'            => 'shop-sidebar',
            'description'   => esc_html__( 'Widgets for the shop page.', 'metaxchron' ),
            'before_widget' => '<section id="%1$s" class="widget %2$s mb-4 card border-0 shadow-sm"><div class="card-body">',
            'after_widget'  => '</div></section>',
            'before_title'  => '<h2 class="widget-title h5 mb-3 border-bottom pb-2">',
            'after_title'   => '</h2>',
        ) );
    }

    // Register 4 Footer Columns
    register_sidebars( 4, array(
        'name'          => __( 'Footer Column %d', 'metaxchron' ),
        'id'            => 'footer',
        'description'   => __( 'Add widgets here to appear in the footer.', 'metaxchron' ),
        'before_widget' => '<section id="%1$s" class="widget %2$s mb-4">',
        'after_widget'  => '</section>',
        'before_title'  => '<h3 class="widget-title h5 mb-3 text-white">',
        'after_title'   => '</h3>',
    ) );

    // Homepage Widget Area
    register_sidebar( array(
        'name'          => esc_html__( 'Homepage Widgets', 'metaxchron' ),
        'id'            => 'homepage-widgets',
        'description'   => esc_html__( 'Widgets for the Widgetized Homepage template.', 'metaxchron' ),
        'before_widget' => '<div id="%1$s" class="widget %2$s mb-5">',
        'after_widget'  => '</div>',
        'before_title'  => '<h2 class="widget-title text-center mb-4">',
        'after_title'   => '</h2>',
    ) );
}
add_action( 'widgets_init', 'mxc_widgets_init' );

// Add Bootstrap 'nav-link' class to menu anchors
function mxc_add_menu_link_class( $atts, $item, $args ) {
    if ( $args->theme_location == 'primary' ) {
        $atts['class'] = 'nav-link';
    }
    return $atts;
}
add_filter( 'nav_menu_link_attributes', 'mxc_add_menu_link_class', 10, 3 );

// Include Customizer settings
require get_template_directory() . '/inc/customizer.php';

// Include Custom Post Types
require get_template_directory() . '/inc/cpt-testimonials.php';

// Include Custom Widgets
require get_template_directory() . '/inc/widgets/class-mxc-social-widget.php';
require get_template_directory() . '/inc/widgets/class-mxc-ad-widget.php';
require get_template_directory() . '/inc/widgets/class-mxc-homepage-widgets.php';
require get_template_directory() . '/inc/widgets/class-mxc-extra-widgets.php';

// Include Meta Boxes
require get_template_directory() . '/inc/meta-boxes.php';

// Include Reading Time
require get_template_directory() . '/inc/reading-time.php';

// Include AJAX Handler
require get_template_directory() . '/inc/ajax-load-more.php';

// Include Typography
require get_template_directory() . '/inc/typography.php';

// Include SEO Enhancements
require get_template_directory() . '/inc/seo.php';

// Include Breadcrumbs
require get_template_directory() . '/inc/breadcrumbs.php';

// Include Block Patterns
require get_template_directory() . '/inc/patterns.php';

// Include One Click Demo Import
if ( class_exists( 'OCDI_Plugin' ) ) {
    require get_template_directory() . '/inc/ocdi-setup.php';
}

// Include Review System
require get_template_directory() . '/inc/review-system.php';

// Add SEO Schema Markup
function mxc_add_schema_markup() {
    if ( is_single() ) {
        global $post;
        $author_id = $post->post_author;

        $schema = array(
            '@context' => 'https://schema.org',
            '@type'    => 'BlogPosting',
            'headline' => get_the_title(),
            'datePublished' => get_the_date( 'c' ),
            'dateModified'  => get_the_modified_date( 'c' ),
            'author' => array(
                '@type' => 'Person',
                'name'  => get_the_author_meta( 'display_name', $author_id )
            ),
            'publisher' => array(
                '@type' => 'Organization',
                'name'  => get_bloginfo( 'name' ),
                'logo'  => array(
                    '@type' => 'ImageObject',
                    'url'   => get_theme_mod( 'mxc_logo' )
                )
            ),
            'description' => wp_strip_all_tags( get_the_excerpt() )
        );

        if ( has_post_thumbnail() ) {
            $schema['image'] = get_the_post_thumbnail_url( null, 'full' );
        }

        // Add Review Schema if applicable
        $score = get_post_meta( $post->ID, '_mxc_review_score', true );
        if ( $score ) {
            $schema['review'] = array(
                '@type' => 'Review',
                'reviewRating' => array(
                    '@type' => 'Rating',
                    'ratingValue' => $score,
                    'bestRating' => '10',
                    'worstRating' => '0'
                ),
                'author' => array(
                    '@type' => 'Person',
                    'name' => get_the_author_meta( 'display_name', $author_id )
                )
            );
        }

        echo '<script type="application/ld+json">' . json_encode( $schema ) . '</script>';
    }
}
add_action( 'wp_head', 'mxc_add_schema_markup' );

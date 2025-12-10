<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php wp_head(); ?>
    <?php
    $heading_choice = get_theme_mod( 'mxc_font_heading_choice', 'inter' );
    $heading_custom = get_theme_mod( 'mxc_font_heading_custom', 'Inter' );
    $body_choice    = get_theme_mod( 'mxc_font_body_choice', 'inter' );
    $body_custom    = get_theme_mod( 'mxc_font_body_custom', 'Inter' );
    $heading_stack  = mxc_get_font_stack_from_choice( $heading_choice, $heading_custom );
    $body_stack     = mxc_get_font_stack_from_choice( $body_choice, $body_custom );
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
            background-color: #0b5ed7; /* You might want to calculate a darker shade ideally */
            border-color: #0a58ca;
            color: #fff;
        }
    </style>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<script>
    (function() {
        var theme = localStorage.getItem('mxc_theme') || 'dark';
        document.body.setAttribute('data-theme', theme);
    })();
</script>

<?php if ( get_theme_mod( 'mxc_show_topbar', false ) ) : ?>
    <div class="bg-dark text-white py-1 small border-bottom border-secondary">
        <div class="container d-flex justify-content-between">
            <span><?php echo esc_html( get_theme_mod( 'mxc_topbar_info' ) ); ?></span>
            <div class="d-flex gap-2">
                <?php if ( get_theme_mod( 'mxc_social_twitter' ) ) : ?><a href="<?php echo esc_url( get_theme_mod( 'mxc_social_twitter' ) ); ?>" class="text-white"><i class="fab fa-x-twitter"></i></a><?php endif; ?>
                <?php if ( get_theme_mod( 'mxc_social_facebook' ) ) : ?><a href="<?php echo esc_url( get_theme_mod( 'mxc_social_facebook' ) ); ?>" class="text-white"><i class="fab fa-facebook-f"></i></a><?php endif; ?>
            </div>
        </div>
    </div>
<?php endif; ?>

<?php if ( get_theme_mod( 'mxc_ad_header' ) ) : ?>
    <div class="container text-center py-3 mxc-header-ad">
        <?php echo get_theme_mod( 'mxc_ad_header' ); // Sanitized via customizer logic ?>
    </div>
<?php endif; ?>

<?php
$header_layout = get_theme_mod( 'mxc_header_layout', 'default' );
$nav_classes = 'navbar navbar-expand-lg navbar-dark shadow-sm';
if ( $header_layout === 'transparent' && is_front_page() ) {
    $nav_classes .= ' position-absolute w-100 bg-transparent shadow-none';
    $nav_style = 'z-index: 1030;';
} else {
    $nav_style = '';
}
$container_class = ( $header_layout === 'centered' ) ? 'container flex-column' : 'container';
$menu_class = ( $header_layout === 'centered' ) ? 'navbar-nav mx-auto mb-2 mb-lg-0' : 'navbar-nav ms-auto mb-2 mb-lg-0';
?>

<header class="site-header">
    <nav class="<?php echo esc_attr( $nav_classes ); ?>" style="<?php echo esc_attr( $nav_style ); ?>">
        <div class="<?php echo esc_attr( $container_class ); ?>">
            <a class="navbar-brand fw-bold <?php echo ( $header_layout === 'centered' ) ? 'mb-3' : ''; ?>" href="<?php echo esc_url( home_url( '/' ) ); ?>">
                <?php
                $logo = get_theme_mod( 'mxc_logo' );
                if ( $logo ) {
                    echo '<img src="' . esc_url( $logo ) . '" alt="' . esc_attr( get_bloginfo( 'name' ) ) . '" height="40">';
                } else {
                    echo esc_html( get_bloginfo( 'name' ) );
                }
                ?>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#mxcOffcanvas" aria-controls="mxcOffcanvas">
                <span class="navbar-toggler-icon"></span>
            </button>

            <!-- Desktop Menu (Collapse for lg, hidden for sm) -->
            <div class="collapse navbar-collapse d-none d-lg-flex" id="mxcNavbarDesktop">
                <?php
                wp_nav_menu( array(
                    'theme_location' => 'primary',
                    'menu_class'     => $menu_class,
                    'container'      => false,
                    'fallback_cb'    => false,
                    'items_wrap'     => '<ul id="%1$s" class="%2$s">%3$s</ul>',
                ) );
                ?>
                <ul class="navbar-nav ms-3 d-flex align-items-center">
                    <?php if ( class_exists( 'WooCommerce' ) ) : ?>
                        <li class="nav-item me-2">
                            <a href="<?php echo esc_url( wc_get_cart_url() ); ?>" class="btn btn-link nav-link position-relative" title="<?php _e( 'View Cart', 'metaxchron' ); ?>">
                                <i class="fas fa-shopping-cart"></i>
                                <?php if ( WC()->cart->get_cart_contents_count() > 0 ) : ?>
                                    <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger" style="font-size: 0.6rem;">
                                        <?php echo WC()->cart->get_cart_contents_count(); ?>
                                    </span>
                                <?php endif; ?>
                            </a>
                        </li>
                    <?php endif; ?>
                    <li class="nav-item">
                        <button class="btn btn-link nav-link mxc-theme-toggle" type="button" aria-label="<?php esc_attr_e( 'Toggle theme', 'metaxchron' ); ?>"><i class="fas fa-sun"></i></button>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Mobile Offcanvas Menu -->
    <div class="offcanvas offcanvas-end d-lg-none mxc-offcanvas" tabindex="-1" id="mxcOffcanvas" aria-labelledby="mxcOffcanvasLabel" style="background-color: var(--mxc-bg-dark) !important;">
        <div class="offcanvas-header border-bottom border-secondary align-items-center">
            <h5 class="offcanvas-title fw-bold mb-0" id="mxcOffcanvasLabel"><?php echo esc_html( get_bloginfo( 'name' ) ); ?></h5>
            <div class="d-flex align-items-center gap-2">
                <button class="btn btn-link mxc-theme-toggle text-reset" type="button" aria-label="<?php esc_attr_e( 'Toggle theme', 'metaxchron' ); ?>"><i class="fas fa-sun"></i></button>
                <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
        </div>
        <div class="offcanvas-body">
            <?php
            wp_nav_menu( array(
                'theme_location' => 'primary',
                'menu_class'     => 'navbar-nav flex-column',
                'container'      => false,
                'fallback_cb'    => false,
                'items_wrap'     => '<ul id="%1$s" class="%2$s">%3$s</ul>',
            ) );
            ?>
            <div class="mt-4">
                <h6 class="text-uppercase small text-muted mb-2"><?php _e( 'Categories', 'metaxchron' ); ?></h6>
                <ul class="list-unstyled m-0">
                    <?php wp_list_categories( array( 'title_li' => '', 'show_count' => false, 'orderby' => 'name', 'depth' => 1 ) ); ?>
                </ul>
            </div>
            <hr class="border-secondary my-4">
            <div class="d-flex justify-content-center gap-3">
                <?php if ( get_theme_mod( 'mxc_social_twitter' ) ) : ?><a href="<?php echo esc_url( get_theme_mod( 'mxc_social_twitter' ) ); ?>" class="text-reset h4"><i class="fab fa-x-twitter"></i></a><?php endif; ?>
                <?php if ( get_theme_mod( 'mxc_social_facebook' ) ) : ?><a href="<?php echo esc_url( get_theme_mod( 'mxc_social_facebook' ) ); ?>" class="text-reset h4"><i class="fab fa-facebook-f"></i></a><?php endif; ?>
            </div>
        </div>
    </div>
</header>

<div id="content" class="site-content">
    <?php if ( ! is_front_page() && function_exists( 'mxc_breadcrumbs' ) ) : ?>
        <div class="container mt-4">
            <?php mxc_breadcrumbs(); ?>
        </div>
    <?php endif; ?>

<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php wp_head(); ?>
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
$logo_width    = get_theme_mod( 'mxc_logo_width', '200' );
$nav_classes   = 'navbar navbar-expand-lg navbar-dark shadow-sm mxc-header-' . $header_layout;

if ( $header_layout === 'transparent' && is_front_page() ) {
    $nav_classes .= ' position-absolute w-100 bg-transparent shadow-none';
    $nav_style = 'z-index: 1030;';
} else {
    $nav_style = '';
}

$container_class = ( $header_layout === 'centered' ) ? 'container flex-column' : 'container';
$menu_class      = ( $header_layout === 'centered' ) ? 'navbar-nav mx-auto mb-2 mb-lg-0' : 'navbar-nav ms-auto mb-2 mb-lg-0';

// Logo Logic
$logo_url        = get_theme_mod( 'mxc_logo' );
$logo_retina     = get_theme_mod( 'mxc_logo_retina' );
$logo_mobile     = get_theme_mod( 'mxc_logo_mobile' );
$site_title      = get_bloginfo( 'name' );
?>

<style>
    .site-logo { width: <?php echo esc_attr( $logo_width ); ?>px; max-width: 100%; height: auto; }
    @media (max-width: 767.98px) {
        .site-logo { width: clamp(120px, <?php echo esc_attr( $logo_width * 0.8 ); ?>px, 100%); }
    }
</style>

<header class="site-header">
    <nav class="<?php echo esc_attr( $nav_classes ); ?>" style="<?php echo esc_attr( $nav_style ); ?>">
        <div class="<?php echo esc_attr( $container_class ); ?>">
            <a class="navbar-brand fw-bold <?php echo ( $header_layout === 'centered' ) ? 'mb-3' : ''; ?>" href="<?php echo esc_url( home_url( '/' ) ); ?>">
                <?php if ( $logo_url ) : ?>
                    <picture>
                        <?php if ( $logo_mobile ) : ?>
                            <source media="(max-width: 575.98px)" srcset="<?php echo esc_url( $logo_mobile ); ?>">
                        <?php endif; ?>

                        <?php if ( $logo_retina ) : ?>
                            <img src="<?php echo esc_url( $logo_url ); ?>" srcset="<?php echo esc_url( $logo_url ); ?> 1x, <?php echo esc_url( $logo_retina ); ?> 2x" alt="<?php echo esc_attr( $site_title ); ?>" class="site-logo">
                        <?php else : ?>
                            <img src="<?php echo esc_url( $logo_url ); ?>" alt="<?php echo esc_attr( $site_title ); ?>" class="site-logo">
                        <?php endif; ?>
                    </picture>
                <?php else : ?>
                    <span class="site-title"><?php echo esc_html( $site_title ); ?></span>
                <?php endif; ?>
            </a>

            <?php if ( $header_layout !== 'minimal' ) : ?>
            <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#mxcOffcanvas" aria-controls="mxcOffcanvas">
                <span class="navbar-toggler-icon"></span>
            </button>
            <?php else: ?>
            <button class="btn btn-link text-white fs-4" type="button" data-bs-toggle="offcanvas" data-bs-target="#mxcOffcanvas" aria-controls="mxcOffcanvas">
                <i class="fas fa-bars"></i>
            </button>
            <?php endif; ?>

            <!-- Desktop Menu (Collapse for lg, hidden for sm) -->
            <?php if ( $header_layout !== 'minimal' ) : ?>
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
            <?php endif; // End check for minimal layout ?>

            <?php if ( $header_layout === 'minimal' ) : ?>
                <div class="ms-auto d-flex align-items-center">
                     <button class="btn btn-link nav-link mxc-theme-toggle" type="button" aria-label="<?php esc_attr_e( 'Toggle theme', 'metaxchron' ); ?>"><i class="fas fa-sun"></i></button>
                </div>
            <?php endif; ?>
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

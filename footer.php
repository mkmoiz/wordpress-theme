</div><!-- #content -->

<footer class="site-footer bg-dark text-white pt-5 pb-3 mt-5" style="background-color: <?php echo esc_attr( get_theme_mod( 'mxc_footer_bg_color', '#000000' ) ); ?> !important;">
    <div class="container">

        <!-- Footer Widgets -->
        <div class="row g-4 mb-4">
            <?php
            $cols = get_theme_mod( 'mxc_footer_columns', 2 );
            $col_class = 'col-md-' . ( 12 / $cols );

            for ( $i = 1; $i <= $cols; $i++ ) {
                if ( is_active_sidebar( 'footer-' . $i ) ) {
                    echo '<div class="' . esc_attr( $col_class ) . '">';
                    dynamic_sidebar( 'footer-' . $i );
                    echo '</div>';
                }
            }
            ?>
        </div>

        <!-- Footer Bottom Bar -->
        <div class="row border-top border-secondary pt-3 align-items-center">
            <div class="col-md-4 text-center text-md-start mb-2 mb-md-0">
                <p class="mb-0 small text-white-50">
                    <?php echo esc_html( get_theme_mod( 'mxc_footer_text', '© 2023 MetaXChron. All rights reserved.' ) ); ?>
                </p>
            </div>

            <div class="col-md-4 text-center mb-2 mb-md-0">
                <?php
                if ( has_nav_menu( 'footer' ) ) {
                    wp_nav_menu( array(
                        'theme_location' => 'footer',
                        'container'      => false,
                        'menu_class'     => 'list-inline mb-0 footer-menu',
                        'depth'          => 1,
                        'item_spacing'   => 'discard',
                        'fallback_cb'    => false,
                    ) );
                }
                ?>
            </div>

            <div class="col-md-4 text-center text-md-end">
                <?php if ( get_theme_mod( 'mxc_show_footer_social', true ) ) : ?>
                    <div class="d-flex justify-content-center justify-content-md-end gap-3 footer-social-icons">
                        <?php
                        $socials = array(
                            'facebook'  => 'fab fa-facebook-f',
                            'twitter'   => 'fab fa-x-twitter',
                            'instagram' => 'fab fa-instagram',
                            'linkedin'  => 'fab fa-linkedin-in',
                            'github'    => 'fab fa-github',
                            'youtube'   => 'fab fa-youtube',
                            'tiktok'    => 'fab fa-tiktok',
                        );

                        foreach ( $socials as $key => $icon ) {
                            $url = get_theme_mod( 'mxc_social_' . $key );
                            if ( $url ) {
                                echo '<a href="' . esc_url( $url ) . '" class="text-white-50 text-decoration-none transition-colors"><i class="' . esc_attr( $icon ) . '"></i></a>';
                            }
                        }
                        ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</footer>

<?php if ( get_theme_mod( 'mxc_show_scroll_top', true ) ) : ?>
    <button id="mxc-scroll-top" class="btn btn-primary rounded-circle shadow-lg" aria-label="<?php esc_attr_e( 'Scroll to top', 'metaxchron' ); ?>">
        <i class="fas fa-arrow-up"></i>
    </button>
<?php endif; ?>

<?php wp_footer(); ?>
</body>
</html>

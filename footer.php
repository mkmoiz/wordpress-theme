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
            <div class="col-md-6 text-center text-md-start">
                <p class="mb-0 small text-white-50">
                    <?php echo esc_html( get_theme_mod( 'mxc_footer_text', '© 2023 MetaXChron. All rights reserved.' ) ); ?>
                </p>
            </div>
            <div class="col-md-6 text-center text-md-end">
                <?php if ( get_theme_mod( 'mxc_show_footer_social', true ) ) : ?>
                    <?php if ( get_theme_mod( 'mxc_social_facebook' ) ) : ?>
                        <a href="<?php echo esc_url( get_theme_mod( 'mxc_social_facebook' ) ); ?>" class="text-white-50 me-3"><i class="fab fa-facebook-f"></i></a>
                    <?php endif; ?>
                    <?php if ( get_theme_mod( 'mxc_social_twitter' ) ) : ?>
                        <a href="<?php echo esc_url( get_theme_mod( 'mxc_social_twitter' ) ); ?>" class="text-white-50 me-3"><i class="fab fa-x-twitter"></i></a>
                    <?php endif; ?>
                    <?php if ( get_theme_mod( 'mxc_social_instagram' ) ) : ?>
                        <a href="<?php echo esc_url( get_theme_mod( 'mxc_social_instagram' ) ); ?>" class="text-white-50"><i class="fab fa-instagram"></i></a>
                    <?php endif; ?>
                <?php endif; ?>
            </div>
        </div>
    </div>
</footer>

<?php wp_footer(); ?>
</body>
</html>

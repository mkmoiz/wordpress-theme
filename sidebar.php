<?php
if ( ! is_active_sidebar( 'sidebar-1' ) ) {
    return;
}
?>

<aside id="secondary" class="widget-area col-lg-4">
    <div class="mxc-sticky-sidebar">
        <?php dynamic_sidebar( 'sidebar-1' ); ?>
    </div>
</aside>

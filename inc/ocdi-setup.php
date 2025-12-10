<?php
/**
 * One Click Demo Import Support
 */

function mxc_ocdi_import_files() {
    return array(
        array(
            'import_file_name'             => 'Metaxchron Demo',
            'categories'                   => array( 'Tech', 'Blog' ),
            'local_import_file'            => trailingslashit( get_template_directory() ) . 'demo-content.xml',
            // 'local_import_widget_file'     => trailingslashit( get_template_directory() ) . 'widgets.wie', // Placeholder
            // 'local_import_customizer_file' => trailingslashit( get_template_directory() ) . 'customizer.dat', // Placeholder
            'import_preview_image_url'     => get_template_directory_uri() . '/screenshot.png',
            'preview_url'                  => 'http://example.com/demo',
        ),
    );
}
add_filter( 'pt-ocdi/import_files', 'mxc_ocdi_import_files' );

function mxc_ocdi_after_import_setup() {
    // Assign menus to their locations.
    $main_menu = get_term_by( 'name', 'Main Menu', 'nav_menu' );

    set_theme_mod( 'nav_menu_locations', array(
            'primary' => $main_menu->term_id,
        )
    );

    // Assign front page and posts page (if created in demo content)
    $front_page_id = get_page_by_title( 'Home' );
    $blog_page_id  = get_page_by_title( 'Blog' );

    if ( $front_page_id && $blog_page_id ) {
        update_option( 'show_on_front', 'page' );
        update_option( 'page_on_front', $front_page_id->ID );
        update_option( 'page_for_posts', $blog_page_id->ID );
    }
}
add_action( 'pt-ocdi/after_import', 'mxc_ocdi_after_import_setup' );

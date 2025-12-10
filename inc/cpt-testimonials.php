<?php
/**
 * Register Testimonials Custom Post Type
 */
function mxc_register_testimonials_cpt() {
    $labels = array(
        'name'                  => _x( 'Testimonials', 'Post Type General Name', 'metaxchron' ),
        'singular_name'         => _x( 'Testimonial', 'Post Type Singular Name', 'metaxchron' ),
        'menu_name'             => __( 'Testimonials', 'metaxchron' ),
        'name_admin_bar'        => __( 'Testimonial', 'metaxchron' ),
        'archives'              => __( 'Testimonial Archives', 'metaxchron' ),
        'attributes'            => __( 'Testimonial Attributes', 'metaxchron' ),
        'parent_item_colon'     => __( 'Parent Testimonial:', 'metaxchron' ),
        'all_items'             => __( 'All Testimonials', 'metaxchron' ),
        'add_new_item'          => __( 'Add New Testimonial', 'metaxchron' ),
        'add_new'               => __( 'Add New', 'metaxchron' ),
        'new_item'              => __( 'New Testimonial', 'metaxchron' ),
        'edit_item'             => __( 'Edit Testimonial', 'metaxchron' ),
        'update_item'           => __( 'Update Testimonial', 'metaxchron' ),
        'view_item'             => __( 'View Testimonial', 'metaxchron' ),
        'view_items'            => __( 'View Testimonials', 'metaxchron' ),
        'search_items'          => __( 'Search Testimonial', 'metaxchron' ),
        'not_found'             => __( 'Not found', 'metaxchron' ),
        'not_found_in_trash'    => __( 'Not found in Trash', 'metaxchron' ),
        'featured_image'        => __( 'Author Image', 'metaxchron' ),
        'set_featured_image'    => __( 'Set author image', 'metaxchron' ),
        'remove_featured_image' => __( 'Remove author image', 'metaxchron' ),
        'use_featured_image'    => __( 'Use as author image', 'metaxchron' ),
        'insert_into_item'      => __( 'Insert into testimonial', 'metaxchron' ),
        'uploaded_to_this_item' => __( 'Uploaded to this testimonial', 'metaxchron' ),
        'items_list'            => __( 'Testimonials list', 'metaxchron' ),
        'items_list_navigation' => __( 'Testimonials list navigation', 'metaxchron' ),
        'filter_items_list'     => __( 'Filter testimonials list', 'metaxchron' ),
    );
    $args = array(
        'label'                 => __( 'Testimonial', 'metaxchron' ),
        'description'           => __( 'Client testimonials', 'metaxchron' ),
        'labels'                => $labels,
        'supports'              => array( 'title', 'editor', 'thumbnail', 'custom-fields' ),
        'hierarchical'          => false,
        'public'                => true,
        'show_ui'               => true,
        'show_in_menu'          => true,
        'menu_position'         => 20,
        'menu_icon'             => 'dashicons-format-quote',
        'show_in_admin_bar'     => true,
        'show_in_nav_menus'     => true,
        'can_export'            => true,
        'has_archive'           => true,
        'exclude_from_search'   => false,
        'publicly_queryable'    => true,
        'capability_type'       => 'post',
    );
    register_post_type( 'testimonials', $args );
}
add_action( 'init', 'mxc_register_testimonials_cpt', 0 );

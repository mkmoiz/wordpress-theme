<?php
/**
 * Post Layout Meta Box
 */

function mxc_add_meta_box() {
    $screens = [ 'post' ];
    foreach ( $screens as $screen ) {
        add_meta_box(
            'mxc_post_layout_box',           // Unique ID
            'Post Layout Settings',          // Box title
            'mxc_post_layout_box_html',      // Content callback
            $screen,                         // Post type
            'side'                           // Context
        );
    }

    // Testimonial Role Meta Box
    add_meta_box(
        'mxc_testimonial_role_box',
        __( 'Client Details', 'metaxchron' ),
        'mxc_testimonial_role_box_html',
        'testimonials',
        'normal',
        'high'
    );
}
add_action( 'add_meta_boxes', 'mxc_add_meta_box' );

function mxc_post_layout_box_html( $post ) {
    wp_nonce_field( 'mxc_save_post_layout', 'mxc_post_layout_nonce' );
    $value = get_post_meta( $post->ID, '_mxc_post_layout', true );
    ?>
    <label for="mxc_post_layout">Select Layout:</label>
    <select name="mxc_post_layout" id="mxc_post_layout" class="postbox">
        <option value="" <?php selected( $value, '' ); ?>>Default (Sidebar Right)</option>
        <option value="cover" <?php selected( $value, 'cover' ); ?>>Cover Image (Full Screen)</option>
        <option value="video" <?php selected( $value, 'video' ); ?>>Video Post</option>
        <option value="sidebar-left" <?php selected( $value, 'sidebar-left' ); ?>>Sidebar Left</option>
        <option value="minimal" <?php selected( $value, 'minimal' ); ?>>Minimalist Text</option>
        <option value="dual" <?php selected( $value, 'dual' ); ?>>Dual Column (Sticky)</option>
    </select>
    <p class="description">Choose a custom layout for this post.</p>
    <?php
    // Also a field for Video URL
    $video_val = get_post_meta( $post->ID, 'mxc_video_url', true );
    ?>
    <hr>
    <label for="mxc_video_url">Video URL (for Video Template):</label>
    <input type="url" name="mxc_video_url" id="mxc_video_url" value="<?php echo esc_attr( $video_val ); ?>" class="widefat">
    <?php
}

function mxc_testimonial_role_box_html( $post ) {
    wp_nonce_field( 'mxc_save_testimonial_details', 'mxc_testimonial_nonce' );
    $role = get_post_meta( $post->ID, 'testimonial_role', true );
    ?>
    <label for="testimonial_role"><?php _e( 'Role / Company:', 'metaxchron' ); ?></label>
    <input type="text" name="testimonial_role" id="testimonial_role" value="<?php echo esc_attr( $role ); ?>" class="widefat">
    <p class="description"><?php _e( 'E.g., CEO of TechCorp', 'metaxchron' ); ?></p>
    <?php
}

function mxc_save_postdata( $post_id ) {
    // Auto-save check
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
        return;
    }

    // Permission check
    if ( ! current_user_can( 'edit_post', $post_id ) ) {
        return;
    }

    // Save Post Layout Data
    if ( isset( $_POST['mxc_post_layout_nonce'] ) && wp_verify_nonce( $_POST['mxc_post_layout_nonce'], 'mxc_save_post_layout' ) ) {
        if ( array_key_exists( 'mxc_post_layout', $_POST ) ) {
            update_post_meta( $post_id, '_mxc_post_layout', sanitize_text_field( $_POST['mxc_post_layout'] ) );
        }
        if ( array_key_exists( 'mxc_video_url', $_POST ) ) {
            update_post_meta( $post_id, 'mxc_video_url', esc_url_raw( $_POST['mxc_video_url'] ) );
        }
    }

    // Save Testimonial Data
    if ( isset( $_POST['mxc_testimonial_nonce'] ) && wp_verify_nonce( $_POST['mxc_testimonial_nonce'], 'mxc_save_testimonial_details' ) ) {
        if ( array_key_exists( 'testimonial_role', $_POST ) ) {
            update_post_meta( $post_id, 'testimonial_role', sanitize_text_field( $_POST['testimonial_role'] ) );
        }
    }
}
add_action( 'save_post', 'mxc_save_postdata' );

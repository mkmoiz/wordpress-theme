<?php
/**
 * Review System Meta Boxes & Logic
 */

// Add Meta Box
function mxc_add_review_meta_box() {
    add_meta_box(
        'mxc_review_box',
        __( 'Tech Review Settings', 'metaxchron' ),
        'mxc_review_box_html',
        'post',
        'normal',
        'high'
    );
}
add_action( 'add_meta_boxes', 'mxc_add_review_meta_box' );

// Callback HTML
function mxc_review_box_html( $post ) {
    wp_nonce_field( 'mxc_save_review_data', 'mxc_review_nonce' );

    $score = get_post_meta( $post->ID, '_mxc_review_score', true );
    $summary = get_post_meta( $post->ID, '_mxc_review_summary', true );
    $pros = get_post_meta( $post->ID, '_mxc_review_pros', true );
    $cons = get_post_meta( $post->ID, '_mxc_review_cons', true );
    ?>
    <p>
        <label for="mxc_review_score"><strong><?php _e( 'Review Score (0-10):', 'metaxchron' ); ?></strong></label><br>
        <input type="number" id="mxc_review_score" name="mxc_review_score" value="<?php echo esc_attr( $score ); ?>" min="0" max="10" step="0.1" class="small-text">
    </p>
    <p>
        <label for="mxc_review_summary"><strong><?php _e( 'The Verdict (Summary):', 'metaxchron' ); ?></strong></label><br>
        <textarea id="mxc_review_summary" name="mxc_review_summary" rows="3" class="widefat"><?php echo esc_textarea( $summary ); ?></textarea>
    </p>
    <div style="display: flex; gap: 20px;">
        <div style="flex: 1;">
            <label for="mxc_review_pros"><strong><?php _e( 'Pros (One per line):', 'metaxchron' ); ?></strong></label><br>
            <textarea id="mxc_review_pros" name="mxc_review_pros" rows="5" class="widefat" placeholder="- Great battery life&#10;- Stunning display"><?php echo esc_textarea( $pros ); ?></textarea>
        </div>
        <div style="flex: 1;">
            <label for="mxc_review_cons"><strong><?php _e( 'Cons (One per line):', 'metaxchron' ); ?></strong></label><br>
            <textarea id="mxc_review_cons" name="mxc_review_cons" rows="5" class="widefat" placeholder="- Expensive&#10;- No headphone jack"><?php echo esc_textarea( $cons ); ?></textarea>
        </div>
    </div>
    <?php
}

// Save Data
function mxc_save_review_data( $post_id ) {
    if ( ! isset( $_POST['mxc_review_nonce'] ) || ! wp_verify_nonce( $_POST['mxc_review_nonce'], 'mxc_save_review_data' ) ) {
        return;
    }
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;
    if ( ! current_user_can( 'edit_post', $post_id ) ) return;

    if ( isset( $_POST['mxc_review_score'] ) ) {
        update_post_meta( $post_id, '_mxc_review_score', sanitize_text_field( $_POST['mxc_review_score'] ) );
    }
    if ( isset( $_POST['mxc_review_summary'] ) ) {
        update_post_meta( $post_id, '_mxc_review_summary', sanitize_textarea_field( $_POST['mxc_review_summary'] ) );
    }
    if ( isset( $_POST['mxc_review_pros'] ) ) {
        update_post_meta( $post_id, '_mxc_review_pros', sanitize_textarea_field( $_POST['mxc_review_pros'] ) );
    }
    if ( isset( $_POST['mxc_review_cons'] ) ) {
        update_post_meta( $post_id, '_mxc_review_cons', sanitize_textarea_field( $_POST['mxc_review_cons'] ) );
    }
}
add_action( 'save_post', 'mxc_save_review_data' );

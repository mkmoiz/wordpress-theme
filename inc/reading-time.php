<?php
/**
 * Calculate Reading Time
 */
function mxc_get_reading_time() {
    global $post;
    $content = get_post_field( 'post_content', $post->ID );
    $word_count = str_word_count( strip_tags( $content ) );
    $reading_time = ceil( $word_count / 200 ); // 200 words per minute

    return sprintf( __( '%s min', 'metaxchron' ), $reading_time );
}

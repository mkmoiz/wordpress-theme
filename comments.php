<?php
if ( post_password_required() ) {
    return;
}
?>

<div id="comments" class="comments-area">

    <?php if ( have_comments() ) : ?>
        <h2 class="comments-title mb-4 border-bottom pb-2">
            <?php
            $mxc_comment_count = get_comments_number();
            if ( '1' === $mxc_comment_count ) {
                printf(
                    /* translators: 1: title. */
                    esc_html__( 'One thought on &ldquo;%1$s&rdquo;', 'metaxchron' ),
                    '<span>' . get_the_title() . '</span>'
                );
            } else {
                printf(
                    /* translators: 1: comment count number, 2: title. */
                    esc_html( _nx( '%1$s thought on &ldquo;%2$s&rdquo;', '%1$s thoughts on &ldquo;%2$s&rdquo;', $mxc_comment_count, 'comments title', 'metaxchron' ) ),
                    number_format_i18n( $mxc_comment_count ),
                    '<span>' . get_the_title() . '</span>'
                );
            }
            ?>
        </h2>

        <ol class="comment-list list-unstyled">
            <?php
            wp_list_comments(
                array(
                    'style'      => 'ol',
                    'short_ping' => true,
                    'callback'   => 'mxc_comment_callback' // Custom callback to style comments with Bootstrap
                )
            );
            ?>
        </ol>

        <?php
        the_comments_navigation();

        // If comments are closed and there are comments, let's leave a little note, shall we?
        if ( ! comments_open() ) :
            ?>
            <p class="no-comments"><?php esc_html_e( 'Comments are closed.', 'metaxchron' ); ?></p>
            <?php
        endif;

    endif; // Check for have_comments().

    $commenter = wp_get_current_commenter();
    $req = get_option( 'require_name_email' );
    $aria_req = ( $req ? " aria-required='true'" : '' );

    comment_form( array(
        'class_form'         => 'comment-form mt-5',
        'title_reply'        => __( 'Leave a Reply', 'metaxchron' ),
        'title_reply_before' => '<h3 id="reply-title" class="comment-reply-title h4 mb-3">',
        'title_reply_after'  => '</h3>',
        'fields'             => array(
            'author' => '<div class="mb-3"><label for="author" class="form-label">' . __( 'Name', 'metaxchron' ) . '</label> <input id="author" name="author" type="text" class="form-control" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30"' . $aria_req . ' /></div>',
            'email'  => '<div class="mb-3"><label for="email" class="form-label">' . __( 'Email', 'metaxchron' ) . '</label> <input id="email" name="email" type="email" class="form-control" value="' . esc_attr(  $commenter['comment_author_email'] ) . '" size="30"' . $aria_req . ' /></div>',
            'url'    => '<div class="mb-3"><label for="url" class="form-label">' . __( 'Website', 'metaxchron' ) . '</label> <input id="url" name="url" type="url" class="form-control" value="' . esc_attr( $commenter['comment_author_url'] ) . '" size="30" /></div>',
        ),
        'comment_field'      => '<div class="mb-3"><label for="comment" class="form-label">' . _x( 'Comment', 'noun', 'metaxchron' ) . '</label> <textarea id="comment" name="comment" cols="45" rows="8" class="form-control" aria-required="true"></textarea></div>',
        'submit_button'      => '<button name="%1$s" type="submit" id="%2$s" class="%3$s btn btn-primary rounded-pill">%4$s</button>',
    ) );
    ?>

</div><!-- #comments -->

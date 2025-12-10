<div class="card bg-light border-0 shadow-sm mb-5">
    <div class="card-body p-4">
        <div class="d-flex align-items-center">
            <div class="flex-shrink-0">
                <?php echo get_avatar( get_the_author_meta( 'ID' ), 80, '', '', array( 'class' => 'rounded-circle shadow-sm border' ) ); ?>
            </div>
            <div class="flex-grow-1 ms-3">
                <h5 class="mt-0 fw-bold"><?php echo esc_html( get_the_author() ); ?></h5>
                <p class="mb-1 small text-muted"><?php echo wp_trim_words( get_the_author_meta( 'description' ), 30 ); ?></p>
                <a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>" class="btn btn-sm btn-outline-primary rounded-pill mt-2">
                    <?php _e( 'View All Posts', 'metaxchron' ); ?>
                </a>
            </div>
        </div>
    </div>
</div>

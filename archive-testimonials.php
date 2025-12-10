<?php get_header(); ?>

<div class="container py-5">
    <div class="text-center mb-5">
        <h1 class="display-4 fw-bold">Testimonials</h1>
        <p class="lead text-muted">What our clients say about us.</p>
    </div>

    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
        <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
            <div class="col">
                <div class="card h-100 border-0 shadow-sm bg-light">
                    <div class="card-body text-center p-4">
                        <?php if ( has_post_thumbnail() ) : ?>
                            <div class="mb-3">
                                <?php the_post_thumbnail( 'thumbnail', array( 'class' => 'rounded-circle shadow', 'style' => 'width: 100px; height: 100px; object-fit: cover;' ) ); ?>
                            </div>
                        <?php else: ?>
                            <div class="mb-3 d-inline-block bg-secondary text-white rounded-circle d-flex align-items-center justify-content-center shadow" style="width: 100px; height: 100px; font-size: 2rem;">
                                <?php echo substr( get_the_title(), 0, 1 ); ?>
                            </div>
                        <?php endif; ?>

                        <h5 class="card-title fw-bold"><?php the_title(); ?></h5>

                        <div class="card-text fst-italic text-muted mb-3">
                            "<?php echo wp_trim_words( get_the_content(), 30 ); ?>"
                        </div>

                        <?php
                        // Example custom field for role/company
                        $role = get_post_meta( get_the_ID(), 'testimonial_role', true );
                        if ( $role ) : ?>
                            <p class="small text-primary-custom fw-bold mb-0"><?php echo esc_html( $role ); ?></p>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        <?php endwhile; else : ?>
            <div class="col-12 text-center">
                <p><?php esc_html_e( 'No testimonials found.', 'metaxchron' ); ?></p>
            </div>
        <?php endif; ?>
    </div>

    <div class="mt-5">
        <?php the_posts_pagination( array( 'class' => 'pagination justify-content-center' ) ); ?>
    </div>
</div>

<?php get_footer(); ?>

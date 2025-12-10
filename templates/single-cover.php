<?php
/**
 * Template Name: Cover Image
 * Template Post Type: post
 */
get_header(); ?>

<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

    <!-- Hero Section -->
    <?php $bg_url = get_the_post_thumbnail_url( null, 'full' ); ?>
    <div class="position-relative w-100 vh-100 d-flex align-items-center justify-content-center text-center text-white mb-5" style="<?php echo $bg_url ? 'background: url(' . esc_url( $bg_url ) . ') no-repeat center center; background-size: cover;' : 'background-color: var(--mxc-bg-dark);'; ?>">
        <div class="position-absolute top-0 start-0 w-100 h-100 bg-dark opacity-50"></div>
        <div class="position-relative z-1 container">
            <div class="badge bg-primary mb-3"><?php the_category( ', ' ); ?></div>
            <h1 class="display-1 fw-bold mb-4"><?php the_title(); ?></h1>
            <div class="lead">
                <span><i class="far fa-user"></i> <?php the_author(); ?></span> &bull;
                <span><i class="far fa-clock"></i> <?php echo mxc_get_reading_time(); ?> read</span>
            </div>
        </div>

        <!-- Scroll Down Indicator -->
        <div class="position-absolute bottom-0 start-50 translate-middle-x mb-4 animate-bounce">
            <i class="fas fa-chevron-down fa-2x"></i>
        </div>
    </div>

    <div class="container pb-5">
        <div class="row justify-content-center">
            <div class="col-lg-8">

                <section class="mb-5 content-body lead">
                    <?php the_content(); ?>
                </section>

                <!-- Share & Interaction -->
                <div class="border-top border-bottom py-4 my-5">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="h5 mb-0">Share this story</div>
                        <div>
                             <a href="<?php echo esc_url( 'https://www.facebook.com/sharer/sharer.php?u=' . urlencode( get_permalink() ) ); ?>" target="_blank" class="btn btn-outline-primary btn-sm rounded-circle me-2" style="width: 40px; height: 40px;"><i class="fab fa-facebook-f"></i></a>
                             <a href="<?php echo esc_url( 'https://x.com/intent/tweet?text=' . urlencode( get_the_title() ) . '&url=' . urlencode( get_permalink() ) ); ?>" target="_blank" class="btn btn-outline-light btn-sm rounded-circle me-2" style="width: 40px; height: 40px;"><i class="fab fa-x-twitter"></i></a>
                             <a href="<?php echo esc_url( 'https://www.linkedin.com/shareArticle?mini=true&url=' . urlencode( get_permalink() ) . '&title=' . urlencode( get_the_title() ) ); ?>" target="_blank" class="btn btn-outline-primary btn-sm rounded-circle" style="width: 40px; height: 40px;"><i class="fab fa-linkedin-in"></i></a>
                        </div>
                    </div>
                </div>

                <!-- Author Bio -->
                <?php get_template_part( 'template-parts/author-bio' ); ?>

                <!-- Related Posts -->
                <?php get_template_part( 'template-parts/related-posts' ); ?>

                <?php if ( comments_open() || get_comments_number() ) : ?>
                    <div class="mt-5">
                        <?php comments_template(); ?>
                    </div>
                <?php endif; ?>

            </div>
        </div>
    </div>

<?php endwhile; endif; ?>

<?php get_footer(); ?>

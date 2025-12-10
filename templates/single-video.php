<?php
/**
 * Template Name: Video Post
 * Template Post Type: post
 */
get_header(); ?>

<div class="bg-dark text-white py-5 mb-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <!-- Video Container -->
                <div class="ratio ratio-16x9 shadow-lg rounded mb-4" style="border: 1px solid rgba(255,255,255,0.1);">
                    <?php
                    // Check for custom field 'mxc_video_url' first
                    $video_url = get_post_meta( get_the_ID(), 'mxc_video_url', true );
                    if ( $video_url ) {
                        echo wp_oembed_get( $video_url );
                    } else {
                        // Fallback: Try to find the first oembed in the content
                        $content = get_the_content();
                        $regex = '/https:\/\/(www\.)?(youtube\.com|youtu\.be|vimeo\.com)\/[a-zA-Z0-9_\-\?\=\&]+/';
                        if ( preg_match( $regex, $content, $match ) ) {
                            echo wp_oembed_get( $match[0] );
                        } else {
                            // Absolute Fallback: Featured Image
                            the_post_thumbnail( 'full', array( 'class' => 'object-fit-cover' ) );
                        }
                    }
                    ?>
                </div>

                <h1 class="display-4 fw-bold text-center"><?php the_title(); ?></h1>
            </div>
        </div>
    </div>
</div>

<div class="container pb-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <article <?php post_class(); ?>>
                <div class="d-flex align-items-center justify-content-between mb-4 text-muted border-bottom pb-3">
                    <div>
                         <span><i class="far fa-user"></i> <?php the_author(); ?></span>
                         <span class="mx-2">&bull;</span>
                         <span><i class="far fa-calendar"></i> <?php echo get_the_date(); ?></span>
                    </div>
                    <div>
                        <span class="badge bg-danger">Video</span>
                        <span class="badge bg-secondary ms-1"><?php echo mxc_get_reading_time(); ?> watch</span>
                    </div>
                </div>

                <section class="mb-5 content-body">
                    <?php
                    // Filter out the video if we auto-detected it to avoid duplication?
                    // For now, just show content.
                    the_content();
                    ?>
                </section>

                <!-- Interaction -->
                <?php get_template_part( 'template-parts/author-bio' ); ?>
                <?php get_template_part( 'template-parts/related-posts' ); ?>

                <?php if ( comments_open() || get_comments_number() ) : ?>
                    <div class="mt-5">
                        <?php comments_template(); ?>
                    </div>
                <?php endif; ?>

            </article>
        </div>

        <?php get_sidebar(); ?>
    </div>
</div>

<?php get_footer(); ?>

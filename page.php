<?php get_header(); ?>

<div class="container py-5">
    <div class="row">
        <div class="col-lg-8">
            <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
                <article <?php post_class(); ?>>
                    <?php if ( has_post_thumbnail() ) : ?>
                        <div class="mb-4">
                            <?php the_post_thumbnail( 'full', array( 'class' => 'img-fluid rounded shadow' ) ); ?>
                        </div>
                    <?php endif; ?>

                    <header class="mb-4">
                        <h1 class="fw-bolder mb-1"><?php the_title(); ?></h1>
                    </header>

                    <section class="mb-5 content-body">
                        <?php the_content(); ?>
                    </section>

                    <?php if ( comments_open() || get_comments_number() ) : ?>
                        <div class="mt-5">
                            <?php comments_template(); ?>
                        </div>
                    <?php endif; ?>

                </article>
            <?php endwhile; endif; ?>
        </div>

        <?php get_sidebar(); ?>
    </div>
</div>

<?php get_footer(); ?>

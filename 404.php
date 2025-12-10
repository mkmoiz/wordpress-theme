<?php get_header(); ?>
<section class="container" style="text-align:center;padding:60px 0;">
  <h1 class="display-1 mb-4">404</h1>
  <h2 class="mb-4"><?php _e('Time fractured — page not found','metaxchron'); ?></h2>
  <p class="lead mb-4"><?php _e('The page you are looking for has slipped through the timeline.','metaxchron'); ?></p>
  <p><a class="btn btn-primary rounded-pill px-4 py-2" href="<?php echo esc_url(home_url('/')); ?>"><?php _e('Go Home','metaxchron'); ?></a></p>
</section>
<?php get_footer(); ?>

<?php
/**
 * Custom Widget: Trending Carousel
 */
class MXC_Trending_Widget extends WP_Widget {

    function __construct() {
        parent::__construct( 'mxc_trending_widget', __( 'MXC: Trending Carousel', 'metaxchron' ), array( 'description' => __( 'Horizontal carousel of posts from a category.', 'metaxchron' ) ) );
    }

    public function widget( $args, $instance ) {
        $cat_id = ! empty( $instance['cat_id'] ) ? $instance['cat_id'] : 0;
        $count = ! empty( $instance['count'] ) ? $instance['count'] : 5;

        $q_args = array( 'posts_per_page' => $count, 'cat' => $cat_id, 'ignore_sticky_posts' => 1 );
        $q = new WP_Query( $q_args );

        echo $args['before_widget'];
        if ( ! empty( $instance['title'] ) ) {
            echo $args['before_title'] . apply_filters( 'widget_title', $instance['title'] ) . $args['after_title'];
        }

        if ( $q->have_posts() ) : ?>
            <div class="trending-carousel d-flex gap-3 overflow-auto pb-3" style="scroll-behavior: smooth;">
                <?php while ( $q->have_posts() ) : $q->the_post(); ?>
                    <div class="card border-0 shadow-sm flex-shrink-0" style="width: 280px;">
                        <?php if ( has_post_thumbnail() ) : ?>
                            <a href="<?php the_permalink(); ?>">
                                <?php the_post_thumbnail( 'medium', array( 'class' => 'card-img-top', 'style' => 'height: 160px; object-fit: cover;' ) ); ?>
                            </a>
                        <?php endif; ?>
                        <div class="card-body p-3">
                            <div class="small text-muted mb-1"><?php the_category( ', ' ); ?></div>
                            <h5 class="card-title h6 mb-0"><a href="<?php the_permalink(); ?>" class="text-decoration-none text-reset"><?php the_title(); ?></a></h5>
                        </div>
                    </div>
                <?php endwhile; ?>
            </div>
        <?php endif; wp_reset_postdata();
        echo $args['after_widget'];
    }

    public function form( $instance ) {
        $title = ! empty( $instance['title'] ) ? $instance['title'] : '';
        $cat_id = ! empty( $instance['cat_id'] ) ? $instance['cat_id'] : 0;
        $count = ! empty( $instance['count'] ) ? $instance['count'] : 5;
        ?>
        <p><label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php _e( 'Title:', 'metaxchron' ); ?></label>
        <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>"></p>
        <p><label for="<?php echo esc_attr( $this->get_field_id( 'cat_id' ) ); ?>"><?php _e( 'Category ID:', 'metaxchron' ); ?></label>
        <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'cat_id' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'cat_id' ) ); ?>" type="number" value="<?php echo esc_attr( $cat_id ); ?>"></p>
        <?php
    }

    public function update( $new_instance, $old_instance ) {
        $instance = array();
        $instance['title'] = sanitize_text_field( $new_instance['title'] );
        $instance['cat_id'] = absint( $new_instance['cat_id'] );
        return $instance;
    }
}

/**
 * Custom Widget: Newsletter CTA
 */
class MXC_Newsletter_Widget extends WP_Widget {

    function __construct() {
        parent::__construct( 'mxc_newsletter_widget', __( 'MXC: Newsletter CTA', 'metaxchron' ), array( 'description' => __( 'Stylish subscription box.', 'metaxchron' ) ) );
    }

    public function widget( $args, $instance ) {
        $title = ! empty( $instance['title'] ) ? $instance['title'] : 'Subscribe';
        $text = ! empty( $instance['text'] ) ? $instance['text'] : 'Join our newsletter.';
        ?>
        <div class="card bg-primary text-white border-0 shadow-lg text-center p-4 mb-4">
            <div class="card-body">
                <i class="fas fa-envelope-open-text fa-3x mb-3 text-white-50"></i>
                <h3 class="h4 fw-bold"><?php echo esc_html( $title ); ?></h3>
                <p class="small text-white-50 mb-4"><?php echo esc_html( $text ); ?></p>
                <form onsubmit="event.preventDefault(); alert('<?php _e('Thank you for subscribing!', 'metaxchron'); ?>');">
                    <div class="input-group">
                        <input type="email" class="form-control border-0" placeholder="<?php _e( 'Enter email address', 'metaxchron' ); ?>" required>
                        <button class="btn btn-dark" type="submit"><?php _e( 'Join', 'metaxchron' ); ?></button>
                    </div>
                </form>
            </div>
        </div>
        <?php
    }

    public function form( $instance ) {
        $title = ! empty( $instance['title'] ) ? $instance['title'] : '';
        $text = ! empty( $instance['text'] ) ? $instance['text'] : '';
        ?>
        <p><label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php _e( 'Headline:', 'metaxchron' ); ?></label>
        <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>"></p>
        <p><label for="<?php echo esc_attr( $this->get_field_id( 'text' ) ); ?>"><?php _e( 'Text:', 'metaxchron' ); ?></label>
        <textarea class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'text' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'text' ) ); ?>"><?php echo esc_textarea( $text ); ?></textarea></p>
        <?php
    }

    public function update( $new_instance, $old_instance ) {
        $instance = array();
        $instance['title'] = sanitize_text_field( $new_instance['title'] );
        $instance['text'] = sanitize_textarea_field( $new_instance['text'] );
        return $instance;
    }
}

// Register
function register_mxc_extra_widgets() {
    register_widget( 'MXC_Trending_Widget' );
    register_widget( 'MXC_Newsletter_Widget' );
}
add_action( 'widgets_init', 'register_mxc_extra_widgets' );

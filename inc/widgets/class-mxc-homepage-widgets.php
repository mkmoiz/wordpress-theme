<?php
/**
 * Custom Widget: Hero Section
 */
class MXC_Hero_Widget extends WP_Widget {

    function __construct() {
        parent::__construct(
            'mxc_hero_widget',
            __( 'MXC: Hero Section', 'metaxchron' ),
            array( 'description' => __( 'A large hero image with text overlay.', 'metaxchron' ), )
        );
    }

    public function widget( $args, $instance ) {
        // No widget wrappers, full width output
        $bg_image = ! empty( $instance['image_url'] ) ? $instance['image_url'] : '';
        $title = ! empty( $instance['title'] ) ? $instance['title'] : '';
        $text = ! empty( $instance['text'] ) ? $instance['text'] : '';
        $btn_text = ! empty( $instance['btn_text'] ) ? $instance['btn_text'] : '';
        $btn_url = ! empty( $instance['btn_url'] ) ? $instance['btn_url'] : '';
        ?>
        <div class="hero-section position-relative d-flex align-items-center justify-content-center text-center text-white" style="min-height: 500px; background: url('<?php echo esc_url( $bg_image ); ?>') center/cover no-repeat; background-color: #000;">
            <div class="position-absolute w-100 h-100 bg-dark opacity-50 top-0 start-0"></div>
            <div class="container position-relative z-1">
                <?php if ( $title ) : ?><h1 class="display-3 fw-bold mb-3"><?php echo esc_html( $title ); ?></h1><?php endif; ?>
                <?php if ( $text ) : ?><p class="lead mb-4"><?php echo esc_html( $text ); ?></p><?php endif; ?>
                <?php if ( $btn_text && $btn_url ) : ?>
                    <a href="<?php echo esc_url( $btn_url ); ?>" class="btn btn-primary btn-lg rounded-pill px-5"><?php echo esc_html( $btn_text ); ?></a>
                <?php endif; ?>
            </div>
        </div>
        <?php
    }

    public function form( $instance ) {
        $defaults = array( 'title' => 'Welcome', 'text' => '', 'btn_text' => 'Learn More', 'btn_url' => '#', 'image_url' => '' );
        $instance = wp_parse_args( (array) $instance, $defaults );
        ?>
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php _e( 'Headline:', 'metaxchron' ); ?></label>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $instance['title'] ); ?>">
        </p>
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'text' ) ); ?>"><?php _e( 'Sub-text:', 'metaxchron' ); ?></label>
            <textarea class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'text' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'text' ) ); ?>"><?php echo esc_textarea( $instance['text'] ); ?></textarea>
        </p>
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'image_url' ) ); ?>"><?php _e( 'Image URL:', 'metaxchron' ); ?></label>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'image_url' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'image_url' ) ); ?>" type="url" value="<?php echo esc_attr( $instance['image_url'] ); ?>">
        </p>
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'btn_text' ) ); ?>"><?php _e( 'Button Text:', 'metaxchron' ); ?></label>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'btn_text' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'btn_text' ) ); ?>" type="text" value="<?php echo esc_attr( $instance['btn_text'] ); ?>">
        </p>
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'btn_url' ) ); ?>"><?php _e( 'Button URL:', 'metaxchron' ); ?></label>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'btn_url' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'btn_url' ) ); ?>" type="url" value="<?php echo esc_attr( $instance['btn_url'] ); ?>">
        </p>
        <?php
    }

    public function update( $new_instance, $old_instance ) {
        $instance = array();
        $instance['title'] = sanitize_text_field( $new_instance['title'] );
        $instance['text'] = sanitize_textarea_field( $new_instance['text'] );
        $instance['image_url'] = esc_url_raw( $new_instance['image_url'] );
        $instance['btn_text'] = sanitize_text_field( $new_instance['btn_text'] );
        $instance['btn_url'] = esc_url_raw( $new_instance['btn_url'] );
        return $instance;
    }
}

/**
 * Custom Widget: Category Grid
 */
class MXC_Category_Grid_Widget extends WP_Widget {

    function __construct() {
        parent::__construct( 'mxc_cat_grid_widget', __( 'MXC: Category Grid', 'metaxchron' ), array( 'description' => __( 'Display posts from a category.', 'metaxchron' ) ) );
    }

    public function widget( $args, $instance ) {
        $cat_id = ! empty( $instance['cat_id'] ) ? $instance['cat_id'] : 0;
        $count = ! empty( $instance['count'] ) ? $instance['count'] : 4;

        $q_args = array(
            'posts_per_page' => $count,
            'cat' => $cat_id,
            'ignore_sticky_posts' => 1
        );
        $q = new WP_Query( $q_args );

        echo '<div class="container my-5">';
        if ( ! empty( $instance['title'] ) ) {
            echo '<h2 class="text-center mb-4">' . apply_filters( 'widget_title', $instance['title'] ) . '</h2>';
        }

        if ( $q->have_posts() ) {
            echo '<div class="row row-cols-1 row-cols-md-2 row-cols-lg-4 g-4">';
            while ( $q->have_posts() ) {
                $q->the_post();
                ?>
                <div class="col">
                    <div class="card h-100 border-0 shadow-sm">
                        <?php if ( has_post_thumbnail() ) : ?>
                            <a href="<?php the_permalink(); ?>">
                                <?php the_post_thumbnail( 'medium', array( 'class' => 'card-img-top', 'style' => 'height: 150px; object-fit: cover;' ) ); ?>
                            </a>
                        <?php endif; ?>
                        <div class="card-body">
                            <h5 class="card-title h6"><a href="<?php the_permalink(); ?>" class="text-decoration-none"><?php the_title(); ?></a></h5>
                        </div>
                    </div>
                </div>
                <?php
            }
            echo '</div>';
        }
        echo '</div>';
        wp_reset_postdata();
    }

    public function form( $instance ) {
        $title = ! empty( $instance['title'] ) ? $instance['title'] : '';
        $cat_id = ! empty( $instance['cat_id'] ) ? $instance['cat_id'] : 0;
        $count = ! empty( $instance['count'] ) ? $instance['count'] : 4;
        ?>
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php _e( 'Title:', 'metaxchron' ); ?></label>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
        </p>
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'cat_id' ) ); ?>"><?php _e( 'Category ID:', 'metaxchron' ); ?></label>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'cat_id' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'cat_id' ) ); ?>" type="number" value="<?php echo esc_attr( $cat_id ); ?>">
        </p>
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'count' ) ); ?>"><?php _e( 'Post Count:', 'metaxchron' ); ?></label>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'count' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'count' ) ); ?>" type="number" value="<?php echo esc_attr( $count ); ?>">
        </p>
        <?php
    }

    public function update( $new_instance, $old_instance ) {
        $instance = array();
        $instance['title'] = sanitize_text_field( $new_instance['title'] );
        $instance['cat_id'] = absint( $new_instance['cat_id'] );
        $instance['count'] = absint( $new_instance['count'] );
        return $instance;
    }
}

// Register
function register_mxc_home_widgets() {
    register_widget( 'MXC_Hero_Widget' );
    register_widget( 'MXC_Category_Grid_Widget' );
}
add_action( 'widgets_init', 'register_mxc_home_widgets' );

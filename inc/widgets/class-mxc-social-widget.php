<?php
/**
 * Custom Widget: Social Icons
 */
class MXC_Social_Widget extends WP_Widget {

    function __construct() {
        parent::__construct(
            'mxc_social_widget',
            __( 'MXC: Social Icons', 'metaxchron' ),
            array( 'description' => __( 'Displays social media icons.', 'metaxchron' ), )
        );
    }

    public function widget( $args, $instance ) {
        echo $args['before_widget'];
        if ( ! empty( $instance['title'] ) ) {
            echo $args['before_title'] . apply_filters( 'widget_title', $instance['title'] ) . $args['after_title'];
        }

        echo '<div class="d-flex gap-3 social-widget-icons">';

        $platforms = array( 'facebook', 'twitter', 'instagram', 'linkedin', 'youtube' );
        foreach ( $platforms as $platform ) {
            if ( ! empty( $instance[$platform] ) ) {
                echo '<a href="' . esc_url( $instance[$platform] ) . '" target="_blank" class="text-reset fs-4"><i class="fab fa-' . esc_attr( $platform ) . '"></i></a>';
            }
        }

        echo '</div>';
        echo $args['after_widget'];
    }

    public function form( $instance ) {
        $title = ! empty( $instance['title'] ) ? $instance['title'] : __( 'Follow Us', 'metaxchron' );
        ?>
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php _e( 'Title:', 'metaxchron' ); ?></label>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
        </p>
        <?php
        $platforms = array( 'facebook', 'twitter', 'instagram', 'linkedin', 'youtube' );
        foreach ( $platforms as $platform ) {
            $val = ! empty( $instance[$platform] ) ? $instance[$platform] : '';
            ?>
            <p>
                <label for="<?php echo esc_attr( $this->get_field_id( $platform ) ); ?>"><?php echo ucfirst( $platform ) . ' URL:'; ?></label>
                <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( $platform ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( $platform ) ); ?>" type="url" value="<?php echo esc_attr( $val ); ?>">
            </p>
            <?php
        }
    }

    public function update( $new_instance, $old_instance ) {
        $instance = array();
        $instance['title'] = ( ! empty( $new_instance['title'] ) ) ? sanitize_text_field( $new_instance['title'] ) : '';

        $platforms = array( 'facebook', 'twitter', 'instagram', 'linkedin', 'youtube' );
        foreach ( $platforms as $platform ) {
            $instance[$platform] = ( ! empty( $new_instance[$platform] ) ) ? esc_url_raw( $new_instance[$platform] ) : '';
        }

        return $instance;
    }
}

// Register Widget
function register_mxc_social_widget() {
    register_widget( 'MXC_Social_Widget' );
}
add_action( 'widgets_init', 'register_mxc_social_widget' );

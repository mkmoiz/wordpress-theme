<?php
/**
 * Custom Widget: Ad Block
 */
class MXC_Ad_Widget extends WP_Widget {

    function __construct() {
        parent::__construct(
            'mxc_ad_widget',
            __( 'MXC: Ad Block', 'metaxchron' ),
            array( 'description' => __( 'Display custom ad code.', 'metaxchron' ), )
        );
    }

    public function widget( $args, $instance ) {
        echo $args['before_widget'];
        if ( ! empty( $instance['title'] ) ) {
            echo $args['before_title'] . apply_filters( 'widget_title', $instance['title'] ) . $args['after_title'];
        }

        if ( ! empty( $instance['ad_code'] ) ) {
            echo '<div class="mxc-sidebar-ad text-center">';
            echo $instance['ad_code']; // Output raw code (assumed admin input)
            echo '</div>';
        }

        echo $args['after_widget'];
    }

    public function form( $instance ) {
        $title = ! empty( $instance['title'] ) ? $instance['title'] : '';
        $ad_code = ! empty( $instance['ad_code'] ) ? $instance['ad_code'] : '';
        ?>
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php _e( 'Title (Optional):', 'metaxchron' ); ?></label>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
        </p>
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'ad_code' ) ); ?>"><?php _e( 'Ad Code (HTML/JS):', 'metaxchron' ); ?></label>
            <textarea class="widefat" rows="5" id="<?php echo esc_attr( $this->get_field_id( 'ad_code' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'ad_code' ) ); ?>"><?php echo esc_textarea( $ad_code ); ?></textarea>
        </p>
        <?php
    }

    public function update( $new_instance, $old_instance ) {
        $instance = array();
        $instance['title'] = ( ! empty( $new_instance['title'] ) ) ? sanitize_text_field( $new_instance['title'] ) : '';

        // Allow raw HTML/JS for admins
        if ( current_user_can( 'unfiltered_html' ) ) {
             $instance['ad_code'] = ( ! empty( $new_instance['ad_code'] ) ) ? $new_instance['ad_code'] : '';
        } else {
             $instance['ad_code'] = ( ! empty( $new_instance['ad_code'] ) ) ? wp_kses_post( $new_instance['ad_code'] ) : '';
        }

        return $instance;
    }
}

// Register Widget
function register_mxc_ad_widget() {
    register_widget( 'MXC_Ad_Widget' );
}
add_action( 'widgets_init', 'register_mxc_ad_widget' );

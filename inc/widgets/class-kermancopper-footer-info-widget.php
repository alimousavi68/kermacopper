<?php
/**
 * Footer Info Widget
 *
 * @package KermanCopper
 */

class KermanCopper_Footer_Info_Widget extends WP_Widget {

    /**
     * Register widget with WordPress.
     */
    public function __construct() {
        parent::__construct(
            'kermancopper_footer_info', // Base ID
            __( 'مس کرمان: اطلاعات فوتر', 'kermancopper' ), // Name
            array( 'description' => __( 'نمایش لوگو و توضیحات مختصر در فوتر', 'kermancopper' ), ) // Args
        );
    }

    /**
     * Front-end display of widget.
     *
     * @see WP_Widget::widget()
     *
     * @param array $args     Widget arguments.
     * @param array $instance Saved values from database.
     */
    public function widget( $args, $instance ) {
        echo $args['before_widget'];
        
        $logo_url = ! empty( $instance['logo_url'] ) ? $instance['logo_url'] : get_template_directory_uri() . '/images/sbsm-logo-3.png';
        $description = ! empty( $instance['description'] ) ? $instance['description'] : '';

        ?>
        <div class="flex flex-col items-center text-center">
            <div class="mb-6">
                <img src="<?php echo esc_url( $logo_url ); ?>" alt="Logo" class="h-16 w-auto object-contain">
            </div>
            <?php if ( ! empty( $description ) ) : ?>
                <p class="text-slate-500 text-xs leading-relaxed mb-8 max-w-xs">
                    <?php echo nl2br( esc_html( $description ) ); ?>
                </p>
            <?php endif; ?>
        </div>
        <?php

        echo $args['after_widget'];
    }

    /**
     * Back-end widget form.
     *
     * @see WP_Widget::form()
     *
     * @param array $instance Previously saved values from database.
     */
    public function form( $instance ) {
        $logo_url = ! empty( $instance['logo_url'] ) ? $instance['logo_url'] : '';
        $description = ! empty( $instance['description'] ) ? $instance['description'] : '';
        ?>
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'logo_url' ) ); ?>"><?php esc_html_e( 'آدرس لوگو:', 'kermancopper' ); ?></label> 
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'logo_url' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'logo_url' ) ); ?>" type="text" value="<?php echo esc_attr( $logo_url ); ?>">
            <small><?php esc_html_e( 'اگر خالی باشد، لوگوی پیش‌فرض نمایش داده می‌شود.', 'kermancopper' ); ?></small>
        </p>
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'description' ) ); ?>"><?php esc_html_e( 'توضیحات:', 'kermancopper' ); ?></label> 
            <textarea class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'description' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'description' ) ); ?>" rows="4"><?php echo esc_textarea( $description ); ?></textarea>
        </p>
        <?php 
    }

    /**
     * Sanitize widget form values as they are saved.
     *
     * @see WP_Widget::update()
     *
     * @param array $new_instance Values just sent to be saved.
     * @param array $old_instance Previously saved values from database.
     *
     * @return array Updated safe values to be saved.
     */
    public function update( $new_instance, $old_instance ) {
        $instance = array();
        $instance['logo_url'] = ( ! empty( $new_instance['logo_url'] ) ) ? esc_url_raw( $new_instance['logo_url'] ) : '';
        $instance['description'] = ( ! empty( $new_instance['description'] ) ) ? sanitize_textarea_field( $new_instance['description'] ) : '';

        return $instance;
    }

} // class KermanCopper_Footer_Info_Widget

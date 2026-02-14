<?php
/**
 * Contact Info Widget
 *
 * @package KermanCopper
 */

class KermanCopper_Contact_Info_Widget extends WP_Widget {

    /**
     * Register widget with WordPress.
     */
    public function __construct() {
        parent::__construct(
            'kermancopper_contact_info', // Base ID
            __( 'مس کرمان: اطلاعات تماس', 'kermancopper' ), // Name
            array( 'description' => __( 'نمایش آدرس، تلفن و ایمیل با آیکون', 'kermancopper' ), ) // Args
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
        
        if ( ! empty( $instance['title'] ) ) {
            echo $args['before_title'] . apply_filters( 'widget_title', $instance['title'] ) . $args['after_title'];
        }

        $phone = ! empty( $instance['phone'] ) ? $instance['phone'] : '';
        $phone2 = ! empty( $instance['phone2'] ) ? $instance['phone2'] : '';
        $phone3 = ! empty( $instance['phone3'] ) ? $instance['phone3'] : '';
        $fax = ! empty( $instance['fax'] ) ? $instance['fax'] : '';
        $email = ! empty( $instance['email'] ) ? $instance['email'] : '';
        $address = ! empty( $instance['address'] ) ? $instance['address'] : '';

        ?>
        <ul class="space-y-4 text-slate-500 text-xs">
            <?php if ( ! empty( $phone ) ) : ?>
            <li class="flex items-center gap-2 font-medium justify-start">
                <i data-lucide="phone" class="w-[14px] h-[14px] text-copper shrink-0"></i> 
                <span dir="ltr"><?php echo esc_html( $phone ); ?></span>
            </li>
            <?php endif; ?>

            <?php if ( ! empty( $phone2 ) ) : ?>
            <li class="flex items-center gap-2 font-medium justify-start">
                <i data-lucide="phone" class="w-[14px] h-[14px] text-copper shrink-0"></i> 
                <span dir="ltr"><?php echo esc_html( $phone2 ); ?></span>
            </li>
            <?php endif; ?>

            <?php if ( ! empty( $phone3 ) ) : ?>
            <li class="flex items-center gap-2 font-medium justify-start">
                <i data-lucide="phone" class="w-[14px] h-[14px] text-copper shrink-0"></i> 
                <span dir="ltr"><?php echo esc_html( $phone3 ); ?></span>
            </li>
            <?php endif; ?>

            <?php if ( ! empty( $fax ) ) : ?>
            <li class="flex items-center gap-2 font-medium justify-start">
                <i data-lucide="printer" class="w-[14px] h-[14px] text-copper shrink-0"></i> 
                <span dir="ltr"><?php echo esc_html( $fax ); ?></span>
            </li>
            <?php endif; ?>

            <?php if ( ! empty( $email ) ) : ?>
            <li class="flex items-center gap-2">
                <i data-lucide="mail" class="w-[14px] h-[14px] text-copper shrink-0"></i> 
                <?php echo esc_html( $email ); ?>
            </li>
            <?php endif; ?>

            <?php if ( ! empty( $address ) ) : ?>
            <li class="flex items-start gap-2 leading-relaxed">
                <i data-lucide="map-pin" class="w-[14px] h-[14px] text-copper mt-0.5 flex-shrink-0"></i> 
                <?php echo esc_html( $address ); ?>
            </li>
            <?php endif; ?>
        </ul>
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
        $title = ! empty( $instance['title'] ) ? $instance['title'] : __( 'ارتباط با ما', 'kermancopper' );
        $phone = ! empty( $instance['phone'] ) ? $instance['phone'] : '';
        $phone2 = ! empty( $instance['phone2'] ) ? $instance['phone2'] : '';
        $phone3 = ! empty( $instance['phone3'] ) ? $instance['phone3'] : '';
        $fax = ! empty( $instance['fax'] ) ? $instance['fax'] : '';
        $email = ! empty( $instance['email'] ) ? $instance['email'] : '';
        $address = ! empty( $instance['address'] ) ? $instance['address'] : '';
        ?>
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_html_e( 'عنوان:', 'kermancopper' ); ?></label> 
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
        </p>
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'phone' ) ); ?>"><?php esc_html_e( 'تلفن ۱:', 'kermancopper' ); ?></label> 
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'phone' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'phone' ) ); ?>" type="text" value="<?php echo esc_attr( $phone ); ?>">
        </p>
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'phone2' ) ); ?>"><?php esc_html_e( 'تلفن ۲:', 'kermancopper' ); ?></label> 
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'phone2' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'phone2' ) ); ?>" type="text" value="<?php echo esc_attr( $phone2 ); ?>">
        </p>
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'phone3' ) ); ?>"><?php esc_html_e( 'تلفن ۳:', 'kermancopper' ); ?></label> 
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'phone3' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'phone3' ) ); ?>" type="text" value="<?php echo esc_attr( $phone3 ); ?>">
        </p>
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'fax' ) ); ?>"><?php esc_html_e( 'فکس:', 'kermancopper' ); ?></label> 
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'fax' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'fax' ) ); ?>" type="text" value="<?php echo esc_attr( $fax ); ?>">
        </p>
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'email' ) ); ?>"><?php esc_html_e( 'ایمیل:', 'kermancopper' ); ?></label> 
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'email' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'email' ) ); ?>" type="text" value="<?php echo esc_attr( $email ); ?>">
        </p>
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'address' ) ); ?>"><?php esc_html_e( 'آدرس:', 'kermancopper' ); ?></label> 
            <textarea class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'address' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'address' ) ); ?>" rows="3"><?php echo esc_textarea( $address ); ?></textarea>
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
        $instance['title'] = ( ! empty( $new_instance['title'] ) ) ? sanitize_text_field( $new_instance['title'] ) : '';
        $instance['phone'] = ( ! empty( $new_instance['phone'] ) ) ? sanitize_text_field( $new_instance['phone'] ) : '';
        $instance['phone2'] = ( ! empty( $new_instance['phone2'] ) ) ? sanitize_text_field( $new_instance['phone2'] ) : '';
        $instance['phone3'] = ( ! empty( $new_instance['phone3'] ) ) ? sanitize_text_field( $new_instance['phone3'] ) : '';
        $instance['fax'] = ( ! empty( $new_instance['fax'] ) ) ? sanitize_text_field( $new_instance['fax'] ) : '';
        $instance['email'] = ( ! empty( $new_instance['email'] ) ) ? sanitize_email( $new_instance['email'] ) : '';
        $instance['address'] = ( ! empty( $new_instance['address'] ) ) ? sanitize_textarea_field( $new_instance['address'] ) : '';

        return $instance;
    }

} // class KermanCopper_Contact_Info_Widget

<?php
/**
 * Map Location Widget
 *
 * @package KermanCopper
 */

class KermanCopper_Map_Widget extends WP_Widget {

    /**
     * Register widget with WordPress.
     */
    public function __construct() {
        parent::__construct(
            'kermancopper_map_widget', // Base ID
            __( 'مس کرمان: موقعیت مکانی (نقشه)', 'kermancopper' ), // Name
            array( 'description' => __( 'نمایش تصویر نقشه به همراه دکمه مسیریابی و آدرس کوتاه', 'kermancopper' ), ) // Args
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
            echo  apply_filters( 'widget_title', $instance['title'] ) ;
        }

        $image_url = ! empty( $instance['image_url'] ) ? $instance['image_url'] : '';
        $map_link = ! empty( $instance['map_link'] ) ? $instance['map_link'] : '#';
        $address = ! empty( $instance['address'] ) ? $instance['address'] : '';
        $phone = ! empty( $instance['phone'] ) ? $instance['phone'] : '';

        ?>
        <div class="flex flex-col gap-4">
            <!-- Map Image Container -->
            <a href="<?php echo esc_url( $map_link ); ?>" target="_blank" class="block relative group overflow-hidden rounded-xl border border-slate-200 shadow-sm hover:shadow-md transition-all duration-300">
                <?php if ( $image_url ) : ?>
                    <img src="<?php echo esc_url( $image_url ); ?>" alt="Map Location" class="w-full h-40 object-cover transform group-hover:scale-105 transition-transform duration-500">
                <?php else : ?>
                    <div class="w-full h-40 bg-slate-100 flex items-center justify-center text-slate-400">
                        <i data-lucide="map" class="w-8 h-8 opacity-50"></i>
                    </div>
                <?php endif; ?>
                
                <!-- Overlay Button -->
                <div class="absolute inset-0 bg-black/20 opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-center justify-center">
                    <span class="bg-white text-copper px-4 py-2 rounded-lg text-xs font-bold shadow-lg transform translate-y-2 group-hover:translate-y-0 transition-transform duration-300 flex items-center gap-2">
                        <i data-lucide="navigation" class="w-3 h-3"></i>
                        مسیریابی
                    </span>
                </div>
            </a>

            <!-- Info -->
            <div class="space-y-3">
                <?php if ( $address ) : ?>
                <div class="flex items-start gap-2 text-xs text-slate-500 leading-relaxed">
                    <i data-lucide="map-pin" class="w-4 h-4 text-copper shrink-0 mt-0.5"></i>
                    <span><?php echo esc_html( $address ); ?></span>
                </div>
                <?php endif; ?>

                <?php if ( $phone ) : ?>
                <div class="flex items-center gap-2 text-xs text-slate-500 font-medium">
                    <i data-lucide="phone" class="w-4 h-4 text-copper shrink-0"></i>
                    <a href="tel:<?php echo esc_attr( $phone ); ?>" class="hover:text-copper transition-colors" dir="ltr"><?php echo esc_html( $phone ); ?></a>
                </div>
                <?php endif; ?>
            </div>
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
        $title = ! empty( $instance['title'] ) ? $instance['title'] : '';
        $image_url = ! empty( $instance['image_url'] ) ? $instance['image_url'] : '';
        $map_link = ! empty( $instance['map_link'] ) ? $instance['map_link'] : '';
        $address = ! empty( $instance['address'] ) ? $instance['address'] : '';
        $phone = ! empty( $instance['phone'] ) ? $instance['phone'] : '';
        ?>
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_attr_e( 'Title:', 'kermancopper' ); ?></label> 
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
        </p>
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'image_url' ) ); ?>"><?php esc_attr_e( 'Image URL:', 'kermancopper' ); ?></label> 
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'image_url' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'image_url' ) ); ?>" type="text" value="<?php echo esc_attr( $image_url ); ?>">
            <small>لینک مستقیم تصویر نقشه را وارد کنید.</small>
        </p>
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'map_link' ) ); ?>"><?php esc_attr_e( 'Map Link (Google Maps/Neshan):', 'kermancopper' ); ?></label> 
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'map_link' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'map_link' ) ); ?>" type="text" value="<?php echo esc_attr( $map_link ); ?>">
        </p>
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'address' ) ); ?>"><?php esc_attr_e( 'Short Address:', 'kermancopper' ); ?></label> 
            <textarea class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'address' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'address' ) ); ?>" rows="3"><?php echo esc_attr( $address ); ?></textarea>
        </p>
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'phone' ) ); ?>"><?php esc_attr_e( 'Main Phone (Optional):', 'kermancopper' ); ?></label> 
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'phone' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'phone' ) ); ?>" type="text" value="<?php echo esc_attr( $phone ); ?>">
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
        $instance['image_url'] = ( ! empty( $new_instance['image_url'] ) ) ? esc_url_raw( $new_instance['image_url'] ) : '';
        $instance['map_link'] = ( ! empty( $new_instance['map_link'] ) ) ? esc_url_raw( $new_instance['map_link'] ) : '';
        $instance['address'] = ( ! empty( $new_instance['address'] ) ) ? sanitize_textarea_field( $new_instance['address'] ) : '';
        $instance['phone'] = ( ! empty( $new_instance['phone'] ) ) ? sanitize_text_field( $new_instance['phone'] ) : '';

        return $instance;
    }

}

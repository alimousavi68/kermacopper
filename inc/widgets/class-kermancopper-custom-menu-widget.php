<?php
/**
 * Custom Menu Widget
 *
 * @package KermanCopper
 */

class KermanCopper_Custom_Menu_Widget extends WP_Widget {

    /**
     * Register widget with WordPress.
     */
    public function __construct() {
        parent::__construct(
            'kermancopper_custom_menu', // Base ID
            __( 'مس کرمان: فهرست سفارشی', 'kermancopper' ), // Name
            array( 'description' => __( 'نمایش فهرست‌های وردپرس با استایل فوتر قالب', 'kermancopper' ), ) // Args
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
        $nav_menu = ! empty( $instance['nav_menu'] ) ? wp_get_nav_menu_object( $instance['nav_menu'] ) : false;
        $layout = ! empty( $instance['layout'] ) ? $instance['layout'] : 'vertical';
        $layout = $layout === 'horizontal' ? 'horizontal' : 'vertical';

        if ( ! $nav_menu ) {
            return;
        }

        echo $args['before_widget'];
        
        $title = ! empty( $instance['title'] ) ? $instance['title'] : '';
        

        if ( ! empty( $title ) ) {
            echo $args['before_title'] . apply_filters( 'widget_title', $title ) . $args['after_title'];
        }

        $menu_class = $layout === 'horizontal'
            ? 'flex flex-wrap items-center justify-between gap-y-3 text-slate-500 text-xs sm:text-sm md:text-base divide-x divide-slate-200/60 divide-x-reverse'
            : 'space-y-4 text-slate-500 text-xs';

        $nav_menu_args = array(
            'fallback_cb' => '',
            'menu'        => $nav_menu,
            'container'   => false,
            'menu_class'  => $menu_class,
            'link_before' => '',
            'link_after'  => '',
            'depth'       => 1, // Limit to level 1 items only
        );

        $this->current_layout = $layout;
        add_filter( 'nav_menu_link_attributes', array( $this, 'add_link_classes' ), 10, 4 );
        add_filter( 'nav_menu_css_class', array( $this, 'add_item_classes' ), 10, 4 );
        
        wp_nav_menu( $nav_menu_args );
        
        remove_filter( 'nav_menu_link_attributes', array( $this, 'add_link_classes' ), 10, 4 );
        remove_filter( 'nav_menu_css_class', array( $this, 'add_item_classes' ), 10, 4 );
        $this->current_layout = null;

        echo $args['after_widget'];
    }
    
    public function add_link_classes( $atts, $item, $args, $depth ) {
        $layout = isset( $this->current_layout ) ? $this->current_layout : 'vertical';
        $base_class = $layout === 'horizontal'
            ? 'inline-flex items-center'
            : 'block';
        if ( empty( $atts['class'] ) ) {
            $atts['class'] = $base_class . ' hover:text-copper transition-colors';
        } else {
            $atts['class'] .= ' ' . $base_class . ' hover:text-copper transition-colors';
        }
        return $atts;
    }

    public function add_item_classes( $classes, $item, $args, $depth ) {
        $layout = isset( $this->current_layout ) ? $this->current_layout : 'vertical';
        if ( $layout === 'horizontal' ) {
            $classes[] = 'px-3';
        }
        return $classes;
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
        $nav_menu = isset( $instance['nav_menu'] ) ? $instance['nav_menu'] : '';
        $layout = ! empty( $instance['layout'] ) ? $instance['layout'] : 'vertical';

        // Get menus
        $menus = wp_get_nav_menus();
        ?>
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_html_e( 'عنوان:', 'kermancopper' ); ?></label> 
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
        </p>
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'nav_menu' ) ); ?>"><?php esc_html_e( 'انتخاب فهرست:', 'kermancopper' ); ?></label>
            <select id="<?php echo esc_attr( $this->get_field_id( 'nav_menu' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'nav_menu' ) ); ?>">
                <option value="0"><?php _e( '&mdash; انتخاب کنید &mdash;', 'kermancopper' ); ?></option>
                <?php foreach ( $menus as $menu ) : ?>
                    <option value="<?php echo esc_attr( $menu->term_id ); ?>" <?php selected( $nav_menu, $menu->term_id ); ?>>
                        <?php echo esc_html( $menu->name ); ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </p>
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'layout' ) ); ?>"><?php esc_html_e( 'چیدمان نمایش:', 'kermancopper' ); ?></label>
            <select id="<?php echo esc_attr( $this->get_field_id( 'layout' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'layout' ) ); ?>">
                <option value="vertical" <?php selected( $layout, 'vertical' ); ?>><?php esc_html_e( 'عمودی', 'kermancopper' ); ?></option>
                <option value="horizontal" <?php selected( $layout, 'horizontal' ); ?>><?php esc_html_e( 'افقی', 'kermancopper' ); ?></option>
            </select>
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
        $instance['nav_menu'] = ( ! empty( $new_instance['nav_menu'] ) ) ? (int) $new_instance['nav_menu'] : 0;
        $instance['layout'] = ( ! empty( $new_instance['layout'] ) && $new_instance['layout'] === 'horizontal' ) ? 'horizontal' : 'vertical';

        return $instance;
    }

} // class KermanCopper_Custom_Menu_Widget

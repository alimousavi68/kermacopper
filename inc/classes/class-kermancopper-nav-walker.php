<?php
/**
 * Custom Nav Walker for KermanCopper Theme
 *
 * @package KermanCopper
 */

class KermanCopper_Nav_Walker extends Walker_Nav_Menu {

    /**
     * Starts the list before the elements are added.
     *
     * @param string $output Used to append additional content (passed by reference).
     * @param int    $depth  Depth of menu item. Used for padding.
     * @param array  $args   An object of wp_nav_menu() arguments.
     */
    public function start_lvl( &$output, $depth = 0, $args = null ) {
        if ( $depth === 0 ) {
            // Dropdown Container
            // We use ul tag but style it to match the theme's dropdown design
            $output .= '<ul class="sub-menu absolute right-0 top-full mt-0 w-56 bg-copper text-white shadow-xl z-[100] rounded-sm opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-300 transform translate-y-2 group-hover:translate-y-0 py-1">';
        } else {
            // Deeper levels (fallback)
            $output .= '<ul class="sub-menu">';
        }
    }

    /**
     * Ends the list of after the elements are added.
     *
     * @param string $output Used to append additional content (passed by reference).
     * @param int    $depth  Depth of menu item. Used for padding.
     * @param array  $args   An object of wp_nav_menu() arguments.
     */
    public function end_lvl( &$output, $depth = 0, $args = null ) {
        $output .= '</ul>';
    }

    /**
     * Starts the element output.
     *
     * @param string $output Used to append additional content (passed by reference).
     * @param WP_Post $item  Menu item data object.
     * @param int     $depth Depth of menu item. Used for padding.
     * @param array   $args  An object of wp_nav_menu() arguments.
     * @param int     $id    Current item ID.
     */
    public function start_el( &$output, $item, $depth = 0, $args = null, $id = 0 ) {
        $classes = empty( $item->classes ) ? array() : (array) $item->classes;
        $has_children = in_array( 'menu-item-has-children', $classes );

        // --- DEPTH 0: Top Level ---
        if ( $depth === 0 ) {
            // Removed py-4 from li, will add to a for better hit area and relative positioning context
            $classes[] = 'relative group menu-item-' . $item->ID;
            
            // Filter classes
            $class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item, $args, $depth ) );
            $class_names = $class_names ? ' class="' . esc_attr( $class_names ) . ' flex items-center"' : ' class="flex items-center"';

            $output .= '<li' . $class_names . '>';

            // Link Attributes
            $atts = array();
            $atts['title']  = ! empty( $item->attr_title ) ? $item->attr_title : '';
            $atts['target'] = ! empty( $item->target )     ? $item->target     : '';
            $atts['rel']    = ! empty( $item->xfn )        ? $item->xfn        : '';
            $atts['href']   = ! empty( $item->url )        ? $item->url        : '';
            
            // Link Classes
            // Added relative and py-4 here
            $base_link_class = 'nav-link flex items-center gap-1 transition-colors duration-200 relative py-4';
            if ( in_array( 'current-menu-item', $classes ) || in_array( 'current-menu-parent', $classes ) ) {
                $base_link_class .= ' text-copper';
            } else {
                $base_link_class .= ' hover:text-copper';
            }
            $atts['class'] = $base_link_class;

            $atts = apply_filters( 'nav_menu_link_attributes', $atts, $item, $args, $depth );
            $attributes = '';
            foreach ( $atts as $attr => $value ) {
                if ( ! empty( $value ) ) {
                    $value = ( 'href' === $attr ) ? esc_url( $value ) : esc_attr( $value );
                    $attributes .= ' ' . $attr . '="' . $value . '"';
                }
            }

            $title = apply_filters( 'the_title', $item->title, $item->ID );
            $title = apply_filters( 'nav_menu_item_title', $title, $item, $args, $depth );

            $item_output = $args->before;
            $item_output .= '<a' . $attributes . '>';
            $item_output .= $args->link_before . $title . $args->link_after;
            
            // Add Chevron if has children
            if ( $has_children ) {
                $item_output .= '<i data-lucide="chevron-down" class="w-2.5 h-2.5 opacity-50"></i>';
            }
            
            // Underline (Moved inside a tag)
            $opacity_class = ( in_array( 'current-menu-item', $classes ) ) ? 'opacity-100' : 'opacity-0 group-hover:opacity-100';
            // Adjusted bottom-1 (0.25rem = 4px) relative to a (which has py-4 = 16px padding).
            // Text is vertically centered. bottom-1 is 4px from bottom edge of a.
            // Since a is taller now, bottom-1 puts the line near the bottom of the padding area.
            $item_output .= '<div class="nav-underline absolute bottom-1 left-1/2 -translate-x-1/2 h-[2.5px] bg-copper w-1/2 rounded-full transition-all duration-300 ' . $opacity_class . '"></div>';

            $item_output .= '</a>';
            
            // Separator
            $item_output .= '<span class="menu-separator text-slate-200 mx-8 xl:mx-12">|</span>';

            $item_output .= $args->after;

            $output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );

        } 
        // --- DEPTH 1+: Submenu Items ---
        else {
            // Filter classes for submenu items
            $classes[] = 'menu-item-' . $item->ID;
            $class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item, $args, $depth ) );
            $class_names = $class_names ? ' class="' . esc_attr( $class_names ) . '"' : '';

            $output .= '<li' . $class_names . '>';

            // Link Attributes
            $atts = array();
            $atts['title']  = ! empty( $item->attr_title ) ? $item->attr_title : '';
            $atts['target'] = ! empty( $item->target )     ? $item->target     : '';
            $atts['rel']    = ! empty( $item->xfn )        ? $item->xfn        : '';
            $atts['href']   = ! empty( $item->url )        ? $item->url        : '';

            // Submenu Link Classes
            $atts['class'] = 'block px-6 py-3 hover:bg-black/10 transition-colors font-light text-[13px] border-b border-white/5 last:border-0 text-white';

            $atts = apply_filters( 'nav_menu_link_attributes', $atts, $item, $args, $depth );
            $attributes = '';
            foreach ( $atts as $attr => $value ) {
                if ( ! empty( $value ) ) {
                    $value = ( 'href' === $attr ) ? esc_url( $value ) : esc_attr( $value );
                    $attributes .= ' ' . $attr . '="' . $value . '"';
                }
            }

            $title = apply_filters( 'the_title', $item->title, $item->ID );
            $title = apply_filters( 'nav_menu_item_title', $title, $item, $args, $depth );

            $item_output = $args->before;
            $item_output .= '<a' . $attributes . '>';
            $item_output .= $args->link_before . $title . $args->link_after;
            $item_output .= '</a>';
            $item_output .= $args->after;

            $output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
        }
    }

    public function end_el( &$output, $item, $depth = 0, $args = null ) {
        $output .= "</li>";
    }
}

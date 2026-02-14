<?php
/**
 * Theme Functions
 *
 * @package KermanCopper
 */

// Define Constants
define( 'KERMANCOPPER_DIR', get_template_directory() );
define( 'KERMANCOPPER_URI', get_template_directory_uri() );

// Load Walker
require_once KERMANCOPPER_DIR . '/inc/classes/class-kermancopper-nav-walker.php';

// Load Customizer
require_once KERMANCOPPER_DIR . '/inc/customizer/loader.php';

// Setup Theme
function kermancopper_setup() {
    add_theme_support( 'title-tag' );
    add_theme_support( 'post-thumbnails' );
    add_theme_support( 'custom-logo' );
    add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption' ) );
    
    register_nav_menus( array(
        'primary' => __( 'Primary Menu', 'kermancopper' ),
        'footer'  => __( 'Footer Menu', 'kermancopper' ),
    ) );
}
add_action( 'after_setup_theme', 'kermancopper_setup' );

// Register Widget Areas
function kermancopper_widgets_init() {
    register_sidebar( array(
        'name'          => __( 'Footer 1', 'kermancopper' ),
        'id'            => 'footer-1',
        'description'   => __( 'Add widgets here to appear in your footer column 1.', 'kermancopper' ),
        'before_widget' => '<div id="%1$s" class="widget %2$s mb-8 flex flex-col items-center text-center">',
        'after_widget'  => '</div>',
        'before_title'  => '<h4 class="font-bold text-slate-900 mb-6 text-sm border-r-2 border-copper pr-2">',
        'after_title'   => '</h4>',
    ) );

    register_sidebar( array(
        'name'          => __( 'Footer 2', 'kermancopper' ),
        'id'            => 'footer-2',
        'description'   => __( 'Add widgets here to appear in your footer column 2.', 'kermancopper' ),
        'before_widget' => '<div id="%1$s" class="widget %2$s mb-8">',
        'after_widget'  => '</div>',
        'before_title'  => '<h4 class="font-bold text-slate-900 mb-6 text-sm border-r-2 border-copper pr-2">',
        'after_title'   => '</h4>',
    ) );

    register_sidebar( array(
        'name'          => __( 'Footer 3', 'kermancopper' ),
        'id'            => 'footer-3',
        'description'   => __( 'Add widgets here to appear in your footer column 3.', 'kermancopper' ),
        'before_widget' => '<div id="%1$s" class="widget %2$s mb-8">',
        'after_widget'  => '</div>',
        'before_title'  => '<h4 class="font-bold text-slate-900 mb-6 text-sm border-r-2 border-copper pr-2">',
        'after_title'   => '</h4>',
    ) );

    register_sidebar( array(
        'name'          => __( 'Footer 4', 'kermancopper' ),
        'id'            => 'footer-4',
        'description'   => __( 'Add widgets here to appear in your footer column 4.', 'kermancopper' ),
        'before_widget' => '<div id="%1$s" class="widget %2$s mb-8">',
        'after_widget'  => '</div>',
        'before_title'  => '<h4 class="font-bold text-slate-900 mb-6 text-sm border-r-2 border-copper pr-2">',
        'after_title'   => '</h4>',
    ) );

    register_sidebar( array(
        'name'          => __( 'Homepage News Below', 'kermancopper' ),
        'id'            => 'home-news-below',
        'description'   => __( 'Widgets below the latest news section on the homepage.', 'kermancopper' ),
        'before_widget' => '<div id="%1$s" class="widget %2$s w-full mb-10">',
        'after_widget'  => '</div>',
        'before_title'  => '<h4 class="font-bold text-slate-900 mb-6 text-sm border-r-2 border-copper pr-2">',
        'after_title'   => '</h4>',
    ) );
}
add_action( 'widgets_init', 'kermancopper_widgets_init' );

// Register Custom Widgets
function kermancopper_register_widgets() {
    // Load Widgets
    require_once get_template_directory() . '/inc/widgets/class-kermancopper-footer-info-widget.php';
    require_once get_template_directory() . '/inc/widgets/class-kermancopper-custom-menu-widget.php';
    require_once get_template_directory() . '/inc/widgets/class-kermancopper-contact-info-widget.php';
    require_once get_template_directory() . '/inc/widgets/class-kermancopper-map-widget.php';
    require_once get_template_directory() . '/inc/widgets/class-kermancopper-news-events-widget.php';

    register_widget( 'KermanCopper_Footer_Info_Widget' );
    register_widget( 'KermanCopper_Custom_Menu_Widget' );
    register_widget( 'KermanCopper_Contact_Info_Widget' );
    register_widget( 'KermanCopper_Map_Widget' );
    register_widget( 'KermanCopper_News_Events_Widget' );
}
add_action( 'widgets_init', 'kermancopper_register_widgets' );

function kermancopper_track_post_views() {
    if ( is_admin() ) {
        return;
    }
    if ( ! is_singular( 'post' ) ) {
        return;
    }
    $post_id = get_queried_object_id();
    if ( ! $post_id ) {
        return;
    }
    $meta_key = 'post_views';
    $views = (int) get_post_meta( $post_id, $meta_key, true );
    $views++;
    update_post_meta( $post_id, $meta_key, $views );
}
add_action( 'wp', 'kermancopper_track_post_views' );

// Enqueue Scripts
function kermancopper_scripts() {
    wp_enqueue_style( 'kermancopper-style', get_stylesheet_uri() );
    
    // Libs
    wp_enqueue_script( 'tailwindcss', get_template_directory_uri() . '/libs/tailwindcss.js', array(), '3.4.1', false );
    wp_enqueue_script( 'lucide', get_template_directory_uri() . '/libs/lucide.js', array(), '0.344.0', true );
    
    // Main Script
    wp_enqueue_script( 'kermancopper-main', get_template_directory_uri() . '/assets/js/main.js', array('lucide'), '1.0.0', true );
}
add_action( 'wp_enqueue_scripts', 'kermancopper_scripts' );

function kermancopper_get_home_setting( $key ) {
    return get_theme_mod( $key );
}

function kermancopper_sync_home_archive_urls() {
    $news_category = (int) get_theme_mod( 'kermancopper_home_news_category' );
    $notices_category = (int) get_theme_mod( 'kermancopper_home_notices_category' );
    if ( $news_category > 0 ) {
        set_theme_mod( 'kermancopper_home_news_archive_url', get_category_link( $news_category ) );
    } else {
        remove_theme_mod( 'kermancopper_home_news_archive_url' );
    }
    if ( $notices_category > 0 ) {
        set_theme_mod( 'kermancopper_home_notices_archive_url', get_category_link( $notices_category ) );
    } else {
        remove_theme_mod( 'kermancopper_home_notices_archive_url' );
    }
}
add_action( 'customize_save_after', 'kermancopper_sync_home_archive_urls' );

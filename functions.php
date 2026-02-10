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

// Enqueue Scripts
function kermancopper_scripts() {
    wp_enqueue_style( 'kermancopper-style', get_stylesheet_uri() );
    
    // Libs
    wp_enqueue_script( 'tailwindcss', get_template_directory_uri() . '/libs/tailwindcss.js', array(), '3.4.1', false );
    wp_enqueue_script( 'lucide', get_template_directory_uri() . '/libs/lucide.js', array(), '0.344.0', false );
    
    // Main Script
    wp_enqueue_script( 'kermancopper-main', get_template_directory_uri() . '/assets/js/main.js', array('lucide'), '1.0.0', true );
}
add_action( 'wp_enqueue_scripts', 'kermancopper_scripts' );

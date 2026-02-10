<?php
/**
 * Header Settings Panel
 *
 * @package KermanCopper
 */

/**
 * Register Header Controls
 * 
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function kermancopper_customize_header( $wp_customize ) {
    
    // Panel: Header Settings
    $wp_customize->add_panel( 'kermancopper_header_panel', array(
        'title'       => __( 'تنظیمات هدر', 'kermancopper' ),
        'priority'    => 20,
        'description' => __( 'مدیریت نوار بالایی، لوگو و شبکه‌های اجتماعی', 'kermancopper' ),
    ) );

    // Section: Top Bar Info
    $wp_customize->add_section( 'kermancopper_topbar_section', array(
        'title'    => __( 'نوار اطلاعات (Top Bar)', 'kermancopper' ),
        'panel'    => 'kermancopper_header_panel',
        'priority' => 10,
    ) );

    // Setting: Show Top Bar
    $wp_customize->add_setting( 'kermancopper_show_topbar', array(
        'default'           => true,
        'sanitize_callback' => 'kermancopper_sanitize_checkbox',
    ) );
    $wp_customize->add_control( 'kermancopper_show_topbar', array(
        'label'    => __( 'نمایش نوار بالایی', 'kermancopper' ),
        'section'  => 'kermancopper_topbar_section',
        'type'     => 'checkbox',
    ) );

    // Setting: Address
    $wp_customize->add_setting( 'kermancopper_address', array(
        'default'           => 'تهران، سعادت آباد، خیابان مروارید ۲۶۴۹',
        'sanitize_callback' => 'kermancopper_sanitize_text',
        'transport'         => 'postMessage',
    ) );
    $wp_customize->add_control( 'kermancopper_address', array(
        'label'    => __( 'آدرس شرکت', 'kermancopper' ),
        'section'  => 'kermancopper_topbar_section',
        'type'     => 'text',
    ) );

    // Setting: Email
    $wp_customize->add_setting( 'kermancopper_email', array(
        'default'           => 'info@copperindustry.com',
        'sanitize_callback' => 'sanitize_email',
        'transport'         => 'postMessage',
    ) );
    $wp_customize->add_control( 'kermancopper_email', array(
        'label'    => __( 'ایمیل تماس', 'kermancopper' ),
        'section'  => 'kermancopper_topbar_section',
        'type'     => 'text',
    ) );

    // Section: Social Media
    $wp_customize->add_section( 'kermancopper_social_section', array(
        'title'    => __( 'شبکه‌های اجتماعی', 'kermancopper' ),
        'panel'    => 'kermancopper_header_panel',
        'priority' => 20,
    ) );

    $socials = array(
        'instagram' => 'اینستاگرام',
        'linkedin'  => 'لینکدین',
        'twitter'   => 'توییتر (ایکس)',
        'facebook'  => 'فیسبوک',
    );

    foreach ( $socials as $key => $label ) {
        $wp_customize->add_setting( "kermancopper_social_{$key}", array(
            'default'           => '',
            'sanitize_callback' => 'esc_url_raw',
        ) );
        $wp_customize->add_control( "kermancopper_social_{$key}", array(
            'label'    => __( "لینک {$label}", 'kermancopper' ),
            'section'  => 'kermancopper_social_section',
            'type'     => 'url',
        ) );
    }
}
add_action( 'customize_register', 'kermancopper_customize_header' );

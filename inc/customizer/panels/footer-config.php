<?php
/**
 * Footer Settings Panel
 *
 * @package KermanCopper
 */

function kermancopper_customize_footer( $wp_customize ) {

    // Panel: Footer
    $wp_customize->add_panel( 'kermancopper_footer_panel', array(
        'title'       => __( 'تنظیمات فوتر', 'kermancopper' ),
        'priority'    => 40,
        'description' => __( 'مدیریت بخش‌های فوتر', 'kermancopper' ),
    ) );

    // Section: Copyright
    $wp_customize->add_section( 'kermancopper_copyright_section', array(
        'title'    => __( 'متن کپی‌رایت', 'kermancopper' ),
        'panel'    => 'kermancopper_footer_panel',
        'priority' => 10,
        'description' => __( 'برای مدیریت ابزارک‌های ستون‌های فوتر، لطفاً به بخش "ابزارک‌ها" (Widgets) در منوی اصلی سفارشی‌سازی مراجعه کنید. برای تنظیم لینک‌های شبکه‌های اجتماعی، به بخش "شبکه‌های اجتماعی" مراجعه کنید.', 'kermancopper' ),
    ) );

    // Setting: Copyright Text
    $wp_customize->add_setting( 'kermancopper_copyright_text', array(
        'default'           => '© ۱۴۰۲ کلیه حقوق مادی و معنوی این سایت متعلق به شرکت صنایع مس می‌باشد.',
        'sanitize_callback' => 'wp_kses_post',
        'transport'         => 'postMessage',
    ) );
    $wp_customize->add_control( 'kermancopper_copyright_text', array(
        'label'    => __( 'متن کپی‌رایت', 'kermancopper' ),
        'section'  => 'kermancopper_copyright_section',
        'type'     => 'textarea',
    ) );

    // Setting: Social Media in Footer
    $wp_customize->add_setting( 'kermancopper_show_footer_socials', array(
        'default'           => true,
        'sanitize_callback' => 'kermancopper_sanitize_checkbox',
    ) );
    $wp_customize->add_control( 'kermancopper_show_footer_socials', array(
        'label'    => __( 'نمایش شبکه‌های اجتماعی در فوتر', 'kermancopper' ),
        'section'  => 'kermancopper_copyright_section',
        'type'     => 'checkbox',
        'description' => __( 'لینک‌ها از تنظیمات هدر خوانده می‌شوند.', 'kermancopper' ),
    ) );

}
add_action( 'customize_register', 'kermancopper_customize_footer' );

<?php
/**
 * Colors Settings Panel
 *
 * @package KermanCopper
 */

function kermancopper_customize_colors( $wp_customize ) {

    // Panel: Colors
    $wp_customize->add_panel( 'kermancopper_colors_panel', array(
        'title'       => __( 'تنظیمات رنگ‌ها', 'kermancopper' ),
        'priority'    => 30,
        'description' => __( 'مدیریت رنگ‌های اصلی قالب', 'kermancopper' ),
    ) );

    // Section: Global Colors
    $wp_customize->add_section( 'kermancopper_global_colors', array(
        'title'    => __( 'رنگ‌های عمومی', 'kermancopper' ),
        'panel'    => 'kermancopper_colors_panel',
        'priority' => 10,
    ) );

    // Copper Color
    $wp_customize->add_setting( 'kermancopper_color_copper', array(
        'default'           => '#C8682F',
        'sanitize_callback' => 'sanitize_hex_color',
        'transport'         => 'refresh',
    ) );
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'kermancopper_color_copper', array(
        'label'       => __( 'رنگ اصلی (مسی)', 'kermancopper' ),
        'description' => __( 'این رنگ در دکمه‌ها، آیکون‌ها، هاورها و بخش‌های اصلی استفاده می‌شود.', 'kermancopper' ),
        'section'     => 'kermancopper_global_colors',
    ) ) );

    // Navy Color
    $wp_customize->add_setting( 'kermancopper_color_navy', array(
        'default'           => '#1A2235',
        'sanitize_callback' => 'sanitize_hex_color',
        'transport'         => 'refresh',
    ) );
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'kermancopper_color_navy', array(
        'label'       => __( 'رنگ سرمه‌ای (تیره)', 'kermancopper' ),
        'description' => __( 'این رنگ در پس‌زمینه بخش قهرمان، فوتر و تیترهای اصلی استفاده می‌شود.', 'kermancopper' ),
        'section'     => 'kermancopper_global_colors',
    ) ) );

    // Copper Light
    $wp_customize->add_setting( 'kermancopper_color_copper_light', array(
        'default'           => '#E28652',
        'sanitize_callback' => 'sanitize_hex_color',
        'transport'         => 'refresh',
    ) );
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'kermancopper_color_copper_light', array(
        'label'       => __( 'مسی روشن', 'kermancopper' ),
        'description' => __( 'رنگ روشن‌تر مسی برای ایجاد سایه‌ها، گرادیانت‌ها و حالت‌های ثانویه.', 'kermancopper' ),
        'section'     => 'kermancopper_global_colors',
    ) ) );

    // Body Background
    $wp_customize->add_setting( 'kermancopper_color_bg_body', array(
        'default'           => '#FAF8F5',
        'sanitize_callback' => 'sanitize_hex_color',
        'transport'         => 'refresh',
    ) );
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'kermancopper_color_bg_body', array(
        'label'       => __( 'رنگ پس‌زمینه بدنه', 'kermancopper' ),
        'description' => __( 'رنگ پایه پس‌زمینه صفحات (پیش‌فرض: کرم بسیار روشن).', 'kermancopper' ),
        'section'     => 'kermancopper_global_colors',
    ) ) );

    // Text Main
    $wp_customize->add_setting( 'kermancopper_color_text_main', array(
        'default'           => '#0F1724',
        'sanitize_callback' => 'sanitize_hex_color',
        'transport'         => 'refresh',
    ) );
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'kermancopper_color_text_main', array(
        'label'    => __( 'رنگ متن اصلی', 'kermancopper' ),
        'section'  => 'kermancopper_global_colors',
    ) ) );

}
add_action( 'customize_register', 'kermancopper_customize_colors' );

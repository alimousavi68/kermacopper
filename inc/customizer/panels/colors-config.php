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
        'default'           => '#c86429',
        'sanitize_callback' => 'sanitize_hex_color',
        'transport'         => 'refresh',
    ) );
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'kermancopper_color_copper', array(
        'label'    => __( 'رنگ اصلی (مسی)', 'kermancopper' ),
        'section'  => 'kermancopper_global_colors',
    ) ) );

    // Industrial Green
    $wp_customize->add_setting( 'kermancopper_color_industrial_green', array(
        'default'           => '#0B6E60',
        'sanitize_callback' => 'sanitize_hex_color',
        'transport'         => 'refresh',
    ) );
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'kermancopper_color_industrial_green', array(
        'label'    => __( 'سبز صنعتی', 'kermancopper' ),
        'section'  => 'kermancopper_global_colors',
    ) ) );

    // Soft Gold
    $wp_customize->add_setting( 'kermancopper_color_soft_gold', array(
        'default'           => '#c4a962',
        'sanitize_callback' => 'sanitize_hex_color',
        'transport'         => 'refresh',
    ) );
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'kermancopper_color_soft_gold', array(
        'label'    => __( 'طلایی ملایم', 'kermancopper' ),
        'section'  => 'kermancopper_global_colors',
    ) ) );

    // Body Background
    $wp_customize->add_setting( 'kermancopper_color_bg_body', array(
        'default'           => '#F5F7FA',
        'sanitize_callback' => 'sanitize_hex_color',
        'transport'         => 'refresh',
    ) );
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'kermancopper_color_bg_body', array(
        'label'    => __( 'رنگ پس‌زمینه بدنه', 'kermancopper' ),
        'section'  => 'kermancopper_global_colors',
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

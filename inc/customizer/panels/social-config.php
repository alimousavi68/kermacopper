<?php
/**
 * Social Media Settings
 *
 * @package KermanCopper
 */

function kermancopper_customize_social( $wp_customize ) {

    // Section: Social Media (Top Level)
    $wp_customize->add_section( 'kermancopper_social_section', array(
        'title'    => __( 'شبکه‌های اجتماعی', 'kermancopper' ),
        'priority' => 35, // Between Colors and Footer
        'description' => __( 'لینک‌های شبکه‌های اجتماعی خود را اینجا وارد کنید. این لینک‌ها در هدر و فوتر نمایش داده می‌شوند.', 'kermancopper' ),
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
add_action( 'customize_register', 'kermancopper_customize_social' );

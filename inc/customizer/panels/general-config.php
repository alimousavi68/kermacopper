<?php
/**
 * General Settings Panel
 *
 * @package KermanCopper
 */

function kermancopper_customize_general( $wp_customize ) {

    // Panel: General
    $wp_customize->add_panel( 'kermancopper_general_panel', array(
        'title'       => __( 'تنظیمات عمومی', 'kermancopper' ),
        'priority'    => 20,
        'description' => __( 'تنظیمات عمومی سایت', 'kermancopper' ),
    ) );

    // Section: Images
    $wp_customize->add_section( 'kermancopper_general_images', array(
        'title'    => __( 'تصاویر پیش‌فرض', 'kermancopper' ),
        'panel'    => 'kermancopper_general_panel',
        'priority' => 10,
    ) );

    // Global Fallback Image
    $wp_customize->add_setting( 'kermancopper_global_fallback_image', array(
        'default'           => '',
        'sanitize_callback' => 'esc_url_raw',
    ) );
    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'kermancopper_global_fallback_image', array(
        'label'       => __( 'تصویر پیش‌فرض سایت', 'kermancopper' ),
        'description' => __( 'این تصویر در صورتی که پست یا آگهی تصویر شاخص نداشته باشد نمایش داده می‌شود.', 'kermancopper' ),
        'section'     => 'kermancopper_general_images',
    ) ) );

    // Section: Contact Information
    $wp_customize->add_section( 'kermancopper_general_contact', array(
        'title'    => __( 'اطلاعات تماس و نقشه', 'kermancopper' ),
        'panel'    => 'kermancopper_general_panel',
        'priority' => 20,
    ) );

    // Map Image
    $wp_customize->add_setting( 'kermancopper_contact_map_image', array(
        'default'           => '',
        'sanitize_callback' => 'esc_url_raw',
    ) );
    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'kermancopper_contact_map_image', array(
        'label'       => __( 'تصویر نقشه', 'kermancopper' ),
        'section'     => 'kermancopper_general_contact',
    ) ) );

    // Map Link
    $wp_customize->add_setting( 'kermancopper_contact_map_link', array(
        'default'           => '',
        'sanitize_callback' => 'esc_url_raw',
    ) );
    $wp_customize->add_control( 'kermancopper_contact_map_link', array(
        'label'       => __( 'لینک نقشه (گوگل مپ، نشان و...)', 'kermancopper' ),
        'section'     => 'kermancopper_general_contact',
        'type'        => 'url',
    ) );

    // Phones Repeater
    $wp_customize->add_setting( 'kermancopper_contact_phones', array(
        'default'           => '',
        'sanitize_callback' => 'wp_kses_post', // The repeater outputs JSON, standard text sanitization is fine if we encode/decode properly, or omit it for simple json. Let's use wp_strip_all_tags to be safe, but JSON has quotes. Since it's an admin field, we can trust it slightly or use a custom sanitizer. We'll use customizer's default.
    ) );
    if ( class_exists( 'KermanCopper_Repeater_Control' ) ) {
        $wp_customize->add_control( new KermanCopper_Repeater_Control( $wp_customize, 'kermancopper_contact_phones', array(
            'label'   => __( 'شماره‌های تماس', 'kermancopper' ),
            'section' => 'kermancopper_general_contact',
            'fields'  => array(
                'phone' => array(
                    'label' => __( 'شماره تماس', 'kermancopper' ),
                    'type'  => 'text',
                ),
            ),
        ) ) );
    }

    // Emails Repeater
    $wp_customize->add_setting( 'kermancopper_contact_emails', array(
        'default'           => '',
    ) );
    if ( class_exists( 'KermanCopper_Repeater_Control' ) ) {
        $wp_customize->add_control( new KermanCopper_Repeater_Control( $wp_customize, 'kermancopper_contact_emails', array(
            'label'   => __( 'ایمیل‌ها', 'kermancopper' ),
            'section' => 'kermancopper_general_contact',
            'fields'  => array(
                'email' => array(
                    'label' => __( 'آدرس ایمیل', 'kermancopper' ),
                    'type'  => 'text',
                ),
            ),
        ) ) );
    }
    
    // Address (Single Textarea) - Fallback
    $wp_customize->add_setting( 'kermancopper_contact_address_text', array(
        'default'           => 'کرمان، رفسنجان',
        'sanitize_callback' => 'wp_kses_post',
    ) );
    $wp_customize->add_control( 'kermancopper_contact_address_text', array(
        'label'       => __( 'آدرس دفتر مرکزی (پشتیبان)', 'kermancopper' ),
        'section'     => 'kermancopper_general_contact',
        'type'        => 'textarea',
    ) );

    // Addresses Repeater
    $wp_customize->add_setting( 'kermancopper_contact_addresses', array(
        'default'           => '',
        'sanitize_callback' => 'wp_kses_post',
    ) );
    if ( class_exists( 'KermanCopper_Repeater_Control' ) ) {
        $wp_customize->add_control( new KermanCopper_Repeater_Control( $wp_customize, 'kermancopper_contact_addresses', array(
            'label'   => __( 'آدرس‌ها', 'kermancopper' ),
            'section' => 'kermancopper_general_contact',
            'fields'  => array(
                'address' => array(
                    'label' => __( 'آدرس دفتر/کارخانه', 'kermancopper' ),
                    'type'  => 'textarea',
                ),
            ),
        ) ) );
    }

    // Recipient Email for Contact Forms
    $wp_customize->add_setting( 'kermancopper_contact_recipient_email', array(
        'default'           => get_option( 'admin_email' ),
        'sanitize_callback' => 'sanitize_text_field',
    ) );
    $wp_customize->add_control( 'kermancopper_contact_recipient_email', array(
        'label'       => __( 'ایمیل گیرنده فرم‌های تماس (برای چند ایمیل با کاما جدا کنید)', 'kermancopper' ),
        'section'     => 'kermancopper_general_contact',
        'type'        => 'text',
    ) );

    // Custom Success Message
    $wp_customize->add_setting( 'kermancopper_contact_success_message', array(
        'default'           => 'پیام شما با موفقیت ثبت شد. به زودی با شما تماس می‌گیریم.',
        'sanitize_callback' => 'sanitize_text_field',
    ) );
    $wp_customize->add_control( 'kermancopper_contact_success_message', array(
        'label'       => __( 'پیام ارسال موفقیت‌آمیز فرم', 'kermancopper' ),
        'section'     => 'kermancopper_general_contact',
        'type'        => 'textarea',
    ) );

    // Custom Error Message
    $wp_customize->add_setting( 'kermancopper_contact_error_message', array(
        'default'           => 'متأسفانه خطایی در ارسال پیام رخ داده است. لطفاً مجدداً تلاش کنید.',
        'sanitize_callback' => 'sanitize_text_field',
    ) );
    $wp_customize->add_control( 'kermancopper_contact_error_message', array(
        'label'       => __( 'پیام خطای ارسال ناموفق فرم', 'kermancopper' ),
        'section'     => 'kermancopper_general_contact',
        'type'        => 'textarea',
    ) );

    // Custom Validation Message
    $wp_customize->add_setting( 'kermancopper_contact_validation_message', array(
        'default'           => 'لطفاً تمامی فیلدهای اجباری را به درستی پر کنید.',
        'sanitize_callback' => 'sanitize_text_field',
    ) );
    $wp_customize->add_control( 'kermancopper_contact_validation_message', array(
        'label'       => __( 'پیام خطای اعتبار سنجی فرم', 'kermancopper' ),
        'section'     => 'kermancopper_general_contact',
        'type'        => 'textarea',
    ) );

}
add_action( 'customize_register', 'kermancopper_customize_general' );

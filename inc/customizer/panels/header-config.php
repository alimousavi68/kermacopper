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
}
add_action( 'customize_register', 'kermancopper_customize_header' );

if ( class_exists( 'WP_Customize_Control' ) ) {
    class KermanCopper_Rich_Text_Control extends WP_Customize_Control {
        public $type = 'kermancopper_richtext';

        public function render_content() {
            if ( empty( $this->label ) ) {
                return;
            }
            echo '<span class="customize-control-title">' . esc_html( $this->label ) . '</span>';
            if ( ! empty( $this->description ) ) {
                echo '<span class="description customize-control-description">' . esc_html( $this->description ) . '</span>';
            }
            wp_editor( $this->value(), $this->id, array(
                'textarea_name' => $this->id,
                'textarea_rows' => 5,
                'teeny'         => true,
                'media_buttons' => false,
            ) );
        }
    }
}

function kermancopper_customize_homepage( $wp_customize ) {
    if ( ! current_user_can( 'edit_theme_options' ) ) {
        return;
    }

    $wp_customize->add_panel( 'kermancopper_homepage_panel', array(
        'title'       => __( 'تنظیمات صفحه اصلی', 'kermancopper' ),
        'priority'    => 30,
    ) );

    $wp_customize->add_section( 'kermancopper_home_news_notices_section', array(
        'title'    => __( 'مدیریت اخبار و اطلاعیه‌ها', 'kermancopper' ),
        'panel'    => 'kermancopper_homepage_panel',
        'priority' => 10,
    ) );

    $categories = get_categories( array( 'hide_empty' => false ) );
    $category_choices = array( '' => __( 'انتخاب دسته', 'kermancopper' ) );
    foreach ( $categories as $category ) {
        $category_choices[ $category->term_id ] = $category->name;
    }

    $wp_customize->add_setting( 'kermancopper_home_news_title', array(
        'sanitize_callback' => 'kermancopper_sanitize_text_100',
    ) );
    $wp_customize->add_control( 'kermancopper_home_news_title', array(
        'label'    => __( 'عنوان بخش اخبار', 'kermancopper' ),
        'section'  => 'kermancopper_home_news_notices_section',
        'type'     => 'text',
    ) );

    $wp_customize->add_setting( 'kermancopper_home_news_kicker', array(
        'sanitize_callback' => 'kermancopper_sanitize_text_100',
    ) );
    $wp_customize->add_control( 'kermancopper_home_news_kicker', array(
        'label'   => __( 'متن بالای عنوان اخبار', 'kermancopper' ),
        'section' => 'kermancopper_home_news_notices_section',
        'type'    => 'text',
    ) );

    $wp_customize->add_setting( 'kermancopper_home_news_category', array(
        'sanitize_callback' => 'kermancopper_sanitize_category_id',
    ) );
    $wp_customize->add_control( 'kermancopper_home_news_category', array(
        'label'   => __( 'دسته‌بندی اخبار', 'kermancopper' ),
        'section' => 'kermancopper_home_news_notices_section',
        'type'    => 'select',
        'choices' => $category_choices,
    ) );

    $wp_customize->add_setting( 'kermancopper_home_news_count', array(
        'sanitize_callback' => 'kermancopper_sanitize_number_range_1_20',
    ) );
    $wp_customize->add_control( 'kermancopper_home_news_count', array(
        'label'       => __( 'تعداد نمایش اخبار', 'kermancopper' ),
        'section'     => 'kermancopper_home_news_notices_section',
        'type'        => 'number',
        'input_attrs' => array( 'min' => 1, 'max' => 20 ),
    ) );

    $wp_customize->add_setting( 'kermancopper_home_news_archive_text', array(
        'sanitize_callback' => 'kermancopper_sanitize_text_50',
    ) );
    $wp_customize->add_control( 'kermancopper_home_news_archive_text', array(
        'label'   => __( 'متن دکمه آرشیو اخبار', 'kermancopper' ),
        'section' => 'kermancopper_home_news_notices_section',
        'type'    => 'text',
    ) );

    $wp_customize->add_setting( 'kermancopper_home_news_show_date', array(
        'sanitize_callback' => 'kermancopper_sanitize_checkbox',
    ) );
    $wp_customize->add_control( 'kermancopper_home_news_show_date', array(
        'label'   => __( 'نمایش تاریخ اخبار', 'kermancopper' ),
        'section' => 'kermancopper_home_news_notices_section',
        'type'    => 'checkbox',
    ) );

    $wp_customize->add_setting( 'kermancopper_home_news_archive_url', array(
        'sanitize_callback' => 'kermancopper_sanitize_url',
    ) );
    $wp_customize->add_control( 'kermancopper_home_news_archive_url', array(
        'label'       => __( 'لینک آرشیو اخبار', 'kermancopper' ),
        'section'     => 'kermancopper_home_news_notices_section',
        'type'        => 'url',
        'input_attrs' => array( 'readonly' => 'readonly' ),
        'description' => __( 'به صورت خودکار از دسته انتخابی ساخته می‌شود.', 'kermancopper' ),
    ) );

    $wp_customize->add_setting( 'kermancopper_home_notices_title', array(
        'sanitize_callback' => 'kermancopper_sanitize_text_100',
    ) );
    $wp_customize->add_control( 'kermancopper_home_notices_title', array(
        'label'    => __( 'عنوان بخش اطلاعیه‌ها', 'kermancopper' ),
        'section'  => 'kermancopper_home_news_notices_section',
        'type'     => 'text',
    ) );

    $wp_customize->add_setting( 'kermancopper_home_notices_kicker', array(
        'sanitize_callback' => 'kermancopper_sanitize_text_100',
    ) );
    $wp_customize->add_control( 'kermancopper_home_notices_kicker', array(
        'label'   => __( 'متن بالای عنوان اطلاعیه‌ها', 'kermancopper' ),
        'section' => 'kermancopper_home_news_notices_section',
        'type'    => 'text',
    ) );

    $wp_customize->add_setting( 'kermancopper_home_notices_category', array(
        'sanitize_callback' => 'kermancopper_sanitize_category_id',
    ) );
    $wp_customize->add_control( 'kermancopper_home_notices_category', array(
        'label'   => __( 'دسته‌بندی اطلاعیه‌ها', 'kermancopper' ),
        'section' => 'kermancopper_home_news_notices_section',
        'type'    => 'select',
        'choices' => $category_choices,
    ) );

    $wp_customize->add_setting( 'kermancopper_home_notices_count', array(
        'sanitize_callback' => 'kermancopper_sanitize_number_range_1_20',
    ) );
    $wp_customize->add_control( 'kermancopper_home_notices_count', array(
        'label'       => __( 'تعداد نمایش اطلاعیه‌ها', 'kermancopper' ),
        'section'     => 'kermancopper_home_news_notices_section',
        'type'        => 'number',
        'input_attrs' => array( 'min' => 1, 'max' => 20 ),
    ) );

    $wp_customize->add_setting( 'kermancopper_home_notices_archive_text', array(
        'sanitize_callback' => 'kermancopper_sanitize_text_50',
    ) );
    $wp_customize->add_control( 'kermancopper_home_notices_archive_text', array(
        'label'   => __( 'متن دکمه آرشیو اطلاعیه‌ها', 'kermancopper' ),
        'section' => 'kermancopper_home_news_notices_section',
        'type'    => 'text',
    ) );

    $wp_customize->add_setting( 'kermancopper_home_notices_show_date', array(
        'sanitize_callback' => 'kermancopper_sanitize_checkbox',
    ) );
    $wp_customize->add_control( 'kermancopper_home_notices_show_date', array(
        'label'   => __( 'نمایش تاریخ اطلاعیه‌ها', 'kermancopper' ),
        'section' => 'kermancopper_home_news_notices_section',
        'type'    => 'checkbox',
    ) );

    $wp_customize->add_setting( 'kermancopper_home_notices_archive_url', array(
        'sanitize_callback' => 'kermancopper_sanitize_url',
    ) );
    $wp_customize->add_control( 'kermancopper_home_notices_archive_url', array(
        'label'       => __( 'لینک آرشیو اطلاعیه‌ها', 'kermancopper' ),
        'section'     => 'kermancopper_home_news_notices_section',
        'type'        => 'url',
        'input_attrs' => array( 'readonly' => 'readonly' ),
        'description' => __( 'به صورت خودکار از دسته انتخابی ساخته می‌شود.', 'kermancopper' ),
    ) );
}
add_action( 'customize_register', 'kermancopper_customize_homepage' );

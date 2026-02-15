<?php

if ( ! defined( 'KERMANCOPPER_AD_META_EXCEL_FORMS' ) ) {
    define( 'KERMANCOPPER_AD_META_EXCEL_FORMS', 'kermancopper_ad_excel_forms' );
}
if ( ! defined( 'KERMANCOPPER_AD_META_EXCEL_URL' ) ) {
    define( 'KERMANCOPPER_AD_META_EXCEL_URL', 'kermancopper_ad_excel_url' );
}
if ( ! defined( 'KERMANCOPPER_AD_META_EXPIRY_DATE' ) ) {
    define( 'KERMANCOPPER_AD_META_EXPIRY_DATE', 'kermancopper_ad_expiry_date' );
}
if ( ! defined( 'KERMANCOPPER_AD_META_STATUS' ) ) {
    define( 'KERMANCOPPER_AD_META_STATUS', 'kermancopper_ad_status' );
}

function kermancopper_jalali_to_gregorian( $jy, $jm, $jd ) {
    $jy = (int) $jy;
    $jm = (int) $jm;
    $jd = (int) $jd;
    $jy += 1595;
    $days = -355668 + ( 365 * $jy ) + ( (int) ( $jy / 33 ) * 8 ) + (int) ( ( ( $jy % 33 ) + 3 ) / 4 ) + $jd;
    $days += ( $jm < 7 ) ? ( ( $jm - 1 ) * 31 ) : ( ( ( $jm - 7 ) * 30 ) + 186 );
    $gy = 400 * (int) ( $days / 146097 );
    $days %= 146097;
    if ( $days > 36524 ) {
        $gy += 100 * (int) ( --$days / 36524 );
        $days %= 36524;
        if ( $days >= 365 ) {
            $days++;
        }
    }
    $gy += 4 * (int) ( $days / 1461 );
    $days %= 1461;
    if ( $days > 365 ) {
        $gy += (int) ( ( $days - 1 ) / 365 );
        $days = ( $days - 1 ) % 365;
    }
    $gd = $days + 1;
    $month_days = array( 0, 31, ( ( $gy % 4 === 0 && $gy % 100 !== 0 ) || ( $gy % 400 === 0 ) ) ? 29 : 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31 );
    for ( $gm = 1; $gm <= 12 && $gd > $month_days[ $gm ]; $gm++ ) {
        $gd -= $month_days[ $gm ];
    }
    return array( $gy, $gm, $gd );
}

function kermancopper_gregorian_to_jalali( $gy, $gm, $gd ) {
    $gy = (int) $gy;
    $gm = (int) $gm;
    $gd = (int) $gd;
    $g_days_in_month = array( 31, 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31 );
    $j_days_in_month = array( 31, 31, 31, 31, 31, 31, 30, 30, 30, 30, 30, 29 );
    $gy -= 1600;
    $gm -= 1;
    $gd -= 1;
    $g_day_no = 365 * $gy + (int) ( ( $gy + 3 ) / 4 ) - (int) ( ( $gy + 99 ) / 100 ) + (int) ( ( $gy + 399 ) / 400 );
    for ( $i = 0; $i < $gm; ++$i ) {
        $g_day_no += $g_days_in_month[ $i ];
    }
    if ( $gm > 1 && ( ( $gy % 4 === 0 && $gy % 100 !== 0 ) || ( $gy % 400 === 0 ) ) ) {
        $g_day_no++;
    }
    $g_day_no += $gd;
    $j_day_no = $g_day_no - 79;
    $j_np = (int) ( $j_day_no / 12053 );
    $j_day_no %= 12053;
    $jy = 979 + ( 33 * $j_np ) + ( 4 * (int) ( $j_day_no / 1461 ) );
    $j_day_no %= 1461;
    if ( $j_day_no >= 366 ) {
        $jy += (int) ( ( $j_day_no - 1 ) / 365 );
        $j_day_no = ( $j_day_no - 1 ) % 365;
    }
    for ( $i = 0; $i < 11 && $j_day_no >= $j_days_in_month[ $i ]; ++$i ) {
        $j_day_no -= $j_days_in_month[ $i ];
    }
    $jm = $i + 1;
    $jd = $j_day_no + 1;
    return array( $jy, $jm, $jd );
}

function kermancopper_ads_format_expiry_date_for_display( $expiry_date ) {
    if ( $expiry_date && preg_match( '/^\d{4}-\d{2}-\d{2}$/', $expiry_date ) ) {
        $parts = explode( '-', $expiry_date );
        if ( count( $parts ) === 3 ) {
            $jalali = kermancopper_gregorian_to_jalali( (int) $parts[0], (int) $parts[1], (int) $parts[2] );
            return sprintf( '%04d/%02d/%02d', $jalali[0], $jalali[1], $jalali[2] );
        }
    }
    if ( $expiry_date && preg_match( '/^\d{4}\/\d{2}\/\d{2}$/', $expiry_date ) ) {
        return $expiry_date;
    }
    return '';
}

function kermancopper_ads_normalize_expiry_date_for_storage( $expiry_date ) {
    if ( $expiry_date && preg_match( '/^\d{4}\/\d{2}\/\d{2}$/', $expiry_date ) ) {
        $parts = explode( '/', $expiry_date );
        if ( count( $parts ) === 3 ) {
            $gregorian = kermancopper_jalali_to_gregorian( (int) $parts[0], (int) $parts[1], (int) $parts[2] );
            return sprintf( '%04d-%02d-%02d', $gregorian[0], $gregorian[1], $gregorian[2] );
        }
    }
    return '';
}

function kermancopper_ads_sanitize_excel_forms( $value ) {
    if ( ! is_array( $value ) ) {
        return array();
    }
    $sanitized = array();
    foreach ( $value as $item ) {
        if ( ! is_array( $item ) ) {
            continue;
        }
        $name = isset( $item['name'] ) ? sanitize_text_field( $item['name'] ) : '';
        $url = isset( $item['url'] ) ? esc_url_raw( $item['url'] ) : '';
        if ( $url === '' ) {
            continue;
        }
        $sanitized[] = array(
            'name' => $name,
            'url'  => $url,
        );
    }
    return $sanitized;
}

function kermancopper_ads_sanitize_expiry_date( $value ) {
    $value = is_string( $value ) ? trim( $value ) : '';
    if ( $value === '' ) {
        return '';
    }
    if ( preg_match( '/^\d{4}-\d{2}-\d{2}$/', $value ) ) {
        return $value;
    }
    if ( preg_match( '/^\d{4}\/\d{2}\/\d{2}$/', $value ) ) {
        $parts = explode( '/', $value );
        if ( count( $parts ) === 3 ) {
            $gregorian = kermancopper_jalali_to_gregorian( (int) $parts[0], (int) $parts[1], (int) $parts[2] );
            return sprintf( '%04d-%02d-%02d', $gregorian[0], $gregorian[1], $gregorian[2] );
        }
    }
    return '';
}

function kermancopper_ads_sanitize_status( $value ) {
    $value = is_string( $value ) ? trim( $value ) : '';
    $allowed = array( 'active', 'closed' );
    return in_array( $value, $allowed, true ) ? $value : '';
}

function kermancopper_ads_register_post_type() {
    $labels = array(
        'name'               => __( 'آگهی‌ها', 'kermancopper' ),
        'singular_name'      => __( 'آگهی', 'kermancopper' ),
        'menu_name'          => __( 'آگهی‌ها', 'kermancopper' ),
        'add_new'            => __( 'افزودن آگهی', 'kermancopper' ),
        'add_new_item'       => __( 'افزودن آگهی جدید', 'kermancopper' ),
        'edit_item'          => __( 'ویرایش آگهی', 'kermancopper' ),
        'new_item'           => __( 'آگهی جدید', 'kermancopper' ),
        'view_item'          => __( 'مشاهده آگهی', 'kermancopper' ),
        'search_items'       => __( 'جستجوی آگهی‌ها', 'kermancopper' ),
        'not_found'          => __( 'موردی یافت نشد', 'kermancopper' ),
        'not_found_in_trash' => __( 'موردی در زباله‌دان نیست', 'kermancopper' ),
    );
    $args = array(
        'labels'        => $labels,
        'public'        => true,
        'has_archive'   => true,
        'rewrite'       => array( 'slug' => 'ads' ),
        'supports'      => array( 'title', 'editor', 'excerpt', 'thumbnail' ),
        'show_in_rest'  => true,
        'menu_position' => 20,
        'menu_icon'     => 'dashicons-megaphone',
        'taxonomies'    => array( 'kermancopper_ad_type' ),
    );
    register_post_type( 'kermancopper_ad', $args );
}
add_action( 'init', 'kermancopper_ads_register_post_type' );

function kermancopper_ads_register_taxonomy() {
    $labels = array(
        'name'          => __( 'نوع آگهی', 'kermancopper' ),
        'singular_name' => __( 'نوع آگهی', 'kermancopper' ),
        'search_items'  => __( 'جستجوی نوع آگهی', 'kermancopper' ),
        'all_items'     => __( 'همه نوع‌ها', 'kermancopper' ),
        'edit_item'     => __( 'ویرایش نوع آگهی', 'kermancopper' ),
        'add_new_item'  => __( 'افزودن نوع جدید', 'kermancopper' ),
        'menu_name'     => __( 'نوع آگهی', 'kermancopper' ),
    );
    $args = array(
        'labels'       => $labels,
        'public'       => true,
        'hierarchical' => true,
        'show_in_rest' => true,
    );
    register_taxonomy( 'kermancopper_ad_type', array( 'kermancopper_ad' ), $args );
}
add_action( 'init', 'kermancopper_ads_register_taxonomy' );

function kermancopper_ads_register_meta() {
    register_post_meta(
        'kermancopper_ad',
        KERMANCOPPER_AD_META_EXCEL_FORMS,
        array(
            'type'              => 'array',
            'single'            => true,
            'sanitize_callback' => 'kermancopper_ads_sanitize_excel_forms',
            'show_in_rest'      => true,
            'auth_callback'     => function () {
                return current_user_can( 'edit_posts' );
            },
        )
    );
    register_post_meta(
        'kermancopper_ad',
        KERMANCOPPER_AD_META_EXPIRY_DATE,
        array(
            'type'              => 'string',
            'single'            => true,
            'sanitize_callback' => 'kermancopper_ads_sanitize_expiry_date',
            'show_in_rest'      => true,
            'auth_callback'     => function () {
                return current_user_can( 'edit_posts' );
            },
        )
    );
    register_post_meta(
        'kermancopper_ad',
        KERMANCOPPER_AD_META_STATUS,
        array(
            'type'              => 'string',
            'single'            => true,
            'sanitize_callback' => 'kermancopper_ads_sanitize_status',
            'show_in_rest'      => true,
            'auth_callback'     => function () {
                return current_user_can( 'edit_posts' );
            },
        )
    );
}
add_action( 'init', 'kermancopper_ads_register_meta' );

function kermancopper_ads_add_meta_boxes() {
    add_meta_box(
        'kermancopper_ad_details',
        __( 'اطلاعات آگهی', 'kermancopper' ),
        'kermancopper_ads_render_meta_box',
        'kermancopper_ad',
        'normal',
        'high'
    );
}
add_action( 'add_meta_boxes', 'kermancopper_ads_add_meta_boxes' );

function kermancopper_ads_render_meta_box( $post ) {
    wp_nonce_field( 'kermancopper_ad_details_save', 'kermancopper_ad_details_nonce' );
    $excel_forms = get_post_meta( $post->ID, KERMANCOPPER_AD_META_EXCEL_FORMS, true );
    if ( ! is_array( $excel_forms ) ) {
        $excel_forms = array();
    }
    if ( empty( $excel_forms ) ) {
        $legacy_excel_url = get_post_meta( $post->ID, KERMANCOPPER_AD_META_EXCEL_URL, true );
        if ( $legacy_excel_url ) {
            $excel_forms[] = array(
                'name' => __( 'فرم اکسل', 'kermancopper' ),
                'url'  => $legacy_excel_url,
            );
        }
    }
    if ( empty( $excel_forms ) ) {
        $excel_forms[] = array(
            'name' => '',
            'url'  => '',
        );
    }
    $expiry_date = get_post_meta( $post->ID, KERMANCOPPER_AD_META_EXPIRY_DATE, true );
    $status = get_post_meta( $post->ID, KERMANCOPPER_AD_META_STATUS, true );
    $display_expiry_date = kermancopper_ads_format_expiry_date_for_display( $expiry_date );
    $status_options = array(
        'active' => __( 'فعال', 'kermancopper' ),
        'closed' => __( 'بسته', 'kermancopper' ),
    );
    ?>
    <div class="kermancopper-ad-fields-row">
        <div class="kermancopper-ad-field">
            <label for="kermancopper_ad_expiry_date"><?php echo esc_html__( 'تاریخ انقضای ثبت درخواست', 'kermancopper' ); ?></label>
            <input type="text" id="kermancopper_ad_expiry_date" name="kermancopper_ad_expiry_date" class="widefat kermancopper-ad-datepicker" data-jdp value="<?php echo esc_attr( $display_expiry_date ); ?>" />
        </div>
        <div class="kermancopper-ad-field">
            <label for="kermancopper_ad_status"><?php echo esc_html__( 'وضعیت آگهی', 'kermancopper' ); ?></label>
            <select id="kermancopper_ad_status" name="kermancopper_ad_status" class="widefat">
                <option value=""><?php echo esc_html__( 'انتخاب وضعیت', 'kermancopper' ); ?></option>
                <?php foreach ( $status_options as $value => $label ) : ?>
                    <option value="<?php echo esc_attr( $value ); ?>" <?php selected( $status, $value ); ?>>
                        <?php echo esc_html( $label ); ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
    </div>
    <div class="kermancopper-ad-excel-separator"></div>
    <p class="kermancopper-ad-excel-title"><?php echo esc_html__( 'فرم‌های اکسل', 'kermancopper' ); ?></p>
    <div id="kermancopper-ad-excel-forms" data-index="<?php echo esc_attr( count( $excel_forms ) ); ?>">
        <?php foreach ( $excel_forms as $index => $form ) : ?>
            <?php
            $form_name = isset( $form['name'] ) ? $form['name'] : '';
            $form_url = isset( $form['url'] ) ? $form['url'] : '';
            ?>
            <div class="kermancopper-ad-excel-row">
                <div>
                    <label class="kermancopper-ad-excel-label"><?php echo esc_html__( 'نام فرم', 'kermancopper' ); ?></label>
                    <input type="text" name="kermancopper_ad_excel_forms[<?php echo esc_attr( $index ); ?>][name]" class="widefat kermancopper-ad-excel-name" placeholder="<?php echo esc_attr__( 'نام فرم', 'kermancopper' ); ?>" value="<?php echo esc_attr( $form_name ); ?>" />
                </div>
                <div>
                    <label class="kermancopper-ad-excel-label"><?php echo esc_html__( 'فایل فرم', 'kermancopper' ); ?></label>
                    <div class="kermancopper-ad-excel-row-actions">
                        <input type="text" name="kermancopper_ad_excel_forms[<?php echo esc_attr( $index ); ?>][url]" class="widefat kermancopper-ad-excel-url" readonly value="<?php echo esc_attr( $form_url ); ?>" />
                        <div class="kermancopper-ad-excel-buttons">
                            <button type="button" class="button kermancopper-ad-excel-select"><?php echo esc_html__( 'انتخاب فایل', 'kermancopper' ); ?></button>
                            <button type="button" class="button kermancopper-ad-excel-remove"><?php echo esc_html__( 'حذف', 'kermancopper' ); ?></button>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
    <p>
        <button type="button" class="button button-primary" id="kermancopper_ad_excel_add"><?php echo esc_html__( 'افزودن فرم', 'kermancopper' ); ?></button>
    </p>
    <?php
}

function kermancopper_ads_save_meta( $post_id ) {
    if ( ! isset( $_POST['kermancopper_ad_details_nonce'] ) ) {
        return;
    }
    if ( ! wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['kermancopper_ad_details_nonce'] ) ), 'kermancopper_ad_details_save' ) ) {
        return;
    }
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
        return;
    }
    if ( ! current_user_can( 'edit_post', $post_id ) ) {
        return;
    }
    if ( get_post_type( $post_id ) !== 'kermancopper_ad' ) {
        return;
    }
    $forms_raw = isset( $_POST['kermancopper_ad_excel_forms'] ) && is_array( $_POST['kermancopper_ad_excel_forms'] ) ? wp_unslash( $_POST['kermancopper_ad_excel_forms'] ) : array();
    $forms = kermancopper_ads_sanitize_excel_forms( $forms_raw );
    if ( ! empty( $forms ) ) {
        update_post_meta( $post_id, KERMANCOPPER_AD_META_EXCEL_FORMS, $forms );
    } else {
        delete_post_meta( $post_id, KERMANCOPPER_AD_META_EXCEL_FORMS );
    }
    delete_post_meta( $post_id, KERMANCOPPER_AD_META_EXCEL_URL );
    $expiry_date = isset( $_POST['kermancopper_ad_expiry_date'] ) ? sanitize_text_field( wp_unslash( $_POST['kermancopper_ad_expiry_date'] ) ) : '';
    $expiry_value = kermancopper_ads_sanitize_expiry_date( $expiry_date );
    if ( $expiry_value !== '' ) {
        update_post_meta( $post_id, KERMANCOPPER_AD_META_EXPIRY_DATE, $expiry_value );
    } else {
        delete_post_meta( $post_id, KERMANCOPPER_AD_META_EXPIRY_DATE );
    }
    $status = isset( $_POST['kermancopper_ad_status'] ) ? sanitize_text_field( wp_unslash( $_POST['kermancopper_ad_status'] ) ) : '';
    $status_value = kermancopper_ads_sanitize_status( $status );
    if ( $status_value !== '' ) {
        update_post_meta( $post_id, KERMANCOPPER_AD_META_STATUS, $status_value );
    } else {
        delete_post_meta( $post_id, KERMANCOPPER_AD_META_STATUS );
    }
}
add_action( 'save_post', 'kermancopper_ads_save_meta' );

function kermancopper_ads_admin_assets() {
    $screen = function_exists( 'get_current_screen' ) ? get_current_screen() : null;
    if ( ! $screen || $screen->post_type !== 'kermancopper_ad' ) {
        return;
    }
    wp_enqueue_media();
    $admin_css_path = get_template_directory() . '/assets/admin/ads-admin.css';
    $admin_js_path = get_template_directory() . '/assets/admin/ads-admin.js';
    wp_enqueue_style( 'kermancopper-jalalidatepicker', get_template_directory_uri() . '/assets/vendor/jalalidatepicker/jalalidatepicker.min.css', array(), '1.3.0' );
    wp_enqueue_style( 'kermancopper-ads-admin', get_template_directory_uri() . '/assets/admin/ads-admin.css', array(), file_exists( $admin_css_path ) ? filemtime( $admin_css_path ) : null );
    wp_enqueue_script( 'kermancopper-jalalidatepicker', get_template_directory_uri() . '/assets/vendor/jalalidatepicker/jalalidatepicker.min.js', array(), '1.3.0', true );
    wp_enqueue_script( 'kermancopper-ads-admin', get_template_directory_uri() . '/assets/admin/ads-admin.js', array( 'jquery', 'kermancopper-jalalidatepicker' ), file_exists( $admin_js_path ) ? filemtime( $admin_js_path ) : null, true );
    wp_localize_script(
        'kermancopper-ads-admin',
        'kermancopperAdsAdmin',
        array(
            'mediaTitle'         => __( 'انتخاب فرم اکسل', 'kermancopper' ),
            'mediaButton'        => __( 'انتخاب', 'kermancopper' ),
            'formNameLabel'      => __( 'نام فرم', 'kermancopper' ),
            'formNamePlaceholder'=> __( 'نام فرم', 'kermancopper' ),
            'formFileLabel'      => __( 'فایل فرم', 'kermancopper' ),
            'selectFileText'     => __( 'انتخاب فایل', 'kermancopper' ),
            'removeText'         => __( 'حذف', 'kermancopper' ),
        )
    );
}
add_action( 'admin_enqueue_scripts', 'kermancopper_ads_admin_assets' );

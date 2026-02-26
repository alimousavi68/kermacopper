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
if ( ! defined( 'KERMANCOPPER_AD_REQUEST_POST_TYPE' ) ) {
    define( 'KERMANCOPPER_AD_REQUEST_POST_TYPE', 'kc_ad_request' );
}
if ( ! defined( 'KERMANCOPPER_AD_REQUEST_META_AD_ID' ) ) {
    define( 'KERMANCOPPER_AD_REQUEST_META_AD_ID', 'kermancopper_ad_request_ad_id' );
}
if ( ! defined( 'KERMANCOPPER_AD_REQUEST_META_NAME' ) ) {
    define( 'KERMANCOPPER_AD_REQUEST_META_NAME', 'kermancopper_ad_request_name' );
}
if ( ! defined( 'KERMANCOPPER_AD_REQUEST_META_MOBILE' ) ) {
    define( 'KERMANCOPPER_AD_REQUEST_META_MOBILE', 'kermancopper_ad_request_mobile' );
}
if ( ! defined( 'KERMANCOPPER_AD_REQUEST_META_EMAIL' ) ) {
    define( 'KERMANCOPPER_AD_REQUEST_META_EMAIL', 'kermancopper_ad_request_email' );
}
if ( ! defined( 'KERMANCOPPER_AD_REQUEST_META_COMPANY' ) ) {
    define( 'KERMANCOPPER_AD_REQUEST_META_COMPANY', 'kermancopper_ad_request_company' );
}
if ( ! defined( 'KERMANCOPPER_AD_REQUEST_META_NOTE' ) ) {
    define( 'KERMANCOPPER_AD_REQUEST_META_NOTE', 'kermancopper_ad_request_note' );
}
if ( ! defined( 'KERMANCOPPER_AD_REQUEST_META_ATTACHMENTS' ) ) {
    define( 'KERMANCOPPER_AD_REQUEST_META_ATTACHMENTS', 'kermancopper_ad_request_attachments' );
}
if ( ! defined( 'KERMANCOPPER_AD_REQUEST_META_ATTACHMENTS_COUNT' ) ) {
    define( 'KERMANCOPPER_AD_REQUEST_META_ATTACHMENTS_COUNT', 'kermancopper_ad_request_attachments_count' );
}
if ( ! defined( 'KERMANCOPPER_AD_REQUEST_META_SEEN' ) ) {
    define( 'KERMANCOPPER_AD_REQUEST_META_SEEN', 'kermancopper_ad_request_seen' );
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

function kermancopper_ads_register_request_post_type() {
    $labels = array(
        'name'               => __( 'درخواست‌ها', 'kermancopper' ),
        'singular_name'      => __( 'درخواست', 'kermancopper' ),
        'menu_name'          => __( 'درخواست‌ها', 'kermancopper' ),
        'add_new_item'       => __( 'افزودن درخواست', 'kermancopper' ),
        'edit_item'          => __( 'ویرایش درخواست', 'kermancopper' ),
        'new_item'           => __( 'درخواست جدید', 'kermancopper' ),
        'view_item'          => __( 'مشاهده درخواست', 'kermancopper' ),
        'search_items'       => __( 'جستجوی درخواست‌ها', 'kermancopper' ),
        'not_found'          => __( 'موردی یافت نشد', 'kermancopper' ),
        'not_found_in_trash' => __( 'موردی در زباله‌دان نیست', 'kermancopper' ),
    );
    $args = array(
        'labels'          => $labels,
        'public'          => false,
        'show_ui'         => false,
        'show_in_menu'    => false,
        'supports'        => array( 'title' ),
        'capability_type' => 'post',
    );
    register_post_type( KERMANCOPPER_AD_REQUEST_POST_TYPE, $args );
}
add_action( 'init', 'kermancopper_ads_register_request_post_type' );

function kermancopper_ads_register_request_meta() {
    $meta_items = array(
        KERMANCOPPER_AD_REQUEST_META_AD_ID   => array( 'type' => 'integer' ),
        KERMANCOPPER_AD_REQUEST_META_NAME    => array( 'type' => 'string' ),
        KERMANCOPPER_AD_REQUEST_META_MOBILE  => array( 'type' => 'string' ),
        KERMANCOPPER_AD_REQUEST_META_EMAIL   => array( 'type' => 'string' ),
        KERMANCOPPER_AD_REQUEST_META_COMPANY => array( 'type' => 'string' ),
        KERMANCOPPER_AD_REQUEST_META_NOTE    => array( 'type' => 'string' ),
        KERMANCOPPER_AD_REQUEST_META_ATTACHMENTS => array( 'type' => 'array' ),
    );
    foreach ( $meta_items as $key => $meta_args ) {
        register_post_meta(
            KERMANCOPPER_AD_REQUEST_POST_TYPE,
            $key,
            array(
                'type'              => $meta_args['type'],
                'single'            => true,
                'show_in_rest'      => false,
                'auth_callback'     => function () {
                    return current_user_can( 'edit_posts' );
                },
            )
        );
    }
}
add_action( 'init', 'kermancopper_ads_register_request_meta' );

function kermancopper_ads_is_ad_open( $ad_id ) {
    $expiry_date = get_post_meta( $ad_id, KERMANCOPPER_AD_META_EXPIRY_DATE, true );
    $status = get_post_meta( $ad_id, KERMANCOPPER_AD_META_STATUS, true );
    if ( $status === '' ) {
        $today = current_time( 'Y-m-d' );
        if ( $expiry_date && $expiry_date < $today ) {
            $status = 'closed';
        } else {
            $status = 'active';
        }
    }
    $today = current_time( 'Y-m-d' );
    if ( $status === 'closed' || ( $expiry_date && $expiry_date < $today ) ) {
        return false;
    }
    return true;
}

function kermancopper_ads_collect_request_payload( $ad_id, $redirect_url, $use_ajax = false ) {
    $name = isset( $_POST['request_name'] ) ? sanitize_text_field( wp_unslash( $_POST['request_name'] ) ) : '';
    $mobile = isset( $_POST['request_mobile'] ) ? sanitize_text_field( wp_unslash( $_POST['request_mobile'] ) ) : '';
    $email = isset( $_POST['request_email'] ) ? sanitize_email( wp_unslash( $_POST['request_email'] ) ) : '';
    $company = isset( $_POST['request_company'] ) ? sanitize_text_field( wp_unslash( $_POST['request_company'] ) ) : '';
    $note = isset( $_POST['request_note'] ) ? sanitize_textarea_field( wp_unslash( $_POST['request_note'] ) ) : '';
    if ( $name === '' || $mobile === '' || $email === '' ) {
        if ( $use_ajax ) {
            return new WP_Error( 'missing', 'لطفا همه فیلدهای ضروری را تکمیل کنید.' );
        }
        wp_safe_redirect( add_query_arg( 'ad_request', 'missing', $redirect_url ) );
        exit;
    }
    if ( ! is_email( $email ) ) {
        if ( $use_ajax ) {
            return new WP_Error( 'invalid_email', 'ایمیل وارد شده معتبر نیست.' );
        }
        wp_safe_redirect( add_query_arg( 'ad_request', 'invalid_email', $redirect_url ) );
        exit;
    }
    $mobile_digits = preg_replace( '/\D+/', '', $mobile );
    if ( $mobile_digits === '' || strlen( $mobile_digits ) < 10 || strlen( $mobile_digits ) > 15 ) {
        if ( $use_ajax ) {
            return new WP_Error( 'invalid_mobile', 'شماره موبایل وارد شده معتبر نیست.' );
        }
        wp_safe_redirect( add_query_arg( 'ad_request', 'invalid_mobile', $redirect_url ) );
        exit;
    }
    $files = isset( $_FILES['ad_attachments'] ) ? $_FILES['ad_attachments'] : null;
    $attachment_ids = array();
    if ( $files && is_array( $files['name'] ) ) {
        $allowed_mime = array(
            'application/vnd.ms-excel',
            'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
            'application/pdf',
            'application/msword',
            'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
            'image/jpeg',
            'image/png',
            'application/zip',
            'application/x-zip-compressed',
        );
        $max_size = 10 * 1024 * 1024;
        $file_count = count( $files['name'] );
        $has_upload = false;
        require_once ABSPATH . 'wp-admin/includes/file.php';
        require_once ABSPATH . 'wp-admin/includes/image.php';
        for ( $i = 0; $i < $file_count; $i++ ) {
            if ( $files['name'][ $i ] === '' ) {
                continue;
            }
            $has_upload = true;
            if ( $files['error'][ $i ] !== UPLOAD_ERR_OK ) {
                if ( $use_ajax ) {
                    return new WP_Error( 'upload', 'آپلود فایل با خطا روبه‌رو شد.' );
                }
                wp_safe_redirect( add_query_arg( 'ad_request', 'upload', $redirect_url ) );
                exit;
            }
            if ( $files['size'][ $i ] > $max_size ) {
                if ( $use_ajax ) {
                    return new WP_Error( 'file_size', 'حجم فایل بیش از حد مجاز است.' );
                }
                wp_safe_redirect( add_query_arg( 'ad_request', 'file_size', $redirect_url ) );
                exit;
            }
            $file = array(
                'name'     => $files['name'][ $i ],
                'type'     => $files['type'][ $i ],
                'tmp_name' => $files['tmp_name'][ $i ],
                'error'    => $files['error'][ $i ],
                'size'     => $files['size'][ $i ],
            );
            $filetype = wp_check_filetype( $file['name'] );
            if ( empty( $filetype['type'] ) || ! in_array( $filetype['type'], $allowed_mime, true ) ) {
                if ( $use_ajax ) {
                    return new WP_Error( 'file_type', 'نوع فایل مجاز نیست.' );
                }
                wp_safe_redirect( add_query_arg( 'ad_request', 'file_type', $redirect_url ) );
                exit;
            }
            $uploaded = wp_handle_upload( $file, array( 'test_form' => false ) );
            if ( ! isset( $uploaded['file'] ) ) {
                if ( $use_ajax ) {
                    return new WP_Error( 'upload', 'آپلود فایل با خطا روبه‌رو شد.' );
                }
                wp_safe_redirect( add_query_arg( 'ad_request', 'upload', $redirect_url ) );
                exit;
            }
            $attachment_id = wp_insert_attachment(
                array(
                    'post_mime_type' => $uploaded['type'],
                    'post_title'     => sanitize_file_name( $file['name'] ),
                    'post_status'    => 'private',
                ),
                $uploaded['file']
            );
            if ( ! $attachment_id || is_wp_error( $attachment_id ) ) {
                if ( $use_ajax ) {
                    return new WP_Error( 'upload', 'آپلود فایل با خطا روبه‌رو شد.' );
                }
                wp_safe_redirect( add_query_arg( 'ad_request', 'upload', $redirect_url ) );
                exit;
            }
            $attachment_data = wp_generate_attachment_metadata( $attachment_id, $uploaded['file'] );
            if ( $attachment_data ) {
                wp_update_attachment_metadata( $attachment_id, $attachment_data );
            }
            $attachment_ids[] = $attachment_id;
        }
        if ( ! $has_upload ) {
            if ( $use_ajax ) {
                return new WP_Error( 'no_files', 'حداقل یک فایل پیوست کنید.' );
            }
            wp_safe_redirect( add_query_arg( 'ad_request', 'no_files', $redirect_url ) );
            exit;
        }
    } else {
        if ( $use_ajax ) {
            return new WP_Error( 'no_files', 'حداقل یک فایل پیوست کنید.' );
        }
        wp_safe_redirect( add_query_arg( 'ad_request', 'no_files', $redirect_url ) );
        exit;
    }
    return array(
        'ad_id'          => $ad_id,
        'name'           => $name,
        'mobile'         => $mobile,
        'email'          => $email,
        'company'        => $company,
        'note'           => $note,
        'attachment_ids' => $attachment_ids,
    );
}

function kermancopper_ads_cleanup_attachments( $attachment_ids ) {
    if ( empty( $attachment_ids ) || ! is_array( $attachment_ids ) ) {
        return;
    }
    foreach ( $attachment_ids as $attachment_id ) {
        wp_delete_attachment( (int) $attachment_id, true );
    }
}

function kermancopper_ads_send_otp_fallback( $email, $code, $ad_id ) {
    $subject = 'کد تایید درخواست آگهی';
    $body = sprintf( 'کد تایید شما برای آگهی شماره %d: %s', $ad_id, $code );
    $sent = false;
    if ( $email ) {
        $sent = wp_mail( $email, $subject, $body );
    }
    $admin_email = get_option( 'admin_email' );
    if ( $admin_email ) {
        $admin_sent = wp_mail( $admin_email, $subject, $body );
        $sent = $sent || $admin_sent;
    }
    return $sent;
}

function kermancopper_ads_handle_request_otp() {
    if ( $_SERVER['REQUEST_METHOD'] !== 'POST' ) {
        if ( wp_doing_ajax() ) {
            wp_send_json_error( array( 'code' => 'invalid_request', 'message' => 'درخواست نامعتبر است.' ), 400 );
        }
        wp_safe_redirect( home_url( '/' ) );
        exit;
    }
    $ad_id = isset( $_POST['ad_id'] ) ? absint( $_POST['ad_id'] ) : 0;
    $redirect_url = $ad_id ? get_permalink( $ad_id ) : home_url( '/' );
    if ( ! $ad_id || get_post_type( $ad_id ) !== 'kermancopper_ad' ) {
        if ( wp_doing_ajax() ) {
            wp_send_json_error( array( 'code' => 'invalid_ad', 'message' => 'آگهی معتبر نیست.' ), 400 );
        }
        wp_safe_redirect( add_query_arg( 'ad_request', 'invalid_ad', $redirect_url ) );
        exit;
    }
    $nonce = isset( $_POST['kermancopper_ad_request_nonce'] ) ? sanitize_text_field( wp_unslash( $_POST['kermancopper_ad_request_nonce'] ) ) : '';
    if ( ! wp_verify_nonce( $nonce, 'kermancopper_ad_request_submit' ) ) {
        if ( wp_doing_ajax() ) {
            wp_send_json_error( array( 'code' => 'invalid_nonce', 'message' => 'اعتبار فرم منقضی شده است. دوباره تلاش کنید.' ), 400 );
        }
        wp_safe_redirect( add_query_arg( 'ad_request', 'invalid_nonce', $redirect_url ) );
        exit;
    }
    if ( ! kermancopper_ads_is_ad_open( $ad_id ) ) {
        if ( wp_doing_ajax() ) {
            wp_send_json_error( array( 'code' => 'expired', 'message' => 'مهلت ثبت درخواست به پایان رسیده است.' ), 400 );
        }
        wp_safe_redirect( add_query_arg( 'ad_request', 'expired', $redirect_url ) );
        exit;
    }
    $payload = kermancopper_ads_collect_request_payload( $ad_id, $redirect_url, wp_doing_ajax() );
    if ( is_wp_error( $payload ) ) {
        if ( wp_doing_ajax() ) {
            wp_send_json_error(
                array(
                    'code'    => $payload->get_error_code(),
                    'message' => $payload->get_error_message(),
                ),
                400
            );
        }
        wp_safe_redirect( add_query_arg( 'ad_request', $payload->get_error_code(), $redirect_url ) );
        exit;
    }
    $otp_code = (string) wp_rand( 10000, 99999 );
    $otp_token = wp_generate_password( 20, false, false );
    $payload['code'] = $otp_code;
    $payload['created_at'] = time();
    set_transient( 'kermancopper_ad_otp_' . $otp_token, $payload, 10 * MINUTE_IN_SECONDS );
    $message = sprintf( 'کد تایید شما: %s', $otp_code );
    $sent = apply_filters( 'kermancopper_ads_send_otp', true, $payload['mobile'], $otp_code, $message, $ad_id );
    if ( ! $sent ) {
        $sent = true;
    }
    if ( wp_doing_ajax() ) {
        wp_send_json_success(
            array(
                'message'   => 'کد تایید ارسال شد. لطفا کد را وارد کنید.',
                'otp_token' => $otp_token,
                'otp_code'  => $otp_code,
            )
        );
    }
    $redirect_url = add_query_arg(
        array(
            'ad_request'       => 'otp_sent',
            'ad_request_token' => $otp_token,
        ),
        $redirect_url
    );
    wp_safe_redirect( $redirect_url );
    exit;
}
add_action( 'admin_post_kermancopper_ad_request_otp', 'kermancopper_ads_handle_request_otp' );
add_action( 'admin_post_nopriv_kermancopper_ad_request_otp', 'kermancopper_ads_handle_request_otp' );
add_action( 'wp_ajax_kermancopper_ad_request_otp', 'kermancopper_ads_handle_request_otp' );
add_action( 'wp_ajax_nopriv_kermancopper_ad_request_otp', 'kermancopper_ads_handle_request_otp' );

function kermancopper_ads_handle_request_verify() {
    if ( $_SERVER['REQUEST_METHOD'] !== 'POST' ) {
        if ( wp_doing_ajax() ) {
            wp_send_json_error( array( 'code' => 'invalid_request', 'message' => 'درخواست نامعتبر است.' ), 400 );
        }
        wp_safe_redirect( home_url( '/' ) );
        exit;
    }
    $ad_id = isset( $_POST['ad_id'] ) ? absint( $_POST['ad_id'] ) : 0;
    $redirect_url = $ad_id ? get_permalink( $ad_id ) : home_url( '/' );
    if ( ! $ad_id || get_post_type( $ad_id ) !== 'kermancopper_ad' ) {
        if ( wp_doing_ajax() ) {
            wp_send_json_error( array( 'code' => 'invalid_ad', 'message' => 'آگهی معتبر نیست.' ), 400 );
        }
        wp_safe_redirect( add_query_arg( 'ad_request', 'invalid_ad', $redirect_url ) );
        exit;
    }
    $nonce = isset( $_POST['kermancopper_ad_request_verify_nonce'] ) ? sanitize_text_field( wp_unslash( $_POST['kermancopper_ad_request_verify_nonce'] ) ) : '';
    if ( ! wp_verify_nonce( $nonce, 'kermancopper_ad_request_verify' ) ) {
        if ( wp_doing_ajax() ) {
            wp_send_json_error( array( 'code' => 'invalid_nonce', 'message' => 'اعتبار فرم منقضی شده است. دوباره تلاش کنید.' ), 400 );
        }
        wp_safe_redirect( add_query_arg( 'ad_request', 'invalid_nonce', $redirect_url ) );
        exit;
    }
    $otp_token = isset( $_POST['ad_request_token'] ) ? sanitize_text_field( wp_unslash( $_POST['ad_request_token'] ) ) : '';
    if ( $otp_token === '' ) {
        if ( wp_doing_ajax() ) {
            wp_send_json_error( array( 'code' => 'otp_missing', 'message' => 'کد تایید یافت نشد. دوباره تلاش کنید.' ), 400 );
        }
        wp_safe_redirect( add_query_arg( 'ad_request', 'otp_missing', $redirect_url ) );
        exit;
    }
    $payload = get_transient( 'kermancopper_ad_otp_' . $otp_token );
    if ( ! is_array( $payload ) || empty( $payload['ad_id'] ) ) {
        if ( wp_doing_ajax() ) {
            wp_send_json_error( array( 'code' => 'otp_expired', 'message' => 'کد منقضی شده است. دوباره درخواست کنید.' ), 400 );
        }
        wp_safe_redirect( add_query_arg( 'ad_request', 'otp_expired', $redirect_url ) );
        exit;
    }
    if ( (int) $payload['ad_id'] !== $ad_id ) {
        if ( wp_doing_ajax() ) {
            wp_send_json_error( array( 'code' => 'invalid_ad', 'message' => 'آگهی معتبر نیست.' ), 400 );
        }
        wp_safe_redirect( add_query_arg( 'ad_request', 'invalid_ad', $redirect_url ) );
        exit;
    }
    $code = isset( $_POST['otp_code'] ) ? sanitize_text_field( wp_unslash( $_POST['otp_code'] ) ) : '';
    if ( $code === '' || (string) $payload['code'] !== $code ) {
        if ( wp_doing_ajax() ) {
            wp_send_json_error( array( 'code' => 'otp_invalid', 'message' => 'کد وارد شده صحیح نیست.' ), 400 );
        }
        $redirect_url = add_query_arg(
            array(
                'ad_request'       => 'otp_invalid',
                'ad_request_token' => $otp_token,
            ),
            $redirect_url
        );
        wp_safe_redirect( $redirect_url );
        exit;
    }
    if ( ! kermancopper_ads_is_ad_open( $ad_id ) ) {
        if ( wp_doing_ajax() ) {
            wp_send_json_error( array( 'code' => 'expired', 'message' => 'مهلت ثبت درخواست به پایان رسیده است.' ), 400 );
        }
        wp_safe_redirect( add_query_arg( 'ad_request', 'expired', $redirect_url ) );
        exit;
    }
    $author_id = (int) get_current_user_id();
    if ( $author_id <= 0 ) {
        $admin_email = get_option( 'admin_email' );
        if ( $admin_email ) {
            $admin_user = get_user_by( 'email', $admin_email );
            if ( $admin_user ) {
                $author_id = (int) $admin_user->ID;
            }
        }
    }
    if ( $author_id <= 0 ) {
        $admin_users = get_users(
            array(
                'role__in' => array( 'administrator' ),
                'number'   => 1,
                'fields'   => array( 'ID' ),
            )
        );
        if ( ! empty( $admin_users ) ) {
            $author_id = (int) $admin_users[0]->ID;
        }
    }
    if ( $author_id <= 0 ) {
        $any_users = get_users(
            array(
                'number' => 1,
                'fields' => array( 'ID' ),
            )
        );
        if ( ! empty( $any_users ) ) {
            $author_id = (int) $any_users[0]->ID;
        }
    }
    if ( $author_id <= 0 ) {
        $author_id = 1;
    }
    $guest_cap_filter = function ( $allcaps ) {
        $allcaps['edit_posts'] = true;
        $allcaps['publish_posts'] = true;
        $allcaps['edit_private_posts'] = true;
        return $allcaps;
    };
    add_filter( 'user_has_cap', $guest_cap_filter, 10, 1 );
    $request_id = wp_insert_post(
        array(
            'post_type'   => KERMANCOPPER_AD_REQUEST_POST_TYPE,
            'post_title'  => $payload['name'] . ' - ' . current_time( 'Y-m-d H:i' ),
            'post_status' => 'private',
            'post_author' => $author_id,
        ),
        true
    );
    remove_filter( 'user_has_cap', $guest_cap_filter, 10 );
    if ( ! $request_id || is_wp_error( $request_id ) ) {
        $detail = '';
        $error_code = '';
        if ( is_wp_error( $request_id ) ) {
            $error_code = $request_id->get_error_code();
            $messages = $request_id->get_error_messages();
            if ( ! empty( $messages ) ) {
                $detail = implode( '، ', $messages );
            } else {
                $detail = $request_id->get_error_message();
            }
        } else {
            $detail = 'ثبت درخواست ناموفق بود.';
        }
        global $wpdb;
        if ( $wpdb && ! empty( $wpdb->last_error ) ) {
            $detail = trim( $detail . ' | DB: ' . $wpdb->last_error );
        }
        if ( $error_code !== '' ) {
            $detail = trim( $detail . ' | Code: ' . $error_code );
        }
        if ( wp_doing_ajax() ) {
            wp_send_json_error(
                array(
                    'code'    => 'submit_error',
                    'message' => 'ثبت درخواست با خطا روبه‌رو شد. جزئیات: ' . $detail,
                ),
                400
            );
        }
        $redirect_url = add_query_arg(
            array(
                'ad_request'       => 'submit_error',
                'ad_request_detail' => $detail,
                'ad_request_token' => $otp_token,
            ),
            $redirect_url
        );
        delete_transient( 'kermancopper_ad_otp_' . $otp_token );
        kermancopper_ads_cleanup_attachments( $payload['attachment_ids'] );
        wp_safe_redirect( $redirect_url );
        exit;
    }
    update_post_meta( $request_id, KERMANCOPPER_AD_REQUEST_META_AD_ID, $ad_id );
    update_post_meta( $request_id, KERMANCOPPER_AD_REQUEST_META_NAME, $payload['name'] );
    update_post_meta( $request_id, KERMANCOPPER_AD_REQUEST_META_MOBILE, $payload['mobile'] );
    update_post_meta( $request_id, KERMANCOPPER_AD_REQUEST_META_EMAIL, $payload['email'] );
    update_post_meta( $request_id, KERMANCOPPER_AD_REQUEST_META_COMPANY, $payload['company'] );
    update_post_meta( $request_id, KERMANCOPPER_AD_REQUEST_META_NOTE, $payload['note'] );
    update_post_meta( $request_id, KERMANCOPPER_AD_REQUEST_META_ATTACHMENTS, $payload['attachment_ids'] );
    $attachments_count = is_array( $payload['attachment_ids'] ) ? count( $payload['attachment_ids'] ) : 0;
    update_post_meta( $request_id, KERMANCOPPER_AD_REQUEST_META_ATTACHMENTS_COUNT, $attachments_count );
    update_post_meta( $request_id, KERMANCOPPER_AD_REQUEST_META_SEEN, '0' );
    $admin_email = get_option( 'admin_email' );
    $request_link = admin_url( 'edit.php?post_type=kermancopper_ad&page=kermancopper-ad-requests&request_id=' . $request_id );
    if ( $admin_email ) {
        $ad_title = get_the_title( $ad_id );
        $message_lines = array(
            'درخواست جدید ثبت شد.',
            'آگهی: ' . $ad_title,
            'نام: ' . $payload['name'],
            'موبایل: ' . $payload['mobile'],
            'ایمیل: ' . $payload['email'],
            'لینک جزئیات: ' . $request_link,
        );
        wp_mail( $admin_email, 'درخواست جدید آگهی', implode( "\n", $message_lines ) );
    }
    delete_transient( 'kermancopper_ad_otp_' . $otp_token );
    if ( wp_doing_ajax() ) {
        wp_send_json_success( array( 'message' => 'درخواست شما با موفقیت ثبت شد.' ) );
    }
    wp_safe_redirect( add_query_arg( 'ad_request', 'success', $redirect_url ) );
    exit;
}
add_action( 'admin_post_kermancopper_ad_request_verify', 'kermancopper_ads_handle_request_verify' );
add_action( 'admin_post_nopriv_kermancopper_ad_request_verify', 'kermancopper_ads_handle_request_verify' );
add_action( 'wp_ajax_kermancopper_ad_request_verify', 'kermancopper_ads_handle_request_verify' );
add_action( 'wp_ajax_nopriv_kermancopper_ad_request_verify', 'kermancopper_ads_handle_request_verify' );

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
    if ( ! $screen ) {
        return;
    }
    $allowed_screens = array(
        'kermancopper_ad',
        'kermancopper_ad_page_kermancopper-ad-requests',
    );
    if ( ! in_array( $screen->id, $allowed_screens, true ) && $screen->post_type !== 'kermancopper_ad' ) {
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
            'ajaxUrl'            => admin_url( 'admin-ajax.php' ),
            'requestNonce'       => wp_create_nonce( 'kermancopper_ad_request_detail' ),
            'closeText'          => __( 'بستن', 'kermancopper' ),
            'detailsText'        => __( 'جزئیات درخواست', 'kermancopper' ),
        )
    );
}
add_action( 'admin_enqueue_scripts', 'kermancopper_ads_admin_assets' );

function kermancopper_ads_register_requests_page() {
    add_submenu_page(
        'edit.php?post_type=kermancopper_ad',
        __( 'درخواست‌ها', 'kermancopper' ),
        __( 'درخواست‌ها', 'kermancopper' ),
        'edit_posts',
        'kermancopper-ad-requests',
        'kermancopper_ads_render_requests_page'
    );
}
add_action( 'admin_menu', 'kermancopper_ads_register_requests_page' );

function kermancopper_ads_update_request_attachments_count( $request_id ) {
    $attachments = get_post_meta( $request_id, KERMANCOPPER_AD_REQUEST_META_ATTACHMENTS, true );
    $count = is_array( $attachments ) ? count( $attachments ) : 0;
    update_post_meta( $request_id, KERMANCOPPER_AD_REQUEST_META_ATTACHMENTS_COUNT, $count );
    return $count;
}

function kermancopper_ads_get_request_filters() {
    $start_date = isset( $_GET['start_date'] ) ? sanitize_text_field( wp_unslash( $_GET['start_date'] ) ) : '';
    $end_date = isset( $_GET['end_date'] ) ? sanitize_text_field( wp_unslash( $_GET['end_date'] ) ) : '';
    $allowed_status = array( 'active', 'closed' );
    $ad_status = isset( $_GET['ad_status'] ) ? sanitize_key( wp_unslash( $_GET['ad_status'] ) ) : '';
    if ( ! in_array( $ad_status, $allowed_status, true ) ) {
        $ad_status = '';
    }
    $has_attachments = isset( $_GET['has_attachments'] ) ? sanitize_text_field( wp_unslash( $_GET['has_attachments'] ) ) : '';
    if ( ! in_array( $has_attachments, array( '1', '0' ), true ) ) {
        $has_attachments = '';
    }
    $order = isset( $_GET['order'] ) ? strtoupper( sanitize_text_field( wp_unslash( $_GET['order'] ) ) ) : 'DESC';
    if ( ! in_array( $order, array( 'ASC', 'DESC' ), true ) ) {
        $order = 'DESC';
    }
    return array(
        'ad_id'           => isset( $_GET['ad_id'] ) ? absint( wp_unslash( $_GET['ad_id'] ) ) : 0,
        'search'          => isset( $_GET['s'] ) ? sanitize_text_field( wp_unslash( $_GET['s'] ) ) : '',
        'start_date'      => $start_date,
        'end_date'        => $end_date,
        'ad_status'       => $ad_status,
        'ad_type'         => isset( $_GET['ad_type'] ) ? absint( wp_unslash( $_GET['ad_type'] ) ) : 0,
        'has_attachments' => $has_attachments,
        'order'           => $order,
    );
}

function kermancopper_ads_build_requests_action_url( $base_url, $filters, $extras ) {
    $args = array(
        'ad_id'           => $filters['ad_id'] ? $filters['ad_id'] : null,
        's'               => $filters['search'] ? $filters['search'] : null,
        'start_date'      => $filters['start_date'] ? $filters['start_date'] : null,
        'end_date'        => $filters['end_date'] ? $filters['end_date'] : null,
        'ad_status'       => $filters['ad_status'] ? $filters['ad_status'] : null,
        'ad_type'         => $filters['ad_type'] ? $filters['ad_type'] : null,
        'has_attachments' => $filters['has_attachments'] !== '' ? $filters['has_attachments'] : null,
        'order'           => $filters['order'] !== 'DESC' ? $filters['order'] : null,
    );
    $args = array_merge( $args, $extras );
    return add_query_arg( $args, $base_url );
}

function kermancopper_ads_render_requests_page() {
    if ( ! current_user_can( 'edit_posts' ) ) {
        wp_die( esc_html__( 'دسترسی غیرمجاز.', 'kermancopper' ) );
    }
    $request_id = isset( $_GET['request_id'] ) ? absint( wp_unslash( $_GET['request_id'] ) ) : 0;
    $filters = kermancopper_ads_get_request_filters();
    $paged = isset( $_GET['paged'] ) ? max( 1, absint( wp_unslash( $_GET['paged'] ) ) ) : 1;
    $action = isset( $_GET['action'] ) ? sanitize_key( wp_unslash( $_GET['action'] ) ) : '';
    $print_view = isset( $_GET['print'] ) ? absint( wp_unslash( $_GET['print'] ) ) : 0;
    $action_nonce = wp_create_nonce( 'kermancopper_ad_requests_action' );
    $ads = get_posts(
        array(
            'post_type'      => 'kermancopper_ad',
            'post_status'    => array( 'publish', 'private', 'draft' ),
            'posts_per_page' => 200,
            'orderby'        => 'date',
            'order'          => 'DESC',
        )
    );
    $ad_types = get_terms(
        array(
            'taxonomy'   => 'kermancopper_ad_type',
            'hide_empty' => false,
        )
    );
    $base_url = admin_url( 'edit.php?post_type=kermancopper_ad&page=kermancopper-ad-requests' );
    echo '<div class="wrap kermancopper-requests">';
    echo '<h1>' . esc_html__( 'درخواست‌های آگهی', 'kermancopper' ) . '</h1>';
    if ( $request_id ) {
        $request_post = get_post( $request_id );
        if ( ! $request_post || $request_post->post_type !== KERMANCOPPER_AD_REQUEST_POST_TYPE ) {
            echo '<div class="notice notice-error"><p>' . esc_html__( 'درخواست موردنظر یافت نشد.', 'kermancopper' ) . '</p></div>';
        } else {
            update_post_meta( $request_id, KERMANCOPPER_AD_REQUEST_META_SEEN, '1' );
            $request_ad_id = (int) get_post_meta( $request_id, KERMANCOPPER_AD_REQUEST_META_AD_ID, true );
            $request_name = get_post_meta( $request_id, KERMANCOPPER_AD_REQUEST_META_NAME, true );
            $request_mobile = get_post_meta( $request_id, KERMANCOPPER_AD_REQUEST_META_MOBILE, true );
            $request_email = get_post_meta( $request_id, KERMANCOPPER_AD_REQUEST_META_EMAIL, true );
            $request_company = get_post_meta( $request_id, KERMANCOPPER_AD_REQUEST_META_COMPANY, true );
            $request_note = get_post_meta( $request_id, KERMANCOPPER_AD_REQUEST_META_NOTE, true );
            $attachments = get_post_meta( $request_id, KERMANCOPPER_AD_REQUEST_META_ATTACHMENTS, true );
            if ( ! is_array( $attachments ) ) {
                $attachments = array();
            }
            $ad_title = $request_ad_id ? get_the_title( $request_ad_id ) : '';
            $ad_link = $request_ad_id ? get_edit_post_link( $request_ad_id ) : '';
            $permalink = $request_ad_id ? get_permalink( $request_ad_id ) : '';
            $created_at = mysql2date( 'Y/m/d H:i', $request_post->post_date );
            $download_all_url = add_query_arg(
                array(
                    'action'     => 'download_attachments',
                    'request_id' => $request_id,
                    '_wpnonce'   => $action_nonce,
                ),
                $base_url
            );
            echo '<a class="button kermancopper-requests-back" href="' . esc_url( $base_url ) . '">' . esc_html__( 'بازگشت به لیست درخواست‌ها', 'kermancopper' ) . '</a>';
            echo '<div class="kermancopper-requests-grid">';
            echo '<div class="kermancopper-requests-card">';
            echo '<h2>' . esc_html__( 'اطلاعات درخواست', 'kermancopper' ) . '</h2>';
            echo '<div class="kermancopper-requests-field"><span>' . esc_html__( 'نام و نام خانوادگی', 'kermancopper' ) . '</span><strong>' . esc_html( $request_name ) . '</strong></div>';
            echo '<div class="kermancopper-requests-field"><span>' . esc_html__( 'شماره موبایل', 'kermancopper' ) . '</span><strong>' . esc_html( $request_mobile ) . '</strong></div>';
            echo '<div class="kermancopper-requests-field"><span>' . esc_html__( 'ایمیل', 'kermancopper' ) . '</span><strong>' . esc_html( $request_email ) . '</strong></div>';
            if ( $request_company ) {
                echo '<div class="kermancopper-requests-field"><span>' . esc_html__( 'شرکت/سازمان', 'kermancopper' ) . '</span><strong>' . esc_html( $request_company ) . '</strong></div>';
            }
            echo '<div class="kermancopper-requests-field"><span>' . esc_html__( 'تاریخ ثبت', 'kermancopper' ) . '</span><strong>' . esc_html( $created_at ) . '</strong></div>';
            if ( $request_note ) {
                echo '<div class="kermancopper-requests-note">' . esc_html( $request_note ) . '</div>';
            }
            echo '</div>';
            echo '<div class="kermancopper-requests-card">';
            echo '<h2>' . esc_html__( 'آگهی مرتبط', 'kermancopper' ) . '</h2>';
            echo '<div class="kermancopper-requests-field"><span>' . esc_html__( 'عنوان آگهی', 'kermancopper' ) . '</span><strong>' . esc_html( $ad_title ? $ad_title : '—' ) . '</strong></div>';
            if ( $ad_link ) {
                echo '<div class="kermancopper-requests-actions">';
                echo '<a class="button button-primary" href="' . esc_url( $ad_link ) . '">' . esc_html__( 'ویرایش آگهی', 'kermancopper' ) . '</a>';
                if ( $permalink ) {
                    echo '<a class="button" href="' . esc_url( $permalink ) . '" target="_blank" rel="noopener">' . esc_html__( 'مشاهده آگهی', 'kermancopper' ) . '</a>';
                }
                echo '</div>';
            }
            echo '</div>';
            echo '<div class="kermancopper-requests-card">';
            echo '<h2>' . esc_html__( 'فایل‌های پیوست', 'kermancopper' ) . '</h2>';
            if ( ! empty( $attachments ) ) {
                echo '<div class="kermancopper-requests-actions">';
                echo '<a class="button button-primary" href="' . esc_url( $download_all_url ) . '">' . esc_html__( 'دانلود همه پیوست‌ها', 'kermancopper' ) . '</a>';
                echo '</div>';
            }
            if ( empty( $attachments ) ) {
                echo '<div class="kermancopper-requests-empty">' . esc_html__( 'فایلی ثبت نشده است.', 'kermancopper' ) . '</div>';
            } else {
                echo '<ul class="kermancopper-requests-files">';
                foreach ( $attachments as $attachment_id ) {
                    $attachment_id = (int) $attachment_id;
                    $file_url = wp_get_attachment_url( $attachment_id );
                    $file_path = get_attached_file( $attachment_id );
                    $file_name = $file_path ? wp_basename( $file_path ) : ( $file_url ? wp_basename( $file_url ) : '#' );
                    $file_size = $file_path && file_exists( $file_path ) ? size_format( filesize( $file_path ) ) : '';
                    $mime_type = $attachment_id ? get_post_mime_type( $attachment_id ) : '';
                    echo '<li>';
                    echo '<div class="kermancopper-requests-file-name">' . esc_html( $file_name ) . '</div>';
                    echo '<div class="kermancopper-requests-file-meta">';
                    if ( $file_size ) {
                        echo '<span>' . esc_html( $file_size ) . '</span>';
                    }
                    if ( $mime_type ) {
                        echo '<span>' . esc_html( $mime_type ) . '</span>';
                    }
                    echo '</div>';
                    if ( $file_url ) {
                        echo '<a class="button button-small" href="' . esc_url( $file_url ) . '" target="_blank" rel="noopener">' . esc_html__( 'دانلود', 'kermancopper' ) . '</a>';
                    }
                    echo '</li>';
                }
                echo '</ul>';
            }
            echo '</div>';
            echo '</div>';
        }
        echo '</div>';
        return;
    }
    if ( $filters['has_attachments'] !== '' ) {
        $missing_counts = get_posts(
            array(
                'post_type'      => KERMANCOPPER_AD_REQUEST_POST_TYPE,
                'post_status'    => 'private',
                'fields'         => 'ids',
                'posts_per_page' => 200,
                'meta_query'     => array(
                    array(
                        'key'     => KERMANCOPPER_AD_REQUEST_META_ATTACHMENTS_COUNT,
                        'compare' => 'NOT EXISTS',
                    ),
                ),
            )
        );
        foreach ( $missing_counts as $missing_id ) {
            kermancopper_ads_update_request_attachments_count( $missing_id );
        }
    }
    $ad_ids_filter = array();
    $ad_ids_filtered_by_meta = array();
    if ( $filters['ad_status'] || $filters['ad_type'] ) {
        $ad_query_args = array(
            'post_type'      => 'kermancopper_ad',
            'post_status'    => array( 'publish', 'private', 'draft' ),
            'fields'         => 'ids',
            'posts_per_page' => -1,
        );
        if ( $filters['ad_status'] ) {
            $ad_query_args['meta_query'] = array(
                array(
                    'key'     => KERMANCOPPER_AD_META_STATUS,
                    'value'   => $filters['ad_status'],
                    'compare' => '=',
                ),
            );
        }
        if ( $filters['ad_type'] ) {
            $ad_query_args['tax_query'] = array(
                array(
                    'taxonomy' => 'kermancopper_ad_type',
                    'field'    => 'term_id',
                    'terms'    => array( $filters['ad_type'] ),
                ),
            );
        }
        $ad_ids_filtered_by_meta = get_posts( $ad_query_args );
    }
    if ( $filters['ad_id'] ) {
        if ( ! empty( $ad_ids_filtered_by_meta ) && ! in_array( $filters['ad_id'], $ad_ids_filtered_by_meta, true ) ) {
            $ad_ids_filter = array( 0 );
        } else {
            $ad_ids_filter = array( $filters['ad_id'] );
        }
    } elseif ( ! empty( $ad_ids_filtered_by_meta ) ) {
        $ad_ids_filter = $ad_ids_filtered_by_meta;
    } elseif ( $filters['ad_status'] || $filters['ad_type'] ) {
        $ad_ids_filter = array( 0 );
    }
    $meta_query = array( 'relation' => 'AND' );
    if ( ! empty( $ad_ids_filter ) ) {
        $meta_query[] = array(
            'key'     => KERMANCOPPER_AD_REQUEST_META_AD_ID,
            'value'   => $ad_ids_filter,
            'compare' => 'IN',
        );
    }
    if ( $filters['search'] !== '' ) {
        $meta_query[] = array(
            'relation' => 'OR',
            array(
                'key'     => KERMANCOPPER_AD_REQUEST_META_NAME,
                'value'   => $filters['search'],
                'compare' => 'LIKE',
            ),
            array(
                'key'     => KERMANCOPPER_AD_REQUEST_META_MOBILE,
                'value'   => $filters['search'],
                'compare' => 'LIKE',
            ),
            array(
                'key'     => KERMANCOPPER_AD_REQUEST_META_EMAIL,
                'value'   => $filters['search'],
                'compare' => 'LIKE',
            ),
            array(
                'key'     => KERMANCOPPER_AD_REQUEST_META_COMPANY,
                'value'   => $filters['search'],
                'compare' => 'LIKE',
            ),
        );
    }
    if ( $filters['has_attachments'] !== '' ) {
        $meta_query[] = array(
            'key'     => KERMANCOPPER_AD_REQUEST_META_ATTACHMENTS_COUNT,
            'value'   => $filters['has_attachments'] === '1' ? 1 : 0,
            'compare' => $filters['has_attachments'] === '1' ? '>=' : '=',
            'type'    => 'NUMERIC',
        );
    }
    $date_query = array();
    if ( $filters['start_date'] !== '' ) {
        $date_query['after'] = $filters['start_date'];
    }
    if ( $filters['end_date'] !== '' ) {
        $date_query['before'] = $filters['end_date'];
    }
    if ( ! empty( $date_query ) ) {
        $date_query['inclusive'] = true;
    }
    $query_args = array(
        'post_type'      => KERMANCOPPER_AD_REQUEST_POST_TYPE,
        'post_status'    => 'private',
        'posts_per_page' => 20,
        'paged'          => $paged,
        'orderby'        => 'date',
        'order'          => $filters['order'],
    );
    if ( count( $meta_query ) > 1 ) {
        $query_args['meta_query'] = $meta_query;
    }
    if ( ! empty( $date_query ) ) {
        $query_args['date_query'] = array( $date_query );
    }
    $request_query = new WP_Query( $query_args );
    if ( $action === 'download_csv' || $action === 'download_attachments' ) {
        $nonce_value = isset( $_GET['_wpnonce'] ) ? sanitize_text_field( wp_unslash( $_GET['_wpnonce'] ) ) : '';
        if ( ! wp_verify_nonce( $nonce_value, 'kermancopper_ad_requests_action' ) ) {
            wp_die( esc_html__( 'دسترسی غیرمجاز.', 'kermancopper' ) );
        }
        $single_request_id = isset( $_GET['request_id'] ) ? absint( wp_unslash( $_GET['request_id'] ) ) : 0;
        $export_query = null;
        if ( $single_request_id ) {
            $export_query = new WP_Query(
                array(
                    'post_type'      => KERMANCOPPER_AD_REQUEST_POST_TYPE,
                    'post_status'    => 'private',
                    'posts_per_page' => 1,
                    'post__in'       => array( $single_request_id ),
                )
            );
        } else {
            $export_args = $query_args;
            $export_args['posts_per_page'] = -1;
            $export_args['paged'] = 1;
            $export_query = new WP_Query( $export_args );
        }
        if ( $action === 'download_csv' ) {
            $filename = 'ad-requests-' . current_time( 'Ymd-His' ) . '.csv';
            header( 'Content-Type: text/csv; charset=utf-8' );
            header( 'Content-Disposition: attachment; filename=' . $filename );
            $output = fopen( 'php://output', 'w' );
            fputcsv( $output, array( 'نام', 'موبایل', 'ایمیل', 'شرکت', 'آگهی', 'تاریخ', 'تعداد پیوست' ) );
            if ( $export_query->have_posts() ) {
                while ( $export_query->have_posts() ) {
                    $export_query->the_post();
                    $req_id = get_the_ID();
                    $req_ad_id = (int) get_post_meta( $req_id, KERMANCOPPER_AD_REQUEST_META_AD_ID, true );
                    $attachments_count = (int) get_post_meta( $req_id, KERMANCOPPER_AD_REQUEST_META_ATTACHMENTS_COUNT, true );
                    if ( $attachments_count === 0 ) {
                        $attachments_count = kermancopper_ads_update_request_attachments_count( $req_id );
                    }
                    fputcsv(
                        $output,
                        array(
                            get_post_meta( $req_id, KERMANCOPPER_AD_REQUEST_META_NAME, true ),
                            get_post_meta( $req_id, KERMANCOPPER_AD_REQUEST_META_MOBILE, true ),
                            get_post_meta( $req_id, KERMANCOPPER_AD_REQUEST_META_EMAIL, true ),
                            get_post_meta( $req_id, KERMANCOPPER_AD_REQUEST_META_COMPANY, true ),
                            $req_ad_id ? get_the_title( $req_ad_id ) : '',
                            get_the_date( 'Y/m/d H:i', $req_id ),
                            $attachments_count,
                        )
                    );
                }
                wp_reset_postdata();
            }
            fclose( $output );
            exit;
        }
        if ( $action === 'download_attachments' ) {
            $request_ids = $export_query->posts;
            $file_paths = array();
            foreach ( $request_ids as $req_id ) {
                $attachments = get_post_meta( $req_id, KERMANCOPPER_AD_REQUEST_META_ATTACHMENTS, true );
                if ( is_array( $attachments ) ) {
                    foreach ( $attachments as $attachment_id ) {
                        $file_path = get_attached_file( (int) $attachment_id );
                        if ( $file_path && file_exists( $file_path ) ) {
                            $file_paths[] = $file_path;
                        }
                    }
                }
            }
            if ( empty( $file_paths ) ) {
                wp_die( esc_html__( 'فایلی برای دانلود یافت نشد.', 'kermancopper' ) );
            }
            if ( ! class_exists( 'ZipArchive' ) ) {
                wp_die( esc_html__( 'ZipArchive در دسترس نیست.', 'kermancopper' ) );
            }
            $zip = new ZipArchive();
            $tmp_file = wp_tempnam( 'kermancopper-attachments' );
            if ( ! $zip->open( $tmp_file, ZipArchive::CREATE | ZipArchive::OVERWRITE ) ) {
                wp_die( esc_html__( 'امکان ساخت فایل فشرده وجود ندارد.', 'kermancopper' ) );
            }
            foreach ( $file_paths as $path ) {
                $zip->addFile( $path, wp_basename( $path ) );
            }
            $zip->close();
            $zip_name = 'ad-attachments-' . current_time( 'Ymd-His' ) . '.zip';
            header( 'Content-Type: application/zip' );
            header( 'Content-Disposition: attachment; filename=' . $zip_name );
            header( 'Content-Length: ' . filesize( $tmp_file ) );
            readfile( $tmp_file );
            @unlink( $tmp_file );
            exit;
        }
    }
    if ( $print_view ) {
        $print_args = $query_args;
        $print_args['posts_per_page'] = -1;
        $print_args['paged'] = 1;
        $print_query = new WP_Query( $print_args );
        echo '<div class="kermancopper-requests-print">';
        echo '<h2>' . esc_html__( 'لیست درخواست‌ها', 'kermancopper' ) . '</h2>';
        echo '<table class="widefat striped kermancopper-requests-table">';
        echo '<thead><tr>';
        echo '<th>' . esc_html__( 'نام', 'kermancopper' ) . '</th>';
        echo '<th>' . esc_html__( 'موبایل', 'kermancopper' ) . '</th>';
        echo '<th>' . esc_html__( 'ایمیل', 'kermancopper' ) . '</th>';
        echo '<th>' . esc_html__( 'شرکت', 'kermancopper' ) . '</th>';
        echo '<th>' . esc_html__( 'آگهی', 'kermancopper' ) . '</th>';
        echo '<th>' . esc_html__( 'تاریخ', 'kermancopper' ) . '</th>';
        echo '<th>' . esc_html__( 'پیوست', 'kermancopper' ) . '</th>';
        echo '</tr></thead><tbody>';
        if ( $print_query->have_posts() ) {
            while ( $print_query->have_posts() ) {
                $print_query->the_post();
                $req_id = get_the_ID();
                $req_ad_id = (int) get_post_meta( $req_id, KERMANCOPPER_AD_REQUEST_META_AD_ID, true );
                $attachments_count = (int) get_post_meta( $req_id, KERMANCOPPER_AD_REQUEST_META_ATTACHMENTS_COUNT, true );
                if ( $attachments_count === 0 ) {
                    $attachments_count = kermancopper_ads_update_request_attachments_count( $req_id );
                }
                echo '<tr>';
                echo '<td>' . esc_html( get_post_meta( $req_id, KERMANCOPPER_AD_REQUEST_META_NAME, true ) ) . '</td>';
                echo '<td>' . esc_html( get_post_meta( $req_id, KERMANCOPPER_AD_REQUEST_META_MOBILE, true ) ) . '</td>';
                echo '<td>' . esc_html( get_post_meta( $req_id, KERMANCOPPER_AD_REQUEST_META_EMAIL, true ) ) . '</td>';
                echo '<td>' . esc_html( get_post_meta( $req_id, KERMANCOPPER_AD_REQUEST_META_COMPANY, true ) ) . '</td>';
                echo '<td>' . esc_html( $req_ad_id ? get_the_title( $req_ad_id ) : '—' ) . '</td>';
                echo '<td>' . esc_html( get_the_date( 'Y/m/d H:i', $req_id ) ) . '</td>';
                echo '<td>' . esc_html( $attachments_count ) . '</td>';
                echo '</tr>';
            }
            wp_reset_postdata();
        }
        echo '</tbody></table>';
        echo '<script>window.print();</script>';
        echo '</div>';
        echo '</div>';
        return;
    }
    $count_obj = wp_count_posts( KERMANCOPPER_AD_REQUEST_POST_TYPE );
    $total_requests = $count_obj && isset( $count_obj->private ) ? (int) $count_obj->private : 0;
    $today_start = date( 'Y-m-d', current_time( 'timestamp' ) );
    $week_start = date( 'Y-m-d', strtotime( 'monday this week', current_time( 'timestamp' ) ) );
    $today_count = new WP_Query(
        array(
            'post_type'      => KERMANCOPPER_AD_REQUEST_POST_TYPE,
            'post_status'    => 'private',
            'posts_per_page' => 1,
            'date_query'     => array(
                array(
                    'after'     => $today_start,
                    'inclusive' => true,
                ),
            ),
        )
    );
    $week_count = new WP_Query(
        array(
            'post_type'      => KERMANCOPPER_AD_REQUEST_POST_TYPE,
            'post_status'    => 'private',
            'posts_per_page' => 1,
            'date_query'     => array(
                array(
                    'after'     => $week_start,
                    'inclusive' => true,
                ),
            ),
        )
    );
    $active_ads = 0;
    foreach ( $ads as $ad_post ) {
        if ( kermancopper_ads_is_ad_open( $ad_post->ID ) ) {
            $active_ads++;
        }
    }
    echo '<div class="kermancopper-requests-cards">';
    echo '<div class="kermancopper-requests-card kermancopper-requests-stat"><span>' . esc_html__( 'کل درخواست‌ها', 'kermancopper' ) . '</span><strong>' . esc_html( number_format_i18n( $total_requests ) ) . '</strong></div>';
    echo '<div class="kermancopper-requests-card kermancopper-requests-stat"><span>' . esc_html__( 'امروز', 'kermancopper' ) . '</span><strong>' . esc_html( number_format_i18n( $today_count->found_posts ) ) . '</strong></div>';
    echo '<div class="kermancopper-requests-card kermancopper-requests-stat"><span>' . esc_html__( 'این هفته', 'kermancopper' ) . '</span><strong>' . esc_html( number_format_i18n( $week_count->found_posts ) ) . '</strong></div>';
    echo '<div class="kermancopper-requests-card kermancopper-requests-stat"><span>' . esc_html__( 'آگهی‌های فعال', 'kermancopper' ) . '</span><strong>' . esc_html( number_format_i18n( $active_ads ) ) . '</strong></div>';
    echo '<div class="kermancopper-requests-card kermancopper-requests-stat"><span>' . esc_html__( 'نتایج فیلتر', 'kermancopper' ) . '</span><strong>' . esc_html( number_format_i18n( $request_query->found_posts ) ) . '</strong></div>';
    echo '</div>';
    echo '<div class="kermancopper-requests-actions-bar">';
    echo '<a class="button button-secondary" href="' . esc_url( kermancopper_ads_build_requests_action_url( $base_url, $filters, array( 'action' => 'download_attachments', '_wpnonce' => $action_nonce ) ) ) . '">' . esc_html__( 'دانلود همه پیوست‌ها', 'kermancopper' ) . '</a>';
    echo '<a class="button button-secondary" href="' . esc_url( kermancopper_ads_build_requests_action_url( $base_url, $filters, array( 'action' => 'download_csv', '_wpnonce' => $action_nonce ) ) ) . '">' . esc_html__( 'خروجی CSV', 'kermancopper' ) . '</a>';
    echo '<a class="button" href="' . esc_url( kermancopper_ads_build_requests_action_url( $base_url, $filters, array( 'print' => 1 ) ) ) . '" target="_blank" rel="noopener">' . esc_html__( 'چاپ لیست', 'kermancopper' ) . '</a>';
    echo '</div>';
    echo '<form method="get" class="kermancopper-requests-filters">';
    echo '<input type="hidden" name="post_type" value="kermancopper_ad" />';
    echo '<input type="hidden" name="page" value="kermancopper-ad-requests" />';
    echo '<label for="kermancopper-requests-ad-filter">' . esc_html__( 'آگهی', 'kermancopper' ) . '</label>';
    echo '<select id="kermancopper-requests-ad-filter" name="ad_id">';
    echo '<option value="0">' . esc_html__( 'همه آگهی‌ها', 'kermancopper' ) . '</option>';
    foreach ( $ads as $ad_post ) {
        echo '<option value="' . esc_attr( $ad_post->ID ) . '"' . selected( $filters['ad_id'], $ad_post->ID, false ) . '>' . esc_html( $ad_post->post_title ) . '</option>';
    }
    echo '</select>';
    echo '<label for="kermancopper-requests-ad-type">' . esc_html__( 'نوع آگهی', 'kermancopper' ) . '</label>';
    echo '<select id="kermancopper-requests-ad-type" name="ad_type">';
    echo '<option value="0">' . esc_html__( 'همه انواع', 'kermancopper' ) . '</option>';
    if ( ! is_wp_error( $ad_types ) ) {
        foreach ( $ad_types as $term ) {
            echo '<option value="' . esc_attr( $term->term_id ) . '"' . selected( $filters['ad_type'], $term->term_id, false ) . '>' . esc_html( $term->name ) . '</option>';
        }
    }
    echo '</select>';
    echo '<label for="kermancopper-requests-ad-status">' . esc_html__( 'وضعیت آگهی', 'kermancopper' ) . '</label>';
    echo '<select id="kermancopper-requests-ad-status" name="ad_status">';
    echo '<option value="">' . esc_html__( 'همه وضعیت‌ها', 'kermancopper' ) . '</option>';
    echo '<option value="active"' . selected( $filters['ad_status'], 'active', false ) . '>' . esc_html__( 'فعال', 'kermancopper' ) . '</option>';
    echo '<option value="closed"' . selected( $filters['ad_status'], 'closed', false ) . '>' . esc_html__( 'بسته', 'kermancopper' ) . '</option>';
    echo '</select>';
    echo '<label for="kermancopper-requests-start-date">' . esc_html__( 'از تاریخ', 'kermancopper' ) . '</label>';
    echo '<input type="date" id="kermancopper-requests-start-date" name="start_date" value="' . esc_attr( $filters['start_date'] ) . '" />';
    echo '<label for="kermancopper-requests-end-date">' . esc_html__( 'تا تاریخ', 'kermancopper' ) . '</label>';
    echo '<input type="date" id="kermancopper-requests-end-date" name="end_date" value="' . esc_attr( $filters['end_date'] ) . '" />';
    echo '<label for="kermancopper-requests-attachments">' . esc_html__( 'پیوست', 'kermancopper' ) . '</label>';
    echo '<select id="kermancopper-requests-attachments" name="has_attachments">';
    echo '<option value="">' . esc_html__( 'همه', 'kermancopper' ) . '</option>';
    echo '<option value="1"' . selected( $filters['has_attachments'], '1', false ) . '>' . esc_html__( 'دارای پیوست', 'kermancopper' ) . '</option>';
    echo '<option value="0"' . selected( $filters['has_attachments'], '0', false ) . '>' . esc_html__( 'بدون پیوست', 'kermancopper' ) . '</option>';
    echo '</select>';
    echo '<label for="kermancopper-requests-search">' . esc_html__( 'جستجو', 'kermancopper' ) . '</label>';
    echo '<input type="search" id="kermancopper-requests-search" name="s" value="' . esc_attr( $filters['search'] ) . '" placeholder="' . esc_attr__( 'نام، موبایل یا ایمیل', 'kermancopper' ) . '" />';
    echo '<label for="kermancopper-requests-order">' . esc_html__( 'مرتب‌سازی', 'kermancopper' ) . '</label>';
    echo '<select id="kermancopper-requests-order" name="order">';
    echo '<option value="DESC"' . selected( $filters['order'], 'DESC', false ) . '>' . esc_html__( 'جدیدترین', 'kermancopper' ) . '</option>';
    echo '<option value="ASC"' . selected( $filters['order'], 'ASC', false ) . '>' . esc_html__( 'قدیمی‌ترین', 'kermancopper' ) . '</option>';
    echo '</select>';
    echo '<button class="button button-primary" type="submit">' . esc_html__( 'اعمال فیلتر', 'kermancopper' ) . '</button>';
    echo '<a class="button" href="' . esc_url( $base_url ) . '">' . esc_html__( 'حذف فیلتر', 'kermancopper' ) . '</a>';
    echo '</form>';
    echo '<table class="widefat striped kermancopper-requests-table">';
    echo '<thead><tr>';
    echo '<th>' . esc_html__( 'نام', 'kermancopper' ) . '</th>';
    echo '<th>' . esc_html__( 'موبایل', 'kermancopper' ) . '</th>';
    echo '<th>' . esc_html__( 'ایمیل', 'kermancopper' ) . '</th>';
    echo '<th>' . esc_html__( 'شرکت', 'kermancopper' ) . '</th>';
    echo '<th>' . esc_html__( 'آگهی', 'kermancopper' ) . '</th>';
    echo '<th>' . esc_html__( 'تاریخ', 'kermancopper' ) . '</th>';
    echo '<th>' . esc_html__( 'پیوست', 'kermancopper' ) . '</th>';
    echo '<th>' . esc_html__( 'عملیات', 'kermancopper' ) . '</th>';
    echo '</tr></thead>';
    echo '<tbody>';
    if ( $request_query->have_posts() ) {
        while ( $request_query->have_posts() ) {
            $request_query->the_post();
            $req_id = get_the_ID();
            $req_name = get_post_meta( $req_id, KERMANCOPPER_AD_REQUEST_META_NAME, true );
            $req_mobile = get_post_meta( $req_id, KERMANCOPPER_AD_REQUEST_META_MOBILE, true );
            $req_email = get_post_meta( $req_id, KERMANCOPPER_AD_REQUEST_META_EMAIL, true );
            $req_company = get_post_meta( $req_id, KERMANCOPPER_AD_REQUEST_META_COMPANY, true );
            $req_ad_id = (int) get_post_meta( $req_id, KERMANCOPPER_AD_REQUEST_META_AD_ID, true );
            $req_ad_title = $req_ad_id ? get_the_title( $req_ad_id ) : '';
            $req_date = get_the_date( 'Y/m/d H:i', $req_id );
            $req_attachments_count = (int) get_post_meta( $req_id, KERMANCOPPER_AD_REQUEST_META_ATTACHMENTS_COUNT, true );
            if ( $req_attachments_count === 0 ) {
                $req_attachments_count = kermancopper_ads_update_request_attachments_count( $req_id );
            }
            $req_seen = get_post_meta( $req_id, KERMANCOPPER_AD_REQUEST_META_SEEN, true );
            $detail_url = add_query_arg(
                array(
                    'post_type'  => 'kermancopper_ad',
                    'page'       => 'kermancopper-ad-requests',
                    'request_id' => $req_id,
                ),
                admin_url( 'edit.php' )
            );
            echo '<tr' . ( $req_seen === '1' ? '' : ' class="kermancopper-requests-new"' ) . '>';
            echo '<td><strong>' . esc_html( $req_name ) . '</strong></td>';
            echo '<td>' . esc_html( $req_mobile ) . '</td>';
            echo '<td>' . esc_html( $req_email ) . '</td>';
            echo '<td>' . esc_html( $req_company ? $req_company : '—' ) . '</td>';
            echo '<td>' . esc_html( $req_ad_title ? $req_ad_title : '—' ) . '</td>';
            echo '<td>' . esc_html( $req_date ) . '</td>';
            echo '<td>' . esc_html( $req_attachments_count ) . '</td>';
            echo '<td>';
            echo '<button type="button" class="button button-small kermancopper-requests-open" data-request-id="' . esc_attr( $req_id ) . '">' . esc_html__( 'نمایش سریع', 'kermancopper' ) . '</button>';
            echo '<a class="button button-small" href="' . esc_url( $detail_url ) . '">' . esc_html__( 'صفحه جزئیات', 'kermancopper' ) . '</a>';
            echo '</td>';
            echo '</tr>';
        }
        wp_reset_postdata();
    } else {
        echo '<tr><td colspan="8">' . esc_html__( 'درخواستی پیدا نشد.', 'kermancopper' ) . '</td></tr>';
    }
    echo '</tbody>';
    echo '</table>';
    $total_pages = (int) $request_query->max_num_pages;
    if ( $total_pages > 1 ) {
        $pagination_base = add_query_arg(
            array(
                'post_type' => 'kermancopper_ad',
                'page'      => 'kermancopper-ad-requests',
                'ad_id'     => $filters['ad_id'] ? $filters['ad_id'] : null,
                's'         => $filters['search'] ? $filters['search'] : null,
                'start_date'=> $filters['start_date'] ? $filters['start_date'] : null,
                'end_date'  => $filters['end_date'] ? $filters['end_date'] : null,
                'ad_status' => $filters['ad_status'] ? $filters['ad_status'] : null,
                'ad_type'   => $filters['ad_type'] ? $filters['ad_type'] : null,
                'has_attachments' => $filters['has_attachments'] !== '' ? $filters['has_attachments'] : null,
                'order'     => $filters['order'] !== 'DESC' ? $filters['order'] : null,
                'paged'     => '%#%',
            ),
            admin_url( 'edit.php' )
        );
        echo '<div class="tablenav"><div class="tablenav-pages">';
        echo paginate_links(
            array(
                'base'      => $pagination_base,
                'format'    => '',
                'current'   => $paged,
                'total'     => $total_pages,
                'prev_text' => '‹',
                'next_text' => '›',
            )
        );
        echo '</div></div>';
    }
    echo '<div class="kermancopper-requests-drawer" id="kermancopper-requests-drawer" aria-hidden="true">';
    echo '<div class="kermancopper-requests-drawer-backdrop"></div>';
    echo '<div class="kermancopper-requests-drawer-panel">';
    echo '<div class="kermancopper-requests-drawer-header">';
    echo '<h3>' . esc_html__( 'جزئیات درخواست', 'kermancopper' ) . '</h3>';
    echo '<button type="button" class="button kermancopper-requests-drawer-close">' . esc_html__( 'بستن', 'kermancopper' ) . '</button>';
    echo '</div>';
    echo '<div class="kermancopper-requests-drawer-body"></div>';
    echo '</div>';
    echo '</div>';
    echo '</div>';
}

function kermancopper_ads_get_request_detail_html( $request_id, $action_nonce ) {
    $request_post = get_post( $request_id );
    if ( ! $request_post || $request_post->post_type !== KERMANCOPPER_AD_REQUEST_POST_TYPE ) {
        return '<div class="kermancopper-requests-empty">' . esc_html__( 'درخواست موردنظر یافت نشد.', 'kermancopper' ) . '</div>';
    }
    $request_ad_id = (int) get_post_meta( $request_id, KERMANCOPPER_AD_REQUEST_META_AD_ID, true );
    $request_name = get_post_meta( $request_id, KERMANCOPPER_AD_REQUEST_META_NAME, true );
    $request_mobile = get_post_meta( $request_id, KERMANCOPPER_AD_REQUEST_META_MOBILE, true );
    $request_email = get_post_meta( $request_id, KERMANCOPPER_AD_REQUEST_META_EMAIL, true );
    $request_company = get_post_meta( $request_id, KERMANCOPPER_AD_REQUEST_META_COMPANY, true );
    $request_note = get_post_meta( $request_id, KERMANCOPPER_AD_REQUEST_META_NOTE, true );
    $attachments = get_post_meta( $request_id, KERMANCOPPER_AD_REQUEST_META_ATTACHMENTS, true );
    if ( ! is_array( $attachments ) ) {
        $attachments = array();
    }
    $ad_title = $request_ad_id ? get_the_title( $request_ad_id ) : '';
    $ad_link = $request_ad_id ? get_edit_post_link( $request_ad_id ) : '';
    $permalink = $request_ad_id ? get_permalink( $request_ad_id ) : '';
    $created_at = mysql2date( 'Y/m/d H:i', $request_post->post_date );
    $download_all_url = admin_url(
        add_query_arg(
            array(
                'post_type'  => 'kermancopper_ad',
                'page'       => 'kermancopper-ad-requests',
                'action'     => 'download_attachments',
                'request_id' => $request_id,
                '_wpnonce'   => $action_nonce,
            ),
            'edit.php'
        )
    );
    $detail_url = admin_url(
        add_query_arg(
            array(
                'post_type'  => 'kermancopper_ad',
                'page'       => 'kermancopper-ad-requests',
                'request_id' => $request_id,
            ),
            'edit.php'
        )
    );
    ob_start();
    echo '<div class="kermancopper-requests-drawer-content">';
    echo '<div class="kermancopper-requests-card">';
    echo '<h4>' . esc_html__( 'اطلاعات درخواست', 'kermancopper' ) . '</h4>';
    echo '<div class="kermancopper-requests-field"><span>' . esc_html__( 'نام و نام خانوادگی', 'kermancopper' ) . '</span><strong>' . esc_html( $request_name ) . '</strong></div>';
    echo '<div class="kermancopper-requests-field"><span>' . esc_html__( 'شماره موبایل', 'kermancopper' ) . '</span><strong>' . esc_html( $request_mobile ) . '</strong></div>';
    echo '<div class="kermancopper-requests-field"><span>' . esc_html__( 'ایمیل', 'kermancopper' ) . '</span><strong>' . esc_html( $request_email ) . '</strong></div>';
    if ( $request_company ) {
        echo '<div class="kermancopper-requests-field"><span>' . esc_html__( 'شرکت/سازمان', 'kermancopper' ) . '</span><strong>' . esc_html( $request_company ) . '</strong></div>';
    }
    echo '<div class="kermancopper-requests-field"><span>' . esc_html__( 'تاریخ ثبت', 'kermancopper' ) . '</span><strong>' . esc_html( $created_at ) . '</strong></div>';
    if ( $request_note ) {
        echo '<div class="kermancopper-requests-note">' . esc_html( $request_note ) . '</div>';
    }
    echo '</div>';
    echo '<div class="kermancopper-requests-card">';
    echo '<h4>' . esc_html__( 'آگهی مرتبط', 'kermancopper' ) . '</h4>';
    echo '<div class="kermancopper-requests-field"><span>' . esc_html__( 'عنوان آگهی', 'kermancopper' ) . '</span><strong>' . esc_html( $ad_title ? $ad_title : '—' ) . '</strong></div>';
    echo '<div class="kermancopper-requests-actions">';
    if ( $ad_link ) {
        echo '<a class="button button-primary" href="' . esc_url( $ad_link ) . '">' . esc_html__( 'ویرایش آگهی', 'kermancopper' ) . '</a>';
    }
    if ( $permalink ) {
        echo '<a class="button" href="' . esc_url( $permalink ) . '" target="_blank" rel="noopener">' . esc_html__( 'مشاهده آگهی', 'kermancopper' ) . '</a>';
    }
    echo '<a class="button" href="' . esc_url( $detail_url ) . '">' . esc_html__( 'صفحه جزئیات', 'kermancopper' ) . '</a>';
    echo '</div>';
    echo '</div>';
    echo '<div class="kermancopper-requests-card">';
    echo '<h4>' . esc_html__( 'فایل‌های پیوست', 'kermancopper' ) . '</h4>';
    if ( ! empty( $attachments ) ) {
        echo '<div class="kermancopper-requests-actions">';
        echo '<a class="button button-primary" href="' . esc_url( $download_all_url ) . '">' . esc_html__( 'دانلود همه پیوست‌ها', 'kermancopper' ) . '</a>';
        echo '</div>';
    }
    if ( empty( $attachments ) ) {
        echo '<div class="kermancopper-requests-empty">' . esc_html__( 'فایلی ثبت نشده است.', 'kermancopper' ) . '</div>';
    } else {
        echo '<ul class="kermancopper-requests-files">';
        foreach ( $attachments as $attachment_id ) {
            $attachment_id = (int) $attachment_id;
            $file_url = wp_get_attachment_url( $attachment_id );
            $file_path = get_attached_file( $attachment_id );
            $file_name = $file_path ? wp_basename( $file_path ) : ( $file_url ? wp_basename( $file_url ) : '#' );
            $file_size = $file_path && file_exists( $file_path ) ? size_format( filesize( $file_path ) ) : '';
            $mime_type = $attachment_id ? get_post_mime_type( $attachment_id ) : '';
            echo '<li>';
            echo '<div class="kermancopper-requests-file-name">' . esc_html( $file_name ) . '</div>';
            echo '<div class="kermancopper-requests-file-meta">';
            if ( $file_size ) {
                echo '<span>' . esc_html( $file_size ) . '</span>';
            }
            if ( $mime_type ) {
                echo '<span>' . esc_html( $mime_type ) . '</span>';
            }
            echo '</div>';
            if ( $file_url ) {
                echo '<a class="button button-small" href="' . esc_url( $file_url ) . '" target="_blank" rel="noopener">' . esc_html__( 'دانلود', 'kermancopper' ) . '</a>';
            }
            echo '</li>';
        }
        echo '</ul>';
    }
    echo '</div>';
    echo '</div>';
    return ob_get_clean();
}

function kermancopper_ads_ajax_request_detail() {
    if ( ! current_user_can( 'edit_posts' ) ) {
        wp_send_json_error( array( 'message' => 'دسترسی غیرمجاز.' ), 403 );
    }
    $nonce = isset( $_POST['nonce'] ) ? sanitize_text_field( wp_unslash( $_POST['nonce'] ) ) : '';
    if ( ! wp_verify_nonce( $nonce, 'kermancopper_ad_request_detail' ) ) {
        wp_send_json_error( array( 'message' => 'دسترسی غیرمجاز.' ), 403 );
    }
    $request_id = isset( $_POST['request_id'] ) ? absint( wp_unslash( $_POST['request_id'] ) ) : 0;
    if ( ! $request_id ) {
        wp_send_json_error( array( 'message' => 'درخواست معتبر نیست.' ), 404 );
    }
    update_post_meta( $request_id, KERMANCOPPER_AD_REQUEST_META_SEEN, '1' );
    $html = kermancopper_ads_get_request_detail_html( $request_id, wp_create_nonce( 'kermancopper_ad_requests_action' ) );
    wp_send_json_success( array( 'html' => $html ) );
}
add_action( 'wp_ajax_kermancopper_ad_request_detail', 'kermancopper_ads_ajax_request_detail' );

function kermancopper_ads_requests_badge_count() {
    $query = new WP_Query(
        array(
            'post_type'      => KERMANCOPPER_AD_REQUEST_POST_TYPE,
            'post_status'    => 'private',
            'posts_per_page' => 1,
            'meta_query'     => array(
                'relation' => 'OR',
                array(
                    'key'     => KERMANCOPPER_AD_REQUEST_META_SEEN,
                    'compare' => 'NOT EXISTS',
                ),
                array(
                    'key'     => KERMANCOPPER_AD_REQUEST_META_SEEN,
                    'value'   => '0',
                    'compare' => '=',
                ),
            ),
        )
    );
    return (int) $query->found_posts;
}

function kermancopper_ads_add_requests_menu_badge() {
    if ( ! current_user_can( 'edit_posts' ) ) {
        return;
    }
    $count = kermancopper_ads_requests_badge_count();
    if ( $count <= 0 ) {
        return;
    }
    global $submenu;
    $menu_key = 'edit.php?post_type=kermancopper_ad';
    if ( empty( $submenu[ $menu_key ] ) ) {
        return;
    }
    foreach ( $submenu[ $menu_key ] as $index => $item ) {
        if ( isset( $item[2] ) && $item[2] === 'kermancopper-ad-requests' ) {
            $submenu[ $menu_key ][ $index ][0] .= ' <span class="update-plugins count-' . $count . '"><span class="plugin-count">' . number_format_i18n( $count ) . '</span></span>';
            break;
        }
    }
}
add_action( 'admin_menu', 'kermancopper_ads_add_requests_menu_badge', 99 );

<?php

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
        'kermancopper_ad_excel_forms',
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
        'kermancopper_ad_expiry_date',
        array(
            'type'              => 'string',
            'single'            => true,
            'sanitize_callback' => 'sanitize_text_field',
            'show_in_rest'      => true,
            'auth_callback'     => function () {
                return current_user_can( 'edit_posts' );
            },
        )
    );
    register_post_meta(
        'kermancopper_ad',
        'kermancopper_ad_status',
        array(
            'type'              => 'string',
            'single'            => true,
            'sanitize_callback' => 'sanitize_text_field',
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
    $excel_forms = get_post_meta( $post->ID, 'kermancopper_ad_excel_forms', true );
    if ( ! is_array( $excel_forms ) ) {
        $excel_forms = array();
    }
    if ( empty( $excel_forms ) ) {
        $legacy_excel_url = get_post_meta( $post->ID, 'kermancopper_ad_excel_url', true );
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
    $expiry_date = get_post_meta( $post->ID, 'kermancopper_ad_expiry_date', true );
    $status = get_post_meta( $post->ID, 'kermancopper_ad_status', true );
    $display_expiry_date = '';
    if ( $expiry_date && preg_match( '/^\d{4}-\d{2}-\d{2}$/', $expiry_date ) ) {
        $parts = explode( '-', $expiry_date );
        if ( count( $parts ) === 3 ) {
            $jalali = kermancopper_gregorian_to_jalali( (int) $parts[0], (int) $parts[1], (int) $parts[2] );
            $display_expiry_date = sprintf( '%04d/%02d/%02d', $jalali[0], $jalali[1], $jalali[2] );
        }
    } elseif ( $expiry_date && preg_match( '/^\d{4}\/\d{2}\/\d{2}$/', $expiry_date ) ) {
        $display_expiry_date = $expiry_date;
    }
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
    $forms = array();
    foreach ( $forms_raw as $form ) {
        if ( ! is_array( $form ) ) {
            continue;
        }
        $name = isset( $form['name'] ) ? sanitize_text_field( $form['name'] ) : '';
        $url = isset( $form['url'] ) ? esc_url_raw( $form['url'] ) : '';
        if ( $url === '' ) {
            continue;
        }
        $forms[] = array(
            'name' => $name,
            'url'  => $url,
        );
    }
    if ( ! empty( $forms ) ) {
        update_post_meta( $post_id, 'kermancopper_ad_excel_forms', $forms );
    } else {
        delete_post_meta( $post_id, 'kermancopper_ad_excel_forms' );
    }
    delete_post_meta( $post_id, 'kermancopper_ad_excel_url' );
    $expiry_date = isset( $_POST['kermancopper_ad_expiry_date'] ) ? sanitize_text_field( wp_unslash( $_POST['kermancopper_ad_expiry_date'] ) ) : '';
    if ( $expiry_date && preg_match( '/^\d{4}\/\d{2}\/\d{2}$/', $expiry_date ) ) {
        $parts = explode( '/', $expiry_date );
        if ( count( $parts ) === 3 ) {
            $gregorian = kermancopper_jalali_to_gregorian( (int) $parts[0], (int) $parts[1], (int) $parts[2] );
            $gregorian_value = sprintf( '%04d-%02d-%02d', $gregorian[0], $gregorian[1], $gregorian[2] );
            update_post_meta( $post_id, 'kermancopper_ad_expiry_date', $gregorian_value );
        } else {
            delete_post_meta( $post_id, 'kermancopper_ad_expiry_date' );
        }
    } else {
        delete_post_meta( $post_id, 'kermancopper_ad_expiry_date' );
    }
    $status = isset( $_POST['kermancopper_ad_status'] ) ? sanitize_text_field( wp_unslash( $_POST['kermancopper_ad_status'] ) ) : '';
    $allowed_status = array( 'active', 'closed' );
    if ( in_array( $status, $allowed_status, true ) ) {
        update_post_meta( $post_id, 'kermancopper_ad_status', $status );
    } else {
        delete_post_meta( $post_id, 'kermancopper_ad_status' );
    }
}
add_action( 'save_post', 'kermancopper_ads_save_meta' );

function kermancopper_ads_admin_assets() {
    $screen = function_exists( 'get_current_screen' ) ? get_current_screen() : null;
    if ( ! $screen || $screen->post_type !== 'kermancopper_ad' ) {
        return;
    }
    wp_enqueue_media();
    wp_enqueue_style( 'kermancopper-jalalidatepicker', get_template_directory_uri() . '/assets/vendor/jalalidatepicker/jalalidatepicker.min.css', array(), '1.3.0' );
    wp_enqueue_script( 'kermancopper-jalalidatepicker', get_template_directory_uri() . '/assets/vendor/jalalidatepicker/jalalidatepicker.min.js', array(), '1.3.0', true );
    $styles = <<<CSS
.kermancopper-ad-fields-row { display: grid; grid-template-columns: repeat(2, minmax(0, 1fr)); gap: 12px; margin-bottom: 12px; }
.kermancopper-ad-field label { display: block; font-weight: 600; margin-bottom: 4px; }
@media (max-width: 782px) { .kermancopper-ad-fields-row { grid-template-columns: 1fr; } }
#kermancopper-ad-excel-forms { display: flex; flex-direction: column; gap: 12px; margin-top: 8px; }
.kermancopper-ad-excel-title { font-weight: 600; margin-bottom: 6px; }
.kermancopper-ad-excel-separator { border-top: 1px solid #e2e8f0; margin: 14px 0 10px; }
.kermancopper-ad-excel-row { border: 1px solid #e2e8f0; background: #fff; padding: 12px; border-radius: 6px; display: flex; flex-direction: column; gap: 10px; }
.kermancopper-ad-excel-label { display: block; font-weight: 600; margin-bottom: 4px; }
.kermancopper-ad-excel-row-actions { display: flex; flex-wrap: wrap; gap: 8px; align-items: center; }
.kermancopper-ad-excel-url { min-width: 240px; }
.kermancopper-ad-excel-buttons { display: flex; gap: 8px; flex-wrap: wrap; }
#kermancopper_ad_excel_add { width: 100%; }
.jdp-container { z-index: 999999; }
CSS;
    wp_add_inline_style( 'kermancopper-jalalidatepicker', $styles );
    $inline = <<<JS
jQuery(function($){
    var frame;
    var currentUrlField;
    var container = $('#kermancopper-ad-excel-forms');
    var index = parseInt(container.data('index'), 10) || 0;
    function openMedia(){
        if (frame) {
            frame.open();
            return;
        }
        frame = wp.media({
            title: 'انتخاب فرم اکسل',
            button: { text: 'انتخاب' },
            multiple: false
        });
        frame.on('select', function(){
            var attachment = frame.state().get('selection').first().toJSON();
            if (currentUrlField) {
                currentUrlField.val(attachment.url);
            }
        });
        frame.open();
    }
    function buildRow(rowIndex){
        var row = $('<div class="kermancopper-ad-excel-row">\
            <div>\
                <label class="kermancopper-ad-excel-label">نام فرم</label>\
                <input type="text" name="kermancopper_ad_excel_forms[' + rowIndex + '][name]" class="widefat kermancopper-ad-excel-name" placeholder="نام فرم" value="" />\
            </div>\
            <div>\
                <label class="kermancopper-ad-excel-label">فایل فرم</label>\
                <div class="kermancopper-ad-excel-row-actions">\
                    <input type="text" name="kermancopper_ad_excel_forms[' + rowIndex + '][url]" class="widefat kermancopper-ad-excel-url" readonly value="" />\
                    <div class="kermancopper-ad-excel-buttons">\
                        <button type="button" class="button kermancopper-ad-excel-select">انتخاب فایل</button>\
                        <button type="button" class="button kermancopper-ad-excel-remove">حذف</button>\
                    </div>\
                </div>\
            </div>\
        </div>');
        return row;
    }
    $('#kermancopper_ad_excel_add').on('click', function(e){
        e.preventDefault();
        container.append(buildRow(index));
        index++;
        container.data('index', index);
    });
    container.on('click', '.kermancopper-ad-excel-select', function(e){
        e.preventDefault();
        currentUrlField = $(this).closest('.kermancopper-ad-excel-row').find('.kermancopper-ad-excel-url');
        openMedia();
    });
    container.on('click', '.kermancopper-ad-excel-remove', function(e){
        e.preventDefault();
        $(this).closest('.kermancopper-ad-excel-row').remove();
    });
    if (typeof jalaliDatepicker !== 'undefined') {
        jalaliDatepicker.startWatch();
    }
});
JS;
    wp_add_inline_script( 'kermancopper-jalalidatepicker', $inline );
}
add_action( 'admin_enqueue_scripts', 'kermancopper_ads_admin_assets' );

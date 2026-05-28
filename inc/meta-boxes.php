<?php
/**
 * Custom Meta Boxes
 *
 * @package KermanCopper
 */

function kermancopper_add_custom_badge_meta_box() {
    add_meta_box(
        'kermancopper_custom_badge_meta',
        __( 'برچسب سفارشی', 'kermancopper' ),
        'kermancopper_custom_badge_meta_callback',
        'post',
        'side',
        'default'
    );
}
add_action( 'add_meta_boxes', 'kermancopper_add_custom_badge_meta_box' );

function kermancopper_custom_badge_meta_callback( $post ) {
    wp_nonce_field( 'kermancopper_save_custom_badge', 'kermancopper_custom_badge_nonce' );
    $value = get_post_meta( $post->ID, '_kermancopper_custom_badge', true );
    
    echo '<label for="kermancopper_custom_badge_field">' . __( 'متن برچسب (مثال: فوری، گزارش ویژه):', 'kermancopper' ) . '</label>';
    echo '<input type="text" id="kermancopper_custom_badge_field" name="kermancopper_custom_badge_field" value="' . esc_attr( $value ) . '" style="width:100%; margin-top: 5px;" />';
    echo '<p class="description">' . __( 'این برچسب در لیست اخبار و اطلاعیه‌ها در صفحه اصلی نمایش داده می‌شود.', 'kermancopper' ) . '</p>';
}

function kermancopper_save_custom_badge_meta( $post_id ) {
    if ( ! isset( $_POST['kermancopper_custom_badge_nonce'] ) || ! wp_verify_nonce( $_POST['kermancopper_custom_badge_nonce'], 'kermancopper_save_custom_badge' ) ) {
        return;
    }
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
        return;
    }
    if ( ! current_user_can( 'edit_post', $post_id ) ) {
        return;
    }

    if ( isset( $_POST['kermancopper_custom_badge_field'] ) ) {
        $badge = sanitize_text_field( $_POST['kermancopper_custom_badge_field'] );
        update_post_meta( $post_id, '_kermancopper_custom_badge', $badge );
    } else {
        delete_post_meta( $post_id, '_kermancopper_custom_badge' );
    }
}
add_action( 'save_post', 'kermancopper_save_custom_badge_meta' );

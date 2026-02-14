<?php
/**
 * Customizer Sanitization Callbacks
 *
 * @package KermanCopper
 */

/**
 * Sanitize Checkbox
 * 
 * @param bool $checked Whether the checkbox is checked.
 * @return bool Whether the checkbox is checked.
 */
function kermancopper_sanitize_checkbox( $checked ) {
    return ( ( isset( $checked ) && true === $checked ) ? true : false );
}

/**
 * Sanitize HTML (Allowed Tags)
 * 
 * @param string $input HTML input.
 * @return string Sanitized HTML.
 */
function kermancopper_sanitize_html( $input ) {
    return wp_kses_post( $input );
}

/**
 * Sanitize URL
 * 
 * @param string $url URL input.
 * @return string Sanitized URL.
 */
function kermancopper_sanitize_url( $url ) {
    return esc_url_raw( $url );
}

/**
 * Sanitize Text
 * 
 * @param string $text Text input.
 * @return string Sanitized text.
 */
function kermancopper_sanitize_text( $text ) {
    return sanitize_text_field( $text );
}

function kermancopper_sanitize_text_100( $text ) {
    $text = sanitize_text_field( $text );
    return mb_substr( $text, 0, 100 );
}

function kermancopper_sanitize_text_50( $text ) {
    $text = sanitize_text_field( $text );
    return mb_substr( $text, 0, 50 );
}

function kermancopper_sanitize_number_range_1_20( $value ) {
    $value = absint( $value );
    if ( $value < 1 || $value > 20 ) {
        return 0;
    }
    return $value;
}

function kermancopper_sanitize_category_id( $value ) {
    $value = absint( $value );
    if ( $value === 0 ) {
        return 0;
    }
    $term = get_term( $value, 'category' );
    if ( $term && ! is_wp_error( $term ) ) {
        return $value;
    }
    return 0;
}

function kermancopper_sanitize_faq_items( $value ) {
    if ( empty( $value ) ) {
        return '';
    }
    $items = json_decode( $value, true );
    if ( ! is_array( $items ) ) {
        return '';
    }
    $sanitized = array();
    foreach ( $items as $item ) {
        if ( ! is_array( $item ) ) {
            continue;
        }
        $question = isset( $item['question'] ) ? sanitize_text_field( $item['question'] ) : '';
        $answer = isset( $item['answer'] ) ? sanitize_text_field( $item['answer'] ) : '';
        if ( $question === '' && $answer === '' ) {
            continue;
        }
        $sanitized[] = array(
            'question' => $question,
            'answer'   => $answer,
        );
    }
    return wp_json_encode( $sanitized );
}

function kermancopper_sanitize_partners_items( $value ) {
    if ( empty( $value ) ) {
        return '';
    }
    $items = json_decode( $value, true );
    if ( ! is_array( $items ) ) {
        return '';
    }
    $sanitized = array();
    foreach ( $items as $item ) {
        if ( ! is_array( $item ) ) {
            continue;
        }
        $name = isset( $item['name'] ) ? sanitize_text_field( $item['name'] ) : '';
        $link = isset( $item['link'] ) ? esc_url_raw( $item['link'] ) : '';
        $image_id = isset( $item['image_id'] ) ? absint( $item['image_id'] ) : 0;
        if ( $name === '' && $link === '' && $image_id === 0 ) {
            continue;
        }
        $sanitized[] = array(
            'name'      => $name,
            'link'      => $link,
            'image_id'  => $image_id,
        );
    }
    return wp_json_encode( $sanitized );
}

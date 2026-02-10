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

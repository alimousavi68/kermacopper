<?php
/**
 * Inline SVG Icons — replaces Lucide JS library (~388KB)
 *
 * Usage:
 *   echo kermancopper_icon( 'arrow-left', 'w-4 h-4' );
 *
 * @package KermanCopper
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Return an inline SVG icon string.
 *
 * @param string $name  Icon name (matches Lucide naming).
 * @param string $class Optional CSS classes.
 * @return string SVG markup or empty string if icon not found.
 */
function kermancopper_icon( $name, $class = '' ) {
    static $icons = null;

    if ( $icons === null ) {
        $icons = array(
            'alert-triangle' => '<path d="m21.73 18-8-14a2 2 0 0 0-3.48 0l-8 14A2 2 0 0 0 4 21h16a2 2 0 0 0 1.73-3"/><path d="M12 9v4"/><path d="M12 17h.01"/>',
            'arrow-left'     => '<path d="m12 19-7-7 7-7"/><path d="M19 12H5"/>',
            'arrow-right'    => '<path d="M5 12h14"/><path d="m12 5 7 7-7 7"/>',
            'arrow-up'       => '<path d="m5 12 7-7 7 7"/><path d="M12 19V5"/>',
            'calendar'       => '<path d="M8 2v4"/><path d="M16 2v4"/><rect width="18" height="18" x="3" y="4" rx="2"/><path d="M3 10h18"/>',
            'check'          => '<path d="M20 6 9 17l-5-5"/>',
            'chevron-down'   => '<path d="m6 9 6 6 6-6"/>',
            'chevron-left'   => '<path d="m15 18-6-6 6-6"/>',
            'chevron-right'  => '<path d="m9 18 6-6-6-6"/>',
            'chevrons-down'  => '<path d="m7 6 5 5 5-5"/><path d="m7 13 5 5 5-5"/>',
            'circle'         => '<circle cx="12" cy="12" r="10"/>',
            'clock'          => '<circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/>',
            'facebook'       => '<path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"/>',
            'file-text'      => '<path d="M15 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V7Z"/><path d="M14 2v4a2 2 0 0 0 2 2h4"/><path d="M10 9H8"/><path d="M16 13H8"/><path d="M16 17H8"/>',
            'filter'         => '<polygon points="22 3 2 3 10 12.46 10 19 14 21 14 12.46 22 3"/>',
            'gavel'          => '<path d="m14 13-7.5 7.5c-.83.83-2.17.83-3 0s-.83-2.17 0-3L11 10"/><path d="m16 16 6-6"/><path d="m8 8 6-6"/><path d="m9 7 8 8"/><path d="m21 11-8-8"/>',
            'home'           => '<path d="m3 9 9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/>',
            'image'          => '<rect width="18" height="18" x="3" y="3" rx="2" ry="2"/><circle cx="9" cy="9" r="2"/><path d="m21 15-3.086-3.086a2 2 0 0 0-2.828 0L6 21"/>',
            'instagram'      => '<rect width="20" height="20" x="2" y="2" rx="5" ry="5"/><path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"/><line x1="17.5" x2="17.51" y1="6.5" y2="6.5"/>',
            'layout-grid'    => '<rect width="7" height="7" x="3" y="3" rx="1"/><rect width="7" height="7" x="14" y="3" rx="1"/><rect width="7" height="7" x="14" y="14" rx="1"/><rect width="7" height="7" x="3" y="14" rx="1"/>',
            'linkedin'       => '<path d="M16 8a6 6 0 0 1 6 6v7h-4v-7a2 2 0 0 0-2-2 2 2 0 0 0-2 2v7h-4v-7a6 6 0 0 1 6-6z"/><rect width="4" height="12" x="2" y="9"/><circle cx="4" cy="4" r="2"/>',
            'mail'           => '<rect width="20" height="16" x="2" y="4" rx="2"/><path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7"/>',
            'map'            => '<polygon points="1 6 1 22 8 18 16 22 23 18 23 2 16 6 8 2 1 6"/><line x1="8" x2="8" y1="2" y2="18"/><line x1="16" x2="16" y1="6" y2="22"/>',
            'map-pin'        => '<path d="M20 10c0 6-8 12-8 12s-8-6-8-12a8 8 0 0 1 16 0Z"/><circle cx="12" cy="10" r="3"/>',
            'menu'           => '<line x1="4" x2="20" y1="12" y2="12"/><line x1="4" x2="20" y1="6" y2="6"/><line x1="4" x2="20" y1="18" y2="18"/>',
            'navigation'     => '<polygon points="3 11 22 2 13 21 11 13 3 11"/>',
            'phone'          => '<path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/>',
            'printer'        => '<polyline points="6 9 6 2 18 2 18 9"/><path d="M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2"/><rect width="12" height="8" x="6" y="14"/>',
            'search'         => '<circle cx="11" cy="11" r="8"/><path d="m21 21-4.3-4.3"/>',
            'tag'            => '<path d="M12 2H2v10l9.29 9.29c.94.94 2.48.94 3.42 0l6.58-6.58c.94-.94.94-2.48 0-3.42L12 2Z"/><path d="M7 7h.01"/>',
            'twitter'        => '<path d="M22 4s-.7 2.1-2 3.4c1.6 10-9.4 17.3-18 11.6 2.2.1 4.4-.6 6-2C3 15.5.5 9.6 3 5c2.2 2.6 5.6 4.1 9 4-.9-4.2 4-6.6 7-3.8 1.1 0 3-1.2 3-1.2z"/>',
            'x'              => '<path d="M18 6 6 18"/><path d="m6 6 12 12"/>',
        );
    }

    if ( ! isset( $icons[ $name ] ) ) {
        return '';
    }

    $class_attr = $class ? ' class="' . esc_attr( $class ) . '"' : '';

    return '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"' . $class_attr . '>' . $icons[ $name ] . '</svg>';
}

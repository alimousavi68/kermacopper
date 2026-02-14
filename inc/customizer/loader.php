<?php
/**
 * Customizer Loader
 *
 * @package KermanCopper
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Load Core Sanitization
require_once get_template_directory() . '/inc/customizer/core/sanitization.php';

// Load Panels/Sections
require_once get_template_directory() . '/inc/customizer/panels/header-config.php';
require_once get_template_directory() . '/inc/customizer/panels/social-config.php';
require_once get_template_directory() . '/inc/customizer/panels/colors-config.php';
require_once get_template_directory() . '/inc/customizer/panels/footer-config.php';

<?php
/**
 * Theme Functions
 *
 * @package KermanCopper
 */

// Define Constants
define( 'KERMANCOPPER_DIR', get_template_directory() );
define( 'KERMANCOPPER_URI', get_template_directory_uri() );

// Load Walker
require_once KERMANCOPPER_DIR . '/inc/classes/class-kermancopper-nav-walker.php';

// Load Customizer
require_once KERMANCOPPER_DIR . '/inc/customizer/loader.php';
require_once KERMANCOPPER_DIR . '/inc/kermancopper-icons.php';

// Setup Theme
function kermancopper_setup() {
    add_theme_support( 'title-tag' );
    add_theme_support( 'post-thumbnails' );
    add_image_size( 'kermancopper-ad-thumbnail', 350, 182, true );
    add_image_size( 'kermancopper-notice-thumbnail', 225, 300, true );
    add_image_size( 'kermancopper-news-thumbnail', 898, 600, true );
    add_theme_support( 'custom-logo' );
    add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption' ) );
    
    register_nav_menus( array(
        'primary' => __( 'Primary Menu', 'kermancopper' ),
        'footer'  => __( 'Footer Menu', 'kermancopper' ),
    ) );
}
add_action( 'after_setup_theme', 'kermancopper_setup' );

// Register Widget Areas
function kermancopper_widgets_init() {
    register_sidebar( array(
        'name'          => __( 'Footer 1', 'kermancopper' ),
        'id'            => 'footer-1',
        'description'   => __( 'Add widgets here to appear in your footer column 1.', 'kermancopper' ),
        'before_widget' => '<div id="%1$s" class="widget %2$s mb-8 flex flex-col items-center text-center">',
        'after_widget'  => '</div>',
        'before_title'  => '<h4 class="font-bold text-slate-900 mb-6 text-sm border-r-2 border-copper pr-2">',
        'after_title'   => '</h4>',
    ) );

    register_sidebar( array(
        'name'          => __( 'Footer 2', 'kermancopper' ),
        'id'            => 'footer-2',
        'description'   => __( 'Add widgets here to appear in your footer column 2.', 'kermancopper' ),
        'before_widget' => '<div id="%1$s" class="widget %2$s mb-8">',
        'after_widget'  => '</div>',
        'before_title'  => '<h4 class="font-bold text-slate-900 mb-6 text-sm border-r-2 border-copper pr-2">',
        'after_title'   => '</h4>',
    ) );

 

    register_sidebar( array(
        'name'          => __( 'Homepage News Below', 'kermancopper' ),
        'id'            => 'home-news-below',
        'description'   => __( 'Widgets below the latest news section on the homepage.', 'kermancopper' ),
        'before_widget' => '<div id="%1$s" class="widget %2$s w-full mb-10">',
        'after_widget'  => '</div>',
        'before_title'  => '<h4 class="font-bold text-slate-900 mb-6 text-sm border-r-2 border-copper pr-2">',
        'after_title'   => '</h4>',
    ) );

    register_sidebar( array(
        'name'          => __( 'Homepage Contact Box', 'kermancopper' ),
        'id'            => 'home-contact-box',
        'description'   => __( 'Widgets inside the contact section box on the homepage.', 'kermancopper' ),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h4 class="font-bold text-slate-900 mb-4 text-sm border-r-2 border-copper pr-2">',
        'after_title'   => '</h4>',
    ) );
}
add_action( 'widgets_init', 'kermancopper_widgets_init' );

// Register Custom Widgets
function kermancopper_register_widgets() {
    // Load Widgets
    require_once get_template_directory() . '/inc/widgets/class-kermancopper-footer-info-widget.php';
    require_once get_template_directory() . '/inc/widgets/class-kermancopper-custom-menu-widget.php';
    require_once get_template_directory() . '/inc/widgets/class-kermancopper-contact-info-widget.php';
    require_once get_template_directory() . '/inc/widgets/class-kermancopper-map-widget.php';
    require_once get_template_directory() . '/inc/widgets/class-kermancopper-news-events-widget.php';

    register_widget( 'KermanCopper_Footer_Info_Widget' );
    register_widget( 'KermanCopper_Custom_Menu_Widget' );
    register_widget( 'KermanCopper_Contact_Info_Widget' );
    register_widget( 'KermanCopper_Map_Widget' );
    register_widget( 'KermanCopper_News_Events_Widget' );
}
add_action( 'widgets_init', 'kermancopper_register_widgets' );

function kermancopper_track_post_views() {
    if ( is_admin() ) {
        return;
    }
    if ( ! is_singular( 'post' ) ) {
        return;
    }
    $post_id = get_queried_object_id();
    if ( ! $post_id ) {
        return;
    }
    $meta_key = 'post_views';
    $views = (int) get_post_meta( $post_id, $meta_key, true );
    $views++;
    update_post_meta( $post_id, $meta_key, $views );
}
add_action( 'wp', 'kermancopper_track_post_views' );

// Enqueue Scripts
function kermancopper_scripts() {
    wp_enqueue_style( 'kermancopper-style', get_stylesheet_uri() );
    
    // Tailwind CSS (compiled)
    wp_enqueue_style( 'kermancopper-tailwind', get_template_directory_uri() . '/assets/css/tailwind.css', array(), '3.4.1' );
    
    // Main Script
    wp_enqueue_script( 'kermancopper-main', get_template_directory_uri() . '/assets/js/main.js', array(), '1.0.0', true );

    // Jalali Datepicker for Frontend
    if ( is_singular( 'kermancopper_ad' ) || is_post_type_archive( 'kermancopper_ad' ) ) {
        wp_enqueue_style( 'kermancopper-jalalidatepicker', get_template_directory_uri() . '/assets/vendor/jalalidatepicker/jalalidatepicker.min.css', array(), '1.3.0' );
        wp_enqueue_script( 'kermancopper-jalalidatepicker', get_template_directory_uri() . '/assets/vendor/jalalidatepicker/jalalidatepicker.min.js', array(), '1.3.0', true );
    }
}
add_action( 'wp_enqueue_scripts', 'kermancopper_scripts' );

function kermancopper_get_home_setting( $key ) {
    return get_theme_mod( $key );
}

function kermancopper_sync_home_archive_urls() {
    $news_category = (int) get_theme_mod( 'kermancopper_home_news_category' );
    $notices_category = (int) get_theme_mod( 'kermancopper_home_notices_category' );
    if ( $news_category > 0 ) {
        set_theme_mod( 'kermancopper_home_news_archive_url', get_category_link( $news_category ) );
    } else {
        remove_theme_mod( 'kermancopper_home_news_archive_url' );
    }
    if ( $notices_category > 0 ) {
        set_theme_mod( 'kermancopper_home_notices_archive_url', get_category_link( $notices_category ) );
    } else {
        remove_theme_mod( 'kermancopper_home_notices_archive_url' );
    }
}
add_action( 'customize_save_after', 'kermancopper_sync_home_archive_urls' );

require_once KERMANCOPPER_DIR . '/inc/ads/ads.php';

function kermancopper_flush_rewrite_rules() {
    if (get_option('kermancopper_rewrite_rules_flushed') !== '6') { // Updated to 6 to trigger re-flush
        flush_rewrite_rules();
        update_option('kermancopper_rewrite_rules_flushed', '6');
    }
}
add_action('init', 'kermancopper_flush_rewrite_rules', 99);

function kermancopper_filter_ads_ajax_handler() {
    $page = isset($_GET['page']) ? absint($_GET['page']) : 1;
    $sort = isset($_GET['sort']) ? sanitize_text_field($_GET['sort']) : 'date_desc';
    $search = isset($_GET['search']) ? sanitize_text_field($_GET['search']) : '';
    $ad_type = isset($_GET['ad_type']) ? absint($_GET['ad_type']) : 0;
    $status = isset($_GET['status']) ? sanitize_text_field($_GET['status']) : '';
    $date_from = isset($_GET['date_from']) ? sanitize_text_field($_GET['date_from']) : '';
    $date_to = isset($_GET['date_to']) ? sanitize_text_field($_GET['date_to']) : '';
    $posts_per_page = 9;

    $args = array(
        'post_type'      => 'kermancopper_ad',
        'posts_per_page' => $posts_per_page,
        'paged'          => $page,
        'post_status'    => 'publish',
    );

    if ($search) {
        $args['s'] = $search;
    }

    // Ad Type Filter
    if ($ad_type > 0) {
        $args['tax_query'] = array(
            array(
                'taxonomy' => 'kermancopper_ad_type',
                'field'    => 'term_id',
                'terms'    => $ad_type,
            ),
        );
    }

    // Status Filter (Based on Expiry Date)
    $today = current_time('Y-m-d');
    if ($status === 'active') {
        $args['meta_query'][] = array(
            'relation' => 'OR',
            array(
                'key'     => KERMANCOPPER_AD_META_EXPIRY_DATE,
                'value'   => $today,
                'compare' => '>=',
                'type'    => 'DATE',
            ),
            array(
                'key'     => KERMANCOPPER_AD_META_EXPIRY_DATE,
                'value'   => '',
                'compare' => '=',
            ),
            array(
                'key'     => KERMANCOPPER_AD_META_EXPIRY_DATE,
                'compare' => 'NOT EXISTS',
            ),
        );
    } elseif ($status === 'closed') {
        $args['meta_query'][] = array(
            'key'     => KERMANCOPPER_AD_META_EXPIRY_DATE,
            'value'   => $today,
            'compare' => '<',
            'type'    => 'DATE',
        );
    }

    // Date Range Filter (Based on Post Date)
    if ($date_from || $date_to) {
        $date_query = array('inclusive' => true);
        if ($date_from) {
            $from_parts = explode('/', $date_from);
            if (count($from_parts) === 3) {
                $from_gregorian = kermancopper_jalali_to_gregorian((int)$from_parts[0], (int)$from_parts[1], (int)$from_parts[2]);
                $date_query['after'] = sprintf('%04d-%02d-%02d', $from_gregorian[0], $from_gregorian[1], $from_gregorian[2]);
            }
        }
        if ($date_to) {
            $to_parts = explode('/', $date_to);
            if (count($to_parts) === 3) {
                $to_gregorian = kermancopper_jalali_to_gregorian((int)$to_parts[0], (int)$to_parts[1], (int)$to_parts[2]);
                $date_query['before'] = sprintf('%04d-%02d-%02d', $to_gregorian[0], $to_gregorian[1], $to_gregorian[2]);
            }
        }
        $args['date_query'] = $date_query;
    }

    // Sorting
    switch ($sort) {
        case 'date_asc':
            $args['orderby'] = 'date';
            $args['order']   = 'ASC';
            break;
        case 'title_asc':
            $args['orderby'] = 'title';
            $args['order']   = 'ASC';
            break;
        case 'date_desc':
        default:
            $args['orderby'] = 'date';
            $args['order']   = 'DESC';
            break;
    }

    $query = new WP_Query($args);
    $html = '';
    
    if ($query->have_posts()) {
        while ($query->have_posts()) {
            $query->the_post();
            $ad_id = get_the_ID();
            
            // Calculate status for display
            $expiry_date = get_post_meta($ad_id, KERMANCOPPER_AD_META_EXPIRY_DATE, true);
            $is_expired = ($expiry_date && $expiry_date < $today);
            $post_status_slug = $is_expired ? 'closed' : 'active';
            $status_label = $is_expired ? __('غیرفعال', 'kermancopper') : __('فعال', 'kermancopper');
            
            $ad_terms = get_the_terms($ad_id, 'kermancopper_ad_type');
            $ad_term = !empty($ad_terms) && !is_wp_error($ad_terms) ? $ad_terms[0] : null;
            $ad_type_label = $ad_term ? $ad_term->name : __('سایر', 'kermancopper');
            $ad_type_icon = 'file-text';
            
            if ($ad_term) {
                if (strpos($ad_term->slug, 'auction') !== false || strpos($ad_term->name, 'مزایده') !== false) {
                    $ad_type_icon = 'gavel';
                } elseif (strpos($ad_term->slug, 'tender') !== false || strpos($ad_term->name, 'مناقصه') !== false) {
                    $ad_type_icon = 'file-text';
                }
            }

            $expiry_display = function_exists('kermancopper_ads_format_expiry_date_for_display')
                ? kermancopper_ads_format_expiry_date_for_display($expiry_date)
                : $expiry_date;
            
            if (empty($expiry_display)) {
                $expiry_display = '—';
            }

            $thumbnail = get_the_post_thumbnail_url($ad_id, 'kermancopper-ad-thumbnail') ?: get_template_directory_uri() . '/images/image2.jpg';

            ob_start();
            ?>
            <article class="ad-card">
                <a href="<?php echo esc_url(get_permalink($ad_id)); ?>" class="block">
                    <div class="ad-card-image" style="background-image: url('<?php echo esc_url($thumbnail); ?>');"></div>
                    <div class="p-5">
                        <h3 class="text-xl font-bold text-slate-800 mb-4" style="height: 3em; line-height: 1.5em; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden;"><?php echo esc_html(get_the_title($ad_id)); ?></h3>
                        <div class="flex flex-wrap items-center gap-2 mb-3">
                            <span class="status-badge <?php echo esc_attr($post_status_slug); ?>">
                                <?php echo kermancopper_icon('circle', 'w-3 h-3'); ?>
                                <?php echo esc_html($status_label); ?>
                            </span>
                            <span class="inline-flex items-center gap-1 px-3 py-1 rounded-full bg-slate-100 text-slate-700 text-xs font-medium">
                                <?php echo kermancopper_icon($ad_type_icon, 'w-3 h-3'); ?>
                                <?php echo esc_html($ad_type_label); ?>
                            </span>
                        </div>
                        <?php if ($expiry_display !== '—') : ?>
                            <div class="flex items-center gap-2 text-slate-500 text-xs">
                                <?php echo kermancopper_icon('clock', 'w-4 h-4'); ?>
                                <span>مهلت: <?php echo esc_html($expiry_display); ?></span>
                            </div>
                        <?php endif; ?>
                    </div>
                </a>
            </article>
            <?php
            $html .= ob_get_clean();
        }
        wp_reset_postdata();
    } else {
        $html = '<div class="col-span-full text-center py-16"><div class="inline-flex items-center justify-center w-20 h-20 rounded-full bg-slate-100 mb-6">' . kermancopper_icon('search', 'w-10 h-10 text-slate-400') . '</div><h3 class="text-xl font-bold text-slate-800 mb-2">آگهی‌ای یافت نشد</h3><p class="text-slate-600">لطفا فیلترها را تغییر دهید.</p></div>';
    }

    wp_send_json_success(array(
        'html'     => $html,
        'total'    => (int) $query->found_posts,
        'has_more' => $page < $query->max_num_pages,
    ));
}
add_action('wp_ajax_kermancopper_filter_ads', 'kermancopper_filter_ads_ajax_handler');
add_action('wp_ajax_nopriv_kermancopper_filter_ads', 'kermancopper_filter_ads_ajax_handler');

function kermancopper_apply_ad_filters_to_main_query($query) {
    if (is_admin() || !$query->is_main_query()) {
        return;
    }

    if (!$query->is_post_type_archive('kermancopper_ad') && !$query->is_tax('kermancopper_ad_type')) {
        return;
    }

    $query->set('post_type', 'kermancopper_ad');
    $query->set('posts_per_page', 9);

    $sort = isset($_GET['sort']) ? sanitize_text_field(wp_unslash($_GET['sort'])) : 'date_desc';
    switch ($sort) {
        case 'date_asc':
            $query->set('orderby', 'date');
            $query->set('order', 'ASC');
            break;
        case 'title_asc':
            $query->set('orderby', 'title');
            $query->set('order', 'ASC');
            break;
        case 'date_desc':
        default:
            $query->set('orderby', 'date');
            $query->set('order', 'DESC');
            break;
    }

    $search = isset($_GET['search']) ? sanitize_text_field(wp_unslash($_GET['search'])) : '';
    if ($search !== '') {
        $query->set('s', $search);
    }

    if ($query->is_post_type_archive('kermancopper_ad')) {
        $ad_type = isset($_GET['ad_type']) ? absint($_GET['ad_type']) : 0;
        if ($ad_type > 0) {
            $query->set('tax_query', array(
                array(
                    'taxonomy' => 'kermancopper_ad_type',
                    'field'    => 'term_id',
                    'terms'    => $ad_type,
                ),
            ));
        }
    }

    $meta_query = array();
    $today = current_time('Y-m-d');
    $status = isset($_GET['status']) ? sanitize_text_field(wp_unslash($_GET['status'])) : '';
    if ($status === 'active') {
        $meta_query[] = array(
            'relation' => 'OR',
            array(
                'key'     => KERMANCOPPER_AD_META_EXPIRY_DATE,
                'value'   => $today,
                'compare' => '>=',
                'type'    => 'DATE',
            ),
            array(
                'key'     => KERMANCOPPER_AD_META_EXPIRY_DATE,
                'value'   => '',
                'compare' => '=',
            ),
            array(
                'key'     => KERMANCOPPER_AD_META_EXPIRY_DATE,
                'compare' => 'NOT EXISTS',
            ),
        );
    } elseif ($status === 'closed') {
        $meta_query[] = array(
            'key'     => KERMANCOPPER_AD_META_EXPIRY_DATE,
            'value'   => $today,
            'compare' => '<',
            'type'    => 'DATE',
        );
    }
    if (!empty($meta_query)) {
        $query->set('meta_query', $meta_query);
    }

    $date_from = isset($_GET['date_from']) ? sanitize_text_field(wp_unslash($_GET['date_from'])) : '';
    $date_to = isset($_GET['date_to']) ? sanitize_text_field(wp_unslash($_GET['date_to'])) : '';
    if ($date_from !== '' || $date_to !== '') {
        $date_query = array('inclusive' => true);
        if ($date_from !== '') {
            $from_parts = explode('/', $date_from);
            if (count($from_parts) === 3 && function_exists('kermancopper_jalali_to_gregorian')) {
                $from_gregorian = kermancopper_jalali_to_gregorian((int) $from_parts[0], (int) $from_parts[1], (int) $from_parts[2]);
                $date_query['after'] = sprintf('%04d-%02d-%02d', $from_gregorian[0], $from_gregorian[1], $from_gregorian[2]);
            }
        }
        if ($date_to !== '') {
            $to_parts = explode('/', $date_to);
            if (count($to_parts) === 3 && function_exists('kermancopper_jalali_to_gregorian')) {
                $to_gregorian = kermancopper_jalali_to_gregorian((int) $to_parts[0], (int) $to_parts[1], (int) $to_parts[2]);
                $date_query['before'] = sprintf('%04d-%02d-%02d', $to_gregorian[0], $to_gregorian[1], $to_gregorian[2]);
            }
        }
        $query->set('date_query', $date_query);
    }
}
add_action('pre_get_posts', 'kermancopper_apply_ad_filters_to_main_query');

/**
 * Remove Elementor scripts & styles on pages where it is not used (like front-page).
 */
function kermancopper_dequeue_elementor_assets() {
    // Check if Elementor is loaded
    if ( ! class_exists( '\Elementor\Plugin' ) ) {
        return;
    }

    $is_elementor_page = false;

    // Check if it's a singular page and built with Elementor
    if ( is_singular() ) {
        $post_id = get_the_ID();
        if ( \Elementor\Plugin::$instance->db->is_built_with_elementor( $post_id ) ) {
            $is_elementor_page = true;
        }
    }

// If it's NOT an Elementor page, dequeue its heavy assets
    if ( ! $is_elementor_page ) {
        // Dequeue styles
        wp_dequeue_style( 'elementor-frontend' );
        wp_dequeue_style( 'elementor-global' );
        wp_dequeue_style( 'elementor-icons' );
        wp_dequeue_style( 'elementor-common' );
        wp_dequeue_style( 'e-theme-ui-light' );
        wp_dequeue_style( 'elementor-animations' );
        wp_dequeue_style( 'elementor-post-' . get_the_ID() );
        wp_dequeue_style( 'elementor-pro-notes-frontend' );
        wp_dequeue_style( 'wp-block-library' );
        wp_dequeue_style( 'wp-block-library-theme' );
        wp_dequeue_style( 'wc-blocks-style' ); // In case woocommerce blocks load

        // Dequeue scripts
        wp_dequeue_script( 'elementor-frontend' );
        wp_dequeue_script( 'elementor-dialog' );
        wp_dequeue_script( 'elementor-waypoints' );
        wp_dequeue_script( 'swiper' );
        wp_dequeue_script( 'share-link' );
        
        // Aggressively remove Elementor app, common, and notes scripts
        wp_dequeue_script( 'elementor-common' );
        wp_dequeue_script( 'elementor-common-modules' );
        wp_dequeue_script( 'elementor-app-loader' );
        wp_dequeue_script( 'elementor-web-cli' );
        wp_dequeue_script( 'elementor-pro-notes' );
        wp_dequeue_script( 'elementor-notes' );
        wp_dequeue_script( 'elementor-pro-notes-app-initiator' );
        
        // Remove React and Backbone dependencies loaded by Elementor App/Notes
        wp_dequeue_script( 'wp-element' ); // React
        wp_dequeue_script( 'react' );
        wp_dequeue_script( 'react-dom' );
        wp_dequeue_script( 'wp-hooks' );
        wp_dequeue_script( 'wp-i18n' );
        wp_dequeue_script( 'backbone-marionette' );
        wp_dequeue_script( 'jquery-ui-draggable' );
    }
}
// Use priority 9999 to ensure it runs after Elementor and Elementor Pro register their scripts
add_action( 'wp_enqueue_scripts', 'kermancopper_dequeue_elementor_assets', 99999 );

// Remove WordPress Emojis
remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
remove_action( 'wp_print_styles', 'print_emoji_styles' );
remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
remove_action( 'admin_print_styles', 'print_emoji_styles' );

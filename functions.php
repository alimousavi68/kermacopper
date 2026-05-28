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
        'mobile'  => __( 'Mobile Menu', 'kermancopper' ),
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
    wp_enqueue_script( 'kermancopper-main', get_template_directory_uri() . '/assets/js/main.js', array(), filemtime( get_template_directory() . '/assets/js/main.js' ), true );
    // Jalali Datepicker for Frontend
    if ( is_singular( 'kermancopper_ad' ) || is_post_type_archive( 'kermancopper_ad' ) || is_page_template( 'page-dashboard.php' ) ) {
        wp_enqueue_style( 'kermancopper-jalalidatepicker', get_template_directory_uri() . '/assets/vendor/jalalidatepicker/jalalidatepicker.min.css', array(), '1.3.0' );
        wp_enqueue_script( 'kermancopper-jalalidatepicker', get_template_directory_uri() . '/assets/vendor/jalalidatepicker/jalalidatepicker.min.js', array(), '1.3.0', true );
    }
}
add_action( 'wp_enqueue_scripts', 'kermancopper_scripts' );

function kermancopper_custom_colors_css() {
    $copper = get_theme_mod( 'kermancopper_color_copper', '#C8682F' );
    $copper_light = get_theme_mod( 'kermancopper_color_copper_light', '#E28652' );
    // Dark copper is usually slightly darker than main
    $copper_dark = '#A65120'; // Keeping dark static or derived if needed. We can just define the variable.
    
    $navy = get_theme_mod( 'kermancopper_color_navy', '#1A2235' );
    $navy_light = '#242F48';
    $navy_dark = '#0F1522';
    
    $bg_body = get_theme_mod( 'kermancopper_color_bg_body', '#FAF8F5' );

    echo "<style>
    :root {
        --color-copper: {$copper};
        --color-copper-light: {$copper_light};
        --color-copper-dark: {$copper_dark};
        --color-navy: {$navy};
        --color-navy-light: {$navy_light};
        --color-navy-dark: {$navy_dark};
        --color-bg-body: {$bg_body};
    }
    body { background-color: var(--color-bg-body); }
    </style>";
}
add_action( 'wp_head', 'kermancopper_custom_colors_css' );

function kermancopper_get_home_setting( $key ) {
    return get_theme_mod( $key );
}

function kermancopper_get_fallback_image() {
    $fallback = get_theme_mod( 'kermancopper_global_fallback_image' );
    if ( ! empty( $fallback ) ) {
        return $fallback;
    }
    // Default fallback if not set in customizer
    return get_template_directory_uri() . '/images/image2.jpg';
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
            <article class="ad-card group">
                <a href="<?php echo esc_url(get_permalink($ad_id)); ?>" class="flex flex-col h-full">
                    <div class="relative overflow-hidden h-[200px] border-b border-slate-100">
                        <div class="ad-card-image w-full h-full transition-transform duration-700 ease-out group-hover:scale-110" style="background-image: url('<?php echo esc_url($thumbnail); ?>');"></div>
                        <div class="absolute top-4 right-4 z-10">
                            <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-xl bg-white/95 backdrop-blur-md text-navy text-xs font-black shadow-sm">
                                <?php echo kermancopper_icon($ad_type_icon, 'w-3.5 h-3.5 text-copper'); ?>
                                <?php echo esc_html($ad_type_label); ?>
                            </span>
                        </div>
                    </div>
                    <div class="p-5 flex-1 flex flex-col justify-between">
                        <div>
                            <h3 class="text-base font-black text-slate-800 group-hover:text-copper transition-colors duration-300 mb-3" style="line-height: 1.6; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden;"><?php echo esc_html(get_the_title($ad_id)); ?></h3>
                        </div>
                        <div class="flex items-center justify-between border-t border-slate-100 pt-4 mt-auto">
                            <span class="status-badge <?php echo esc_attr($post_status_slug); ?>">
                                <span class="w-1.5 h-1.5 rounded-full <?php echo $is_expired ? 'bg-rose-500' : 'bg-emerald-500'; ?> <?php echo $is_expired ? '' : 'animate-pulse'; ?>"></span>
                                <?php echo esc_html($status_label); ?>
                            </span>
                            <?php if ($expiry_display !== '—') : ?>
                                <div class="flex items-center gap-1.5 text-slate-400 text-xs font-semibold">
                                    <?php echo kermancopper_icon('clock', 'w-3.5 h-3.5'); ?>
                                    <span>مهلت: <?php echo esc_html($expiry_display); ?></span>
                                </div>
                            <?php endif; ?>
                        </div>
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

/**
 * Auto-create essential pages on theme init
 */
function kermancopper_create_essential_pages() {
    $pages = array(
        'dashboard' => array(
            'title'    => 'پنل کاربری',
            'template' => 'page-dashboard.php'
        ),
        'login' => array(
            'title'    => 'ورود متقاضیان',
            'template' => 'page-login.php'
        )
    );

    foreach ( $pages as $slug => $data ) {
        $page = get_page_by_path( $slug );
        if ( ! $page ) {
            $page_id = wp_insert_post( array(
                'post_title'   => $data['title'],
                'post_name'    => $slug,
                'post_status'  => 'publish',
                'post_type'    => 'page',
                'post_author'  => 1,
            ) );
            if ( $page_id && ! is_wp_error( $page_id ) ) {
                update_post_meta( $page_id, '_wp_page_template', $data['template'] );
            }
        } else {
            $current_template = get_post_meta( $page->ID, '_wp_page_template', true );
            if ( $current_template !== $data['template'] ) {
                update_post_meta( $page->ID, '_wp_page_template', $data['template'] );
            }
        }
    }
}
add_action( 'init', 'kermancopper_create_essential_pages' );

/**
 * Expand default search results to include posts, pages, and ads (kermancopper_ad)
 */
function kermancopper_include_custom_post_types_in_search($query) {
    if (is_admin() || !$query->is_main_query()) {
        return;
    }
    if ($query->is_search()) {
        $query->set('post_type', array('post', 'page', 'kermancopper_ad'));
    }
}
add_action('pre_get_posts', 'kermancopper_include_custom_post_types_in_search');

/**
 * Register Custom Post Type: kermancopper_message (صندوق پیام‌ها)
 */
function kermancopper_register_contact_cpt() {
    $unread_count = kermancopper_get_unread_messages_count();
    $menu_name = 'صندوق پیام‌ها';
    if ( $unread_count > 0 ) {
        $menu_name .= sprintf( ' <span class="update-plugins count-%1$s"><span class="plugin-count">%1$s</span></span>', number_format_i18n( $unread_count ) );
    }

    $labels = array(
        'name'               => 'صندوق پیام‌ها',
        'singular_name'      => 'پیام',
        'menu_name'          => $menu_name,
        'name_admin_bar'     => 'پیام جدید',
        'all_items'          => 'همه پیام‌ها',
        'view_item'          => 'مشاهده پیام',
        'search_items'       => 'جستجوی پیام‌ها',
        'not_found'          => 'پیامی پیدا نشد',
        'not_found_in_trash' => 'پیامی در زباله‌دان پیدا نشد',
    );

    $args = array(
        'labels'             => $labels,
        'public'             => false,
        'publicly_queryable' => false,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'query_var'          => true,
        'rewrite'            => false,
        'capability_type'    => 'post',
        'capabilities'       => array(
            'create_posts' => 'do_not_allow', // disable manual creation
        ),
        'map_meta_cap'       => true,
        'has_archive'        => false,
        'hierarchical'       => false,
        'menu_position'      => 25,
        'menu_icon'          => 'dashicons-email-alt',
        'supports'           => array( 'title', 'editor' ),
    );
    register_post_type( 'kermancopper_message', $args );
}
add_action( 'init', 'kermancopper_register_contact_cpt' );

/**
 * Get count of unread messages
 */
function kermancopper_get_unread_messages_count() {
    $query = new WP_Query( array(
        'post_type'      => 'kermancopper_message',
        'post_status'    => 'publish',
        'posts_per_page' => -1,
        'meta_query'     => array(
            'relation' => 'OR',
            array(
                'key'     => '_kermancopper_message_read',
                'value'   => '0',
                'compare' => '=',
            ),
            array(
                'key'     => '_kermancopper_message_read',
                'compare' => 'NOT EXISTS',
            ),
        ),
        'fields'         => 'ids',
    ) );
    return $query->found_posts;
}

/**
 * Mark message as read when edited/opened in wp-admin
 */
function kermancopper_mark_message_as_read( $post_id ) {
    if ( get_post_type( $post_id ) === 'kermancopper_message' ) {
        update_post_meta( $post_id, '_kermancopper_message_read', '1' );
    }
}
add_action( 'admin_init', function() {
    if ( is_admin() && isset( $_GET['post'] ) && isset( $_GET['action'] ) && 'edit' === $_GET['action'] ) {
        $post_id = intval( $_GET['post'] );
        kermancopper_mark_message_as_read( $post_id );
    }
} );

/**
 * Custom columns for kermancopper_message CPT list
 */
add_filter( 'manage_kermancopper_message_posts_columns', 'kermancopper_set_message_columns' );
function kermancopper_set_message_columns( $columns ) {
    $new_columns = array(
        'cb'           => $columns['cb'],
        'title'        => 'فرستنده (نام)',
        'contact_info' => 'اطلاعات تماس (ایمیل/موبایل)',
        'subject'      => 'موضوع پیام',
        'status'       => 'وضعیت',
        'date'         => 'تاریخ ارسال',
    );
    return $new_columns;
}

add_action( 'manage_kermancopper_message_posts_custom_column', 'kermancopper_fill_message_columns', 10, 2 );
function kermancopper_fill_message_columns( $column, $post_id ) {
    switch ( $column ) {
        case 'contact_info':
            $info = get_post_meta( $post_id, '_kermancopper_message_contact_info', true );
            echo esc_html( $info ?: '-' );
            break;
        case 'subject':
            $subject_raw = get_post_meta( $post_id, '_kermancopper_message_subject', true );
            $subject_map = array(
                'public_relations' => 'روابط عمومی و رسانه',
                'tenders'          => 'مناقصات و مزایدات',
                'sales'            => 'فروش و بازرگانی',
                'human_resources'  => 'استخدام و منابع انسانی',
                'other'            => 'سایر موضوعات',
            );
            $subject_lbl = isset( $subject_map[$subject_raw] ) ? $subject_map[$subject_raw] : $subject_raw;
            echo esc_html( $subject_lbl ?: '-' );
            break;
        case 'status':
            $read = get_post_meta( $post_id, '_kermancopper_message_read', true );
            if ( $read === '1' ) {
                echo '<span class="badge-read" style="color: #46b450; font-weight: bold;">خوانده شده</span>';
            } else {
                echo '<span class="badge-unread" style="color: #dc3232; font-weight: bold; background: #fbebeb; padding: 2px 8px; border-radius: 4px;">خوانده نشده</span>';
            }
            break;
    }
}

/**
 * Display meta details box inside message edit page
 */
add_action( 'add_meta_boxes', 'kermancopper_message_add_meta_boxes' );
function kermancopper_message_add_meta_boxes() {
    add_meta_box(
        'kermancopper_message_details',
        'اطلاعات فرستنده',
        'kermancopper_message_meta_box_callback',
        'kermancopper_message',
        'normal',
        'high'
    );
}

function kermancopper_message_meta_box_callback( $post ) {
    $info = get_post_meta( $post->ID, '_kermancopper_message_contact_info', true );
    $subject_raw = get_post_meta( $post->ID, '_kermancopper_message_subject', true );
    $subject_map = array(
        'public_relations' => 'روابط عمومی و رسانه',
        'tenders'          => 'مناقصات و مزایدات',
        'sales'            => 'فروش و بازرگانی',
        'human_resources'  => 'استخدام و منابع انسانی',
        'other'            => 'سایر موضوعات',
    );
    $subject = isset( $subject_map[$subject_raw] ) ? $subject_map[$subject_raw] : $subject_raw;

    echo '<table class="form-table">';
    echo '<tr>';
    echo '<th><strong>اطلاعات تماس:</strong></th>';
    echo '<td>' . esc_html( $info ?: '-' ) . '</td>';
    echo '</tr>';
    echo '<tr>';
    echo '<th><strong>بخش/موضوع:</strong></th>';
    echo '<td>' . esc_html( $subject ?: '-' ) . '</td>';
    echo '</tr>';
    echo '</table>';
}

/**
 * Dashboard Widget for Unread messages
 */
add_action( 'wp_dashboard_setup', 'kermancopper_add_dashboard_widgets' );
function kermancopper_add_dashboard_widgets() {
    wp_add_dashboard_widget(
        'kermancopper_contact_messages_widget',
        'پیام‌های دریافتی جدید (صندوق پیام‌ها)',
        'kermancopper_dashboard_widget_display'
    );
}

function kermancopper_dashboard_widget_display() {
    $unread_count = kermancopper_get_unread_messages_count();
    echo '<div style="margin-bottom: 15px; padding: 12px; background: #f6f6f6; border-right: 4px solid #c8682f; border-radius: 4px;">';
    echo sprintf( 'تعداد پیام‌های خوانده‌نشده: <strong style="font-size: 16px; color: #dc3232;">%s</strong>', number_format_i18n( $unread_count ) );
    echo '</div>';

    $query = new WP_Query( array(
        'post_type'      => 'kermancopper_message',
        'post_status'    => 'publish',
        'posts_per_page' => 5,
        'meta_query'     => array(
            'relation' => 'OR',
            array(
                'key'     => '_kermancopper_message_read',
                'value'   => '0',
                'compare' => '=',
            ),
            array(
                'key'     => '_kermancopper_message_read',
                'compare' => 'NOT EXISTS',
            ),
        ),
    ) );

    if ( $query->have_posts() ) {
        echo '<ul style="margin: 0; padding: 0; list-style: none;">';
        while ( $query->have_posts() ) {
            $query->the_post();
            $post_id = get_the_ID();
            $sender = get_the_title();
            $info = get_post_meta( $post_id, '_kermancopper_message_contact_info', true );
            $subject_raw = get_post_meta( $post_id, '_kermancopper_message_subject', true );
            $subject_map = array(
                'public_relations' => 'روابط عمومی و رسانه',
                'tenders'          => 'مناقصات و مزایدات',
                'sales'            => 'فروش و بازرگانی',
                'human_resources'  => 'استخدام و منابع انسانی',
                'other'            => 'سایر موضوعات',
            );
            $subject = isset( $subject_map[$subject_raw] ) ? $subject_map[$subject_raw] : $subject_raw;

            echo '<li style="padding: 10px 0; border-bottom: 1px solid #eee; display: flex; justify-content: space-between; align-items: center;">';
            echo '<div>';
            echo sprintf( '<strong>%s</strong> (%s) - <span style="color: #666; font-size: 11px;">%s</span><br>', esc_html($sender), esc_html($info), esc_html($subject) );
            echo '<span style="color: #888; font-size: 11px;">' . get_the_time('Y/m/d H:i') . '</span>';
            echo '</div>';
            echo sprintf( '<a class="button button-small" href="%s">مشاهده</a>', esc_url( get_edit_post_link( $post_id ) ) );
            echo '</li>';
        }
        echo '</ul>';
        echo '<div style="margin-top: 15px; text-align: left;">';
        echo '<a class="button button-primary" href="' . admin_url( 'edit.php?post_type=kermancopper_message' ) . '">مشاهده همه پیام‌ها</a>';
        echo '</div>';
    } else {
        echo '<p>پیام جدیدی وجود ندارد.</p>';
    }
    wp_reset_postdata();
}

/**
 * Handle Contact Form submission via AJAX
 */
add_action( 'wp_ajax_kermancopper_submit_contact_form', 'kermancopper_handle_contact_form_submit' );
add_action( 'wp_ajax_nopriv_kermancopper_submit_contact_form', 'kermancopper_handle_contact_form_submit' );

function kermancopper_handle_contact_form_submit() {
    $name = isset( $_POST['name'] ) ? sanitize_text_field( $_POST['name'] ) : '';
    $contact_info = isset( $_POST['contact_info'] ) ? sanitize_text_field( $_POST['contact_info'] ) : '';
    $subject_raw = isset( $_POST['subject'] ) ? sanitize_text_field( $_POST['subject'] ) : '';
    $message = isset( $_POST['message'] ) ? sanitize_textarea_field( $_POST['message'] ) : '';

    $validation_msg = get_theme_mod( 'kermancopper_contact_validation_message', 'لطفاً تمامی فیلدهای اجباری را به درستی پر کنید.' );
    $success_msg = get_theme_mod( 'kermancopper_contact_success_message', 'پیام شما با موفقیت ثبت شد. به زودی با شما تماس می‌گیریم.' );
    $error_msg = get_theme_mod( 'kermancopper_contact_error_message', 'متأسفانه خطایی در ارسال پیام رخ داده است. لطفاً مجدداً تلاش کنید.' );

    if ( empty( $name ) || empty( $contact_info ) || empty( $message ) ) {
        wp_send_json_error( array( 'message' => $validation_msg ) );
    }

    // Insert message into CPT
    $post_id = wp_insert_post( array(
        'post_title'   => $name,
        'post_content' => $message,
        'post_status'  => 'publish',
        'post_type'    => 'kermancopper_message',
    ) );

    if ( is_wp_error( $post_id ) || ! $post_id ) {
        wp_send_json_error( array( 'message' => $error_msg ) );
    }

    // Save post meta
    update_post_meta( $post_id, '_kermancopper_message_contact_info', $contact_info );
    update_post_meta( $post_id, '_kermancopper_message_subject', $subject_raw );
    update_post_meta( $post_id, '_kermancopper_message_read', '0' );

    // Send email to recipient email
    $recipient = get_theme_mod( 'kermancopper_contact_recipient_email', get_option( 'admin_email' ) );
    
    $subject_map = array(
        'public_relations' => 'روابط عمومی و رسانه',
        'tenders'          => 'مناقصات و مزایدات',
        'sales'            => 'فروش و بازرگانی',
        'human_resources'  => 'استخدام و منابع انسانی',
        'other'            => 'سایر موضوعات',
    );
    $subject_label = isset( $subject_map[$subject_raw] ) ? $subject_map[$subject_raw] : 'تماس مستقیم';

    $email_subject = 'پیام جدید از فرم تماس: ' . $name;
    $headers = array('Content-Type: text/html; charset=UTF-8');
    
    // HTML Email Template
    $email_body = '
    <!DOCTYPE html>
    <html lang="fa" dir="rtl">
    <head>
        <meta charset="UTF-8">
        <style>
            body { font-family: Tahoma, Geneva, sans-serif; direction: rtl; text-align: right; background-color: #FAF8F5; color: #1A2235; margin: 0; padding: 30px; }
            .wrapper { max-width: 600px; margin: 0 auto; background: #ffffff; border-radius: 24px; overflow: hidden; box-shadow: 0 10px 40px rgba(0,0,0,0.03); border: 1px solid #E2E8F0; }
            .header { background-color: #1A2235; padding: 40px; text-align: center; border-bottom: 4px solid #C8682F; }
            .header h2 { color: #ffffff; margin: 0; font-size: 22px; font-weight: bold; letter-spacing: 0.5px; }
            .header p { color: #C8682F; margin: 8px 0 0 0; font-size: 13px; font-weight: bold; }
            .body { padding: 40px 30px; }
            .field-row { margin-bottom: 25px; padding-bottom: 20px; border-bottom: 1px solid #F1F5F9; }
            .field-row:last-child { margin-bottom: 0; padding-bottom: 0; border-bottom: none; }
            .label { font-weight: 800; color: #C8682F; font-size: 13px; margin-bottom: 8px; }
            .value { font-size: 15px; color: #334155; line-height: 1.8; }
            .message-box { background: #FAF8F5; padding: 20px; border-radius: 16px; border-right: 4px solid #C8682F; font-size: 15px; line-height: 1.8; color: #1A2235; margin-top: 10px; }
            .footer { background-color: #FAF8F5; padding: 25px; text-align: center; font-size: 11px; color: #94A3B8; border-top: 1px solid #E2E8F0; line-height: 1.6; }
        </style>
    </head>
    <body>
        <div class="wrapper">
            <div class="header">
                <h2>صنایع و معادن مس کرمان زمین</h2>
                <p>دریافت پیام جدید از وب‌سایت</p>
            </div>
            <div class="body">
                <div class="field-row">
                    <div class="label">فرستنده پیام</div>
                    <div class="value">' . esc_html( $name ) . '</div>
                </div>
                <div class="field-row">
                    <div class="label">اطلاعات تماس (ایمیل / موبایل)</div>
                    <div class="value" dir="ltr" style="text-align: right;">' . esc_html( $contact_info ) . '</div>
                </div>
                <div class="field-row">
                    <div class="label">موضوع پیام</div>
                    <div class="value">' . esc_html( $subject_label ) . '</div>
                </div>
                <div class="field-row">
                    <div class="label">متن پیام</div>
                    <div class="message-box">' . nl2br( esc_html( $message ) ) . '</div>
                </div>
            </div>
            <div class="footer">
                این پیام به صورت خودکار از فرم تماس وب‌سایت صنایع و معادن مس کرمان زمین ارسال شده است.<br>
                لطفاً به این ایمیل پاسخ ندهید. برای مدیریت پیام‌ها به پنل وردپرس بخش صندوق پیام‌ها مراجعه کنید.
            </div>
        </div>
    </body>
    </html>
    ';

    $to_emails = array_map( 'trim', explode( ',', $recipient ) );
    foreach ( $to_emails as $email ) {
        if ( is_email( $email ) ) {
            wp_mail( $email, $email_subject, $email_body, $headers );
        }
    }

    wp_send_json_success( array( 'message' => $success_msg ) );
}


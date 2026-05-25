<!DOCTYPE html>
<html <?php language_attributes(); ?> dir="rtl">
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title><?php wp_title( '|', true, 'right' ); ?></title>
    <!-- Fonts -->
    <style>
      :root {
        --color-copper: <?php echo get_theme_mod( 'kermancopper_color_copper', '#c86429' ); ?>;
        --color-industrial-green: <?php echo get_theme_mod( 'kermancopper_color_industrial_green', '#0B6E60' ); ?>;
        --color-bg-body: <?php echo get_theme_mod( 'kermancopper_color_bg_body', '#F5F7FA' ); ?>;
        --color-text-main: <?php echo get_theme_mod( 'kermancopper_color_text_main', '#0F1724' ); ?>;
        --color-soft-gold: <?php echo get_theme_mod( 'kermancopper_color_soft_gold', '#c4a962' ); ?>;
      }
      
      /* Hide last separator in menu */
      .menu-item:last-child .menu-separator { display: none; }
     
      @font-face {
            font-family: 'PeydaWebVF';
            src: url('<?php echo get_template_directory_uri(); ?>/fonts/peyda/PeydaWebVF.woff2') format('woff2-variations'),
                 url('<?php echo get_template_directory_uri(); ?>/fonts/peyda/PeydaWebVF.woff') format('woff-variations');
            font-weight: 100 950;
            font-style: normal;
            font-display: swap;
        }

       

      html {
        scroll-behavior: smooth;
      }

      body {
        font-family: 'PeydaWebVF', sans-serif;
        -moz-font-feature-settings: "ss02";
        -webkit-font-feature-settings: "ss02";
        font-feature-settings: "ss02";
        background-color: var(--color-bg-body);
        color: var(--color-text-main);
        overflow-x: hidden;
      }

      .bg-copper { background-color: var(--color-copper); }
      .text-copper { color: var(--color-copper); }
      .border-copper { border-color: var(--color-copper); }
      .bg-industrial-green { background-color: var(--color-industrial-green); }
      .text-industrial-green { color: var(--color-industrial-green); }
      .bg-soft-gold { background-color: var(--color-soft-gold); }
      
      .hero-gradient {
        background: linear-gradient(rgba(15, 23, 36, 0.6), rgba(15, 23, 36, 0.4));
      }
      
      .sticky-nav {
        transition: all 0.3s ease;
      }
      .sticky-nav.scrolled {
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(10px);
        box-shadow: 0 4px 6px -1px rgb(0 0 0 / 0.1);
        padding-top: 0.25rem;
        padding-bottom: 0.25rem;
      }
      
      .card-hover:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 15px -3px rgb(0 0 0 / 0.1);
      }
      
      .rounded-2xl, .rounded-3xl, .rounded-[3rem], .rounded-xl, .rounded-lg {
        border-radius: 0.125rem !important;
      }

      /* Animation Utilities */
      .fade-in-section {
        opacity: 0;
        transform: translateY(30px);
        transition: opacity 0.8s ease-out, transform 0.8s ease-out;
        will-change: opacity, transform;
      }
      .fade-in-section.is-visible {
        opacity: 1;
        transform: none;
      }

      /* Mobile Menu Transition */
      #mobile-menu-overlay {
        transition: opacity 0.3s ease;
      }
      #mobile-menu-sidebar {
        transition: transform 0.3s ease, opacity 0.3s ease;
      }
      
      /* Ads Dropdown */
      #ads-dropdown {
        transition: opacity 0.2s ease, transform 0.2s ease;
        display: none;
      }
      /* Hover Bridge to prevent dropdown closing */
      .group:hover #ads-dropdown, #ads-dropdown:hover {
        display: block;
        animation: fadeIn 0.2s ease forwards;
      }
      .group {
        padding-bottom: 10px; /* Invisible bridge */
        margin-bottom: -10px;
      }
      @keyframes fadeIn {
        from { opacity: 0; transform: translateY(5px); }
        to { opacity: 1; transform: translateY(0); }
      }
    </style>
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php
$is_home = is_front_page();
$header_position_class = $is_home ? 'absolute' : 'relative';
$top_bar_classes = $is_home ? 'bg-transparent border-white/10 text-white/80' : 'bg-white border-slate-100 text-slate-500';
$nav_bg_classes = $is_home ? 'bg-transparent' : 'bg-[#c86429]';
$nav_text_classes = $is_home ? 'text-white/90' : 'text-white';
$icon_button_classes = $is_home ? 'text-white hover:bg-white/10' : 'text-white hover:bg-white/10';
$mobile_button_classes = $is_home ? 'text-white hover:bg-white/10' : 'text-white hover:bg-white/10';
$separator_classes = $is_home ? 'text-white/30' : 'text-white/30';
$social_icon_classes = $is_home ? 'text-white/70 hover:text-white' : 'text-white/70 hover:text-white';
$lang_active_classes = $is_home ? 'text-white' : 'text-white';
$lang_hover_classes = $is_home ? 'hover:text-white' : 'hover:text-white';
$icon_color_classes = $is_home ? 'text-white' : 'text-copper';
$border_social_classes = $is_home ? 'sm:border-white/15' : 'sm:border-white/15';
$border_lang_classes = $is_home ? 'sm:border-white/15' : 'sm:border-white/15';
$underline_classes = $is_home ? 'bg-white/70' : 'bg-copper';
$topbar_link_hover = $is_home ? 'hover:text-white' : 'hover:text-copper';
$topbar_address = trim( (string) get_theme_mod( 'kermancopper_address', '' ) );
$topbar_email = trim( (string) get_theme_mod( 'kermancopper_email', '' ) );
$topbar_phone = trim( (string) get_theme_mod( 'kermancopper_phone', '' ) );
?>

    <!-- Top Bar -->
    <?php if ( get_theme_mod( 'kermancopper_show_topbar', true ) ) : ?>
    <div class="absolute top-0 w-full z-50 border-b border-white/5 bg-transparent py-2.5 text-xs text-white hidden lg:block">
        <div class="container mx-auto px-6 lg:px-12 flex justify-between items-center">
            <!-- Left Side: Lang and Socials -->
            <div class="flex items-center gap-6">
                <div class="flex items-center gap-2 border-l border-white/10 pl-6">
                    <span class="hover:text-copper cursor-pointer font-bold transition-colors">En</span>
                    <span class="text-white/20">|</span>
                    <span class="text-copper font-bold transition-colors">Fa</span>
                </div>
                <div class="flex items-center gap-4">
                    <?php if ( $instagram = get_theme_mod( 'kermancopper_social_instagram' ) ) : ?>
                        <a href="<?php echo esc_url( $instagram ); ?>" class="hover:text-copper transition-colors" target="_blank"><?php echo kermancopper_icon('instagram', 'w-4 h-4'); ?></a>
                    <?php endif; ?>
                    <?php if ( $linkedin = get_theme_mod( 'kermancopper_social_linkedin' ) ) : ?>
                        <a href="<?php echo esc_url( $linkedin ); ?>" class="hover:text-copper transition-colors" target="_blank"><?php echo kermancopper_icon('linkedin', 'w-4 h-4'); ?></a>
                    <?php endif; ?>
                    <?php if ( $twitter = get_theme_mod( 'kermancopper_social_twitter' ) ) : ?>
                        <a href="<?php echo esc_url( $twitter ); ?>" class="hover:text-copper transition-colors" target="_blank"><?php echo kermancopper_icon('twitter', 'w-4 h-4'); ?></a>
                    <?php endif; ?>
                </div>
            </div>
            <!-- Right Side: Contact info -->
            <div class="flex items-center gap-6" dir="ltr">
                <?php if ( $topbar_phone ) : ?>
                <a href="tel:<?php echo esc_attr( preg_replace( '/\s+/', '', $topbar_phone ) ); ?>" class="flex items-center gap-2 hover:text-copper transition-colors">
                    <span><?php echo esc_html( $topbar_phone ); ?></span>
                    <?php echo kermancopper_icon('phone', 'w-4 h-4 text-copper'); ?>
                </a>
                <?php endif; ?>
                <?php if ( $topbar_phone && $topbar_email ) : ?>
                <span class="text-white/20">|</span>
                <?php endif; ?>
                <?php if ( $topbar_email ) : ?>
                <a href="mailto:<?php echo esc_attr( $topbar_email ); ?>"
                    class="flex items-center gap-2 hover:text-copper transition-colors">
                    <span><?php echo esc_html( $topbar_email ); ?></span>
                    <?php echo kermancopper_icon('mail', 'w-4 h-4 text-copper'); ?>
                </a>
                <?php endif; ?>
            </div>
        </div>
    </div>
    <?php endif; ?>

    <!-- Navbar -->
    <nav class="absolute top-0 lg:top-10 w-full z-50 py-6 animate-fade-in-down">
        <div class="container mx-auto px-6 lg:px-12 flex justify-between items-center">
            <div class="flex-shrink-0">
                <?php if ( has_custom_logo() ) : ?>
                    <?php
                    $custom_logo_id = get_theme_mod( 'custom_logo' );
                    $logo = wp_get_attachment_image_src( $custom_logo_id , 'full' );
                    if ( has_custom_logo() ) {
                        echo '<a href="' . esc_url( home_url( '/' ) ) . '" class="block transition-transform hover:scale-105"><img src="' . esc_url( $logo[0] ) . '" class="h-12 md:h-14 lg:h-16 xl:h-20 w-auto object-contain" alt="' . get_bloginfo( 'name' ) . '"></a>';
                    }
                    ?>
                <?php endif; ?>
            </div>

            <!-- Desktop Menu -->
            <div class="hidden lg:flex items-center gap-4 xl:gap-8 text-white/90 text-xs lg:text-sm font-medium bg-white/5 backdrop-blur-md px-6 xl:px-12 py-3 rounded-full border border-white/10 shadow-sm mx-4">
                <?php
                if ( has_nav_menu( 'primary' ) ) {
                    wp_nav_menu( array(
                        'theme_location' => 'primary',
                        'container'      => false,
                        'menu_class'     => 'flex items-center gap-4 xl:gap-8',
                        'walker'         => new KermanCopper_Nav_Walker(),
                        'fallback_cb'    => false,
                    ) );
                } else {
                    ?>
                    <!-- Static Menu (Fallback) -->
                    <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="nav-link <?php echo is_front_page() ? 'active' : ''; ?> hover:text-copper">خانه</a>
                    <span class="h-4 w-px bg-white/15"></span>
                    <a href="<?php echo esc_url( home_url( '/news' ) ); ?>" class="nav-link <?php echo (is_home() || is_singular('post')) ? 'active' : ''; ?> hover:text-copper">اخبار و رویدادها</a>
                    <span class="h-4 w-px bg-white/15"></span>
                    <a href="<?php echo esc_url( home_url( '/about' ) ); ?>" class="nav-link <?php echo is_page('about') ? 'active' : ''; ?> hover:text-copper">درباره ما</a>
                    <span class="h-4 w-px bg-white/15"></span>
                    <a href="<?php echo esc_url( home_url( '/contact' ) ); ?>" class="nav-link <?php echo is_page('contact') ? 'active' : ''; ?> hover:text-copper">تماس با ما</a>
                    <span class="h-4 w-px bg-white/15"></span>
                    <a href="<?php echo esc_url( home_url( '/kermancopper_ad' ) ); ?>" class="nav-link <?php echo is_post_type_archive('kermancopper_ad') ? 'active' : ''; ?> hover:text-copper">آگهی‌ها</a>
                    <?php
                }
                ?>
            </div>

            <!-- Utility Icons -->
            <div class="flex-shrink-0">
                <div class="flex items-center gap-4 text-white/80">
                    <button id="search-open-btn" class="hover:text-copper transition-colors focus:outline-none"><?php echo kermancopper_icon('search', 'w-5 h-5'); ?></button>
                    <button id="mobile-menu-btn" class="hover:text-copper transition-colors focus:outline-none lg:hidden"><?php echo kermancopper_icon('menu', 'w-5 h-5'); ?></button>
                </div>
            </div>
        </div>

        <!-- Mobile Sidebar Overlay -->
        <div id="mobile-menu-overlay" class="fixed inset-0 bg-black/50 backdrop-blur-sm z-[60] hidden opacity-0 transition-opacity duration-300"></div>
        <div id="mobile-menu-sidebar" class="fixed inset-y-0 right-0 w-full sm:w-80 bg-white shadow-2xl z-[70] flex flex-col p-8 rounded-l-2xl translate-x-full opacity-0 transition-all duration-300">
            <div class="flex justify-between items-center mb-10 border-b border-slate-100 pb-4">
                 <?php if ( has_custom_logo() ) : ?>
                    <?php
                    $custom_logo_id = get_theme_mod( 'custom_logo' );
                    $logo = wp_get_attachment_image_src( $custom_logo_id , 'full' );
                    if ( has_custom_logo() ) {
                        echo '<a href="' . esc_url( home_url( '/' ) ) . '"><img src="' . esc_url( $logo[0] ) . '" class="h-10 w-auto object-contain" alt="' . get_bloginfo( 'name' ) . '"></a>';
                    }
                    ?>
                <?php else : ?>
                    <span class="font-bold text-copper text-lg">کرمان زمین</span>
                <?php endif; ?>
                <button id="close-mobile-menu" class="p-2 hover:bg-slate-50 rounded-lg text-slate-500 transition-colors">
                    <?php echo kermancopper_icon('x', 'w-6 h-6'); ?>
                </button>
            </div>
            
            <div class="space-y-1 overflow-y-auto flex-1">
                <?php
                if ( has_nav_menu( 'primary' ) ) {
                    wp_nav_menu( array(
                        'theme_location' => 'primary',
                        'container'      => false,
                        'menu_class'     => 'space-y-1 list-none',
                        'fallback_cb'    => false,
                        'items_wrap'     => '<ul class="%2$s">%3$s</ul>',
                        'walker'         => new KermanCopper_Mobile_Nav_Walker(),
                    ) );
                } else {
                    ?>
                    <div class="mobile-menu-item border-b border-slate-50 last:border-0"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="block py-3.5 px-2 text-base font-medium text-slate-700 hover:text-copper hover:bg-copper/5 rounded-lg transition-colors">صفحه اصلی</a></div>
                    <div class="mobile-menu-item border-b border-slate-50 last:border-0"><a href="<?php echo esc_url( home_url( '/kermancopper_ad' ) ); ?>" class="block py-3.5 px-2 text-base font-medium text-slate-700 hover:text-copper hover:bg-copper/5 rounded-lg transition-colors">آگهی‌ها</a></div>
                    <div class="mobile-menu-item border-b border-slate-50 last:border-0"><a href="<?php echo esc_url( home_url( '/news' ) ); ?>" class="block py-3.5 px-2 text-base font-medium text-slate-700 hover:text-copper hover:bg-copper/5 rounded-lg transition-colors">اخبار و رویدادها</a></div>
                    <div class="mobile-menu-item border-b border-slate-50 last:border-0"><a href="<?php echo esc_url( home_url( '/about' ) ); ?>" class="block py-3.5 px-2 text-base font-medium text-slate-700 hover:text-copper hover:bg-copper/5 rounded-lg transition-colors">درباره ما</a></div>
                    <div class="mobile-menu-item border-b border-slate-50 last:border-0"><a href="<?php echo esc_url( home_url( '/contact' ) ); ?>" class="block py-3.5 px-2 text-base font-medium text-slate-700 hover:text-copper hover:bg-copper/5 rounded-lg transition-colors">تماس با ما</a></div>
                    <?php
                }
                ?>
            </div>

            <div class="mt-auto pt-8 border-t border-slate-100">
                <div class="flex justify-center gap-6 text-slate-400">
                    <?php if ( $instagram = get_theme_mod( 'kermancopper_social_instagram' ) ) : ?><a href="<?php echo esc_url( $instagram ); ?>" class="hover:text-copper transition-colors" target="_blank"><?php echo kermancopper_icon('instagram', 'w-5 h-5'); ?></a><?php endif; ?>
                    <?php if ( $linkedin = get_theme_mod( 'kermancopper_social_linkedin' ) ) : ?><a href="<?php echo esc_url( $linkedin ); ?>" class="hover:text-copper transition-colors" target="_blank"><?php echo kermancopper_icon('linkedin', 'w-5 h-5'); ?></a><?php endif; ?>
                    <?php if ( $twitter = get_theme_mod( 'kermancopper_social_twitter' ) ) : ?><a href="<?php echo esc_url( $twitter ); ?>" class="hover:text-copper transition-colors" target="_blank"><?php echo kermancopper_icon('twitter', 'w-5 h-5'); ?></a><?php endif; ?>
                </div>
            </div>
        </div>
    </nav>

    <!-- Search Spotlight -->
    <div id="search-spotlight" class="fixed inset-0 z-[100] hidden">
        <div class="absolute inset-0 bg-slate-900/60 backdrop-blur-sm transition-opacity duration-300 opacity-0" id="search-overlay"></div>
        <div class="absolute inset-x-0 top-0 pt-24 px-4 transition-all duration-300 transform -translate-y-10 opacity-0" id="search-modal-content">
            <div class="max-w-3xl mx-auto bg-white rounded-2xl shadow-2xl overflow-hidden border border-slate-100">
                <form action="<?php echo esc_url( home_url( '/' ) ); ?>" method="get" class="relative">
                    <div class="p-6 sm:p-8 flex items-center gap-4 border-b border-slate-100">
                        <?php echo kermancopper_icon('search', 'w-7 h-7 text-copper'); ?>
                        <input type="text" name="s" id="search-input-field" placeholder="جستجو در مقالات، آگهی‌ها..." class="flex-1 bg-transparent border-none text-xl sm:text-2xl font-peyda text-slate-800 placeholder:text-slate-300 focus:ring-0 outline-none" autocomplete="off">
                        <button type="button" id="search-close-btn" class="p-3 hover:bg-slate-50 rounded-xl transition-colors text-slate-400 hover:text-slate-700 focus:outline-none bg-slate-50/50">
                            <?php echo kermancopper_icon('x', 'w-6 h-6'); ?>
                        </button>
                    </div>
                    <div class="p-4 sm:px-8 sm:py-5 bg-[#FAF8F5] flex flex-col sm:flex-row items-center justify-between text-xs text-slate-500 font-sans">
                        <div class="flex items-center gap-6 mb-3 sm:mb-0">
                            <span class="flex items-center gap-2"><kbd class="px-2 py-1 rounded-md border border-slate-200 bg-white font-mono shadow-sm">Enter</kbd> برای جستجو</span>
                            <span class="flex items-center gap-2"><kbd class="px-2 py-1 rounded-md border border-slate-200 bg-white font-mono shadow-sm">Esc</kbd> برای بستن</span>
                        </div>
                        <span class="font-bold text-copper/80">صنایع و معادن مس کرمان زمین</span>
                    </div>
                </form>
            </div>
        </div>
    </div>    </header>

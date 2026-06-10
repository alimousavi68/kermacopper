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

      @font-face {
            font-family: 'IRANYekanX';
            src: url('<?php echo get_template_directory_uri(); ?>/fonts/IRANYekanX/woff2/IRANYekanX-Regular.woff2') format('woff2'),
                 url('<?php echo get_template_directory_uri(); ?>/fonts/IRANYekanX/woff/IRANYekanX-Regular.woff') format('woff');
            font-weight: normal;
            font-style: normal;
            font-display: swap;
        }

       

      html {
        scroll-behavior: smooth;
        overflow-x: hidden;
      }

      body {
        font-family: 'PeydaWebVF', 'IRANYekanX', sans-serif;
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

      /* Luxury Pattern Slide-in & Shimmer */
      .hero-pattern-left-wrapper {
        opacity: 0;
        will-change: transform, opacity;
        animation: slideInPattern 0.8s cubic-bezier(0.16, 1, 0.3, 1) 0s forwards;
      }
      
      @keyframes slideInPattern {
        0% {
          opacity: 0;
          transform: translateX(-100px);
        }
        50% {
          opacity: 0.85;
        }
        100% {
          opacity: 1;
          transform: translateX(0);
        }
      }
      
      .hero-pattern-shimmer {
        position: absolute;
        top: 0;
        bottom: 0;
        left: -200%;
        width: 250%;
        background: linear-gradient(
          105deg,
          transparent 20%,
          rgba(255, 215, 140, 0.15) 35%,
          rgba(255, 255, 255, 0.55) 50%,
          rgba(255, 215, 140, 0.15) 65%,
          transparent 80%
        );
        transform: skewX(-20deg);
        pointer-events: none;
        opacity: 0;
        mix-blend-mode: screen;
      }

      /* Initial shimmer plays once after slide-in */
      .hero-pattern-shimmer.shimmer-play {
        animation: sweepShimmer 1.2s cubic-bezier(0.25, 0.46, 0.45, 0.94) forwards;
      }
      
      @keyframes sweepShimmer {
        0% {
          opacity: 0;
          left: -200%;
        }
        15% {
          opacity: 1;
        }
        85% {
          opacity: 0.9;
        }
        100% {
          opacity: 0;
          left: 150%;
        }
      }

      /* Subtle persistent glow after shimmer */
      .hero-pattern-left-wrapper.pattern-visible {
        filter: drop-shadow(0 0 18px rgba(200, 104, 47, 0.18));
        transition: filter 1.5s ease;
      }
      .hero-pattern-left-wrapper.pattern-visible:hover {
        filter: drop-shadow(0 0 30px rgba(200, 104, 47, 0.35));
      }

      /* Premium Mobile Menu Drawer */
      #mobile-menu-overlay {
        transition: opacity 0.5s cubic-bezier(0.16, 1, 0.3, 1);
      }
      #mobile-menu-sidebar {
        transition: transform 0.5s cubic-bezier(0.16, 1, 0.3, 1), opacity 0.5s cubic-bezier(0.16, 1, 0.3, 1);
        backdrop-filter: blur(32px) saturate(190%);
        -webkit-backdrop-filter: blur(32px) saturate(190%);
        background: rgba(9, 13, 22, 0.94);
        border-left: 1px solid rgba(200, 104, 47, 0.15);
      }
      #mobile-menu-sidebar a {
        color: rgba(255, 255, 255, 0.88) !important;
        font-family: 'PeydaWebVF', 'PeydaFa', sans-serif !important;
        transition: all 0.4s cubic-bezier(0.16, 1, 0.3, 1);
        display: inline-block;
      }
      #mobile-menu-sidebar a:hover,
      #mobile-menu-sidebar a.text-copper {
        color: #C8682F !important;
        text-shadow: 0 0 16px rgba(200, 104, 47, 0.45);
        transform: scale(1.08);
      }
      
      /* Stagger Animations */
      #mobile-menu-sidebar .mobile-menu-item {
        opacity: 0;
        transform: translateY(25px);
        transition: opacity 0.6s cubic-bezier(0.16, 1, 0.3, 1), transform 0.6s cubic-bezier(0.16, 1, 0.3, 1);
      }
      #mobile-menu-sidebar:not(.translate-x-full) .mobile-menu-item {
        opacity: 1;
        transform: translateY(0);
      }
      #mobile-menu-sidebar:not(.translate-x-full) .mobile-menu-item:nth-child(1) { transition-delay: 0.10s; }
      #mobile-menu-sidebar:not(.translate-x-full) .mobile-menu-item:nth-child(2) { transition-delay: 0.16s; }
      #mobile-menu-sidebar:not(.translate-x-full) .mobile-menu-item:nth-child(3) { transition-delay: 0.22s; }
      #mobile-menu-sidebar:not(.translate-x-full) .mobile-menu-item:nth-child(4) { transition-delay: 0.28s; }
      #mobile-menu-sidebar:not(.translate-x-full) .mobile-menu-item:nth-child(5) { transition-delay: 0.34s; }
      #mobile-menu-sidebar:not(.translate-x-full) .mobile-menu-item:nth-child(6) { transition-delay: 0.40s; }
      #mobile-menu-sidebar:not(.translate-x-full) .mobile-menu-item:nth-child(7) { transition-delay: 0.46s; }
      #mobile-menu-sidebar:not(.translate-x-full) .mobile-menu-item:nth-child(8) { transition-delay: 0.52s; }

      #mobile-menu-sidebar button {
        transition: all 0.3s cubic-bezier(0.16, 1, 0.3, 1);
      }
      #mobile-menu-sidebar svg {
        stroke: currentColor !important;
      }
      #mobile-menu-sidebar .overflow-y-auto::-webkit-scrollbar {
        width: 3px;
      }
      #mobile-menu-sidebar .overflow-y-auto::-webkit-scrollbar-track {
        background: transparent;
      }
      #mobile-menu-sidebar .overflow-y-auto::-webkit-scrollbar-thumb {
        background: rgba(200, 104, 47, 0.2);
        border-radius: 99px;
      }
      #mobile-menu-sidebar .overflow-y-auto::-webkit-scrollbar-thumb:hover {
        background: rgba(200, 104, 47, 0.4);
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
                <?php if ( ! $is_home ) : ?>
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
                <?php endif; ?>
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
        <div class="container mx-auto px-4 lg:px-6 xl:px-12 flex justify-between items-center">
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
            <div class="hidden lg:flex items-center text-white/90 text-xs xl:text-sm font-medium bg-white/5 backdrop-blur-md px-4 lg:px-6 xl:px-8 py-1 rounded-full border border-white/10 shadow-sm mx-2 xl:mx-4">
                <?php
                if ( has_nav_menu( 'primary' ) ) {
                    wp_nav_menu( array(
                        'theme_location' => 'primary',
                        'container'      => false,
                        'menu_class'     => 'flex items-center',
                        'walker'         => new KermanCopper_Nav_Walker(),
                        'fallback_cb'    => false,
                    ) );
                } else {
                    ?>
                    <!-- Static Menu (Fallback) -->
                    <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="nav-link <?php echo is_front_page() ? 'active' : ''; ?> hover:text-copper whitespace-nowrap">خانه</a>
                    <span class="h-4 w-px bg-white/15 mx-6 lg:mx-3 xl:mx-4"></span>
                    <a href="<?php echo esc_url( home_url( '/news' ) ); ?>" class="nav-link <?php echo (is_home() || is_singular('post')) ? 'active' : ''; ?> hover:text-copper whitespace-nowrap">اخبار و رویدادها</a>
                    <span class="h-4 w-px bg-white/15 mx-6 lg:mx-3 xl:mx-4"></span>
                    <a href="<?php echo esc_url( home_url( '/about' ) ); ?>" class="nav-link <?php echo is_page('about') ? 'active' : ''; ?> hover:text-copper whitespace-nowrap">درباره ما</a>
                    <span class="h-4 w-px bg-white/15 mx-6 lg:mx-3 xl:mx-4"></span>
                    <a href="<?php echo esc_url( home_url( '/contact' ) ); ?>" class="nav-link <?php echo is_page('contact') ? 'active' : ''; ?> hover:text-copper whitespace-nowrap">تماس با ما</a>
                    <span class="h-4 w-px bg-white/15 mx-6 lg:mx-3 xl:mx-4"></span>
                    <a href="<?php echo esc_url( home_url( '/kermancopper_ad' ) ); ?>" class="nav-link <?php echo is_post_type_archive('kermancopper_ad') ? 'active' : ''; ?> hover:text-copper whitespace-nowrap">آگهی‌ها</a>
                    <?php
                }
                ?>
            </div>

            <!-- Utility Icons -->
            <div class="flex-shrink-0">
                <div class="flex items-center gap-4 text-white/80">
                    <?php 
                        $dashboard_page = get_page_by_path('dashboard');
                        $dashboard_url = $dashboard_page ? get_permalink($dashboard_page->ID) : home_url( '/dashboard/' );
                        
                        $login_page = get_page_by_path('login');
                        $login_url = $login_page ? get_permalink($login_page->ID) : home_url( '/login/' );
                        
                        if ( is_user_logged_in() ) : 
                        $current_user = wp_get_current_user();
                        $company_name = get_user_meta( $current_user->ID, 'company', true );
                        $display_name = $company_name ? $company_name : ($current_user->first_name ? $current_user->first_name : $current_user->display_name);
                        $short_name = mb_strimwidth($display_name, 0, 20, '...');
                    ?>
                        <div class="relative group/userdropdown">
                            <a href="<?php echo esc_url( $dashboard_url ); ?>" class="flex items-center justify-center md:gap-2 p-1 md:px-3 md:py-1.5 rounded-full bg-white/5 border border-white/10 hover:bg-white/10 hover:border-copper/30 transition-all duration-300 w-9 h-9 md:w-auto md:h-auto max-w-[180px] sm:max-w-none">
                                <span class="hidden md:inline text-xs font-bold text-white/90 group-hover/userdropdown:text-copper transition-colors truncate max-w-[80px] sm:max-w-[120px] font-peyda"><?php echo esc_html( $short_name ); ?></span>
                                <div class="w-6 h-6 rounded-full bg-copper/20 flex items-center justify-center text-copper group-hover/userdropdown:bg-copper group-hover/userdropdown:text-white transition-all duration-300 flex-shrink-0 shadow-inner">
                                    <svg class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M12 12C14.7614 12 17 9.76142 17 7C17 4.23858 14.7614 2 12 2C9.23858 2 7 4.23858 7 7C7 9.76142 9.23858 12 12 12Z" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/>
                                        <path d="M20.5899 22C20.5899 18.13 16.7399 15 11.9999 15C7.25991 15 3.40991 18.13 3.40991 22" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>
                                </div>
                            </a>
                            
                            <!-- Dropdown Menu -->
                            <div class="absolute top-full left-0 mt-3 w-56 bg-white rounded-2xl shadow-xl shadow-navy/5 border border-slate-100 opacity-0 invisible group-hover/userdropdown:opacity-100 group-hover/userdropdown:visible transition-all duration-300 transform translate-y-3 group-hover/userdropdown:translate-y-0 z-[100] overflow-hidden">
                                <div class="p-2 flex flex-col gap-1">
                                    <a href="<?php echo esc_url( add_query_arg('tab', 'requests', $dashboard_url) ); ?>" class="flex items-center gap-3 px-4 py-2.5 rounded-xl text-sm font-bold text-slate-700 hover:text-copper hover:bg-slate-50 transition-colors group/item">
                                        <span class="text-slate-400 group-hover/item:text-copper transition-colors"><?php echo kermancopper_icon('file-text', 'w-4 h-4'); ?></span>
                                        <span>لیست درخواست‌ها</span>
                                    </a>
                                    <a href="<?php echo esc_url( add_query_arg('tab', 'profile', $dashboard_url) ); ?>" class="flex items-center gap-3 px-4 py-2.5 rounded-xl text-sm font-bold text-slate-700 hover:text-copper hover:bg-slate-50 transition-colors group/item">
                                        <span class="text-slate-400 group-hover/item:text-copper transition-colors"><?php echo kermancopper_icon('user', 'w-4 h-4'); ?></span>
                                        <span>مشخصات عمومی</span>
                                    </a>
                                    <a href="<?php echo esc_url( add_query_arg('tab', 'password', $dashboard_url) ); ?>" class="flex items-center gap-3 px-4 py-2.5 rounded-xl text-sm font-bold text-slate-700 hover:text-copper hover:bg-slate-50 transition-colors group/item">
                                        <span class="text-slate-400 group-hover/item:text-copper transition-colors"><?php echo kermancopper_icon('shield-check', 'w-4 h-4'); ?></span>
                                        <span>تغییر کلمه عبور</span>
                                    </a>
                                    <div class="h-px bg-slate-100 my-1 mx-2"></div>
                                    <a href="<?php echo esc_url( wp_logout_url( $login_url ) ); ?>" class="flex items-center gap-3 px-4 py-2.5 rounded-xl text-sm font-bold text-rose-600 hover:bg-rose-50 hover:text-rose-700 transition-colors group/item">
                                        <span class="text-rose-400 group-hover/item:text-rose-600 transition-colors"><?php echo kermancopper_icon('x', 'w-4 h-4'); ?></span>
                                        <span>خروج از حساب</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    <?php else : ?>
                        <a href="<?php echo esc_url( $login_url ); ?>" class="hover:text-copper transition-colors focus:outline-none flex items-center justify-center" title="ورود متقاضیان">
                            <?php echo kermancopper_icon('user', 'w-5 h-5'); ?>
                        </a>
                    <?php endif; ?>

                    <button id="search-open-btn" class="hover:text-copper transition-colors focus:outline-none"><?php echo kermancopper_icon('search', 'w-5 h-5'); ?></button>
                    <button id="mobile-menu-btn" class="hover:text-copper transition-colors focus:outline-none"><?php echo kermancopper_icon('menu', 'w-5 h-5'); ?></button>
                </div>
            </div>
        </div>

    </nav>

    <!-- Mobile Sidebar Overlay -->
    <div id="mobile-menu-overlay" class="fixed inset-0 bg-black/60 backdrop-blur-sm z-[60] hidden opacity-0 transition-opacity duration-300"></div>
    <div id="mobile-menu-sidebar" class="fixed inset-y-0 right-0 w-full sm:w-[460px] shadow-2xl z-[70] flex flex-col p-6 sm:p-10 rounded-l-[2.5rem] border-l border-copper/15 translate-x-full opacity-0 invisible transition-all duration-300 overflow-hidden">
        <!-- Glowing luxury circle in background -->
        <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[350px] h-[350px] bg-copper/10 rounded-full blur-[110px] pointer-events-none z-0"></div>

        <!-- Top Header with Minimal Close Button -->
        <div class="relative z-10 flex justify-between items-center mb-8">
            <button id="close-mobile-menu" class="w-12 h-12 rounded-full border border-white/10 hover:border-copper/40 flex items-center justify-center text-white/60 hover:text-copper transition-all duration-300 bg-white/5 backdrop-blur-md hover:rotate-90">
                <?php echo kermancopper_icon('x', 'w-5 h-5'); ?>
            </button>
        </div>
        
        <!-- Center-Aligned Minimalist Menu List -->
        <div class="relative z-10 flex-1 flex flex-col justify-center items-center py-6">
            <div class="w-full space-y-1.5 overflow-y-auto max-h-full pr-1">
                <?php
                $mobile_menu_html = '';
                if ( has_nav_menu( 'mobile' ) ) {
                    $mobile_menu_html = wp_nav_menu( array(
                        'theme_location' => 'mobile',
                        'container'      => false,
                        'menu_class'     => 'space-y-1.5 list-none',
                        'fallback_cb'    => false,
                        'items_wrap'     => '<ul class="%2$s">%3$s</ul>',
                        'walker'         => new KermanCopper_Mobile_Nav_Walker(),
                        'echo'           => false,
                    ) );
                }
                
                if ( empty( $mobile_menu_html ) && has_nav_menu( 'primary' ) ) {
                    $mobile_menu_html = wp_nav_menu( array(
                        'theme_location' => 'primary',
                        'container'      => false,
                        'menu_class'     => 'space-y-1.5 list-none',
                        'fallback_cb'    => false,
                        'items_wrap'     => '<ul class="%2$s">%3$s</ul>',
                        'walker'         => new KermanCopper_Mobile_Nav_Walker(),
                        'echo'           => false,
                    ) );
                }

                if ( ! empty( $mobile_menu_html ) ) {
                    echo $mobile_menu_html;
                } else {
                    ?>
                    <div class="mobile-menu-item w-full flex items-center justify-center py-3"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="block py-3 text-xl sm:text-2xl font-bold text-white/95 hover:text-copper text-center w-full transition-all duration-300">صفحه اصلی</a></div>
                    <div class="mobile-menu-item w-full flex items-center justify-center py-3"><a href="<?php echo esc_url( home_url( '/kermancopper_ad' ) ); ?>" class="block py-3 text-xl sm:text-2xl font-bold text-white/95 hover:text-copper text-center w-full transition-all duration-300">آگهی‌ها</a></div>
                    <div class="mobile-menu-item w-full flex items-center justify-center py-3"><a href="<?php echo esc_url( home_url( '/news' ) ); ?>" class="block py-3 text-xl sm:text-2xl font-bold text-white/95 hover:text-copper text-center w-full transition-all duration-300">اخبار و رویدادها</a></div>
                    <div class="mobile-menu-item w-full flex items-center justify-center py-3"><a href="<?php echo esc_url( home_url( '/about' ) ); ?>" class="block py-3 text-xl sm:text-2xl font-bold text-white/95 hover:text-copper text-center w-full transition-all duration-300">درباره ما</a></div>
                    <div class="mobile-menu-item w-full flex items-center justify-center py-3"><a href="<?php echo esc_url( home_url( '/contact' ) ); ?>" class="block py-3 text-xl sm:text-2xl font-bold text-white/95 hover:text-copper text-center w-full transition-all duration-300">تماس با ما</a></div>
                    <?php
                }
                ?>
            </div>
        </div>
    </div>

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

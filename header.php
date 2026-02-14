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
        font-family: 'IRANYekanX';
        src: url('<?php echo get_template_directory_uri(); ?>/fonts/IRANYekanX/woff2/IRANYekanX-Regular.woff2') format('woff2');
        font-weight: 400;
        font-style: normal;
      }
      @font-face {
        font-family: 'IRANYekanX';
        src: url('<?php echo get_template_directory_uri(); ?>/fonts/IRANYekanX/woff2/IRANYekanX-Bold.woff2') format('woff2');
        font-weight: 700;
        font-style: normal;
      }
      @font-face {
        font-family: 'IRANYekanX';
        src: url('<?php echo get_template_directory_uri(); ?>/fonts/IRANYekanX/woff2/IRANYekanX-Light.woff2') format('woff2');
        font-weight: 300;
        font-style: normal;
      }
      @font-face {
        font-family: 'IRANYekanX';
        src: url('<?php echo get_template_directory_uri(); ?>/fonts/IRANYekanX/woff2/IRANYekanX-Medium.woff2') format('woff2');
        font-weight: 500;
        font-style: normal;
      }
      @font-face {
        font-family: 'IRANYekanX';
        src: url('<?php echo get_template_directory_uri(); ?>/fonts/IRANYekanX/woff2/IRANYekanX-Black.woff2') format('woff2');
        font-weight: 900;
        font-style: normal;
      }

      html {
        scroll-behavior: smooth;
      }

      body {
        font-family: 'IRANYekanX', sans-serif;
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

    <!-- Header -->
    <header id="main-header" class="fixed top-0 left-0 right-0 z-50 transition-all duration-300">
        <?php if ( get_theme_mod( 'kermancopper_show_topbar', true ) ) : ?>
        <!-- Top Bar -->
        <div id="top-bar" class="bg-white border-b border-slate-100 transition-all duration-300 overflow-hidden">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-2 md:py-0 min-h-[40px] flex flex-col md:flex-row md:justify-between md:items-center gap-2 text-[11px] font-medium text-slate-500">
                <div class="flex flex-col sm:flex-row sm:items-center gap-2 sm:gap-6">
                    <div class="flex items-center gap-2">
                        <i data-lucide="map-pin" class="w-[10px] h-[10px] text-copper"></i>
                        <span><?php echo esc_html( get_theme_mod( 'kermancopper_address', 'تهران، سعادت آباد، خیابان مروارید ۲۶۴۹' ) ); ?></span>
                    </div>
                    <div class="flex items-center gap-2 sm:border-r border-slate-200 sm:pr-6 sm:mr-6">
                        <i data-lucide="mail" class="w-[10px] h-[10px] text-copper"></i>
                        <span><?php echo esc_html( get_theme_mod( 'kermancopper_email', 'info@copperindustry.com' ) ); ?></span>
                    </div>
                </div>
                
                <div class="flex items-center justify-between gap-4">
                    <div class="flex items-center gap-3 sm:border-l border-slate-200 sm:pl-4 sm:ml-2">
                        <?php if ( $instagram = get_theme_mod( 'kermancopper_social_instagram' ) ) : ?>
                            <a href="<?php echo esc_url( $instagram ); ?>" target="_blank"><i data-lucide="instagram" class="w-[14px] h-[14px] cursor-pointer text-slate-400/80 hover:text-copper transition-colors"></i></a>
                        <?php endif; ?>
                        <?php if ( $linkedin = get_theme_mod( 'kermancopper_social_linkedin' ) ) : ?>
                            <a href="<?php echo esc_url( $linkedin ); ?>" target="_blank"><i data-lucide="linkedin" class="w-[14px] h-[14px] cursor-pointer text-slate-400/80 hover:text-copper transition-colors"></i></a>
                        <?php endif; ?>
                        <?php if ( $twitter = get_theme_mod( 'kermancopper_social_twitter' ) ) : ?>
                            <a href="<?php echo esc_url( $twitter ); ?>" target="_blank"><i data-lucide="twitter" class="w-[14px] h-[14px] cursor-pointer text-slate-400/80 hover:text-copper transition-colors"></i></a>
                        <?php endif; ?>
                        <?php if ( $facebook = get_theme_mod( 'kermancopper_social_facebook' ) ) : ?>
                            <a href="<?php echo esc_url( $facebook ); ?>" target="_blank"><i data-lucide="facebook" class="w-[14px] h-[14px] cursor-pointer text-slate-400/80 hover:text-copper transition-colors"></i></a>
                        <?php endif; ?>
                    </div>
                    <div class="flex items-center gap-3">
                        <span class="text-copper font-bold cursor-default">Fa</span>
                        <span class="text-slate-300">|</span>
                        <span class="cursor-pointer hover:text-copper transition-colors">Ar</span>
                        <span class="text-slate-300">|</span>
                        <span class="cursor-pointer hover:text-copper transition-colors">En</span>
                    </div>
                </div>
            </div>
        </div>
        <?php endif; ?>

        <!-- Main Navigation -->
        <nav id="main-nav" class="w-full transition-all duration-300 bg-white py-3">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between items-center h-16 sm:h-20">
                    
                    <!-- Logo Section -->
                    <div class="flex-shrink-0 flex items-center gap-3">
                        <?php if ( has_custom_logo() ) : ?>
                            <?php
                            $custom_logo_id = get_theme_mod( 'custom_logo' );
                            $logo = wp_get_attachment_image_src( $custom_logo_id , 'full' );
                            if ( has_custom_logo() ) {
                                echo '<a href="' . esc_url( home_url( '/' ) ) . '"><img src="' . esc_url( $logo[0] ) . '" class="h-[68px] w-auto object-contain" alt="' . get_bloginfo( 'name' ) . '"></a>';
                            }
                            ?>
                        <?php else : ?>
                            <a href="<?php echo esc_url( home_url( '/' ) ); ?>">
                                <img src="<?php echo get_template_directory_uri(); ?>/images/sbsm-logo-3.png" alt="Copper Industry Logo" class="h-[68px] w-auto object-contain">
                            </a>
                        <?php endif; ?>
                    </div>

                    <!-- Desktop Menu -->
                    <div class="hidden lg:flex items-center gap-8 xl:gap-12 text-[14px] font-normal text-slate-600">
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
                            <div class="relative group py-4">
                                <a href="#" class="nav-link flex items-center gap-1 transition-colors duration-200 text-copper" data-target="home">
                                    صفحه اصلی
                                </a>
                                <div class="nav-underline absolute bottom-1 left-1/2 -translate-x-1/2 h-[2.5px] bg-copper w-1/2 rounded-full transition-all duration-300 opacity-100"></div>
                            </div>
                            <span class="text-slate-200">|</span>
                            <div class="relative group py-4">
                                <a href="#ads" class="nav-link flex items-center gap-1 transition-colors duration-200 hover:text-copper" data-target="ads">
                                    آگهی ها
                                    <i data-lucide="chevron-down" class="w-2.5 h-2.5 opacity-50"></i>
                                </a>
                                <div class="nav-underline absolute bottom-1 left-1/2 -translate-x-1/2 h-[2.5px] bg-copper w-1/2 rounded-full transition-all duration-300 opacity-0 group-hover:opacity-100"></div>
                                <!-- Dropdown -->
                                <div id="ads-dropdown" class="absolute right-0 top-full mt-0 w-56 bg-[#c86429] text-white shadow-xl z-[100] rounded-sm">
                                    <div class="py-1">
                                        <a href="#" class="block px-6 py-3 hover:bg-black/10 transition-colors font-light text-[13px] border-b border-white/5 last:border-0">مناقصات عمومی</a>
                                        <a href="#" class="block px-6 py-3 hover:bg-black/10 transition-colors font-light text-[13px] border-b border-white/5 last:border-0">مزایده ها</a>
                                    </div>
                                </div>
                            </div>
                            <span class="text-slate-200">|</span>
                            <div class="relative group py-4">
                                <a href="#news" class="nav-link flex items-center gap-1 transition-colors duration-200 hover:text-copper" data-target="news">
                                    اخبار و رویداد ها
                                </a>
                                <div class="nav-underline absolute bottom-1 left-1/2 -translate-x-1/2 h-[2.5px] bg-copper w-1/2 rounded-full transition-all duration-300 opacity-0 group-hover:opacity-100"></div>
                            </div>
                            <span class="text-slate-200">|</span>
                            <div class="relative group py-4">
                                <a href="#about" class="nav-link flex items-center gap-1 transition-colors duration-200 hover:text-copper" data-target="about">
                                    درباره ما
                                </a>
                                <div class="nav-underline absolute bottom-1 left-1/2 -translate-x-1/2 h-[2.5px] bg-copper w-1/2 rounded-full transition-all duration-300 opacity-0 group-hover:opacity-100"></div>
                            </div>
                            <span class="text-slate-200">|</span>
                            <div class="relative group py-4">
                                <a href="#contact" class="nav-link flex items-center gap-1 transition-colors duration-200 hover:text-copper" data-target="contact">
                                    تماس با ما
                                </a>
                                <div class="nav-underline absolute bottom-1 left-1/2 -translate-x-1/2 h-[2.5px] bg-copper w-1/2 rounded-full transition-all duration-300 opacity-0 group-hover:opacity-100"></div>
                            </div>
                            <?php
                        }
                        ?>
                    </div>

                    <!-- Utility Icons & Menu Trigger -->
                    <div class="flex items-center gap-2">
                        <div class="w-10 h-10 flex items-center justify-center rounded-sm hover:bg-slate-50 cursor-pointer text-slate-900 hover:text-copper transition-all">
                            <i data-lucide="search" class="w-[20px] h-[20px]"></i>
                        </div>
                        <button id="mobile-menu-btn" class="w-10 h-10 flex items-center justify-center rounded-sm text-slate-900 hover:bg-slate-50 transition-colors" aria-label="Menu">
                            <i data-lucide="menu" class="w-[26px] h-[26px]"></i>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Mobile Sidebar Overlay -->
            <div id="mobile-menu-overlay" class="fixed inset-0 bg-black/50 backdrop-blur-sm z-[60] hidden opacity-0"></div>
            <div id="mobile-menu-sidebar" class="fixed inset-y-0 right-0 w-full sm:w-80 bg-white shadow-2xl z-[70] flex flex-col p-8 rounded-sm translate-x-full opacity-0">
                <div class="flex justify-between items-center mb-10">
                     <?php if ( has_custom_logo() ) : ?>
                        <?php
                        $custom_logo_id = get_theme_mod( 'custom_logo' );
                        $logo = wp_get_attachment_image_src( $custom_logo_id , 'full' );
                        if ( has_custom_logo() ) {
                            echo '<a href="' . esc_url( home_url( '/' ) ) . '"><img src="' . esc_url( $logo[0] ) . '" class="h-10 w-auto object-contain" alt="' . get_bloginfo( 'name' ) . '"></a>';
                        }
                        ?>
                    <?php else : ?>
                        <img src="<?php echo get_template_directory_uri(); ?>/images/sbsm-logo-3.png" alt="Logo" class="h-10 w-auto object-contain">
                    <?php endif; ?>
                    <button id="close-mobile-menu" class="p-2 hover:bg-slate-50 rounded-sm">
                        <i data-lucide="x" class="w-[24px] h-[24px]"></i>
                    </button>
                </div>
                
                <div class="space-y-2">
                    <?php
                    if ( has_nav_menu( 'primary' ) ) {
                        wp_nav_menu( array(
                            'theme_location' => 'primary',
                            'container'      => false,
                            'menu_class'     => 'space-y-2 list-none',
                            'fallback_cb'    => false,
                            'items_wrap'     => '<ul class="%2$s">%3$s</ul>',
                            'walker'         => new KermanCopper_Mobile_Nav_Walker(),
                        ) );
                    } else {
                        ?>
                        <div class="mobile-menu-item border-b border-slate-100 pb-2"><a href="#" class="block py-3 text-base font-bold text-slate-800 hover:text-copper transition-colors">صفحه اصلی</a></div>
                        <div class="mobile-menu-item border-b border-slate-100 pb-2"><a href="#ads" class="block py-3 text-base font-bold text-slate-800 hover:text-copper transition-colors">آگهی ها</a></div>
                        <div class="mobile-menu-item border-b border-slate-100 pb-2"><a href="#news" class="block py-3 text-base font-bold text-slate-800 hover:text-copper transition-colors">اخبار و رویداد ها</a></div>
                        <div class="mobile-menu-item border-b border-slate-100 pb-2"><a href="#about" class="block py-3 text-base font-bold text-slate-800 hover:text-copper transition-colors">درباره ما</a></div>
                        <div class="mobile-menu-item border-b border-slate-100 pb-2"><a href="#contact" class="block py-3 text-base font-bold text-slate-800 hover:text-copper transition-colors">تماس با ما</a></div>
                        <?php
                    }
                    ?>
                </div>

                <div class="mt-auto pt-10">
                    <div class="flex justify-center gap-6 text-slate-400">
                        <i data-lucide="instagram" class="w-[22px] h-[22px] hover:text-copper cursor-pointer"></i>
                        <i data-lucide="linkedin" class="w-[22px] h-[22px] hover:text-copper cursor-pointer"></i>
                        <i data-lucide="twitter" class="w-[22px] h-[22px] hover:text-copper cursor-pointer"></i>
                        <i data-lucide="facebook" class="w-[22px] h-[22px] hover:text-copper cursor-pointer"></i>
                    </div>
                </div>
            </div>
        </nav>
    </header>

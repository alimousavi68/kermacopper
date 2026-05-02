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
            font-family: 'PeydaFa';
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
        font-family: 'PeydaFa', sans-serif;
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
$topbar_link_hover = $is_home ? 'hover:text-white' : 'hover:text-white';
$topbar_address = trim( (string) get_theme_mod( 'kermancopper_address', '' ) );
$topbar_email = trim( (string) get_theme_mod( 'kermancopper_email', '' ) );
$topbar_phone = trim( (string) get_theme_mod( 'kermancopper_phone', '' ) );
?>

    <!-- Header -->
    <header id="main-header" class="<?php echo esc_attr( $header_position_class ); ?> top-0 left-0 right-0 z-50 transition-all duration-300">
        <?php if ( get_theme_mod( 'kermancopper_show_topbar', true ) ) : ?>
        <!-- Top Bar -->
        <div id="top-bar" class="<?php echo esc_attr( $top_bar_classes ); ?> border-b transition-all duration-300 overflow-hidden hidden md:block">
            <div class="container mx-auto  py-2 md:py-0 min-h-[40px] flex flex-col md:flex-row md:justify-between md:items-center gap-2 text-[11px] font-medium">
                <div class="flex flex-col sm:flex-row sm:items-center gap-2 sm:gap-6">
                    <?php if ( $topbar_address ) : ?>
                        <div class="flex items-center gap-2">
                            <i data-lucide="map-pin" class="w-[10px] h-[10px] <?php echo esc_attr( $icon_color_classes ); ?>"></i>
                            <span><?php echo esc_html( $topbar_address ); ?></span>
                        </div>
                    <?php endif; ?>
                    <?php if ( $topbar_email ) : ?>
                        <div class="flex items-center gap-2 sm:border-r <?php echo esc_attr( $border_social_classes ); ?> sm:pr-6 sm:mr-6">
                            <i data-lucide="mail" class="w-[10px] h-[10px] <?php echo esc_attr( $icon_color_classes ); ?>"></i>
                            <a href="mailto:<?php echo esc_attr( $topbar_email ); ?>" class="transition-colors <?php echo esc_attr( $topbar_link_hover ); ?>"><?php echo esc_html( $topbar_email ); ?></a>
                        </div>
                    <?php endif; ?>
                    <?php if ( $topbar_phone ) : ?>
                        <div class="flex items-center gap-2 sm:border-r <?php echo esc_attr( $border_social_classes ); ?> sm:pr-6 sm:mr-6">
                            <i data-lucide="phone" class="w-[10px] h-[10px] <?php echo esc_attr( $icon_color_classes ); ?>"></i>
                            <a href="tel:<?php echo esc_attr( preg_replace( '/\s+/', '', $topbar_phone ) ); ?>" class="transition-colors <?php echo esc_attr( $topbar_link_hover ); ?>"><?php echo esc_html( $topbar_phone ); ?></a>
                        </div>
                    <?php endif; ?>
                </div>
                
                <div class="flex items-center justify-between gap-4">
                    <div class="flex items-center gap-3 sm:border-l <?php echo esc_attr( $border_lang_classes ); ?> sm:pl-4 sm:ml-2">
                        <?php if ( $instagram = get_theme_mod( 'kermancopper_social_instagram' ) ) : ?>
                            <a href="<?php echo esc_url( $instagram ); ?>" target="_blank"><i data-lucide="instagram" class="w-[14px] h-[14px] cursor-pointer <?php echo esc_attr( $social_icon_classes ); ?> transition-colors"></i></a>
                        <?php endif; ?>
                        <?php if ( $linkedin = get_theme_mod( 'kermancopper_social_linkedin' ) ) : ?>
                            <a href="<?php echo esc_url( $linkedin ); ?>" target="_blank"><i data-lucide="linkedin" class="w-[14px] h-[14px] cursor-pointer <?php echo esc_attr( $social_icon_classes ); ?> transition-colors"></i></a>
                        <?php endif; ?>
                        <?php if ( $twitter = get_theme_mod( 'kermancopper_social_twitter' ) ) : ?>
                            <a href="<?php echo esc_url( $twitter ); ?>" target="_blank"><i data-lucide="twitter" class="w-[14px] h-[14px] cursor-pointer <?php echo esc_attr( $social_icon_classes ); ?> transition-colors"></i></a>
                        <?php endif; ?>
                        <?php if ( $facebook = get_theme_mod( 'kermancopper_social_facebook' ) ) : ?>
                            <a href="<?php echo esc_url( $facebook ); ?>" target="_blank"><i data-lucide="facebook" class="w-[14px] h-[14px] cursor-pointer <?php echo esc_attr( $social_icon_classes ); ?> transition-colors"></i></a>
                        <?php endif; ?>
                    </div>
                    <div class="flex items-center gap-3">
                        <span class="<?php echo esc_attr( $lang_active_classes ); ?> font-bold cursor-default">Fa</span>
                        <span class="<?php echo esc_attr( $separator_classes ); ?>">|</span>
                        <span class="cursor-pointer <?php echo esc_attr( $lang_hover_classes ); ?> transition-colors">En</span>
                    </div>
                </div>
            </div>
        </div>
        <?php endif; ?>

        <!-- Main Navigation -->
        <nav id="main-nav" class="w-full transition-all duration-300 <?php echo esc_attr( $nav_bg_classes ); ?> py-3">
            <div class="container mx-auto ">
                <div class="flex justify-between items-center h-16 sm:h-20">
                    
                    <!-- Logo Section -->
                    <div class="flex-shrink-0 flex items-center gap-3">
                        <?php if ( has_custom_logo() ) : ?>
                            <?php
                            $custom_logo_id = get_theme_mod( 'custom_logo' );
                            $logo = wp_get_attachment_image_src( $custom_logo_id , 'full' );
                            if ( has_custom_logo() ) {
                                echo '<a href="' . esc_url( home_url( '/' ) ) . '"><img src="' . esc_url( $logo[0] ) . '" class="h-[80px] w-auto object-contain" alt="' . get_bloginfo( 'name' ) . '"></a>';
                            }
                            ?>
                        <?php endif; ?>
                    </div>

                    <!-- Desktop Menu -->
                    <div class="hidden lg:flex items-center gap-8 xl:gap-12 text-[14px] font-normal <?php echo esc_attr( $nav_text_classes ); ?>">
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
                                <a href="#" class="nav-link flex items-center gap-1 transition-colors duration-200 <?php echo esc_attr( $is_home ? 'text-white' : 'text-copper' ); ?>" data-target="home">
                                    صفحه اصلی
                                </a>
                                <div class="nav-underline absolute bottom-1 left-1/2 -translate-x-1/2 h-[2.5px] <?php echo esc_attr( $underline_classes ); ?> w-1/2 rounded-full transition-all duration-300 opacity-100"></div>
                            </div>
                            <span class="<?php echo esc_attr( $separator_classes ); ?>">|</span>
                            <div class="relative group py-4">
                                <a href="#ads" class="nav-link flex items-center gap-1 transition-colors duration-200 <?php echo esc_attr( $is_home ? 'hover:text-white' : 'hover:text-copper' ); ?>" data-target="ads">
                                    آگهی ها
                                    <i data-lucide="chevron-down" class="w-2.5 h-2.5 opacity-50"></i>
                                </a>
                                <div class="nav-underline absolute bottom-1 left-1/2 -translate-x-1/2 h-[2.5px] <?php echo esc_attr( $underline_classes ); ?> w-1/2 rounded-full transition-all duration-300 opacity-0 group-hover:opacity-100"></div>
                                <!-- Dropdown -->
                                <div id="ads-dropdown" class="absolute right-0 top-full mt-0 w-56 bg-[#c86429] text-white shadow-xl z-[100] rounded-sm">
                                    <div class="py-1">
                                        <a href="#" class="block px-6 py-3 hover:bg-black/10 transition-colors font-light text-[13px] border-b border-white/5 last:border-0">مناقصات عمومی</a>
                                        <a href="#" class="block px-6 py-3 hover:bg-black/10 transition-colors font-light text-[13px] border-b border-white/5 last:border-0">مزایده ها</a>
                                    </div>
                                </div>
                            </div>
                            <span class="<?php echo esc_attr( $separator_classes ); ?>">|</span>
                            <div class="relative group py-4">
                                <a href="#news" class="nav-link flex items-center gap-1 transition-colors duration-200 <?php echo esc_attr( $is_home ? 'hover:text-white' : 'hover:text-copper' ); ?>" data-target="news">
                                    اخبار و رویداد ها
                                </a>
                                <div class="nav-underline absolute bottom-1 left-1/2 -translate-x-1/2 h-[2.5px] <?php echo esc_attr( $underline_classes ); ?> w-1/2 rounded-full transition-all duration-300 opacity-0 group-hover:opacity-100"></div>
                            </div>
                            <span class="<?php echo esc_attr( $separator_classes ); ?>">|</span>
                            <div class="relative group py-4">
                                <a href="#about" class="nav-link flex items-center gap-1 transition-colors duration-200 <?php echo esc_attr( $is_home ? 'hover:text-white' : 'hover:text-copper' ); ?>" data-target="about">
                                    درباره ما
                                </a>
                                <div class="nav-underline absolute bottom-1 left-1/2 -translate-x-1/2 h-[2.5px] <?php echo esc_attr( $underline_classes ); ?> w-1/2 rounded-full transition-all duration-300 opacity-0 group-hover:opacity-100"></div>
                            </div>
                            <span class="<?php echo esc_attr( $separator_classes ); ?>">|</span>
                            <div class="relative group py-4">
                                <a href="#contact" class="nav-link flex items-center gap-1 transition-colors duration-200 <?php echo esc_attr( $is_home ? 'hover:text-white' : 'hover:text-copper' ); ?>" data-target="contact">
                                    تماس با ما
                                </a>
                                <div class="nav-underline absolute bottom-1 left-1/2 -translate-x-1/2 h-[2.5px] <?php echo esc_attr( $underline_classes ); ?> w-1/2 rounded-full transition-all duration-300 opacity-0 group-hover:opacity-100"></div>
                            </div>
                            <?php
                        }
                        ?>
                    </div>

                    <!-- Utility Icons & Menu Trigger -->
                    <div class="flex items-center gap-2">
                        <div class="w-10 h-10 flex items-center justify-center rounded-sm cursor-pointer <?php echo esc_attr( $icon_button_classes ); ?> transition-all">
                            <i data-lucide="search" class="w-[20px] h-[20px]"></i>
                        </div>
                        <button id="mobile-menu-btn" class="w-10 h-10 flex items-center justify-center rounded-sm <?php echo esc_attr( $mobile_button_classes ); ?> transition-colors" aria-label="Menu">
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

<!DOCTYPE html>
<html lang="fa" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo isset($page_title) ? $page_title : 'صنایع و معادن مس کرمان زمین'; ?></title>
    
    <!-- Localized Tailwind CSS -->
    <script src="assets/js/tailwind.min.js?v=3.4.1"></script>
    
    <!-- Local IRANYekanX Font -->
    <link rel="stylesheet" href="../fonts/fontiran.css">
    <!-- Local Peyda Font -->
    <link rel="stylesheet" href="../fonts/peyda/fontiran.css">
    
    <!-- Localized Lucide Icons -->
    <script src="assets/js/lucide.min.js?v=0.3.0"></script>
    
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['IRANYekanX', 'sans-serif'],
                        peyda: ['PeydaWebVF', 'sans-serif'],
                    },
                    colors: {
                        copper: {
                            DEFAULT: '#C8682F', // V2 Copper
                            light: '#E28652',
                            dark: '#A65120',
                        },
                        navy: {
                            DEFAULT: '#1A2235',
                            light: '#242F48',
                            dark: '#0F1522',
                        }
                    },
                    animation: {
                        'float': 'float 6s ease-in-out infinite',
                        'pulse-slow': 'pulse 4s cubic-bezier(0.4, 0, 0.6, 1) infinite',
                    },
                    keyframes: {
                        float: {
                            '0%, 100%': { transform: 'translateY(0)' },
                            '50%': { transform: 'translateY(-20px)' },
                        }
                    }
                }
            }
        }
    </script>
    
    <!-- Main Extracted Stylesheet -->
    <link rel="stylesheet" href="assets/css/style.css?v=<?php echo time(); ?>">
</head>

<body class="text-slate-800 antialiased overflow-x-hidden bg-[#FAFAFA]">

    <!-- Top Bar -->
    <div class="absolute top-0 w-full z-50 border-b border-white/5 bg-transparent py-2.5 text-xs text-white hidden lg:block">
        <div class="container mx-auto px-6 lg:px-12 flex justify-between items-center">
            <!-- Left Side: Lang and Socials -->
            <div class="flex items-center gap-6">
                <div class="flex items-center gap-2 border-l border-white/10 pl-6">
                    <span class="hover:text-copper cursor-pointer font-bold">En</span>
                    <span class="text-white/20">|</span>
                    <span class="text-copper font-bold">Fa</span>
                </div>
                <div class="flex items-center gap-4">
                    <a href="#" class="hover:text-copper transition-colors"><i data-lucide="instagram" class="w-4 h-4"></i></a>
                    <a href="#" class="hover:text-copper transition-colors"><i data-lucide="linkedin" class="w-4 h-4"></i></a>
                </div>
            </div>
            <!-- Right Side: Contact info -->
            <div class="flex items-center gap-6" dir="ltr">
                <a href="tel:02188715002" class="flex items-center gap-2 hover:text-copper transition-colors">
                    <span>۰۲۱ - ۸۸۷۱ ۵۰۰۲ - ۳</span>
                    <i data-lucide="phone" class="w-4 h-4 text-copper"></i>
                </a>
                <span class="text-white/20">|</span>
                <a href="mailto:info@kermancopper.com" class="flex items-center gap-2 hover:text-copper transition-colors">
                    <span>info@kermancopper.com</span>
                    <i data-lucide="mail" class="w-4 h-4 text-copper"></i>
                </a>
            </div>
        </div>
    </div>

    <!-- Navbar (Transparent) -->
    <nav class="absolute top-0 lg:top-10 w-full z-50 py-6 animate-fade-in-down">
        <div class="container mx-auto px-6 lg:px-12 flex justify-between items-center">
            <!-- Right: Logo -->
            <div class="flex-shrink-0">
                <a href="front-page.php" class="block transition-transform hover:scale-105">
                    <img src="http://localhost:8888/kermancopper/wp-content/uploads/2026/02/sbsm-logo-3-mw.webp" alt="صنایع و معادن مس کرمان زمین" class="h-12 md:h-14 lg:h-16 xl:h-20 w-auto object-contain">
                </a>
            </div>

            <!-- Center: Menu links -->
            <div class="hidden lg:flex items-center gap-4 xl:gap-8 text-white/90 text-xs lg:text-sm font-medium bg-white/5 backdrop-blur-md px-6 xl:px-12 py-3 rounded-full border border-white/10 shadow-sm mx-4">
                <a href="front-page.php" class="nav-link <?php echo (isset($active_page) && $active_page == 'home') ? 'active' : ''; ?>">خانه</a>
                <span class="h-4 w-px bg-white/15"></span>
                <a href="front-page.php#news" class="nav-link <?php echo (isset($active_page) && $active_page == 'news') ? 'active' : ''; ?>">اخبار و رویدادها</a>
                <span class="h-4 w-px bg-white/15"></span>
                <a href="about.php" class="nav-link <?php echo (isset($active_page) && $active_page == 'about') ? 'active' : ''; ?>">درباره ما</a>
                <span class="h-4 w-px bg-white/15"></span>
                <a href="contact.php" class="nav-link <?php echo (isset($active_page) && $active_page == 'contact') ? 'active' : ''; ?>">تماس با ما</a>
                <span class="h-4 w-px bg-white/15"></span>
                <a href="front-page.php#ads" class="nav-link <?php echo (isset($active_page) && $active_page == 'ads') ? 'active' : ''; ?>">مزایده</a>
            </div>

            <!-- Left: Search/Menu icons -->
            <div class="flex-shrink-0">
                <div class="flex items-center gap-4 text-white/80">
                    <button class="hover:text-copper transition-colors focus:outline-none"><i data-lucide="search" class="w-5 h-5"></i></button>
                    <button class="hover:text-copper transition-colors focus:outline-none"><i data-lucide="menu" class="w-5 h-5"></i></button>
                </div>
            </div>
        </div>
    </nav>

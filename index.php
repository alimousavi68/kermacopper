<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>شرکت صنایع مس | پیشرو در صنعت و معدن</title>
    <script src="<?php echo get_template_directory_uri(); ?>/libs/tailwindcss.js"></script>
    <script src="<?php echo get_template_directory_uri(); ?>/libs/lucide.js"></script>
    <!-- <link href="https://fonts.googleapis.com/css2?family=Vazirmatn:wght@100;300;400;500;700;900&display=swap" rel="stylesheet"> -->
    <style>
      :root {
        --color-copper: #c86429;
        --color-industrial-green: #0B6E60;
        --color-bg-body: #F5F7FA;
        --color-text-main: #0F1724;
        --color-soft-gold: #c4a962;
      }

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

</head>
<body>

    <!-- Header -->
    <header id="main-header" class="fixed top-0 left-0 right-0 z-50 transition-all duration-300">
        <!-- Top Bar -->
        <div id="top-bar" class="bg-white border-b border-slate-100 hidden md:block transition-all duration-300 overflow-hidden h-10">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-10 flex justify-between items-center text-[11px] font-medium text-slate-500">
                <div class="flex items-center gap-6">
                    <div class="flex items-center gap-2">
                        <i data-lucide="map-pin" class="w-[10px] h-[10px] text-copper"></i>
                        <span>تهران، سعادت آباد، خیابان مروارید ۲۶۴۹</span>
                    </div>
                    <div class="flex items-center gap-2 border-r border-slate-200 pr-6 mr-6">
                        <i data-lucide="mail" class="w-[10px] h-[10px] text-copper"></i>
                        <span>info@copperindustry.com</span>
                    </div>
                </div>
                
                <div class="flex items-center gap-4">
                    <div class="flex items-center gap-3 border-l border-slate-200 pl-4 ml-2">
                        <i data-lucide="instagram" class="w-[14px] h-[14px] cursor-pointer text-slate-400/80 hover:text-copper transition-colors"></i>
                        <i data-lucide="linkedin" class="w-[14px] h-[14px] cursor-pointer text-slate-400/80 hover:text-copper transition-colors"></i>
                        <i data-lucide="twitter" class="w-[14px] h-[14px] cursor-pointer text-slate-400/80 hover:text-copper transition-colors"></i>
                        <i data-lucide="facebook" class="w-[14px] h-[14px] cursor-pointer text-slate-400/80 hover:text-copper transition-colors"></i>
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

        <!-- Main Navigation -->
        <nav id="main-nav" class="w-full transition-all duration-300 bg-white py-3">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between items-center h-16 sm:h-20">
                    
                    <!-- Logo Section -->
                    <div class="flex-shrink-0 flex items-center gap-3">
                         <img src="<?php echo get_template_directory_uri(); ?>/images/sbsm-logo-3.png" alt="Copper Industry Logo" class="h-[68px] w-auto object-contain">
                    </div>

                    <!-- Desktop Menu -->
                    <div class="hidden lg:flex items-center gap-8 xl:gap-12 text-[14px] font-normal text-slate-600">
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
                     <img src="<?php echo get_template_directory_uri(); ?>/images/sbsm-logo-3.png" alt="Logo" class="h-10 w-auto object-contain">
                    <button id="close-mobile-menu" class="p-2 hover:bg-slate-50 rounded-sm">
                        <i data-lucide="x" class="w-[24px] h-[24px]"></i>
                    </button>
                </div>
                
                <div class="space-y-1">
                    <div><a href="#" class="block py-3 text-lg font-bold border-b border-slate-50 transition-colors text-slate-800 hover:text-copper">صفحه اصلی</a></div>
                    <div><a href="#ads" class="block py-3 text-lg font-bold border-b border-slate-50 transition-colors text-slate-800 hover:text-copper">آگهی ها</a></div>
                    <div><a href="#news" class="block py-3 text-lg font-bold border-b border-slate-50 transition-colors text-slate-800 hover:text-copper">اخبار و رویداد ها</a></div>
                    <div><a href="#about" class="block py-3 text-lg font-bold border-b border-slate-50 transition-colors text-slate-800 hover:text-copper">درباره ما</a></div>
                    <div><a href="#contact" class="block py-3 text-lg font-bold border-b border-slate-50 transition-colors text-slate-800 hover:text-copper">تماس با ما</a></div>
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

    <main>
        <!-- Hero Section -->
        <div class="relative h-[calc(100vh-200px)] sm:h-[80vh] flex items-center overflow-hidden mt-[100px] sm:mt-[125px]">
            <div class="absolute inset-0 z-0" id="hero-slider">
                <!-- Slide 1 -->
                <div class="hero-slide absolute inset-0 transition-opacity duration-1000 opacity-100" data-index="0">
                    <img src="<?php echo get_template_directory_uri(); ?>/images/pano sarcheshmeh.jpg" class="w-full h-full object-cover" alt="Sarcheshmeh Mine" />
                    <div class="absolute inset-0 hero-gradient"></div>
                </div>
                <!-- Slide 2 -->
                <div class="hero-slide absolute inset-0 transition-opacity duration-1000 opacity-0" data-index="1">
                    <img src="<?php echo get_template_directory_uri(); ?>/images/14164.jpg" class="w-full h-full object-cover" alt="Industry" />
                    <div class="absolute inset-0 hero-gradient"></div>
                </div>
            </div>

            <!-- Hero Pattern -->
            <div class="absolute left-0 top-0 bottom-0 w-1/3 opacity-60 pointer-events-none z-10 pattern-bg" style="background-image: url('<?php echo get_template_directory_uri(); ?>/images/patt-right.webp'); background-repeat: no-repeat; background-position: right center; background-size: contain; transform: scaleX(-1); filter: invert(1);"></div>

            <div class="container mx-auto px-4 z-10 text-white">
                <div class="max-w-3xl fade-in-section">
                    <h1 class="text-4xl md:text-6xl font-black mb-6 leading-tight">نوآوری در قلب صنعت مس <br /> <span class="text-2xl md:text-5xl font-light opacity-90 block mt-6">Innovation at the Heart of Industry</span></h1>
                    <p class="text-base md:text-lg mb-10 text-slate-200 leading-relaxed font-light max-w-2xl opacity-80">
                        ما با تکیه بر دانش بومی و تکنولوژی‌های روز، استانداردهای جدیدی در بهره‌وری و حفظ محیط زیست خلق می‌کنیم. به ما بپیوندید تا آینده‌ای پایدار بسازیم.
                    </p>
                    <div class="flex flex-wrap gap-4">
                        <a href="#ads" class="bg-copper hover:opacity-90 text-white px-10 py-4 rounded-sm font-bold transition-all shadow-xl text-sm md:text-base tracking-wide border border-transparent">
                            فرصت‌های همکاری
                        </a>
                        <a href="#about" class="bg-white/10 hover:bg-white/20 backdrop-blur-md border border-white/30 text-white px-10 py-4 rounded-sm font-bold transition-all text-sm md:text-base tracking-wide">
                            درباره ما
                        </a>
                    </div>
                </div>
            </div>
            
            <div class="absolute bottom-10 left-1/2 -translate-x-1/2 flex gap-3 z-10">
                <button class="hero-dot w-6 h-2.5 rounded-full transition-all duration-300 bg-copper" data-index="0"></button>
                <button class="hero-dot w-2.5 h-2.5 rounded-full transition-all duration-300 bg-white/40" data-index="1"></button>
            </div>
        </div>

        <!-- About Us -->
        <section id="about" class="py-24 bg-white overflow-hidden relative">
             <div class="absolute right-0 top-0 bottom-0 w-1/3 opacity-30 pointer-events-none z-0 hidden md:block pattern-bg" style="background-image: url('<?php echo get_template_directory_uri(); ?>/images/patt-right.webp'); background-repeat: no-repeat; background-position: right center; background-size: contain;"></div>
            <div class="container mx-auto px-4 relative z-10">
                <div class="flex flex-col md:flex-row items-center gap-16">
                    <!-- Text Content -->
                    <div class="w-full md:w-1/2 fade-in-section">
                        <div class="relative">
                            <div class="absolute -top-10 -right-10 w-40 h-40 bg-soft-gold/20 rounded-full blur-3xl"></div>
                            <span class="text-copper font-bold tracking-widest mb-4 block text-sm flex items-center gap-2">
                                <span class="w-8 h-[2px] bg-copper"></span> درباره ما
                            </span>
                            <h2 class="text-4xl font-black mb-8 leading-snug"><span class="text-copper">مس کرمان زمین</span>؛ پیشگام در صنعت استخراج</h2>
                            <p class="text-slate-600 text-lg leading-loose mb-8 text-justify">
                                مجموعه‌ای پیشرو در ارائه خدمات جامع مهندسی و استخراج معادن در تراز جهانی است. ما با بهره‌گیری از تکنولوژی‌های هوشمند و مشارکت‌های راهبردی، به دنبال بهینه‌سازی زنجیره ارزش تولید مس هستیم.
                            </p>
                            
                            <!-- Mission & Vision -->
                            <div class="flex gap-8 border-t border-slate-100 pt-8 mt-8 mb-8">
                                <div class="border-r-2 border-copper pr-4">
                                    <h4 class="font-bold text-copper mb-2 text-sm">ماموریت</h4>
                                    <p class="text-xs text-slate-500 leading-relaxed">ارتقای سطح تکنولوژی استخراج و بومی‌سازی قطعات استراتژیک.</p>
                                </div>
                                <div class="border-r-2 border-copper pr-4">
                                    <h4 class="font-bold text-copper mb-2 text-sm">چشم‌انداز</h4>
                                    <p class="text-xs text-slate-500 leading-relaxed">دستیابی به رتبه نخست بهره‌وری در میان شرکت‌های معدنی منطقه.</p>
                                </div>
                            </div>

                            <div class="flex flex-wrap gap-4">
                                <button class="group bg-white text-copper border border-copper px-8 py-3 rounded-sm font-bold flex items-center gap-2 hover:bg-[var(--color-copper)] hover:text-white transition-all shadow-lg hover:shadow-xl">
                                    <i data-lucide="file-text" class="w-4 h-4"></i>
                                    مشاهده سوابق و گواهینامه‌ها
                                </button>
                                <button class="group flex items-center gap-2 text-sm font-bold text-slate-900 transition-all hover:text-copper border border-slate-200 px-6 py-3 rounded-sm hover:border-copper">
                                    بیشتر بدانید <i data-lucide="arrow-left" class="w-4 h-4 transition-transform group-hover:-translate-x-1"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Image Content -->
                    <div class="w-full md:w-1/2 fade-in-section relative">
                         <div class="relative rounded-sm overflow-hidden shadow-2xl group">
                           <img src="<?php echo get_template_directory_uri(); ?>/images/pano sarcheshmeh.jpg" class="w-full h-[500px] object-cover transition-transform duration-700 group-hover:scale-105" alt="Industrial Complex" />
                           <div class="absolute inset-0 bg-gradient-to-t from-black/50 to-transparent"></div>
                           
                           <!-- Experience Box -->
                           <div class="absolute bottom-0 right-0 bg-copper text-white p-8 md:p-10 shadow-2xl max-w-[200px] md:max-w-[250px]">
                               <div class="text-5xl md:text-6xl font-black mb-2 flex items-center justify-center gap-1" dir="ltr">+<span id="experience-counter">0</span></div>
                               <div class="text-sm md:text-base font-medium text-center text-white/90">سال سابقه درخشان صنعتی</div>
                           </div>
                         </div>
                         <!-- Decorative Element -->
                         <div class="absolute -bottom-6 -left-6 w-full h-full border-2 border-slate-100 rounded-sm -z-10 hidden md:block"></div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Ads Section -->
        <section id="ads" class="py-24 bg-slate-50">
            <div class="container mx-auto px-4">
                <div class="flex flex-col md:flex-row justify-between items-end mb-12 gap-6 fade-in-section">
                    <div>
                        <span class="text-copper font-bold mb-2 block text-sm">فرصت‌های همکاری</span>
                        <h2 class="text-4xl font-black">آگهی‌های مزایده و مناقصه</h2>
                    </div>
                    <div class="flex bg-white p-1 rounded-sm shadow-sm border border-slate-200" id="ads-filter-container">
                        <button data-filter="all" class="px-6 py-2 rounded-sm font-bold transition-all text-sm bg-copper text-white">همه</button>
                        <button data-filter="auction" class="px-6 py-2 rounded-sm font-bold transition-all text-sm text-slate-500 hover:bg-slate-50">مزایدات</button>
                        <button data-filter="tender" class="px-6 py-2 rounded-sm font-bold transition-all text-sm text-slate-500 hover:bg-slate-50">مناقصات</button>
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8" id="ads-grid">
                    <!-- Ad 1 -->
                    <div class="ad-item bg-white rounded-sm overflow-hidden shadow-sm border border-slate-100 card-hover transition-all fade-in-section" data-type="tender">
                        <div class="h-48 relative overflow-hidden group">
                            <img src="<?php echo get_template_directory_uri(); ?>/images/cmms-2-800x480-1.jpg" alt="خرید قطعات یدکی" class="w-full h-full object-cover" />
                            <div class="absolute top-4 right-4 bg-white/95 backdrop-blur px-2.5 py-1 rounded-sm text-[10px] font-normal shadow-sm text-slate-700 uppercase tracking-tight flex items-center gap-1">
                                <i data-lucide="file-text" class="w-2.5 h-2.5 text-copper stroke-[1.5]"></i> مناقصه
                            </div>
                        </div>
                        <div class="p-6">
                            <h3 class="font-bold text-base mb-4 h-12 line-clamp-2 text-slate-800 leading-relaxed">خرید قطعات یدکی دستگاه سنگ‌شکن</h3>
                            <div class="flex justify-between items-center text-[12px] text-slate-500 mb-6 border-t border-slate-50 pt-4">
                                <div class="flex items-center gap-1 font-medium"><i data-lucide="calendar" class="w-2.5 h-2.5 text-slate-400 stroke-[1.5]"></i> مهلت : ۱۴۰۲/۱۲/۱۵</div>
                                <div class="px-2 py-0.5 rounded-sm font-medium text-[11px] bg-green-50 text-green-700 border border-green-100">فعال</div>
                            </div>
                            <div class="flex gap-2">
                                <button class="flex-1 bg-white text-copper border border-copper py-2.5 rounded-sm text-sm font-bold hover:bg-[var(--color-copper)] hover:text-white transition-all shadow-sm">جزئیات آگهی</button>
                            </div>
                        </div>
                    </div>
                    <!-- Ad 2 -->
                    <div class="ad-item bg-white rounded-sm overflow-hidden shadow-sm border border-slate-100 card-hover transition-all fade-in-section" data-type="auction">
                        <div class="h-48 relative overflow-hidden group">
                            <img src="<?php echo get_template_directory_uri(); ?>/images/ورق مس.jpg" alt="فروش کاتد مس" class="w-full h-full object-cover" />
                            <div class="absolute top-4 right-4 bg-white/95 backdrop-blur px-2.5 py-1 rounded-sm text-[10px] font-normal shadow-sm text-slate-700 uppercase tracking-tight flex items-center gap-1">
                                <i data-lucide="gavel" class="w-2.5 h-2.5 text-copper stroke-[1.5]"></i> مزایده
                            </div>
                        </div>
                        <div class="p-6">
                            <h3 class="font-bold text-base mb-4 h-12 line-clamp-2 text-slate-800 leading-relaxed">فروش ۳۰ تن کاتد مس درجه دو</h3>
                            <div class="flex justify-between items-center text-[12px] text-slate-500 mb-6 border-t border-slate-50 pt-4">
                                <div class="flex items-center gap-1 font-medium"><i data-lucide="calendar" class="w-2.5 h-2.5 text-slate-400 stroke-[1.5]"></i> مهلت : ۱۴۰۲/۱۲/۲۰</div>
                                <div class="px-2 py-0.5 rounded-sm font-medium text-[11px] bg-green-50 text-green-700 border border-green-100">فعال</div>
                            </div>
                            <div class="flex gap-2">
                                <button class="flex-1 bg-white text-copper border border-copper py-2.5 rounded-sm text-sm font-bold hover:bg-[var(--[vlor-coar(-)]-color-copper)] hover:text-white transition-all shadow-sm">جزئیات آگهی</button>
                            </div>
                        </div>
                    </div>
                    <!-- Ad 3 -->
                    <div class="ad-item bg-white rounded-sm overflow-hidden shadow-sm border border-slate-100 card-hover transition-all fade-in-section" data-type="tender">
                        <div class="h-48 relative overflow-hidden group">
                            <img src="<?php echo get_template_directory_uri(); ?>/images/copper-sheet-bahonar.webp" alt="حمل و نقل" class="w-full h-full object-cover" />
                            <div class="absolute top-4 right-4 bg-white/95 backdrop-blur px-2.5 py-1 rounded-sm text-[10px] font-normal shadow-sm text-slate-700 uppercase tracking-tight flex items-center gap-1">
                                <i data-lucide="file-text" class="w-2.5 h-2.5 text-copper stroke-[1.5]"></i> مناقصه
                            </div>
                        </div>
                        <div class="p-6">
                            <h3 class="font-bold text-base mb-4 h-12 line-clamp-2 text-slate-800 leading-relaxed">مناقصه عمومی حمل و نقل مواد معدنی</h3>
                            <div class="flex justify-between items-center text-[12px] text-slate-500 mb-6 border-t border-slate-50 pt-4">
                                <div class="flex items-center gap-1 font-medium"><i data-lucide="calendar" class="w-2.5 h-2.5 text-slate-400 stroke-[1.5]"></i> مهلت : ۱۴۰۲/۱۲/۲۲</div>
                                <div class="px-2 py-0.5 rounded-sm font-medium text-[11px] bg-slate-50 text-slate-500 border border-slate-100">به زودی</div>
                            </div>
                            <div class="flex gap-2">
                                <button class="flex-1 bg-white text-copper border border-copper py-2.5 rounded-sm text-sm font-bold hover:bg-[var(--color-copper)] hover:text-white transition-all shadow-sm">جزئیات آگهی</button>
                            </div>
                        </div>
                    </div>
                    <!-- Ad 4 -->
                    <div class="ad-item bg-white rounded-sm overflow-hidden shadow-sm border border-slate-100 card-hover transition-all fade-in-section" data-type="auction">
                        <div class="h-48 relative overflow-hidden group">
                            <img src="<?php echo get_template_directory_uri(); ?>/images/image2.jpg" alt="خودرو سنگین" class="w-full h-full object-cover" />
                            <div class="absolute top-4 right-4 bg-white/95 backdrop-blur px-2.5 py-1 rounded-sm text-[10px] font-normal shadow-sm text-slate-700 uppercase tracking-tight flex items-center gap-1">
                                <i data-lucide="gavel" class="w-2.5 h-2.5 text-copper stroke-[1.5]"></i> مزایده
                            </div>
                        </div>
                        <div class="p-6">
                            <h3 class="font-bold text-base mb-4 h-12 line-clamp-2 text-slate-800 leading-relaxed">مزایده خودروهای سنگین کارکرده</h3>
                            <div class="flex justify-between items-center text-[12px] text-slate-500 mb-6 border-t border-slate-50 pt-4">
                                <div class="flex items-center gap-1 font-medium"><i data-lucide="calendar" class="w-2.5 h-2.5 text-slate-400 stroke-[1.5]"></i> مهلت : ۱۴۰۲/۱۲/۲۵</div>
                                <div class="px-2 py-0.5 rounded-sm font-medium text-[11px] bg-green-50 text-green-700 border border-green-100">فعال</div>
                            </div>
                            <div class="flex gap-2">
                                <button class="flex-1 bg-white text-copper border border-copper py-2.5 rounded-sm text-sm font-bold hover:bg-[var(--color-copper)] hover:text-white transition-all shadow-sm">جزئیات آگهی</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- News Section -->
        <section id="news" class="py-24 bg-white">
            <div class="container mx-auto px-4">
                <div class="flex flex-col md:flex-row justify-between items-end mb-12 gap-6 fade-in-section">
                    <div>
                        <span class="text-copper font-bold mb-2 block text-sm flex items-center gap-2"><span class="w-8 h-[2px] bg-copper"></span> اتاق خبر</span>
                        <h2 class="text-4xl font-black text-slate-900">تازه‌ترین اخبار و رویدادها</h2>
                    </div>
                    <a href="#" class="group flex items-center gap-2 text-sm font-bold text-slate-500 hover:text-copper transition-colors border-b border-transparent hover:border-copper pb-1">
                        مشاهده آرشیو اخبار <i data-lucide="arrow-left" class="w-4 h-4 transition-transform group-hover:-translate-x-1"></i>
                    </a>
                </div>
                
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 fade-in-section">
                    <!-- Featured News (Large) -->
                    <div class="lg:col-span-2 group cursor-pointer relative rounded-sm overflow-hidden shadow-md hover:shadow-2xl transition-all duration-500 h-[500px]">
                        <img src="https://images.unsplash.com/photo-1621905252507-b35492cc74b4?auto=format&fit=crop&q=80&w=1200" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105" />
                        <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/20 to-transparent opacity-90"></div>
                        <div class="absolute bottom-0 left-0 right-0 p-8 md:p-12">
                            <div class="flex items-center gap-4 mb-4 text-white/80 text-xs font-bold">
                                <span class="bg-copper text-white px-3 py-1 rounded-full">ویژه</span>
                                <span>۲۰ اسفند ۱۴۰۲</span>
                            </div>
                            <h3 class="font-black text-white text-2xl md:text-4xl leading-tight mb-4 group-hover:text-copper transition-colors">رکوردشکنی تاریخی در استخراج مس سرچشمه؛ دستاوردی بزرگ برای صنعت کشور</h3>
                            <p class="text-slate-200 text-sm md:text-base leading-relaxed line-clamp-2 mb-6 max-w-2xl opacity-90">
                                با همت متخصصان داخلی و بهره‌گیری از تکنولوژی‌های نوین، میزان استخراج ماهانه از مرز پیش‌بینی شده عبور کرد و برگ زرین دیگری در تاریخ صنعت مس رقم خورد.
                            </p>
                            <span class="inline-flex items-center gap-2 text-white font-bold border-b border-white/30 pb-1 group-hover:border-copper group-hover:text-copper transition-all">
                                مطالعه کامل خبر <i data-lucide="arrow-left" class="w-4 h-4"></i>
                            </span>
                        </div>
                    </div>

                    <!-- Side News List -->
                    <div class="flex flex-col gap-6">
                        <!-- Side Item 1 -->
                        <div class="flex-1 group cursor-pointer bg-slate-50 rounded-sm p-4 flex gap-4 transition-all hover:bg-white hover:shadow-xl border border-slate-100">
                            <div class="w-32 h-32 rounded-sm overflow-hidden flex-shrink-0 relative">
                                <img src="https://images.unsplash.com/photo-1621905251189-08b45d6a269e?auto=format&fit=crop&q=80&w=400" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110" />
                            </div>
                            <div class="flex flex-col justify-center">
                                <div class="text-[10px] font-bold text-copper mb-2">۱۸ اسفند ۱۴۰۲</div>
                                <h4 class="font-bold text-slate-800 text-base leading-snug mb-2 group-hover:text-copper transition-colors line-clamp-2">هوش مصنوعی در معادن: آینده صنعت استخراج و فرآوری</h4>
                                <span class="text-xs text-slate-400 mt-auto flex items-center gap-1 group-hover:text-copper transition-colors">بیشتر بخوانید <i data-lucide="chevron-left" class="w-3 h-3"></i></span>
                            </div>
                        </div>

                        <!-- Side Item 2 -->
                        <div class="flex-1 group cursor-pointer bg-slate-50 rounded-sm p-4 flex gap-4 transition-all hover:bg-white hover:shadow-xl border border-slate-100">
                            <div class="w-32 h-32 rounded-sm overflow-hidden flex-shrink-0 relative">
                                <img src="https://images.unsplash.com/photo-1518546305927-5a555bb7020d?auto=format&fit=crop&q=80&w=400" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110" />
                            </div>
                            <div class="flex flex-col justify-center">
                                <div class="text-[10px] font-bold text-copper mb-2">۱۵ اسفند ۱۴۰۲</div>
                                <h4 class="font-bold text-slate-800 text-base leading-snug mb-2 group-hover:text-copper transition-colors line-clamp-2">آغاز عملیات ساخت بیمارستان تخصصی در منطقه محروم</h4>
                                <span class="text-xs text-slate-400 mt-auto flex items-center gap-1 group-hover:text-copper transition-colors">بیشتر بخوانید <i data-lucide="chevron-left" class="w-3 h-3"></i></span>
                            </div>
                        </div>
                        
                         <!-- Side Item 3 -->
                        <div class="flex-1 group cursor-pointer bg-slate-50 rounded-sm p-4 flex gap-4 transition-all hover:bg-white hover:shadow-xl border border-slate-100">
                            <div class="w-32 h-32 rounded-sm overflow-hidden flex-shrink-0 relative">
                                <img src="https://images.unsplash.com/photo-1504917595217-d4dc5ebe6122?auto=format&fit=crop&q=80&w=400" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110" />
                            </div>
                            <div class="flex flex-col justify-center">
                                <div class="text-[10px] font-bold text-copper mb-2">۱۲ اسفند ۱۴۰۲</div>
                                <h4 class="font-bold text-slate-800 text-base leading-snug mb-2 group-hover:text-copper transition-colors line-clamp-2">افتتاح خط تولید جدید کنسانتره مس</h4>
                                <span class="text-xs text-slate-400 mt-auto flex items-center gap-1 group-hover:text-copper transition-colors">بیشتر بخوانید <i data-lucide="chevron-left" class="w-3 h-3"></i></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Icon Links -->
        <section class="py-16 bg-slate-900 text-white overflow-hidden">
            <div class="container mx-auto px-4">
                <div class="grid grid-cols-2 md:grid-cols-5 gap-6 fade-in-section">
                    <div class="flex flex-col items-center text-center p-6 rounded-sm hover:bg-white/5 transition-all border border-white/5 group hover:-translate-y-1">
                        <div class="w-14 h-14 bg-copper/10 rounded-sm flex items-center justify-center text-copper mb-4">
                            <i data-lucide="bar-chart" class="w-[28px] h-[28px]"></i>
                        </div>
                        <h4 class="font-bold text-sm mb-1">گزارش‌های مالی</h4>
                        <p class="text-slate-500 text-[10px] uppercase tracking-wide">صورت‌های سود و زیان</p>
                    </div>
                    <div class="flex flex-col items-center text-center p-6 rounded-sm hover:bg-white/5 transition-all border border-white/5 group hover:-translate-y-1">
                        <div class="w-14 h-14 bg-copper/10 rounded-sm flex items-center justify-center text-copper mb-4">
                            <i data-lucide="hard-hat" class="w-[28px] h-[28px]"></i>
                        </div>
                        <h4 class="font-bold text-sm mb-1">پایداری و ایمنی</h4>
                        <p class="text-slate-500 text-[10px] uppercase tracking-wide">استاندارد‌های HSE</p>
                    </div>
                    <div class="flex flex-col items-center text-center p-6 rounded-sm hover:bg-white/5 transition-all border border-white/5 group hover:-translate-y-1">
                        <div class="w-14 h-14 bg-copper/10 rounded-sm flex items-center justify-center text-copper mb-4">
                            <i data-lucide="file-text" class="w-[28px] h-[28px]"></i>
                        </div>
                        <h4 class="font-bold text-sm mb-1">فرم‌ها و راهنماها</h4>
                        <p class="text-slate-500 text-[10px] uppercase tracking-wide">فایل‌های اداری</p>
                    </div>
                    <div class="flex flex-col items-center text-center p-6 rounded-sm hover:bg-white/5 transition-all border border-white/5 group hover:-translate-y-1">
                        <div class="w-14 h-14 bg-copper/10 rounded-sm flex items-center justify-center text-copper mb-4">
                            <i data-lucide="settings" class="w-[28px] h-[28px]"></i>
                        </div>
                        <h4 class="font-bold text-sm mb-1">شرکت‌های تابعه</h4>
                        <p class="text-slate-500 text-[10px] uppercase tracking-wide">زیرمجموعه‌های گروه</p>
                    </div>
                    <div class="flex flex-col items-center text-center p-6 rounded-sm hover:bg-white/5 transition-all border border-white/5 group hover:-translate-y-1">
                        <div class="w-14 h-14 bg-copper/10 rounded-sm flex items-center justify-center text-copper mb-4">
                            <i data-lucide="users" class="w-[28px] h-[28px]"></i>
                        </div>
                        <h4 class="font-bold text-sm mb-1">پورتال پیمانکاران</h4>
                        <p class="text-slate-500 text-[10px] uppercase tracking-wide">سامانه متمرکز خدمات</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- FAQ Section -->
        <section class="py-24 bg-white border-b border-slate-50">
            <div class="container mx-auto px-4">
                <div class="flex flex-col lg:flex-row gap-16">
                    <!-- Title Column -->
                    <div class="lg:w-1/3 fade-in-section">
                        <span class="text-copper font-bold mb-2 block text-sm">پشتیبانی و راهنما</span>
                        <h2 class="text-4xl font-black mb-6 leading-tight">سوالات متداول شما</h2>
                        <p class="text-slate-500 leading-relaxed mb-8">
                            پاسخ به پرسش‌های رایج درباره فرآیندهای کاری، مناقصات و همکاری با ما. اگر پاسخ خود را نیافتید، با ما تماس بگیرید.
                        </p>
                        <a href="#contact" class="inline-flex items-center gap-2 font-bold text-copper border-b-2 border-copper/20 pb-1 hover:border-copper transition-all">
                            تماس با پشتیبانی <i data-lucide="arrow-left" class="w-4 h-4"></i>
                        </a>
                    </div>

                    <!-- Accordion Column -->
                    <div class="lg:w-2/3 space-y-4 fade-in-section" id="faq-container">
                        <div class="border border-slate-100 rounded-sm overflow-hidden group bg-slate-50 hover:bg-white transition-colors">
                            <button class="w-full flex items-center justify-between p-6 text-right transition-colors">
                                <span class="font-bold text-slate-800 text-lg">چگونه می‌توان در مناقصات شرکت کرد؟</span>
                                <div class="w-8 h-8 rounded-full bg-white border border-slate-200 flex items-center justify-center text-slate-400 group-[.active]:bg-copper group-[.active]:text-white group-[.active]:border-copper transition-all">
                                    <i data-lucide="chevron-down" class="w-5 h-5 transition-transform duration-300 group-[.active]:rotate-180"></i>
                                </div>
                            </button>
                            <div class="accordion-content max-h-0 overflow-hidden transition-all duration-300 ease-in-out text-slate-600 leading-loose px-6">
                                <div class="pb-6 pt-2 border-t border-slate-100/50">
                                    برای شرکت در مناقصات، ابتدا باید در سامانه تامین‌کنندگان ثبت‌نام کنید. پس از تایید مدارک و دریافت کد کاربری، می‌توانید به کارتابل خود مراجعه کرده و لیست مناقصات فعال را مشاهده و اسناد مربوطه را دریافت نمایید.
                                </div>
                            </div>
                        </div>
                        <div class="border border-slate-100 rounded-sm overflow-hidden group bg-slate-50 hover:bg-white transition-colors">
                            <button class="w-full flex items-center justify-between p-6 text-right transition-colors">
                                <span class="font-bold text-slate-800 text-lg">مدارک مورد نیاز برای ثبت‌نام پیمانکاران چیست؟</span>
                                <div class="w-8 h-8 rounded-full bg-white border border-slate-200 flex items-center justify-center text-slate-400 group-[.active]:bg-copper group-[.active]:text-white group-[.active]:border-copper transition-all">
                                    <i data-lucide="chevron-down" class="w-5 h-5 transition-transform duration-300 group-[.active]:rotate-180"></i>
                                </div>
                            </button>
                            <div class="accordion-content max-h-0 overflow-hidden transition-all duration-300 ease-in-out text-slate-600 leading-loose px-6">
                                <div class="pb-6 pt-2 border-t border-slate-100/50">
                                    مدارک ثبتی شرکت (اساسنامه، روزنامه رسمی)، گواهی‌نامه‌های صلاحیت ایمنی و فنی، سوابق کاری مرتبط در ۵ سال گذشته، گواهی حسن انجام کار از کارفرمایان قبلی و مدارک مالیاتی معتبر.
                                </div>
                            </div>
                        </div>
                        <div class="border border-slate-100 rounded-sm overflow-hidden group bg-slate-50 hover:bg-white transition-colors">
                            <button class="w-full flex items-center justify-between p-6 text-right transition-colors">
                                <span class="font-bold text-slate-800 text-lg">فرآیند پرداخت صورت‌وضعیت‌ها چگونه است؟</span>
                                <div class="w-8 h-8 rounded-full bg-white border border-slate-200 flex items-center justify-center text-slate-400 group-[.active]:bg-copper group-[.active]:text-white group-[.active]:border-copper transition-all">
                                    <i data-lucide="chevron-down" class="w-5 h-5 transition-transform duration-300 group-[.active]:rotate-180"></i>
                                </div>
                            </button>
                            <div class="accordion-content max-h-0 overflow-hidden transition-all duration-300 ease-in-out text-slate-600 leading-loose px-6">
                                <div class="pb-6 pt-2 border-t border-slate-100/50">
                                    پس از ارسال صورت‌وضعیت توسط پیمانکار، ناظر پروژه آن را بررسی می‌کند. پس از تایید فنی، پرونده به واحد مالی ارجاع شده و طبق زمان‌بندی قرارداد و تخصیص بودجه، پرداخت انجام می‌شود.
                                </div>
                            </div>
                        </div>
                        <div class="border border-slate-100 rounded-sm overflow-hidden group bg-slate-50 hover:bg-white transition-colors">
                            <button class="w-full flex items-center justify-between p-6 text-right transition-colors">
                                <span class="font-bold text-slate-800 text-lg">چگونه می‌توانم از نتایج مناقصات مطلع شوم؟</span>
                                <div class="w-8 h-8 rounded-full bg-white border border-slate-200 flex items-center justify-center text-slate-400 group-[.active]:bg-copper group-[.active]:text-white group-[.active]:border-copper transition-all">
                                    <i data-lucide="chevron-down" class="w-5 h-5 transition-transform duration-300 group-[.active]:rotate-180"></i>
                                </div>
                            </button>
                            <div class="accordion-content max-h-0 overflow-hidden transition-all duration-300 ease-in-out text-slate-600 leading-loose px-6">
                                <div class="pb-6 pt-2 border-t border-slate-100/50">
                                    نتایج تمامی مناقصات و مزایدات از طریق سامانه رسمی شرکت و همچنین ارسال پیامک به نمایندگان شرکت‌های حاضر در مناقصه اطلاع‌رسانی می‌شود.
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Subsidiaries & Partners -->
        <section id="partners" class="py-24 bg-slate-50 overflow-hidden">
            <div class="container mx-auto px-4">
                 <div class="text-center mb-16 fade-in-section">
                     <span class="text-copper font-bold mb-2 block text-sm">زیرمجموعه‌ها</span>
                     <h2 class="text-4xl font-black text-slate-900">شرکت‌های تابعه و همکار</h2>
                </div>
            
                <div class="grid grid-cols-2 md:grid-cols-5 gap-8 md:gap-12 fade-in-section">
                    <!-- Item 1 -->
                    <a href="#" class="flex flex-col items-center gap-4 group cursor-pointer opacity-70 grayscale hover:opacity-100 hover:grayscale-0 transition-all duration-300">
                        <div class="w-32 h-32 bg-white rounded-full flex items-center justify-center text-slate-300 shadow-sm border border-slate-100 group-hover:text-copper group-hover:shadow-xl group-hover:scale-110 transition-all duration-300">
                            <img src="<?php echo get_template_directory_uri(); ?>/images/logo/subcompany-3.png" alt="Company 3" class="w-24 h-24 object-contain opacity-80 group-hover:opacity-100">
                        </div>
                        <h4 class="font-bold text-slate-700 group-hover:text-copper transition-colors">شرکت سرمایه گذاری آتیه اندیشان مس</h4>
                    </a>
                    <!-- Item 2 -->
                    <a href="#" class="flex flex-col items-center gap-4 group cursor-pointer opacity-70 grayscale hover:opacity-100 hover:grayscale-0 transition-all duration-300">
                        <div class="w-32 h-32 bg-white rounded-full flex items-center justify-center text-slate-300 shadow-sm border border-slate-100 group-hover:text-copper group-hover:shadow-xl group-hover:scale-110 transition-all duration-300">
                            <img src="<?php echo get_template_directory_uri(); ?>/images/logo/subcompany-2.png" alt="Company 3" class="w-24 h-24 object-contain opacity-80 group-hover:opacity-100">
                        </div>
                        <h4 class="font-bold text-slate-700 group-hover:text-copper transition-colors">شرکت معدنکاری اولنگ</h4>
                    </a>
                    <!-- Item 3 -->
                    <a href="#" class="flex flex-col items-center gap-4 group cursor-pointer opacity-70 grayscale hover:opacity-100 hover:grayscale-0 transition-all duration-300">
                        <div class="w-32 h-32 bg-white rounded-full flex items-center justify-center text-slate-300 shadow-sm border border-slate-100 group-hover:text-copper group-hover:shadow-xl group-hover:scale-110 transition-all duration-300">
                            <img src="<?php echo get_template_directory_uri(); ?>/images/logo/subcompany-4.png" alt="Company 4" class="w-24 h-24 object-contain opacity-80 group-hover:opacity-100">
                        </div>
                        <h4 class="font-bold text-slate-700 group-hover:text-copper transition-colors">شرکت سرمایه گذاری مس سرچشمه</h4>
                    </a>
                    <!-- Item 4 -->
                    <a href="#" class="flex flex-col items-center gap-4 group cursor-pointer opacity-70 grayscale hover:opacity-100 hover:grayscale-0 transition-all duration-300">
                        <div class="w-32 h-32 bg-white rounded-full flex items-center justify-center text-slate-300 shadow-sm border border-slate-100 group-hover:text-copper group-hover:shadow-xl group-hover:scale-110 transition-all duration-300">
                            <img src="<?php echo get_template_directory_uri(); ?>/images/logo/subcompany-7.png" alt="Company 5" class="w-24 h-24 object-contain opacity-80 group-hover:opacity-100">
                        </div>
                        <h4 class="font-bold text-slate-700 group-hover:text-copper transition-colors">منطقه ویژه اقتصادی رفسنجان</h4>
                    </a>
                    <!-- Item 5 -->
                    <a href="#" class="flex flex-col items-center gap-4 group cursor-pointer opacity-70 grayscale hover:opacity-100 hover:grayscale-0 transition-all duration-300">
                        <div class="w-32 h-32 bg-white rounded-full flex items-center justify-center text-slate-300 shadow-sm border border-slate-100 group-hover:text-copper group-hover:shadow-xl group-hover:scale-110 transition-all duration-300">
                            <img src="<?php echo get_template_directory_uri(); ?>/images/logo/subcompany-6.png" alt="Company 6" class="w-24 h-24 object-contain opacity-80 group-hover:opacity-100">
                        </div>
                        <h4 class="font-bold text-slate-700 group-hover:text-copper transition-colors">شرکت خدمات فنی و مهندسی صنایع و معادن کانی مس</h4>
                    </a>
                </div>
            </div>
        </section>

        <!-- Contact Section -->
        <section id="contact" class="py-24 bg-white">
            <div class="container mx-auto px-4">
                <div class="bg-slate-900 rounded-sm overflow-hidden flex flex-col md:flex-row fade-in-section">
                    <div class="w-full md:w-1/2 p-12 md:p-20 text-white">
                        <h2 class="text-3xl font-black mb-8">با ما در ارتباط باشید</h2>
                        <div class="space-y-8">
                            <div class="flex items-start gap-4">
                                <div class="w-10 h-10 bg-white/5 rounded-sm flex items-center justify-center text-copper flex-shrink-0"><i data-lucide="map-pin" class="w-[20px] h-[20px]"></i></div>
                                <div>
                                    <h4 class="font-bold mb-1 text-sm">دفتر مرکزی</h4>
                                    <p class="text-slate-400 text-[13px] leading-relaxed">تهران، سعادت آباد، خیابان مروارید، پلاک ۸۲، ساختمان مرکزی صنایع مس</p>
                                </div>
                            </div>
                            <div class="flex items-start gap-4">
                                <div class="w-10 h-10 bg-white/5 rounded-sm flex items-center justify-center text-copper flex-shrink-0"><i data-lucide="phone" class="w-[20px] h-[20px]"></i></div>
                                <div>
                                    <h4 class="font-bold mb-1 text-sm">تلفن تماس</h4>
                                    <p class="text-slate-400 text-[13px]" dir="ltr">+۹۸ ۲۱ ۲۸۴۲ ۰۹۰۹</p>
                                </div>
                            </div>
                            <div class="flex items-start gap-4">
                                <div class="w-10 h-10 bg-white/5 rounded-sm flex items-center justify-center text-copper flex-shrink-0"><i data-lucide="mail" class="w-[20px] h-[20px]"></i></div>
                                <div>
                                    <h4 class="font-bold mb-1 text-sm">پست الکترونیک</h4>
                                    <p class="text-slate-400 text-[13px]">info@copperindustry.co.ir</p>
                                </div>
                            </div>
                        </div>
                        
                        <div class="mt-16 pt-16 border-t border-white/5">
                            <h4 class="font-bold text-xs mb-6 uppercase tracking-widest text-slate-500">شبکه‌های اجتماعی</h4>
                            <div class="flex gap-4">
                                <a href="#" class="w-10 h-10 rounded-sm border border-white/10 flex items-center justify-center hover:bg-copper hover:text-white transition-all text-slate-400">
                                    <i data-lucide="instagram" class="w-[18px] h-[18px]"></i>
                                </a>
                                <a href="#" class="w-10 h-10 rounded-sm border border-white/10 flex items-center justify-center hover:bg-copper hover:text-white transition-all text-slate-400">
                                    <i data-lucide="linkedin" class="w-[18px] h-[18px]"></i>
                                </a>
                                <a href="#" class="w-10 h-10 rounded-sm border border-white/10 flex items-center justify-center hover:bg-copper hover:text-white transition-all text-slate-400">
                                    <i data-lucide="twitter" class="w-[18px] h-[18px]"></i>
                                </a>
                                <a href="#" class="w-10 h-10 rounded-sm border border-white/10 flex items-center justify-center hover:bg-copper hover:text-white transition-all text-slate-400">
                                    <i data-lucide="facebook" class="w-[18px] h-[18px]"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="w-full md:w-1/2 bg-white m-4 rounded-2xl p-12 shadow-2xl border border-slate-100/50 relative overflow-hidden">
                         <div class="absolute top-0 right-0 w-32 h-32 bg-copper/5 rounded-bl-full -mr-16 -mt-16 pointer-events-none"></div>
                        <h3 class="text-xl font-bold mb-8 text-slate-900 border-r-4 border-copper pr-4">ارسال پیام سریع</h3>
                        <form class="space-y-6" id="contact-form">
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                                <div>
                                    <label class="block text-[11px] font-bold mb-2 text-slate-500 uppercase tracking-tighter">نام و نام خانوادگی</label>
                                    <input type="text" required class="w-full bg-white border border-slate-200 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-copper/20 focus:border-copper transition-all text-sm shadow-sm hover:border-copper/50" placeholder="مثلا: علی محمدی" />
                                </div>
                                <div>
                                    <label class="block text-[11px] font-bold mb-2 text-slate-500 uppercase tracking-tighter">پست الکترونیک</label>
                                    <input type="email" required class="w-full bg-white border border-slate-200 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-copper/20 focus:border-copper transition-all text-sm shadow-sm hover:border-copper/50" placeholder="example@mail.com" />
                                </div>
                            </div>
                            <div>
                                <label class="block text-[11px] font-bold mb-2 text-slate-500 uppercase tracking-tighter">موضوع پیام</label>
                                <div class="relative">
                                    <select class="w-full bg-white border border-slate-200 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-copper/20 focus:border-copper transition-all text-sm appearance-none shadow-sm hover:border-copper/50">
                                        <option>سرمایه‌گذاری</option>
                                        <option>مزایده و مناقصه</option>
                                        <option>رسانه و اخبار</option>
                                        <option>سایر موارد</option>
                                    </select>
                                    <i data-lucide="chevron-down" class="absolute left-4 top-1/2 -translate-y-1/2 w-4 h-4 text-slate-400 pointer-events-none"></i>
                                </div>
                            </div>
                            <div>
                                <label class="block text-[11px] font-bold mb-2 text-slate-500 uppercase tracking-tighter">متن پیام</label>
                                <textarea rows="4" required class="w-full bg-white border border-slate-200 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-copper/20 focus:border-copper transition-all text-sm shadow-sm hover:border-copper/50" placeholder="پیام خود را اینجا بنویسید..."></textarea>
                            </div>
                            <button type="submit" class="w-full bg-copper text-white py-4 rounded-lg font-bold flex items-center justify-center gap-2 hover:bg-copper/90 transition-all shadow-lg shadow-copper/30 hover:shadow-xl hover:-translate-y-0.5 active:translate-y-0">
                                ارسال پیام <i data-lucide="send" class="w-[18px] h-[18px]"></i>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </section>

    </main>

    <!-- Footer -->
    <footer class="bg-white pt-20 border-t border-slate-100 relative overflow-hidden">
         <div class="absolute left-0 top-0 bottom-0 w-1/3 opacity-30 pointer-events-none z-0 hidden md:block pattern-bg" style="background-image: url('<?php echo get_template_directory_uri(); ?>/images/patt-right.webp'); background-repeat: no-repeat; background-position: left center; background-size: contain; transform: scaleX(-1);"></div>
        <div class="container mx-auto px-4 relative z-10">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-12 mb-16">
                <div class="col-span-1 md:col-span-1 flex flex-col items-center text-center">
                    <div class="mb-6">
                        <img src="<?php echo get_template_directory_uri(); ?>/images/sbsm-logo-3.png" alt="Logo" class="h-16 w-auto object-contain">
                    </div>
                    <p class="text-slate-500 text-xs leading-relaxed mb-8 max-w-xs">
                        پیشرو در صنعت استخراج و فرآوری مس، متعهد به پایداری، نوآوری و شکوفایی اقتصادی کشور عزیزمان ایران.
                    </p>
                </div>
                <div>
                    <h4 class="font-bold text-slate-900 mb-6 text-sm border-r-2 border-copper pr-2">دسترسی سریع</h4>
                    <ul class="space-y-4 text-slate-500 text-xs">
                        <li><a href="#" class="hover:text-copper transition-colors">صفحه اصلی</a></li>
                        <li><a href="#" class="hover:text-copper transition-colors">اخبار و رویدادها</a></li>
                        <li><a href="#" class="hover:text-copper transition-colors">مزایدات و مناقصات</a></li>
                        <li><a href="#" class="hover:text-copper transition-colors">سرمایه‌گذاران</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="font-bold text-slate-900 mb-6 text-sm border-r-2 border-copper pr-2">بخش‌های شرکت</h4>
                    <ul class="space-y-4 text-slate-500 text-xs">
                        <li><a href="#" class="hover:text-copper transition-colors">واحد تحقیق و توسعه</a></li>
                        <li><a href="#" class="hover:text-copper transition-colors">مدیریت محیط زیست</a></li>
                        <li><a href="#" class="hover:text-copper transition-colors">امور بین‌الملل</a></li>
                        <li><a href="#" class="hover:text-copper transition-colors">فروش و بازاریابی</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="font-bold text-slate-900 mb-6 text-sm border-r-2 border-copper pr-2">ارتباط با ما</h4>
                    <ul class="space-y-4 text-slate-500 text-xs">
                        <li class="flex items-center gap-2 font-medium justify-start" dir="ltr"><span class="ml-auto flex items-center gap-2"><i data-lucide="phone" class="w-[14px] h-[14px] text-copper"></i> +۹۸ ۲۱ ۲۸۴۲ ۰۹۰۹</span></li>
                        <li class="flex items-center gap-2"><i data-lucide="mail" class="w-[14px] h-[14px] text-copper"></i> contact@copper.ir</li>
                        <li class="flex items-start gap-2 leading-relaxed"><i data-lucide="map-pin" class="w-[14px] h-[14px] text-copper mt-0.5 flex-shrink-0"></i> تهران، خیابان ولیعصر، برج صنایع مس</li>
                    </ul>
                    <div class="mt-8 flex gap-3">
                        <a href="#" class="w-8 h-8 rounded-sm bg-slate-100 flex items-center justify-center hover:bg-copper hover:text-white transition-all text-slate-400">
                            <i data-lucide="instagram" class="w-[14px] h-[14px]"></i>
                        </a>
                        <a href="#" class="w-8 h-8 rounded-sm bg-slate-100 flex items-center justify-center hover:bg-copper hover:text-white transition-all text-slate-400">
                            <i data-lucide="linkedin" class="w-[14px] h-[14px]"></i>
                        </a>
                        <a href="#" class="w-8 h-8 rounded-sm bg-slate-100 flex items-center justify-center hover:bg-copper hover:text-white transition-all text-slate-400">
                            <i data-lucide="twitter" class="w-[14px] h-[14px]"></i>
                        </a>
                         <a href="#" class="w-8 h-8 rounded-sm bg-slate-100 flex items-center justify-center hover:bg-copper hover:text-white transition-all text-slate-400">
                            <i data-lucide="facebook" class="w-[14px] h-[14px]"></i>
                        </a>
                    </div>
                </div>
            </div>
            <div class="border-t border-slate-100 py-8 flex flex-col md:flex-row justify-between items-center gap-4 text-[11px] text-slate-400 font-medium">
                <p>© ۱۴۰۲ کلیه حقوق مادی و معنوی این سایت متعلق به شرکت صنایع مس می‌باشد.</p>
                <div class="flex gap-6">
                    <a href="#" class="hover:text-slate-600">قوانین و مقررات</a>
                    <a href="#" class="hover:text-slate-600">حریم خصوصی</a>
                </div>
            </div>
        </div>
    </footer>

    <!-- Back to Top Button -->
    <button id="back-to-top" class="fixed bottom-8 right-8 bg-white border border-slate-200 text-copper w-12 h-12 rounded-full shadow-xl flex items-center justify-center hover:bg-copper hover:text-white transition-all duration-300 z-50 opacity-0 translate-y-10 group" aria-label="Back to Top">
        <i data-lucide="arrow-up" class="w-6 h-6"></i>
    </button>

    <script>
        // Back to Top Logic
        const backToTopBtn = document.getElementById('back-to-top');
        
        window.addEventListener('scroll', () => {
            if (window.scrollY > 500) {
                backToTopBtn.classList.remove('opacity-0', 'translate-y-10');
            } else {
                backToTopBtn.classList.add('opacity-0', 'translate-y-10');
            }
        });
        
        backToTopBtn.addEventListener('click', () => {
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        });

        // Counter Animation
        const counterElement = document.getElementById('experience-counter');
        if (counterElement) {
            let count = 0;
            const target = 32;
            const duration = 2000; // 2 seconds
            const increment = target / (duration / 16); // 60fps
            
            const startCounter = () => {
                const interval = setInterval(() => {
                    count += increment;
                    if (count >= target) {
                        count = target;
                        clearInterval(interval);
                    }
                    counterElement.innerText = Math.floor(count);
                }, 16);
            };
            
            // Trigger when visible
            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        startCounter();
                        observer.unobserve(entry.target);
                    }
                });
            }, { threshold: 0.5 });
            
            observer.observe(counterElement);
        }

        // FAQ Accordion Logic
        const faqContainer = document.getElementById('faq-container');
        if (faqContainer) {
            const faqItems = faqContainer.querySelectorAll('.group');
            faqItems.forEach(item => {
                const button = item.querySelector('button');
                const content = item.querySelector('.accordion-content');
                
                button.addEventListener('click', () => {
                    const isActive = item.classList.contains('active');
                    
                    // Close all others
                    faqItems.forEach(otherItem => {
                        otherItem.classList.remove('active');
                        otherItem.querySelector('.accordion-content').style.maxHeight = '0';
                    });
                    
                    // Toggle current
                    if (!isActive) {
                        item.classList.add('active');
                        content.style.maxHeight = content.scrollHeight + 'px';
                    }
                });
            });
        }

        // Parallax Effect for Pattern
         window.addEventListener('scroll', () => {
             const scrolled = window.scrollY;
             const patterns = document.querySelectorAll('.pattern-bg');
             patterns.forEach(pattern => {
                 // Check if section is visible to avoid unnecessary calcs
                 const rect = pattern.parentElement.getBoundingClientRect();
                 if (rect.top < window.innerHeight && rect.bottom > 0) {
                      // Simple parallax: move background slightly opposite to scroll
                      const speed = 0.05; // Slower speed for subtle effect
                      const yPos = (window.scrollY - pattern.parentElement.offsetTop) * speed;
                      
                      // Check for initial flip (scaleX(-1))
                      if (pattern.dataset.flipped === undefined) {
                          pattern.dataset.flipped = pattern.style.transform.includes('scaleX(-1)') || pattern.getAttribute('style')?.includes('scaleX(-1)');
                      }
                      const isFlipped = pattern.dataset.flipped === 'true';
                      
                      pattern.style.transform = isFlipped 
                         ? `scaleX(-1) translateY(${yPos}px)` 
                         : `translateY(${yPos}px)`;
                 }
             });
         });

         // Initialize Icons
         lucide.createIcons();

        // Navbar Scroll Logic
        const nav = document.getElementById('main-nav');
        const topBar = document.getElementById('top-bar');
        
        window.addEventListener('scroll', () => {
            if (window.scrollY > 40) {
                // Sticky State
                nav.classList.add('scrolled', 'shadow-md', 'py-1');
                nav.classList.remove('py-3');
                
                // Hide Top Bar
                if (topBar) {
                    topBar.style.height = '0px';
                    topBar.style.opacity = '0';
                }
            } else {
                // Normal State
                nav.classList.remove('scrolled', 'shadow-md', 'py-1');
                nav.classList.add('py-3');
                
                // Show Top Bar
                if (topBar) {
                    topBar.style.height = '40px'; // h-10 is 2.5rem = 40px
                    topBar.style.opacity = '1';
                }
            }
        });

        // Mobile Menu Logic
        const mobileBtn = document.getElementById('mobile-menu-btn');
        const closeMobileBtn = document.getElementById('close-mobile-menu');
        const overlay = document.getElementById('mobile-menu-overlay');
        const sidebar = document.getElementById('mobile-menu-sidebar');

        function toggleMobileMenu() {
            const isHidden = overlay.classList.contains('hidden');
            const menuIcon = mobileBtn.querySelector('[data-lucide="menu"]');
            const xIcon = mobileBtn.querySelector('[data-lucide="x"]');
            
            // Note: Since Lucide replaces <i> with <svg>, we need to target svg or handle the replacement.
            // However, re-rendering icons is expensive.
            // Easier approach: toggle the content of the button or class.
            // But Lucide replaces the element. 
            // Let's check the button content again.
            // The button has: <i data-lucide="menu"></i>
            // After lucide.createIcons(), it becomes <svg ... class="lucide lucide-menu">...</svg>
            
            // To change icon, we can remove the inner HTML and add new icon, then call createIcons for that element.
            // Or easier: have both icons and toggle visibility.
            // Let's stick to the current logic of just opening/closing sidebar for now as "icon toggle" involves DOM manipulation with Lucide.
            // But I can try to swap the icon.
            
            if (isHidden) {
                // Open
                overlay.classList.remove('hidden');
                setTimeout(() => overlay.classList.remove('opacity-0'), 10);
                
                sidebar.classList.remove('translate-x-full', 'opacity-0');
                
                // Change menu icon to X (Optional, but nice)
                mobileBtn.innerHTML = '<i data-lucide="x" class="w-[26px] h-[26px]"></i>';
                lucide.createIcons({ attrs: { class: "w-[26px] h-[26px]" }, nameAttr: 'data-lucide' }); 
            } else {
                // Close
                overlay.classList.add('opacity-0');
                sidebar.classList.add('translate-x-full', 'opacity-0');
                setTimeout(() => {
                    overlay.classList.add('hidden');
                }, 300);
                
                // Change X icon to menu
                mobileBtn.innerHTML = '<i data-lucide="menu" class="w-[26px] h-[26px]"></i>';
                lucide.createIcons({ attrs: { class: "w-[26px] h-[26px]" }, nameAttr: 'data-lucide' });
            }
        }

        mobileBtn.addEventListener('click', toggleMobileMenu);
        closeMobileBtn.addEventListener('click', toggleMobileMenu);
        overlay.addEventListener('click', toggleMobileMenu);

        // Ads Filter Logic
        const filterBtns = document.querySelectorAll('[data-filter]');
        const adItems = document.querySelectorAll('.ad-item');

        filterBtns.forEach(btn => {
            btn.addEventListener('click', () => {
                // Update active button state
                filterBtns.forEach(b => {
                    b.classList.remove('bg-copper', 'text-white');
                    b.classList.add('text-slate-500', 'hover:bg-slate-50');
                });
                btn.classList.remove('text-slate-500', 'hover:bg-slate-50');
                btn.classList.add('bg-copper', 'text-white');

                // Filter items
                const filter = btn.getAttribute('data-filter');
                adItems.forEach(item => {
                    if (filter === 'all' || item.getAttribute('data-type') === filter) {
                        item.classList.remove('hidden');
                        item.classList.add('fade-in-section'); // Re-trigger fade
                        setTimeout(() => item.classList.add('is-visible'), 10);
                    } else {
                        item.classList.add('hidden');
                        item.classList.remove('is-visible');
                    }
                });
            });
        });

        // Hero Slider Logic
        const heroDots = document.querySelectorAll('.hero-dot');
        const heroSlides = document.querySelectorAll('.hero-slide');
        let currentSlide = 0;
        let slideInterval;

        function showSlide(index) {
            // Ensure index is valid
            if (index < 0 || index >= heroSlides.length) return;

            // Update Slides
            heroSlides.forEach(slide => {
                slide.classList.remove('opacity-100');
                slide.classList.add('opacity-0');
            });
            
            // We need to match slide index. Since slides have data-index, let's use that or just array index.
            // In HTML we added data-index to slides.
            const targetSlide = heroSlides[index]; 
            if (targetSlide) {
                targetSlide.classList.remove('opacity-0');
                targetSlide.classList.add('opacity-100');
            }

            // Update Dots
            heroDots.forEach(d => {
                d.classList.remove('w-6', 'bg-copper');
                d.classList.add('w-2.5', 'bg-white/40');
            });
            // Match dot index
            const activeDot = heroDots[index];
            if (activeDot) {
                activeDot.classList.remove('w-2.5', 'bg-white/40');
                activeDot.classList.add('w-6', 'bg-copper');
            }
            currentSlide = index;
        }

        function nextSlide() {
            let next = currentSlide + 1;
            if (next >= heroSlides.length) next = 0;
            showSlide(next);
        }

        function startSlider() {
            slideInterval = setInterval(nextSlide, 5000);
        }

        function resetTimer() {
            clearInterval(slideInterval);
            startSlider();
        }

        heroDots.forEach((dot, index) => {
            dot.addEventListener('click', () => {
                showSlide(index);
                resetTimer();
            });
        });

        // Initialize
        startSlider();

        // Contact Form Logic
        const contactForm = document.getElementById('contact-form');
        if (contactForm) {
            contactForm.addEventListener('submit', (e) => {
                e.preventDefault();
                // Simulate sending
                const btn = contactForm.querySelector('button');
                const originalText = btn.innerHTML;
                btn.innerHTML = 'در حال ارسال...';
                btn.disabled = true;
                
                setTimeout(() => {
                    btn.innerHTML = 'پیام ارسال شد <i data-lucide="check" class="w-[18px] h-[18px]"></i>';
                    lucide.createIcons();
                    btn.classList.remove('bg-copper');
                    btn.classList.add('bg-green-600');
                    contactForm.reset();
                    
                    setTimeout(() => {
                        btn.innerHTML = originalText;
                        btn.classList.add('bg-copper');
                        btn.classList.remove('bg-green-600');
                        btn.disabled = false;
                    }, 3000);
                }, 1500);
            });
        }

        // Intersection Observer for Animations
        const observerOptions = {
            root: null,
            rootMargin: '0px',
            threshold: 0.1
        };

        const observer = new IntersectionObserver((entries, observer) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('is-visible');
                    // Optional: Stop observing once visible if you want it to animate only once
                    // observer.unobserve(entry.target); 
                }
            });
        }, observerOptions);

        document.querySelectorAll('.fade-in-section').forEach(section => {
            observer.observe(section);
        });

        // Active Link Highlighting (Simple)
        const links = document.querySelectorAll('.nav-link');
        links.forEach(link => {
            link.addEventListener('click', function() {
                // Remove active state from all
                links.forEach(l => {
                    l.classList.remove('text-copper');
                    l.classList.add('text-slate-600');
                    // Find sibling underline and hide it
                    const parent = l.parentElement;
                    const underline = parent.querySelector('.nav-underline');
                    if (underline) underline.classList.add('hidden');
                });
                
                // Add active state to current
                this.classList.remove('text-slate-600');
                this.classList.add('text-copper');
                // Show sibling underline
                const parent = this.parentElement;
                const underline = parent.querySelector('.nav-underline');
                if (underline) underline.classList.remove('hidden');
                
                // Close mobile menu if open
                if (!overlay.classList.contains('hidden')) {
                    toggleMobileMenu();
                }
            });
        });

    </script>
</body>
</html>

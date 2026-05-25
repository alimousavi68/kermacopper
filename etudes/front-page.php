<?php
$active_page = 'home';
$page_title = 'مس سرچشمه - اتود جدید';
include 'header.php';
?>

    <!-- HERO SECTION -->
    <header class="relative h-screen min-h-[550px] lg:min-h-[650px] flex items-center justify-start overflow-hidden bg-navy">
        <!-- Background Image -->
        <div class="absolute inset-0 w-full h-full">
            <img src="../images/pano sarcheshmeh.jpg" class="hero-bg-image w-full h-full object-cover opacity-65 mix-blend-overlay will-change-transform" alt="صنایع و معادن مس کرمان زمین">
            <!-- Vibrant Overlay: Dark on the right for readability of right-aligned text -->
            <div class="absolute inset-0 bg-gradient-to-l from-navy/80 via-navy/35 to-transparent z-10"></div>
            <div class="absolute inset-0 bg-gradient-to-t from-navy/60 via-transparent to-transparent z-10"></div>

            <!-- Left Side Pattern Graphic (Stretches to cover and scale with screen size) -->
            <div class="hero-pattern-left absolute left-0 top-0 bottom-0 w-1/3 xl:w-[35%] opacity-[0.55] pointer-events-none z-10" style="background-image: url('../images/patt-right.webp'); background-repeat: no-repeat; background-position: left center; background-size: cover; transform: scaleX(-1);">
            </div>

            <!-- Accent glow: Positioned above background gradients but below text container -->
            <div class="hero-glow-accent absolute -top-[20%] -right-[10%] w-[55%] h-[55%] bg-copper/35 rounded-full blur-[120px] animate-pulse-slow z-15">
            </div>
        </div>

        <div class="hero-text-container container mx-auto px-6 lg:px-12 relative z-20 flex flex-col items-start text-right mt-8 lg:mt-10 xl:mt-12 font-peyda">
            <div class="inline-flex items-center gap-3 px-4 py-2 rounded-full glass-panel mb-6 border border-white/20 animate-fade-in-up delay-100">
                <span class="relative flex h-3 w-3">
                    <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-copper opacity-75"></span>
                    <span class="relative inline-flex rounded-full h-3 w-3 bg-copper"></span>
                </span>
                <span class="text-copper-light text-xs font-extrabold tracking-widest">صنایع و معادن مس کرمان زمین | مهد مس ایران</span>
            </div>

            <h1 class="text-3xl md:text-5xl lg:text-6xl xl:text-7xl xl:leading-[1.1] font-black text-white leading-[1.2] mb-3 max-w-4xl text-right animate-fade-in-up delay-200">
                افتخار ملی، نوآوری در <br class="hidden sm:inline">قلب <span class="text-transparent bg-clip-text bg-gradient-to-l from-copper-dark via-copper to-copper-light">صنعت مس ایران</span>
            </h1>
            <div class="text-sm md:text-base lg:text-lg xl:text-xl text-slate-400 font-semibold tracking-wider mb-6 uppercase text-right animate-fade-in-up delay-300" dir="ltr">
                National Pride, Innovation in Iran's Copper Industry
            </div>

            <p class="text-base md:text-lg xl:text-xl xl:leading-relaxed text-slate-300 max-w-2xl leading-relaxed mb-8 font-light text-right animate-fade-in-up delay-400">
                تکیه بر تخصص بومی و پتانسیل‌های بی‌کران دشت‌های کرمان، صنایع و معادن مس کرمان زمین را به نماد پایداری، خودکفایی و حضور پرقدرت در بازارهای جهانی تبدیل کرده است.
            </p>

            <div class="flex justify-start flex-wrap gap-4 mb-4 animate-fade-in-up delay-500">
                <a href="#ads" class="bg-copper hover:bg-copper-light text-white px-6 py-3 rounded-full text-sm font-bold transition-all hover:shadow-[0_10px_30px_rgba(200,104,47,0.4)] flex items-center gap-2 hover:-translate-y-1">
                    مزایده و مناقصه
                </a>
                <a href="about.php" class="border border-white hover:bg-white hover:text-navy text-white px-6 py-3 rounded-full text-sm font-bold transition-all flex items-center gap-2 hover:-translate-y-1">
                    درباره ما
                </a>
            </div>
        </div>

        <!-- Bottom Curve (Union image) -->
        <div class="hero-curve">
            <img src="../images/Union.png" srcset="../images/Union.png 1440w, ../images/Union-300x37.png 300w, ../images/Union-1024x127.png 1024w, ../images/Union-768x95.png 768w" sizes="(max-width: 1440px) 100vw, 1440px" class="hero-curve-image" alt="" />
            <a href="#about" class="hero-curve-arrow" aria-label="بخش بعدی">
                <i data-lucide="chevrons-down" class="hero-curve-arrow-icon"></i>
            </a>
        </div>
    </header>

<?php
include 'template-parts/about-section.php';
include 'template-parts/ads-section.php';
include 'template-parts/news-section.php';
include 'template-parts/faq-section.php';
include 'template-parts/contact-section.php';
include 'footer.php';
?>

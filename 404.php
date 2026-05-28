<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @package KermanCopper
 */

get_header(); ?>

<header class="relative min-h-[450px] lg:min-h-[500px] flex items-center justify-center overflow-hidden bg-navy pt-32 lg:pt-40 pb-16">
    <!-- Background Image -->
    <div class="absolute inset-0 w-full h-full">
        <img src="<?php $hero_bg_image_id = get_theme_mod( 'kermancopper_home_hero_slide_1_image_id' ); $hero_bg_image_url = $hero_bg_image_id ? wp_get_attachment_image_url( $hero_bg_image_id, 'full' ) : ''; echo esc_url( $hero_bg_image_url ?: ( get_template_directory_uri() . '/images/pano sarcheshmeh.jpg' ) ); ?>" class="hero-bg-image w-full h-full object-cover opacity-25 mix-blend-overlay" alt="404 Error">
        <div class="absolute inset-0 bg-gradient-to-t from-navy via-navy/70 to-transparent z-10"></div>
        <div class="absolute inset-0 bg-gradient-to-l from-navy/50 via-transparent to-navy/50 z-10"></div>

        <!-- Glow Accent -->
        <div class="hero-glow-accent absolute -top-[20%] -right-[10%] w-[55%] h-[55%] bg-copper/35 rounded-full blur-[120px] animate-pulse-slow z-15"></div>
    </div>

    <!-- Pattern Background -->
    <div class="absolute inset-0 bg-[radial-gradient(rgba(200,104,47,0.15)_1px,transparent_1px)] bg-[size:32px_32px] opacity-60 z-10"></div>

    <div class="hero-text-container container mx-auto px-6 lg:px-12 relative z-20 text-center font-peyda">
        <div class="inline-flex items-center gap-3 px-5 py-2.5 rounded-full glass-panel mb-6 border border-white/10 shadow-[0_8px_32px_0_rgba(0,0,0,0.2)] animate-fade-in-down delay-100 mx-auto">
            <?php echo kermancopper_icon('alert-triangle', 'w-4 h-4 text-copper-light'); ?>
            <span class="text-copper-light text-xs font-extrabold tracking-widest">خطای ۴۰۴</span>
        </div>

        <h1 class="text-6xl md:text-8xl font-black text-white leading-tight mb-4 animate-fade-in-down delay-200 tracking-wider">
            404
        </h1>

        <p class="text-xl md:text-2xl font-bold text-slate-300 mx-auto leading-relaxed animate-fade-in-down delay-300 max-w-3xl">
            صفحه مورد نظر یافت نشد
        </p>
    </div>

    <!-- Bottom Curve -->
    <div class="hero-curve">
        <img src="<?php echo get_template_directory_uri(); ?>/images/Union.png" srcset="<?php echo get_template_directory_uri(); ?>/images/Union.png 1440w, <?php echo get_template_directory_uri(); ?>/images/Union-300x37.png 300w, <?php echo get_template_directory_uri(); ?>/images/Union-1024x127.png 1024w, <?php echo get_template_directory_uri(); ?>/images/Union-768x95.png 768w" sizes="(max-width: 1440px) 100vw, 1440px" class="hero-curve-image" alt="" />
        <a href="#content-section" class="hero-curve-arrow" aria-label="بخش بعدی">
            <?php echo kermancopper_icon('chevrons-down', 'hero-curve-arrow-icon'); ?>
        </a>
    </div>
</header>

<main id="content-section" class="relative z-20 pb-32 bg-gradient-to-b from-[#FAF8F5] via-white to-[#FAF8F5] pt-16 lg:pt-24 text-center">
    <div class="container mx-auto px-6 lg:px-12 relative z-10 max-w-2xl">
        <p class="text-slate-600 text-lg mb-8 leading-loose font-medium font-peyda">
            متاسفانه صفحه‌ای که به دنبال آن هستید وجود ندارد یا منتقل شده است. می‌توانید از بخش جستجوی زیر استفاده کنید یا به صفحه اصلی بازگردید.
        </p>

        <!-- Search Form -->
        <div class="bg-white border border-slate-200/80 p-8 rounded-[2rem] shadow-[0_15px_50px_rgba(0,0,0,0.03)] mb-12">
            <form action="<?php echo esc_url( home_url( '/' ) ); ?>" method="get" class="relative flex items-center gap-3">
                <input type="search" name="s" placeholder="جستجو در سایت..." class="w-full rounded-2xl border border-slate-300 bg-slate-50 px-6 py-4 text-navy focus:outline-none focus:border-copper focus:bg-white transition-all font-semibold" required />
                <button type="submit" class="bg-gradient-to-r from-copper-dark to-copper text-white font-extrabold px-8 py-4 rounded-2xl transition-all shadow-[0_10px_20px_rgba(200,104,47,0.2)] hover:shadow-[0_15px_30px_rgba(200,104,47,0.3)] hover:-translate-y-0.5 flex items-center justify-center">
                    <?php echo kermancopper_icon('search', 'w-5 h-5'); ?>
                </button>
            </form>
        </div>

        <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="bg-navy hover:bg-copper text-white font-extrabold px-8 py-4 rounded-2xl transition-all shadow-[0_10px_25px_rgba(15,23,36,0.15)] hover:shadow-[0_15px_30px_rgba(200,104,47,0.3)] hover:-translate-y-0.5 inline-flex items-center gap-2">
            <?php echo kermancopper_icon('home', 'w-5 h-5'); ?>
            بازگشت به صفحه اصلی
        </a>
    </div>
</main>

<style>
/* Scoped overrides to restore border radiuses */
#content-section .rounded-\[2rem\],
#content-section .rounded-2xl {
    border-radius: 2rem !important;
}
#content-section input,
#content-section button,
#content-section a {
    border-radius: 1rem !important;
}
#content-section input {
    border: 1.8px solid #7f8e9f !important;
    background-color: #f8fafc !important;
    color: #0f172a !important;
}
#content-section input:focus {
    border-color: #c8682f !important;
    background-color: #ffffff !important;
    box-shadow: 0 0 0 4px rgba(200, 104, 47, 0.25) !important;
}
</style>

<?php
get_footer();

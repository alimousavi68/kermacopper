<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @package KermanCopper
 */

get_header(); ?>

<main class="container mx-auto px-4 py-20 mt-[100px] sm:mt-[125px] text-center min-h-[60vh] flex flex-col items-center justify-center">
    <div class="mb-8 text-copper opacity-20">
        <?php echo kermancopper_icon('alert-triangle', 'w-32 h-32'); ?>
    </div>
    <h1 class="text-6xl md:text-8xl font-black text-slate-900 mb-4">404</h1>
    <h2 class="text-2xl md:text-3xl font-bold text-slate-700 mb-6">صفحه مورد نظر یافت نشد</h2>
    <p class="text-slate-500 max-w-md mx-auto mb-10 leading-relaxed">
        متاسفانه صفحه‌ای که به دنبال آن هستید وجود ندارد یا حذف شده است. می‌توانید به صفحه اصلی بازگردید یا از جستجو استفاده کنید.
    </p>
    
    <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="bg-copper text-white px-8 py-3 rounded-sm font-bold hover:bg-slate-900 transition-colors inline-flex items-center gap-2">
        <?php echo kermancopper_icon('home', 'w-4 h-4'); ?>
        بازگشت به صفحه اصلی
    </a>
</main>

<?php
get_footer();

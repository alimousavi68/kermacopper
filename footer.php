    <!-- Footer -->
    <footer class="bg-white pt-20 border-t border-slate-100 relative overflow-hidden">
         <div class="absolute left-0 top-0 bottom-0 w-1/3 opacity-30 pointer-events-none z-0 hidden md:block pattern-bg" style="background-image: url('<?php echo get_template_directory_uri(); ?>/images/patt-right.webp'); background-repeat: no-repeat; background-position: left center; background-size: contain; transform: scaleX(-1);"></div>
        <div class="container mx-auto px-4 relative z-10">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-12 mb-16">
                <!-- Footer 1 -->
                <div class="col-span-1 md:col-span-1">
                    <?php if ( is_active_sidebar( 'footer-1' ) ) : ?>
                        <?php dynamic_sidebar( 'footer-1' ); ?>
                    <?php else : ?>
                        <!-- Fallback Content -->
                        <div class="flex flex-col items-center text-center">
                            <div class="mb-6">
                                <img src="<?php echo get_template_directory_uri(); ?>/images/sbsm-logo-3.png" alt="Logo" class="h-16 w-auto object-contain">
                            </div>
                            <p class="text-slate-500 text-xs leading-relaxed mb-8 max-w-xs">
                                پیشرو در صنعت استخراج و فرآوری مس، متعهد به پایداری، نوآوری و شکوفایی اقتصادی کشور عزیزمان ایران.
                            </p>
                        </div>
                    <?php endif; ?>
                </div>

                <!-- Footer 2 -->
                <div>
                    <?php if ( is_active_sidebar( 'footer-2' ) ) : ?>
                        <div class="footer-widget-area">
                            <?php dynamic_sidebar( 'footer-2' ); ?>
                        </div>
                    <?php else : ?>
                         <h4 class="font-bold text-slate-900 mb-6 text-sm border-r-2 border-copper pr-2">دسترسی سریع</h4>
                        <ul class="space-y-4 text-slate-500 text-xs">
                            <li><a href="#" class="hover:text-copper transition-colors">صفحه اصلی</a></li>
                            <li><a href="#" class="hover:text-copper transition-colors">اخبار و رویدادها</a></li>
                            <li><a href="#" class="hover:text-copper transition-colors">مزایدات و مناقصات</a></li>
                            <li><a href="#" class="hover:text-copper transition-colors">سرمایه‌گذاران</a></li>
                        </ul>
                    <?php endif; ?>
                </div>

                <!-- Footer 3 -->
                <div>
                    <?php if ( is_active_sidebar( 'footer-3' ) ) : ?>
                        <div class="footer-widget-area">
                            <?php dynamic_sidebar( 'footer-3' ); ?>
                        </div>
                    <?php else : ?>
                        <h4 class="font-bold text-slate-900 mb-6 text-sm border-r-2 border-copper pr-2">بخش‌های شرکت</h4>
                        <ul class="space-y-4 text-slate-500 text-xs">
                            <li><a href="#" class="hover:text-copper transition-colors">واحد تحقیق و توسعه</a></li>
                            <li><a href="#" class="hover:text-copper transition-colors">مدیریت محیط زیست</a></li>
                            <li><a href="#" class="hover:text-copper transition-colors">فرصت‌های شغلی</a></li>
                            <li><a href="#" class="hover:text-copper transition-colors">تماس با ما</a></li>
                        </ul>
                    <?php endif; ?>
                </div>

                <!-- Footer 4 -->
                <div>
                    <?php if ( is_active_sidebar( 'footer-4' ) ) : ?>
                        <div class="footer-widget-area">
                            <?php dynamic_sidebar( 'footer-4' ); ?>
                        </div>
                    <?php else : ?>
                        <h4 class="font-bold text-slate-900 mb-6 text-sm border-r-2 border-copper pr-2">ارتباط با ما</h4>
                        <ul class="space-y-4 text-slate-500 text-xs">
                            <li class="flex items-start gap-3">
                                <i data-lucide="map-pin" class="w-4 h-4 text-copper shrink-0 mt-1"></i>
                                <span>تهران، سعادت آباد، خیابان مروارید، پلاک ۱۲</span>
                            </li>
                            <li class="flex items-center gap-3">
                                <i data-lucide="phone" class="w-4 h-4 text-copper shrink-0"></i>
                                <span dir="ltr">+98 21 8888 1234</span>
                            </li>
                            <li class="flex items-center gap-3">
                                <i data-lucide="mail" class="w-4 h-4 text-copper shrink-0"></i>
                                <span>info@copperindustry.com</span>
                            </li>
                        </ul>
                    <?php endif; ?>

                    <?php if ( get_theme_mod( 'kermancopper_show_social', true ) ) : ?>
                    <div class="flex gap-3 mt-8">
                        <?php if ( $instagram = get_theme_mod( 'kermancopper_social_instagram' ) ) : ?>
                        <a href="<?php echo esc_url( $instagram ); ?>" target="_blank" class="w-8 h-8 rounded-sm bg-slate-100 flex items-center justify-center hover:bg-copper hover:text-white transition-all text-slate-400">
                            <i data-lucide="instagram" class="w-[14px] h-[14px]"></i>
                        </a>
                        <?php endif; ?>
                        <?php if ( $linkedin = get_theme_mod( 'kermancopper_social_linkedin' ) ) : ?>
                        <a href="<?php echo esc_url( $linkedin ); ?>" target="_blank" class="w-8 h-8 rounded-sm bg-slate-100 flex items-center justify-center hover:bg-copper hover:text-white transition-all text-slate-400">
                            <i data-lucide="linkedin" class="w-[14px] h-[14px]"></i>
                        </a>
                        <?php endif; ?>
                         <?php if ( $twitter = get_theme_mod( 'kermancopper_social_twitter' ) ) : ?>
                        <a href="<?php echo esc_url( $twitter ); ?>" target="_blank" class="w-8 h-8 rounded-sm bg-slate-100 flex items-center justify-center hover:bg-copper hover:text-white transition-all text-slate-400">
                            <i data-lucide="twitter" class="w-[14px] h-[14px]"></i>
                        </a>
                        <?php endif; ?>
                         <?php if ( $facebook = get_theme_mod( 'kermancopper_social_facebook' ) ) : ?>
                         <a href="<?php echo esc_url( $facebook ); ?>" target="_blank" class="w-8 h-8 rounded-sm bg-slate-100 flex items-center justify-center hover:bg-copper hover:text-white transition-all text-slate-400">
                            <i data-lucide="facebook" class="w-[14px] h-[14px]"></i>
                        </a>
                        <?php endif; ?>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
            <div class="border-t border-slate-100 py-8 flex flex-col md:flex-row justify-between items-center gap-4 text-[11px] text-slate-400 font-medium">
                <p><?php echo wp_kses_post( get_theme_mod( 'kermancopper_copyright_text', '© ۱۴۰۲ کلیه حقوق مادی و معنوی این سایت متعلق به شرکت صنایع مس می‌باشد.' ) ); ?></p>
                <div class="flex gap-6">
                    <span class="text-slate-500">طراحی و توسعه : <a href="https://ihasht.ir/" target="_blank" class="hover:text-copper transition-colors">هشت بهشت</a></span>
                </div>
            </div>
        </div>
    </footer>
    
    <!-- Back to Top Button -->
    <button id="back-to-top" class="fixed bottom-8 left-8 bg-copper text-white p-3 rounded-full shadow-lg opacity-0 translate-y-10 transition-all duration-300 z-50 hover:bg-slate-800">
        <i data-lucide="arrow-up" class="w-5 h-5"></i>
    </button>

    <?php wp_footer(); ?>
</body>
</html>
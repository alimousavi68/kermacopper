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

    <?php wp_footer(); ?>
</body>
</html>

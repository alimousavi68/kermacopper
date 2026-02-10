<?php get_header(); ?>

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

<?php get_footer(); ?>

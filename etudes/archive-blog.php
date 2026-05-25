<?php
$active_page = 'news';
$page_title = 'اخبار و رویدادها - صنایع و معادن مس کرمان زمین';
include 'header.php';
?>

    <!-- ARCHIVE HERO SECTION -->
    <header class="relative min-h-[450px] lg:min-h-[500px] flex items-center justify-center overflow-hidden bg-navy-dark pt-32 lg:pt-40 pb-16">
        <!-- Background Image -->
        <div class="absolute inset-0 w-full h-full">
            <img src="../images/pano sarcheshmeh.jpg" class="hero-bg-image w-full h-full object-cover opacity-35 mix-blend-overlay will-change-transform" alt="اخبار مس کرمان زمین">
            <div class="absolute inset-0 bg-gradient-to-t from-navy-dark via-navy-dark/70 to-transparent z-10"></div>
            <div class="absolute inset-0 bg-gradient-to-l from-navy-dark/50 via-transparent to-navy-dark/50 z-10"></div>

            <!-- Glow Accent -->
            <div class="absolute -top-[20%] left-1/2 -translate-x-1/2 w-[70%] h-[70%] bg-copper/20 rounded-full blur-[140px] z-15">
            </div>
        </div>

        <!-- Pattern Background -->
        <div class="absolute inset-0 bg-[radial-gradient(rgba(200,104,47,0.15)_1px,transparent_1px)] bg-[size:32px_32px] opacity-60 z-10">
        </div>

        <div class="container mx-auto px-6 lg:px-12 relative z-20 text-center font-peyda">
            <div class="inline-flex items-center gap-3 px-5 py-2.5 rounded-full glass-panel mb-6 border border-white/10 shadow-[0_8px_32px_0_rgba(0,0,0,0.2)] animate-fade-in-up delay-100 mx-auto">
                <i data-lucide="radio" class="w-4 h-4 text-copper-light"></i>
                <span class="text-copper-light text-xs font-extrabold tracking-widest">پایگاه اطلاع‌رسانی و مستندات</span>
            </div>

            <h1 class="text-4xl md:text-5xl lg:text-6xl font-black text-white leading-tight mb-4 animate-fade-in-up delay-200">
                اخبار و <span class="text-transparent bg-clip-text bg-gradient-to-l from-copper-dark via-copper to-copper-light">رویدادها</span>
            </h1>

            <p class="text-base text-slate-400 mx-auto font-light leading-relaxed animate-fade-in-up delay-300 mb-10">
                تازه‌ترین دستاوردها، اطلاعیه‌ها، و گزارش‌های عملکرد صنایع و معادن مس کرمان زمین در سطح ملی و بین‌المللی
            </p>
        </div>

        <!-- Bottom Curve -->
        <div class="hero-curve">
            <img src="../images/Union.png" srcset="../images/Union.png 1440w, ../images/Union-300x37.png 300w, ../images/Union-1024x127.png 1024w, ../images/Union-768x95.png 768w" sizes="(max-width: 1440px) 100vw, 1440px" class="hero-curve-image" alt="" />
            <a href="#posts-grid" class="hero-curve-arrow" aria-label="بخش بعدی">
                <i data-lucide="chevrons-down" class="hero-curve-arrow-icon"></i>
            </a>
        </div>
    </header>

    <!-- POSTS GRID SECTION -->
    <main id="posts-grid" class="relative z-20 pb-32 bg-gradient-to-b from-[#FAF8F5] via-white to-[#FAF8F5] pt-6 lg:pt-8">
        <!-- Dot Pattern Background -->
        <div class="absolute inset-0 bg-[radial-gradient(#c8c8c8_1px,transparent_1px)] bg-[size:24px_24px] opacity-30 pointer-events-none z-0">
        </div>

        <div class="container mx-auto px-6 lg:px-12 relative z-10">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 lg:gap-8">

                <!-- Main Content Column (News) -->
                <div class="lg:col-span-8">
                    <!-- Filters -->
                    <div class="flex flex-col sm:flex-row justify-between items-center mb-10 gap-6 scroll-reveal">
                        <h3 class="text-2xl font-black text-navy font-peyda">آخرین اخبار</h3>
                        <div class="flex flex-wrap justify-center bg-white p-1.5 rounded-2xl shadow-[0_8px_30px_rgb(0,0,0,0.04)] border border-slate-200">
                            <button class="px-5 py-2.5 rounded-xl font-bold text-sm bg-copper text-white shadow-[0_4px_15px_rgba(200,104,47,0.3)] transition-all">همه</button>
                            <button class="px-5 py-2.5 rounded-xl font-bold text-sm text-slate-500 hover:text-copper hover:bg-copper/5 transition-all hidden sm:block">اخبار شرکت</button>
                            <button class="px-5 py-2.5 rounded-xl font-bold text-sm text-slate-500 hover:text-copper hover:bg-copper/5 transition-all hidden sm:block">مسئولیت اجتماعی</button>
                            <button class="px-5 py-2.5 rounded-xl font-bold text-sm text-slate-500 hover:text-copper hover:bg-copper/5 transition-all">بیشتر <i data-lucide="chevron-down" class="inline w-4 h-4"></i></button>
                        </div>
                    </div>

                    <!-- Bento Posts Grid -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-8">

                        <!-- Featured Post -->
                        <article class="sm:col-span-2 post-card scroll-reveal delay-100 relative group cursor-pointer" onclick="window.location.href='single-post.php'">
                            <div class="relative h-[320px] sm:h-[400px] lg:h-[500px] w-full overflow-hidden bg-navy-dark">
                                <img src="../images/about/realistic_mine.png" alt="Featured News" class="post-image w-full h-full object-cover">
                                <div class="absolute inset-0 bg-gradient-to-t from-navy/90 via-navy/30 to-transparent"></div>
                                <div class="absolute top-6 right-6 post-category-badge px-4 py-2 rounded-xl text-xs font-bold font-peyda shadow-sm">
                                    <span class="flex items-center gap-2"><span class="w-2 h-2 rounded-full bg-copper animate-pulse"></span> اخبار ویژه</span>
                                </div>
                                <div class="absolute bottom-6 right-6 left-6 text-white font-peyda">
                                    <div class="flex items-center gap-4 text-xs font-medium text-slate-300 mb-3 font-sans">
                                        <span class="flex items-center gap-1"><i data-lucide="calendar" class="w-3.5 h-3.5"></i> ۲۴ اردیبهشت ۱۴۰۴</span>
                                        <span class="w-1 h-1 bg-slate-500 rounded-full"></span>
                                        <span class="flex items-center gap-1"><i data-lucide="clock" class="w-3.5 h-3.5"></i> ۵ دقیقه مطالعه</span>
                                    </div>
                                    <h2 class="text-2xl sm:text-3xl font-black mb-4 leading-tight group-hover:text-copper-light transition-colors">
                                        افتتاح فاز جدید کارخانه تغلیظ مس سرچشمه با تکیه بر دانش بومی</h2>
                                    <p class="text-slate-300 text-sm font-sans font-light line-clamp-2 hidden sm:block max-w-3xl">
                                        با حضور مقامات کشوری و استانی، فاز سوم توسعه کارخانجات تغلیظ مجتمع مس سرچشمه با هدف افزایش ظرفیت تولید کنسانتره و کاهش مصرف آب و انرژی با موفقیت به بهره‌برداری رسید.
                                    </p>
                                </div>
                            </div>
                        </article>

                        <!-- Standard Post 1 -->
                        <article class="post-card scroll-reveal delay-200 cursor-pointer" onclick="window.location.href='single-post.php'">
                            <div class="relative h-56 w-full overflow-hidden">
                                <img src="../images/about/realistic_foundry.png" alt="News Image" class="post-image w-full h-full object-cover">
                                <div class="absolute top-4 right-4 post-category-badge px-3 py-1.5 rounded-lg text-xs font-bold font-peyda shadow-sm">تولید و صنعت</div>
                            </div>
                            <div class="p-6 flex flex-col flex-grow">
                                <div class="flex items-center gap-3 text-xs font-medium text-slate-400 mb-3 font-sans">
                                    <span class="flex items-center gap-1"><i data-lucide="calendar" class="w-3 h-3"></i> ۱۸ اردیبهشت ۱۴۰۴</span>
                                </div>
                                <h3 class="font-peyda text-lg font-black text-navy mb-3 leading-snug group-hover:text-copper transition-colors">رکوردشکنی تولید کاتد مس در سه‌ماهه نخست سال جاری</h3>
                                <p class="text-slate-600 text-sm font-semibold font-sans line-clamp-3 mb-6">
                                    تولید مس کاتدی در پالایشگاه مجتمع سرچشمه با ثبت رکوردی بی‌سابقه، رشد ۱۵ درصدی نسبت به مدت مشابه سال قبل را نشان می‌دهد.
                                </p>
                                <div class="mt-auto flex items-center text-copper font-bold text-xs uppercase tracking-wider group/link">
                                    مطالعه بیشتر <i data-lucide="arrow-left" class="w-4 h-4 mr-2 transition-transform group-hover/link:-translate-x-1"></i>
                                </div>
                            </div>
                        </article>

                        <!-- Standard Post 2 -->
                        <article class="post-card scroll-reveal delay-100 cursor-pointer" onclick="window.location.href='single-post.php'">
                            <div class="relative h-56 w-full overflow-hidden">
                                <img src="../images/about/mes-premium.png" alt="News Image" class="post-image w-full h-full object-cover">
                                <div class="absolute top-4 right-4 post-category-badge px-3 py-1.5 rounded-lg text-xs font-bold font-peyda shadow-sm">گزارشات بورسی</div>
                            </div>
                            <div class="p-6 flex flex-col flex-grow">
                                <div class="flex items-center gap-3 text-xs font-medium text-slate-400 mb-3 font-sans">
                                    <span class="flex items-center gap-1"><i data-lucide="calendar" class="w-3 h-3"></i> ۱۲ اردیبهشت ۱۴۰۴</span>
                                </div>
                                <h3 class="font-peyda text-lg font-black text-navy mb-3 leading-snug group-hover:text-copper transition-colors">عرضه موفق شمش مس در بورس کالای ایران</h3>
                                <p class="text-slate-600 text-sm font-semibold font-sans line-clamp-3 mb-6">
                                    با تقاضای بالای صنایع پایین‌دستی، تمامی محموله‌های عرضه شده مس کرمان در بورس کالا با موفقیت و رقابت قیمتی به فروش رسید.
                                </p>
                                <div class="mt-auto flex items-center text-copper font-bold text-xs uppercase tracking-wider group/link">
                                    مطالعه بیشتر <i data-lucide="arrow-left" class="w-4 h-4 mr-2 transition-transform group-hover/link:-translate-x-1"></i>
                                </div>
                            </div>
                        </article>

                        <!-- Standard Post 3 -->
                        <article class="post-card scroll-reveal delay-200 cursor-pointer" onclick="window.location.href='single-post.php'">
                            <div class="relative h-56 w-full overflow-hidden">
                                <img src="../images/image2.jpg" alt="News Image" class="post-image w-full h-full object-cover">
                                <div class="absolute top-4 right-4 post-category-badge px-3 py-1.5 rounded-lg text-xs font-bold font-peyda shadow-sm">مسئولیت اجتماعی</div>
                            </div>
                            <div class="p-6 flex flex-col flex-grow">
                                <div class="flex items-center gap-3 text-xs font-medium text-slate-400 mb-3 font-sans">
                                    <span class="flex items-center gap-1"><i data-lucide="calendar" class="w-3 h-3"></i> ۰۵ اردیبهشت ۱۴۰۴</span>
                                </div>
                                <h3 class="font-peyda text-lg font-black text-navy mb-3 leading-snug group-hover:text-copper transition-colors">آغاز طرح جامع جنگل‌کاری و احیای پوشش گیاهی منطقه</h3>
                                <p class="text-slate-600 text-sm font-semibold font-sans line-clamp-3 mb-6">
                                    در راستای توسعه پایدار و معدن‌کاری سبز، کاشت بیش از پنجاه هزار اصله نهال بومی سازگار با اقلیم در حاشیه مجتمع آغاز شد.
                                </p>
                                <div class="mt-auto flex items-center text-copper font-bold text-xs uppercase tracking-wider group/link">
                                    مطالعه بیشتر <i data-lucide="arrow-left" class="w-4 h-4 mr-2 transition-transform group-hover/link:-translate-x-1"></i>
                                </div>
                            </div>
                        </article>

                        <!-- Standard Post 4 -->
                        <article class="post-card scroll-reveal delay-300 cursor-pointer" onclick="window.location.href='single-post.php'">
                            <div class="relative h-56 w-full overflow-hidden bg-navy-light flex items-center justify-center">
                                <img src="../images/copper-sheet-bahonar.webp" alt="News Image" class="post-image w-full h-full object-cover opacity-80 mix-blend-luminosity">
                                <div class="absolute inset-0 bg-gradient-to-t from-navy to-transparent"></div>
                                <i data-lucide="play-circle" class="absolute w-12 h-12 text-white/80 z-10 drop-shadow-lg"></i>
                                <div class="absolute top-4 right-4 post-category-badge bg-rose-500/90 text-white border-none px-3 py-1.5 rounded-lg text-xs font-bold font-peyda shadow-sm flex items-center gap-1">
                                    <i data-lucide="video" class="w-3 h-3"></i> ویدیو
                                </div>
                            </div>
                            <div class="p-6 flex flex-col flex-grow">
                                <div class="flex items-center gap-3 text-xs font-medium text-slate-400 mb-3 font-sans">
                                    <span class="flex items-center gap-1"><i data-lucide="calendar" class="w-3 h-3"></i> ۲۸ فروردین ۱۴۰۴</span>
                                </div>
                                <h3 class="font-peyda text-lg font-black text-navy mb-3 leading-snug group-hover:text-copper transition-colors">مستند کوتاه: مسیر مس، از معدن تا کاتد</h3>
                                <p class="text-slate-600 text-sm font-semibold font-sans line-clamp-3 mb-6">
                                    نگاهی بصری به تلاش شبانه‌روزی مهندسان و کارگران در پروسه پیچیده استخراج و فرآوری سنگ مس در سرچشمه.
                                </p>
                                <div class="mt-auto flex items-center text-copper font-bold text-xs uppercase tracking-wider group/link">
                                    تماشا کنید <i data-lucide="arrow-left" class="w-4 h-4 mr-2 transition-transform group-hover/link:-translate-x-1"></i>
                                </div>
                            </div>
                        </article>

                    </div>

                    <!-- Pagination -->
                    <div class="flex justify-center items-center gap-2 mt-12 pt-8 border-t border-slate-200/60 scroll-reveal">
                        <button class="w-10 h-10 rounded-xl bg-white border border-slate-200 text-slate-400 flex items-center justify-center hover:text-copper hover:border-copper transition-colors shadow-sm disabled:opacity-50" disabled>
                            <i data-lucide="chevron-right" class="w-5 h-5"></i>
                        </button>
                        <button class="w-10 h-10 rounded-xl bg-copper text-white font-bold shadow-md">۱</button>
                        <button class="w-10 h-10 rounded-xl bg-white border border-slate-200 text-slate-600 font-bold hover:text-copper hover:border-copper transition-colors shadow-sm">۲</button>
                        <button class="w-10 h-10 rounded-xl bg-white border border-slate-200 text-slate-600 font-bold hover:text-copper hover:border-copper transition-colors shadow-sm">۳</button>
                        <span class="text-slate-400 font-bold px-2">...</span>
                        <button class="w-10 h-10 rounded-xl bg-white border border-slate-200 text-slate-400 flex items-center justify-center hover:text-copper hover:border-copper transition-colors shadow-sm">
                            <i data-lucide="chevron-left" class="w-5 h-5"></i>
                        </button>
                    </div>

                </div>

                <!-- Sidebar Column (Announcements) -->
                <div class="lg:col-span-4 lg:sticky lg:top-32 self-start scroll-reveal delay-200">
                    <div class="bg-white border border-slate-200/80 rounded-[2rem] p-6 sm:p-8 shadow-[0_15px_50px_rgba(0,0,0,0.03)] relative overflow-hidden">
                        <!-- Decorative bg -->
                        <div class="absolute -top-12 -right-12 w-32 h-32 bg-copper/5 rounded-full blur-2xl"></div>

                        <div class="flex items-center gap-3 mb-8 relative z-10">
                            <div class="w-12 h-12 rounded-xl bg-copper/10 text-copper flex items-center justify-center shadow-inner">
                                <i data-lucide="bell-ring" class="w-6 h-6"></i>
                            </div>
                            <h3 class="text-xl font-black text-navy font-peyda">اطلاعیه‌ها و فراخوان‌ها</h3>
                        </div>

                        <div class="flex flex-col gap-4 relative z-10">
                            <!-- Announcement 1 -->
                            <a href="#" class="bg-slate-50 border border-slate-100 rounded-2xl p-5 hover:bg-white hover:border-copper/40 hover:shadow-[0_10px_25px_rgba(200,104,47,0.1)] transition-all duration-300 group block">
                                <div class="flex items-start justify-between mb-3">
                                    <span class="bg-rose-100 text-rose-700 px-2.5 py-1 rounded-md text-[10px] font-bold font-peyda uppercase tracking-wider">مهم و فوری</span>
                                    <span class="text-slate-400 text-xs font-medium flex items-center gap-1"><i data-lucide="calendar" class="w-3 h-3"></i> ۲۵ اردیبهشت</span>
                                </div>
                                <h4 class="font-peyda text-base font-black text-navy mb-2 group-hover:text-copper transition-colors leading-snug">
                                    فراخوان ارزیابی کیفی پیمانکاران واجد شرایط</h4>
                                <p class="text-slate-500 text-xs font-semibold line-clamp-2 leading-relaxed">دعوت از شرکت‌های دارای رتبه یک و دو در رشته تاسیسات جهت شرکت در مناقصه احداث پایپینگ فاز سوم.</p>
                            </a>

                            <!-- Announcement 2 -->
                            <a href="#" class="bg-slate-50 border border-slate-100 rounded-2xl p-5 hover:bg-white hover:border-copper/40 hover:shadow-[0_10px_25px_rgba(200,104,47,0.1)] transition-all duration-300 group block">
                                <div class="flex items-start justify-between mb-3">
                                    <span class="bg-sky-100 text-sky-700 px-2.5 py-1 rounded-md text-[10px] font-bold font-peyda uppercase tracking-wider">استخدام</span>
                                    <span class="text-slate-400 text-xs font-medium flex items-center gap-1"><i data-lucide="calendar" class="w-3 h-3"></i> ۲۰ اردیبهشت</span>
                                </div>
                                <h4 class="font-peyda text-base font-black text-navy mb-2 group-hover:text-copper transition-colors leading-snug">
                                    آزمون استخدامی مجتمع مس سرچشمه (نوبت اول ۱۴۰۴)</h4>
                                <p class="text-slate-500 text-xs font-semibold line-clamp-2 leading-relaxed">آغاز ثبت نام فارغ‌التحصیلان بومی استان کرمان در مقاطع کارشناسی و کارشناسی ارشد مهندسی معدن.</p>
                            </a>

                            <!-- Announcement 3 -->
                            <a href="#" class="bg-slate-50 border border-slate-100 rounded-2xl p-5 hover:bg-white hover:border-copper/40 hover:shadow-[0_10px_25px_rgba(200,104,47,0.1)] transition-all duration-300 group block">
                                <div class="flex items-start justify-between mb-3">
                                    <span class="bg-emerald-100 text-emerald-700 px-2.5 py-1 rounded-md text-[10px] font-bold font-peyda uppercase tracking-wider">اطلاعیه عمومی</span>
                                    <span class="text-slate-400 text-xs font-medium flex items-center gap-1"><i data-lucide="calendar" class="w-3 h-3"></i> ۱۵ اردیبهشت</span>
                                </div>
                                <h4 class="font-peyda text-base font-black text-navy mb-2 group-hover:text-copper transition-colors leading-snug">
                                    تغییر ساعات کاری پرسنل ستادی در ایام تابستان</h4>
                                <p class="text-slate-500 text-xs font-semibold line-clamp-2 leading-relaxed">به منظور مدیریت مصرف انرژی, تغییر ساعات کاری دفاتر مرکزی و واحدهای ستادی مجتمع از تاریخ اول خرداد ماه.</p>
                            </a>

                            <!-- Announcement 4 -->
                            <a href="#" class="bg-slate-50 border border-slate-100 rounded-2xl p-5 hover:bg-white hover:border-copper/40 hover:shadow-[0_10px_25px_rgba(200,104,47,0.1)] transition-all duration-300 group block">
                                <div class="flex items-start justify-between mb-3">
                                    <span class="bg-purple-100 text-purple-700 px-2.5 py-1 rounded-md text-[10px] font-bold font-peyda uppercase tracking-wider">فرهنگی و ورزشی</span>
                                    <span class="text-slate-400 text-xs font-medium flex items-center gap-1"><i data-lucide="calendar" class="w-3 h-3"></i> ۱۰ اردیبهشت</span>
                                </div>
                                <h4 class="font-peyda text-base font-black text-navy mb-2 group-hover:text-copper transition-colors leading-snug">
                                    ثبت‌نام المپیاد ورزشی کارکنان و خانواده‌های مس</h4>
                                <p class="text-slate-500 text-xs font-semibold line-clamp-2 leading-relaxed">نهمین دوره المپیاد ورزشی در رشته‌های شنا، فوتسال، والیبال و شطرنج. مهلت ثبت نام تا پایان اردیبهشت.</p>
                            </a>
                        </div>

                        <div class="mt-6 pt-4 border-t border-slate-100 text-center relative z-10">
                            <a href="#" class="text-copper font-bold text-xs hover:text-copper-dark transition-colors inline-flex items-center gap-1">
                                مشاهده تمامی اطلاعیه‌ها <i data-lucide="arrow-left" class="w-3.5 h-3.5"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

<?php
include 'footer.php';
?>

<?php
$active_page = 'about';
$page_title = 'درباره ما - صنایع و معادن مس کرمان زمین';
include 'header.php';
?>

    <!-- ABOUT HERO SECTION -->
    <header class="relative min-h-[520px] flex items-center justify-center overflow-hidden bg-navy-dark pt-32 lg:pt-40 pb-16">
        <!-- Background Image -->
        <div class="absolute inset-0 w-full h-full">
            <img src="../images/pano sarcheshmeh.jpg" class="hero-bg-image w-full h-full object-cover opacity-35 mix-blend-overlay will-change-transform" alt="درباره مس کرمان زمین">
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
            <!-- Badge -->
            <div class="inline-flex items-center gap-3 px-5 py-2.5 rounded-full glass-panel mb-6 border border-white/10 shadow-[0_8px_32px_0_rgba(0,0,0,0.2)] animate-fade-in-up delay-100 mx-auto">
                <span class="text-copper-light text-xs font-extrabold tracking-widest">توسعه پایدار و اصالت ملی در صنعت مس</span>
            </div>

            <!-- Title -->
            <h1 class="text-4xl md:text-5xl lg:text-6xl font-black text-white leading-tight mb-4 animate-fade-in-up delay-200">
                ریشه در خاک، سرافراز در <span class="text-transparent bg-clip-text bg-gradient-to-l from-copper-dark via-copper to-copper-light">صنعت و نوآوری</span>
            </h1>

            <p class="text-base text-slate-400 mx-auto font-light leading-relaxed animate-fade-in-up delay-300 mb-20">
                صنایع و معادن مس کرمان زمین؛ نماد پایداری، خودکفایی علمی و بهره‌برداری پیشرفته از غنی‌ترین ذخایر زمین‌شناختی فلات مرکزی ایران
            </p>
        </div>

        <!-- Bottom Curve (Union image) -->
        <div class="hero-curve">
            <img src="../images/Union.png" srcset="../images/Union.png 1440w, ../images/Union-300x37.png 300w, ../images/Union-1024x127.png 1024w, ../images/Union-768x95.png 768w" sizes="(max-width: 1440px) 100vw, 1440px" class="hero-curve-image" alt="" />
            <a href="#content" class="hero-curve-arrow" aria-label="بخش بعدی">
                <i data-lucide="chevrons-down" class="hero-curve-arrow-icon"></i>
            </a>
        </div>
    </header>

    <!-- MAIN CONTENT SECTION -->
    <main id="content" class="relative z-20 pb-36 bg-gradient-to-b from-[#FAF8F5] via-white to-[#FAF8F5] pt-8 lg:pt-12">
        <!-- Traditional Kerman Pateh Shamseh Watermark in Background -->
        <div class="absolute left-[-100px] top-[15%] w-[500px] h-[500px] opacity-[0.025] text-navy pointer-events-none z-0 select-none">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 200 200" fill="none" stroke="currentColor" stroke-width="0.8" stroke-linecap="round" stroke-linejoin="round" class="w-full h-full">
                <circle cx="100" cy="100" r="15" />
                <circle cx="100" cy="100" r="8" />
                <path d="M 100 65 C 92 80, 108 80, 100 65 Z" />
                <path d="M 100 135 C 92 120, 108 120, 100 135 Z" />
                <path d="M 65 100 C 80 92, 80 108, 65 100 Z" />
                <path d="M 135 100 C 120 92, 120 108, 135 100 Z" />
                <polygon points="100,45 139,61 155,100 139,139 100,155 61,139 45,100 61,61" stroke-dasharray="4,4" />
                <path d="M 100 45 Q 110 25 100 10 Q 90 25 100 45" />
                <path d="M 100 155 Q 110 175 100 190 Q 90 175 100 155" />
                <path d="M 155 100 Q 175 110 190 100 Q 175 90 155 100" />
                <path d="M 45 100 Q 25 110 10 100 Q 25 90 45 100" />
            </svg>
        </div>

        <div class="container mx-auto px-6 lg:px-12 relative z-10">
            <!-- SECTION 1: HISTORY & BENTO GRID -->
            <section class="mb-32">
                <div class="text-center mb-16 scroll-reveal">
                    <span class="text-copper font-black text-sm tracking-wider uppercase block mb-3 font-peyda">ریشه‌ها و اصالت</span>
                    <h2 class="text-3xl md:text-4xl lg:text-5xl font-black text-navy font-peyda">میراث معدن‌کاری و سیر تاریخی</h2>
                    <div class="w-16 h-1 bg-copper mx-auto mt-4 rounded-full"></div>
                </div>

                <!-- Bento Grid Layout -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8 items-stretch">
                    <!-- Card 1: Ancient History (2 cols wide) -->
                    <div class="md:col-span-2 bento-card rounded-[2.5rem] p-8 sm:p-10 flex flex-col justify-between relative overflow-hidden scroll-reveal delay-75">
                        <div class="relative z-10">
                            <div class="w-12 h-12 rounded-2xl bg-copper/10 text-copper flex items-center justify-center mb-6">
                                <i data-lucide="history" class="w-6 h-6"></i>
                            </div>
                            <h3 class="font-peyda text-2xl font-black text-navy mb-4">مس کرمان؛ میراث ۶۰۰۰ ساله فلزکاری</h3>
                            <p class="text-slate-600 text-sm md:text-base leading-relaxed font-semibold mb-6">
                                کاوش‌های باستان‌شناختی در محوطه‌هایی همچون «تل ابلیس» و «تپه یحیی» گواه آن است که استان کرمان از نخستین خاستگاه‌های ذوب مس و متالورژی در جهان باستان بوده است. نیاکان ما در این دشت پهناور، قرن‌ها پیش از عصر صنعتی مدرن، با روش‌های سنتی اقدام به استخراج کانسارها و ساخت ابزار مفرغی و مسی و صادرات آن به تمدن‌های همسایه می‌کردند. این میراث تاریخی، الهام‌بخش ما در احیا و توسعه پیشرفته‌ترین روش‌های فرآوری فلز سرخ در عصر حاضر است.
                            </p>
                        </div>
                        <div class="flex items-center gap-4 text-xs font-black text-copper relative z-10">
                            <span>پیشینه کهن فلات ایران</span>
                            <span class="w-2 h-2 rounded-full bg-copper"></span>
                            <span>از تل ابلیس تا صنعت نوین</span>
                        </div>
                        <!-- Subtle graphic watermark in card background -->
                        <div class="absolute bottom-[-50px] left-[-50px] w-52 h-52 opacity-[0.05] pointer-events-none text-copper">
                            <i data-lucide="award" class="w-full h-full"></i>
                        </div>
                    </div>

                    <!-- Card 2: Discovery (1 col wide) -->
                    <div class="bento-card rounded-[2.5rem] p-8 flex flex-col justify-between scroll-reveal delay-150">
                        <div>
                            <div class="w-12 h-12 rounded-2xl bg-copper/10 text-copper flex items-center justify-center mb-6">
                                <i data-lucide="search" class="w-6 h-6"></i>
                            </div>
                            <h3 class="font-peyda text-xl font-black text-navy mb-4">اکتشاف ذخیره سرچشمه</h3>
                            <p class="text-slate-600 text-xs md:text-sm leading-relaxed font-semibold">
                                در اواخر دهه ۱۳۴۰ خورشیدی، وجود یک دگرسانی عظیم و کانسار مس پورفیری در دره سرچشمه کرمان با ارزیابی‌های ژئوشیمیایی و زمین‌شناختی پیشرفته تایید شد. این ذخیره بزرگ، با عیار متوسط بالا، یکی از غنی‌ترین و بزرگ‌ترین توده‌های معدنی مس جهان است که نقطه‌عطفی در ورود ایران به صنعت متالورژی سنگین گردید.
                            </p>
                        </div>
                        <div class="pt-6 border-t border-slate-100 flex items-center justify-between text-xs font-bold text-slate-500">
                            <span>آغاز مطالعات سیستماتیک</span>
                            <span class="text-copper">۱۳۴۶ خورشیدی</span>
                        </div>
                    </div>

                    <!-- Card 3: Modern Enterprise (1 col wide) -->
                    <div class="bento-card rounded-[2.5rem] p-8 flex flex-col justify-between scroll-reveal delay-75">
                        <div>
                            <div class="w-12 h-12 rounded-2xl bg-copper/10 text-copper flex items-center justify-center mb-6">
                                <i data-lucide="factory" class="w-6 h-6"></i>
                            </div>
                            <h3 class="font-peyda text-xl font-black text-navy mb-4">تجهیز و توسعه صنعتی</h3>
                            <p class="text-slate-600 text-xs md:text-sm leading-relaxed font-semibold">
                                به موازات پیشرفت طراحی‌ها، کارخانجات تغلیظ، ذوب و پالایشگاه الکترولیز مس به سرعت برنامه‌ریزی و احداث گردید تا چرخه استخراج تا شمش مس کاتدی در قلب استان کرمان تکمیل گردد. مس کرمان زمین امروزه با ارتقای دانش مهندسی و بازسازی تجهیزات، یکی از پیشتازان بازارهای منطقه‌ای است.
                            </p>
                        </div>
                        <div class="pt-6 border-t border-slate-100 flex items-center justify-between text-xs font-bold text-slate-500">
                            <span>ظرفیت تولید کاتد مس</span>
                            <span class="text-copper">مهم‌ترین هاب متالورژی ایران</span>
                        </div>
                    </div>

                    <!-- Card 4: Environmental & Region (2 cols wide) -->
                    <div class="md:col-span-2 bento-card rounded-[2.5rem] p-8 sm:p-10 flex flex-col justify-between relative overflow-hidden scroll-reveal delay-150">
                        <div class="relative z-10">
                            <div class="w-12 h-12 rounded-2xl bg-copper/10 text-copper flex items-center justify-center mb-6">
                                <i data-lucide="leaf" class="w-6 h-6"></i>
                            </div>
                            <h3 class="font-peyda text-2xl font-black text-navy mb-4">توسعه پایدار بومی و مسئولیت‌های زیست‌محیطی</h3>
                            <p class="text-slate-600 text-sm md:text-base leading-relaxed font-semibold mb-6">
                                ما متعهد به ایجاد هم‌زیستی مسالمت‌آمیز میان صنعت سنگین و حفظ اکوسیستم‌های طبیعی کرمان هستیم. احداث کارخانجات اسید سولفوریک با هدف پالایش کامل گازهای خروجی کوره، توسعه فناوری‌های بازیافت آب و کاهش نرخ مصرف انرژی الکتریکی در صنایع فرآوری، گامی جدی در جهت معدن‌کاری سبز است. همچنین پشتیبانی از پروژه‌های عمرانی منطقه و اشتغال‌زایی گسترده برای متخصصان و نخبگان استانی، اولویت کلیدی منشور اجتماعی ما است.
                            </p>
                        </div>
                        <div class="flex items-center gap-4 text-xs font-black text-copper relative z-10">
                            <span>پروژه‌های معدن‌کاری سبز</span>
                            <span class="w-2 h-2 rounded-full bg-copper"></span>
                            <span>مدیریت یکپارچه منابع آب و بازچرخانی</span>
                        </div>
                    </div>
                </div>
            </section>

            <!-- SECTION 2: VALUE CHAIN & OPERATIONAL PROCESSES -->
            <section class="mb-32">
                <div class="text-center mb-20 scroll-reveal">
                    <span class="text-copper font-black text-sm tracking-wider uppercase block mb-3 font-peyda">فرآیندها و دستاوردها</span>
                    <h2 class="text-3xl md:text-4xl lg:text-5xl font-black text-navy font-peyda">زنجیره کامل ارزش؛ از خاک تا کاتد مس</h2>
                    <div class="w-16 h-1 bg-copper mx-auto mt-4 rounded-full"></div>
                </div>

                <div class="space-y-16">
                    <!-- Step 1: Mining -->
                    <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-center scroll-reveal">
                        <div class="lg:col-span-6 relative rounded-[2rem] overflow-hidden shadow-[0_15px_45px_rgba(0,0,0,0.03)] border border-slate-200/60 bg-white">
                            <img src="../images/about/realistic_mine.png" alt="معدن‌کاری و استخراج مس" class="w-full h-[320px] object-cover hover:scale-105 transition-transform duration-700">
                            <div class="absolute top-6 right-6 bg-navy/95 backdrop-blur text-white text-xs font-black px-4 py-2 rounded-xl border border-white/10 font-peyda">
                                گام نخست: استخراج
                            </div>
                        </div>
                        <div class="lg:col-span-6 font-peyda">
                            <h3 class="text-2xl lg:text-3xl font-black text-navy mb-4 flex items-center gap-3">
                                <span class="w-8 h-8 rounded-xl bg-copper/10 text-copper flex items-center justify-center font-bold text-sm">۱</span>
                                استخراج و استخراج روباز (Mining)
                            </h3>
                            <p class="text-slate-600 text-sm md:text-base leading-relaxed font-semibold font-sans">
                                استخراج مواد معدنی کانسار پورفیری سرچشمه با روش استخراج روباز (Open-Pit Mining) در پله‌هایی با ارتفاع مناسب صورت می‌پذیرد. عملیات چال‌زنی، آتش‌باری سنگ‌های سخت و ترابری با غول‌پیکرترین کامیون‌های معدنی (دامپتراک) سنگ شکن‌ها را به کار می‌اندازد. نظارت مانیتورینگ آنلاین دیسپچینگ، ضامن امنیت و راندمان این فرآیند شبانه‌روزی است.
                            </p>
                        </div>
                    </div>

                    <!-- Step 2: Concentrator -->
                    <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-center scroll-reveal">
                        <div class="lg:col-span-6 lg:order-2 relative rounded-[2rem] overflow-hidden shadow-[0_15px_45px_rgba(0,0,0,0.03)] border border-slate-200/60 bg-white">
                            <img src="../images/about/image1.png" alt="تغلیظ مس" class="w-full h-[320px] object-cover hover:scale-105 transition-transform duration-700">
                            <div class="absolute top-6 right-6 bg-navy/95 backdrop-blur text-white text-xs font-black px-4 py-2 rounded-xl border border-white/10 font-peyda">
                                گام دوم: فرآوری و تغلیظ
                            </div>
                        </div>
                        <div class="lg:col-span-6 lg:order-1 font-peyda">
                            <h3 class="text-2xl lg:text-3xl font-black text-navy mb-4 flex items-center gap-3">
                                <span class="w-8 h-8 rounded-xl bg-copper/10 text-copper flex items-center justify-center font-bold text-sm">۲</span>
                                تغلیظ سنگ مس (Concentration)
                            </h3>
                            <p class="text-slate-600 text-sm md:text-base leading-relaxed font-semibold font-sans">
                                سنگ معدن خرد شده در آسیاب‌های گلوله‌ای و نیمه‌خودشناور به ابعاد میکرومتری خرد می‌شود. سپس در سلول‌های فلوتاسیون با افزودن شناورکننده‌های شیمیایی، ذرات مسدار از باطله جدا شده و عیار مس سنگ خام از ۰.۶ درصد به ۲۸ درصد در قالب کنسانتره مس صعود می‌کند.
                            </p>
                        </div>
                    </div>

                    <!-- Step 3: Smelter -->
                    <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-center scroll-reveal">
                        <div class="lg:col-span-6 relative rounded-[2rem] overflow-hidden shadow-[0_15px_45px_rgba(0,0,0,0.03)] border border-slate-200/60 bg-white">
                            <img src="../images/about/realistic_foundry.png" alt="ذوب مس" class="w-full h-[320px] object-cover hover:scale-105 transition-transform duration-700">
                            <div class="absolute top-6 right-6 bg-navy/95 backdrop-blur text-white text-xs font-black px-4 py-2 rounded-xl border border-white/10 font-peyda">
                                گام سوم: ذوب و ریخته‌گری
                            </div>
                        </div>
                        <div class="lg:col-span-6 font-peyda">
                            <h3 class="text-2xl lg:text-3xl font-black text-navy mb-4 flex items-center gap-3">
                                <span class="w-8 h-8 rounded-xl bg-copper/10 text-copper flex items-center justify-center font-bold text-sm">۳</span>
                                ذوب و تولید آند (Smelting)
                            </h3>
                            <p class="text-slate-600 text-sm md:text-base leading-relaxed font-semibold font-sans">
                                کنسانتره مس تغلیظ شده در کوره‌های پیشرفته شعله‌ای و فلش حرارت داده شده تا ناخالصی‌ها در قالب سرباره تخلیه و مس مات با عیار بالای ۶۰ درصد حاصل شود. در مرحله بعد با فرآیند دمیدن اکسیژن در کانورترها، مس تاول‌زا تولید شده و سرانجام مس آندی با خلوص ۹۹.۳ درصد برای ریخته‌گری در چرخ آند ریخته می‌شود.
                            </p>
                        </div>
                    </div>

                    <!-- Step 4: Refinery -->
                    <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-center scroll-reveal">
                        <div class="lg:col-span-6 lg:order-2 relative rounded-[2rem] overflow-hidden shadow-[0_15px_45px_rgba(0,0,0,0.03)] border border-slate-200/60 bg-white">
                            <img src="../images/about/mes-premium.png" alt="کاتد مس پالایش شده" class="w-full h-[320px] object-cover hover:scale-105 transition-transform duration-700">
                            <div class="absolute top-6 right-6 bg-navy/95 backdrop-blur text-white text-xs font-black px-4 py-2 rounded-xl border border-white/10 font-peyda">
                                گام چهارم: الکترولیز و کاتد
                            </div>
                        </div>
                        <div class="lg:col-span-6 lg:order-1 font-peyda">
                            <h3 class="text-2xl lg:text-3xl font-black text-navy mb-4 flex items-center gap-3">
                                <span class="w-8 h-8 rounded-xl bg-copper/10 text-copper flex items-center justify-center font-bold text-sm">۴</span>
                                تصفیه الکترولیتی و کاتد مس (Refining)
                            </h3>
                            <p class="text-slate-600 text-sm md:text-base leading-relaxed font-semibold font-sans">
                                در آخرین مرحله از زنجیره تولید، صفحات آند مس در وان‌های الکترولیت حاوی سولفات مس قرار گرفته و با اعمال جریان الکتریکی، یون‌های خالص مس به سمت ورقه‌های کاتد جذب می‌شوند. محصول نهایی، کاتد مس با خلوص عالی ۹۹.۹۹ درصد است که آماده عرضه در بورس کالا و بازارهای صادراتی جهانی است.
                            </p>
                        </div>
                    </div>
                </div>
            </section>

            <!-- SECTION 3: VISION, CORE VALUES & ENVIRONMENT -->
            <section class="bg-navy rounded-[3rem] p-8 sm:p-12 lg:p-16 text-white relative overflow-hidden scroll-reveal">
                <!-- Decorative background elements -->
                <div class="absolute top-[-50%] right-[-20%] w-[70%] h-[100%] bg-copper/10 rounded-full blur-[120px] pointer-events-none"></div>
                <div class="absolute bottom-[-40%] left-[-10%] w-[50%] h-[80%] bg-sky-600/10 rounded-full blur-[100px] pointer-events-none"></div>

                <div class="relative z-10 grid grid-cols-1 lg:grid-cols-12 gap-12 items-center">
                    <div class="lg:col-span-5 font-peyda">
                        <span class="text-copper-light text-xs font-black uppercase tracking-wider block mb-3">چشم‌انداز و استراتژی</span>
                        <h2 class="text-3xl lg:text-4xl font-black mb-6 leading-tight">با تکیه بر خودباوری ملی، مس‌آفرین آینده کشوریم</h2>
                        <p class="text-slate-400 text-sm md:text-base leading-relaxed font-light font-sans mb-8">
                            صنایع و معادن مس کرمان زمین مصمم است با تکیه بر توان داخلی و پیاده‌سازی فناوری‌های هوش مصنوعی معدنی، فرآیندهای سنتی را دگرگون ساخته و تولید پایدار خود را به تراز بین‌المللی برساند.
                        </p>
                        <div class="flex gap-4">
                            <a href="contact.php" class="bg-copper hover:bg-copper-light text-white px-6 py-3 rounded-full text-sm font-bold transition-all shadow-[0_10px_25px_rgba(200,104,47,0.3)] hover:-translate-y-1">تماس مستقیم با ما</a>
                            <a href="front-page.php#news" class="border border-white/20 hover:bg-white hover:text-navy text-white px-6 py-3 rounded-full text-sm font-bold transition-all hover:-translate-y-1">اخبار و رویدادها</a>
                        </div>
                    </div>

                    <div class="lg:col-span-7 grid grid-cols-1 sm:grid-cols-2 gap-6 font-sans">
                        <!-- Value 1 -->
                        <div class="bg-white/5 border border-white/10 rounded-2xl p-6 backdrop-blur">
                            <div class="w-10 h-10 rounded-xl bg-copper/20 text-copper flex items-center justify-center mb-4">
                                <i data-lucide="shield-check" class="w-5 h-5"></i>
                            </div>
                            <h4 class="font-peyda text-lg font-black text-white mb-2">تعهد به کیفیت مطلق</h4>
                            <p class="text-slate-400 text-xs leading-relaxed font-semibold">تولیدات ما طبق آخرین استانداردهای LME بوده و در بازارهای جهانی قابل رقابت است.</p>
                        </div>

                        <!-- Value 2 -->
                        <div class="bg-white/5 border border-white/10 rounded-2xl p-6 backdrop-blur">
                            <div class="w-10 h-10 rounded-xl bg-copper/20 text-copper flex items-center justify-center mb-4">
                                <i data-lucide="users" class="w-5 h-5"></i>
                            </div>
                            <h4 class="font-peyda text-lg font-black text-white mb-2">توسعه سرمایه انسانی</h4>
                            <p class="text-slate-400 text-xs leading-relaxed font-semibold">ایجاد زمینه رشد تخصصی برای هزاران جوان بااستعداد بومی استان کرمان.</p>
                        </div>

                        <!-- Value 3 -->
                        <div class="bg-white/5 border border-white/10 rounded-2xl p-6 backdrop-blur">
                            <div class="w-10 h-10 rounded-xl bg-copper/20 text-copper flex items-center justify-center mb-4">
                                <i data-lucide="sprout" class="w-5 h-5"></i>
                            </div>
                            <h4 class="font-peyda text-lg font-black text-white mb-2">حفظ محیط زیست کرمان</h4>
                            <p class="text-slate-400 text-xs leading-relaxed font-semibold">کاهش آلایندگی با سیستم‌های کنترل آنلاین و فیلتراسیون کوره ذوب.</p>
                        </div>

                        <!-- Value 4 -->
                        <div class="bg-white/5 border border-white/10 rounded-2xl p-6 backdrop-blur">
                            <div class="w-10 h-10 rounded-xl bg-copper/20 text-copper flex items-center justify-center mb-4">
                                <i data-lucide="award" class="w-5 h-5"></i>
                            </div>
                            <h4 class="font-peyda text-lg font-black text-white mb-2">رونق بازارهای ملی</h4>
                            <p class="text-slate-400 text-xs leading-relaxed font-semibold">تضمین تامین پایدار مواد اولیه برای صنایع پایین‌دستی برق، فولاد و الکترونیک.</p>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </main>

<?php
include 'footer.php';
?>

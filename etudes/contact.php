<?php
$active_page = 'contact';
$page_title = 'تماس با ما - صنایع و معادن مس کرمان زمین';
include 'header.php';
?>

    <!-- CONTACT HERO SECTION -->
    <header class="relative min-h-[520px] flex items-center justify-center overflow-hidden bg-navy-dark pt-32 lg:pt-40 pb-16">
        <!-- Background Image -->
        <div class="absolute inset-0 w-full h-full">
            <img src="../images/pano sarcheshmeh.jpg" class="hero-bg-image w-full h-full object-cover opacity-35 mix-blend-overlay will-change-transform" alt="تماس با ما">
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
                <span class="text-copper-light text-xs font-extrabold tracking-widest">ارتباط مستقیم با صنایع و معادن مس کرمان زمین</span>
            </div>

            <!-- Title -->
            <h1 class="text-4xl md:text-5xl lg:text-6xl font-black text-white leading-tight mb-4 animate-fade-in-up delay-200">
                همواره پاسخگوی <span class="text-transparent bg-clip-text bg-gradient-to-l from-copper-dark via-copper to-copper-light">شما هستیم</span>
            </h1>

            <p class="text-base text-slate-400 mx-auto font-light leading-relaxed animate-fade-in-up delay-300 mb-20">
                درگاه ارتباط مستقیم با واحد روابط عمومی، بخش فروش و مناقصات، دفتر مرکزی و کارخانجات مجتمع مس کرمان زمین
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
        <div class="absolute right-[-100px] top-[10%] w-[500px] h-[500px] opacity-[0.02] text-navy pointer-events-none z-0 select-none">
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
            <!-- Row 1: Office Details & Department Direct Numbers -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-16">

                <!-- Tehran Central Office -->
                <div class="bg-white border border-slate-200/80 rounded-[2rem] p-8 hover-lift flex flex-col justify-between shadow-[0_8px_30px_rgba(0,0,0,0.02)] scroll-reveal delay-75">
                    <div>
                        <div class="w-14 h-14 rounded-2xl bg-copper/10 text-copper flex items-center justify-center mb-6">
                            <i data-lucide="building-2" class="w-6 h-6"></i>
                        </div>
                        <h4 class="font-peyda text-xl font-black text-navy mb-3">دفتر مرکزی تهران</h4>
                        <p class="text-sm text-slate-600 leading-relaxed font-semibold mb-6">
                            خیابان ولیعصر، نرسیده به میدان ونک، خیابان عباسپور، پلاک ۲۴، ساختمان کرمان زمین
                        </p>
                    </div>
                    <div class="space-y-3 pt-6 border-t border-slate-100 text-sm font-bold text-slate-700" dir="ltr">
                        <div class="flex items-center justify-between">
                            <span>۰۲۱ - ۸۸۷۱ ۵۰۰۲</span>
                            <span class="text-copper">تلفن:</span>
                        </div>
                        <div class="flex items-center justify-between">
                            <span>۰۲۱ - ۸۸۷۱ ۵۰۰۴</span>
                            <span class="text-copper">فکس:</span>
                        </div>
                    </div>
                </div>

                <!-- Kerman / Sarcheshmeh Office -->
                <div class="bg-white border border-slate-200/80 rounded-[2rem] p-8 hover-lift flex flex-col justify-between shadow-[0_8px_30px_rgba(0,0,0,0.02)] scroll-reveal delay-150">
                    <div>
                        <div class="w-14 h-14 rounded-2xl bg-copper/10 text-copper flex items-center justify-center mb-6">
                            <i data-lucide="factory" class="w-6 h-6"></i>
                        </div>
                        <h4 class="font-peyda text-xl font-black text-navy mb-3">دفتر مجتمع سرچشمه</h4>
                        <p class="text-sm text-slate-600 leading-relaxed font-semibold mb-6">
                            استان کرمان، ۵۰ کیلومتری شهرستان رفسنجان، مجتمع معدنی و صنعتی مس سرچشمه
                        </p>
                    </div>
                    <div class="space-y-3 pt-6 border-t border-slate-100 text-sm font-bold text-slate-700" dir="ltr">
                        <div class="flex items-center justify-between">
                            <span>۰۳۴ - ۳۴۳۰ ۰۰۰۰</span>
                            <span class="text-copper">تلفنخانه:</span>
                        </div>
                        <div class="flex items-center justify-between">
                            <span>۰۳۴ - ۳۴۳۰ ۲۲۲۲</span>
                            <span class="text-copper">روابط عمومی:</span>
                        </div>
                    </div>
                </div>

                <!-- Direct Departments Phone Book -->
                <div class="bg-white border border-slate-200/80 rounded-[2rem] p-8 shadow-[0_8px_30px_rgba(0,0,0,0.02)] relative overflow-hidden flex flex-col justify-between scroll-reveal delay-200">
                    <h4 class="font-peyda text-xl font-black text-navy mb-6 flex items-center gap-3">
                        <i data-lucide="phone-forwarded" class="text-copper w-5 h-5"></i> تماس با دپارتمان‌ها
                    </h4>

                    <div class="space-y-3 flex-1 flex flex-col justify-center">
                        <!-- sales -->
                        <div class="flex items-center justify-between p-3.5 rounded-xl bg-slate-50 border border-slate-100 hover:border-copper/30 transition-all">
                            <div class="text-right">
                                <h5 class="text-xs font-black text-navy">امور بازرگانی و فروش</h5>
                            </div>
                            <a href="tel:02188715002" class="text-xs font-bold text-copper hover:text-copper-light transition-colors" dir="ltr">داخلی ۱۰۴</a>
                        </div>

                        <!-- tenders -->
                        <div class="flex items-center justify-between p-3.5 rounded-xl bg-slate-50 border border-slate-100 hover:border-copper/30 transition-all">
                            <div class="text-right">
                                <h5 class="text-xs font-black text-navy">امور قراردادها و مناقصات</h5>
                            </div>
                            <a href="tel:02188715002" class="text-xs font-bold text-copper hover:text-copper-light transition-colors" dir="ltr">داخلی ۱۱۲</a>
                        </div>

                        <!-- PR -->
                        <div class="flex items-center justify-between p-3.5 rounded-xl bg-slate-50 border border-slate-100 hover:border-copper/30 transition-all">
                            <div class="text-right">
                                <h5 class="text-xs font-black text-navy">روابط عمومی و رسانه</h5>
                            </div>
                            <a href="tel:02188715002" class="text-xs font-bold text-copper hover:text-copper-light transition-colors" dir="ltr">داخلی ۱۰۱</a>
                        </div>
                    </div>
                </div>

            </div>

            <!-- Row 2: Form and Map (Balanced Side-by-Side) -->
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-stretch mt-20">

                <!-- Right Column: Interactive Premium Contact Form -->
                <section class="lg:col-span-5 bg-white p-8 sm:p-10 rounded-[2.5rem] shadow-[0_15px_50px_rgba(0,0,0,0.04)] border border-slate-200/80 relative overflow-hidden flex flex-col justify-center scroll-reveal delay-75">
                    <h3 class="font-peyda text-2xl font-black text-navy mb-2 flex items-center gap-3">
                        <span class="w-6 h-1 rounded-full bg-copper"></span> ارسال پیام مستقیم
                    </h3>
                    <p class="text-sm text-slate-500 mb-8 font-medium">فرم زیر را تکمیل کنید تا کارشناسان ما در سریع‌ترین زمان با شما تماس بگیرند.</p>

                    <form id="contactForm" class="space-y-6 relative z-10" onsubmit="handleFormSubmit(event)">
                        <!-- Name Input -->
                        <div class="relative group">
                            <input type="text" id="name" required class="peer w-full bg-slate-50/50 border border-slate-200 rounded-2xl px-6 py-4 text-navy placeholder-transparent focus:outline-none focus:border-copper focus:bg-white transition-all font-semibold" placeholder="نام و نام خانوادگی">
                            <label for="name" class="absolute right-6 top-4 text-slate-400 bg-transparent px-1 text-sm font-bold transition-all duration-300 pointer-events-none
                                peer-focus:-top-2.5 peer-focus:text-xs peer-focus:text-copper peer-focus:bg-white
                                peer-[:not(:placeholder-shown)]:-top-2.5 peer-[:not(:placeholder-shown)]:text-xs peer-[:not(:placeholder-shown)]:bg-white">نام و نام خانوادگی *</label>
                        </div>

                        <!-- Email/Phone Input -->
                        <div class="relative group">
                            <input type="text" id="contact_info" required class="peer w-full bg-slate-50/50 border border-slate-200 rounded-2xl px-6 py-4 text-navy placeholder-transparent focus:outline-none focus:border-copper focus:bg-white transition-all font-semibold" placeholder="شماره تماس یا ایمیل">
                            <label for="contact_info" class="absolute right-6 top-4 text-slate-400 bg-transparent px-1 text-sm font-bold transition-all duration-300 pointer-events-none
                                peer-focus:-top-2.5 peer-focus:text-xs peer-focus:text-copper peer-focus:bg-white
                                peer-[:not(:placeholder-shown)]:-top-2.5 peer-[:not(:placeholder-shown)]:text-xs peer-[:not(:placeholder-shown)]:bg-white">شماره موبایل یا ایمیل *</label>
                        </div>

                        <!-- Subject Dropdown -->
                        <div class="relative group">
                            <select id="subject" required class="w-full bg-slate-50/50 border border-slate-200 rounded-2xl px-6 py-4 text-slate-700 focus:outline-none focus:border-copper focus:bg-white transition-all font-semibold appearance-none cursor-pointer">
                                <option value="" disabled selected class="text-slate-400">موضوع پیام را انتخاب کنید</option>
                                <option value="public_relations" class="text-navy">روابط عمومی و رسانه</option>
                                <option value="tenders" class="text-navy">مناقصات و مزایدات</option>
                                <option value="sales" class="text-navy">فروش و بازرگانی</option>
                                <option value="human_resources" class="text-navy">استخدام و منابع انسانی</option>
                                <option value="other" class="text-navy">سایر موضوعات</option>
                            </select>
                            <label for="subject" class="absolute right-6 -top-2.5 bg-white px-2 text-xs text-slate-400 group-focus-within:text-copper font-bold transition-colors">بخش مربوطه *</label>
                            <div class="absolute left-6 top-4 pointer-events-none text-slate-400 group-focus-within:text-copper transition-colors">
                                <i data-lucide="chevron-down" class="w-5 h-5"></i>
                            </div>
                        </div>

                        <!-- Message TextArea -->
                        <div class="relative group">
                            <textarea id="message" rows="4" required class="peer w-full bg-slate-50/50 border border-slate-200 rounded-2xl px-6 py-4 text-navy placeholder-transparent focus:outline-none focus:border-copper focus:bg-white transition-all resize-none font-semibold" placeholder="متن پیام"></textarea>
                            <label for="message" class="absolute right-6 top-4 text-slate-400 bg-transparent px-1 text-sm font-bold transition-all duration-300 pointer-events-none
                                peer-focus:-top-2.5 peer-focus:text-xs peer-focus:text-copper peer-focus:bg-white
                                peer-[:not(:placeholder-shown)]:-top-2.5 peer-[:not(:placeholder-shown)]:text-xs peer-[:not(:placeholder-shown)]:bg-white">متن پیام شما *</label>
                        </div>

                        <!-- Submit Button -->
                        <button type="submit" class="w-full bg-gradient-to-r from-copper-dark via-copper to-copper-light text-white font-black text-lg py-5 rounded-2xl transition-all shadow-[0_10px_30px_rgba(200,104,47,0.3)] hover:shadow-[0_15px_40px_rgba(200,104,47,0.5)] hover:-translate-y-1 mt-4 group relative overflow-hidden">
                            <span class="absolute inset-0 bg-white/20 translate-y-full group-hover:translate-y-0 transition-transform duration-500 ease-out"></span>
                            <span class="relative flex items-center justify-center gap-2">
                                ارسال نهایی پیام <i data-lucide="send" class="w-5 h-5 transition-transform duration-300 group-hover:-translate-y-1 group-hover:translate-x-1"></i>
                            </span>
                        </button>
                    </form>

                    <!-- Form Success Message -->
                    <div id="formSuccess" class="hidden mt-6 p-5 rounded-2xl bg-emerald-50 border border-emerald-200 text-emerald-600 text-sm font-bold flex items-center gap-3">
                        <i data-lucide="check-circle" class="w-5 h-5 flex-shrink-0"></i>
                        <span>پیام شما با موفقیت ثبت شد. به زودی با شما تماس می‌گیریم.</span>
                    </div>
                </section>

                <!-- Left Column: Styled Map (Matches Form Height on Row 1) -->
                <section class="lg:col-span-7 flex flex-col justify-between scroll-reveal delay-150">
                    <!-- Light Styled Map Card -->
                    <div class="w-full h-full min-h-[450px] rounded-[2.5rem] overflow-hidden relative group border border-slate-200/80 shadow-[0_15px_50px_rgba(0,0,0,0.04)] z-10 bg-[#F5F2EB] flex items-center justify-center">
                        <img src="../images/map-kerman.png" alt="موقعیت مجتمع مس سرچشمه" class="absolute inset-0 w-full h-full object-cover group-hover:scale-102 transition-transform duration-1000">
                        <div class="absolute inset-0 bg-gradient-to-t from-orange-950/10 via-transparent to-transparent pointer-events-none">
                        </div>

                        <!-- Pulse Pin -->
                        <div class="absolute top-[53%] left-[44%] -translate-x-1/2 -translate-y-1/2 flex flex-col items-center">
                            <div class="w-16 h-16 rounded-full bg-copper/20 flex items-center justify-center animate-pulse">
                                <div class="w-10 h-10 rounded-full bg-copper flex items-center justify-center shadow-[0_0_20px_rgba(200,104,47,0.8)]">
                                    <i data-lucide="map-pin" class="w-5 h-5 text-white"></i>
                                </div>
                            </div>
                            <div class="mt-4 bg-white/90 backdrop-blur-md border border-[#E28652]/30 px-4 py-2 rounded-xl text-navy font-black text-xs shadow-lg pointer-events-none font-peyda">
                                مجتمع صنایع مس سرچشمه کرمان
                            </div>
                        </div>
                    </div>
                </section>

            </div>
        </div>
    </main>

<?php
include 'footer.php';
?>

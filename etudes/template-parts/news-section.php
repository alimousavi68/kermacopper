    <!-- NEWS & ANNOUNCEMENTS SECTION -->
    <section id="news" class="py-32 bg-navy relative overflow-hidden scroll-reveal">
        <!-- Ambient Background Glows -->
        <div class="absolute top-0 right-0 w-[600px] h-[600px] bg-copper/5 rounded-full blur-[120px] pointer-events-none">
        </div>
        <div class="absolute bottom-0 left-0 w-[500px] h-[500px] bg-sky-500/5 rounded-full blur-[100px] pointer-events-none">
        </div>

        <div class="container mx-auto px-6 lg:px-12 relative z-10">
            <div class="text-center mb-16 fade-up-element opacity-0 translate-y-10 transition-all duration-1000 ease-out">
                <h4 class="text-copper font-bold tracking-widest mb-4 flex items-center justify-center gap-4 font-peyda">
                    <span class="w-12 h-0.5 bg-copper"></span> پایگاه خبری و اطلاع‌رسانی <span class="w-12 h-0.5 bg-copper"></span>
                </h4>
                <h2 class="text-4xl lg:text-5xl font-black text-white tracking-tight font-peyda">تازه‌ترین اخبار و اطلاعیه‌ها</h2>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 lg:gap-12 items-stretch">
                <!-- Latest News -->
                <div class="lg:col-span-8 flex flex-col fade-up-element opacity-0 translate-y-10 transition-all duration-1000 delay-[200ms] ease-out h-full">
                    <div class="flex items-center justify-between mb-8">
                        <h3 class="text-2xl font-black text-white font-peyda flex items-center gap-3">
                            <div class="w-10 h-10 rounded-xl bg-white/5 border border-white/10 flex items-center justify-center text-copper shadow-inner">
                                <i data-lucide="newspaper" class="w-5 h-5"></i>
                            </div>
                            اخبار و رویدادها
                        </h3>
                        <a href="archive-blog.php" class="text-slate-400 hover:text-copper transition-colors text-sm font-bold flex items-center gap-1 group/link">آرشیو اخبار <i data-lucide="arrow-left" class="w-4 h-4 transition-transform group-hover/link:-translate-x-1"></i></a>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 flex-1">
                        <!-- Featured News -->
                        <a href="single-post.php" class="news-parallax-item relative rounded-[2rem] overflow-hidden group shadow-[0_20px_50px_rgba(0,0,0,0.3)] border border-white/10 hover:border-copper/40 transition-colors duration-500 flex flex-col min-h-[400px] h-full">
                            <img src="../images/ofogh-co-cover.jpg" class="absolute inset-0 w-full h-full object-cover transition-transform duration-1000 group-hover:scale-105" alt="News">
                            <div class="absolute inset-0 bg-gradient-to-t from-navy via-navy/60 to-transparent opacity-90 group-hover:opacity-100 transition-opacity duration-500">
                            </div>

                            <div class="absolute top-6 left-6">
                                <div class="w-10 h-10 rounded-full bg-navy/50 backdrop-blur-md border border-white/10 flex items-center justify-center text-white/50 group-hover:bg-copper group-hover:text-white group-hover:border-copper transition-all duration-300">
                                    <i data-lucide="arrow-up-left" class="w-5 h-5"></i>
                                </div>
                            </div>

                            <div class="absolute bottom-0 left-0 right-0 p-8">
                                <span class="inline-block bg-white/10 backdrop-blur-md text-white border border-white/20 px-4 py-1.5 rounded-xl text-xs font-bold mb-4">گزارش ویژه</span>
                                <h3 class="text-xl md:text-2xl font-black text-white leading-tight mb-4 group-hover:text-copper transition-colors font-peyda">
                                    راه‌اندازی سامانه پایش آنلاین مصرف انرژی در مجتمع مس
                                </h3>
                                <p class="text-slate-300 text-sm line-clamp-2 leading-relaxed">
                                    این سامانه با هدف بهینه‌سازی مصرف و کاهش آلاینده‌های زیست محیطی به صورت کاملا بومی طراحی و پیاده‌سازی شده است.
                                </p>
                            </div>
                        </a>

                        <div class="flex flex-col gap-6">
                            <!-- Small News 1 -->
                            <a href="single-post.php" class="news-parallax-item relative rounded-[2rem] overflow-hidden group shadow-lg border border-white/10 flex-1 flex flex-col sm:flex-row bg-white/5 backdrop-blur-sm hover:bg-white/10 hover:border-copper/30 transition-all duration-300 h-full">
                                <div class="w-full sm:w-2/5 h-48 sm:h-full relative overflow-hidden">
                                    <img src="../images/about/Nuclear-contamination-in-Iran.jpg" class="absolute inset-0 w-full h-full object-cover transition-transform duration-700 group-hover:scale-110" alt="News">
                                </div>
                                <div class="w-full sm:w-3/5 p-6 flex flex-col justify-center relative z-10">
                                    <div class="text-copper text-xs font-bold mb-3 flex items-center gap-1.5"><i data-lucide="clock" class="w-3.5 h-3.5"></i> ۲۴ بهمن ۱۴۰۴</div>
                                    <h4 class="text-base font-bold text-white leading-snug group-hover:text-copper transition-colors font-peyda mb-4 line-clamp-2">
                                        بازدید مدیرعامل از طرح توسعه فاز ۳ استخراج
                                    </h4>
                                    <div class="mt-auto flex items-center text-slate-400 text-xs font-semibold group-hover:text-white transition-colors">
                                        بیشتر بخوانید <i data-lucide="chevron-left" class="w-4 h-4 mr-1"></i>
                                    </div>
                                </div>
                            </a>

                            <!-- Small News 2 -->
                            <a href="single-post.php" class="news-parallax-item relative rounded-[2rem] overflow-hidden group shadow-lg border border-white/10 flex-1 flex flex-col sm:flex-row bg-white/5 backdrop-blur-sm hover:bg-white/10 hover:border-copper/30 transition-all duration-300 h-full">
                                <div class="w-full sm:w-2/5 h-48 sm:h-full relative overflow-hidden">
                                    <img src="../images/14164.jpg" class="absolute inset-0 w-full h-full object-cover transition-transform duration-700 group-hover:scale-110" alt="News">
                                </div>
                                <div class="w-full sm:w-3/5 p-6 flex flex-col justify-center relative z-10">
                                    <div class="text-copper text-xs font-bold mb-3 flex items-center gap-1.5"><i data-lucide="clock" class="w-3.5 h-3.5"></i> ۲۰ بهمن ۱۴۰۴</div>
                                    <h4 class="text-base font-bold text-white leading-snug group-hover:text-copper transition-colors font-peyda mb-4 line-clamp-2">
                                        افتخارآفرینی مهندسان در مسابقات ملی رباتیک صنعتی
                                    </h4>
                                    <div class="mt-auto flex items-center text-slate-400 text-xs font-semibold group-hover:text-white transition-colors">
                                        بیشتر بخوانید <i data-lucide="chevron-left" class="w-4 h-4 mr-1"></i>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Announcements -->
                <div class="lg:col-span-4 flex flex-col fade-up-element opacity-0 translate-y-10 transition-all duration-1000 delay-[400ms] ease-out h-full min-h-0">
                    <div class="flex items-center justify-between mb-8 shrink-0">
                        <h3 class="text-2xl font-black text-white font-peyda flex items-center gap-3">
                            <div class="w-10 h-10 rounded-xl bg-white/5 border border-white/10 flex items-center justify-center text-copper shadow-inner">
                                <i data-lucide="bell" class="w-5 h-5"></i>
                            </div>
                            اطلاعیه‌ها
                        </h3>
                        <a href="#" class="text-slate-400 hover:text-copper transition-colors text-sm font-bold flex items-center gap-1 group/link">همه <i data-lucide="arrow-left" class="w-4 h-4 transition-transform group-hover/link:-translate-x-1"></i></a>
                    </div>

                    <!-- Vertical Banner Carousel -->
                    <div class="news-parallax-item relative flex-1 min-h-0 h-full rounded-[2rem] overflow-hidden shadow-[0_20px_50px_rgba(0,0,0,0.3)] border border-white/10 hover:border-copper/40 transition-colors duration-500">
                        <div id="announcements-carousel" class="flex h-full w-full overflow-x-auto overflow-y-hidden snap-x snap-mandatory scrollbar-hide [&::-webkit-scrollbar]:hidden [-ms-overflow-style:none] [scrollbar-width:none] cursor-grab active:cursor-grabbing">

                            <!-- Slide 1 -->
                            <a href="#" class="relative w-full h-full flex-shrink-0 snap-center group block">
                                <img src="../images/ورق مس.jpg" class="absolute inset-0 w-full h-full object-cover transition-transform duration-1000 group-hover:scale-110" alt="Announcement">
                                <div class="absolute inset-0 bg-gradient-to-t from-navy via-navy/60 to-navy/10 group-hover:via-navy/50 transition-all duration-500">
                                </div>

                                <div class="absolute top-6 right-6">
                                    <span class="bg-copper/90 backdrop-blur-md text-white px-3.5 py-2 rounded-xl text-xs font-bold shadow-[0_4px_15px_rgba(200,104,47,0.4)] border border-white/20 flex items-center gap-2">
                                        <span class="w-2 h-2 rounded-full bg-white animate-ping"></span> فوری
                                    </span>
                                </div>

                                <div class="absolute bottom-12 left-0 right-0 p-8">
                                    <div class="text-copper-light text-sm font-bold mb-3 flex items-center gap-2">
                                        <i data-lucide="calendar" class="w-4 h-4"></i> ۲۵ بهمن ۱۴۰۴
                                    </div>
                                    <h4 class="text-2xl font-black text-white leading-tight group-hover:text-copper-light transition-colors font-peyda mb-6">
                                        فراخوان جذب نیروی متخصص و مهندس معدن در مجتمع مس سرچشمه
                                    </h4>
                                    <div class="inline-flex items-center gap-3 text-white/80 hover:text-white group/btn">
                                        <span class="text-sm font-bold">مشاهده کامل اطلاعیه</span>
                                        <span class="w-10 h-10 rounded-full bg-white/10 backdrop-blur-sm border border-white/20 flex items-center justify-center group-hover/btn:bg-copper group-hover/btn:border-copper group-hover/btn:shadow-[0_0_20px_rgba(200,104,47,0.4)] transition-all duration-300">
                                            <i data-lucide="arrow-left" class="w-4 h-4"></i>
                                        </span>
                                    </div>
                                </div>
                            </a>

                            <!-- Slide 2 -->
                            <a href="#" class="relative w-full h-full flex-shrink-0 snap-center group block">
                                <img src="../images/copper-sheet-bahonar.webp" class="absolute inset-0 w-full h-full object-cover transition-transform duration-1000 group-hover:scale-110" alt="Announcement">
                                <div class="absolute inset-0 bg-gradient-to-t from-navy via-navy/60 to-navy/10 group-hover:via-navy/50 transition-all duration-500">
                                </div>

                                <div class="absolute top-6 right-6">
                                    <span class="bg-emerald-600/90 backdrop-blur-md text-white px-3.5 py-2 rounded-xl text-xs font-bold shadow-[0_4px_15px_rgba(16,185,129,0.4)] border border-white/20 flex items-center gap-2">
                                        اطلاعیه جدید
                                    </span>
                                </div>

                                <div class="absolute bottom-12 left-0 right-0 p-8">
                                    <div class="text-copper-light text-sm font-bold mb-3 flex items-center gap-2">
                                        <i data-lucide="calendar" class="w-4 h-4"></i> ۲۰ بهمن ۱۴۰۴
                                    </div>
                                    <h4 class="text-2xl font-black text-white leading-tight group-hover:text-copper-light transition-colors font-peyda mb-6">
                                        برگزاری دوره آموزشی ایمنی کار در معادن برای پرسنل جدید
                                    </h4>
                                    <div class="inline-flex items-center gap-3 text-white/80 hover:text-white group/btn">
                                        <span class="text-sm font-bold">مشاهده کامل اطلاعیه</span>
                                        <span class="w-10 h-10 rounded-full bg-white/10 backdrop-blur-sm border border-white/20 flex items-center justify-center group-hover/btn:bg-copper group-hover/btn:border-copper group-hover/btn:shadow-[0_0_20px_rgba(200,104,47,0.4)] transition-all duration-300">
                                            <i data-lucide="arrow-left" class="w-4 h-4"></i>
                                        </span>
                                    </div>
                                </div>
                            </a>

                        </div>

                        <!-- Carousel Navigation -->
                        <div class="absolute inset-y-0 left-0 right-0 flex items-center justify-between px-2 sm:px-4 pointer-events-none z-20">
                            <button id="ann-next-btn" type="button" class="w-10 h-10 rounded-full bg-white/10 backdrop-blur-md border border-white/20 flex items-center justify-center text-white hover:bg-copper hover:text-white hover:border-copper hover:scale-110 hover:shadow-[0_0_15px_rgba(200,104,47,0.6)] transition-all duration-300 pointer-events-auto">
                                <i data-lucide="chevron-right" class="w-5 h-5"></i>
                            </button>
                            <button id="ann-prev-btn" type="button" class="w-10 h-10 rounded-full bg-white/10 backdrop-blur-md border border-white/20 flex items-center justify-center text-white hover:bg-copper hover:text-white hover:border-copper hover:scale-110 hover:shadow-[0_0_15px_rgba(200,104,47,0.6)] transition-all duration-300 pointer-events-auto">
                                <i data-lucide="chevron-left" class="w-5 h-5"></i>
                            </button>
                        </div>

                        <!-- Carousel Indicators -->
                        <div class="absolute bottom-6 left-1/2 -translate-x-1/2 flex items-center gap-2 z-20">
                            <button type="button" class="w-6 h-1.5 rounded-full bg-white transition-all duration-300"></button>
                            <button type="button" class="w-1.5 h-1.5 rounded-full bg-white/40 hover:bg-white/80 transition-all duration-300"></button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

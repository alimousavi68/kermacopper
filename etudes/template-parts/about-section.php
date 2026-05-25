    <!-- ABOUT SECTION (Bento Box Concept) -->
    <section id="about" class="py-32 bg-gradient-to-b from-[#FAF8F5] via-white to-[#FAF8F5] relative overflow-hidden scroll-reveal">
        <!-- Dot Pattern Background -->
        <div class="absolute inset-0 bg-[radial-gradient(#c8c8c8_1px,transparent_1px)] bg-[size:24px_24px] opacity-40">
        </div>

        <!-- Traditional Kerman Pateh Shamseh Watermark in Background -->
        <div class="absolute -left-20 top-1/4 w-[400px] h-[400px] opacity-[0.025] text-navy pointer-events-none z-0 select-none">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 200 200" fill="none" stroke="currentColor" stroke-width="0.8" stroke-linecap="round" stroke-linejoin="round" class="w-full h-full">
                <!-- Center Circle -->
                <circle cx="100" cy="100" r="15" />
                <circle cx="100" cy="100" r="8" />
                <!-- 8 Petals / Points -->
                <path d="M 100 65 C 92 80, 108 80, 100 65 Z" />
                <path d="M 100 135 C 92 120, 108 120, 100 135 Z" />
                <path d="M 65 100 C 80 92, 80 108, 65 100 Z" />
                <path d="M 135 100 C 120 92, 120 108, 135 100 Z" />
                <!-- Diagonals -->
                <path d="M 75 75 C 85 85, 90 80, 75 75 Z" />
                <path d="M 125 125 C 115 115, 110 120, 125 125 Z" />
                <path d="M 125 75 C 115 85, 110 80, 125 75 Z" />
                <path d="M 75 125 C 85 115, 90 120, 75 125 Z" />
                <!-- Outer Octagonal Ring -->
                <polygon points="100,45 139,61 155,100 139,139 100,155 61,139 45,100 61,61" stroke-dasharray="4,4" />
                <!-- Outer Paisley / Floral extensions -->
                <path d="M 100 45 Q 110 25 100 10 Q 90 25 100 45" />
                <path d="M 100 155 Q 110 175 100 190 Q 90 175 100 155" />
                <path d="M 155 100 Q 175 110 190 100 Q 175 90 155 100" />
                <path d="M 45 100 Q 25 110 10 100 Q 25 90 45 100" />
                <!-- Diagonal Outer Paisleys -->
                <path d="M 139 61 Q 160 50 164 36 Q 150 40 139 61" />
                <path d="M 61 139 Q 40 150 36 164 Q 50 160 61 139" />
                <path d="M 139 139 Q 160 150 164 164 Q 150 160 139 139" />
                <path d="M 61 61 Q 40 50 36 36 Q 50 40 61 61" />
            </svg>
        </div>

        <!-- Ambient Glow Elements -->
        <div class="absolute top-[20%] right-[-10%] w-[45%] h-[45%] bg-copper/10 blur-[140px] rounded-full pointer-events-none">
        </div>
        <div class="absolute bottom-[10%] left-[-10%] w-[40%] h-[40%] bg-navy/5 blur-[140px] rounded-full pointer-events-none">
        </div>

        <div class="container mx-auto px-6 lg:px-12">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-center">
                <!-- Content -->
                <div class="lg:col-span-5 flex flex-col justify-center about-fade-up opacity-0 translate-y-10 transition-all duration-[1200ms] ease-out">
                    <!-- Kicker Badge -->
                    <div class="inline-flex items-center gap-2 bg-copper/5 border border-copper/15 text-copper px-4 py-1.5 rounded-full text-xs font-bold font-peyda w-max mb-6">
                        <span class="w-2.5 h-2.5 rounded-full bg-copper shadow-[0_0_8px_rgba(200,104,47,0.8)] animate-pulse"></span>
                        <span class="tracking-wider uppercase">مس کرمان زمین</span>
                    </div>

                    <!-- Title -->
                    <h2 class="text-5xl lg:text-6xl font-black text-navy mb-8 leading-normal font-peyda ">
                        پیشگام در توسعه <br>
                        <span class="text-transparent bg-clip-text bg-gradient-to-l  from-copper-dark via-copper to-copper-light">صنعت استخراج مس</span>
                    </h2>

                    <!-- Description -->
                    <p class="text-slate-700 text-lg leading-relaxed mb-12 text-right font-medium max-w-xl">
                        مجتمع مس سرچشمه با تکیه بر دانش بومی و استفاده از تکنولوژی‌های روز دنیا، توانسته است ضمن حفظ محیط زیست، به یکی از بزرگترین قطب‌های تولیدی کشور تبدیل شود. تعهد ما به کیفیت و پایداری، مسیر آینده را روشن می‌سازد.
                    </p>

                    <!-- Cards Grid -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 pt-10 border-t border-slate-200/80">
                        <!-- Card 1: Mission -->
                        <div class="bg-white rounded-3xl p-7 border border-slate-200 shadow-[0_15px_40px_-10px_rgba(0,0,0,0.05)] hover:shadow-[0_25px_50px_-12px_rgba(200,104,47,0.15)] hover:-translate-y-1 hover:border-copper/40 transition-all duration-500 group/card flex flex-col relative overflow-hidden z-10">
                            <!-- Watermark background number -->
                            <div class="absolute -left-2 -bottom-2 text-7xl font-black text-slate-100/80 select-none group-hover/card:text-copper/10 transition-colors duration-500 font-peyda" dir="ltr">01</div>

                            <!-- Icon Container -->
                            <div class="w-12 h-12 rounded-2xl bg-gradient-to-br from-copper/10 to-copper/5 border border-copper/10 flex items-center justify-center text-copper mb-5 group-hover/card:scale-110 transition-all duration-500 relative">
                                <i data-lucide="target" class="w-6 h-6 relative z-10 transition-transform duration-700 group-hover/card:rotate-[360deg]"></i>
                            </div>

                            <h4 class="font-extrabold text-navy text-lg mb-2.5 font-peyda group-hover/card:text-copper transition-colors duration-300 relative z-10">مأموریت ما</h4>
                            <p class="text-sm text-slate-600 leading-relaxed font-semibold relative z-10">تولید مس با بالاترین استانداردهای جهانی و توسعه پایدار اقتصادی.</p>
                        </div>

                        <!-- Card 2: Vision -->
                        <div class="bg-white rounded-3xl p-7 border border-slate-200 shadow-[0_15px_40px_-10px_rgba(0,0,0,0.05)] hover:shadow-[0_25px_50px_-12px_rgba(200,104,47,0.15)] hover:-translate-y-1 hover:border-copper/40 transition-all duration-500 group/card flex flex-col relative overflow-hidden z-10">
                            <!-- Watermark background number -->
                            <div class="absolute -left-2 -bottom-2 text-7xl font-black text-slate-100/80 select-none group-hover/card:text-copper/10 transition-colors duration-500 font-peyda" dir="ltr">02</div>

                            <!-- Icon Container -->
                            <div class="w-12 h-12 rounded-2xl bg-gradient-to-br from-copper/10 to-copper/5 border border-copper/10 flex items-center justify-center text-copper mb-5 group-hover/card:scale-110 transition-all duration-500 relative">
                                <i data-lucide="eye" class="w-6 h-6 relative z-10 transition-transform duration-700 group-hover/card:rotate-[360deg]"></i>
                            </div>

                            <h4 class="font-extrabold text-navy text-lg mb-2.5 font-peyda group-hover/card:text-copper transition-colors duration-300 relative z-10">چشم‌انداز</h4>
                            <p class="text-sm text-slate-600 leading-relaxed font-semibold relative z-10">قرارگیری در بین ۵ شرکت برتر تولیدکننده مس در سطح بین‌الملل.</p>
                        </div>
                    </div>
                </div>

                <!-- Image Composition (Editorial Staggered Layout) -->
                <div class="lg:col-span-6 lg:col-start-7 relative h-[450px] lg:h-[600px] flex items-stretch gap-4 sm:gap-6 group z-10 px-2 sm:px-0">
                    <!-- Decorative Background Elements -->
                    <div class="absolute -top-8 -right-8 w-40 h-40 rounded-full border border-copper/30 border-dashed animate-[spin_10s_linear_infinite] z-0 opacity-60 pointer-events-none"></div>
                    <div class="absolute bottom-20 -left-12 w-48 h-48 bg-copper/10 blur-[60px] rounded-full z-0 pointer-events-none"></div>

                    <!-- Right Column (First flex child, Mine) -->
                    <div class="w-1/2 h-[75%] lg:h-[80%] mt-0 relative z-10 transition-all duration-1000 ease-out group-hover:-translate-y-4 group-hover:rotate-1 about-fade-up opacity-0 translate-y-10 delay-[200ms]">
                        <div class="about-parallax-item w-full h-full rounded-[2rem] sm:rounded-[3rem] overflow-hidden shadow-[0_20px_50px_rgba(0,0,0,0.1)] border-4 sm:border-8 border-white/80 bg-white relative">
                            <img src="../images/about/realistic_mine.png" class="w-full h-full object-cover transition-transform duration-1000 ease-out hover:scale-110" alt="Mine">
                            <div class="absolute inset-0 bg-navy/10 mix-blend-multiply pointer-events-none"></div>
                        </div>
                    </div>

                    <!-- Left Column (Second flex child, offset, Foundry) -->
                    <div class="w-1/2 h-[85%] lg:h-[90%] mt-12 sm:mt-20 relative z-20 transition-all duration-1000 ease-out group-hover:-translate-y-6 group-hover:-rotate-1 about-fade-up opacity-0 translate-y-10 delay-[400ms]">
                        <div class="about-parallax-item w-full h-full rounded-[2rem] sm:rounded-[3rem] overflow-hidden shadow-[0_30px_60px_-15px_rgba(200,104,47,0.15)] border-4 sm:border-8 border-white bg-white relative">
                            <img src="../images/about/realistic_foundry.png" class="w-full h-full object-cover transition-transform duration-1000 ease-out hover:scale-110" alt="Foundry">
                            <div class="absolute inset-0 bg-navy/10 mix-blend-multiply pointer-events-none"></div>
                        </div>
                    </div>

                    <!-- Overlapping Horizontal Glass Badge -->
                    <div class="absolute -bottom-6 sm:bottom-4 left-1/2 -translate-x-1/2 w-[90%] sm:w-max min-w-[320px] glass-panel-dark p-4 sm:p-5 lg:px-8 lg:py-6 rounded-[2rem] shadow-[0_25px_50px_-12px_rgba(26,34,53,0.5)] border border-white/10 z-30 flex items-center justify-between gap-6 sm:gap-10 transition-all duration-1000 hover:scale-105 hover:border-copper/40 hover:shadow-[0_30px_60px_-15px_rgba(200,104,47,0.3)] about-fade-up opacity-0 translate-y-10 delay-[600ms]">
                        <div class="flex items-center gap-3 sm:gap-4">
                            <div class="w-10 h-10 sm:w-12 sm:h-12 rounded-2xl bg-gradient-to-br from-copper/20 to-copper/5 flex items-center justify-center border border-copper/20 shadow-inner flex-shrink-0">
                                <i data-lucide="gem" class="w-5 h-5 sm:w-6 sm:h-6 text-copper-light"></i>
                            </div>
                            <div class="text-xs sm:text-sm font-bold text-slate-200 leading-relaxed">
                                سه دهه تجربه‌ درخشان <br>
                                <span class="text-slate-400 font-medium text-[10px] sm:text-xs">در صنعت استخراج مس</span>
                            </div>
                        </div>
                        <div class="text-3xl sm:text-4xl lg:text-5xl font-black bg-gradient-to-l from-copper-light via-copper to-copper-dark bg-clip-text text-transparent font-peyda ml-2" dir="ltr">+<span class="counter-up" data-target="32">۰</span></div>
                    </div>
                </div>
            </div>
        </div>
    </section>

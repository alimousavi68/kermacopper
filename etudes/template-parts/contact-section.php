    <!-- CONTACT SECTION -->
    <section class="py-32 bg-navy relative overflow-hidden border-t border-white/5 scroll-reveal">
        <!-- Glowing Orbs -->
        <div class="absolute top-[20%] right-[10%] w-[400px] h-[400px] bg-copper/10 rounded-full blur-[140px] pointer-events-none">
        </div>
        <div class="absolute bottom-[10%] left-[5%] w-[500px] h-[500px] bg-sky-500/10 rounded-full blur-[140px] pointer-events-none">
        </div>

        <div class="container mx-auto px-6 lg:px-12 relative z-10">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-16 lg:gap-12 items-center">
                <!-- Form Area -->
                <div class="lg:col-span-5 contact-fade-up opacity-0 translate-y-10 transition-all duration-1000 delay-[200ms] ease-out">
                    <div class="mb-12">
                        <h4 class="text-copper font-bold tracking-widest mb-4 flex items-center gap-3 font-peyda">
                            <span class="w-8 h-0.5 bg-copper"></span> صدای شما
                        </h4>
                        <h2 class="text-4xl lg:text-5xl font-black text-white mb-6 font-peyda">در ارتباط باشیم</h2>
                        <p class="text-slate-300 leading-relaxed font-light text-lg">
                            نظرات، پیشنهادات و درخواست‌های خود را با ما در میان بگذارید. تیم پشتیبانی مجتمع مس سرچشمه در اسرع وقت پاسخگوی شما خواهد بود.
                        </p>
                    </div>

                    <form class="space-y-5" onsubmit="handleFormSubmit(event)">
                        <div class="relative group">
                            <input type="text" id="name" required class="peer w-full bg-white/5 border border-white/10 rounded-2xl px-6 py-5 text-white placeholder-transparent focus:outline-none focus:border-copper focus:bg-white/10 transition-all" placeholder="نام و نام خانوادگی">
                            <label for="name" class="absolute right-6 -top-2.5 bg-navy px-2 text-sm text-copper transition-all peer-placeholder-shown:text-slate-400 peer-placeholder-shown:top-5 peer-placeholder-shown:bg-transparent peer-focus:-top-2.5 peer-focus:text-copper peer-focus:bg-navy font-medium cursor-text">نام و نام خانوادگی</label>
                        </div>
                        <div class="relative group">
                            <input type="text" id="email" required class="peer w-full bg-white/5 border border-white/10 rounded-2xl px-6 py-5 text-white placeholder-transparent focus:outline-none focus:border-copper focus:bg-white/10 transition-all" placeholder="ایمیل یا شماره تماس" dir="ltr">
                            <label for="email" class="absolute right-6 -top-2.5 bg-navy px-2 text-sm text-copper transition-all peer-placeholder-shown:text-slate-400 peer-placeholder-shown:top-5 peer-placeholder-shown:bg-transparent peer-focus:-top-2.5 peer-focus:text-copper peer-focus:bg-navy font-medium cursor-text">ایمیل یا موبایل</label>
                        </div>
                        <div class="relative group">
                            <textarea id="message" rows="4" required class="peer w-full bg-white/5 border border-white/10 rounded-2xl px-6 py-5 text-white placeholder-transparent focus:outline-none focus:border-copper focus:bg-white/10 transition-all resize-none" placeholder="پیام شما..."></textarea>
                            <label for="message" class="absolute right-6 -top-2.5 bg-navy px-2 text-sm text-copper transition-all peer-placeholder-shown:text-slate-400 peer-placeholder-shown:top-5 peer-placeholder-shown:bg-transparent peer-focus:-top-2.5 peer-focus:text-copper peer-focus:bg-navy font-medium cursor-text">پیام شما</label>
                        </div>
                        <button class="w-full bg-gradient-to-r from-copper-dark via-copper to-copper-light text-white font-black text-lg py-5 rounded-2xl transition-all shadow-[0_10px_30px_rgba(200,104,47,0.3)] hover:shadow-[0_15px_40px_rgba(200,104,47,0.5)] hover:-translate-y-1 mt-4 group relative overflow-hidden">
                            <span class="absolute inset-0 bg-white/20 translate-y-full group-hover:translate-y-0 transition-transform duration-500 ease-out"></span>
                            <span class="relative flex items-center justify-center gap-2">
                                ارسال پیام <i data-lucide="send" class="w-5 h-5 transition-transform duration-300 group-hover:-translate-y-1 group-hover:translate-x-1"></i>
                            </span>
                        </button>
                    </form>
                    <div id="formSuccess" class="hidden mt-6 p-5 rounded-2xl bg-emerald-500/10 border border-emerald-500/20 text-emerald-400 text-sm font-bold flex items-center gap-3">
                        <i data-lucide="check-circle" class="w-5 h-5 flex-shrink-0"></i>
                        <span>پیام شما با موفقیت ثبت شد. به زودی با شما تماس می‌گیریم.</span>
                    </div>
                </div>

                <!-- Info & Map Area -->
                <div class="lg:col-span-7 contact-fade-up opacity-0 translate-y-10 transition-all duration-1000 delay-[400ms] ease-out h-full flex flex-col gap-6 mt-12 lg:mt-0">

                    <!-- Premium Map Card -->
                    <div class="w-full h-64 sm:h-80 rounded-[2rem] overflow-hidden relative group border border-white/10 shadow-2xl z-10 bg-navy-light flex items-center justify-center">
                        <img src="../images/map-dark.jpg" alt="Map Location Placeholder" class="absolute inset-0 w-full h-full object-cover grayscale opacity-50 group-hover:grayscale-[50%] group-hover:opacity-80 transition-all duration-1000 group-hover:scale-105" onerror="this.src='https://images.unsplash.com/photo-1524661135-423995f22d0b?ixlib=rb-4.0.3&auto=format&fit=crop&w=1600&q=80'; this.classList.add('opacity-30')">
                        <div class="absolute inset-0 bg-gradient-to-t from-navy via-navy/40 to-transparent pointer-events-none">
                        </div>

                        <!-- Map Pin -->
                        <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 flex flex-col items-center">
                            <div class="w-16 h-16 rounded-full bg-copper/20 flex items-center justify-center animate-pulse">
                                <div class="w-10 h-10 rounded-full bg-copper flex items-center justify-center shadow-[0_0_20px_rgba(200,104,47,0.8)]">
                                    <i data-lucide="map-pin" class="w-5 h-5 text-white"></i>
                                </div>
                            </div>
                            <div class="mt-4 bg-white/10 backdrop-blur-md px-4 py-2 rounded-xl border border-white/20 text-white font-bold text-sm shadow-lg pointer-events-none">
                                مجتمع مس سرچشمه
                            </div>
                        </div>
                    </div>

                    <!-- Contact Details Cards -->
                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-6 flex-1">
                        <!-- Address -->
                        <div class="bg-white/5 backdrop-blur-sm border border-white/10 rounded-[2rem] p-6 sm:p-8 hover:bg-white/10 hover:border-copper/40 transition-all duration-500 group flex flex-col items-center justify-center text-center shadow-lg h-full">
                            <div class="w-14 h-14 rounded-2xl bg-copper/10 text-copper flex items-center justify-center mb-5 group-hover:scale-110 group-hover:bg-copper group-hover:text-white transition-all duration-500 flex-shrink-0">
                                <i data-lucide="map" class="w-6 h-6"></i>
                            </div>
                            <h5 class="text-white font-bold text-base mb-2 font-peyda">دفتر مرکزی</h5>
                            <p class="text-sm text-slate-400 leading-relaxed font-medium">کرمان، رفسنجان<br>مجتمع مس سرچشمه</p>
                        </div>
                        <!-- Phone -->
                        <div class="bg-white/5 backdrop-blur-sm border border-white/10 rounded-[2rem] p-6 sm:p-8 hover:bg-white/10 hover:border-copper/40 transition-all duration-500 group flex flex-col items-center justify-center text-center shadow-lg h-full">
                            <div class="w-14 h-14 rounded-2xl bg-copper/10 text-copper flex items-center justify-center mb-5 group-hover:scale-110 group-hover:bg-copper group-hover:text-white transition-all duration-500 flex-shrink-0">
                                <i data-lucide="phone-call" class="w-6 h-6"></i>
                            </div>
                            <h5 class="text-white font-bold text-base mb-2 font-peyda">شماره تماس</h5>
                            <p class="text-sm text-slate-400 leading-relaxed font-medium" dir="ltr">۰۳۴ - ۳۴۳۰ ۰۰۰۰<br>۰۳۴ - ۳۴۳۰ ۰۰۰۱</p>
                        </div>
                        <!-- Email -->
                        <div class="bg-white/5 backdrop-blur-sm border border-white/10 rounded-[2rem] p-6 sm:p-8 hover:bg-white/10 hover:border-copper/40 transition-all duration-500 group flex flex-col items-center justify-center text-center shadow-lg h-full">
                            <div class="w-14 h-14 rounded-2xl bg-copper/10 text-copper flex items-center justify-center mb-5 group-hover:scale-110 group-hover:bg-copper group-hover:text-white transition-all duration-500 flex-shrink-0">
                                <i data-lucide="mail" class="w-6 h-6"></i>
                            </div>
                            <h5 class="text-white font-bold text-base mb-2 font-peyda">پست الکترونیک</h5>
                            <p class="text-sm text-slate-400 leading-relaxed font-medium" dir="ltr">info@kermancopper.ir<br>pr@kermancopper.ir</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

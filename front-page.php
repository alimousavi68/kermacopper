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
                        <button data-filter="other" class="px-6 py-2 rounded-sm font-bold transition-all text-sm text-slate-500 hover:bg-slate-50">سایر</button>
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
                    <div class="ad-item bg-white rounded-sm overflow-hidden shadow-sm border border-slate-100 card-hover transition-all fade-in-section" data-type="other">
                        <div class="h-48 relative overflow-hidden group">
                            <img src="<?php echo get_template_directory_uri(); ?>/images/image2.jpg" alt="خودرو سنگین" class="w-full h-full object-cover" />
                            <div class="absolute top-4 right-4 bg-white/95 backdrop-blur px-2.5 py-1 rounded-sm text-[10px] font-normal shadow-sm text-slate-700 uppercase tracking-tight flex items-center gap-1">
                                <i data-lucide="file-text" class="w-2.5 h-2.5 text-copper stroke-[1.5]"></i> سایر
                            </div>
                        </div>
                        <div class="p-6">
                            <h3 class="font-bold text-base mb-4 h-12 line-clamp-2 text-slate-800 leading-relaxed">فراخوان تامین خدمات آزمایشگاهی و کنترل کیفیت</h3>
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
        <?php
        $news_category = (int) kermancopper_get_home_setting( 'kermancopper_home_news_category' );
        $notices_category = (int) kermancopper_get_home_setting( 'kermancopper_home_notices_category' );
        $news_enabled = $news_category > 0;
        $notices_enabled = $notices_category > 0;
        $news_title = kermancopper_get_home_setting( 'kermancopper_home_news_title' );
        $news_kicker = kermancopper_get_home_setting( 'kermancopper_home_news_kicker' );
        $news_count = (int) kermancopper_get_home_setting( 'kermancopper_home_news_count' );
        $news_archive_text = kermancopper_get_home_setting( 'kermancopper_home_news_archive_text' );
        $news_show_date = (bool) kermancopper_get_home_setting( 'kermancopper_home_news_show_date' );
        $news_archive_url = $news_enabled ? get_category_link( $news_category ) : '';
        $news_slides = array();
        if ( $news_enabled && $news_count > 0 ) {
            $news_query = new WP_Query( array(
                'cat'            => $news_category,
                'posts_per_page' => $news_count,
                'post_status'    => 'publish',
            ) );
            if ( $news_query->have_posts() ) {
                while ( $news_query->have_posts() ) {
                    $news_query->the_post();
                    $image = get_the_post_thumbnail_url( get_the_ID(), 'full' );
                    if ( ! $image ) {
                        continue;
                    }
                    $news_slides[] = array(
                        'title'   => get_the_title(),
                        'excerpt' => get_the_excerpt(),
                        'date'    => get_the_date(),
                        'url'     => get_permalink(),
                        'image'   => $image,
                    );
                }
            }
            wp_reset_postdata();
        }
        $news_has_content = $news_enabled && ! empty( $news_slides );
        $notices_title = kermancopper_get_home_setting( 'kermancopper_home_notices_title' );
        $notices_kicker = kermancopper_get_home_setting( 'kermancopper_home_notices_kicker' );
        $notices_count = (int) kermancopper_get_home_setting( 'kermancopper_home_notices_count' );
        $notices_archive_text = kermancopper_get_home_setting( 'kermancopper_home_notices_archive_text' );
        $notices_show_date = (bool) kermancopper_get_home_setting( 'kermancopper_home_notices_show_date' );
        $notices_archive_url = $notices_enabled ? get_category_link( $notices_category ) : '';
        $notices_items = array();
        if ( $notices_enabled && $notices_count > 0 ) {
            $notices_query = new WP_Query( array(
                'cat'            => $notices_category,
                'posts_per_page' => $notices_count,
                'post_status'    => 'publish',
            ) );
            if ( $notices_query->have_posts() ) {
                while ( $notices_query->have_posts() ) {
                    $notices_query->the_post();
                    $image = get_the_post_thumbnail_url( get_the_ID(), 'large' );
                    if ( ! $image ) {
                        continue;
                    }
                    $notices_items[] = array(
                        'title' => get_the_title(),
                        'date'  => get_the_date(),
                        'url'   => get_permalink(),
                        'image' => $image,
                    );
                }
            }
            wp_reset_postdata();
        }
        $notices_has_content = $notices_enabled && ! empty( $notices_items );
        ?>
        <?php if ( $news_has_content || $notices_has_content ) : ?>
        <section id="news" class="py-24 bg-white">
            <div class="container mx-auto px-4">
                <div class="grid grid-cols-1 lg:grid-cols-12 gap-10 fade-in-section items-stretch">
                    <?php if ( $news_has_content ) : ?>
                    <div class="<?php echo $notices_has_content ? 'lg:col-span-8' : 'lg:col-span-12'; ?> flex flex-col h-full">
                        <div class="flex flex-col md:flex-row justify-between items-end mb-8 gap-6 min-h-[96px]">
                            <div>
                                <?php if ( $news_kicker !== '' ) : ?>
                                    <span class="text-copper font-bold mb-2 block text-sm flex items-center gap-2"><span class="w-8 h-[2px] bg-copper"></span> <?php echo wp_kses_post( $news_kicker ); ?></span>
                                <?php endif; ?>
                                <h2 class="text-4xl font-black text-slate-900"><?php echo esc_html( $news_title ); ?></h2>
                            </div>
                            <?php if ( ! empty( $news_archive_text ) && ! empty( $news_archive_url ) ) : ?>
                                <a href="<?php echo esc_url( $news_archive_url ); ?>" class="group flex items-center gap-2 text-sm font-bold text-slate-500 hover:text-copper transition-colors border-b border-transparent hover:border-copper pb-1">
                                    <?php echo esc_html( $news_archive_text ); ?> <i data-lucide="arrow-left" class="w-4 h-4 transition-transform group-hover:-translate-x-1"></i>
                                </a>
                            <?php endif; ?>
                        </div>

                        <div id="news-carousel" class="relative rounded-sm overflow-hidden shadow-md hover:shadow-2xl transition-all duration-500 flex-1 min-h-[520px]">
                            <div class="absolute inset-0">
                                <?php foreach ( $news_slides as $index => $slide ) : ?>
                                    <a href="<?php echo esc_url( $slide['url'] ); ?>" class="news-slide absolute inset-0 <?php echo $index === 0 ? 'opacity-100' : 'opacity-0'; ?> transition-opacity duration-500 block">
                                        <img src="<?php echo esc_url( $slide['image'] ); ?>" class="w-full h-full object-cover" />
                                        <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/30 to-transparent opacity-95"></div>
                                        <div class="absolute bottom-0 left-0 right-0 p-8 md:p-12">
                                            <?php if ( $news_show_date && ! empty( $slide['date'] ) ) : ?>
                                                <div class="flex items-center gap-4 mb-4 text-white/80 text-xs font-bold">
                                                    <span><?php echo esc_html( $slide['date'] ); ?></span>
                                                </div>
                                            <?php endif; ?>
                                            <h3 class="font-black text-white text-2xl md:text-4xl leading-tight mb-4"><?php echo esc_html( $slide['title'] ); ?></h3>
                                            <?php if ( ! empty( $slide['excerpt'] ) ) : ?>
                                                <p class="text-slate-200 text-sm md:text-base leading-relaxed line-clamp-2 mb-6 max-w-2xl opacity-90"><?php echo esc_html( $slide['excerpt'] ); ?></p>
                                            <?php endif; ?>
                                            <span class="inline-flex items-center gap-2 text-white font-bold border-b border-white/30 pb-1 hover:border-copper hover:text-copper transition-all">
                                                مطالعه کامل خبر <i data-lucide="arrow-left" class="w-4 h-4"></i>
                                            </span>
                                        </div>
                                    </a>
                                <?php endforeach; ?>
                            </div>

                            <?php if ( count( $news_slides ) > 1 ) : ?>
                                <div class="absolute bottom-6 left-6 flex items-center gap-3">
                                    <button id="news-prev" class="group w-11 h-11 border border-copper text-copper hover:text-white hover:bg-copper hover:border-copper transition-all flex items-center justify-center leading-none p-0">
                                        <i data-lucide="chevron-right" class="w-7 h-7 block stroke-[2]"></i>
                                    </button>
                                    <button id="news-next" class="group w-11 h-11 border border-copper text-copper hover:text-white hover:bg-copper hover:border-copper transition-all flex items-center justify-center leading-none p-0">
                                        <i data-lucide="chevron-left" class="w-7 h-7 block stroke-[2]"></i>
                                    </button>
                                </div>

                                <div class="absolute bottom-5 left-1/2 -translate-x-1/2 flex items-center gap-2">
                                    <?php foreach ( $news_slides as $index => $slide ) : ?>
                                        <button class="news-dot <?php echo $index === 0 ? 'w-6 h-2.5 bg-copper' : 'w-2.5 h-2.5 bg-white/50'; ?> rounded-full transition-all"></button>
                                    <?php endforeach; ?>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                    <?php endif; ?>

                    <?php if ( $notices_has_content ) : ?>
                    <div class="<?php echo $news_has_content ? 'lg:col-span-4' : 'lg:col-span-12'; ?> flex flex-col h-full">
                        <div class="flex flex-col md:flex-row justify-between items-end mb-8 gap-6 min-h-[96px]">
                            <div>
                                <?php if ( $notices_kicker !== '' ) : ?>
                                    <span class="text-copper font-bold mb-2 block text-sm flex items-center gap-2"><span class="w-8 h-[2px] bg-copper"></span> <?php echo wp_kses_post( $notices_kicker ); ?></span>
                                <?php endif; ?>
                                <h3 class="text-2xl font-black text-slate-900"><?php echo esc_html( $notices_title ); ?></h3>
                            </div>
                            <?php if ( ! empty( $notices_archive_text ) && ! empty( $notices_archive_url ) ) : ?>
                                <a href="<?php echo esc_url( $notices_archive_url ); ?>" class="group flex items-center gap-2 text-sm font-bold text-slate-500 hover:text-copper transition-colors border-b border-transparent hover:border-copper pb-1">
                                    <?php echo esc_html( $notices_archive_text ); ?> <i data-lucide="arrow-left" class="w-4 h-4 transition-transform group-hover:-translate-x-1"></i>
                                </a>
                            <?php endif; ?>
                        </div>

                        <div id="news-notices-grid" class="grid grid-cols-2 gap-6 flex-1">
                            <?php foreach ( $notices_items as $notice ) : ?>
                                <a href="<?php echo esc_url( $notice['url'] ); ?>" class="group relative rounded-sm overflow-hidden shadow-sm hover:shadow-xl transition-all aspect-[3/4] block">
                                    <img src="<?php echo esc_url( $notice['image'] ); ?>" class="absolute inset-0 w-full h-full object-cover transition-transform duration-500 group-hover:scale-105" />
                                    <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/30 to-transparent"></div>
                                    <div class="absolute bottom-0 left-0 right-0 p-4">
                                        <?php if ( $notices_show_date && ! empty( $notice['date'] ) ) : ?>
                                            <div class="text-[10px] font-bold text-white/80 mb-2"><?php echo esc_html( $notice['date'] ); ?></div>
                                        <?php endif; ?>
                                        <h4 class="text-white font-bold text-sm leading-snug line-clamp-2"><?php echo esc_html( $notice['title'] ); ?></h4>
                                    </div>
                                </a>
                            <?php endforeach; ?>
                        </div>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
        </section>
        <?php endif; ?>

        <section class="py-16 bg-white">
            <div class="w-full max-w-[1400px] mx-auto px-4">
                <?php if ( is_active_sidebar( 'home-news-below' ) ) : ?>
                    <?php dynamic_sidebar( 'home-news-below' ); ?>
                <?php endif; ?>
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
                    <h2 class="text-4xl font-black text-slate-900">پیوندها</h2>
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

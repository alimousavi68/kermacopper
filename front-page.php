<?php get_header(); ?>

<main>
    <?php
    // Hero Settings
    $hero_bg_image_id           = kermancopper_get_home_setting( 'kermancopper_home_hero_slide_1_image_id' );
    $hero_bg_image_url          = $hero_bg_image_id ? wp_get_attachment_image_url( $hero_bg_image_id, 'full' ) : '';
    if ( ! $hero_bg_image_url ) {
        $hero_bg_image_url = get_template_directory_uri() . '/images/pano sarcheshmeh.jpg';
    }
    $hero_bg_image_alt          = kermancopper_get_home_setting( 'kermancopper_home_hero_slide_1_alt' ) ?: 'صنایع و معادن مس کرمان زمین';

    $hero_pattern_image_id      = kermancopper_get_home_setting( 'kermancopper_home_hero_pattern_image_id' );
    $hero_pattern_image_url     = $hero_pattern_image_id ? wp_get_attachment_image_url( $hero_pattern_image_id, 'full' ) : '';
    if ( ! $hero_pattern_image_url ) {
        $hero_pattern_image_url = get_template_directory_uri() . '/images/patt-right.svg';
    }

    $hero_badge_text            = kermancopper_get_home_setting( 'kermancopper_home_hero_badge_text' ) ?: 'صنایع و معادن مس کرمان زمین | مهد مس ایران';

    $hero_title                 = kermancopper_get_home_setting( 'kermancopper_home_hero_title' );
    $hero_title_highlight       = kermancopper_get_home_setting( 'kermancopper_home_hero_title_highlight' );
    $hero_subtitle              = kermancopper_get_home_setting( 'kermancopper_home_hero_subtitle' );
    $hero_description           = kermancopper_get_home_setting( 'kermancopper_home_hero_description' );
    $hero_button_primary_text   = kermancopper_get_home_setting( 'kermancopper_home_hero_button_primary_text' );
    $hero_button_primary_url    = kermancopper_get_home_setting( 'kermancopper_home_hero_button_primary_url' );
    $hero_button_secondary_text = kermancopper_get_home_setting( 'kermancopper_home_hero_button_secondary_text' );
    $hero_button_secondary_url  = kermancopper_get_home_setting( 'kermancopper_home_hero_button_secondary_url' );
    // News & Notices Settings
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
                $image = get_the_post_thumbnail_url( get_the_ID(), 'kermancopper-news-thumbnail' );
                if ( ! $image ) {
                    $image = kermancopper_get_fallback_image();
                }
                $badge = get_post_meta( get_the_ID(), '_kermancopper_custom_badge', true );
                $news_slides[] = array(
                    'title'   => get_the_title(),
                    'excerpt' => get_the_excerpt(),
                    'date'    => get_the_date(),
                    'url'     => get_permalink(),
                    'image'   => $image,
                    'badge'   => $badge,
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
                $image = get_the_post_thumbnail_url( get_the_ID(), 'kermancopper-notice-thumbnail' );
                if ( ! $image ) {
                    $image = kermancopper_get_fallback_image();
                }
                $badge = get_post_meta( get_the_ID(), '_kermancopper_custom_badge', true );
                $notices_items[] = array(
                    'title' => get_the_title(),
                    'date'  => get_the_date(),
                    'url'   => get_permalink(),
                    'image' => $image,
                    'badge' => $badge,
                );
            }
        }
        wp_reset_postdata();
    }
    $notices_has_content = $notices_enabled && ! empty( $notices_items );
    // FAQ Settings
    $faq_kicker = kermancopper_get_home_setting( 'kermancopper_home_faq_kicker' );
    $faq_title = kermancopper_get_home_setting( 'kermancopper_home_faq_title' );
    $faq_description = kermancopper_get_home_setting( 'kermancopper_home_faq_description' );
    $faq_items_raw = kermancopper_get_home_setting( 'kermancopper_home_faq_items' );
    $faq_items = json_decode( $faq_items_raw, true );
    if ( ! is_array( $faq_items ) ) {
        $faq_items = array();
    }
    $faq_items = array_values(
        array_filter(
            $faq_items,
            function( $item ) {
                return is_array( $item ) && ( ! empty( $item['question'] ) || ! empty( $item['answer'] ) );
            }
        )
    );
    $faq_has_items = ! empty( $faq_items );
    // Contact Information
    $contact_map_image = kermancopper_get_home_setting('kermancopper_contact_map_image');
    $contact_map_link = kermancopper_get_home_setting('kermancopper_contact_map_link');
    $contact_phones_raw = kermancopper_get_home_setting('kermancopper_contact_phones');
    $contact_emails_raw = kermancopper_get_home_setting('kermancopper_contact_emails');
    
    $contact_phones = json_decode( $contact_phones_raw, true );
    if ( ! is_array( $contact_phones ) ) $contact_phones = array();
    
    $contact_emails = json_decode( $contact_emails_raw, true );
    if ( ! is_array( $contact_emails ) ) $contact_emails = array();

    $contact_addresses_raw = kermancopper_get_home_setting('kermancopper_contact_addresses');
    $contact_addresses = json_decode( $contact_addresses_raw, true );
    if ( ! is_array( $contact_addresses ) || empty( $contact_addresses ) ) {
        $contact_address_single = kermancopper_get_home_setting('kermancopper_contact_address_text');
        if ( ! empty( $contact_address_single ) ) {
            $contact_addresses = array( array( 'address' => $contact_address_single ) );
        } else {
            $contact_addresses = array( array( 'address' => 'کرمان، رفسنجان' ) );
        }
    }
    // About Settings
    $about_kicker = kermancopper_get_home_setting( 'kermancopper_home_about_kicker' );
    $about_title_highlight = kermancopper_get_home_setting( 'kermancopper_home_about_title_highlight' );
    $about_title_rest = kermancopper_get_home_setting( 'kermancopper_home_about_title_rest' );
    $about_description = kermancopper_get_home_setting( 'kermancopper_home_about_description' );
    $about_mission_title = kermancopper_get_home_setting( 'kermancopper_home_about_mission_title' );
    $about_mission_desc = kermancopper_get_home_setting( 'kermancopper_home_about_mission_text' );
    $about_vision_title = kermancopper_get_home_setting( 'kermancopper_home_about_vision_title' );
    $about_vision_desc = kermancopper_get_home_setting( 'kermancopper_home_about_vision_text' );

    // About Images
    $about_image_1_id = kermancopper_get_home_setting( 'kermancopper_home_about_main_image_id' );
    $about_image_1_url = $about_image_1_id ? wp_get_attachment_image_url( $about_image_1_id, 'full' ) : '';
    if ( ! $about_image_1_url ) {
        $about_image_1_url = get_template_directory_uri() . '/images/about/realistic_mine.png';
    }

    $about_image_2_id = kermancopper_get_home_setting( 'kermancopper_home_about_secondary_image_id' );
    if ( ! $about_image_2_id ) {
        $about_image_2_id = kermancopper_get_home_setting( 'kermancopper_home_about_pattern_image_id' );
    }
    $about_image_2_url = $about_image_2_id ? wp_get_attachment_image_url( $about_image_2_id, 'full' ) : '';
    if ( ! $about_image_2_url ) {
        $about_image_2_url = get_template_directory_uri() . '/images/about/realistic_foundry.png';
    }

    // Experience Stats
    $about_years_exp = kermancopper_get_home_setting( 'kermancopper_home_about_experience_count' );
    $about_experience_label = kermancopper_get_home_setting( 'kermancopper_home_about_experience_label' ) ?: 'سه دهه تجربه‌ درخشان';
    $about_experience_sublabel = kermancopper_get_home_setting( 'kermancopper_home_about_experience_sublabel' ) ?: 'در صنعت استخراج مس';
    ?>





<!-- HERO SECTION -->
    <header class="relative h-screen min-h-[550px] lg:min-h-[650px] flex items-center justify-start overflow-hidden bg-navy">
        <!-- Background Image -->
        <div class="absolute inset-0 w-full h-full">
            <img src="<?php echo esc_url( $hero_bg_image_url ); ?>" class="hero-bg-image w-full h-full object-cover opacity-65 mix-blend-overlay will-change-transform" alt="<?php echo esc_attr( $hero_bg_image_alt ); ?>">
            <!-- Vibrant Overlay: Dark on the right for readability of right-aligned text -->
            <div class="absolute inset-0 bg-gradient-to-l from-navy/80 via-navy/35 to-transparent z-10"></div>
            <div class="absolute inset-0 bg-gradient-to-t from-navy/60 via-transparent to-transparent z-10"></div>

            <!-- Left Side Pattern Graphic (Stretches to cover and scale with screen size) -->
            <div class="hero-pattern-left-wrapper absolute left-0 top-0 bottom-0 w-full sm:w-1/2 lg:w-1/3 xl:w-[35%] pointer-events-none z-10 overflow-hidden">
                <div class="hero-pattern-left absolute inset-0 w-full h-full opacity-100" 
                style="background-image: url('<?php echo esc_url( $hero_pattern_image_url ); ?>');
                 background-repeat: no-repeat; background-position: left center; background-size: cover;
                  transform: scaleX(-1); -webkit-mask-image: url('<?php echo esc_url( $hero_pattern_image_url ); ?>');
                   -webkit-mask-size: cover; -webkit-mask-position: left center; -webkit-mask-repeat: no-repeat;
                    mask-image: url('<?php echo esc_url( $hero_pattern_image_url ); ?>'); mask-size: cover; mask-position: left center; mask-repeat: no-repeat;
                    filter: brightness(1.6) contrast(1.3) saturate(1.2);">
                    <div class="hero-pattern-shimmer"></div>
                </div>
            </div>

            <!-- Accent glow: Positioned above background gradients but below text container -->
            <div class="hero-glow-accent absolute -top-[20%] -right-[10%] w-[55%] h-[55%] bg-copper/35 rounded-full blur-[120px] animate-pulse-slow z-15">
            </div>
        </div>

        <div class="hero-text-container container mx-auto px-6 lg:px-12 relative z-20 flex flex-col items-start text-right mt-6 lg:mt-8 xl:mt-10 2xl:mt-12 font-peyda">
            <div class="inline-flex items-center gap-3 px-4 py-2 rounded-full glass-panel mb-4 xl:mb-6 border border-white/20 animate-fade-in-up delay-100">
                <span class="relative flex h-3 w-3">
                    <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-copper opacity-75"></span>
                    <span class="relative inline-flex rounded-full h-3 w-3 bg-copper"></span>
                </span>
                <span class="text-copper-light text-xs font-extrabold tracking-widest"><?php echo esc_html( $hero_badge_text ); ?></span>
            </div>

            <h1 class="text-xl sm:text-2xl md:text-5xl lg:text-5xl xl:text-6xl 2xl:text-7xl xl:leading-[1.1] font-black text-white leading-[1.2] mb-3 max-w-4xl text-right animate-fade-in-up delay-200">
                <?php echo esc_html( $hero_title ?: 'افتخار ملی، نوآوری در' ); ?> <span class="text-transparent bg-clip-text bg-gradient-to-l from-copper-dark via-copper to-copper-light"><?php echo esc_html( $hero_title_highlight ?: 'صنعت مس ایران' ); ?></span>
            </h1>
            <div class="text-xs md:text-sm lg:text-base xl:text-lg 2xl:text-xl text-slate-400 font-semibold tracking-wider mb-4 xl:mb-6 uppercase text-right animate-fade-in-up delay-300" dir="ltr">
                <?php echo esc_html( $hero_subtitle ?: "National Pride, Innovation in Iran's Copper Industry" ); ?>
            </div>

            <p class="text-sm md:text-base xl:text-lg 2xl:text-xl xl:leading-relaxed text-slate-300 max-w-2xl leading-relaxed mb-6 xl:mb-8 font-light text-right animate-fade-in-up delay-400">
                <?php echo esc_html( $hero_description ?: 'تکیه بر تخصص بومی و پتانسیل‌های بی‌کران دشت‌های کرمان، صنایع و معادن مس کرمان زمین را به نماد پایداری، خودکفایی و حضور پرقدرت در بازارهای جهانی تبدیل کرده است.' ); ?>
            </p>

            <div class="flex justify-start flex-wrap gap-4 mb-4 animate-fade-in-up delay-500">
                <?php if ( $hero_button_primary_text && $hero_button_primary_url ) : ?>
                <a href="<?php echo esc_url( $hero_button_primary_url ); ?>" class="bg-copper hover:bg-copper-light text-white px-6 py-3 rounded-full text-sm font-bold transition-all hover:shadow-[0_10px_30px_rgba(200,104,47,0.4)] flex items-center gap-2 hover:-translate-y-1">
                    <?php echo esc_html( $hero_button_primary_text ); ?>
                </a>
                <?php else: ?>
                <a href="#ads" class="bg-copper hover:bg-copper-light text-white px-6 py-3 rounded-full text-sm font-bold transition-all hover:shadow-[0_10px_30px_rgba(200,104,47,0.4)] flex items-center gap-2 hover:-translate-y-1">
                    مزایده و مناقصه
                </a>
                <?php endif; ?>
                <?php if ( $hero_button_secondary_text && $hero_button_secondary_url ) : ?>
                <a href="<?php echo esc_url( $hero_button_secondary_url ); ?>" class="border border-white hover:bg-white hover:text-navy text-white px-6 py-3 rounded-full text-sm font-bold transition-all flex items-center gap-2 hover:-translate-y-1">
                    <?php echo esc_html( $hero_button_secondary_text ); ?>
                </a>
                <?php else: ?>
                <a href="about" class="border border-white hover:bg-white hover:text-navy text-white px-6 py-3 rounded-full text-sm font-bold transition-all flex items-center gap-2 hover:-translate-y-1">
                    درباره ما
                </a>
                <?php endif; ?>
            </div>
        </div>

        <!-- Bottom Curve (Union image) -->
        <div class="hero-curve">
            <img src="<?php echo get_template_directory_uri(); ?>/images/Union.png" srcset="<?php echo get_template_directory_uri(); ?>/images/Union.png 1440w, <?php echo get_template_directory_uri(); ?>/images/Union-300x37.png 300w, <?php echo get_template_directory_uri(); ?>/images/Union-1024x127.png 1024w, <?php echo get_template_directory_uri(); ?>/images/Union-768x95.png 768w" sizes="(max-width: 1440px) 100vw, 1440px" class="hero-curve-image" alt="" />
            <a href="#about" class="hero-curve-arrow" aria-label="بخش بعدی">
                <?php echo kermancopper_icon('chevrons-down', 'hero-curve-arrow-icon'); ?>
            </a>
        </div>
    </header>

    <!-- ABOUT SECTION (Bento Box Concept) -->
    <section id="about" class="py-32 bg-gradient-to-b from-[#FAF8F5] via-white to-[#FAF8F5] relative overflow-hidden scroll-reveal">
        <!-- Dot Pattern Background -->
        <div class="absolute inset-0 bg-[radial-gradient(#c8c8c8_1px,transparent_1px)] bg-[size:24px_24px] opacity-40">
        </div>

        <!-- Traditional Kerman Pateh Shamseh Watermark in Background -->
        <div
            class="absolute -left-20 top-1/4 w-[400px] h-[400px] opacity-[0.025] text-navy pointer-events-none z-0 select-none">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 200 200" fill="none" stroke="currentColor"
                stroke-width="0.8" stroke-linecap="round" stroke-linejoin="round" class="w-full h-full">
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
        <div
            class="absolute top-[20%] right-[-10%] w-[45%] h-[45%] bg-copper/10 blur-[140px] rounded-full pointer-events-none">
        </div>
        <div
            class="absolute bottom-[10%] left-[-10%] w-[40%] h-[40%] bg-navy/5 blur-[140px] rounded-full pointer-events-none">
        </div>

        <div class="container mx-auto px-6 lg:px-12">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-center">
                <!-- Content -->
                <div
                    class="lg:col-span-5 flex flex-col justify-center about-fade-up opacity-0 translate-y-10 transition-all duration-[1200ms] ease-out">
                    <!-- Kicker Badge -->
                    <div
                        class="inline-flex items-center gap-2 bg-copper/5 border border-copper/15 text-copper px-4 py-1.5 rounded-full text-xs font-bold font-peyda w-max mb-6">
                        <span
                            class="w-2.5 h-2.5 rounded-full bg-copper shadow-[0_0_8px_rgba(200,104,47,0.8)] animate-pulse"></span>
                        <span class="tracking-wider uppercase"><?php echo esc_html($about_kicker ?: 'مس کرمان زمین'); ?></span>
                    </div>

                    <!-- Title -->
                    <h2 class="text-4xl lg:text-5xl font-black text-navy mb-8 leading-relaxed font-peyda ">
                        <?php echo esc_html($about_title_rest ?: 'پیشگام در توسعه'); ?> <br>
                        <span
                            class="text-transparent bg-clip-text bg-gradient-to-l  from-copper-dark via-copper to-copper-light"><?php echo esc_html($about_title_highlight ?: 'صنعت استخراج مس'); ?></span>
                    </h2>

                    <!-- Description -->
                    <p class="text-slate-700 text-lg leading-relaxed mb-12 text-right font-medium max-w-xl">
                        <?php echo esc_html($about_description ?: 'صنایع و معادن مس کرمان زمین با تکیه بر دانش بومی و استفاده از تکنولوژی‌های روز دنیا، توانسته است ضمن حفظ محیط زیست، به یکی از بزرگترین قطب‌های تولیدی کشور تبدیل شود. تعهد ما به کیفیت و پایداری، مسیر آینده را روشن می‌سازد.'); ?>
                    </p>

                    <!-- Cards Grid -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 pt-10 border-t border-slate-200/80">
                        <!-- Card 1: Mission -->
                        <div
                            class="bg-white rounded-3xl p-7 border border-slate-200 shadow-[0_15px_40px_-10px_rgba(0,0,0,0.05)] hover:shadow-[0_25px_50px_-12px_rgba(200,104,47,0.15)] hover:-translate-y-1 hover:border-copper/40 transition-all duration-500 group/card flex flex-col relative overflow-hidden z-10">
                            <!-- Watermark background number -->
                            <div class="absolute -left-2 -bottom-2 text-7xl font-black text-slate-100/80 select-none group-hover/card:text-copper/10 transition-colors duration-500 font-peyda"
                                dir="ltr">01</div>

                            <!-- Icon Container -->
                            <div
                                class="w-12 h-12 rounded-2xl bg-gradient-to-br from-copper/10 to-copper/5 border border-copper/10 flex items-center justify-center text-copper mb-5 group-hover/card:scale-110 transition-all duration-500 relative">
                                <?php echo kermancopper_icon('target', 'w-6 h-6 relative z-10 transition-transform duration-700 group-hover/card:rotate-[360deg]'); ?>
                            </div>

                            <h4
                                class="font-extrabold text-navy text-lg mb-2.5 font-peyda group-hover/card:text-copper transition-colors duration-300 relative z-10">
                                <?php echo esc_html($about_mission_title ?: 'مأموریت ما'); ?></h4>
                            <p class="text-sm text-slate-600 leading-relaxed font-semibold relative z-10"><?php echo esc_html($about_mission_desc ?: 'تولید مس با بالاترین استانداردهای جهانی و توسعه پایدار اقتصادی.'); ?></p>
                        </div>

                        <!-- Card 2: Vision -->
                        <div
                            class="bg-white rounded-3xl p-7 border border-slate-200 shadow-[0_15px_40px_-10px_rgba(0,0,0,0.05)] hover:shadow-[0_25px_50px_-12px_rgba(200,104,47,0.15)] hover:-translate-y-1 hover:border-copper/40 transition-all duration-500 group/card flex flex-col relative overflow-hidden z-10">
                            <!-- Watermark background number -->
                            <div class="absolute -left-2 -bottom-2 text-7xl font-black text-slate-100/80 select-none group-hover/card:text-copper/10 transition-colors duration-500 font-peyda"
                                dir="ltr">02</div>

                            <!-- Icon Container -->
                            <div
                                class="w-12 h-12 rounded-2xl bg-gradient-to-br from-copper/10 to-copper/5 border border-copper/10 flex items-center justify-center text-copper mb-5 group-hover/card:scale-110 transition-all duration-500 relative">
                                <?php echo kermancopper_icon('eye', 'w-6 h-6 relative z-10 transition-transform duration-700 group-hover/card:rotate-[360deg]'); ?>
                            </div>

                            <h4
                                class="font-extrabold text-navy text-lg mb-2.5 font-peyda group-hover/card:text-copper transition-colors duration-300 relative z-10">
                                <?php echo esc_html($about_vision_title ?: 'چشم‌انداز'); ?></h4>
                            <p class="text-sm text-slate-600 leading-relaxed font-semibold relative z-10"><?php echo esc_html($about_vision_desc ?: 'قرارگیری در بین ۵ شرکت برتر تولیدکننده مس در سطح بین‌الملل.'); ?></p>
                        </div>
                    </div>
                </div>

                <!-- Image Composition (Editorial Staggered Layout) -->
                <div
                    class="lg:col-span-6 lg:col-start-7 relative h-[450px] lg:h-[600px] flex items-stretch gap-4 sm:gap-6 group z-10 px-2 sm:px-0">

                    <!-- Decorative Background Elements -->
                    <div
                        class="absolute -top-8 -right-8 w-40 h-40 rounded-full border border-copper/30 border-dashed animate-[spin_10s_linear_infinite] z-0 opacity-60 pointer-events-none">
                    </div>
                    <div
                        class="absolute bottom-20 -left-12 w-48 h-48 bg-copper/10 blur-[60px] rounded-full z-0 pointer-events-none">
                    </div>

                    <!-- Right Column (First flex child, Mine) -->
                    <div
                        class="w-1/2 h-[75%] lg:h-[80%] mt-0 relative z-10 transition-all duration-1000 ease-out group-hover:-translate-y-4 group-hover:rotate-1 about-fade-up opacity-0 translate-y-10 delay-[200ms]">
                        <div
                            class="about-parallax-item w-full h-full rounded-[2rem] sm:rounded-[3rem] overflow-hidden shadow-[0_20px_50px_rgba(0,0,0,0.1)] border-4 sm:border-8 border-white/80 bg-white relative">
                            <img src="<?php echo esc_url($about_image_1_url); ?>"
                                class="w-full h-full object-cover transition-transform duration-1000 ease-out hover:scale-110"
                                alt="Mine">
                            <div class="absolute inset-0 bg-navy/10 mix-blend-multiply pointer-events-none"></div>
                        </div>
                    </div>

                    <!-- Left Column (Second flex child, offset, Foundry) -->
                    <div
                        class="w-1/2 h-[85%] lg:h-[90%] mt-12 sm:mt-20 relative z-20 transition-all duration-1000 ease-out group-hover:-translate-y-6 group-hover:-rotate-1 about-fade-up opacity-0 translate-y-10 delay-[400ms]">
                        <div
                            class="about-parallax-item w-full h-full rounded-[2rem] sm:rounded-[3rem] overflow-hidden shadow-[0_30px_60px_-15px_rgba(200,104,47,0.15)] border-4 sm:border-8 border-white bg-white relative">
                            <img src="<?php echo esc_url($about_image_2_url); ?>"
                                class="w-full h-full object-cover transition-transform duration-1000 ease-out hover:scale-110"
                                alt="Foundry">
                            <div class="absolute inset-0 bg-navy/10 mix-blend-multiply pointer-events-none"></div>
                        </div>
                    </div>

                    <!-- Overlapping Horizontal Glass Badge -->
                    <div
                        class="absolute -bottom-6 sm:bottom-4 left-1/2 -translate-x-1/2 w-[90%] sm:w-max min-w-[320px] glass-panel-dark p-4 sm:p-5 lg:px-8 lg:py-6 rounded-[2rem] shadow-[0_25px_50px_-12px_rgba(26,34,53,0.5)] border border-white/10 z-30 flex items-center justify-between gap-6 sm:gap-10 transition-all duration-1000 hover:scale-105 hover:border-copper/40 hover:shadow-[0_30px_60px_-15px_rgba(200,104,47,0.3)] about-fade-up opacity-0 translate-y-10 delay-[600ms]">
                        <div class="flex items-center gap-3 sm:gap-4">
                            <div
                                class="w-10 h-10 sm:w-12 sm:h-12 rounded-2xl bg-gradient-to-br from-copper/20 to-copper/5 flex items-center justify-center border border-copper/20 shadow-inner flex-shrink-0">
                                <?php echo kermancopper_icon('gem', 'w-5 h-5 sm:w-6 sm:h-6 text-copper-light'); ?>
                            </div>
                            <div class="text-xs sm:text-sm font-bold text-slate-200 leading-relaxed">
                                <?php echo esc_html($about_experience_label); ?> <br>
                                <span class="text-slate-400 font-medium text-[10px] sm:text-xs"><?php echo esc_html($about_experience_sublabel); ?></span>
                            </div>
                        </div>
                        <div class="text-3xl sm:text-4xl lg:text-5xl font-black bg-gradient-to-l from-copper-light via-copper to-copper-dark bg-clip-text text-transparent font-peyda ml-2"
                            dir="ltr">+<span class="counter-up" data-target="<?php echo esc_attr(intval($about_years_exp) ?: 32); ?>">۰</span></div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ADS / TENDERS SECTION -->
    <section id="ads"
        class="py-32 bg-gradient-to-b from-[#FAF8F5] to-white relative overflow-hidden border-t border-slate-200/50 scroll-reveal">
        <!-- Dot Pattern Background -->
        <div
            class="absolute inset-0 bg-[radial-gradient(#c8c8c8_1px,transparent_1px)] bg-[size:24px_24px] opacity-30 pointer-events-none z-0">
        </div>

        <!-- Premium Ambient Background -->
        <div
            class="absolute top-0 right-0 w-[800px] h-[800px] bg-copper/5 rounded-full blur-[120px] -z-10 translate-x-1/2 -translate-y-1/2 pointer-events-none">
        </div>
        <div
            class="absolute bottom-0 left-0 w-[600px] h-[600px] bg-navy/5 rounded-full blur-[100px] -z-10 -translate-x-1/3 translate-y-1/3 pointer-events-none">
        </div>

        <div class="container mx-auto px-6 lg:px-12 relative z-10">
            <div class="flex flex-col md:flex-row justify-between items-end mb-16 gap-8">
                <div class="ads-fade-up opacity-0 translate-y-10 transition-all duration-[1000ms] ease-out">
                    <h4 class="text-copper font-bold tracking-widest mb-4 flex items-center gap-4 font-peyda">
                        <span class="w-12 h-0.5 bg-copper"></span> فرصت‌های همکاری
                    </h4>
                    <h2 class="text-4xl lg:text-5xl font-black text-navy tracking-tight font-peyda leading-relaxed">آگهی‌های مزایده و
                        مناقصه</h2>
                </div>
                <!-- Premium Filters -->
                <div
                    class="flex bg-white p-1.5 rounded-2xl shadow-sm border border-slate-200 ads-fade-up opacity-0 translate-y-10 transition-all duration-[1000ms] delay-[200ms] ease-out overflow-x-auto hide-scrollbar max-w-full">
                    <button
                        class="relative px-3 sm:px-6 md:px-8 py-2 sm:py-2.5 rounded-lg sm:rounded-xl font-bold text-xs sm:text-sm bg-copper text-white shadow-[0_4px_15px_rgba(200,104,47,0.3)] transition-all duration-300 z-10 transform scale-100 whitespace-nowrap flex-shrink-0">همه موارد</button>
                    <button
                        class="relative px-3 sm:px-6 md:px-8 py-2 sm:py-2.5 rounded-lg sm:rounded-xl font-bold text-xs sm:text-sm text-slate-500 hover:text-copper hover:bg-copper/5 hover:shadow-sm transition-all duration-300 z-10 whitespace-nowrap flex-shrink-0">مزایده</button>
                    <button
                        class="relative px-3 sm:px-6 md:px-8 py-2 sm:py-2.5 rounded-lg sm:rounded-xl font-bold text-xs sm:text-sm text-slate-500 hover:text-copper hover:bg-copper/5 hover:shadow-sm transition-all duration-300 z-10 whitespace-nowrap flex-shrink-0">مناقصه</button>
                    <button
                        class="relative px-3 sm:px-6 md:px-8 py-2 sm:py-2.5 rounded-lg sm:rounded-xl font-bold text-xs sm:text-sm text-slate-500 hover:text-copper hover:bg-copper/5 hover:shadow-sm transition-all duration-300 z-10 whitespace-nowrap flex-shrink-0">سایر</button>
                </div>
            </div>

            
            <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-8" id="ads-grid">
                <?php
                $ads_query = new WP_Query( array(
                    'post_type'      => 'kermancopper_ad',
                    'post_status'    => 'publish',
                    'posts_per_page' => 4,
                    'orderby'        => 'date',
                    'order'          => 'DESC',
                ) );
                ?>
                <?php if ( $ads_query->have_posts() ) : ?>
                    <?php $delay = 300; while ( $ads_query->have_posts() ) : $ads_query->the_post(); ?>
                        <?php
                        $ad_id = get_the_ID();
                        $ad_terms = get_the_terms( $ad_id, 'kermancopper_ad_type' );
                        $ad_term = ! empty( $ad_terms ) && ! is_wp_error( $ad_terms ) ? $ad_terms[0] : null;
                        $ad_type_slug = $ad_term ? $ad_term->slug : 'other';
                        $ad_type_label = $ad_term ? $ad_term->name : __( 'سایر', 'kermancopper' );
                        $ad_type_icon = 'file-text';
                        if ( $ad_term ) {
                            if ( strpos( $ad_term->slug, 'auction' ) !== false || strpos( $ad_term->name, 'مزایده' ) !== false ) {
                                $ad_type_icon = 'gavel';
                            } elseif ( strpos( $ad_term->slug, 'tender' ) !== false || strpos( $ad_term->name, 'مناقصه' ) !== false ) {
                                $ad_type_icon = 'file-text';
                            }
                        }
                        $thumbnail = get_the_post_thumbnail_url( $ad_id, 'kermancopper-ad-thumbnail' );
                        if ( ! $thumbnail ) {
                            $thumbnail = kermancopper_get_fallback_image();
                        }
                        $expiry_date = get_post_meta( $ad_id, KERMANCOPPER_AD_META_EXPIRY_DATE, true );
                        $expiry_display = kermancopper_ads_format_expiry_date_for_display( $expiry_date );
                        if ( $expiry_display === '' ) {
                            $expiry_display = '—';
                        }
                        $status = get_post_meta( $ad_id, KERMANCOPPER_AD_META_STATUS, true );
                        if ( $status === '' ) {
                            $today = current_time( 'Y-m-d' );
                            if ( $expiry_date && $expiry_date < $today ) {
                                $status = 'closed';
                            } else {
                                $status = 'active';
                            }
                        }
                        $status_label = $status === 'closed' ? __( 'منقضی', 'kermancopper' ) : __( 'فعال', 'kermancopper' );
                        $status_class = $status === 'closed'
                            ? 'bg-rose-50 text-rose-600 border border-rose-100/50'
                            : 'bg-emerald-50 text-emerald-600 border border-emerald-100/50';
                        ?>
                        <div class="ads-fade-up opacity-0 translate-y-10 transition-all duration-[1000ms] ease-out h-full ad-item" style="transition-delay: <?php echo esc_attr($delay); ?>ms" data-type="<?php echo esc_attr( $ad_type_slug ); ?>">
                            <a href="<?php echo esc_url( get_permalink() ); ?>" class="ads-parallax-item bg-white rounded-[2rem] p-4 shadow-[0_8px_30px_rgb(0,0,0,0.04)] border border-slate-200/60 hover:shadow-[0_20px_40px_-15px_rgba(200,104,47,0.15)] hover:border-copper/40 transition-all duration-500 group cursor-pointer flex flex-col h-full relative overflow-hidden block">
                                <div class="absolute inset-0 bg-gradient-to-br from-copper/5 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500 pointer-events-none"></div>
                                <div class="h-52 rounded-3xl overflow-hidden mb-6 relative shadow-inner">
                                    <img src="<?php echo esc_url( $thumbnail ); ?>" class="w-full h-full object-cover transition-transform duration-1000 group-hover:scale-110" alt="<?php echo esc_attr( get_the_title() ); ?>">
                                    <div class="absolute inset-0 bg-navy/0 group-hover:bg-navy/10 transition-colors duration-500 pointer-events-none"></div>
                                    <div class="absolute top-3 right-3 bg-white/95 backdrop-blur-md px-3.5 py-2 rounded-xl text-xs font-bold text-navy flex items-center gap-2 shadow-[0_4px_12px_rgba(0,0,0,0.08)] border border-white/20">
                                        <?php echo kermancopper_icon('<?php echo esc_attr($ad_type_icon); ?>', 'w-4 h-4 text-copper'); ?> <?php echo esc_html( $ad_type_label ); ?>
                                    </div>
                                </div>
                                <div class="px-2 flex-1 flex flex-col relative z-10">
                                    <h3 class="font-extrabold text-lg text-navy mb-4 leading-relaxed line-clamp-2 group-hover:text-copper transition-colors duration-300 font-peyda">
                                        <?php echo esc_html( get_the_title() ); ?>
                                    </h3>
                                    <div class="mt-auto pt-4 border-t border-slate-100/80 flex items-center justify-between">
                                        <div class="flex items-center gap-1.5 text-slate-500 text-sm font-medium">
                                            <?php echo kermancopper_icon('calendar', 'w-4 h-4 text-slate-400'); ?>
                                            <span class="text-[10px] text-slate-400">مهلت:</span> <?php echo esc_html( $expiry_display ); ?>
                                        </div>
                                        <span class="<?php echo esc_attr($status_class); ?> px-3 py-1.5 rounded-lg text-xs font-bold shadow-sm"><?php echo esc_html( $status_label ); ?></span>
                                    </div>
                                </div>
                            </a>
                        </div>
                    <?php $delay += 100; endwhile; ?>
                    <?php wp_reset_postdata(); ?>
                <?php else : ?>
                    <div class="col-span-full text-center text-slate-500 py-10">آگهی‌ای برای نمایش وجود ندارد.</div>
                <?php endif; ?>
            </div>
    
        </div>
    </section>

    <!-- NEWS & ANNOUNCEMENTS SECTION -->
    <section id="news" class="py-32 bg-navy relative overflow-hidden scroll-reveal">
        <!-- Ambient Background Glows -->
        <div
            class="absolute top-0 right-0 w-[600px] h-[600px] bg-copper/5 rounded-full blur-[120px] pointer-events-none">
        </div>
        <div
            class="absolute bottom-0 left-0 w-[500px] h-[500px] bg-sky-500/5 rounded-full blur-[100px] pointer-events-none">
        </div>

        <div class="container mx-auto px-6 lg:px-12 relative z-10">
            <div
                class="text-center mb-16 fade-up-element opacity-0 translate-y-10 transition-all duration-1000 ease-out">
                <h4
                    class="text-copper font-bold tracking-widest mb-4 flex items-center justify-center gap-4 font-peyda">
                    <span class="w-12 h-0.5 bg-copper"></span> پایگاه خبری و اطلاع‌رسانی <span
                        class="w-12 h-0.5 bg-copper"></span>
                </h4>
                <h2 class="text-4xl lg:text-5xl font-black text-white tracking-tight font-peyda leading-relaxed">تازه‌ترین اخبار و
                    اطلاعیه‌ها</h2>
            </div>

            
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 lg:gap-12 items-stretch">
                <!-- Latest News (Now on the right visually/first in DOM) -->
                <?php if ($news_has_content): ?>
                <div
                    class="lg:col-span-8 flex flex-col fade-up-element opacity-0 translate-y-10 transition-all duration-1000 delay-[200ms] ease-out h-full">
                    <div class="flex items-center justify-between mb-8">
                        <h3 class="text-2xl font-black text-white font-peyda flex items-center gap-3">
                            <div
                                class="w-10 h-10 rounded-xl bg-white/5 border border-white/10 flex items-center justify-center text-copper shadow-inner">
                                <?php echo kermancopper_icon('newspaper', 'w-5 h-5'); ?>
                            </div>
                            <?php echo esc_html($news_title ?: 'اخبار و رویدادها'); ?>
                        </h3>
                        <?php if ($news_archive_url): ?>
                        <a href="<?php echo esc_url($news_archive_url); ?>"
                            class="text-slate-400 hover:text-copper transition-colors text-sm font-bold flex items-center gap-1 group/link"><?php echo esc_html($news_archive_text ?: 'آرشیو اخبار'); ?> <?php echo kermancopper_icon('arrow-left', 'w-4 h-4 transition-transform group-hover/link:-translate-x-1'); ?></a>
                        <?php endif; ?>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 flex-1">
                        <?php 
                        // Featured News (First item)
                        $featured_news = isset($news_slides[0]) ? $news_slides[0] : null; 
                        if ($featured_news):
                        ?>
                        <a href="<?php echo esc_url($featured_news['url']); ?>"
                            class="news-parallax-item relative rounded-[2rem] overflow-hidden group shadow-[0_20px_50px_rgba(0,0,0,0.3)] border border-white/10 hover:border-copper/40 transition-colors duration-500 flex flex-col min-h-[400px] h-full">
                            <img src="<?php echo esc_url($featured_news['image']); ?>"
                                class="absolute inset-0 w-full h-full object-cover transition-transform duration-1000 group-hover:scale-105"
                                alt="<?php echo esc_attr($featured_news['title']); ?>">
                            <div
                                class="absolute inset-0 bg-gradient-to-t from-navy via-navy/60 to-transparent opacity-90 group-hover:opacity-100 transition-opacity duration-500">
                            </div>

                            <div class="absolute top-6 left-6">
                                <div
                                    class="w-10 h-10 rounded-full bg-navy/50 backdrop-blur-md border border-white/10 flex items-center justify-center text-white/50 group-hover:bg-copper group-hover:text-white group-hover:border-copper transition-all duration-300">
                                    <?php echo kermancopper_icon('arrow-up-left', 'w-5 h-5'); ?>
                                </div>
                            </div>

                            <div class="absolute bottom-0 left-0 right-0 p-8">
                                <?php if ( ! empty( $featured_news['badge'] ) ) : ?>
                                <span class="inline-block bg-white/10 backdrop-blur-md text-white border border-white/20 px-4 py-1.5 rounded-xl text-xs font-bold mb-4">
                                    <?php echo esc_html( $featured_news['badge'] ); ?>
                                </span>
                                <?php endif; ?>
                                <h3
                                    class="text-xl md:text-2xl font-black text-white leading-tight mb-4 group-hover:text-copper transition-colors font-peyda">
                                    <?php echo esc_html($featured_news['title']); ?>
                                </h3>
                                <p class="text-slate-300 text-sm line-clamp-2 leading-relaxed">
                                    <?php echo esc_html($featured_news['excerpt']); ?>
                                </p>
                            </div>
                        </a>
                        <?php endif; ?>

                        <div class="flex flex-col gap-6">
                            <?php 
                            // Other news
                            for ($i = 1; $i < min(3, count($news_slides)); $i++): 
                                $slide = $news_slides[$i];
                            ?>
                            <a href="<?php echo esc_url($slide['url']); ?>"
                                class="news-parallax-item relative rounded-[2rem] overflow-hidden group shadow-lg border border-white/10 flex-1 flex flex-col sm:flex-row bg-white/5 backdrop-blur-sm hover:bg-white/10 hover:border-copper/30 transition-all duration-300 h-full">
                                <div class="w-full sm:w-2/5 h-48 sm:h-full relative overflow-hidden">
                                    <img src="<?php echo esc_url($slide['image']); ?>"
                                        class="absolute inset-0 w-full h-full object-cover transition-transform duration-700 group-hover:scale-110"
                                        alt="<?php echo esc_attr($slide['title']); ?>">
                                </div>
                                <div class="w-full sm:w-3/5 p-6 flex flex-col justify-center relative z-10">
                                    <?php if ($news_show_date): ?>
                                    <div class="text-copper text-xs font-bold mb-3 flex items-center gap-1.5"><?php echo kermancopper_icon('clock', 'w-3.5 h-3.5'); ?> <?php echo esc_html($slide['date']); ?></div>
                                    <?php endif; ?>
                                    <h4
                                        class="text-base font-bold text-white leading-snug group-hover:text-copper transition-colors font-peyda mb-4 line-clamp-2">
                                        <?php echo esc_html($slide['title']); ?>
                                    </h4>
                                    <div
                                        class="mt-auto flex items-center text-slate-400 text-xs font-semibold group-hover:text-white transition-colors">
                                        بیشتر بخوانید <?php echo kermancopper_icon('chevron-left', 'w-4 h-4 mr-1'); ?>
                                    </div>
                                </div>
                            </a>
                            <?php endfor; ?>
                        </div>
                    </div>
                </div>
                <?php endif; ?>

                <!-- Announcements (Vertical Banners - Now on the left visually/second in DOM) -->
                <?php if ($notices_has_content): ?>
                <div
                    class="lg:col-span-4 flex flex-col fade-up-element opacity-0 translate-y-10 transition-all duration-1000 delay-[400ms] ease-out h-[400px] sm:h-[500px] lg:h-full min-h-0">
                    <div class="flex items-center justify-between mb-8 shrink-0">
                        <h3 class="text-2xl font-black text-white font-peyda flex items-center gap-3">
                            <div
                                class="w-10 h-10 rounded-xl bg-white/5 border border-white/10 flex items-center justify-center text-copper shadow-inner">
                                <?php echo kermancopper_icon('bell', 'w-5 h-5'); ?>
                            </div>
                            <?php echo esc_html($notices_title ?: 'اطلاعیه‌ها'); ?>
                        </h3>
                        <?php if ($notices_archive_url): ?>
                        <a href="<?php echo esc_url($notices_archive_url); ?>"
                            class="text-slate-400 hover:text-copper transition-colors text-sm font-bold flex items-center gap-1 group/link"><?php echo esc_html($notices_archive_text ?: 'همه'); ?>
                            <?php echo kermancopper_icon('arrow-left', 'w-4 h-4 transition-transform group-hover/link:-translate-x-1'); ?></a>
                        <?php endif; ?>
                    </div>

                    <!-- Vertical Banner Carousel -->
                    <div
                        class="news-parallax-item relative flex-1 min-h-0 h-full rounded-[2rem] overflow-hidden shadow-[0_20px_50px_rgba(0,0,0,0.3)] border border-white/10 hover:border-copper/40 transition-colors duration-500">
                        <div id="announcements-carousel"
                            class="flex h-full w-full overflow-x-auto overflow-y-hidden snap-x snap-mandatory scrollbar-hide [&::-webkit-scrollbar]:hidden [-ms-overflow-style:none] [scrollbar-width:none] cursor-grab active:cursor-grabbing">

                            <?php foreach ($notices_items as $index => $notice): ?>
                            <!-- Slide -->
                            <a href="<?php echo esc_url($notice['url']); ?>" class="relative w-full h-full flex-shrink-0 snap-center group block">
                                <img src="<?php echo esc_url($notice['image']); ?>"
                                    class="absolute inset-0 w-full h-full object-cover transition-transform duration-1000 group-hover:scale-110"
                                    alt="<?php echo esc_attr($notice['title']); ?>">
                                <div
                                    class="absolute inset-0 bg-gradient-to-t from-navy via-navy/60 to-navy/10 group-hover:via-navy/50 transition-all duration-500">
                                </div>

                                <div class="absolute top-6 right-6">
                                    <?php if ( ! empty( $notice['badge'] ) ) : ?>
                                    <span class="bg-copper/90 backdrop-blur-md text-white px-3.5 py-2 rounded-xl text-xs font-bold shadow-[0_4px_15px_rgba(200,104,47,0.4)] border border-white/20 flex items-center gap-2">
                                        <?php echo esc_html( $notice['badge'] ); ?>
                                    </span>
                                    <?php endif; ?>
                                </div>

                                <div class="absolute bottom-12 left-0 right-0 p-8">
                                    <?php if ($notices_show_date): ?>
                                    <div class="text-copper-light text-sm font-bold mb-3 flex items-center gap-2">
                                        <?php echo kermancopper_icon('calendar', 'w-4 h-4'); ?> <?php echo esc_html($notice['date']); ?>
                                    </div>
                                    <?php endif; ?>
                                    <h4
                                        class="text-2xl font-black text-white leading-tight group-hover:text-copper-light transition-colors font-peyda mb-6">
                                        <?php echo esc_html($notice['title']); ?>
                                    </h4>
                                    <div
                                        class="inline-flex items-center gap-3 text-white/80 hover:text-white group/btn">
                                        <span class="text-sm font-bold">مشاهده کامل اطلاعیه</span>
                                        <span
                                            class="w-10 h-10 rounded-full bg-white/10 backdrop-blur-sm border border-white/20 flex items-center justify-center group-hover/btn:bg-copper group-hover/btn:border-copper group-hover/btn:shadow-[0_0_20px_rgba(200,104,47,0.4)] transition-all duration-300">
                                            <?php echo kermancopper_icon('arrow-left', 'w-4 h-4'); ?>
                                        </span>
                                    </div>
                                </div>
                            </a>
                            <?php endforeach; ?>
                        </div>

                        <?php if (count($notices_items) > 1): ?>
                        <!-- Carousel Navigation -->
                        <div
                            class="absolute inset-y-0 left-0 right-0 flex items-center justify-between px-2 sm:px-4 pointer-events-none z-20">
                            <!-- Next (Right side visually because of absolute, but left arrow in RTL) -->
                            <button id="ann-next-btn" type="button"
                                class="w-10 h-10 rounded-full bg-white/10 backdrop-blur-md border border-white/20 flex items-center justify-center text-white hover:bg-copper hover:text-white hover:border-copper hover:scale-110 hover:shadow-[0_0_15px_rgba(200,104,47,0.6)] transition-all duration-300 pointer-events-auto">
                                <?php echo kermancopper_icon('chevron-right', 'w-5 h-5'); ?>
                            </button>
                            <!-- Prev (Left side visually, right arrow in RTL) -->
                            <button id="ann-prev-btn" type="button"
                                class="w-10 h-10 rounded-full bg-white/10 backdrop-blur-md border border-white/20 flex items-center justify-center text-white hover:bg-copper hover:text-white hover:border-copper hover:scale-110 hover:shadow-[0_0_15px_rgba(200,104,47,0.6)] transition-all duration-300 pointer-events-auto">
                                <?php echo kermancopper_icon('chevron-left', 'w-5 h-5'); ?>
                            </button>
                        </div>

                        <!-- Carousel Indicators -->
                        <div class="absolute bottom-6 left-1/2 -translate-x-1/2 flex items-center gap-2 z-20">
                            <?php foreach ($notices_items as $index => $notice): ?>
                            <button type="button"
                                class="<?php echo $index === 0 ? 'w-6 h-1.5 bg-white' : 'w-1.5 h-1.5 bg-white/40'; ?> rounded-full transition-all duration-300"></button>
                            <?php endforeach; ?>
                        </div>
                        <?php endif; ?>
                    </div>
                </div>
                <?php endif; ?>
            </div>

        </div>
    </section>

    <!-- FAQ SECTION -->
    <section id="faq" class="pt-32 pb-40 bg-gradient-to-b from-slate-50 to-white relative z-10 overflow-hidden scroll-reveal">
        <!-- Decorative Pattern -->
        <div class="absolute inset-0 opacity-30 pointer-events-none z-0"
            style="background-image: url('<?php echo get_template_directory_uri(); ?>/images/bpattern.png'); background-repeat: repeat; background-size: contain; background-position:top right;">
        </div>

        <!-- Ambient Glows -->
        <div
            class="absolute top-[10%] left-[-10%] w-[50%] h-[50%] bg-copper/5 blur-[120px] rounded-full pointer-events-none">
        </div>
        <div
            class="absolute bottom-[-10%] right-[-10%] w-[40%] h-[40%] bg-navy/5 blur-[100px] rounded-full pointer-events-none">
        </div>

        <div class="container mx-auto px-6 lg:px-12 relative z-10">
            <div
                class="max-w-4xl mx-auto text-center mb-24 fade-up-element opacity-0 translate-y-10 transition-all duration-1000 ease-out">
                <h4
                    class="text-copper font-bold tracking-widest mb-4 flex items-center justify-center gap-4 font-peyda">
                    <span class="w-12 h-0.5 bg-copper/30"></span> <?php echo esc_html($faq_kicker ?: 'پشتیبانی و راهنمایی'); ?> <span
                        class="w-12 h-0.5 bg-copper/30"></span>
                </h4>
                <h2 class="text-4xl lg:text-5xl font-black text-navy mb-6 font-peyda leading-relaxed"><?php echo esc_html($faq_title ?: 'سوالات متداول'); ?></h2>
                <p class="text-slate-500 text-lg max-w-2xl mx-auto"><?php echo esc_html($faq_description ?: 'پاسخ به پرتکرارترین پرسش‌های شما در زمینه ثبت‌نام در مناقصات، نحوه همکاری و استخدام در صنایع و معادن مس کرمان زمین.'); ?></p>
            </div>

            
            <div class="max-w-4xl mx-auto space-y-6 relative">
                <!-- Decorative Elements -->
                <div
                    class="absolute -left-12 top-20 w-24 h-24 border border-copper/20 rounded-full border-dashed animate-[spin_15s_linear_infinite] z-0 pointer-events-none hidden lg:block">
                </div>

                <?php if ($faq_has_items): ?>
                <?php foreach ($faq_items as $index => $faq_item): ?>
                <div class="faq-item faq-fade-up opacity-0 translate-y-10 transition-all duration-[1000ms] delay-[<?php echo esc_attr(($index+1)*100); ?>ms] ease-out bg-white rounded-3xl border border-slate-100/80 shadow-[0_10px_40px_-10px_rgba(0,0,0,0.05)] hover:shadow-[0_20px_50px_-15px_rgba(200,104,47,0.15)] hover:border-copper/30 relative z-10 group"
                    data-active="<?php echo $index === 0 ? 'true' : 'false'; ?>">
                    <button class="w-full text-right p-8 flex justify-between items-center focus:outline-none"
                        onclick="toggleFaq(this)">
                        <span
                            class="font-bold text-lg md:text-xl <?php echo $index === 0 ? 'text-copper border-copper' : 'text-navy border-transparent group-hover:text-copper group-hover:border-copper/50'; ?> transition-colors font-peyda pr-2 border-r-4">
                            <?php echo esc_html($faq_item['question']); ?>
                        </span>
                        <div
                            class="faq-icon w-12 h-12 rounded-2xl <?php echo $index === 0 ? 'bg-copper/10 text-copper rotate-180' : 'bg-slate-50 text-slate-400 group-hover:bg-copper/10 group-hover:text-copper'; ?> flex items-center justify-center shrink-0 transition-transform duration-500">
                            <?php echo kermancopper_icon('chevron-down', 'w-6 h-6'); ?>
                        </div>
                    </button>
                    <div class="faq-content px-8 overflow-hidden transition-all duration-500 <?php echo $index === 0 ? 'pb-8 pt-2' : 'max-h-0 opacity-0 pb-0 pt-0'; ?>"
                        <?php if ($index === 0) echo 'style="max-height: 500px; opacity: 1;"'; ?>>
                        <p class="text-slate-600 leading-relaxed text-justify md:pl-16">
                            <?php echo esc_html($faq_item['answer']); ?>
                        </p>
                    </div>
                </div>
                <?php endforeach; ?>
                <?php endif; ?>
            </div>

        </div>
    </section>

    <!-- CONTACT SECTION -->
    <section class="py-32 bg-navy relative overflow-hidden border-t border-white/5 scroll-reveal">
        <!-- Glowing Orbs -->
        <div
            class="absolute top-[20%] right-[10%] w-[400px] h-[400px] bg-copper/10 rounded-full blur-[140px] pointer-events-none">
        </div>
        <div
            class="absolute bottom-[10%] left-[5%] w-[500px] h-[500px] bg-sky-500/10 rounded-full blur-[140px] pointer-events-none">
        </div>

        <div class="container mx-auto px-6 lg:px-12 relative z-10">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-16 lg:gap-12 items-center">
                <!-- Form Area -->
                <div
                    class="lg:col-span-5 contact-fade-up opacity-0 translate-y-10 transition-all duration-1000 delay-[200ms] ease-out">
                    <div class="mb-12">
                        <h4 class="text-copper font-bold tracking-widest mb-4 flex items-center gap-3 font-peyda">
                            <span class="w-8 h-0.5 bg-copper"></span> صدای شما
                        </h4>
                        <h2 class="text-4xl lg:text-5xl font-black text-white mb-6 font-peyda leading-relaxed">در ارتباط باشیم</h2>
                        <p class="text-slate-300 leading-relaxed font-light text-lg">
                            نظرات، پیشنهادات و درخواست‌های خود را با ما در میان بگذارید. تیم پشتیبانی صنایع و معادن مس کرمان زمین در
                            اسرع وقت پاسخگوی شما خواهد بود.
                        </p>
                    </div>

                    <form id="frontContactForm" class="space-y-5 relative z-10" onsubmit="handleFrontFormSubmit(event)">
                        <div class="relative group">
                            <input type="text" id="front_name" name="name" required
                                class="peer w-full bg-white/5 border border-white/10 rounded-2xl px-6 py-5 text-white placeholder-transparent focus:outline-none focus:border-copper focus:bg-white/10 transition-all"
                                placeholder="نام و نام خانوادگی">
                            <label for="front_name"
                                class="absolute right-6 -top-2.5 bg-navy px-2 text-sm text-copper transition-all peer-placeholder-shown:text-slate-400 peer-placeholder-shown:top-5 peer-placeholder-shown:bg-transparent peer-focus:-top-2.5 peer-focus:text-copper peer-focus:bg-navy font-medium cursor-text">نام
                                و نام خانوادگی *</label>
                        </div>
                        <div class="relative group">
                            <input type="text" id="front_email" name="contact_info" required
                                class="peer w-full bg-white/5 border border-white/10 rounded-2xl px-6 py-5 text-white placeholder-transparent focus:outline-none focus:border-copper focus:bg-white/10 transition-all"
                                placeholder="ایمیل یا شماره تماس" dir="ltr">
                            <label for="front_email"
                                class="absolute right-6 -top-2.5 bg-navy px-2 text-sm text-copper transition-all peer-placeholder-shown:text-slate-400 peer-placeholder-shown:top-5 peer-placeholder-shown:bg-transparent peer-focus:-top-2.5 peer-focus:text-copper peer-focus:bg-navy font-medium cursor-text">ایمیل
                                یا موبایل *</label>
                        </div>
                        <div class="relative group">
                            <select id="front_subject" name="subject" required
                                class="w-full bg-white/5 border border-white/10 rounded-2xl px-6 py-5 text-white focus:outline-none focus:border-copper focus:bg-white/10 transition-all font-semibold appearance-none cursor-pointer">
                                <option value="" disabled selected class="text-navy bg-navy-light">موضوع پیام را انتخاب کنید</option>
                                <option value="public_relations" class="text-navy bg-white">روابط عمومی و رسانه</option>
                                <option value="tenders" class="text-navy bg-white">مناقصات و مزایدات</option>
                                <option value="sales" class="text-navy bg-white">فروش و بازرگانی</option>
                                <option value="human_resources" class="text-navy bg-white">استخدام و منابع انسانی</option>
                                <option value="other" class="text-navy bg-white">سایر موضوعات</option>
                            </select>
                            <label for="front_subject" class="absolute right-6 -top-2.5 bg-navy px-2 text-xs text-copper font-bold transition-colors">بخش مربوطه *</label>
                            <div class="absolute left-6 top-1/2 -translate-y-1/2 pointer-events-none text-slate-400 group-focus-within:text-copper transition-colors">
                                <?php echo kermancopper_icon('chevron-down', 'w-5 h-5'); ?>
                            </div>
                        </div>
                        <div class="relative group">
                            <textarea id="front_message" name="message" rows="4" required
                                class="peer w-full bg-white/5 border border-white/10 rounded-2xl px-6 py-5 text-white placeholder-transparent focus:outline-none focus:border-copper focus:bg-white/10 transition-all resize-none"
                                placeholder="پیام شما..."></textarea>
                            <label for="front_message"
                                class="absolute right-6 -top-2.5 bg-navy px-2 text-sm text-copper transition-all peer-placeholder-shown:text-slate-400 peer-placeholder-shown:top-5 peer-placeholder-shown:bg-transparent peer-focus:-top-2.5 peer-focus:text-copper peer-focus:bg-navy font-medium cursor-text">پیام
                                شما *</label>
                        </div>
                        <button type="submit"
                            class="w-full bg-gradient-to-r from-copper-dark via-copper to-copper-light text-white font-black text-lg py-5 rounded-2xl transition-all shadow-[0_10px_30px_rgba(200,104,47,0.3)] hover:shadow-[0_15px_40px_rgba(200,104,47,0.5)] hover:-translate-y-1 mt-4 group relative overflow-hidden">
                            <span
                                class="absolute inset-0 bg-white/20 translate-y-full group-hover:translate-y-0 transition-transform duration-500 ease-out"></span>
                            <span class="relative flex items-center justify-center gap-2">
                                ارسال پیام <?php echo kermancopper_icon('send', 'w-5 h-5 transition-transform duration-300 group-hover:-translate-y-1 group-hover:translate-x-1'); ?>
                            </span>
                        </button>
                    </form>
                    <div id="frontFormAlert" class="hidden mt-6 p-5 rounded-2xl text-sm font-bold flex items-center gap-3"></div>
                </div>

                <!-- Info & Map Area -->
                <div
                    class="lg:col-span-7 contact-fade-up opacity-0 translate-y-10 transition-all duration-1000 delay-[400ms] ease-out h-full flex flex-col gap-6 mt-12 lg:mt-0">

                    <!-- Premium Map Card -->
                    <div
                        class="w-full h-64 sm:h-80 rounded-[2rem] overflow-hidden relative group border border-white/10 shadow-2xl z-10 bg-navy-light flex items-center justify-center">
                        <?php if ( ! empty( $contact_map_link ) ) : ?>
                        <a href="<?php echo esc_url( $contact_map_link ); ?>" target="_blank" rel="noopener noreferrer" class="absolute inset-0 z-20"></a>
                        <?php endif; ?>
                        <?php
                        $map_img_src = ! empty( $contact_map_image ) ? $contact_map_image : get_template_directory_uri() . '/images/map-dark.jpg';
                        ?>
                        <img src="<?php echo esc_url( $map_img_src ); ?>" alt="نقشه"
                            class="absolute inset-0 w-full h-full object-cover grayscale opacity-50 group-hover:grayscale-[50%] group-hover:opacity-80 transition-all duration-1000 group-hover:scale-105">
                        <div
                            class="absolute inset-0 bg-gradient-to-t from-navy via-navy/40 to-transparent pointer-events-none">
                        </div>

                        <!-- Map Pin -->
                        <div
                            class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 flex flex-col items-center">
                            <div
                                class="w-16 h-16 rounded-full bg-copper/20 flex items-center justify-center animate-pulse">
                                <div
                                    class="w-10 h-10 rounded-full bg-copper flex items-center justify-center shadow-[0_0_20px_rgba(200,104,47,0.8)]">
                                    <?php echo kermancopper_icon('map-pin', 'w-5 h-5 text-white'); ?>
                                </div>
                            </div>
                            <div
                                class="mt-4 bg-white/10 backdrop-blur-md px-4 py-2 rounded-xl border border-white/20 text-white font-bold text-sm shadow-lg pointer-events-none">
                                صنایع و معادن مس کرمان زمین
                            </div>
                        </div>
                    </div>

                    <!-- Contact Details Cards -->
                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-6 flex-1">
                        <!-- Address -->
                        <div
                            class="bg-white/5 backdrop-blur-sm border border-white/10 rounded-[2rem] p-6 sm:p-8 hover:bg-white/10 hover:border-copper/40 transition-all duration-500 group flex flex-col items-center justify-center text-center shadow-lg h-full">
                            <div
                                class="w-14 h-14 rounded-2xl bg-copper/10 text-copper flex items-center justify-center mb-5 group-hover:scale-110 group-hover:bg-copper group-hover:text-white transition-all duration-500 flex-shrink-0">
                                <?php echo kermancopper_icon('map', 'w-6 h-6'); ?>
                            </div>
                            <h5 class="text-white font-bold text-base mb-2 font-peyda">آدرس</h5>
                            <div class="text-sm text-slate-400 leading-relaxed font-medium space-y-2">
                                <?php foreach ( $contact_addresses as $addr_item ) : 
                                    if ( ! empty( $addr_item['address'] ) ) : ?>
                                        <div><?php echo nl2br( esc_html( $addr_item['address'] ) ); ?></div>
                                    <?php endif;
                                endforeach; ?>
                            </div>
                        </div>
                        <!-- Phone -->
                        <div
                            class="bg-white/5 backdrop-blur-sm border border-white/10 rounded-[2rem] p-6 sm:p-8 hover:bg-white/10 hover:border-copper/40 transition-all duration-500 group flex flex-col items-center justify-center text-center shadow-lg h-full">
                            <div
                                class="w-14 h-14 rounded-2xl bg-copper/10 text-copper flex items-center justify-center mb-5 group-hover:scale-110 group-hover:bg-copper group-hover:text-white transition-all duration-500 flex-shrink-0">
                                <?php echo kermancopper_icon('phone-call', 'w-6 h-6'); ?>
                            </div>
                            <h5 class="text-white font-bold text-base mb-2 font-peyda">شماره تماس</h5>
                            <p class="text-sm text-slate-400 leading-relaxed font-medium" dir="ltr">
                                <?php 
                                if ( ! empty( $contact_phones ) ) {
                                    $phones_list = wp_list_pluck( $contact_phones, 'phone' );
                                    echo implode( '<br>', array_map( 'esc_html', $phones_list ) );
                                } else {
                                    echo '۰۳۴ - ۳۴۳۰ ۰۰۰۰'; // Fallback
                                }
                                ?>
                            </p>
                        </div>
                        <!-- Email -->
                        <div
                            class="bg-white/5 backdrop-blur-sm border border-white/10 rounded-[2rem] p-6 sm:p-8 hover:bg-white/10 hover:border-copper/40 transition-all duration-500 group flex flex-col items-center justify-center text-center shadow-lg h-full">
                            <div
                                class="w-14 h-14 rounded-2xl bg-copper/10 text-copper flex items-center justify-center mb-5 group-hover:scale-110 group-hover:bg-copper group-hover:text-white transition-all duration-500 flex-shrink-0">
                                <?php echo kermancopper_icon('mail', 'w-6 h-6'); ?>
                            </div>
                            <h5 class="text-white font-bold text-base mb-2 font-peyda">پست الکترونیک</h5>
                            <p class="text-sm text-slate-400 leading-relaxed font-medium" dir="ltr">
                                <?php 
                                if ( ! empty( $contact_emails ) ) {
                                    $emails_list = wp_list_pluck( $contact_emails, 'email' );
                                    echo implode( '<br>', array_map( 'esc_html', $emails_list ) );
                                } else {
                                    echo 'info@kermancopper.ir'; // Fallback
                                }
                                ?>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>

<script>
(function() {
    // Run shimmer once after pattern slide-in finishes (~2.5s)
    var wrapper = document.querySelector('.hero-pattern-left-wrapper');
    var shimmer = document.querySelector('.hero-pattern-shimmer');
    if (!wrapper || !shimmer) return;

    function playShimmer() {
        shimmer.classList.remove('shimmer-play');
        // Force reflow to restart animation
        void shimmer.offsetWidth;
        shimmer.classList.add('shimmer-play');
    }

    // Initial play after slide-in completes
    setTimeout(function() {
        wrapper.classList.add('pattern-visible');
        playShimmer();
    }, 2600);

    // Replay on hover
    wrapper.addEventListener('mouseenter', function() {
        // Only replay if not in the middle of initial animation
        if (wrapper.classList.contains('pattern-visible')) {
            playShimmer();
        }
    });
})();
</script>

<script>
function handleFrontFormSubmit(event) {
    event.preventDefault();
    const form = event.target;
    const btn = form.querySelector('button[type="submit"]');
    const alertDiv = document.getElementById('frontFormAlert');
    
    if (!btn) return;
    
    btn.setAttribute('disabled', 'true');
    const originalContent = btn.innerHTML;
    btn.innerHTML = '<span class="flex items-center justify-center gap-2"><svg class="animate-spin h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg> در حال ارسال...</span>';

    const formData = new FormData(form);
    formData.append('action', 'kermancopper_submit_contact_form');

    fetch('<?php echo esc_url( admin_url( 'admin-ajax.php' ) ); ?>', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            alertDiv.className = 'mt-6 p-5 rounded-2xl bg-emerald-500/10 border border-emerald-500/20 text-emerald-400 text-sm font-bold flex items-center gap-3';
            alertDiv.innerHTML = '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-5 h-5 flex-shrink-0"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><path d="m9 11 3 3L22 4"/></svg> <span>' + data.data.message + '</span>';
            alertDiv.classList.remove('hidden');
            form.reset();
        } else {
            alertDiv.className = 'mt-6 p-5 rounded-2xl bg-rose-500/10 border border-rose-500/20 text-rose-400 text-sm font-bold flex items-center gap-3';
            alertDiv.innerHTML = '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-5 h-5 flex-shrink-0"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg> <span>' + (data.data ? data.data.message : 'خطایی رخ داد.') + '</span>';
            alertDiv.classList.remove('hidden');
        }
    })
    .catch(err => {
        alertDiv.className = 'mt-6 p-5 rounded-2xl bg-rose-500/10 border border-rose-500/20 text-rose-400 text-sm font-bold flex items-center gap-3';
        alertDiv.innerHTML = '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-5 h-5 flex-shrink-0"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg> <span>اتصال برقرار نشد. لطفاً اینترنت خود را بررسی کنید.</span>';
        alertDiv.classList.remove('hidden');
    })
    .finally(() => {
        btn.innerHTML = originalContent;
        btn.removeAttribute('disabled');
        setTimeout(() => {
            alertDiv.classList.add('hidden');
        }, 5000);
    });
}
</script>

<?php get_footer(); ?>

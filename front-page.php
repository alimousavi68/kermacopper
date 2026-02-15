<?php get_header(); ?>

    <main>
        <?php
        $hero_slide_1_image_id = absint( kermancopper_get_home_setting( 'kermancopper_home_hero_slide_1_image_id' ) );
        $hero_slide_1_image_src = $hero_slide_1_image_id ? wp_get_attachment_image_url( $hero_slide_1_image_id, 'full' ) : '';
        $hero_slide_1_alt = kermancopper_get_home_setting( 'kermancopper_home_hero_slide_1_alt' );
        $hero_slide_2_image_id = absint( kermancopper_get_home_setting( 'kermancopper_home_hero_slide_2_image_id' ) );
        $hero_slide_2_image_src = $hero_slide_2_image_id ? wp_get_attachment_image_url( $hero_slide_2_image_id, 'full' ) : '';
        $hero_slide_2_alt = kermancopper_get_home_setting( 'kermancopper_home_hero_slide_2_alt' );
        $hero_pattern_image_id = absint( kermancopper_get_home_setting( 'kermancopper_home_hero_pattern_image_id' ) );
        $hero_pattern_image_src = $hero_pattern_image_id ? wp_get_attachment_image_url( $hero_pattern_image_id, 'full' ) : '';
        $hero_title = kermancopper_get_home_setting( 'kermancopper_home_hero_title' );
        $hero_subtitle = kermancopper_get_home_setting( 'kermancopper_home_hero_subtitle' );
        $hero_description = kermancopper_get_home_setting( 'kermancopper_home_hero_description' );
        $hero_button_primary_text = kermancopper_get_home_setting( 'kermancopper_home_hero_button_primary_text' );
        $hero_button_primary_url = kermancopper_get_home_setting( 'kermancopper_home_hero_button_primary_url' );
        $hero_button_secondary_text = kermancopper_get_home_setting( 'kermancopper_home_hero_button_secondary_text' );
        $hero_button_secondary_url = kermancopper_get_home_setting( 'kermancopper_home_hero_button_secondary_url' );
        $hero_slides = array();
        if ( $hero_slide_1_image_src ) {
            $hero_slides[] = array(
                'src' => $hero_slide_1_image_src,
                'alt' => $hero_slide_1_alt,
            );
        }
        if ( $hero_slide_2_image_src ) {
            $hero_slides[] = array(
                'src' => $hero_slide_2_image_src,
                'alt' => $hero_slide_2_alt,
            );
        }
        ?>
        <!-- Hero Section -->
        <div class="relative h-[calc(100vh-200px)] sm:h-[80vh] flex items-center overflow-hidden mt-[100px] sm:mt-[125px]">
            <div class="absolute inset-0 z-0" id="hero-slider">
                <?php foreach ( $hero_slides as $index => $slide ) : ?>
                    <div class="hero-slide absolute inset-0 transition-opacity duration-1000 <?php echo $index === 0 ? 'opacity-100' : 'opacity-0'; ?>" data-index="<?php echo esc_attr( $index ); ?>">
                        <img src="<?php echo esc_url( $slide['src'] ); ?>" class="w-full h-full object-cover" alt="<?php echo esc_attr( $slide['alt'] ); ?>" />
                        <div class="absolute inset-0 hero-gradient"></div>
                    </div>
                <?php endforeach; ?>
            </div>

            <?php if ( $hero_pattern_image_src ) : ?>
            <div class="absolute left-0 top-0 bottom-0 w-1/3 opacity-60 pointer-events-none z-10 pattern-bg" style="background-image: url('<?php echo esc_url( $hero_pattern_image_src ); ?>'); background-repeat: no-repeat; background-position: right center; background-size: contain; transform: scaleX(-1) translateY(-6.25px); filter: invert(1);" data-flipped="true"></div>
            <?php endif; ?>

            <div class="container mx-auto px-4 z-10 text-white">
                <div class="max-w-3xl fade-in-section">
                    <?php if ( $hero_title || $hero_subtitle ) : ?>
                    <h1 class="text-4xl md:text-6xl font-black mb-6 leading-tight">
                        <?php if ( $hero_title ) : ?>
                            <?php echo esc_html( $hero_title ); ?>
                        <?php endif; ?>
                        <?php if ( $hero_subtitle ) : ?>
                            <br /> <span class="text-2xl md:text-5xl font-light opacity-90 block mt-6"><?php echo esc_html( $hero_subtitle ); ?></span>
                        <?php endif; ?>
                    </h1>
                    <?php endif; ?>
                    <?php if ( $hero_description ) : ?>
                    <p class="text-base md:text-lg mb-10 text-slate-200 leading-relaxed font-light max-w-2xl opacity-80">
                        <?php echo esc_html( $hero_description ); ?>
                    </p>
                    <?php endif; ?>
                    <?php if ( ( $hero_button_primary_text && $hero_button_primary_url ) || ( $hero_button_secondary_text && $hero_button_secondary_url ) ) : ?>
                    <div class="flex flex-wrap gap-4">
                        <?php if ( $hero_button_primary_text && $hero_button_primary_url ) : ?>
                        <a href="<?php echo esc_url( $hero_button_primary_url ); ?>" class="bg-copper hover:opacity-90 text-white px-10 py-4 rounded-sm font-bold transition-all shadow-xl text-sm md:text-base tracking-wide border border-transparent">
                            <?php echo esc_html( $hero_button_primary_text ); ?>
                        </a>
                        <?php endif; ?>
                        <?php if ( $hero_button_secondary_text && $hero_button_secondary_url ) : ?>
                        <a href="<?php echo esc_url( $hero_button_secondary_url ); ?>" class="bg-white/10 hover:bg-white/20 backdrop-blur-md border border-white/30 text-white px-10 py-4 rounded-sm font-bold transition-all text-sm md:text-base tracking-wide">
                            <?php echo esc_html( $hero_button_secondary_text ); ?>
                        </a>
                        <?php endif; ?>
                    </div>
                    <?php endif; ?>
                </div>
            </div>

            <?php if ( count( $hero_slides ) > 1 ) : ?>
            <div class="absolute bottom-10 left-1/2 -translate-x-1/2 flex gap-3 z-10">
                <?php foreach ( $hero_slides as $index => $slide ) : ?>
                    <button class="hero-dot <?php echo $index === 0 ? 'w-6 h-2.5 bg-copper' : 'w-2.5 h-2.5 bg-white/40'; ?> rounded-full transition-all duration-300" data-index="<?php echo esc_attr( $index ); ?>"></button>
                <?php endforeach; ?>
            </div>
            <?php endif; ?>
        </div>

        <?php
        $about_kicker = kermancopper_get_home_setting( 'kermancopper_home_about_kicker' );
        $about_title_highlight = kermancopper_get_home_setting( 'kermancopper_home_about_title_highlight' );
        $about_title_rest = kermancopper_get_home_setting( 'kermancopper_home_about_title_rest' );
        $about_description = kermancopper_get_home_setting( 'kermancopper_home_about_description' );
        $about_mission_title = kermancopper_get_home_setting( 'kermancopper_home_about_mission_title' );
        $about_mission_text = kermancopper_get_home_setting( 'kermancopper_home_about_mission_text' );
        $about_vision_title = kermancopper_get_home_setting( 'kermancopper_home_about_vision_title' );
        $about_vision_text = kermancopper_get_home_setting( 'kermancopper_home_about_vision_text' );
        $about_button_primary_text = kermancopper_get_home_setting( 'kermancopper_home_about_button_primary_text' );
        $about_button_primary_url = kermancopper_get_home_setting( 'kermancopper_home_about_button_primary_url' );
        $about_button_secondary_text = kermancopper_get_home_setting( 'kermancopper_home_about_button_secondary_text' );
        $about_button_secondary_url = kermancopper_get_home_setting( 'kermancopper_home_about_button_secondary_url' );
        $about_pattern_image_id = absint( kermancopper_get_home_setting( 'kermancopper_home_about_pattern_image_id' ) );
        $about_pattern_image_src = $about_pattern_image_id ? wp_get_attachment_image_url( $about_pattern_image_id, 'full' ) : '';
        $about_main_image_id = absint( kermancopper_get_home_setting( 'kermancopper_home_about_main_image_id' ) );
        $about_main_image_src = $about_main_image_id ? wp_get_attachment_image_url( $about_main_image_id, 'full' ) : '';
        $about_experience_count = absint( kermancopper_get_home_setting( 'kermancopper_home_about_experience_count' ) );
        $about_experience_label = kermancopper_get_home_setting( 'kermancopper_home_about_experience_label' );
        ?>
        <!-- About Us -->
        <section id="about" class="py-24 bg-white overflow-hidden relative">
            <?php if ( $about_pattern_image_src ) : ?>
            <div class="absolute right-0 top-0 bottom-0 w-1/3 opacity-30 pointer-events-none z-0 hidden md:block pattern-bg" style="background-image: url('<?php echo esc_url( $about_pattern_image_src ); ?>'); background-repeat: no-repeat; background-position: right center; background-size: contain;"></div>
            <?php endif; ?>
            <div class="container mx-auto px-4 relative z-10">
                <div class="flex flex-col md:flex-row items-center gap-16">
                    <!-- Text Content -->
                    <div class="w-full md:w-1/2 fade-in-section">
                        <div class="relative">
                            <div class="absolute -top-10 -right-10 w-40 h-40 bg-soft-gold/20 rounded-full blur-3xl"></div>
                            <?php if ( $about_kicker ) : ?>
                            <span class="text-copper font-bold tracking-widest mb-4 block text-sm flex items-center gap-2">
                                <span class="w-8 h-[2px] bg-copper"></span> <?php echo esc_html( $about_kicker ); ?>
                            </span>
                            <?php endif; ?>
                            <?php if ( $about_title_highlight || $about_title_rest ) : ?>
                            <h2 class="text-4xl font-black mb-8 leading-snug">
                                <?php if ( $about_title_highlight ) : ?>
                                    <span class="text-copper"><?php echo esc_html( $about_title_highlight ); ?></span>
                                <?php endif; ?>
                                <?php if ( $about_title_rest ) : ?>
                                    <?php echo esc_html( ( $about_title_highlight ? ' ' : '' ) . $about_title_rest ); ?>
                                <?php endif; ?>
                            </h2>
                            <?php endif; ?>
                            <?php if ( $about_description ) : ?>
                            <p class="text-slate-600 text-lg leading-loose mb-8 text-justify">
                                <?php echo esc_html( $about_description ); ?>
                            </p>
                            <?php endif; ?>

                            <?php if ( $about_mission_title || $about_mission_text || $about_vision_title || $about_vision_text ) : ?>
                            <!-- Mission & Vision -->
                            <div class="flex gap-8 border-t border-slate-100 pt-8 mt-8 mb-8">
                                <?php if ( $about_mission_title || $about_mission_text ) : ?>
                                <div class="border-r-2 border-copper pr-4">
                                    <?php if ( $about_mission_title ) : ?>
                                    <h4 class="font-bold text-copper mb-2 text-sm"><?php echo esc_html( $about_mission_title ); ?></h4>
                                    <?php endif; ?>
                                    <?php if ( $about_mission_text ) : ?>
                                    <p class="text-xs text-slate-500 leading-relaxed"><?php echo esc_html( $about_mission_text ); ?></p>
                                    <?php endif; ?>
                                </div>
                                <?php endif; ?>
                                <?php if ( $about_vision_title || $about_vision_text ) : ?>
                                <div class="border-r-2 border-copper pr-4">
                                    <?php if ( $about_vision_title ) : ?>
                                    <h4 class="font-bold text-copper mb-2 text-sm"><?php echo esc_html( $about_vision_title ); ?></h4>
                                    <?php endif; ?>
                                    <?php if ( $about_vision_text ) : ?>
                                    <p class="text-xs text-slate-500 leading-relaxed"><?php echo esc_html( $about_vision_text ); ?></p>
                                    <?php endif; ?>
                                </div>
                                <?php endif; ?>
                            </div>
                            <?php endif; ?>

                            <?php if ( ( $about_button_primary_text && $about_button_primary_url ) || ( $about_button_secondary_text && $about_button_secondary_url ) ) : ?>
                            <div class="flex flex-wrap gap-4">
                                <?php if ( $about_button_primary_text && $about_button_primary_url ) : ?>
                                <a href="<?php echo esc_url( $about_button_primary_url ); ?>" class="group bg-white text-copper border border-copper px-8 py-3 rounded-sm font-bold flex items-center gap-2 hover:bg-[var(--color-copper)] hover:text-white transition-all shadow-lg hover:shadow-xl">
                                    <i data-lucide="file-text" class="w-4 h-4"></i>
                                    <?php echo esc_html( $about_button_primary_text ); ?>
                                </a>
                                <?php endif; ?>
                                <?php if ( $about_button_secondary_text && $about_button_secondary_url ) : ?>
                                <a href="<?php echo esc_url( $about_button_secondary_url ); ?>" class="group flex items-center gap-2 text-sm font-bold text-slate-900 transition-all hover:text-copper border border-slate-200 px-6 py-3 rounded-sm hover:border-copper">
                                    <?php echo esc_html( $about_button_secondary_text ); ?> <i data-lucide="arrow-left" class="w-4 h-4 transition-transform group-hover:-translate-x-1"></i>
                                </a>
                                <?php endif; ?>
                            </div>
                            <?php endif; ?>
                        </div>
                    </div>

                    <!-- Image Content -->
                    <?php if ( $about_main_image_src ) : ?>
                    <div class="w-full md:w-1/2 fade-in-section relative">
                         <div class="relative rounded-sm overflow-hidden shadow-2xl group">
                           <img src="<?php echo esc_url( $about_main_image_src ); ?>" class="w-full h-[500px] object-cover transition-transform duration-700 group-hover:scale-105" alt="<?php echo esc_attr( $about_title_highlight ? $about_title_highlight : $about_title_rest ); ?>" />
                           <div class="absolute inset-0 bg-gradient-to-t from-black/50 to-transparent"></div>

                           <?php if ( $about_experience_count || $about_experience_label ) : ?>
                           <!-- Experience Box -->
                           <div class="absolute bottom-0 right-0 bg-copper text-white p-8 md:p-10 shadow-2xl max-w-[200px] md:max-w-[250px]">
                               <div class="text-5xl md:text-6xl font-black mb-2 flex items-center justify-center gap-1" dir="ltr">+<span id="experience-counter"><?php echo esc_html( $about_experience_count ); ?></span></div>
                               <?php if ( $about_experience_label ) : ?>
                               <div class="text-sm md:text-base font-medium text-center text-white/90"><?php echo esc_html( $about_experience_label ); ?></div>
                               <?php endif; ?>
                           </div>
                           <?php endif; ?>
                         </div>
                         <!-- Decorative Element -->
                         <div class="absolute -bottom-6 -left-6 w-full h-full border-2 border-slate-100 rounded-sm -z-10 hidden md:block"></div>
                    </div>
                    <?php endif; ?>
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
                    <?php
                    $ads_terms = get_terms( array(
                        'taxonomy'   => 'kermancopper_ad_type',
                        'hide_empty' => true,
                    ) );
                    $ads_has_terms = ! is_wp_error( $ads_terms ) && ! empty( $ads_terms );
                    ?>
                    <div class="flex bg-white p-1 rounded-sm shadow-sm border border-slate-200" id="ads-filter-container">
                        <button data-filter="all" class="px-6 py-2 rounded-sm font-bold transition-all text-sm bg-copper text-white">همه</button>
                        <?php if ( $ads_has_terms ) : ?>
                            <?php foreach ( $ads_terms as $term ) : ?>
                                <button data-filter="<?php echo esc_attr( $term->slug ); ?>" class="px-6 py-2 rounded-sm font-bold transition-all text-sm text-slate-500 hover:bg-slate-50"><?php echo esc_html( $term->name ); ?></button>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8" id="ads-grid">
                    <?php
                    $ads_query = new WP_Query( array(
                        'post_type'      => 'kermancopper_ad',
                        'post_status'    => 'publish',
                        'posts_per_page' => 8,
                        'orderby'        => 'date',
                        'order'          => 'DESC',
                    ) );
                    ?>
                    <?php if ( $ads_query->have_posts() ) : ?>
                        <?php while ( $ads_query->have_posts() ) : ?>
                            <?php
                            $ads_query->the_post();
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
                            $thumbnail = get_the_post_thumbnail_url( $ad_id, 'large' );
                            if ( ! $thumbnail ) {
                                $thumbnail = get_template_directory_uri() . '/images/image2.jpg';
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
                            $status_label = $status === 'closed' ? __( 'بسته', 'kermancopper' ) : __( 'فعال', 'kermancopper' );
                            $status_class = $status === 'closed'
                                ? 'bg-slate-50 text-slate-500 border border-slate-100'
                                : 'bg-green-50 text-green-700 border border-green-100';
                            ?>
                            <div class="ad-item bg-white rounded-sm overflow-hidden shadow-sm border border-slate-100 card-hover transition-all fade-in-section" data-type="<?php echo esc_attr( $ad_type_slug ); ?>">
                                <div class="h-48 relative overflow-hidden group">
                                    <img src="<?php echo esc_url( $thumbnail ); ?>" alt="<?php echo esc_attr( get_the_title() ); ?>" class="w-full h-full object-cover" />
                                    <div class="absolute top-4 right-4 bg-white/95 backdrop-blur px-2.5 py-1 rounded-sm text-[10px] font-normal shadow-sm text-slate-700 uppercase tracking-tight flex items-center gap-1">
                                        <i data-lucide="<?php echo esc_attr( $ad_type_icon ); ?>" class="w-2.5 h-2.5 text-copper stroke-[1.5]"></i> <?php echo esc_html( $ad_type_label ); ?>
                                    </div>
                                </div>
                                <div class="p-6">
                                    <h3 class="font-bold text-base mb-4 h-12 line-clamp-2 text-slate-800 leading-relaxed"><?php echo esc_html( get_the_title() ); ?></h3>
                                    <div class="flex justify-between items-center text-[12px] text-slate-500 mb-6 border-t border-slate-50 pt-4">
                                        <div class="flex items-center gap-1 font-medium"><i data-lucide="calendar" class="w-2.5 h-2.5 text-slate-400 stroke-[1.5]"></i> مهلت : <?php echo esc_html( $expiry_display ); ?></div>
                                        <div class="px-2 py-0.5 rounded-sm font-medium text-[11px] <?php echo esc_attr( $status_class ); ?>"><?php echo esc_html( $status_label ); ?></div>
                                    </div>
                                    <div class="flex gap-2">
                                        <a href="<?php echo esc_url( get_permalink() ); ?>" class="flex-1 bg-white text-copper border border-copper py-2.5 rounded-sm text-sm font-bold hover:bg-[var(--color-copper)] hover:text-white transition-all shadow-sm text-center">جزئیات آگهی</a>
                                    </div>
                                </div>
                            </div>
                        <?php endwhile; ?>
                        <?php wp_reset_postdata(); ?>
                    <?php else : ?>
                        <div class="col-span-full text-center text-slate-500">آگهی‌ای برای نمایش وجود ندارد.</div>
                    <?php endif; ?>
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

    
        <?php
        $faq_kicker = kermancopper_get_home_setting( 'kermancopper_home_faq_kicker' );
        $faq_title = kermancopper_get_home_setting( 'kermancopper_home_faq_title' );
        $faq_description = kermancopper_get_home_setting( 'kermancopper_home_faq_description' );
        $faq_link_text = kermancopper_get_home_setting( 'kermancopper_home_faq_link_text' );
        $faq_link_url = kermancopper_get_home_setting( 'kermancopper_home_faq_link_url' );
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
        ?>
        <?php if ( $faq_has_items ) : ?>
        <section class="py-24 bg-white border-b border-slate-50">
            <div class="container mx-auto px-4">
                <div class="flex flex-col lg:flex-row gap-16">
                    <div class="lg:w-1/3 fade-in-section">
                        <?php if ( ! empty( $faq_kicker ) ) : ?>
                            <span class="text-copper font-bold mb-2 block text-sm"><?php echo esc_html( $faq_kicker ); ?></span>
                        <?php endif; ?>
                        <?php if ( ! empty( $faq_title ) ) : ?>
                            <h2 class="text-4xl font-black mb-6 leading-tight"><?php echo esc_html( $faq_title ); ?></h2>
                        <?php endif; ?>
                        <?php if ( ! empty( $faq_description ) ) : ?>
                            <p class="text-slate-500 leading-relaxed mb-8"><?php echo esc_html( $faq_description ); ?></p>
                        <?php endif; ?>
                        <?php if ( ! empty( $faq_link_text ) && ! empty( $faq_link_url ) ) : ?>
                            <a href="<?php echo esc_url( $faq_link_url ); ?>" class="inline-flex items-center gap-2 font-bold text-copper border-b-2 border-copper/20 pb-1 hover:border-copper transition-all">
                                <?php echo esc_html( $faq_link_text ); ?> <i data-lucide="arrow-left" class="w-4 h-4"></i>
                            </a>
                        <?php endif; ?>
                    </div>

                    <div class="lg:w-2/3 space-y-4 fade-in-section" id="faq-container">
                        <?php foreach ( $faq_items as $faq_item ) : ?>
                            <div class="border border-slate-100 rounded-sm overflow-hidden group bg-slate-50 hover:bg-white transition-colors">
                                <button class="w-full flex items-center justify-between p-6 text-right transition-colors">
                                    <span class="font-bold text-slate-800 text-lg"><?php echo esc_html( $faq_item['question'] ); ?></span>
                                    <div class="w-8 h-8 rounded-full bg-white border border-slate-200 flex items-center justify-center text-slate-400 group-[.active]:bg-copper group-[.active]:text-white group-[.active]:border-copper transition-all">
                                        <i data-lucide="chevron-down" class="w-5 h-5 transition-transform duration-300 group-[.active]:rotate-180"></i>
                                    </div>
                                </button>
                                <div class="accordion-content max-h-0 overflow-hidden transition-all duration-300 ease-in-out text-slate-600 leading-loose px-6">
                                    <div class="pb-6 pt-2 border-t border-slate-100/50">
                                        <?php echo esc_html( $faq_item['answer'] ); ?>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </section>
        <?php endif; ?>

       
        <?php
        $partners_kicker = kermancopper_get_home_setting( 'kermancopper_home_partners_kicker' );
        $partners_title = kermancopper_get_home_setting( 'kermancopper_home_partners_title' );
        $partners_items_raw = kermancopper_get_home_setting( 'kermancopper_home_partners_items' );
        $partners_items = json_decode( $partners_items_raw, true );
        if ( ! is_array( $partners_items ) ) {
            $partners_items = array();
        }
        $partners_items = array_values(
            array_filter(
                $partners_items,
                function( $item ) {
                    return is_array( $item ) && ( ! empty( $item['name'] ) || ! empty( $item['link'] ) || ! empty( $item['image_id'] ) || ! empty( $item['image_url'] ) );
                }
            )
        );
        $partners_has_items = ! empty( $partners_items );
        ?>
        <?php if ( $partners_has_items ) : ?>
        <section id="partners-showcase" class="py-24 bg-white">
            <div class="container mx-auto px-4">
                <div class="max-w-[86.4rem] mx-auto">
                    <div class="relative z-0 rounded-[28px] bg-[#2B3446] overflow-hidden">
                        <div class="absolute inset-0 bg-[url('<?php echo get_template_directory_uri(); ?>/images/pano sarcheshmeh.jpg')] bg-cover bg-center opacity-25"></div>
                        <div class="absolute inset-0 bg-[#2B3446]/90"></div>
                        <div class="relative z-10 flex flex-col md:flex-row items-center gap-10 px-10 pt-16 pb-40 md:px-14 md:pt-20 md:pb-48 text-white">
                            <div class="w-full md:w-2/3">
                                <h2 class="text-2xl md:text-3xl font-black mb-5">تماس با ما</h2>
                                <form class="grid grid-cols-1 md:grid-cols-2 gap-2 text-right">
                                    <div class="md:col-span-1">
                                        <label class="block text-xs text-slate-200 mb-1">نام و نام خانوادگی</label>
                                        <input type="text" class="w-full h-11 rounded-lg border border-[color:var(--color-copper)] bg-transparent px-4 text-sm text-white placeholder:text-slate-300 focus:outline-none focus:border-[color:var(--color-copper)]" placeholder="نام و نام خانوادگی" />
                                    </div>
                                    <div class="md:col-span-1">
                                        <label class="block text-xs text-slate-200 mb-1">پست الکترونیک</label>
                                        <input type="email" class="w-full h-11 rounded-lg border border-[color:var(--color-copper)] bg-transparent px-4 text-sm text-white placeholder:text-slate-300 focus:outline-none focus:border-[color:var(--color-copper)]" placeholder="example@email.com" />
                                    </div>
                                    <div class="md:col-span-2">
                                        <label class="block text-xs text-slate-200 mb-1">موضوع پیام</label>
                                        <input type="text" class="w-full h-11 rounded-lg border border-[color:var(--color-copper)] bg-transparent px-4 text-sm text-white placeholder:text-slate-300 focus:outline-none focus:border-[color:var(--color-copper)]" placeholder="موضوع پیام" />
                                    </div>
                                    <div class="md:col-span-2">
                                        <label class="block text-xs text-slate-200 mb-1">متن پیام</label>
                                        <textarea rows="3" class="w-full rounded-lg border border-[color:var(--color-copper)] bg-transparent px-4 py-3 text-sm text-white placeholder:text-slate-300 focus:outline-none focus:border-[color:var(--color-copper)]" placeholder="متن پیام شما"></textarea>
                                    </div>
                                    <div class="md:col-span-2">
                                        <button type="submit" class="w-full md:w-auto h-11 px-6 rounded-lg bg-[color:var(--color-copper)] hover:brightness-110 text-white font-bold transition-all">
                                            ارسال پیام
                                        </button>
                                    </div>
                                </form>
                            </div>
                            <div class="w-full md:w-1/3 flex justify-center">
                                <div class="bg-white rounded-[22px] p-2 shadow-[0_18px_36px_rgba(15,23,42,0.2)]">
                                    <img src="<?php echo get_template_directory_uri(); ?>/images/pano sarcheshmeh.jpg" alt="Company" class="w-[220px] h-[220px] md:w-[240px] md:h-[240px] object-cover rounded-[18px]" />
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="relative z-20 w-[103%] max-w-[76.8rem] mx-auto -mt-24 md:-mt-28 rounded-[20px] bg-white border border-[#EEF2F7] shadow-[0_16px_32px_rgba(15,23,42,0.12),0_2px_6px_rgba(15,23,42,0.06)] px-8 py-4">
                        <div class="text-center mb-3">
                            <?php if ( ! empty( $partners_title ) ) : ?>
                                <h3 class="text-base md:text-lg font-bold text-slate-800"><?php echo esc_html( $partners_title ); ?></h3>
                            <?php endif; ?>
                        </div>
                        <div class="grid grid-cols-2 md:grid-cols-5 gap-8 md:gap-14">
                        <?php foreach ( $partners_items as $partner ) : ?>
                            <?php
                            $image_src = '';
                            if ( ! empty( $partner['image_id'] ) ) {
                                $image_src = wp_get_attachment_image_url( absint( $partner['image_id'] ), 'medium' );
                            }
                            if ( empty( $image_src ) && ! empty( $partner['image_url'] ) ) {
                                $image_src = $partner['image_url'];
                            }
                            $link = ! empty( $partner['link'] ) ? $partner['link'] : '';
                            ?>
                            <?php if ( $link ) : ?>
                            <a href="<?php echo esc_url( $link ); ?>" class="flex flex-col items-center gap-2 group cursor-pointer opacity-70 grayscale hover:opacity-100 hover:grayscale-0 transition-all duration-300">
                            <?php else : ?>
                            <div class="flex flex-col items-center gap-2 group cursor-default opacity-70 grayscale hover:opacity-100 hover:grayscale-0 transition-all duration-300">
                            <?php endif; ?>
                                <div class="w-24 h-24 bg-white rounded-full flex items-center justify-center text-slate-300 shadow-sm border border-slate-100 group-hover:text-[color:var(--color-copper)] group-hover:shadow-xl group-hover:scale-105 transition-all duration-300">
                                    <?php if ( ! empty( $image_src ) ) : ?>
                                        <img src="<?php echo esc_url( $image_src ); ?>" alt="<?php echo esc_attr( $partner['name'] ); ?>" class="w-16 h-16 object-contain opacity-80 group-hover:opacity-100">
                                    <?php endif; ?>
                                </div>
                                <?php if ( ! empty( $partner['name'] ) ) : ?>
                                    <h4 class="font-bold text-[12px] leading-5 text-slate-700 group-hover:text-[color:var(--color-copper)] transition-colors text-center"><?php echo esc_html( $partner['name'] ); ?></h4>
                                <?php endif; ?>
                            <?php if ( $link ) : ?>
                            </a>
                            <?php else : ?>
                            </div>
                            <?php endif; ?>
                        <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <?php endif; ?>

    </main>

<?php get_footer(); ?>

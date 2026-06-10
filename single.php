<?php
/**
 * The template for displaying all single posts
 *
 * @package KermanCopper
 */

get_header();

while ( have_posts() ) :
    the_post();

    $thumbnail_url = get_the_post_thumbnail_url( get_the_ID(), 'kermancopper-hero-thumbnail' );
    if ( ! $thumbnail_url ) {
        $thumbnail_url = get_template_directory_uri() . '/images/about/realistic_mine.png';
    }
    ?>

    <header class="relative min-h-[500px] lg:min-h-[600px] flex items-end justify-center overflow-hidden bg-navy pt-40 pb-20">
        <!-- Background Image -->
        <div class="absolute inset-0 w-full h-full">
            <img src="<?php echo esc_url( $thumbnail_url ); ?>" class="hero-bg-image w-full h-full object-cover opacity-60 mix-blend-overlay" alt="<?php the_title_attribute(); ?>">
            <!-- Gradients for text readability -->
            <div class="absolute inset-0 bg-gradient-to-t from-navy via-navy/60 to-transparent z-10"></div>
            <!-- Accent glow -->
            <div class="hero-glow-accent absolute -top-[20%] -right-[10%] w-[55%] h-[55%] bg-copper/35 rounded-full blur-[120px] animate-pulse-slow z-15 pointer-events-none">
            </div>
        </div>

        <div class="hero-text-container container mx-auto px-6 lg:px-12 relative z-20 font-peyda max-w-5xl">
            <!-- Breadcrumb & Badges -->
            <div class="flex flex-wrap items-center gap-4 mb-6 animate-fade-in-down delay-100">
                <a href="<?php echo esc_url( get_post_type_archive_link( 'post' ) ?: home_url( '/news/' ) ); ?>" class="text-slate-300 hover:text-white transition-colors text-sm font-bold flex items-center gap-1">
                    <?php echo kermancopper_icon('home', 'w-4 h-4'); ?> اخبار
                </a>
                <span class="text-slate-500">/</span>
                <?php
                $categories = get_the_category();
                if ( ! empty( $categories ) ) :
                    ?>
                    <a href="<?php echo esc_url( get_category_link( $categories[0]->term_id ) ); ?>" class="px-3 py-1 rounded-lg glass-panel text-copper-light text-xs font-bold border-copper/20">
                        <?php echo esc_html( $categories[0]->name ); ?>
                    </a>
                <?php endif; ?>
                <span class="px-3 py-1 rounded-lg glass-panel text-white/80 text-xs font-bold flex items-center gap-1">
                    <span class="w-1.5 h-1.5 rounded-full bg-emerald-400 animate-pulse"></span> اخبار ویژه
                </span>
            </div>

            <!-- Title -->
            <h1 class="text-2xl/[1.5] sm:text-3xl/[1.5] lg:text-4xl/[1.5] xl:text-5xl/[1.5] font-black text-white mb-8 animate-fade-in-down delay-200">
                <?php the_title(); ?>
            </h1>

            <!-- Meta Info -->
            <div class="flex flex-wrap items-center gap-6 text-slate-300 text-sm font-sans font-medium animate-fade-in-down delay-300 border-t border-white/10 pt-6">
                <div class="flex items-center gap-2">
                    <div class="w-8 h-8 rounded-full bg-copper/20 flex items-center justify-center text-copper-light">
                        <?php echo kermancopper_icon('user', 'w-4 h-4'); ?>
                    </div>
                    <span><?php the_author(); ?></span>
                </div>
                <div class="flex items-center gap-2">
                    <?php echo kermancopper_icon('calendar', 'w-4 h-4 text-slate-400'); ?>
                    <span><?php echo get_the_date(); ?></span>
                </div>
                <div class="flex items-center gap-2">
                    <?php echo kermancopper_icon('clock', 'w-4 h-4 text-slate-400'); ?>
                    <span>
                        <?php
                        $content = get_the_content();
                        $word_count = str_word_count( strip_tags( $content ) );
                        $reading_time = ceil( $word_count / 200 );
                        echo sprintf( '%d دقیقه مطالعه', $reading_time > 0 ? $reading_time : 3 );
                        ?>
                    </span>
                </div>
                <div class="flex items-center gap-2 mr-auto">
                    <button class="w-8 h-8 rounded-full bg-white/5 hover:bg-copper hover:text-white transition-colors flex items-center justify-center border border-white/10" aria-label="اشتراک‌گذاری" onclick="navigator.clipboard.writeText(window.location.href); alert('لینک صفحه کپی شد.');">
                        <?php echo kermancopper_icon('share-2', 'w-3.5 h-3.5'); ?>
                    </button>
                    <button class="w-8 h-8 rounded-full bg-white/5 hover:bg-copper hover:text-white transition-colors flex items-center justify-center border border-white/10" aria-label="چاپ" onclick="window.print();">
                        <?php echo kermancopper_icon('printer', 'w-3.5 h-3.5'); ?>
                    </button>
                </div>
            </div>
        </div>
    </header>

    <!-- POST CONTENT -->
    <main class="relative z-20 bg-[#FAFAFA] pb-24">
        <!-- Overlay curve to transition smoothly from dark hero -->
        <div class="absolute -top-1 left-0 right-0 w-full overflow-hidden text-[#FAFAFA] z-20 pointer-events-none">
            <svg viewBox="0 0 1440 48" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-full h-auto drop-shadow-sm">
                <path d="M0 48H1440V0C1440 0 1140 48 720 48C300 48 0 0 0 0V48Z" fill="currentColor" />
            </svg>
        </div>

        <div class="container mx-auto px-6 lg:px-12 pt-20">
            <div class="max-w-3xl mx-auto scroll-reveal">

                <article class="post-content">
                    <?php the_content(); ?>
                </article>

                <?php if ( get_post_type() === 'kermancopper_ad' ) : ?>
                    <?php
                    $forms = get_post_meta( get_the_ID(), 'kermancopper_ad_excel_forms', true );
                    if ( ! is_array( $forms ) ) {
                        $forms = array();
                    }
                    ?>
                    <?php if ( ! empty( $forms ) ) : ?>
                        <div class="mt-10 rounded-[2rem] border border-slate-200/80 bg-white p-6 shadow-sm">
                            <h2 class="text-lg font-bold text-slate-900 mb-4">فرم‌های مرتبط</h2>
                            <div class="flex flex-col gap-3">
                                <?php foreach ( $forms as $index => $form ) : ?>
                                    <?php
                                    $form_name = isset( $form['name'] ) ? $form['name'] : '';
                                    $form_url = isset( $form['url'] ) ? $form['url'] : '';
                                    $fallback_name = sprintf( 'فرم %d', $index + 1 );
                                    ?>
                                    <?php if ( $form_url ) : ?>
                                        <a href="<?php echo esc_url( $form_url ); ?>" class="flex items-center justify-between gap-3 rounded-2xl border border-slate-200 px-4 py-3 text-sm font-bold text-slate-700 hover:border-copper hover:text-copper transition-all">
                                            <span><?php echo esc_html( $form_name ? $form_name : $fallback_name ); ?></span>
                                            <span class="text-xs text-slate-400">دانلود</span>
                                        </a>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    <?php endif; ?>
                <?php endif; ?>

                <!-- Tags & Share (Bottom of article) -->
                <div class="mt-16 pt-8 border-t border-slate-200 flex flex-col sm:flex-row items-center justify-between gap-6">
                    <!-- Tags -->
                    <?php
                    $tags = get_the_tags();
                    if ( $tags ) :
                        ?>
                        <div class="flex flex-wrap items-center gap-2">
                            <span class="text-sm font-bold text-navy ml-2 font-peyda">برچسب‌ها:</span>
                            <?php foreach ( $tags as $tag ) : ?>
                                <a href="<?php echo esc_url( get_tag_link( $tag->term_id ) ); ?>" class="px-3 py-1.5 bg-slate-100 hover:bg-copper/10 text-slate-600 hover:text-copper transition-colors rounded-lg text-xs font-bold">#<?php echo esc_html( $tag->name ); ?></a>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>

                    <!-- Share -->
                    <div class="flex items-center gap-3">
                        <span class="text-sm font-bold text-navy ml-2 font-peyda">اشتراک‌گذاری:</span>
                        <a href="https://www.linkedin.com/shareArticle?mini=true&url=<?php echo urlencode(get_permalink()); ?>&title=<?php echo urlencode(get_the_title()); ?>" target="_blank" class="w-9 h-9 rounded-full bg-slate-100 text-slate-500 hover:bg-[#0077b5] hover:text-white transition-colors flex items-center justify-center shadow-sm">
                            <?php echo kermancopper_icon('linkedin', 'w-4 h-4'); ?>
                        </a>
                        <a href="https://api.whatsapp.com/send?text=<?php echo urlencode(get_permalink()); ?>" target="_blank" class="w-9 h-9 rounded-full bg-slate-100 text-slate-500 hover:bg-[#25D366] hover:text-white transition-colors flex items-center justify-center shadow-sm">
                            <?php echo kermancopper_icon('smartphone', 'w-4 h-4'); ?>
                        </a>
                        <a href="#" class="w-9 h-9 rounded-full bg-slate-100 text-slate-500 hover:bg-copper hover:text-white transition-colors flex items-center justify-center shadow-sm" onclick="event.preventDefault(); navigator.clipboard.writeText(window.location.href); alert('لینک صفحه کپی شد.');">
                            <?php echo kermancopper_icon('link', 'w-4 h-4'); ?>
                        </a>
                    </div>
                </div>

                <!-- Comments -->
                <?php
                if ( comments_open() || get_comments_number() ) :
                    ?>
                    <div class="mt-16 pt-8 border-t border-slate-200">
                        <?php comments_template(); ?>
                    </div>
                <?php endif; ?>

            </div>
        </div>
    </main>

    <!-- RELATED POSTS -->
    <?php
    $categories = wp_get_post_categories( get_the_ID() );
    $related_query = new WP_Query( array(
        'category__in'   => $categories,
        'post__not_in'   => array( get_the_ID() ),
        'posts_per_page' => 3,
        'post_status'    => 'publish',
    ) );

    if ( $related_query->have_posts() ) :
    ?>
    <section class="py-20 bg-white border-t border-slate-100 relative">
        <div class="container mx-auto px-6 lg:px-12">
            <div class="text-center mb-12 scroll-reveal">
                <h3 class="text-3xl font-black text-navy font-peyda mb-2">مطالب مرتبط</h3>
                <div class="w-12 h-1 bg-copper mx-auto rounded-full"></div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <?php while ( $related_query->have_posts() ) : $related_query->the_post(); ?>
                    <article class="post-card scroll-reveal delay-100 cursor-pointer flex flex-col h-full group" onclick="window.location.href='<?php the_permalink(); ?>'">
                        <div class="relative h-48 w-full overflow-hidden">
                            <?php if ( has_post_thumbnail() ) : ?>
                                <?php the_post_thumbnail( 'medium_large', array( 'class' => 'post-image w-full h-full object-cover' ) ); ?>
                            <?php else : ?>
                                <img src="<?php echo get_template_directory_uri(); ?>/images/about/realistic_foundry.png" alt="<?php the_title_attribute(); ?>" class="post-image w-full h-full object-cover">
                            <?php endif; ?>
                            <div class="absolute top-4 right-4 post-category-badge px-3 py-1 rounded-lg text-xs font-bold font-peyda shadow-sm">
                                <?php
                                $cats = get_the_category();
                                echo ! empty( $cats ) ? esc_html( $cats[0]->name ) : 'خبر';
                                ?>
                            </div>
                        </div>
                        <div class="p-5 flex flex-col flex-grow">
                            <h3 class="font-peyda text-base font-black text-navy mb-3 leading-snug group-hover:text-copper transition-colors">
                                <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                            </h3>
                            <div class="mt-auto flex items-center gap-2 text-xs font-medium text-slate-400 font-sans">
                                <?php echo kermancopper_icon('calendar', 'w-3.5 h-3.5'); ?>
                                <?php echo get_the_date(); ?>
                            </div>
                        </div>
                    </article>
                <?php endwhile; wp_reset_postdata(); ?>
            </div>
        </div>
    </section>
    <?php endif; ?>

<?php
endwhile;

get_footer();

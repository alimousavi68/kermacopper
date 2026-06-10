<?php
/**
 * The template for displaying the blog/posts index page
 *
 * @package KermanCopper
 */

get_header(); 

$blog_page_id = get_option( 'page_for_posts' );
$blog_title = $blog_page_id ? get_the_title( $blog_page_id ) : 'اخبار و رویدادها';
$blog_desc = '';
if ( $blog_page_id ) {
    $blog_page = get_post( $blog_page_id );
    if ( $blog_page && !empty( $blog_page->post_content ) ) {
        $blog_desc = wp_strip_all_tags( $blog_page->post_content );
    }
}
if ( empty( $blog_desc ) ) {
    $blog_desc = 'تازه‌ترین دستاوردها، اطلاعیه‌ها، و گزارش‌های عملکرد صنایع و معادن مس کرمان زمین در سطح ملی و بین‌المللی';
}
?>

    <!-- BLOG HERO SECTION -->
    <header class="relative min-h-[450px] lg:min-h-[500px] flex items-center justify-center overflow-hidden bg-navy pt-32 lg:pt-40 pb-16">
        <!-- Background Image -->
        <div class="absolute inset-0 w-full h-full">
            <img src="<?php $hero_bg_image_id = get_theme_mod( 'kermancopper_home_hero_slide_1_image_id' ); $hero_bg_image_url = $hero_bg_image_id ? wp_get_attachment_image_url( $hero_bg_image_id, 'full' ) : ''; echo esc_url( $hero_bg_image_url ?: ( get_template_directory_uri() . '/images/pano sarcheshmeh.jpg' ) ); ?>" class="hero-bg-image w-full h-full object-cover opacity-35 mix-blend-overlay will-change-transform" alt="<?php echo esc_attr( $blog_title ); ?>">
            <div class="absolute inset-0 bg-gradient-to-t from-navy via-navy/70 to-transparent z-10"></div>
            <div class="absolute inset-0 bg-gradient-to-l from-navy/50 via-transparent to-navy/50 z-10"></div>

            <!-- Glow Accent -->
            <div class="hero-glow-accent absolute -top-[20%] -right-[10%] w-[55%] h-[55%] bg-copper/35 rounded-full blur-[120px] animate-pulse-slow z-15">
            </div>
        </div>

        <!-- Pattern Background -->
        <div class="absolute inset-0 bg-[radial-gradient(rgba(200,104,47,0.15)_1px,transparent_1px)] bg-[size:32px_32px] opacity-60 z-10">
        </div>

        <div class="hero-text-container container mx-auto px-6 lg:px-12 relative z-20 text-center font-peyda">
            <div class="inline-flex items-center gap-3 px-5 py-2.5 rounded-full glass-panel mb-6 border border-white/10 shadow-[0_8px_32px_0_rgba(0,0,0,0.2)] animate-fade-in-down delay-100 mx-auto">
                <?php echo kermancopper_icon('radio', 'w-4 h-4 text-copper-light'); ?>
                <span class="text-copper-light text-xs font-extrabold tracking-widest">پایگاه اطلاع‌رسانی و مستندات</span>
            </div>

            <h1 class="text-4xl md:text-5xl lg:text-6xl font-black text-white leading-tight mb-4 animate-fade-in-down delay-200">
                <?php echo esc_html( $blog_title ); ?>
            </h1>

            <p class="text-base text-slate-400 mx-auto font-light leading-relaxed animate-fade-in-down delay-300 mb-10 max-w-3xl">
                <?php echo esc_html( $blog_desc ); ?>
            </p>
        </div>

        <!-- Bottom Curve -->
        <div class="hero-curve">
            <img src="<?php echo get_template_directory_uri(); ?>/images/Union.png" srcset="<?php echo get_template_directory_uri(); ?>/images/Union.png 1440w, <?php echo get_template_directory_uri(); ?>/images/Union-300x37.png 300w, <?php echo get_template_directory_uri(); ?>/images/Union-1024x127.png 1024w, <?php echo get_template_directory_uri(); ?>/images/Union-768x95.png 768w" sizes="(max-width: 1440px) 100vw, 1440px" class="hero-curve-image" alt="" />
            <a href="#posts-grid" class="hero-curve-arrow" aria-label="بخش بعدی">
                <?php echo kermancopper_icon('chevrons-down', 'hero-curve-arrow-icon'); ?>
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
                        <h3 class="text-2xl font-black text-navy font-peyda">آخرین اخبار و مطالب</h3>
                        <div class="flex flex-wrap justify-center bg-white p-1.5 rounded-2xl shadow-[0_8px_30px_rgb(0,0,0,0.04)] border border-slate-200">
                            <a href="<?php echo esc_url( get_permalink( get_option( 'page_for_posts' ) ) ); ?>" class="px-5 py-2.5 rounded-xl font-bold text-sm bg-copper text-white shadow-[0_4px_15px_rgba(200,104,47,0.3)] transition-all">همه</a>
                            <?php
                            $categories = get_categories( array( 'hide_empty' => true ) );
                            foreach ( $categories as $cat ) {
                                echo '<a href="' . esc_url( get_category_link( $cat->term_id ) ) . '" class="px-5 py-2.5 rounded-xl font-bold text-sm text-slate-500 hover:text-copper hover:bg-copper/5 transition-all">' . esc_html( $cat->name ) . '</a>';
                            }
                            ?>
                        </div>
                    </div>

                    <!-- Bento Posts Grid -->
                    <?php if ( have_posts() ) : ?>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-8">
                            <?php
                            $post_count = 0;
                            while ( have_posts() ) : the_post();
                                $post_count++;
                                if ( $post_count === 1 && ! is_paged() ) {
                                    // Featured Post
                                    $thumbnail_url = get_the_post_thumbnail_url( get_the_ID(), 'kermancopper-news-thumbnail' );
                                    if ( ! $thumbnail_url ) {
                                        $thumbnail_url = get_template_directory_uri() . '/images/about/realistic_mine.png';
                                    }
                                    ?>
                                    <!-- DEBUG THUMBNAIL URL: <?php echo esc_html($thumbnail_url); ?> -->
                                    <article class="sm:col-span-2 post-card scroll-reveal delay-100 relative group cursor-pointer" onclick="window.location.href='<?php the_permalink(); ?>'">
                                        <div class="relative h-[320px] sm:h-[400px] lg:h-[500px] w-full overflow-hidden bg-navy-dark">
                                            <img src="<?php echo esc_url( $thumbnail_url ); ?>" alt="<?php the_title_attribute(); ?>" class="post-image absolute inset-0 w-full h-full object-cover">
                                            <div class="absolute inset-0 bg-gradient-to-t from-navy via-navy/60 to-transparent opacity-90 group-hover:opacity-100 transition-opacity duration-500"></div>
                                            <div class="absolute top-6 right-6 post-category-badge px-4 py-2 rounded-xl text-xs font-bold font-peyda shadow-sm">
                                                <span class="flex items-center gap-2">
                                                    <span class="w-2 h-2 rounded-full bg-copper animate-pulse"></span>
                                                    <?php
                                                    $cats = get_the_category();
                                                    echo ! empty( $cats ) ? esc_html( $cats[0]->name ) : 'اخبار ویژه';
                                                    ?>
                                                </span>
                                            </div>
                                            <div class="absolute bottom-6 right-6 left-6 text-white font-peyda">
                                                <div class="flex items-center gap-4 text-xs font-medium text-slate-300 mb-3 font-sans">
                                                    <span class="flex items-center gap-1">
                                                        <?php echo kermancopper_icon('calendar', 'w-3.5 h-3.5'); ?>
                                                        <?php echo get_the_date(); ?>
                                                    </span>
                                                    <span class="w-1 h-1 bg-slate-500 rounded-full"></span>
                                                    <span class="flex items-center gap-1">
                                                        <?php echo kermancopper_icon('clock', 'w-3.5 h-3.5'); ?>
                                                        <?php
                                                        $content = get_post_field( 'post_content', get_the_ID() );
                                                        $word_count = str_word_count( strip_tags( $content ) );
                                                        $reading_time = ceil( $word_count / 200 );
                                                        echo sprintf( '%d دقیقه مطالعه', $reading_time > 0 ? $reading_time : 3 );
                                                        ?>
                                                    </span>
                                                </div>
                                                <h2 class="text-2xl sm:text-3xl font-black mb-4 leading-tight group-hover:text-copper-light transition-colors">
                                                    <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                                </h2>
                                                <p class="text-slate-300 text-sm font-sans font-light line-clamp-2 hidden sm:block max-w-3xl">
                                                    <?php echo wp_strip_all_tags( get_the_excerpt() ); ?>
                                                </p>
                                            </div>
                                        </div>
                                    </article>
                                    <?php
                                } else {
                                    // Standard Post
                                    $thumbnail_url = get_the_post_thumbnail_url( get_the_ID(), 'kermancopper-news-thumbnail' );
                                    if ( ! $thumbnail_url ) {
                                        $thumbnail_url = get_template_directory_uri() . '/images/about/realistic_foundry.png';
                                    }
                                    ?>
                                    <article class="post-card scroll-reveal delay-100 cursor-pointer flex flex-col h-full group" onclick="window.location.href='<?php the_permalink(); ?>'">
                                        <div class="relative h-56 w-full overflow-hidden">
                                            <img src="<?php echo esc_url( $thumbnail_url ); ?>" alt="<?php the_title_attribute(); ?>" class="post-image w-full h-full object-cover">
                                            <div class="absolute top-4 right-4 post-category-badge px-3 py-1.5 rounded-lg text-xs font-bold font-peyda shadow-sm">
                                                <?php
                                                $cats = get_the_category();
                                                echo ! empty( $cats ) ? esc_html( $cats[0]->name ) : 'خبر';
                                                ?>
                                            </div>
                                        </div>
                                        <div class="p-6 flex flex-col flex-grow">
                                            <div class="flex items-center gap-3 text-xs font-medium text-slate-400 mb-3 font-sans">
                                                <span class="flex items-center gap-1">
                                                    <?php echo kermancopper_icon('calendar', 'w-3 h-3'); ?>
                                                    <?php echo get_the_date(); ?>
                                                </span>
                                            </div>
                                            <h3 class="font-peyda text-lg font-black text-navy mb-3 leading-snug group-hover:text-copper transition-colors">
                                                <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                            </h3>
                                            <p class="text-slate-600 text-sm font-semibold font-sans line-clamp-3 mb-6">
                                                <?php echo wp_strip_all_tags( get_the_excerpt() ); ?>
                                            </p>
                                            <div class="mt-auto flex items-center text-copper font-bold text-xs uppercase tracking-wider group/link">
                                                مطالعه بیشتر <?php echo kermancopper_icon('arrow-left', 'w-4 h-4 mr-2 transition-transform group-hover/link:-translate-x-1'); ?>
                                            </div>
                                        </div>
                                    </article>
                                    <?php
                                }
                            endwhile;
                            ?>
                        </div>

                        <!-- Pagination -->
                        <?php
                        $links = paginate_links( array(
                            'type'      => 'array',
                            'prev_text' => kermancopper_icon('chevron-right', 'w-5 h-5'),
                            'next_text' => kermancopper_icon('chevron-left', 'w-5 h-5'),
                        ) );

                        if ( ! empty( $links ) ) :
                            ?>
                            <div class="flex justify-center items-center gap-2 mt-12 pt-8 border-t border-slate-200/60 scroll-reveal">
                                <?php
                                foreach ( $links as $link ) {
                                    $link = str_replace( 'page-numbers', 'w-10 h-10 rounded-xl font-bold flex items-center justify-center transition-all duration-200', $link );
                                    $link = str_replace( "current", "bg-copper text-white shadow-md", $link );
                                    $link = str_replace( "dots", "text-slate-400 px-2 border-none bg-transparent shadow-none hover:text-slate-400", $link );
                                    
                                    if ( strpos( $link, 'bg-copper' ) === false && strpos( $link, 'text-slate-400' ) === false ) {
                                        $link = str_replace( "w-10", "w-10 bg-white border border-slate-200 text-slate-600 hover:text-copper hover:border-copper shadow-sm", $link );
                                    }
                                    echo $link;
                                }
                                ?>
                            </div>
                        <?php endif; ?>

                    <?php else : ?>
                        <div class="text-center py-20 bg-slate-50 rounded-sm">
                            <h2 class="text-2xl font-bold text-slate-700 mb-4">محتوایی یافت نشد</h2>
                            <p class="text-slate-500">متاسفانه مطلبی در این بخش وجود ندارد.</p>
                        </div>
                    <?php endif; ?>
                </div>

                <!-- Sidebar Column (Announcements) -->
                <?php
                $notices_category = (int) kermancopper_get_home_setting( 'kermancopper_home_notices_category' );
                $notices_query = new WP_Query( array(
                    'cat'            => $notices_category,
                    'posts_per_page' => 4,
                    'post_status'    => 'publish',
                ) );
                ?>
                <div class="lg:col-span-4 lg:sticky lg:top-32 self-start scroll-reveal delay-200">
                    <div class="bg-white border border-slate-200/80 rounded-[2rem] p-6 sm:p-8 shadow-[0_15px_50px_rgba(0,0,0,0.03)] relative overflow-hidden">
                        <!-- Decorative bg -->
                        <div class="absolute -top-12 -right-12 w-32 h-32 bg-copper/5 rounded-full blur-2xl"></div>

                        <div class="flex items-center gap-3 mb-8 relative z-10">
                            <div class="w-12 h-12 rounded-xl bg-copper/10 text-copper flex items-center justify-center shadow-inner">
                                <?php echo kermancopper_icon('bell-ring', 'w-6 h-6'); ?>
                            </div>
                            <h3 class="text-xl font-black text-navy font-peyda">اطلاعیه‌ها و فراخوان‌ها</h3>
                        </div>

                        <div class="flex flex-col gap-4 relative z-10">
                            <?php if ( $notices_query->have_posts() ) : ?>
                                <?php while ( $notices_query->have_posts() ) : $notices_query->the_post(); ?>
                                    <a href="<?php the_permalink(); ?>" class="bg-slate-50 border border-slate-100 rounded-2xl p-5 hover:bg-white hover:border-copper/40 hover:shadow-[0_10px_25px_rgba(200,104,47,0.1)] transition-all duration-300 group block">
                                        <div class="flex items-start justify-between mb-3">
                                            <span class="bg-rose-100 text-rose-700 px-2.5 py-1 rounded-md text-[10px] font-bold font-peyda uppercase tracking-wider">اطلاعیه</span>
                                            <span class="text-slate-400 text-xs font-medium flex items-center gap-1">
                                                <?php echo kermancopper_icon('calendar', 'w-3 h-3'); ?>
                                                <?php echo get_the_date('d F'); ?>
                                            </span>
                                        </div>
                                        <h4 class="font-peyda text-base font-black text-navy mb-2 group-hover:text-copper transition-colors leading-snug">
                                            <?php the_title(); ?>
                                        </h4>
                                        <div class="text-slate-500 text-xs font-semibold line-clamp-2 leading-relaxed">
                                            <?php the_excerpt(); ?>
                                        </div>
                                    </a>
                                <?php endwhile; wp_reset_postdata(); ?>
                            <?php else : ?>
                                <p class="text-slate-400 text-sm text-center">هیچ اطلاعیه‌ای یافت نشد.</p>
                            <?php endif; ?>
                        </div>

                        <?php if ( $notices_category > 0 ) : ?>
                            <div class="mt-6 pt-4 border-t border-slate-100 text-center relative z-10">
                                <a href="<?php echo esc_url( get_category_link( $notices_category ) ); ?>" class="text-copper font-bold text-xs hover:text-copper-dark transition-colors inline-flex items-center gap-1">
                                    مشاهده تمامی اطلاعیه‌ها <?php echo kermancopper_icon('arrow-left', 'w-3.5 h-3.5'); ?>
                                </a>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </main>

<?php
get_footer();

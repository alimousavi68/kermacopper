<?php
/**
 * The template for displaying search results pages
 *
 * @package KermanCopper
 */

get_header(); ?>

<header class="relative min-h-[450px] lg:min-h-[500px] flex items-center justify-center overflow-hidden bg-navy pt-32 lg:pt-40 pb-16">
    <!-- Background Image -->
    <div class="absolute inset-0 w-full h-full">
        <img src="<?php $hero_bg_image_id = get_theme_mod( 'kermancopper_home_hero_slide_1_image_id' ); $hero_bg_image_url = $hero_bg_image_id ? wp_get_attachment_image_url( $hero_bg_image_id, 'full' ) : ''; echo esc_url( $hero_bg_image_url ?: ( get_template_directory_uri() . '/images/pano sarcheshmeh.jpg' ) ); ?>" class="hero-bg-image w-full h-full object-cover opacity-25 mix-blend-overlay" alt="Search Results">
        <div class="absolute inset-0 bg-gradient-to-t from-navy via-navy/70 to-transparent z-10"></div>
        <div class="absolute inset-0 bg-gradient-to-l from-navy/50 via-transparent to-navy/50 z-10"></div>

        <!-- Glow Accent -->
        <div class="hero-glow-accent absolute -top-[20%] -right-[10%] w-[55%] h-[55%] bg-copper/35 rounded-full blur-[120px] animate-pulse-slow z-15"></div>
    </div>

    <!-- Pattern Background -->
    <div class="absolute inset-0 bg-[radial-gradient(rgba(200,104,47,0.15)_1px,transparent_1px)] bg-[size:32px_32px] opacity-60 z-10"></div>

    <div class="hero-text-container container mx-auto px-6 lg:px-12 relative z-20 text-center font-peyda">
        <div class="inline-flex items-center gap-3 px-5 py-2.5 rounded-full glass-panel mb-6 border border-white/10 shadow-[0_8px_32px_0_rgba(0,0,0,0.2)] animate-fade-in-down delay-100 mx-auto">
            <?php echo kermancopper_icon('search', 'w-4 h-4 text-copper-light'); ?>
            <span class="text-copper-light text-xs font-extrabold tracking-widest">نتایج جستجو</span>
        </div>

        <h1 class="text-3xl md:text-5xl font-black text-white leading-tight mb-4 animate-fade-in-down delay-200">
            <?php printf( esc_html__( 'نتایج جستجو برای: %s', 'kermancopper' ), '<span class="text-copper-light font-black">' . get_search_query() . '</span>' ); ?>
        </h1>
    </div>

    <!-- Bottom Curve -->
    <div class="hero-curve">
        <img src="<?php echo get_template_directory_uri(); ?>/images/Union.png" srcset="<?php echo get_template_directory_uri(); ?>/images/Union.png 1440w, <?php echo get_template_directory_uri(); ?>/images/Union-300x37.png 300w, <?php echo get_template_directory_uri(); ?>/images/Union-1024x127.png 1024w, <?php echo get_template_directory_uri(); ?>/images/Union-768x95.png 768w" sizes="(max-width: 1440px) 100vw, 1440px" class="hero-curve-image" alt="" />
        <a href="#content-section" class="hero-curve-arrow" aria-label="بخش بعدی">
            <?php echo kermancopper_icon('chevrons-down', 'hero-curve-arrow-icon'); ?>
        </a>
    </div>
</header>

<main id="content-section" class="relative z-20 pb-32 bg-gradient-to-b from-[#FAF8F5] via-white to-[#FAF8F5] pt-16 lg:pt-24">
    <div class="container mx-auto px-6 lg:px-12 relative z-10 max-w-7xl">
        <?php if ( have_posts() ) : ?>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <?php while ( have_posts() ) : the_post(); ?>
                    <?php
                    $thumbnail_url = get_the_post_thumbnail_url( get_the_ID(), 'medium_large' );
                    if ( ! $thumbnail_url ) {
                        $thumbnail_url = get_template_directory_uri() . '/images/image2.jpg';
                    }
                    ?>
                    <article class="post-card scroll-reveal delay-100 cursor-pointer flex flex-col h-full group" onclick="window.location.href='<?php the_permalink(); ?>'">
                        <div class="relative h-56 w-full overflow-hidden">
                            <img src="<?php echo esc_url( $thumbnail_url ); ?>" alt="<?php the_title_attribute(); ?>" class="post-image w-full h-full object-cover transition-transform duration-700 ease-out group-hover:scale-105">
                            <div class="absolute top-4 right-4 post-category-badge px-3 py-1.5 rounded-xl text-xs font-bold font-peyda shadow-sm">
                                <?php
                                $post_type = get_post_type();
                                if ($post_type === 'kermancopper_ad') {
                                    echo 'آگهی و مناقصه';
                                } else {
                                    $cats = get_the_category();
                                    echo ! empty( $cats ) ? esc_html( $cats[0]->name ) : 'مطلب';
                                }
                                ?>
                            </div>
                        </div>
                        <div class="p-6 flex flex-col flex-grow bg-white">
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
                                مشاهده جزئیات <?php echo kermancopper_icon('arrow-left', 'w-4 h-4 mr-2 transition-transform group-hover/link:-translate-x-1'); ?>
                            </div>
                        </div>
                    </article>
                <?php endwhile; ?>
            </div>

            <!-- Pagination -->
            <div class="mt-16 flex justify-center">
                <div class="flex items-center gap-2 bg-white p-2 rounded-2xl border border-slate-200/80 shadow-[0_8px_30px_rgba(0,0,0,0.02)]">
                    <?php
                    $links = paginate_links( array(
                        'type'      => 'array',
                        'prev_text' => kermancopper_icon('chevron-right', 'w-5 h-5'),
                        'next_text' => kermancopper_icon('chevron-left', 'w-5 h-5'),
                    ) );
                    if ( $links ) {
                        foreach ( $links as $link ) {
                            $is_active = strpos( $link, 'current' ) !== false;
                            $link_styled = str_replace(
                                'page-numbers',
                                'page-numbers w-10 h-10 flex items-center justify-center rounded-xl text-sm font-black transition-all duration-300 ' . ( $is_active ? 'bg-copper text-white shadow-[0_4px_15px_rgba(200,104,47,0.3)]' : 'text-slate-500 hover:bg-slate-50 hover:text-copper' ),
                                $link
                            );
                            echo $link_styled;
                        }
                    }
                    ?>
                </div>
            </div>

        <?php else : ?>
            
            <div class="max-w-2xl mx-auto text-center py-12">
                <div class="inline-flex items-center justify-center w-24 h-24 rounded-full bg-slate-100 text-slate-400 mb-8">
                    <?php echo kermancopper_icon('search', 'w-10 h-10'); ?>
                </div>
                <h3 class="text-2xl font-black text-navy mb-4 font-peyda">موردی یافت نشد</h3>
                <p class="text-slate-600 mb-10 leading-loose">
                    متاسفانه هیچ محتوایی مطابق با عبارت جستجوی شما یافت نشد. لطفاً عبارت دیگری را امتحان کنید.
                </p>

                <!-- Search Form -->
                <div class="bg-white border border-slate-200/80 p-8 rounded-[2rem] shadow-[0_15px_50px_rgba(0,0,0,0.03)]">
                    <form action="<?php echo esc_url( home_url( '/' ) ); ?>" method="get" class="relative flex items-center gap-3">
                        <input type="search" name="s" value="<?php echo get_search_query(); ?>" placeholder="جستجو در سایت..." class="w-full rounded-2xl border border-slate-300 bg-slate-50 px-6 py-4 text-navy focus:outline-none focus:border-copper focus:bg-white transition-all font-semibold" required />
                        <button type="submit" class="bg-gradient-to-r from-copper-dark to-copper text-white font-extrabold px-8 py-4 rounded-2xl transition-all shadow-[0_10px_20px_rgba(200,104,47,0.2)] hover:shadow-[0_15px_30px_rgba(200,104,47,0.3)] hover:-translate-y-0.5 flex items-center justify-center">
                            <?php echo kermancopper_icon('search', 'w-5 h-5'); ?>
                        </button>
                    </form>
                </div>
            </div>

        <?php endif; ?>
    </div>
</main>

<style>
/* Scoped overrides to restore border radiuses */
#content-section .rounded-\[2rem\],
#content-section .rounded-2xl,
#content-section .post-card {
    border-radius: 2rem !important;
}
#content-section .post-image {
    border-radius: 2rem 2rem 0 0 !important;
}
#content-section .post-category-badge {
    border-radius: 0.75rem !important;
}
#content-section input,
#content-section button,
#content-section a {
    border-radius: 1rem !important;
}
#content-section input {
    border: 1.8px solid #7f8e9f !important;
    background-color: #f8fafc !important;
    color: #0f172a !important;
}
#content-section input:focus {
    border-color: #c8682f !important;
    background-color: #ffffff !important;
    box-shadow: 0 0 0 4px rgba(200, 104, 47, 0.25) !important;
}
</style>

<?php
get_footer();

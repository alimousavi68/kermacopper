<?php
/**
 * The template for displaying all pages
 *
 * @package KermanCopper
 */

get_header();

while ( have_posts() ) :
    the_post();

    $thumbnail_url = get_the_post_thumbnail_url( get_the_ID(), 'full' );
    if ( ! $thumbnail_url ) {
        $hero_bg_image_id = get_theme_mod( 'kermancopper_home_hero_slide_1_image_id' );
        $thumbnail_url    = $hero_bg_image_id ? wp_get_attachment_image_url( $hero_bg_image_id, 'full' ) : '';
        if ( ! $thumbnail_url ) {
            $thumbnail_url = get_template_directory_uri() . '/images/pano sarcheshmeh.jpg';
        }
    }
    ?>

    <!-- PAGE HERO SECTION -->
    <header class="relative min-h-[500px] lg:min-h-[560px] flex items-center justify-center overflow-hidden bg-navy pt-32 lg:pt-40 pb-20">
        <!-- Background Image -->
        <div class="absolute inset-0 w-full h-full">
            <img src="<?php echo esc_url( $thumbnail_url ); ?>" class="hero-bg-image w-full h-full object-cover opacity-35 mix-blend-overlay will-change-transform" alt="<?php the_title_attribute(); ?>">
            <div class="absolute inset-0 bg-gradient-to-t from-navy via-navy/70 to-transparent z-10"></div>
            <div class="absolute inset-0 bg-gradient-to-l from-navy/50 via-transparent to-navy/50 z-10"></div>

            <!-- Glow Accent -->
            <div class="hero-glow-accent absolute -top-[20%] -right-[10%] w-[55%] h-[55%] bg-copper/35 rounded-full blur-[120px] animate-pulse-slow z-15 pointer-events-none">
            </div>
        </div>

        <!-- Pattern Background -->
        <div class="absolute inset-0 bg-[radial-gradient(rgba(200,104,47,0.15)_1px,transparent_1px)] bg-[size:32px_32px] opacity-60 z-10">
        </div>

        <div class="hero-text-container container mx-auto px-6 lg:px-12 relative z-20 text-center font-peyda max-w-4xl pb-10">
            <!-- Breadcrumb / Badge -->
            <div class="inline-flex items-center gap-2 px-5 py-2.5 rounded-full glass-panel mb-6 border border-white/10 shadow-[0_8px_32px_0_rgba(0,0,0,0.2)] animate-fade-in-down delay-100 mx-auto text-xs font-bold text-slate-300">
                <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="hover:text-white transition-colors flex items-center gap-1">
                    <?php echo kermancopper_icon('home', 'w-3.5 h-3.5 text-copper-light'); ?> صفحه اصلی
                </a>
                <span class="text-slate-500">/</span>
                <span class="text-copper-light"><?php the_title(); ?></span>
            </div>

            <!-- Title -->
            <h1 class="text-3xl sm:text-4xl md:text-5xl lg:text-6xl font-black text-white leading-tight mb-4 animate-fade-in-down delay-200">
                <?php the_title(); ?>
            </h1>

            <?php if ( has_excerpt() ) : ?>
                <p class="text-base sm:text-lg text-slate-300 mx-auto font-light leading-relaxed animate-fade-in-down delay-300 max-w-2xl">
                    <?php echo esc_html( get_the_excerpt() ); ?>
                </p>
            <?php endif; ?>
        </div>

        <!-- Bottom Curve (Union image) -->
        <div class="hero-curve">
            <img src="<?php echo get_template_directory_uri(); ?>/images/Union.png" srcset="<?php echo get_template_directory_uri(); ?>/images/Union.png 1440w, <?php echo get_template_directory_uri(); ?>/images/Union-300x37.png 300w, <?php echo get_template_directory_uri(); ?>/images/Union-1024x127.png 1024w, <?php echo get_template_directory_uri(); ?>/images/Union-768x95.png 768w" sizes="(max-width: 1440px) 100vw, 1440px" class="hero-curve-image" alt="" />
            <a href="#content" class="hero-curve-arrow" aria-label="بخش بعدی">
                <?php echo kermancopper_icon('chevrons-down', 'hero-curve-arrow-icon'); ?>
            </a>
        </div>
    </header>

    <!-- MAIN CONTENT SECTION -->
    <main id="content" class="relative z-20 pb-24 bg-gradient-to-b from-[#FAF8F5] via-white to-[#FAF8F5] pt-12 lg:pt-16">
        <div class="container mx-auto px-6 lg:px-12 max-w-5xl relative z-20">
            <article id="post-<?php the_ID(); ?>" <?php post_class( 'post-content text-slate-700 leading-loose bg-white border border-slate-200/80 rounded-[2rem] shadow-[0_8px_30px_rgba(0,0,0,0.02)] p-8 sm:p-12 mb-12 scroll-reveal' ); ?>>
                <?php the_content(); ?>
            </article>
        </div>
    </main>

<?php
endwhile;

get_footer();


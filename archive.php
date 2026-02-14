<?php
/**
 * The template for displaying archive pages
 *
 * @package KermanCopper
 */

get_header(); ?>

<main class="container mx-auto px-4 py-16 mt-[100px] sm:mt-[125px]">
    <header class="mb-12 text-center">
        <h1 class="text-3xl md:text-4xl font-black text-slate-900 mb-4">
            <?php the_archive_title(); ?>
        </h1>
        <div class="text-slate-500 max-w-2xl mx-auto">
            <?php the_archive_description(); ?>
        </div>
    </header>

    <?php if ( have_posts() ) : ?>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            <?php
            while ( have_posts() ) :
                the_post();
                ?>
                <article id="post-<?php the_ID(); ?>" <?php post_class( 'bg-white rounded-sm shadow-lg overflow-hidden group hover:shadow-2xl transition-all duration-300' ); ?>>
                    <?php if ( has_post_thumbnail() ) : ?>
                        <div class="h-48 overflow-hidden relative">
                            <a href="<?php the_permalink(); ?>">
                                <?php the_post_thumbnail( 'medium_large', array( 'class' => 'w-full h-full object-cover transition-transform duration-500 group-hover:scale-105' ) ); ?>
                                <div class="absolute inset-0 bg-black/20 group-hover:bg-transparent transition-colors"></div>
                            </a>
                        </div>
                    <?php endif; ?>
                    
                    <div class="p-6">
                        <div class="text-xs text-copper font-bold mb-2">
                            <?php echo get_the_date(); ?>
                        </div>
                        <h2 class="text-xl font-bold text-slate-900 mb-3 leading-snug">
                            <a href="<?php the_permalink(); ?>" class="hover:text-copper transition-colors">
                                <?php the_title(); ?>
                            </a>
                        </h2>
                        <div class="text-slate-500 text-sm leading-relaxed mb-4 line-clamp-3">
                            <?php the_excerpt(); ?>
                        </div>
                        <a href="<?php the_permalink(); ?>" class="inline-flex items-center gap-1 text-sm font-bold text-slate-900 hover:text-copper transition-colors">
                            ادامه مطلب <i data-lucide="arrow-left" class="w-4 h-4"></i>
                        </a>
                    </div>
                </article>
                <?php
            endwhile;
            ?>
        </div>

        <div class="mt-12 flex justify-center">
            <?php
            the_posts_pagination( array(
                'prev_text' => '<i data-lucide="chevron-right" class="w-5 h-5"></i>',
                'next_text' => '<i data-lucide="chevron-left" class="w-5 h-5"></i>',
                'class'     => 'flex items-center gap-2',
            ) );
            ?>
        </div>

    <?php else : ?>
        <div class="text-center py-20 bg-slate-50 rounded-sm">
            <h2 class="text-2xl font-bold text-slate-700 mb-4">محتوایی یافت نشد</h2>
            <p class="text-slate-500">متاسفانه مطلبی در این بخش وجود ندارد.</p>
        </div>
    <?php endif; ?>
</main>

<?php
get_footer();

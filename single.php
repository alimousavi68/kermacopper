<?php
/**
 * The template for displaying all single posts
 *
 * @package KermanCopper
 */

get_header(); ?>

<main class="container mx-auto px-4 py-16 mt-[100px] sm:mt-[125px]">
    <?php
    while ( have_posts() ) :
        the_post();
        ?>
        <article id="post-<?php the_ID(); ?>" <?php post_class( 'max-w-4xl mx-auto' ); ?>>
            <header class="mb-8 text-center">
                <div class="mb-4 text-sm text-copper font-medium">
                    <?php echo get_the_date(); ?>
                    <span class="mx-2 text-slate-300">|</span>
                    <?php the_category( ', ' ); ?>
                </div>
                <h1 class="text-3xl md:text-5xl font-black text-slate-900 mb-6 leading-tight"><?php the_title(); ?></h1>
                <?php if ( has_post_thumbnail() ) : ?>
                    <div class="mt-8 rounded-sm overflow-hidden shadow-xl">
                        <?php the_post_thumbnail( 'full', array( 'class' => 'w-full h-auto object-cover' ) ); ?>
                    </div>
                <?php endif; ?>
            </header>

            <div class="prose prose-lg max-w-none text-slate-600 leading-loose">
                <?php the_content(); ?>
            </div>
            
            <footer class="mt-12 pt-8 border-t border-slate-100 flex flex-wrap gap-2">
                <?php the_tags( '<span class="text-sm text-slate-500">برچسب‌ها:</span> ', ' ' ); ?>
            </footer>

            <!-- Navigation -->
            <div class="mt-12 flex justify-between text-sm font-bold">
                <div class="text-right">
                    <?php previous_post_link( '%link', '<span class="text-slate-400 block mb-1">قبلی</span> %title' ); ?>
                </div>
                <div class="text-left">
                    <?php next_post_link( '%link', '<span class="text-slate-400 block mb-1">بعدی</span> %title' ); ?>
                </div>
            </div>
            
            <!-- Comments -->
            <?php
            if ( comments_open() || get_comments_number() ) :
                comments_template();
            endif;
            ?>

        </article>
        <?php
    endwhile;
    ?>
</main>

<?php
get_footer();

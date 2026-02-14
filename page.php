<?php
/**
 * The template for displaying all pages
 *
 * @package KermanCopper
 */

get_header(); ?>

<main class="container mx-auto px-4 py-16 mt-[100px] sm:mt-[125px]">
    <?php
    while ( have_posts() ) :
        the_post();
        ?>
        <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
            <header class="mb-8 border-b border-slate-100 pb-8">
                <h1 class="text-3xl md:text-4xl font-bold text-slate-900 mb-4"><?php the_title(); ?></h1>
            </header>

            <div class="prose max-w-none text-slate-600 leading-loose">
                <?php the_content(); ?>
            </div>
        </article>
        <?php
    endwhile;
    ?>
</main>

<?php
get_footer();

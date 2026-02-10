<?php get_header(); ?>

<main class="container mx-auto px-4 py-16">
    <?php
    if ( have_posts() ) :
        while ( have_posts() ) :
            the_post();
            ?>
            <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                <header class="mb-8">
                    <h1 class="text-3xl font-bold text-slate-900 mb-4"><?php the_title(); ?></h1>
                    <div class="text-slate-500 text-sm">
                        <?php the_date(); ?>
                    </div>
                </header>

                <div class="prose max-w-none text-slate-600 leading-loose">
                    <?php the_content(); ?>
                </div>
            </article>
            <?php
        endwhile;

        the_posts_navigation();

    else :
        ?>
        <div class="text-center py-20">
            <h2 class="text-2xl font-bold text-slate-700 mb-4">محتوایی یافت نشد</h2>
            <p class="text-slate-500">متاسفانه مطلبی با مشخصات مورد نظر شما پیدا نشد.</p>
        </div>
        <?php
    endif;
    ?>
</main>

<?php get_footer(); ?>

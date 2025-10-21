<?php get_header(); ?>

<div class="page-content">
    <?php
    if (have_posts()):
        while (have_posts()):
            the_post();
            ?>
            <article>
                <h1 class="page-title"><?php the_title(); ?></h1>
                <div class="entry-content">
                    <?php the_content(); ?>
                </div>
            </article>
            <?php
        endwhile;
    endif;
    ?>
</div>

<?php get_footer(); ?>
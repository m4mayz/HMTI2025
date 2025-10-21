<?php get_header(); ?>

<div class="single-post">
    <?php
    if (have_posts()):
        while (have_posts()):
            the_post();
            ?>
            <article>
                <h1 class="post-title"><?php the_title(); ?></h1>
                <div class="post-meta">
                    <span>Penulis: <?php the_author(); ?></span> |
                    <span>Tanggal: <?php echo get_the_date(); ?></span>
                </div>
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
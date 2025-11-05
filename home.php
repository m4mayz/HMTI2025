<?php get_header(); ?>

<div class="archive-page">
    <h1 class="archive-title">Berita & Publikasi</h1>

    <div class="archive-grid">
        <?php
        if (have_posts()):
            while (have_posts()):
                the_post();
                ?>
                <article class="news-item">
                    <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                    <div class="post-meta">
                        <span><?php echo get_the_date(); ?></span>
                    </div>
                    <div class="excerpt"><?php the_excerpt(); ?></div>
                </article>
                <?php
            endwhile;
        else:
            echo '<p>Belum ada berita yang dipublikasikan.</p>';
        endif;
        ?>
    </div>
</div>

<?php get_footer(); ?>
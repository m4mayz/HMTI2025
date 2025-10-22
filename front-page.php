<?php get_header(); ?>

<?php $hero_bg = get_theme_mod('hero_background_image'); ?>
<section class="hero-bg" style="<?php if ($hero_bg)
    echo 'background-image: url(' . esc_url($hero_bg) . ');'; ?>">
    <section class="hero-section">
        <div class=" hero-content-left">
            <p>Himpunan Mahasiswa Teknik Informatika (HMTI) Universitas Nusa Putra merupakan organisasi kemahasiswaan
                resmi yang mewadahi seluruh mahasiswa Program Studi Teknik Informatika.</p>
            <hr class="separator">
            <a href="<?php echo home_url('/tentang-hmti'); ?>" class="view-more-button">
                <span>Lihat Selengkapnya</span>
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <circle cx="12" cy="12" r="12" fill="#3498DB" />
                    <path d="M10.5 16.5L15 12L10.5 7.5" stroke="white" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round" />
                </svg>
            </a>
        </div>
        <div class="hero-content-right">
            <h1 class="hero-headline">
                <span class="headline-text">Together</span>

            </h1>
            <h1 class="hero-headline">
                <span class="headline-text">be Better!</span>
                <span class="headline-highlighter"></span>
            </h1>
        </div>
    </section>
</section>

<section class="news-section">
    <div class="news-grid">

        <div class="news-title-block">
            <h2 class="news-section-title">
                Berita & Artikel<span class="highlight"> Terbaru</span>
            </h2>
            <p class="news-categories">ARTIKEL / TIPS & TRIK / PRESTASI / DLL</p>
            <a href="<?php echo home_url('/berita-artikel'); ?>" class="view-more-button">
                <span>Lihat Selengkapnya</span>
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <circle cx="12" cy="12" r="12" fill="#3498DB" />
                    <path d="M10.5 16.5L15 12L10.5 7.5" stroke="white" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round" />
                </svg>
            </a>
        </div>

        <?php
        $latest_posts = new WP_Query([
            'post_type' => 'post',
            'posts_per_page' => 3,
        ]);

        $post_counter = 1;

        if ($latest_posts->have_posts()):
            while ($latest_posts->have_posts()):
                $latest_posts->the_post();
                ?>
                <article class="news-article-card">
                    <div class="card-image">
                        <a href="<?php the_permalink(); ?>">
                            <?php if (has_post_thumbnail()): ?>
                                <?php the_post_thumbnail('medium_large'); ?>
                            <?php else: ?>
                                <img src="<?php echo get_template_directory_uri(); ?>/assets/images/placeholder.png"
                                    alt="Placeholder">
                            <?php endif; ?>
                        </a>
                    </div>
                    <div class="card-content">
                        <div class="card-meta">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <rect x="3" y="4" width="18" height="18" rx="2" stroke="currentColor" stroke-width="2" />
                                <path d="M16 2V6M8 2V6M3 10H21" stroke="currentColor" stroke-width="2" stroke-linecap="round" />
                            </svg>
                            <span class="post-date"><?php echo get_the_date('d M Y'); ?></span>
                        </div>
                        <?php
                        $title = get_the_title();
                        $max_length = 50; // Adjust character limit as needed
                        $trimmed_title = (mb_strlen($title) > $max_length) ? mb_substr($title, 0, $max_length) . '...' : $title;
                        ?>
                        <h3><a href="<?php the_permalink(); ?>"><?php echo $trimmed_title; ?></a>
                        </h3>
                        <div class="card-excerpt">
                            <p><?php echo wp_trim_words(get_the_excerpt(), 18, '...'); ?></p>
                        </div>
                        <a href="<?php the_permalink(); ?>" class="read-more-link">
                            <span>Baca Selengkapnya</span>
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <circle cx="12" cy="12" r="11.5" stroke="#333" />
                                <path d="M10.5 16.5L15 12L10.5 7.5" stroke="#333" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round" />
                            </svg>
                        </a>
                    </div>
                    <span class="post-number"><?php echo '0' . $post_counter; ?></span>
                </article>
                <?php
                $post_counter++;
            endwhile;
            wp_reset_postdata();
        endif;
        ?>

    </div>
</section>

<?php get_footer(); ?>
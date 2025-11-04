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

<!-- Greeting Section -->
<section class="greeting-section">
    <div class="greeting-container">

        <h2 class="greeting-section-title">
            Sambutan dari
            <span class="title-with-highlight">
                <span class="highlight-text highlight"> mereka</span>
                <span class="highlight-bar primary-dark"></span>
            </span>
        </h2>

        <div class="greeting-items-wrapper">
            <!-- Sambutan Pembina HMTI -->
            <?php if (get_theme_mod('greeting_pembina_photo') || get_theme_mod('greeting_pembina_message')): ?>
                <div class="greeting-item">
                    <div class="greeting-photo">
                        <?php if (get_theme_mod('greeting_pembina_photo')): ?>
                            <img src="<?php echo esc_url(get_theme_mod('greeting_pembina_photo')); ?>"
                                alt="<?php echo esc_attr(get_theme_mod('greeting_pembina_name', 'Pembina HMTI')); ?>">
                        <?php endif; ?>
                    </div>
                    <div class="greeting-content">
                        <div class="greeting-header">
                            <h3 class="greeting-name">
                                <?php echo esc_html(get_theme_mod('greeting_pembina_name', 'Nama Pembina HMTI')); ?>
                            </h3>
                            <p class="greeting-position">
                                <?php echo esc_html(get_theme_mod('greeting_pembina_position', 'Pembina HMTI')); ?>
                            </p>
                        </div>
                        <div class="greeting-message">
                            <p><?php echo nl2br(esc_html(get_theme_mod('greeting_pembina_message', 'Selamat bergabung di HMTI.'))); ?>
                            </p>
                        </div>
                    </div>
                </div>
            <?php endif; ?>

            <!-- Sambutan Ketua HMTI -->
            <?php if (get_theme_mod('greeting_ketua_photo') || get_theme_mod('greeting_ketua_message')): ?>
                <div class="greeting-item">
                    <div class="greeting-photo">
                        <?php if (get_theme_mod('greeting_ketua_photo')): ?>
                            <img src="<?php echo esc_url(get_theme_mod('greeting_ketua_photo')); ?>"
                                alt="<?php echo esc_attr(get_theme_mod('greeting_ketua_name', 'Ketua HMTI')); ?>">
                        <?php endif; ?>
                    </div>
                    <div class="greeting-content">
                        <div class="greeting-header">
                            <h3 class="greeting-name">
                                <?php echo esc_html(get_theme_mod('greeting_ketua_name', 'Nama Ketua HMTI')); ?>
                            </h3>
                            <p class="greeting-position">
                                <?php echo esc_html(get_theme_mod('greeting_ketua_position', 'Ketua HMTI')); ?>
                            </p>
                        </div>
                        <div class="greeting-message">
                            <p><?php echo nl2br(esc_html(get_theme_mod('greeting_ketua_message', 'Selamat datang di website resmi HMTI Universitas Nusa Putra.'))); ?>
                            </p>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
        </div>

    </div>
</section>

<section class="news-section">
    <div class="news-grid">

        <div class="news-title-block">
            <h2 class="news-section-title">
                Berita & Publikasi
                <span class="title-with-highlight">
                    <span class="highlight-text highlight"> Terbaru</span>
                    <span class="highlight-bar primary"></span>
                </span>
            </h2>
            <p class="news-categories">ARTIKEL / TIPS & TRIK / PRESTASI / DLL</p>
            <a href="<?php echo home_url('/berita-publikasi'); ?>" class="view-more-button">
                <span>Lihat Selengkapnya</span>
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <circle cx="12" cy="12" r="12" fill="#3498DB" />
                    <path d="M10.5 16.5L15 12L10.5 7.5" stroke="white" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round" />
                </svg>
            </a>
        </div>
        <div class="news-articles-wrapper">
            <?php
            $latest_posts = new WP_Query([
                'post_type' => 'post',
                'posts_per_page' => 10,
                'category_name' => 'berita, artikel, informasi, prestasi',
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
                                    <path d="M16 2V6M8 2V6M3 10H21" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" />
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

    </div>
</section>

<!-- Divider -->
<div class="section-divider"></div>

<!-- Event Section -->
<section class="event-section">
    <div class="event-grid">

        <div class="event-articles-wrapper">
            <?php
            $latest_events = new WP_Query([
                'post_type' => 'post',
                'category_name' => 'event, lomba, seminar, workshop',
                'posts_per_page' => 10,
            ]);

            $event_counter = 1;

            if ($latest_events->have_posts()):
                while ($latest_events->have_posts()):
                    $latest_events->the_post();
                    ?>
                    <article class="event-article-card">
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
                                    <path d="M16 2V6M8 2V6M3 10H21" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" />
                                </svg>
                                <span class="post-date"><?php echo get_the_date('d M Y'); ?></span>
                            </div>
                            <?php
                            $title = get_the_title();
                            $max_length = 50;
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
                        <span class="post-number"><?php echo '0' . $event_counter; ?></span>
                    </article>
                    <?php
                    $event_counter++;
                endwhile;
                wp_reset_postdata();
            endif;
            ?>
        </div>

        <div class="event-title-block">
            <h2 class="event-section-title">
                Event
                <span class="title-with-highlight">
                    <span class="highlight-text highlight"> Terdekat</span>
                    <span class="highlight-bar secondary"></span>
                </span>
            </h2>
            <p class="event-categories">SEMINAR / WORKSHOP / LOMBA / DLL</p>
            <a href="<?php echo home_url('/program-kegiatan'); ?>" class="view-more-button">
                <span>Lihat Selengkapnya</span>
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <circle cx="12" cy="12" r="12" fill="#3498DB" />
                    <path d="M10.5 16.5L15 12L10.5 7.5" stroke="white" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round" />
                </svg>
            </a>
        </div>

    </div>
</section>

<!-- Divider -->
<div class="section-divider"></div>

<!-- Gallery Section -->
<section class="gallery-section">
    <div class="gallery-container">
        <h2 class="gallery-section-title">
            Sekilas
            <span class="title-with-highlight">
                <span class="highlight-text highlight"> Galeri</span>
                <span class="highlight-bar secondary-dark"></span>
            </span>
        </h2>

        <div class="gallery-grid">
            <?php
            // Get all images first
            $all_images = new WP_Query([
                'post_type' => 'attachment',
                'post_mime_type' => 'image',
                'post_status' => 'inherit',
                'posts_per_page' => 50, // Get more to filter from
                'orderby' => 'date',
                'order' => 'DESC'
            ]);

            $landscape_images = [];

            // Filter only landscape images
            if ($all_images->have_posts()):
                while ($all_images->have_posts()):
                    $all_images->the_post();
                    $metadata = wp_get_attachment_metadata(get_the_ID());

                    // Check if image is landscape (width > height)
                    if (isset($metadata['width']) && isset($metadata['height'])) {
                        if ($metadata['width'] > $metadata['height']) {
                            $landscape_images[] = get_the_ID();

                            // Stop when we have 9 landscape images
                            if (count($landscape_images) >= 9) {
                                break;
                            }
                        }
                    }
                endwhile;
                wp_reset_postdata();
            endif;

            // Display the landscape images
            if (!empty($landscape_images)):
                $counter = 0;
                foreach ($landscape_images as $image_id):
                    $counter++;
                    $image_url = wp_get_attachment_image_url($image_id, 'large');
                    $image_alt = get_post_meta($image_id, '_wp_attachment_image_alt', true);
                    ?>
                    <div class="gallery-item gallery-item-<?php echo $counter; ?>">
                        <div>
                            <img src="<?php echo esc_url($image_url); ?>"
                                alt="<?php echo esc_attr($image_alt ? $image_alt : 'Gallery Image ' . $counter); ?>">
                        </div>
                    </div>
                    <?php
                endforeach;
            else:
                ?>
                <p class="no-gallery">Belum ada foto landscape di galeri.</p>
                <?php
            endif;
            ?>
        </div>

        <a href="<?php echo home_url('/galeri'); ?>" class="view-more-button gallery-view-more">
            <span>Lihat Semua Galeri</span>
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <circle cx="12" cy="12" r="12" fill="#c9cc2e" />
                <path d="M10.5 16.5L15 12L10.5 7.5" stroke="#222" stroke-width="2" stroke-linecap="round"
                    stroke-linejoin="round" />
            </svg>
        </a>
    </div>
</section>

<!-- CTA Section -->
<section class="cta-section">
    <div class="cta-container">
        <div class="cta-content">
            <h2 class="cta-title">
                Ingin Tahu Lebih
                <span class="title-with-highlight">
                    <span class="highlight-text">Lanjut?</span>
                    <span class="highlight-bar primary"></span>
                </span>
            </h2>
            <p class="cta-description">Lihat program kerja kami dan temukan berbagai kegiatan menarik yang telah kami
                rencanakan untuk mengembangkan potensi mahasiswa Teknik Informatika.</p>
            <a href="<?php echo home_url('/program-kegiatan'); ?>" class="cta-button">
                <span>Lihat Program Kerja Kami</span>
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M5 12H19M19 12L12 5M19 12L12 19" stroke="white" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round" />
                </svg>
            </a>
        </div>
    </div>
</section>

<?php get_footer(); ?>
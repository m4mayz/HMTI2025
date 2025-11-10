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
            <p class="news-categories">BERITA / ARTIKEL / INFORMASI / PRESTASI</p>

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
                                <?php
                                $categories = get_the_category();
                                if (!empty($categories)):
                                    ?>
                                    <span class="post-category"><?php echo esc_html($categories[0]->name); ?></span>
                                    <span class="meta-separator">•</span>
                                <?php endif; ?>
                                <span class="post-date"><?php echo hmti_time_ago(get_the_time('U')); ?></span>
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
    <div class="flex justify-center px-4 sm:px-6 lg:px-8 mt-6 sm:mt-8">
        <a href="<?php echo home_url('/berita-publikasi'); ?>" class="view-more-button">
            <span>Lihat Selengkapnya</span>
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <circle cx="12" cy="12" r="12" fill="#3498DB" />
                <path d="M10.5 16.5L15 12L10.5 7.5" stroke="white" stroke-width="2" stroke-linecap="round"
                    stroke-linejoin="round" />
            </svg>
        </a>
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

<!-- Acara Terdekat Section -->
<section class="py-8 sm:py-12 md:py-16 px-0 bg-white circuit-bg">
    <?php
    // Query untuk mendapatkan 1 acara terdekat dari custom post "acara_terbuka"
    $upcoming_event = new WP_Query([
        'post_type' => 'acara_terbuka',
        'posts_per_page' => 1,
        'meta_query' => [
            [
                'key' => '_acara_terbuka_tanggal',
                'value' => date('Y-m-d'),
                'compare' => '>=',
                'type' => 'DATE'
            ]
        ],
        'orderby' => 'meta_value',
        'meta_key' => '_acara_terbuka_tanggal',
        'order' => 'ASC'
    ]);

    if ($upcoming_event->have_posts()):
        while ($upcoming_event->have_posts()):
            $upcoming_event->the_post();
            $tanggal = get_post_meta(get_the_ID(), '_acara_terbuka_tanggal', true);
            $lokasi = get_post_meta(get_the_ID(), '_acara_terbuka_lokasi', true);
            $link = get_post_meta(get_the_ID(), '_acara_terbuka_link', true);
            $is_pendaftaran = get_post_meta(get_the_ID(), '_acara_terbuka_is_pendaftaran', true);
            $deskripsi = get_post_meta(get_the_ID(), '_acara_terbuka_deskripsi', true);
            $kategori = get_post_meta(get_the_ID(), '_acara_terbuka_kategori', true);
            ?>
            <!-- Header -->
            <div class="flex flex-row justify-between items-start gap-4 p-4 sm:p-6 lg:p-8 mb-4">
                <h2 class="font-title text-2xl sm:text-3xl md:text-4xl lg:text-6xl font-bold text-dark-bg">
                    Acara
                    <span class="title-with-highlight">
                        <span class="highlight-text highlight">Terdekat</span>
                        <span class="highlight-bar primary"></span>
                    </span>
                </h2>
            </div>

            <!-- Banner Image with Overlay Content -->
            <div class="relative mx-4 sm:mx-6 lg:mx-8 mb-4 sm:mb-6 lg:mb-8 rounded-lg sm:rounded-xl overflow-hidden">
                <!-- Container dengan aspect ratio responsif -->
                <div class="event-banner-wrapper">
                    <div class="event-banner-content">
                        <?php if (has_post_thumbnail()): ?>
                            <?php the_post_thumbnail('full', ['class' => 'w-full h-full object-cover']); ?>
                        <?php else: ?>
                            <div class="w-full h-full bg-gradient-to-br from-primary to-secondary"></div>
                        <?php endif; ?>

                        <!-- Dark Overlay -->
                        <div class="absolute inset-0 bg-gradient-to-t from-black/90 via-black/60 to-black/30"></div>

                        <!-- Content Overlay -->
                        <div class="absolute inset-0 p-3 sm:p-4 md:p-6 lg:p-8 xl:p-10 flex flex-col justify-end text-white">
                            <!-- Kategori Badge -->
                            <?php if ($kategori): ?>
                                <div class="mb-1.5 sm:mb-2">
                                    <span
                                        class="inline-block bg-secondary text-dark-bg px-2 py-0.5 sm:px-3 sm:py-1 rounded-full text-[10px] sm:text-xs font-body font-bold uppercase tracking-wide">
                                        <?php echo esc_html($kategori); ?>
                                    </span>
                                </div>
                            <?php endif; ?>

                            <!-- Title -->
                            <h3
                                class="font-title text-base sm:text-xl md:text-2xl lg:text-4xl xl:text-5xl font-bold mb-1.5 sm:mb-2 lg:mb-4 leading-tight">
                                <?php the_title(); ?>
                            </h3>

                            <!-- Meta Info -->
                            <div
                                class="flex flex-wrap gap-1.5 sm:gap-2 md:gap-4 lg:gap-6 mb-2 sm:mb-3 text-[10px] sm:text-xs lg:text-base">
                                <?php if ($tanggal): ?>
                                    <div class="flex items-center gap-1 sm:gap-1.5">
                                        <svg class="w-3 h-3 sm:w-4 sm:h-4 lg:w-5 lg:h-5 shrink-0" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                        </svg>
                                        <span
                                            class="font-body font-semibold"><?php echo date('d F Y', strtotime($tanggal)); ?></span>
                                    </div>
                                <?php endif; ?>
                                <?php if ($lokasi): ?>
                                    <div class="flex items-center gap-1 sm:gap-1.5">
                                        <svg class="w-3 h-3 sm:w-4 sm:h-4 lg:w-5 lg:h-5 shrink-0" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                        </svg>
                                        <span class="font-body font-semibold"><?php echo esc_html($lokasi); ?></span>
                                    </div>
                                <?php endif; ?>
                            </div>

                            <!-- Description -->
                            <?php if ($deskripsi): ?>
                                <p
                                    class="hidden sm:block font-body font-medium text-sm sm:text-base lg:text-lg mb-4 sm:mb-5 lg:mb-6 max-w-3xl line-clamp-2 sm:line-clamp-3">
                                    <?php echo esc_html($deskripsi); ?>
                                </p>
                            <?php endif; ?>

                            <!-- CTA Button -->
                            <?php if ($link): ?>
                                <div>
                                    <a href="<?php echo esc_url($link); ?>" target="_blank"
                                        class="inline-flex items-center gap-1.5 sm:gap-2 lg:gap-3 bg-white hover:bg-gray-100 text-dark-bg font-body font-bold px-3 py-2 sm:px-4 sm:py-2.5 lg:px-8 lg:py-4 rounded-full text-xs sm:text-sm lg:text-base transition-all duration-300 shadow-lg hover:shadow-xl transform hover:-translate-y-1">
                                        <span><?php echo $is_pendaftaran ? 'Daftar Sekarang' : 'Lihat Detail'; ?></span>
                                        <svg class="w-3 h-3 sm:w-4 sm:h-4 lg:w-5 lg:h-5 shrink-0" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M13 7l5 5m0 0l-5 5m5-5H6" />
                                        </svg>
                                    </a>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="event flex justify-center px-4 sm:px-6 lg:px-8">
                <a href="<?php echo home_url('/program-kegiatan#acara-terbuka'); ?>" class="view-more-button">
                    <span>Lihat Selengkapnya</span>
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <circle cx="12" cy="12" r="12" fill="#3498DB" />
                        <path d="M10.5 16.5L15 12L10.5 7.5" stroke="white" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" />
                    </svg>
                </a>
            </div>
            <?php
        endwhile;
        wp_reset_postdata();
    else:
        ?>
        <!-- No Upcoming Events -->
        <div class="px-4 sm:px-6 lg:px-18">
            <h2 class="font-title text-2xl sm:text-3xl md:text-4xl lg:text-6xl font-bold text-dark-bg mb-6 sm:mb-8">
                Acara
                <span class="title-with-highlight">
                    <span class="highlight-text highlight">Terdekat</span>
                    <span class="highlight-bar primary"></span>
                </span>
            </h2>
            <div class="text-center py-12 sm:py-16 bg-gray-50 rounded-xl sm:rounded-2xl mx-4 sm:mx-6 lg:mx-8">
                <svg class="w-16 h-16 sm:w-20 sm:h-20 text-gray-300 mx-auto mb-4 sm:mb-6" fill="none" stroke="currentColor"
                    viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                </svg>
                <h3 class="font-title text-xl sm:text-2xl font-semibold text-gray-600 mb-2">Belum Ada Acara Terdekat</h3>
                <p class="font-body font-medium text-sm sm:text-base text-gray-500">Pantau terus untuk informasi acara
                    mendatang!</p>
            </div>
        </div>
        <?php
    endif;
    ?>
</section>

<?php get_footer(); ?>
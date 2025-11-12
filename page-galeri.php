<?php
/*
Template Name: Galeri
*/

get_header();
?>

<!-- Hero Section -->
<section
    class="relative w-full h-[40vh] min-h-[300px] bg-gradient-to-br from-[#1a1a1a] via-[#222] to-[#2a2a2a] overflow-hidden">
    <div class="absolute inset-0 bg-black/30"></div>
    <div
        class="absolute inset-0 bg-[url('data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iNjAiIGhlaWdodD0iNjAiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyI+PGRlZnM+PHBhdHRlcm4gaWQ9ImdyaWQiIHdpZHRoPSI2MCIgaGVpZ2h0PSI2MCIgcGF0dGVyblVuaXRzPSJ1c2VyU3BhY2VPblVzZSI+PHBhdGggZD0iTSAxMCAwIEwgMCAwIDAgMTAiIGZpbGw9Im5vbmUiIHN0cm9rZT0id2hpdGUiIHN0cm9rZS1vcGFjaXR5PSIwLjA1IiBzdHJva2Utd2lkdGg9IjEiLz48L3BhdHRlcm4+PC9kZWZzPjxyZWN0IHdpZHRoPSIxMDAlIiBoZWlnaHQ9IjEwMCUiIGZpbGw9InVybCgjZ3JpZCkiLz48L3N2Zz4=')] opacity-30">
    </div>
    <!-- Decorative Elements -->
    <div class="absolute top-10 left-10 w-20 h-20 bg-primary/10 rounded-full blur-3xl"></div>
    <div class="absolute bottom-10 right-10 w-32 h-32 bg-secondary/10 rounded-full blur-3xl"></div>

    <div
        class="relative container mx-auto px-4 sm:px-6 lg:px-24 h-full flex flex-col justify-center items-center text-center">
        <h1 class="font-title text-4xl sm:text-5xl lg:text-6xl font-bold text-white mb-4 animate-fade-in">
            Our Gallery
        </h1>
        <p class="font-body font-medium text-base sm:text-lg lg:text-xl text-white/90 max-w-2xl animate-fade-in-delay">
            Dokumentasi kegiatan dan momen berharga Himpunan Mahasiswa Teknik Informatika
        </p>

    </div>
</section>

<!-- Gallery Section -->
<section class="w-full py-12 sm:py-16 lg:py-20 bg-gray-50 px-4 sm:px-6 lg:px-24">

    <!-- Info Banner for logged-in admin -->
    <?php if (current_user_can('edit_posts')): ?>
        <div class="mb-6 bg-blue-50 border-l-4 border-blue-500 p-4 rounded-r-lg">
            <div class="flex items-start">
                <svg class="w-5 h-5 text-blue-500 mt-0.5 mr-3 flex-shrink-0" fill="none" stroke="currentColor"
                    viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <div class="flex-1">
                    <p class="font-body font-medium text-sm text-blue-700">
                        <strong>Info Admin:</strong> Halaman ini hanya menampilkan foto yang ditandai "Tampilkan di
                        Galeri".
                        Buka <a href="<?php echo admin_url('upload.php'); ?>" class="underline hover:text-blue-900">Media
                            Library</a>
                        untuk mengelola foto galeri. Anda bisa menandai foto satu per satu atau gunakan bulk action
                        untuk menandai banyak foto sekaligus.
                    </p>
                </div>
            </div>
        </div>
    <?php endif; ?>

    <?php
    // Get current page number
    $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;

    // Query untuk mendapatkan hanya attachments (images) yang ditandai untuk galeri
    $args = array(
        'post_type' => 'attachment',
        'post_mime_type' => 'image',
        'post_status' => 'inherit',
        'posts_per_page' => 18, // 18 gambar per halaman
        'paged' => $paged,
        'orderby' => 'date',
        'order' => 'DESC',
        'meta_query' => array(
            array(
                'key' => '_show_in_gallery',
                'value' => '1',
                'compare' => '='
            )
        )
    );

    $gallery_query = new WP_Query($args);

    if ($gallery_query->have_posts()): ?>
        <!-- Stats Bar -->
        <div
            class="mb-8 sm:mb-12 flex flex-col sm:flex-row justify-between items-center gap-4 bg-white p-4 sm:p-6 rounded-xl shadow-sm">
            <div class="flex items-center gap-3">
                <div class="w-12 h-12 bg-primary/10 rounded-lg flex items-center justify-center">
                    <svg class="w-6 h-6 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                    </svg>
                </div>
                <div>
                    <p class="font-body font-medium text-sm text-gray-500">Total Foto</p>
                    <p class="font-title text-xl sm:text-2xl font-bold text-dark-bg">
                        <?php echo $gallery_query->found_posts; ?>
                    </p>
                </div>
            </div>
            <div class="flex items-center gap-2 text-sm text-gray-600">
                <span class="font-body font-medium">Halaman <?php echo $paged; ?> dari
                    <?php echo $gallery_query->max_num_pages; ?></span>
            </div>
        </div>

        <!-- Gallery Grid with Masonry Layout -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-4 sm:gap-6">
            <?php
            $counter = 0;
            while ($gallery_query->have_posts()):
                $gallery_query->the_post();
                $counter++;
                $image_url = wp_get_attachment_url(get_the_ID());
                $image_title = get_the_title();
                $image_caption = wp_get_attachment_caption(get_the_ID());
                $image_metadata = wp_get_attachment_metadata(get_the_ID());
                $image_date = get_the_date('d M Y');

                // Determine size class for varied layout
                $size_class = '';
                if ($counter % 7 == 1) {
                    $size_class = 'sm:col-span-2 sm:row-span-2'; // Large
                } elseif ($counter % 11 == 0) {
                    $size_class = 'sm:col-span-2'; // Wide
                } elseif ($counter % 13 == 0) {
                    $size_class = 'sm:row-span-2'; // Tall
                }
                ?>
                <div class="gallery-item group relative overflow-hidden rounded-xl shadow-md hover:shadow-2xl transition-all duration-500 bg-white <?php echo $size_class; ?> animate-fade-in-up"
                    style="animation-delay: <?php echo ($counter % 18) * 50; ?>ms;">
                    <!-- Image Container -->
                    <div
                        class="relative w-full h-64 sm:h-72 <?php echo ($size_class == 'sm:col-span-2 sm:row-span-2') ? 'sm:h-96 lg:h-[600px]' : ''; ?> <?php echo ($size_class == 'sm:row-span-2') ? 'sm:h-96 lg:h-[450px]' : ''; ?> overflow-hidden bg-gray-100">
                        <img src="<?php echo esc_url($image_url); ?>" alt="<?php echo esc_attr($image_title); ?>" loading="lazy"
                            class="w-full h-full object-cover transform group-hover:scale-110 transition-transform duration-700 ease-out">

                        <!-- Gradient Overlay -->
                        <div
                            class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/30 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                        </div>

                        <!-- Hover Content -->
                        <div
                            class="absolute inset-0 flex flex-col justify-end p-4 sm:p-6 translate-y-full group-hover:translate-y-0 transition-transform duration-300">
                            <?php if ($image_title): ?>
                                <h3 class="font-title text-base sm:text-lg lg:text-xl font-bold text-white mb-2 line-clamp-2">
                                    <?php echo esc_html($image_title); ?>
                                </h3>
                            <?php endif; ?>
                            <?php if ($image_caption): ?>
                                <p class="font-body font-medium text-xs sm:text-sm text-gray-200 mb-3 line-clamp-2">
                                    <?php echo esc_html($image_caption); ?>
                                </p>
                            <?php endif; ?>
                            <div class="flex items-center justify-between">
                                <span class="font-body font-medium text-xs text-gray-300 flex items-center gap-1">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                    <?php echo $image_date; ?>
                                </span>
                                <span
                                    class="inline-flex items-center gap-1 text-xs font-medium text-white bg-white/20 backdrop-blur-sm px-3 py-1 rounded-full">
                                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0zM10 7v3m0 0v3m0-3h3m-3 0H7" />
                                    </svg>
                                    Lihat Detail
                                </span>
                            </div>
                        </div>

                        <!-- View Icon -->
                        <div
                            class="absolute top-4 right-4 w-10 h-10 bg-white/90 backdrop-blur-sm rounded-full flex items-center justify-center opacity-0 group-hover:opacity-100 scale-0 group-hover:scale-100 transition-all duration-300">
                            <svg class="w-5 h-5 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                            </svg>
                        </div>
                    </div>

                    <!-- Lightbox Link -->
                    <a href="<?php echo esc_url($image_url); ?>" class="absolute inset-0 z-10" data-lightbox="gallery"
                        data-title="<?php echo esc_attr($image_title); ?>"
                        data-caption="<?php echo esc_attr($image_caption); ?>" data-date="<?php echo esc_attr($image_date); ?>">
                        <span class="sr-only">Lihat gambar <?php echo esc_attr($image_title); ?></span>
                    </a>
                </div>
            <?php endwhile; ?>
        </div>

        <!-- Pagination -->
        <?php if ($gallery_query->max_num_pages > 1): ?>
            <div class="mt-12 sm:mt-16">
                <nav class="flex flex-wrap items-center justify-center gap-2" aria-label="Pagination">
                    <?php
                    $big = 999999999;

                    // Previous Button
                    if ($paged > 1) {
                        echo '<a href="' . get_pagenum_link($paged - 1) . '" class="inline-flex items-center gap-2 px-4 py-2 bg-gradient-to-r from-primary to-secondary text-white font-semibold rounded-lg shadow-md hover:shadow-lg hover:from-primary-dark hover:to-secondary-dark transition-all duration-200">';
                        echo '<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>';
                        echo '<span class="hidden sm:inline">Sebelumnya</span>';
                        echo '</a>';
                    }

                    // Page Numbers
                    for ($i = 1; $i <= $gallery_query->max_num_pages; $i++) {
                        if ($i == $paged) {
                            // Current Page
                            echo '<span class="inline-flex items-center justify-center min-w-[40px] px-4 py-2 bg-gradient-to-r from-primary to-primary-dark text-white font-bold rounded-lg shadow-md border-2 border-primary">' . $i . '</span>';
                        } else {
                            // Other Pages
                            if ($i == 1 || $i == $gallery_query->max_num_pages || ($i >= $paged - 1 && $i <= $paged + 1)) {
                                echo '<a href="' . get_pagenum_link($i) . '" class="inline-flex items-center justify-center min-w-[40px] px-4 py-2 bg-white text-gray-700 font-medium rounded-lg shadow-sm hover:bg-primary hover:text-white hover:shadow-md border border-gray-200 hover:border-primary transition-all duration-200">' . $i . '</a>';
                            } elseif ($i == $paged - 2 || $i == $paged + 2) {
                                echo '<span class="inline-flex items-center justify-center px-2 text-gray-400">...</span>';
                            }
                        }
                    }

                    // Next Button
                    if ($paged < $gallery_query->max_num_pages) {
                        echo '<a href="' . get_pagenum_link($paged + 1) . '" class="inline-flex items-center gap-2 px-4 py-2 bg-gradient-to-r from-primary to-secondary text-white font-semibold rounded-lg shadow-md hover:shadow-lg hover:from-primary-dark hover:to-secondary-dark transition-all duration-200">';
                        echo '<span class="hidden sm:inline">Selanjutnya</span>';
                        echo '<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>';
                        echo '</a>';
                    }
                    ?>
                </nav>
            </div>
        <?php endif; ?>

    <?php else: ?>
        <!-- No Images Found -->
        <div class="text-center py-16 sm:py-20 lg:py-24 bg-white rounded-2xl shadow-sm">
            <div class="max-w-md mx-auto">
                <div
                    class="w-20 h-20 sm:w-24 sm:h-24 mx-auto mb-6 bg-gray-100 rounded-full flex items-center justify-center">
                    <svg class="w-10 h-10 sm:w-12 sm:h-12 text-gray-400" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                    </svg>
                </div>
                <h3 class="font-title text-2xl sm:text-3xl font-bold text-gray-800 mb-3">
                    Galeri Masih Kosong
                </h3>
                <p class="font-body font-medium text-sm sm:text-base text-gray-600 mb-6">
                    Belum ada foto yang tersedia saat ini. Segera kami akan mengisi galeri dengan dokumentasi kegiatan
                    terbaru.
                </p>
                <div class="inline-flex items-center gap-2 text-primary font-medium">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <span class="font-body font-medium text-sm">Tunggu update selanjutnya</span>
                </div>
            </div>
        </div>
    <?php endif; ?>

    <?php wp_reset_postdata(); ?>
</section>

<!-- Enhanced Lightbox Script -->
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const galleryLinks = document.querySelectorAll('[data-lightbox="gallery"]');
        let currentIndex = 0;
        let lightboxElement = null;

        if (galleryLinks.length === 0) return;

        function createLightbox(index) {
            const link = galleryLinks[index];
            const imgUrl = link.href;
            const title = link.dataset.title || '';
            const caption = link.dataset.caption || '';
            const date = link.dataset.date || '';

            currentIndex = index;

            // Remove existing lightbox
            if (lightboxElement) {
                document.body.removeChild(lightboxElement);
            }

            // Create new lightbox
            lightboxElement = document.createElement('div');
            lightboxElement.className = 'fixed inset-0 z-50 bg-black/95 backdrop-blur-sm flex items-center justify-center p-4 animate-fade-in';
            lightboxElement.innerHTML = `
            <div class="relative max-w-7xl w-full max-h-full flex flex-col">
                <!-- Header -->
                <div class="flex items-center justify-between mb-4 text-white">
                    <div class="flex items-center gap-4">
                        <span class="font-body font-medium text-sm sm:text-base">${currentIndex + 1} / ${galleryLinks.length}</span>
                        ${date ? `
                            <span class="hidden sm:flex items-center gap-2 text-sm font-medium text-gray-300">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                </svg>
                                ${date}
                            </span>
                        ` : ''}
                    </div>
                    <button class="close-btn w-10 h-10 sm:w-12 sm:h-12 flex items-center justify-center hover:bg-white/10 rounded-full transition-colors duration-200" aria-label="Close">
                        <svg class="w-6 h-6 sm:w-8 sm:h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    </button>
                </div>

                <!-- Image Container -->
                <div class="relative flex-1 flex items-center justify-center min-h-0">
                    <img src="${imgUrl}" alt="${title}" class="max-w-full max-h-[70vh] sm:max-h-[75vh] object-contain rounded-lg shadow-2xl animate-scale-in">
                    
                    <!-- Navigation Buttons -->
                    ${galleryLinks.length > 1 ? `
                        <button class="prev-btn absolute left-2 sm:left-4 top-1/2 -translate-y-1/2 w-10 h-10 sm:w-12 sm:h-12 bg-white/90 hover:bg-white rounded-full flex items-center justify-center transition-all duration-200 hover:scale-110 shadow-lg" aria-label="Previous">
                            <svg class="w-5 h-5 sm:w-6 sm:h-6 text-dark-bg" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                            </svg>
                        </button>
                        <button class="next-btn absolute right-2 sm:right-4 top-1/2 -translate-y-1/2 w-10 h-10 sm:w-12 sm:h-12 bg-white/90 hover:bg-white rounded-full flex items-center justify-center transition-all duration-200 hover:scale-110 shadow-lg" aria-label="Next">
                            <svg class="w-5 h-5 sm:w-6 sm:h-6 text-dark-bg" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                            </svg>
                        </button>
                    ` : ''}
                </div>

                <!-- Info -->
                ${title || caption ? `
                    <div class="mt-4 sm:mt-6 text-center text-white max-w-3xl mx-auto">
                        ${title ? `<h3 class="font-title text-lg sm:text-xl lg:text-2xl font-bold mb-2">${title}</h3>` : ''}
                        ${caption ? `<p class="font-body font-medium text-sm sm:text-base text-gray-300">${caption}</p>` : ''}
                    </div>
                ` : ''}
            </div>
        `;

            document.body.appendChild(lightboxElement);
            document.body.style.overflow = 'hidden';

            // Event listeners
            const closeBtn = lightboxElement.querySelector('.close-btn');
            const prevBtn = lightboxElement.querySelector('.prev-btn');
            const nextBtn = lightboxElement.querySelector('.next-btn');

            closeBtn.addEventListener('click', closeLightbox);

            if (prevBtn) {
                prevBtn.addEventListener('click', (e) => {
                    e.stopPropagation();
                    showPrevious();
                });
            }

            if (nextBtn) {
                nextBtn.addEventListener('click', (e) => {
                    e.stopPropagation();
                    showNext();
                });
            }

            lightboxElement.addEventListener('click', (e) => {
                if (e.target === lightboxElement) {
                    closeLightbox();
                }
            });
        }

        function closeLightbox() {
            if (lightboxElement) {
                lightboxElement.classList.add('animate-fade-out');
                setTimeout(() => {
                    if (lightboxElement && document.body.contains(lightboxElement)) {
                        document.body.removeChild(lightboxElement);
                        lightboxElement = null;
                    }
                    document.body.style.overflow = 'auto';
                }, 200);
            }
        }

        function showNext() {
            currentIndex = (currentIndex + 1) % galleryLinks.length;
            createLightbox(currentIndex);
        }

        function showPrevious() {
            currentIndex = (currentIndex - 1 + galleryLinks.length) % galleryLinks.length;
            createLightbox(currentIndex);
        }

        // Attach click events to gallery items
        galleryLinks.forEach((link, index) => {
            link.addEventListener('click', function (e) {
                e.preventDefault();
                createLightbox(index);
            });
        });

        // Keyboard navigation
        document.addEventListener('keydown', function (e) {
            if (!lightboxElement) return;

            switch (e.key) {
                case 'Escape':
                    closeLightbox();
                    break;
                case 'ArrowRight':
                    if (galleryLinks.length > 1) showNext();
                    break;
                case 'ArrowLeft':
                    if (galleryLinks.length > 1) showPrevious();
                    break;
            }
        });
    });
</script>

<!-- Custom Styles -->
<style>
    @keyframes fadeIn {
        from {
            opacity: 0;
        }

        to {
            opacity: 1;
        }
    }

    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(20px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    @keyframes scaleIn {
        from {
            opacity: 0;
            transform: scale(0.9);
        }

        to {
            opacity: 1;
            transform: scale(1);
        }
    }

    .animate-fade-in {
        animation: fadeIn 0.3s ease-out;
    }

    .animate-fade-in-delay {
        animation: fadeIn 0.5s ease-out 0.2s both;
    }

    .animate-fade-in-delay-2 {
        animation: fadeIn 0.5s ease-out 0.4s both;
    }

    .animate-fade-in-up {
        animation: fadeInUp 0.5s ease-out both;
    }

    .animate-scale-in {
        animation: scaleIn 0.3s ease-out;
    }

    .animate-fade-out {
        animation: fadeIn 0.2s ease-in reverse;
    }

    /* Responsive Grid Adjustments */
    @media (max-width: 640px) {
        .gallery-item {
            min-height: 250px;
        }
    }
</style>

<?php get_footer(); ?>
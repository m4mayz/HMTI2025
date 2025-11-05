<?php
/*
Template Name: Galeri
*/

get_header();
?>

<section class="w-full py-16 bg-white">
    <div class="container mx-auto px-6 lg:px-24">
        <!-- Page Title -->
        <div class="text-center mb-12">
            <h2 class="font-title text-4xl lg:text-5xl font-bold text-dark-bg mb-4">
                Our Story in
                <span class="title-with-highlight">
                    <span class="highlight-text highlight">Pictures</span>
                    <span class="highlight-bar primary"></span>
                </span>
            </h2>
            <p class="font-body font-medium text-medium lg:text-lg text-gray-600">
                Koleksi foto kegiatan dan momen Himpunan Mahasiswa Teknik Informatika
            </p>
        </div>

        <?php
        // Get current page number
        $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;

        // Query untuk mendapatkan semua attachments (images)
        $args = array(
            'post_type' => 'attachment',
            'post_mime_type' => 'image',
            'post_status' => 'inherit',
            'posts_per_page' => 12, // 12 gambar per halaman
            'paged' => $paged,
            'orderby' => 'date',
            'order' => 'DESC'
        );

        $gallery_query = new WP_Query($args);

        if ($gallery_query->have_posts()): ?>
            <!-- Gallery Grid -->
            <div class="flex flex-wrap justify-center gap-6">
                <?php while ($gallery_query->have_posts()):
                    $gallery_query->the_post();
                    $image_url = wp_get_attachment_url(get_the_ID());
                    $image_title = get_the_title();
                    $image_caption = wp_get_attachment_caption(get_the_ID());
                    $image_metadata = wp_get_attachment_metadata(get_the_ID());
                    $image_width = isset($image_metadata['width']) ? $image_metadata['width'] : 800;
                    $image_height = isset($image_metadata['height']) ? $image_metadata['height'] : 600;

                    // Hitung aspect ratio
                    $aspect_ratio = $image_width / $image_height;

                    // Tentukan lebar berdasarkan orientasi
                    if ($aspect_ratio > 1.5) {
                        // Landscape lebar
                        $calculated_width = 400;
                    } elseif ($aspect_ratio > 1) {
                        // Landscape sedang
                        $calculated_width = 320;
                    } elseif ($aspect_ratio > 0.7) {
                        // Portrait atau square
                        $calculated_width = 240;
                    } else {
                        // Portrait sempit
                        $calculated_width = 200;
                    }

                    // Hitung height berdasarkan width dan aspect ratio
                    $calculated_height = $calculated_width / $aspect_ratio;
                    ?>
                    <div class="group relative overflow-hidden rounded-lg shadow-md hover:shadow-xl transition-all duration-300"
                        style="width: <?php echo $calculated_width; ?>px; height: <?php echo $calculated_height; ?>px;">
                        <!-- Image -->
                        <img src="<?php echo esc_url($image_url); ?>" alt="<?php echo esc_attr($image_title); ?>"
                            class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">

                        <!-- Overlay with Title -->
                        <?php if ($image_title || $image_caption): ?>
                            <div
                                class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/20 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                                <div class="absolute bottom-0 left-0 right-0 p-4">
                                    <?php if ($image_title): ?>
                                        <h3 class="font-title text-lg font-semibold text-white mb-1">
                                            <?php echo esc_html($image_title); ?>
                                        </h3>
                                    <?php endif; ?>
                                    <?php if ($image_caption): ?>
                                        <p class="font-body text-sm text-gray-200 line-clamp-2">
                                            <?php echo esc_html($image_caption); ?>
                                        </p>
                                    <?php endif; ?>
                                </div>
                            </div>
                        <?php endif; ?>

                        <!-- Lightbox Link -->
                        <a href="<?php echo esc_url($image_url); ?>" class="absolute inset-0 z-10" data-lightbox="gallery"
                            data-title="<?php echo esc_attr($image_title); ?>">
                            <span class="sr-only">Lihat gambar</span>
                        </a>
                    </div>
                <?php endwhile; ?>
            </div>

            <!-- Pagination -->
            <div class="mt-12">
                <?php
                // Custom pagination
                $big = 999999999;
                echo paginate_links(array(
                    'base' => str_replace($big, '%#%', esc_url(get_pagenum_link($big))),
                    'format' => '?paged=%#%',
                    'current' => max(1, $paged),
                    'total' => $gallery_query->max_num_pages,
                    'mid_size' => 2,
                    'prev_text' => __('← Sebelumnya', 'hmti2025'),
                    'next_text' => __('Selanjutnya →', 'hmti2025'),
                    'type' => 'list',
                    'class' => 'font-body',
                ));
                ?>
            </div>

        <?php else: ?>
            <!-- No Images Found -->
            <div class="text-center py-20">
                <svg class="w-24 h-24 mx-auto text-gray-300 mb-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                </svg>
                <h3 class="font-title text-2xl font-semibold text-gray-700 mb-2">
                    Belum Ada Gambar
                </h3>
                <p class="font-body text-gray-500">
                    Galeri foto belum tersedia saat ini.
                </p>
            </div>
        <?php endif; ?>

        <?php wp_reset_postdata(); ?>
    </div>
</section>

<!-- Lightbox Script -->
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const galleryLinks = document.querySelectorAll('[data-lightbox="gallery"]');

        if (galleryLinks.length > 0) {
            galleryLinks.forEach(link => {
                link.addEventListener('click', function (e) {
                    e.preventDefault();
                    const imgUrl = this.href;
                    const title = this.dataset.title || '';

                    // Create lightbox
                    const lightbox = document.createElement('div');
                    lightbox.className = 'fixed inset-0 z-50 bg-black/90 flex items-center justify-center p-4';
                    lightbox.innerHTML = `
                    <div class="relative max-w-7xl max-h-full">
                        <button class="absolute -top-12 right-0 text-white hover:text-gray-300 text-4xl font-bold">
                            &times;
                        </button>
                        <img src="${imgUrl}" alt="${title}" class="max-w-full max-h-[90vh] object-contain rounded-lg">
                        ${title ? `<p class="text-white text-center mt-4 font-body">${title}</p>` : ''}
                    </div>
                `;

                    document.body.appendChild(lightbox);
                    document.body.style.overflow = 'hidden';

                    // Close on click
                    lightbox.addEventListener('click', function (e) {
                        if (e.target === lightbox || e.target.tagName === 'BUTTON') {
                            document.body.removeChild(lightbox);
                            document.body.style.overflow = 'auto';
                        }
                    });

                    // Close on ESC key
                    document.addEventListener('keydown', function (e) {
                        if (e.key === 'Escape') {
                            if (document.body.contains(lightbox)) {
                                document.body.removeChild(lightbox);
                                document.body.style.overflow = 'auto';
                            }
                        }
                    });
                });
            });
        }
    });
</script>

<?php get_footer(); ?>
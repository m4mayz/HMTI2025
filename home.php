<?php get_header(); ?>

<!-- Section: Search Bar & Postingan -->
<section class="py-12">
    <div class="container mx-auto px-6 lg:px-24">

        <!-- Search Bar -->
        <div class="flex justify-center w-full mb-16 relative z-50">
            <div
                class="lg:w-[70%] w-full h-16 border border-black/20 rounded-full flex items-center lg:py-4 py-2 px-3 lg:px-5 bg-white">
                <form method="get" action="<?php echo home_url('/'); ?>" class="flex items-center w-full h-full">
                    <!-- Dropdown Kategori -->
                    <div class="relative flex cursor-pointer">
                        <div class="btn-dropdown-cat flex justify-between items-center lg:w-[120px] w-[100px]">
                            <p class="text-base text-dark-bg font-body font-medium selected-dropdown">
                                <?php
                                if (isset($_GET['category']) && !empty($_GET['category'])) {
                                    $cat_names = [
                                        'berita' => 'Berita',
                                        'artikel' => 'Artikel',
                                        'informasi' => 'Informasi',
                                        'prestasi' => 'Prestasi'
                                    ];
                                    echo isset($cat_names[$_GET['category']]) ? $cat_names[$_GET['category']] : 'Semua Kategori';
                                } else {
                                    echo 'Semua Kategori';
                                }
                                ?>
                            </p>
                            <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 9l-7 7-7-7" />
                            </svg>
                        </div>
                        <ul
                            class="dropdown-cat-wrapper absolute top-12 lg:-left-5 -left-4 bg-white h-[200px] shadow-xl overflow-y-auto lg:w-[200px] w-[150px] px-2 py-2 rounded-2xl hidden z-[100] border border-gray-200">
                            <li>
                                <a href="<?php echo home_url('/berita-publikasi'); ?>"
                                    class="flex w-full h-full px-3 py-2 duration-300 hover:bg-primary/20 font-body font-medium text-base rounded">
                                    Semua Kategori
                                </a>
                            </li>
                            <li>
                                <a href="<?php echo get_category_link(get_category_by_slug('berita')->term_id); ?>"
                                    class="flex w-full h-full px-3 py-2 duration-300 hover:bg-primary/20 font-body font-medium text-base rounded">
                                    Berita
                                </a>
                            </li>
                            <li>
                                <a href="<?php echo get_category_link(get_category_by_slug('artikel')->term_id); ?>"
                                    class="flex w-full h-full px-3 py-2 duration-300 hover:bg-primary/20 font-body font-medium text-base rounded">
                                    Artikel
                                </a>
                            </li>
                            <li>
                                <a href="<?php echo get_category_link(get_category_by_slug('informasi')->term_id); ?>"
                                    class="flex w-full h-full px-3 py-2 duration-300 hover:bg-primary/20 font-body font-medium text-base rounded">
                                    Informasi
                                </a>
                            </li>
                            <li>
                                <a href="<?php echo get_category_link(get_category_by_slug('prestasi')->term_id); ?>"
                                    class="flex w-full h-full px-3 py-2 duration-300 hover:bg-primary/20 font-body font-medium text-base rounded">
                                    Prestasi
                                </a>
                            </li>
                        </ul>
                    </div>

                    <!-- Divider -->
                    <div class="w-[1px] h-full bg-gray-300 lg:mx-5 mx-2"></div>

                    <!-- Search Input -->
                    <input type="text" name="s"
                        class="flex-1 border-0 focus:ring-0 text-dark-bg font-body font-medium text-base lg:text-lg outline-none bg-transparent"
                        placeholder="Cari berita, artikel, atau informasi..."
                        value="<?php echo get_search_query(); ?>" />

                    <!-- Hidden category input -->
                    <?php if (isset($_GET['category']) && !empty($_GET['category'])): ?>
                        <input type="hidden" name="category" value="<?php echo esc_attr($_GET['category']); ?>" />
                    <?php endif; ?>

                    <!-- Search Button -->
                    <button
                        class="min-w-[40px] min-h-[40px] rounded-full bg-sky-500 hover:bg-sky-700 flex justify-center items-center ml-2 cursor-pointer"
                        type="submit">
                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                    </button>
                </form>
            </div>
        </div>

        <!-- POSTINGAN TERBARU -->
        <h2 class="font-title text-4xl lg:text-5xl font-bold text-dark-bg mb-12">
            Postingan
            <span class="title-with-highlight">
                <span class="highlight-text highlight">Terbaru</span>
                <span class="highlight-bar primary"></span>
            </span>
        </h2>

        <div class="grid grid-cols-1 gap-6 lg:grid-cols-3 lg:gap-8">
            <?php
            $latest_posts = new WP_Query([
                'post_type' => 'post',
                'posts_per_page' => 4,
                'category_name' => 'berita,artikel,informasi,prestasi', // Filter kategori
                'orderby' => 'date',
                'order' => 'DESC',
            ]);

            if ($latest_posts->have_posts()):
                $counter = 0;
                while ($latest_posts->have_posts()):
                    $latest_posts->the_post();
                    $counter++;

                    // Post pertama span 3 kolom
                    $col_class = ($counter == 1) ? 'lg:col-span-3' : 'lg:col-span-1';
                    $flex_class = ($counter == 1) ? 'flex-col lg:flex-row' : 'flex-col';
                    $img_height = ($counter == 1) ? 'h-48 lg:h-96' : 'h-48 lg:h-64';
                    $img_width = ($counter == 1) ? 'lg:w-1/2' : 'w-full';
                    $content_width = ($counter == 1) ? 'lg:w-1/2' : 'w-full';
                    ?>
                    <a href="<?php the_permalink(); ?>"
                        class="<?php echo $col_class; ?> flex <?php echo $flex_class; ?> gap-6 group bg-white rounded-lg overflow-hidden transition-all duration-300">
                        <figure class="<?php echo $img_width; ?> <?php echo $img_height; ?> rounded-lg overflow-hidden">
                            <?php if (has_post_thumbnail()): ?>
                                <?php the_post_thumbnail('large', ['class' => 'w-full h-full object-cover group-hover:scale-110 transition-transform duration-500']); ?>
                            <?php else: ?>
                                <img src="<?php echo get_template_directory_uri(); ?>/assets/images/placeholder.png"
                                    alt="<?php the_title(); ?>"
                                    class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                            <?php endif; ?>
                        </figure>

                        <div class="<?php echo $content_width; ?> flex flex-col gap-4 p-6">
                            <div class="flex items-center gap-2 text-sm font-body font-medium text-gray-600">
                                <?php
                                $categories = get_the_category();
                                if ($categories) {
                                    echo '<span class="capitalize">' . esc_html($categories[0]->name) . '</span>';
                                    echo '<span class="w-1.5 h-1.5 bg-primary rounded-full"></span>';
                                }
                                ?>
                                <span><?php echo human_time_diff(get_the_time('U'), current_time('timestamp')) . ' yang lalu'; ?></span>
                            </div>

                            <h3
                                class="font-title text-2xl <?php echo ($counter == 1) ? 'lg:text-4xl' : 'lg:text-2xl'; ?> font-bold text-dark-bg leading-tight">
                                <?php the_title(); ?>
                            </h3>

                            <p
                                class="font-body font-medium text-base text-gray-600 line-clamp-3 <?php echo ($counter == 1) ? 'lg:line-clamp-5' : ''; ?>">
                                <?php echo wp_trim_words(get_the_excerpt(), 20, '...'); ?>
                            </p>

                            <p class="font-body font-medium text-sm text-gray-500 mt-auto">
                                <?php echo get_the_date('j F Y'); ?>
                            </p>
                        </div>
                    </a>
                    <?php
                endwhile;
                wp_reset_postdata();
            else:
                ?>
                <p class="col-span-3 text-center text-gray-500 py-12">Belum ada postingan terbaru.</p>
            <?php endif; ?>
        </div>
    </div>
</section>

<!-- Section: POSTINGAN BERDASARKAN KATEGORI -->
<?php
$categories_to_display = ['berita', 'artikel', 'informasi', 'prestasi'];
$category_labels = [
    'berita' => 'Berita',
    'artikel' => 'Artikel',
    'informasi' => 'Informasi',
    'prestasi' => 'Prestasi'
];

$section_counter = 0;
foreach ($categories_to_display as $cat_slug):
    $cat_obj = get_category_by_slug($cat_slug);
    if (!$cat_obj)
        continue;

    $cat_posts = new WP_Query([
        'post_type' => 'post',
        'category_name' => $cat_slug,
        'posts_per_page' => 3,
        'orderby' => 'date',
        'order' => 'DESC',
    ]);

    if (!$cat_posts->have_posts())
        continue;

    $section_counter++;
    $bg_color = ($section_counter % 2 == 0) ? 'bg-white' : 'bg-white';
    ?>
    <!-- Divider -->
    <div class="container mx-auto px-6 lg:px-24 mb-12">
        <div class="border-t-2 border-gray-300"></div>
    </div>
    <section class="<?php echo $bg_color; ?> py-16">
        <div class="container mx-auto px-6 lg:px-24">
            <!-- Header Kategori -->
            <div class="flex items-center justify-between mb-8">
                <h2 class="font-title text-3xl lg:text-4xl font-bold text-dark-bg">
                    <span class="title-with-highlight">
                        <span class="highlight-text highlight"><?php echo esc_html($category_labels[$cat_slug]); ?></span>
                        <span class="highlight-bar primary"></span>
                    </span>
                </h2>
                <a href="<?php echo get_category_link($cat_obj->term_id); ?>" class="view-more-button">
                    <span class="font-body font-bold text-lg text-dark-bg">Lihat Semua</span>
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <circle cx="12" cy="12" r="12" fill="#3498DB" />
                        <path d="M10.5 16.5L15 12L10.5 7.5" stroke="white" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" />
                    </svg>
                </a>
            </div>

            <!-- Grid Postingan -->
            <div class="grid grid-cols-1 gap-6 lg:grid-cols-3 lg:gap-8">
                <?php
                while ($cat_posts->have_posts()):
                    $cat_posts->the_post();
                    ?>
                    <a href="<?php the_permalink(); ?>" class="flex flex-col gap-4 group">
                        <figure class="w-full h-48 lg:h-64 overflow-hidden rounded-lg">
                            <?php if (has_post_thumbnail()): ?>
                                <?php the_post_thumbnail('large', ['class' => 'w-full h-full object-cover group-hover:scale-110 transition-transform duration-500']); ?>
                            <?php else: ?>
                                <img src="<?php echo get_template_directory_uri(); ?>/assets/images/placeholder.png"
                                    alt="<?php the_title(); ?>"
                                    class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                            <?php endif; ?>
                        </figure>

                        <div class="flex flex-col gap-2">
                            <div class="flex items-center gap-2 text-sm font-body font-medium text-gray-600">
                                <span class="capitalize"><?php echo esc_html($category_labels[$cat_slug]); ?></span>
                                <span class="w-1.5 h-1.5 bg-primary rounded-full"></span>
                                <span><?php echo human_time_diff(get_the_time('U'), current_time('timestamp')) . ' yang lalu'; ?></span>
                            </div>

                            <h3
                                class="font-title text-xl lg:text-2xl font-bold text-dark-bg leading-tight group-hover:text-primary transition-colors duration-300">
                                <?php the_title(); ?>
                            </h3>

                            <p class="font-body font-medium text-base text-gray-600 line-clamp-3">
                                <?php echo wp_trim_words(get_the_excerpt(), 18, '...'); ?>
                            </p>

                            <p class="font-body font-medium text-sm text-gray-500">
                                <?php echo get_the_date('j F Y'); ?>
                            </p>
                        </div>
                    </a>
                    <?php
                endwhile;
                wp_reset_postdata();
                ?>
            </div>
        </div>
    </section>

    <?php
endforeach;
?>

<?php get_footer(); ?>
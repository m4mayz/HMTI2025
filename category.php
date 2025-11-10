<?php get_header(); ?>

<?php
// Get current category info
$current_category = get_queried_object();
$category_slug = $current_category->slug;
$category_name = $current_category->name;

// Set posts per page to 20
$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
query_posts(array(
    'cat' => $current_category->term_id,
    'posts_per_page' => 20,
    'paged' => $paged
));
?>

<!-- Section: Search Bar & Postingan -->
<section class="py-12">
    <div class="container mx-auto px-6 lg:px-24">

        <!-- Search Bar -->
        <div class="flex justify-center w-full mb-12 sm:mb-16 relative z-50">
            <div
                class="w-full sm:w-[90%] lg:w-[70%] h-12 sm:h-14 md:h-16 border border-black/20 rounded-full flex items-center py-2 px-2 sm:px-3 md:px-4 lg:px-5 bg-white">
                <form method="get" action="<?php echo home_url('/'); ?>" class="flex items-center w-full h-full">
                    <!-- Dropdown Kategori -->
                    <div class="relative flex cursor-pointer">
                        <div
                            class="btn-dropdown-cat flex justify-between items-center w-[70px] sm:w-[80px] lg:w-[120px]">
                            <p
                                class="text-[10px] sm:text-xs lg:text-base text-dark-bg font-body font-medium selected-dropdown truncate">
                                <?php echo esc_html($category_name); ?>
                            </p>
                            <svg class="w-2.5 h-2.5 sm:w-3 sm:h-3 md:w-4 md:h-4 ml-0.5 sm:ml-1 md:ml-2 shrink-0"
                                fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 9l-7 7-7-7" />
                            </svg>
                        </div>
                        <ul
                            class="dropdown-cat-wrapper absolute top-12 -left-2 sm:-left-4 lg:-left-5 bg-white h-[200px] shadow-xl overflow-y-auto w-[130px] sm:w-[150px] lg:w-[200px] px-2 py-2 rounded-2xl hidden z-[100] border border-gray-200">
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
                    <div class="w-[1px] h-full bg-gray-300 mx-1.5 sm:mx-2 md:mx-3 lg:mx-5"></div>

                    <!-- Search Input -->
                    <input type="text" name="s"
                        class="flex-1 border-0 focus:ring-0 text-dark-bg font-body font-medium text-xs sm:text-sm md:text-base lg:text-lg outline-none bg-transparent"
                        placeholder="Cari berita..." value="<?php echo get_search_query(); ?>" />

                    <!-- Hidden category input -->
                    <?php if (isset($_GET['category']) && !empty($_GET['category'])): ?>
                        <input type="hidden" name="category" value="<?php echo esc_attr($_GET['category']); ?>" />
                    <?php endif; ?>

                    <!-- Search Button -->
                    <button
                        class="min-w-[32px] min-h-[32px] sm:min-w-[36px] sm:min-h-[36px] md:min-w-[40px] md:min-h-[40px] rounded-full bg-sky-500 hover:bg-sky-700 flex justify-center items-center ml-1.5 sm:ml-2 cursor-pointer shrink-0"
                        type="submit">
                        <svg class="w-3.5 h-3.5 sm:w-4 sm:h-4 md:w-5 md:h-5 text-white" fill="none"
                            stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                    </button>
                </form>
            </div>
        </div>

        <!-- POSTINGAN KATEGORI -->
        <div class="mb-6 sm:mb-8">
            <h2 class="font-title text-2xl sm:text-3xl lg:text-4xl font-bold text-dark-bg">
                <span class="title-with-highlight">
                    <span class="highlight-text highlight"><?php echo esc_html($category_name); ?></span>
                    <span class="highlight-bar primary"></span>
                </span>
            </h2>
        </div>

        <!-- Grid Postingan -->
        <div class="grid grid-cols-2 lg:grid-cols-3 gap-4 sm:gap-6 lg:gap-8">
            <?php
            if (have_posts()):
                while (have_posts()):
                    the_post();
                    ?>
                    <a href="<?php the_permalink(); ?>" class="flex flex-col gap-2 sm:gap-3 group">
                        <figure class="w-full aspect-video overflow-hidden rounded-lg">
                            <?php if (has_post_thumbnail()): ?>
                                <?php the_post_thumbnail('large', ['class' => 'w-full h-full object-cover group-hover:scale-110 transition-transform duration-500']); ?>
                            <?php else: ?>
                                <img src="<?php echo get_template_directory_uri(); ?>/assets/images/placeholder.png"
                                    alt="<?php the_title(); ?>"
                                    class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                            <?php endif; ?>
                        </figure>

                        <div class="flex flex-col gap-1 sm:gap-1.5">
                            <!-- Kategori dan waktu - hidden di tablet -->
                            <div
                                class="hidden lg:flex items-center gap-2 text-xs sm:text-sm font-body font-medium text-gray-600">
                                <?php
                                $categories = get_the_category();
                                if ($categories) {
                                    echo '<span class="capitalize">' . esc_html($categories[0]->name) . '</span>';
                                    echo '<span class="w-1.5 h-1.5 bg-primary rounded-full"></span>';
                                }
                                ?>
                                <span><?php echo human_time_diff(get_the_time('U'), current_time('timestamp')) . ' yang lalu'; ?></span>
                            </div>

                            <!-- Waktu saja untuk tablet -->
                            <div class="flex lg:hidden items-center gap-2 text-xs font-body font-medium text-gray-600">
                                <span><?php echo human_time_diff(get_the_time('U'), current_time('timestamp')) . ' yang lalu'; ?></span>
                            </div>

                            <h3
                                class="font-title text-base sm:text-lg lg:text-xl font-bold text-dark-bg leading-tight group-hover:text-primary transition-colors duration-300 line-clamp-2">
                                <?php the_title(); ?>
                            </h3>

                            <!-- Excerpt dan tanggal - hidden di tablet -->
                            <p class="hidden lg:block font-body font-medium text-sm lg:text-base text-gray-600 line-clamp-2">
                                <?php echo wp_trim_words(get_the_excerpt(), 18, '...'); ?>
                            </p>

                            <p class="hidden lg:block font-body font-medium text-xs lg:text-sm text-gray-500">
                                <?php echo get_the_date('j F Y'); ?>
                            </p>
                        </div>
                    </a>
                    <?php
                endwhile;
                ?>
            </div>

            <!-- Pagination -->
            <div class="mt-12">
                <?php
                the_posts_pagination([
                    'mid_size' => 2,
                    'prev_text' => __('← Sebelumnya', 'hmti2025'),
                    'next_text' => __('Selanjutnya →', 'hmti2025'),
                    'class' => 'font-body',
                ]);
                ?>
            </div>

            <?php
            else:
                ?>
            <p class="col-span-3 text-center text-gray-500 py-12">Belum ada postingan di kategori ini.</p>
        <?php endif; ?>

        <?php wp_reset_query(); ?>
    </div>

    </div>
</section>

<?php get_footer(); ?>
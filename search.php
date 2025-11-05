<?php get_header(); ?>

<?php
// Search results template
$search_query = get_search_query();
$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
// Ensure 20 posts per page for search
query_posts(array(
    's' => $search_query,
    'posts_per_page' => 20,
    'paged' => $paged,
));
?>

<!-- Section: Search Results -->
<section class="py-12">
    <div class="container mx-auto px-6 lg:px-24">

        <!-- Search Bar -->
        <div class="flex justify-center w-full mb-12 relative z-50">
            <div
                class="lg:w-[70%] w-full h-16 border border-black/20 rounded-full flex items-center lg:py-4 py-2 px-3 lg:px-5 bg-white">
                <form method="get" action="<?php echo home_url('/'); ?>" class="flex items-center w-full h-full">
                    <div class="relative flex cursor-pointer">
                        <div class="btn-dropdown-cat flex justify-between items-center lg:w-[120px] w-[100px]">
                            <p class="text-lg text-dark-bg font-body font-medium selected-dropdown">Cari</p>
                            <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 9l-7 7-7-7" />
                            </svg>
                        </div>
                        <!-- dropdown omitted in search template - keep minimal -->
                    </div>

                    <div class="w-[1px] h-full bg-gray-300 lg:mx-5 mx-2"></div>

                    <input type="search" name="s" value="<?php echo esc_attr($search_query); ?>"
                        placeholder="Cari berita, artikel, atau informasi..."
                        class="flex-1 border-0 focus:ring-0 text-dark-bg font-body font-medium text-base lg:text-lg outline-none bg-transparent" />

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

        <!-- Title -->
        <div class="mb-8">
            <h2 class="font-title text-3xl lg:text-4xl font-bold text-dark-bg">
                Hasil Pencarian
                <span class="title-with-highlight">
                    <span class="highlight-text highlight">"<?php echo esc_html($search_query); ?>"</span>
                    <span class="highlight-bar primary"></span>
                </span>
            </h2>
        </div>

        <!-- Grid Results -->
        <div class="grid grid-cols-1 gap-6 lg:grid-cols-3 lg:gap-8">
            <?php if (have_posts()): ?>
                <?php while (have_posts()):
                    the_post(); ?>
                    <a href="<?php the_permalink(); ?>" class="flex flex-col gap-4 group">
                        <figure class="w-full h-48 lg:h-64 overflow-hidden rounded-lg">
                            <?php if (has_post_thumbnail()): ?>
                                <?php the_post_thumbnail('large', ['class' => 'w-full h-full object-cover group-hover:scale-110 transition-transform duration-500']); ?>
                            <?php else: ?>
                                <img src="<?php echo get_template_directory_uri(); ?>/assets/images/placeholder.png"
                                    alt="<?php the_title_attribute(); ?>"
                                    class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                            <?php endif; ?>
                        </figure>

                        <div class="flex flex-col gap-2">
                            <div class="flex items-center gap-2 text-sm font-body font-medium text-gray-600">
                                <?php $cats = get_the_category();
                                if (!empty($cats)) {
                                    echo '<span class="capitalize">' . esc_html($cats[0]->name) . '</span>';
                                    echo '<span class="w-1.5 h-1.5 bg-primary rounded-full"></span>';
                                } ?>
                                <span><?php echo human_time_diff(get_the_time('U'), current_time('timestamp')) . ' yang lalu'; ?></span>
                            </div>

                            <h3
                                class="font-title text-xl lg:text-2xl font-bold text-dark-bg leading-tight group-hover:text-primary transition-colors duration-300">
                                <?php the_title(); ?></h3>

                            <p class="font-body font-medium text-base text-gray-600 line-clamp-3">
                                <?php echo wp_trim_words(get_the_excerpt(), 18, '...'); ?></p>

                            <p class="font-body font-medium text-sm text-gray-500"><?php echo get_the_date('j F Y'); ?></p>
                        </div>
                    </a>
                <?php endwhile; ?>
            <?php else: ?>
                <p class="col-span-3 text-center text-gray-500 py-12">Tidak ada hasil untuk
                    "<?php echo esc_html($search_query); ?>".</p>
            <?php endif; ?>
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

    </div>
</section>

<?php wp_reset_query(); ?>

<?php get_footer(); ?>
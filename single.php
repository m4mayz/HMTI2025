<?php get_header(); ?>

<?php
if (have_posts()):
    while (have_posts()):
        the_post();
        ?>
        <main class="w-full bg-gray-50">
            <!-- Hero Section with Featured Image -->
            <?php if (has_post_thumbnail()): ?>
                <div
                    class="relative w-full h-[300px] sm:h-[400px] lg:h-[500px] overflow-hidden bg-gradient-to-b from-dark-bg to-gray-900">
                    <?php the_post_thumbnail('full', ['class' => 'w-full h-full object-cover opacity-40']); ?>
                    <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/40 to-transparent"></div>
                </div>
            <?php endif; ?>

            <div class="container mx-auto pb-4 px-4 sm:px-6 lg:px-24 -mt-20 sm:-mt-32 lg:-mt-40 relative z-10">
                <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 lg:gap-10">
                    <!-- Main Content -->
                    <article class="lg:col-span-8">
                        <!-- Content Card -->
                        <div class="bg-white rounded-2xl shadow-xl overflow-hidden">
                            <!-- Category Badge -->
                            <div class="px-4 sm:px-6 lg:px-10 pt-6 sm:pt-8 lg:pt-10">
                                <?php
                                $categories = get_the_category();
                                if (!empty($categories)):
                                    ?>
                                    <div class="inline-flex items-center gap-2 mb-4">
                                        <span
                                            class="inline-block bg-primary text-white px-4 py-1.5 rounded-full text-xs sm:text-sm font-body font-bold uppercase tracking-wide">
                                            <?php echo esc_html($categories[0]->name); ?>
                                        </span>
                                        <span class="text-gray-400 text-xs sm:text-sm">•</span>
                                        <span class="text-gray-500 font-body font-medium text-xs sm:text-sm">
                                            <?php echo human_time_diff(get_the_time('U'), current_time('timestamp')) . ' yang lalu'; ?>
                                        </span>
                                    </div>
                                <?php endif; ?>

                                <!-- Post Title -->
                                <h1
                                    class="font-title text-2xl sm:text-3xl lg:text-5xl font-bold leading-tight text-dark-bg mb-4 sm:mb-6 wrap-break-word">
                                    <?php the_title(); ?>
                                </h1>

                                <!-- Post Meta -->
                                <div class="flex flex-wrap items-center gap-3 sm:gap-4 pb-6 sm:pb-8 border-b border-gray-200">
                                    <!-- Author -->
                                    <div class="flex items-center gap-2">
                                        <div
                                            class="w-8 h-8 sm:w-10 sm:h-10 rounded-full bg-primary/10 flex items-center justify-center">
                                            <svg class="w-4 h-4 sm:w-5 sm:h-5 text-primary" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                            </svg>
                                        </div>
                                        <a href="<?php echo get_author_posts_url(get_the_author_meta('ID')); ?>"
                                            class="text-gray-700 font-body font-semibold text-sm sm:text-base hover:text-primary transition-colors">
                                            <?php the_author(); ?>
                                        </a>
                                    </div>

                                    <!-- Date -->
                                    <div class="flex items-center gap-2">
                                        <svg class="w-4 h-4 sm:w-5 sm:h-5 text-gray-400" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                        </svg>
                                        <span class="text-gray-600 font-body font-medium text-sm sm:text-base">
                                            <?php echo get_the_date('d F Y'); ?>
                                        </span>
                                    </div>
                                </div>

                                <!-- Share Buttons -->
                                <div class="flex items-center gap-3 py-4 sm:py-6">
                                    <span class="text-gray-600 font-body font-semibold text-sm sm:text-base">Bagikan:</span>

                                    <a href="https://x.com/intent/tweet?url=<?php echo urlencode(get_permalink()); ?>&text=<?php echo urlencode(get_the_title()); ?>"
                                        target="_blank"
                                        class="w-9 h-9 sm:w-10 sm:h-10 bg-gradient-to-br from-black to-gray-800 hover:from-gray-900 hover:to-gray-700 rounded-full flex items-center justify-center transition-all duration-300 shadow-md hover:shadow-lg transform hover:-translate-y-0.5"
                                        title="Bagikan ke X">
                                        <svg class="w-4 h-4 sm:w-5 sm:h-5 text-white" fill="currentColor" viewBox="0 0 24 24">
                                            <path
                                                d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z" />
                                        </svg>
                                    </a>

                                    <!-- Share Facebook -->
                                    <a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo urlencode(get_permalink()); ?>"
                                        target="_blank"
                                        class="w-9 h-9 sm:w-10 sm:h-10 bg-gradient-to-br from-blue-500 to-blue-700 hover:from-blue-600 hover:to-blue-800 rounded-full flex items-center justify-center transition-all duration-300 shadow-md hover:shadow-lg transform hover:-translate-y-0.5"
                                        title="Bagikan ke Facebook">
                                        <svg class="w-4 h-4 sm:w-5 sm:h-5 text-white" fill="currentColor" viewBox="0 0 24 24">
                                            <path
                                                d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z" />
                                        </svg>
                                    </a>

                                    <!-- Share WhatsApp -->
                                    <a href="https://wa.me/?text=<?php echo urlencode(get_the_title() . ' - ' . get_permalink()); ?>"
                                        target="_blank"
                                        class="w-9 h-9 sm:w-10 sm:h-10 bg-gradient-to-br from-green-500 to-green-700 hover:from-green-600 hover:to-green-800 rounded-full flex items-center justify-center transition-all duration-300 shadow-md hover:shadow-lg transform hover:-translate-y-0.5"
                                        title="Bagikan ke WhatsApp">
                                        <svg class="w-4 h-4 sm:w-5 sm:h-5 text-white" fill="currentColor" viewBox="0 0 24 24">
                                            <path
                                                d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413Z" />
                                        </svg>
                                    </a>

                                    <!-- Copy Link -->
                                    <button onclick="copyToClipboard(this, '<?php echo esc_js(get_permalink()); ?>')"
                                        class="relative w-9 h-9 sm:w-10 sm:h-10 bg-gradient-to-br from-gray-500 to-gray-700 hover:from-gray-600 hover:to-gray-800 rounded-full flex items-center justify-center transition-all duration-300 shadow-md hover:shadow-lg transform hover:-translate-y-0.5"
                                        title="Salin Link">
                                        <svg class="w-4 h-4 sm:w-5 sm:h-5 text-white" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z" />
                                        </svg>
                                        <span
                                            class="copy-tooltip absolute -top-10 left-1/2 transform -translate-x-1/2 bg-dark-bg text-white text-xs px-3 py-1.5 rounded-lg opacity-0 pointer-events-none transition-opacity duration-300 whitespace-nowrap">
                                            Link tersalin!
                                        </span>
                                    </button>
                                </div>
                            </div>

                            <!-- Featured Image (if not already shown in hero) -->
                            <?php if (!has_post_thumbnail()): ?>
                                <div class="px-4 sm:px-6 lg:px-10">
                                    <div
                                        class="w-full h-[200px] sm:h-[300px] lg:h-[400px] bg-gradient-to-br from-primary/20 to-secondary/20 rounded-xl flex items-center justify-center">
                                        <svg class="w-16 h-16 sm:w-20 sm:h-20 text-gray-300" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                        </svg>
                                    </div>
                                </div>
                            <?php endif; ?>

                            <!-- Post Content -->
                            <div class="px-4 sm:px-6 lg:px-10 py-6 sm:py-8 lg:py-10">
                                <div
                                    class="prose prose-sm sm:prose-base lg:prose-lg max-w-none font-body text-gray-700 leading-relaxed post-content">
                                    <?php the_content(); ?>
                                </div>
                            </div>

                            <!-- Tags -->
                            <?php
                            $tags = get_the_tags();
                            if ($tags):
                                ?>
                                <div class="px-4 sm:px-6 lg:px-10 pb-6 sm:pb-8 lg:pb-10 border-t border-gray-100">
                                    <div class="flex flex-wrap gap-2 pt-6">
                                        <span class="text-gray-600 font-body font-semibold text-sm">Tags:</span>
                                        <?php foreach ($tags as $tag): ?>
                                            <a href="<?php echo get_tag_link($tag->term_id); ?>"
                                                class="inline-block bg-gray-100 hover:bg-primary hover:text-white text-gray-700 px-3 py-1 rounded-full text-xs sm:text-sm font-body font-medium transition-all duration-300">
                                                #<?php echo esc_html($tag->name); ?>
                                            </a>
                                        <?php endforeach; ?>
                                    </div>
                                </div>
                            <?php endif; ?>

                            <!-- Related Posts -->
                            <?php
                            if ($tags) {
                                $tag_ids = array();
                                foreach ($tags as $tag) {
                                    $tag_ids[] = $tag->term_id;
                                }

                                $related_posts = new WP_Query(array(
                                    'tag__in' => $tag_ids,
                                    'post__not_in' => array(get_the_ID()),
                                    'posts_per_page' => 3,
                                    'orderby' => 'rand'
                                ));

                                if ($related_posts->have_posts()): ?>
                                    <div class="bg-gradient-to-br from-primary/5 to-secondary/5 px-4 sm:px-6 lg:px-10 py-6 sm:py-8">
                                        <h3 class="font-title text-xl sm:text-2xl font-bold text-dark-bg mb-4 sm:mb-6">
                                            Artikel Terkait
                                        </h3>
                                        <div class="grid grid-cols-1 gap-4">
                                            <?php while ($related_posts->have_posts()):
                                                $related_posts->the_post(); ?>
                                                <a href="<?php the_permalink(); ?>"
                                                    class="flex gap-4 p-3 sm:p-4 bg-white rounded-lg hover:shadow-md transition-all duration-300 group">
                                                    <?php if (has_post_thumbnail()): ?>
                                                        <div class="w-20 h-20 sm:w-24 sm:h-24 rounded-lg overflow-hidden flex-shrink-0">
                                                            <?php the_post_thumbnail('thumbnail', ['class' => 'w-full h-full object-cover group-hover:scale-110 transition-transform duration-300']); ?>
                                                        </div>
                                                    <?php endif; ?>
                                                    <div class="flex-1 min-w-0">
                                                        <h4
                                                            class="font-body font-semibold text-sm sm:text-base text-dark-bg group-hover:text-primary transition-colors line-clamp-2 mb-2">
                                                            <?php the_title(); ?>
                                                        </h4>
                                                        <p class="text-xs sm:text-sm text-gray-500">
                                                            <?php echo get_the_date('d F Y'); ?>
                                                        </p>
                                                    </div>
                                                </a>
                                            <?php endwhile; ?>
                                        </div>
                                    </div>
                                    <?php
                                    wp_reset_postdata();
                                endif;
                            }
                            ?>
                        </div>
                    </article>

                    <!-- Sidebar -->
                    <aside class="lg:col-span-4">
                        <div class="lg:sticky lg:top-24 space-y-6">
                            <!-- Latest Posts Widget -->
                            <div class="bg-white rounded-2xl shadow-lg p-4 sm:p-6">
                                <h2
                                    class="font-title text-xl sm:text-2xl lg:text-3xl font-bold text-dark-bg mb-4 sm:mb-6 pb-4 border-b-2 border-primary">
                                    Berita Terbaru
                                </h2>

                                <div class="space-y-4 sm:space-y-6">
                                    <?php
                                    $latest_posts = new WP_Query([
                                        'post_type' => 'post',
                                        'posts_per_page' => 5,
                                        'post__not_in' => [get_the_ID()],
                                        'orderby' => 'date',
                                        'order' => 'DESC'
                                    ]);

                                    if ($latest_posts->have_posts()):
                                        $counter = 0;
                                        while ($latest_posts->have_posts()):
                                            $latest_posts->the_post();
                                            $counter++;
                                            $sidebar_categories = get_the_category();
                                            ?>
                                            <article
                                                class="group <?php echo $counter < 5 ? 'pb-4 sm:pb-6 border-b border-gray-100' : ''; ?>">
                                                <a href="<?php the_permalink(); ?>" class="block">
                                                    <div class="flex gap-3 sm:gap-4">
                                                        <?php if (has_post_thumbnail()): ?>
                                                            <div class="w-20 h-20 sm:w-24 sm:h-24 rounded-lg overflow-hidden flex-shrink-0">
                                                                <?php the_post_thumbnail('thumbnail', ['class' => 'w-full h-full object-cover group-hover:scale-110 transition-transform duration-300']); ?>
                                                            </div>
                                                        <?php else: ?>
                                                            <div
                                                                class="w-20 h-20 sm:w-24 sm:h-24 rounded-lg bg-gradient-to-br from-primary/20 to-secondary/20 flex items-center justify-center flex-shrink-0">
                                                                <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor"
                                                                    viewBox="0 0 24 24">
                                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                                        d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                                                </svg>
                                                            </div>
                                                        <?php endif; ?>

                                                        <div class="flex-1 min-w-0">
                                                            <?php if (!empty($sidebar_categories)): ?>
                                                                <span
                                                                    class="inline-block text-[10px] sm:text-xs font-bold text-primary uppercase mb-1">
                                                                    <?php echo esc_html($sidebar_categories[0]->name); ?>
                                                                </span>
                                                            <?php endif; ?>
                                                            <h3
                                                                class="font-title text-sm sm:text-base font-semibold text-dark-bg group-hover:text-primary transition-colors leading-tight line-clamp-2 mb-2">
                                                                <?php the_title(); ?>
                                                            </h3>
                                                            <div class="flex items-center gap-2 text-xs text-gray-500">
                                                                <svg class="w-3 h-3" fill="none" stroke="currentColor"
                                                                    viewBox="0 0 24 24">
                                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                                        stroke-width="2"
                                                                        d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                                </svg>
                                                                <span><?php echo human_time_diff(get_the_time('U'), current_time('timestamp')) . ' lalu'; ?></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </a>
                                            </article>
                                            <?php
                                        endwhile;
                                        wp_reset_postdata();
                                    endif;
                                    ?>
                                </div>
                            </div>

                            <!-- Categories Widget -->
                            <div class="bg-gradient-to-br from-primary/10 to-secondary/10 rounded-2xl shadow-lg p-4 sm:p-6">
                                <h3 class="font-title text-xl sm:text-2xl font-bold text-dark-bg mb-4">
                                    Kategori
                                </h3>
                                <div class="flex flex-wrap gap-2">
                                    <?php
                                    $all_categories = get_categories([
                                        'taxonomy' => 'category',
                                        'hide_empty' => true,
                                        'number' => 10
                                    ]);
                                    foreach ($all_categories as $cat):
                                        ?>
                                        <a href="<?php echo get_category_link($cat->term_id); ?>"
                                            class="inline-block bg-white hover:bg-primary hover:text-white text-gray-700 px-3 sm:px-4 py-2 rounded-full text-xs sm:text-sm font-body font-semibold transition-all duration-300 shadow-sm hover:shadow-md">
                                            <?php echo esc_html($cat->name); ?>
                                            <span class="text-[10px] opacity-70">(<?php echo $cat->count; ?>)</span>
                                        </a>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                        </div>
                    </aside>
                </div>
            </div>


        </main>

        <script>
            function copyToClipboard(button, text) {
                navigator.clipboard.writeText(text).then(function () {
                    const tooltip = button.querySelector('.copy-tooltip');
                    tooltip.classList.add('opacity-100');
                    tooltip.classList.remove('opacity-0');

                    setTimeout(function () {
                        tooltip.classList.remove('opacity-100');
                        tooltip.classList.add('opacity-0');
                    }, 2000);
                }, function (err) {
                    console.error('Gagal menyalin link: ', err);
                });
            }
        </script>

        <?php
    endwhile;
endif;
?>

<?php get_footer(); ?>
<?php get_header(); ?>

<?php
if (have_posts()):
    while (have_posts()):
        the_post();
        ?>
        <main class="w-full bg-white">
            <!-- Hero Section with Featured Image -->
            <?php if (has_post_thumbnail()): ?>
                <div
                    class="relative w-full h-[300px] sm:h-[400px] lg:h-[500px] overflow-hidden bg-gradient-to-b from-dark-bg to-gray-900">
                    <?php the_post_thumbnail('full', ['class' => 'w-full h-full object-cover opacity-40']); ?>
                    <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/40 to-transparent"></div>
                </div>
            <?php endif; ?>

            <div class="container mx-auto pb-4 px-4 sm:px-6 lg:px-24 -mt-20 sm:-mt-32 lg:-mt-40 relative z-10">
                <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 lg:gap-5">
                    <!-- Main Content -->
                    <article class="lg:col-span-8">
                        <!-- Content Card -->
                        <div class="bg-white overflow-hidden">
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
                                    class="font-body text-2xl sm:text-3xl lg:text-5xl font-bold leading-tight text-dark-bg mb-4 sm:mb-6 wrap-break-word">
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
                                <div class="post-content font-body text-gray-700 leading-relaxed">
                                    <?php the_content(); ?>
                                </div>
                            </div> <!-- Tags -->
                            <?php
                            $tags = get_the_tags();
                            if ($tags):
                                ?>
                                <div class="px-4 sm:px-6 lg:px-10 pb-6 sm:pb-8 lg:pb-10 border-t border-gray-300">
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
                                        <h3 class="font-body text-xl sm:text-2xl font-bold text-dark-bg mb-4 sm:mb-6">
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
                    <aside class="bg-white mt-10 p-4 sm:p-6 lg:col-span-4 lg:sticky lg:top-20 lg:right-0">
                        <!-- Latest Posts Widget -->
                        <h2
                            class="font-body text-xl sm:text-2xl lg:text-3xl font-bold text-dark-bg mb-4 sm:mb-6 pb-4 border-b-2 border-primary">
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
                                    <article class="group <?php echo $counter < 5 ? 'pb-4 sm:pb-6 border-b border-gray-300' : ''; ?>">
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
                                                            class="inline-block text-[10px] sm:text-xs lg:text-sm font-bold text-primary uppercase mb-1">
                                                            <?php echo esc_html($sidebar_categories[0]->name); ?>
                                                        </span>
                                                    <?php endif; ?>
                                                    <h3
                                                        class="font-body text-sm sm:text-base lg:text-lg font-bold text-dark-bg group-hover:text-primary transition-colors leading-tight line-clamp-2 mb-2">
                                                        <?php the_title(); ?>
                                                    </h3>
                                                    <div class="flex items-center gap-2 text-xs lg:text-sm font-medium text-gray-500">
                                                        <svg class="w-3 h-3 lg:w-4 lg:h-4" fill="none" stroke="currentColor"
                                                            viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
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
                    </aside>
                </div>
            </div>


        </main>

        <!-- Custom CSS for WordPress Editor Content -->
        <style>
            /* Post Content Formatting */
            .post-content {
                font-size: 1rem;
                line-height: 1.7;
                font-weight: 500;
            }

            @media (min-width: 640px) {
                .post-content {
                    font-size: 1.0625rem;
                    line-height: 1.7;
                }
            }

            @media (min-width: 1024px) {
                .post-content {
                    font-size: 1.25rem;
                    line-height: 1.7;
                }
            }

            /* Headings */
            .post-content h1,
            .post-content h2,
            .post-content h3,
            .post-content h4,
            .post-content h5,
            .post-content h6 {
                font-family: var(--font-body);
                font-weight: 700;
                color: var(--dark-bg);
                /* margin-top: 1rem; */
                line-height: 1.3;
            }

            .post-content h1 {
                font-size: 28px;
            }

            .post-content h2 {
                font-size: 24px;
                position: relative;
                padding-left: 40px;
                margin-bottom: 1rem;
                margin-top: 1.2rem;
            }

            .post-content h2::before {
                content: '';
                position: absolute;
                left: 0;
                top: 50%;
                transform: translateY(-50%);
                width: 20px;
                height: 20px;
                background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='%233498db' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3E%3Cpath d='M10 13a5 5 0 0 0 7.54.54l3-3a5 5 0 0 0-7.07-7.07l-1.72 1.71'/%3E%3Cpath d='M14 11a5 5 0 0 0-7.54-.54l-3 3a5 5 0 0 0 7.07 7.07l1.71-1.71'/%3E%3C/svg%3E");
                background-size: contain;
                background-repeat: no-repeat;
                background-position: center;
            }

            .post-content h3 {
                font-size: 20px;
                margin-bottom: 0.5rem;
            }

            .post-content h4 {
                font-size: 18px;
            }

            .post-content h5 {
                font-size: 16px;
            }

            .post-content h6 {
                font-size: 14px;
            }

            /* Responsive Headings - Tablet */
            @media (min-width: 640px) {
                .post-content h1 {
                    font-size: 36px;
                }

                .post-content h2 {
                    font-size: 30px;
                }

                .post-content h2::before {
                    width: 22px;
                    height: 22px;
                }

                .post-content h3 {
                    font-size: 24px;
                }

                .post-content h4 {
                    font-size: 20px;
                }

                .post-content h5 {
                    font-size: 18px;
                }

                .post-content h6 {
                    font-size: 16px;
                }
            }

            /* Responsive Headings - Desktop */
            @media (min-width: 1024px) {
                .post-content h1 {
                    font-size: 48px;
                }

                .post-content h2 {
                    font-size: 36px;
                }

                .post-content h2::before {
                    width: 24px;
                    height: 24px;
                }

                .post-content h3 {
                    font-size: 28px;
                }

                .post-content h4 {
                    font-size: 22px;
                }

                .post-content h5 {
                    font-size: 18px;
                }

                .post-content h6 {
                    font-size: 16px;
                }
            }

            /* Paragraphs */
            .post-content p {
                margin-bottom: 1.25rem;
                color: #374151;
                font-weight: 500;
            }

            /* Links */
            .post-content a {
                color: var(--primary-color);
                text-decoration: underline;
                font-weight: 500;
                transition: all 0.3s ease;
            }

            .post-content a:hover {
                color: var(--primary-dark);
                text-decoration: none;
            }

            /* Lists */
            .post-content ul,
            .post-content ol {
                margin-bottom: 1.25rem;
                padding-left: 2rem;
            }

            .post-content ul {
                list-style-type: disc;
            }

            .post-content ol {
                list-style-type: decimal;
            }

            .post-content li {
                margin-bottom: 0.5rem;
                color: #374151;
                font-weight: 500;
            }

            .post-content li::marker {
                color: var(--primary-color);
            }

            .post-content ul ul,
            .post-content ol ol,
            .post-content ul ol,
            .post-content ol ul {
                margin-top: 0.5rem;
                margin-bottom: 0.5rem;
            }

            /* Blockquotes */
            .post-content blockquote {
                border-left: 4px solid var(--primary-color);
                padding-left: 1.5rem;
                margin: 1.5rem 0;
                font-style: italic;
                color: #4b5563;
                background: linear-gradient(to right, rgba(52, 152, 219, 0.05), transparent);
                padding: 1rem 1.5rem;
                border-radius: 0.5rem;
            }

            .post-content blockquote p {
                margin-bottom: 0.5rem;
            }

            .post-content blockquote cite {
                display: block;
                margin-top: 0.5rem;
                font-size: 0.875rem;
                color: #6b7280;
                font-style: normal;
            }

            /* Images */
            .post-content img {
                max-width: 100%;
                height: auto;
                border-radius: 0.75rem;
                margin: 1.5rem 0;
                box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
            }

            .post-content figure {
                margin: 1.5rem 0;
            }

            .post-content figcaption {
                text-align: center;
                font-size: 0.875rem;
                color: #6b7280;
                margin-top: 0.5rem;
                font-style: italic;
            }

            /* WordPress alignment classes */
            .post-content .alignleft {
                float: left;
                margin-right: 1.5rem;
                margin-bottom: 1rem;
                max-width: 50%;
            }

            .post-content .alignright {
                float: right;
                margin-left: 1.5rem;
                margin-bottom: 1rem;
                max-width: 50%;
            }

            .post-content .aligncenter {
                display: block;
                margin-left: auto;
                margin-right: auto;
            }

            .post-content .alignwide {
                max-width: 100%;
            }

            .post-content .alignfull {
                max-width: 100vw;
                width: 100vw;
                margin-left: calc(50% - 50vw);
            }

            /* Tables */
            .post-content table {
                width: 100%;
                border-collapse: collapse;
                margin: 1.5rem 0;
                overflow-x: auto;
                display: block;
                box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
                border-radius: 0.5rem;
            }

            .post-content table thead {
                background: linear-gradient(to right, var(--primary-color), var(--primary-dark));
                color: white;
            }

            .post-content table th {
                padding: 0.75rem 1rem;
                text-align: left;
                font-weight: 600;
                font-size: 0.875rem;
                text-transform: uppercase;
                letter-spacing: 0.05em;
            }

            .post-content table td {
                padding: 0.75rem 1rem;
                border-bottom: 1px solid #e5e7eb;
                color: #374151;
                font-weight: 500;
            }

            .post-content table tbody tr:hover {
                background-color: rgba(52, 152, 219, 0.05);
            }

            .post-content table tbody tr:last-child td {
                border-bottom: none;
            }

            /* Code */
            .post-content code {
                background-color: #f3f4f6;
                padding: 0.25rem 0.5rem;
                border-radius: 0.25rem;
                font-family: 'Courier New', Courier, monospace;
                font-size: 0.875em;
                color: #dc2626;
            }

            .post-content pre {
                background-color: #1f2937;
                color: #f3f4f6;
                padding: 1.5rem;
                border-radius: 0.5rem;
                overflow-x: auto;
                margin: 1.5rem 0;
                line-height: 1.6;
            }

            .post-content pre code {
                background-color: transparent;
                padding: 0;
                color: #f3f4f6;
                font-size: 0.875rem;
            }

            /* Horizontal Rule */
            .post-content hr {
                border: none;
                border-top: 2px solid #e5e7eb;
                margin: 2rem 0;
            }

            /* Strong and Emphasis */
            .post-content strong,
            .post-content b {
                font-weight: 700;
                color: var(--dark-bg);
            }

            .post-content em,
            .post-content i {
                font-style: italic;
            }

            /* WordPress Embeds (Video, iframe) */
            .post-content iframe,
            .post-content embed,
            .post-content object {
                max-width: 100%;
                margin: 1.5rem 0;
                border-radius: 0.75rem;
            }

            .post-content .wp-block-embed {
                margin: 1.5rem 0;
            }

            .post-content .wp-block-embed iframe {
                width: 100%;
                aspect-ratio: 16/9;
            }

            /* WordPress Buttons */
            .post-content .wp-block-button {
                margin: 1.5rem 0;
            }

            .post-content .wp-block-button__link {
                display: inline-block;
                padding: 0.75rem 1.5rem;
                background: linear-gradient(to right, var(--primary-color), var(--primary-dark));
                color: white;
                text-decoration: none;
                border-radius: 9999px;
                font-weight: 600;
                transition: all 0.3s ease;
            }

            .post-content .wp-block-button__link:hover {
                transform: translateY(-2px);
                box-shadow: 0 4px 12px rgba(52, 152, 219, 0.4);
            }

            /* WordPress Columns */
            .post-content .wp-block-columns {
                display: grid;
                gap: 1.5rem;
                margin: 1.5rem 0;
            }

            @media (min-width: 768px) {
                .post-content .wp-block-columns {
                    grid-template-columns: repeat(auto-fit, minmax(0, 1fr));
                }
            }

            /* WordPress Gallery */
            .post-content .wp-block-gallery {
                display: grid;
                grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
                gap: 1rem;
                margin: 1.5rem 0;
            }

            .post-content .wp-block-gallery img {
                margin: 0;
            }

            /* WordPress Cover Block */
            .post-content .wp-block-cover {
                margin: 1.5rem 0;
                border-radius: 0.75rem;
                overflow: hidden;
            }

            /* Captions */
            .post-content .wp-caption {
                max-width: 100%;
                margin: 1.5rem 0;
            }

            .post-content .wp-caption-text {
                text-align: center;
                font-size: 0.875rem;
                color: #6b7280;
                margin-top: 0.5rem;
                font-style: italic;
            }

            /* Clearfix for floated images */
            .post-content::after {
                content: "";
                display: table;
                clear: both;
            }

            /* Responsive tables on mobile */
            @media (max-width: 640px) {
                .post-content table {
                    font-size: 0.875rem;
                }

                .post-content table th,
                .post-content table td {
                    padding: 0.5rem;
                }
            }

            /* Mark/Highlight */
            .post-content mark {
                background-color: #fef3c7;
                padding: 0.125rem 0.25rem;
                border-radius: 0.25rem;
            }

            /* Subscript and Superscript */
            .post-content sub,
            .post-content sup {
                font-size: 0.75em;
                line-height: 0;
                position: relative;
                vertical-align: baseline;
            }

            .post-content sup {
                top: -0.5em;
            }

            .post-content sub {
                bottom: -0.25em;
            }

            /* Definition Lists */
            .post-content dl {
                margin: 1.5rem 0;
            }

            .post-content dt {
                font-weight: 700;
                color: var(--dark-bg);
                margin-top: 1rem;
            }

            .post-content dd {
                margin-left: 2rem;
                margin-bottom: 0.5rem;
                color: #374151;
                font-weight: 500;
            }

            /* Address */
            .post-content address {
                font-style: normal;
                margin: 1.5rem 0;
                padding: 1rem;
                background-color: #f9fafb;
                border-left: 4px solid var(--primary-color);
                border-radius: 0.5rem;
            }

            /* Abbreviation */
            .post-content abbr[title] {
                text-decoration: underline dotted;
                cursor: help;
                border-bottom: 1px dotted currentColor;
            }
        </style>

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
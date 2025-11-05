<?php get_header(); ?>

<?php
if (have_posts()):
    while (have_posts()):
        the_post();
        ?>
        <main class="w-full py-16 bg-white">
            <div class="container mx-auto px-6 lg:px-50">
                <!-- Post Meta -->
                <div class="flex flex-wrap gap-1 lg:flex-nowrap lg:gap-2 mb-6">
                    <a href="<?php echo get_author_posts_url(get_the_author_meta('ID')); ?>"
                        class="text-gray-500 font-body font-medium text-sm lg:text-base hover:text-primary transition-colors">
                        <?php the_author(); ?>
                    </a>
                    <span class="text-primary font-body text-sm lg:text-base">-</span>
                    <span class="text-gray-500 font-body font-medium text-sm lg:text-base">
                        <?php echo get_the_date('l, d F Y'); ?>
                    </span>
                    <span class="text-primary font-body text-sm lg:text-base">-</span>
                    <span class="text-gray-500 font-body font-medium text-sm lg:text-base">
                        <?php echo human_time_diff(get_the_time('U'), current_time('timestamp')) . ' yang lalu'; ?>
                    </span>
                </div>

                <div class="grid grid-cols-1 lg:grid-cols-12 gap-10">
                    <!-- Main Content -->
                    <div class="lg:col-span-8">
                        <!-- Post Title -->
                        <h1 class="font-title text-4xl lg:text-5xl font-bold leading-tight lg:leading-[58px] text-dark-bg mb-6">
                            <?php the_title(); ?>
                        </h1>

                        <!-- Share Buttons -->
                        <div class="flex items-center gap-4 mb-8 lg:mb-12">
                            <!-- Share Twitter -->
                            <a href="https://twitter.com/share?url=<?php echo urlencode(get_permalink()); ?>&text=<?php echo urlencode(get_the_title()); ?>"
                                target="_blank"
                                class="w-8 h-8 bg-gray-100 hover:bg-gray-200 rounded-full flex items-center justify-center transition-colors"
                                title="Bagikan ke Twitter">
                                <svg class="w-4 h-4 text-gray-600" fill="currentColor" viewBox="0 0 24 24">
                                    <path
                                        d="M23.953 4.57a10 10 0 01-2.825.775 4.958 4.958 0 002.163-2.723c-.951.555-2.005.959-3.127 1.184a4.92 4.92 0 00-8.384 4.482C7.69 8.095 4.067 6.13 1.64 3.162a4.822 4.822 0 00-.666 2.475c0 1.71.87 3.213 2.188 4.096a4.904 4.904 0 01-2.228-.616v.06a4.923 4.923 0 003.946 4.827 4.996 4.996 0 01-2.212.085 4.936 4.936 0 004.604 3.417 9.867 9.867 0 01-6.102 2.105c-.39 0-.779-.023-1.17-.067a13.995 13.995 0 007.557 2.209c9.053 0 13.998-7.496 13.998-13.985 0-.21 0-.42-.015-.63A9.935 9.935 0 0024 4.59z" />
                                </svg>
                            </a>

                            <!-- Share Facebook -->
                            <a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo urlencode(get_permalink()); ?>"
                                target="_blank"
                                class="w-8 h-8 bg-gray-100 hover:bg-gray-200 rounded-full flex items-center justify-center transition-colors"
                                title="Bagikan ke Facebook">
                                <svg class="w-4 h-4 text-gray-600" fill="currentColor" viewBox="0 0 24 24">
                                    <path
                                        d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z" />
                                </svg>
                            </a>

                            <!-- Share WhatsApp -->
                            <a href="https://wa.me/?text=<?php echo urlencode(get_the_title() . ' - ' . get_permalink()); ?>"
                                target="_blank"
                                class="w-8 h-8 bg-gray-100 hover:bg-gray-200 rounded-full flex items-center justify-center transition-colors"
                                title="Bagikan ke WhatsApp">
                                <svg class="w-4 h-4 text-gray-600" fill="currentColor" viewBox="0 0 24 24">
                                    <path
                                        d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413Z" />
                                </svg>
                            </a>
                        </div>

                        <!-- Featured Image -->
                        <?php if (has_post_thumbnail()): ?>
                            <div class="mb-10">
                                <?php the_post_thumbnail('large', ['class' => 'w-full h-auto rounded-2xl object-cover']); ?>
                            </div>
                        <?php endif; ?>

                        <!-- Post Content -->
                        <div class="font-body font-medium text-base lg:text-xl text-gray-700 leading-relaxed post-content">
                            <?php the_content(); ?>
                        </div>

                        <!-- Related Posts / Artikel Terkait -->
                        <?php
                        $tags = get_the_tags();
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
                                <div class="mt-12 bg-gray-100 w-full h-fit px-4 py-2 transition-all duration-500">
                                    <strong class="font-body font-bold text-base lg:text-xl text-primary">Artikel Terkait :</strong>
                                    <ul class="mt-2 space-y-2">
                                        <?php while ($related_posts->have_posts()):
                                            $related_posts->the_post(); ?>
                                            <li class="list-disc ml-5">
                                                <a href="<?php the_permalink(); ?>"
                                                    class="font-body font-medium text-base lg:text-xl text-primary hover:underline">
                                                    <?php the_title(); ?>
                                                </a>
                                            </li>
                                        <?php endwhile; ?>
                                    </ul>
                                </div>
                                <?php
                                wp_reset_postdata();
                            endif;
                        }
                        ?>
                    </div>

                    <!-- Sidebar - Latest Posts -->
                    <aside class="lg:col-span-4">
                        <div class="lg:sticky lg:top-24">
                            <h2 class="font-title text-3xl lg:text-4xl font-bold text-dark-bg mb-6">Berita Terbaru</h2>

                            <ul class="pt-6 flex flex-col gap-6">
                                <?php
                                $latest_posts = new WP_Query([
                                    'post_type' => 'post',
                                    'posts_per_page' => 4,
                                    'post__not_in' => [get_the_ID()],
                                    'orderby' => 'date',
                                    'order' => 'DESC'
                                ]);

                                if ($latest_posts->have_posts()):
                                    while ($latest_posts->have_posts()):
                                        $latest_posts->the_post();
                                        $categories = get_the_category();
                                        ?>
                                        <li class="relative pb-6 border-b border-gray-200 last:border-b-0">
                                            <a href="<?php the_permalink(); ?>" class="flex flex-col group">
                                                <?php if (!empty($categories)): ?>
                                                    <p class="text-sm font-semibold text-primary pb-2 uppercase font-body">
                                                        <?php echo esc_html($categories[0]->name); ?>
                                                    </p>
                                                <?php endif; ?>
                                                <h3
                                                    class="font-title text-xl lg:text-2xl font-semibold text-dark-bg pb-4 leading-tight group-hover:text-primary transition-colors line-clamp-2">
                                                    <?php the_title(); ?>
                                                </h3>
                                                <p class="font-body text-sm text-gray-500">
                                                    <?php echo get_the_date('d F Y'); ?>
                                                </p>
                                            </a>
                                        </li>
                                        <?php
                                    endwhile;
                                    wp_reset_postdata();
                                endif;
                                ?>
                            </ul>
                        </div>
                    </aside>
                </div>
            </div>
        </main>

        <?php
    endwhile;
endif;
?>

<?php get_footer(); ?>
<?php
/*
Template Name: Arsip dan Unduhan
*/

get_header();
?>

<section class="w-full py-16 bg-white">
    <div class="container mx-auto px-6 lg:px-24">
        <!-- Page Title -->
        <div class="text-center mb-12">
            <h2 class="font-title text-4xl lg:text-5xl font-bold text-dark-bg mb-4">
                Download and Explore
                <span class="title-with-highlight">
                    <span class="highlight-text highlight">Files</span>
                    <span class="highlight-bar primary"></span>
                </span>
            </h2>
            <p class="font-body font-medium text-base lg:text-lg text-gray-600">
                Koleksi dokumen, formulir, dan file penting Himpunan Mahasiswa Teknik Informatika
            </p>
        </div>

        <!-- Search and Filter -->
        <div class="mb-8 bg-gray-50 p-6 rounded-lg shadow-sm">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <!-- Search Bar -->
                <div class="md:col-span-2">
                    <label for="search-input" class="block font-body font-bold text-gray-700 mb-2">
                        Cari Dokumen
                    </label>
                    <input type="text" id="search-input" placeholder="Cari berdasarkan nama file..."
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-primary font-body font-medium">
                </div>

                <!-- Date Filter -->
                <div>
                    <label for="date-filter" class="block font-body font-bold text-gray-700 mb-2">
                        Filter Tanggal
                    </label>
                    <select id="date-filter"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-primary font-body font-medium">
                        <option value="all">Semua Tanggal</option>
                        <option value="today">Hari Ini</option>
                        <option value="week">Minggu Ini</option>
                        <option value="month">Bulan Ini</option>
                        <option value="year">Tahun Ini</option>
                    </select>
                </div>
            </div>

            <!-- Reset Button -->
            <div class="mt-4">
                <button id="reset-filter"
                    class="px-4 py-2 bg-gray-200 hover:bg-gray-300 text-gray-700 font-body font-bold rounded-lg transition-colors">
                    Reset Filter
                </button>
            </div>
        </div>

        <?php
        // Get current page number
        $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;

        // Query untuk mendapatkan semua attachments (non-image files)
        $args = array(
            'post_type' => 'attachment',
            'post_mime_type' => array(
                'application/pdf',
                'application/msword',
                'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
                'application/vnd.ms-excel',
                'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
                'application/vnd.ms-powerpoint',
                'application/vnd.openxmlformats-officedocument.presentationml.presentation',
                'application/zip',
                'application/x-rar-compressed',
            ),
            'post_status' => 'inherit',
            'posts_per_page' => -1, // Get all for client-side filtering
            'orderby' => 'date',
            'order' => 'DESC'
        );

        $files_query = new WP_Query($args);

        if ($files_query->have_posts()): ?>
            <!-- Files List -->
            <div id="files-container">
                <div class="space-y-4">
                    <?php while ($files_query->have_posts()):
                        $files_query->the_post();
                        $file_url = wp_get_attachment_url(get_the_ID());
                        $file_title = get_the_title();
                        $file_date = get_the_date('Y-m-d H:i:s');
                        $file_date_display = get_the_date('d F Y');
                        $file_type = wp_check_filetype($file_url);
                        $file_size = size_format(filesize(get_attached_file(get_the_ID())), 2);
                        $file_extension = strtoupper($file_type['ext']);

                        // Icon color based on file type
                        $icon_color = 'bg-blue-100 text-blue-600';
                        if (in_array($file_extension, ['PDF'])) {
                            $icon_color = 'bg-red-100 text-red-600';
                        } elseif (in_array($file_extension, ['DOC', 'DOCX'])) {
                            $icon_color = 'bg-blue-100 text-blue-600';
                        } elseif (in_array($file_extension, ['XLS', 'XLSX'])) {
                            $icon_color = 'bg-green-100 text-green-600';
                        } elseif (in_array($file_extension, ['PPT', 'PPTX'])) {
                            $icon_color = 'bg-orange-100 text-orange-600';
                        } elseif (in_array($file_extension, ['ZIP', 'RAR'])) {
                            $icon_color = 'bg-purple-100 text-purple-600';
                        }
                        ?>
                        <div class="file-item bg-white border border-gray-200 rounded-lg p-4 hover:shadow-md transition-all duration-300"
                            data-title="<?php echo esc_attr(strtolower($file_title)); ?>"
                            data-date="<?php echo esc_attr($file_date); ?>">
                            <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                                <!-- File Info -->
                                <div class="flex items-start gap-4 flex-1">
                                    <!-- File Icon -->
                                    <div
                                        class="flex-shrink-0 w-12 h-12 <?php echo $icon_color; ?> rounded-lg flex items-center justify-center">
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z" />
                                        </svg>
                                    </div>

                                    <!-- File Details -->
                                    <div class="flex-1 min-w-0">
                                        <h3 class="font-title text-lg font-semibold text-dark-bg mb-1 truncate">
                                            <?php echo esc_html($file_title); ?>
                                        </h3>
                                        <div class="flex flex-wrap gap-3 text-sm text-gray-500 font-body font-medium">
                                            <span class="flex items-center gap-1">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                                </svg>
                                                <?php echo $file_date_display; ?>
                                            </span>
                                            <span class="flex items-center gap-1">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z" />
                                                </svg>
                                                <?php echo $file_extension; ?>
                                            </span>
                                            <span class="flex items-center gap-1">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-6l-2-2H5a2 2 0 00-2 2z" />
                                                </svg>
                                                <?php echo $file_size; ?>
                                            </span>
                                        </div>
                                    </div>
                                </div>

                                <!-- Download Button -->
                                <div class="flex-shrink-0">
                                    <a href="<?php echo esc_url($file_url); ?>" download
                                        class="inline-flex items-center gap-2 px-4 py-2 bg-primary hover:bg-primary/90 text-white font-body font-bold rounded-lg transition-colors">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                                        </svg>
                                        Unduh
                                    </a>
                                </div>
                            </div>
                        </div>
                    <?php endwhile; ?>
                </div>

                <!-- No Results Message -->
                <div id="no-results" class="hidden text-center py-12">
                    <svg class="w-24 h-24 mx-auto text-gray-300 mb-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                    </svg>
                    <h3 class="font-title text-2xl font-semibold text-gray-700 mb-2">
                        Tidak Ada Hasil
                    </h3>
                    <p class="font-body font-medium text-gray-500">
                        Tidak ada dokumen yang sesuai dengan pencarian Anda.
                    </p>
                </div>
            </div>

        <?php else: ?>
            <!-- No Files Found -->
            <div class="text-center py-20">
                <svg class="w-24 h-24 mx-auto text-gray-300 mb-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                </svg>
                <h3 class="font-title text-2xl font-semibold text-gray-700 mb-2">
                    Belum Ada File
                </h3>
                <p class="font-body font-medium text-gray-500">
                    Arsip dan unduhan belum tersedia saat ini.
                </p>
            </div>
        <?php endif; ?>

        <?php wp_reset_postdata(); ?>
    </div>
</section>

<!-- Filter Script -->
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const searchInput = document.getElementById('search-input');
        const dateFilter = document.getElementById('date-filter');
        const resetButton = document.getElementById('reset-filter');
        const fileItems = document.querySelectorAll('.file-item');
        const noResults = document.getElementById('no-results');

        function filterFiles() {
            const searchTerm = searchInput.value.toLowerCase().trim();
            const dateFilterValue = dateFilter.value;
            let visibleCount = 0;

            const now = new Date();
            const today = new Date(now.getFullYear(), now.getMonth(), now.getDate());
            const weekAgo = new Date(today);
            weekAgo.setDate(weekAgo.getDate() - 7);
            const monthStart = new Date(now.getFullYear(), now.getMonth(), 1);
            const yearStart = new Date(now.getFullYear(), 0, 1);

            fileItems.forEach(item => {
                const title = item.dataset.title;
                const fileDate = new Date(item.dataset.date);
                let matchesSearch = true;
                let matchesDate = true;

                // Search filter
                if (searchTerm) {
                    matchesSearch = title.includes(searchTerm);
                }

                // Date filter
                if (dateFilterValue !== 'all') {
                    switch (dateFilterValue) {
                        case 'today':
                            matchesDate = fileDate >= today;
                            break;
                        case 'week':
                            matchesDate = fileDate >= weekAgo;
                            break;
                        case 'month':
                            matchesDate = fileDate >= monthStart;
                            break;
                        case 'year':
                            matchesDate = fileDate >= yearStart;
                            break;
                    }
                }

                // Show/hide item
                if (matchesSearch && matchesDate) {
                    item.style.display = '';
                    visibleCount++;
                } else {
                    item.style.display = 'none';
                }
            });

            // Show/hide no results message
            if (visibleCount === 0) {
                noResults.classList.remove('hidden');
            } else {
                noResults.classList.add('hidden');
            }
        }

        // Event listeners
        searchInput.addEventListener('input', filterFiles);
        dateFilter.addEventListener('change', filterFiles);

        resetButton.addEventListener('click', function () {
            searchInput.value = '';
            dateFilter.value = 'all';
            filterFiles();
        });
    });
</script>

<?php get_footer(); ?>
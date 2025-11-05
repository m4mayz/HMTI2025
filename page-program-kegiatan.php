<?php
/**
 * Template Name: Program & Kegiatan
 */
get_header();
?>

<!-- Hero Section -->
<section class="about-new-hero-section">
    <div class="about-new-hero-container">
        <div class="about-new-hero-left">
            <h1 class="about-new-hero-headline">
                <span class="headline-text">Together in Every</span>
            </h1>
            <h1 class="about-new-hero-headline">
                <span class="headline-text">
                    <span class="text-content">Activity</span>
                    <span class="headline-highlighter"></span>
                </span>
            </h1>
        </div>
        <div class="about-new-hero-right">
            <!-- Empty as requested -->
        </div>
    </div>
</section>

<!-- Kalender Kegiatan Section -->
<section class="py-16 px-6 lg:px-24 bg-white" id="kalender-section">
    <div class="mb-12">
        <h2 class="font-title text-4xl lg:text-5xl font-bold text-dark-bg mb-4">
            <span class="title-with-highlight">
                <span class="highlight-text highlight">Kalender</span>
                <span class="highlight-bar primary"></span>
            </span>
            Kegiatan
        </h2>
        <p class="font-body font-medium text-lg text-gray-600">Jadwal kegiatan HMTI bulan ini</p>
    </div>

    <!-- Calendar Grid -->
    <div class="bg-white rounded-2xl shadow-lg p-5" id="calendar-widget">
        <?php
        // Get all events from both post types
        // Query Program Unggulan
        $program_unggulan_query = new WP_Query([
            'post_type' => 'program_unggulan',
            'posts_per_page' => -1,
            'meta_key' => '_program_unggulan_tanggal',
            'orderby' => 'meta_value',
            'order' => 'ASC'
        ]);

        // Query Acara Terbuka
        $acara_terbuka_query = new WP_Query([
            'post_type' => 'acara_terbuka',
            'posts_per_page' => -1,
            'meta_key' => '_acara_terbuka_tanggal',
            'orderby' => 'meta_value',
            'order' => 'ASC'
        ]);

        $all_events = [];

        // Add Program Unggulan events
        if ($program_unggulan_query->have_posts()) {
            while ($program_unggulan_query->have_posts()) {
                $program_unggulan_query->the_post();
                $tanggal = get_post_meta(get_the_ID(), '_program_unggulan_tanggal', true);
                if ($tanggal) {
                    $all_events[] = [
                        'date' => $tanggal,
                        'title' => get_the_title()
                    ];
                }
            }
            wp_reset_postdata();
        }

        // Add Acara Terbuka events
        if ($acara_terbuka_query->have_posts()) {
            while ($acara_terbuka_query->have_posts()) {
                $acara_terbuka_query->the_post();
                $tanggal = get_post_meta(get_the_ID(), '_acara_terbuka_tanggal', true);
                if ($tanggal) {
                    $all_events[] = [
                        'date' => $tanggal,
                        'title' => get_the_title()
                    ];
                }
            }
            wp_reset_postdata();
        }
        ?>

        <!-- Calendar Header -->
        <div class="flex justify-between items-center mb-6">
            <h3 class="font-title text-2xl font-bold text-dark-bg" id="calendar-month-year"></h3>
            <div class="flex gap-2">
                <button id="calendar-prev-btn"
                    class="px-4 py-2 bg-gray-100 hover:bg-gray-200 rounded-lg font-body font-medium transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                    </svg>
                </button>
                <button id="calendar-next-btn"
                    class="px-4 py-2 bg-gray-100 hover:bg-gray-200 rounded-lg font-body font-medium transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                    </svg>
                </button>
            </div>
        </div>

        <!-- Calendar Grid -->
        <div class="grid grid-cols-7 gap-2" id="calendar-grid">
            <!-- Day Headers -->
            <div class="text-center font-body font-bold text-gray-600 py-3">Minggu</div>
            <div class="text-center font-body font-bold text-gray-600 py-3">Senin</div>
            <div class="text-center font-body font-bold text-gray-600 py-3">Selasa</div>
            <div class="text-center font-body font-bold text-gray-600 py-3">Rabu</div>
            <div class="text-center font-body font-bold text-gray-600 py-3">Kamis</div>
            <div class="text-center font-body font-bold text-gray-600 py-3">Jumat</div>
            <div class="text-center font-body font-bold text-gray-600 py-3">Sabtu</div>
            <!-- Calendar cells will be generated by JavaScript -->
        </div>
    </div>

    <script>
        // Events data from PHP
        const calendarEvents = <?php echo json_encode($all_events); ?>;

        // Current month and year
        let currentMonth = new Date().getMonth(); // 0-11
        let currentYear = new Date().getFullYear();

        // Month names in Indonesian
        const monthNames = [
            'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni',
            'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'
        ];

        function renderCalendar() {
            const firstDay = new Date(currentYear, currentMonth, 1);
            const lastDay = new Date(currentYear, currentMonth + 1, 0);
            const daysInMonth = lastDay.getDate();
            const startingDayOfWeek = firstDay.getDay(); // 0 = Sunday

            // Update month/year display
            document.getElementById('calendar-month-year').textContent =
                monthNames[currentMonth] + ' ' + currentYear;

            // Get calendar grid (skip first 7 day headers)
            const grid = document.getElementById('calendar-grid');
            const dayHeaders = Array.from(grid.children).slice(0, 7);
            grid.innerHTML = '';
            dayHeaders.forEach(header => grid.appendChild(header));

            // Get today's date for comparison
            const today = new Date();
            const isCurrentMonth = (currentMonth === today.getMonth() && currentYear === today.getFullYear());
            const todayDate = today.getDate();

            // Get events for this month
            const monthEvents = {};
            calendarEvents.forEach(event => {
                const eventDate = new Date(event.date);
                if (eventDate.getMonth() === currentMonth && eventDate.getFullYear() === currentYear) {
                    const day = eventDate.getDate();
                    if (!monthEvents[day]) {
                        monthEvents[day] = [];
                    }
                    monthEvents[day].push(event.title);
                }
            });

            // Add empty cells before first day
            for (let i = 0; i < startingDayOfWeek; i++) {
                const emptyCell = document.createElement('div');
                emptyCell.className = 'p-2 bg-gray-50 rounded-lg min-h-24';
                grid.appendChild(emptyCell);
            }

            // Add days
            for (let day = 1; day <= daysInMonth; day++) {
                const isToday = (isCurrentMonth && day === todayDate);
                const hasEvent = monthEvents[day] && monthEvents[day].length > 0;

                const dayCell = document.createElement('div');
                dayCell.className = `p-2 rounded-lg ${isToday ? 'bg-primary text-white' : 'bg-gray-50'} ${hasEvent ? 'ring-2 ring-secondary' : ''} hover:bg-gray-100 transition-colors cursor-pointer min-h-24`;

                const dayNumber = document.createElement('div');
                dayNumber.className = `font-body font-bold ${isToday ? 'text-white' : 'text-gray-700'} mb-1`;
                dayNumber.textContent = day;
                dayCell.appendChild(dayNumber);

                if (hasEvent) {
                    monthEvents[day].forEach(title => {
                        const eventTitle = document.createElement('div');
                        eventTitle.className = `font-body text-sm font-medium ${isToday ? 'text-white' : 'text-gray-600'} mb-1 line-clamp-2 leading-tight`;
                        eventTitle.textContent = title;
                        dayCell.appendChild(eventTitle);
                    });
                }

                grid.appendChild(dayCell);
            }
        }

        // Navigation buttons
        document.getElementById('calendar-prev-btn').addEventListener('click', function () {
            currentMonth--;
            if (currentMonth < 0) {
                currentMonth = 11;
                currentYear--;
            }
            renderCalendar();
        });

        document.getElementById('calendar-next-btn').addEventListener('click', function () {
            currentMonth++;
            if (currentMonth > 11) {
                currentMonth = 0;
                currentYear++;
            }
            renderCalendar();
        });

        // Initial render
        renderCalendar();
    </script>
</section>

<!-- Program Kerja Unggulan Section -->
<section class="py-16 bg-dark-bg relative overflow-hidden">
    <!-- Decorative elements -->
    <div class="absolute top-[-50px] left-[-50px] w-[500px] h-[500px] opacity-20 pointer-events-none z-0"
        style="background-image: url('<?php echo get_template_directory_uri(); ?>/assets/images/elements/1.png'); background-size: contain; background-repeat: no-repeat;">
    </div>
    <div class="absolute bottom-[-50px] right-[-50px] w-[500px] h-[500px] opacity-20 pointer-events-none z-0 rotate-180"
        style="background-image: url('<?php echo get_template_directory_uri(); ?>/assets/images/elements/1.png'); background-size: contain; background-repeat: no-repeat;">
    </div>

    <div class="container mx-auto px-6 lg:px-24 relative z-10">
        <div class="mb-12">
            <h2 class="font-title text-4xl lg:text-5xl font-bold text-white mb-4">
                Program Kerja
                <span class="title-with-highlight">
                    <span class="highlight-text highlight"> Unggulan</span>
                    <span class="highlight-bar secondary"></span>
                </span>
            </h2>
            <p class="font-body font-medium text-lg text-gray-300">Program-program besar HMTI yang menjadi andalan</p>
        </div>

        <?php
        $featured_programs = new WP_Query([
            'post_type' => 'program_unggulan',
            'posts_per_page' => -1,
            'orderby' => 'date',
            'order' => 'DESC'
        ]);

        if ($featured_programs->have_posts()):
            $counter = 0;
            while ($featured_programs->have_posts()):
                $featured_programs->the_post();
                $counter++;
                $tanggal = get_post_meta(get_the_ID(), '_program_unggulan_tanggal', true);
                $lokasi = get_post_meta(get_the_ID(), '_program_unggulan_lokasi', true);

                // Determine status based on date
                $status = '';
                if ($tanggal) {
                    $event_date = strtotime($tanggal);
                    $today = strtotime(date('Y-m-d'));

                    if ($event_date == $today) {
                        $status = 'berlangsung';
                    } elseif ($event_date > $today) {
                        $status = 'mendatang';
                    } else {
                        $status = 'selesai';
                    }
                }

                // Alternate layout
                $reverse = $counter % 2 == 0;
                ?>
                <div
                    class="mb-12 bg-gray-800/50 backdrop-blur-sm rounded-2xl shadow-2xl overflow-hidden border border-gray-700/50">
                    <div class="grid lg:grid-cols-2 gap-0">
                        <div class="<?php echo $reverse ? 'lg:order-2' : ''; ?> relative h-64 lg:h-auto">
                            <?php if (has_post_thumbnail()): ?>
                                <?php the_post_thumbnail('large', ['class' => 'w-full h-full object-cover']); ?>
                            <?php else: ?>
                                <div
                                    class="w-full h-full bg-gradient-to-br from-primary to-secondary flex items-center justify-center">
                                    <svg class="w-24 h-24 text-white opacity-50" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                </div>
                            <?php endif; ?>
                            <?php if ($status == 'berlangsung'): ?>
                                <div
                                    class="absolute top-4 right-4 bg-green-500 text-white px-4 py-2 rounded-full font-body font-bold text-sm">
                                    Sedang Berlangsung
                                </div>
                            <?php elseif ($status == 'mendatang'): ?>
                                <div
                                    class="absolute top-4 right-4 bg-primary text-white px-4 py-2 rounded-full font-body font-bold text-sm">
                                    Akan Datang
                                </div>
                            <?php elseif ($status == 'selesai'): ?>
                                <div
                                    class="absolute top-4 right-4 bg-gray-500 text-white px-4 py-2 rounded-full font-body font-bold text-sm">
                                    Selesai
                                </div>
                            <?php endif; ?>
                        </div>
                        <div class="p-8 lg:p-12 flex flex-col justify-center">
                            <h3 class="font-title text-4xl lg:text-5xl font-bold text-white mb-4">
                                <?php the_title(); ?>
                            </h3>
                            <div class="flex flex-wrap gap-4 mb-6 text-gray-300 font-body font-medium">
                                <?php if ($tanggal): ?>
                                    <div class="flex items-center gap-2">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                        </svg>
                                        <span><?php echo date('d F Y', strtotime($tanggal)); ?></span>
                                    </div>
                                <?php endif; ?>
                                <?php if ($lokasi): ?>
                                    <div class="flex items-center gap-2">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                        </svg>
                                        <span><?php echo esc_html($lokasi); ?></span>
                                    </div>
                                <?php endif; ?>
                            </div>
                            <?php
                            $deskripsi = get_post_meta(get_the_ID(), '_program_unggulan_deskripsi', true);
                            if ($deskripsi):
                                ?>
                                <div class="font-body font-medium text-gray-300 mb-6 leading-relaxed">
                                    <?php echo esc_html($deskripsi); ?>
                                </div>
                            <?php endif; ?>
                            <?php
                            $categories = get_the_category();
                            if (!empty($categories)):
                                ?>
                                <div class="flex flex-wrap gap-2 mb-6">
                                    <?php foreach ($categories as $cat): ?>
                                        <span
                                            class="px-3 py-1 bg-primary/20 text-primary rounded-full text-sm font-body font-medium border border-primary/30">
                                            <?php echo esc_html($cat->name); ?>
                                        </span>
                                    <?php endforeach; ?>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
                <?php
            endwhile;
            wp_reset_postdata();
        else:
            ?>
            <div class="text-center py-12 bg-gray-800/50 backdrop-blur-sm rounded-2xl border border-gray-700/50">
                <p class="font-body font-medium text-gray-400">Belum ada program unggulan yang ditampilkan.</p>
            </div>
        <?php endif; ?>
    </div>
</section>

<!-- Pendaftaran Acara Section -->
<section class="py-16 px-6 lg:px-24 bg-white">
    <div class="mb-12">
        <h2 class="font-title text-4xl lg:text-5xl font-bold text-dark-bg mb-4">
            Acara
            <span class="title-with-highlight">
                <span class="highlight-text highlight"> Terbuka</span>
                <span class="highlight-bar primary"></span>
            </span>
        </h2>
        <p class="font-body font-medium text-lg text-gray-600">Daftar sekarang untuk mengikuti acara HMTI</p>
    </div>

    <?php
    $open_events = new WP_Query([
        'post_type' => 'acara_terbuka',
        'posts_per_page' => -1,
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

    if ($open_events->have_posts()):
        ?>
        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
            <?php
            while ($open_events->have_posts()):
                $open_events->the_post();
                $tanggal = get_post_meta(get_the_ID(), '_acara_terbuka_tanggal', true);
                $lokasi = get_post_meta(get_the_ID(), '_acara_terbuka_lokasi', true);
                $link_daftar = get_post_meta(get_the_ID(), '_acara_terbuka_link_daftar', true);

                // Determine status based on date
                $status = '';
                if ($tanggal) {
                    $event_date = strtotime($tanggal);
                    $today = strtotime(date('Y-m-d'));

                    if ($event_date == $today) {
                        $status = 'berlangsung';
                    } elseif ($event_date > $today) {
                        $status = 'mendatang';
                    } else {
                        $status = 'selesai';
                    }
                }
                ?>
                <div class="bg-white rounded-xl shadow-lg hover:shadow-2xl transition-all duration-300 overflow-hidden group">
                    <div class="relative h-48 overflow-hidden">
                        <?php if (has_post_thumbnail()): ?>
                            <?php the_post_thumbnail('medium', ['class' => 'w-full h-full object-cover group-hover:scale-110 transition-transform duration-500']); ?>
                        <?php else: ?>
                            <div class="w-full h-full bg-gradient-to-br from-primary to-secondary"></div>
                        <?php endif; ?>
                        <div class="absolute top-4 right-4">
                            <?php if ($status == 'berlangsung'): ?>
                                <span class="bg-green-500 text-white px-3 py-1 rounded-full text-xs font-body font-bold">
                                    Berlangsung
                                </span>
                            <?php else: ?>
                                <span class="bg-primary text-white px-3 py-1 rounded-full text-xs font-body font-bold">
                                    Akan Datang
                                </span>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="p-6">
                        <h3 class="font-title text-xl font-bold text-dark-bg mb-3 line-clamp-2">
                            <?php the_title(); ?>
                        </h3>
                        <?php if ($tanggal): ?>
                            <div class="flex items-center gap-2 text-gray-600 font-body font-medium text-sm mb-2">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                                <span><?php echo date('d F Y', strtotime($tanggal)); ?></span>
                            </div>
                        <?php endif; ?>
                        <?php if ($lokasi): ?>
                            <div class="flex items-center gap-2 text-gray-600 font-body font-medium text-sm mb-4">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                </svg>
                                <span class="line-clamp-1"><?php echo esc_html($lokasi); ?></span>
                            </div>
                        <?php endif; ?>
                        <?php
                        $deskripsi = get_post_meta(get_the_ID(), '_acara_terbuka_deskripsi', true);
                        if ($deskripsi):
                            ?>
                            <p class="font-body font-medium text-gray-600 text-sm mb-4 line-clamp-3">
                                <?php echo esc_html($deskripsi); ?>
                            </p>
                        <?php endif; ?>
                        <?php if ($link_daftar): ?>
                            <a href="<?php echo esc_url($link_daftar); ?>" target="_blank"
                                class="inline-flex items-center gap-2 bg-primary hover:bg-primary-dark text-white font-body font-bold px-6 py-3 rounded-full transition-colors duration-300 w-full justify-center">
                                <span>Daftar Sekarang</span>
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M13 7l5 5m0 0l-5 5m5-5H6" />
                                </svg>
                            </a>
                        <?php endif; ?>
                    </div>
                </div>
                <?php
            endwhile;
            wp_reset_postdata();
            ?>
        </div>
    <?php else: ?>
        <div class="text-center py-12 bg-gray-50 rounded-2xl">
            <svg class="w-16 h-16 text-gray-400 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
            </svg>
            <p class="font-body font-medium text-gray-500 text-lg">Belum ada acara yang dibuka untuk pendaftaran saat
                ini.</p>
            <p class="font-body font-medium text-gray-400 text-sm mt-2">Pantau terus untuk informasi acara mendatang!
            </p>
        </div>
    <?php endif; ?>
</section>

<?php get_footer(); ?>
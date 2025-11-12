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
<section class="py-12 sm:py-16 lg:py-20 px-4 sm:px-6 lg:px-24 bg-gradient-to-b from-gray-50 to-white"
    id="kalender-section">
    <!-- Section Header -->
    <div class="text-center mb-8 sm:mb-12 lg:mb-16">
        <h2 class="font-title text-3xl sm:text-4xl lg:text-5xl font-bold text-dark-bg mb-4">
            <span class="title-with-highlight">
                <span class="highlight-text highlight">Kalender</span>
                <span class="highlight-bar primary"></span>
            </span>
            Kegiatan HMTI
        </h2>
        <p class="font-body font-medium text-base sm:text-lg text-gray-600 max-w-2xl mx-auto">
            Pantau dan catat semua kegiatan HMTI yang akan datang
        </p>
    </div>

    <!-- Calendar Widget -->
    <div class="bg-white rounded-2xl sm:rounded-3xl shadow-xl p-4 sm:p-6 lg:p-8 border border-gray-100"
        id="calendar-widget">
        <?php
        // Get all events from all sources
        
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

        // Query Agenda Kalender
        $agenda_kalender_query = new WP_Query([
            'post_type' => 'agenda_kalender',
            'posts_per_page' => -1,
            'meta_key' => '_agenda_kalender_tanggal',
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

        // Add Agenda Kalender events
        if ($agenda_kalender_query->have_posts()) {
            while ($agenda_kalender_query->have_posts()) {
                $agenda_kalender_query->the_post();

                // Get multiple dates
                $tanggal_list = get_post_meta(get_the_ID(), '_agenda_kalender_tanggal_list', true);

                // Backward compatibility: check old single date field if list is empty
                if (empty($tanggal_list)) {
                    $tanggal = get_post_meta(get_the_ID(), '_agenda_kalender_tanggal', true);
                    if ($tanggal) {
                        $tanggal_list = [$tanggal];
                    }
                }

                // Add event for each date
                if (!empty($tanggal_list) && is_array($tanggal_list)) {
                    foreach ($tanggal_list as $tanggal) {
                        if ($tanggal) {
                            $all_events[] = [
                                'date' => $tanggal,
                                'title' => get_the_title()
                            ];
                        }
                    }
                }
            }
            wp_reset_postdata();
        }
        ?>

        <!-- Calendar Header -->
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-6 sm:mb-8">
            <h3 class="font-title text-xl sm:text-2xl lg:text-3xl font-bold text-dark-bg" id="calendar-month-year">
            </h3>
            <div class="flex gap-2 w-full sm:w-auto">
                <button id="calendar-prev-btn"
                    class="flex-1 sm:flex-none px-3 py-2 sm:px-4 sm:py-2 bg-gray-100 hover:bg-primary hover:text-white rounded-lg sm:rounded-xl font-body font-medium transition-all duration-300 transform hover:scale-105 shadow-sm hover:shadow-md">
                    <svg class="w-4 h-4 sm:w-5 sm:h-5 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                    </svg>
                </button>
                <button id="calendar-today-btn"
                    class="flex-1 sm:flex-none px-3 py-2 sm:px-4 sm:py-2 bg-primary text-white hover:bg-primary-dark rounded-lg sm:rounded-xl font-body font-semibold text-xs sm:text-sm transition-all duration-300 transform hover:scale-105 shadow-sm hover:shadow-md">
                    Hari Ini
                </button>
                <button id="calendar-next-btn"
                    class="flex-1 sm:flex-none px-3 py-2 sm:px-4 sm:py-2 bg-gray-100 hover:bg-primary hover:text-white rounded-lg sm:rounded-xl font-body font-medium transition-all duration-300 transform hover:scale-105 shadow-sm hover:shadow-md">
                    <svg class="w-4 h-4 sm:w-5 sm:h-5 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                    </svg>
                </button>
            </div>
        </div>

        <!-- Calendar Grid -->
        <div class="overflow-x-auto -mx-4 sm:mx-0">
            <div class="min-w-[640px] px-4 sm:px-0">
                <div class="grid grid-cols-7 gap-1 sm:gap-2 m-2" id="calendar-grid">
                    <!-- Day Headers -->
                    <div
                        class="text-center font-body font-bold text-gray-700 py-2 sm:py-3 text-xs sm:text-sm bg-gray-50 rounded-t-lg">
                        Min</div>
                    <div
                        class="text-center font-body font-bold text-gray-700 py-2 sm:py-3 text-xs sm:text-sm bg-gray-50 rounded-t-lg">
                        Sen</div>
                    <div
                        class="text-center font-body font-bold text-gray-700 py-2 sm:py-3 text-xs sm:text-sm bg-gray-50 rounded-t-lg">
                        Sel</div>
                    <div
                        class="text-center font-body font-bold text-gray-700 py-2 sm:py-3 text-xs sm:text-sm bg-gray-50 rounded-t-lg">
                        Rab</div>
                    <div
                        class="text-center font-body font-bold text-gray-700 py-2 sm:py-3 text-xs sm:text-sm bg-gray-50 rounded-t-lg">
                        Kam</div>
                    <div
                        class="text-center font-body font-bold text-gray-700 py-2 sm:py-3 text-xs sm:text-sm bg-gray-50 rounded-t-lg">
                        Jum</div>
                    <div
                        class="text-center font-body font-bold text-gray-700 py-2 sm:py-3 text-xs sm:text-sm bg-gray-50 rounded-t-lg">
                        Sab</div>
                    <!-- Calendar cells will be generated by JavaScript -->
                </div>
            </div>
        </div>

        <!-- Event Legend -->
        <div class="mt-6 sm:mt-8 pt-6 sm:pt-8 border-t border-gray-200">
            <div id="month-events-list" class="space-y-3">
                <!-- Events will be populated by JavaScript -->
            </div>
        </div>
    </div>

    <script>
        // Events data from PHP
        const calendarEvents = <?php echo json_encode($all_events); ?>;

        // Current month and year
        let currentMonth = new Date().getMonth();
        let currentYear = new Date().getFullYear();

        // Month names in Indonesian
        const monthNames = [
            'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni',
            'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'
        ];

        // Color palette for events
        const eventColors = [
            'bg-blue-500',
            'bg-green-500',
            'bg-yellow-500',
            'bg-red-500',
            'bg-purple-500',
            'bg-pink-500',
            'bg-indigo-500',
            'bg-orange-500',
            'bg-teal-500',
            'bg-cyan-500'
        ];

        // Map to store event colors
        const eventColorMap = new Map();

        // Function to get consistent color for an event
        function getEventColor(eventTitle) {
            if (!eventColorMap.has(eventTitle)) {
                // Use hash to get consistent color for same event
                let hash = 0;
                for (let i = 0; i < eventTitle.length; i++) {
                    hash = eventTitle.charCodeAt(i) + ((hash << 5) - hash);
                }
                const colorIndex = Math.abs(hash) % eventColors.length;
                eventColorMap.set(eventTitle, eventColors[colorIndex]);
            }
            return eventColorMap.get(eventTitle);
        }

        function renderCalendar() {
            const firstDay = new Date(currentYear, currentMonth, 1);
            const lastDay = new Date(currentYear, currentMonth + 1, 0);
            const daysInMonth = lastDay.getDate();
            const startingDayOfWeek = firstDay.getDay();

            // Update month/year display
            document.getElementById('calendar-month-year').textContent =
                monthNames[currentMonth] + ' ' + currentYear;

            // Get calendar grid (skip first 7 day headers)
            const grid = document.getElementById('calendar-grid');
            const dayHeaders = Array.from(grid.children).slice(0, 7);
            grid.innerHTML = '';
            dayHeaders.forEach(header => grid.appendChild(header));

            // Get today's date
            const today = new Date();
            const isCurrentMonth = (currentMonth === today.getMonth() && currentYear === today.getFullYear());
            const todayDate = today.getDate();

            // Get events for this month
            const monthEvents = {};
            const eventsWithDates = [];
            calendarEvents.forEach(event => {
                const eventDate = new Date(event.date);
                if (eventDate.getMonth() === currentMonth && eventDate.getFullYear() === currentYear) {
                    const day = eventDate.getDate();
                    if (!monthEvents[day]) {
                        monthEvents[day] = [];
                    }
                    monthEvents[day].push({
                        title: event.title,
                        color: getEventColor(event.title)
                    });
                    eventsWithDates.push({
                        day: day,
                        date: eventDate,
                        title: event.title,
                        color: getEventColor(event.title)
                    });
                }
            });

            // Sort events by date
            eventsWithDates.sort((a, b) => a.date - b.date);

            // Update month events list
            updateMonthEventsList(eventsWithDates);

            // Add empty cells before first day
            for (let i = 0; i < startingDayOfWeek; i++) {
                const emptyCell = document.createElement('div');
                emptyCell.className = 'p-2 sm:p-3 bg-gray-50 rounded-lg min-h-[80px] sm:min-h-[100px]';
                grid.appendChild(emptyCell);
            }

            // Add days
            for (let day = 1; day <= daysInMonth; day++) {
                const isToday = (isCurrentMonth && day === todayDate);
                const hasEvent = monthEvents[day] && monthEvents[day].length > 0;

                const dayCell = document.createElement('div');
                dayCell.className = `p-2 sm:p-3 rounded-lg ${isToday ? 'bg-primary text-white shadow-lg scale-105' : 'bg-white hover:bg-gray-50'} ${hasEvent ? 'ring-2 ring-secondary ring-offset-1' : 'border border-gray-200'} transition-all duration-300 cursor-pointer min-h-[80px] sm:min-h-[100px] flex flex-col`;

                const dayNumber = document.createElement('div');
                dayNumber.className = `font-body font-bold text-sm sm:text-base ${isToday ? 'text-white' : 'text-gray-700'} mb-1`;
                dayNumber.textContent = day;
                dayCell.appendChild(dayNumber);

                if (hasEvent) {
                    // Show dot indicator for events - use first event's color
                    const eventDot = document.createElement('div');
                    const dotColor = isToday ? 'bg-white' : monthEvents[day][0].color;
                    eventDot.className = `w-2 h-2 rounded-full ${dotColor} mt-1`;
                    dayCell.appendChild(eventDot);
                }

                grid.appendChild(dayCell);
            }
        }

        function updateMonthEventsList(eventsWithDates) {
            const listContainer = document.getElementById('month-events-list');

            if (eventsWithDates.length === 0) {
                listContainer.innerHTML = `
                    <p class="font-body text-gray-500 text-sm text-center py-4">Tidak ada kegiatan di bulan ini</p>
                `;
                return;
            }

            // Group events by title to combine multiple dates
            const groupedEvents = {};
            eventsWithDates.forEach(event => {
                if (!groupedEvents[event.title]) {
                    groupedEvents[event.title] = {
                        title: event.title,
                        color: event.color,
                        dates: []
                    };
                }
                groupedEvents[event.title].dates.push(event.day);
            });

            listContainer.innerHTML = '';

            // Sort grouped events by first date
            const sortedGroups = Object.values(groupedEvents).sort((a, b) => {
                return Math.min(...a.dates) - Math.min(...b.dates);
            });

            sortedGroups.forEach(group => {
                const eventItem = document.createElement('div');
                eventItem.className = 'flex items-start gap-2 font-body text-sm sm:text-base text-gray-700';

                // Date dot indicator with event color
                const dot = document.createElement('div');
                dot.className = `flex-shrink-0 w-2 h-2 rounded-full ${group.color} mt-1.5`;

                const eventText = document.createElement('p');
                eventText.className = 'flex-1';

                // Format dates
                let dateDisplay = '';
                if (group.dates.length === 1) {
                    // Single date
                    dateDisplay = `${group.dates[0]} ${monthNames[currentMonth]} ${currentYear}`;
                } else {
                    // Multiple dates - sort and display as comma-separated
                    const sortedDates = group.dates.sort((a, b) => a - b);
                    dateDisplay = `${sortedDates.join(', ')} ${monthNames[currentMonth]} ${currentYear}`;
                }

                eventText.innerHTML = `<span class="font-semibold">${dateDisplay}:</span> ${group.title}`;

                eventItem.appendChild(dot);
                eventItem.appendChild(eventText);
                listContainer.appendChild(eventItem);
            });
        }        // Navigation buttons
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

        // Today button
        const todayBtn = document.getElementById('calendar-today-btn');
        if (todayBtn) {
            todayBtn.addEventListener('click', function () {
                const today = new Date();
                currentMonth = today.getMonth();
                currentYear = today.getFullYear();
                renderCalendar();
            });
        }

        // Initial render
        renderCalendar();

        // Re-render on window resize to adjust event display
        let resizeTimeout;
        window.addEventListener('resize', function () {
            clearTimeout(resizeTimeout);
            resizeTimeout = setTimeout(renderCalendar, 250);
        });
    </script>
</section>

<!-- Program Kerja Unggulan Section -->
<section class="py-12 sm:py-16 lg:py-20 bg-dark-bg relative overflow-hidden">
    <!-- Decorative elements -->
    <div class="absolute top-[-50px] left-[-50px] w-[300px] h-[300px] sm:w-[500px] sm:h-[500px] opacity-10 pointer-events-none z-0"
        style="background-image: url('<?php echo get_template_directory_uri(); ?>/assets/images/elements/1.png'); background-size: contain; background-repeat: no-repeat;">
    </div>
    <div class="absolute bottom-[-50px] right-[-50px] w-[300px] h-[300px] sm:w-[500px] sm:h-[500px] opacity-10 pointer-events-none z-0 rotate-180"
        style="background-image: url('<?php echo get_template_directory_uri(); ?>/assets/images/elements/1.png'); background-size: contain; background-repeat: no-repeat;">
    </div>

    <div class="container mx-auto px-4 sm:px-6 lg:px-24 relative z-10">
        <!-- Section Header -->
        <div class="text-center mb-8 sm:mb-12 lg:mb-16">

            <h2 class="font-title text-3xl sm:text-4xl lg:text-5xl font-bold text-white mb-4">
                <span class="title-with-highlight">
                    <span class="highlight-text highlight">Program Kerja </span>
                    <span class="highlight-bar secondary"></span>
                </span>
                HMTI
            </h2>
            <p class="font-body font-medium text-base sm:text-lg text-gray-300 max-w-2xl mx-auto">
                Program-program strategis dan berdampak besar untuk kemajuan HMTI
            </p>
        </div>

        <?php
        $featured_programs = new WP_Query([
            'post_type' => 'program_unggulan',
            'posts_per_page' => -1,
            'orderby' => 'date',
            'order' => 'DESC'
        ]);

        if ($featured_programs->have_posts()):
            ?>
            <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-4 sm:gap-6 p-5" id="programs-container">
                <?php
                $program_counter = 0;
                while ($featured_programs->have_posts()):
                    $featured_programs->the_post();
                    $program_counter++;
                    $tanggal = get_post_meta(get_the_ID(), '_program_unggulan_tanggal', true);
                    $tanggal_selesai = get_post_meta(get_the_ID(), '_program_unggulan_tanggal_selesai', true);
                    $lokasi = get_post_meta(get_the_ID(), '_program_unggulan_lokasi', true);
                    $deskripsi = get_post_meta(get_the_ID(), '_program_unggulan_deskripsi', true);

                    // Determine status based on date range
                    $status = '';
                    if ($tanggal) {
                        $start_date = strtotime($tanggal);
                        $end_date = $tanggal_selesai ? strtotime($tanggal_selesai) : $start_date;
                        $today = strtotime(date('Y-m-d'));

                        if ($today >= $start_date && $today <= $end_date) {
                            $status = 'berlangsung';
                        } elseif ($today < $start_date) {
                            $status = 'mendatang';
                        } else {
                            $status = 'selesai';
                        }
                    }
                    ?>
                    <div class="program-card bg-gray-800/50 backdrop-blur-sm rounded-xl sm:rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-500 overflow-hidden group transform lg:hover:-translate-y-1 border border-gray-700/50"
                        data-program-id="<?php echo $program_counter; ?>">
                        <div class="relative w-full overflow-hidden" style="aspect-ratio: 16/9;">
                            <?php if (has_post_thumbnail()): ?>
                                <?php the_post_thumbnail('medium', ['class' => 'absolute inset-0 w-full h-full object-cover group-hover:scale-110 transition-transform duration-700']); ?>
                            <?php else: ?>
                                <div
                                    class="absolute inset-0 w-full h-full bg-gradient-to-br from-primary to-secondary flex items-center justify-center">
                                    <svg class="w-12 h-12 sm:w-16 sm:h-16 text-white opacity-50" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                </div>
                            <?php endif; ?>
                            <div class="absolute inset-0 bg-gradient-to-t from-black/50 via-transparent to-transparent"></div>

                            <!-- Status Badge - Only show if date exists -->
                            <?php if ($status): ?>
                                <div class="absolute top-3 right-3">
                                    <?php if ($status == 'berlangsung'): ?>
                                        <span
                                            class="bg-gradient-to-r from-green-500 to-green-600 text-white px-2 sm:px-3 py-1 rounded-full text-[10px] sm:text-xs font-body font-bold shadow-lg backdrop-blur-sm">
                                            Berlangsung
                                        </span>
                                    <?php elseif ($status == 'mendatang'): ?>
                                        <span
                                            class="bg-gradient-to-r from-primary to-blue-600 text-white px-2 sm:px-3 py-1 rounded-full text-[10px] sm:text-xs font-body font-bold shadow-lg backdrop-blur-sm">
                                            Akan Datang
                                        </span>
                                    <?php else: ?>
                                        <span
                                            class="bg-gradient-to-r from-gray-500 to-gray-600 text-white px-2 sm:px-3 py-1 rounded-full text-[10px] sm:text-xs font-body font-bold shadow-lg backdrop-blur-sm">
                                            Selesai
                                        </span>
                                    <?php endif; ?>
                                </div>
                            <?php endif; ?>

                            <!-- Category Badge -->
                            <?php
                            $categories = get_the_category();
                            if (!empty($categories)):
                                ?>
                                <div class="absolute top-3 left-3">
                                    <span
                                        class="bg-secondary text-dark-bg px-2 sm:px-3 py-1 rounded-full text-[10px] sm:text-xs font-body font-bold uppercase shadow-lg backdrop-blur-sm">
                                        <?php echo esc_html($categories[0]->name); ?>
                                    </span>
                                </div>
                            <?php endif; ?>
                        </div>

                        <div class="p-3 sm:p-4 lg:p-6">
                            <h3
                                class="font-title text-sm sm:text-lg lg:text-xl font-bold text-white mb-2 sm:mb-3 lg:mb-4 line-clamp-2 leading-tight min-h-[2.5rem] sm:min-h-[3.5rem]">
                                <?php the_title(); ?>
                            </h3>

                            <!-- Details Section - Hidden on mobile until expanded -->
                            <div class="program-details" data-program-details="<?php echo $program_counter; ?>">
                                <?php if ($tanggal || $lokasi): ?>
                                    <div class="space-y-2 mb-3 sm:mb-4">
                                        <?php if ($tanggal): ?>
                                            <div class="flex items-center gap-2 text-gray-300 font-body font-medium text-xs sm:text-sm">
                                                <svg class="w-4 h-4 flex-shrink-0 text-secondary" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                                </svg>
                                                <span class="truncate">
                                                    <?php
                                                    echo date('d F Y', strtotime($tanggal));
                                                    if ($tanggal_selesai && $tanggal_selesai != $tanggal) {
                                                        echo ' - ' . date('d F Y', strtotime($tanggal_selesai));
                                                    }
                                                    ?>
                                                </span>
                                            </div>
                                        <?php endif; ?>

                                        <?php if ($lokasi): ?>
                                            <div class="flex items-start gap-2 text-gray-300 font-body font-medium text-xs sm:text-sm">
                                                <svg class="w-4 h-4 flex-shrink-0 text-secondary mt-0.5" fill="none"
                                                    stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                                </svg>
                                                <span class="line-clamp-2"><?php echo esc_html($lokasi); ?></span>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                <?php endif; ?>

                                <?php if ($deskripsi): ?>
                                    <p
                                        class="font-body font-medium text-gray-300 text-xs sm:text-sm mb-3 sm:mb-4 lg:mb-5 line-clamp-3 leading-relaxed">
                                        <?php echo esc_html($deskripsi); ?>
                                    </p>
                                <?php endif; ?>

                                <?php
                                $categories = get_the_category();
                                if (!empty($categories)):
                                    ?>
                                    <div class="program-action-btn flex flex-wrap gap-2">
                                        <?php foreach ($categories as $cat): ?>
                                            <span
                                                class="px-3 py-1 bg-primary/20 text-secondary border border-primary/30 rounded-full text-xs font-body font-medium">
                                                <?php echo esc_html($cat->name); ?>
                                            </span>
                                        <?php endforeach; ?>
                                    </div>
                                <?php endif; ?>
                            </div>

                            <!-- Toggle Button - Only visible on mobile -->
                            <button
                                class="toggle-program-btn lg:hidden w-full inline-flex items-center justify-center gap-2 bg-gray-700/50 hover:bg-gray-600/50 text-white font-body font-semibold px-4 py-2 rounded-lg transition-all duration-300 text-xs sm:text-sm border border-gray-600/50"
                                data-toggle-program="<?php echo $program_counter; ?>"
                                onclick="toggleProgramDetails(<?php echo $program_counter; ?>)">
                                <span class="toggle-text">Lihat Detail</span>
                                <svg class="w-4 h-4 toggle-icon transition-transform duration-300" fill="none"
                                    stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                </svg>
                            </button>
                        </div>
                    </div>
                    <?php
                endwhile;
                wp_reset_postdata();
                ?>
            </div>
        <?php else: ?>
            <div
                class="text-center py-12 sm:py-16 lg:py-20 bg-gray-800/50 backdrop-blur-sm rounded-2xl sm:rounded-3xl border-2 border-dashed border-gray-600">
                <div class="max-w-md mx-auto px-4">
                    <div
                        class="w-16 h-16 sm:w-20 sm:h-20 bg-secondary/10 rounded-full flex items-center justify-center mx-auto mb-4 sm:mb-6">
                        <svg class="w-8 h-8 sm:w-10 sm:h-10 text-secondary" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                    </div>
                    <h3 class="font-title text-xl sm:text-2xl font-bold text-white mb-2 sm:mb-3">Belum Ada Program</h3>
                    <p class="font-body font-medium text-gray-300 text-sm sm:text-base mb-2">Belum ada program unggulan yang
                        ditampilkan.</p>
                    <p class="font-body text-gray-400 text-xs sm:text-sm">Pantau terus untuk informasi program mendatang!
                    </p>
                </div>
            </div>
        <?php endif; ?>
    </div>
</section>

<!-- Pendaftaran Acara Section -->
<section id="acara-terbuka"
    class="py-12 sm:py-16 lg:py-20 px-4 sm:px-6 lg:px-24 bg-gradient-to-b from-white to-gray-50">
    <div class="container mx-auto">
        <!-- Section Header -->
        <div class="text-center mb-8 sm:mb-12 lg:mb-16">

            <h2 class="font-title text-3xl sm:text-4xl lg:text-5xl font-bold text-dark-bg mb-4">
                <span class="title-with-highlight">
                    <span class="highlight-text highlight">Event </span>
                    <span class="highlight-bar primary"></span>
                </span>
                HMTI
            </h2>
            <p class="font-body font-medium text-base sm:text-lg text-gray-600 max-w-2xl mx-auto">
                Ikuti berbagai acara menarik yang diselenggarakan oleh HMTI
            </p>
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
            <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-4 sm:gap-6 p-5" id="events-container">
                <?php
                $event_counter = 0;
                while ($open_events->have_posts()):
                    $open_events->the_post();
                    $event_counter++;
                    $tanggal = get_post_meta(get_the_ID(), '_acara_terbuka_tanggal', true);
                    $tanggal_selesai = get_post_meta(get_the_ID(), '_acara_terbuka_tanggal_selesai', true);
                    $lokasi = get_post_meta(get_the_ID(), '_acara_terbuka_lokasi', true);
                    $kategori = get_post_meta(get_the_ID(), '_acara_terbuka_kategori', true);
                    $link = get_post_meta(get_the_ID(), '_acara_terbuka_link', true);
                    $is_pendaftaran = get_post_meta(get_the_ID(), '_acara_terbuka_is_pendaftaran', true);
                    $deskripsi = get_post_meta(get_the_ID(), '_acara_terbuka_deskripsi', true);

                    // Determine status based on date range
                    $status = '';
                    if ($tanggal) {
                        $start_date = strtotime($tanggal);
                        $end_date = $tanggal_selesai ? strtotime($tanggal_selesai) : $start_date;
                        $today = strtotime(date('Y-m-d'));

                        if ($today >= $start_date && $today <= $end_date) {
                            $status = 'berlangsung';
                        } elseif ($today < $start_date) {
                            $status = 'mendatang';
                        } else {
                            $status = 'selesai';
                        }
                    }
                    ?>
                    <div class="event-card bg-white rounded-xl sm:rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-500 overflow-hidden group transform lg:hover:-translate-y-1"
                        data-event-id="<?php echo $event_counter; ?>">
                        <div class="relative w-full overflow-hidden" style="aspect-ratio: 16/9;">
                            <?php if (has_post_thumbnail()): ?>
                                <?php the_post_thumbnail('medium', ['class' => 'absolute inset-0 w-full h-full object-cover group-hover:scale-110 transition-transform duration-700']); ?>
                            <?php else: ?>
                                <div
                                    class="absolute inset-0 w-full h-full bg-gradient-to-br from-primary to-secondary flex items-center justify-center">
                                    <svg class="w-12 h-12 sm:w-16 sm:h-16 text-white opacity-50" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z" />
                                    </svg>
                                </div>
                            <?php endif; ?>
                            <div class="absolute inset-0 bg-gradient-to-t from-black/50 via-transparent to-transparent"></div>

                            <!-- Status Badge - Only show if date exists -->
                            <?php if ($status): ?>
                                <div class="absolute top-3 right-3">
                                    <?php if ($status == 'berlangsung'): ?>
                                        <span
                                            class="bg-gradient-to-r from-green-500 to-green-600 text-white px-2 sm:px-3 py-1 rounded-full text-[10px] sm:text-xs font-body font-bold shadow-lg backdrop-blur-sm">
                                            Berlangsung
                                        </span>
                                    <?php else: ?>
                                        <span
                                            class="bg-gradient-to-r from-primary to-blue-600 text-white px-2 sm:px-3 py-1 rounded-full text-[10px] sm:text-xs font-body font-bold shadow-lg backdrop-blur-sm">
                                            Akan Datang
                                        </span>
                                    <?php endif; ?>
                                </div>
                            <?php endif; ?>

                            <!-- Kategori Badge -->
                            <?php if ($kategori): ?>
                                <div class="absolute top-3 left-3">
                                    <span
                                        class="bg-secondary text-dark-bg px-2 sm:px-3 py-1 rounded-full text-[10px] sm:text-xs font-body font-bold uppercase shadow-lg backdrop-blur-sm">
                                        <?php echo esc_html($kategori); ?>
                                    </span>
                                </div>
                            <?php endif; ?>
                        </div>

                        <div class="p-3 sm:p-4 lg:p-6">
                            <h3
                                class="font-title text-sm sm:text-lg lg:text-xl font-bold text-dark-bg mb-2 sm:mb-3 lg:mb-4 line-clamp-2 leading-tight min-h-[2.5rem] sm:min-h-[3.5rem]">
                                <?php the_title(); ?>
                            </h3>

                            <!-- Details Section - Hidden on mobile until expanded -->
                            <div class="event-details" data-event-details="<?php echo $event_counter; ?>">
                                <?php if ($tanggal || $lokasi): ?>
                                    <div class="space-y-2 mb-3 sm:mb-4">
                                        <?php if ($tanggal): ?>
                                            <div class="flex items-center gap-2 text-gray-600 font-body font-medium text-xs sm:text-sm">
                                                <svg class="w-4 h-4 flex-shrink-0 text-primary" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                                </svg>
                                                <span class="truncate">
                                                    <?php
                                                    echo date('d F Y', strtotime($tanggal));
                                                    if ($tanggal_selesai && $tanggal_selesai != $tanggal) {
                                                        echo ' - ' . date('d F Y', strtotime($tanggal_selesai));
                                                    }
                                                    ?>
                                                </span>
                                            </div>
                                        <?php endif; ?>

                                        <?php if ($lokasi): ?>
                                            <div class="flex items-start gap-2 text-gray-600 font-body font-medium text-xs sm:text-sm">
                                                <svg class="w-4 h-4 flex-shrink-0 text-primary mt-0.5" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                                </svg>
                                                <span class="line-clamp-2"><?php echo esc_html($lokasi); ?></span>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                <?php endif; ?>

                                <?php if ($deskripsi): ?>
                                    <p
                                        class="font-body font-medium text-gray-600 text-xs sm:text-sm mb-3 sm:mb-4 lg:mb-5 line-clamp-3 leading-relaxed">
                                        <?php echo esc_html($deskripsi); ?>
                                    </p>
                                <?php endif; ?>

                                <?php if ($link): ?>
                                    <a href="<?php echo esc_url($link); ?>" target="_blank"
                                        class="event-action-btn inline-flex items-center justify-center gap-2 bg-gradient-to-r from-primary to-blue-600 hover:from-primary-dark hover:to-blue-700 text-white font-body font-bold px-4 sm:px-5 lg:px-6 py-2 sm:py-2.5 lg:py-3 rounded-full transition-all duration-300 w-full shadow-lg hover:shadow-xl transform hover:scale-105 text-xs sm:text-sm lg:text-base">
                                        <span><?php echo $is_pendaftaran ? 'Daftar Sekarang' : 'Lihat Detail'; ?></span>
                                        <svg class="w-4 h-4 sm:w-5 sm:h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M13 7l5 5m0 0l-5 5m5-5H6" />
                                        </svg>
                                    </a>
                                <?php endif; ?>
                            </div>

                            <!-- Toggle Button - Only visible on mobile -->
                            <button
                                class="toggle-details-btn lg:hidden w-full inline-flex items-center justify-center gap-2 bg-gray-100 hover:bg-gray-200 text-dark-bg font-body font-semibold px-4 py-2 rounded-lg transition-all duration-300 text-xs sm:text-sm"
                                data-toggle-event="<?php echo $event_counter; ?>"
                                onclick="toggleEventDetails(<?php echo $event_counter; ?>)">
                                <span class="toggle-text">Lihat Detail</span>
                                <svg class="w-4 h-4 toggle-icon transition-transform duration-300" fill="none"
                                    stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                </svg>
                            </button>
                        </div>
                    </div>
                    <?php
                endwhile;
                wp_reset_postdata();
                ?>
            </div>
        <?php else: ?>
            <div
                class="text-center py-12 sm:py-16 lg:py-20 bg-gradient-to-br from-gray-50 to-white rounded-2xl sm:rounded-3xl border-2 border-dashed border-gray-300">
                <div class="max-w-md mx-auto px-4">
                    <div
                        class="w-16 h-16 sm:w-20 sm:h-20 bg-primary/10 rounded-full flex items-center justify-center mx-auto mb-4 sm:mb-6">
                        <svg class="w-8 h-8 sm:w-10 sm:h-10 text-primary" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                    </div>
                    <h3 class="font-title text-xl sm:text-2xl font-bold text-dark-bg mb-2 sm:mb-3">Belum Ada Acara</h3>
                    <p class="font-body font-medium text-gray-600 text-sm sm:text-base mb-2">Belum ada acara yang dibuka
                        untuk saat ini.</p>
                    <p class="font-body text-gray-500 text-xs sm:text-sm">Pantau terus untuk informasi acara mendatang!
                    </p>
                </div>
            </div>
        <?php endif; ?>
    </div>
</section>

<style>
    /* Program card responsive styles */
    @media (max-width: 1023px) {
        .program-card {
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .program-card.expanded {
            grid-column: 1 / -1;
            z-index: 10;
        }

        .program-details {
            max-height: 0;
            opacity: 0;
            overflow: hidden;
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .program-card.expanded .program-details {
            max-height: 1000px;
            opacity: 1;
            margin-bottom: 0.75rem;
        }

        .toggle-program-btn {
            display: flex;
        }

        .program-card.expanded .toggle-icon {
            transform: rotate(180deg);
        }

        .program-action-btn {
            display: none;
        }

        .program-card.expanded .program-action-btn {
            display: flex;
        }
    }

    @media (min-width: 1024px) {
        .program-details {
            max-height: none;
            opacity: 1;
            overflow: visible;
        }

        .toggle-program-btn {
            display: none !important;
        }

        .program-action-btn {
            display: flex;
        }
    }

    /* Event card responsive styles */
    @media (max-width: 1023px) {
        .event-card {
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .event-card.expanded {
            grid-column: 1 / -1;
            z-index: 10;
        }

        .event-details {
            max-height: 0;
            opacity: 0;
            overflow: hidden;
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .event-card.expanded .event-details {
            max-height: 1000px;
            opacity: 1;
            margin-bottom: 0.75rem;
        }

        .toggle-details-btn {
            display: flex;
        }

        .event-card.expanded .toggle-icon {
            transform: rotate(180deg);
        }

        .event-action-btn {
            display: none;
        }

        .event-card.expanded .event-action-btn {
            display: inline-flex;
        }
    }

    @media (min-width: 1024px) {
        .event-details {
            max-height: none;
            opacity: 1;
            overflow: visible;
        }

        .toggle-details-btn {
            display: none !important;
        }

        .event-action-btn {
            display: inline-flex;
        }
    }
</style>

<script>
    function toggleProgramDetails(programId) {
        const card = document.querySelector(`[data-program-id="${programId}"]`);
        const toggleBtn = card.querySelector(`[data-toggle-program="${programId}"]`);
        const toggleText = toggleBtn.querySelector('.toggle-text');
        const isExpanded = card.classList.contains('expanded');

        // Close all other expanded cards first (optional)
        if (!isExpanded) {
            const allCards = document.querySelectorAll('.program-card.expanded');
            allCards.forEach(otherCard => {
                if (otherCard !== card) {
                    otherCard.classList.remove('expanded');
                    const otherBtn = otherCard.querySelector('.toggle-program-btn');
                    const otherText = otherBtn.querySelector('.toggle-text');
                    otherText.textContent = 'Lihat Detail';
                }
            });
        }

        // Toggle current card
        card.classList.toggle('expanded');

        // Update button text
        if (card.classList.contains('expanded')) {
            toggleText.textContent = 'Sembunyikan';
        } else {
            toggleText.textContent = 'Lihat Detail';
        }
    }

    function toggleEventDetails(eventId) {
        const card = document.querySelector(`[data-event-id="${eventId}"]`);
        const toggleBtn = card.querySelector(`[data-toggle-event="${eventId}"]`);
        const toggleText = toggleBtn.querySelector('.toggle-text');
        const isExpanded = card.classList.contains('expanded');

        // Close all other expanded cards first (optional)
        if (!isExpanded) {
            const allCards = document.querySelectorAll('.event-card.expanded');
            allCards.forEach(otherCard => {
                if (otherCard !== card) {
                    otherCard.classList.remove('expanded');
                    const otherBtn = otherCard.querySelector('.toggle-details-btn');
                    const otherText = otherBtn.querySelector('.toggle-text');
                    otherText.textContent = 'Lihat Detail';
                }
            });
        }

        // Toggle current card
        card.classList.toggle('expanded');

        // Update button text
        if (card.classList.contains('expanded')) {
            toggleText.textContent = 'Sembunyikan';
        } else {
            toggleText.textContent = 'Lihat Detail';
        }
    }

    // Close expanded cards when window is resized to desktop size
    window.addEventListener('resize', function () {
        if (window.innerWidth >= 1024) {
            // Close program cards
            const expandedPrograms = document.querySelectorAll('.program-card.expanded');
            expandedPrograms.forEach(card => {
                card.classList.remove('expanded');
                const btn = card.querySelector('.toggle-program-btn');
                if (btn) {
                    const text = btn.querySelector('.toggle-text');
                    text.textContent = 'Lihat Detail';
                }
            });

            // Close event cards
            const expandedCards = document.querySelectorAll('.event-card.expanded');
            expandedCards.forEach(card => {
                card.classList.remove('expanded');
                const btn = card.querySelector('.toggle-details-btn');
                if (btn) {
                    const text = btn.querySelector('.toggle-text');
                    text.textContent = 'Lihat Detail';
                }
            });
        }
    });
</script>

<!-- Intersection Observer Animation Script -->
<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Add animation class to elements that should animate
        const animateElements = document.querySelectorAll('.program-card, .event-card, #calendar-widget');

        animateElements.forEach((el) => {
            el.style.opacity = '0';
            el.style.transform = 'translateY(30px)';
            el.style.transition = 'opacity 0.6s ease-out, transform 0.6s ease-out';
        });

        // Create intersection observer
        const observerOptions = {
            threshold: 0.1,
            rootMargin: '0px 0px -50px 0px'
        };

        const observer = new IntersectionObserver((entries) => {
            entries.forEach((entry) => {
                if (entry.isIntersecting) {
                    // Add delay based on index for staggered animation
                    const delay = entry.target.dataset.index ? parseInt(entry.target.dataset.index) * 100 : 0;

                    setTimeout(() => {
                        entry.target.style.opacity = '1';
                        entry.target.style.transform = 'translateY(0)';
                    }, delay);

                    observer.unobserve(entry.target);
                }
            });
        }, observerOptions);

        // Observe calendar widget
        const calendarWidget = document.getElementById('calendar-widget');
        if (calendarWidget) {
            observer.observe(calendarWidget);
        }

        // Observe program cards with staggered delay
        document.querySelectorAll('.program-card').forEach((el, index) => {
            el.dataset.index = index;
            observer.observe(el);
        });

        // Observe event cards with staggered delay
        document.querySelectorAll('.event-card').forEach((el, index) => {
            el.dataset.index = index;
            observer.observe(el);
        });

        // Observe section titles and headers
        const titles = document.querySelectorAll('.about-new-hero-headline, h2.font-title');
        titles.forEach((title, index) => {
            title.style.opacity = '0';
            title.style.transform = 'translateY(20px)';
            title.style.transition = 'opacity 0.6s ease-out, transform 0.6s ease-out';
            title.dataset.index = index;
            observer.observe(title);
        });

        // Re-animate cards when they're expanded on mobile (optional enhancement)
        const expandButtons = document.querySelectorAll('.toggle-program-btn, .toggle-details-btn');
        expandButtons.forEach(button => {
            button.addEventListener('click', function () {
                const card = this.closest('.program-card, .event-card');
                if (card && card.classList.contains('expanded')) {
                    // Add a subtle animation when expanding
                    card.style.transform = 'translateY(0) scale(1.02)';
                    setTimeout(() => {
                        card.style.transform = 'translateY(0) scale(1)';
                    }, 300);
                }
            });
        });
    });
</script>

<?php get_footer(); ?>
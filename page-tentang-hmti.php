<?php
/**
 * Template Name: Tentang HMTI
 * Description: Halaman khusus untuk Tentang HMTI
 */
get_header();
?>

<!-- Hero Section -->
<section class="about-new-hero-section">
    <div class="about-new-hero-container">
        <div class="about-new-hero-left">
            <h1 class="about-new-hero-headline">
                <span class="headline-text">The Story that</span>
            </h1>
            <h1 class="about-new-hero-headline">
                <span class="headline-text">
                    <span class="text-content">Built Us</span>
                    <span class="headline-highlighter"></span>
                </span>
            </h1>
        </div>
        <div class="about-new-hero-right">
            <!-- Empty as requested -->
        </div>
    </div>
</section>

<!-- Sejarah HMTI Section -->
<section class="sejarah-new-section">
    <div class="sejarah-new-container">
        <div class="sejarah-new-logo">
            <img src="<?php echo get_template_directory_uri(); ?>/assets/images/logo.png" alt="Logo HMTI">
        </div>
        <div class="sejarah-new-text">
            <p>Himpunan Mahasiswa Teknik Informatika (HMTI) Universitas Nusa Putra merupakan organisasi yang mewadahi
                para mahasiswa Teknik Informatika yang sadar akan hak dan kewajibannya sebagai unit kegiatan kampus yang
                berusaha memberikan darma bhaktinya untuk mewujudkan nilai-nilai keilmuan demi terwujudnya mahasiswa
                yang cerdas, adil dan berjiwa pemimpin.
            </p>

            <p>HMTI merupakan pecahan dari HIMTISI (Himpunan Mahasiswa Teknik Informatika dan Sistem Informasi) hingga
                pada akhirnya berpisah dengan SI dan terbentuklah HMTI pada tanggal 25 September 2013 oleh angkatan
                pertama mahasiswa Teknik Informatika.
            </p>


        </div>
    </div>
</section>

<!-- Visi & Misi Section -->
<section class="visimisi-new-section">
    <!-- Kabinet Section (dalam Visi & Misi) -->
    <div class="sejarah-new-container" style="padding-bottom: 80px;">
        <div class="sejarah-new-logo">
            <?php
            $kabinet_logo = get_theme_mod('kabinet_logo');
            if ($kabinet_logo): ?>
                <img src="<?php echo esc_url($kabinet_logo); ?>" alt="Logo Kabinet HMTI">
            <?php else: ?>
                <img src="<?php echo get_template_directory_uri(); ?>/assets/images/logo.png" alt="Logo Kabinet HMTI">
            <?php endif; ?>
        </div>
        <div class="sejarah-new-text">
            <h3 class="visimisi-new-label" style="margin-bottom: 30px;">
                <?php echo esc_html(get_theme_mod('kabinet_title', 'Kabinet')); ?>
            </h3>
            <div class="visimisi-new-right" style="padding: 0;">
                <p><?php echo nl2br(esc_html(get_theme_mod('kabinet_description', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.'))); ?>
                </p>
            </div>
        </div>
    </div>
    <div class="visimisi-new-container">

        <?php
        // Ambil data Visi & Misi dari Customizer
        $visi = get_theme_mod('visimisi_visi', 'Menjadi organisasi mahasiswa yang unggul, inovatif, dan berkarakter dalam mengembangkan potensi mahasiswa di bidang teknologi informasi.');
        $misi = get_theme_mod('visimisi_misi', "Meningkatkan kualitas akademik dan non-akademik mahasiswa\nMengembangkan jiwa kepemimpinan dan kewirausahaan\nMembangun networking dengan berbagai pihak\nMenciptakan program kerja yang bermanfaat");
        ?>

        <!-- Visi -->
        <?php if ($visi): ?>
            <div class="visimisi-new-item">
                <div class="visimisi-new-left">
                    <h3 class="visimisi-new-label">Visi</h3>
                </div>
                <div class="visimisi-new-right">
                    <p><?php echo nl2br(esc_html($visi)); ?></p>
                </div>
            </div>
        <?php endif; ?>

        <!-- Misi -->
        <?php if ($misi):
            // Split misi by newlines and filter empty lines
            $misi_lines = array_filter(array_map('trim', explode("\n", $misi)));

            if (!empty($misi_lines)):
                ?>
                <div class="visimisi-new-item">
                    <div class="visimisi-new-left">
                        <h3 class="visimisi-new-label">Misi</h3>
                    </div>
                    <div class="visimisi-new-right">
                        <ol class="visimisi-list">
                            <?php foreach ($misi_lines as $misi_item): ?>
                                <li><?php echo esc_html($misi_item); ?></li>
                            <?php endforeach; ?>
                        </ol>
                    </div>
                </div>
            <?php endif; ?>
        <?php endif; ?>

    </div>


</section>

<!-- Pengurus HMTI Section -->
<section class="py-16 px-6 lg:px-24 circuit-bg">
    <div class="text-center mb-12">
        <h2 class="font-title text-2xl sm:text-4xl lg:text-5xl font-bold text-dark-bg mb-4">
            <?php
            $pengurus_title = get_theme_mod('pengurus_title', 'Kepemimpinan dan Struktur Kami');
            // Split title untuk highlight kata terakhir
            $title_parts = explode(' ', $pengurus_title);
            $last_words = array_slice($title_parts, -2); // ambil 2 kata terakhir
            $first_words = array_slice($title_parts, 0, -2); // ambil sisanya
            
            if (!empty($first_words)) {
                echo implode(' ', $first_words) . ' ';
            }
            ?>
            <span class="title-with-highlight">
                <span class="highlight-text highlight"><?php echo implode(' ', $last_words); ?></span>
                <span class="highlight-bar primary"></span>
            </span>
        </h2>
        <p class="font-body font-medium text-base lg:text-lg text-gray-600 mb-8">
            <?php echo esc_html(get_theme_mod('pengurus_subtitle', 'Tim pengurus HMTI periode 2024/2025')); ?>
        </p>

        <?php
        // Get all unique divisi from database
        global $wpdb;
        $all_divisi = $wpdb->get_col("
                SELECT DISTINCT meta_value 
                FROM {$wpdb->postmeta} 
                WHERE meta_key = '_pengurus_divisi' 
                AND meta_value != '' 
                ORDER BY meta_value ASC
            ");

        // Determine default divisi (prioritize "Ketua & Wakil")
        $default_divisi = '';
        if (in_array('Ketua & Wakil', $all_divisi)) {
            $default_divisi = 'Ketua & Wakil';
        } elseif (!empty($all_divisi)) {
            $default_divisi = $all_divisi[0];
        }
        ?>

        <!-- Filter Dropdown -->
        <?php if (!empty($all_divisi)): ?>
            <div class="flex justify-center mb-8">
                <select id="divisi-filter"
                    class="px-6 py-3 bg-white border-2 border-gray-300 rounded-full font-body font-semibold text-dark-bg focus:outline-none focus:border-primary transition-colors cursor-pointer shadow-sm hover:shadow-md">
                    <?php foreach ($all_divisi as $divisi_option): ?>
                        <option value="<?php echo esc_attr($divisi_option); ?>" <?php echo ($divisi_option === $default_divisi) ? 'selected' : ''; ?>>
                            <?php echo esc_html($divisi_option); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
        <?php endif; ?>
    </div>

    <div class="flex flex-wrap justify-center p-2">
        <?php
        // Query untuk mengambil data pengurus dari Custom Post Type
        $pengurus_query = new WP_Query([
            'post_type' => 'pengurus',
            'posts_per_page' => -1,
            'meta_key' => '_pengurus_urutan',
            'orderby' => 'meta_value_num',
            'order' => 'ASC',
        ]);

        if ($pengurus_query->have_posts()):
            while ($pengurus_query->have_posts()):
                $pengurus_query->the_post();
                $jabatan = get_post_meta(get_the_ID(), '_pengurus_jabatan', true);
                $divisi = get_post_meta(get_the_ID(), '_pengurus_divisi', true);
                ?>
                <div class="pengurus-card group w-1/2 md:w-1/3 lg:w-1/4 xl:w-1/5 p-2"
                    data-divisi="<?php echo esc_attr($divisi); ?>"
                    style="<?php echo ($divisi !== $default_divisi) ? 'display: none;' : ''; ?>">
                    <div
                        class="relative overflow-hidden rounded-t-lg bg-gradient-to-br from-primary/10 to-secondary/10 aspect-[3/4]">
                        <?php if (has_post_thumbnail()): ?>
                            <?php the_post_thumbnail('medium', ['class' => 'w-full h-full object-cover group-hover:scale-105 transition-transform duration-500']); ?>
                        <?php else: ?>
                            <div class="w-full h-full flex items-center justify-center bg-gradient-to-br from-primary to-secondary">
                                <svg class="w-12 h-12 text-white opacity-50" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                </svg>
                            </div>
                        <?php endif; ?>
                    </div>
                    <div class="bg-white p-2 rounded-b-lg shadow-md">
                        <h4
                            class="pengurus-nama font-title font-bold text-dark-bg mb-1 overflow-hidden whitespace-nowrap text-ellipsis">
                            <?php the_title(); ?>
                        </h4>
                        <p
                            class="pengurus-jabatan font-body font-semibold text-primary leading-tight overflow-hidden whitespace-nowrap text-ellipsis">
                            <?php echo esc_html($jabatan); ?>
                        </p>
                    </div>
                </div>
                <?php
            endwhile;
            wp_reset_postdata();
        else:
            ?>
            <div class="col-span-full text-center py-12">
                <svg class="w-16 h-16 text-gray-300 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                </svg>
                <p class="font-body font-medium text-gray-500 text-lg">Belum ada data pengurus.</p>
                <p class="font-body font-medium text-gray-400 text-sm mt-2">Silakan tambahkan di menu Pengurus HMTI di
                    dashboard WordPress.</p>
            </div>
        <?php endif; ?>
    </div>
</section>

<script>
    // Filter pengurus berdasarkan divisi
    document.addEventListener('DOMContentLoaded', function () {
        const filterSelect = document.getElementById('divisi-filter');
        const pengurusCards = document.querySelectorAll('.pengurus-card');

        if (filterSelect) {
            filterSelect.addEventListener('change', function () {
                const selectedDivisi = this.value;

                pengurusCards.forEach(card => {
                    const cardDivisi = card.getAttribute('data-divisi');

                    if (cardDivisi === selectedDivisi) {
                        card.style.display = 'block';
                    } else {
                        card.style.display = 'none';
                    }
                });
            });
        }
    });

    // Add CSS animation
    const style = document.createElement('style');
    style.textContent = `
    .pengurus-card {
        transition: all 0.3s ease;
    }
    
    .pengurus-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px -5px rgba(0, 0, 0, 0.15);
    }
    
    /* Responsive font sizes based on card width */
    .pengurus-nama {
        font-size: 1.125rem; /* 18px default */
    }
    
    .pengurus-jabatan {
        font-size: 1rem; /* 16px default */
    }
    
    /* xl breakpoint: 5 cards (w-1/5) */
    @media (min-width: 1280px) {
        .pengurus-nama {
            font-size: 1rem; /* 16px */
        }
        .pengurus-jabatan {
            font-size: 0.875rem; /* 14px */
        }
    }
    
    /* lg breakpoint: 4 cards (w-1/4) */
    @media (min-width: 1024px) and (max-width: 1279px) {
        .pengurus-nama {
            font-size: 0.9375rem; /* 15px */
        }
        .pengurus-jabatan {
            font-size: 0.8125rem; /* 13px */
        }
    }
    
    /* md breakpoint: 3 cards (w-1/3) */
    @media (min-width: 768px) and (max-width: 1023px) {
        .pengurus-nama {
            font-size: 1rem; /* 16px */
        }
        .pengurus-jabatan {
            font-size: 0.875rem; /* 14px */
        }
    }
    
    /* mobile: 2 cards (w-1/2) */
    @media (max-width: 767px) {
        .pengurus-nama {
            font-size: 0.75rem; /* 12px */
        }
        .pengurus-jabatan {
            font-size: 0.625rem; /* 10px */
        }
    }
    
    /* very small mobile */
    @media (max-width: 480px) {
        .pengurus-nama {
            font-size: 0.625rem; /* 10px */
        }
        .pengurus-jabatan {
            font-size: 0.625rem; /* 10px */
        }
    }
        
    @media (max-width: 350px) {
        .pengurus-nama {
            font-size: 0.5625rem; /* 9px */
        }
        .pengurus-jabatan {
            font-size: 0.5625rem; /* 9px */
        }
    }
`;
    document.head.appendChild(style);
</script>

<!-- Intersection Observer Animation Script -->
<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Add animation class to elements that should animate
        const animateElements = document.querySelectorAll('.sejarah-new-container, .visimisi-new-item, .pengurus-card');

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

        // Observe sejarah section
        document.querySelectorAll('.sejarah-new-container').forEach((el, index) => {
            el.dataset.index = index;
            observer.observe(el);
        });

        // Observe visi misi items
        document.querySelectorAll('.visimisi-new-item').forEach((el, index) => {
            el.dataset.index = index;
            observer.observe(el);
        });

        // Observe pengurus cards with staggered delay
        const visiblePengurusCards = Array.from(document.querySelectorAll('.pengurus-card')).filter(
            card => card.style.display !== 'none'
        );

        visiblePengurusCards.forEach((el, index) => {
            el.dataset.index = index;
            observer.observe(el);
        });

        // Re-observe cards when divisi filter changes
        const filterSelect = document.getElementById('divisi-filter');
        if (filterSelect) {
            const originalChangeHandler = filterSelect.onchange;
            filterSelect.addEventListener('change', function () {
                // Reset all cards animation
                document.querySelectorAll('.pengurus-card').forEach((card) => {
                    card.style.opacity = '0';
                    card.style.transform = 'translateY(30px)';
                    observer.unobserve(card);
                });

                // After a short delay, observe visible cards again
                setTimeout(() => {
                    const newVisibleCards = Array.from(document.querySelectorAll('.pengurus-card')).filter(
                        card => card.style.display !== 'none'
                    );

                    newVisibleCards.forEach((el, index) => {
                        el.dataset.index = index;
                        observer.observe(el);
                    });
                }, 50);
            });
        }

        // Observe section titles
        const titles = document.querySelectorAll('.about-new-hero-headline, .visimisi-new-label');
        titles.forEach((title, index) => {
            title.style.opacity = '0';
            title.style.transform = 'translateY(20px)';
            title.style.transition = 'opacity 0.6s ease-out, transform 0.6s ease-out';
            title.dataset.index = index;
            observer.observe(title);
        });
    });
</script>

<?php get_footer(); ?>
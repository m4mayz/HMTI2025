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
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et
                dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip
                ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu
                fugiat nulla pariatur.</p>

            <p>Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est
                laborum. Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque
                laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae
                vitae dicta sunt explicabo.</p>


        </div>
    </div>
</section>

<!-- Visi & Misi Section -->
<section class="visimisi-new-section">
    <div class="visimisi-new-container">

        <?php
        // Query untuk mengambil data Visi & Misi dari Custom Post Type
        $visimisi_query = new WP_Query([
            'post_type' => 'visimisi',
            'posts_per_page' => 1,
        ]);

        if ($visimisi_query->have_posts()):
            while ($visimisi_query->have_posts()):
                $visimisi_query->the_post();
                $visi = get_post_meta(get_the_ID(), '_visimisi_visi', true);
                $misi = get_post_meta(get_the_ID(), '_visimisi_misi', true);
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

                <?php
            endwhile;
            wp_reset_postdata();
        else:
            ?>
            <p style="text-align: center; width: 100%; color: #999; padding: 40px 20px;">Belum ada data Visi & Misi. Silakan
                tambahkan di menu Visi & Misi di dashboard WordPress.</p>
        <?php endif; ?>

    </div>
</section>

<!-- Pengurus HMTI Section -->
<section class="py-16 px-6 lg:px-24 circuit-bg">
    <div class="container mx-auto">
        <div class="text-center mb-12">
            <h2 class="font-title text-4xl lg:text-5xl font-bold text-dark-bg mb-4">
                Kepemimpinan dan
                <span class="title-with-highlight">
                    <span class="highlight-text highlight">Struktur Kami</span>
                    <span class="highlight-bar primary"></span>
                </span>
            </h2>
            <p class="font-body font-medium text-lg text-gray-600 mb-8">Tim pengurus HMTI periode 2024/2025</p>

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

            // Determine default divisi (prioritize "Badan Pengurus Harian")
            $default_divisi = '';
            if (in_array('Badan Pengurus Harian', $all_divisi)) {
                $default_divisi = 'Badan Pengurus Harian';
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
                            class="relative overflow-hidden rounded-t-lg bg-gradient-to-br from-primary/10 to-secondary/10 aspect-square">
                            <?php if (has_post_thumbnail()): ?>
                                <?php the_post_thumbnail('medium', ['class' => 'w-full h-full object-cover group-hover:scale-105 transition-transform duration-500']); ?>
                            <?php else: ?>
                                <div
                                    class="w-full h-full flex items-center justify-center bg-gradient-to-br from-primary to-secondary">
                                    <svg class="w-12 h-12 text-white opacity-50" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                    </svg>
                                </div>
                            <?php endif; ?>
                        </div>
                        <div class="bg-white p-3 rounded-b-lg shadow-md">
                            <h4 class="font-title text-lg font-bold text-dark-bg mb-1 line-clamp-2">
                                <?php the_title(); ?>
                            </h4>
                            <p class="font-body font-semibold text-primary text-base leading-tight line-clamp-2">
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
`;
    document.head.appendChild(style);
</script>

<?php get_footer(); ?>
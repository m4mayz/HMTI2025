<?php
/**
 * Template Name: Halaman Divisi
 * Description: Template untuk menampilkan detail divisi HMTI
 */
get_header();

// Get divisi slug from URL
$divisi_slug = get_query_var('divisi_slug');
if (empty($divisi_slug)) {
    $divisi_slug = '1'; // Default ke divisi 1
}

// Find divisi number from slug
$divisi_number = 1;
for ($i = 1; $i <= 6; $i++) {
    $name = get_theme_mod("divisi_{$i}_name");
    if (sanitize_title($name) === $divisi_slug) {
        $divisi_number = $i;
        break;
    }
}

// Get divisi data
$divisi_name = get_theme_mod("divisi_{$divisi_number}_name", "Divisi");
$divisi_desc = get_theme_mod("divisi_{$divisi_number}_description", "");
$divisi_ketua = get_theme_mod("divisi_{$divisi_number}_ketua", "");
$divisi_photo = get_theme_mod("divisi_{$divisi_number}_photo", "");
$divisi_icon = get_theme_mod("divisi_{$divisi_number}_icon", "");

// Get anggota divisi (stored as comma-separated)
$anggota_list = get_theme_mod("divisi_{$divisi_number}_anggota", "");
$anggota_array = !empty($anggota_list) ? array_filter(array_map('trim', explode("\n", $anggota_list))) : [];

// Get program kerja (stored as comma-separated)
$proker_list = get_theme_mod("divisi_{$divisi_number}_proker", "");
$proker_array = !empty($proker_list) ? array_filter(array_map('trim', explode("\n", $proker_list))) : [];
?>

<!-- Hero Section -->
<section class="divisi-detail-hero">
    <div class="divisi-hero-content">
        <div class="divisi-icon-large">
            <?php if ($divisi_icon): ?>
                <img src="<?php echo esc_url($divisi_icon); ?>" alt="<?php echo esc_attr($divisi_name); ?>">
            <?php else: ?>
                <svg width="80" height="80" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <rect x="3" y="3" width="18" height="18" rx="2" stroke="currentColor" stroke-width="2" />
                    <path d="M9 9h6M9 12h6M9 15h4" stroke="currentColor" stroke-width="2" stroke-linecap="round" />
                </svg>
            <?php endif; ?>
        </div>
        <h1 class="divisi-hero-title"><?php echo esc_html($divisi_name); ?></h1>
        <?php if ($divisi_desc): ?>
            <p class="divisi-hero-subtitle"><?php echo esc_html($divisi_desc); ?></p>
        <?php endif; ?>
        <a href="<?php echo home_url('/tentang-hmti'); ?>" class="back-button">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M19 12H5M12 19l-7-7 7-7" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                    stroke-linejoin="round" />
            </svg>
            <span>Kembali ke Tentang HMTI</span>
        </a>
    </div>
</section>

<!-- Divider -->
<div class="section-divider"></div>

<!-- Kepala Divisi Section -->
<?php if ($divisi_ketua): ?>
    <section class="divisi-leader-section">
        <div class="divisi-leader-container">
            <h2 class="section-title-center">
                Kepala
                <span class="title-with-highlight">
                    <span class="highlight-text highlight"> Divisi</span>
                    <span class="highlight-bar primary"></span>
                </span>
            </h2>
            <div class="leader-card-wrapper">
                <div class="leader-card">
                    <?php if ($divisi_photo): ?>
                        <div class="leader-photo">
                            <img src="<?php echo esc_url($divisi_photo); ?>" alt="<?php echo esc_attr($divisi_ketua); ?>">
                        </div>
                    <?php endif; ?>
                    <h3 class="leader-name"><?php echo esc_html($divisi_ketua); ?></h3>
                    <p class="leader-position">Kepala <?php echo esc_html($divisi_name); ?></p>
                </div>
            </div>
        </div>
    </section>

    <!-- Divider -->
    <div class="section-divider"></div>
<?php endif; ?>

<!-- Anggota Divisi Section -->
<section class="divisi-members-section">
    <div class="divisi-members-container">
        <h2 class="section-title-center">
            Anggota
            <span class="title-with-highlight">
                <span class="highlight-text highlight"> Divisi</span>
                <span class="highlight-bar secondary"></span>
            </span>
        </h2>

        <?php if (!empty($anggota_array)): ?>
            <div class="members-grid">
                <?php foreach ($anggota_array as $anggota): ?>
                    <div class="member-card">
                        <div class="member-avatar">
                            <svg width="48" height="48" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <circle cx="12" cy="8" r="4" stroke="currentColor" stroke-width="2" />
                                <path d="M6 21v-2a4 4 0 0 1 4-4h4a4 4 0 0 1 4 4v2" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" />
                            </svg>
                        </div>
                        <h4 class="member-name"><?php echo esc_html($anggota); ?></h4>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php else: ?>
            <p class="no-data">Daftar anggota divisi belum tersedia.</p>
        <?php endif; ?>
    </div>
</section>

<!-- Divider -->
<div class="section-divider"></div>

<!-- Program Kerja Section -->
<section class="divisi-proker-section">
    <div class="divisi-proker-container">
        <h2 class="section-title-center">
            Program
            <span class="title-with-highlight">
                <span class="highlight-text highlight"> Kerja</span>
                <span class="highlight-bar primary"></span>
            </span>
        </h2>

        <?php if (!empty($proker_array)): ?>
            <div class="proker-list">
                <?php
                $counter = 1;
                foreach ($proker_array as $proker):
                    ?>
                    <div class="proker-item">
                        <div class="proker-number"><?php echo str_pad($counter, 2, '0', STR_PAD_LEFT); ?></div>
                        <div class="proker-content">
                            <h3 class="proker-title"><?php echo esc_html($proker); ?></h3>
                        </div>
                    </div>
                    <?php
                    $counter++;
                endforeach;
                ?>
            </div>
        <?php else: ?>
            <p class="no-data">Program kerja divisi belum tersedia.</p>
        <?php endif; ?>
    </div>
</section>

<!-- CTA Section -->
<section class="cta-section">
    <div class="cta-container">
        <div class="cta-content">
            <h2 class="cta-title">
                <span class="title-with-highlight">
                    <span class="highlight-text">Tertarik Bergabung?</span>
                    <span class="highlight-bar primary"></span>
                </span>
            </h2>
            <p class="cta-description">Hubungi kami untuk informasi lebih lanjut tentang HMTI dan divisi-divisinya.</p>
            <a href="<?php echo home_url('/kontak'); ?>" class="cta-button">
                <span>Hubungi Kami</span>
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M5 12H19M19 12L12 5M19 12L12 19" stroke="white" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round" />
                </svg>
            </a>
        </div>
    </div>
</section>

<?php get_footer(); ?>
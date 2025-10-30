<?php
/**
 * Template Name: Tentang HMTI
 * Description: Halaman khusus untuk Tentang HMTI
 */
get_header();
?>

<!-- Tentang Kami Section -->
<section class="tentang-kami-section">
    <div class="tentang-kami-container">
        <div class="tentang-kami-content">
            <!-- Logo HMTI -->
            <div class="tentang-logo">
                <img src="<?php echo get_template_directory_uri(); ?>/assets/images/logo.png" alt="Logo HMTI">
            </div>

            <!-- Konten Teks -->
            <div class="tentang-text">
                <h1 class="tentang-title">Tentang Kami</h1>
                <div class="tentang-description">
                    <?php echo wpautop(get_theme_mod('sejarah_hmti_text', 'Mangcoding adalah sebuah agen pengembangan web yang berbasis di Sukabumi, Jawa Barat, Indonesia. Kami membantu berbagai bisnis, baik besar maupun kecil, untuk tampil maksimal dengan menghadirkan aplikasi web kustom yang tepat. Kami mengutamakan mendengarkan kebutuhan klien terlebih dahulu, mendorong kreativitas, dan berkomitmen untuk menyelesaikan proyek-proyek yang mampu menarik perhatian.')); ?>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Divider -->
<div class="section-divider"></div>

<!-- Visi & Misi -->
<section class="visi-misi-section">
    <div class="visi-misi-container">
        <h2 class="visi-misi-section-title">Visi &<span class="highlight"> Misi</span></h2>
        <div class="visi-misi-grid">
            <!-- Visi -->
            <div class="visi-box">
                <div class="box-icon">
                    <svg width="64" height="64" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M12 4.5C7 4.5 2.73 7.61 1 12c1.73 4.39 6 7.5 11 7.5s9.27-3.11 11-7.5c-1.73-4.39-6-7.5-11-7.5zM12 17c-2.76 0-5-2.24-5-5s2.24-5 5-5 5 2.24 5 5-2.24 5-5 5zm0-8c-1.66 0-3 1.34-3 3s1.34 3 3 3 3-1.34 3-3-1.34-3-3-3z"
                            fill="currentColor" />
                    </svg>
                </div>
                <h3 class="box-title">Visi</h3>
                <div class="box-content">
                    <?php echo wpautop(get_theme_mod('visi_hmti', 'Menjadi organisasi kemahasiswaan yang unggul, inovatif, dan berdaya saing dalam bidang Teknik Informatika.')); ?>
                </div>
            </div>

            <!-- Misi -->
            <div class="misi-box">
                <div class="box-icon">
                    <svg width="64" height="64" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M9 16.2L4.8 12l-1.4 1.4L9 19 21 7l-1.4-1.4L9 16.2z" fill="currentColor" />
                    </svg>
                </div>
                <h3 class="box-title">Misi</h3>
                <div class="box-content">
                    <?php echo wpautop(get_theme_mod('misi_hmti', '1. Meningkatkan kualitas mahasiswa Teknik Informatika\n2. Mengembangkan potensi dan minat mahasiswa\n3. Membangun kerjasama dengan berbagai pihak\n4. Menyelenggarakan program kerja yang bermanfaat')); ?>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Divider -->
<div class="section-divider"></div>

<!-- Struktur Organisasi -->
<section class="struktur-section">
    <div class="struktur-container">
        <h2 class="struktur-section-title">Struktur<span class="highlight"> Organisasi</span></h2>
        <p class="struktur-subtitle">Kepengurusan HMTI Periode
            <?php echo esc_html(get_theme_mod('periode_kepengurusan', '2024-2025')); ?>
        </p>

        <!-- Pembina & Ketua -->
        <div class="top-structure">
            <?php if (get_theme_mod('struktur_pembina_name')): ?>
                <div class="struktur-card pembina-card">
                    <?php if (get_theme_mod('struktur_pembina_photo')): ?>
                        <div class="struktur-photo">
                            <img src="<?php echo esc_url(get_theme_mod('struktur_pembina_photo')); ?>"
                                alt="<?php echo esc_attr(get_theme_mod('struktur_pembina_name')); ?>">
                        </div>
                    <?php endif; ?>
                    <h4 class="struktur-jabatan">Pembina HMTI</h4>
                    <h3 class="struktur-name"><?php echo esc_html(get_theme_mod('struktur_pembina_name')); ?></h3>
                </div>
            <?php endif; ?>

            <?php if (get_theme_mod('struktur_ketua_name')): ?>
                <div class="struktur-card ketua-card">
                    <?php if (get_theme_mod('struktur_ketua_photo')): ?>
                        <div class="struktur-photo">
                            <img src="<?php echo esc_url(get_theme_mod('struktur_ketua_photo')); ?>"
                                alt="<?php echo esc_attr(get_theme_mod('struktur_ketua_name')); ?>">
                        </div>
                    <?php endif; ?>
                    <h4 class="struktur-jabatan">Ketua HMTI</h4>
                    <h3 class="struktur-name"><?php echo esc_html(get_theme_mod('struktur_ketua_name')); ?></h3>
                </div>
            <?php endif; ?>

            <?php if (get_theme_mod('struktur_wakil_name')): ?>
                <div class="struktur-card wakil-card">
                    <?php if (get_theme_mod('struktur_wakil_photo')): ?>
                        <div class="struktur-photo">
                            <img src="<?php echo esc_url(get_theme_mod('struktur_wakil_photo')); ?>"
                                alt="<?php echo esc_attr(get_theme_mod('struktur_wakil_name')); ?>">
                        </div>
                    <?php endif; ?>
                    <h4 class="struktur-jabatan">Wakil Ketua HMTI</h4>
                    <h3 class="struktur-name"><?php echo esc_html(get_theme_mod('struktur_wakil_name')); ?></h3>
                </div>
            <?php endif; ?>
        </div>

        <!-- Sekretaris & Bendahara -->
        <div class="middle-structure">
            <?php if (get_theme_mod('struktur_sekretaris_name')): ?>
                <div class="struktur-card">
                    <?php if (get_theme_mod('struktur_sekretaris_photo')): ?>
                        <div class="struktur-photo">
                            <img src="<?php echo esc_url(get_theme_mod('struktur_sekretaris_photo')); ?>"
                                alt="<?php echo esc_attr(get_theme_mod('struktur_sekretaris_name')); ?>">
                        </div>
                    <?php endif; ?>
                    <h4 class="struktur-jabatan">Sekretaris</h4>
                    <h3 class="struktur-name"><?php echo esc_html(get_theme_mod('struktur_sekretaris_name')); ?></h3>
                </div>
            <?php endif; ?>

            <?php if (get_theme_mod('struktur_bendahara_name')): ?>
                <div class="struktur-card">
                    <?php if (get_theme_mod('struktur_bendahara_photo')): ?>
                        <div class="struktur-photo">
                            <img src="<?php echo esc_url(get_theme_mod('struktur_bendahara_photo')); ?>"
                                alt="<?php echo esc_attr(get_theme_mod('struktur_bendahara_name')); ?>">
                        </div>
                    <?php endif; ?>
                    <h4 class="struktur-jabatan">Bendahara</h4>
                    <h3 class="struktur-name"><?php echo esc_html(get_theme_mod('struktur_bendahara_name')); ?></h3>
                </div>
            <?php endif; ?>
        </div>

        <!-- Kepala Divisi -->
        <div class="divisi-structure">
            <h3 class="divisi-header">Kepala Divisi</h3>
            <div class="divisi-grid">
                <?php
                // Loop untuk 6 divisi
                for ($i = 1; $i <= 6; $i++):
                    $divisi_name = get_theme_mod("divisi_{$i}_name");
                    $divisi_ketua = get_theme_mod("divisi_{$i}_ketua");
                    $divisi_photo = get_theme_mod("divisi_{$i}_photo");

                    if ($divisi_ketua):
                        ?>
                        <div class="struktur-card divisi-card">
                            <?php if ($divisi_photo): ?>
                                <div class="struktur-photo">
                                    <img src="<?php echo esc_url($divisi_photo); ?>" alt="<?php echo esc_attr($divisi_ketua); ?>">
                                </div>
                            <?php endif; ?>
                            <h4 class="struktur-jabatan"><?php echo esc_html($divisi_name ? $divisi_name : "Divisi $i"); ?></h4>
                            <h3 class="struktur-name"><?php echo esc_html($divisi_ketua); ?></h3>
                        </div>
                        <?php
                    endif;
                endfor;
                ?>
            </div>
        </div>
    </div>
</section>

<!-- Divider -->
<div class="section-divider"></div>

<!-- Divisi / Departemen -->
<section class="departemen-section">
    <div class="departemen-container">
        <h2 class="departemen-section-title">Divisi &<span class="highlight"> Departemen</span></h2>

        <div class="departemen-grid">
            <?php
            // Loop untuk 6 divisi
            for ($i = 1; $i <= 6; $i++):
                $divisi_name = get_theme_mod("divisi_{$i}_name");
                $divisi_desc = get_theme_mod("divisi_{$i}_description");
                $divisi_icon = get_theme_mod("divisi_{$i}_icon");

                if ($divisi_name):
                    ?>
                    <div class="departemen-card">
                        <div class="departemen-icon">
                            <?php if ($divisi_icon): ?>
                                <img src="<?php echo esc_url($divisi_icon); ?>" alt="<?php echo esc_attr($divisi_name); ?>">
                            <?php else: ?>
                                <svg width="64" height="64" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <rect x="3" y="3" width="18" height="18" rx="2" stroke="currentColor" stroke-width="2" />
                                    <path d="M9 9h6M9 12h6M9 15h4" stroke="currentColor" stroke-width="2" stroke-linecap="round" />
                                </svg>
                            <?php endif; ?>
                        </div>
                        <h3 class="departemen-name"><?php echo esc_html($divisi_name); ?></h3>
                        <p class="departemen-description">
                            <?php echo esc_html($divisi_desc ? $divisi_desc : 'Deskripsi divisi belum diisi.'); ?>
                        </p>
                        <a href="<?php echo home_url('/divisi/' . sanitize_title($divisi_name)); ?>" class="departemen-link">
                            <span>Lihat Detail</span>
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M5 12h14M12 5l7 7-7 7" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round" />
                            </svg>
                        </a>
                    </div>
                    <?php
                endif;
            endfor;
            ?>
        </div>
    </div>
</section>

<?php get_footer(); ?>
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
                <span class="headline-text">The story that</span>
            </h1>
            <h1 class="about-new-hero-headline">
                <span class="headline-text">
                    <span class="text-content">built us</span>
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
            <p>Himpunan Mahasiswa Teknik Informatika (HMTI) Universitas Nusa Putra merupakan organisasi kemahasiswaan
                resmi yang mewadahi seluruh mahasiswa Program Studi Teknik Informatika. Didirikan dengan tujuan untuk
                mengembangkan potensi mahasiswa baik dalam bidang akademik maupun non-akademik.</p>

            <p>Sejak awal berdirinya, HMTI telah berkomitmen untuk menciptakan lingkungan yang kondusif bagi mahasiswa
                dalam mengembangkan kemampuan teknis, soft skills, dan jiwa kepemimpinan. Melalui berbagai program kerja
                dan kegiatan, HMTI terus berinovasi untuk memberikan manfaat terbaik bagi seluruh anggotanya.</p>

            <p>Dengan semangat kebersamaan dan kolaborasi, HMTI tidak hanya fokus pada pengembangan internal organisasi,
                tetapi juga aktif dalam membangun jaringan dengan berbagai pihak eksternal, baik industri, akademisi,
                maupun komunitas teknologi lainnya. Hal ini bertujuan untuk memberikan exposure yang lebih luas kepada
                mahasiswa Teknik Informatika dalam menghadapi dunia kerja dan perkembangan teknologi yang dinamis.</p>
        </div>
    </div>
</section>

<!-- Visi & Misi Section -->
<section class="visimisi-new-section">
    <div class="visimisi-new-container">

        <!-- Visi -->
        <div class="visimisi-new-item">
            <div class="visimisi-new-left">
                <h3 class="visimisi-new-label">Visi</h3>
            </div>
            <div class="visimisi-new-right">
                <p>Menjadi organisasi kemahasiswaan yang unggul, inovatif, dan berdaya saing tinggi dalam bidang Teknik
                    Informatika. Kami berkomitmen untuk menciptakan lingkungan yang mendorong pengembangan potensi
                    mahasiswa secara optimal, baik dalam aspek akademik, profesional, maupun sosial, sehingga mampu
                    menghasilkan lulusan yang kompeten dan siap berkontribusi dalam era digital.</p>
            </div>
        </div>

        <!-- Misi -->
        <div class="visimisi-new-item">
            <div class="visimisi-new-left">
                <h3 class="visimisi-new-label">Misi</h3>
            </div>
            <div class="visimisi-new-right">
                <ol class="visimisi-list">
                    <li>Menyelenggarakan program kerja yang berkualitas dan berkelanjutan untuk meningkatkan kompetensi
                        mahasiswa Teknik Informatika.</li>
                    <li>Membangun ekosistem pembelajaran yang kolaboratif dan inovatif melalui berbagai kegiatan
                        akademik, pelatihan, seminar, dan workshop.</li>
                    <li>Mengembangkan jaringan kerjasama dengan industri, institusi pendidikan, dan komunitas teknologi
                        untuk memberikan peluang pengembangan karir.</li>
                    <li>Memfasilitasi mahasiswa dalam mengembangkan soft skills, leadership, dan entrepreneurship untuk
                        persiapan masa depan yang lebih baik.</li>
                </ol>
            </div>
        </div>

    </div>
</section>

<!-- Pengurus HMTI Section -->
<section class="pengurus-section">
    <div class="pengurus-container">
        <h2 class="pengurus-section-title">Pengurus HMTI Periode 2025/2026</h2>

        <div class="pengurus-grid">
            <?php
            // Contoh data pengurus - nanti bisa diganti dengan dynamic data
            $pengurus_list = array(
                array('nama' => 'Nama Pengurus 1', 'jabatan' => 'Ketua Umum', 'foto' => get_template_directory_uri() . '/assets/images/logo.png'),
                array('nama' => 'Nama Pengurus 2', 'jabatan' => 'Wakil Ketua', 'foto' => get_template_directory_uri() . '/assets/images/logo.png'),
                array('nama' => 'Nama Pengurus 3', 'jabatan' => 'Sekretaris', 'foto' => get_template_directory_uri() . '/assets/images/logo.png'),
                array('nama' => 'Nama Pengurus 4', 'jabatan' => 'Bendahara', 'foto' => get_template_directory_uri() . '/assets/images/logo.png'),
                array('nama' => 'Nama Pengurus 5', 'jabatan' => 'Divisi Humas', 'foto' => get_template_directory_uri() . '/assets/images/logo.png'),
                array('nama' => 'Nama Pengurus 6', 'jabatan' => 'Divisi Acara', 'foto' => get_template_directory_uri() . '/assets/images/logo.png'),
                array('nama' => 'Nama Pengurus 7', 'jabatan' => 'Divisi Media', 'foto' => get_template_directory_uri() . '/assets/images/logo.png'),
                array('nama' => 'Nama Pengurus 8', 'jabatan' => 'Divisi Kreatif', 'foto' => get_template_directory_uri() . '/assets/images/logo.png'),
                // Tambahkan lebih banyak data sesuai kebutuhan (max 70)
            );

            foreach ($pengurus_list as $pengurus):
                ?>
                <div class="pengurus-cell">
                    <div class="pengurus-photo">
                        <img src="<?php echo esc_url($pengurus['foto']); ?>"
                            alt="<?php echo esc_attr($pengurus['nama']); ?>">
                    </div>
                    <div class="pengurus-info">
                        <h4 class="pengurus-nama"><?php echo esc_html($pengurus['nama']); ?></h4>
                        <p class="pengurus-jabatan"><?php echo esc_html($pengurus['jabatan']); ?></p>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<?php get_footer(); ?>
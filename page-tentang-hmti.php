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
<section class="pengurus-section">
    <div class="pengurus-container">
        <h2 class="pengurus-section-title">
            Kepemimpinan dan<br>
            <span class="title-with-highlight">
                <span class="highlight-text highlight">Struktur Kami</span>
                <span class="highlight-bar primary"></span>
            </span>
        </h2>

        <div class="pengurus-grid">
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
                    ?>
                    <div class="pengurus-cell">
                        <div class="pengurus-photo">
                            <?php if (has_post_thumbnail()): ?>
                                <?php the_post_thumbnail('medium'); ?>
                            <?php else: ?>
                                <img src="<?php echo get_template_directory_uri(); ?>/assets/images/logo.png"
                                    alt="<?php the_title(); ?>">
                            <?php endif; ?>
                        </div>
                        <div class="pengurus-info">
                            <h4 class="pengurus-nama"><?php the_title(); ?></h4>
                            <p class="pengurus-jabatan"><?php echo esc_html($jabatan); ?></p>
                        </div>
                    </div>
                    <?php
                endwhile;
                wp_reset_postdata();
            else:
                ?>
                <p style="text-align: center; width: 100%; color: #999;">Belum ada data pengurus. Silakan tambahkan di menu
                    Pengurus HMTI di dashboard WordPress.</p>
            <?php endif; ?>
        </div>
    </div>
</section>

<?php get_footer(); ?>
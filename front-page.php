<?php get_header(); ?>

<?php $hero_bg = get_theme_mod('hero_background_image'); ?>
<section class="hero-bg" style="<?php if ($hero_bg)
    echo 'background-image: url(' . esc_url($hero_bg) . ');'; ?>">
    <section class="hero-section">
        <div class=" hero-content-left">
            <p>Himpunan Mahasiswa Teknik Informatika (HMTI) Universitas Nusa Putra merupakan organisasi kemahasiswaan
                resmi yang mewadahi seluruh mahasiswa Program Studi Teknik Informatika.</p>
            <hr class="separator">
            <a href="<?php echo home_url('/tentang-hmti'); ?>" class="view-more-button">
                <span>Lihat Selengkapnya</span>
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <circle cx="12" cy="12" r="12" fill="#3498DB" />
                    <path d="M10.5 16.5L15 12L10.5 7.5" stroke="white" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round" />
                </svg>
            </a>
        </div>
        <div class="hero-content-right">
            <h1 class="hero-headline">
                <span class="headline-text">Together</span>

            </h1>
            <h1 class="hero-headline">
                <span class="headline-text">be Better!</span>
                <span class="headline-highlighter"></span>
            </h1>
        </div>
    </section>
</section>

<?php
// Di sini Anda bisa menambahkan section lain untuk berita terbaru, dll.
?>

<?php get_footer(); ?>
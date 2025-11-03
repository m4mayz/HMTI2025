<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php wp_head(); // Hook penting, jangan dihapus ?>
</head>

<body <?php body_class(); ?>>
    <header class="site-header">
        <div class="container">
            <div class="logo">
                <a href="<?php echo home_url('/'); ?>">
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/images/logo.png" alt="Logo HMTI">
                    <span class="logo-text">HMTI Universitas Nusa Putra</span>
                </a>
            </div>

            <button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false" aria-label="Toggle Menu">
                <span class="line"></span>
                <span class="line"></span>
                <span class="line"></span>
            </button>

            <nav class="main-navigation">
                <ul>
                    <li class="<?php if (is_front_page())
                        echo 'active-menu'; ?>">
                        <a href="<?php echo home_url('/'); ?>">Beranda</a>
                    </li>
                    <li class="<?php if (is_page('tentang-hmti'))
                        echo 'active-menu'; ?>">
                        <a href="<?php echo home_url('/tentang-hmti'); ?>">Tentang HMTI</a>
                    </li>
                    <li class="<?php if (is_home() || is_single() || is_archive())
                        echo 'active-menu'; ?>">
                        <a href="<?php echo home_url('/berita-publikasi'); ?>">Berita & Publikasi</a>
                    </li>
                    <li class="<?php if (is_page('program-kegiatan'))
                        echo 'active-menu'; ?>">
                        <a href="<?php echo home_url('/program-kegiatan'); ?>">Program & Kegiatan</a>
                    </li>
                    <li class="<?php if (is_page('galeri'))
                        echo 'active-menu'; ?>">
                        <a href="<?php echo home_url('/galeri'); ?>">Galeri</a>
                    </li>
                    <li class="<?php if (is_page('arsip'))
                        echo 'active-menu'; ?>">
                        <a href="<?php echo home_url('/arsip'); ?>">Arsip & Unduhan</a>
                    </li>
                    <li class="<?php if (is_page('kontak'))
                        echo 'active-menu'; ?>">
                        <a href="<?php echo home_url('/kontak'); ?>">Kontak</a>
                    </li>
                </ul>
            </nav>
        </div>
    </header>

    <main class="site-content">
        <div class="container">
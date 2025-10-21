<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php wp_title('|', true, 'right'); ?></title>
    <?php wp_head(); // Hook penting, jangan dihapus ?>
</head>

<body <?php body_class(); ?>>
    <header class="site-header">
        <div class="container">
            <div class="logo">
                <a href="<?php echo home_url('/'); ?>">
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/images/logo.png" alt="Logo HMTI">
                </a>
            </div>

            <button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false">
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
                        <a href="<?php echo home_url('/berita-artikel'); ?>">Berita & Artikel</a>
                    </li>
                    <li class="<?php if (is_page('dokumentasi'))
                        echo 'active-menu'; ?>">
                        <a href="<?php echo home_url('/dokumentasi'); ?>">Dokumentasi / Galeri</a>
                    </li>
                </ul>
            </nav>
        </div>
    </header>

    <main class="site-content">
        <div class="container">
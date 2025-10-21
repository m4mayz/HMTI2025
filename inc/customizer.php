<?php
function hmti_customize_register($wp_customize)
{

    $wp_customize->add_panel('hmti_homepage_panel', [
        'title' => 'Pengaturan Halaman Depan',
        'priority' => 10,
    ]);

    // 1. Hero Section
    $wp_customize->add_section('hmti_hero_section', [
        'title' => 'Hero Section',
        'panel' => 'hmti_homepage_panel',
    ]);
    $wp_customize->add_setting('hero_background_image');
    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'hero_background_image', [
        'label' => 'Gambar Background Hero',
        'section' => 'hmti_hero_section',
    ]));
    $wp_customize->add_setting('hero_subheadline', ['default' => 'Menjadi pusat informasi yang inovatif dan inspiratif...']);
    $wp_customize->add_control('hero_subheadline', [
        'label' => 'Teks Sub-headline (Kiri)',
        'section' => 'hmti_hero_section',
        'type' => 'textarea',
    ]);

    // 2. About Snippet
    $wp_customize->add_section('hmti_about_section', [
        'title' => 'Sekilas Tentang HIMA TI',
        'panel' => 'hmti_homepage_panel',
    ]);
    $wp_customize->add_setting('about_text', ['default' => 'Paragraf singkat yang menjelaskan siapa HIMA TI...']);
    $wp_customize->add_control('about_text', [
        'label' => 'Teks Singkat',
        'section' => 'hmti_about_section',
        'type' => 'textarea',
    ]);
    $wp_customize->add_setting('about_link', ['default' => '/tentang-hmti']);
    $wp_customize->add_control('about_link', [
        'label' => 'Link Tombol (contoh: /tentang-hmti)',
        'section' => 'hmti_about_section',
        'type' => 'text',
    ]);

    // 3. Upcoming Events (3 Cards)
    $wp_customize->add_section('hmti_events_section', [
        'title' => 'Upcoming Events',
        'panel' => 'hmti_homepage_panel',
    ]);
    for ($i = 1; $i <= 3; $i++) {
        $wp_customize->add_setting("event_{$i}_image");
        $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, "event_{$i}_image", [
            'label' => "Gambar Acara {$i}",
            'section' => 'hmti_events_section',
        ]));
        $wp_customize->add_setting("event_{$i}_title", ['default' => "Judul Acara {$i}"]);
        $wp_customize->add_control("event_{$i}_title", [
            'label' => "Judul Acara {$i}",
            'section' => 'hmti_events_section',
            'type' => 'text',
        ]);
        $wp_customize->add_setting("event_{$i}_link", ['default' => '#']);
        $wp_customize->add_control("event_{$i}_link", [
            'label' => "Link Acara {$i}",
            'section' => 'hmti_events_section',
            'type' => 'text',
        ]);
    }

    // 4. Gallery Snippet
    $wp_customize->add_section('hmti_gallery_section', [
        'title' => 'Galeri Singkat',
        'panel' => 'hmti_homepage_panel',
    ]);
    for ($i = 1; $i <= 4; $i++) {
        $wp_customize->add_setting("gallery_{$i}_image");
        $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, "gallery_{$i}_image", [
            'label' => "Gambar Galeri {$i}",
            'section' => 'hmti_gallery_section',
        ]));
    }
}
add_action('customize_register', 'hmti_customize_register');
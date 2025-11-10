<?php
function hmti_customize_register($wp_customize)
{

    $wp_customize->add_panel('hmti_homepage_panel', [
        'title' => 'Pengaturan HMTI',
        'priority' => 10,
    ]);

    // 1. Hero Section
    $wp_customize->add_section('hmti_hero_section', [
        'title' => 'Gambar (Beranda)',
        'panel' => 'hmti_homepage_panel',
    ]);
    $wp_customize->add_setting('hero_background_image');
    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'hero_background_image', [
        'label' => 'Latar Belakang',
        'section' => 'hmti_hero_section',
    ]));

    // 2. Greeting Section - Ketua HMTI
    $wp_customize->add_section('hmti_greeting_section', [
        'title' => 'Sambutan (Beranda)',
        'panel' => 'hmti_homepage_panel',
    ]);

    // Ketua HMTI - Foto
    $wp_customize->add_setting('greeting_ketua_photo');
    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'greeting_ketua_photo', [
        'label' => 'Foto Ketua HMTI',
        'section' => 'hmti_greeting_section',
    ]));

    // Ketua HMTI - Nama
    $wp_customize->add_setting('greeting_ketua_name', [
        'default' => 'Nama Ketua HMTI',
    ]);
    $wp_customize->add_control('greeting_ketua_name', [
        'label' => 'Nama Ketua HMTI',
        'section' => 'hmti_greeting_section',
        'type' => 'text',
    ]);

    // Ketua HMTI - Jabatan
    $wp_customize->add_setting('greeting_ketua_position', [
        'default' => 'Ketua HMTI',
    ]);
    $wp_customize->add_control('greeting_ketua_position', [
        'label' => 'Jabatan Ketua',
        'section' => 'hmti_greeting_section',
        'type' => 'text',
    ]);

    // Ketua HMTI - Sambutan
    $wp_customize->add_setting('greeting_ketua_message', [
        'default' => 'Selamat datang di website resmi HMTI...',
    ]);
    $wp_customize->add_control('greeting_ketua_message', [
        'label' => 'Sambutan Ketua HMTI',
        'section' => 'hmti_greeting_section',
        'type' => 'textarea',
    ]);

    // Pembina HMTI - Foto
    $wp_customize->add_setting('greeting_pembina_photo');
    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'greeting_pembina_photo', [
        'label' => 'Foto Pembina HMTI',
        'section' => 'hmti_greeting_section',
    ]));

    // Pembina HMTI - Nama
    $wp_customize->add_setting('greeting_pembina_name', [
        'default' => 'Nama Pembina HMTI',
    ]);
    $wp_customize->add_control('greeting_pembina_name', [
        'label' => 'Nama Pembina HMTI',
        'section' => 'hmti_greeting_section',
        'type' => 'text',
    ]);

    // Pembina HMTI - Jabatan
    $wp_customize->add_setting('greeting_pembina_position', [
        'default' => 'Pembina HMTI',
    ]);
    $wp_customize->add_control('greeting_pembina_position', [
        'label' => 'Jabatan Pembina',
        'section' => 'hmti_greeting_section',
        'type' => 'text',
    ]);

    // Pembina HMTI - Sambutan
    $wp_customize->add_setting('greeting_pembina_message', [
        'default' => 'Selamat bergabung di HMTI...',
    ]);
    $wp_customize->add_control('greeting_pembina_message', [
        'label' => 'Sambutan Pembina HMTI',
        'section' => 'hmti_greeting_section',
        'type' => 'textarea',
    ]);

    // 3. Pengurus Section (Tentang HMTI Page)
    $wp_customize->add_section('hmti_pengurus_section', [
        'title' => 'Pengurus (Tentang HMTI)',
        'panel' => 'hmti_homepage_panel',
    ]);

    // Title Pengurus
    $wp_customize->add_setting('pengurus_title', [
        'default' => 'Kepemimpinan dan Struktur Kami',
    ]);
    $wp_customize->add_control('pengurus_title', [
        'label' => 'Title',
        'section' => 'hmti_pengurus_section',
        'type' => 'text',
    ]);

    // Subtitle/Periode Pengurus
    $wp_customize->add_setting('pengurus_subtitle', [
        'default' => 'Tim pengurus HMTI periode 2024/2025',
    ]);
    $wp_customize->add_control('pengurus_subtitle', [
        'label' => 'Periode Pengurus',
        'section' => 'hmti_pengurus_section',
        'type' => 'text',
    ]);

    // 4. Kabinet Section (Tentang HMTI Page)
    $wp_customize->add_section('hmti_kabinet_section', [
        'title' => 'Kabinet (Tentang HMTI)',
        'panel' => 'hmti_homepage_panel',
    ]);

    // Title Kabinet
    $wp_customize->add_setting('kabinet_title', [
        'default' => 'Kabinet',
    ]);
    $wp_customize->add_control('kabinet_title', [
        'label' => 'Nama Kabinet',
        'section' => 'hmti_kabinet_section',
        'type' => 'text',
    ]);

    // Logo Kabinet
    $wp_customize->add_setting('kabinet_logo');
    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'kabinet_logo', [
        'label' => 'Logo Kabinet',
        'section' => 'hmti_kabinet_section',
        'description' => 'Upload logo kabinet (opsional, default menggunakan logo HMTI)',
    ]));

    // Deskripsi Kabinet
    $wp_customize->add_setting('kabinet_description', [
        'default' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.',
    ]);
    $wp_customize->add_control('kabinet_description', [
        'label' => 'Deskripsi Kabinet',
        'section' => 'hmti_kabinet_section',
        'type' => 'textarea',
    ]);

    // 5. Visi & Misi Section (Tentang HMTI Page)
    $wp_customize->add_section('hmti_visimisi_section', [
        'title' => 'Visi & Misi (Tentang HMTI)',
        'panel' => 'hmti_homepage_panel',
    ]);

    // Visi
    $wp_customize->add_setting('visimisi_visi', [
        'default' => 'Menjadi organisasi mahasiswa yang unggul, inovatif, dan berkarakter dalam mengembangkan potensi mahasiswa di bidang teknologi informasi.',
    ]);
    $wp_customize->add_control('visimisi_visi', [
        'label' => 'Visi HMTI',
        'section' => 'hmti_visimisi_section',
        'type' => 'textarea',
    ]);

    // Misi
    $wp_customize->add_setting('visimisi_misi', [
        'default' => "Meningkatkan kualitas akademik dan non-akademik mahasiswa\nMengembangkan jiwa kepemimpinan dan kewirausahaan\nMembangun networking dengan berbagai pihak\nMenciptakan program kerja yang bermanfaat",
    ]);
    $wp_customize->add_control('visimisi_misi', [
        'label' => 'Misi HMTI (Pisahkan setiap poin dengan Enter/baris baru)',
        'section' => 'hmti_visimisi_section',
        'type' => 'textarea',
        'description' => 'Setiap baris akan menjadi satu poin misi dengan nomor urut.',
    ]);


}
add_action('customize_register', 'hmti_customize_register');
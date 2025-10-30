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

    // 2. Greeting Section - Ketua HMTI
    $wp_customize->add_section('hmti_greeting_section', [
        'title' => 'Section Sambutan',
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

    // ==========================================
    // Panel Halaman Tentang HMTI
    // ==========================================
    $wp_customize->add_panel('hmti_about_panel', [
        'title' => 'Pengaturan Tentang HMTI',
        'priority' => 20,
    ]);

    // Hero Section - About Page
    $wp_customize->add_section('hmti_about_hero_section', [
        'title' => 'Hero Section - Tentang HMTI',
        'panel' => 'hmti_about_panel',
    ]);

    $wp_customize->add_setting('about_hero_background_image');
    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'about_hero_background_image', [
        'label' => 'Gambar Background Hero - Tentang HMTI',
        'section' => 'hmti_about_hero_section',
    ]));

    // Sejarah HMTI
    $wp_customize->add_section('hmti_sejarah_section', [
        'title' => 'Sejarah HMTI',
        'panel' => 'hmti_about_panel',
    ]);

    $wp_customize->add_setting('sejarah_hmti_text', [
        'default' => 'Himpunan Mahasiswa Teknik Informatika (HMTI) Universitas Nusa Putra didirikan pada tahun...',
    ]);
    $wp_customize->add_control('sejarah_hmti_text', [
        'label' => 'Teks Sejarah HMTI',
        'section' => 'hmti_sejarah_section',
        'type' => 'textarea',
    ]);

    $wp_customize->add_setting('sejarah_hmti_image');
    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'sejarah_hmti_image', [
        'label' => 'Gambar Sejarah',
        'section' => 'hmti_sejarah_section',
    ]));

    // Visi & Misi
    $wp_customize->add_section('hmti_visi_misi_section', [
        'title' => 'Visi & Misi',
        'panel' => 'hmti_about_panel',
    ]);

    $wp_customize->add_setting('visi_hmti', [
        'default' => 'Menjadi organisasi kemahasiswaan yang unggul, inovatif, dan berdaya saing dalam bidang Teknik Informatika.',
    ]);
    $wp_customize->add_control('visi_hmti', [
        'label' => 'Visi HMTI',
        'section' => 'hmti_visi_misi_section',
        'type' => 'textarea',
    ]);

    $wp_customize->add_setting('misi_hmti', [
        'default' => "1. Meningkatkan kualitas mahasiswa Teknik Informatika\n2. Mengembangkan potensi dan minat mahasiswa\n3. Membangun kerjasama dengan berbagai pihak\n4. Menyelenggarakan program kerja yang bermanfaat",
    ]);
    $wp_customize->add_control('misi_hmti', [
        'label' => 'Misi HMTI',
        'section' => 'hmti_visi_misi_section',
        'type' => 'textarea',
    ]);

    // Struktur Organisasi
    $wp_customize->add_section('hmti_struktur_section', [
        'title' => 'Struktur Organisasi',
        'panel' => 'hmti_about_panel',
    ]);

    $wp_customize->add_setting('periode_kepengurusan', [
        'default' => '2024-2025',
    ]);
    $wp_customize->add_control('periode_kepengurusan', [
        'label' => 'Periode Kepengurusan',
        'section' => 'hmti_struktur_section',
        'type' => 'text',
    ]);

    // Pembina
    $wp_customize->add_setting('struktur_pembina_name');
    $wp_customize->add_control('struktur_pembina_name', [
        'label' => 'Nama Pembina',
        'section' => 'hmti_struktur_section',
        'type' => 'text',
    ]);

    $wp_customize->add_setting('struktur_pembina_photo');
    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'struktur_pembina_photo', [
        'label' => 'Foto Pembina',
        'section' => 'hmti_struktur_section',
    ]));

    // Ketua
    $wp_customize->add_setting('struktur_ketua_name');
    $wp_customize->add_control('struktur_ketua_name', [
        'label' => 'Nama Ketua',
        'section' => 'hmti_struktur_section',
        'type' => 'text',
    ]);

    $wp_customize->add_setting('struktur_ketua_photo');
    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'struktur_ketua_photo', [
        'label' => 'Foto Ketua',
        'section' => 'hmti_struktur_section',
    ]));

    // Wakil Ketua
    $wp_customize->add_setting('struktur_wakil_name');
    $wp_customize->add_control('struktur_wakil_name', [
        'label' => 'Nama Wakil Ketua',
        'section' => 'hmti_struktur_section',
        'type' => 'text',
    ]);

    $wp_customize->add_setting('struktur_wakil_photo');
    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'struktur_wakil_photo', [
        'label' => 'Foto Wakil Ketua',
        'section' => 'hmti_struktur_section',
    ]));

    // Sekretaris
    $wp_customize->add_setting('struktur_sekretaris_name');
    $wp_customize->add_control('struktur_sekretaris_name', [
        'label' => 'Nama Sekretaris',
        'section' => 'hmti_struktur_section',
        'type' => 'text',
    ]);

    $wp_customize->add_setting('struktur_sekretaris_photo');
    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'struktur_sekretaris_photo', [
        'label' => 'Foto Sekretaris',
        'section' => 'hmti_struktur_section',
    ]));

    // Bendahara
    $wp_customize->add_setting('struktur_bendahara_name');
    $wp_customize->add_control('struktur_bendahara_name', [
        'label' => 'Nama Bendahara',
        'section' => 'hmti_struktur_section',
        'type' => 'text',
    ]);

    $wp_customize->add_setting('struktur_bendahara_photo');
    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'struktur_bendahara_photo', [
        'label' => 'Foto Bendahara',
        'section' => 'hmti_struktur_section',
    ]));

    // Divisi (6 divisi)
    $wp_customize->add_section('hmti_divisi_section', [
        'title' => 'Divisi / Departemen',
        'panel' => 'hmti_about_panel',
    ]);

    for ($i = 1; $i <= 6; $i++) {
        // Nama Divisi
        $wp_customize->add_setting("divisi_{$i}_name");
        $wp_customize->add_control("divisi_{$i}_name", [
            'label' => "Nama Divisi $i",
            'section' => 'hmti_divisi_section',
            'type' => 'text',
        ]);

        // Ketua Divisi
        $wp_customize->add_setting("divisi_{$i}_ketua");
        $wp_customize->add_control("divisi_{$i}_ketua", [
            'label' => "Ketua Divisi $i",
            'section' => 'hmti_divisi_section',
            'type' => 'text',
        ]);

        // Foto Ketua Divisi
        $wp_customize->add_setting("divisi_{$i}_photo");
        $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, "divisi_{$i}_photo", [
            'label' => "Foto Ketua Divisi $i",
            'section' => 'hmti_divisi_section',
        ]));

        // Deskripsi Divisi
        $wp_customize->add_setting("divisi_{$i}_description");
        $wp_customize->add_control("divisi_{$i}_description", [
            'label' => "Deskripsi Divisi $i",
            'section' => 'hmti_divisi_section',
            'type' => 'textarea',
        ]);

        // Icon Divisi
        $wp_customize->add_setting("divisi_{$i}_icon");
        $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, "divisi_{$i}_icon", [
            'label' => "Icon Divisi $i",
            'section' => 'hmti_divisi_section',
        ]));
    }

}
add_action('customize_register', 'hmti_customize_register');
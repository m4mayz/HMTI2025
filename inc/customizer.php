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


}
add_action('customize_register', 'hmti_customize_register');
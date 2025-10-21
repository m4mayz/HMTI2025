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


}
add_action('customize_register', 'hmti_customize_register');
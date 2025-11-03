<?php
function hmti_theme_setup()
{
    // Dukungan untuk title tag otomatis dari WordPress
    add_theme_support('title-tag');

    // Dukungan untuk featured images
    add_theme_support('post-thumbnails');
}
add_action('after_setup_theme', 'hmti_theme_setup');

require get_template_directory() . '/inc/customizer.php';
function hmti_theme_styles()
{
    // Memanggil file style.css utama
    wp_enqueue_style(
        'hmti-main-style',
        get_stylesheet_uri(), // Ini akan otomatis mengambil style.css di root tema
        [], // Dependensi (jika ada)
        '1.0' // Versi
    );

    // Jika Anda punya file CSS lain, panggil di sini
    // wp_enqueue_style('hmti-custom-style', get_template_directory_uri() . '/assets/css/custom.css');
}

// Memberitahu WordPress untuk menjalankan fungsi di atas
add_action('wp_enqueue_scripts', 'hmti_theme_styles');
function hmti_theme_scripts()
{
    wp_enqueue_script(
        'hmti-main-script',
        get_template_directory_uri() . '/assets/js/main.js',
        [],
        '1.0',
        true
    );
}
add_action('wp_enqueue_scripts', 'hmti_theme_scripts');

?>
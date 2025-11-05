<?php
function hmti_theme_setup()
{
    // Dukungan untuk title tag otomatis dari WordPress
    add_theme_support('title-tag');

    // Dukungan untuk featured images
    add_theme_support('post-thumbnails');
}
add_action('after_setup_theme', 'hmti_theme_setup');

// Register Custom Post Type untuk Pengurus
function hmti_register_pengurus_post_type()
{
    $labels = array(
        'name' => 'Pengurus HMTI',
        'singular_name' => 'Pengurus',
        'menu_name' => 'Pengurus HMTI',
        'add_new' => 'Tambah Pengurus',
        'add_new_item' => 'Tambah Pengurus Baru',
        'edit_item' => 'Edit Pengurus',
        'new_item' => 'Pengurus Baru',
        'view_item' => 'Lihat Pengurus',
        'search_items' => 'Cari Pengurus',
        'not_found' => 'Pengurus tidak ditemukan',
        'not_found_in_trash' => 'Tidak ada pengurus di trash',
    );

    $args = array(
        'labels' => $labels,
        'public' => true,
        'has_archive' => false,
        'publicly_queryable' => false,
        'show_ui' => true,
        'show_in_menu' => true,
        'menu_icon' => 'dashicons-groups',
        'supports' => array('title', 'thumbnail'),
        'rewrite' => false,
    );

    register_post_type('pengurus', $args);
}
add_action('init', 'hmti_register_pengurus_post_type');

// Add Meta Box untuk Jabatan Pengurus
function hmti_add_pengurus_meta_boxes()
{
    add_meta_box(
        'pengurus_jabatan',
        'Jabatan',
        'hmti_pengurus_jabatan_callback',
        'pengurus',
        'normal',
        'high'
    );

    add_meta_box(
        'pengurus_urutan',
        'Urutan Tampilan',
        'hmti_pengurus_urutan_callback',
        'pengurus',
        'side',
        'default'
    );
}
add_action('add_meta_boxes', 'hmti_add_pengurus_meta_boxes');

function hmti_pengurus_jabatan_callback($post)
{
    wp_nonce_field('hmti_save_pengurus_data', 'hmti_pengurus_nonce');
    $jabatan = get_post_meta($post->ID, '_pengurus_jabatan', true);
    echo '<input type="text" name="pengurus_jabatan" value="' . esc_attr($jabatan) . '" class="widefat" placeholder="Contoh: Ketua Umum, Wakil Ketua, Sekretaris, dll.">';
}

function hmti_pengurus_urutan_callback($post)
{
    $urutan = get_post_meta($post->ID, '_pengurus_urutan', true);
    echo '<p><label>Urutan tampilan (angka kecil tampil lebih dulu):</label></p>';
    echo '<input type="number" name="pengurus_urutan" value="' . esc_attr($urutan) . '" class="widefat" placeholder="0" min="0">';
    echo '<p class="description">Contoh: Ketua = 1, Wakil = 2, Sekretaris = 3, dst.</p>';
}

function hmti_save_pengurus_meta($post_id)
{
    if (!isset($_POST['hmti_pengurus_nonce']) || !wp_verify_nonce($_POST['hmti_pengurus_nonce'], 'hmti_save_pengurus_data')) {
        return;
    }

    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }

    if (!current_user_can('edit_post', $post_id)) {
        return;
    }

    if (isset($_POST['pengurus_jabatan'])) {
        update_post_meta($post_id, '_pengurus_jabatan', sanitize_text_field($_POST['pengurus_jabatan']));
    }

    if (isset($_POST['pengurus_urutan'])) {
        update_post_meta($post_id, '_pengurus_urutan', intval($_POST['pengurus_urutan']));
    }
}
add_action('save_post_pengurus', 'hmti_save_pengurus_meta');

// Register Custom Post Type untuk Visi & Misi
function hmti_register_visimisi_post_type()
{
    $labels = array(
        'name' => 'Visi & Misi',
        'singular_name' => 'Visi & Misi',
        'menu_name' => 'Visi & Misi',
        'edit_item' => 'Edit Visi & Misi',
        'view_item' => 'Lihat Visi & Misi',
        'all_items' => 'Visi & Misi',
    );

    $args = array(
        'labels' => $labels,
        'public' => true,
        'has_archive' => false,
        'publicly_queryable' => false,
        'show_ui' => true,
        'show_in_menu' => true,
        'menu_icon' => 'dashicons-star-filled',
        'supports' => array('title'),
        'rewrite' => false,
        'capability_type' => 'post',
        'show_in_rest' => false,
    );

    register_post_type('visimisi', $args);
}
add_action('init', 'hmti_register_visimisi_post_type');

// Add Meta Box untuk Visi & Misi
function hmti_add_visimisi_meta_boxes()
{
    add_meta_box(
        'visimisi_content',
        'Konten Visi & Misi',
        'hmti_visimisi_content_callback',
        'visimisi',
        'normal',
        'high'
    );
}
add_action('add_meta_boxes', 'hmti_add_visimisi_meta_boxes');

function hmti_visimisi_content_callback($post)
{
    wp_nonce_field('hmti_save_visimisi_data', 'hmti_visimisi_nonce');
    $visi = get_post_meta($post->ID, '_visimisi_visi', true);
    $misi = get_post_meta($post->ID, '_visimisi_misi', true);

    echo '<div style="margin-bottom: 20px;">';
    echo '<h3>Visi</h3>';
    echo '<textarea name="visimisi_visi" rows="5" class="widefat">' . esc_textarea($visi) . '</textarea>';
    echo '<p class="description">Masukkan teks visi organisasi.</p>';
    echo '</div>';

    echo '<div>';
    echo '<h3>Misi</h3>';
    echo '<textarea name="visimisi_misi" rows="10" class="widefat">' . esc_textarea($misi) . '</textarea>';
    echo '<p class="description">Masukkan misi, satu per baris. Setiap baris akan menjadi satu item misi.</p>';
    echo '</div>';
}

function hmti_save_visimisi_meta($post_id)
{
    if (!isset($_POST['hmti_visimisi_nonce']) || !wp_verify_nonce($_POST['hmti_visimisi_nonce'], 'hmti_save_visimisi_data')) {
        return;
    }

    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }

    if (!current_user_can('edit_post', $post_id)) {
        return;
    }

    if (isset($_POST['visimisi_visi'])) {
        update_post_meta($post_id, '_visimisi_visi', sanitize_textarea_field($_POST['visimisi_visi']));
    }

    if (isset($_POST['visimisi_misi'])) {
        update_post_meta($post_id, '_visimisi_misi', sanitize_textarea_field($_POST['visimisi_misi']));
    }
}
add_action('save_post_visimisi', 'hmti_save_visimisi_meta');

require get_template_directory() . '/inc/customizer.php';

function hmti_theme_styles()
{
    // Load Google Fonts
    wp_enqueue_style(
        'hmti-google-fonts',
        'https://fonts.googleapis.com/css2?family=Cormorant+Garamond:wght@300;400;500;600;700&family=Darker+Grotesque:wght@300;400;500;600;700;800;900&display=swap',
        [],
        null
    );

    // Load Tailwind CSS (output dari build)
    wp_enqueue_style(
        'hmti-tailwind',
        get_template_directory_uri() . '/assets/output.css',
        ['hmti-google-fonts'], // Load setelah Google Fonts
        filemtime(get_template_directory() . '/assets/output.css') // Cache busting
    );

    // Memanggil file style.css utama untuk custom CSS tambahan
    wp_enqueue_style(
        'hmti-main-style',
        get_stylesheet_uri(),
        array('hmti-tailwind'), // Load setelah Tailwind
        '1.0'
    );
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
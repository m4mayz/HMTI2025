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
        'pengurus_details',
        'Detail Pengurus',
        'hmti_pengurus_details_callback',
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

function hmti_pengurus_details_callback($post)
{
    wp_nonce_field('hmti_save_pengurus_data', 'hmti_pengurus_nonce');
    $divisi = get_post_meta($post->ID, '_pengurus_divisi', true);
    $jabatan = get_post_meta($post->ID, '_pengurus_jabatan', true);

    // Get all existing divisi from database
    global $wpdb;
    $existing_divisi = $wpdb->get_col("
        SELECT DISTINCT meta_value 
        FROM {$wpdb->postmeta} 
        WHERE meta_key = '_pengurus_divisi' 
        AND meta_value != '' 
        ORDER BY meta_value ASC
    ");

    echo '<p><label><strong>Divisi:</strong></label></p>';
    echo '<input type="text" name="pengurus_divisi" value="' . esc_attr($divisi) . '" class="widefat" list="divisi-suggestions" required placeholder="Ketik atau pilih divisi...">';
    echo '<datalist id="divisi-suggestions">';
    foreach ($existing_divisi as $existing) {
        echo '<option value="' . esc_attr($existing) . '">';
    }
    echo '</datalist>';
    echo '<p class="description">Ketik nama divisi baru atau pilih dari yang sudah ada. Contoh: Badan Pengurus Harian, Keilmuan, Kewirausahaan, dll.</p>';

    echo '<p style="margin-top:15px;"><label><strong>Jabatan:</strong></label></p>';
    echo '<input type="text" name="pengurus_jabatan" value="' . esc_attr($jabatan) . '" class="widefat" placeholder="Contoh: Ketua Umum, Wakil Ketua, Sekretaris, dll.">';
    echo '<p class="description">Jabatan dalam divisi yang dipilih.</p>';
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

    if (isset($_POST['pengurus_divisi'])) {
        update_post_meta($post_id, '_pengurus_divisi', sanitize_text_field($_POST['pengurus_divisi']));
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

// Register Custom Post Type untuk Program Unggulan
function hmti_register_program_unggulan_post_type()
{
    $labels = array(
        'name' => 'Program Unggulan',
        'singular_name' => 'Program Unggulan',
        'menu_name' => 'Program Unggulan',
        'add_new' => 'Tambah Program',
        'add_new_item' => 'Tambah Program Unggulan Baru',
        'edit_item' => 'Edit Program Unggulan',
        'new_item' => 'Program Unggulan Baru',
        'view_item' => 'Lihat Program Unggulan',
        'search_items' => 'Cari Program Unggulan',
        'not_found' => 'Program Unggulan tidak ditemukan',
    );

    $args = array(
        'labels' => $labels,
        'public' => false,
        'has_archive' => false,
        'publicly_queryable' => false,
        'show_ui' => true,
        'show_in_menu' => true,
        'menu_icon' => 'dashicons-star-filled',
        'supports' => array('title', 'thumbnail'),
        'rewrite' => false,
    );

    register_post_type('program_unggulan', $args);
}
add_action('init', 'hmti_register_program_unggulan_post_type');

// Add Meta Boxes for Program Unggulan
function hmti_add_program_unggulan_meta_boxes()
{
    add_meta_box(
        'program_unggulan_details',
        'Detail Program Unggulan',
        'hmti_program_unggulan_details_callback',
        'program_unggulan',
        'normal',
        'high'
    );
}
add_action('add_meta_boxes', 'hmti_add_program_unggulan_meta_boxes');

function hmti_program_unggulan_details_callback($post)
{
    wp_nonce_field('hmti_save_program_unggulan_data', 'hmti_program_unggulan_nonce');
    $tanggal = get_post_meta($post->ID, '_program_unggulan_tanggal', true);
    $lokasi = get_post_meta($post->ID, '_program_unggulan_lokasi', true);
    $deskripsi = get_post_meta($post->ID, '_program_unggulan_deskripsi', true);

    echo '<p><label><strong>Tanggal Program:</strong></label></p>';
    echo '<input type="date" name="program_unggulan_tanggal" value="' . esc_attr($tanggal) . '" class="widefat">';
    echo '<p class="description">Status akan otomatis ditentukan berdasarkan tanggal (hari ini = berlangsung, sebelum = selesai, setelah = akan datang).</p>';

    echo '<p style="margin-top:15px;"><label><strong>Lokasi:</strong></label></p>';
    echo '<input type="text" name="program_unggulan_lokasi" value="' . esc_attr($lokasi) . '" class="widefat" placeholder="Contoh: Aula Kampus">';

    echo '<p style="margin-top:15px;"><label><strong>Deskripsi Singkat:</strong></label></p>';
    echo '<textarea name="program_unggulan_deskripsi" class="widefat" rows="3" maxlength="310" placeholder="Deskripsi singkat program (maksimal 310 karakter)" oninput="document.getElementById(\'char-count-program\').textContent = this.value.length">' . esc_textarea($deskripsi) . '</textarea>';
    echo '<p class="description"><span id="char-count-program">' . strlen($deskripsi) . '</span>/310 karakter</p>';
}

function hmti_save_program_unggulan_meta($post_id)
{
    if (!isset($_POST['hmti_program_unggulan_nonce']) || !wp_verify_nonce($_POST['hmti_program_unggulan_nonce'], 'hmti_save_program_unggulan_data')) {
        return;
    }

    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }

    if (!current_user_can('edit_post', $post_id)) {
        return;
    }

    if (isset($_POST['program_unggulan_tanggal'])) {
        update_post_meta($post_id, '_program_unggulan_tanggal', sanitize_text_field($_POST['program_unggulan_tanggal']));
    }

    if (isset($_POST['program_unggulan_lokasi'])) {
        update_post_meta($post_id, '_program_unggulan_lokasi', sanitize_text_field($_POST['program_unggulan_lokasi']));
    }

    if (isset($_POST['program_unggulan_deskripsi'])) {
        $deskripsi = substr(sanitize_textarea_field($_POST['program_unggulan_deskripsi']), 0, 310);
        update_post_meta($post_id, '_program_unggulan_deskripsi', $deskripsi);
    }
}
add_action('save_post_program_unggulan', 'hmti_save_program_unggulan_meta');

// Register Custom Post Type untuk Acara Terbuka
function hmti_register_acara_terbuka_post_type()
{
    $labels = array(
        'name' => 'Acara Terbuka',
        'singular_name' => 'Acara Terbuka',
        'menu_name' => 'Acara Terbuka',
        'add_new' => 'Tambah Acara',
        'add_new_item' => 'Tambah Acara Terbuka Baru',
        'edit_item' => 'Edit Acara Terbuka',
        'new_item' => 'Acara Terbuka Baru',
        'view_item' => 'Lihat Acara Terbuka',
        'search_items' => 'Cari Acara Terbuka',
        'not_found' => 'Acara Terbuka tidak ditemukan',
    );

    $args = array(
        'labels' => $labels,
        'public' => false,
        'has_archive' => false,
        'publicly_queryable' => false,
        'show_ui' => true,
        'show_in_menu' => true,
        'menu_icon' => 'dashicons-calendar-alt',
        'supports' => array('title', 'thumbnail'),
        'rewrite' => false,
    );

    register_post_type('acara_terbuka', $args);
}
add_action('init', 'hmti_register_acara_terbuka_post_type');

// Add Meta Boxes for Acara Terbuka
function hmti_add_acara_terbuka_meta_boxes()
{
    add_meta_box(
        'acara_terbuka_details',
        'Detail Acara Terbuka',
        'hmti_acara_terbuka_details_callback',
        'acara_terbuka',
        'normal',
        'high'
    );
}
add_action('add_meta_boxes', 'hmti_add_acara_terbuka_meta_boxes');

function hmti_acara_terbuka_details_callback($post)
{
    wp_nonce_field('hmti_save_acara_terbuka_data', 'hmti_acara_terbuka_nonce');
    $tanggal = get_post_meta($post->ID, '_acara_terbuka_tanggal', true);
    $lokasi = get_post_meta($post->ID, '_acara_terbuka_lokasi', true);
    $kategori = get_post_meta($post->ID, '_acara_terbuka_kategori', true);
    $link = get_post_meta($post->ID, '_acara_terbuka_link', true);
    $is_pendaftaran = get_post_meta($post->ID, '_acara_terbuka_is_pendaftaran', true);
    $deskripsi = get_post_meta($post->ID, '_acara_terbuka_deskripsi', true);

    echo '<p><label><strong>Kategori Acara:</strong></label></p>';
    echo '<select name="acara_terbuka_kategori" class="widefat" required>';
    echo '<option value="">-- Pilih Kategori --</option>';
    echo '<option value="lomba"' . selected($kategori, 'lomba', false) . '>Lomba</option>';
    echo '<option value="seminar"' . selected($kategori, 'seminar', false) . '>Seminar</option>';
    echo '<option value="workshop"' . selected($kategori, 'workshop', false) . '>Workshop</option>';
    echo '<option value="kegiatan sosial"' . selected($kategori, 'kegiatan sosial', false) . '>Kegiatan Sosial</option>';
    echo '<option value="event lainnya"' . selected($kategori, 'event lainnya', false) . '>Event Lainnya</option>';
    echo '</select>';
    echo '<p class="description">Kategori acara wajib dipilih.</p>';

    echo '<p style="margin-top:15px;"><label><strong>Tanggal Acara:</strong></label></p>';
    echo '<input type="date" name="acara_terbuka_tanggal" value="' . esc_attr($tanggal) . '" class="widefat">';
    echo '<p class="description">Status akan otomatis ditentukan berdasarkan tanggal (hari ini = berlangsung, sebelum = selesai, setelah = akan datang).</p>';

    echo '<p style="margin-top:15px;"><label><strong>Lokasi:</strong></label></p>';
    echo '<input type="text" name="acara_terbuka_lokasi" value="' . esc_attr($lokasi) . '" class="widefat" placeholder="Contoh: Aula Kampus">';

    echo '<p style="margin-top:15px;"><label><strong>Deskripsi Singkat:</strong></label></p>';
    echo '<textarea name="acara_terbuka_deskripsi" class="widefat" rows="3" maxlength="200" placeholder="Deskripsi singkat acara (maksimal 200 karakter)" oninput="document.getElementById(\'char-count-acara\').textContent = this.value.length">' . esc_textarea($deskripsi) . '</textarea>';
    echo '<p class="description"><span id="char-count-acara">' . strlen($deskripsi) . '</span>/200 karakter</p>';

    echo '<p style="margin-top:15px;"><label><strong>Link:</strong></label></p>';
    echo '<input type="url" name="acara_terbuka_link" value="' . esc_url($link) . '" class="widefat" placeholder="https://...">';
    echo '<p class="description">Link ke halaman detail acara atau formulir pendaftaran (opsional).</p>';

    echo '<p style="margin-top:10px;">';
    echo '<label><input type="checkbox" name="acara_terbuka_is_pendaftaran" value="1"' . checked($is_pendaftaran, '1', false) . '> Link ini adalah link pendaftaran</label>';
    echo '</p>';
    echo '<p class="description">Centang jika link di atas adalah link untuk mendaftar acara. Jika tidak dicentang, link akan ditampilkan sebagai "Lihat Detail".</p>';
}

function hmti_save_acara_terbuka_meta($post_id)
{
    if (!isset($_POST['hmti_acara_terbuka_nonce']) || !wp_verify_nonce($_POST['hmti_acara_terbuka_nonce'], 'hmti_save_acara_terbuka_data')) {
        return;
    }

    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }

    if (!current_user_can('edit_post', $post_id)) {
        return;
    }

    if (isset($_POST['acara_terbuka_kategori'])) {
        update_post_meta($post_id, '_acara_terbuka_kategori', sanitize_text_field($_POST['acara_terbuka_kategori']));
    }

    if (isset($_POST['acara_terbuka_tanggal'])) {
        update_post_meta($post_id, '_acara_terbuka_tanggal', sanitize_text_field($_POST['acara_terbuka_tanggal']));
    }

    if (isset($_POST['acara_terbuka_lokasi'])) {
        update_post_meta($post_id, '_acara_terbuka_lokasi', sanitize_text_field($_POST['acara_terbuka_lokasi']));
    }

    if (isset($_POST['acara_terbuka_deskripsi'])) {
        $deskripsi = substr(sanitize_textarea_field($_POST['acara_terbuka_deskripsi']), 0, 200);
        update_post_meta($post_id, '_acara_terbuka_deskripsi', $deskripsi);
    }

    if (isset($_POST['acara_terbuka_link'])) {
        update_post_meta($post_id, '_acara_terbuka_link', esc_url_raw($_POST['acara_terbuka_link']));
    } else {
        update_post_meta($post_id, '_acara_terbuka_link', '');
    }

    if (isset($_POST['acara_terbuka_is_pendaftaran'])) {
        update_post_meta($post_id, '_acara_terbuka_is_pendaftaran', '1');
    } else {
        update_post_meta($post_id, '_acara_terbuka_is_pendaftaran', '0');
    }
}
add_action('save_post_acara_terbuka', 'hmti_save_acara_terbuka_meta');

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

// Custom Pagination Styles
function hmti_pagination_styles()
{
    ?>
    <style>
        /* Pagination Wrapper */
        .navigation.pagination {
            margin-top: 3rem;
        }

        /* Pagination List */
        .page-numbers {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 0.5rem;
            list-style: none;
            padding: 0;
            margin: 0;
        }

        /* Pagination Items */
        .page-numbers li {
            list-style: none;
        }

        /* Pagination Links */
        .page-numbers a,
        .page-numbers span {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-width: 2.5rem;
            height: 2.5rem;
            padding: 0 0.75rem;
            font-family: 'Darker Grotesque', sans-serif;
            font-size: 1rem;
            font-weight: 500;
            color: #1f2937;
            background-color: #f9fafb;
            border: 1px solid #e5e7eb;
            border-radius: 0.5rem;
            text-decoration: none;
            transition: all 0.3s ease;
        }

        /* Hover State */
        .page-numbers a:hover {
            background-color: #0ea5e9;
            color: #ffffff;
            border-color: #0ea5e9;
            transform: translateY(-2px);
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
        }

        /* Current Page */
        .page-numbers .current {
            background-color: #0ea5e9;
            color: #ffffff;
            border-color: #0ea5e9;
            font-weight: 600;
            cursor: default;
        }

        /* Dots */
        .page-numbers .dots {
            background: transparent;
            border: none;
            color: #9ca3af;
            cursor: default;
            min-width: auto;
            padding: 0 0.25rem;
        }

        .page-numbers .dots:hover {
            background: transparent;
            border: none;
            transform: none;
            box-shadow: none;
        }

        /* Prev/Next Buttons */
        .page-numbers .prev,
        .page-numbers .next {
            font-weight: 600;
            padding: 0 1rem;
        }

        /* Disabled Prev/Next */
        .page-numbers .prev.disabled,
        .page-numbers .next.disabled {
            opacity: 0.5;
            cursor: not-allowed;
            pointer-events: none;
        }

        /* Responsive */
        @media (max-width: 640px) {
            .page-numbers {
                gap: 0.25rem;
            }

            .page-numbers a,
            .page-numbers span {
                min-width: 2rem;
                height: 2rem;
                font-size: 0.875rem;
                padding: 0 0.5rem;
            }

            .page-numbers .prev,
            .page-numbers .next {
                padding: 0 0.75rem;
            }
        }
    </style>
    <?php
}
add_action('wp_head', 'hmti_pagination_styles');

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

// Function to get time ago
function hmti_time_ago($time)
{
    $time_difference = time() - $time;

    if ($time_difference < 1) {
        return 'baru saja';
    }

    $condition = array(
        12 * 30 * 24 * 60 * 60 => 'tahun',
        30 * 24 * 60 * 60 => 'bulan',
        24 * 60 * 60 => 'hari',
        60 * 60 => 'jam',
        60 => 'menit',
        1 => 'detik'
    );

    foreach ($condition as $secs => $str) {
        $d = $time_difference / $secs;

        if ($d >= 1) {
            $t = round($d);
            return $t . ' ' . $str . ' lalu';
        }
    }
}

?>
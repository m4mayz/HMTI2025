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
    echo '<p class="description">Ketik nama divisi baru atau pilih dari yang sudah ada. Contoh: Ketua & Wakil, Keilmuan, Kewirausahaan, dll.</p>';

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

// =====================================================
// QUICK ADD MULTIPLE PENGURUS
// =====================================================

// Add custom admin page for bulk import
function hmti_add_pengurus_import_page()
{
    add_submenu_page(
        'edit.php?post_type=pengurus',
        'Import Pengurus',
        'Import Pengurus',
        'manage_options',
        'hmti-import-pengurus',
        'hmti_render_import_pengurus_page'
    );
}
add_action('admin_menu', 'hmti_add_pengurus_import_page');

// Render import page
function hmti_render_import_pengurus_page()
{
    ?>
    <div class="wrap">
        <h1>Import Pengurus - Cara Cepat Menambah Banyak Pengurus</h1>

        <?php if (isset($_GET['success'])): ?>
            <div class="notice notice-success is-dismissible">
                <p><strong>Berhasil!</strong> <?php echo intval($_GET['success']); ?> pengurus telah ditambahkan.</p>
            </div>
        <?php endif; ?>

        <?php if (isset($_GET['deleted'])): ?>
            <div class="notice notice-success is-dismissible">
                <p><strong>Berhasil!</strong> <?php echo intval($_GET['deleted']); ?> pengurus telah dihapus permanen.</p>
            </div>
        <?php endif; ?>

        <?php if (isset($_GET['error'])): ?>
            <div class="notice notice-error is-dismissible">
                <p><strong>Error:</strong> <?php echo esc_html($_GET['error']); ?></p>
            </div>
        <?php endif; ?>

        <div class="card" style="max-width: 900px; margin-top: 20px;">
            <h2>📥 Metode 1: Import dari CSV/Excel</h2>
            <p>Upload file CSV atau Excel dengan format yang sudah ditentukan.</p>

            <!-- Download Template Button -->
            <p>
                <a href="<?php echo admin_url('admin-post.php?action=download_pengurus_template'); ?>"
                    class="button button-secondary">
                    📄 Download Template CSV
                </a>
                <span style="margin-left: 10px; color: #666;">
                    Download template kosong untuk diisi
                </span>
            </p>

            <form method="post" enctype="multipart/form-data" action="<?php echo admin_url('admin-post.php'); ?>">
                <?php wp_nonce_field('hmti_import_pengurus', 'hmti_import_nonce'); ?>
                <input type="hidden" name="action" value="hmti_import_pengurus">

                <table class="form-table">
                    <tr>
                        <th scope="row">
                            <label for="pengurus_csv">File CSV/Excel</label>
                        </th>
                        <td>
                            <input type="file" name="pengurus_csv" id="pengurus_csv" accept=".csv,.xlsx,.xls" required>
                            <p class="description">
                                Format: Nama, Divisi, Jabatan, Urutan (tanpa header)<br>
                                Contoh: John Doe, Ketua & Wakil, Ketua Umum, 1
                            </p>
                        </td>
                    </tr>
                </table>

                <?php submit_button('Import Pengurus'); ?>
            </form>
        </div>

        <div class="card" style="max-width: 900px; margin-top: 20px;">
            <h2>➕ Metode 2: Quick Add (Form Cepat)</h2>
            <p>Tambahkan beberapa pengurus sekaligus dengan form sederhana.</p>

            <form method="post" action="<?php echo admin_url('admin-post.php'); ?>" id="quick-add-form">
                <?php wp_nonce_field('hmti_quick_add_pengurus', 'hmti_quick_add_nonce'); ?>
                <input type="hidden" name="action" value="hmti_quick_add_pengurus">

                <div id="pengurus-entries">
                    <div class="pengurus-entry"
                        style="border: 1px solid #ddd; padding: 15px; margin-bottom: 15px; border-radius: 5px; background: #f9f9f9;">
                        <h4>Pengurus #1</h4>
                        <table class="form-table">
                            <tr>
                                <th><label>Nama Lengkap</label></th>
                                <td><input type="text" name="pengurus[0][nama]" class="regular-text" required></td>
                            </tr>
                            <tr>
                                <th><label>Divisi</label></th>
                                <td>
                                    <input type="text" name="pengurus[0][divisi]" class="regular-text" required
                                        list="divisi-list-0" placeholder="Ketua & Wakil, Keilmuan, dll">
                                    <datalist id="divisi-list-0">
                                        <?php
                                        global $wpdb;
                                        $divisi_list = $wpdb->get_col("
                                            SELECT DISTINCT meta_value 
                                            FROM {$wpdb->postmeta} 
                                            WHERE meta_key = '_pengurus_divisi' 
                                            AND meta_value != '' 
                                            ORDER BY meta_value ASC
                                        ");
                                        foreach ($divisi_list as $divisi) {
                                            echo '<option value="' . esc_attr($divisi) . '">';
                                        }
                                        ?>
                                    </datalist>
                                </td>
                            </tr>
                            <tr>
                                <th><label>Jabatan</label></th>
                                <td><input type="text" name="pengurus[0][jabatan]" class="regular-text"
                                        placeholder="Ketua Umum, Sekretaris, dll"></td>
                            </tr>
                            <tr>
                                <th><label>Urutan</label></th>
                                <td><input type="number" name="pengurus[0][urutan]" class="small-text" value="0" min="0">
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>

                <p>
                    <button type="button" class="button button-secondary" onclick="addPengurusEntry()">
                        ➕ Tambah Pengurus Lagi
                    </button>
                    <button type="button" class="button button-secondary" onclick="removePengurusEntry()"
                        style="margin-left: 10px;">
                        ➖ Hapus Pengurus Terakhir
                    </button>
                </p>

                <?php submit_button('Simpan Semua Pengurus'); ?>
            </form>
        </div>

        <div class="card" style="max-width: 900px; margin-top: 20px;">
            <h2>📋 Tips Penggunaan</h2>
            <ul>
                <li><strong>CSV Import:</strong> Cocok untuk data dalam jumlah besar (10+ pengurus)</li>
                <li><strong>Quick Add:</strong> Cocok untuk menambah 2-10 pengurus sekaligus</li>
                <li><strong>Foto:</strong> Upload foto setelah pengurus ditambahkan (Edit post → Set featured image)</li>
                <li><strong>Format Urutan:</strong> Angka kecil tampil lebih dulu (Ketua=1, Wakil=2, dst)</li>
            </ul>
        </div>

        <!-- Danger Zone -->
        <div class="card" style="max-width: 900px; margin-top: 20px; border-color: #dc3232;">
            <h2 style="color: #dc3232;">⚠️ Danger Zone - Hapus Semua Data</h2>
            <p style="color: #666;">
                <strong>Peringatan:</strong> Tindakan ini akan menghapus <strong>SEMUA</strong> data pengurus yang ada.
                Gunakan dengan hati-hati! Data yang dihapus tidak dapat dikembalikan.
            </p>

            <?php
            // Count total pengurus
            $pengurus_count = wp_count_posts('pengurus');
            $total_pengurus = $pengurus_count->publish + $pengurus_count->draft;
            ?>

            <div style="background: #fff3cd; border: 1px solid #ffc107; padding: 15px; border-radius: 5px; margin: 15px 0;">
                <p style="margin: 0; color: #856404;">
                    📊 Total pengurus saat ini: <strong><?php echo $total_pengurus; ?> orang</strong>
                </p>
            </div>

            <form method="post" action="<?php echo admin_url('admin-post.php'); ?>" onsubmit="return confirmDeleteAll();"
                style="margin-top: 15px;">
                <?php wp_nonce_field('hmti_delete_all_pengurus', 'hmti_delete_all_nonce'); ?>
                <input type="hidden" name="action" value="hmti_delete_all_pengurus">

                <p>
                    <label style="display: block; margin-bottom: 10px;">
                        <input type="checkbox" id="confirm-delete" required>
                        <strong>Saya mengerti bahwa tindakan ini tidak dapat dibatalkan</strong>
                    </label>
                </p>

                <button type="submit" class="button button-primary"
                    style="background: #dc3232; border-color: #dc3232; text-shadow: none; box-shadow: none;">
                    🗑️ Hapus Semua Pengurus (<?php echo $total_pengurus; ?>)
                </button>
            </form>

            <p style="margin-top: 15px; font-size: 12px; color: #999;">
                💡 <strong>Tips:</strong> Gunakan fitur ini sebelum import pengurus baru di periode kepengurusan baru.
            </p>
        </div>
    </div>

    <script>
        function confirmDeleteAll() {
            const totalPengurus = <?php echo $total_pengurus; ?>;

            if (totalPengurus === 0) {
                alert('Tidak ada pengurus untuk dihapus!');
                return false;
            }

            const confirmation = confirm(
                '⚠️ KONFIRMASI HAPUS SEMUA PENGURUS\n\n' +
                'Anda akan menghapus ' + totalPengurus + ' pengurus.\n\n' +
                'Data yang akan dihapus:\n' +
                '• Semua nama pengurus\n' +
                '• Divisi dan jabatan\n' +
                '• Foto pengurus\n' +
                '• Urutan tampilan\n\n' +
                'Tindakan ini TIDAK DAPAT DIBATALKAN!\n\n' +
                'Apakah Anda yakin ingin melanjutkan?'
            );

            if (!confirmation) {
                return false;
            }

            // Double confirmation for safety
            const doubleConfirm = confirm(
                '⚠️ KONFIRMASI TERAKHIR!\n\n' +
                'Ini adalah konfirmasi terakhir.\n' +
                'Semua ' + totalPengurus + ' pengurus akan dihapus PERMANEN.\n\n' +
                'Klik OK untuk HAPUS atau Cancel untuk BATALKAN.'
            );

            return doubleConfirm;
        }
    </script>

    <script>
        let pengurusCount = 1;

        function addPengurusEntry() {
            const container = document.getElementById('pengurus-entries');
            const newEntry = document.createElement('div');
            newEntry.className = 'pengurus-entry';
            newEntry.style.cssText = 'border: 1px solid #ddd; padding: 15px; margin-bottom: 15px; border-radius: 5px; background: #f9f9f9;';

            newEntry.innerHTML = `
            <h4>Pengurus #${pengurusCount + 1}</h4>
            <table class="form-table">
                <tr>
                    <th><label>Nama Lengkap</label></th>
                    <td><input type="text" name="pengurus[${pengurusCount}][nama]" class="regular-text" required></td>
                </tr>
                <tr>
                    <th><label>Divisi</label></th>
                    <td>
                        <input type="text" name="pengurus[${pengurusCount}][divisi]" class="regular-text" required 
                               list="divisi-list-${pengurusCount}" placeholder="Ketua & Wakil, Keilmuan, dll">
                        <datalist id="divisi-list-${pengurusCount}">
                            <?php
                            foreach ($divisi_list as $divisi) {
                                echo '<option value="' . esc_attr($divisi) . '">';
                            }
                            ?>
                        </datalist>
                    </td>
                </tr>
                <tr>
                    <th><label>Jabatan</label></th>
                    <td><input type="text" name="pengurus[${pengurusCount}][jabatan]" class="regular-text" placeholder="Ketua Umum, Sekretaris, dll"></td>
                </tr>
                <tr>
                    <th><label>Urutan</label></th>
                    <td><input type="number" name="pengurus[${pengurusCount}][urutan]" class="small-text" value="0" min="0"></td>
                </tr>
            </table>
        `;

            container.appendChild(newEntry);
            pengurusCount++;
        }

        function removePengurusEntry() {
            const container = document.getElementById('pengurus-entries');
            const entries = container.getElementsByClassName('pengurus-entry');
            if (entries.length > 1) {
                container.removeChild(entries[entries.length - 1]);
                pengurusCount--;
            } else {
                alert('Minimal harus ada 1 pengurus!');
            }
        }
    </script>

    <style>
        .card {
            background: #fff;
            border: 1px solid #ccd0d4;
            border-radius: 4px;
            padding: 20px;
            box-shadow: 0 1px 1px rgba(0, 0, 0, .04);
        }

        .card h2 {
            margin-top: 0;
            padding-bottom: 10px;
            border-bottom: 1px solid #ddd;
        }
    </style>
    <?php
}

// Handle CSV download template
function hmti_download_pengurus_template()
{
    if (!current_user_can('manage_options')) {
        wp_die('Unauthorized');
    }

    $filename = 'template-import-pengurus.csv';

    header('Content-Type: text/csv; charset=utf-8');
    header('Content-Disposition: attachment; filename=' . $filename);

    $output = fopen('php://output', 'w');

    // Add BOM for Excel UTF-8 compatibility
    fprintf($output, chr(0xEF) . chr(0xBB) . chr(0xBF));

    // Header row
    fputcsv($output, array('Nama', 'Divisi', 'Jabatan', 'Urutan'));

    // Example rows
    fputcsv($output, array('John Doe', 'Ketua & Wakil', 'Ketua Umum', '1'));
    fputcsv($output, array('Jane Smith', 'Ketua & Wakil', 'Wakil Ketua', '2'));
    fputcsv($output, array('Bob Johnson', 'Keilmuan', 'Kepala Divisi', '10'));

    fclose($output);
    exit;
}
add_action('admin_post_download_pengurus_template', 'hmti_download_pengurus_template');

// Handle CSV import
function hmti_handle_import_pengurus()
{
    if (!current_user_can('manage_options')) {
        wp_die('Unauthorized');
    }

    if (!isset($_POST['hmti_import_nonce']) || !wp_verify_nonce($_POST['hmti_import_nonce'], 'hmti_import_pengurus')) {
        wp_die('Nonce verification failed');
    }

    if (!isset($_FILES['pengurus_csv']) || $_FILES['pengurus_csv']['error'] !== UPLOAD_ERR_OK) {
        wp_redirect(admin_url('edit.php?post_type=pengurus&page=hmti-import-pengurus&error=' . urlencode('File upload failed')));
        exit;
    }

    $file = $_FILES['pengurus_csv']['tmp_name'];
    $handle = fopen($file, 'r');

    if ($handle === false) {
        wp_redirect(admin_url('edit.php?post_type=pengurus&page=hmti-import-pengurus&error=' . urlencode('Cannot read file')));
        exit;
    }

    $count = 0;
    $row_number = 0;

    while (($data = fgetcsv($handle, 1000, ',')) !== false) {
        $row_number++;

        // Skip header row if exists
        if ($row_number === 1 && (strtolower($data[0]) === 'nama' || strtolower($data[0]) === 'name')) {
            continue;
        }

        // Skip empty rows
        if (empty($data[0])) {
            continue;
        }

        $nama = sanitize_text_field($data[0]);
        $divisi = isset($data[1]) ? sanitize_text_field($data[1]) : '';
        $jabatan = isset($data[2]) ? sanitize_text_field($data[2]) : '';
        $urutan = isset($data[3]) ? intval($data[3]) : 0;

        // Create post
        $post_id = wp_insert_post(array(
            'post_title' => $nama,
            'post_type' => 'pengurus',
            'post_status' => 'publish'
        ));

        if ($post_id) {
            update_post_meta($post_id, '_pengurus_divisi', $divisi);
            update_post_meta($post_id, '_pengurus_jabatan', $jabatan);
            update_post_meta($post_id, '_pengurus_urutan', $urutan);
            $count++;
        }
    }

    fclose($handle);

    wp_redirect(admin_url('edit.php?post_type=pengurus&page=hmti-import-pengurus&success=' . $count));
    exit;
}
add_action('admin_post_hmti_import_pengurus', 'hmti_handle_import_pengurus');

// Handle quick add form
function hmti_handle_quick_add_pengurus()
{
    if (!current_user_can('manage_options')) {
        wp_die('Unauthorized');
    }

    if (!isset($_POST['hmti_quick_add_nonce']) || !wp_verify_nonce($_POST['hmti_quick_add_nonce'], 'hmti_quick_add_pengurus')) {
        wp_die('Nonce verification failed');
    }

    $pengurus_data = isset($_POST['pengurus']) ? $_POST['pengurus'] : array();
    $count = 0;

    foreach ($pengurus_data as $pengurus) {
        $nama = sanitize_text_field($pengurus['nama']);
        $divisi = sanitize_text_field($pengurus['divisi']);
        $jabatan = isset($pengurus['jabatan']) ? sanitize_text_field($pengurus['jabatan']) : '';
        $urutan = isset($pengurus['urutan']) ? intval($pengurus['urutan']) : 0;

        if (empty($nama) || empty($divisi)) {
            continue;
        }

        // Create post
        $post_id = wp_insert_post(array(
            'post_title' => $nama,
            'post_type' => 'pengurus',
            'post_status' => 'publish'
        ));

        if ($post_id) {
            update_post_meta($post_id, '_pengurus_divisi', $divisi);
            update_post_meta($post_id, '_pengurus_jabatan', $jabatan);
            update_post_meta($post_id, '_pengurus_urutan', $urutan);
            $count++;
        }
    }

    wp_redirect(admin_url('edit.php?post_type=pengurus&page=hmti-import-pengurus&success=' . $count));
    exit;
}
add_action('admin_post_hmti_quick_add_pengurus', 'hmti_handle_quick_add_pengurus');

// Handle delete all pengurus
function hmti_handle_delete_all_pengurus()
{
    if (!current_user_can('manage_options')) {
        wp_die('Unauthorized');
    }

    if (!isset($_POST['hmti_delete_all_nonce']) || !wp_verify_nonce($_POST['hmti_delete_all_nonce'], 'hmti_delete_all_pengurus')) {
        wp_die('Nonce verification failed');
    }

    // Get all pengurus posts
    $args = array(
        'post_type' => 'pengurus',
        'posts_per_page' => -1,
        'post_status' => 'any',
        'fields' => 'ids'
    );

    $pengurus_ids = get_posts($args);
    $count = 0;

    // Delete each pengurus permanently
    foreach ($pengurus_ids as $post_id) {
        // Delete featured image if exists
        $thumbnail_id = get_post_thumbnail_id($post_id);
        if ($thumbnail_id) {
            wp_delete_attachment($thumbnail_id, true);
        }

        // Force delete (bypass trash)
        $deleted = wp_delete_post($post_id, true);
        if ($deleted) {
            $count++;
        }
    }

    wp_redirect(admin_url('edit.php?post_type=pengurus&page=hmti-import-pengurus&deleted=' . $count));
    exit;
}
add_action('admin_post_hmti_delete_all_pengurus', 'hmti_handle_delete_all_pengurus');


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

// =====================================================
// GALLERY MEDIA FILTER
// =====================================================

// Add "Show in Gallery" checkbox to attachment edit screen
function hmti_add_gallery_checkbox_to_attachment($form_fields, $post)
{
    $show_in_gallery = get_post_meta($post->ID, '_show_in_gallery', true);

    $form_fields['show_in_gallery'] = array(
        'label' => 'Tampilkan di Galeri',
        'input' => 'html',
        'html' => '<label for="attachments-' . $post->ID . '-show_in_gallery">
                    <input type="checkbox" id="attachments-' . $post->ID . '-show_in_gallery" name="attachments[' . $post->ID . '][show_in_gallery]" value="1" ' . checked($show_in_gallery, '1', false) . '> 
                    Centang untuk menampilkan foto ini di halaman galeri
                   </label>',
        'helps' => 'Hanya foto yang dicentang yang akan muncul di halaman galeri publik.'
    );

    return $form_fields;
}
add_filter('attachment_fields_to_edit', 'hmti_add_gallery_checkbox_to_attachment', 10, 2);

// Save "Show in Gallery" checkbox value
function hmti_save_gallery_checkbox($post, $attachment)
{
    if (isset($attachment['show_in_gallery'])) {
        update_post_meta($post['ID'], '_show_in_gallery', '1');
    } else {
        delete_post_meta($post['ID'], '_show_in_gallery');
    }

    return $post;
}
add_filter('attachment_fields_to_save', 'hmti_save_gallery_checkbox', 10, 2);

// Add "Show in Gallery" column to Media Library list view
function hmti_add_gallery_column($columns)
{
    $columns['show_in_gallery'] = 'Galeri';
    return $columns;
}
add_filter('manage_media_columns', 'hmti_add_gallery_column');

// Display "Show in Gallery" status in Media Library list view
function hmti_display_gallery_column($column_name, $post_id)
{
    if ($column_name === 'show_in_gallery') {
        $show_in_gallery = get_post_meta($post_id, '_show_in_gallery', true);
        if ($show_in_gallery === '1') {
            echo '<span style="color: #46b450; font-weight: bold;">✓ Ya</span>';
        } else {
            echo '<span style="color: #ddd;">-</span>';
        }
    }
}
add_action('manage_media_custom_column', 'hmti_display_gallery_column', 10, 2);

// Make "Show in Gallery" column sortable
function hmti_make_gallery_column_sortable($columns)
{
    $columns['show_in_gallery'] = 'show_in_gallery';
    return $columns;
}
add_filter('manage_upload_sortable_columns', 'hmti_make_gallery_column_sortable');

// Add bulk action to mark multiple images for gallery
function hmti_add_gallery_bulk_actions($bulk_actions)
{
    $bulk_actions['add_to_gallery'] = 'Tambah ke Galeri';
    $bulk_actions['remove_from_gallery'] = 'Hapus dari Galeri';
    return $bulk_actions;
}
add_filter('bulk_actions-upload', 'hmti_add_gallery_bulk_actions');

// Handle bulk action to mark/unmark images for gallery
function hmti_handle_gallery_bulk_actions($redirect_to, $action, $post_ids)
{
    if ($action === 'add_to_gallery') {
        foreach ($post_ids as $post_id) {
            update_post_meta($post_id, '_show_in_gallery', '1');
        }
        $redirect_to = add_query_arg('gallery_added', count($post_ids), $redirect_to);
    } elseif ($action === 'remove_from_gallery') {
        foreach ($post_ids as $post_id) {
            delete_post_meta($post_id, '_show_in_gallery');
        }
        $redirect_to = add_query_arg('gallery_removed', count($post_ids), $redirect_to);
    }

    return $redirect_to;
}
add_filter('handle_bulk_actions-upload', 'hmti_handle_gallery_bulk_actions', 10, 3);

// Show admin notice after bulk action
function hmti_gallery_bulk_action_admin_notice()
{
    if (!empty($_REQUEST['gallery_added'])) {
        $count = intval($_REQUEST['gallery_added']);
        printf(
            '<div class="notice notice-success is-dismissible"><p>%s foto berhasil ditambahkan ke galeri.</p></div>',
            $count
        );
    }

    if (!empty($_REQUEST['gallery_removed'])) {
        $count = intval($_REQUEST['gallery_removed']);
        printf(
            '<div class="notice notice-success is-dismissible"><p>%s foto berhasil dihapus dari galeri.</p></div>',
            $count
        );
    }
}
add_action('admin_notices', 'hmti_gallery_bulk_action_admin_notice');

?>
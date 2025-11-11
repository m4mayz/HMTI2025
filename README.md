# 🎓 HMTI2025 Theme - Panduan Lengkap

> Tema WordPress Custom untuk Himpunan Mahasiswa Teknik Informatika

## 📋 Daftar Isi

1. [Tentang Tema](#tentang-tema)
2. [Instalasi & Setup](#instalasi--setup)
3. [Struktur Tema](#struktur-tema)
4. [Mengelola Konten](#mengelola-konten)
5. [Kustomisasi Tema](#kustomisasi-tema)
6. [Pengembangan](#pengembangan)
7. [Troubleshooting](#troubleshooting)

---

## 🎨 Tentang Tema

**HMTI2025** adalah tema WordPress custom yang dirancang khusus untuk website organisasi kampus dengan fitur-fitur modern:

### ✨ Fitur Utama

-   ✅ **Responsive Design** - Tampil sempurna di semua perangkat
-   ✅ **Dark Theme** - Tema gelap yang modern dan elegan
-   ✅ **Tailwind CSS** - Framework CSS utility-first untuk styling cepat
-   ✅ **Scroll Animations** - Animasi fade-in saat scroll dengan Intersection Observer
-   ✅ **Custom Post Types** - Dukungan untuk berbagai jenis konten
-   ✅ **Gallery System** - Masonry layout dengan lightbox
-   ✅ **SEO Friendly** - Struktur HTML yang optimal
-   ✅ **404 Error Page** - Halaman error yang menarik dan informatif

### 🎨 Palet Warna

```css
--primary-color: #3498db    /* Biru */
--primary-dark: #2f7db2     /* Biru Gelap */
--secondary-color: #c9cc2e  /* Kuning/Lime */
--dark-bg: #222             /* Background Gelap */
```

### 🔤 Tipografi

-   **Body Text**: Darker Grotesque (Sans-serif) - Weight 500
-   **Title Text**: Cormorant Garamond (Serif)

---

## 🚀 Instalasi & Setup

### Prasyarat

-   WordPress 5.0 atau lebih baru
-   PHP 7.4 atau lebih baru
-   Node.js dan npm (untuk development)
-   XAMPP/WAMP/LAMP (untuk local development)

### Langkah Instalasi

#### 1. Upload Tema

```bash
# Via FTP atau File Manager
1. Download tema HMTI2025
2. Upload ke: /wp-content/themes/HMTI2025/
3. Login ke WordPress Admin
4. Pergi ke Appearance > Themes
5. Aktifkan tema HMTI2025
```

#### 2. Setup Development (Opsional)

```bash
# Masuk ke folder tema
cd /xampp/htdocs/wordpress/wp-content/themes/HMTI2025

# Install dependencies
npm install

# Build CSS (Tailwind)
npm run build:css

# Watch mode untuk development
npm run watch:css
```

#### 3. Konfigurasi Awal

1. **Set Homepage**: Settings > Reading > Your homepage displays > A static page
2. **Permalink**: Settings > Permalinks > Post name
3. **Media Settings**: Settings > Media (set ukuran thumbnail sesuai kebutuhan)

---

## 📁 Struktur Tema

```
HMTI2025/
├── 📄 index.php              # Template fallback
├── 📄 front-page.php         # Halaman beranda
├── 📄 home.php               # Blog archive
├── 📄 page.php               # Template halaman default
├── 📄 single.php             # Template post tunggal
├── 📄 category.php           # Template kategori
├── 📄 search.php             # Template hasil pencarian
├── 📄 404.php                # Halaman error 404
├── 📄 header.php             # Header global
├── 📄 footer.php             # Footer global
├── 📄 functions.php          # Fungsi tema
├── 📄 style.css              # Stylesheet utama & variabel CSS
├── 📄 app.css                # Input Tailwind CSS
├── 📄 tailwind.config.js     # Konfigurasi Tailwind
├── 📄 postcss.config.js      # Konfigurasi PostCSS
├── 📄 package.json           # Dependencies Node.js
│
├── 📁 assets/
│   ├── 📄 output.css         # Compiled Tailwind CSS
│   ├── 📁 images/
│   │   └── 📁 elements/      # Gambar elemen UI
│   └── 📁 js/
│       └── 📄 main.js        # JavaScript global
│
├── 📁 inc/
│   └── 📄 customizer.php     # WordPress Customizer
│
└── 📁 templates/              # Template halaman khusus
    ├── 📄 page-tentang-hmti.php
    ├── 📄 page-galeri.php
    ├── 📄 page-program-kegiatan.php
    └── 📄 page-arsip.php
```

---

## 📝 Mengelola Konten

### 1. Halaman Beranda (Front Page)

#### Mengubah Hero Section

```php
// File: front-page.php (Sekitar baris 10-30)

// Edit teks greeting
<h2>Selamat Datang di Website HMTI</h2>

// Edit deskripsi
<p>Himpunan Mahasiswa Teknik Informatika...</p>
```

**Via WordPress Admin:**

1. Pages > Front Page > Edit
2. Ubah konten sesuai kebutuhan

#### Menambah/Edit Greeting Cards

```php
// File: front-page.php (Sekitar baris 50-80)

// Struktur greeting card:
<div class="greeting-item">
    <div class="greeting-icon">
        <!-- Icon SVG -->
    </div>
    <h3>Judul Card</h3>
    <p>Deskripsi card</p>
</div>
```

#### Mengelola Berita di Beranda

**Via WordPress Admin:**

1. Posts > Add New
2. Tulis konten berita
3. Set Featured Image (gambar utama)
4. Pilih Category
5. Publish

**Berita akan otomatis muncul** di section "Berita & Publikasi" pada homepage (menampilkan 6 berita terbaru).

#### Mengelola Galeri di Beranda

**Via WordPress Admin:**

1. Media > Library > Add New
2. Upload gambar (maksimal 6 gambar terbaru)
3. Set Title dan Description untuk setiap gambar

**Gambar akan otomatis muncul** di section galeri homepage.

---

### 2. Halaman Tentang HMTI

**Buat Halaman Baru:**

1. Pages > Add New
2. Title: "Tentang HMTI"
3. Template: `page-tentang-hmti.php` (pilih di sidebar kanan)
4. Publish

#### Mengubah Sejarah HMTI

```php
// File: page-tentang-hmti.php (Sekitar baris 30-60)

// Edit konten sejarah:
<div class="sejarah-content">
    <p>Teks sejarah HMTI Anda...</p>
</div>
```

#### Mengelola Visi & Misi

```php
// File: page-tentang-hmti.php (Sekitar baris 80-120)

// Tambah/Edit Visi:
<div class="visimisi-new-item">
    <h4>Visi</h4>
    <p>Konten visi...</p>
</div>

// Tambah/Edit Misi:
<div class="visimisi-new-item">
    <h4>Misi 1</h4>
    <p>Konten misi 1...</p>
</div>
```

#### Mengelola Struktur Organisasi

**Via Custom Post Type - Pengurus:**

1. Dashboard > Pengurus > Add New
2. Isi data:
    - Title: Nama Pengurus
    - Content: Bio/Deskripsi (opsional)
    - Set Featured Image: Foto pengurus
3. Isi Custom Fields:
    - Jabatan: (contoh: "Ketua Umum")
    - Divisi: (contoh: "Inti", "Kaderisasi", "PSDM", dll)
    - NIM: (opsional)
    - Angkatan: (opsional)
4. Publish

**Filter Divisi akan otomatis** menampilkan pengurus berdasarkan divisi.

---

### 3. Halaman Program & Kegiatan

**Buat Halaman Baru:**

1. Pages > Add New
2. Title: "Program & Kegiatan"
3. Template: `page-program-kegiatan.php`
4. Publish

#### Mengelola Program

**Via Custom Post Type - Program:**

1. Dashboard > Program > Add New
2. Isi data:
    - Title: Nama Program
    - Content: Deskripsi program lengkap
    - Set Featured Image: Logo/gambar program
3. Isi Custom Fields:
    - Kategori: (contoh: "Kaderisasi", "PSDM", "Teknologi")
    - Status: "Rutin" atau "Tahunan"
    - Periode: (contoh: "Januari - Maret 2025")
4. Publish

#### Mengelola Event/Kegiatan

**Via Custom Post Type - Event:**

1. Dashboard > Event > Add New
2. Isi data:
    - Title: Nama Event
    - Content: Deskripsi event
    - Set Featured Image: Poster event
3. Isi Custom Fields:
    - Tanggal Event: (format: DD/MM/YYYY)
    - Waktu: (contoh: "09:00 - 12:00 WIB")
    - Lokasi: (contoh: "Auditorium Kampus")
    - Status: "Akan Datang", "Berlangsung", "Selesai"
    - Link Pendaftaran: (opsional)
4. Publish

**Event akan otomatis tersortir** berdasarkan tanggal.

---

### 4. Halaman Galeri

**Buat Halaman Baru:**

1. Pages > Add New
2. Title: "Galeri"
3. Template: `page-galeri.php`
4. Publish

#### Mengelola Foto Galeri

**Via Media Library:**

1. Media > Library > Add New
2. Upload foto (ukuran optimal: 1200x800px)
3. Untuk setiap foto, isi:
    - Title: Judul foto
    - Caption: Deskripsi singkat
    - Alt Text: Deskripsi untuk SEO
4. Foto akan otomatis muncul di galeri dengan **masonry layout**

**Fitur Galeri:**

-   ✅ Masonry grid responsif
-   ✅ Lightbox untuk preview fullscreen
-   ✅ Navigation prev/next di lightbox
-   ✅ Keyboard support (← → untuk navigasi, Esc untuk close)
-   ✅ Pagination otomatis (12 foto per halaman)

---

### 5. Halaman Arsip

**Buat Halaman Baru:**

1. Pages > Add New
2. Title: "Arsip"
3. Template: `page-arsip.php`
4. Publish

Halaman ini akan menampilkan:

-   Arsip berita berdasarkan bulan
-   Arsip program & kegiatan
-   Filter by kategori
-   Search functionality

---

### 6. Blog/Berita

#### Menulis Post Baru

1. Posts > Add New
2. Tulis judul dan konten
3. Format tulisan:
    - Gunakan **Heading 2** untuk sub-judul
    - Gunakan **Heading 3** untuk sub-sub-judul
    - Tambahkan gambar (Insert Media)
4. Set Featured Image (wajib)
5. Pilih Category:
    - Berita
    - Publikasi
    - Pengumuman
    - Artikel
6. Add Tags (opsional)
7. Excerpt: Tulis ringkasan singkat (maks 150 karakter)
8. Publish

#### Mengelola Kategori

1. Posts > Categories
2. Add New Category:
    - Name: Nama kategori
    - Slug: URL-friendly name
    - Description: Deskripsi kategori
3. Save

---

### 7. Menu Navigasi

#### Mengatur Menu Utama

1. Appearance > Menus
2. Create Menu: "Main Menu"
3. Add Items:
    - **Beranda** (Custom Link: `/`)
    - **Tentang HMTI** (Page: Tentang HMTI)
    - **Program & Kegiatan** (Page: Program & Kegiatan)
    - **Berita & Publikasi** (Category atau Custom Link)
    - **Galeri** (Page: Galeri)
    - **Kontak** (Custom Link atau Page)
4. Drag & drop untuk mengatur urutan
5. Enable submenu dengan drag ke kanan
6. Assign to Location: "Primary Menu"
7. Save Menu

#### Menu Footer

1. Appearance > Menus
2. Create Menu: "Footer Menu"
3. Add items (biasanya: Privacy Policy, Terms, Sitemap)
4. Assign to Location: "Footer Menu"
5. Save

---

### 8. Widget & Sidebar

#### Mengatur Widget

1. Appearance > Widgets
2. Available Widget Areas:
    - **Sidebar**: Sidebar untuk blog/post
    - **Footer 1, 2, 3**: 3 kolom footer
3. Drag widget yang diinginkan:
    - Search
    - Recent Posts
    - Categories
    - Tags Cloud
    - Custom HTML
4. Configure dan Save

---

## 🎨 Kustomisasi Tema

### 1. Mengubah Warna Tema

**Via CSS Variables (Recommended):**

```css
/* File: style.css (Sekitar baris 15-25) */

:root {
    /* Ubah warna sesuai keinginan */
    --primary-color: #3498db; /* Warna utama */
    --primary-dark: #2f7db2; /* Warna utama gelap */
    --secondary-color: #c9cc2e; /* Warna sekunder */
    --dark-bg: #222; /* Background gelap */
    --light-text: #f4f4f4; /* Teks terang */
    --dark-text: #333; /* Teks gelap */
}
```

**Via Tailwind Config:**

```javascript
// File: tailwind.config.js

module.exports = {
    theme: {
        extend: {
            colors: {
                primary: "#3498db",
                "primary-dark": "#2f7db2",
                secondary: "#c9cc2e",
                // Tambah warna custom lainnya
            },
        },
    },
};
```

**Setelah edit, compile CSS:**

```bash
npm run build:css
```

---

### 2. Mengubah Font

**Tambah Google Font:**

```php
// File: functions.php (Sekitar baris 30)

function hmti_enqueue_styles() {
    // Tambah Google Font
    wp_enqueue_style('google-fonts',
        'https://fonts.googleapis.com/css2?family=Font-Name:wght@400;500;700&display=swap'
    );
}
```

**Update CSS Variables:**

```css
/* File: style.css */

:root {
    --body-text: "Font Name", sans-serif;
    --title-text: "Font Name", serif;
}
```

---

### 3. Mengubah Logo & Favicon

#### Upload Logo

```php
// File: header.php (Sekitar baris 20-30)

// Ganti path logo:
<img src="<?php echo get_template_directory_uri(); ?>/assets/images/logo.png"
     alt="Logo HMTI">
```

**Via Customizer:**

1. Appearance > Customize > Site Identity
2. Upload Logo
3. Set Site Icon (Favicon)
4. Publish

#### Ukuran Logo Optimal

-   **Logo Header**: 200x60px (PNG dengan transparent background)
-   **Favicon**: 512x512px (PNG/ICO)

---

### 4. Mengatur Footer

```php
// File: footer.php (Sekitar baris 10-50)

// Edit informasi kontak:
<div class="footer-contact">
    <p>Email: hmti@example.com</p>
    <p>Telp: +62 xxx xxxx xxxx</p>
    <p>Alamat: Jl. Kampus No. 123</p>
</div>

// Edit social media:
<div class="social-links">
    <a href="https://instagram.com/hmti">Instagram</a>
    <a href="https://facebook.com/hmti">Facebook</a>
    <a href="https://twitter.com/hmti">Twitter</a>
    <a href="https://youtube.com/hmti">YouTube</a>
</div>

// Edit copyright:
<p>&copy; 2025 HMTI - Nama Universitas</p>
```

---

### 5. Menambah Custom CSS

**Via Customizer (Recommended):**

1. Appearance > Customize > Additional CSS
2. Tambahkan CSS custom Anda:

```css
/* Contoh: Ubah warna link */
a {
    color: #your-color;
}

/* Contoh: Custom button */
.custom-button {
    background: linear-gradient(to right, #3498db, #2f7db2);
    padding: 1rem 2rem;
    border-radius: 9999px;
}
```

3. Publish

**Via style.css:**

```css
/* File: style.css (di bagian bawah) */

/* ========== CUSTOM STYLES ========== */
.your-custom-class {
    /* Your styles here */
}
```

---

### 6. Tailwind CSS Utilities

#### Class Utilities Paling Sering Digunakan

**Layout:**

```html
<!-- Container -->
<div class="container mx-auto px-4 sm:px-6 lg:px-24">
    <!-- Flexbox -->
    <div class="flex items-center justify-center gap-4">
        <!-- Grid -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6"></div>
    </div>
</div>
```

**Typography:**

```html
<!-- Font -->
<p class="font-body font-medium text-base sm:text-lg">
    <!-- Title -->
</p>

<h1 class="font-title text-3xl sm:text-4xl lg:text-5xl font-bold"></h1>
```

**Spacing:**

```html
<!-- Padding -->
<div class="p-4 sm:p-6 lg:p-8">
    <!-- Margin -->
    <div class="mt-8 mb-12"></div>
</div>
```

**Colors:**

```html
<!-- Background -->
<div class="bg-primary hover:bg-primary-dark">
    <!-- Text -->
    <p class="text-white/80 hover:text-white"></p>
</div>
```

**Effects:**

```html
<!-- Gradient -->
<div class="bg-gradient-to-r from-primary to-primary-dark">
    <!-- Shadow -->
    <div class="shadow-lg hover:shadow-xl">
        <!-- Transition -->
        <button
            class="transition-all duration-300 transform hover:scale-105"
        ></button>
    </div>
</div>
```

---

## 🛠️ Pengembangan

### Development Workflow

#### 1. Setup Development Environment

```bash
# Clone/Download tema
cd /xampp/htdocs/wordpress/wp-content/themes/HMTI2025

# Install dependencies
npm install

# Start watch mode (auto-compile saat ada perubahan)
npm run watch:css
```

#### 2. Editing Styles

**Untuk Tailwind Classes:**

```html
<!-- Langsung gunakan utility classes di template -->
<div class="bg-primary text-white p-4 rounded-lg"></div>
```

**Untuk Custom CSS:**

```css
/* File: app.css (untuk Tailwind directives) */
@layer components {
    .custom-button {
        @apply bg-primary hover:bg-primary-dark px-6 py-3 rounded-full;
    }
}

/* File: style.css (untuk CSS biasa) */
.custom-class {
    /* Your custom CSS */
}
```

#### 3. Build untuk Production

```bash
# Build CSS (minified)
npm run build:css

# Pastikan tidak ada error
# Check file: assets/output.css
```

---

### Menambah Custom Post Type

```php
// File: functions.php (Sekitar baris 100+)

function hmti_register_custom_post_type() {
    // Contoh: Register "Prestasi"
    register_post_type('prestasi', array(
        'labels' => array(
            'name' => 'Prestasi',
            'singular_name' => 'Prestasi',
            'add_new' => 'Tambah Prestasi',
            'add_new_item' => 'Tambah Prestasi Baru',
            'edit_item' => 'Edit Prestasi',
            'view_item' => 'Lihat Prestasi',
        ),
        'public' => true,
        'has_archive' => true,
        'menu_icon' => 'dashicons-awards',
        'supports' => array('title', 'editor', 'thumbnail', 'excerpt'),
        'show_in_rest' => true, // Enable Gutenberg editor
    ));
}
add_action('init', 'hmti_register_custom_post_type');
```

---

### Menambah Custom Fields/Meta Box

**Menggunakan ACF (Advanced Custom Fields) Plugin:**

1. Install plugin ACF
2. Custom Fields > Add New
3. Buat field group (contoh: "Event Details")
4. Add Fields:
    - Tanggal Event (Date Picker)
    - Waktu (Text)
    - Lokasi (Text)
    - Link Pendaftaran (URL)
5. Location Rules: Post Type = Event
6. Publish

**Display di Template:**

```php
<?php if (function_exists('get_field')): ?>
    <p>Tanggal: <?php the_field('tanggal_event'); ?></p>
    <p>Waktu: <?php the_field('waktu'); ?></p>
    <p>Lokasi: <?php the_field('lokasi'); ?></p>
<?php endif; ?>
```

---

### Membuat Template Halaman Baru

```php
<?php
/**
 * Template Name: Nama Template Anda
 */

get_header();
?>

<!-- Your custom page content here -->
<section class="py-16 sm:py-20 lg:py-24">
    <div class="container mx-auto px-4 sm:px-6 lg:px-24">
        <h1><?php the_title(); ?></h1>
        <div><?php the_content(); ?></div>
    </div>
</section>

<?php
get_footer();
?>
```

**Cara Menggunakan:**

1. Simpan file dengan nama: `page-nama-template.php`
2. Buat page baru di WordPress
3. Pilih template di sidebar kanan: "Nama Template Anda"
4. Publish

---

### JavaScript Custom

```javascript
// File: assets/js/main.js

document.addEventListener("DOMContentLoaded", function () {
    // Contoh: Smooth scroll
    document.querySelectorAll('a[href^="#"]').forEach((anchor) => {
        anchor.addEventListener("click", function (e) {
            e.preventDefault();
            const target = document.querySelector(this.getAttribute("href"));
            if (target) {
                target.scrollIntoView({
                    behavior: "smooth",
                    block: "start",
                });
            }
        });
    });

    // Contoh: Toggle mobile menu
    const menuToggle = document.querySelector(".menu-toggle");
    const mobileMenu = document.querySelector(".mobile-menu");

    if (menuToggle) {
        menuToggle.addEventListener("click", function () {
            mobileMenu.classList.toggle("active");
        });
    }
});
```

**Enqueue JavaScript:**

```php
// File: functions.php

function hmti_enqueue_scripts() {
    wp_enqueue_script(
        'hmti-main-js',
        get_template_directory_uri() . '/assets/js/main.js',
        array('jquery'), // Dependencies
        '1.0.0',
        true // Load in footer
    );
}
add_action('wp_enqueue_scripts', 'hmti_enqueue_scripts');
```

---

### Optimasi Performance

#### 1. Image Optimization

```bash
# Install plugin untuk optimize gambar:
- Smush (Recommended)
- ShortPixel
- EWWW Image Optimizer
```

#### 2. Caching

```bash
# Install caching plugin:
- W3 Total Cache
- WP Super Cache
- LiteSpeed Cache
```

#### 3. Minify CSS/JS

```bash
# Via Plugin:
- Autoptimize
- WP Rocket (Premium)

# Via NPM (build process):
npm run build:css  # Already minified
```

#### 4. Lazy Loading

```html
<!-- Sudah built-in di WordPress 5.5+ -->
<img src="image.jpg" loading="lazy" alt="Description" />
```

---

## 🔧 Troubleshooting

### 1. CSS Tidak Berubah Setelah Edit

**Solusi:**

```bash
# 1. Clear browser cache (Ctrl + Shift + R)

# 2. Rebuild CSS
npm run build:css

# 3. Clear WordPress cache
# - Via Plugin (jika menggunakan caching plugin)
# - Atau hapus folder: /wp-content/cache/

# 4. Pastikan file output.css ter-update
# Check timestamp file: assets/output.css
```

---

### 2. Halaman 404 Tidak Muncul

**Solusi:**

```bash
# 1. Reset Permalink
# WordPress Admin > Settings > Permalinks
# Klik "Save Changes" tanpa mengubah apapun

# 2. Pastikan file 404.php ada
# Check: /wp-content/themes/HMTI2025/404.php

# 3. Clear .htaccess
# Backup dulu, lalu regenerate via Settings > Permalinks
```

---

### 3. Gambar Tidak Muncul

**Solusi:**

```php
// 1. Check path gambar
<?php echo get_template_directory_uri(); ?>/assets/images/logo.png

// 2. Pastikan file permissions correct
// Folder: 755
// Files: 644

// 3. Regenerate thumbnails
// Install plugin: Regenerate Thumbnails
```

---

### 4. Custom Post Type Tidak Muncul

**Solusi:**

```bash
# 1. Flush rewrite rules
# Buka: Settings > Permalinks
# Klik "Save Changes"

# 2. Check functions.php
# Pastikan function register_post_type() ada
# Dan dipanggil dengan add_action('init', ...)

# 3. Deactivate & Activate tema
```

---

### 5. JavaScript Tidak Berjalan

**Solusi:**

```javascript
// 1. Check console browser (F12)
// Lihat error messages

// 2. Pastikan jQuery loaded
// WordPress sudah include jQuery secara default

// 3. Wrap code dengan DOMContentLoaded
document.addEventListener("DOMContentLoaded", function () {
    // Your code here
});

// 4. Check enqueue di functions.php
// Pastikan script dienqueue dengan benar
```

---

### 6. Menu Tidak Muncul

**Solusi:**

```bash
# 1. Register menu location
# Check functions.php: register_nav_menus()

# 2. Assign menu ke location
# Appearance > Menus > Menu Settings
# Check "Primary Menu" atau location yang sesuai

# 3. Fallback menu
# Di header.php, tambahkan fallback pages:
wp_nav_menu(array(
    'theme_location' => 'primary',
    'fallback_cb' => 'wp_page_menu'
));
```

---

### 7. Error "npm command not found"

**Solusi:**

```bash
# 1. Install Node.js
# Download dari: https://nodejs.org/

# 2. Verify installation
node --version
npm --version

# 3. Install dependencies
cd /path/to/theme
npm install

# 4. Run build
npm run build:css
```

---

### 8. Animasi Tidak Berjalan

**Solusi:**

```javascript
// 1. Check Intersection Observer support
if ("IntersectionObserver" in window) {
    // Your animation code
} else {
    // Fallback atau load polyfill
}

// 2. Check class names
// Pastikan class yang di-observe benar
// Contoh: .greeting-item, .news-article-card

// 3. Clear cache dan reload
// Ctrl + Shift + R
```

---

## 📚 Best Practices

### 1. Content Management

-   ✅ Selalu set **Featured Image** untuk post/page
-   ✅ Gunakan **Alt Text** untuk semua gambar (SEO)
-   ✅ Tulis **Excerpt** untuk post (ringkasan)
-   ✅ Gunakan **Categories & Tags** dengan konsisten
-   ✅ Optimize ukuran gambar sebelum upload (max 500KB)

### 2. SEO

-   ✅ Install plugin: **Yoast SEO** atau **Rank Math**
-   ✅ Set **Title & Meta Description** untuk setiap halaman
-   ✅ Gunakan **Heading** secara hierarkis (H1 > H2 > H3)
-   ✅ Buat **XML Sitemap** (via plugin SEO)
-   ✅ Submit sitemap ke **Google Search Console**

### 3. Security

-   ✅ Update WordPress, tema, dan plugin secara berkala
-   ✅ Gunakan **strong password**
-   ✅ Install security plugin: **Wordfence** atau **Sucuri**
-   ✅ Backup website secara rutin (plugin: **UpdraftPlus**)
-   ✅ Gunakan **SSL Certificate** (HTTPS)

### 4. Performance

-   ✅ Optimize gambar (plugin: **Smush**)
-   ✅ Enable **caching** (plugin: **W3 Total Cache**)
-   ✅ Gunakan **CDN** untuk assets statis
-   ✅ Minify CSS/JS (plugin: **Autoptimize**)
-   ✅ Lazy load images (built-in WordPress)

### 5. Backup

```bash
# Backup files penting:
- /wp-content/themes/HMTI2025/
- /wp-content/uploads/
- /wp-config.php
- Database (export via phpMyAdmin)

# Backup plugins (Recommended):
- UpdraftPlus (Free)
- BackupBuddy (Premium)
- VaultPress (Jetpack Premium)
```

---

## 🆘 Support & Resources

### Documentation

-   📖 [WordPress Codex](https://codex.wordpress.org/)
-   📖 [Tailwind CSS Docs](https://tailwindcss.com/docs)
-   📖 [PHP Manual](https://www.php.net/manual/en/)

### Useful Plugins

-   🔌 **ACF** (Advanced Custom Fields) - Custom fields
-   🔌 **Yoast SEO** - SEO optimization
-   🔌 **Contact Form 7** - Contact forms
-   🔌 **Wordfence** - Security
-   🔌 **UpdraftPlus** - Backup
-   🔌 **Smush** - Image optimization
-   🔌 **W3 Total Cache** - Caching

### Community

-   💬 WordPress Support Forum
-   💬 Stack Overflow (tag: wordpress)
-   💬 GitHub Issues (untuk tema ini)

---

## 📝 Changelog

### Version 1.0.0 (2025-01-01)

-   ✅ Initial release
-   ✅ Responsive design dengan Tailwind CSS
-   ✅ Dark theme dengan gradient backgrounds
-   ✅ Scroll animations dengan Intersection Observer
-   ✅ Halaman beranda dengan hero & sections dinamis
-   ✅ Halaman tentang HMTI dengan struktur organisasi
-   ✅ Halaman program & kegiatan
-   ✅ Halaman galeri dengan masonry layout & lightbox
-   ✅ Custom 404 error page
-   ✅ Custom post types: Program, Event, Pengurus
-   ✅ Blog/news system
-   ✅ Search functionality

---

## 📄 License

Tema ini dibuat khusus untuk **Himpunan Mahasiswa Teknik Informatika**.
Silakan modify sesuai kebutuhan organisasi Anda.

---

## 👨‍💻 Credits

**Developed by:** HMTI Development Team
**Theme Version:** 1.0.0
**WordPress Version:** 5.0+
**Last Updated:** November 2025

---

## 📞 Contact

Jika ada pertanyaan atau butuh bantuan:

-   **Email:** hmti@example.com
-   **Website:** https://hmti.example.com
-   **Instagram:** @hmti_official

---

**Selamat mengelola website HMTI Anda! 🎓🚀**

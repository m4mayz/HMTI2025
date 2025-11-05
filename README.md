# HMTI 2025 WordPress Theme

Theme WordPress untuk website Himpunan Mahasiswa Teknik Informatika menggunakan Tailwind CSS dan DaisyUI.

## Teknologi

-   **Tailwind CSS v4** - Utility-first CSS framework
-   **DaisyUI** - Component library untuk Tailwind CSS
-   **WordPress** - CMS

## Setup Development

### 1. Install Dependencies

```bash
npm install
```

### 2. Build Tailwind CSS

```bash
npm run build:css
```

### 3. Watch Mode (Development)

Untuk auto-compile saat file berubah:

```bash
npm run watch:css
```

## Custom Post Types

### Pengurus HMTI

-   Nama (Title)
-   Jabatan (Meta Box)
-   Urutan Tampilan (Meta Box)
-   Foto (Featured Image)

### Visi & Misi

-   Visi (Textarea)
-   Misi (Textarea - satu baris per item)

## Template Pages

### home.php - Berita & Publikasi

Halaman blog/archive yang menampilkan postingan dengan fitur:

-   **Search Bar dengan Filter Kategori** - Cari postingan berdasarkan keyword dan kategori
-   **Section Postingan Terbaru** - Menampilkan 4 postingan terbaru (layout grid dengan highlight post pertama)
-   **Section Berdasarkan Kategori** - Menampilkan 3 postingan terbaru dari setiap kategori (Berita, Artikel, Informasi, Prestasi)

#### Kategori yang Didukung:

-   Berita
-   Artikel
-   Informasi
-   Prestasi

#### Catatan:

-   Pastikan sudah membuat kategori di WordPress (Posts > Categories)
-   Featured Image diperlukan untuk tampilan optimal
-   Jika tidak ada featured image, akan menampilkan `assets/images/placeholder.png`

## Tailwind Configuration

File konfigurasi: `tailwind.config.js`

### Custom Colors

-   `primary`: #3498db
-   `primary-dark`: #2f7db2
-   `secondary`: #c9cc2e
-   `secondary-dark`: #b0b32e
-   `dark-bg`: #222

### Custom Fonts

-   `font-body`: Darker Grotesque
-   `font-title`: Cormorant Garamond

## DaisyUI Theme

Theme custom "hmti" sudah dikonfigurasi di `tailwind.config.js`

## Build untuk Production

```bash
npm run build
```

## File Structure

```
HMTI2025/
├── app.css              # Input Tailwind CSS
├── assets/
│   ├── output.css       # Compiled Tailwind CSS
│   ├── js/
│   └── images/
├── inc/
│   └── customizer.php   # WordPress Customizer
├── functions.php        # Theme functions
├── style.css            # WordPress theme stylesheet (custom CSS)
├── tailwind.config.js   # Tailwind configuration
├── postcss.config.js    # PostCSS configuration
└── package.json         # NPM dependencies
```

## Penggunaan Tailwind & DaisyUI

Gunakan class Tailwind dan DaisyUI langsung di file PHP:

```php
<div class="container mx-auto px-4">
    <h1 class="text-4xl font-title text-primary">Hello World</h1>
    <button class="btn btn-primary">Click Me</button>
</div>
```

## WordPress Customizer

Akses di: **Appearance > Customize**

-   Hero Section (Background Image)
-   Greeting Section (Sambutan Pembina & Ketua)

## Notes

-   Setiap perubahan di `app.css` atau file PHP memerlukan rebuild: `npm run build:css`
-   Gunakan `npm run watch:css` saat development untuk auto-compile
-   File `assets/output.css` adalah hasil compile, jangan edit manual

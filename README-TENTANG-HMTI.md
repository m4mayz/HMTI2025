# Halaman Tentang HMTI - Dokumentasi

## Overview
Halaman Tentang HMTI telah dibuat ulang dengan gaya dan style yang konsisten dengan homepage, menggunakan design system yang sama.

## Struktur Halaman

### 1. **Hero Section**
- Background image dengan overlay gelap
- Judul besar "Tentang HMTI" dengan highlight warna primary
- Subtitle deskriptif
- Full-width responsive layout

**Customizer Setting:**
- `about_hero_background_image` - Upload gambar background untuk hero section

### 2. **Sejarah HMTI**
- Layout grid 2 kolom (text + image)
- Background putih dengan shadow cards
- Responsive: menjadi 1 kolom di mobile

**Customizer Settings:**
- `sejarah_hmti_text` - Cerita singkat berdirinya HMTI (textarea)
- `sejarah_hmti_image` - Gambar sejarah/dokumentasi (image upload)

### 3. **Visi & Misi**
- Background gelap (`#222`) dengan decorative elements
- 2 kartu dengan icon SVG
- Glassmorphism effect dengan hover animation

**Customizer Settings:**
- `visi_hmti` - Visi HMTI (textarea)
- `misi_hmti` - Misi HMTI (textarea, bisa menggunakan numbered list)

### 4. **Struktur Organisasi**
- **Periode Kepengurusan** - Display di subtitle
- **Top Structure:** Pembina, Ketua, Wakil Ketua
- **Middle Structure:** Sekretaris, Bendahara
- **Division Structure:** 6 Kepala Divisi

Setiap card menampilkan:
- Foto (bulat dengan border)
- Jabatan
- Nama

**Customizer Settings:**
- `periode_kepengurusan` - Periode (contoh: 2024-2025)
- `struktur_pembina_name` & `struktur_pembina_photo`
- `struktur_ketua_name` & `struktur_ketua_photo`
- `struktur_wakil_name` & `struktur_wakil_photo`
- `struktur_sekretaris_name` & `struktur_sekretaris_photo`
- `struktur_bendahara_name` & `struktur_bendahara_photo`
- Loop 1-6: `divisi_{i}_name`, `divisi_{i}_ketua`, `divisi_{i}_photo`

### 5. **Divisi & Departemen**
- Background gradient dark (`#1a1a1a` - `#222`)
- Grid layout dengan cards glassmorphism
- Setiap card memiliki:
  - Icon/logo divisi
  - Nama divisi
  - Deskripsi singkat
  - Link "Lihat Detail" ke halaman detail divisi

**Customizer Settings untuk setiap divisi (1-6):**
- `divisi_{i}_name` - Nama divisi
- `divisi_{i}_description` - Deskripsi divisi
- `divisi_{i}_icon` - Icon divisi (image upload)
- `divisi_{i}_ketua` - Nama ketua divisi
- `divisi_{i}_photo` - Foto ketua divisi
- `divisi_{i}_anggota` - Daftar anggota (satu nama per baris)
- `divisi_{i}_proker` - Program kerja (satu program per baris)

---

## Halaman Detail Divisi

### Template: `page-divisi.php`
Template khusus untuk menampilkan detail setiap divisi.

### URL Structure:
- `/divisi/nama-divisi` (contoh: `/divisi/kominfo`)

### Sections:

#### 1. **Hero Section**
- Background gradient dark
- Icon divisi besar
- Nama divisi
- Deskripsi divisi
- Tombol "Kembali ke Tentang HMTI"

#### 2. **Kepala Divisi**
- Card dengan foto kepala divisi
- Nama dan jabatan
- Border top warna secondary

#### 3. **Anggota Divisi**
- Background dark dengan decorative elements
- Grid layout member cards
- Avatar icon placeholder
- Nama anggota

#### 4. **Program Kerja**
- Background putih
- List item dengan:
  - Nomor urut besar
  - Nama program kerja
  - Hover effect dengan translate

#### 5. **CTA Section**
- Ajakan bergabung
- Tombol "Hubungi Kami" menuju halaman kontak

---

## Cara Mengisi Konten

### Via WordPress Customizer (Appearance > Customize)

1. **Panel: Pengaturan Halaman Depan**
   - Section: Hero Section
     - Upload background image

2. **Panel: Pengaturan Tentang HMTI**
   - Section: Hero Section - Tentang HMTI
     - Upload background image untuk halaman About
   
   - Section: Sejarah HMTI
     - Isi teks sejarah
     - Upload gambar
   
   - Section: Visi & Misi
     - Isi visi (1 paragraf)
     - Isi misi (bisa numbered list)
   
   - Section: Struktur Organisasi
     - Isi periode (contoh: 2024-2025)
     - Upload foto dan isi nama untuk setiap jabatan
   
   - Section: Divisi / Departemen
     - Untuk setiap divisi (1-6):
       - Nama divisi
       - Ketua divisi
       - Upload foto ketua
       - Deskripsi divisi
       - Upload icon divisi
       - Daftar anggota (satu per baris)
       - Daftar program kerja (satu per baris)

### Contoh Pengisian Anggota Divisi:
```
Ahmad Fauzi
Siti Nurhaliza
Budi Santoso
Rina Maharani
```

### Contoh Pengisian Program Kerja:
```
Pelatihan Web Development
Workshop Digital Marketing
Seminar Teknologi AI
Lomba Coding Competition
```

---

## Design System

### Colors:
- **Primary:** `#3498db` (Blue)
- **Secondary:** `#c9cc2e` (Yellow-Green)
- **Dark:** `#222`
- **Font Color:** `#333`

### Typography:
- **Body:** Darker Grotesque
- **Heading:** Cormorant Garamond

### Responsive Breakpoints:
- Desktop: > 985px
- Tablet: 768px - 985px
- Mobile: < 768px
- Small Mobile: < 480px

### Common Effects:
- Hover: `translateY(-5px)` atau `translateY(-10px)`
- Box Shadow: `0 5px 20px rgba(0,0,0,0.05)` → `0 10px 30px rgba(0,0,0,0.1)`
- Glassmorphism: `rgba(255,255,255,0.05)` dengan `backdrop-filter: blur(10px)`

---

## File-file yang Dibuat/Dimodifikasi

### Dibuat Baru:
1. **`page-divisi.php`** - Template untuk halaman detail divisi
2. **`README-TENTANG-HMTI.md`** - Dokumentasi ini

### Dimodifikasi:
1. **`page-tentang-hmti.php`** - Template halaman Tentang HMTI
2. **`style.css`** - Tambahan CSS untuk:
   - Hero Section About
   - Sejarah Section (updated)
   - Divisi Detail Page (full styling)
   - Responsive design untuk semua section
3. **`inc/customizer.php`** - Tambahan settings:
   - `divisi_{i}_anggota` (textarea)
   - `divisi_{i}_proker` (textarea)

---

## Notes & Tips

1. **Foto Rekomendasi:**
   - Hero Background: 1920x1080px (landscape)
   - Foto Anggota: 500x500px (square)
   - Icon Divisi: 200x200px (square, PNG dengan background transparan)

2. **Format Teks:**
   - Sejarah: 2-3 paragraf, maksimal 500 kata
   - Visi: 1 paragraf, maksimal 100 kata
   - Misi: 3-5 poin
   - Deskripsi Divisi: 1-2 kalimat, maksimal 100 kata
   - Program Kerja: Nama singkat, maksimal 10 kata per item

3. **Best Practices:**
   - Gunakan foto dengan kualitas tinggi
   - Pastikan semua teks sudah diproofread
   - Isi semua field untuk tampilan optimal
   - Test tampilan di mobile setelah mengisi content

---

## Troubleshooting

### Link "Lihat Detail" tidak berfungsi?
Pastikan ada page dengan template "Halaman Divisi" dan slug sesuai nama divisi.

### Gambar tidak muncul?
Cek path gambar di customizer, pastikan sudah di-upload dengan benar.

### Anggota/Program Kerja tidak muncul?
Pastikan format pengisian: satu item per baris (tekan Enter untuk baris baru).

---

## Future Enhancements (Optional)

- [ ] Custom post type untuk divisi (untuk manajemen lebih mudah)
- [ ] Gallery per divisi
- [ ] Search/filter divisi
- [ ] Testimonial dari anggota
- [ ] Achievement/awards section
- [ ] Timeline sejarah interaktif
- [ ] Org chart visualizer

---

Dibuat oleh: AI Assistant untuk HMTI 2025 Theme
Tanggal: 2025-10-30

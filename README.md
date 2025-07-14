# 📚 Sistem Informasi Perpustakaan SMP Negeri 3 Karanglewas

Sistem Informasi Perpustakaan ini dibangun menggunakan **PHP** dengan **framework Laravel** dan tampilan antarmuka berbasis **Bootstrap 5**. Aplikasi ini membantu pengelolaan data buku, anggota, peminjaman, pengembalian, serta denda secara efisien dan modern.

## ✨ Fitur Utama

- 🔐 **Autentikasi User**
  - Login & Register
  - Hak akses user
- 📖 **Manajemen Buku**
  - Tambah, edit, hapus buku
  - Kategori dan rak buku
- 👤 **Manajemen Anggota**
  - Registrasi anggota
  - Pencarian data anggota
- 🔄 **Peminjaman & Pengembalian**
  - Riwayat pinjam dan kembalikan
  - Kalkulasi otomatis keterlambatan
- 💰 **Pengelolaan Denda**
  - Perhitungan denda otomatis
  - Laporan denda per periode
- 📊 **Laporan**
  - Filter laporan berdasarkan hari/bulan/tahun
- 🎨 **Antarmuka Responsive**
  - Menggunakan Bootstrap 5
  - Desain sederhana dan mudah digunakan

## 🛠️ Teknologi yang Digunakan

| Teknologi      | Keterangan                      |
|----------------|----------------------------------|
| PHP            | Bahasa pemrograman utama        |
| Laravel        | Framework backend (v10+)        |
| MySQL          | Database                        |
| Bootstrap 5    | Frontend UI Framework           |
| SweetAlert2    | Notifikasi interaktif           |


## ⚙️ Cara Menjalankan

1. **Clone repository**
   ```bash
   git clone https://github.com/byanscool89/Perpustakaan.git
   cd Perpustakaan
composer install
npm install && npm run dev

cp .env.example .env
php artisan key:generate
php artisan migrate --seed
php artisan serve


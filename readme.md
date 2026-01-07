# 🏫 Sistem Informasi Inventaris Sekolah (SD)

![Project Status](https://img.shields.io/badge/status-active-green)
![PHP Version](https://img.shields.io/badge/php-%3E%3D%207.4-blue)
![License](https://img.shields.io/badge/license-MIT-blue)

Aplikasi manajemen aset dan inventaris sekolah berbasis web yang dibangun dengan **PHP Native** dan antarmuka modern menggunakan **Tailwind CSS**. Proyek ini memudahkan pencatatan aset, monitoring kondisi barang (Baik/Rusak), dan pembuatan laporan untuk Sekolah Dasar (SD).

## ✨ Fitur Utama

- **Staf Tata Usaha (Admin):** Dashboard statistik, manajemen aset (tambah/edit), upload foto, update kondisi barang, dan cetak laporan.
- **Kepala Sekolah (Supervisor):** Monitoring aset, validasi & penghapusan aset rusak, serta akses pencetakan laporan.

## 🛠️ Teknologi

- **Backend:** PHP Native (procedural)
- **Database:** MySQL / MariaDB
- **Frontend:** HTML5, Tailwind CSS (CDN)
- **Icons:** Remix Icon (CDN)
- **Printing:** Browser `window.print`

## 📂 Struktur Folder (ringkasan)

```text
/
├── config/          # Koneksi Database
├── fungsi/          # Logic PHP (CRUD, Auth, Upload)
├── komponen/        # Komponen UI (Sidebar, Header)
├── staf/            # Halaman khusus Staf TU
├── kepsek/          # Halaman khusus Kepala Sekolah
├── uploads/         # Penyimpanan gambar aset
└── index.php        # Halaman Login
```

## 🚀 Cara Instalasi

1. Salin/clone repository ke folder server lokal (contoh: `htdocs` pada XAMPP atau `www` pada Laragon).
2. Buka phpMyAdmin dan buat database baru bernama `inventaris_sd`.
3. Import file `inventaris_sd.sql` yang ada di root proyek.
4. Sesuaikan koneksi database di `config/database.php`. Contoh konfigurasi:

```php
$host = "localhost";
$user = "root";
$pass = "";
$db   = "inventaris_sd";
```

5. Akses aplikasi melalui browser: `http://localhost/inventaris_sd`

## 🔐 Akun Demo

| Role | Username | Password |
|------|----------:|:--------:|
| Staf TU | `admin` | `123` |
| Kepala Sekolah | `kepsek` | `123` |

> Catatan: Username/password bisa berbeda jika sudah diubah pada instalasi Anda.


---
Made with ❤️ by eRiez41
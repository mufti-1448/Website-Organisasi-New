# 🌐 Website Organisasi Sekolah

[![Laravel](https://img.shields.io/badge/Laravel-12.0-red.svg)](https://laravel.com)
[![PHP](https://img.shields.io/badge/PHP-8.2+-blue.svg)](https://php.net)
[![SQLite](https://img.shields.io/badge/SQLite-3-green.svg)](https://www.sqlite.org)
[![Bootstrap](https://img.shields.io/badge/Bootstrap-5.3-purple.svg)](https://getbootstrap.com)
[![License](https://img.shields.io/badge/License-MIT-yellow.svg)](LICENSE)

## 🇮🇩 Tentang Proyek
Website Organisasi Sekolah adalah aplikasi berbasis web yang dibuat sebagai **tugas Ujian Kompetensi Keahlian (UKK)**  
Jurusan **Rekayasa Perangkat Lunak (RPL)**.

Website ini digunakan untuk menampilkan informasi organisasi seperti anggota, rapat, program kerja, notulen, dan evaluasi kegiatan.  
Sistem memiliki **dua peran utama**, yaitu **Admin** dan **User (Publik)**.

## 🇬🇧 About the Project
This School Organization Website is a web-based application developed as part of the **Vocational Skill Competency Exam (UKK)**  
for the **Software Engineering (RPL)** major.

The website displays organizational information such as members, meetings, work programs, minutes, and evaluations.  
The system supports **two main roles**: **Admin** and **Public User**.

---

## 📋 Daftar Isi
- [Fitur Utama](#-fitur-utama)
- [Tech Stack](#-tech-stack)
- [Prerequisites](#-prerequisites)
- [Instalasi](#-instalasi)
- [Menjalankan Aplikasi](#-menjalankan-aplikasi)
- [Testing](#-testing)
- [Screenshots](#-screenshots)
- [Kontribusi](#-kontribusi)
- [Lisensi](#-lisensi)
- [Pengembang](#-pengembang)

## ✨ Fitur Utama | Key Features

### 👨‍💼 Admin
- Login & autentikasi admin
- Dashboard admin
- CRUD Anggota Organisasi
- CRUD Rapat
- CRUD Program Kerja
- CRUD Notulen
- CRUD Evaluasi
- Export laporan (PDF / Excel)

### 👥 User (Publik)
- Melihat profil organisasi
- Melihat anggota
- Melihat rapat, program kerja, notulen, dan evaluasi
- Tidak memerlukan login (read-only)

---

## 🛠️ Tech Stack
- **Backend**: Laravel 12
- **Frontend**: Blade Template + Bootstrap 5
- **Database**: SQLite
- **Language**: PHP 8.2, HTML, CSS, JavaScript

---
## 📋 Prerequisites
Sebelum menjalankan proyek ini, pastikan Anda memiliki:
- **PHP** >= 8.2
- **Composer** (untuk dependency management)
- **Node.js** & **npm** (opsional, untuk frontend assets)
- **Git** (untuk cloning repository)

## 🚀 Instalasi

### 1. Clone Repository
```bash
git clone https://github.com/mufti-1448/Website-Organisasi.git
cd Website-Organisasi
```

### 2. Install Dependencies
```bash
composer install
npm install  # opsional, jika menggunakan npm untuk Bootstrap
```

### 3. Setup Environment
Salin file `.env.example` menjadi `.env`:
```bash
cp .env.example .env
```

Ubah konfigurasi database di `.env` agar menggunakan SQLite:
```env
DB_CONNECTION=sqlite
DB_DATABASE=database/database.sqlite
```

Buat file kosong untuk database:
```bash
touch database/database.sqlite
```

### 4. Generate Application Key
```bash
php artisan key:generate
```

### 5. Migrasi Database
```bash
php artisan migrate
```

## ▶️ Menjalankan Aplikasi
```bash
php artisan serve
```

Akses website di:  
👉 [http://127.0.0.1:8000](http://127.0.0.1:8000)

Untuk development dengan hot reload:
```bash
npm run dev
```

## 🧪 Testing
Jalankan test suite dengan:
```bash
php artisan test
```

## 📸 Screenshots
*(Tambahkan screenshots aplikasi di sini)*

## 🤝 Kontribusi
Kontribusi sangat diterima! Silakan fork repository ini dan buat pull request untuk perubahan yang Anda usulkan.

1. Fork proyek
2. Buat branch fitur (`git checkout -b feature/AmazingFeature`)
3. Commit perubahan (`git commit -m 'Add some AmazingFeature'`)
4. Push ke branch (`git push origin feature/AmazingFeature`)
5. Buat Pull Request

## 📄 Lisensi
Proyek ini menggunakan lisensi MIT. Lihat file [LICENSE](LICENSE) untuk detail lebih lanjut.

## 👨‍💻 Pengembang
Dibuat oleh **M. Khafidhin Mufti Ali**  
Jurusan **Rekayasa Perangkat Lunak (RPL)**  
Sebagai tugas **Ujian Kompetensi Keahlian (UKK)** Tahun 2025-2026.

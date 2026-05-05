# IT Tangcity — Remake Web

![Laravel](https://img.shields.io/badge/Laravel-13-FF2D20?style=flat&logo=laravel&logoColor=white)
![PHP](https://img.shields.io/badge/PHP-8.4-777BB4?style=flat&logo=php&logoColor=white)
![TailwindCSS](https://img.shields.io/badge/TailwindCSS-4-06B6D4?style=flat&logo=tailwindcss&logoColor=white)
![Alpine.js](https://img.shields.io/badge/Alpine.js-3-8BC0D0?style=flat&logo=alpinedotjs&logoColor=white)
![License](https://img.shields.io/badge/License-MIT-green?style=flat)

Remake lengkap website **IT Tangcity** ([tangcity.cloud](https://tangcity.cloud/)) yang sebelumnya dibangun di atas WordPress. Proyek ini memigrasikan seluruh fitur ke tumpukan modern berbasis **Laravel 13**, menghadirkan performa lebih cepat, keamanan lebih baik, dan kemudahan pengelolaan konten melalui panel admin yang dibangun dari nol.

---

## Tentang Proyek

IT Tangcity adalah website resmi divisi IT yang menyediakan informasi, artikel teknologi, serta direktori kontak dan email staf. Website lama menggunakan WordPress dengan berbagai plugin pihak ketiga yang menyulitkan kustomisasi dan perawatan jangka panjang.

Proyek remake ini bertujuan:
- Mengganti WordPress dengan aplikasi Laravel yang sepenuhnya dikustomisasi
- Memberikan tampilan modern, cepat, dan responsif di semua perangkat
- Menyediakan panel admin yang lengkap dan berbasis role/permission
- Meningkatkan keamanan dengan sistem autentikasi dan otorisasi bawaan Laravel

---

## Fitur Utama

### Halaman Publik
| Halaman | Deskripsi |
|---|---|
| **Beranda** | Halaman utama dengan informasi divisi IT, layanan, dan artikel terbaru |
| **Artikel** | Daftar artikel teknologi dengan filter kategori, pencarian, dan pagination |
| **Detail Artikel** | Konten artikel lengkap dengan sistem komentar pembaca |
| **Daftar Email Staff** | Direktori email seluruh staf divisi IT |
| **Email Workspace** | Daftar staf yang memiliki akun Google Workspace |
| **Mailing List** | Halaman daftar mailing list yang tersedia |
| **Formulir Kontak** | Form pengiriman pesan dengan rate limiting untuk mencegah spam |

### Panel Admin (`/admin`)
| Menu | Fitur |
|---|---|
| **Dashboard** | Statistik artikel, komentar, pesan masuk, notifikasi real-time |
| **Artikel** | CRUD artikel dengan rich text editor (Quill.js), upload gambar sampul, kategori, tag, status draft/publish |
| **Kategori** | Kelola kategori artikel |
| **Komentar** | Moderasi komentar pembaca |
| **Pesan Masuk** | Baca dan kelola pesan dari formulir kontak |
| **Mailing List** | Kelola data mailing list |
| **Email Staff** | Kelola data email staf |
| **Email Workspace** | Lihat daftar staf Google Workspace |
| **Pengguna** | Manajemen akun pengguna, persetujuan pendaftaran, aktifkan/nonaktifkan akun |
| **Role** | Kelola peran (staff, editor, admin, super-admin) |
| **Permission** | Kelola hak akses per role secara granular |
| **Blokir Login** | Monitor dan buka blokir IP/email yang terkunci akibat terlalu banyak percobaan login gagal |
| **Log Aktivitas** | Riwayat lengkap seluruh aktivitas di sistem (siapa melakukan apa dan kapan) |
| **Profil** | Edit profil, ubah password, hapus akun |

### Keamanan
- Autentikasi berbasis Laravel Breeze (email + password)
- Role-based access control menggunakan **Spatie Laravel Permission**
- Rate limiting pada login, formulir kontak, dan komentar
- Proteksi brute-force login dengan auto-block setelah beberapa percobaan gagal
- Activity logging otomatis pada semua operasi CRUD (Spatie Activity Log v5)
- Login gagal dicatat lengkap dengan IP, user-agent, dan alasan gagal
- Purifikasi konten HTML dengan `mews/purifier` untuk mencegah XSS

---

## Tumpukan Teknologi

| Kategori | Teknologi |
|---|---|
| **Backend** | PHP 8.4, Laravel 13 |
| **Frontend** | Blade, Tailwind CSS v4, Alpine.js v3 |
| **Build Tool** | Vite 8 |
| **Database** | MySQL |
| **Rich Text Editor** | Quill.js |
| **Chart** | Chart.js |
| **Animasi** | AOS (Animate On Scroll) |
| **Permission** | spatie/laravel-permission v7 |
| **Activity Log** | spatie/laravel-activitylog v5 |
| **HTML Purifier** | mews/purifier |
| **Testing** | Pest v4 |
| **Code Formatter** | Laravel Pint |

---

## Instalasi

### Prasyarat
- PHP >= 8.4
- Composer
- Node.js >= 20 & npm
- MySQL

### Langkah Instalasi

```bash
# 1. Clone repositori
git clone https://github.com/username/remake-web-it.git
cd remake-web-it

# 2. Install dependensi PHP
composer install

# 3. Salin file environment
cp .env.example .env

# 4. Generate application key
php artisan key:generate

# 5. Konfigurasi database di .env
# DB_DATABASE=website-it
# DB_USERNAME=root
# DB_PASSWORD=

# 6. Jalankan migrasi dan seeder
php artisan migrate --seed

# 7. Install dependensi frontend dan build aset
npm install
npm run build
```

Atau gunakan shortcut setup yang sudah dikonfigurasi:

```bash
composer run setup
```

### Menjalankan Server Lokal

```bash
# Jalankan semua sekaligus (server, queue, vite dev)
composer run dev
```

---

## Role & Permission

| Role | Akses |
|---|---|
| `super-admin` | Akses penuh ke seluruh sistem |
| `admin` | Semua fitur kecuali manajemen pengguna, role, dan permission |
| `editor` | Kelola artikel, kategori, komentar |
| `staff` | Akses baca artikel, komentar, dan konten dasar |

---

## Testing

Proyek ini menggunakan **Pest v4** dengan database MySQL terpisah (`website_it_test`).

```bash
# Jalankan seluruh test
php artisan test --compact

# Jalankan test tertentu
php artisan test --compact --filter=NamaTest
```

---

## Struktur Direktori Utama

```
app/
├── Http/Controllers/
│   ├── Admin/          # Controller panel admin
│   └── Auth/           # Autentikasi
├── Models/             # Eloquent models
└── Providers/

resources/views/
├── admin/              # Tampilan panel admin
├── articles/           # Tampilan halaman artikel publik
├── home.blade.php      # Halaman beranda
└── layouts/            # Layout utama

routes/
├── web.php             # Rute web (publik + admin)
└── auth.php            # Rute autentikasi

database/
├── migrations/
└── seeders/
    └── RolesAndPermissionsSeeder.php
```

---

## Lisensi

Proyek ini dilisensikan di bawah [MIT License](LICENSE).

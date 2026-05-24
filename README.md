# Yuk Ngoding

Website layanan jasa pembuatan proyek web & mobile. Dibangun dengan Laravel 13, Livewire 4, Flux UI, dan Tailwind CSS v4.

## Fitur

- **Landing Page** — Hero section, content band, alur pengerjaan, dan form kontak
- **Form Kontak** — Pengunjung dapat mengirim brief/pesan dengan validasi nomor WhatsApp atau email
- **Contact Inbox** — Dashboard admin untuk melihat, mencari, dan menghapus pesan masuk
- **Multi-bahasa** — Dukungan bahasa Indonesia dan Inggris dengan language switcher
- **Dark Mode** — Tema gelap/terang otomatis sesuai preferensi sistem
- **Animasi** — Transisi dan scroll animation menggunakan GSAP & Alpine.js
- **Autentikasi** — Login admin menggunakan WorkOS

## Tech Stack

| Layer      | Teknologi                          |
| ---------- | ---------------------------------- |
| Backend    | PHP 8.3+, Laravel 13               |
| Frontend   | Livewire 4, Flux UI 2, Alpine.js 3 |
| Styling    | Tailwind CSS v4                    |
| Build Tool | Vite 8                             |
| Auth       | WorkOS                             |
| Testing    | Pest 4                             |

## Prasyarat

- PHP >= 8.3
- Composer
- Node.js & npm
- Database (MySQL / SQLite)
- Akun [WorkOS](https://workos.com) untuk autentikasi admin

## Instalasi

```bash
# 1. Clone repositori
git clone <url-repo> yuk-ngoding
cd yuk-ngoding

# 2. Install dependensi PHP
composer install

# 3. Salin file environment
cp .env.example .env

# 4. Generate application key
php artisan key:generate

# 5. Konfigurasi database di .env, lalu jalankan migrasi
php artisan migrate

# 6. Install dependensi Node & build aset
npm install
npm run build
```

### Konfigurasi WorkOS

Tambahkan kredensial WorkOS di file `.env`:

```env
WORKOS_CLIENT_ID=your_client_id
WORKOS_API_KEY=your_api_key
WORKOS_REDIRECT_URL="${APP_URL}/authenticate"
```

## Menjalankan Aplikasi

```bash
# Development (jalankan server & Vite secara bersamaan)
composer run dev

# Atau secara terpisah
php artisan serve
npm run dev
```

Aplikasi akan tersedia di `http://localhost:8000`.

## Struktur Halaman

| URL                     | Deskripsi                     |
| ----------------------- | ----------------------------- |
| `/`                     | Landing page publik           |
| `/contacts`             | POST — kirim brief/pesan baru |
| `/language/{locale}`    | Ganti bahasa (`en` / `id`)    |
| `/dashboard`            | Dashboard admin (perlu login) |
| `/contacts` (GET, auth) | Inbox pesan masuk             |

## Menjalankan Test

```bash
php artisan test
# atau
./vendor/bin/pest
```

## Lisensi

Proyek ini dilisensikan di bawah [MIT License](LICENSE).

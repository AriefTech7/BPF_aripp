# BPF Aripp

Aplikasi web Laravel untuk praktik **form dan validasi** serta **manajemen data pelanggan**. Aplikasi menyediakan halaman form pertanyaan dan dashboard admin dengan fitur CRUD pelanggan.

## Fitur

- Menampilkan halaman beranda dengan data pengguna contoh dan pilihan jenjang pendidikan.
- Mengirim form pertanyaan dengan validasi nama, email, dan isi pertanyaan.
- Menampilkan respons dari form pertanyaan.
- Dashboard admin.
- CRUD data pelanggan: tambah, lihat daftar, ubah, dan hapus data.
- Validasi data pelanggan sebelum disimpan atau diperbarui.

## Teknologi

- PHP 8.3 atau lebih baru
- Laravel 13
- Eloquent ORM dan Laravel Migration
- Blade Template
- Bootstrap 5 dan aset dashboard Volt
- Vite dan Tailwind CSS

## Struktur Data Pelanggan

Data pelanggan disimpan pada tabel `pelanggan` dengan kolom berikut:

| Kolom | Keterangan |
| --- | --- |
| `pelanggan_id` | ID utama pelanggan |
| `first_name` | Nama depan |
| `last_name` | Nama belakang |
| `birthday` | Tanggal lahir |
| `gender` | Jenis kelamin |
| `email` | Email unik pelanggan |
| `phone` | Nomor telepon |
| `created_at`, `updated_at` | Waktu pencatatan data |

## Instalasi

Pastikan PHP, Composer, Node.js, dan npm telah tersedia.

```bash
git clone <url-repositori>
cd BPF_aripp
composer install
npm install
```

Buat file konfigurasi lingkungan dan aplikasi key:

```bash
cp .env.example .env
php artisan key:generate
```

Atur koneksi database pada file `.env`, lalu jalankan migrasi:

```bash
php artisan migrate
```

Jalankan aplikasi dan Vite secara terpisah:

```bash
php artisan serve
npm run dev
```

Aplikasi dapat diakses melalui alamat yang ditampilkan oleh `php artisan serve`, umumnya `http://127.0.0.1:8000`.

## Rute Utama

| URL | Method | Keterangan |
| --- | --- | --- |
| `/home` | GET | Halaman form pertanyaan |
| `/question/store` | POST | Memproses form pertanyaan |
| `/dashboard` | GET | Dashboard admin |
| `/pelanggan` | GET | Daftar pelanggan |
| `/pelanggan/create` | GET | Form tambah pelanggan |
| `/pelanggan` | POST | Menyimpan pelanggan baru |
| `/pelanggan/{id}/edit` | GET | Form ubah pelanggan |
| `/pelanggan/{id}` | PUT/PATCH | Memperbarui pelanggan |
| `/pelanggan/{id}` | DELETE | Menghapus pelanggan |

## Validasi

### Form pertanyaan

- Nama wajib diisi, maksimal 10 karakter.
- Email wajib diisi dan harus berformat email.
- Pertanyaan wajib diisi, minimal 8 dan maksimal 300 karakter.

### Data pelanggan

- Nama depan dan nama belakang wajib diisi.
- Tanggal lahir harus berupa tanggal valid.
- Jenis kelamin hanya `Male` atau `Female`.
- Email harus valid.
- Nomor telepon harus berupa angka.

## Pengujian

Jalankan pengujian dengan perintah berikut:

```bash
composer test
```

# Debugging (Catatan Singkat)

## Kasus 1: Foto tidak muncul

**Gejala**: foto berhasil upload, tapi tidak tampil di halaman detail.

**Solusi**:

1. Jalankan:
   - `php artisan storage:link`
2. Pastikan `FILESYSTEM_DISK=public` (atau disk `public` aktif).

## Kasus 2: Error akses halaman admin/siswa (403)

**Gejala**: setelah login tidak bisa akses `/admin/...` atau `/siswa/...`.

**Penyebab**: role user tidak sesuai.

**Solusi**:

- Pastikan kolom `users.role` berisi `admin` atau `siswa`.
- Jalankan seed: `php artisan db:seed`

## Kasus 3: Rekap per bulan tidak jalan di SQLite

**Catatan**: aplikasi sudah menangani perbedaan fungsi bulan (MySQL `DATE_FORMAT` vs SQLite `strftime`).
Jika Anda mengganti driver DB, pastikan `.env` sesuai.




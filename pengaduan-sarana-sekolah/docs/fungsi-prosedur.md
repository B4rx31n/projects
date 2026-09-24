# Dokumentasi Fungsi / Prosedur

## Fungsi (kode aplikasi)

- **`Aspiration::scopeFilter(array $filters)`** (`app/Models/Aspiration.php`)
  - Tujuan: filter query aspirasi berdasarkan:
    - `q` (judul/deskripsi/lokasi)
    - `status`
    - `category_id`
    - `user_id`
    - `from`, `to` (rentang tanggal)
    - `month` (YYYY-MM)
  - Catatan: query `month` menyesuaikan driver DB (SQLite vs MySQL/MariaDB).

- **`HomeController::__invoke()`** (`app/Http/Controllers/HomeController.php`)
  - Tujuan: redirect ke halaman utama sesuai role (admin → dashboard, siswa → form).

- **`StudentAspirationController`**
  - `index()`: tampilkan form + 10 aspirasi terbaru siswa.
  - `store()`: simpan aspirasi baru (foto optional ke storage `public`).
  - `history()`: list histori aspirasi siswa + filter.
  - `show()`: detail aspirasi + riwayat umpan balik.

- **`AdminAspirationController`**
  - `index()`: list aspirasi + filter + rekap.
  - `show()`: detail aspirasi.
  - `storeFeedback()`: simpan umpan balik + update status/progres (transaction).

## Prosedur (database – MySQL/MariaDB)

Tersedia di migration `database/migrations/2026_01_29_000005_create_mysql_procedures_for_rekap.php`
dan file SQL `database/pengaduan_sarana_sekolah.sql`:

- **`sp_rekap_aspirasi_per_tanggal(p_from, p_to)`**
- **`sp_rekap_aspirasi_per_bulan(p_from, p_to)`**
- **`sp_rekap_aspirasi_per_siswa(p_from, p_to)`**
- **`sp_rekap_aspirasi_per_kategori(p_from, p_to)`**

Jika prosedur tidak tersedia, aplikasi otomatis fallback ke query builder.




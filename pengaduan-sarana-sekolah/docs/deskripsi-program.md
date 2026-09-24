# Deskripsi Program

## Tujuan

Menyediakan aplikasi web untuk memudahkan proses **input** aspirasi/pengaduan sarana sekolah oleh siswa dan **output** berupa umpan balik, status, serta progres perbaikan oleh admin.

## Peran

- **Siswa**: mengirim aspirasi, melihat histori, status, umpan balik, progres.
- **Admin**: melihat daftar aspirasi, melakukan filter, memberi umpan balik, mengubah status/progres, melihat rekap.

## Halaman Utama

1. **Halaman Form Aspirasi Siswa** (`/siswa/aspirasi`)
   - Input: kategori, judul, deskripsi, lokasi (opsional), foto (opsional)
   - Output: ringkasan aspirasi terbaru siswa + status/progres + umpan balik terakhir
2. **Halaman Umpan Balik Aspirasi (Admin)** (`/admin/aspirasi`)
   - List aspirasi + filter (tanggal, bulan, siswa, kategori, status)
   - Rekap per tanggal/bulan/siswa/kategori
   - Detail aspirasi + form umpan balik untuk update status/progres

## Status & Progres

- Status: `baru`, `diproses`, `selesai`, `ditolak`
- Progres: integer 0–100 (%)




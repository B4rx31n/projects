# Implementasi absen.php ke Laravel - Task Breakdown

1. Buat Model Absensi
   - Buat model Absensi dengan atribut: nama, tanggal, jam

2. Buat Controller AttendanceController
   - Buat method untuk menangani form POST absensi
   - Baca karyawan.json untuk validasi nama
   - Jika nama tidak ditemukan, kembalikan view error
   - Jika ditemukan, cek absensi untuk tanggal hari ini
   - Jika sudah absen, kembalikan view warning
   - Jika belum, simpan absensi dan kembalikan view success

3. Buat view Blade "attendance_result.blade.php"
   - Tampilkan hasil absensi berdasarkan status (error, warning, success)
   - Gunakan style sesuai absen.php (CSS inline yang sudah disiapkan)

4. Update routes/web.php
   - Tambahkan route POST /absen yang mengarah ke AttendanceController@store

5. Tempatkan file karyawan.json di storage/app/karyawan.json
   - Sesuaikan path di controller saat membaca file

6. Testing fungsi absensi di Laravel development server

Langkah berikutnya:
- Mulai implementasi step 1: Model Absensi
- Lanjutkan step demi step sesuai todo list

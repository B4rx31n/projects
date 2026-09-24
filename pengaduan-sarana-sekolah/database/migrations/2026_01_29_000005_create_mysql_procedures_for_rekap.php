<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        $driver = DB::getDriverName();
        if ($driver !== 'mysql' && $driver !== 'mariadb') {
            return;
        }

        DB::unprepared('DROP PROCEDURE IF EXISTS sp_rekap_aspirasi_per_tanggal');
        DB::unprepared(<<<'SQL'
CREATE PROCEDURE sp_rekap_aspirasi_per_tanggal(IN p_from DATE, IN p_to DATE)
BEGIN
  SELECT DATE(created_at) AS tanggal, COUNT(*) AS total
  FROM aspirations
  WHERE DATE(created_at) BETWEEN p_from AND p_to
  GROUP BY DATE(created_at)
  ORDER BY tanggal ASC;
END
SQL);

        DB::unprepared('DROP PROCEDURE IF EXISTS sp_rekap_aspirasi_per_bulan');
        DB::unprepared(<<<'SQL'
CREATE PROCEDURE sp_rekap_aspirasi_per_bulan(IN p_from DATE, IN p_to DATE)
BEGIN
  SELECT DATE_FORMAT(created_at, '%Y-%m') AS bulan, COUNT(*) AS total
  FROM aspirations
  WHERE DATE(created_at) BETWEEN p_from AND p_to
  GROUP BY DATE_FORMAT(created_at, '%Y-%m')
  ORDER BY bulan ASC;
END
SQL);

        DB::unprepared('DROP PROCEDURE IF EXISTS sp_rekap_aspirasi_per_siswa');
        DB::unprepared(<<<'SQL'
CREATE PROCEDURE sp_rekap_aspirasi_per_siswa(IN p_from DATE, IN p_to DATE)
BEGIN
  SELECT u.id AS user_id, u.name AS siswa, COUNT(a.id) AS total
  FROM aspirations a
  JOIN users u ON u.id = a.user_id
  WHERE DATE(a.created_at) BETWEEN p_from AND p_to
  GROUP BY u.id, u.name
  ORDER BY total DESC, siswa ASC;
END
SQL);

        DB::unprepared('DROP PROCEDURE IF EXISTS sp_rekap_aspirasi_per_kategori');
        DB::unprepared(<<<'SQL'
CREATE PROCEDURE sp_rekap_aspirasi_per_kategori(IN p_from DATE, IN p_to DATE)
BEGIN
  SELECT c.id AS category_id, c.name AS kategori, COUNT(a.id) AS total
  FROM aspirations a
  JOIN categories c ON c.id = a.category_id
  WHERE DATE(a.created_at) BETWEEN p_from AND p_to
  GROUP BY c.id, c.name
  ORDER BY total DESC, kategori ASC;
END
SQL);
    }

    public function down(): void
    {
        $driver = DB::getDriverName();
        if ($driver !== 'mysql' && $driver !== 'mariadb') {
            return;
        }

        DB::unprepared('DROP PROCEDURE IF EXISTS sp_rekap_aspirasi_per_tanggal');
        DB::unprepared('DROP PROCEDURE IF EXISTS sp_rekap_aspirasi_per_bulan');
        DB::unprepared('DROP PROCEDURE IF EXISTS sp_rekap_aspirasi_per_siswa');
        DB::unprepared('DROP PROCEDURE IF EXISTS sp_rekap_aspirasi_per_kategori');
    }
};




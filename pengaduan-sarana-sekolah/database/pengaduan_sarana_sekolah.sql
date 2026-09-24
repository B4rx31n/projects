-- Aplikasi Pengaduan Sarana Sekolah (SPK)
-- Target: MySQL/MariaDB (Laragon)
-- Catatan: Struktur tabel mengikuti migration Laravel di project ini.

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

DROP TABLE IF EXISTS users;
DROP TABLE IF EXISTS aspiration_feedback;
DROP TABLE IF EXISTS aspirations;
DROP TABLE IF EXISTS categories;

-- User (siswa/admin) - minimal untuk kebutuhan aplikasi
CREATE TABLE users (
  id BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
  name VARCHAR(255) NOT NULL,
  email VARCHAR(255) NOT NULL,
  email_verified_at TIMESTAMP NULL DEFAULT NULL,
  password VARCHAR(255) NOT NULL,
  role VARCHAR(20) NOT NULL DEFAULT 'siswa',
  remember_token VARCHAR(100) NULL,
  created_at TIMESTAMP NULL DEFAULT NULL,
  updated_at TIMESTAMP NULL DEFAULT NULL,
  PRIMARY KEY (id),
  UNIQUE KEY users_email_unique (email),
  KEY users_role_index (role)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Master kategori
CREATE TABLE categories (
  id BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
  name VARCHAR(100) NOT NULL,
  created_at TIMESTAMP NULL DEFAULT NULL,
  updated_at TIMESTAMP NULL DEFAULT NULL,
  PRIMARY KEY (id),
  UNIQUE KEY categories_name_unique (name)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Aspirasi/pengaduan
CREATE TABLE aspirations (
  id BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
  user_id BIGINT UNSIGNED NOT NULL,
  category_id BIGINT UNSIGNED NOT NULL,
  title VARCHAR(150) NOT NULL,
  description TEXT NOT NULL,
  location VARCHAR(150) NULL,
  photo_path VARCHAR(255) NULL,
  status VARCHAR(20) NOT NULL DEFAULT 'baru',
  progress_percent TINYINT UNSIGNED NOT NULL DEFAULT 0,
  created_at TIMESTAMP NULL DEFAULT NULL,
  updated_at TIMESTAMP NULL DEFAULT NULL,
  PRIMARY KEY (id),
  KEY aspirations_status_created_at_index (status, created_at),
  KEY aspirations_category_created_at_index (category_id, created_at),
  KEY aspirations_user_created_at_index (user_id, created_at),
  CONSTRAINT aspirations_user_id_foreign FOREIGN KEY (user_id) REFERENCES users (id) ON DELETE CASCADE,
  CONSTRAINT aspirations_category_id_foreign FOREIGN KEY (category_id) REFERENCES categories (id) ON DELETE RESTRICT
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Umpan balik admin (riwayat)
CREATE TABLE aspiration_feedback (
  id BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
  aspiration_id BIGINT UNSIGNED NOT NULL,
  admin_id BIGINT UNSIGNED NOT NULL,
  message TEXT NOT NULL,
  status_after VARCHAR(20) NOT NULL,
  progress_percent_after TINYINT UNSIGNED NOT NULL DEFAULT 0,
  created_at TIMESTAMP NULL DEFAULT NULL,
  updated_at TIMESTAMP NULL DEFAULT NULL,
  PRIMARY KEY (id),
  KEY aspiration_feedback_aspiration_created_at_index (aspiration_id, created_at),
  KEY aspiration_feedback_admin_created_at_index (admin_id, created_at),
  CONSTRAINT aspiration_feedback_aspiration_id_foreign FOREIGN KEY (aspiration_id) REFERENCES aspirations (id) ON DELETE CASCADE,
  CONSTRAINT aspiration_feedback_admin_id_foreign FOREIGN KEY (admin_id) REFERENCES users (id) ON DELETE RESTRICT
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Data master kategori (opsional)
INSERT INTO categories (name, created_at, updated_at) VALUES
('Ruang Kelas', NOW(), NOW()),
('Toilet', NOW(), NOW()),
('Laboratorium', NOW(), NOW()),
('Perpustakaan', NOW(), NOW()),
('Lapangan/Olahraga', NOW(), NOW()),
('Listrik/Internet', NOW(), NOW()),
('Lainnya', NOW(), NOW())
ON DUPLICATE KEY UPDATE name = VALUES(name), updated_at = NOW();

-- Akun demo (opsional). Password: "password"
-- NOTE: Hash bcrypt ini bersifat contoh; Anda juga bisa membuat user via `php artisan db:seed`.
INSERT INTO users (name, email, password, role, created_at, updated_at) VALUES
('Admin Sarpras', 'admin@demo.test', '$2y$12$1f5avH6YGXz2hhBBKd7cfeEG4udgMakiclMulYV3C1KRfS2wPbADC', 'admin', NOW(), NOW()),
('Siswa Demo', 'siswa@demo.test', '$2y$12$1f5avH6YGXz2hhBBKd7cfeEG4udgMakiclMulYV3C1KRfS2wPbADC', 'siswa', NOW(), NOW())
ON DUPLICATE KEY UPDATE name = VALUES(name), role = VALUES(role), updated_at = NOW();

-- Stored procedure rekap (opsional)
DROP PROCEDURE IF EXISTS sp_rekap_aspirasi_per_tanggal;
DELIMITER $$
CREATE PROCEDURE sp_rekap_aspirasi_per_tanggal(IN p_from DATE, IN p_to DATE)
BEGIN
  SELECT DATE(created_at) AS tanggal, COUNT(*) AS total
  FROM aspirations
  WHERE DATE(created_at) BETWEEN p_from AND p_to
  GROUP BY DATE(created_at)
  ORDER BY tanggal ASC;
END$$
DELIMITER ;

DROP PROCEDURE IF EXISTS sp_rekap_aspirasi_per_bulan;
DELIMITER $$
CREATE PROCEDURE sp_rekap_aspirasi_per_bulan(IN p_from DATE, IN p_to DATE)
BEGIN
  SELECT DATE_FORMAT(created_at, '%Y-%m') AS bulan, COUNT(*) AS total
  FROM aspirations
  WHERE DATE(created_at) BETWEEN p_from AND p_to
  GROUP BY DATE_FORMAT(created_at, '%Y-%m')
  ORDER BY bulan ASC;
END$$
DELIMITER ;

DROP PROCEDURE IF EXISTS sp_rekap_aspirasi_per_siswa;
DELIMITER $$
CREATE PROCEDURE sp_rekap_aspirasi_per_siswa(IN p_from DATE, IN p_to DATE)
BEGIN
  SELECT u.id AS user_id, u.name AS siswa, COUNT(a.id) AS total
  FROM aspirations a
  JOIN users u ON u.id = a.user_id
  WHERE DATE(a.created_at) BETWEEN p_from AND p_to
  GROUP BY u.id, u.name
  ORDER BY total DESC, siswa ASC;
END$$
DELIMITER ;

DROP PROCEDURE IF EXISTS sp_rekap_aspirasi_per_kategori;
DELIMITER $$
CREATE PROCEDURE sp_rekap_aspirasi_per_kategori(IN p_from DATE, IN p_to DATE)
BEGIN
  SELECT c.id AS category_id, c.name AS kategori, COUNT(a.id) AS total
  FROM aspirations a
  JOIN categories c ON c.id = a.category_id
  WHERE DATE(a.created_at) BETWEEN p_from AND p_to
  GROUP BY c.id, c.name
  ORDER BY total DESC, kategori ASC;
END$$
DELIMITER ;

SET FOREIGN_KEY_CHECKS = 1;



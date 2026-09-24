CREATE DATABASE IF NOT EXISTS data_lengkap;
USE data_lengkap;

-- Tabel user login
CREATE TABLE IF NOT EXISTS users (
  id INT AUTO_INCREMENT PRIMARY KEY,
  username VARCHAR(50) NOT NULL,
  email VARCHAR(100) NOT NULL UNIQUE,
  password VARCHAR(255) NOT NULL,
  role ENUM('admin', 'user') DEFAULT 'user'
);

-- insert default admin (password: admin123)
INSERT INTO users (username,email,password,role)
SELECT 'admin','admin@example.com', '$2y$10$zvI8y9Zq2dQ7VqE8bqj0Wu0qJz8kGZb2Yx3bQYq0nq1YeJkzN5p6W', 'admin'
WHERE NOT EXISTS (SELECT 1 FROM users WHERE email='admin@example.com');

-- Tabel data umur
CREATE TABLE IF NOT EXISTS data_umur (
  id INT AUTO_INCREMENT PRIMARY KEY,
  nama VARCHAR(100),
  umur INT,
  jenis_kelamin ENUM('Laki-laki','Perempuan')
);

-- Tabel data nama
CREATE TABLE IF NOT EXISTS data_nama (
  id INT AUTO_INCREMENT PRIMARY KEY,
  nama_lengkap VARCHAR(100),
  nik VARCHAR(20),
  alamat TEXT
);

-- Tabel data pekerjaan
CREATE TABLE IF NOT EXISTS data_pekerjaan (
  id INT AUTO_INCREMENT PRIMARY KEY,
  nama VARCHAR(100),
  pekerjaan VARCHAR(100),
  penghasilan VARCHAR(50)
);

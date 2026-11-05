CREATE DATABASE IF NOT EXISTS perpustakaan;

USE perpustakaan;

CREATE TABLE books (
    id INT AUTO_INCREMENT PRIMARY KEY,
    judul VARCHAR(255) NOT NULL,
    penulis VARCHAR(255) NOT NULL,
    penerbit VARCHAR(255),
    tahun_terbit YEAR,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

INSERT INTO books (judul, penulis, penerbit, tahun_terbit) VALUES
('Laskar Pelangi', 'Andrea Hirata', 'Bentang Pustaka', 2005),
('Bumi Manusia', 'Pramoedya Ananta Toer', 'Hasta Mitra', 1980);
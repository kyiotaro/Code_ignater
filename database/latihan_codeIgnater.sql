CREATE DATABASE IF NOT EXISTS `latihan_codeIgnater`
  CHARACTER SET utf8mb4
  COLLATE utf8mb4_general_ci;

USE `latihan_codeIgnater`;

CREATE TABLE IF NOT EXISTS `siswa` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `nama` VARCHAR(100) NOT NULL,
  `umur` TINYINT UNSIGNED NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE IF NOT EXISTS `barang` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `nama` VARCHAR(100) NOT NULL,
  `kategori` VARCHAR(60) NOT NULL,
  `harga` INT UNSIGNED NOT NULL DEFAULT 0,
  `aktif` TINYINT(1) NOT NULL DEFAULT 1,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `barang` (`nama`, `kategori`, `harga`, `aktif`) VALUES
  ('Buku Tulis', 'Alat Tulis', 5000, 1),
  ('Pulpen Biru', 'Alat Tulis', 3000, 1),
  ('Botol Minum', 'Aksesori', 25000, 0);

INSERT INTO `siswa` (`nama`, `umur`) VALUES
  ('Andi', 16),
  ('Budi', 17),
  ('Caca', 18),
  ('Deni', 19);
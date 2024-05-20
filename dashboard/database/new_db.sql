DROP TABLE IF EXISTS `order_jadwal`;
DROP TABLE IF EXISTS `order_lokasi`;
DROP TABLE IF EXISTS `user_reviews`;
DROP TABLE IF EXISTS `user_order`;
DROP TABLE IF EXISTS `jadwal`;
DROP TABLE IF EXISTS `lokasi`;
DROP TABLE IF EXISTS `user`;
DROP TABLE IF EXISTS `admin`;

CREATE TABLE `admin` (
  `id` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `username` varchar(100) NOT NULL,
  `password` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `user` (
  `id` integer PRIMARY KEY AUTO_INCREMENT,
  `email` varchar(255),
  `username` varchar(255),
  `password` varchar(255),
  `no_wa` varchar(255)
);

CREATE TABLE `lokasi` (
  `id` integer PRIMARY KEY AUTO_INCREMENT,
  `lokasi` varchar(255)
);

CREATE TABLE `jadwal` (
  `id` integer PRIMARY KEY AUTO_INCREMENT,
  `lokasi_id` integer,
  `jam` time,
  `sesi` integer,
  `jenis_jadwal` varchar(255)
);

CREATE TABLE `user_order` (
  `id` integer PRIMARY KEY AUTO_INCREMENT,
  `user_id` integer,
  `kode_order` varchar(255) UNIQUE,
  `order_type` varchar(15),
  `tanggal_order` date,
  `tanggal_selesai_order` date,
  `total_pembayaran` integer,
  `bukti_pembayaran` varchar(255),
  `konfirmasi` boolean DEFAULT false,
  `tolak` boolean DEFAULT false,
  `kursi` varchar(10) NULL,
  `metode_pembayaran` varchar(100),
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

CREATE TABLE `user_reviews` (
  `id` integer PRIMARY KEY AUTO_INCREMENT,
  `user_id` integer,
  `rating` integer,
  `masukan_saran` text,
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

CREATE TABLE `order_lokasi` (
  `user_order_id` integer,
  `lokasi_id` integer
);

CREATE TABLE `order_jadwal` (
  `user_order_id` integer,
  `jadwal_id` integer
);



ALTER TABLE `user_order` ADD FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);
ALTER TABLE `user_reviews` ADD FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);
ALTER TABLE `jadwal` ADD FOREIGN KEY (`lokasi_id`) REFERENCES `lokasi` (`id`);
ALTER TABLE `order_lokasi` ADD FOREIGN KEY (`lokasi_id`) REFERENCES `lokasi` (`id`);
ALTER TABLE `order_lokasi` ADD FOREIGN KEY (`user_order_id`) REFERENCES `user_order` (`id`);

INSERT INTO `admin` (`id`, `username`, `password`) VALUES
(1, 'admin', '$2y$10$8u5r/aJundMiolM5NUpvcubV7vQCOSxFGrIGbJQ6xpyxI7U.fTDOm');
INSERT INTO `user` (`id`, `username`, `no_wa`, `email`, `password`) VALUES
(1, 'user', '086681928172', 'user@gmail.com', '$2y$10$oMx9dlc3y9iSgK9mo8IdF.rDs6ybV3LILt2pelox/0Ziq2/8abA5K');

INSERT INTO lokasi (id, lokasi) VALUES
(1, 'Terminal Tegal'),
(2, 'Alun-alun Tegal'),
(3, 'Pasar Pagi Tegal'),
(4, 'Pantai Alam Indah'),
(5, 'Pantai Batam Sari'),
(6, 'Stasiun Tegal'),
(7, 'Situs Makam Sunan Amangkurat Agung'),
(8, 'Taman Rakyat Slawi'),
(9, 'Makam Ki Gede Sebayu'),
(10, 'GUCI Pemandian Air Panas');

INSERT INTO jadwal (lokasi_id, jam, sesi, jenis_jadwal) VALUES
(1, '09:00', 1, 'berangkat'),
(1, '10:00', 2, 'kembali'),
(2, '09:30',1, 'berangkat'),
(3, '10:00', 1 ,'berangkat');

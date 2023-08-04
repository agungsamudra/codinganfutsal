-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 26, 2023 at 01:35 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `futsal`
--

-- --------------------------------------------------------

--
-- Table structure for table `jadwal`
--

CREATE TABLE `jadwal` (
  `id_jadwal` int(11) NOT NULL,
  `id_lapangan` int(11) NOT NULL,
  `jam` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `jadwal`
--

INSERT INTO `jadwal` (`id_jadwal`, `id_lapangan`, `jam`) VALUES
(2, 1, '09:00:00'),
(3, 1, '10:00:00'),
(4, 1, '11:00:00'),
(5, 1, '12:00:00'),
(6, 1, '13:00:00'),
(7, 1, '14:00:00'),
(8, 1, '15:00:00'),
(9, 1, '16:00:00'),
(10, 1, '17:00:00'),
(11, 1, '18:00:00'),
(12, 1, '19:00:00'),
(13, 1, '20:00:00'),
(15, 2, '09:00:00'),
(16, 2, '10:00:00'),
(17, 2, '11:00:00'),
(18, 2, '12:00:00'),
(19, 2, '13:00:00'),
(20, 2, '14:00:00'),
(21, 2, '15:00:00'),
(22, 2, '16:00:00'),
(23, 2, '17:00:00'),
(24, 2, '18:00:00'),
(25, 2, '19:00:00'),
(26, 2, '20:00:00'),
(53, 6, '09:00:00'),
(54, 6, '10:00:00'),
(55, 6, '11:00:00'),
(56, 6, '12:00:00'),
(57, 6, '13:00:00'),
(58, 6, '14:00:00'),
(59, 6, '15:00:00'),
(60, 6, '16:00:00'),
(61, 6, '17:00:00'),
(64, 6, '18:00:00'),
(65, 6, '19:00:00'),
(66, 6, '20:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `lapangan`
--

CREATE TABLE `lapangan` (
  `id_lapangan` int(11) NOT NULL,
  `nama_lapangan` varchar(50) NOT NULL,
  `harga_sewa` int(11) NOT NULL,
  `kontak` varchar(15) NOT NULL,
  `foto` text NOT NULL,
  `jml_tersewa` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `lapangan`
--

INSERT INTO `lapangan` (`id_lapangan`, `nama_lapangan`, `harga_sewa`, `kontak`, `foto`, `jml_tersewa`) VALUES
(1, 'LAPANGAN 1', 120000, '085123456789', 'harapanindah1.png', 0),
(2, 'LAPANGAN 2', 120000, '085123456789', 'harapanindah.png', 0),
(6, 'LAPANGAN 3', 100000, '085123456789', 'harapanindah11.png', 1);

-- --------------------------------------------------------

--
-- Table structure for table `pemesan`
--

CREATE TABLE `pemesan` (
  `id_pemesan` int(11) NOT NULL,
  `nama_pemesan` varchar(50) NOT NULL,
  `alamat` varchar(100) NOT NULL,
  `no_hp` varchar(15) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pemesan`
--

INSERT INTO `pemesan` (`id_pemesan`, `nama_pemesan`, `alamat`, `no_hp`, `email`, `password`) VALUES
(1, 'Joko Suparto', 'Jl. Merdeka No. 67 ', '085123456789', 'joko@gmail.com', '$2y$10$Y1LrAf5tT3Y0s0crNtrCse0ZXZHMirN5m/O5aoq9q/c2F4sUE/WV2'),
(2, 'Aceng Fikri', 'Jl. Ancol 1 ', '085123456789', 'aceng@gmail.com', '$2y$10$1KFJC7UXQwZ8B7V8NfQnhu2qxOWPPoEcP1CAqiNEvYW8cZ7v9bSFy');

-- --------------------------------------------------------

--
-- Table structure for table `pemesanan`
--

CREATE TABLE `pemesanan` (
  `id_pemesanan` int(11) NOT NULL,
  `kode_pemesanan` varchar(20) NOT NULL,
  `tanggal` date NOT NULL,
  `id_pemesan` int(11) NOT NULL,
  `id_lapangan` int(11) NOT NULL,
  `tgl_booking` date NOT NULL,
  `jam_booking` time NOT NULL,
  `dp` int(11) NOT NULL,
  `total` int(11) NOT NULL,
  `status` enum('Belum Lunas','Batal','Lunas') NOT NULL,
  `ulasan` tinyint(1) NOT NULL DEFAULT 0,
  `file` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pemesanan`
--

INSERT INTO `pemesanan` (`id_pemesanan`, `kode_pemesanan`, `tanggal`, `id_pemesan`, `id_lapangan`, `tgl_booking`, `jam_booking`, `dp`, `total`, `status`, `ulasan`, `file`) VALUES
(1, '20230626170820', '2023-06-26', 2, 6, '2023-06-27', '10:00:00', 50000, 100000, 'Lunas', 1, 'assets/images/dp/1867290716_1687777363.jpeg');

--
-- Triggers `pemesanan`
--
DELIMITER $$
CREATE TRIGGER `update jumlah tersewa` AFTER INSERT ON `pemesanan` FOR EACH ROW UPDATE lapangan SET jml_tersewa=jml_tersewa+1 WHERE id_lapangan=new.id_lapangan
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `pengguna`
--

CREATE TABLE `pengguna` (
  `id_pengguna` int(11) NOT NULL,
  `nama_lengkap` varchar(50) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` text NOT NULL,
  `level` enum('Admin','Pemilik') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pengguna`
--

INSERT INTO `pengguna` (`id_pengguna`, `nama_lengkap`, `username`, `password`, `level`) VALUES
(1, 'Administrator', 'admin', '$2y$10$yiZayN1wjx8fmUsQwfOwHOafbjtklF1F5S1NkvP3GZJqxxqEWuzoi', 'Admin'),
(10, 'Aceng Fikri', 'pemilik', '$2y$10$tUua0UKnsmw0Z.WUOxt86.faSOA5GGivTqsf3bLW.f4IPd66TkZWG', 'Pemilik');

-- --------------------------------------------------------

--
-- Table structure for table `rating`
--

CREATE TABLE `rating` (
  `id_rating` int(11) NOT NULL,
  `id_lapangan` int(11) NOT NULL,
  `id_pemesan` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `rating` float NOT NULL,
  `ulasan` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `rating`
--

INSERT INTO `rating` (`id_rating`, `id_lapangan`, `id_pemesan`, `tanggal`, `rating`, `ulasan`) VALUES
(1, 6, 2, '2023-06-26', 5, 'bagus lapangan nya');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `jadwal`
--
ALTER TABLE `jadwal`
  ADD PRIMARY KEY (`id_jadwal`),
  ADD KEY `id_lapangan` (`id_lapangan`);

--
-- Indexes for table `lapangan`
--
ALTER TABLE `lapangan`
  ADD PRIMARY KEY (`id_lapangan`);

--
-- Indexes for table `pemesan`
--
ALTER TABLE `pemesan`
  ADD PRIMARY KEY (`id_pemesan`);

--
-- Indexes for table `pemesanan`
--
ALTER TABLE `pemesanan`
  ADD PRIMARY KEY (`id_pemesanan`),
  ADD KEY `id_lapangan` (`id_lapangan`),
  ADD KEY `id_pemesan` (`id_pemesan`);

--
-- Indexes for table `pengguna`
--
ALTER TABLE `pengguna`
  ADD PRIMARY KEY (`id_pengguna`);

--
-- Indexes for table `rating`
--
ALTER TABLE `rating`
  ADD PRIMARY KEY (`id_rating`),
  ADD KEY `id_lapangan` (`id_lapangan`),
  ADD KEY `id_pemesan` (`id_pemesan`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `jadwal`
--
ALTER TABLE `jadwal`
  MODIFY `id_jadwal` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=67;

--
-- AUTO_INCREMENT for table `lapangan`
--
ALTER TABLE `lapangan`
  MODIFY `id_lapangan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `pemesan`
--
ALTER TABLE `pemesan`
  MODIFY `id_pemesan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `pemesanan`
--
ALTER TABLE `pemesanan`
  MODIFY `id_pemesanan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `pengguna`
--
ALTER TABLE `pengguna`
  MODIFY `id_pengguna` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `rating`
--
ALTER TABLE `rating`
  MODIFY `id_rating` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `jadwal`
--
ALTER TABLE `jadwal`
  ADD CONSTRAINT `jadwal_ibfk_1` FOREIGN KEY (`id_lapangan`) REFERENCES `lapangan` (`id_lapangan`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `pemesanan`
--
ALTER TABLE `pemesanan`
  ADD CONSTRAINT `pemesanan_ibfk_1` FOREIGN KEY (`id_lapangan`) REFERENCES `lapangan` (`id_lapangan`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `pemesanan_ibfk_2` FOREIGN KEY (`id_pemesan`) REFERENCES `pemesan` (`id_pemesan`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `rating`
--
ALTER TABLE `rating`
  ADD CONSTRAINT `rating_ibfk_1` FOREIGN KEY (`id_lapangan`) REFERENCES `lapangan` (`id_lapangan`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `rating_ibfk_2` FOREIGN KEY (`id_pemesan`) REFERENCES `pemesan` (`id_pemesan`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

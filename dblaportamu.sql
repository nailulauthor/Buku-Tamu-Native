-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jun 24, 2024 at 08:54 AM
-- Server version: 8.0.30
-- PHP Version: 8.2.20

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dblaportamu`
--

-- --------------------------------------------------------

--
-- Table structure for table `berkunjung`
--

CREATE TABLE `berkunjung` (
  `idberkunjung` int NOT NULL,
  `idtamu` int NOT NULL,
  `idkeluarga` int NOT NULL,
  `jam_kunjung` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` varchar(15) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `berkunjung`
--

INSERT INTO `berkunjung` (`idberkunjung`, `idtamu`, `idkeluarga`, `jam_kunjung`, `status`) VALUES
(1, 26, 3, '2023-07-09 22:46:11', 'Menginap'),
(3, 29, 3, '2023-07-10 01:34:00', 'Menginap');

-- --------------------------------------------------------

--
-- Table structure for table `keluarga`
--

CREATE TABLE `keluarga` (
  `idkeluarga` int NOT NULL,
  `no_rumah` char(5) COLLATE utf8mb4_general_ci NOT NULL,
  `nama` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `panggilan` varchar(15) COLLATE utf8mb4_general_ci NOT NULL,
  `nohp1` char(15) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `jenis_kelamin` varchar(10) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `keluarga`
--

INSERT INTO `keluarga` (`idkeluarga`, `no_rumah`, `nama`, `panggilan`, `nohp1`, `jenis_kelamin`) VALUES
(3, 'AA001', 'Bejo saputro', 'bejo', '08922111122', 'laki-laki'),
(8, 'AA001', 'andri', 'ratna', '089524427223', 'Laki-laki');

-- --------------------------------------------------------

--
-- Table structure for table `tbltamu`
--

CREATE TABLE `tbltamu` (
  `idtamu` int NOT NULL,
  `nama_tamu` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `jenis_kelamin` varchar(10) COLLATE utf8mb4_general_ci NOT NULL,
  `alamat_tamu` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `nohp` varchar(15) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbltamu`
--

INSERT INTO `tbltamu` (`idtamu`, `nama_tamu`, `jenis_kelamin`, `alamat_tamu`, `nohp`) VALUES
(26, 'agus', 'Laki-laki', 'jalan ponorogo kauman 17/04 pekalongan', '0895244272446'),
(29, 'sofyan', 'Laki-laki', 'wiradesa kab pekalongan', '0895244272446'),
(36, 'sofyan', 'Laki-laki', 'wiradesakab pekalongan', '0895244272446'),
(37, 'agus', 'Laki-laki', 'tangerang', '929292929'),
(38, 'sofyan', 'Laki-laki', 'tangerang', '0895244272446');

-- --------------------------------------------------------

--
-- Table structure for table `tbrumah`
--

CREATE TABLE `tbrumah` (
  `no_rumah` char(5) COLLATE utf8mb4_general_ci NOT NULL,
  `alamat` varchar(50) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbrumah`
--

INSERT INTO `tbrumah` (`no_rumah`, `alamat`) VALUES
('AA001', 'Jalan Ceremai'),
('AA002', 'Jalan mangga'),
('AA003', 'jalan nangka');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `idadmin` int NOT NULL,
  `username` varchar(30) COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`idadmin`, `username`, `password`) VALUES
(2, 'admin', '21232f297a57a5a743894a0e4a801fc3');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `berkunjung`
--
ALTER TABLE `berkunjung`
  ADD PRIMARY KEY (`idberkunjung`),
  ADD KEY `idkeluarga` (`idkeluarga`),
  ADD KEY `idtamu` (`idtamu`);

--
-- Indexes for table `keluarga`
--
ALTER TABLE `keluarga`
  ADD PRIMARY KEY (`idkeluarga`),
  ADD KEY `no_rumah` (`no_rumah`);

--
-- Indexes for table `tbltamu`
--
ALTER TABLE `tbltamu`
  ADD PRIMARY KEY (`idtamu`);

--
-- Indexes for table `tbrumah`
--
ALTER TABLE `tbrumah`
  ADD PRIMARY KEY (`no_rumah`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`idadmin`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `berkunjung`
--
ALTER TABLE `berkunjung`
  MODIFY `idberkunjung` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `keluarga`
--
ALTER TABLE `keluarga`
  MODIFY `idkeluarga` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `tbltamu`
--
ALTER TABLE `tbltamu`
  MODIFY `idtamu` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `idadmin` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `berkunjung`
--
ALTER TABLE `berkunjung`
  ADD CONSTRAINT `berkunjung_ibfk_1` FOREIGN KEY (`idkeluarga`) REFERENCES `keluarga` (`idkeluarga`),
  ADD CONSTRAINT `berkunjung_ibfk_2` FOREIGN KEY (`idtamu`) REFERENCES `tbltamu` (`idtamu`);

--
-- Constraints for table `keluarga`
--
ALTER TABLE `keluarga`
  ADD CONSTRAINT `keluarga_ibfk_1` FOREIGN KEY (`no_rumah`) REFERENCES `tbrumah` (`no_rumah`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

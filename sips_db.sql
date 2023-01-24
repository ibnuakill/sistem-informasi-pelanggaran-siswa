-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 03, 2021 at 05:53 PM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 8.0.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sips_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `jenis_pelanggaran`
--

CREATE TABLE `jenis_pelanggaran` (
  `id_jenis` int(11) NOT NULL,
  `jenis_pelanggaran` text NOT NULL,
  `poin` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `jurusan`
--

CREATE TABLE `jurusan` (
  `id_jurusan` int(11) NOT NULL,
  `nama_jurusan` varchar(10) NOT NULL,
  `keterangan` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `kelas`
--

CREATE TABLE `kelas` (
  `id_kelas` int(11) NOT NULL,
  `nama_kelas` varchar(10) NOT NULL,
  `nama_jurusan` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `pelanggaran_siswa`
--

CREATE TABLE `pelanggaran_siswa` (
  `id_pelanggaran` int(11) NOT NULL,
  `NIS` int(11) NOT NULL,
  `nama_siswa` varchar(30) NOT NULL,
  `jenis_pelanggaran` text NOT NULL,
  `poin` int(11) NOT NULL,
  `keterangan` text NOT NULL,
  `tanggal` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Triggers `pelanggaran_siswa`
--
DELIMITER $$
CREATE TRIGGER `delete_pelanggaran` AFTER DELETE ON `pelanggaran_siswa` FOR EACH ROW BEGIN
UPDATE siswa
SET total_poin = total_poin - OLD.poin
WHERE
siswa.NIS = OLD.NIS;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `insert_pelanggaran` AFTER INSERT ON `pelanggaran_siswa` FOR EACH ROW BEGIN
UPDATE siswa
SET total_poin = total_poin + NEW.poin
WHERE
siswa.NIS = NEW.NIS;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `update_poin` AFTER UPDATE ON `pelanggaran_siswa` FOR EACH ROW BEGIN
UPDATE siswa
SET total_poin = total_poin - OLD.poin + NEW.poin
WHERE
siswa.NIS = NEW.NIS;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `sanksi`
--

CREATE TABLE `sanksi` (
  `no_sanksi` int(11) NOT NULL,
  `rentang` varchar(10) NOT NULL,
  `tindakan_sekolah` text NOT NULL,
  `sanksi` text NOT NULL,
  `pelaksana` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `sanksi`
--

INSERT INTO `sanksi` (`no_sanksi`, `rentang`, `tindakan_sekolah`, `sanksi`, `pelaksana`) VALUES
(1, 's.d 40', 'Berkomunikasi dengan orang tua/wali siswa dan memberikan bimbingan serta perhatian.', 'Teguran tertulis dan surat perjanjian pertama.', 'Wali Kelas'),
(2, '41 s.d 70', 'Berkomunikasi dengan orang tua/wali siswa dan memberikan bimbingan serta perhatian.', 'Teguran tertulis dan surat perjanjian kedua.', 'Wali Kelas dan BK'),
(3, '71 s.d 99', 'Berkomunikasi dengan orang tua/wali siswa dan memberi bimbingan serta perhatian.', 'Surat perjanjian tertulis bermaterai dan skorsing maksimal 3 hari efektif, diketahui Kepala Sekolah.', 'Wali Kelas dan BK Wakasek Kesiswaan diketahui Kepala Sekolah'),
(4, 's.d 100', 'Berkomunikasi dengan orang tua/wali siswa dan memberi bimbingan serta perhatian.', 'Dikembalikan kepada orang tua secara sepihak.', 'Pleno Guru');

-- --------------------------------------------------------

--
-- Table structure for table `siswa`
--

CREATE TABLE `siswa` (
  `NIS` varchar(10) NOT NULL,
  `nama_siswa` varchar(30) NOT NULL,
  `nama_kelas` varchar(10) NOT NULL,
  `nama_jurusan` varchar(10) NOT NULL,
  `jenis_kelamin` varchar(10) NOT NULL,
  `alamat` text NOT NULL,
  `no_telepon` varchar(15) NOT NULL,
  `id_akun` varchar(10) NOT NULL,
  `total_poin` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `siswa`
--

INSERT INTO `siswa` (`NIS`, `nama_siswa`, `nama_kelas`, `nama_jurusan`, `jenis_kelamin`, `alamat`, `no_telepon`, `id_akun`, `total_poin`) VALUES
('1910', 'Almira Van Fadhilla', 'X MIPA 1', 'MIPA', 'Perempuan', 'Lebak, Banten', '085817922085', 'SW01', 0);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_akun` varchar(10) NOT NULL,
  `nama_pengguna` varchar(30) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(20) NOT NULL,
  `role` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_akun`, `nama_pengguna`, `username`, `password`, `role`) VALUES
('ADM01', 'Rachma Adzima', 'admin_ama', 'admin123', 'Admin'),
('PGW01', 'Jasmine Athira', 'pegawai_jasmine', 'pegawai123', 'Pegawai'),
('SW01', 'Almira Van Fadhilla', 'almiravan', 'mira123', 'Admin');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `jenis_pelanggaran`
--
ALTER TABLE `jenis_pelanggaran`
  ADD PRIMARY KEY (`id_jenis`);

--
-- Indexes for table `jurusan`
--
ALTER TABLE `jurusan`
  ADD PRIMARY KEY (`id_jurusan`);

--
-- Indexes for table `kelas`
--
ALTER TABLE `kelas`
  ADD PRIMARY KEY (`id_kelas`);

--
-- Indexes for table `pelanggaran_siswa`
--
ALTER TABLE `pelanggaran_siswa`
  ADD PRIMARY KEY (`id_pelanggaran`);

--
-- Indexes for table `sanksi`
--
ALTER TABLE `sanksi`
  ADD PRIMARY KEY (`no_sanksi`);

--
-- Indexes for table `siswa`
--
ALTER TABLE `siswa`
  ADD PRIMARY KEY (`NIS`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_akun`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `jenis_pelanggaran`
--
ALTER TABLE `jenis_pelanggaran`
  MODIFY `id_jenis` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jurusan`
--
ALTER TABLE `jurusan`
  MODIFY `id_jurusan` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `kelas`
--
ALTER TABLE `kelas`
  MODIFY `id_kelas` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pelanggaran_siswa`
--
ALTER TABLE `pelanggaran_siswa`
  MODIFY `id_pelanggaran` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sanksi`
--
ALTER TABLE `sanksi`
  MODIFY `no_sanksi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

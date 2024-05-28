-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: May 28, 2024 at 11:03 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 7.4.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `kelulusan`
--

-- --------------------------------------------------------

--
-- Table structure for table `jurusan`
--

CREATE TABLE `jurusan` (
  `id_jurusan` varchar(11) NOT NULL,
  `nama_jurusan` varchar(255) CHARACTER SET utf8 NOT NULL,
  `singkatan` varchar(255) CHARACTER SET utf8 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `kelas`
--

CREATE TABLE `kelas` (
  `id_kelas` varchar(11) NOT NULL,
  `id_jurusan` varchar(11) NOT NULL,
  `nama_kelas` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `kelulusan`
--

CREATE TABLE `kelulusan` (
  `id_kelulusan` int(11) NOT NULL,
  `id_siswa` int(11) NOT NULL,
  `berkas` varchar(255) NOT NULL,
  `keterangan` text NOT NULL,
  `verifikasi` int(11) NOT NULL,
  `status_lulus` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `menu`
--

CREATE TABLE `menu` (
  `id_menu` int(11) NOT NULL,
  `nama_menu` varchar(255) NOT NULL,
  `icon` varchar(255) NOT NULL,
  `ada_submenu` int(11) NOT NULL,
  `url` varchar(255) NOT NULL,
  `urutan` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `menu`
--

INSERT INTO `menu` (`id_menu`, `nama_menu`, `icon`, `ada_submenu`, `url`, `urutan`) VALUES
(15, 'Dashboard', 'fa-tachometer-alt', 0, 'dashboard', 1),
(16, 'Data Master', 'fa-link', 1, 'master', 2),
(17, 'Kelulusan', 'fa-user-graduate', 1, 'kelulusan', 3),
(18, 'Data User', 'fa-users', 0, 'user', 4),
(19, 'Pengaturan Akses', 'fa-cogs', 0, 'role', 5),
(20, 'Profil', 'fa-user', 1, 'profil', 6);

-- --------------------------------------------------------

--
-- Table structure for table `petugas`
--

CREATE TABLE `petugas` (
  `id_petugas` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `nama_petugas` varchar(255) NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `jk` enum('L','P') NOT NULL,
  `telepon` varchar(255) NOT NULL,
  `gambar` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `petugas`
--

INSERT INTO `petugas` (`id_petugas`, `id_user`, `nama_petugas`, `alamat`, `jk`, `telepon`, `gambar`) VALUES
(1, 3, 'Petugas', 'Bandung', 'L', '08123456789', 'IMGL0062.jpg'),
(8, 12, 'Verifikator', 'Bandung', 'L', '08123456789', '74899851_1141442616196555_1777832484911577027_n.jpg'),
(9, 13, 'Petugas', 'Bandung', 'L', '08123456789', 'IMG-20200418-WA00041.jpg'),
(10, 14, 'rekayasa', 'Bandung', 'L', '0123456789', 'IMG-20200421-WA0013.jpg'),
(11, 15, 'Bang', 'Ciwidey', 'L', '081211273648', 'Screenshot_2020-04-30-23-05-10-90_f2cb81fb7cf38af7978f186f2a61634a.jpg'),
(12, 16, 'bisnis', 'bandung', 'P', '08123456789', 'WhatsApp_Image_2020-04-20_at_11_04_01.jpeg');

-- --------------------------------------------------------

--
-- Table structure for table `role`
--

CREATE TABLE `role` (
  `id_role` int(11) NOT NULL,
  `nama_role` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `role`
--

INSERT INTO `role` (`id_role`, `nama_role`) VALUES
(1, 'Admin'),
(8, 'Petugas'),
(9, 'Verifikator');

-- --------------------------------------------------------

--
-- Table structure for table `role_access_menu`
--

CREATE TABLE `role_access_menu` (
  `id_role_access` int(11) NOT NULL,
  `id_role` int(11) NOT NULL,
  `id_menu` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `role_access_menu`
--

INSERT INTO `role_access_menu` (`id_role_access`, `id_role`, `id_menu`) VALUES
(33, 1, 19),
(34, 1, 15),
(35, 1, 16),
(36, 1, 17),
(37, 1, 18),
(38, 1, 20),
(39, 8, 15),
(41, 8, 20),
(44, 9, 15),
(46, 9, 17),
(47, 9, 20),
(49, 8, 16),
(50, 8, 17);

-- --------------------------------------------------------

--
-- Table structure for table `role_access_submenu`
--

CREATE TABLE `role_access_submenu` (
  `id_role_access_submenu` int(11) NOT NULL,
  `id_role` int(11) NOT NULL,
  `id_submenu` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `role_access_submenu`
--

INSERT INTO `role_access_submenu` (`id_role_access_submenu`, `id_role`, `id_submenu`) VALUES
(41, 1, 21),
(42, 1, 22),
(43, 1, 23),
(44, 1, 24),
(45, 1, 25),
(46, 1, 26),
(47, 1, 27),
(48, 8, 23),
(49, 8, 25),
(50, 8, 26),
(51, 8, 27),
(52, 8, 22),
(53, 1, 28),
(54, 9, 24),
(55, 9, 25),
(56, 9, 26),
(57, 9, 27);

-- --------------------------------------------------------

--
-- Table structure for table `siswa`
--

CREATE TABLE `siswa` (
  `id_siswa` int(11) NOT NULL,
  `nama_siswa` varchar(255) NOT NULL,
  `tgl` date NOT NULL,
  `nis` varchar(255) NOT NULL,
  `nisn` varchar(255) DEFAULT NULL,
  `no_peserta_ujian` varchar(255) NOT NULL,
  `id_jurusan` varchar(11) NOT NULL,
  `id_kelas` varchar(11) NOT NULL,
  `jk` enum('L','P') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `submenu`
--

CREATE TABLE `submenu` (
  `id_submenu` int(11) NOT NULL,
  `id_menu` int(11) NOT NULL,
  `url` varchar(255) NOT NULL,
  `nama_submenu` varchar(255) NOT NULL,
  `urutan` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `submenu`
--

INSERT INTO `submenu` (`id_submenu`, `id_menu`, `url`, `nama_submenu`, `urutan`) VALUES
(21, 16, 'master/jurusan', 'Data Jurusan', 1),
(22, 16, 'master/siswa', 'Data Siswa', 3),
(23, 17, 'kelulusan/berkas', 'Berkas Kelulusan Siswa', 1),
(24, 17, 'kelulusan/verifikasi', 'Verifikasi Kelulusan', 2),
(25, 20, 'profil', 'Profil Saya', 1),
(26, 20, 'profil/ubah', 'Ubah Profil', 2),
(27, 20, 'profil/ubah_password', 'Ubah Password', 3),
(28, 16, 'master/kelas', 'Data Kelas', 2);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `id_role` int(11) NOT NULL,
  `petugas` int(11) NOT NULL,
  `id_jurusan` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `email`, `password`, `id_role`, `petugas`, `id_jurusan`) VALUES
(3, 'admin@admin.com', '$2a$12$CEN69b1nsYZdG5n6qIK7wurbJOj72lY6Zz6yc5la435KZ/bTiKsua', 1, 0, 'JRS001');

--
-- Indexes for dumped tables
--

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
-- Indexes for table `kelulusan`
--
ALTER TABLE `kelulusan`
  ADD PRIMARY KEY (`id_kelulusan`);

--
-- Indexes for table `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`id_menu`);

--
-- Indexes for table `petugas`
--
ALTER TABLE `petugas`
  ADD PRIMARY KEY (`id_petugas`);

--
-- Indexes for table `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`id_role`);

--
-- Indexes for table `role_access_menu`
--
ALTER TABLE `role_access_menu`
  ADD PRIMARY KEY (`id_role_access`);

--
-- Indexes for table `role_access_submenu`
--
ALTER TABLE `role_access_submenu`
  ADD PRIMARY KEY (`id_role_access_submenu`);

--
-- Indexes for table `siswa`
--
ALTER TABLE `siswa`
  ADD PRIMARY KEY (`id_siswa`);

--
-- Indexes for table `submenu`
--
ALTER TABLE `submenu`
  ADD PRIMARY KEY (`id_submenu`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `kelulusan`
--
ALTER TABLE `kelulusan`
  MODIFY `id_kelulusan` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `menu`
--
ALTER TABLE `menu`
  MODIFY `id_menu` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `petugas`
--
ALTER TABLE `petugas`
  MODIFY `id_petugas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `role`
--
ALTER TABLE `role`
  MODIFY `id_role` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `role_access_menu`
--
ALTER TABLE `role_access_menu`
  MODIFY `id_role_access` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT for table `role_access_submenu`
--
ALTER TABLE `role_access_submenu`
  MODIFY `id_role_access_submenu` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- AUTO_INCREMENT for table `siswa`
--
ALTER TABLE `siswa`
  MODIFY `id_siswa` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `submenu`
--
ALTER TABLE `submenu`
  MODIFY `id_submenu` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

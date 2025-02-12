-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 12, 2025 at 01:38 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `uas_aldi`
--

-- --------------------------------------------------------

--
-- Table structure for table `pendidikan`
--

CREATE TABLE `pendidikan` (
  `id` int(11) NOT NULL,
  `pendidikan` varchar(50) NOT NULL,
  `lokasi` varchar(50) NOT NULL,
  `tahun` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pendidikan`
--

INSERT INTO `pendidikan` (`id`, `pendidikan`, `lokasi`, `tahun`) VALUES
(1, 'S1 Teknologi Informasi', 'Stikom Uyelindo', '2024'),
(2, 'SMK Teknik Komputer Jaringan', 'SMK Negeri 1 Kupang', '2020'),
(3, 'S2 Manajemen Sistem Informasi', 'Universitas Teknologi Jakarta', '2026'),
(4, 'S1 Desain Komunikasi Visual', 'Universitas Desain Bandung', '2025');

-- --------------------------------------------------------

--
-- Table structure for table `pengalaman`
--

CREATE TABLE `pengalaman` (
  `id` int(11) NOT NULL,
  `pengalaman` varchar(50) NOT NULL,
  `tahun` varchar(25) NOT NULL,
  `kategori` varchar(25) NOT NULL,
  `deskripsi` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pengalaman`
--

INSERT INTO `pengalaman` (`id`, `pengalaman`, `tahun`, `kategori`, `deskripsi`) VALUES
(1, 'Frontend Developer di Web.it Kupang', '2024', 'Pekerjaan', 'Bertanggung jawab dalam merancang dan mengembangkan antarmuka pengguna untuk aplikasi web menggunakan ReactJS dan TailwindCSS.'),
(2, 'Internship di BAWASLU Kota Kupang', '2023', 'Magang', 'Mengembangkan aplikasi Pengaduan Masyarakat dengan Laravel sebagai bagian dari program magang.'),
(3, 'Freelance Front-End Developer', '2023', 'Freelance', 'Menyediakan layanan pengembangan front-end menggunakan ReactJS, TailwindCSS, dan Bootstrap untuk beberapa klien.'),
(4, 'Pembuatan Website Portofolio Pribadi', '2023', 'Proyek Pribadi', 'Merancang dan mengembangkan website portofolio pribadi untuk menampilkan proyek-proyek pengembangan web saya menggunakan ReactJS dan TailwindCSS.');

-- --------------------------------------------------------

--
-- Table structure for table `profil`
--

CREATE TABLE `profil` (
  `id` int(11) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `umur` int(50) NOT NULL,
  `telepon` int(25) NOT NULL,
  `email` varchar(50) NOT NULL,
  `instagram` varchar(20) NOT NULL,
  `tiktok` varchar(20) NOT NULL,
  `deskripsi` text NOT NULL,
  `gambar` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `profil`
--

INSERT INTO `profil` (`id`, `nama`, `umur`, `telepon`, `email`, `instagram`, `tiktok`, `deskripsi`, `gambar`) VALUES
(1, 'Aldi', 22, 1010101, 'aldi@example.com', '@aldi', '@aldi', 'asdasdasd', 'assets/img/gallery/67ab5cb3a9671.jpeg');

-- --------------------------------------------------------

--
-- Table structure for table `skill`
--

CREATE TABLE `skill` (
  `id` int(11) NOT NULL,
  `skill` varchar(50) NOT NULL,
  `presentase` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `skill`
--

INSERT INTO `skill` (`id`, `skill`, `presentase`) VALUES
(1, 'HTML', 90),
(2, 'CSS', 85),
(3, 'JavaScript', 80),
(4, 'ReactJS', 75),
(6, 'PHP', 60),
(7, 'MySQL', 70);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(10) NOT NULL,
  `username` varchar(15) NOT NULL,
  `password` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `password`) VALUES
(1, 'admin', 'admin');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `pendidikan`
--
ALTER TABLE `pendidikan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pengalaman`
--
ALTER TABLE `pengalaman`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `profil`
--
ALTER TABLE `profil`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `skill`
--
ALTER TABLE `skill`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `pendidikan`
--
ALTER TABLE `pendidikan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `pengalaman`
--
ALTER TABLE `pengalaman`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `profil`
--
ALTER TABLE `profil`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `skill`
--
ALTER TABLE `skill`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

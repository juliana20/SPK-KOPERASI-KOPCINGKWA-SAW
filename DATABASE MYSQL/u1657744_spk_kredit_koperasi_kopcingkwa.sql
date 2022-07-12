-- phpMyAdmin SQL Dump
-- version 4.9.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jul 10, 2022 at 09:41 PM
-- Server version: 10.5.15-MariaDB-cll-lve
-- PHP Version: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `spk_kredit_koperasi_kopcingkwa`
--

-- --------------------------------------------------------

--
-- Table structure for table `tb_alternatif`
--

CREATE TABLE `tb_alternatif` (
  `id` int(11) NOT NULL,
  `kode_alternatif` varchar(10) DEFAULT NULL,
  `id_debitur` int(11) DEFAULT NULL,
  `aktif` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_alternatif`
--

INSERT INTO `tb_alternatif` (`id`, `kode_alternatif`, `id_debitur`, `aktif`) VALUES
(1, 'A1', 1, 1),
(2, 'A2', 2, 1),
(4, 'A3', 5, 1),
(5, 'A4', 4, 1),
(6, 'A5', 6, 1),
(7, 'A6', 7, 1),
(8, 'A7', 8, 1),
(9, 'A8', 9, 1),
(10, 'A9', 10, 1),
(11, 'A10', 11, 1),
(12, 'A11', 12, 1),
(13, 'A12', 13, 1),
(14, 'A13', 14, 1),
(15, 'A14', 15, 1),
(16, 'A15', 16, 1),
(17, 'A16', 17, 1),
(18, 'A17', 18, 1),
(19, 'A18', 19, 1),
(20, 'A19', 20, 1),
(21, 'A20', 21, 1),
(22, 'A21', 22, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tb_bobot_kriteria`
--

CREATE TABLE `tb_bobot_kriteria` (
  `key` varchar(100) DEFAULT NULL,
  `value` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_bobot_kriteria`
--

INSERT INTO `tb_bobot_kriteria` (`key`, `value`) VALUES
('c1', '0.19'),
('c2', '0.17'),
('c3', '0.16'),
('c4', '0.14'),
('c5', '0.10'),
('c6', '0.13'),
('c7', '0.11');

-- --------------------------------------------------------

--
-- Table structure for table `tb_debitur`
--

CREATE TABLE `tb_debitur` (
  `id` int(11) NOT NULL,
  `id_debitur` varchar(100) DEFAULT NULL,
  `nama_debitur` varchar(100) DEFAULT NULL,
  `alamat_debitur` varchar(100) DEFAULT NULL,
  `telepon` varchar(15) DEFAULT NULL,
  `tanggal_lahir` date DEFAULT NULL,
  `jenis_kelamin` varchar(20) DEFAULT NULL,
  `pekerjaan` varchar(20) DEFAULT NULL,
  `id_pengguna` int(11) DEFAULT NULL,
  `aktif` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_debitur`
--

INSERT INTO `tb_debitur` (`id`, `id_debitur`, `nama_debitur`, `alamat_debitur`, `telepon`, `tanggal_lahir`, `jenis_kelamin`, `pekerjaan`, `id_pengguna`, `aktif`) VALUES
(1, 'DB00001', 'Komang Ayu Laksmi', 'Gianyar', '081999897333', '2000-01-13', 'L', 'Wiraswasta', 3, 1),
(2, 'DB00002', 'Nengah Suantra', 'Bedulu, Gianyar', '081999897123', '1998-01-20', 'P', 'PNS', 4, 1),
(3, 'DB00003', 'Raya', 'Cirebon', '081239261321', '1976-08-13', 'L', 'Wiraswasta', 7, 0),
(4, 'DB00004', 'kadek yoga', 'ubud', '1123456789', '2022-05-03', 'L', 'Wiraswasta', 8, 1),
(5, 'DB00005', 'Raya', 'Denpasar', '083115236534', '1999-09-13', 'P', 'Wiraswasta', 10, 1),
(6, 'DB00006', 'Anak Agung Adik Sri Utari', 'Jl. Raya Tembuku Kaler', '083114239526', '1999-09-13', 'P', 'PNS', 11, 1),
(7, 'DB00007', 'Surya Permana', 'Bondase Kaler Bangli', '081239287352', '1989-01-11', 'L', 'Wiraswasta', 12, 1),
(8, 'DB00008', 'Tania Asidikin', 'Jl Sokasasti No. 3AA', '087234557889', '1975-01-10', 'P', 'PNS', 13, 1),
(9, 'DB00009', 'Gusti Ketut Alit Suardana', 'Jl. Sejahtera Merdeka', '089255678456', '1995-09-13', 'L', 'Pengacara', 14, 1),
(10, 'DB00010', 'I Gede Yogi Saputra', 'Jalan Tengkulak Tengah', '087776896999', '1889-12-30', 'L', 'Wiraswasta', 15, 1),
(11, 'DB00011', 'Maharani Mandala', 'Jl. Raha Hati Glogor', '083114239764', '1999-08-18', 'P', 'PNS', 16, 1),
(12, 'DB00012', 'Janetra Trigatra', 'Jalan Penganggasaan Raya', '085987456123', '1999-07-17', 'L', 'Wiraswasta', 17, 1),
(13, 'DB00013', 'Trisma Satwika Suari', 'Jalan Lodtunduh Serayak', '085335887564', '2000-10-10', 'P', 'Wiraswasta', 18, 1),
(14, 'DB00014', 'Dewa Ayu Sri', 'Jl. Raya Pucak Sari', '089776876465', '1975-10-22', 'P', 'Wiraswasta', 19, 1),
(15, 'DB00015', 'Anak Agung Raka', 'Jl. Pattimura', '086458763908', '1998-07-06', 'L', 'PNS', 20, 1),
(16, 'DB00016', 'Indah Iswari Deswari', 'Jl. Hanoman Raya', '083115297309', '1997-03-10', 'P', 'Wiraswasta', 21, 1),
(17, 'DB00017', 'Zoro Nasrani', 'Jl. Dewi Sita', '089776445887', '1986-11-23', 'L', 'Pengacara', 22, 1),
(18, 'DB00018', 'Lufty Agata Putra', 'Jl. Greand Land', '089771225342', '1977-11-11', 'L', 'PNS', 23, 1),
(19, 'DB00019', 'Rama Putra Wijaya', 'Jl. Hati Attack', '091999877109', '1999-06-24', 'L', 'Pengacara', 24, 1),
(20, 'DB00020', 'Devi Damayanti', 'Jl. Mas Buawana', '089665129873', '1980-11-08', 'P', 'Wiraswasta', 25, 1),
(21, 'DB00021', 'Ayu Sri Undari', 'Jl. Seminyak Gita', '087123456987', '1995-03-12', 'P', 'Wiraswasta', 26, 1),
(22, 'DB00022', 'Cokorda Istri Praminandya', 'Jalan Cianjur Paku', '087440886543', '2000-10-22', 'P', 'Wiraswasta', 27, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tb_hasil`
--

CREATE TABLE `tb_hasil` (
  `id` int(11) NOT NULL,
  `id_pinjaman` varchar(20) DEFAULT NULL,
  `alternatif` varchar(20) DEFAULT NULL,
  `c1` varchar(20) DEFAULT NULL,
  `c2` varchar(20) DEFAULT NULL,
  `c3` varchar(20) DEFAULT NULL,
  `c4` varchar(20) DEFAULT NULL,
  `c5` varchar(20) DEFAULT NULL,
  `c6` varchar(20) DEFAULT NULL,
  `c7` varchar(20) DEFAULT NULL,
  `hasil_akhir` varchar(20) DEFAULT NULL,
  `keputusan` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_hasil`
--

INSERT INTO `tb_hasil` (`id`, `id_pinjaman`, `alternatif`, `c1`, `c2`, `c3`, `c4`, `c5`, `c6`, `c7`, `hasil_akhir`, `keputusan`, `created_at`) VALUES
(29, 'PNJ000001', 'A1', '0.08', '0.04', '0.08', '0.05', '0.02', '0.08', '0.05', '0.39', 'Dipertimbangkan', '2022-07-05 06:01:31'),
(30, 'PNJ000002', 'A2', '0.11', '0.17', '0.08', '0.05', '0.08', '0.13', '0.11', '0.73', 'Direkomendasikan', '2022-07-05 06:01:31'),
(31, 'PNJ000003', 'A2', '0.19', '0.13', '0.16', '0.14', '0.1', '0.13', '0.11', '0.96', 'Sangat Direkomendasikan', '2022-07-05 06:01:31'),
(32, 'PNJ000004', 'A3', '0.19', '0.13', '0.12', '0.14', '0.02', '0.05', '0.11', '0.76', 'Sangat Direkomendasikan', '2022-07-05 06:01:31'),
(33, 'PNJ000005', 'A4', '0.04', '0.04', '0.04', '0.02', '0.08', '0.05', '0.05', '0.32', 'Dipertimbangkan', '2022-07-05 06:01:31'),
(34, 'PNJ000006', 'A5', '0.15', '0.09', '0.08', '0.05', '0.1', '0.08', '0.05', '0.59', 'Direkomendasikan', '2022-07-05 06:01:31'),
(35, 'PNJ000007', 'A6', '0.08', '0.04', '0.04', '0.02', '0.08', '0.05', '0.11', '0.42', 'Dipertimbangkan', '2022-07-05 06:01:31'),
(36, 'PNJ000008', 'A7', '0.15', '0.09', '0.08', '0.05', '0.02', '0.08', '0.11', '0.58', 'Direkomendasikan', '2022-07-05 06:01:31'),
(37, 'PNJ000009', 'A8', '0.19', '0.04', '0.08', '0.08', '0.08', '0.05', '0.05', '0.57', 'Direkomendasikan', '2022-07-05 06:01:31'),
(38, 'PNJ000010', 'A9', '0.04', '0.04', '0.04', '0.02', '0.02', '0.05', '0.05', '0.26', 'Dipertimbangkan', '2022-07-05 06:01:31'),
(39, 'PNJ000011', 'A10', '0.15', '0.04', '0.08', '0.05', '0.1', '0.08', '0.11', '0.61', 'Direkomendasikan', '2022-07-05 06:01:31'),
(40, 'PNJ000012', 'A11', '0.11', '0.09', '0.04', '0.05', '0.02', '0.13', '0.05', '0.49', 'Dipertimbangkan', '2022-07-05 06:01:31'),
(41, 'PNJ000013', 'A12', '0.19', '0.13', '0.12', '0.08', '0.08', '0.05', '0.11', '0.76', 'Sangat Direkomendasikan', '2022-07-05 06:01:31'),
(42, 'PNJ000014', 'A13', '0.11', '0.09', '0.04', '0.05', '0.02', '0.13', '0.05', '0.49', 'Dipertimbangkan', '2022-07-05 06:01:31'),
(43, 'PNJ000015', 'A14', '0.15', '0.09', '0.04', '0.05', '0.08', '0.08', '0.11', '0.6', 'Direkomendasikan', '2022-07-05 06:01:31'),
(44, 'PNJ000016', 'A15', '0.19', '0.09', '0.08', '0.08', '0.02', '0.13', '0.11', '0.69', 'Direkomendasikan', '2022-07-05 06:01:31'),
(45, 'PNJ000017', 'A16', '0.15', '0.04', '0.08', '0.11', '0.08', '0.05', '0.05', '0.56', 'Direkomendasikan', '2022-07-05 06:01:31'),
(46, 'PNJ000018', 'A17', '0.15', '0.09', '0.08', '0.08', '0.08', '0.08', '0.11', '0.66', 'Direkomendasikan', '2022-07-05 06:01:31'),
(47, 'PNJ000019', 'A18', '0.11', '0.09', '0.04', '0.08', '0.08', '0.05', '0.05', '0.5', 'Dipertimbangkan', '2022-07-05 06:01:31'),
(48, 'PNJ000020', 'A19', '0.19', '0.13', '0.08', '0.08', '0.08', '0.13', '0.11', '0.8', 'Sangat Direkomendasikan', '2022-07-05 06:01:31'),
(49, 'PNJ000021', 'A20', '0.15', '0.09', '0.08', '0.05', '0.02', '0.13', '0.05', '0.56', 'Direkomendasikan', '2022-07-05 06:01:31'),
(50, 'PNJ000020', 'A19', '0.19', '0.13', '0.08', '0.08', '0.08', '0.13', '0.11', '0.8', 'Sangat Direkomendasikan', '2022-07-05 06:01:31');

-- --------------------------------------------------------

--
-- Table structure for table `tb_hasil_normalisasi`
--

CREATE TABLE `tb_hasil_normalisasi` (
  `id` int(11) NOT NULL,
  `id_pinjaman` varchar(20) DEFAULT NULL,
  `alternatif` varchar(10) DEFAULT NULL,
  `c1` varchar(20) DEFAULT NULL,
  `c2` varchar(20) DEFAULT NULL,
  `c3` varchar(20) DEFAULT NULL,
  `c4` varchar(20) DEFAULT NULL,
  `c5` varchar(20) DEFAULT NULL,
  `c6` varchar(20) DEFAULT NULL,
  `c7` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tb_kriteria`
--

CREATE TABLE `tb_kriteria` (
  `id` int(11) NOT NULL,
  `kode_kriteria` varchar(20) DEFAULT NULL,
  `nama_kriteria` varchar(100) DEFAULT NULL,
  `bobot` varchar(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_kriteria`
--

INSERT INTO `tb_kriteria` (`id`, `kode_kriteria`, `nama_kriteria`, `bobot`) VALUES
(1, 'C1', 'Jumlah Pinjaman', '0.19'),
(2, 'C2', 'Jangka Waktu', '0.17'),
(3, 'C3', 'Jaminan', '0.16'),
(4, 'C4', 'Pendapatan Perbulan', '0.14'),
(5, 'C5', 'Riawayat Meminjam', '0.10'),
(6, 'C6', 'Pekerjaan', '0.13'),
(7, 'C7', 'Jenis Pinjaman', '0.11');

-- --------------------------------------------------------

--
-- Table structure for table `tb_pengguna`
--

CREATE TABLE `tb_pengguna` (
  `id` int(11) NOT NULL,
  `id_pengguna` varchar(20) DEFAULT NULL,
  `nama` varchar(250) DEFAULT NULL,
  `username` varchar(100) DEFAULT NULL,
  `password` varchar(250) DEFAULT NULL,
  `jabatan` varchar(15) DEFAULT NULL,
  `jenis_kelamin` varchar(15) DEFAULT NULL,
  `telepon` varchar(15) DEFAULT NULL,
  `alamat` varchar(100) DEFAULT NULL,
  `aktif` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_pengguna`
--

INSERT INTO `tb_pengguna` (`id`, `id_pengguna`, `nama`, `username`, `password`, `jabatan`, `jenis_kelamin`, `telepon`, `alamat`, `aktif`) VALUES
(1, 'U001', 'I Nyoman Antara', 'admin', '$2y$10$NQDDRFAV0dG7gfCZROtq8OXNhGdvZN7hsl25Xs96n3cl2s39djK2.', 'Admin', 'L', '081999897555', 'Gianyar', 1),
(2, 'U002', 'Wayan Sueca', 'ketua', '$2y$10$MAD6CIaVyfTG2kvivAiSQej9Kejrck/O0PTaxiZZ32WiHNPQHOhAa', 'Ketua', 'L', '081999897123', 'Tabanan', 1),
(3, 'U003', 'Komang Ayu Laksmi', 'laksmi', '$2y$10$G/Bnxm24N9u4FB/bjSHfPO1k1P6mKha6nTeOdk.j7E5bktc89FAo.', 'Debitur', 'L', '081999897333', 'Gianyar', 1),
(4, 'U004', 'Nengah Suantra', 'suantra', '$2y$10$uAYmQHGal3cKPMJiHt2QPu4qZ1cffP9hJVNut3eXjHn22EUunSrSC', 'Debitur', 'P', '081999897123', 'Bedulu, Gianyar', 1),
(5, 'U005', 'Pasek', 'admin', '$2y$10$9wYcZLRbwlXidi5f330jguJtgSd5kh60oSkoLA6gfbIm2fdDxDC4e', 'Admin', 'L', '083114239526', 'Petulu', 1),
(6, 'U006', 'Gung Adik', 'ketua', '$2y$10$lAqscZ66D3bIZ.1B3JN8wOpMMphTO6BLtO5WlDlcHBpFQWF5Ij1km', 'Ketua', 'P', '083114239526', 'Gianyar', 1),
(7, 'U007', 'Raya', 'debitur', '$2y$10$rB3xxgTyuehE4mJn8iUNAOpWC/xSaswbdvTbl/7mUMCK9MFq1EHSe', 'Debitur', 'L', '081239261321', 'Cirebon', 1),
(8, 'U008', 'kadek yoga', 'yoga', '$2y$10$.kYHlx8OZLi9FaMf2/QHtuvTE0qDEofTP9b.H/HaZ4MOCH1WQFZL.', 'Debitur', 'L', '1123456789', 'ubud', 1),
(9, 'U009', 'Nugrahita', 'admin', '$2y$10$NscrWN5dpF7b.VdV6fmULOsowdYtwjdD.faESit0c2op7AClUF1.6', 'Admin', 'P', '081238245321', 'Denpasar', 1),
(10, 'U010', 'Raya', 'admin', '$2y$10$YfVzl7XHvLPuaffpK5TCr.Sbj4gG2Y0uApjSt69Wiy.lhXB2T9RkW', 'Debitur', 'P', '083115236534', 'Denpasar', 1),
(11, 'U001', 'Anak Agung Adik Sri Utari', 'admin', '$2y$10$W2X35qq6lMrR8Qfp8ZxvI.vc.p4jenuGBTrFuJUiUwo/5qWio3Jlm', 'Debitur', 'P', '083114239526', 'Jl. Raya Tembuku Kaler', 1),
(12, 'U001', 'Surya Permana', 'admin', '$2y$10$0raEqhODnv2pBhXgSTjFRekdWsi.MaatTmZXaqOX1Lvlz5o/Jr4WW', 'Debitur', 'L', '081239287352', 'Bondase Kaler Bangli', 1),
(13, 'U001', 'Tania Asidikin', 'admin', '$2y$10$SQs12JwDMvTDeAxM1C30kervjzUA2Ohi.ZmEmnCjmPFCq9Mu.bZli', 'Debitur', 'P', '087234557889', 'Jl Sokasasti No. 3AA', 1),
(14, 'U001', 'Gusti Ketut Alit Suardana', 'admin', '$2y$10$HmVkBnLYwVHJUpltpCqd6.egvAtV98BDHZ.6a3kV1Kjbo03oFzJKW', 'Debitur', 'L', '089255678456', 'Jl. Sejahtera Merdeka', 1),
(15, 'U001', 'I Gede Yogi Saputra', 'admin', '$2y$10$sxuWtHz/t7Nm3GWusERE5u246B3ThT79PF9t4p4TpUQ4w/16Obtb.', 'Debitur', 'L', '087776896999', 'Jalan Tengkulak Tengah', 1),
(16, 'U001', 'Maharani Mandala', 'admin', '$2y$10$x8WcxE.LNqHyPL6xG0RcdeHP48LO5Ck.KGVKBPTB7/UPMur2ZahNe', 'Debitur', 'P', '083114239764', 'Jl. Raha Hati Glogor', 1),
(17, 'U001', 'Janetra Trigatra', 'admin', '$2y$10$Jhg9RzdFE44qT0cmRLqGlursDHRoH2Hl1r/rSaTk507q5fsu3mDWC', 'Debitur', 'L', '085987456123', 'Jalan Penganggasaan Raya', 1),
(18, 'U001', 'Trisma Satwika Suari', 'admin', '$2y$10$bHWx6FZczbSkablAazTbZ.mpZJ0h32Wv/hWLpS59qRpV4cT2NA1hu', 'Debitur', 'P', '085335887564', 'Jalan Lodtunduh Serayak', 1),
(19, 'U001', 'Dewa Ayu Sri', 'admin', '$2y$10$6edJAArlLh49.7sXEmk.9exqLhSaXIWMr5UD0uHkRlCr1M1qUHDci', 'Debitur', 'P', '089776876465', 'Jl. Raya Pucak Sari', 1),
(20, 'U001', 'Anak Agung Raka', 'admin', '$2y$10$mALbEHed4T9wUSg4kolr0eV0p9/GUwMGqp.p27L22L8amfvnMggSu', 'Debitur', 'L', '086458763908', 'Jl. Pattimura', 1),
(21, 'U001', 'Indah Iswari Deswari', 'admin', '$2y$10$xbOGu88Z1/wsr1JIeHs7w.8eAZPbYe96aTV2oFTLV3zAU20qBSQo.', 'Debitur', 'P', '083115297309', 'Jl. Hanoman Raya', 1),
(22, 'U001', 'Zoro Nasrani', 'admin', '$2y$10$Mw3yu8axKZrEdIlavsPoROfMjNZSBhaB3WGV/k6DQ5DiyHhQX.EAy', 'Debitur', 'L', '089776445887', 'Jl. Dewi Sita', 1),
(23, 'U001', 'Lufty Agata Putra', 'admin', '$2y$10$SQ3j6DfdvPRzRqVic6Yfy.h5fp3FQEcgNf7WUQCU4xeiDUH5e2nTi', 'Debitur', 'L', '089771225342', 'Jl. Greand Land', 1),
(24, 'U001', 'Rama Putra Wijaya', 'admin', '$2y$10$wstnTIyigaM9HIr7n5IdDeXwe/GDy2C2sv3/lmMF1HWsS3dYD31eu', 'Debitur', 'L', '091999877109', 'Jl. Hati Attack', 1),
(25, 'U001', 'Devi Damayanti', 'admin', '$2y$10$ahMNPZ/H5jY6YOfHboVQIejOUuvdg/VcrwXYGgrIF12B7PPs5Rc6i', 'Debitur', 'P', '089665129873', 'Jl. Mas Buawana', 1),
(26, 'U001', 'Ayu Sri Undari', 'admin', '$2y$10$jzp56sErJf8buahk4F6w9uXktyZHazNhDdUJG.R6wb/Gr4JEnADFS', 'Debitur', 'P', '087123456987', 'Jl. Seminyak Gita', 1),
(27, 'U001', 'Cokorda Istri Praminandya', 'admin', '$2y$10$ntnxqb6iKEMIIphSe5swQOPXtm083VzZHUenGzij8RTNkqPHb0.Dy', 'Debitur', 'P', '087440886543', 'Jalan Cianjur Paku', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tb_pinjaman`
--

CREATE TABLE `tb_pinjaman` (
  `id` int(11) NOT NULL,
  `id_pinjaman` varchar(20) DEFAULT NULL,
  `id_alternatif` int(11) DEFAULT NULL,
  `tanggal_pinjaman` date DEFAULT NULL,
  `jaminan` varchar(100) DEFAULT NULL,
  `jumlah_pinjaman` varchar(100) DEFAULT NULL,
  `pekerjaan` varchar(100) DEFAULT NULL,
  `jenis_pinjaman` varchar(100) DEFAULT NULL,
  `pendapatan_perbulan` varchar(100) DEFAULT NULL,
  `riwayat_meminjam` varchar(100) DEFAULT NULL,
  `jangka_waktu` varchar(100) DEFAULT NULL,
  `sudah_proses` tinyint(1) DEFAULT 0,
  `aktif` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_pinjaman`
--

INSERT INTO `tb_pinjaman` (`id`, `id_pinjaman`, `id_alternatif`, `tanggal_pinjaman`, `jaminan`, `jumlah_pinjaman`, `pekerjaan`, `jenis_pinjaman`, `pendapatan_perbulan`, `riwayat_meminjam`, `jangka_waktu`, `sudah_proses`, `aktif`) VALUES
(1, 'PNJ000001', 1, '2022-04-14', '10', '2', '21', '25', '14', '20', '5', 1, 1),
(2, 'PNJ000002', 2, '2022-04-15', '10', '3', '23', '24', '14', '18', '8', 1, 1),
(3, 'PNJ000003', 2, '2022-05-30', '12', '26', '23', '24', '17', '19', '7', 1, 0),
(4, 'PNJ000004', 4, '2022-06-30', '11', '26', '22', '24', '17', '20', '7', 1, 1),
(5, 'PNJ000005', 5, '2022-06-30', '9', '1', '22', '25', '13', '18', '5', 1, 1),
(6, 'PNJ000006', 6, '2022-06-30', '10', '4', '21', '25', '14', '19', '6', 1, 1),
(7, 'PNJ000007', 7, '2022-06-30', '9', '2', '22', '24', '13', '18', '5', 1, 1),
(8, 'PNJ000008', 8, '2022-07-04', '10', '4', '21', '24', '14', '20', '6', 1, 1),
(9, 'PNJ000009', 9, '2022-07-03', '10', '26', '22', '25', '15', '18', '5', 1, 1),
(10, 'PNJ000010', 10, '2022-07-01', '9', '1', '22', '25', '13', '20', '5', 1, 1),
(11, 'PNJ000011', 11, '2022-07-04', '10', '4', '21', '24', '14', '19', '5', 1, 1),
(12, 'PNJ000012', 12, '2022-07-05', '9', '3', '23', '25', '14', '20', '6', 1, 1),
(13, 'PNJ000013', 13, '2022-07-05', '11', '26', '22', '24', '15', '18', '7', 1, 1),
(14, 'PNJ000014', 14, '2022-07-05', '9', '3', '23', '25', '14', '20', '6', 1, 1),
(15, 'PNJ000015', 15, '2022-07-05', '9', '4', '21', '24', '14', '18', '6', 1, 1),
(16, 'PNJ000016', 16, '2022-07-06', '10', '26', '23', '24', '15', '20', '6', 1, 1),
(17, 'PNJ000017', 17, '2022-07-06', '10', '4', '22', '25', '16', '18', '5', 1, 1),
(18, 'PNJ000018', 18, '2022-07-06', '10', '4', '21', '24', '15', '18', '6', 1, 1),
(19, 'PNJ000019', 19, '2022-07-06', '9', '3', '22', '25', '15', '18', '6', 1, 1),
(20, 'PNJ000020', 20, '2022-07-07', '10', '26', '23', '24', '15', '18', '7', 1, 1),
(21, 'PNJ000021', 21, '2022-07-07', '10', '4', '23', '25', '14', '20', '6', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tb_sub_kriteria`
--

CREATE TABLE `tb_sub_kriteria` (
  `id` int(11) NOT NULL,
  `kode_kriteria` varchar(20) DEFAULT NULL,
  `nama_sub_kriteria` varchar(100) DEFAULT NULL,
  `nilai` float DEFAULT NULL,
  `bobot` varchar(10) DEFAULT NULL,
  `aktif` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_sub_kriteria`
--

INSERT INTO `tb_sub_kriteria` (`id`, `kode_kriteria`, `nama_sub_kriteria`, `nilai`, `bobot`, `aktif`) VALUES
(1, 'C1', '500 Ribu s/d 1 Jutas', 10, '0.1', 1),
(2, 'C1', 'Lebih dari 1 Juta s/d 10 Juta', 20, '0.2', 1),
(3, 'C1', 'Lebih dari 10 Juta s/d 50 Juta', 30, '0.3', 1),
(4, 'C1', 'Lebih dari 50 Juta', 40, '0.4', 1),
(5, 'C2', '6 bulan s/d 12 bulan', 10, '0.1', 1),
(6, 'C2', 'Lebih dari 12 bulan s/d 18 bulan', 20, '0.2', 1),
(7, 'C2', 'Lebih dari 18 bulan s/d 24 bulan', 30, '0.3', 1),
(8, 'C2', 'Lebih dari 24 bulan s/d 60 bulan', 40, '0.4', 1),
(9, 'C3', '1 juta s/d 10 juta', 10, '0.1', 1),
(10, 'C3', 'Lebih dari 10 juta s/d 100 juta', 20, '0.2', 1),
(11, 'C3', 'Lebih dari 100 juta s/d 500 juta', 30, '0.3', 1),
(12, 'C3', 'Lebih dari 500 juta', 40, '0.4', 1),
(13, 'C4', '1 juta s/d 2 juta', 5, '0.05', 1),
(14, 'C4', 'Lebih dari 2 juta s/d 5 juta', 12.5, '0.125', 1),
(15, 'C4', 'Lebih dari 5 juta s/d 10 juta', 20, '0.2', 1),
(16, 'C4', 'Lebih dari 10 juta s/d 20 juta', 27.5, '0.275', 1),
(17, 'C4', 'Lebih dari 20 jut', 35, '0.35', 1),
(18, 'C5', 'Belum Pernah', 40, '0.4', 1),
(19, 'C5', 'Pernah Lancar', 50, '0.5', 1),
(20, 'C5', 'Pernah Macet', 10, '0.1', 1),
(21, 'C6', 'PNS', 30, '0.3', 1),
(22, 'C6', 'Swasta', 20, '0.2', 1),
(23, 'C6', 'Pengusaha', 50, '0.5', 1),
(24, 'C7', 'Modal Usaha', 70, '0.7', 1),
(25, 'C7', 'Konsumtif', 30, '0.3', 1),
(26, 'C1', 'Lebih dari 100 juta', 50, '0.5', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_alternatif`
--
ALTER TABLE `tb_alternatif`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_debitur`
--
ALTER TABLE `tb_debitur`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_hasil`
--
ALTER TABLE `tb_hasil`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_hasil_normalisasi`
--
ALTER TABLE `tb_hasil_normalisasi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_kriteria`
--
ALTER TABLE `tb_kriteria`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_pengguna`
--
ALTER TABLE `tb_pengguna`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_pinjaman`
--
ALTER TABLE `tb_pinjaman`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_sub_kriteria`
--
ALTER TABLE `tb_sub_kriteria`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_alternatif`
--
ALTER TABLE `tb_alternatif`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `tb_debitur`
--
ALTER TABLE `tb_debitur`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `tb_hasil`
--
ALTER TABLE `tb_hasil`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT for table `tb_hasil_normalisasi`
--
ALTER TABLE `tb_hasil_normalisasi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- AUTO_INCREMENT for table `tb_kriteria`
--
ALTER TABLE `tb_kriteria`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tb_pengguna`
--
ALTER TABLE `tb_pengguna`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `tb_pinjaman`
--
ALTER TABLE `tb_pinjaman`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `tb_sub_kriteria`
--
ALTER TABLE `tb_sub_kriteria`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

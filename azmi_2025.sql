-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 18, 2025 at 03:49 PM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 7.4.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `azmi_2025`
--

-- --------------------------------------------------------

--
-- Table structure for table `ci_sessions`
--

DROP TABLE IF EXISTS `ci_sessions`;
CREATE TABLE `ci_sessions` (
  `id` varchar(128) NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `timestamp` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `data` blob NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ci_sessions`
--

INSERT INTO `ci_sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES
('dug8b087tg05nnp8v31aivch6nrgcf6u', '192.168.100.4', 1742294401, 0x5f5f63695f6c6173745f726567656e65726174657c693a313734323239343231323b757365726e616d657c733a353a2261646d696e223b6e616d617c733a31313a2241646d696e205574616d61223b6c6f676765645f696e7c623a313b616b7365737c733a343a22726f6f74223b),
('ho9vithoo5qfo745a28qee3psbnjq2fu', '::1', 1742308836, 0x5f5f63695f6c6173745f726567656e65726174657c693a313734323330383833313b757365726e616d657c733a353a2261646d696e223b6e616d617c733a31313a2241646d696e205574616d61223b6c6f676765645f696e7c623a313b616b7365737c733a343a22726f6f74223b),
('jqapvu9lbsu6p0n9hjoent42eob6h90b', '192.168.10.77', 1742264447, 0x5f5f63695f6c6173745f726567656e65726174657c693a313734323236343230383b757365726e616d657c733a353a2261646d696e223b6e616d617c733a31313a2241646d696e205574616d61223b6c6f676765645f696e7c623a313b616b7365737c733a343a22726f6f74223b),
('k7k79rl6ov5g2hh27l55qg1ne446lujl', '192.168.10.77', 1742284872, 0x5f5f63695f6c6173745f726567656e65726174657c693a313734323238343732313b757365726e616d657c733a353a2261646d696e223b6e616d617c733a31313a2241646d696e205574616d61223b6c6f676765645f696e7c623a313b616b7365737c733a343a22726f6f74223b),
('la00t77bi1eishsibnn0d9471g2h46e7', '::1', 1742271194, 0x5f5f63695f6c6173745f726567656e65726174657c693a313734323237313139343b),
('ur7b1pv3g3nfcr5b8r9scdbscrhsd3r2', '::1', 1742263854, 0x5f5f63695f6c6173745f726567656e65726174657c693a313734323236333835343b);

-- --------------------------------------------------------

--
-- Table structure for table `master_babar`
--

DROP TABLE IF EXISTS `master_babar`;
CREATE TABLE `master_babar` (
  `id_barbar` int(11) NOT NULL,
  `jenis_babaran` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `master_babar`
--

INSERT INTO `master_babar` (`id_barbar`, `jenis_babaran`) VALUES
(1, 'BABAR PISAN POLA LUZA'),
(4, 'BABAR PINDO CAP 3X'),
(5, 'BABAR 3X KUNINGAN'),
(6, 'BABAR TIEDYE CAP'),
(7, 'NOM TUO KAJI ATA'),
(10, '2X MARUN, SERI MOTIF'),
(11, 'BIRUNAN, SERI MOTIF'),
(12, '2X WARNA CERAH');

-- --------------------------------------------------------

--
-- Table structure for table `master_jahiten`
--

DROP TABLE IF EXISTS `master_jahiten`;
CREATE TABLE `master_jahiten` (
  `id_msj` int(11) NOT NULL,
  `kode_penjahit` varchar(30) NOT NULL,
  `jenis_jahitan` varchar(50) NOT NULL,
  `model_jahitan` varchar(50) NOT NULL,
  `harga_jahitan` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `master_jahiten`
--

INSERT INTO `master_jahiten` (`id_msj`, `kode_penjahit`, `jenis_jahitan`, `model_jahitan`, `harga_jahitan`) VALUES
(10, 'EA', 'DASTER LOWO', 'BUSUI', 6000),
(11, 'EA', 'GAMIS TRUNTUM', 'BUSUI', 9000),
(12, 'EA', 'GAMIS', 'FELA', 8500),
(13, 'EA', 'GAMIS', 'BUSUI', 8500),
(14, 'LM', 'DASTER LOWO', 'BUSUI', 6000),
(15, 'LM', 'LONGDRESS LOWO', 'BUSUI', 6500),
(16, 'LM', 'KAFTAN', 'BUSUI', 7000),
(17, 'LM', 'GAMIS TRUNTUM', 'BUSUI', 9000),
(18, 'LM', 'GAMIS', 'FELA', 8500),
(19, 'LM', 'GAMIS ', 'BUSUI', 8500),
(20, 'IP', 'GAMIS', 'FELA', 8500),
(21, 'IP', 'GAMIS', 'BUSUI', 8500),
(22, 'IP', 'LONGDRESS LOWO', 'BUSUI', 6500),
(23, 'UC', 'GAMIS TRUNTUM', 'BUSUI', 8500);

-- --------------------------------------------------------

--
-- Table structure for table `master_kain`
--

DROP TABLE IF EXISTS `master_kain`;
CREATE TABLE `master_kain` (
  `id_kain` int(11) NOT NULL,
  `nama_kain` varchar(50) NOT NULL,
  `konstruksi_kain` varchar(50) NOT NULL,
  `inisial` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `master_kain`
--

INSERT INTO `master_kain` (`id_kain`, `nama_kain`, `konstruksi_kain`, `inisial`) VALUES
(8, 'SAMITEX SUPER', '84.60.L120', 'SM'),
(9, 'SAMITEX SUPER DOUBLE', '84.60.L150', 'SMD'),
(10, 'SAFARITEX L90', '84.60.L90', 'SFL');

-- --------------------------------------------------------

--
-- Table structure for table `master_karyawan`
--

DROP TABLE IF EXISTS `master_karyawan`;
CREATE TABLE `master_karyawan` (
  `id_karyawan` int(11) NOT NULL,
  `nama_kar` varchar(50) NOT NULL,
  `nik` varchar(20) NOT NULL,
  `tanggal_awal` date NOT NULL,
  `no_wa` varchar(20) NOT NULL,
  `alamat_kar` varchar(244) NOT NULL,
  `status_aktif` enum('Aktif','Resign') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `master_karyawan`
--

INSERT INTO `master_karyawan` (`id_karyawan`, `nama_kar`, `nik`, `tanggal_awal`, `no_wa`, `alamat_kar`, `status_aktif`) VALUES
(1, 'ADI SUBUHADIR', '3375021607960002', '2025-01-20', '089651253545', 'Kuripan Kidul Gg.2 No.134', 'Aktif'),
(2, 'BIMA PRASETYA SAPUTRA', '3375021607960029', '2024-03-02', '08976271611', 'owek ', 'Aktif'),
(4, 'AZMI', '3375022812960003', '2025-02-02', '087812426261', 'Kartini Pekalongan', 'Aktif');

-- --------------------------------------------------------

--
-- Table structure for table `master_pembatik`
--

DROP TABLE IF EXISTS `master_pembatik`;
CREATE TABLE `master_pembatik` (
  `id_pembatik` int(11) NOT NULL,
  `nama_pembatik` varchar(50) NOT NULL,
  `alamat` varchar(100) NOT NULL,
  `kode_pembatik` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `master_pembatik`
--

INSERT INTO `master_pembatik` (`id_pembatik`, `nama_pembatik`, `alamat`, `kode_pembatik`) VALUES
(5, 'FATHUR ROHMAN', 'Samborejo-Tirto', 'FT'),
(6, 'MAHCFUD', 'Krapyak', 'MF'),
(7, 'GUNAWAN', 'Tirto', 'GN'),
(8, 'WILDAN', 'Krapyak', 'WN'),
(9, 'ZEN', 'Kertoharjo', 'ZN');

-- --------------------------------------------------------

--
-- Table structure for table `master_pemotong`
--

DROP TABLE IF EXISTS `master_pemotong`;
CREATE TABLE `master_pemotong` (
  `id_ptg` int(11) NOT NULL,
  `nama_ptg` varchar(35) NOT NULL,
  `kode_ptg` varchar(35) NOT NULL,
  `alamat` varchar(244) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `master_pemotong`
--

INSERT INTO `master_pemotong` (`id_ptg`, `nama_ptg`, `kode_ptg`, `alamat`) VALUES
(5, 'AMAK ANGGAWI', 'AA', 'Krapyak Kidul');

-- --------------------------------------------------------

--
-- Table structure for table `master_penjahit`
--

DROP TABLE IF EXISTS `master_penjahit`;
CREATE TABLE `master_penjahit` (
  `id_penjahit` int(11) NOT NULL,
  `nama_penjahit` varchar(50) NOT NULL,
  `alamat` varchar(100) NOT NULL,
  `kode_penjahit` varchar(30) NOT NULL,
  `harga_jahitan` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `master_penjahit`
--

INSERT INTO `master_penjahit` (`id_penjahit`, `nama_penjahit`, `alamat`, `kode_penjahit`, `harga_jahitan`) VALUES
(4, 'ERIYA', 'Jeruk Sari - Pekalongan', 'EA', 0),
(5, 'LIMIN', 'PEKALONGAN', 'LM', 0),
(6, 'IPUL', 'PEKALONGAN', 'IP', 0),
(7, 'UCI', 'PEKALONGAN', 'UC', 0);

-- --------------------------------------------------------

--
-- Table structure for table `master_produk`
--

DROP TABLE IF EXISTS `master_produk`;
CREATE TABLE `master_produk` (
  `id_produk` int(11) NOT NULL,
  `kode_produk` varchar(30) NOT NULL,
  `nama_produk` varchar(100) NOT NULL,
  `foto_produk` varchar(200) NOT NULL DEFAULT 'null'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `master_produk`
--

INSERT INTO `master_produk` (`id_produk`, `kode_produk`, `nama_produk`, `foto_produk`) VALUES
(1, 'DLR', 'DASTER LOWO RUBY', 'null'),
(2, 'DLK', 'DASTER LOWO KIMBERLY', 'null'),
(3, 'LLK', 'LONGDRESS LOWO KARITA', 'null'),
(6, 'GI', 'GAMIS INDIGO', 'null');

-- --------------------------------------------------------

--
-- Table structure for table `master_produk_varians`
--

DROP TABLE IF EXISTS `master_produk_varians`;
CREATE TABLE `master_produk_varians` (
  `id_varians` int(11) NOT NULL,
  `kode_produk` varchar(30) NOT NULL,
  `nama_produk` varchar(100) NOT NULL,
  `models` varchar(100) NOT NULL,
  `kode_varians` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `master_produk_varians`
--

INSERT INTO `master_produk_varians` (`id_varians`, `kode_produk`, `nama_produk`, `models`, `kode_varians`) VALUES
(1, 'DLR', 'DASTER LOWO RUBY', 'MERAH', 'DLR-1'),
(2, 'DLR', 'DASTER LOWO RUBY', 'HIJAU', 'DLR-2'),
(3, 'DLK', 'DASTER LOWO KIMBERLY', 'COKLAT', 'DLK-1'),
(4, 'LLK', 'LONGDRESS LOWO KARITA', 'MERAH', 'LLK-1'),
(7, 'GI', 'GAMIS INDIGO', 'A', 'GI-1'),
(8, 'GI', 'GAMIS INDIGO', 'B', 'GI-2');

-- --------------------------------------------------------

--
-- Table structure for table `produksi_babar`
--

DROP TABLE IF EXISTS `produksi_babar`;
CREATE TABLE `produksi_babar` (
  `id_produksi` int(11) NOT NULL,
  `kode_kain` varchar(50) NOT NULL,
  `id_pot_kain` int(11) NOT NULL,
  `jumlah_kirim` int(11) NOT NULL,
  `kode_pembatik` varchar(30) NOT NULL,
  `tgl_kirim` date NOT NULL,
  `tgl_input` datetime NOT NULL,
  `proses_babar` varchar(150) NOT NULL,
  `harga_pcs` int(11) NOT NULL,
  `harga_ttl` int(11) NOT NULL,
  `diinputoleh` varchar(30) NOT NULL,
  `codeproduksi` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `produksi_babar_fns`
--

DROP TABLE IF EXISTS `produksi_babar_fns`;
CREATE TABLE `produksi_babar_fns` (
  `id_pbf` int(11) NOT NULL,
  `codeproduksi` varchar(45) NOT NULL,
  `jumlah_pcs` int(11) NOT NULL,
  `status_fns` varchar(40) NOT NULL,
  `tgl_fns` date NOT NULL,
  `tglinput` datetime NOT NULL,
  `yginput` varchar(35) NOT NULL,
  `kode_varians` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `produksi_jahit`
--

DROP TABLE IF EXISTS `produksi_jahit`;
CREATE TABLE `produksi_jahit` (
  `id_pjhit` int(11) NOT NULL,
  `kode_babar` varchar(30) NOT NULL,
  `kode_kain` varchar(50) NOT NULL,
  `proses_babar` varchar(120) NOT NULL,
  `jumlah_kirim` int(11) NOT NULL,
  `kode_penjahit` varchar(10) NOT NULL,
  `kode_msj` int(11) NOT NULL,
  `tanggal_jahit` date NOT NULL,
  `tanggal_input` datetime NOT NULL,
  `yg_input` varchar(30) NOT NULL,
  `harga_jhit_pcs` int(11) NOT NULL,
  `harga_jhit_ttl` int(11) NOT NULL,
  `hpp1` int(11) NOT NULL,
  `hpp2` int(11) NOT NULL,
  `codeproduksi` varchar(45) NOT NULL,
  `codeproduksijhit` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `produksi_jahit_finish`
--

DROP TABLE IF EXISTS `produksi_jahit_finish`;
CREATE TABLE `produksi_jahit_finish` (
  `id_pjf` int(11) NOT NULL,
  `codeproduksijahit` varchar(45) NOT NULL,
  `tgl_masuk` date NOT NULL,
  `tgl_input` datetime NOT NULL,
  `yg_input` varchar(35) NOT NULL,
  `status_finish` varchar(30) NOT NULL,
  `jumlah_kembali` int(11) NOT NULL,
  `kode_produk` varchar(30) NOT NULL,
  `kode_varians` varchar(30) NOT NULL,
  `ukuran` varchar(20) NOT NULL,
  `codestok` varchar(35) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `produksi_jahit_use`
--

DROP TABLE IF EXISTS `produksi_jahit_use`;
CREATE TABLE `produksi_jahit_use` (
  `id_pjhuse` int(11) NOT NULL,
  `codeproduksijahit` varchar(45) NOT NULL,
  `id_skb` int(11) NOT NULL,
  `pakai` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `stok_kain`
--

DROP TABLE IF EXISTS `stok_kain`;
CREATE TABLE `stok_kain` (
  `id_stok` int(11) NOT NULL,
  `inisial_kain` varchar(25) NOT NULL,
  `jumlah_stok` double NOT NULL,
  `harga_kain_peryard` int(11) NOT NULL,
  `codestok` varchar(100) NOT NULL,
  `codesave` varchar(35) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `stok_kain`
--

INSERT INTO `stok_kain` (`id_stok`, `inisial_kain`, `jumlah_stok`, `harga_kain_peryard`, `codestok`, `codesave`) VALUES
(1, 'SM', 0, 11070, 'SM-11070', 'TSU5dsifLD4JeF2PaKtOm');

-- --------------------------------------------------------

--
-- Table structure for table `stok_kain_pakai`
--

DROP TABLE IF EXISTS `stok_kain_pakai`;
CREATE TABLE `stok_kain_pakai` (
  `id_stokpakai` int(11) NOT NULL,
  `id_stok` int(11) NOT NULL,
  `inisial_kain` varchar(35) NOT NULL,
  `stok_sebelumnya` double NOT NULL,
  `pemakaian` double NOT NULL,
  `codesaved` varchar(55) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `stok_kain_pakai`
--

INSERT INTO `stok_kain_pakai` (`id_stokpakai`, `id_stok`, `inisial_kain`, `stok_sebelumnya`, `pemakaian`, `codesaved`) VALUES
(9, 1, 'SM', 2500, 2500, 'TOsFpil5CaK4ASwgHbu');

-- --------------------------------------------------------

--
-- Table structure for table `stok_kain_potongan`
--

DROP TABLE IF EXISTS `stok_kain_potongan`;
CREATE TABLE `stok_kain_potongan` (
  `id_k_ptgan` int(11) NOT NULL,
  `inisial_kain` varchar(30) NOT NULL,
  `panjang_kain` double NOT NULL,
  `lebar_kain` double NOT NULL,
  `harga_pcs` int(11) NOT NULL,
  `harga_ptg_pcs` int(11) NOT NULL,
  `jumlah_pcs` int(11) NOT NULL,
  `code_saved` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `stok_kain_potongan`
--

INSERT INTO `stok_kain_potongan` (`id_k_ptgan`, `inisial_kain`, `panjang_kain`, `lebar_kain`, `harga_pcs`, `harga_ptg_pcs`, `jumlah_pcs`, `code_saved`) VALUES
(20, 'SM', 1.7, 1.8, 21639, 100, 200, 'TOsFpil5CaK4ASwgHbu'),
(21, 'SM', 2.05, 1.8, 26195, 100, 500, 'TOsFpil5CaK4ASwgHbu'),
(22, 'SM', 2.7, 1.8, 34167, 100, 300, 'TOsFpil5CaK4ASwgHbu');

-- --------------------------------------------------------

--
-- Table structure for table `stok_kain_proses_babar`
--

DROP TABLE IF EXISTS `stok_kain_proses_babar`;
CREATE TABLE `stok_kain_proses_babar` (
  `id_skb` int(11) NOT NULL,
  `kode_babar` varchar(30) NOT NULL,
  `codeproduksi` varchar(45) NOT NULL,
  `id_pbf` int(11) NOT NULL,
  `jumlah_pcs` int(11) NOT NULL,
  `kode_kain` varchar(40) NOT NULL,
  `proses_babar` varchar(100) NOT NULL,
  `hpp1` int(11) NOT NULL,
  `hpp2` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `stok_produk`
--

DROP TABLE IF EXISTS `stok_produk`;
CREATE TABLE `stok_produk` (
  `id_stokproduk` int(11) NOT NULL,
  `kode_produk` varchar(30) NOT NULL,
  `kode_varians` varchar(30) NOT NULL,
  `ukuran` varchar(30) NOT NULL,
  `hpp` int(11) NOT NULL,
  `harga_jual` int(11) NOT NULL,
  `codeproduksijahit` varchar(45) NOT NULL,
  `kode_produksi` varchar(60) NOT NULL,
  `codestok` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `t_pembelian_kain`
--

DROP TABLE IF EXISTS `t_pembelian_kain`;
CREATE TABLE `t_pembelian_kain` (
  `id_pembeliankain` int(11) NOT NULL,
  `inisial_kain` varchar(20) NOT NULL,
  `tgl_pembelian` date NOT NULL,
  `tgl_input` datetime NOT NULL,
  `jumlah_pembelian` double NOT NULL,
  `harga_peryard` double NOT NULL,
  `harga_total_kain` double NOT NULL,
  `nama_supplier` varchar(100) NOT NULL,
  `pembayaran` varchar(150) NOT NULL,
  `bukti_tf` varchar(200) NOT NULL,
  `bea_dll` double NOT NULL,
  `diinput` varchar(50) NOT NULL,
  `codesave` varchar(35) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `t_pembelian_kain`
--

INSERT INTO `t_pembelian_kain` (`id_pembeliankain`, `inisial_kain`, `tgl_pembelian`, `tgl_input`, `jumlah_pembelian`, `harga_peryard`, `harga_total_kain`, `nama_supplier`, `pembayaran`, `bukti_tf`, `bea_dll`, `diinput`, `codesave`) VALUES
(1, 'SM', '2025-03-03', '2025-03-18 16:49:14', 2500, 11050, 27625000, 'TOKO KAIN AWEN', 'Transfer', 'null.jpg', 50000, 'admin', 'TSU5dsifLD4JeF2PaKtOm');

-- --------------------------------------------------------

--
-- Table structure for table `t_potong_kain`
--

DROP TABLE IF EXISTS `t_potong_kain`;
CREATE TABLE `t_potong_kain` (
  `id_tptg` int(11) NOT NULL,
  `codesaved` varchar(35) NOT NULL,
  `tgl_potong` date NOT NULL,
  `tgl_input` datetime NOT NULL,
  `kode_pemotong` varchar(20) NOT NULL,
  `kode_kain` varchar(30) NOT NULL,
  `jumlah_kainkirim` double NOT NULL,
  `harga_peryard` int(11) NOT NULL,
  `ongkos_potong` int(11) NOT NULL,
  `diinputoleh` varchar(35) NOT NULL,
  `kode_potongan` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `t_potong_kain`
--

INSERT INTO `t_potong_kain` (`id_tptg`, `codesaved`, `tgl_potong`, `tgl_input`, `kode_pemotong`, `kode_kain`, `jumlah_kainkirim`, `harga_peryard`, `ongkos_potong`, `diinputoleh`, `kode_potongan`) VALUES
(8, 'TOsFpil5CaK4ASwgHbu', '2025-03-18', '2025-03-18 20:51:32', 'AA', 'SM', 2500, 11389, 100000, 'admin', 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(100) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `nama` varchar(100) DEFAULT NULL,
  `akses` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `nama`, `akses`) VALUES
(2, 'admin', '$2y$10$WVKyRrmQguH8vlx20lGtme/ZqtrzpAMtASvzZsscIBXg0gm.L121i', 'Admin Utama', 'root'),
(9, 'azmi', '$2y$10$sJLC/mkCCVNcZe6k9mJL3e1vkU7dJCyELHXJQmlDRvA5kNr4N4c46', 'AZMI BASWEDAN', 'admin');

-- --------------------------------------------------------

--
-- Stand-in structure for view `view_potongan_kain`
-- (See below for the actual view)
--
DROP VIEW IF EXISTS `view_potongan_kain`;
CREATE TABLE `view_potongan_kain` (
`id_k_ptgan` int(11)
,`inisial_kain` varchar(30)
,`panjang_kain` double
,`harga_pcs` int(11)
,`harga_ptg_pcs` int(11)
,`jumlah_pcs` int(11)
,`code_saved` varchar(45)
,`id_tptg` int(11)
,`codesaved` varchar(35)
,`tgl_potong` date
,`kode_pemotong` varchar(20)
);

-- --------------------------------------------------------

--
-- Structure for view `view_potongan_kain`
--
DROP TABLE IF EXISTS `view_potongan_kain`;

DROP VIEW IF EXISTS `view_potongan_kain`;
CREATE  VIEW `view_potongan_kain`  AS SELECT `stok_kain_potongan`.`id_k_ptgan` AS `id_k_ptgan`, `stok_kain_potongan`.`inisial_kain` AS `inisial_kain`, `stok_kain_potongan`.`panjang_kain` AS `panjang_kain`, `stok_kain_potongan`.`harga_pcs` AS `harga_pcs`, `stok_kain_potongan`.`harga_ptg_pcs` AS `harga_ptg_pcs`, `stok_kain_potongan`.`jumlah_pcs` AS `jumlah_pcs`, `stok_kain_potongan`.`code_saved` AS `code_saved`, `t_potong_kain`.`id_tptg` AS `id_tptg`, `t_potong_kain`.`codesaved` AS `codesaved`, `t_potong_kain`.`tgl_potong` AS `tgl_potong`, `t_potong_kain`.`kode_pemotong` AS `kode_pemotong` FROM (`stok_kain_potongan` join `t_potong_kain`) WHERE `stok_kain_potongan`.`code_saved` = `t_potong_kain`.`codesaved` ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `ci_sessions`
--
ALTER TABLE `ci_sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ci_sessions_timestamp` (`timestamp`);

--
-- Indexes for table `master_babar`
--
ALTER TABLE `master_babar`
  ADD PRIMARY KEY (`id_barbar`);

--
-- Indexes for table `master_jahiten`
--
ALTER TABLE `master_jahiten`
  ADD PRIMARY KEY (`id_msj`);

--
-- Indexes for table `master_kain`
--
ALTER TABLE `master_kain`
  ADD PRIMARY KEY (`id_kain`);

--
-- Indexes for table `master_karyawan`
--
ALTER TABLE `master_karyawan`
  ADD PRIMARY KEY (`id_karyawan`);

--
-- Indexes for table `master_pembatik`
--
ALTER TABLE `master_pembatik`
  ADD PRIMARY KEY (`id_pembatik`);

--
-- Indexes for table `master_pemotong`
--
ALTER TABLE `master_pemotong`
  ADD PRIMARY KEY (`id_ptg`);

--
-- Indexes for table `master_penjahit`
--
ALTER TABLE `master_penjahit`
  ADD PRIMARY KEY (`id_penjahit`);

--
-- Indexes for table `master_produk`
--
ALTER TABLE `master_produk`
  ADD PRIMARY KEY (`id_produk`);

--
-- Indexes for table `master_produk_varians`
--
ALTER TABLE `master_produk_varians`
  ADD PRIMARY KEY (`id_varians`);

--
-- Indexes for table `produksi_babar`
--
ALTER TABLE `produksi_babar`
  ADD PRIMARY KEY (`id_produksi`);

--
-- Indexes for table `produksi_babar_fns`
--
ALTER TABLE `produksi_babar_fns`
  ADD PRIMARY KEY (`id_pbf`);

--
-- Indexes for table `produksi_jahit`
--
ALTER TABLE `produksi_jahit`
  ADD PRIMARY KEY (`id_pjhit`);

--
-- Indexes for table `produksi_jahit_finish`
--
ALTER TABLE `produksi_jahit_finish`
  ADD PRIMARY KEY (`id_pjf`);

--
-- Indexes for table `produksi_jahit_use`
--
ALTER TABLE `produksi_jahit_use`
  ADD PRIMARY KEY (`id_pjhuse`);

--
-- Indexes for table `stok_kain`
--
ALTER TABLE `stok_kain`
  ADD PRIMARY KEY (`id_stok`);

--
-- Indexes for table `stok_kain_pakai`
--
ALTER TABLE `stok_kain_pakai`
  ADD PRIMARY KEY (`id_stokpakai`);

--
-- Indexes for table `stok_kain_potongan`
--
ALTER TABLE `stok_kain_potongan`
  ADD PRIMARY KEY (`id_k_ptgan`);

--
-- Indexes for table `stok_kain_proses_babar`
--
ALTER TABLE `stok_kain_proses_babar`
  ADD PRIMARY KEY (`id_skb`);

--
-- Indexes for table `stok_produk`
--
ALTER TABLE `stok_produk`
  ADD PRIMARY KEY (`id_stokproduk`);

--
-- Indexes for table `t_pembelian_kain`
--
ALTER TABLE `t_pembelian_kain`
  ADD PRIMARY KEY (`id_pembeliankain`);

--
-- Indexes for table `t_potong_kain`
--
ALTER TABLE `t_potong_kain`
  ADD PRIMARY KEY (`id_tptg`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `master_babar`
--
ALTER TABLE `master_babar`
  MODIFY `id_barbar` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `master_jahiten`
--
ALTER TABLE `master_jahiten`
  MODIFY `id_msj` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `master_kain`
--
ALTER TABLE `master_kain`
  MODIFY `id_kain` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `master_karyawan`
--
ALTER TABLE `master_karyawan`
  MODIFY `id_karyawan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `master_pembatik`
--
ALTER TABLE `master_pembatik`
  MODIFY `id_pembatik` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `master_pemotong`
--
ALTER TABLE `master_pemotong`
  MODIFY `id_ptg` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `master_penjahit`
--
ALTER TABLE `master_penjahit`
  MODIFY `id_penjahit` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `master_produk`
--
ALTER TABLE `master_produk`
  MODIFY `id_produk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `master_produk_varians`
--
ALTER TABLE `master_produk_varians`
  MODIFY `id_varians` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `produksi_babar`
--
ALTER TABLE `produksi_babar`
  MODIFY `id_produksi` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `produksi_babar_fns`
--
ALTER TABLE `produksi_babar_fns`
  MODIFY `id_pbf` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `produksi_jahit`
--
ALTER TABLE `produksi_jahit`
  MODIFY `id_pjhit` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `produksi_jahit_finish`
--
ALTER TABLE `produksi_jahit_finish`
  MODIFY `id_pjf` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `produksi_jahit_use`
--
ALTER TABLE `produksi_jahit_use`
  MODIFY `id_pjhuse` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `stok_kain`
--
ALTER TABLE `stok_kain`
  MODIFY `id_stok` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `stok_kain_pakai`
--
ALTER TABLE `stok_kain_pakai`
  MODIFY `id_stokpakai` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `stok_kain_potongan`
--
ALTER TABLE `stok_kain_potongan`
  MODIFY `id_k_ptgan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `stok_kain_proses_babar`
--
ALTER TABLE `stok_kain_proses_babar`
  MODIFY `id_skb` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `stok_produk`
--
ALTER TABLE `stok_produk`
  MODIFY `id_stokproduk` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `t_pembelian_kain`
--
ALTER TABLE `t_pembelian_kain`
  MODIFY `id_pembeliankain` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `t_potong_kain`
--
ALTER TABLE `t_potong_kain`
  MODIFY `id_tptg` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

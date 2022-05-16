-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 16, 2022 at 03:39 PM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.0.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ci_penjualan`
--

-- --------------------------------------------------------

--
-- Table structure for table `barang_harga`
--

CREATE TABLE `barang_harga` (
  `kode_harga` char(10) NOT NULL,
  `kode_barang` char(5) NOT NULL,
  `harga` int(11) NOT NULL,
  `stok` int(6) NOT NULL,
  `kode_cabang` char(3) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `barang_harga`
--

INSERT INTO `barang_harga` (`kode_harga`, `kode_barang`, `harga`, `stok`, `kode_cabang`) VALUES
('CS01PST', 'CS01', 15000, 10, 'PST'),
('CS02PST', 'CS02', 18000, 10, 'PST'),
('CS03PST', 'CS03', 18000, 10, 'PST'),
('DG01PST', 'DG01', 8000, 10, 'PST'),
('DG02PST', 'DG02', 8000, 10, 'PST'),
('DG03PST', 'DG03', 90000, 10, 'PST'),
('CS01JTS', 'CS01', 15000, 10, 'JTS'),
('CS02JTS', 'CS02', 18000, 10, 'JTS'),
('CS03JTS', 'CS03', 18000, 10, 'JTS'),
('DG01JTS', 'DG01', 8000, 10, 'JTS'),
('DG02JTS', 'DG02', 8000, 10, 'JTS'),
('DG03JTS', 'DG03', 90000, 10, 'JTS');

-- --------------------------------------------------------

--
-- Table structure for table `barang_master`
--

CREATE TABLE `barang_master` (
  `kode_barang` varchar(5) NOT NULL,
  `nama_barang` varchar(50) NOT NULL,
  `satuan` varchar(5) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `barang_master`
--

INSERT INTO `barang_master` (`kode_barang`, `nama_barang`, `satuan`) VALUES
('CS01', 'Croissant Polos', 'pcs'),
('CS02', 'Croissant Isi Coklat', 'pcs'),
('CS03', 'Croissant Isi Keju', 'pcs'),
('DG01', 'Donat Gula', 'pcs'),
('DG02', 'Donat Gula Glaze', 'pcs'),
('DG03', 'Donat Gula-Glaze 1 Lusin', 'unit');

-- --------------------------------------------------------

--
-- Table structure for table `bulan`
--

CREATE TABLE `bulan` (
  `id` int(11) NOT NULL,
  `namabulan` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `bulan`
--

INSERT INTO `bulan` (`id`, `namabulan`) VALUES
(1, 'Januari'),
(2, 'Februari'),
(3, 'Maret'),
(4, 'April'),
(5, 'Mei'),
(6, 'Juni'),
(7, 'Juli'),
(8, 'Agustus'),
(9, 'September'),
(10, 'Oktober'),
(11, 'November'),
(12, 'Desember');

-- --------------------------------------------------------

--
-- Table structure for table `cabang`
--

CREATE TABLE `cabang` (
  `kode_cabang` char(3) NOT NULL,
  `nama_cabang` varchar(50) NOT NULL,
  `alamat_cabang` varchar(255) DEFAULT NULL,
  `telepon` varbinary(13) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cabang`
--

INSERT INTO `cabang` (`kode_cabang`, `nama_cabang`, `alamat_cabang`, `telepon`) VALUES
('RCK', 'Rancaekek', 'Jl. Budi Doremi', 0x303830383038303830383038),
('JTS', 'Jatinangor Town Square', 'Jatinangor Town Square Lt. 2', 0x303831333038303830383038),
('PST', 'Pusat', 'Kantor Pusat', 0x303837373038373730383737);

-- --------------------------------------------------------

--
-- Table structure for table `historibayar`
--

CREATE TABLE `historibayar` (
  `nobukti` char(8) NOT NULL,
  `no_faktur` varchar(13) NOT NULL,
  `tglbayar` date NOT NULL,
  `bayar` int(11) NOT NULL,
  `id_user` char(6) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `historibayar`
--

INSERT INTO `historibayar` (`nobukti`, `no_faktur`, `tglbayar`, `bayar`, `id_user`) VALUES
('22000001', 'PST04220003', '2022-05-01', 20000, 'USR001'),
('22000002', 'PST04220003', '2022-05-01', 20000, 'USR001');

-- --------------------------------------------------------

--
-- Table structure for table `pelanggan`
--

CREATE TABLE `pelanggan` (
  `kode_pelanggan` varchar(13) NOT NULL,
  `nik` varchar(50) NOT NULL,
  `no_kk` varchar(50) NOT NULL,
  `nama_pelanggan` varchar(100) NOT NULL,
  `tgl_lahir` date NOT NULL,
  `kecamatan` varchar(100) NOT NULL,
  `kelurahan` varchar(100) NOT NULL,
  `alamat_pelanggan` varchar(200) NOT NULL,
  `no_hp` varchar(15) NOT NULL,
  `pasar` varchar(50) NOT NULL,
  `hari` varchar(10) NOT NULL,
  `kode_cabang` char(3) NOT NULL,
  `id_sales` char(7) DEFAULT NULL,
  `latitude` varchar(30) DEFAULT NULL,
  `longitude` varchar(30) DEFAULT NULL,
  `limitpel` int(11) DEFAULT NULL,
  `time_stamps` timestamp NULL DEFAULT current_timestamp(),
  `foto` varchar(20) DEFAULT NULL,
  `kepemilikan` varchar(20) DEFAULT NULL,
  `lama_berjualan` varchar(20) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pelanggan`
--

INSERT INTO `pelanggan` (`kode_pelanggan`, `nik`, `no_kk`, `nama_pelanggan`, `tgl_lahir`, `kecamatan`, `kelurahan`, `alamat_pelanggan`, `no_hp`, `pasar`, `hari`, `kode_cabang`, `id_sales`, `latitude`, `longitude`, `limitpel`, `time_stamps`, `foto`, `kepemilikan`, `lama_berjualan`) VALUES
('CS001', '', '', 'Mas Bro', '0000-00-00', '', '', 'Jl. ABC', '089999999999', '', '', 'JTS', NULL, NULL, NULL, NULL, '2022-04-26 12:49:58', NULL, NULL, NULL),
('CS002', '', '', 'Euis', '0000-00-00', '', '', 'Jl.123', '081312341234', '', '', 'PST', NULL, NULL, NULL, NULL, '2022-04-26 12:51:10', NULL, NULL, NULL),
('CS003', '', '', 'Cecep Margocep', '0000-00-00', '', '', 'Jl. Bango', '087654321234', '', '', 'RCK', NULL, NULL, NULL, NULL, '2022-04-26 12:51:48', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `penjualan`
--

CREATE TABLE `penjualan` (
  `no_faktur` varchar(13) NOT NULL,
  `tgltransaksi` date NOT NULL,
  `kode_pelanggan` varchar(13) NOT NULL,
  `jenistransaksi` varchar(6) NOT NULL,
  `jatuhtempo` date DEFAULT NULL,
  `id_user` char(6) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `penjualan`
--

INSERT INTO `penjualan` (`no_faktur`, `tgltransaksi`, `kode_pelanggan`, `jenistransaksi`, `jatuhtempo`, `id_user`) VALUES
('PST04220005', '2022-04-29', 'CS002', 'kredit', '2022-05-29', 'USR001'),
('PST04220004', '2022-04-29', 'CS001', 'kredit', '2022-05-29', 'USR001'),
('PST04220003', '2022-04-29', 'CS003', 'tunai', '2022-05-29', 'USR001'),
('PST04220001', '2022-04-29', 'CS001', 'tunai', '2022-05-29', 'USR001');

-- --------------------------------------------------------

--
-- Table structure for table `penjualan_detail`
--

CREATE TABLE `penjualan_detail` (
  `no_faktur` varchar(13) DEFAULT NULL,
  `kode_barang` varchar(8) DEFAULT NULL,
  `harga` int(11) DEFAULT NULL,
  `qty` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `penjualan_detail`
--

INSERT INTO `penjualan_detail` (`no_faktur`, `kode_barang`, `harga`, `qty`) VALUES
('PST04220001', 'CS01', 15000, 2),
('PST04220003', 'CS03', 18000, 2),
('PST04220004', 'DG03', 90000, 1);

-- --------------------------------------------------------

--
-- Table structure for table `penjualan_detail_temp`
--

CREATE TABLE `penjualan_detail_temp` (
  `kode_barang` varchar(8) NOT NULL,
  `harga` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `id_user` char(6) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id_user` char(6) NOT NULL,
  `nama_lengkap` varchar(50) NOT NULL,
  `no_hp` varchar(13) NOT NULL,
  `username` varchar(10) NOT NULL,
  `password` varchar(255) NOT NULL,
  `level` varchar(30) NOT NULL,
  `kode_cabang` char(3) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id_user`, `nama_lengkap`, `no_hp`, `username`, `password`, `level`, `kode_cabang`) VALUES
('USR001', 'Mimin Admin', '087788025588', 'admin', '$2y$10$Qis1vmK01zsIoU/SIbx.Ae0aq6Dw90ENNFbrCQEsCrKhXh1O65e5C', 'administrator', 'PST'),
('USR002', 'Mba Kasir', '081234567890', 'daffa', '$2y$10$LfJ/P9d.CA05M88D6DU3J.mPkHgvyucFplp0itPZRLM/NO.quo6c6', 'kasir', 'JTS');

-- --------------------------------------------------------

--
-- Stand-in structure for view `view_totalbayar`
-- (See below for the actual view)
--
CREATE TABLE `view_totalbayar` (
`no_faktur` varchar(13)
,`totalbayar` decimal(32,0)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `view_totalpenjualan`
-- (See below for the actual view)
--
CREATE TABLE `view_totalpenjualan` (
`no_faktur` varchar(13)
,`totalpenjualan` decimal(42,0)
);

-- --------------------------------------------------------

--
-- Structure for view `view_totalbayar`
--
DROP TABLE IF EXISTS `view_totalbayar`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_totalbayar`  AS SELECT `historibayar`.`no_faktur` AS `no_faktur`, sum(`historibayar`.`bayar`) AS `totalbayar` FROM `historibayar` GROUP BY `historibayar`.`no_faktur` ;

-- --------------------------------------------------------

--
-- Structure for view `view_totalpenjualan`
--
DROP TABLE IF EXISTS `view_totalpenjualan`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_totalpenjualan`  AS SELECT `penjualan_detail`.`no_faktur` AS `no_faktur`, sum(`penjualan_detail`.`harga` * `penjualan_detail`.`qty`) AS `totalpenjualan` FROM `penjualan_detail` GROUP BY `penjualan_detail`.`no_faktur` ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `barang_harga`
--
ALTER TABLE `barang_harga`
  ADD PRIMARY KEY (`kode_harga`);

--
-- Indexes for table `barang_master`
--
ALTER TABLE `barang_master`
  ADD PRIMARY KEY (`kode_barang`) USING BTREE;

--
-- Indexes for table `bulan`
--
ALTER TABLE `bulan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cabang`
--
ALTER TABLE `cabang`
  ADD PRIMARY KEY (`kode_cabang`),
  ADD KEY `kode_cab_idx` (`kode_cabang`);

--
-- Indexes for table `historibayar`
--
ALTER TABLE `historibayar`
  ADD PRIMARY KEY (`nobukti`),
  ADD KEY `hb_nofaktur` (`no_faktur`),
  ADD KEY `hb_tglbayar_jenis` (`tglbayar`);

--
-- Indexes for table `pelanggan`
--
ALTER TABLE `pelanggan`
  ADD PRIMARY KEY (`kode_pelanggan`) USING BTREE,
  ADD KEY `pel_nama` (`nama_pelanggan`),
  ADD KEY `pel_idkar` (`id_sales`),
  ADD KEY `pel_kodecab` (`kode_cabang`);

--
-- Indexes for table `penjualan`
--
ALTER TABLE `penjualan`
  ADD PRIMARY KEY (`no_faktur`) USING BTREE,
  ADD KEY `kode_pelanggan` (`kode_pelanggan`),
  ADD KEY `tgltransaksi` (`tgltransaksi`);

--
-- Indexes for table `penjualan_detail`
--
ALTER TABLE `penjualan_detail`
  ADD KEY `detailpenj_nofaktur` (`no_faktur`),
  ADD KEY `detailpenj_kodebarang` (`kode_barang`);

--
-- Indexes for table `penjualan_detail_temp`
--
ALTER TABLE `penjualan_detail_temp`
  ADD KEY `detailpenj_kodebarang` (`kode_barang`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bulan`
--
ALTER TABLE `bulan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

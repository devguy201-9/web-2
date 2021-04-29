-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 29, 2021 at 04:17 AM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 7.4.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ecommerce`
--

-- --------------------------------------------------------

--
-- Table structure for table `chitiethd`
--

CREATE TABLE `chitiethd` (
  `MaHD` int(11) NOT NULL,
  `MaSP` int(11) NOT NULL,
  `Size` varchar(10) NOT NULL,
  `SoLuong` int(10) NOT NULL,
  `GiaBan` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `chitiethd`
--

INSERT INTO `chitiethd` (`MaHD`, `MaSP`, `Size`, `SoLuong`, `GiaBan`) VALUES
(1, 15, 'L', 3, 1800000),
(3, 29, 'L', 8, 1120000),
(3, 37, 'L', 1, 1000000),
(3, 43, 'L', 1, 1300000),
(4, 80, 'L', 4, 600000),
(8, 80, 'L', 1, 600000);

-- --------------------------------------------------------

--
-- Table structure for table `chucvu`
--

CREATE TABLE `chucvu` (
  `MaCH` int(11) NOT NULL,
  `TenCh` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `chucvu`
--

INSERT INTO `chucvu` (`MaCH`, `TenCh`) VALUES
(1, 'Manager'),
(2, 'Seller');

-- --------------------------------------------------------

--
-- Table structure for table `hoadon`
--

CREATE TABLE `hoadon` (
  `MaHD` int(11) NOT NULL,
  `NGAYXUAT` datetime DEFAULT NULL,
  `MaKH` int(11) NOT NULL,
  `TinhTrang` tinyint(1) NOT NULL,
  `ThanhTien` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `hoadon`
--

INSERT INTO `hoadon` (`MaHD`, `NGAYXUAT`, `MaKH`, `TinhTrang`, `ThanhTien`) VALUES
(1, '2021-04-29 00:00:00', 1, 1, 0),
(3, NULL, 6, 0, NULL),
(4, NULL, 7, 0, NULL),
(8, NULL, 5, 0, NULL),
(10, NULL, 9, 0, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `khachhang`
--

CREATE TABLE `khachhang` (
  `MaKH` int(11) NOT NULL,
  `Ten` varchar(50) NOT NULL,
  `DiaChi` varchar(50) NOT NULL,
  `Email` varchar(50) NOT NULL,
  `SDT` varchar(50) NOT NULL,
  `MatKhau` varchar(100) NOT NULL,
  `TinhTrang` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `khachhang`
--

INSERT INTO `khachhang` (`MaKH`, `Ten`, `DiaChi`, `Email`, `SDT`, `MatKhau`, `TinhTrang`) VALUES
(1, 'Nguyen Le Huy Thang', '456/17 pth', 'nguyenlehuythang@gmail.com', '0901407894', '25d55ad283aa400af464c76d713c07ad', 1),
(4, 'Sang Vũ Trụ', 'Tân Phú', 'sang@gmail.com', '0901407894', '99f7dce285bb3f9b3c4517afc3038cc5', 1),
(5, 'Chôm Chỉa', 'Tân Phú', 'chom@gmail.com', '0901407894', '441402dd8cf8d006df5e7cce84c19ec6', 1),
(6, 'Chôm Chỉa', 'Tân Phú', 'choch@gmail.com', '0901407894', '441402dd8cf8d006df5e7cce84c19ec6', 1),
(7, 'Sang Vũ Trụ', 'Tân Phú', 'vubu@gmail.com', '0901407894', '441402dd8cf8d006df5e7cce84c19ec6', 1),
(8, 'Sang Vũ Trụ', 'Tân Phú', 'vutru@gmail.com', '0901407894', 'd458278448fec8ed1cf23283543ab354', 1),
(9, 'Ka ka Ka', '456/17 Tan Phú', 'ka@gmail.com', '0123456789', '25d55ad283aa400af464c76d713c07ad', 1);

-- --------------------------------------------------------

--
-- Table structure for table `loai`
--

CREATE TABLE `loai` (
  `MaLo` int(11) NOT NULL,
  `TenLoai` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `loai`
--

INSERT INTO `loai` (`MaLo`, `TenLoai`) VALUES
(1, 'T-Shirt'),
(2, 'Pant');

-- --------------------------------------------------------

--
-- Table structure for table `nhanvien`
--

CREATE TABLE `nhanvien` (
  `MaNV` int(11) NOT NULL,
  `Ten` varchar(50) NOT NULL,
  `MaCh` int(11) NOT NULL,
  `DiaChi` varchar(50) NOT NULL,
  `Password` text NOT NULL,
  `TinhTrang` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `sanpham`
--

CREATE TABLE `sanpham` (
  `MaSP` int(11) NOT NULL,
  `Ten` varchar(50) NOT NULL,
  `Hinh` text NOT NULL,
  `GiaBan` double NOT NULL,
  `MaLoai` int(11) NOT NULL,
  `SoLuongTon` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `sanpham`
--

INSERT INTO `sanpham` (`MaSP`, `Ten`, `Hinh`, `GiaBan`, `MaLoai`, `SoLuongTon`) VALUES
(6, '3-Stripes Pants', '../image/product_46.jpg', 900000, 2, 994),
(7, 'Arsenal Third Jersey', '../image/product_14.jpg', 1800000, 1, 1000),
(8, 'Chile 20 Tee', '../image/product_15.jpg', 900000, 1, 1000),
(9, '3D Trefoil Graphic Tee', '../image/product_16.jpg', 600000, 1, 10000),
(10, 'Trefoil Tee', '../image/product_17.jpg', 600000, 1, 1000),
(11, 'Pride Trefoil Flag Fill Tee', '../image/product_32.jpg', 600000, 1, 1000),
(12, 'Big Badge of Sport Boxy Tee', '../image/product_33.jpg', 600000, 1, 1000),
(13, 'Lil Stripe Splash Tee', '../image/product_34.jpg', 500000, 1, 1004),
(14, 'Adiprene Tee', '../image/product_35.jpg', 700000, 1, 1000),
(15, 'Juventus 20/21 Third Jersey', '../image/product_36.jpg', 1800000, 1, 1027),
(16, 'adidas Z.N.E. Pants', '../image/product_47.jpg', 640000, 2, 1000),
(17, 'Tiro 19 Training Pants', '../image/product_48.jpg', 800000, 2, 1000),
(18, 'Aeroready Knit Pants', '../image/product_55.jpg', 860000, 2, 1000),
(19, 'Outline Sweat Pants', '../image/product_56.jpg', 1240000, 2, 1000),
(20, '3-Stripes Pants', '../image/product_57.jpg', 780000, 2, 1000),
(21, '3-Stripes Tee', '../image/product_18.jpg', 700000, 1, 1000),
(22, 'Adiprene Tee', '../image/product_19.jpg', 560000, 1, 1000),
(23, 'Chile 20 Tee', '../image/product_20.jpg', 800000, 1, 1000),
(24, 'M.U Long Sleeve Tee', '../image/product_21.jpg', 1400000, 1, 1000),
(25, 'Tiro 19 Training Pants', '../image/product_58.jpg', 1100000, 2, 1000),
(26, 'Essentials Wind Pants', '../image/product_59.jpg', 1200000, 2, 1000),
(27, 'Tiro 19 Training Pants', '../image/product_60.jpg', 1200000, 2, 1000),
(28, 'French Terry Pants', '../image/product_61.jpg', 1600000, 2, 1000),
(29, 'Alphaskin 2.0 Sport Tights', '../image/product_62.jpg', 1120000, 2, 1000),
(30, 'Firebird Track Pants', '../image/product_63.jpg', 1400000, 2, 1000),
(31, 'Essentials Fleece Jogger Pants', '../image/product_64.jpg', 640000, 2, 1000),
(32, 'Adicolor SST Track Pants', '../image/product_65.jpg', 800000, 2, 1000),
(33, 'Must Haves Primeblue Pants', '../image/product_66.jpg', 900000, 2, 1000),
(34, 'Classics Track Pants', '../image/product_67.jpg', 640000, 2, 1000),
(35, 'ID Pants', '../image/product_68.jpg', 900000, 2, 1000),
(36, 'Cross Up 365 Pants', '../image/product_69.jpg', 900000, 2, 1000),
(37, 'Bouclette Pants', '../image/product_70.jpg', 1000000, 2, 1000),
(38, 'Own the Run Astro Pants', '../image/product_71.jpg', 640000, 2, 1000),
(39, 'R.Y.V. Sweat Pants', '../image/product_72.jpg', 900000, 2, 1000),
(40, 'O Shape Pants', '../image/product_73.jpg', 1120000, 2, 1000),
(41, 'Must Haves Stadium Pants', '../image/product_74.jpg', 1400000, 2, 1000),
(42, '3-Stripes Pants', '../image/product_75.jpg', 900000, 2, 1000),
(43, 'Essentials Tapered Pants', '../image/product_76.jpg', 1300000, 2, 1000),
(44, 'Brilliant Basics Pants', '../image/product_77.jpg', 840000, 2, 1000),
(45, 'adidas Z.N.E. Woven Pants', '../image/product_78.jpg', 1200000, 2, 1000),
(46, '3-Stripes Tapered Pants', '../image/product_79.jpg', 1120000, 2, 1000),
(47, 'Camouflage Pants', '../image/product_80.jpg', 1400000, 2, 1000),
(48, 'Essentials Colorblock Pants', '../image/product_81.jpg', 840000, 2, 1000),
(49, 'Adventure Track Pants', '../image/product_82.jpg', 1200000, 2, 1000),
(50, 'Essentials 3-Stripes Pants', '../image/product_83.jpg', 1200000, 2, 1000),
(51, 'Adi Primeblue Track Pants', '../image/product_84.jpg', 1600000, 2, 1000),
(52, 'Tiro 19 Training Pants', '../image/product_85.jpg', 840000, 2, 1000),
(53, '3D Trefoil Graphic Sweat Pants', '../image/product_86.jpg', 1200000, 2, 1000),
(54, 'Trefoil Tee', '../image/product_0.jpg', 600000, 1, 1000),
(55, 'Short Sleeve Shmoo Tee', '../image/product_1.jpg', 700000, 1, 1000),
(56, 'Must Haves Stadium Tee', '../image/product_2.jpg', 560000, 1, 1000),
(57, 'Run It 3-Stripes PB Tee', '../image/product_3.jpg', 700000, 1, 1000),
(58, 'Own Long Sleeve Tee', '../image/product_4.jpg', 700000, 1, 1000),
(59, 'Own the Run Tee', '../image/product_5.jpg', 700000, 1, 1000),
(60, '3-Stripes Tee', '../image/product_6.jpg', 700000, 1, 1000),
(61, 'Chile 20 Tee', '../image/product_7.jpg', 800000, 1, 1000),
(62, 'Trefoil Tee', '../image/product_8.jpg', 600000, 1, 1000),
(63, 'Real Madrid Third Jersey', '../image/product_9.jpg', 1800000, 1, 1000),
(64, '25/7 Primeblue Tee', '../image/product_10.jpg', 900000, 1, 1000),
(65, '3-Stripes Tee', '../image/product_11.jpg', 800000, 1, 1000),
(66, 'NY Pigeon Tee', '../image/product_12.jpg', 600000, 1, 1000),
(67, 'R.Y.V. Graphic Tee', '../image/product_22.jpg', 800000, 1, 1000),
(68, 'New Stacked LA Trefoil Tee', '../image/product_23.jpg', 600000, 1, 1000),
(69, 'M.U Third Jersey', '../image/product_24.jpg', 1800000, 1, 1000),
(70, 'Badge of Sport Tee', '../image/product_26.jpg', 500000, 1, 1000),
(71, 'Own the Run Tee', '../image/product_27.jpg', 700000, 1, 1000),
(72, 'TAN Logo Tee', '../image/product_29.jpg', 800000, 1, 1000),
(73, 'Torsion Tee', '../image/product_30.jpg', 700000, 1, 1000),
(74, 'Big Trefoil Outline Tee', '../image/product_31.jpg', 600000, 1, 1000),
(75, 'Real Madrid DNA Graphic Tee', '../image/product_37.jpg', 500000, 1, 1000),
(76, 'Captain Tsubasa Tee', '../image/product_38.jpg', 800000, 1, 1000),
(77, 'USA Volleyball 1/4 Zip Tee', '../image/product_39.jpg', 1100000, 1, 1000),
(78, 'Unity Tee', '../image/product_40.jpg', 800000, 1, 1000),
(79, 'R.Y.V. Tee', '../image/product_41.jpg', 600000, 1, 1000),
(80, 'Badge of Sport Tee', '../image/product_42.jpg', 600000, 1, 1000),
(81, 'New Stacked Trefoil Tee', '../image/product_43.jpg', 600000, 1, 1000),
(82, 'Essentials 3-Stripes Wind Pants', '../image/product_49.jpg', 1200000, 1, 1004),
(83, 'Sport French Terry Pants', '../image/product_50.jpg', 1700000, 2, 1000),
(84, 'Woven Tape Pants', '../image/product_51.jpg', 900000, 2, 1000),
(85, 'Trefoil Essentials Pants', '../image/product_52.jpg', 640000, 2, 1000),
(86, '3-Stripes Pants', '../image/product_53.jpg', 900000, 2, 1000),
(87, 'Run It 3-Stripes Astro Pants', '../image/product_54.jpg', 1000000, 2, 1000);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `chitiethd`
--
ALTER TABLE `chitiethd`
  ADD PRIMARY KEY (`MaHD`,`MaSP`,`Size`),
  ADD KEY `MaHD` (`MaHD`,`MaSP`),
  ADD KEY `MaSP` (`MaSP`),
  ADD KEY `MaHD_2` (`MaHD`,`MaSP`,`Size`);

--
-- Indexes for table `chucvu`
--
ALTER TABLE `chucvu`
  ADD PRIMARY KEY (`MaCH`);

--
-- Indexes for table `hoadon`
--
ALTER TABLE `hoadon`
  ADD PRIMARY KEY (`MaHD`),
  ADD KEY `MaKH_2` (`MaKH`);

--
-- Indexes for table `khachhang`
--
ALTER TABLE `khachhang`
  ADD PRIMARY KEY (`MaKH`),
  ADD UNIQUE KEY `Email` (`Email`);

--
-- Indexes for table `loai`
--
ALTER TABLE `loai`
  ADD PRIMARY KEY (`MaLo`);

--
-- Indexes for table `nhanvien`
--
ALTER TABLE `nhanvien`
  ADD PRIMARY KEY (`MaNV`),
  ADD KEY `MaCh` (`MaCh`);

--
-- Indexes for table `sanpham`
--
ALTER TABLE `sanpham`
  ADD PRIMARY KEY (`MaSP`),
  ADD KEY `MaLoai` (`MaLoai`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `chucvu`
--
ALTER TABLE `chucvu`
  MODIFY `MaCH` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `hoadon`
--
ALTER TABLE `hoadon`
  MODIFY `MaHD` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `khachhang`
--
ALTER TABLE `khachhang`
  MODIFY `MaKH` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `loai`
--
ALTER TABLE `loai`
  MODIFY `MaLo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `nhanvien`
--
ALTER TABLE `nhanvien`
  MODIFY `MaNV` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sanpham`
--
ALTER TABLE `sanpham`
  MODIFY `MaSP` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=88;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `chitiethd`
--
ALTER TABLE `chitiethd`
  ADD CONSTRAINT `chitiethd_ibfk_1` FOREIGN KEY (`MaHD`) REFERENCES `hoadon` (`MaHD`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `chitiethd_ibfk_2` FOREIGN KEY (`MaSP`) REFERENCES `sanpham` (`MaSP`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `hoadon`
--
ALTER TABLE `hoadon`
  ADD CONSTRAINT `hoadon_ibfk_1` FOREIGN KEY (`MaKH`) REFERENCES `khachhang` (`MaKH`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `nhanvien`
--
ALTER TABLE `nhanvien`
  ADD CONSTRAINT `nhanvien_ibfk_1` FOREIGN KEY (`MaCh`) REFERENCES `chucvu` (`MaCH`);

--
-- Constraints for table `sanpham`
--
ALTER TABLE `sanpham`
  ADD CONSTRAINT `sanpham_ibfk_1` FOREIGN KEY (`MaLoai`) REFERENCES `loai` (`MaLo`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

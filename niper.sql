-- phpMyAdmin SQL Dump
-- version 4.8.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 15, 2018 at 03:59 PM
-- Server version: 10.1.31-MariaDB
-- PHP Version: 7.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `niper`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` int(11) NOT NULL,
  `username` varchar(80) NOT NULL,
  `password` varchar(80) NOT NULL,
  `name` varchar(80) NOT NULL,
  `email` varchar(80) NOT NULL,
  `role` varchar(80) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `username`, `password`, `name`, `email`, `role`) VALUES
(1, 'admin', 'admin', 'admin', 'admin@admin.com', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `facilities`
--

CREATE TABLE `facilities` (
  `id` int(11) NOT NULL,
  `instrument_id` int(11) NOT NULL,
  `facility` varchar(80) NOT NULL,
  `industry_charge` int(11) NOT NULL,
  `institute_charge` int(11) NOT NULL,
  `remark` varchar(80) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `facilities`
--

INSERT INTO `facilities` (`id`, `instrument_id`, `facility`, `industry_charge`, `institute_charge`, `remark`) VALUES
(1, 1, 'MS+VE', 4500, 2250, 'per mode'),
(2, 1, 'MS-VE', 4500, 2250, 'per mode');

-- --------------------------------------------------------

--
-- Table structure for table `instruments`
--

CREATE TABLE `instruments` (
  `id` int(11) NOT NULL,
  `instrument` varchar(80) NOT NULL,
  `admin_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `instruments`
--

INSERT INTO `instruments` (`id`, `instrument`, `admin_id`) VALUES
(1, 'LC-MS-QTOF', 1),
(2, 'HPLC', 1),
(3, 'FTIR', 1),
(4, 'ATR', 1),
(5, 'SEMI-PREP HPLC', 1),
(6, 'GC', 1),
(7, 'POLARIMETER', 1),
(8, 'DSC', 1),
(9, 'TGA', 1),
(10, 'POROSIMETER', 1),
(11, 'RT-PCR', 1),
(12, 'TEXTURE ANALYZER', 1),
(13, 'UV- VISIBLE SPECTROSCOPY', 1),
(14, 'GPC', 1),
(15, 'FACS', 1),
(16, 'CONFOCAL MICROSCOPE', 1),
(17, 'FLASH CHROMATOGRAPHY', 1),
(18, 'INVERTED MICROSCOPE', 1),
(19, 'HOTSTAGE MICROSCOPE', 1),
(20, 'AUTOCOATER', 1),
(21, 'STABILITY CHAMBER', 1),
(22, 'RHEOMETER', 1),
(23, 'ZETASIZER', 1),
(24, 'ULTRA CENTRIFUGE', 1),
(25, 'BIO ANALYZER', 1),
(26, 'MAGNETOMETER', 1),
(27, 'RAPID MIXER GRANULATOR', 1),
(28, 'POTENTIOSTAT- GALVANOSTAT (PGSTAT)', 1),
(29, 'RAPID MIXER GRANULATOR', 1),
(30, 'MASTERSIZER', 1),
(31, 'ROTARY COMPRESSION MACHINE', 1),
(32, 'PIEZOMETER', 1),
(33, 'UNIVERSAL TESTING MACHINE', 1),
(34, 'NANODROP', 1),
(35, 'ELECTRO SPINNING SETUP', 1),
(36, 'USP Dissolution Apperatus-IV', 1),
(37, 'ATC FACILITY INCLUDES', 1),
(38, 'ANIMAL HOUSE FACILITY INCLUDES', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`,`username`);

--
-- Indexes for table `facilities`
--
ALTER TABLE `facilities`
  ADD PRIMARY KEY (`id`),
  ADD KEY `instrument_id` (`instrument_id`);

--
-- Indexes for table `instruments`
--
ALTER TABLE `instruments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `admin_id` (`admin_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `facilities`
--
ALTER TABLE `facilities`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `instruments`
--
ALTER TABLE `instruments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `facilities`
--
ALTER TABLE `facilities`
  ADD CONSTRAINT `facilities_ibfk_1` FOREIGN KEY (`instrument_id`) REFERENCES `instruments` (`id`);

--
-- Constraints for table `instruments`
--
ALTER TABLE `instruments`
  ADD CONSTRAINT `instruments_ibfk_1` FOREIGN KEY (`admin_id`) REFERENCES `admins` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

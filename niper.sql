-- phpMyAdmin SQL Dump
-- version 4.8.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 14, 2018 at 07:59 AM
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
(1, 'admin', '$2y$10$DVZlzdUQ3x2bjrmCfRZ/CeeVCu00jv0FOeMPp1WS53PuNCsRwtVnW', 'admin', 'admin@admin.com', 'admin'),
(2, 'hardik', '$2y$10$DVZlzdUQ3x2bjrmCfRZ/CeeVCu00jv0FOeMPp1WS53PuNCsRwtVnW', 'Hardik', 'hardik@gmail.com', 'admin'),
(3, 'priyanshu', '$2y$10$DVZlzdUQ3x2bjrmCfRZ/CeeVCu00jv0FOeMPp1WS53PuNCsRwtVnW', 'Priyanshu', 'priyanshu@gmail.com', 'admin');

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
(2, 1, 'MS-VE', 4500, 2250, 'per mode'),
(3, 1, 'HR-MS', 5500, 2750, 'per mode'),
(4, 1, 'HRMS-MS', 10000, 5000, 'per mode'),
(5, 2, 'Qualitative Analysis', 3500, 1750, 'per run'),
(6, 2, 'Qualitative Analysis', 1500, 750, 'per run'),
(7, 3, 'Standard Tests', 1500, 750, 'per sample'),
(8, 4, 'Standard Tests', 1500, 750, 'per sample'),
(9, 5, 'Standard Tests', 7000, 3500, 'per run'),
(10, 6, 'Standard Tests', 3000, 1500, 'per sample'),
(11, 7, 'Specific Optical Rotation for each Wavelength', 3000, 1500, 'per Spectrum'),
(12, 7, 'Optical Rotation for each Wavelength', 2000, 1000, 'per Spectrum'),
(13, 8, 'Standard Tests', 4000, 2000, 'per hour of Instrument time'),
(14, 9, 'Standard Tests', 4000, 2000, 'per hour of Instrument time'),
(15, 10, 'Standard Tests', 5500, 2750, 'per sample'),
(16, 11, 'Standard Tests with Cyber green Dye', 1500, 750, 'per sample'),
(17, 11, 'Standard Tests with Taqman Dye', 3000, 1500, 'per sample'),
(18, 12, 'Standard Tests', 2000, 1000, 'per sample'),
(19, 13, 'Full spectra', 1500, 750, 'per sample'),
(20, 13, 'Peltier kinetics', 7000, 3500, 'per hour'),
(21, 14, 'Standard Tests', 6000, 3000, 'per sample'),
(22, 15, 'For analysis', 1000, 500, 'per sample'),
(23, 15, 'For Sorting (Excluding Reagents and Consumables For Each Sample)', 5000, 2500, 'per hour'),
(24, 16, 'Live Cell Imaging', 7000, 3500, 'per sample'),
(25, 16, 'Fixed Sample cell', 4500, 2250, 'per sample');

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
(38, 'ANIMAL HOUSE FACILITY INCLUDES', 1),
(39, 'FLASH CHROMATOGRAPHY', 1),
(40, 'Hey', 1),
(46, 'MY', 1),
(47, 'MY', 1);

-- --------------------------------------------------------

--
-- Table structure for table `internal_applicants`
--

CREATE TABLE `internal_applicants` (
  `id` int(11) NOT NULL,
  `name` varchar(80) NOT NULL,
  `id_number` varchar(80) NOT NULL,
  `email` varchar(80) NOT NULL,
  `contact` varchar(15) NOT NULL,
  `facility_id` int(11) NOT NULL,
  `message` longtext NOT NULL,
  `nos` int(11) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `internal_applicants`
--

INSERT INTO `internal_applicants` (`id`, `name`, `id_number`, `email`, `contact`, `facility_id`, `message`, `nos`, `timestamp`, `status`) VALUES
(1, 'abc', '101', 'abc@gmail.com', '1234567890', 1, '', 2, '2018-10-08 04:00:00', 1),
(2, 'pqr', '102', 'pqr@gmail.com', '9876543210', 2, '', 1, '2018-10-08 10:45:37', 2),
(3, 'xyz', '103', 'xyz@gmail.com', '4567891230', 3, '', 2, '2018-10-08 10:56:45', 4),
(4, 'lmo', '104', 'lmo@gmail.com', '1234567890', 4, '', 6, '2018-10-08 04:00:22', 1),
(5, 'def', '105', 'def@gmail.com', '1234567890', 5, '', 2, '2018-10-08 10:56:42', 3),
(8, 'xyz', '106', 'xyz@gmail.com', '9998999988', 6, '', 2, '2018-10-08 04:52:02', 1);

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
-- Indexes for table `internal_applicants`
--
ALTER TABLE `internal_applicants`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `facilities`
--
ALTER TABLE `facilities`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `instruments`
--
ALTER TABLE `instruments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT for table `internal_applicants`
--
ALTER TABLE `internal_applicants`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

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

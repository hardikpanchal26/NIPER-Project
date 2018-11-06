-- phpMyAdmin SQL Dump
-- version 4.8.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 06, 2018 at 12:46 PM
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
(1, 'admin', '$2y$10$.ZGDWHcMIU7oQoteeBBMCeBQHoOHnrleRESOj4dch//vrzPYRyzXS', 'admin', 'admin@admin.com', 'admin'),
(2, 'hardik', '$2y$10$DVZlzdUQ3x2bjrmCfRZ/CeeVCu00jv0FOeMPp1WS53PuNCsRwtVnW', 'Hardik', 'hardik@gmail.com', 'admin'),
(3, 'priyanshu', '$2y$10$DVZlzdUQ3x2bjrmCfRZ/CeeVCu00jv0FOeMPp1WS53PuNCsRwtVnW', 'Priyanshu', 'priyanshu@gmail.com', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `external_applicants`
--

CREATE TABLE `external_applicants` (
  `id` int(11) NOT NULL,
  `type` varchar(80) NOT NULL,
  `organization` text NOT NULL,
  `address` longtext NOT NULL,
  `name` varchar(80) NOT NULL,
  `designation` varchar(80) NOT NULL,
  `email` varchar(80) NOT NULL,
  `contact` varchar(15) NOT NULL,
  `facility_id` int(11) NOT NULL,
  `form_values` longtext NOT NULL,
  `message` longtext NOT NULL,
  `nos` int(11) NOT NULL,
  `amount_paid` int(11) NOT NULL,
  `gst_exemption` varchar(80) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
  `remark` varchar(80) NOT NULL,
  `availability` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `facilities`
--

INSERT INTO `facilities` (`id`, `instrument_id`, `facility`, `industry_charge`, `institute_charge`, `remark`, `availability`) VALUES
(1, 1, 'MS+VE', 4500, 2250, 'per mode', 1),
(2, 1, 'MS-VE', 4500, 2250, 'per mode', 1),
(3, 1, 'HR-MS', 5500, 2750, 'per mode', 1),
(4, 1, 'MS-MS', 8500, 4250, 'per mode', 1),
(5, 1, 'HRMS-MS', 10000, 5000, 'per mode', 1),
(6, 2, 'Qualitative Analysis', 3500, 1750, 'per run (max 3 runs)', 1),
(7, 2, 'Quantitative Analysis', 1500, 750, 'per run', 1),
(8, 3, 'Standard Test', 1500, 750, 'per sample', 1),
(9, 4, 'Standard Test', 1500, 750, 'per sample', 1),
(10, 5, 'Standard Test', 7000, 3500, 'per run', 1),
(11, 6, 'Standard Test', 3000, 1500, 'per sample', 1),
(12, 7, 'Specific Optical Rotation for each Wavelength', 3000, 1500, 'per spectrum', 1),
(13, 7, 'Optical Rotation for each Wavelength', 2000, 1000, 'per spectrum', 1),
(14, 8, 'Time based usage', 4000, 2000, 'per hour', 1),
(15, 9, 'Time based usage', 4000, 2000, 'per hour', 1),
(16, 10, 'Standard Test', 5500, 2750, 'per sample', 1),
(17, 11, 'With Cyber green Dye', 1500, 750, 'per sample', 1),
(18, 11, 'With Taqman Dye', 3000, 1500, 'per sample', 1),
(19, 12, 'Standard Test', 2000, 1000, 'per sample', 1),
(20, 13, 'Full spectra', 1500, 750, 'per sample', 1),
(21, 13, 'Peltier kinetics', 7000, 3500, 'per hour', 1),
(22, 14, 'Standard Test', 6000, 3000, 'per sample', 1),
(23, 15, 'Analysis', 1000, 500, 'per sample', 1),
(24, 15, 'Sorting (Excluding Reagents and Consumables)', 5000, 2500, 'per hour', 1),
(25, 16, 'Live Cell Imaging', 7000, 3500, 'per sample', 1),
(26, 16, 'Fixed Sample Cell', 4500, 2250, 'per sample', 1);

-- --------------------------------------------------------

--
-- Table structure for table `instruments`
--

CREATE TABLE `instruments` (
  `id` int(11) NOT NULL,
  `instrument` varchar(80) NOT NULL,
  `admin_id` int(11) NOT NULL,
  `form_factors` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `instruments`
--

INSERT INTO `instruments` (`id`, `instrument`, `admin_id`, `form_factors`) VALUES
(1, 'LC-MS-QTOF', 1, ''),
(2, 'HPLC', 1, '[{\"type\":\"select\",\"label\":\"Sample Type \",\"choices\":[\"Quantative\",\" Qualitative\"]},{\"type\":\"select\",\"label\":\"Detector \",\"choices\":[\"FLD\",\"DAD\",\"UV\",\"RI\"]},{\"type\":\"text\",\"label\":\"Column type\"},{\"type\":\"text\",\"label\":\"Injection volume (0.1 to 100 )\"},{\"type\":\"select\",\"label\":\"Mobile Phase ratio (in %)\",\"choices\":[\" Organic\",\"Aqueous\"]},{\"type\":\"select\",\"label\":\"Isocratic mode \",\"choices\":[\" Yes\",\"No\"]},{\"type\":\"text\",\"label\":\"Retention Time( Max 100 min. Specify in  min.  If Retention time more than 100 min then 500 INR extra per  run will be charged.)\"}]'),
(3, 'FTIR', 1, ''),
(4, 'ATR', 1, ''),
(5, 'SEMI-PREP HPLC', 1, ''),
(6, 'GC', 1, ''),
(7, 'POLARIMETER', 1, '[{\"type\":\"select\",\"label\":\"Wavelength\",\"choices\":[\" 633\",\"589\",\"546435\",\"405\",\"365\"]},{\"type\":\"select\",\"label\":\"Experiment \",\"choices\":[\" Optical rotation\",\"Specific Rotation\"]},{\"type\":\"text\",\"label\":\"Nature of Sample\"},{\"type\":\"text\",\"label\":\"Sample Quantity Required 1mg/ml (10 ml)\"},{\"type\":\"text\",\"label\":\"Mention the name of Solvent in which the Sample is to be Dissolved.\"}]'),
(8, 'DSC', 1, '[{\"type\":\"select\",\"label\":\"Nature of Sample\",\"choices\":[\" Solid\",\"Liquid\"]},{\"type\":\"select\",\"label\":\"Heating Rate\",\"choices\":[\" 5 C/min\",\"10 C/min\"]}]'),
(9, 'TGA', 1, ''),
(10, 'POROSIMETER', 1, ''),
(11, 'RT-PCR', 1, ''),
(12, 'TEXTURE ANALYZER', 1, ''),
(13, 'UV- VISIBLE SPECTROSCOPY', 1, '[{\"type\":\"select\",\"label\":\"Sample Type \",\"choices\":[\" Qualitative \",\" Quntative\"]},{\"type\":\"select\",\"label\":\"Scan \",\"choices\":[\" UV \",\"Visible\"]},{\"type\":\"select\",\"label\":\"Range \",\"choices\":[\" 10 â€“ 400 nm \",\"390 â€“ 700 nm\"]},{\"type\":\"text\",\"label\":\"If fixed wavelength then Specify in nm\"},{\"type\":\"text\",\"label\":\"Solvent in which sample is Prepared\"},{\"type\":\"text\",\"label\":\"Specify blank solution/solvent\"}]'),
(14, 'GPC', 1, ''),
(15, 'FACS', 1, '[{\"type\":\"select\",\"label\":\"Experiment Type\",\"choices\":[\" Acquisition \",\"Sorting with Acquisition\"]},{\"type\":\"text\",\"label\":\"Number of Controls\"},{\"type\":\"text\",\"label\":\"No of Test sample\"},{\"type\":\"text\",\"label\":\"Number of fluorophores(dye used)\"},{\"type\":\"select\",\"label\":\"Fluorochromes (488 nm blue)\",\"choices\":[\" FL â€“ 1 FITC\",\"FL-1  ALEX A488\",\"FL-1 DCF â€“ DA\",\"FL-1 GFP\",\" FL â€“ 2 PE\",\"FL-2 DS RED\",\"FL-1 JC 1\",\"FL â€“ 3 PI\",\"FL-3 7-AAD\",\"FL-3 PEâ€“CY7\",\"FL-3 Et Br\"]},{\"type\":\"select\",\"label\":\"Fluorochromes (640 nm Red)\",\"choices\":[\"FL â€“ 4 APC\",\"FL-4 CY 5\",\"FL - 4 ALEX A 647 FL - 4DRAQ 5\"]},{\"type\":\"text\",\"label\":\"Other Dyes\"},{\"type\":\"text\",\"label\":\"Number of sample to be sorted.\"},{\"type\":\"select\",\"label\":\"Sorting Type \",\"choices\":[\"One way\",\"Two way\"]},{\"type\":\"text\",\"label\":\"Number of Population to be sorted\"}]'),
(16, 'CONFOCAL MICROSCOPE', 1, '[{\"type\":\"select\",\"label\":\"Will you be imaging live mammalian cells using the  physiological chamber ? \",\"choices\":[\"Yes\",\"No\"]},{\"type\":\"select\",\"label\":\"If using live cells, are they certified bio safety level 1 \",\"choices\":[\"Yes\",\"No\"]},{\"type\":\"text\",\"label\":\"What type of cells?\"}]'),
(17, 'FLASH CHROMATOGRAPHY', 1, ''),
(18, 'INVERTED MICROSCOPE', 1, ''),
(19, 'HOTSTAGE MICROSCOPE', 1, '[{\"type\":\"text\",\"label\":\"API\"},{\"type\":\"text\",\"label\":\"Content of API in Formulation\"},{\"type\":\"text\",\"label\":\"Type of formulation\"},{\"type\":\"text\",\"label\":\"Type of Excipient\"},{\"type\":\"text\",\"label\":\"Polymorphic form of sample\"},{\"type\":\"text\",\"label\":\"Melting point of Sample\"},{\"type\":\"text\",\"label\":\"Temperature Range of Sample analysis in Hot stage\"},{\"type\":\"text\",\"label\":\"Heating rate\"},{\"type\":\"select\",\"label\":\"Nature of Sample \",\"choices\":[\"Solid\",\"Liquid\"]},{\"type\":\"text\",\"label\":\"Procedure Sample Preparation and Storage Condition\"}]'),
(20, 'AUTOCOATER', 1, '[{\"type\":\"select\",\"label\":\"Experiment Type\",\"choices\":[\" Aqueous Coating\",\"Non Aqueous Coating\",\" Enteric Coating\"]},{\"type\":\"text\",\"label\":\"Solvent\"},{\"type\":\"text\",\"label\":\"Volume of Coating Solution\"},{\"type\":\"text\",\"label\":\"Spraying rate\"},{\"type\":\"text\",\"label\":\"Drying Temp.\"},{\"type\":\"text\",\"label\":\"Solvent Composition\"},{\"type\":\"text\",\"label\":\"Nature of Sample\"},{\"type\":\"text\",\"label\":\"Procedure Sample Preparation\"}]'),
(21, 'STABILITY CHAMBER', 1, ''),
(22, 'RHEOMETER', 1, ''),
(23, 'ZETASIZER', 1, ''),
(24, 'ULTRA CENTRIFUGE', 1, ''),
(25, 'BIO ANALYZER', 1, ''),
(26, 'MAGNETOMETER', 1, ''),
(27, 'RAPID MIXER GRANULATOR', 1, '[{\"type\":\"select\",\"label\":\"Experiment Type Bowl Type (size) \",\"choices\":[\" 2 lit\",\" 5 lit\",\" 10 lit\"]},{\"type\":\"select\",\"label\":\"Type of Report \",\"choices\":[\"Mixing speed\",\"Mixing time\",\"Bulk Volume\"]},{\"type\":\"text\",\"label\":\"Nature of Sample\"},{\"type\":\"text\",\"label\":\"Procedure Sample Preparation\"}]'),
(28, 'POTENTIOSTAT- GALVANOSTAT (PGSTAT)', 1, ''),
(29, 'MASTERSIZER', 1, ''),
(30, 'ROTARY COMPRESSION MACHINE', 1, '[{\"type\":\"select\",\"label\":\"Experiment Type (Tooling) \",\"choices\":[\"D Tooling\",\" B Tooling\"]},{\"type\":\"select\",\"label\":\"Type of Report\",\"choices\":[\" Tablet Thickness\",\"RPM\"]},{\"type\":\"text\",\"label\":\"Nature of Sample\"},{\"type\":\"text\",\"label\":\"Procedure Sample Preparation\"}]'),
(31, 'PIEZOMETER', 1, ''),
(32, 'UNIVERSAL TESTING MACHINE', 1, ''),
(33, 'NANODROP', 1, ''),
(34, 'ELECTRO SPINNING SETUP', 1, ''),
(35, 'USP Dissolution Apperatus-IV', 1, ''),
(36, 'ATC FACILITY INCLUDES', 1, ''),
(37, 'ANIMAL HOUSE FACILITY INCLUDES', 1, '');

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
  `form_values` longtext NOT NULL,
  `message` longtext NOT NULL,
  `nos` int(11) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `status` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`,`username`);

--
-- Indexes for table `external_applicants`
--
ALTER TABLE `external_applicants`
  ADD PRIMARY KEY (`id`);

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
  ADD UNIQUE KEY `instrument` (`instrument`),
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
-- AUTO_INCREMENT for table `external_applicants`
--
ALTER TABLE `external_applicants`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `facilities`
--
ALTER TABLE `facilities`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `instruments`
--
ALTER TABLE `instruments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `internal_applicants`
--
ALTER TABLE `internal_applicants`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

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

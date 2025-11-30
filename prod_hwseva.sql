-- phpMyAdmin SQL Dump
-- version 5.2.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Nov 26, 2025 at 03:44 PM
-- Server version: 8.0.42
-- PHP Version: 8.2.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `prod_hwseva`
--

-- --------------------------------------------------------

--
-- Table structure for table `0_fiscal_year`
--

CREATE TABLE `0_fiscal_year` (
  `id` int NOT NULL,
  `begin` date DEFAULT '0000-00-00',
  `end` date DEFAULT '0000-00-00',
  `closed` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `0_fiscal_year`
--

INSERT INTO `0_fiscal_year` (`id`, `begin`, `end`, `closed`) VALUES
(1, '2012-04-01', '2013-03-31', 0),
(2, '2013-04-01', '2014-03-31', 0),
(3, '2014-04-01', '2015-03-31', 0),
(4, '2015-04-01', '2016-03-31', 0),
(5, '2016-04-01', '2017-03-31', 0),
(6, '2017-04-01', '2018-03-31', 0);

-- --------------------------------------------------------

--
-- Table structure for table `0_hw_assembly`
--

CREATE TABLE `0_hw_assembly` (
  `assembly_id` int NOT NULL,
  `assembly_code` varchar(60) NOT NULL,
  `description` varchar(500) NOT NULL,
  `ip_address` varchar(15) NOT NULL,
  `loc_code` varchar(32) NOT NULL,
  `user` varchar(150) DEFAULT NULL,
  `is_personal_flag` tinyint(1) NOT NULL DEFAULT '0',
  `owner` varchar(200) DEFAULT NULL,
  `temporary_allocation_flag` tinyint(1) NOT NULL DEFAULT '0',
  `allocation_end_date` date DEFAULT NULL,
  `actual_return_date` date DEFAULT NULL,
  `return_to_location` varchar(60) DEFAULT NULL,
  `remark` tinytext,
  `status` tinyint DEFAULT NULL,
  `version` smallint NOT NULL DEFAULT '1',
  `created_by` tinyint NOT NULL,
  `created_on` date NOT NULL,
  `modified_by` tinyint NOT NULL,
  `modified_on` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `0_hw_assembly`
--

INSERT INTO `0_hw_assembly` (`assembly_id`, `assembly_code`, `description`, `ip_address`, `loc_code`, `user`, `is_personal_flag`, `owner`, `temporary_allocation_flag`, `allocation_end_date`, `actual_return_date`, `return_to_location`, `remark`, `status`, `version`, `created_by`, `created_on`, `modified_by`, `modified_on`) VALUES
(1, 'Atom-01', 'Atom-01', '', 'Scrap_GOA', NULL, 1, 'Mr Nagesh Takbhate ', 0, '0000-00-00', '0000-00-00', NULL, NULL, 4, 8, 0, '0000-00-00', 77, '2022-11-14'),
(2, 'PC-11', 'XP 32Bit/Pentium E2140/2BG Ram / 160 GB HDD, xp oem', '', 'Scrap_GOA', NULL, 0, 'Sanatan Sanstha Mangalore', 0, '0000-00-00', '0000-00-00', NULL, NULL, 4, 10, 0, '0000-00-00', 13, '2018-08-09'),
(3, 'PC-14', 'Core 2 Duo, 3 GB RAM, 160 GB HDD, xp paper', '', 'Scrap_GOA', NULL, 1, 'Mr Kondiba Jadhav', 0, '0000-00-00', '0000-00-00', NULL, NULL, 4, 7, 0, '0000-00-00', 9, '2019-12-22'),
(4, 'PC-15', 'Dual Core, 2 GB RAM, 80 GB HDD', '', 'Scrap_GOA', NULL, 0, 'NA', 0, '0000-00-00', '0000-00-00', NULL, NULL, 4, 5, 0, '0000-00-00', 13, '2018-06-04'),
(5, 'PC-19', 'PC-19', '', 'Scrap_GOA', NULL, 1, 'Mr Yogesh Shinde', 0, '0000-00-00', '0000-00-00', NULL, 'Ha Sanganak Scrap Kela Ahe - 26-06-14, Jitendra', 4, 7, 0, '0000-00-00', 13, '2018-06-04'),
(7, 'PC-20', 'Core 2 Duo, 4 GB RAM, 250 GB HDD', '', 'Scrap_GOA', NULL, 1, 'Miss Nishigandha Deshmukh ', 0, '0000-00-00', '0000-00-00', NULL, 'This Assambly was scrap therefore it insert in hw', 4, 9, 0, '0000-00-00', 13, '2018-06-04'),
(8, 'PC-21', 'core 2 duo, 4 gb, xp oem', '', 'Scrap_GOA', NULL, 0, 'Miss Nishigandha Deshmukh ', 0, '0000-00-00', '0000-00-00', NULL, NULL, 4, 9, 0, '0000-00-00', 9, '2019-06-23'),
(9, 'PC-23', 'Core 2 Duo, 2 GB RAM, 160 GB HDD, xp oem', '', 'Spare', NULL, 1, 'Mr Yogesh Shinde', 0, '0000-00-00', '0000-00-00', NULL, NULL, 1, 12, 0, '0000-00-00', 13, '2018-08-08'),
(10, 'PC-36', 'C2quad, 4 gb, win7 Paper', '', 'Scrap_GOA', NULL, 1, 'Nityanutan Enterprises', 0, '0000-00-00', '0000-00-00', NULL, NULL, 4, 10, 0, '0000-00-00', 9, '2023-10-11'),
(11, 'PC-37', 'PC-37', '', 'Scrap_GOA', NULL, 0, 'Nityanutan Enterprises', 0, '0000-00-00', '0000-00-00', NULL, 'Baki parts chya nondi baki ahet. - shraddha (2.3.23)', 4, 8, 0, '0000-00-00', 9, '2023-03-02'),
(12, 'PC-38', 'Core 2 Quad, 4 GB RAM, 160 &amp; 250 GB HDD, WIN 7 NEW Paper', '', 'Scrap_GOA', NULL, 1, 'Nityanutan Enterprises', 0, '0000-00-00', '0000-00-00', NULL, NULL, 4, 11, 0, '0000-00-00', 77, '2022-11-22'),
(13, 'GOA-PC-39', 'Dell Vostro 420, Intel core 2, 4 GB RAM,  160 GB HDD, Windows 8.1', '', 'Scrap_GOA', NULL, 1, 'Nityanutan Enterprises', 0, '0000-00-00', '0000-00-00', NULL, 'PC-39 YA SANGANKACHE NAV CHANGE KARUN GOA-PC-39 KELE AAHE.', 4, 22, 0, '0000-00-00', 9, '2021-03-28'),
(14, 'PC-41', 'c2 quad, 4gb, xp paper', '', 'Scrap_GOA', NULL, 1, 'Nityanutan Enterprises', 0, '0000-00-00', '0000-00-00', NULL, NULL, 4, 10, 0, '0000-00-00', 9, '2021-03-29'),
(15, 'PC-42', 'Core 2 Duo, 2 GB RAM, 80 GB HDD', '', 'Scrap_GOA', NULL, 0, 'NA', 0, '0000-00-00', '0000-00-00', NULL, NULL, 4, 21, 0, '0000-00-00', 13, '2018-06-04'),
(16, 'PC-43', 'HP Workstation, 120 GB SSD', '', 'Scrap_GOA', NULL, 1, 'Nityanutan Enterprises', 0, '0000-00-00', '0000-00-00', NULL, 'andaje 1.1.2019 la scrap zala ahe pan erpla nond navti', 4, 10, 0, '0000-00-00', 9, '2020-03-16'),
(17, 'GOA-PC-44', 'HP Workstation XW4600', '', 'Scrap_GOA', NULL, 0, 'Nityanutan Enterprises', 0, '0000-00-00', '0000-00-00', NULL, NULL, 4, 11, 0, '0000-00-00', 9, '2019-01-25'),
(18, 'PC-45', 'XP Pro,  Core 2 Duo, 4 GB RAM, 200 GB &amp; 160 GB HDD, xp oem, 32 bit', '', 'AV_Archival', 'Laxminarayan Acharya', 1, 'Nityanutan Enterprises', 0, '0000-00-00', '0000-00-00', NULL, NULL, 1, 15, 0, '0000-00-00', 13, '2022-11-28'),
(19, 'PC-46', 'Core 2 duo, 4 GB,', '', 'Computer Hardware', NULL, 0, 'Nityanutan Enterprises', 0, '0000-00-00', '0000-00-00', NULL, NULL, 1, 14, 0, '0000-00-00', 77, '2022-09-17'),
(20, 'PC-47', 'PC-47', '', 'Scrap_GOA', NULL, 0, 'Nityanutan Enterprises', 0, '0000-00-00', '0000-00-00', NULL, NULL, 4, 6, 0, '0000-00-00', 13, '2018-08-09'),
(21, 'PC-48', 'Core 2 Duo, 4 GB RAM, 250 GB HDD, LINUX', '', 'Scrap_GOA', NULL, 0, 'Nityanutan Enterprises', 0, '0000-00-00', '0000-00-00', NULL, NULL, 4, 7, 0, '0000-00-00', 9, '2019-01-31');

-- --------------------------------------------------------

--
-- Table structure for table `0_hw_assembly_trans`
--

CREATE TABLE `0_hw_assembly_trans` (
  `id` int NOT NULL,
  `entry_date` date NOT NULL,
  `assembly_id` int NOT NULL,
  `loc_code` varchar(30) NOT NULL,
  `user` varchar(60) DEFAULT NULL,
  `temporary_allocation_flag` tinyint NOT NULL DEFAULT '0',
  `allocation_end_date` date DEFAULT NULL,
  `actual_return_date` date DEFAULT NULL,
  `return_to_location` varchar(30) DEFAULT NULL,
  `remark` tinytext,
  `status` tinyint DEFAULT NULL,
  `latest_record_flag` tinyint(1) NOT NULL DEFAULT '1',
  `created_by` tinyint NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `0_hw_assembly_trans`
--

INSERT INTO `0_hw_assembly_trans` (`id`, `entry_date`, `assembly_id`, `loc_code`, `user`, `temporary_allocation_flag`, `allocation_end_date`, `actual_return_date`, `return_to_location`, `remark`, `status`, `latest_record_flag`, `created_by`) VALUES
(1, '2012-10-13', 1, 'Dainik', NULL, 0, '0000-00-00', NULL, '0', NULL, 1, 0, 0),
(2, '2012-10-13', 2, 'Murtishala', NULL, 0, '0000-00-00', NULL, '0', NULL, 1, 0, 0),
(3, '2012-10-13', 3, 'Murtishala', NULL, 0, '0000-00-00', NULL, '0', NULL, 1, 0, 0),
(4, '2012-10-13', 4, '205', NULL, 0, '0000-00-00', NULL, '0', NULL, 1, 0, 0),
(5, '2012-10-13', 5, 'Murtishala', NULL, 0, '0000-00-00', NULL, '0', NULL, 1, 0, 0),
(6, '2012-10-13', 6, 'Murtishala', NULL, 0, '0000-00-00', NULL, '0', NULL, 1, 0, 0),
(7, '2012-10-13', 7, '205', NULL, 0, '0000-00-00', NULL, '0', NULL, 1, 0, 0),
(8, '2012-10-13', 8, 'Murtishala', NULL, 0, '0000-00-00', NULL, '0', NULL, 1, 0, 0),
(9, '2012-10-13', 9, '205', NULL, 0, '0000-00-00', NULL, '0', NULL, 1, 0, 0),
(10, '2012-10-13', 10, '227', NULL, 0, '0000-00-00', NULL, '0', NULL, 1, 0, 0),
(11, '2012-10-13', 11, 'Murtishala', NULL, 0, '0000-00-00', NULL, '0', NULL, 1, 0, 0),
(12, '2012-10-13', 12, '209', NULL, 0, '0000-00-00', NULL, '0', NULL, 1, 0, 0),
(13, '2012-10-13', 13, 'Murtishala', NULL, 0, '0000-00-00', NULL, '0', NULL, 1, 0, 0),
(14, '2012-10-13', 14, '204', NULL, 0, '0000-00-00', NULL, '0', NULL, 1, 0, 0),
(15, '2012-10-13', 15, '204', NULL, 0, '0000-00-00', NULL, '0', NULL, 1, 0, 0),
(16, '2012-10-13', 16, '209', NULL, 0, '0000-00-00', NULL, '0', NULL, 1, 0, 0),
(17, '2012-10-13', 17, '227', NULL, 0, '0000-00-00', NULL, '0', NULL, 1, 0, 0),
(18, '2012-10-13', 18, '209', NULL, 0, '0000-00-00', NULL, '0', NULL, 1, 0, 0),
(19, '2012-10-13', 19, 'Murtishala', NULL, 0, '0000-00-00', NULL, '0', NULL, 1, 0, 0),
(20, '2012-10-13', 20, '227', NULL, 0, '0000-00-00', NULL, '0', NULL, 1, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `0_hw_assets`
--

CREATE TABLE `0_hw_assets` (
  `asset_id` mediumint NOT NULL,
  `asset_code` varchar(16) NOT NULL,
  `asset_description` varchar(500) NOT NULL,
  `asset_category_id` smallint NOT NULL,
  `sub_category_id` smallint NOT NULL,
  `loc_code` varchar(24) NOT NULL,
  `user` varchar(60) DEFAULT NULL,
  `assembly_id` smallint NOT NULL,
  `cpu_part_flag` tinyint(1) NOT NULL DEFAULT '0',
  `manufacturer` varchar(60) DEFAULT NULL,
  `model` varchar(60) DEFAULT NULL,
  `company_serial` varchar(150) DEFAULT NULL,
  `part_no` varchar(80) DEFAULT NULL,
  `version_info` varchar(80) DEFAULT NULL,
  `storage_capacity` varchar(8) DEFAULT NULL,
  `consumable_flag` tinyint(1) NOT NULL DEFAULT '0',
  `quantity` mediumint NOT NULL DEFAULT '0',
  `donated_flag` tinyint(1) NOT NULL DEFAULT '0',
  `donor` varchar(150) DEFAULT NULL,
  `donation_date` date DEFAULT NULL,
  `temporary_allocation_flag` tinyint(1) NOT NULL DEFAULT '0',
  `allocation_end_date` date DEFAULT NULL,
  `actual_return_date` date DEFAULT NULL,
  `return_to_location` varchar(24) DEFAULT NULL,
  `requisition_no` varchar(10) DEFAULT NULL,
  `is_personal_flag` tinyint(1) NOT NULL DEFAULT '0',
  `owner` varchar(200) DEFAULT NULL,
  `supplier` varchar(100) DEFAULT NULL,
  `invoice_no` varchar(16) DEFAULT NULL,
  `purchase_date` date DEFAULT NULL,
  `purchase_cost` float DEFAULT NULL,
  `warranty_expiration_date` date DEFAULT NULL,
  `last_maintenance_date` date DEFAULT NULL,
  `replacement_asset_id` mediumint DEFAULT NULL,
  `on_maintenance_flag` tinyint(1) NOT NULL DEFAULT '0',
  `followup_date` date DEFAULT NULL,
  `support_provider` varchar(100) DEFAULT NULL,
  `support_contact` varchar(20) DEFAULT NULL,
  `support_reference` varchar(100) DEFAULT NULL,
  `remark` tinytext,
  `status` tinyint DEFAULT NULL,
  `emg_stk` tinyint(1) NOT NULL DEFAULT '0',
  `version` smallint NOT NULL DEFAULT '1',
  `created_by` smallint NOT NULL,
  `created_on` date NOT NULL,
  `modified_by` smallint NOT NULL,
  `modified_on` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `0_hw_assets`
--

INSERT INTO `0_hw_assets` (`asset_id`, `asset_code`, `asset_description`, `asset_category_id`, `sub_category_id`, `loc_code`, `user`, `assembly_id`, `cpu_part_flag`, `manufacturer`, `model`, `company_serial`, `part_no`, `version_info`, `storage_capacity`, `consumable_flag`, `quantity`, `donated_flag`, `donor`, `donation_date`, `temporary_allocation_flag`, `allocation_end_date`, `actual_return_date`, `return_to_location`, `requisition_no`, `is_personal_flag`, `owner`, `supplier`, `invoice_no`, `purchase_date`, `purchase_cost`, `warranty_expiration_date`, `last_maintenance_date`, `replacement_asset_id`, `on_maintenance_flag`, `followup_date`, `support_provider`, `support_contact`, `support_reference`, `remark`, `status`, `emg_stk`, `version`, `created_by`, `created_on`, `modified_by`, `modified_on`) VALUES
(1, '1238', 'AMD Phenom II Black Edition Multi Core Processor (X2-560)', 1, 0, 'Scrap_GOA', NULL, 0, 1, 'AMD', 'X2-560', '9A32723C20106', NULL, NULL, NULL, 0, 1, 0, NULL, '0000-00-00', 0, '0000-00-00', '0000-00-00', NULL, NULL, 0, 'Sanatan Sanstha Mangalore', 'Worldwide', NULL, '2012-05-21', 0, '2015-05-21', '0000-00-00', 0, 0, '0000-00-00', NULL, NULL, NULL, NULL, 4, 0, 2, 0, '0000-00-00', 9, '2021-04-01'),
(2, '1235', '(ASUS) M5A78L - MLX  Motherboard', 2, 0, 'Scrap_GOA', NULL, 0, 1, 'Asus', 'M5A78L - MLX', 'O1B0011-12860-MB07K0-A05  0602', NULL, NULL, NULL, 0, 1, 0, NULL, '0000-00-00', 0, '0000-00-00', '0000-00-00', NULL, NULL, 0, 'Sanatan Sanstha Mangalore', 'Worldwide', NULL, '2012-05-21', 0, '2015-05-21', '0000-00-00', 0, 0, '0000-00-00', NULL, NULL, NULL, NULL, 4, 0, 2, 0, '0000-00-00', 9, '2021-04-01'),
(3, '1239', 'Kingston 2GB ( DDR3 ) RAM', 3, 17, 'Scrap_GOA', NULL, 0, 1, 'Kingston', '99P5471-014.AOOLF', '41LV4-L95MHK-HWC66', NULL, NULL, '2GB', 0, 1, 0, NULL, '0000-00-00', 0, '0000-00-00', '0000-00-00', NULL, NULL, 0, 'Sanatan Sanstha Mangalore', 'Worldwide', NULL, '2012-05-21', 0, '2015-05-21', '0000-00-00', 0, 0, '0000-00-00', NULL, NULL, NULL, NULL, 4, 0, 2, 0, '0000-00-00', 9, '2021-04-01'),
(4, '1240', 'Kingston 2GB ( DDR3 ) RAM', 3, 17, 'Scrap_GOA', NULL, 0, 1, 'Kingston', '99P5471-014.AOOLF', 'PELPA-D95M7R-8W1KF', NULL, NULL, '2GB', 0, 1, 0, NULL, '0000-00-00', 0, '0000-00-00', '0000-00-00', NULL, NULL, 0, 'Sanatan Sanstha Mangalore', 'Worldwide', NULL, '2012-05-21', 0, '2015-05-21', '0000-00-00', 0, 0, '0000-00-00', NULL, NULL, NULL, NULL, 4, 0, 2, 0, '0000-00-00', 9, '2021-04-01'),
(5, '1241', 'Seagate 250 GB Sata HDD', 4, 14, 'Scrap_GOA', NULL, 0, 1, 'Seagate', 'ST250DM000', 'S/N: S2A4E3NV PN: 1BD141-302', NULL, NULL, '250GB', 0, 1, 0, NULL, '0000-00-00', 0, '0000-00-00', '0000-00-00', NULL, NULL, 0, 'Sanatan Sanstha Mangalore', 'Worldwide', NULL, '2012-05-21', 0, '0000-00-00', '0000-00-00', 0, 0, '0000-00-00', NULL, NULL, NULL, NULL, 4, 0, 4, 0, '0000-00-00', 19, '2017-06-30'),
(6, '1298', 'UMAX Switching Mode power Supply 450W', 5, 0, 'Spare', NULL, 0, 1, 'Umax', 'USMPS 450', '14-1112-450R15289', NULL, NULL, NULL, 0, 1, 0, NULL, '0000-00-00', 0, '0000-00-00', '0000-00-00', NULL, NULL, 0, 'Sanatan Sanstha Mangalore', 'Tricom', NULL, '2012-06-16', 0, '2015-06-16', '0000-00-00', 0, 0, '0000-00-00', NULL, NULL, NULL, 'Replacement la pathavla ahe.', 1, 0, 2, 0, '0000-00-00', 41, '2014-10-15'),
(7, '1237', 'Logitech K200  Keyboard  USB', 6, 21, 'Scrap_GOA', NULL, 0, 0, 'Logitech', 'K200', 'PID - SY201UK  PN- 820004217', NULL, NULL, NULL, 0, 1, 0, NULL, '0000-00-00', 0, '0000-00-00', '0000-00-00', NULL, NULL, 0, 'Sanatan Sanstha Mangalore', 'Worldwide', NULL, '2012-05-21', 0, '2015-05-21', '0000-00-00', 0, 0, '0000-00-00', NULL, NULL, NULL, '9 key chalat nahi- shraddha(3.8.2015)', 4, 0, 7, 0, '0000-00-00', 9, '2021-08-14'),
(8, '1236', '(Logitech) MK200 Media Combo Mouse USB', 7, 22, 'hw_spare_to_track', NULL, 0, 0, 'Logitech', 'M-U0026', 'PID - HS151HA   PN - 810-002181', NULL, NULL, NULL, 0, 1, 0, NULL, '0000-00-00', 0, '0000-00-00', '0000-00-00', NULL, NULL, 0, 'Sanatan Sanstha Mangalore', 'Worldwide', NULL, '2012-05-21', 0, '2015-05-21', '0000-00-00', 0, 0, '0000-00-00', NULL, NULL, NULL, 'confirm this mouse physically - mahesh', 1, 0, 3, 0, '0000-00-00', 9, '2021-04-21'),
(9, '1234', 'Dell 18.5 Inch Monitor  (D1920F)', 28, 0, 'Scrap_GOA', NULL, 0, 0, 'Dell', 'D1920F', 'CN-0321DV-72872-22N-E6DI', NULL, NULL, NULL, 0, 1, 0, NULL, '0000-00-00', 0, '0000-00-00', '0000-00-00', NULL, NULL, 0, 'Sanatan Sanstha Mangalore', 'Worldwide', NULL, '2012-05-21', 0, '2015-05-21', '0000-00-00', 0, 0, '0000-00-00', NULL, NULL, NULL, 'half display yeto, khup lines ahet, ajay la pathavane baki - mahesh 01-11-21', 4, 0, 8, 0, '0000-00-00', 13, '2021-11-01'),
(10, 'N75', 'Xtech', 9, 0, 'Scrap_GOA', NULL, 56, 1, 'Xtech', NULL, NULL, NULL, NULL, NULL, 0, 1, 0, NULL, '0000-00-00', 0, '0000-00-00', NULL, NULL, NULL, 0, 'NA', 'NA', NULL, '0000-00-00', 0, '0000-00-00', '0000-00-00', 0, 0, '0000-00-00', NULL, NULL, NULL, NULL, 1, 0, 1, 0, '0000-00-00', 20, '2013-03-16'),
(11, 'W369', 'XP Pro 32 BIT OEM', 10, 4, 'Scrap_GOA', NULL, 56, 0, 'Microsoft', 'Window XP Pro', 'RVCVD-GG4K9-RDQ7C-HGXMQ-WP66D', NULL, NULL, NULL, 0, 1, 0, NULL, '0000-00-00', 0, '0000-00-00', '0000-00-00', NULL, NULL, 0, 'Hindu Janajagruti Samiti', 'Worldwide', '08/06/144', '2008-06-21', 5725, '0000-00-00', '0000-00-00', 0, 0, '0000-00-00', NULL, NULL, NULL, NULL, 1, 0, 5, 0, '0000-00-00', 13, '2016-01-25'),
(23, '1253', 'AMD PHENOM (TM)II X4 B60 Processor', 1, 0, 'Scrap_GOA', NULL, 47, 1, 'AMD', 'Phenom II Black Edition Multicore', '9A32723C21237', NULL, NULL, NULL, 0, 1, 0, NULL, '0000-00-00', 0, '0000-00-00', '0000-00-00', NULL, NULL, 0, 'Sanatan Sanstha Mangalore', 'Worldwide', NULL, '2012-05-21', 0, '2015-05-21', '0000-00-00', 0, 0, '0000-00-00', NULL, NULL, NULL, 'replaced with 2014', 3, 0, 5, 0, '0000-00-00', 13, '2015-08-17'),
(24, '1254', 'ASUS Motherboard', 2, 0, 'Scrap_GOA', NULL, 0, 1, 'Asus', 'M5A78L - MLX', '01B0011-06282-MB07K0-A05-0602,  BBMOCS249076', NULL, NULL, NULL, 0, 1, 0, NULL, '0000-00-00', 0, '0000-00-00', '0000-00-00', NULL, NULL, 0, 'Sanatan Sanstha Mangalore', 'Worldwide', NULL, '2012-05-21', 0, '2015-05-21', '0000-00-00', 0, 0, '0000-00-00', NULL, NULL, NULL, NULL, 4, 0, 4, 0, '0000-00-00', 9, '2021-08-17'),
(25, '1255', 'Kingston (DDR3)2GB Ram', 3, 17, 'Spare', NULL, 0, 1, 'Kingston', '99P5471-014.A00LF', '6UJFM-E9EM87-CV91N', NULL, NULL, NULL, 0, 1, 0, NULL, '0000-00-00', 0, '0000-00-00', '0000-00-00', NULL, NULL, 0, 'Sanatan Sanstha Mangalore', 'Worldwide', NULL, '2012-05-21', 0, '2015-05-21', '0000-00-00', 0, 0, '0000-00-00', NULL, NULL, NULL, NULL, 1, 0, 5, 0, '0000-00-00', 9, '2021-08-17'),
(26, '1256', 'Kingston (DDR3)2GB Ram', 3, 17, 'Scrap_GOA', NULL, 0, 1, 'Kingston', '99P5471-014.A00LF', 'LNLXC-693MXX-9WBXC', NULL, NULL, NULL, 0, 1, 0, NULL, '0000-00-00', 0, '0000-00-00', '0000-00-00', NULL, NULL, 0, 'Sanatan Sanstha Mangalore', 'Worldwide', NULL, '2012-05-21', 0, '2015-05-21', '0000-00-00', 0, 0, '0000-00-00', NULL, NULL, NULL, 'Ajay dada kade Sale karita patavale', 4, 0, 5, 0, '0000-00-00', 74, '2021-12-16'),
(27, '1257', 'Seagate Hardisk', 4, 15, 'Scrap_GOA', NULL, 0, 1, 'Seagate', 'ST250DMD00', '9VYFRTQT, 1BD141-302', NULL, NULL, '250 GB', 0, 1, 0, NULL, '0000-00-00', 0, '0000-00-00', '0000-00-00', NULL, NULL, 0, 'Sanatan Sanstha Mangalore', 'Worldwide', NULL, '2012-05-21', 0, '2013-06-30', '0000-00-00', 0, 0, '0000-00-00', NULL, NULL, NULL, NULL, 4, 0, 4, 0, '0000-00-00', 19, '2017-02-23'),
(28, '1322', 'UMAX Switiching power supply 450W', 5, 0, 'Scrap_GOA', NULL, 0, 1, 'Umax', 'USMPS 450', '14-1201-450R06117', NULL, NULL, NULL, 0, 1, 0, NULL, '0000-00-00', 0, '0000-00-00', '0000-00-00', NULL, NULL, 0, 'NA', 'Tricom', NULL, '2012-06-16', 0, '2015-06-16', '0000-00-00', 0, 0, '0000-00-00', NULL, NULL, NULL, NULL, 4, 0, 3, 0, '0000-00-00', 9, '2019-12-22'),
(29, '1251', 'Logitech USB Keyboard', 6, 20, 'Spare', NULL, 0, 0, 'Logitech', 'K200 Y-U0011', '820-004217 PID: SY153UK', NULL, NULL, NULL, 0, 1, 0, NULL, '0000-00-00', 0, '0000-00-00', '0000-00-00', NULL, '189', 0, 'Sanatan Sanstha Mangalore', 'Worldwide', NULL, '2012-05-21', 0, '2015-05-21', '0000-00-00', 0, 0, '0000-00-00', NULL, NULL, NULL, 'goa-pc-235 la jodla hota. aditi tai ne jama kela. control key work karat nahi. ajayla pathavane - mahesh 08-04-22', 2, 0, 9, 0, '0000-00-00', 13, '2022-04-08'),
(30, '1252', 'Logitech USB Optical', 7, 22, 'Scrap_GOA', NULL, 0, 0, 'Logitech', 'M-U0026', '810-002181 PID - HC148HH', NULL, NULL, NULL, 0, 1, 0, NULL, '0000-00-00', 0, '0000-00-00', '0000-00-00', NULL, '189', 0, 'Sanatan Sanstha Mangalore', 'Worldwide', NULL, '2012-05-21', 0, '2015-05-21', '0000-00-00', 0, 0, '0000-00-00', NULL, NULL, NULL, NULL, 4, 0, 11, 0, '0000-00-00', 9, '2020-09-21'),
(31, '1250', 'Dell 18.5 Inch', 28, 0, 'Scrap_GOA', NULL, 0, 0, 'Dell', 'D1920F', 'CN-0321DV-72872-22N-EC6i', NULL, NULL, NULL, 0, 1, 0, NULL, '0000-00-00', 0, '0000-00-00', '0000-00-00', NULL, '189', 0, 'Sanatan Sanstha Mangalore', 'Worldwide', NULL, '2012-05-21', 0, '2015-05-21', '0000-00-00', 0, 0, '0000-00-00', NULL, NULL, NULL, 'scrapped - shraddha (30.9.2020)', 4, 0, 8, 0, '0000-00-00', 9, '2020-09-30');

-- --------------------------------------------------------

--
-- Table structure for table `0_hw_assets_trans`
--

CREATE TABLE `0_hw_assets_trans` (
  `id` int NOT NULL,
  `asset_id` int NOT NULL,
  `entry_date` date DEFAULT NULL,
  `loc_code` varchar(60) NOT NULL,
  `user` varchar(150) DEFAULT NULL,
  `assembly_id` int NOT NULL,
  `temporary_allocation_flag` tinyint(1) NOT NULL DEFAULT '0',
  `allocation_end_date` date DEFAULT NULL,
  `actual_return_date` date DEFAULT NULL,
  `on_maintenance_flag` tinyint(1) NOT NULL DEFAULT '0',
  `followup_date` date DEFAULT NULL,
  `support_provider` varchar(150) DEFAULT NULL,
  `support_reference` varchar(100) DEFAULT NULL,
  `remark` tinytext,
  `status` tinyint DEFAULT NULL,
  `emg_stk` tinyint(1) DEFAULT '0',
  `latest_record_flag` tinyint(1) DEFAULT '1',
  `created_by` tinyint NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `0_hw_assets_trans`
--

INSERT INTO `0_hw_assets_trans` (`id`, `asset_id`, `entry_date`, `loc_code`, `user`, `assembly_id`, `temporary_allocation_flag`, `allocation_end_date`, `actual_return_date`, `on_maintenance_flag`, `followup_date`, `support_provider`, `support_reference`, `remark`, `status`, `emg_stk`, `latest_record_flag`, `created_by`) VALUES
(1, 1, '2012-10-14', 'Dainik', NULL, 56, 0, '0000-00-00', NULL, 0, '0000-00-00', NULL, NULL, NULL, 1, 0, 0, 0),
(2, 2, '2012-10-14', 'Dainik', NULL, 56, 0, '0000-00-00', NULL, 0, '0000-00-00', NULL, NULL, NULL, 1, 0, 0, 0),
(3, 3, '2012-10-14', 'Dainik', NULL, 56, 0, '0000-00-00', NULL, 0, '0000-00-00', NULL, NULL, NULL, 1, 0, 0, 0),
(4, 4, '2012-10-14', 'Dainik', NULL, 56, 0, '0000-00-00', NULL, 0, '0000-00-00', NULL, NULL, NULL, 1, 0, 0, 0),
(5, 5, '2012-10-14', 'Dainik', NULL, 56, 0, '0000-00-00', NULL, 0, '0000-00-00', NULL, NULL, NULL, 1, 0, 0, 0),
(6, 6, '2012-10-14', 'Dainik', NULL, 56, 0, '0000-00-00', NULL, 0, '0000-00-00', NULL, NULL, NULL, 1, 0, 0, 0),
(7, 7, '2012-10-14', 'Dainik', NULL, 56, 0, '0000-00-00', NULL, 0, '0000-00-00', NULL, NULL, NULL, 1, 0, 0, 0),
(8, 8, '2012-10-14', 'Dainik', NULL, 56, 0, '0000-00-00', NULL, 0, '0000-00-00', NULL, NULL, NULL, 1, 0, 0, 0),
(9, 9, '2012-10-14', 'Dainik', NULL, 56, 0, '0000-00-00', NULL, 0, '0000-00-00', NULL, NULL, NULL, 1, 0, 0, 0),
(10, 10, '2012-10-14', 'Dainik', NULL, 56, 0, '0000-00-00', NULL, 0, '0000-00-00', NULL, NULL, NULL, 1, 0, 1, 0),
(11, 11, '2012-10-14', 'Dainik', NULL, 56, 0, '0000-00-00', NULL, 0, '0000-00-00', NULL, NULL, NULL, 1, 0, 1, 0),
(12, 12, '2012-10-14', 'Dainik', NULL, 67, 0, '0000-00-00', NULL, 0, '0000-00-00', NULL, NULL, NULL, 1, 0, 1, 0),
(13, 13, '2012-10-14', 'Dainik', NULL, 67, 0, '0000-00-00', NULL, 0, '0000-00-00', NULL, NULL, NULL, 1, 0, 1, 0),
(14, 14, '2012-10-14', 'Dainik', NULL, 67, 0, '0000-00-00', NULL, 0, '0000-00-00', NULL, NULL, NULL, 1, 0, 1, 0),
(15, 15, '2012-10-14', 'Dainik', NULL, 67, 0, '0000-00-00', NULL, 0, '0000-00-00', NULL, NULL, NULL, 1, 0, 1, 0),
(16, 16, '2012-10-14', 'Dainik', NULL, 67, 0, '0000-00-00', NULL, 0, '0000-00-00', NULL, NULL, NULL, 1, 0, 1, 0),
(17, 17, '2012-10-14', 'Dainik', NULL, 67, 0, '0000-00-00', NULL, 0, '0000-00-00', NULL, NULL, NULL, 1, 0, 1, 0),
(18, 18, '2012-10-14', 'Dainik', NULL, 67, 0, '0000-00-00', NULL, 0, '0000-00-00', NULL, NULL, NULL, 1, 0, 1, 0),
(19, 19, '2012-10-14', 'Dainik', NULL, 67, 0, '0000-00-00', NULL, 0, '0000-00-00', NULL, NULL, NULL, 1, 0, 1, 0),
(20, 20, '2012-10-14', 'Dainik', NULL, 67, 0, '0000-00-00', NULL, 0, '0000-00-00', NULL, NULL, NULL, 1, 0, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `0_hw_departments`
--

CREATE TABLE `0_hw_departments` (
  `dept_id` smallint NOT NULL,
  `department` varchar(100) NOT NULL DEFAULT '',
  `inactive` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `0_hw_departments`
--

INSERT INTO `0_hw_departments` (`dept_id`, `department`, `inactive`) VALUES
(1, 'Dainik', 0),
(2, 'General', 0),
(3, 'Prasar', 0);

-- --------------------------------------------------------

--
-- Table structure for table `0_hw_items`
--

CREATE TABLE `0_hw_items` (
  `stock_id` varchar(20) NOT NULL DEFAULT '',
  `category_id` int NOT NULL DEFAULT '0',
  `description` varchar(200) NOT NULL DEFAULT '',
  `price` float DEFAULT '0',
  `inactive` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `0_hw_item_owner`
--

CREATE TABLE `0_hw_item_owner` (
  `owner_id` smallint NOT NULL,
  `description` varchar(60) NOT NULL,
  `inactive` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `0_hw_item_owner`
--

INSERT INTO `0_hw_item_owner` (`owner_id`, `description`, `inactive`) VALUES
(1, 'sanatan sanstha', 0),
(2, 'hjs123', 0),
(3, 'personal', 0);

-- --------------------------------------------------------

--
-- Table structure for table `0_hw_stock_category`
--

CREATE TABLE `0_hw_stock_category` (
  `category_id` smallint NOT NULL,
  `description` varchar(60) NOT NULL DEFAULT '',
  `hw_sw` tinyint(1) NOT NULL DEFAULT '1',
  `inactive` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `0_hw_stock_category`
--

INSERT INTO `0_hw_stock_category` (`category_id`, `description`, `hw_sw`, `inactive`) VALUES
(1, 'Processor', 1, 0),
(2, 'Mother Board', 1, 0),
(3, 'RAM', 1, 0),
(4, 'Hard Disk', 1, 0),
(5, 'SMPS', 1, 0),
(6, 'Keyboard', 1, 0),
(7, 'Mouse', 1, 0),
(8, 'Monitor', 1, 0),
(9, 'Cabinet', 1, 0),
(10, 'Operating System', 2, 0),
(11, 'Pagemaker', 2, 0),
(12, 'Antivirus', 2, 0),
(13, 'DVD Writer', 1, 0),
(14, 'MS-Office', 2, 0),
(15, 'Graphic Card', 1, 0),
(16, 'Corel', 2, 0),
(17, 'Photoshop', 2, 0),
(18, 'Indesign', 2, 0),
(19, 'Thin Client ', 1, 0),
(20, 'Shree Lipi', 2, 0);

-- --------------------------------------------------------

--
-- Table structure for table `0_hw_sub_category`
--

CREATE TABLE `0_hw_sub_category` (
  `sub_cat_id` smallint NOT NULL,
  `description` varchar(60) NOT NULL,
  `parent` smallint NOT NULL,
  `inactive` tinyint(1) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `0_hw_sub_category`
--

INSERT INTO `0_hw_sub_category` (`sub_cat_id`, `description`, `parent`, `inactive`) VALUES
(1, 'CS4', 17, 0),
(2, 'CS3', 17, 0),
(3, 'XP Prof. - Paper License', 10, 0),
(4, 'XP Prof. - OEM', 10, 0),
(5, 'Win 7 Prof. - Paper License', 10, 0),
(6, 'Win 7 Prof. - OEM', 10, 0),
(7, 'Win 8.1 Prof. - Paper License', 10, 0),
(8, 'Win 7 Home Basic - OEM', 10, 0),
(9, 'Win 7 Home Pre - OEM', 10, 0),
(10, 'X5', 16, 0),
(11, 'X4 Paper', 16, 0),
(12, 'X3', 16, 0),
(13, 'CS6', 18, 0),
(14, 'Sata', 4, 0),
(15, 'IDE', 4, 0),
(16, 'DDR3', 3, 0),
(17, 'DDR2', 3, 0),
(18, '3.0', 30, 0),
(19, 'CS 5.5', 18, 0),
(20, 'USB', 6, 0);

-- --------------------------------------------------------

--
-- Table structure for table `0_printers`
--

CREATE TABLE `0_printers` (
  `id` tinyint UNSIGNED NOT NULL,
  `name` varchar(20) NOT NULL,
  `description` varchar(60) NOT NULL,
  `queue` varchar(20) NOT NULL,
  `host` varchar(40) NOT NULL,
  `port` smallint UNSIGNED NOT NULL,
  `timeout` tinyint UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `0_printers`
--

INSERT INTO `0_printers` (`id`, `name`, `description`, `queue`, `host`, `port`, `timeout`) VALUES
(1, 'QL500', 'Label printer', 'QL500', 'server', 127, 20),
(2, 'Samsung', 'Main network printer', 'scx4521F', 'server', 515, 5);

-- --------------------------------------------------------

--
-- Table structure for table `0_print_profiles`
--

CREATE TABLE `0_print_profiles` (
  `id` smallint UNSIGNED NOT NULL,
  `profile` varchar(30) NOT NULL,
  `report` varchar(5) DEFAULT NULL,
  `printer` tinyint UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `0_print_profiles`
--

INSERT INTO `0_print_profiles` (`id`, `profile`, `report`, `printer`) VALUES
(1, 'Out of office', NULL, 0),
(2, 'Sales Department', NULL, 0),
(3, 'Central', NULL, 2),
(4, 'Sales Department', '104', 2),
(5, 'Sales Department', '105', 2),
(6, 'Sales Department', '107', 2),
(7, 'Sales Department', '109', 2),
(8, 'Sales Department', '110', 2),
(9, 'Sales Department', '201', 2);

-- --------------------------------------------------------

--
-- Table structure for table `0_security_roles`
--

CREATE TABLE `0_security_roles` (
  `id` int NOT NULL,
  `role` varchar(30) NOT NULL,
  `description` varchar(50) DEFAULT NULL,
  `sections` text,
  `areas` text,
  `inactive` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `0_security_roles`
--

INSERT INTO `0_security_roles` (`id`, `role`, `description`, `sections`, `areas`, `inactive`) VALUES
(1, 'System Administrator', 'System Administrator', '256;512;768;2816;3072;3584', '266;276;286;296;522;532;542;552;562;778;788;798;808;818;2826;2836;2846;3082;3092;3102;3594;3604;3614;3624;3634', 0),
(11, 'General_Ramnathi', 'General Users Edit tkt view asset', '768;2816;3072;3584', '266;276;286;296;522;532;542;552;562;778;788;2826;3594;3604;3634', 0),
(12, 'Hardware V', 'Hardware Vibhag', '768;2816;3072;3584', '266;276;286;296;522;532;542;552;562;778;788;798;818;2826;2836;2846;3082;3594;3604;3624;3634', 0),
(13, 'Hardware Admin', 'Administrator ', '256;512;768;2816;3072;3584', '542;778;788;798;818;2826;2836;2846;3082;3092;3594;3604;3614;3624;3634', 0),
(14, 'General_Devad', 'General Users Edit tkt view asset', '768;2816;3072', '266;276;286;296;522;532;542;552;562;778;788;2826;3594;3604;3614;3624', 0),
(15, 'General_District', 'General Users edit/view asset', '768;2816;3072', '266;276;286;296;522;532;542;552;562;778;788;2826;3594;3604;3614;3624', 0),
(16, 'Hardware V (limited)', 'Having Access HW tkt but read only asset', '768;2816;3584', '266;276;286;296;522;532;542;552;562;778;788;798;818;2826;2846;3082;3092;3102;3594;3604;3624;3634', 0),
(17, 'Ticket_RAsser_all', 'Search Asset, add /edit tickets', '256;768;2816;3584', '522;532;542;552;562;778;788;2826;2836;3082;3092;3102;3594;3604;3634', 0);

-- --------------------------------------------------------

--
-- Table structure for table `0_seva_locations`
--

CREATE TABLE `0_seva_locations` (
  `loc_code` varchar(30) NOT NULL DEFAULT '',
  `location_name` varchar(60) NOT NULL DEFAULT '',
  `is_district` tinyint(1) NOT NULL DEFAULT '0',
  `parent` varchar(60) NOT NULL,
  `delivery_address` tinytext NOT NULL,
  `phone` varchar(30) NOT NULL DEFAULT '',
  `email` varchar(100) NOT NULL DEFAULT '',
  `contact` varchar(30) NOT NULL DEFAULT '',
  `inactive` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `0_seva_locations`
--

INSERT INTO `0_seva_locations` (`loc_code`, `location_name`, `is_district`, `parent`, `delivery_address`, `phone`, `email`, `contact`, `inactive`) VALUES
('201', '201_av', 0, 'Av', '', '', '', '', 0),
('227', '227_av', 0, 'Av', '227 Kholi', '1014', '', 'Ku. Gayatri Jadhav', 0),
('Adhiveshan', 'Adhiveshan', 0, 'HW-RAM', 'Granth Vibhag', '1053', '', 'Chetan Rajhans', 0),
('Ahemdabad', 'Ahemdabad', 0, 'Other_States', '', '', '', 'Shri. Ajay Prajapati', 0),
('Akola', 'Akola', 1, 'Mh_Jillha', '', '', '', 'Shri. Ajay Prajapati', 0),
('Allahabad', 'Allahabad', 0, 'Other_States', '', '', '', 'Shri. Ajay Prajapati', 0),
('Amravati', 'Amravati', 1, 'Mh_Jillha', '', '', '', 'Shri. Ajay Prajapati', 0),
('Av', 'Av', 0, 'HW-RAM', '', '', '', '', 0),
('AV_Archival', 'Archival Vibhag', 0, 'Av', '', '', '', '', 0),
('AV_chitrikaran', 'Chitrikaran Vibhag', 0, 'Av', '', '', '', '', 0),
('AV_Sankalan', 'AV Sankalan Vibhag', 0, 'Av', '', '', '', '', 0),
('Bandhkam_V', 'Bandhkam Vibhag', 0, 'HW-RAM', '', '1126', '', '', 0),
('Bangalore', 'Bangalore', 0, 'Other_States', '', '', '', 'Shri. Ajay Prajapati', 0),
('Bekary', 'Bekary', 0, 'HW-RAM', '', '', '', '', 0),
('Belgaon', 'Belgaon', 0, 'Other_States', '', '', '', 'Shri. Ajay Prajapati', 0),
('Belgaum', 'Belgaum_Sevakendra', 1, 'Computer Hardware', 'Belgaum,Karnatak\n', '', '', 'Anjsh Kananglekar', 0),
('Bhagyanagar', 'Bhagyanagar', 0, 'Other_States', '', '', '', 'Shri. Ajay Prajapati', 0),
('Bharat', 'Bharat', 0, '', '', '', '', '', 0),
('Bhopal', 'Bhopal', 0, 'Other_States', '', '', '', 'Shri. Ajay Prajapati', 0),
('Chandrapur', 'Chandrapur', 1, 'Mh_Jillha', '', '', '', 'Shri. Ajay Prajapati', 0);

-- --------------------------------------------------------

--
-- Table structure for table `0_seva_loc_access`
--

CREATE TABLE `0_seva_loc_access` (
  `id` int NOT NULL,
  `parent` varchar(60) NOT NULL,
  `is_parent_district` tinyint(1) NOT NULL,
  `sub_loc` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='For storing seva_locations for a parent location';

--
-- Dumping data for table `0_seva_loc_access`
--

INSERT INTO `0_seva_loc_access` (`id`, `parent`, `is_parent_district`, `sub_loc`) VALUES
(1, '201', 0, '201'),
(2, '227', 0, '227'),
(3, 'Adhiveshan', 0, 'Adhiveshan'),
(4, 'Ahemdabad', 0, 'Ahemdabad'),
(5, 'Akola', 1, 'Akola'),
(6, 'Allahabad', 0, 'Allahabad'),
(7, 'Amravati', 1, 'Amravati'),
(8, 'Av', 0, 'Av'),
(9, 'Av', 0, '201'),
(10, 'Av', 0, '227'),
(11, 'Av', 0, 'AV_Archival'),
(12, 'Av', 0, 'AV_chitrikaran'),
(13, 'Av', 0, 'AV_Sankalan'),
(14, 'Av', 0, 'Daura'),
(15, 'Av', 0, 'Kala Mandir'),
(16, 'Av', 0, 'Murtishala'),
(17, 'AV_Archival', 0, 'AV_Archival'),
(18, 'AV_chitrikaran', 0, 'AV_chitrikaran'),
(19, 'AV_Sankalan', 0, 'AV_Sankalan'),
(20, 'Bandhkam_V', 0, 'Bandhkam_V');

-- --------------------------------------------------------

--
-- Table structure for table `0_sql_trail`
--

CREATE TABLE `0_sql_trail` (
  `id` int UNSIGNED NOT NULL,
  `sql` text NOT NULL,
  `result` tinyint(1) NOT NULL,
  `msg` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `0_sys_prefs`
--

CREATE TABLE `0_sys_prefs` (
  `name` varchar(35) NOT NULL DEFAULT '',
  `category` varchar(30) DEFAULT NULL,
  `type` varchar(20) NOT NULL DEFAULT '',
  `length` smallint DEFAULT NULL,
  `value` tinytext
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `0_sys_prefs`
--

INSERT INTO `0_sys_prefs` (`name`, `category`, `type`, `length`, `value`) VALUES
('accumulate_shipping', 'glsetup.customer', 'tinyint', 1, '0'),
('add_pct', 'setup.company', 'int', 5, '-1'),
('allow_negative_stock', 'glsetup.inventory', 'tinyint', 1, '0'),
('auto_curr_reval', 'setup.company', 'smallint', 6, '1'),
('bank_charge_act', 'glsetup.general', 'varchar', 15, '5690'),
('base_sales', 'setup.company', 'int', 11, '1'),
('coy_logo', 'setup.company', 'varchar', 100, NULL),
('coy_name', 'setup.company', 'varchar', 60, 'PrasarSahitya'),
('coy_no', 'setup.company', 'varchar', 25, NULL),
('creditors_act', 'glsetup.purchase', 'varchar', 15, '2100'),
('curr_default', 'setup.company', 'char', 3, 'INR'),
('debtors_act', 'glsetup.sales', 'varchar', 15, '1200'),
('default_adj_act', 'glsetup.items', 'varchar', 15, '5040'),
('default_assembly_act', 'glsetup.items', 'varchar', 15, '1530'),
('default_cogs_act', 'glsetup.items', 'varchar', 15, '5010'),
('default_credit_limit', 'glsetup.customer', 'int', 11, '1000'),
('default_delivery_required', 'glsetup.sales', 'smallint', 6, '1'),
('default_dim_required', 'glsetup.dims', 'int', 11, '20'),
('default_inventory_act', 'glsetup.items', 'varchar', 15, '1510'),
('default_inv_sales_act', 'glsetup.items', 'varchar', 15, '4010');

-- --------------------------------------------------------

--
-- Table structure for table `0_tkt_header`
--

CREATE TABLE `0_tkt_header` (
  `tkt_id` mediumint NOT NULL,
  `title` varchar(60) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `description` varchar(2000) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `priority_id` tinyint(1) NOT NULL DEFAULT '2',
  `type_id` tinyint NOT NULL,
  `assign_id` tinyint NOT NULL,
  `status_id` tinyint NOT NULL DEFAULT '1',
  `asset_id` int DEFAULT NULL,
  `assembly_id` int DEFAULT NULL,
  `req_time` varchar(8) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT '0',
  `act_time` varchar(8) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT '0',
  `loc_code` varchar(60) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `duedate` date NOT NULL,
  `created_by` tinyint NOT NULL,
  `created_on` datetime NOT NULL,
  `modified_by` tinyint NOT NULL,
  `modified_on` datetime NOT NULL,
  `is_closed` tinyint(1) NOT NULL DEFAULT '0',
  `is_reopen` tinyint(1) NOT NULL DEFAULT '0',
  `is_approved` tinyint(1) NOT NULL DEFAULT '1',
  `seeker_name` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `inactive` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Dumping data for table `0_tkt_header`
--

INSERT INTO `0_tkt_header` (`tkt_id`, `title`, `description`, `priority_id`, `type_id`, `assign_id`, `status_id`, `asset_id`, `assembly_id`, `req_time`, `act_time`, `loc_code`, `duedate`, `created_by`, `created_on`, `modified_by`, `modified_on`, `is_closed`, `is_reopen`, `is_approved`, `seeker_name`, `inactive`) VALUES
(1, 'namaskar Shrikrushna charani prarthana karuya', 'krushna', 1, 1, 0, 1, 0, 0, '', '', '', '2012-10-20', 1, '2012-10-12 20:03:47', 1, '2012-10-12 20:03:47', 0, 0, 1, '', 0),
(2, 'Shrikrushna charani prarthana karuya', 'n', 1, 1, 0, 1, 0, 0, '', '', '', '2012-10-20', 1, '2012-10-12 20:30:10', 1, '2012-10-12 20:30:10', 0, 0, 1, '', 0),
(3, 'test1', 'check &amp; reply', 1, 3, 9, 3, 394, 0, '5.00', '0.00', 'Dainik', '2012-11-21', 5, '2012-10-13 08:44:43', 16, '2013-04-14 15:17:02', 0, 0, 1, '', 0),
(5, 'No display', ',mhnklh', 1, 1, 5, 3, 0, 2, '2.00', '0.00', 'Murtishala', '2012-10-16', 5, '2012-10-16 09:07:24', 16, '2014-01-26 10:22:13', 0, 0, 1, '', 0),
(6, 'Mouse not working ... sumit', 'pl.', 1, 2, 9, 3, 0, 131, '', '', 'Dainik', '2012-11-18', 8, '2012-11-16 18:10:31', 10, '2012-11-18 18:34:42', 0, 0, 1, '', 0),
(8, 'Internet not working', 'Internet not working.', 1, 1, 5, 3, 0, 29, '0.00', '0.00', '205', '2012-11-19', 5, '2012-11-18 17:58:49', 5, '2012-11-18 18:01:26', 0, 0, 1, '', 0),
(9, 'Internet not workingf ff', 'sss', 1, 2, 0, 3, 0, 9, '', '', '205', '2012-11-19', 5, '2012-11-18 17:59:50', 5, '2012-11-18 18:00:49', 0, 0, 1, '', 0),
(11, 'Licence issue', 'Win7 32 hardware compitablity issue', 2, 1, 5, 3, 0, 139, '0.00', '', 'Kala Vibhag', '2012-11-20', 10, '2012-11-18 18:16:57', 16, '2014-01-26 10:23:35', 0, 0, 1, '', 0),
(15, 'No diplay', 'No Display - Vishal', 2, 2, 0, 3, 0, 44, '', '', 'Dainik', '2013-03-18', 8, '2013-03-17 19:10:54', 16, '2014-01-26 10:20:42', 0, 0, 1, '', 0),
(16, 'Graphics Card Error', 'A few pink strips are observed on the screen often. The screen flickers, the system hangs or reboots on its own. Sometimes the driver software stops responding and quits. Need to replace or repair the graphics card.', 2, 2, 0, 3, 0, 144, '', '', 'Kala Vibhag', '2013-03-21', 7, '2013-03-20 09:58:34', 16, '2014-01-26 10:22:01', 0, 0, 1, '', 0),
(18, 'no disply', 'no disply', 1, 2, 0, 3, 0, 29, '', '', 'Kala Vibhag', '2013-12-29', 7, '2013-12-29 12:01:35', 16, '2014-01-26 10:21:39', 0, 0, 1, '', 0),
(19, 'Unable to delete the file on Shrilakshmi server', 'On Shrilakshmi\\naam\\Sanketsthal\\Anit there is a file android_ppt_we.ppt. \r\n\r\nIt is of 5 mb and I do not need it anymore. But I am unable to delete the file.', 2, 1, 10, 3, 0, 131, '', '', 'Sanketsthal', '2014-02-02', 1, '2014-01-24 13:10:45', 13, '2014-02-08 15:15:12', 0, 0, 1, '', 0),
(20, 'host unreachable', 'Kadhi kadhi host unreachable yete. Yabadalyat PC milava', 3, 3, 0, 3, 0, 156, '', '', 'Dainik', '2014-01-27', 8, '2014-01-26 10:11:26', 13, '2014-02-08 15:13:36', 0, 0, 1, '', 0),
(21, 'Require 5 mouse', 'Require 5 mouse', 2, 10, 0, 3, 0, 0, '', '', 'RAM', '2014-01-31', 1, '2014-01-26 13:55:52', 1, '2014-05-13 19:28:28', 0, 0, 1, '', 0),
(22, 'Dainik 1 Image madhe Niro Dvd writer ghalne', 'Image Madhe, New shrilipi, Quickheal, Dropbox, Niro dvd writer, have\r\n\r\nSeva Suru Ahe', 2, 1, 20, 3, 0, 42, '2.00', '', 'Dainik', '2014-02-11', 8, '2014-01-27 06:37:45', 20, '2014-02-12 14:20:10', 0, 0, 1, '', 0),
(23, 'Intercom problem', 'sakali 1212 ghenyasathi koni nasatanna to disconnect karun thevu shakto ka? :sharwari', 2, 3, 36, 3, 0, 0, '0.30', '', '201', '2014-02-14', 32, '2014-01-27 16:10:28', 13, '2014-02-16 07:47:38', 0, 0, 1, '', 0),
(24, 'Need RAM upgrade', 'In designe sathi RAM kami padate - Sayali W', 2, 10, 10, 3, 0, 74, '1.00', '', 'Granth', '2014-02-17', 23, '2014-01-28 11:32:20', 10, '2014-02-16 13:47:24', 0, 0, 1, '', 0),
(25, 'back up hardiskche userla deletion hot nahi', 'back up hardiskche userla deletion hot nahi', 1, 1, 0, 3, 0, 64, '', '', 'Dainik', '2014-01-29', 8, '2014-01-29 11:43:34', 13, '2014-02-08 07:41:16', 0, 0, 1, '', 0),
(26, 'back up hardiskche deletion', 'back up hardiskche deletion userla hot nahi tyache setting karun have', 1, 1, 0, 3, 0, 48, '', '', 'Dainik', '2014-01-29', 8, '2014-01-29 11:47:08', 13, '2014-02-08 07:41:56', 0, 0, 1, '', 0),
(27, 'Computer is not working...', 'Suru hot nahi...', 2, 2, 0, 3, 0, 223, '', '', 'Sanketsthal', '2014-02-01', 11, '2014-01-30 18:23:09', 13, '2014-02-12 14:16:27', 0, 0, 1, '', 0);

-- --------------------------------------------------------

--
-- Table structure for table `0_tkt_reply`
--

CREATE TABLE `0_tkt_reply` (
  `reply_id` int NOT NULL,
  `tkt_id` mediumint NOT NULL,
  `reply_description` varchar(500) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `created_by` tinyint NOT NULL,
  `created_on` datetime NOT NULL,
  `unread` tinyint(1) NOT NULL DEFAULT '0',
  `inactive` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `0_tkt_reply`
--

INSERT INTO `0_tkt_reply` (`reply_id`, `tkt_id`, `reply_description`, `created_by`, `created_on`, `unread`, `inactive`) VALUES
(1, 6, 'pl. check the cable', 1, '2012-11-16 18:11:37', 0, 0),
(2, 6, 'cable is ok', 8, '2012-11-16 18:13:02', 0, 0),
(3, 6, 'pl. try another mouse', 1, '2012-11-16 18:13:29', 0, 0),
(4, 6, 'ok but can u come here', 8, '2012-11-16 18:14:18', 0, 0),
(5, 7, 'please chech cable', 5, '2012-11-17 14:27:44', 0, 0),
(6, 7, 'cable is ok', 7, '2012-11-17 14:28:18', 0, 0),
(7, 7, 'ps2 port is damaged', 9, '2012-11-17 14:45:00', 0, 0),
(8, 12, 'Num LED is Not Working...', 7, '2012-11-20 07:48:15', 0, 0),
(9, 13, 'Cable is damaged', 7, '2012-11-20 10:22:38', 0, 0),
(10, 15, 'urgent', 8, '2013-03-17 19:13:14', 0, 0),
(11, 19, 'We will try to solve this in 3 days', 16, '2014-01-26 10:24:17', 0, 0),
(12, 19, 'Ok, krutadnya', 1, '2014-01-26 13:51:39', 0, 0),
(13, 20, 'Sadhya TC badlun baghto', 16, '2014-01-27 12:38:05', 0, 0),
(15, 29, 'User - sonali_b\r\nPls call for password', 16, '2014-02-02 14:35:11', 0, 0),
(16, 28, 'User digvijay_c\r\nPass w - pls contact\r\nfor server access - pls contact', 16, '2014-02-02 14:44:45', 0, 0),
(17, 30, 'sadhya neelesh padhye baher gavi asalyane 8 tarakhe paryant sodavu shakato', 13, '2014-02-03 15:43:10', 0, 0),
(18, 23, 'wire kadhun thevu shakata', 13, '2014-02-04 07:14:58', 0, 0),
(19, 25, 'file name mothe asalyamule back hot navata. admin madhun backup lavalyamule back up fast hoto - neelesh. ata adachan sutali', 13, '2014-02-04 07:16:18', 0, 0),
(20, 37, 'install kele', 13, '2014-02-08 07:39:40', 0, 0),
(21, 39, 'ekach user don thikani vaparat aslyane error yet hoti. dusara user set kela - mahesh', 13, '2014-02-08 07:40:42', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `0_tkt_types`
--

CREATE TABLE `0_tkt_types` (
  `type_id` smallint NOT NULL,
  `type` varchar(100) NOT NULL DEFAULT '',
  `inactive` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `0_tkt_types`
--

INSERT INTO `0_tkt_types` (`type_id`, `type`, `inactive`) VALUES
(1, 'Software', 0),
(2, 'Hardware', 0),
(3, 'Other', 0),
(10, 'Demand', 0),
(11, 'Network', 0),
(12, 'Telephone', 0),
(13, 'Firewall', 0),
(14, 'User / Server ', 0),
(15, 'Asset', 0),
(16, 'Laptop', 0),
(17, 'SDNA Software', 0),
(18, 'CacheA', 0),
(19, 'DNA Server', 0),
(20, 'Thecus NAS', 0),
(23, 'Purchase', 0),
(24, 'HP-LTO6', 0),
(25, 'CCTV', 0),
(26, 'Mobile', 0),
(27, 'System', 0),
(28, 'warranty', 0);

-- --------------------------------------------------------

--
-- Table structure for table `0_useronline`
--

CREATE TABLE `0_useronline` (
  `id` int NOT NULL,
  `timestamp` int NOT NULL DEFAULT '0',
  `ip` varchar(40) NOT NULL DEFAULT '',
  `file` varchar(100) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `0_useronline`
--

INSERT INTO `0_useronline` (`id`, `timestamp`, `ip`, `file`) VALUES
(1268949, 1750584710, '118.185.65.162', '/index.php'),
(1268950, 1750584716, '118.185.65.162', '/hw/ticket/ticket_inquiry.php'),
(1268951, 1750584737, '118.185.65.162', '/hw/ticket/ticket.php'),
(1268952, 1750584743, '118.185.65.162', '/hw/ticket/reply.php'),
(1268953, 1750584746, '182.72.250.82', '/index.php'),
(1268954, 1750584755, '118.185.65.162', '/hw/ticket/reply.php'),
(1268955, 1750584755, '182.72.250.82', '/index.php'),
(1268956, 1750584761, '182.72.250.82', '/admin/backups.php');

-- --------------------------------------------------------

--
-- Table structure for table `0_users`
--

CREATE TABLE `0_users` (
  `id` smallint NOT NULL,
  `user_id` varchar(60) NOT NULL DEFAULT '',
  `password` varchar(100) NOT NULL DEFAULT '',
  `real_name` varchar(100) NOT NULL DEFAULT '',
  `role_id` int NOT NULL DEFAULT '1',
  `phone` varchar(30) NOT NULL DEFAULT '',
  `email` varchar(100) DEFAULT NULL,
  `language` varchar(20) DEFAULT NULL,
  `date_format` tinyint(1) NOT NULL DEFAULT '0',
  `date_sep` tinyint(1) NOT NULL DEFAULT '0',
  `tho_sep` tinyint(1) NOT NULL DEFAULT '0',
  `dec_sep` tinyint(1) NOT NULL DEFAULT '0',
  `theme` varchar(20) NOT NULL DEFAULT 'default',
  `page_size` varchar(20) NOT NULL DEFAULT 'A4',
  `prices_dec` smallint NOT NULL DEFAULT '2',
  `qty_dec` smallint NOT NULL DEFAULT '2',
  `rates_dec` smallint NOT NULL DEFAULT '4',
  `percent_dec` smallint NOT NULL DEFAULT '1',
  `show_gl` tinyint(1) NOT NULL DEFAULT '1',
  `show_codes` tinyint(1) NOT NULL DEFAULT '0',
  `show_hints` tinyint(1) NOT NULL DEFAULT '0',
  `last_visit_date` datetime DEFAULT NULL,
  `query_size` tinyint(1) DEFAULT '10',
  `graphic_links` tinyint(1) DEFAULT '1',
  `pos` smallint DEFAULT '1',
  `print_profile` varchar(30) NOT NULL DEFAULT '1',
  `rep_popup` tinyint(1) DEFAULT '1',
  `sticky_doc_date` tinyint(1) DEFAULT '0',
  `startup_tab` varchar(20) NOT NULL DEFAULT '',
  `inactive` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `0_users`
--

INSERT INTO `0_users` (`id`, `user_id`, `password`, `real_name`, `role_id`, `phone`, `email`, `language`, `date_format`, `date_sep`, `tho_sep`, `dec_sep`, `theme`, `page_size`, `prices_dec`, `qty_dec`, `rates_dec`, `percent_dec`, `show_gl`, `show_codes`, `show_hints`, `last_visit_date`, `query_size`, `graphic_links`, `pos`, `print_profile`, `rep_popup`, `sticky_doc_date`, `startup_tab`, `inactive`) VALUES
(1, 'admin', '12d9144de76175c29456ea8a6d8bce9a', 'Administrator', 1, '', 'adm@adm.com', 'C', 1, 2, 0, 0, 'modern', 'A4', 2, 2, 4, 1, 1, 1, 0, '2025-05-04 16:35:18', 127, 1, 1, '', 1, 0, 'hw_com', 0),
(8, 'dainik', '0004da3e7ebdd80dca17eaf0c209c5ca', 'Dainik Vibhag', 11, '1127, 1128', NULL, 'C', 1, 2, 0, 0, 'aqua', 'A4', 2, 2, 4, 1, 1, 1, 0, '2025-06-19 14:03:30', 50, 1, 1, '', 1, 0, 'hw_com', 0),
(9, 'shraddha_l', '76906cf37550282fc5daeaaf36b7eb2c', 'Shraddha Londhe', 13, '1141', NULL, 'C', 1, 2, 0, 0, 'modern', 'A4', 2, 2, 4, 1, 1, 1, 0, '2025-06-22 12:39:02', 50, 1, 1, '', 1, 0, 'hw_com', 0),
(11, 'sanketsthal', 'df2874f5e2d0b123d70b624a1b62eb49', 'Sanketsthal', 11, '1107', 'sevakweb@gmail.com', 'C', 1, 2, 0, 0, 'cool', 'A4', 2, 2, 4, 1, 1, 1, 0, '2025-02-10 13:21:09', 100, 1, 1, '', 1, 0, 'hw_com', 0),
(12, 'sandesh_h', '81dc9bdb52d04dc20036dbd8313ed055', 'Sandesh Hazare', 12, '1141', NULL, 'C', 1, 2, 0, 0, 'cool', 'A4', 2, 2, 4, 1, 1, 1, 0, '2017-03-16 14:22:31', 50, 1, 1, '', 1, 0, 'hw_com', 1),
(13, 'mahesh_c', 'e4b3931ccd6d76d99fad4767d6a83ac9', 'Mahesh Chavan', 13, '1141', 'mahesh5689@gmail.com', 'C', 1, 2, 0, 0, 'default', 'Letter', 2, 2, 4, 1, 1, 1, 0, '2025-06-22 13:51:11', 50, 1, 1, '', 1, 1, 'hw_com', 0),
(14, 'Mohit_M', '5f4dcc3b5aa765d61d8327deb882cf99', 'Mohit Mahakal', 12, '1201', NULL, 'C', 1, 2, 0, 0, 'cool', 'A4', 2, 2, 4, 1, 1, 1, 0, NULL, 50, 1, 1, '', 1, 0, 'hw_com', 1),
(16, 'neelesh_c', '8253d0aae52e08f943f35604a42f4335', 'Neelesh Chitale', 13, '1160', NULL, 'C', 1, 2, 0, 0, 'modern', 'A4', 2, 2, 4, 1, 1, 1, 1, '2025-06-22 14:58:36', 25, 1, 1, '', 1, 0, 'hw_com', 0),
(17, 'Dadasaheb_G', '5f4dcc3b5aa765d61d8327deb882cf99', 'Dadasaheb Ghadge', 12, '1141', NULL, 'C', 1, 2, 0, 0, 'cool', 'A4', 2, 2, 4, 1, 1, 1, 0, '2015-08-13 15:53:09', 50, 1, 1, '', 1, 0, 'hw_com', 1),
(18, 'Reshak_G', '5f4dcc3b5aa765d61d8327deb882cf99', 'Reshak Gaokar', 12, '9923398851', NULL, 'C', 1, 2, 0, 0, 'fancy', 'A4', 2, 2, 4, 1, 1, 1, 0, '2025-01-27 09:44:38', 50, 1, 1, '', 1, 0, 'hw_com', 0),
(19, 'niresh_t', '8ecd3f2b787c9c99d7c0ffee6e6263be', 'Niresh Tari', 16, '9823253124', NULL, 'C', 1, 2, 0, 0, 'cool', 'A4', 2, 2, 4, 1, 1, 1, 0, '2018-09-20 16:50:38', 50, 1, 1, '', 1, 0, 'hw_com', 1),
(21, 'hindi', '53397a27af8caa803ca11617a21d7ac9', 'Hindi Vibhag', 11, '1211', NULL, 'C', 1, 2, 0, 0, 'cool', 'A4', 2, 2, 4, 1, 1, 1, 0, '2025-06-21 12:43:38', 50, 1, 1, '', 1, 0, 'hw_com', 0),
(22, 'english', '482c811da5d5b4bc6d497ffa98491e38', 'English Vibhag', 11, '1211', NULL, 'C', 1, 2, 0, 0, 'cool', 'A4', 2, 2, 4, 1, 1, 1, 0, '2025-04-25 18:59:28', 50, 1, 1, '', 1, 0, 'hw_com', 0),
(23, 'granth', '76036fe1c4b573f156c0a0cea233f6a8', 'Granth Vibhag', 11, '1112, 1113', NULL, 'C', 1, 2, 0, 0, 'cool', 'A4', 2, 2, 4, 1, 1, 1, 0, '2025-06-21 22:26:57', 50, 1, 1, '', 1, 0, 'hw_com', 0),
(24, 'Gujarati', '5f4dcc3b5aa765d61d8327deb882cf99', 'Gujarati Vibhag', 11, '1211', NULL, 'C', 1, 2, 0, 0, 'cool', 'A4', 2, 2, 4, 1, 1, 1, 0, '2019-12-21 15:20:08', 50, 1, 1, '', 1, 0, 'hw_com', 0),
(25, 'Dainik_Lekha', '5f4dcc3b5aa765d61d8327deb882cf99', 'Dainik Lekha Vibhag', 11, '1131', NULL, 'C', 1, 2, 0, 0, 'cool', 'A4', 2, 2, 4, 1, 1, 1, 0, '2025-06-07 17:53:42', 50, 1, 1, '', 1, 0, 'hw_com', 0),
(26, 'Nyas', '5f4dcc3b5aa765d61d8327deb882cf99', 'Nyas Vibhag', 11, '1130', NULL, 'C', 1, 2, 0, 0, 'cool', 'A4', 2, 2, 4, 1, 1, 1, 0, '2024-09-09 20:56:49', 50, 1, 1, '', 1, 0, 'hw_com', 0),
(27, 'Bandhkam', '5f4dcc3b5aa765d61d8327deb882cf99', 'Bandhkam Vibhag', 11, '1149', NULL, 'C', 1, 2, 0, 0, 'cool', 'A4', 2, 2, 4, 1, 1, 1, 0, '2025-05-27 07:00:30', 50, 1, 1, '', 1, 0, 'hw_com', 0),
(28, 'Jilha_Lekha', '5f4dcc3b5aa765d61d8327deb882cf99', 'Jilha Lekha Vibhag', 11, '1151', NULL, 'C', 1, 2, 0, 0, 'cool', 'A4', 2, 2, 4, 1, 1, 1, 0, '2019-05-10 13:26:06', 50, 1, 1, '', 1, 0, 'hw_com', 0),
(29, 'Videsh', '81dc9bdb52d04dc20036dbd8313ed055', 'Videsh Vibhag', 11, '1213', NULL, 'C', 1, 2, 0, 0, 'cool', 'A4', 2, 2, 4, 1, 1, 1, 0, '2025-06-11 20:30:38', 50, 1, 1, '', 1, 0, 'hw_com', 0);

-- --------------------------------------------------------

--
-- Table structure for table `0_user_cust_link`
--

CREATE TABLE `0_user_cust_link` (
  `id` smallint NOT NULL,
  `user_id` smallint NOT NULL,
  `cust_code` varchar(60) NOT NULL,
  `banks` tinytext,
  `inactive` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `0_user_cust_link`
--

INSERT INTO `0_user_cust_link` (`id`, `user_id`, `cust_code`, `banks`, `inactive`) VALUES
(2, 38, '48', NULL, 0),
(3, 27, '35', NULL, 0),
(4, 19, '23', NULL, 0),
(5, 34, '44', NULL, 0),
(6, 20, '25', NULL, 0),
(7, 12, '14', NULL, 0),
(8, 13, '15', NULL, 0),
(9, 22, '41', NULL, 0),
(10, 17, '19', NULL, 0),
(11, 35, '45', NULL, 0),
(12, 37, '47', NULL, 0),
(13, 32, '38', NULL, 0),
(14, 33, '62', NULL, 0),
(15, 39, '50', NULL, 0),
(16, 7, '9', NULL, 0),
(17, 23, '31', NULL, 0),
(18, 8, '10', NULL, 0),
(19, 31, '40', NULL, 0),
(20, 30, '57', NULL, 0),
(21, 25, '33', NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `0_user_loc_link`
--

CREATE TABLE `0_user_loc_link` (
  `id` smallint NOT NULL,
  `user_id` smallint NOT NULL,
  `loc_code` varchar(60) NOT NULL,
  `departments` varchar(100) NOT NULL,
  `inactive` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `0_user_loc_link`
--

INSERT INTO `0_user_loc_link` (`id`, `user_id`, `loc_code`, `departments`, `inactive`) VALUES
(3, 1, 'Bharat', '1,2,3', 0),
(4, 3, 'TEST', '2,3', 0),
(5, 4, 'SAMPLE', '2', 0),
(6, 5, 'HW-RAM', '1', 0),
(7, 6, 'HW-RAM', '3', 0),
(8, 7, 'Kala Vibhag', '', 0),
(9, 8, 'Dainik', '', 0),
(10, 9, 'HW-RAM', '2', 0),
(11, 10, 'HW-RAM', '', 0),
(13, 13, 'HW-RAM', '', 0),
(16, 16, 'HW-RAM', '', 0),
(18, 18, 'HW-RAM', '', 0),
(19, 19, 'HW-RAM', '', 0),
(20, 20, 'HW-RAM', '', 0),
(22, 21, 'Hindi', '', 0),
(23, 22, 'English', '', 0),
(24, 23, 'Granth', '', 0),
(25, 24, 'Gujrathi', '2', 0),
(26, 25, 'Daink_Lekha', '', 0),
(27, 27, 'Bandhkam_V', '', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `0_fiscal_year`
--
ALTER TABLE `0_fiscal_year`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `begin` (`begin`),
  ADD UNIQUE KEY `end` (`end`);

--
-- Indexes for table `0_hw_assembly`
--
ALTER TABLE `0_hw_assembly`
  ADD PRIMARY KEY (`assembly_id`),
  ADD KEY `assembly_code` (`assembly_code`),
  ADD KEY `loc_code` (`loc_code`),
  ADD KEY `user` (`user`),
  ADD KEY `return_to_location` (`return_to_location`),
  ADD KEY `created_by` (`created_by`),
  ADD KEY `modified_by` (`modified_by`);

--
-- Indexes for table `0_hw_assembly_trans`
--
ALTER TABLE `0_hw_assembly_trans`
  ADD PRIMARY KEY (`id`),
  ADD KEY `assembly_code` (`assembly_id`),
  ADD KEY `loc_code` (`loc_code`),
  ADD KEY `return_to_location` (`return_to_location`),
  ADD KEY `created_by` (`created_by`),
  ADD KEY `status` (`status`);

--
-- Indexes for table `0_hw_assets`
--
ALTER TABLE `0_hw_assets`
  ADD PRIMARY KEY (`asset_id`),
  ADD KEY `assembly` (`assembly_id`),
  ADD KEY `asset_category_id` (`asset_category_id`),
  ADD KEY `sub_category_id` (`sub_category_id`),
  ADD KEY `user` (`user`),
  ADD KEY `loc_code` (`loc_code`),
  ADD KEY `asset_code` (`asset_code`),
  ADD KEY `return_to_location` (`return_to_location`),
  ADD KEY `created_by` (`created_by`),
  ADD KEY `modified_by` (`modified_by`);

--
-- Indexes for table `0_hw_assets_trans`
--
ALTER TABLE `0_hw_assets_trans`
  ADD PRIMARY KEY (`id`),
  ADD KEY `assembly` (`assembly_id`),
  ADD KEY `asset_id` (`asset_id`),
  ADD KEY `loc_code` (`loc_code`),
  ADD KEY `created_by` (`created_by`),
  ADD KEY `status` (`status`);

--
-- Indexes for table `0_hw_departments`
--
ALTER TABLE `0_hw_departments`
  ADD PRIMARY KEY (`dept_id`);

--
-- Indexes for table `0_hw_items`
--
ALTER TABLE `0_hw_items`
  ADD PRIMARY KEY (`stock_id`);

--
-- Indexes for table `0_hw_item_owner`
--
ALTER TABLE `0_hw_item_owner`
  ADD PRIMARY KEY (`owner_id`);

--
-- Indexes for table `0_hw_stock_category`
--
ALTER TABLE `0_hw_stock_category`
  ADD PRIMARY KEY (`category_id`),
  ADD UNIQUE KEY `description` (`description`);

--
-- Indexes for table `0_hw_sub_category`
--
ALTER TABLE `0_hw_sub_category`
  ADD PRIMARY KEY (`sub_cat_id`);

--
-- Indexes for table `0_printers`
--
ALTER TABLE `0_printers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `0_print_profiles`
--
ALTER TABLE `0_print_profiles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `profile` (`profile`,`report`);

--
-- Indexes for table `0_security_roles`
--
ALTER TABLE `0_security_roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `role` (`role`);

--
-- Indexes for table `0_seva_locations`
--
ALTER TABLE `0_seva_locations`
  ADD PRIMARY KEY (`loc_code`),
  ADD KEY `parent` (`parent`),
  ADD KEY `location_name` (`location_name`);

--
-- Indexes for table `0_seva_loc_access`
--
ALTER TABLE `0_seva_loc_access`
  ADD PRIMARY KEY (`id`),
  ADD KEY `parent` (`parent`);

--
-- Indexes for table `0_sql_trail`
--
ALTER TABLE `0_sql_trail`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `0_sys_prefs`
--
ALTER TABLE `0_sys_prefs`
  ADD PRIMARY KEY (`name`),
  ADD KEY `category` (`category`);

--
-- Indexes for table `0_tkt_header`
--
ALTER TABLE `0_tkt_header`
  ADD PRIMARY KEY (`tkt_id`),
  ADD KEY `assign_id` (`assign_id`),
  ADD KEY `loc_code` (`loc_code`),
  ADD KEY `asset_id` (`asset_id`),
  ADD KEY `assembly_id` (`assembly_id`),
  ADD KEY `created_by` (`created_by`),
  ADD KEY `type_id` (`type_id`),
  ADD KEY `priority_id` (`priority_id`),
  ADD KEY `status_id` (`status_id`),
  ADD KEY `modified_by` (`modified_by`);

--
-- Indexes for table `0_tkt_reply`
--
ALTER TABLE `0_tkt_reply`
  ADD PRIMARY KEY (`reply_id`),
  ADD KEY `tkt_id` (`tkt_id`),
  ADD KEY `created_by` (`created_by`),
  ADD KEY `unread` (`unread`);

--
-- Indexes for table `0_tkt_types`
--
ALTER TABLE `0_tkt_types`
  ADD PRIMARY KEY (`type_id`);

--
-- Indexes for table `0_useronline`
--
ALTER TABLE `0_useronline`
  ADD PRIMARY KEY (`id`),
  ADD KEY `timestamp` (`timestamp`),
  ADD KEY `ip` (`ip`);

--
-- Indexes for table `0_users`
--
ALTER TABLE `0_users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `user_id` (`user_id`);

--
-- Indexes for table `0_user_cust_link`
--
ALTER TABLE `0_user_cust_link`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_cust` (`user_id`,`cust_code`);

--
-- Indexes for table `0_user_loc_link`
--
ALTER TABLE `0_user_loc_link`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_cust` (`user_id`,`loc_code`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `0_fiscal_year`
--
ALTER TABLE `0_fiscal_year`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `0_hw_assembly`
--
ALTER TABLE `0_hw_assembly`
  MODIFY `assembly_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1706;

--
-- AUTO_INCREMENT for table `0_hw_assembly_trans`
--
ALTER TABLE `0_hw_assembly_trans`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6567;

--
-- AUTO_INCREMENT for table `0_hw_assets`
--
ALTER TABLE `0_hw_assets`
  MODIFY `asset_id` mediumint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10880;

--
-- AUTO_INCREMENT for table `0_hw_assets_trans`
--
ALTER TABLE `0_hw_assets_trans`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29845;

--
-- AUTO_INCREMENT for table `0_hw_departments`
--
ALTER TABLE `0_hw_departments`
  MODIFY `dept_id` smallint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `0_hw_item_owner`
--
ALTER TABLE `0_hw_item_owner`
  MODIFY `owner_id` smallint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `0_hw_stock_category`
--
ALTER TABLE `0_hw_stock_category`
  MODIFY `category_id` smallint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=190;

--
-- AUTO_INCREMENT for table `0_hw_sub_category`
--
ALTER TABLE `0_hw_sub_category`
  MODIFY `sub_cat_id` smallint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=88;

--
-- AUTO_INCREMENT for table `0_printers`
--
ALTER TABLE `0_printers`
  MODIFY `id` tinyint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `0_print_profiles`
--
ALTER TABLE `0_print_profiles`
  MODIFY `id` smallint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `0_security_roles`
--
ALTER TABLE `0_security_roles`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `0_seva_loc_access`
--
ALTER TABLE `0_seva_loc_access`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=607;

--
-- AUTO_INCREMENT for table `0_sql_trail`
--
ALTER TABLE `0_sql_trail`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `0_tkt_header`
--
ALTER TABLE `0_tkt_header`
  MODIFY `tkt_id` mediumint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15832;

--
-- AUTO_INCREMENT for table `0_tkt_reply`
--
ALTER TABLE `0_tkt_reply`
  MODIFY `reply_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60934;

--
-- AUTO_INCREMENT for table `0_tkt_types`
--
ALTER TABLE `0_tkt_types`
  MODIFY `type_id` smallint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `0_useronline`
--
ALTER TABLE `0_useronline`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1268957;

--
-- AUTO_INCREMENT for table `0_users`
--
ALTER TABLE `0_users`
  MODIFY `id` smallint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=97;

--
-- AUTO_INCREMENT for table `0_user_cust_link`
--
ALTER TABLE `0_user_cust_link`
  MODIFY `id` smallint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=91;

--
-- AUTO_INCREMENT for table `0_user_loc_link`
--
ALTER TABLE `0_user_loc_link`
  MODIFY `id` smallint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=88;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

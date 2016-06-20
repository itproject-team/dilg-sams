-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jun 15, 2016 at 10:06 PM
-- Server version: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `dilg`
--

-- --------------------------------------------------------

--
-- Table structure for table `asset_inventory`
--

CREATE TABLE IF NOT EXISTS `asset_inventory` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `asset_no` varchar(45) NOT NULL,
  `asset_name` varchar(45) NOT NULL,
  `asset_description` varchar(45) NOT NULL,
  `status` varchar(45) NOT NULL,
  `remarks` varchar(255) NOT NULL,
  `emp_id` int(11) DEFAULT NULL,
  `distinction_no` varchar(255) NOT NULL,
  `form_id` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `emp_id_idx` (`emp_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `asset_inventory`
--

INSERT INTO `asset_inventory` (`id`, `asset_no`, `asset_name`, `asset_description`, `status`, `remarks`, `emp_id`, `distinction_no`, `form_id`) VALUES
(1, 'ACC-2016-1', 'Printer', 'Inkjet Laser Printer, black', '', 'For printing only', 4, 'DHF265', '2016-06-1'),
(2, '', 'Printer', 'Inkjet Laser Printer, black', '', '', NULL, 'LGU956', '2016-06-1'),
(3, '', 'Stapler', 'Swingline Heavy Duty, black', '', '', NULL, 'STP1', '2016-06-1'),
(4, '', 'Stapler', 'Swingline Heavy Duty, black', '', '', NULL, 'STP2', '2016-06-1'),
(5, '', 'Table', 'Table 2072 Office Table, gray', '', '', NULL, 'HF4', '2016-06-1'),
(6, '', 'Chair', 'Q6A Mesh Chair, white', '', '', NULL, 'KJ3', '2016-06-1');

-- --------------------------------------------------------

--
-- Table structure for table `asset_part`
--

CREATE TABLE IF NOT EXISTS `asset_part` (
  `asset_part_no` varchar(45) NOT NULL,
  `asset_part_name` varchar(45) DEFAULT NULL,
  `asset_part_description` varchar(45) DEFAULT NULL,
  `status` varchar(255) NOT NULL,
  `asset_no` varchar(45) DEFAULT NULL,
  `distinction_no` varchar(255) NOT NULL,
  `remarks` varchar(255) NOT NULL,
  KEY `asset_idx` (`asset_no`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `asset_part`
--

INSERT INTO `asset_part` (`asset_part_no`, `asset_part_name`, `asset_part_description`, `status`, `asset_no`, `distinction_no`, `remarks`) VALUES
('ACC-2016-1-', 'Cartridge', 'Black', 'Serviceable', 'ACC-2016-1', 'HJH290', 'Continuous ink');

-- --------------------------------------------------------

--
-- Table structure for table `department`
--

CREATE TABLE IF NOT EXISTS `department` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `department`
--

INSERT INTO `department` (`id`, `name`) VALUES
(1, 'GSS'),
(2, 'Accounting'),
(3, 'IT'),
(4, 'Department 1'),
(5, 'Department 2');

-- --------------------------------------------------------

--
-- Table structure for table `disposed`
--

CREATE TABLE IF NOT EXISTS `disposed` (
  `wmr_no` varchar(45) NOT NULL,
  `employee` int(11) NOT NULL,
  `asset_no` varchar(45) NOT NULL,
  `date_disposed` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `disposed_id` varchar(45) NOT NULL,
  PRIMARY KEY (`wmr_no`),
  KEY `wmr_disposed_idx` (`wmr_no`),
  KEY `emp_id_idx` (`employee`),
  KEY `emp_idx` (`employee`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `iar`
--

CREATE TABLE IF NOT EXISTS `iar` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `iar_no` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `date_created` date NOT NULL,
  `date_modified` date NOT NULL,
  `po_id` int(11) NOT NULL,
  `created_by` varchar(255) DEFAULT NULL,
  `modified_by` varchar(255) NOT NULL,
  `inspected_by` varchar(45) DEFAULT NULL,
  `inspected_position` varchar(45) DEFAULT NULL,
  `requisitioning` varchar(45) DEFAULT NULL,
  `accepted_by` varchar(45) DEFAULT NULL,
  `accepted_position` varchar(45) DEFAULT NULL,
  `invoice_no` varchar(45) DEFAULT NULL,
  `date_received` date DEFAULT NULL,
  `date_inspected` date DEFAULT NULL,
  `responsibility_code` varchar(45) DEFAULT NULL,
  `entity_naming` varchar(45) DEFAULT NULL,
  `fund_cluster` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `po_id_idx` (`po_id`),
  KEY `po_id2_idx` (`po_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `iar`
--

INSERT INTO `iar` (`id`, `iar_no`, `status`, `date_created`, `date_modified`, `po_id`, `created_by`, `modified_by`, `inspected_by`, `inspected_position`, `requisitioning`, `accepted_by`, `accepted_position`, `invoice_no`, `date_received`, `date_inspected`, `responsibility_code`, `entity_naming`, `fund_cluster`) VALUES
(1, '2016-06-1', 'completed', '2016-06-16', '0000-00-00', 1, 'Carl Thomas Rivera', 'Carl Thomas Rivera', 'Joshua Manzano', 'Officer 4', 'GSS', 'Paul Raul', 'Officer 2', '98', '2016-06-21', '2016-06-21', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `invoice`
--

CREATE TABLE IF NOT EXISTS `invoice` (
  `invoice_no` varchar(45) NOT NULL,
  `employee_a` varchar(45) NOT NULL,
  `employee_b` varchar(45) NOT NULL,
  `emp_no` varchar(45) NOT NULL,
  `asset_no` varchar(45) NOT NULL,
  `asset_name` varchar(45) NOT NULL,
  `asset_description` varchar(45) NOT NULL,
  `date_created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_modifed` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` varchar(45) NOT NULL,
  KEY `emp_a_idx` (`employee_a`),
  KEY `asset_no_idx` (`asset_no`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

CREATE TABLE IF NOT EXISTS `items` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `qty` int(11) NOT NULL,
  `unit_cost` float NOT NULL,
  `total_cost` float NOT NULL,
  `form_type` varchar(255) NOT NULL,
  `source` varchar(255) NOT NULL,
  `item_type` varchar(255) NOT NULL,
  `form_id` int(11) NOT NULL,
  `filename` varchar(255) NOT NULL,
  `dispense_qty` int(11) NOT NULL,
  `code` varchar(45) DEFAULT NULL,
  `delivered_qty` int(11) NOT NULL,
  `unit` varchar(45) NOT NULL,
  `distinction_no` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=23 ;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`id`, `name`, `description`, `qty`, `unit_cost`, `total_cost`, `form_type`, `source`, `item_type`, `form_id`, `filename`, `dispense_qty`, `code`, `delivered_qty`, `unit`, `distinction_no`) VALUES
(1, 'Pencil', 'Mongol, No. 2', 10, 5, 50, 'po', 'csv', 'supply', 1, 'Abstract.csv', 0, 'PEN-01', 0, 'pcs.', ''),
(2, 'Bond Paper', 'Multipurpose legal, 70gsm.', 300, 1, 300, 'po', 'csv', 'supply', 1, 'Abstract.csv', 0, 'PAP-01', 0, 'rm.', ''),
(3, 'Printer', 'Inkjet Laser Printer, black', 2, 3000, 6000, 'po', 'csv', 'asset', 1, 'Abstract.csv', 0, '', 0, 'pcs.', ''),
(4, 'Tape', 'Double-Sided Tape, 2inches', 10, 20, 200, 'po', 'csv', 'supply', 1, 'Abstract.csv', 0, 'TAP-01', 0, 'pcs.', ''),
(5, 'Paper Clip', 'Multicolored Paper, 500pcs', 50, 25, 1250, 'po', 'csv', 'supply', 1, 'Abstract.csv', 0, 'CLI-01', 0, 'pcs.', ''),
(6, 'Stapler', 'Swingline Heavy Duty, black', 2, 100, 1000, 'po', 'csv', 'asset', 1, 'Abstract.csv', 0, '', 0, 'pcs.', ''),
(7, 'Table', 'Table 2072 Office Table, gray', 1, 3000, 15000, 'po', 'csv', 'asset', 1, 'Abstract.csv', 0, '', 0, 'pcs.', ''),
(8, 'Chair', 'Q6A Mesh Chair, white', 1, 3000, 15000, 'po', 'csv', 'asset', 1, 'Abstract.csv', 0, '', 0, 'pcs.', ''),
(9, 'Pencil', 'Mongol, No. 2', 10, 5, 50, 'iar', 'csv', 'supply', 1, '', 0, 'PEN-01', 10, '', ''),
(10, 'Bond Paper', 'Multipurpose legal, 70gsm.', 300, 1, 300, 'iar', 'csv', 'supply', 1, '', 0, 'PAP-01', 300, '', ''),
(11, 'Tape', 'Double-Sided Tape, 2inches', 10, 20, 200, 'iar', 'csv', 'supply', 1, '', 0, 'TAP-01', 10, '', ''),
(12, 'Paper Clip', 'Multicolored Paper, 500pcs', 50, 25, 1250, 'iar', 'csv', 'supply', 1, '', 0, 'CLI-01', 50, '', ''),
(13, 'Printer', 'Inkjet Laser Printer, black', 2, 3000, 6000, 'iar', 'csv', 'asset', 1, '', 0, NULL, 2, '', ''),
(14, 'Stapler', 'Swingline Heavy Duty, black', 2, 100, 1000, 'iar', 'csv', 'asset', 1, '', 0, NULL, 2, '', ''),
(15, 'Table', 'Table 2072 Office Table, gray', 1, 3000, 15000, 'iar', 'csv', 'asset', 1, '', 0, NULL, 1, '', ''),
(16, 'Chair', 'Q6A Mesh Chair, white', 1, 3000, 15000, 'iar', 'csv', 'asset', 1, '', 0, NULL, 1, '', ''),
(17, 'Pencil', 'Mongol, No. 2', 10, 5, 50, 'ppmp', 'csv', 'supply', 1, '', 0, 'PEN-01', 0, 'pcs.', ''),
(18, 'Bond Paper', 'Multipurpose legal, 70gsm.', 300, 1, 300, 'ppmp', 'csv', 'supply', 1, '', 0, 'PAP-01', 0, 'rm.', ''),
(19, 'Tape', 'Double-Sided Tape, 2inches', 10, 20, 200, 'ppmp', 'csv', 'supply', 1, '', 0, 'TAP-01', 0, 'pcs.', ''),
(20, 'Paper Clip', 'Multicolored Paper, 500pcs', 50, 25, 1250, 'ppmp', 'csv', 'supply', 1, '', 0, 'CLI-01', 0, 'pcs.', ''),
(21, 'Pencil', 'Mongol, No. 2', 2, 5, 100, 'ris', 'csv', 'supply', 1, '', 2, 'PEN-01', 0, 'pcs.', ''),
(22, 'Bond Paper', 'Multipurpose legal, 70gsm.', 10, 1, 3000, 'ris', 'csv', 'supply', 1, '', 10, 'PAP-01', 0, 'rm.', '');

-- --------------------------------------------------------

--
-- Table structure for table `oejwo`
--

CREATE TABLE IF NOT EXISTS `oejwo` (
  `oejwo_no` varchar(45) NOT NULL,
  `employee` varchar(45) NOT NULL,
  `emp_no` varchar(45) NOT NULL,
  `asset_no` varchar(45) NOT NULL,
  `date_created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_modified` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` varchar(45) NOT NULL,
  `wmr_no` varchar(45) NOT NULL,
  KEY `wmr_no_idx` (`wmr_no`),
  KEY `asset_no_idx` (`asset_no`),
  KEY `asset_no2_idx` (`asset_no`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `par`
--

CREATE TABLE IF NOT EXISTS `par` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `par_no` varchar(45) NOT NULL,
  `asset_no` varchar(45) NOT NULL,
  `status` varchar(45) NOT NULL,
  `received_from` varchar(45) NOT NULL,
  `position_from` varchar(45) NOT NULL,
  `received_by` varchar(45) NOT NULL,
  `position_by` varchar(45) NOT NULL,
  `date_created` date NOT NULL,
  `date_modified` date DEFAULT NULL,
  `emp_id` varchar(45) NOT NULL,
  `created_by` varchar(45) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `par`
--

INSERT INTO `par` (`id`, `par_no`, `asset_no`, `status`, `received_from`, `position_from`, `received_by`, `position_by`, `date_created`, `date_modified`, `emp_id`, `created_by`) VALUES
(1, '2016-06-1', 'ACC-2016-1', 'completed', '', '', '', '', '2016-06-15', NULL, '1', 'Carl Thomas Rivera');

-- --------------------------------------------------------

--
-- Table structure for table `pc`
--

CREATE TABLE IF NOT EXISTS `pc` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pc_no` varchar(45) NOT NULL,
  `asset_no` varchar(45) NOT NULL,
  `status` varchar(45) NOT NULL,
  `remarks` varchar(255) NOT NULL,
  `date_created` date NOT NULL,
  `date_modified` date NOT NULL,
  `emp_id` int(11) DEFAULT NULL,
  `created_by` varchar(45) NOT NULL,
  `modified_by` varchar(45) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `emp_id_idx` (`emp_id`),
  KEY `emp_id` (`emp_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `pc`
--

INSERT INTO `pc` (`id`, `pc_no`, `asset_no`, `status`, `remarks`, `date_created`, `date_modified`, `emp_id`, `created_by`, `modified_by`) VALUES
(1, '', 'ACC-2016-1', 'Serviceable', 'For printing only', '2016-06-15', '0000-00-00', 1, 'Carl Thomas Rivera', 'Carl Thomas Rivera'),
(2, '', 'ACC-2016-1', 'Unserviceable', 'No ink', '0000-00-00', '2016-08-16', NULL, '', '');

-- --------------------------------------------------------

--
-- Table structure for table `po`
--

CREATE TABLE IF NOT EXISTS `po` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `po_no` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `date_created` date NOT NULL,
  `date_modified` date NOT NULL,
  `iar_status` varchar(255) NOT NULL,
  `user_id` int(11) NOT NULL,
  `modified_by` varchar(45) DEFAULT NULL,
  `supplier` varchar(255) DEFAULT NULL,
  `source` varchar(255) DEFAULT NULL,
  `purpose` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `tin` varchar(45) DEFAULT NULL,
  `mode` varchar(45) DEFAULT NULL,
  `pdelivery` varchar(255) DEFAULT NULL,
  `ddelivery` date DEFAULT NULL,
  `dterm` varchar(255) DEFAULT NULL,
  `pterm` varchar(255) DEFAULT NULL,
  `sign` varchar(45) DEFAULT NULL,
  `signby` varchar(45) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `po`
--

INSERT INTO `po` (`id`, `po_no`, `status`, `date_created`, `date_modified`, `iar_status`, `user_id`, `modified_by`, `supplier`, `source`, `purpose`, `address`, `tin`, `mode`, `pdelivery`, `ddelivery`, `dterm`, `pterm`, `sign`, `signby`) VALUES
(1, '16-06-1', 'completed', '2016-06-16', '2016-06-15', 'pending', 1, 'Kim  dela Cruz  Sibul', 'SHR Merchandise', 'Budget', 'Out of stock', 'Magsaysay Ave. Baguio City', '2352-6357-3473-2410', 'Shopping', 'Riverview Waterpark', '2016-06-21', '5 days', '5-10 days', 'Regional Director', 'Marlo L. Iringan');

-- --------------------------------------------------------

--
-- Table structure for table `ppe`
--

CREATE TABLE IF NOT EXISTS `ppe` (
  `ppe_no` varchar(45) NOT NULL,
  `employee` varchar(45) NOT NULL,
  `asset_no` varchar(45) NOT NULL,
  `date_created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_modified` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `ppmp`
--

CREATE TABLE IF NOT EXISTS `ppmp` (
  `ppmp_id` int(11) NOT NULL AUTO_INCREMENT,
  `year` varchar(255) NOT NULL,
  `quarter` int(11) NOT NULL,
  `dept_id` int(11) NOT NULL,
  `flag` int(11) NOT NULL,
  `filename` varchar(255) NOT NULL,
  PRIMARY KEY (`ppmp_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `ppmp`
--

INSERT INTO `ppmp` (`ppmp_id`, `year`, `quarter`, `dept_id`, `flag`, `filename`) VALUES
(1, '2016', 1, 2, 1, 'PPMP.csv');

-- --------------------------------------------------------

--
-- Table structure for table `ris`
--

CREATE TABLE IF NOT EXISTS `ris` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ris_no` varchar(255) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `date_created` date DEFAULT NULL,
  `date_modified` date DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `dept_id` int(11) DEFAULT NULL,
  `flag` int(11) NOT NULL DEFAULT '1',
  `modified_by` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `ris`
--

INSERT INTO `ris` (`id`, `ris_no`, `status`, `date_created`, `date_modified`, `user_id`, `dept_id`, `flag`, `modified_by`) VALUES
(1, 'RIS-1-2016', 'completed', '2016-06-15', NULL, 4, 2, 1, 'Carl Thomas Rivera');

-- --------------------------------------------------------

--
-- Table structure for table `sai`
--

CREATE TABLE IF NOT EXISTS `sai` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sai_no` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `date_created` date NOT NULL,
  `date_modified` date NOT NULL,
  `user_id` int(11) NOT NULL,
  `dept_id` int(11) NOT NULL,
  `ris_status` varchar(45) NOT NULL DEFAULT 'none',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `supply_inventory`
--

CREATE TABLE IF NOT EXISTS `supply_inventory` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `qty` int(11) NOT NULL,
  `unit_cost` float NOT NULL,
  `total_cost` float NOT NULL,
  `dispense_qty` int(11) NOT NULL,
  `code` varchar(45) DEFAULT NULL,
  `unit` varchar(45) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `supply_inventory`
--

INSERT INTO `supply_inventory` (`id`, `name`, `description`, `qty`, `unit_cost`, `total_cost`, `dispense_qty`, `code`, `unit`) VALUES
(1, 'Pencil', 'Mongol, No. 2', 10, 5, 50, 2, 'PEN-01', 'pcs.'),
(2, 'Bond Paper', 'Multipurpose legal, 70gsm.', 300, 1, 300, 10, 'PAP-01', 'rm.'),
(3, 'Tape', 'Double-Sided Tape, 2inches', 10, 20, 200, 0, 'TAP-01', 'pcs.'),
(4, 'Paper Clip', 'Multicolored Paper, 500pcs', 50, 25, 1250, 0, 'CLI-01', 'pcs.');

-- --------------------------------------------------------

--
-- Table structure for table `user_account`
--

CREATE TABLE IF NOT EXISTS `user_account` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `department` int(11) NOT NULL,
  `access_level` varchar(255) NOT NULL,
  `position` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `dept_idx` (`id`),
  KEY `dept_idx1` (`department`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `user_account`
--

INSERT INTO `user_account` (`id`, `username`, `password`, `department`, `access_level`, `position`) VALUES
(1, 'gsshead', 'b347807626c9f96adc1582e47f5207b3', 1, 'head', 'GSS Head'),
(2, 'ithead', 'c6fcb75a09165d75e74fbabcb0af70b5', 3, 'head', 'GSS Head'),
(4, 'accountinghead', '3833ba628cf7a11bc3628c3e37b3a955', 2, 'head', 'Accounting Head'),
(9, 'user1', '24c9e15e52afc47c225b757e7bee1f9d', 1, 'head', 'Officer 2');

-- --------------------------------------------------------

--
-- Table structure for table `user_profile`
--

CREATE TABLE IF NOT EXISTS `user_profile` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `firstname` varchar(255) NOT NULL,
  `middlename` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `user_account` int(11) NOT NULL,
  `user_image` varchar(255) DEFAULT NULL,
  `home_addr` varchar(225) DEFAULT NULL,
  `tel_no` int(11) DEFAULT NULL,
  `email` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_idx` (`user_account`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `user_profile`
--

INSERT INTO `user_profile` (`id`, `firstname`, `middlename`, `lastname`, `user_account`, `user_image`, `home_addr`, `tel_no`, `email`) VALUES
(1, 'Carl', 'Thomas', 'Rivera', 1, NULL, 'Baguio City', 0, NULL),
(2, 'James', 'Abueva', 'Garcia', 2, NULL, 'Baguio City', NULL, NULL),
(4, 'Kim', ' dela Cruz', ' Sibul', 4, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `wmr`
--

CREATE TABLE IF NOT EXISTS `wmr` (
  `wmr_no` varchar(45) NOT NULL,
  `asset_no` varchar(45) NOT NULL,
  `emp_no` varchar(45) NOT NULL,
  `employee` varchar(45) NOT NULL,
  `date_created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_modified` datetime DEFAULT NULL,
  `status` varchar(45) NOT NULL,
  PRIMARY KEY (`wmr_no`),
  KEY `asset_no_idx` (`asset_no`),
  KEY `asset_no2_idx` (`asset_no`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `disposed`
--
ALTER TABLE `disposed`
  ADD CONSTRAINT `emp` FOREIGN KEY (`employee`) REFERENCES `user_profile` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `wmr_disposed` FOREIGN KEY (`wmr_no`) REFERENCES `wmr` (`wmr_no`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `iar`
--
ALTER TABLE `iar`
  ADD CONSTRAINT `po_id` FOREIGN KEY (`po_id`) REFERENCES `po` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
